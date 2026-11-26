<?php

declare(strict_types=1);

namespace Arengapp\Tests\Unit\Infrastructure;

use Arengapp\Domain\Category;
use Arengapp\Infrastructure\CatalogUnavailable;
use Arengapp\Infrastructure\JsonArengaCatalog;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class JsonArengaCatalogTest extends TestCase
{
    private string $file;

    protected function setUp(): void
    {
        $this->file = (string) tempnam(sys_get_temp_dir(), 'arengas');
    }

    protected function tearDown(): void
    {
        @unlink($this->file);
    }

    public function testLoadsArengasInFileOrder(): void
    {
        file_put_contents($this->file, (string) json_encode([
            ['slug' => 'viva-la-u', 'title' => 'Viva la U', 'category' => 'estudiantes', 'seconds' => 78, 'lyrics' => ['¡Viva la U!']],
            ['slug' => 'duque-chao', 'title' => '¡Duque chao!', 'category' => 'nacional', 'seconds' => 152, 'lyrics' => null],
        ]));
        $catalog = new JsonArengaCatalog($this->file);

        $all = $catalog->all();

        self::assertCount(2, $all);
        self::assertSame(['viva-la-u', 'duque-chao'], array_map(static fn($a) => $a->slug, $all));
        self::assertSame(Category::Nacional, $catalog->find('duque-chao')?->category);
        self::assertSame(['¡Viva la U!'], $catalog->find('viva-la-u')?->lyrics);
        self::assertNull($catalog->find('no-existe'));
    }

    public function testFailsWhenTheFileIsMissing(): void
    {
        $this->expectException(CatalogUnavailable::class);
        $this->expectExceptionMessage('is not readable');

        (new JsonArengaCatalog($this->file . '.missing'))->all();
    }

    /**
     * @return iterable<string, array{string, string}>
     */
    public static function brokenFiles(): iterable
    {
        $ok = ['slug' => 'viva-la-u', 'title' => 'Viva la U', 'category' => 'estudiantes', 'seconds' => 78, 'lyrics' => null];

        yield 'invalid json' => ['[{', 'catalog json: Syntax error'];
        yield 'object instead of list' => ['{"a": 1}', 'expected a list'];
        yield 'entry is not an object' => ['["viva"]', 'entry 0 is not an object'];
        yield 'unknown category' => [(string) json_encode([[...$ok, 'category' => 'otra']]), 'known category'];
        yield 'missing seconds' => [(string) json_encode([array_diff_key($ok, ['seconds' => 0])]), 'needs slug, title, seconds'];
        yield 'lyrics with numbers' => [(string) json_encode([[...$ok, 'lyrics' => ['línea', 3]]]), 'must be a list of lines'];
        yield 'invalid slug' => [(string) json_encode([[...$ok, 'slug' => 'Viva La U']]), 'invalid slug'];
        yield 'duplicated slug' => [(string) json_encode([$ok, $ok]), 'duplicated slug "viva-la-u"'];
    }

    #[DataProvider('brokenFiles')]
    public function testRejectsBrokenFiles(string $contents, string $message): void
    {
        file_put_contents($this->file, $contents);

        $this->expectException(CatalogUnavailable::class);
        $this->expectExceptionMessage($message);

        (new JsonArengaCatalog($this->file))->all();
    }
}
