<?php

declare(strict_types=1);

namespace Arengapp\Http;

use Arengapp\Domain\Arenga;
use Arengapp\Domain\ArengaCatalog;
use Arengapp\Domain\Category;
use Arengapp\View\PageMeta;
use Arengapp\View\View;

/**
 * Routes a request to the page that answers it and applies the security headers.
 */
final readonly class App
{
    private const array SECURITY_HEADERS = [
        'Content-Security-Policy' => "default-src 'self'; img-src 'self' data:; media-src 'self'; style-src 'self'; script-src 'self'; "
            . "object-src 'none'; base-uri 'self'; form-action 'self'; frame-ancestors 'none'",
        'X-Content-Type-Options' => 'nosniff',
        'Referrer-Policy' => 'strict-origin-when-cross-origin',
        'Permissions-Policy' => 'camera=(), microphone=(), geolocation=()',
        'Cross-Origin-Opener-Policy' => 'same-origin',
    ];

    private const array LEGACY_REDIRECTS = [
        '/index.php' => '/',
        '/privacidad.php' => '/privacidad',
    ];

    public function __construct(
        private ArengaCatalog $catalog,
        private View $view,
        private SiteConfig $site,
    ) {}

    public function handle(Request $request): Response
    {
        try {
            $response = $this->route($request);
        } catch (\Throwable $e) {
            error_log('arengapp: ' . $e::class . ': ' . $e->getMessage());
            $response = Response::html($this->view->page('error', [], new PageMeta('Algo salió mal', 'Error interno.', '/', indexable: false)), 500);
        }

        return $response->withHeaders(self::SECURITY_HEADERS);
    }

    private function route(Request $request): Response
    {
        if ($request->method !== 'GET' && $request->method !== 'HEAD') {
            return new Response(405, '', ['Allow' => 'GET, HEAD']);
        }

        if (isset(self::LEGACY_REDIRECTS[$request->path])) {
            return Response::redirect(self::LEGACY_REDIRECTS[$request->path]);
        }

        if ($request->path !== '/' && str_ends_with($request->path, '/')) {
            $trimmed = rtrim($request->path, '/');

            return Response::redirect($trimmed === '' ? '/' : $trimmed);
        }

        if (preg_match('#^/arengas/([a-z0-9-]+)$#', $request->path, $match) === 1) {
            $arenga = $this->catalog->find($match[1]);

            return $arenga === null ? $this->notFound() : $this->arengaPage($arenga);
        }

        return match ($request->path) {
            '/' => $this->homePage(),
            '/privacidad' => Response::html($this->view->page('privacy', [], new PageMeta(
                'Política de privacidad',
                'ArengApp no usa cookies, analítica ni publicidad y no recoge datos personales.',
                '/privacidad',
            ))),
            '/sitemap.xml' => $this->sitemap(),
            '/robots.txt' => new Response(
                200,
                "User-agent: *\nAllow: /\n\nSitemap: " . $this->site->absolute('/sitemap.xml') . "\n",
                ['Content-Type' => 'text/plain; charset=utf-8'],
            ),
            default => $this->notFound(),
        };
    }

    private function homePage(): Response
    {
        $arengas = $this->catalog->all();

        return Response::html($this->view->page('catalog', $this->catalogData($arengas, null), new PageMeta(
            'Archivo sonoro de arengas del paro nacional en Colombia',
            \sprintf(
                'Escucha %d arengas del paro nacional, el movimiento estudiantil y el movimiento feminista de Colombia (2019-2021), con letras y reproductor en línea.',
                \count($arengas),
            ),
            '/',
            jsonLd: $this->collectionJsonLd($arengas),
        )));
    }

    private function arengaPage(Arenga $arenga): Response
    {
        return Response::html($this->view->page('catalog', $this->catalogData($this->catalog->all(), $arenga), new PageMeta(
            $arenga->title . ' | Arenga ' . mb_strtolower($arenga->category->label()),
            $arenga->summary(),
            $arenga->url(),
            image: $arenga->category->coverPath(),
            jsonLd: $this->recordingJsonLd($arenga),
        )));
    }

    private function notFound(): Response
    {
        return Response::html($this->view->page('not-found', [], new PageMeta(
            'Arenga no encontrada',
            'La página que buscas no existe en el archivo.',
            '/',
            indexable: false,
        )), 404);
    }

    private function sitemap(): Response
    {
        $paths = ['/', '/privacidad', ...array_map(static fn(Arenga $a): string => $a->url(), $this->catalog->all())];
        $xml = new \XMLWriter();
        $xml->openMemory();
        $xml->startDocument('1.0', 'UTF-8');
        $xml->startElement('urlset');
        $xml->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        foreach ($paths as $path) {
            $xml->startElement('url');
            $xml->writeElement('loc', $this->site->absolute($path));
            $xml->endElement();
        }
        $xml->endElement();
        $xml->endDocument();

        return new Response(200, $xml->outputMemory(), ['Content-Type' => 'application/xml; charset=utf-8']);
    }

    /**
     * @param list<Arenga> $arengas
     *
     * @return array<string, mixed>
     */
    private function catalogData(array $arengas, ?Arenga $current): array
    {
        $counts = [];
        foreach (Category::cases() as $category) {
            $counts[$category->value] = \count(array_filter($arengas, static fn(Arenga $a): bool => $a->category === $category));
        }

        return [
            'arengas' => $arengas,
            'current' => $current ?? $arengas[0] ?? null,
            'isHome' => $current === null,
            'counts' => $counts,
            'repositoryUrl' => SiteConfig::REPOSITORY_URL,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private function recordingJsonLd(Arenga $arenga): array
    {
        $data = [
            '@context' => 'https://schema.org',
            '@type' => 'MusicRecording',
            'name' => $arenga->title,
            'url' => $this->site->absolute($arenga->url()),
            'duration' => $arenga->isoDuration(),
            'genre' => 'Arenga de protesta',
            'inLanguage' => 'es-CO',
            'isPartOf' => ['@type' => 'Collection', 'name' => 'ArengApp', 'url' => $this->site->absolute('/')],
            'audio' => [
                '@type' => 'AudioObject',
                'contentUrl' => $this->site->absolute($arenga->audioPath()),
                'encodingFormat' => 'audio/mpeg',
                'duration' => $arenga->isoDuration(),
            ],
        ];
        if ($arenga->lyrics !== null) {
            $data['recordingOf'] = [
                '@type' => 'MusicComposition',
                'name' => $arenga->title,
                'lyrics' => ['@type' => 'CreativeWork', 'text' => implode("\n", $arenga->lyrics)],
            ];
        }

        return $data;
    }

    /**
     * @param list<Arenga> $arengas
     *
     * @return array<string, mixed>
     */
    private function collectionJsonLd(array $arengas): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Collection',
            'name' => 'ArengApp: archivo sonoro de arengas',
            'url' => $this->site->absolute('/'),
            'inLanguage' => 'es-CO',
            'about' => 'Arengas de las movilizaciones sociales en Colombia entre 2019 y 2021',
            'hasPart' => array_map(fn(Arenga $a): array => [
                '@type' => 'MusicRecording',
                'name' => $a->title,
                'url' => $this->site->absolute($a->url()),
            ], $arengas),
        ];
    }
}
