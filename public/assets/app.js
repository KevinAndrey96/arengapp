// Progressive enhancement: without this script every arenga is still a page with a native player.

const dataElement = document.getElementById('catalog-data');
const audio = document.getElementById('audio');

if (dataElement && audio) {
  const catalog = JSON.parse(dataElement.textContent);
  const bySlug = new Map(catalog.map((arenga) => [arenga.slug, arenga]));
  const tracks = [...document.querySelectorAll('.track')];
  const search = document.getElementById('search');
  const chips = [...document.querySelectorAll('.chip')];
  const empty = document.getElementById('empty');
  const playButton = document.getElementById('play');
  const lyrics = document.getElementById('lyrics');
  const lyricsBody = document.getElementById('lyrics-body');
  const initialTitle = document.title;

  let current = bySlug.get(document.querySelector('.track.is-current')?.dataset.slug) ?? catalog[0];
  let activeFilter = '';

  const normalize = (text) => text.normalize('NFD').replace(/\p{Diacritic}/gu, '').toLowerCase();

  const visibleSlugs = () => tracks.filter((track) => !track.hidden).map((track) => track.dataset.slug);

  function renderLyrics(arenga) {
    lyricsBody.replaceChildren();
    if (arenga.lyrics) {
      for (const line of arenga.lyrics) {
        const paragraph = document.createElement('p');
        paragraph.textContent = line;
        lyricsBody.append(paragraph);
      }
      return;
    }
    const paragraph = document.createElement('p');
    paragraph.className = 'muted';
    const link = document.createElement('a');
    link.href = arenga.contributeUrl;
    link.rel = 'noopener';
    link.target = '_blank';
    link.textContent = '¿La conoces? Envíala';
    paragraph.append('Aún no tenemos la letra de esta arenga. ', link, '.');
    lyricsBody.append(paragraph);
  }

  function renderNow(arenga) {
    document.getElementById('now-title').textContent = arenga.title;
    document.getElementById('now-category').textContent = arenga.category;
    document.getElementById('now-cover').src = arenga.cover;
    renderLyrics(arenga);
    for (const track of tracks) {
      track.classList.toggle('is-current', track.dataset.slug === arenga.slug);
    }
    if ('mediaSession' in navigator) {
      navigator.mediaSession.metadata = new MediaMetadata({
        title: arenga.title,
        artist: arenga.category,
        album: 'ArengApp',
        artwork: [{ src: arenga.cover, sizes: '512x512', type: 'image/png' }],
      });
    }
  }

  function select(slug, { play = true, push = true } = {}) {
    const arenga = bySlug.get(slug);
    if (!arenga) {
      return;
    }
    current = arenga;
    renderNow(arenga);
    audio.src = arenga.audio;
    if (play) {
      audio.play().catch(() => {});
    }
    if (push && location.pathname !== arenga.url) {
      history.pushState({ slug }, '', arenga.url);
    }
    document.title = `${arenga.title} | ArengApp`;
  }

  function step(offset) {
    const slugs = visibleSlugs();
    if (slugs.length === 0) {
      return;
    }
    const index = slugs.indexOf(current.slug);
    const nextIndex = index === -1 ? 0 : (index + offset + slugs.length) % slugs.length;
    select(slugs[nextIndex]);
  }

  function applyFilters() {
    const query = normalize(search.value.trim());
    let shown = 0;
    for (const track of tracks) {
      const arenga = bySlug.get(track.dataset.slug);
      const matchesFilter = activeFilter === '' || track.dataset.category === activeFilter;
      const matchesQuery = query === '' || normalize(`${arenga.title} ${arenga.category}`).includes(query);
      track.hidden = !(matchesFilter && matchesQuery);
      shown += track.hidden ? 0 : 1;
    }
    empty.hidden = shown > 0;
  }

  function syncPlayButton() {
    const playing = !audio.paused && !audio.ended;
    playButton.setAttribute('aria-label', playing ? 'Pausar' : 'Reproducir');
    playButton.querySelector('use').setAttribute('href', playing ? '#i-pause' : '#i-play');
  }

  document.getElementById('tracks').addEventListener('click', (event) => {
    const link = event.target.closest('.track-link');
    if (!link || event.metaKey || event.ctrlKey || event.shiftKey || event.button !== 0) {
      return;
    }
    event.preventDefault();
    select(link.closest('.track').dataset.slug);
    if (window.matchMedia('(min-width: 900px)').matches) {
      lyrics.open = true;
    }
  });

  chips.forEach((chip) => {
    chip.addEventListener('click', () => {
      activeFilter = chip.dataset.filter;
      chips.forEach((other) => other.setAttribute('aria-pressed', String(other === chip)));
      applyFilters();
    });
  });

  search.addEventListener('input', applyFilters);
  playButton.addEventListener('click', () => (audio.paused ? audio.play().catch(() => {}) : audio.pause()));
  document.getElementById('prev').addEventListener('click', () => step(-1));
  document.getElementById('next').addEventListener('click', () => step(1));
  audio.addEventListener('ended', () => step(1));
  ['play', 'pause', 'ended'].forEach((name) => audio.addEventListener(name, syncPlayButton));

  if ('mediaSession' in navigator) {
    navigator.mediaSession.setActionHandler('previoustrack', () => step(-1));
    navigator.mediaSession.setActionHandler('nexttrack', () => step(1));
  }

  window.addEventListener('popstate', (event) => {
    const slug = event.state?.slug ?? location.pathname.split('/').pop();
    if (bySlug.has(slug)) {
      select(slug, { play: false, push: false });
    } else {
      document.title = initialTitle;
    }
  });

  if (!window.matchMedia('(min-width: 900px)').matches) {
    lyrics.open = false;
  }
  history.replaceState({ slug: current.slug }, '');
  renderNow(current);
  syncPlayButton();
}
