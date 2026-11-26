# ArengApp: archivo sonoro de las arengas del paro nacional en Colombia

[![CI](https://github.com/KevinAndrey96/php-arengapp-protest-audio-archive/actions/workflows/ci.yml/badge.svg)](https://github.com/KevinAndrey96/php-arengapp-protest-audio-archive/actions/workflows/ci.yml)
![PHP](https://img.shields.io/badge/PHP-8.3%20%7C%208.4%20%7C%208.5-777BB4?logo=php&logoColor=white)
![PHPStan](https://img.shields.io/badge/PHPStan-nivel%20max-2a6fd6)
![Docker](https://img.shields.io/badge/Docker-Apache%20sin%20root-2496ED?logo=docker&logoColor=white)
[![Licencia MIT](https://img.shields.io/badge/licencia-MIT-green)](LICENSE)

Archivo y reproductor web de **42 arengas** grabadas en las calles durante el paro nacional y las movilizaciones sociales de Colombia entre 2019 y 2021: cantos del paro nacional, del movimiento estudiantil y del movimiento feminista, con su letra cuando se conoce.

ArengApp nació durante el paro nacional de 2019 para que cualquiera pudiera escuchar y aprender las arengas desde el celular. Se difundió por WhatsApp y redes sociales y llegó a tener más de 10.000 personas conectadas al mismo tiempo. Hoy se conserva como archivo de memoria histórica.

## Contenido

- [Qué ofrece](#qué-ofrece)
- [Arquitectura](#arquitectura)
- [Ejecutar en local](#ejecutar-en-local)
- [Pruebas y calidad](#pruebas-y-calidad)
- [Despliegue](#despliegue)
- [Contribuir con letras](#contribuir-con-letras)
- [Modernización 2026](#modernización-2026)
- [Licencia](#licencia)

## Qué ofrece

- **Una página por arenga** (`/arengas/duque-chao`, `/arengas/viva-la-u`...) con su audio, letra, URL canónica, etiquetas Open Graph y datos estructurados `MusicRecording` de schema.org, para que cada canto aparezca por sí mismo en buscadores y al compartirlo.
- **Reproductor continuo:** al terminar una arenga suena la siguiente de la lista filtrada; anterior y siguiente también funcionan desde la pantalla de bloqueo del celular (Media Session API).
- **Filtros por movimiento y búsqueda** que ignora tildes ("educacion" encuentra "La educación es mía").
- **Funciona sin JavaScript:** cada arenga es un enlace a su página con un reproductor nativo; el script solo mejora la experiencia (cambio de pista sin recargar y URL sincronizada).
- **Privacidad real:** sin cookies, analítica, publicidad ni recursos de terceros. Todo se sirve desde el mismo origen, con una política CSP estricta (`default-src 'self'`).
- **Audio listo para celulares:** Apache atiende solicitudes por rangos (`206 Partial Content`) para adelantar el audio, con caché de 7 días y archivos CSS/JS versionados por hash.
- **Mapa del sitio y robots** generados con la URL pública configurada, y redirecciones 301 desde las direcciones antiguas (`/index.php`, `/privacidad.php`).

## Arquitectura

PHP 8.3+ sin framework, organizado por capas con dependencias hacia adentro:

| Capa | Ubicación | Responsabilidad |
| :--- | :--- | :--- |
| Dominio | `src/Domain` | `Arenga` (valida slug, título, duración y letra), `Category` y la interfaz `ArengaCatalog`. |
| Infraestructura | `src/Infrastructure` | `JsonArengaCatalog`: lee y valida `data/arengas.json`, con errores claros si el archivo está mal formado. |
| HTTP | `src/Http` | `App` enruta, aplica cabeceras de seguridad y convierte cualquier falla en una página de error 500 sin filtrar detalles. |
| Vista | `src/View`, `templates/` | Plantillas PHP que escapan todo el contenido, JSON seguro para incrustar y metadatos SEO por página. |

```text
.
├── data/arengas.json         catálogo: fuente única de títulos, categorías, duraciones y letras
├── public/
│   ├── index.php             controlador frontal
│   ├── audio/                42 grabaciones MP3
│   └── assets/               CSS, JavaScript sin dependencias, portadas e ícono
├── src/                      dominio, infraestructura, HTTP y vista
├── templates/                páginas y layout
├── tests/                    unitarias, HTTP e integridad del archivo
├── docker/apache.conf        Apache en el puerto 8080, sin listado de directorios
└── Dockerfile                imagen de producción sin root con OPcache
```

| Ruta | Contenido |
| :--- | :--- |
| `/` | Catálogo completo con reproductor |
| `/arengas/{slug}` | Página de una arenga con audio y letra |
| `/privacidad` | Política de privacidad |
| `/sitemap.xml`, `/robots.txt` | Indexación para buscadores |

## Ejecutar en local

Con Docker:

```bash
docker compose up --build
```

El sitio queda en http://localhost:8080. La variable `APP_URL` define la URL pública que usan las etiquetas canónicas, Open Graph y el mapa del sitio.

Sin Docker (PHP 8.3 o superior y Composer):

```bash
composer install
APP_URL=http://localhost:8000 php -S localhost:8000 -t public public/index.php
```

## Pruebas y calidad

```bash
composer check   # PHP-CS-Fixer (PER-CS), PHPStan nivel max con reglas estrictas y PHPUnit
```

- **Unitarias:** reglas de `Arenga` (slugs, duraciones ISO 8601, resúmenes) y validación del catálogo JSON ante archivos dañados, duplicados o categorías desconocidas.
- **HTTP:** cada ruta, códigos 301, 404 y 405, cabeceras de seguridad, escape de contenido malicioso, mapa del sitio y página de error.
- **Integridad del archivo:** las 42 arengas tienen su grabación, no hay grabaciones huérfanas, cada categoría tiene portada y los títulos no se repiten.
- **CI:** PHP 8.3, 8.4 y 8.5, y una prueba de humo sobre la imagen Docker (rutas, sitemap, CSP, solicitudes por rangos y usuario sin privilegios).

## Despliegue

La imagen Docker es autosuficiente: `docker build -t arengapp .` y `docker run -p 8080:8080 -e APP_URL=https://tu-dominio arengapp`. En un hosting PHP tradicional basta con apuntar la raíz del sitio a `public/` y enviar a `index.php` toda ruta que no sea un archivo, como hace `docker/apache.conf`.

## Contribuir con letras

Muchas arengas todavía no tienen letra. Si conoces alguna, usa el botón **"¿La conoces? Envíala"** de su página o abre un reporte con la plantilla [Enviar la letra de una arenga](https://github.com/KevinAndrey96/php-arengapp-protest-audio-archive/issues/new?template=letra.yml). Las letras se agregan en `data/arengas.json`, una línea por verso.

## Modernización 2026

La versión original (2019) era una sola página PHP con jQuery y GSAP desde CDN, el catálogo duplicado entre el código y una base de datos MySQL, Google Analytics y AdSense. En 2026 se reescribió:

- El catálogo vive en un solo archivo JSON validado, sin base de datos ni phpMyAdmin expuesto.
- Cada arenga tiene su propia página indexable, en lugar de una única página sin contenido para buscadores.
- Se retiraron la analítica, la publicidad y todas las dependencias externas del navegador.
- Se corrigieron tildes y signos en títulos y letras, y los archivos de audio pasaron a nombres legibles sin caracteres especiales.
- Cuatro grabaciones tenían minutos de silencio al final (`la-batuta` duraba 5:18 para 10 segundos de audio); se recortaron sin recodificar, y ahora el reproductor continuo pasa de una arenga a otra sin esperas.
- Pruebas, análisis estático, imagen Docker sin root y CI.

## Licencia

El código se publica bajo la [licencia MIT](LICENSE). Las grabaciones y portadas se comparten como archivo de memoria histórica de las movilizaciones; las arengas son cantos populares de autoría colectiva.

Desarrollado por **Kevin Andrey Herrera Silva** ([@KevinAndrey96](https://github.com/KevinAndrey96), [LinkedIn](https://www.linkedin.com/in/kevinandrey96/)).
