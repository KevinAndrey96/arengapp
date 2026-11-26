<?php

declare(strict_types=1);

namespace Arengapp\View;

use Arengapp\Http\SiteConfig;

/**
 * Renders plain PHP templates inside the shared layout. Templates escape every value with e().
 */
final readonly class View
{
    public function __construct(
        private string $templatesDir,
        private string $publicDir,
        private SiteConfig $site,
    ) {}

    /** Public URL of a static file with a content hash, so long browser caches never serve stale code. */
    public function asset(string $path): string
    {
        $hash = @md5_file($this->publicDir . $path);

        return $hash === false ? $path : $path . '?v=' . substr($hash, 0, 10);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function page(string $template, array $data, PageMeta $meta): string
    {
        return $this->render('layout', [
            'content' => $this->render($template, $data),
            'meta' => $meta,
            'site' => $this->site,
            'repositoryUrl' => SiteConfig::REPOSITORY_URL,
        ]);
    }

    public function e(string $value): string
    {
        return htmlspecialchars($value, \ENT_QUOTES | \ENT_SUBSTITUTE, 'UTF-8');
    }

    /** JSON safe to embed inside a script element. */
    public function json(mixed $value): string
    {
        return json_encode($value, \JSON_THROW_ON_ERROR | \JSON_UNESCAPED_UNICODE | \JSON_UNESCAPED_SLASHES | \JSON_HEX_TAG | \JSON_HEX_AMP);
    }

    /**
     * @param array<string, mixed> $data
     */
    private function render(string $template, array $data): string
    {
        $file = $this->templatesDir . '/' . $template . '.php';
        if (!is_file($file)) {
            throw new \LogicException(\sprintf('template "%s" not found', $template));
        }

        ob_start();
        try {
            (function (string $__file, array $__data): void {
                extract($__data, \EXTR_SKIP);
                require $__file;
            })->call($this, $file, $data);
        } catch (\Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return (string) ob_get_clean();
    }
}
