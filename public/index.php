<?php

declare(strict_types=1);

use Arengapp\Http\App;
use Arengapp\Http\Request;
use Arengapp\Http\SiteConfig;
use Arengapp\Infrastructure\JsonArengaCatalog;
use Arengapp\View\View;

if (PHP_SAPI === 'cli-server') {
    $file = __DIR__ . parse_url(is_string($_SERVER['REQUEST_URI'] ?? null) ? $_SERVER['REQUEST_URI'] : '/', PHP_URL_PATH);
    if (is_file($file)) {
        return false;
    }
}

$root = dirname(__DIR__);
require $root . '/vendor/autoload.php';

$site = SiteConfig::fromEnvironment();
$app = new App(new JsonArengaCatalog($root . '/data/arengas.json'), new View($root . '/templates', $root . '/public', $site), $site);

$request = Request::fromServer($_SERVER);
$app->handle($request)->send(!$request->isHead());
