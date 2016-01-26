-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-10-2013 a las 15:08:53
-- Versión del servidor: 5.5.27
-- Versión de PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `id_dewey` varchar(4) NOT NULL,
  `nombre` varchar(64) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_dewey`, `nombre`) VALUES
('000', 'Generalidades'),
('010', 'Bibliografía'),
('020', 'Bibliotecnología e informática'),
('030', 'Enciclopedias generales'),
('040', 'Este número no tiene ningún uso. '),
('050', 'Publicaciones en serie'),
('060', 'Organizaciones y museografía '),
('070', 'Periodismo, editoriales, diarios'),
('080', 'Colecciones generales'),
('090', 'Manuscritos y libros raros'),
('100', ' Filosofía y psicología'),
('110', 'Metafísica '),
('120', ' Conocimiento, causa, fin, hombre '),
('130', 'Parapsicología, ocultismo '),
('140', 'Puntos de vista filosóficos '),
('150', 'Psicología '),
('160', 'Lógica'),
('170', 'Ética (filosofía moral)'),
('180', 'Filosofía antigua, medieval, oriental'),
('190', 'Filosofía moderna occidental'),
('200', 'Religion'),
('210', 'Religión natural'),
('220', 'Biblia'),
('230', 'Teología cristiana'),
('240', 'Moral y prácticas cristianas'),
('250', 'Iglesia local y órdenes religiosas'),
('260', 'Teología social y eclesiología'),
('270', 'Historia y geografía de la iglesia'),
('280', 'Credos de la iglesia cristiana'),
('290', 'Otras religiones'),
('300', 'Ciencias sociales'),
('310', 'Estadística'),
('320', 'Ciencia política'),
('330', 'Economía'),
('340', 'Derecho'),
('350', 'Administración pública'),
('360', 'Patología y servicio sociales'),
('370', 'Educacion'),
('380', 'Comercio'),
('390', 'Costumbres y folklore'),
('420', 'Ingles y algosajon'),
('400', 'Lenguas '),
('410', 'Linguisticas'),
('430', 'Lenguas germánicas; alemán'),
('440', 'Lenguas romances; francés'),
('450', 'Italiano, rumano, rético'),
('460', 'Español y portugués'),
('470', 'Lenguas itálicas; latín'),
('480', 'Lenguas helénicas; griego clásico'),
('490', 'Otras lenguas'),
('500', 'Matemáticas y ciencias naturales'),
('510', 'Matemáticas'),
('520', 'Astronomía y ciencias afines '),
('530', 'Fisica'),
('540', 'Quimica y ciencias a fines'),
('550', 'Geociencias'),
('560', 'Paleontologia'),
('570', 'Ciencias biologicas'),
('580', 'Ciencias botanicas'),
('590', 'Ciencias zoologicas'),
('600', 'Tecnología y ciencias aplicadas'),
('610', 'Ciencias medicas'),
('620', 'Ingeniería y operaciones afines'),
('630', 'Agricultura y tecnologías afines'),
('640', 'Economía doméstica'),
('650', 'Servicios administrativos empresariales'),
('660', 'Química industrial'),
('670', 'Manufacturas'),
('680', 'Manufacturas varias'),
('690', 'Construcciones'),
('700', 'Artes'),
('710', 'Urbanismo y arquitectura del paisaje'),
('720', 'Arquitectura'),
('730', 'Artes plásticas; escultura'),
('740', 'Dibujo, artes decorativas y menores'),
('750', 'Pintura y pinturas'),
('760', 'Artes gráficas; grabados'),
('770', 'Fotografía y fotografías'),
('780', 'Musica'),
('790', 'Entretenimiento'),
('800', 'Literatura'),
('810', 'Literatura americana en inglés'),
('820', 'Literatura inglesa y anglosajona'),
('830', 'Literaturas germánicas '),
('840', 'Literaturas de las lenguas romances '),
('850', 'Literaturas italiana, rumana '),
('860', 'Literaturas española y portuguesa'),
('870', 'Literaturas de las lenguas itálicas'),
('880', 'Literaturas de las lenguas helénicas'),
('890', 'Literaturas de otras lenguas'),
('900', 'Historia y geografía'),
('910', 'Geografía; viajes'),
('920', 'Biografía y genealogía'),
('930', 'Historia del mundo antiguo'),
('940', 'Historia de Europa'),
('950', 'Historia de Asia'),
('960', 'Historia de africa'),
('970', 'Historia de América del Norte'),
('980', 'Historia de América del Sur'),
('990', 'Historia de otras regiones');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
