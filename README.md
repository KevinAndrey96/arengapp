# ArengApp: Voces de Resistencia y Archivo Sonoro Popular

<div align="center">

![PHP](https://img.shields.io/badge/PHP-8.1-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MariaDB](https://img.shields.io/badge/MariaDB-10.11-003545?style=for-the-badge&logo=mariadb&logoColor=white)
![Docker](https://img.shields.io/badge/Docker-Compose-2496ED?style=for-the-badge&logo=docker&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-ES6+-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
![Pico Historico](https://img.shields.io/badge/Pico_Historico-10.000%2B_Usuarios-brightgreen?style=for-the-badge&logo=google-analytics&logoColor=white)
![Estado](https://img.shields.io/badge/Estado-Archivo_Historico_Open_Source-blue?style=for-the-badge)
![Contexto](https://img.shields.io/badge/Contexto-Estallido_Social_Colombia-FCD116?style=for-the-badge&labelColor=003893&color=CE1126)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)

<p align="center">
  <strong>Archivo sonoro cultural y reproductor web desarrollado durante las movilizaciones ciudadanas en Colombia. Alcanzo un pico historico de mas de 10.000 usuarios simultaneos en produccion y hoy se preserva como caso de estudio de alta concurrencia y memoria historica de 42 arengas populares.</strong>
</p>

</div>

---

## 📌 Descripcion del Proyecto & Contexto Historico

**ArengApp** nacio en el contexto del **Estallido Social y Paro Nacional en Colombia (2019-2021)** como una iniciativa digital ciudadana para unificar, documentar y facilitar la difusion de los cantos populares y arengas entonadas en las calles por estudiantes, colectivos feministas y la ciudadania en general.

En medio de las marchas multitudinarias en ciudades como Bogota, Medellin y Cali, la plataforma se difundio de forma organica y viral en redes sociales (Twitter/X, WhatsApp, Instagram), alcanzando un **pico historico de mas de 10.000 personas conectadas simultaneamente** consumiendo audio y letras en vivo desde sus dispositivos moviles.

Cumplido su ciclo operativo durante las movilizaciones ciudadanas, hoy ArengApp se mantiene y expone como un **archivo historico sonoro y caso de estudio de codigo abierto**, demostrando como una arquitectura web ligera y optimizada puede absorber picos masivos de concurrencia viral con cero costos de infraestructura y sin degradacion de servicio.

---

## 🌟 Metricas Historicas de Impacto & Rendimiento

- **Pico Historico de Audiencia:** Mas de **10.000 usuarios concurrentes** conectados durante las jornadas de mayor afluencia del paro nacional.
- **Rendimiento bajo Alta Concurrencia:** Miles de solicitudes de streaming de audio simultaneas atendidas sin caidas gracias a una implementacion minimalista y libre de sobrecargas de frameworks pesados.
- **Estado Actual:** Preservado como repositorio publico de memoria historica y plantilla de reproductor multimedia open source.
- **Acervo Documental:** 42 arengas populares grabadas, catalogadas y clasificadas tematicamente con transcripcion completa de sus letras.

---

## 🚀 Caracteristicas Principales

- **Reproductor de Audio Dual:**
  - **Mini-Player Superior:** Control permanente de reproduccion (play/pause, pista anterior, siguiente y caratula por categoria).
  - **Panel Desplegable Lateral:** Interfaz extendida con barra de desplazamiento temporal (scrubber interactivo), selector de categorias y busqueda en tiempo real.
- **Catalogo Categorizado:**
  - **Nacional:** Cantos del paro civico y protestas ciudadanas transversales (*Duque Chao!*, *A parar para avanzar*, *El pueblo*, *Hay que ver las cosas que pasan*, *Represion*).
  - **Estudiantes:** Arengas del movimiento universitario y defensa de la educacion publica (*Viva la U*, *Soy Estudiante*, *La Batuta*, *Taki Taki*, *Poropopo*, *Presupuesto*).
  - **Feministas:** Himnos y consignas de colectivos de mujeres y equidad de genero (*Libres o muertas*, *Arroz con leche*, *Don Federico*, *Hoy peleamos*, *Si el papa fuera mujer*).
- **Visor de Letras y Contexto:** Modal interactivo para consultar la letra detallada de cada arenga y su significado historico.
- **Filtros Dinamicos en el Cliente:** Filtrado instantaneo por texto o por categoria tematica sin recargar la pagina.
- **Resiliencia Operativa:** Capa de datos desacoplada en PDO con mecanismo de fallback en memoria: la aplicacion reproduce todo el catalogo tanto con base de datos MariaDB activa como de manera autonoma.
- **Despliegue Llave en Mano:** Stack completo orquestado con Docker Compose (PHP Apache + MariaDB + phpMyAdmin).

---

## 🛠️ Arquitectura y Tecnologias

```text
Frontend:     HTML5 Semantico · CSS3 Fluido (Animaciones Wave) · JavaScript ES6+
Animaciones:  GSAP (TweenMax 1.19 / TimelineMax) · jQuery
Backend:      PHP 8.1 Apache · PDO MySQL (Prepared Statements & Fallback)
Base Datos:   MariaDB 10.11 / MySQL 8.0 (arengapp_bd)
Contenedores: Docker · Docker Compose
```

---

## 📦 Estructura del Repositorio

```text
arengapp/
├── Covers/                 # Portadas graficas por categoria (Nacional, Estudiantes, Feministas)
├── Songs/                  # 42 archivos de audio en formato MP3
├── Tools/
│   └── PDO.php             # Capa de conexion a MariaDB con variables de entorno y fallback
├── arengapp_bd.sql         # Volcado SQL oficial de la tabla Songs y las 42 arengas
├── docker-compose.yml      # Orquestacion de contenedores (App :8096, DB :3313, PMA :8097)
├── Dockerfile              # Imagen PHP 8.1 Apache con extensiones PDO MySQL
├── index.php               # Portal principal y reproductor interactivo
├── privacidad.php          # Politicas de privacidad y terminos de uso
├── script.js               # Controladores de animacion GSAP y transiciones de pantalla
├── style.css               # Estilos visuales, ondas animadas y diseno responsive
└── README.md
```

---

## ⚙️ Puesta en Marcha con Docker Compose

La forma mas rapida y recomendada para ejecutar ArengApp en local:

### 1. Clonar el repositorio
```bash
git clone https://github.com/KevinAndrey96/arengapp.git
cd arengapp
```

### 2. Iniciar los servicios
```bash
docker compose up -d --build
```

### 3. Acceder a los servicios
- **Reproductor Web ArengApp:** [http://localhost:8096](http://localhost:8096)
- **phpMyAdmin:** [http://localhost:8097](http://localhost:8097) (Servidor: `arengapp-db`, Usuario: `arengapp_admin`, Password: `arengapp_secret`)
- **MariaDB Directo:** `localhost:3313`

---

## 💻 Ejecucion Local (Sin Docker)

Si prefieres usar un servidor PHP local:

```bash
# Iniciar servidor embebido de PHP
php -S localhost:8000

# Abrir en el navegador
open http://localhost:8000
```

> **Nota:** Si no configuras una base de datos MySQL, ArengApp utilizara automaticamente el catalogo de respaldo integrado, permitiendo reproducir todo el audio sin configuracion previa.

---

## 📊 Inventario de Arengas Documentadas

| Categoria | Total Pistas | Ejemplos Destacados |
| :--- | :---: | :--- |
| **Nacional** | 17 | *Duque Chao!*, *A parar para avanzar*, *Hay que ver las cosas*, *El pueblo*, *Represion* |
| **Estudiantes** | 15 | *Soy Estudiante*, *Viva la U*, *La Batuta*, *Taki Taki*, *Poropopo*, *Presupuesto* |
| **Feministas** | 10 | *Libres o muertas*, *Arroz con leche*, *Don Federico*, *Hoy peleamos*, *Si el papa fuera mujer* |

---

## 📄 Licencia

Este proyecto esta bajo la Licencia MIT. Consulta el archivo `LICENSE` para mas detalles.

---

## 👨‍💻 Autor

**Kevin Andrey Herrera Silva**  
*Senior Backend Engineer & Software Architect*  
Bogota, Colombia  
- [GitHub](https://github.com/KevinAndrey96)  
- [LinkedIn](https://www.linkedin.com/in/kevinandrey96/)  
