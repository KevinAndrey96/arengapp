<?php

declare(strict_types=1);

namespace Arengapp\Infrastructure;

use Arengapp\Domain\Arenga;
use Arengapp\Domain\ArengaCatalog;
use Arengapp\Domain\Category;
use Arengapp\Domain\InvalidArenga;

/**
 * Reads the archive from a JSON file once per request.
 */
final class JsonArengaCatalog implements ArengaCatalog
{
    /** @var array<string, Arenga>|null */
    private ?array $bySlug = null;

    public function __construct(private readonly string $path) {}

    public function all(): array
    {
        return array_values($this->load());
    }

    public function find(string $slug): ?Arenga
    {
        return $this->load()[$slug] ?? null;
    }

    /**
     * @return array<string, Arenga>
     */
    private function load(): array
    {
        if ($this->bySlug !== null) {
            return $this->bySlug;
        }

        $raw = @file_get_contents($this->path);
        if ($raw === false) {
            throw new CatalogUnavailable(\sprintf('catalog file "%s" is not readable', $this->path));
        }

        try {
            $rows = json_decode($raw, true, 8, \JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            throw new CatalogUnavailable('catalog json: ' . $e->getMessage(), 0, $e);
        }
        if (!\is_array($rows) || !array_is_list($rows)) {
            throw new CatalogUnavailable('catalog json: expected a list of arengas');
        }

        $bySlug = [];
        foreach ($rows as $position => $row) {
            $arenga = $this->hydrate($row, $position);
            if (isset($bySlug[$arenga->slug])) {
                throw new CatalogUnavailable(\sprintf('catalog json: duplicated slug "%s"', $arenga->slug));
            }
            $bySlug[$arenga->slug] = $arenga;
        }

        return $this->bySlug = $bySlug;
    }

    private function hydrate(mixed $row, int $position): Arenga
    {
        if (!\is_array($row)) {
            throw new CatalogUnavailable(\sprintf('catalog json: entry %d is not an object', $position));
        }

        $slug = $row['slug'] ?? null;
        $title = $row['title'] ?? null;
        $seconds = $row['seconds'] ?? null;
        $category = \is_string($row['category'] ?? null) ? Category::tryFrom($row['category']) : null;
        $lyrics = $row['lyrics'] ?? null;

        if (!\is_string($slug) || !\is_string($title) || !\is_int($seconds) || $category === null) {
            throw new CatalogUnavailable(\sprintf('catalog json: entry %d needs slug, title, seconds and a known category', $position));
        }
        if ($lyrics !== null && (!\is_array($lyrics) || !array_is_list($lyrics) || array_filter($lyrics, is_string(...)) !== $lyrics)) {
            throw new CatalogUnavailable(\sprintf('catalog json: lyrics of "%s" must be a list of lines or null', $slug));
        }

        try {
            /** @var list<string>|null $lyrics */
            return new Arenga($slug, $title, $category, $seconds, $lyrics);
        } catch (InvalidArenga $e) {
            throw new CatalogUnavailable('catalog json: ' . $e->getMessage(), 0, $e);
        }
    }
}
