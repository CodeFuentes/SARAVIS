-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-12-2013 a las 17:22:52
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
-- Estructura de tabla para la tabla `auditoria`
--

CREATE TABLE IF NOT EXISTS `auditoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `operacion` longtext CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=86 ;

--
-- Volcado de datos para la tabla `auditoria`
--

INSERT INTO `auditoria` (`id`, `usuario`, `operacion`, `fecha`, `hora`) VALUES
(2, 'Juan', 'El usuario Juan ha iniciado sesion', '2013-11-21', '00:00:00'),
(3, 'Juan', 'El usuario Juan ha cerrado sesion', '2013-11-21', '00:00:00'),
(4, 'Olga', 'El usuario Olga ha iniciado sesion', '2013-11-21', '00:00:00'),
(5, 'Olga', 'El usuario Olga ha cerrado sesion', '2013-11-21', '00:00:00'),
(6, 'Rossner', 'El usuario Rossner ha iniciado sesion', '2013-11-21', '00:00:00'),
(7, 'Rossner', 'El usuario Rossner ha cerrado sesion', '2013-11-21', '00:00:00'),
(8, 'Roxana', 'El usuario Roxana ha iniciado sesion', '2013-11-21', '00:00:00'),
(9, 'Roxana', 'El usuario Roxana ha cerrado sesion', '2013-11-21', '00:00:00'),
(12, 'Rossner', 'El usuario Rossner ha iniciado sesion', '2013-11-22', '00:00:00'),
(13, 'Rossner', 'El usuario Rossner ha cerrado sesion', '2013-11-22', '00:00:00'),
(14, 'Rossner', 'El usuario Rossner ha iniciado sesion', '2013-11-25', '00:00:00'),
(15, 'Rossner', 'El usuario Rossner ha cerrado sesion', '2013-11-25', '00:00:00'),
(16, 'Rossner', 'El usuario Rossner ha iniciado sesion', '2013-11-28', '00:00:00'),
(17, 'Rossner', 'El usuario Rossner ha cerrado sesion', '2013-11-28', '00:00:00'),
(18, 'juan', 'El usuario juan ha iniciado sesion', '2013-11-28', '00:00:00'),
(19, 'juan', 'El usuario juan ha cerrado sesion', '2013-11-28', '00:00:00'),
(20, 'Olga', 'El usuario Olga ha iniciado sesion', '2013-11-28', '00:00:00'),
(21, 'Olga', 'El usuario Olga ha cerrado sesion', '2013-11-28', '00:00:00'),
(22, 'Rossner', 'El usuario Rossner ha iniciado sesion', '2013-11-28', '00:00:00'),
(23, 'Rossner', 'El usuario Rossner ha cerrado sesion', '2013-11-28', '00:00:00'),
(24, 'Rossner', 'El usuario Rossner ha iniciado sesion', '2013-11-28', '00:00:00'),
(25, 'Rossner', 'El usuario Rossner ha cerrado sesion', '2013-11-28', '00:00:00'),
(26, 'Thibisay', 'El usuario Thibisay ha iniciado sesion', '2013-11-28', '00:00:00'),
(27, 'Thibisay', 'El usuario Thibisay ha cerrado sesion', '2013-11-28', '00:00:00'),
(28, 'Rossner', 'El usuario Rossner ha iniciado sesion', '2013-11-29', '00:00:00'),
(29, 'Rossner', 'El usuario Rossner ha cerrado sesion', '2013-11-29', '00:00:00'),
(30, 'Rossner', 'El usuario Rossner ha iniciado sesion', '2013-11-29', '00:00:00'),
(31, 'Rossner', 'El usuario Rossner ha cerrado sesion', '2013-11-29', '00:00:00'),
(32, 'Rossner', 'El usuario Rossner ha iniciado sesion', '2013-11-29', '00:00:00'),
(33, 'Rossner', 'El usuario Rossner ha cerrado sesion', '2013-11-29', '00:00:00'),
(34, 'Rossner', 'El usuario Rossner ha iniciado sesion', '2013-11-29', '00:00:00'),
(35, 'Rossner', 'El usuario Rossner ha cerrado sesion', '2013-11-29', '00:00:00'),
(36, 'Rossner', 'El usuario Rossner ha iniciado sesion', '2013-11-29', '00:00:00'),
(37, 'Rossner', 'El usuario Rossner ha cerrado sesion', '2013-11-29', '00:00:00'),
(38, 'Rossner', 'El usuario Rossner ha iniciado sesion', '2013-12-01', '00:00:00'),
(41, 'Rossner', 'El usuario Rossner ha cerrado sesion', '2013-12-01', '00:00:00'),
(42, 'Rossner', 'El usuario Rossner ha iniciado sesion', '2013-12-01', '00:00:00'),
(44, 'Rossner', 'El usuario Rossner ha cerrado sesion', '2013-12-01', '00:00:00'),
(45, 'Rossner', 'El usuario Rossner ha iniciado sesion', '2013-12-01', '00:00:00'),
(46, 'Rossner', 'El usuario Rossner ha cerrado sesion', '2013-12-01', '00:00:00'),
(50, 'Roxana', 'El usuario Roxana ha iniciado sesion', '2013-12-01', '00:00:00'),
(51, 'Roxana', 'El usuario Roxana ha cerrado sesion', '2013-12-01', '00:00:00'),
(52, 'Rossner', 'El usuario Rossner ha iniciado sesion', '2013-12-01', '00:00:00'),
(53, 'Rossner', 'El usuario Rossner ha cerrado sesion', '2013-12-01', '00:00:00'),
(54, 'Alejandra', 'El usuario Alejandra ha iniciado sesion', '2013-12-01', '00:00:00'),
(55, 'Alejandra', 'El usuario Alejandra ha cerrado sesion', '2013-12-01', '00:00:00'),
(56, 'Rossner', 'El usuario Rossner ha iniciado sesion', '2013-12-01', '00:00:00'),
(57, 'Rossner', 'El usuario Rossner ha cerrado sesion', '2013-12-01', '00:00:00'),
(58, 'Rossner', 'El usuario Rossner ha iniciado sesion', '2013-12-01', '00:00:00'),
(59, 'Rossner', 'El usuario Rossner ha cerrado sesion', '2013-12-01', '00:00:00'),
(60, 'Juan', 'El usuario Juan ha iniciado sesion', '2013-12-01', '00:00:00'),
(61, 'Juan', 'El usuario Juan ha cerrado sesion', '2013-12-01', '00:00:00'),
(62, 'Olga', 'El usuario Olga ha iniciado sesion', '2013-12-01', '00:00:00'),
(63, 'Olga', 'El usuario Olga ha cerrado sesion', '2013-12-01', '00:00:00'),
(64, 'Alejandra', 'El usuario Alejandra ha iniciado sesion', '2013-12-01', '00:00:00'),
(65, 'Alejandra', 'El usuario Alejandra ha cerrado sesion', '2013-12-01', '00:00:00'),
(66, 'Roxana', 'El usuario Roxana ha iniciado sesion', '2013-12-01', '00:00:00'),
(67, 'Roxana', 'El usuario Roxana ha cerrado sesion', '2013-12-01', '00:00:00'),
(68, 'Rossner', 'El usuario Rossner ha iniciado sesion', '2013-12-01', '00:00:00'),
(69, 'Rossner', 'El usuario Rossner ha iniciado sesion', '2013-12-02', '00:00:00'),
(70, 'Rossner', 'El usuario Rossner ha cerrado sesion', '2013-12-02', '00:00:00'),
(71, 'Rossner', 'El usuario Rossner ha iniciado sesion', '2013-12-02', '00:00:00'),
(72, 'Rossner', 'El usuario Rossner ha cerrado sesion', '2013-12-02', '00:00:00'),
(73, 'Roxana', 'El usuario Roxana ha iniciado sesion', '2013-12-02', '00:00:00'),
(74, 'Roxana', 'El usuario Roxana ha cerrado sesion', '2013-12-02', '00:00:00'),
(75, 'Alejandra', 'El usuario Alejandra ha iniciado sesion', '2013-12-02', '00:00:00'),
(76, 'Alejandra', 'El usuario Alejandra ha cerrado sesion', '2013-12-02', '00:00:00'),
(77, 'adca', 'El usuario adca ha iniciado sesion', '2013-12-02', '00:00:00'),
(78, 'adca', 'El usuario adca ha cerrado sesion', '2013-12-02', '00:00:00'),
(79, 'dada', 'El usuario dada ha iniciado sesion', '2013-12-02', '00:00:00'),
(80, 'dada', 'El usuario dada ha cerrado sesion', '2013-12-02', '00:00:00'),
(81, 'Rossner', 'El usuario Rossner ha iniciado sesion', '2013-12-02', '00:00:00'),
(82, 'Rossner', 'El usuario Rossner ha cerrado sesion', '2013-12-02', '00:00:00'),
(83, 'Alejandra', 'El usuario Alejandra ha iniciado sesion', '2013-12-02', '00:00:00'),
(84, 'Alejandra', 'El usuario Alejandra ha cerrado sesion', '2013-12-02', '00:00:00'),
(85, 'Rossner', 'El usuario Rossner ha cerrado sesion', '2013-12-02', '');

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `donante`
--

CREATE TABLE IF NOT EXISTS `donante` (
  `nombre` varchar(32) DEFAULT NULL,
  `apellido` varchar(32) DEFAULT NULL,
  `telefono` varchar(32) DEFAULT NULL,
  `identidad` varchar(32) NOT NULL,
  `activo` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`identidad`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `donante`
--

INSERT INTO `donante` (`nombre`, `apellido`, `telefono`, `identidad`, `activo`) VALUES
('MILEY', 'CYRUS', '04163143674', 'V-18769561', 1),
('Arnaldo', 'PiÃ±a', '0456123332', 'E-14533212', 0),
('Eva', 'PerÃ³n', '04142321111', 'V-24111123', 0),
('ALBERTO', 'ESPINO', '04123456789', 'V-24669569', 1),
('ROSSNER J', 'CONTRERAS', '04142341111', 'V-22344503', 1),
('LADY', 'GAGA', '04123443211', 'V-23456311', 1),
('ERMO', 'RAMIREZ', '04123443211', 'V-18769569', 1),
('OMAR', 'ROSALES', '04123456789', 'V-8819048', 1),
('JOSE', 'CAMPO', '0244567382', 'V-3456789', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lector`
--

