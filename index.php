<?php
require_once __DIR__ . '/Tools/PDO.php';

// Default dataset in case database is offline
$default_songs = [
    ['IdSong' => 1, 'Name' => 'Duque Chao!', 'Category' => 'Nacional', 'Route' => 'duquechao', 'Lyrics' => 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto.'],
    ['IdSong' => 2, 'Name' => 'Soy Estudiante', 'Category' => 'Estudiantes', 'Route' => 'soyestudiante', 'Lyrics' => '¿Quién es usted?<br>Soy estudiante<br>No lo escuché<br>Soy estudiante!<br>Una vez más<br>Soy estudiante soy, soy estudiante soy, yo quiero estudiar<br>Para cambiar la sociedad vamo a la lucha!'],
    ['IdSong' => 3, 'Name' => 'A parar para avanzar', 'Category' => 'Nacional', 'Route' => 'apararparaavanzar', 'Lyrics' => 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto.'],
    ['IdSong' => 4, 'Name' => 'No queremos privatización', 'Category' => 'Nacional', 'Route' => 'noqueremosprivatizacion', 'Lyrics' => 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto.'],
    ['IdSong' => 5, 'Name' => 'Viva la U', 'Category' => 'Estudiantes', 'Route' => 'vivalau', 'Lyrics' => 'Viva la U, Viva!!!<br>Viva la U!! Viva!!<br>Viva la Universidad, no la dejes no, no la dejes no, no la dejes privatizar.<br>En caso de privadas puede terminar asi:<br>Viva la U, Viva!!!<br>Viva la U!! Viva!!<br>Viva la Universidad, no la dejes no, no la dejes no, no la dejes comercializar.'],
    ['IdSong' => 6, 'Name' => 'La Batuta', 'Category' => 'Estudiantes', 'Route' => 'labatuta', 'Lyrics' => 'A ver, A ver <br>quien lleva la batuta? <br>si los estudiantes,<br>o el gobierno hijueputa uta uta.'],
    ['IdSong' => 7, 'Name' => 'Taki Taki por la Educación', 'Category' => 'Estudiantes', 'Route' => 'takitaki', 'Lyrics' => 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto.'],
    ['IdSong' => 8, 'Name' => 'A las Mujeres y a la universidad', 'Category' => 'Feministas', 'Route' => 'alasmujeresyalauniversidad', 'Lyrics' => 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto.'],
    ['IdSong' => 9, 'Name' => 'Arroz con leche', 'Category' => 'Feministas', 'Route' => 'arrozconleche', 'Lyrics' => 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto.'],
    ['IdSong' => 10, 'Name' => 'En el bosque de la china', 'Category' => 'Feministas', 'Route' => 'bosquedelachina', 'Lyrics' => 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto.'],
    ['IdSong' => 11, 'Name' => 'Don Federico', 'Category' => 'Feministas', 'Route' => 'donfederico', 'Lyrics' => 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto.'],
    ['IdSong' => 12, 'Name' => 'Hoy peleamos', 'Category' => 'Feministas', 'Route' => 'hoypeleamos', 'Lyrics' => 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto.'],
    ['IdSong' => 13, 'Name' => 'Libres o muertas', 'Category' => 'Feministas', 'Route' => 'libresomuertas', 'Lyrics' => 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto.'],
    ['IdSong' => 14, 'Name' => 'Mujeres contra', 'Category' => 'Feministas', 'Route' => 'mujerescontra', 'Lyrics' => 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto.'],
    ['IdSong' => 15, 'Name' => 'No sea indiferente', 'Category' => 'Feministas', 'Route' => 'noseaindiferente', 'Lyrics' => 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto.'],
    ['IdSong' => 16, 'Name' => '¿Quién es usted?', 'Category' => 'Feministas', 'Route' => 'quienesusted', 'Lyrics' => 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto.'],
    ['IdSong' => 17, 'Name' => 'Si el papa fuera mujer', 'Category' => 'Feministas', 'Route' => 'sielpapafueramujer', 'Lyrics' => 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto.'],
    ['IdSong' => 18, 'Name' => 'Duque Ra Ra Ra', 'Category' => 'Nacional', 'Route' => 'duquerarara', 'Lyrics' => 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto.'],
    ['IdSong' => 19, 'Name' => 'El pueblo', 'Category' => 'Nacional', 'Route' => 'elpueblo', 'Lyrics' => 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto.'],
    ['IdSong' => 20, 'Name' => 'El que no estudia es policia nacional', 'Category' => 'Estudiantes', 'Route' => 'elquenoestudia', 'Lyrics' => 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto.'],
    ['IdSong' => 21, 'Name' => 'En los libros', 'Category' => 'Estudiantes', 'Route' => 'enloslibros', 'Lyrics' => 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto.'],
    ['IdSong' => 22, 'Name' => 'Es la voz del estudiante', 'Category' => 'Estudiantes', 'Route' => 'eslavozdelestudiante', 'Lyrics' => 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto.'],
    ['IdSong' => 23, 'Name' => 'Esos son', 'Category' => 'Nacional', 'Route' => 'esosson', 'Lyrics' => 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto.'],
    ['IdSong' => 24, 'Name' => 'Hay que ver las cosas que pasan', 'Category' => 'Nacional', 'Route' => 'hayquever', 'Lyrics' => 'Hay que ver las cosas que pasan,<br>hay que ver las vueltas que dan,<br>con un pueblo que camina pa\' adelante <br>y un gobierno que camina para atrás.'],
    ['IdSong' => 25, 'Name' => 'La educación es un derecho', 'Category' => 'Estudiantes', 'Route' => 'laeducacionesunderecho', 'Lyrics' => 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto.'],
    ['IdSong' => 26, 'Name' => 'La educación es mia', 'Category' => 'Estudiantes', 'Route' => 'laeducacionesmia', 'Lyrics' => 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto.'],
    ['IdSong' => 27, 'Name' => 'Los pollitos', 'Category' => 'Nacional', 'Route' => 'lospollitos', 'Lyrics' => 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto.'],
    ['IdSong' => 28, 'Name' => 'Ni un minuto de silencio', 'Category' => 'Nacional', 'Route' => 'niunminuto', 'Lyrics' => 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto.'],
    ['IdSong' => 29, 'Name' => 'No respetamos', 'Category' => 'Nacional', 'Route' => 'norespetamos', 'Lyrics' => 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto.'],
    ['IdSong' => 30, 'Name' => 'Pa la publica no hay na', 'Category' => 'Estudiantes', 'Route' => 'palapublicanohayna', 'Lyrics' => 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto.'],
    ['IdSong' => 31, 'Name' => 'Poropopo', 'Category' => 'Estudiantes', 'Route' => 'poropopo', 'Lyrics' => 'Porropopo - Porropopo el que no salte quiere Privatizacion.'],
    ['IdSong' => 32, 'Name' => '¿Por que nos matan?', 'Category' => 'Nacional', 'Route' => 'porquenosmatan', 'Lyrics' => 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto.'],
    ['IdSong' => 33, 'Name' => 'Presupuesto', 'Category' => 'Estudiantes', 'Route' => 'presupuesto', 'Lyrics' => 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto.'],
    ['IdSong' => 34, 'Name' => 'Que lo vengan a ver', 'Category' => 'Nacional', 'Route' => 'quelovenganaver', 'Lyrics' => 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto.'],
    ['IdSong' => 35, 'Name' => 'Queremos', 'Category' => 'Nacional', 'Route' => 'queremos', 'Lyrics' => 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto.'],
    ['IdSong' => 36, 'Name' => 'Represión', 'Category' => 'Nacional', 'Route' => 'represion', 'Lyrics' => 'Quienes somos? Estudiantes<br>Que exigimos? Soluciones<br>Que nos dan? Represión, represión y la privatización.'],
    ['IdSong' => 37, 'Name' => 'Señoras, Señores', 'Category' => 'Nacional', 'Route' => 'señorasseñores', 'Lyrics' => 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto.'],
    ['IdSong' => 38, 'Name' => 'Somos estudiantes', 'Category' => 'Estudiantes', 'Route' => 'somosestudiantes', 'Lyrics' => 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto.'],
    ['IdSong' => 39, 'Name' => 'Todas las mañanas', 'Category' => 'Nacional', 'Route' => 'todaslasmañanas', 'Lyrics' => 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto.'],
    ['IdSong' => 40, 'Name' => 'Vamos compañeros', 'Category' => 'Estudiantes', 'Route' => 'vamoscompañeros', 'Lyrics' => 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto.'],
    ['IdSong' => 41, 'Name' => 'Van a volver', 'Category' => 'Nacional', 'Route' => 'vanavolver', 'Lyrics' => 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto.'],
    ['IdSong' => 42, 'Name' => 'A la nanita nana', 'Category' => 'Nacional', 'Route' => 'alananitanana', 'Lyrics' => 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto.'],
];

$songs = $default_songs;
if (isset($db) && $db instanceof PDO) {
    try {
        $stmt = $db->query("SELECT * FROM Songs ORDER BY IdSong ASC");
        $fetched = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($fetched)) {
            $songs = $fetched;
        }
    } catch (Exception $e) {
        // Fallback to default array
    }
}

// Initial random song
$initial_index = array_rand($songs);
$initial_song = $songs[$initial_index];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ArengApp | Voces de Resistencia y Memoria Histórica</title>
  <meta name="description" content="Archivo sonoro interactivo de arengas y cantos populares de movilizaciones sociales y estudiantiles en Colombia.">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="./style.css">
  <style>
    /* Custom enhancements for ArengApp */
    .filter-bar {
      display: flex;
      gap: 8px;
      padding: 10px 20px;
      background: #f9f7f2;
      border-bottom: 1px solid rgba(0,0,0,0.06);
    }
    .filter-btn {
      border: 1px solid rgba(37,33,32,0.2);
      background: #fff;
      color: #252120;
      padding: 4px 12px;
      border-radius: 20px;
      font-size: 12px;
      cursor: pointer;
      font-family: 'Oswald', sans-serif;
      transition: all 0.2s;
    }
    .filter-btn.active, .filter-btn:hover {
      background: #18DFAD;
      border-color: #18DFAD;
      color: #252120;
    }
    .search-box {
      width: 100%;
      padding: 8px 16px;
      border: none;
      border-bottom: 1px solid rgba(0,0,0,0.1);
      font-family: 'Oswald', sans-serif;
      font-size: 14px;
      outline: none;
      box-sizing: border-box;
    }
    .list_item {
      display: flex;
      align-items: center;
      padding: 10px 20px;
      cursor: pointer;
      border-bottom: 1px solid rgba(0,0,0,0.04);
      transition: background 0.2s;
    }
    .list_item:hover {
      background: rgba(24, 223, 173, 0.12);
    }
    .list_item.playing {
      background: rgba(24, 223, 173, 0.25);
      border-left: 4px solid #18DFAD;
    }
    .list_item .thumb {
      width: 44px;
      height: 44px;
      border-radius: 4px;
      background-size: cover;
      background-position: center;
      margin-right: 14px;
      flex-shrink: 0;
    }
    .list_item .info {
      flex-grow: 1;
      overflow: hidden;
    }
    .list_item .title {
      font-size: 15px;
      color: #252120;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    .list_item .category-tag {
      display: inline-block;
      font-size: 11px;
      text-transform: uppercase;
      color: #777;
      margin-top: 2px;
    }
    .lyrics-modal {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 90%;
      max-width: 500px;
      background: #ffffff;
      padding: 24px;
      border-radius: 8px;
      box-shadow: 0 10px 40px rgba(0,0,0,0.3);
      z-index: 1000;
      max-height: 80vh;
      overflow-y: auto;
    }
    .lyrics-modal h3 {
      margin-top: 0;
      color: #252120;
      border-bottom: 2px solid #18DFAD;
      padding-bottom: 8px;
    }
    .lyrics-modal .lyrics-body {
      font-family: sans-serif;
      font-size: 14px;
      line-height: 1.6;
      color: #333;
      white-space: pre-wrap;
    }
    .lyrics-close {
      position: absolute;
      top: 16px;
      right: 16px;
      font-size: 20px;
      cursor: pointer;
      color: #999;
    }
    .lyrics-btn {
      border: none;
      background: transparent;
      color: #888;
      cursor: pointer;
      font-size: 14px;
      padding: 6px;
      margin-left: 8px;
    }
    .lyrics-btn:hover {
      color: #F12645;
    }
    .nav_sub a i {
      font-size: 20px;
      margin: 0 6px;
    }
  </style>
</head>
<body>

<audio id="reproductor" src="" preload="auto"></audio>

<!-- Modal Letra -->
<div class="dim" id="lyrics-dim" style="z-index: 9999;" onclick="closeLyrics()"></div>
<div class="lyrics-modal" id="lyrics-modal" style="z-index: 10000;">
  <span class="lyrics-close" onclick="closeLyrics()">&times;</span>
  <h3 id="lyrics-title">Letra de la Arenga</h3>
  <div class="lyrics-body" id="lyrics-content"></div>
</div>

<div class="wrapper">
  <!-- Wave background -->
  <div class="wave-container">
    <div class="wave -one"></div>
    <div class="wave -two"></div>
    <div class="wave -three"></div>
  </div>

  <div class="line"></div>

  <!-- Landing Center Text -->
  <div class="text-wrap">
    <div class="text">
      <span>ARENGAPP</span>
      <div class="main-btn_wrapper">
        <div class="main-btn"><i class="fa fa-play"></i></div>
      </div>
      <p style="text-align: center; color: #fff9e1; font-size: 1.15rem; margin-top: 14px; font-weight: 300; letter-spacing: 1px;">
        VOCES DE RESISTENCIA &bull; ARCHIVO SONORO POPULAR
      </p>
    </div>
  </div>

  <!-- Top Header Navigation -->
  <div class="header">
    <div class="burger-wrapper" title="Menú">
      <div class="burger"></div>
    </div>
    <div class="logo-text">ArengApp</div>
    <div class="back_btn">
      <div class="circle"></div>
      <div class="text">Inicio</div>
    </div>
  </div>

  <!-- Side Navigation Drawer -->
  <div class="nav">
    <ul class="nav_main">
      <li style="font-size: 1.8vw; line-height: 1.4; color: #33476a; font-weight: 400;">
        "El derecho a la protesta social es un pilar fundamental de la democracia. Este archivo preserva la memoria viva de las manifestaciones colectivas en Colombia."
      </li>
    </ul>
    <div class="nav_divider"></div>
    <ul class="nav_sub">
      <li><a class="nav_link" href="privacidad.php">Políticas de Privacidad</a></li>
      <li><a class="nav_link" target="_blank" rel="noopener noreferrer" href="https://github.com/KevinAndrey96/arengapp">Código en GitHub</a></li>
      <li><a class="nav_link" target="_blank" rel="noopener noreferrer" href="https://www.linkedin.com/in/kevinandrey96/">Desarrollado por Kevin Andrey</a></li>
    </ul>
  </div>

  <!-- Mini Player (Top Right) -->
  <div class="mini-player">
    <div class="track_info_wrapper">
      <div class="track_info" title="Abrir lista de reproducción">
        <div class="thumb" id="mini-thumb" style="background-image: url('Covers/<?= htmlspecialchars($initial_song['Category']) ?>.png');"></div>
        <div class="info">
          <div class="title" id="mini-title"><?= htmlspecialchars($initial_song['Name']) ?></div>
          <div class="artist" id="mini-category"><?= htmlspecialchars($initial_song['Category']) ?></div>
        </div>
      </div>
    </div>
    <div class="mini-player_btn_wrapper">
      <i class="btn-prev fa fa-step-backward" onclick="prevSong()" title="Anterior"></i>
      <div class="btn-switch">
        <div onclick="togglePlay()"><i class="btn-play fa fa-play" id="mini-play-icon"></i></div>
        <div onclick="togglePlay()"><i class="btn-pause fa fa-pause" id="mini-pause-icon"></i></div>
      </div>
      <i class="btn-next fa fa-step-forward" onclick="nextSong()" title="Siguiente"></i>
      <i class="btn-open-player fa fa-list" title="Ver catálogo"></i>
    </div>
  </div>

  <div class="dim"></div>

  <!-- Slide-out Playlist / Full Player Drawer -->
  <div class="player" id="player">
    <div class="playback_wrapper">
      <div class="playback_blur" id="player-blur" style="background-image: url('Covers/<?= htmlspecialchars($initial_song['Category']) ?>.png');"></div>
      <div class="playback_thumb" id="player-thumb" style="background-image: url('Covers/<?= htmlspecialchars($initial_song['Category']) ?>.png');"></div>
      <div class="playback_info">
        <div class="title" id="player-title"><?= htmlspecialchars($initial_song['Name']) ?></div>
        <div class="artist" id="player-category"><?= htmlspecialchars($initial_song['Category']) ?></div>
        <div style="margin-top: 8px;">
          <button class="filter-btn" onclick="showCurrentLyrics()" style="font-size: 11px; padding: 2px 10px;">
            <i class="fa fa-file-text-o"></i> Ver Letra
          </button>
        </div>
      </div>
      
      <div class="playback_btn_wrapper">
        <i class="btn-prev fa fa-step-backward" onclick="prevSong()" title="Anterior"></i>
        <div class="btn-switch">
          <div onclick="togglePlay()"><i class="btn-play fa fa-play" id="drawer-play-icon"></i></div>
          <div onclick="togglePlay()"><i class="btn-pause fa fa-pause" id="drawer-pause-icon"></i></div>
        </div>
        <i class="btn-next fa fa-step-forward" onclick="nextSong()" title="Siguiente"></i>
      </div>

      <div class="playback_timeline">
        <div class="playback_timeline_start-time" id="time-current">00:00</div>
        <div class="playback_timeline_slider" id="progress-container" onclick="seekAudio(event)" style="cursor: pointer;">
          <div class="slider_base"></div>
          <div class="slider_progress" id="progress-bar"></div>
          <div class="slider_handle" id="progress-handle"></div>
        </div>
        <div class="playback_timeline_end-time" id="time-total">--:--</div>
      </div>
    </div>

    <!-- Search & Filter Controls -->
    <input type="text" id="search-input" class="search-box" placeholder="Buscar por título o categoría..." oninput="filterSongs()">
    <div class="filter-bar">
      <button class="filter-btn active" data-category="Todas" onclick="selectCategory('Todas', this)">Todas (<?= count($songs) ?>)</button>
      <button class="filter-btn" data-category="Nacional" onclick="selectCategory('Nacional', this)">Nacional</button>
      <button class="filter-btn" data-category="Estudiantes" onclick="selectCategory('Estudiantes', this)">Estudiantes</button>
      <button class="filter-btn" data-category="Feministas" onclick="selectCategory('Feministas', this)">Feministas</button>
    </div>

    <!-- Song List -->
    <div class="list_wrapper" style="height: calc(100% - 410px); overflow-y: auto;">
      <ul class="list" id="songs-list">
        <?php foreach ($songs as $idx => $s): ?>
          <li class="list_item" data-index="<?= $idx ?>" data-category="<?= htmlspecialchars($s['Category']) ?>" data-name="<?= strtolower(htmlspecialchars($s['Name'])) ?>" onclick="playIndex(<?= $idx ?>)">
            <div class="thumb" style="background-image: url('Covers/<?= htmlspecialchars($s['Category']) ?>.png');"></div>
            <div class="info">
              <div class="title"><?= htmlspecialchars($s['Name']) ?></div>
              <span class="category-tag"><?= htmlspecialchars($s['Category']) ?></span>
            </div>
            <button class="lyrics-btn" onclick="event.stopPropagation(); showLyrics(<?= $idx ?>)" title="Ver letra">
              <i class="fa fa-file-text-o"></i>
            </button>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>

  <!-- Curator Page View (Accessible from center text click) -->
  <div class="page" id="curator">
    <div class="curator_title_wrapper"><span>♪♫</span>
      <div class="curator_line"></div>
      <div class="curator_title">Archivo Sonoro de Arengas</div>
      <div class="curator_line"></div><span>♫♪</span>
    </div>
    <div class="curator_list" style="display: block; text-align: center; margin-top: 30px;">
      <p style="color: #444; font-size: 1.2rem; max-width: 600px; margin: 0 auto 20px;">
        Selecciona una categoría o abre el reproductor lateral para navegar por las 42 arengas documentadas.
      </p>
      <div style="display: flex; justify-content: center; gap: 15px; flex-wrap: wrap;">
        <button class="filter-btn" onclick="openPlayerWithCategory('Nacional')" style="font-size: 16px; padding: 10px 24px;">
          Marcha Nacional
        </button>
        <button class="filter-btn" onclick="openPlayerWithCategory('Estudiantes')" style="font-size: 16px; padding: 10px 24px;">
          Movimiento Estudiantil
        </button>
        <button class="filter-btn" onclick="openPlayerWithCategory('Feministas')" style="font-size: 16px; padding: 10px 24px;">
          Movimiento Feminista
        </button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/TweenMax.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/TimelineMax.min.js"></script>
<script src="./script.js"></script>

<script>
// Songs database passed to client
const songsData = <?= json_encode($songs) ?>;
let currentIndex = <?= $initial_index ?>;
let isPlaying = false;
const audio = document.getElementById('reproductor');

function formatTime(seconds) {
  if (isNaN(seconds)) return '00:00';
  const mins = Math.floor(seconds / 60);
  const secs = Math.floor(seconds % 60);
  return (mins < 10 ? '0' : '') + mins + ':' + (secs < 10 ? '0' : '') + secs;
}

function updateUI() {
  const song = songsData[currentIndex];
  if (!song) return;

  // Update text & images
  $('#mini-title, #player-title').text(song.Name);
  $('#mini-category, #player-category').text(song.Category);
  const coverUrl = 'Covers/' + song.Category + '.png';
  $('#mini-thumb, #player-thumb, #player-blur').css('background-image', "url('" + coverUrl + "')");

  // Highlight active row in list
  $('.list_item').removeClass('playing');
  $('.list_item[data-index="' + currentIndex + '"]').addClass('playing');

  // Update play/pause buttons
  if (isPlaying) {
    $('.btn-play').hide();
    $('.btn-pause').show();
  } else {
    $('.btn-play').show();
    $('.btn-pause').hide();
  }
}

function playIndex(index) {
  if (index < 0 || index >= songsData.length) return;
  currentIndex = index;
  const song = songsData[currentIndex];
  audio.src = 'Songs/' + song.Route + '.mp3';
  audio.play().then(() => {
    isPlaying = true;
    updateUI();
  }).catch(err => {
    console.warn('Autoplay restricted or file error:', err);
    isPlaying = false;
    updateUI();
  });
}

function togglePlay() {
  if (!audio.src || audio.src === window.location.href) {
    playIndex(currentIndex);
    return;
  }
  if (audio.paused) {
    audio.play();
    isPlaying = true;
  } else {
    audio.pause();
    isPlaying = false;
  }
  updateUI();
}

function nextSong() {
  let next = currentIndex + 1;
  if (next >= songsData.length) next = 0;
  playIndex(next);
}

function prevSong() {
  let prev = currentIndex - 1;
  if (prev < 0) prev = songsData.length - 1;
  playIndex(prev);
}

// Audio time updates
audio.addEventListener('timeupdate', () => {
  if (!audio.duration) return;
  const pct = (audio.currentTime / audio.duration) * 100;
  $('#progress-bar').css('width', pct + '%');
  $('#progress-handle').css('left', pct + '%');
  $('#time-current').text(formatTime(audio.currentTime));
  $('#time-total').text(formatTime(audio.duration));
});

audio.addEventListener('ended', () => {
  nextSong();
});

function seekAudio(e) {
  const container = document.getElementById('progress-container');
  const rect = container.getBoundingClientRect();
  const clickX = e.clientX - rect.left;
  const pct = Math.max(0, Math.min(1, clickX / rect.width));
  if (audio.duration) {
    audio.currentTime = pct * audio.duration;
  }
}

// Category & Search Filters
let activeCategory = 'Todas';
function selectCategory(cat, btn) {
  activeCategory = cat;
  $('.filter-btn').removeClass('active');
  $(btn).addClass('active');
  filterSongs();
}

function filterSongs() {
  const query = $('#search-input').val().toLowerCase().trim();
  $('.list_item').each(function() {
    const itemCat = $(this).data('category');
    const itemName = $(this).data('name');
    const matchesCat = (activeCategory === 'Todas' || itemCat === activeCategory);
    const matchesSearch = (!query || itemName.includes(query) || itemCat.toLowerCase().includes(query));
    if (matchesCat && matchesSearch) {
      $(this).show();
    } else {
      $(this).hide();
    }
  });
}

function openPlayerWithCategory(cat) {
  // Trigger drawer open
  $('.btn-open-player').trigger('click');
  const btn = $('.filter-btn[data-category="' + cat + '"]')[0];
  if (btn) selectCategory(cat, btn);
}

// Lyrics modal
function showLyrics(index) {
  const song = songsData[index];
  if (!song) return;
  $('#lyrics-title').text(song.Name + ' (' + song.Category + ')');
  $('#lyrics-content').html(song.Lyrics || 'Letra no disponible.');
  $('#lyrics-dim, #lyrics-modal').fadeIn(200);
}

function showCurrentLyrics() {
  showLyrics(currentIndex);
}

function closeLyrics() {
  $('#lyrics-dim, #lyrics-modal').fadeOut(200);
}

$(document).ready(() => {
  updateUI();
});
</script>

</body>
</html>
