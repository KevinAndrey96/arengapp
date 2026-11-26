<?php

declare(strict_types=1);

namespace Arengapp\Tests\Unit\Domain;

use Arengapp\Domain\Arenga;
use Arengapp\Domain\Category;
use Arengapp\Domain\InvalidArenga;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class ArengaTest extends TestCase
{
    public function testExposesPathsForItsPageAndRecording(): void
    {
        $arenga = new Arenga('viva-la-u', 'Viva la U', Category::Estudiantes, 78, ['¡Viva la U! ¡Viva!']);

        self::assertSame('/arengas/viva-la-u', $arenga->url());
        self::assertSame('/audio/viva-la-u.mp3', $arenga->audioPath());
        self::assertTrue($arenga->hasLyrics());
    }

    /**
     * @return iterable<string, array{int, string, string}>
     */
    public static function durations(): iterable
    {
        yield 'seconds only' => [9, 'PT9S', '0:09'];
        yield 'exact minute' => [60, 'PT1M0S', '1:00'];
        yield 'minutes and seconds' => [152, 'PT2M32S', '2:32'];
    }

    #[DataProvider('durations')]
    public function testFormatsDurations(int $seconds, string $iso, string $clock): void
    {
        $arenga = new Arenga('duque-chao', '¡Duque chao!', Category::Nacional, $seconds, null);

        self::assertSame($iso, $arenga->isoDuration());
        self::assertSame($clock, $arenga->clockDuration());
    }

    public function testSummaryQuotesTheFirstLinesWhenLyricsAreKnown(): void
    {
        $arenga = new Arenga('represion', 'Represión', Category::Nacional, 10, ['¿Quiénes somos? ¡Estudiantes!', '¿Qué exigimos? ¡Soluciones!', 'tercera']);

        self::assertSame('Letra y audio de "Represión": ¿Quiénes somos? ¡Estudiantes! ¿Qué exigimos? ¡Soluciones!', $arenga->summary());
    }

    public function testSummaryDescribesTheRecordingWhenLyricsAreMissing(): void
    {
        $arenga = new Arenga('hoy-peleamos', 'Hoy peleamos', Category::Feministas, 27, null);

        self::assertFalse($arenga->hasLyrics());
        self::assertSame('Escucha "Hoy peleamos", arenga del movimiento feminista grabada en las movilizaciones sociales de Colombia.', $arenga->summary());
    }

    /**
     * @return iterable<string, array{string, string, int, list<string>|null, string}>
     */
    public static function invalidArengas(): iterable
    {
        yield 'uppercase slug' => ['Viva-La-U', 'Viva la U', 10, null, 'invalid slug'];
        yield 'slug with accents' => ['represión', 'Represión', 10, null, 'invalid slug'];
        yield 'trailing dash' => ['viva-', 'Viva', 10, null, 'invalid slug'];
        yield 'blank title' => ['viva-la-u', '  ', 10, null, 'empty title'];
        yield 'zero duration' => ['viva-la-u', 'Viva la U', 0, null, 'non-positive duration'];
        yield 'empty lyrics list' => ['viva-la-u', 'Viva la U', 10, [], 'empty lyrics'];
    }

    /**
     * @param list<string>|null $lyrics
     */
    #[DataProvider('invalidArengas')]
    public function testRejectsInvalidData(string $slug, string $title, int $seconds, ?array $lyrics, string $message): void
    {
        $this->expectException(InvalidArenga::class);
        $this->expectExceptionMessage($message);

        new Arenga($slug, $title, Category::Nacional, $seconds, $lyrics);
    }

    public function testCategoriesHaveLabelsAndCovers(): void
    {
        self::assertSame('Paro nacional', Category::Nacional->label());
        self::assertSame('Movimiento estudiantil', Category::Estudiantes->label());
        self::assertSame('Movimiento feminista', Category::Feministas->label());
        self::assertSame('/assets/covers/feministas.png', Category::Feministas->coverPath());
    }
}