CREATE TABLE IF NOT EXISTS `lector` (
  `nombre` varchar(32) DEFAULT NULL,
  `apellido` varchar(32) DEFAULT NULL,
  `identidad` varchar(32) NOT NULL,
  `tipo` varchar(32) DEFAULT NULL,
  `ocupacion` varchar(32) DEFAULT NULL,
  `activo` int(11) NOT NULL DEFAULT '1',
  `multado_hasta` date DEFAULT NULL,
  `sexo` varchar(1) NOT NULL,
  `direccion` longtext NOT NULL,
  `telefono` varchar(11) NOT NULL,
  `grado` varchar(4) DEFAULT NULL,
  `turno` varchar(16) DEFAULT NULL,
  `multa` int(11) NOT NULL,
  PRIMARY KEY (`identidad`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `lector`
--

INSERT INTO `lector` (`nombre`, `apellido`, `identidad`, `tipo`, `ocupacion`, `activo`, `multado_hasta`, `sexo`, `direccion`, `telefono`, `grado`, `turno`, `multa`) VALUES
('Jesus', 'Moncada', 'V-24669562', 'externo', 'Profesor', 1, '2013-10-30', 'M', 'urbanizacion', '04123455543', '1', '', 0),
('Juana', 'Diaz', 'V-4368331', 'estudiante', 'estudiante', 1, NULL, 'F', 'GRDGERHERH', '04123321212', '7', 'DIURNO', 0),
('FAFA', 'GAGA', 'V-22344504', 'estudiante', 'DADA', 1, NULL, 'F', 'davbngfjs', '124587654', '3', 'diurno', 0),
('XING', 'HAO', 'E-13456711', 'estudiante', 'CHAPERO', 1, NULL, 'M', 'el rancho', '04167123147', '2', 'vespertino', 0),
('ROSSNER', 'CONTRERAS', 'V-22344503', 'estudiante', 'INGENIERO', 1, NULL, 'M', 'La Victoria', '04120487113', '5', 'diurno', 0),
('HFHJ', 'HFHF', 'V-21272049', 'externo', 'F6YT5E', 1, NULL, 'F', 'ghfhj', '38536857384', '3', '', 0),
('GFJGJ', 'JGVJG', 'V-12345678', 'estudiante', 'DFHJK', 1, NULL, 'M', 'hfhjfjjg', '086576536', '9', 'diurno', 0),
('CARMEN', 'FERNANDEZ', 'V-4567890', 'estudiante', 'SECRETARIO', 1, NULL, 'F', 'La Victoria', '0241098345', '11', 'diurno', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro`
--

CREATE TABLE IF NOT EXISTS `libro` (
  `cota` varchar(32) NOT NULL,
  `titulo` varchar(32) DEFAULT NULL,
  `autor` varchar(32) DEFAULT NULL,
  `editorial` varchar(32) DEFAULT NULL,
  `ano` int(11) DEFAULT NULL,
  `materia` varchar(32) DEFAULT NULL,
  `estante` varchar(3) NOT NULL,
  `uso` varchar(16) NOT NULL,
  `id_donante` varchar(16) NOT NULL,
  `activo` int(11) NOT NULL DEFAULT '1',
  `prestado` int(11) NOT NULL,
  PRIMARY KEY (`cota`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `libro`
--

INSERT INTO `libro` (`cota`, `titulo`, `autor`, `editorial`, `ano`, `materia`, `estante`, `uso`, `id_donante`, `activo`, `prestado`) VALUES
('000-4169-G1', 'Adiestramiento en el uso de soft', 'Oriana GÃ³mez', 'Patria', 2013, '000', 'G1', 'CIRCULANTE', 'V-18769561', 1, 1),
('000-6074-G2', 'Adiestramiento en el uso de soft', 'Oriana GÃ³mez', 'Patria', 2013, '000', 'G2', 'SALA', 'V-18769561', 1, 1),
('000-4804-G3', 'Adiestramiento en el uso de soft', 'Oriana GÃ³mez', 'Patria', 2013, '000', 'G3', 'CIRCULANTE', 'V-18769561', 1, 1),
('000-9136-P1', 'Adiestramiento en el uso de soft', 'Oriana GÃ³mez', 'Patria', 2013, '000', 'P1', 'SALA', 'V-18769561', 1, 0),
('000-1391-G1', 'Adiestramiento en el uso de soft', 'Oriana GÃ³mez', 'Patria', 2013, '000', 'G1', 'CIRCULANTE', 'V-18769561', 1, 1),
('070-2231-G1', '20000 LEGUAS HOT', 'AZOCAR', 'PATRIA', 2012, '070', 'G1', 'SALA', 'V-18769569', 1, 1),
('070-7569-G1', '20000 LEGUAS HOT', 'AZOCAR', 'PATRIA', 2012, '070', 'G1', 'CIRCULANTE', 'V-18769569', 1, 0),
('110-3254-G2', 'PROGRAMACION', 'OMAR', 'SANTILLANA', 1999, '110', 'G2', 'SALA', 'V-8819048', 1, 1),
('110-4869-G2', 'PROGRAMACION', 'OMAR', 'SANTILLANA', 1999, '110', 'G2', 'CIRCULANTE', 'V-8819048', 1, 0),
('110-7542-G2', 'PROGRAMACION', 'OMAR', 'SANTILLANA', 1999, '110', 'G2', 'CIRCULANTE', 'V-8819048', 1, 0),
('110-2348-G2', 'PROGRAMACION', 'OMAR', 'SANTILLANA', 1999, '110', 'G2', 'CIRCULANTE', 'V-8819048', 1, 0),
('110-4180-G2', 'PROGRAMACION', 'OMAR', 'SANTILLANA', 1999, '110', 'G2', 'CIRCULANTE', 'V-8819048', 1, 0),
('300-8210-G1', 'REDES', 'OMAR', 'CHARACO', 1924, '300', 'G1', 'SALA', 'V-3456789', 1, 1),
('300-6643-G1', 'REDES', 'OMAR', 'CHARACO', 1924, '300', 'G1', 'CIRCULANTE', 'V-3456789', 1, 0),
('100-1063-G2', 'REDESLAN', 'PEDRO PEREZ', 'SEGUNDA', 1995, '100', 'G2', 'SALA', '', 1, 0),
('100-3682-G1', 'REDESLAN', 'PEDRO PEREZ', 'SEGUNDA', 1995, '100', 'G1', 'CIRCULANTE', '', 1, 0),
('100-6683-G1', 'REDESLAN', 'PEDRO PEREZ', 'SEGUNDA', 1995, '100', 'G1', 'CIRCULANTE', '', 1, 0),
('100-4549-G1', 'REDESLAN', 'PEDRO PEREZ', 'SEGUNDA', 1995, '100', 'G1', 'CIRCULANTE', '', 1, 1),
('100-5882-G2', 'REDESLAN', 'PEDRO PEREZ', 'SEGUNDA', 1995, '100', 'G2', 'SALA', '', 1, 0),
('100-9842-G1', 'REDESLAN', 'PEDRO PEREZ', 'SEGUNDA', 1995, '100', 'G1', 'CIRCULANTE', '', 1, 0),
('100-3689-G1', 'REDESLAN', 'PEDRO PEREZ', 'SEGUNDA', 1995, '100', 'G1', 'CIRCULANTE', '', 1, 0),
('100-9541-G1', 'REDESLAN', 'PEDRO PEREZ', 'SEGUNDA', 1995, '100', 'G1', 'CIRCULANTE', '', 1, 0),
('100-1195-G2', 'REDESLAN', 'PEDRO PEREZ', 'SEGUNDA', 1995, '100', 'G2', 'SALA', '', 1, 0),
('100-6581-G1', 'REDESLAN', 'PEDRO PEREZ', 'SEGUNDA', 1995, '100', 'G1', 'CIRCULANTE', '', 1, 0),
('100-1739-G1', 'REDESLAN', 'PEDRO PEREZ', 'SEGUNDA', 1995, '100', 'G1', 'CIRCULANTE', '', 1, 0),
('100-9949-G1', 'REDESLAN', 'PEDRO PEREZ', 'SEGUNDA', 1995, '100', 'G1', 'CIRCULANTE', '', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamo`
--

CREATE TABLE IF NOT EXISTS `prestamo` (
  `id_p` int(11) NOT NULL AUTO_INCREMENT,
  `id_lector` varchar(16) DEFAULT NULL,
  `id_ejemplar` varchar(16) DEFAULT NULL,
  `fecha_c` date DEFAULT NULL,
  `fecha_r` date DEFAULT NULL,
  `estado` varchar(32) DEFAULT NULL,
  `multa` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_p`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `prestamo`
--

INSERT INTO `prestamo` (`id_p`, `id_lector`, `id_ejemplar`, `fecha_c`, `fecha_r`, `estado`, `multa`) VALUES
(1, '12102013-230', '1', '2013-10-20', '2013-10-20', 'DEVUELTO EL 20/10/2013', 0),
(2, '12102013-230', '2', '2013-10-20', '2013-11-03', 'NO DEVUELTO', 0),
(3, '12102013-230', '26102013-152-1', '2013-10-22', '2013-10-27', 'DEVUELTO EL 27/10/2013', 0),
(4, 'V-24669562', '070-2231-G1', '2013-11-21', '2013-11-21', 'NO DEVUELTO', 0),
(5, 'V-24669562', '000-4169-G1', '2013-11-21', '2013-11-23', 'DEVUELTO EL 21/11/2013', 0),
(6, 'V-12345678', '110-3254-G2', '2013-11-21', '2013-11-21', 'NO DEVUELTO', 0),
(7, 'V-12345678', '000-4804-G3', '2013-11-21', '2013-11-23', 'DEVUELTO EL 21/11/2013', 0),
(8, 'V-4567890', '000-6074-G2', '2013-11-25', '2013-11-25', 'NO DEVUELTO', 0),
(9, 'V-4567890', '300-8210-G1', '2013-11-25', '2013-11-25', 'DEVUELTO EL 25/11/2013', 0),
(10, 'V-4567890', '000-6074-G2', '2013-11-25', '2013-11-25', 'NO DEVUELTO', 0),
(11, 'V-4567890', '300-8210-G1', '2013-11-25', '2013-11-25', 'DEVUELTO EL 28/11/2013', 0),
(12, 'V-33333333', '000-1391-G1', '2013-11-28', '2013-11-28', 'NO DEVUELTO', 0),
(13, 'V-12345678', '100-4549-G1', '2013-11-29', '2013-12-01', 'NO DEVUELTO', 0),
(14, 'V-12345678', '100-4549-G1', '2013-11-29', '2013-12-01', 'NO DEVUELTO', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(16) DEFAULT NULL,
  `clave` varchar(32) DEFAULT NULL,
  `tipocuenta` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `clave`, `tipocuenta`) VALUES
(1, 'Juan', '87654321', 'ADMIN'),
(2, 'Rossner', '12345678', 'ADMIN'),
(3, 'Roxana', '12345678', 'ADMIN'),
(4, 'Alejandra', '12345678', 'ADMIN'),
(5, 'Olga', '87654321', 'ENCAR');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
