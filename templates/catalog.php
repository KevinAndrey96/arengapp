<?php
/**
 * @var Arengapp\View\View $this
 * @var list<Arengapp\Domain\Arenga> $arengas
 * @var Arengapp\Domain\Arenga|null $current
 * @var bool $isHome
 * @var array<string, int> $counts
 * @var string $repositoryUrl
 */
use Arengapp\Domain\Arenga;
use Arengapp\Domain\Category;

$contributeUrl = static fn (Arenga $a): string => $repositoryUrl . '/issues/new?template=letra.yml&title=' . rawurlencode('Letra: ' . $a->title);
$clientCatalog = array_map(static fn (Arenga $a): array => [
    'slug' => $a->slug,
    'title' => $a->title,
    'category' => $a->category->label(),
    'cover' => $a->category->coverPath(),
    'audio' => $a->audioPath(),
    'url' => $a->url(),
    'lyrics' => $a->lyrics,
    'contributeUrl' => $contributeUrl($a),
], $arengas);
?>
<section class="hero">
  <div class="hero-text">
    <p class="eyebrow">Archivo sonoro popular · Colombia 2019-2021</p>
    <?php if ($isHome || $current === null): ?>
    <h1>Las arengas del paro nacional, en un solo lugar</h1>
    <p class="lead"><?= \count($arengas) ?> cantos del paro nacional, el movimiento estudiantil y el movimiento feminista, grabados en las calles y preservados como memoria histórica.</p>
    <?php else: ?>
    <h1><?= $this->e($current->title) ?></h1>
    <p class="lead">Arenga del <?= $this->e(mb_strtolower($current->category->label())) ?> · <?= $this->e($current->clockDuration()) ?></p>
    <?php endif ?>
  </div>
  <div class="waves" aria-hidden="true"><span></span><span></span><span></span></div>
</section>

<div class="layout">
  <section class="catalog" aria-labelledby="catalogo">
    <h2 id="catalogo" class="sr-only">Catálogo de arengas</h2>
    <div class="toolbar">
      <label class="search">
        <span class="sr-only">Buscar arenga</span>
        <input type="search" id="search" placeholder="Buscar arenga…" autocomplete="off">
      </label>
      <div class="chips" role="group" aria-label="Filtrar por movimiento">
        <button type="button" class="chip" data-filter="" aria-pressed="true">Todas <span><?= \count($arengas) ?></span></button>
        <?php foreach (Category::cases() as $category): ?>
        <button type="button" class="chip" data-filter="<?= $this->e($category->label()) ?>" aria-pressed="false"><?= $this->e($category->label()) ?> <span><?= $counts[$category->value] ?? 0 ?></span></button>
        <?php endforeach ?>
      </div>
    </div>

    <ol class="tracks" id="tracks">
      <?php foreach ($arengas as $arenga): ?>
      <li class="track<?= $current !== null && $arenga->slug === $current->slug ? ' is-current' : '' ?>" data-slug="<?= $this->e($arenga->slug) ?>" data-category="<?= $this->e($arenga->category->label()) ?>">
        <a class="track-link" href="<?= $this->e($arenga->url()) ?>">
          <img src="<?= $this->e($arenga->category->coverPath()) ?>" alt="" width="48" height="48" loading="lazy">
          <span class="track-text">
            <span class="track-title"><?= $this->e($arenga->title) ?></span>
            <span class="track-meta"><?= $this->e($arenga->category->label()) ?> · <?= $this->e($arenga->clockDuration()) ?><?= $arenga->hasLyrics() ? ' · con letra' : '' ?></span>
          </span>
        </a>
      </li>
      <?php endforeach ?>
    </ol>
    <p class="empty" id="empty" hidden>No encontramos arengas con esa búsqueda.</p>
  </section>

  <?php if ($current !== null): ?>
  <aside class="now" id="now" aria-label="Reproduciendo">
    <div class="now-head">
      <img id="now-cover" src="<?= $this->e($current->category->coverPath()) ?>" alt="" width="72" height="72">
      <div>
        <p class="now-category" id="now-category"><?= $this->e($current->category->label()) ?></p>
        <p class="now-title" id="now-title"><?= $this->e($current->title) ?></p>
      </div>
    </div>
    <audio id="audio" controls preload="metadata" src="<?= $this->e($current->audioPath()) ?>"></audio>
    <div class="transport">
      <button type="button" id="prev" class="icon-button" aria-label="Arenga anterior"><svg aria-hidden="true"><use href="#i-prev"/></svg></button>
      <button type="button" id="play" class="icon-button is-primary" aria-label="Reproducir"><svg aria-hidden="true"><use href="#i-play"/></svg></button>
      <button type="button" id="next" class="icon-button" aria-label="Arenga siguiente"><svg aria-hidden="true"><use href="#i-next"/></svg></button>
    </div>
    <details class="lyrics" id="lyrics" <?= $isHome ? '' : 'open' ?>>
      <summary>Letra</summary>
      <div id="lyrics-body">
        <?php if ($current->lyrics !== null): ?>
          <?php foreach ($current->lyrics as $line): ?>
          <p><?= $this->e($line) ?></p>
          <?php endforeach ?>
        <?php else: ?>
          <p class="muted">Aún no tenemos la letra de esta arenga. <a href="<?= $this->e($contributeUrl($current)) ?>" rel="noopener" target="_blank">¿La conoces? Envíala</a>.</p>
        <?php endif ?>
      </div>
    </details>
  </aside>
  <?php endif ?>
</div>

<script type="application/json" id="catalog-data"><?= $this->json($clientCatalog) ?></script>
