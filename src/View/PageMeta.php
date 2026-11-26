<?php

declare(strict_types=1);

namespace Arengapp\View;

final readonly class PageMeta
{
    /**
     * @param array<string, mixed>|null $jsonLd schema.org data for the page
     */
    public function __construct(
        public string $title,
        public string $description,
        public string $path,
        public string $image = '/assets/covers/nacional.png',
        public ?array $jsonLd = null,
        public bool $indexable = true,
    ) {}
}
