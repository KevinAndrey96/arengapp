<?php

declare(strict_types=1);

namespace Arengapp\Http;

final readonly class SiteConfig
{
    public const string REPOSITORY_URL = 'https://github.com/KevinAndrey96/php-arengapp-protest-audio-archive';

    public string $baseUrl;

    public function __construct(string $baseUrl)
    {
        $this->baseUrl = rtrim($baseUrl, '/');
    }

    public static function fromEnvironment(): self
    {
        $url = getenv('APP_URL');

        return new self(\is_string($url) && $url !== '' ? $url : 'http://localhost:8080');
    }

    public function absolute(string $path): string
    {
        return $this->baseUrl . $path;
    }
}
