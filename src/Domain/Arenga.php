<?php

declare(strict_types=1);

namespace Arengapp\Domain;

/**
 * A protest chant of the archive with its recording and, when known, its lyrics.
 */
final readonly class Arenga
{
    private const string SLUG_PATTERN = '/^[a-z0-9]+(?:-[a-z0-9]+)*$/';

    /**
     * @param list<string>|null $lyrics one entry per sung line, null while nobody has transcribed it
     */
    public function __construct(
        public string $slug,
        public string $title,
        public Category $category,
        public int $seconds,
        public ?array $lyrics,
    ) {
        if (preg_match(self::SLUG_PATTERN, $slug) !== 1) {
            throw new InvalidArenga(\sprintf('invalid slug "%s"', $slug));
        }
        if (trim($title) === '') {
            throw new InvalidArenga(\sprintf('empty title for "%s"', $slug));
        }
        if ($seconds < 1) {
            throw new InvalidArenga(\sprintf('non-positive duration for "%s"', $slug));
        }
        if ($lyrics === []) {
            throw new InvalidArenga(\sprintf('empty lyrics for "%s", use null instead', $slug));
        }
    }

    public function url(): string
    {
        return '/arengas/' . $this->slug;
    }

    public function audioPath(): string
    {
        return '/audio/' . $this->slug . '.mp3';
    }

    public function hasLyrics(): bool
    {
        return $this->lyrics !== null;
    }

    /** ISO 8601 duration, as expected by schema.org. */
    public function isoDuration(): string
    {
        $minutes = intdiv($this->seconds, 60);
        $seconds = $this->seconds % 60;

        return 'PT' . ($minutes > 0 ? $minutes . 'M' : '') . $seconds . 'S';
    }

    public function clockDuration(): string
    {
        return \sprintf('%d:%02d', intdiv($this->seconds, 60), $this->seconds % 60);
    }

    /** Short plain-text description for search results and link previews. */
    public function summary(): string
    {
        if ($this->lyrics === null) {
            return \sprintf(
                'Escucha "%s", arenga del %s grabada en las movilizaciones sociales de Colombia.',
                $this->title,
                mb_strtolower($this->category->label()),
            );
        }

        $excerpt = implode(' ', \array_slice($this->lyrics, 0, 2));

        return \sprintf('Letra y audio de "%s": %s', $this->title, $excerpt);
    }
}
