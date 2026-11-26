<?php

declare(strict_types=1);

namespace Arengapp\Tests\Integration;

use Arengapp\Domain\Arenga;
use Arengapp\Domain\Category;
use Arengapp\Infrastructure\JsonArengaCatalog;
use PHPUnit\Framework\TestCase;

/**
 * Guards the published archive: every entry has its recording and every recording is listed.
 */
final class ArchiveIntegrityTest extends TestCase
{
    private const string ROOT = __DIR__ . '/../..';

    /**
     * @return list<Arenga>
     */
    private function arengas(): array
    {
        return (new JsonArengaCatalog(self::ROOT . '/data/arengas.json'))->all();
    }

    public function testTheArchiveHasTheFortyTwoArengas(): void
    {
        self::assertCount(42, $this->arengas());
    }

    public function testEveryArengaHasItsRecording(): void
    {
        foreach ($this->arengas() as $arenga) {
            self::assertFileExists(self::ROOT . '/public' . $arenga->audioPath(), $arenga->slug);
        }
    }

    public function testEveryRecordingBelongsToAnArenga(): void
    {
        $listed = array_map(static fn(Arenga $a): string => $a->slug . '.mp3', $this->arengas());
        $paths = glob(self::ROOT . '/public/audio/*.mp3');
        self::assertNotFalse($paths);
        $files = array_map('basename', $paths);

        self::assertEqualsCanonicalizing($listed, $files);
    }

    public function testEveryCategoryHasItsCover(): void
    {
        foreach (Category::cases() as $category) {
            self::assertFileExists(self::ROOT . '/public' . $category->coverPath());
        }
    }

    public function testTitlesAreUnique(): void
    {
        $titles = array_map(static fn(Arenga $a): string => mb_strtolower($a->title), $this->arengas());

        self::assertSame($titles, array_values(array_unique($titles)));
    }
}
