<?php

declare(strict_types=1);

namespace Arengapp\Tests\Http;

use Arengapp\Domain\Arenga;
use Arengapp\Domain\ArengaCatalog;
use Arengapp\Domain\Category;
use Arengapp\Http\App;
use Arengapp\Http\Request;
use Arengapp\Http\Response;
use Arengapp\Http\SiteConfig;
use Arengapp\View\View;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class AppTest extends TestCase
{
    /**
     * @param list<Arenga>|null $arengas
     */
    private function get(string $path, ?array $arengas = null, string $method = 'GET'): Response
    {
        $catalog = new InMemoryCatalog($arengas ?? [
            new Arenga('viva-la-u', 'Viva la U', Category::Estudiantes, 78, ['¡Viva la U! ¡Viva!', 'Viva la universidad']),
            new Arenga('duque-chao', '¡Duque chao!', Category::Nacional, 152, null),
            new Arenga('hoy-peleamos', 'Hoy peleamos', Category::Feministas, 27, null),
        ]);
        $site = new SiteConfig('https://arengapp.test/');
        $app = new App($catalog, new View(__DIR__ . '/../../templates', __DIR__ . '/../../public', $site), $site);

        return $app->handle(new Request($method, $path));
    }

    public function testHomeListsEveryArengaWithFilters(): void
    {
        $response = $this->get('/');

        self::assertSame(200, $response->status);
        self::assertSame('text/html; charset=utf-8', $response->headers['Content-Type']);
        self::assertStringContainsString('<title>ArengApp | Archivo sonoro de arengas del paro nacional en Colombia</title>', $response->body);
        self::assertStringContainsString('href="/arengas/viva-la-u"', $response->body);
        self::assertStringContainsString('href="/arengas/duque-chao"', $response->body);
        self::assertStringContainsString('Movimiento feminista <span>1</span>', $response->body);
        self::assertStringContainsString('<link rel="canonical" href="https://arengapp.test/">', $response->body);
        self::assertStringContainsString('"@type":"Collection"', $response->body);
        self::assertMatchesRegularExpression('#<script type="module" src="/assets/app\.js\?v=[0-9a-f]{10}"></script>#', $response->body);
        self::assertMatchesRegularExpression('#<link rel="stylesheet" href="/assets/app\.css\?v=[0-9a-f]{10}">#', $response->body);
    }

    public function testArengaPageShowsLyricsAndStructuredData(): void
    {
        $response = $this->get('/arengas/viva-la-u');

        self::assertSame(200, $response->status);
        self::assertStringContainsString('<h1>Viva la U</h1>', $response->body);
        self::assertStringContainsString('<p>¡Viva la U! ¡Viva!</p>', $response->body);
        self::assertStringContainsString('src="/audio/viva-la-u.mp3"', $response->body);
        self::assertStringContainsString('<link rel="canonical" href="https://arengapp.test/arengas/viva-la-u">', $response->body);
        self::assertStringContainsString('<meta property="og:type" content="music.song">', $response->body);
        self::assertStringContainsString('"@type":"MusicRecording"', $response->body);
        self::assertStringContainsString('"duration":"PT1M18S"', $response->body);
        self::assertStringContainsString('class="track is-current" data-slug="viva-la-u"', $response->body);
    }

    public function testArengaWithoutLyricsInvitesContributions(): void
    {
        $response = $this->get('/arengas/duque-chao');

        self::assertStringContainsString('Aún no tenemos la letra de esta arenga.', $response->body);
        self::assertStringContainsString('/issues/new?template=letra.yml&amp;title=Letra%3A%20%C2%A1Duque%20chao%21', $response->body);
        self::assertStringNotContainsString('"recordingOf"', $response->body);
    }

    public function testEscapesCatalogContent(): void
    {
        $response = $this->get('/arengas/xss', [
            new Arenga('xss', '<script>alert(1)</script>', Category::Nacional, 5, ['</script><img src=x onerror=alert(1)>']),
        ]);

        self::assertStringNotContainsString('<script>alert(1)</script>', $response->body);
        self::assertStringNotContainsString('<img src=x', $response->body);
        self::assertStringContainsString('&lt;script&gt;alert(1)&lt;/script&gt;', $response->body);
        self::assertStringContainsString('\u003C/script\u003E', $response->body);
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function missingPages(): iterable
    {
        yield 'unknown arenga' => ['/arengas/no-existe'];
        yield 'unknown page' => ['/admin'];
        yield 'invalid slug' => ['/arengas/Viva%20la%20U'];
    }

    #[DataProvider('missingPages')]
    public function testUnknownPagesAreNotFound(string $path): void
    {
        $response = $this->get($path);

        self::assertSame(404, $response->status);
        self::assertStringContainsString('<meta name="robots" content="noindex">', $response->body);
    }

    public function testPrivacyPage(): void
    {
        $response = $this->get('/privacidad');

        self::assertSame(200, $response->status);
        self::assertStringContainsString('No hay cuentas, formularios, cookies, analítica, publicidad', $response->body);
    }

    public function testSitemapListsEveryPage(): void
    {
        $response = $this->get('/sitemap.xml');

        self::assertSame(200, $response->status);
        self::assertSame('application/xml; charset=utf-8', $response->headers['Content-Type']);
        $xml = simplexml_load_string($response->body);
        self::assertNotFalse($xml);
        $locations = [];
        foreach ($xml->url as $url) {
            $locations[] = (string) $url->loc;
        }
        self::assertSame([
            'https://arengapp.test/',
            'https://arengapp.test/privacidad',
            'https://arengapp.test/arengas/viva-la-u',
            'https://arengapp.test/arengas/duque-chao',
            'https://arengapp.test/arengas/hoy-peleamos',
        ], $locations);
    }

    public function testRobotsPointsToTheAbsoluteSitemap(): void
    {
        $response = $this->get('/robots.txt');

        self::assertSame(200, $response->status);
        self::assertStringContainsString('Sitemap: https://arengapp.test/sitemap.xml', $response->body);
    }

    /**
     * @return iterable<string, array{string, string}>
     */
    public static function legacyUrls(): iterable
    {
        yield 'old home' => ['/index.php', '/'];
        yield 'old privacy page' => ['/privacidad.php', '/privacidad'];
        yield 'trailing slash' => ['/arengas/viva-la-u/', '/arengas/viva-la-u'];
        yield 'only slashes' => ['//', '/'];
    }

    #[DataProvider('legacyUrls')]
    public function testRedirectsLegacyUrls(string $from, string $to): void
    {
        $response = $this->get($from);

        self::assertSame(301, $response->status);
        self::assertSame($to, $response->headers['Location']);
    }

    public function testOnlyReadsAreAllowed(): void
    {
        $response = $this->get('/', method: 'POST');

        self::assertSame(405, $response->status);
        self::assertSame('GET, HEAD', $response->headers['Allow']);
    }

    public function testEveryResponseCarriesSecurityHeaders(): void
    {
        foreach (['/', '/arengas/no-existe', '/sitemap.xml'] as $path) {
            $headers = $this->get($path)->headers;

            self::assertStringContainsString("default-src 'self'", $headers['Content-Security-Policy']);
            self::assertStringContainsString("frame-ancestors 'none'", $headers['Content-Security-Policy']);
            self::assertSame('nosniff', $headers['X-Content-Type-Options']);
            self::assertSame('strict-origin-when-cross-origin', $headers['Referrer-Policy']);
        }
    }

    public function testCatalogFailuresBecomeAnErrorPage(): void
    {
        $site = new SiteConfig('https://arengapp.test');
        $app = new App(new FailingCatalog(), new View(__DIR__ . '/../../templates', __DIR__ . '/../../public', $site), $site);
        $log = ini_set('error_log', '/dev/null');

        $response = $app->handle(new Request('GET', '/'));
        ini_set('error_log', (string) $log);

        self::assertSame(500, $response->status);
        self::assertStringContainsString('Algo salió mal', $response->body);
        self::assertArrayHasKey('Content-Security-Policy', $response->headers);
    }

    public function testRequestIsBuiltFromServerVariables(): void
    {
        $request = Request::fromServer(['REQUEST_METHOD' => 'head', 'REQUEST_URI' => '/arengas/viva-la-u?utm=x']);

        self::assertSame('HEAD', $request->method);
        self::assertSame('/arengas/viva-la-u', $request->path);
        self::assertTrue($request->isHead());
        self::assertSame('/', Request::fromServer([])->path);
    }
}

final readonly class InMemoryCatalog implements ArengaCatalog
{
    /**
     * @param list<Arenga> $arengas
     */
    public function __construct(private array $arengas) {}

    public function all(): array
    {
        return $this->arengas;
    }

    public function find(string $slug): ?Arenga
    {
        foreach ($this->arengas as $arenga) {
            if ($arenga->slug === $slug) {
                return $arenga;
            }
        }

        return null;
    }
}

final class FailingCatalog implements ArengaCatalog
{
    public function all(): array
    {
        throw new \RuntimeException('disk unavailable');
    }

    public function find(string $slug): ?Arenga
    {
        throw new \RuntimeException('disk unavailable');
    }
}
