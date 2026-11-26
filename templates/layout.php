<?php
/**
 * @var Arengapp\View\View $this
 * @var string $content
 * @var Arengapp\View\PageMeta $meta
 * @var Arengapp\Http\SiteConfig $site
 * @var string $repositoryUrl
 */
$fullTitle = $meta->path === '/' ? 'ArengApp | ' . $meta->title : $meta->title . ' | ArengApp';
?>
<!DOCTYPE html>
<html lang="es-CO">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $this->e($fullTitle) ?></title>
  <meta name="description" content="<?= $this->e($meta->description) ?>">
  <meta name="robots" content="<?= $meta->indexable ? 'index, follow' : 'noindex' ?>">
  <meta name="theme-color" content="#252120">
  <link rel="canonical" href="<?= $this->e($site->absolute($meta->path)) ?>">
  <meta property="og:type" content="<?= str_starts_with($meta->path, '/arengas/') ? 'music.song' : 'website' ?>">
  <meta property="og:site_name" content="ArengApp">
  <meta property="og:locale" content="es_CO">
  <meta property="og:title" content="<?= $this->e($meta->title) ?>">
  <meta property="og:description" content="<?= $this->e($meta->description) ?>">
  <meta property="og:url" content="<?= $this->e($site->absolute($meta->path)) ?>">
  <meta property="og:image" content="<?= $this->e($site->absolute($meta->image)) ?>">
  <meta name="twitter:card" content="summary">
  <link rel="icon" href="/assets/icon.svg" type="image/svg+xml">
  <link rel="stylesheet" href="<?= $this->e($this->asset('/assets/app.css')) ?>">
  <?php if ($meta->jsonLd !== null): ?>
  <script type="application/ld+json"><?= $this->json($meta->jsonLd) ?></script>
  <?php endif ?>
  <script type="module" src="<?= $this->e($this->asset('/assets/app.js')) ?>"></script>
</head>
<body>
  <svg xmlns="http://www.w3.org/2000/svg" class="sprite" aria-hidden="true">
    <symbol id="i-play" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></symbol>
    <symbol id="i-pause" viewBox="0 0 24 24"><path d="M6 5h4v14H6zM14 5h4v14h-4z"/></symbol>
    <symbol id="i-prev" viewBox="0 0 24 24"><path d="M6 6h2v12H6zM9.5 12 18 18V6z"/></symbol>
    <symbol id="i-next" viewBox="0 0 24 24"><path d="M16 6h2v12h-2zM6 18l8.5-6L6 6z"/></symbol>
    <symbol id="i-github" viewBox="0 0 24 24"><path d="M12 .5a11.5 11.5 0 0 0-3.64 22.41c.58.1.79-.25.79-.56v-2c-3.2.7-3.88-1.37-3.88-1.37-.53-1.33-1.3-1.69-1.3-1.69-1.05-.72.08-.7.08-.7 1.16.08 1.77 1.19 1.77 1.19 1.03 1.77 2.71 1.26 3.37.96.1-.75.4-1.26.73-1.55-2.55-.29-5.24-1.28-5.24-5.68 0-1.26.45-2.28 1.19-3.09-.12-.29-.52-1.46.11-3.05 0 0 .97-.31 3.17 1.18a11 11 0 0 1 5.77 0c2.2-1.49 3.17-1.18 3.17-1.18.63 1.59.23 2.76.11 3.05.74.81 1.19 1.83 1.19 3.09 0 4.41-2.69 5.38-5.26 5.67.41.36.78 1.06.78 2.14v3.17c0 .31.21.67.8.56A11.5 11.5 0 0 0 12 .5Z"/></symbol>
  </svg>

  <header class="site-header">
    <a class="brand" href="/">Areng<span>App</span></a>
    <nav aria-label="Principal">
      <a href="/">Arengas</a>
      <a href="/privacidad">Privacidad</a>
      <a href="<?= $this->e($repositoryUrl) ?>" rel="noopener" target="_blank">
        <svg class="icon" aria-hidden="true"><use href="#i-github"/></svg><span class="sr-only">Código en GitHub</span>
      </a>
    </nav>
  </header>

  <main id="contenido">
<?= $content ?>
  </main>

  <footer class="site-footer">
    <p>Archivo de memoria histórica de las movilizaciones sociales en Colombia. El derecho a la protesta pacífica está protegido por el artículo 37 de la Constitución.</p>
    <p>Hecho por <a href="https://www.linkedin.com/in/kevinandrey96/" rel="noopener" target="_blank">Kevin Andrey Herrera Silva</a> · <a href="<?= $this->e($repositoryUrl) ?>" rel="noopener" target="_blank">Código abierto (MIT)</a></p>
  </footer>
</body>
</html>
