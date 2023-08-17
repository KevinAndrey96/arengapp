-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 16, 2023 at 11:29 PM
-- Server version: 10.5.18-MariaDB-cll-lve
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arengapp_bd`
--

-- --------------------------------------------------------

--
-- Table structure for table `Songs`
--

CREATE TABLE `Songs` (
  `IdSong` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Category` varchar(50) NOT NULL,
  `Route` varchar(200) NOT NULL,
  `Lyrics` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `Songs`
--

INSERT INTO `Songs` (`IdSong`, `Name`, `Category`, `Route`, `Lyrics`) VALUES
(1, 'Duque Chao!', 'Nacional', 'duquechao', 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto.'),
(2, 'Soy Estudiante', 'Estudiantes', 'soyestudiante', '¿Quién es usted?<br>Soy estudiante<br>No lo escuché<br>Soy estudiante!<br>Una vez más<br>Soy estudiante soy, soy estudiante soy, yo quiero estudiar<br>Para cambiar la sociedad vamo a la lucha!'),
(3, 'A parar para avanzar', 'Nacional', 'apararparaavanzar', 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto'),
(4, 'No queremos privatización', 'Nacional', 'noqueremosprivatizacion', 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto'),
(5, 'Viva la U', 'Estudiantes', 'vivalau', 'Viva la U, Viva!!!<br>Viva la U!! Viva!!<br>Viva la Universidad, no la dejes no, no la dejes no, no la dejes privatizar. <br>En caso de privadas puede terminar asi:<br>Viva la U, Viva!!!<br>Viva la U!! Viva!!<br>Viva la Universidad, no la dejes no, no la dejes no, no la dejes comercializar. <br>'),
(6, 'La Batuta', 'Estudiantes', 'labatuta', 'A ver, A ver <br>quien lleva la batuta? <br>si los estudiantes,<br>o el gobierno hijueputa uta uta.<br>'),
(7, 'Taki Taki por la Educación', 'Estudiantes', 'takitaki', 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto'),
(8, 'A las Mujeres y a la universidad', 'Feministas', 'alasmujeresyalauniversidad', 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto'),
(9, 'Arroz con leche', 'Feministas', 'arrozconleche', 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto'),
(10, 'En el bosque de la china', 'Feministas', 'bosquedelachina', 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto'),
(11, 'Don Federico', 'Feministas', 'donfederico', 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto'),
(12, 'Hoy peleamos', 'Feministas', 'hoypeleamos', 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto'),
(13, 'Libres o muertas', 'Feministas', 'libresomuertas', 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto'),
(14, 'Mujeres contra', 'Feministas', 'mujerescontra', 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto'),
(15, 'No sea indiferente', 'Feministas', 'noseaindiferente', 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto'),
(16, '¿Quién es usted?', 'Feministas', 'quienesusted', 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto'),
(17, 'Si el papa fuera mujer', 'Feministas', 'sielpapafueramujer', 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto'),
(18, 'Duque Ra Ra Ra', 'Nacional', 'duquerarara', 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto'),
(19, 'El pueblo', 'Nacional', 'elpueblo', 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto'),
(20, 'El que no estudia es policia nacional', 'Estudiantes', 'elquenoestudia', 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto'),
(21, 'En los libros', 'Estudiantes', 'enloslibros', 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto'),
(22, 'Es la voz del estudiante', 'Estudiantes', 'eslavozdelestudiante', 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto'),
(23, 'Esos son', 'Nacional', 'esosson', 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto'),
(24, 'Hay que ver las cosas que pasan', 'Nacional', 'hayquever', 'Hay que ver las cosas que pasan,<br>hay que ver las vueltas que dan,<br>con un pueblo que camina pa\' adelante <br>y un gobierno que camina para atrás. <br>'),
(25, 'La educación es un derecho', 'Estudiantes', 'laeducacionesunderecho', 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto'),
(26, 'La educación es mia', 'Estudiantes', 'laeducacionesmia', 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto'),
(27, 'Los pollitos', 'Nacional', 'lospollitos', 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto'),
(28, 'Ni un minuto de silencio', 'Nacional', 'niunminuto', 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto'),
(29, 'No respetamos', 'Nacional', 'norespetamos', 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto'),
(30, 'Pa la publica no hay na', 'Estudiantes', 'palapublicanohayna', 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto'),
(31, 'Poropopo', 'Estudiantes', 'poropopo', 'Porropopo - Porropopo el que no salte quiere Privatizacion.'),
(32, '¿Por que nos matan?', 'Nacional', 'porquenosmatan', 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto'),
(33, 'Presupuesto', 'Estudiantes', 'presupuesto', 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto'),
(34, 'Que lo vengan a ver', 'Nacional', 'quelovenganaver', 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto'),
(35, 'Queremos', 'Nacional', 'queremos', 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto'),
(36, 'Represión', 'Nacional', 'represion', 'Quienes somos? Estudiantes<br>Que exigimos? Soluciones<br>Que nos dan? Represión, represión y la privatización.<br>'),
(37, 'Señoras, Señores', 'Nacional', 'señorasseñores', 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto'),
(38, 'Somos estudiantes', 'Estudiantes', 'somosestudiantes', 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto'),
(39, 'Todas las mañanas', 'Nacional', 'todaslasmañanas', 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto'),
(40, 'Vamos compañeros', 'Estudiantes', 'vamoscompañeros', 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto'),
(41, 'Van a volver', 'Nacional', 'vanavolver', 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto'),
(42, 'A la nanita nana', 'Nacional', 'alananitanana', 'Aún no se encuentra disponible la letra de esta Arenga, anímate a enviarla y contribuir con este proyecto');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Songs`
--
ALTER TABLE `Songs`
  ADD PRIMARY KEY (`IdSong`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Songs`
--
ALTER TABLE `Songs`
  MODIFY `IdSong` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
