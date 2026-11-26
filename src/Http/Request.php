<?php

declare(strict_types=1);

namespace Arengapp\Http;

final readonly class Request
{
    public function __construct(
        public string $method,
        public string $path,
    ) {}

    /**
     * @param array<mixed> $server usually $_SERVER
     */
    public static function fromServer(array $server): self
    {
        $method = \is_string($server['REQUEST_METHOD'] ?? null) ? strtoupper($server['REQUEST_METHOD']) : 'GET';
        $uri = \is_string($server['REQUEST_URI'] ?? null) ? $server['REQUEST_URI'] : '/';
        $path = parse_url($uri, \PHP_URL_PATH);

        return new self($method, \is_string($path) && $path !== '' ? rawurldecode($path) : '/');
    }

    public function isHead(): bool
    {
        return $this->method === 'HEAD';
    }
}
