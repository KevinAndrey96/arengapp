<?php

declare(strict_types=1);

namespace Arengapp\Domain;

interface ArengaCatalog
{
    /**
     * @return list<Arenga> in display order
     */
    public function all(): array;

    public function find(string $slug): ?Arenga;
}
