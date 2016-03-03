-- phpMyAdmin SQL Dump
-- version 4.4.15.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 03-03-2016 a las 05:52:40
-- Versión del servidor: 10.0.22-MariaDB
-- Versión de PHP: 5.6.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `saravis`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `certificados`
--

CREATE TABLE IF NOT EXISTS `certificados` (
  `id_certificado` int(11) NOT NULL,
  `id_edicion` int(11) NOT NULL,
  `firma_facilitador` varchar(200) NOT NULL,
  `firmas_extras` varchar(750) NOT NULL,
  `fondo` varchar(20) NOT NULL,
  `logo_extra` varchar(20) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `certificados`
--

INSERT INTO `certificados` (`id_certificado`, `id_edicion`, `firma_facilitador`, `firmas_extras`, `fondo`, `logo_extra`) VALUES
(1, 1, 'Ing(#=D=#)Facilitador', 'Ing.(#=D=#)Jorge Dominguez(#=D=#)Programador', 'fondo_6_1.jpeg', 'logo_6_1.jpeg'),
(3, 2, 'Algo(#=D=#)otro', '', 'fondo_6_2.jpeg', 'ninguno'),
(4, 3, 'Lic.(#=D=#)Coordinadora de Arte del MPPC', 'Prof.(#=D=#)Responsable Área Académica(#=D=#)Jimy V. Santana C.', 'fondo_10_3.jpeg', 'logo_10_3.jpeg'),
(5, 5, 'Profa.(#=D=#)Profesora Estudios Generales', 'Profa.(#=D=#)Rectora UPT Aragua FBF(#=D=#)Bettys E. Muñoz H.(#=P=#)Prof.(#=D=#)Coordinador Área Cultural(#=D=#)César Mòsquera', 'fondo_12_5.jpeg', 'logo_12_5.jpeg'),
(6, 6, 'TSU(#=D=#)Facilitadora', 'Ing.(#=D=#)Coordinador Cultura(#=D=#)Gabriel Vastag', 'fondo_11_6.jpeg', 'logo_11_6.jpeg'),
(7, 4, 'TSU(#=D=#)Facilitadora', 'Profa.(#=D=#)César Mosquera(#=D=#)Coordinador de Cultura', 'fondo_11_4.jpeg', 'logo_11_4.jpeg'),
(8, 7, 'Profa.(#=D=#)Jefa del Departamento de Informática', 'Profa.(#=D=#)Rectora(#=D=#)Bettys Muñoz Henriquez(#=P=#)Prof.(#=D=#)Coordinador de Creación Intelectual y Desarrollo Socioproductivo(#=D=#)Richard Castellanos(#=P=#)Sr.(#=D=#)Coordinador de la UDER(#=D=#)Ramón Garcia', 'fondo_13_7.jpeg', 'logo_13_7.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE IF NOT EXISTS `cursos` (
  `id_curso` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(200) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id_curso`, `nombre`, `descripcion`) VALUES
(1, 'Programacion Web: MVC', 'Programacion Web: MVC'),
(2, 'Programacion Web: Javascript', 'Programacion Web: Javascript'),
(3, 'Programacion Web: Jquery', 'Programacion Web: Jquery'),
(4, 'Programacion Web: CSS3', 'Programacion Web: CSS3'),
(5, 'Programacion Web: HTML5', 'Programacion Web: HTML5'),
(6, 'Programacion Web: PHP y algo mas', 'Programacion Web: PHP'),
(7, 'Programacion Web: AJAX', 'Programacion Web: AJAX'),
(8, 'Programacion Web: MYSQL', 'Programacion Web: MYSQL'),
(9, 'Cisco Redes: Basico', 'Curso de la Cisco, Nivel basico'),
(10, 'Fotografía', 'Taller de Iniciación a la fotografía'),
(11, 'Taller de Mimo', 'Taller orientado a captar personas con talento para realizar actuación y pantomima artística'),
(12, 'Taller de Literatura', 'Taller dirigido a incentivar el hábito de la lectura'),
(13, 'Infotecnología', 'Taller de formación comunitaria, orientado a apoyar el desarrollo socioproductivo de la región, enmarcado en el encargo social de la universidad'),
(14, 'XIII Jornadas De Investigación de Informática', 'XIII Jornadas De Investigación, Desarrollo Socio Productivo Y Vinculación Social');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ediciones`
--

CREATE TABLE IF NOT EXISTS `ediciones` (
  `id_edicion` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `id_facilitador` int(11) NOT NULL,
  `estado` enum('normal','bloqueada') NOT NULL,
  `tipo` enum('curso_apro','curso_part','taller_apro','taller_part') NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `duracion` varchar(15) NOT NULL,
  `limite` int(3) NOT NULL,
  `horario` varchar(200) NOT NULL,
  `sinoptico` varchar(500) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ediciones`
--

INSERT INTO `ediciones` (`id_edicion`, `id_curso`, `id_facilitador`, `estado`, `tipo`, `fecha_inicio`, `fecha_fin`, `duracion`, `limite`, `horario`, `sinoptico`) VALUES
(1, 6, 3, 'bloqueada', 'curso_apro', '2014-04-09', '2014-04-15', '20 Horas', 5, 'Lunes y Viernes\r\n5:30 pm a 7:00 pm', '.Síntaxis básica\r\n.Tipos\r\n.Variables\r\n.Constantes\r\n.Expresiones\r\n.Operadores\r\n.Estructuras de Control\r\n.Funciones\r\n.Clases y Objetos\r\n'),
(2, 6, 2, 'bloqueada', 'taller_part', '2014-04-21', '2014-04-24', '3 Dias', 3, 'Martes 2:00 pm a 7:00 pm', 'Sitios web dinámicos \r\nAlmacenamiento y recuperación de imágenes en MySQL, desde interfaz \r\nProgramación de aplicaciones para web y Off line\r\nGestión de información Bases de datos analíticas \r\nSistemas de gráficos dinámicos con MySQL y PHP \r\n\r\nAnálisis inteligente de datos: \r\nFunciones estadísticas en el análisis de datos para la toma de desiciones \r\nHerramientas Open Source para control y mantenimiento de Bases de Datos en forma remota.'),
(3, 10, 3, 'bloqueada', 'taller_part', '2014-04-14', '2014-04-25', '40 Horas', 10, '2:00 pm a 6:00 pm', 'Historia\r\nLos colores\r\nLa Luz\r\nEl Equipo\r\nLos ángulos'),
(4, 11, 6, 'normal', 'taller_part', '2014-04-23', '2014-04-23', '8 Horas', 10, 'Jornada de 8 am a 6 pm', 'Posturas\r\nExpresiones\r\nMovimientos'),
(5, 12, 12, 'normal', 'taller_apro', '2014-03-27', '2014-04-29', '20 Horas', 5, 'Martes y Jueves de 4:00 pm a 6:00 pm', 'El arte de leer\r\nSelección de temas\r\nLa postura\r\nEl lugar\r\nLa iluminación\r\nEl Texto digital'),
(6, 11, 6, 'bloqueada', 'taller_apro', '2014-04-29', '2014-05-06', '10 Horas', 5, 'martes y jueves de 2:00 a 4:00pm', 'Taller orientado a formar actores para realizar pantomima artística'),
(7, 13, 136, 'normal', 'taller_part', '2015-04-29', '2015-04-29', '4 Horas', 120, '2:00 pm a 6:00 pm', 'Uso de las TIC en apoyo al Desarrollo Socio Productivo de las Comunidades'),
(8, 14, 136, 'normal', 'taller_part', '2015-07-09', '2015-07-09', '8 Horas', 600, '8:00am a 12:00m y 1:00pm a 6:00pm', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ediciones_personas`
--

CREATE TABLE IF NOT EXISTS `ediciones_personas` (
  `id_edicion` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `estado` varchar(20) NOT NULL DEFAULT 'ninguno'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ediciones_personas`
--

INSERT INTO `ediciones_personas` (`id_edicion`, `id_persona`, `estado`) VALUES
(7, 64, 'ninguno'),
(7, 65, 'ninguno'),
(7, 131, 'ninguno'),
(7, 132, 'ninguno'),
(7, 73, 'ninguno'),
(7, 9, 'ninguno'),
(7, 134, 'ninguno'),
(7, 74, 'ninguno'),
(7, 135, 'ninguno'),
(7, 86, 'ninguno'),
(7, 71, 'ninguno'),
(7, 72, 'ninguno'),
(7, 47, 'ninguno'),
(7, 137, 'ninguno'),
(7, 139, 'ninguno'),
(7, 48, 'ninguno'),
(7, 138, 'ninguno'),
(7, 10, 'ninguno'),
(7, 111, 'ninguno'),
(7, 60, 'ninguno'),
(7, 18, 'ninguno'),
(7, 141, 'ninguno'),
(7, 140, 'ninguno'),
(7, 13, 'ninguno'),
(7, 142, 'ninguno'),
(7, 95, 'ninguno'),
(7, 143, 'ninguno'),
(7, 144, 'ninguno'),
(7, 20, 'ninguno'),
(7, 145, 'ninguno'),
(7, 146, 'ninguno'),
(7, 147, 'ninguno'),
(7, 99, 'ninguno'),
(7, 101, 'ninguno'),
(7, 102, 'ninguno'),
(7, 148, 'ninguno'),
(7, 100, 'ninguno'),
(7, 69, 'ninguno'),
(7, 16, 'ninguno'),
(7, 149, 'ninguno'),
(7, 70, 'ninguno'),
(7, 110, 'ninguno'),
(7, 62, 'ninguno'),
(7, 63, 'ninguno'),
(7, 7, 'ninguno'),
(7, 42, 'ninguno'),
(7, 46, 'ninguno'),
(7, 49, 'ninguno'),
(7, 150, 'ninguno'),
(7, 151, 'ninguno'),
(7, 152, 'ninguno'),
(7, 23, 'ninguno'),
(7, 153, 'ninguno'),
(7, 109, 'ninguno'),
(7, 108, 'ninguno'),
(7, 90, 'ninguno'),
(7, 80, 'ninguno'),
(7, 154, 'ninguno'),
(7, 57, 'ninguno'),
(7, 88, 'ninguno'),
(7, 157, 'ninguno'),
(7, 158, 'ninguno'),
(7, 107, 'ninguno'),
(7, 75, 'ninguno'),
(7, 159, 'ninguno'),
(7, 84, 'ninguno'),
(7, 98, 'ninguno'),
(7, 160, 'ninguno'),
(7, 11, 'ninguno'),
(7, 81, 'ninguno'),
(7, 79, 'ninguno'),
(7, 161, 'ninguno'),
(7, 155, 'ninguno'),
(7, 163, 'ninguno'),
(7, 123, 'ninguno'),
(7, 162, 'ninguno'),
(7, 164, 'ninguno'),
(7, 165, 'ninguno'),
(7, 31, 'ninguno'),
(7, 127, 'ninguno'),
(7, 30, 'ninguno'),
(7, 56, 'ninguno'),
(7, 55, 'ninguno'),
(7, 166, 'ninguno'),
(7, 167, 'ninguno'),
(7, 24, 'ninguno'),
(7, 125, 'ninguno'),
(7, 36, 'ninguno'),
(7, 168, 'ninguno'),
(7, 124, 'ninguno'),
(7, 113, 'ninguno'),
(8, 169, 'ninguno'),
(8, 127, 'ninguno'),
(8, 170, 'ninguno'),
(8, 171, 'ninguno'),
(8, 164, 'ninguno'),
(8, 172, 'ninguno'),
(8, 173, 'ninguno'),
(8, 174, 'ninguno'),
(8, 92, 'ninguno'),
(8, 175, 'ninguno'),
(8, 176, 'ninguno'),
(8, 177, 'ninguno'),
(8, 178, 'ninguno'),
(8, 179, 'ninguno'),
(8, 180, 'ninguno'),
(8, 181, 'ninguno'),
(8, 182, 'ninguno'),
(8, 183, 'ninguno'),
(8, 184, 'ninguno'),
(8, 185, 'ninguno'),
(8, 186, 'ninguno'),
(8, 187, 'ninguno'),
(8, 188, 'ninguno'),
(8, 189, 'ninguno'),
(8, 190, 'ninguno'),
(8, 191, 'ninguno'),
(8, 192, 'ninguno'),
(8, 193, 'ninguno'),
(8, 194, 'ninguno'),
(8, 195, 'ninguno'),
(8, 196, 'ninguno'),
(8, 197, 'ninguno'),
(8, 155, 'ninguno'),
(8, 198, 'ninguno'),
(8, 199, 'ninguno'),
(8, 200, 'ninguno'),
(8, 201, 'ninguno'),
(8, 202, 'ninguno'),
(8, 162, 'ninguno'),
(8, 161, 'ninguno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `identificadores`
--

CREATE TABLE IF NOT EXISTS `identificadores` (
  `id_identificador` int(11) NOT NULL,
  `id_edicion` int(11) NOT NULL,
  `fondo` varchar(20) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `identificadores`
--

INSERT INTO `identificadores` (`id_identificador`, `id_edicion`, `fondo`) VALUES
(1, 1, 'fondo_6_1.jpeg'),
(2, 2, 'fondo_6_2.jpeg'),
(3, 3, 'fondo_10_3.jpeg'),
(4, 4, 'fondo_11_4.jpeg'),
(5, 5, 'fondo_12_5.jpeg'),
(6, 6, 'fondo_11_6.jpeg'),
(7, 7, 'fondo_13_7.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE IF NOT EXISTS `personas` (
  `id_persona` int(11) NOT NULL,
  `documento` varchar(10) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `sexo` enum('masculino','femenino') NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `telefono` varchar(11) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `correo` varchar(50) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=205 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id_persona`, `documento`, `nombre`, `apellido`, `sexo`, `fecha_nacimiento`, `telefono`, `direccion`, `correo`) VALUES
(2, 'V-17715553', 'MARIA ', 'ACOSTA', '', '0000-00-00', '', 'mariflor150585@gmail.com', ''),
(3, 'V-16762382', 'YONISKA ', 'TORREALBA', '', '0000-00-00', '', '', ''),
(4, 'V-8584321', 'FLOR ', 'DURAN', '', '0000-00-00', '', 'mariflor150585@gmail.com', ''),
(5, 'V-4885532', 'EDGAR ', 'PLAZA', '', '0000-00-00', '', 'mariflor150585@gmail.com', ''),
(6, 'V-15256421', 'YENNI', 'TIRADO', '', '0000-00-00', '', 'yennytirado-k@hotmail.com', ''),
(7, 'V-11183169', 'ELIZABETH', 'CARRION', '', '0000-00-00', '', 'eli-_866@hotmail.com', ''),
(9, 'V-17175102', 'Yusey', 'Rebolledo', 'masculino', '1986-02-06', '04264414258', 'yuseyrebolledo@gmail.com', ''),
(10, 'V-15054728', 'DAYANY ', 'VASQUEZ', '', '0000-00-00', '', 'danymari-81@hotmail.com', ''),
(11, 'V-12480616', 'JULIE', 'PEREZ', '', '0000-00-00', '', 'juliedelcinais2015@gmail.com', ''),
(12, 'V-11064597', 'EDGAR ', 'PIÑANGO', '', '0000-00-00', '', 'edgarbach1@hotmail.com', ''),
(13, 'V-4568464', 'MIREYA', 'SALAS', '', '0000-00-00', '', 'mireya_elisa@hotmail.com', ''),
(14, 'V-13412423', 'AIDA', 'VELASQUEZ', '', '0000-00-00', '', 'jackevelasquez23@hotmail.com', ''),
(15, 'V-11183238', 'ALEXANDER', 'GUEVARA', '', '0000-00-00', '', '', ''),
(16, 'V-15733242', 'MARIANA', 'LIENDO', '', '0000-00-00', '', '', ''),
(17, 'V-15256794', 'ALEXIS', 'RAMIREZ', '', '0000-00-00', '', 'alexisrafael.rp@gmail.com', ''),
(18, 'V-19595122', 'DANIEL', 'MEDINA', '', '0000-00-00', '', 'danilete15@gmail.com', ''),
(19, 'V-4402480', 'CESAR', 'SUAREZ', '', '0000-00-00', '', 'cesar.suarez1@yahoo.com', ''),
(20, 'V-9815443', 'RAFAEL', 'ZAMORA', '', '0000-00-00', '', 'cegmarz37@gmail.com', ''),
(21, 'V-11181631', 'MARIBEL', 'PACHECO', '', '0000-00-00', '', 'marybellypm@gmail.com', ''),
(22, 'V-21252591', 'MARYELI', 'MORIN', '', '0000-00-00', '', 'maryelimorin4semestre@gmail.com', ''),
(23, 'V-12480816', 'MARIA', 'LUGO', '', '0000-00-00', '', '', ''),
(24, 'V-13240209', 'MEUDYS', 'MADRIZ', '', '0000-00-00', '', 'meudysmadriz@gmail.com', ''),
(25, 'V-20876921', 'ANGEL', 'VELASQUEZ', '', '0000-00-00', '', 'angel-v16@hotmail.com', ''),
(26, 'V-20588889', 'FRANCISCO', 'VELASQUEZ', '', '0000-00-00', '', 'el-fran_xD@hotmail.com', ''),
(27, 'V-10363238', 'CARMELITA', 'CARMONA', '', '0000-00-00', '', 'bivianacarmelita@hotmail.com', ''),
(28, 'V-3000367', 'CARLOS ', 'TORRES', '', '0000-00-00', '', 'carlostorres4660@hotmail.com', ''),
(29, 'V-21602463', 'ZULEIMA', 'CORDERO', '', '0000-00-00', '', 'misterio182009@hotmail.com', ''),
(30, 'V-18610279', 'Ingiormarid Del Nazareth', 'Morales Bolivar', 'femenino', '1989-03-22', '04261342830', 'ingior@hotmail.com', ''),
(31, 'V-25071645', 'JOSE', 'FLORES', '', '0000-00-00', '', 'niñoloko21@hotmail.com', ''),
(32, 'V-17259094', 'JHONNEL', 'PEREZ', '', '0000-00-00', '', 'jhonnel_perez@hotmail.com', ''),
(33, 'V-24176367', 'DEIVIS', 'PEREIRA', '', '0000-00-00', '', 'deivisope@hotmail.com', ''),
(34, 'V-21254853', 'JESUS', 'LANDAETA', '', '0000-00-00', '', 'jesus.tovar13@hotmail.es', ''),
(35, 'V-20771279', 'CHRISTIAN', 'SANTANA', '', '0000-00-00', '', 'santanajose20771276@gmail.com', ''),
(36, 'V-17174347', 'LIBAN', 'HALEGUEY', '', '0000-00-00', '', 'libanhaleguey@live.com', ''),
(37, 'V-3162454', 'ADELAIDE', 'D''OLIVEIRA', '', '0000-00-00', '', 'adelaidecastillo49@gmail.com', ''),
(38, 'V-5624405', 'MARCOS', 'MEDINA', '', '0000-00-00', '', 'meguimar1@hotmail.com', ''),
(39, 'V-14240560', 'EILIM', 'HERNANDEZ', '', '0000-00-00', '', 'eilime1@hotmail.com', ''),
(40, 'V-8576144', 'NORA', 'BRITO', '', '0000-00-00', '', 'morabritoperez@hotmail.es', ''),
(41, 'V-8578052', 'CLARITZA', 'ARIAS', '', '0000-00-00', '', 'claritzagrisel@hotmail.com', ''),
(42, 'V-3934529', 'Josefina', 'Pinto De Perez', 'masculino', '1954-01-10', '04129405714', 'josefinapinto54@hotmail.com', ''),
(43, 'V-20267249', 'YOSIMAR', 'LAYA', '', '0000-00-00', '', '', ''),
(44, 'V-3375391', 'JOSEFINA', 'FLORES', '', '0000-00-00', '', 'josefinaflores.ctu@gmail.com', ''),
(45, 'V-5262339', 'JULIO', 'TORRES', '', '0000-00-00', '', 'jatf-ve@hotmail.com', ''),
(46, 'V-12415060', 'SUE', 'DIAZ', '', '0000-00-00', '', 'sueca1975@hotmail.com', ''),
(47, 'V-13520244', 'CRISTINA ', 'LANDOLINA', '', '0000-00-00', '', 'cristinarladolinap@gmail.com', ''),
(48, 'V-10275194', 'CALOGERO', 'LANDOLINA', '', '0000-00-00', '', 'venerelandolina@hotmail.com', ''),
(49, 'V-6807580', 'Miladys Maria', 'Villalba Sucre', 'masculino', '1972-02-16', '04162307073', 'miladysm16@hotmail.com', ''),
(50, 'V-4404838', 'IVAN', 'BRICEÑO', '', '0000-00-00', '', '', ''),
(51, 'V-13520482', 'ROSA', 'GONZALEZ', '', '0000-00-00', '', '', ''),
(52, 'V-11177296', 'CHERRY', 'APONTE', '', '0000-00-00', '', 'cherryaponte1969@hotmail.com', ''),
(53, 'V-8733050', 'MARYELI', 'MATTEYS', '', '0000-00-00', '', 'lagatam@hotmail.com', ''),
(54, 'V-15967051', 'ENEILDA ', 'CASTRO', '', '0000-00-00', '', 'eneilda.castro@hotmail.com', ''),
(55, 'V-16762062', 'Evelyn', 'Jaimes', 'masculino', '1982-09-17', '04128865997', 'evejaimes05@hotmail.com', ''),
(56, 'V-13241131', 'Javier', 'Albarran', 'masculino', '1973-10-16', '04243091314', 'evejaime05@hotmail.com', ''),
(57, 'V-12809216', 'Yulys', 'Quirpa', 'masculino', '1974-11-17', '04121988407', 'yulysquirpa_89@hotmail.com', ''),
(58, 'V-9644646', 'RAFAEL', 'ARENAS', '', '0000-00-00', '', 'a.hrafael@yahoo.com', ''),
(59, 'V-12502134', 'MARLON', 'ZAMORA', '', '0000-00-00', '', 'marlonjosezamora1011@gmail.com', ''),
(60, 'V-10363248', 'LUIS', 'DURAN', '', '0000-00-00', '', '', ''),
(61, 'V-12001696', 'MIRIAN', 'CHAVEZ', '', '0000-00-00', '', '', ''),
(62, 'V-18165666', 'ALVARO', 'TORRES', '', '0000-00-00', '', 'rosa75aron@gmail.com', ''),
(63, 'V-16011481', 'Klenniyer', 'Ramirez', 'masculino', '1981-10-09', '04165445268', 'rosa75aron@gmail.com', ''),
(64, 'V-14087957', 'DORKAS', 'MEZA', '', '0000-00-00', '', 'dorcasmeza@gmail.com', ''),
(65, 'V-21252457', 'MICHAEL', 'FLORES', '', '0000-00-00', '', 'gransacerdocio@gmail.com', ''),
(66, 'V-8585244', 'MARIA', 'GUEVARA', '', '0000-00-00', '', '', ''),
(67, 'V-8818284', 'YAJAIRA', 'BLANCO', '', '0000-00-00', '', 'anairobisblanco@hotmail.com', ''),
(68, 'V-9667941', 'CESAR', 'RANGEL', '', '0000-00-00', '', 'anairobisblanco@hotmail.com', ''),
(69, 'V-6040074', 'MARCELA', 'MARCANO', '', '0000-00-00', '', 'marcelamarcano@hotmail.com', ''),
(70, 'V-14086611', 'Marisela', 'Oropeza', 'masculino', '1977-02-10', '04267321809', 'mariseta_oropeza@hotmail.com', ''),
(71, 'V-3160909', 'ILDEMARO', 'VILLAMIZAR', '', '0000-00-00', '', '', ''),
(72, 'V-5624045', 'ELBA', 'GARCIA', '', '0000-00-00', '', 'elbacgross58@gmail.com', ''),
(73, 'V-8815217', 'WILLIAMS ', 'VILLAPAREDES', '', '0000-00-00', '', 'williamsvillaparedes@gmail.com', ''),
(74, 'V-12730973', 'LENNYS', 'CALVO', '', '0000-00-00', '', 'lennys21477@hotmail.com', ''),
(75, 'V-18147741', 'Yohana Lorena', 'Esaa Rojas', 'masculino', '1987-10-26', '04243390285', 'uderibas@gmail.com', ''),
(76, 'V-13908769', 'MHARILUIS', 'MEJIAS', '', '0000-00-00', '', 'mharifor1810@hotmail.com', ''),
(77, 'V-9658771', 'MENYS', 'ORTIZ', '', '0000-00-00', '', 'menysortiz@hotmai.com', ''),
(78, 'V-24344402', 'YOHALYS', 'DAZA', '', '0000-00-00', '', 'yoalys_13@hotmail.com', ''),
(79, 'V-26978950', 'JONAIRIT', 'FLORES', '', '0000-00-00', '', 'yonairitf@gmail.com', ''),
(80, 'V-16523644', 'EDISSON', 'DAZA', '', '0000-00-00', '', '', ''),
(81, 'V-11793207', 'AURA', 'MARTINEZ', '', '0000-00-00', '', 'cavaleria06@hotmail.com', ''),
(82, 'V-25448466', 'YORGELISS', 'BELLO', '', '0000-00-00', '', 'yorgeliss05@gmail.com', ''),
(83, 'V-8693257', 'BEATRIZ', 'LOPEZ', '', '0000-00-00', '', '', ''),
(84, 'V-3934558', 'LIZ MARIA', 'MARTINEZ', '', '0000-00-00', '', '', ''),
(127, 'V-21253028', 'Christian', 'Pires', 'masculino', '1993-05-12', '04128725723', 'chriss.pires.12@gmail.com', ''),
(86, 'V-13634553', 'ERICK', 'BETANCOURT', '', '0000-00-00', '', 'erickvictoria010@gmail.com', ''),
(126, 'V-8819893', 'Yamilet', 'Vivas', 'femenino', '1966-09-17', '04162475630', 'vivasyamileth@gmail.com', ''),
(88, 'V-13862794', 'CARLOS', 'ZAMBRANO', '', '0000-00-00', '', 'carlosjzambrano@gmail.com', ''),
(89, 'V-8819221', 'MARIA', 'GUILLEN', '', '0000-00-00', '', 'guillenm1@hotmail.com', ''),
(90, 'V-9226117', 'DAYI', 'VALERA', '', '0000-00-00', '', 'jeanneth9226@gmail.com', ''),
(91, 'V-15708578', 'REGULO', 'MARIN', '', '0000-00-00', '', 'regulo81@gmail.com', ''),
(92, 'V-12121647', 'NORKA', 'VERA', '', '0000-00-00', '', 'norkavergua@gmail.com', ''),
(93, 'V-3162793', 'RAFAEL', 'FLORES', '', '0000-00-00', '', '', ''),
(94, 'V-10358062', 'EDWIN', 'CEBALLOS', '', '0000-00-00', '', 'edwinj@yahoo.es', ''),
(95, 'V-7188413', 'RICHARD', 'CASTELLANOS', '', '0000-00-00', '', 'castellanosr_di@yahoo.es', ''),
(96, 'V-7474070', 'RAMON', 'GARCIA', '', '0000-00-00', '', 'ramongarciadiputado@hotmail.com', ''),
(97, 'V-20067073', 'GENESIS', 'ROJAS', '', '0000-00-00', '', 'genesisrojas_19@hotmail.com', ''),
(98, 'V-25364231', 'Jeniree', 'Areúrma', 'masculino', '1995-12-18', '02449895334', 'alejeniree92@gmail.com', ''),
(99, 'V-24923106', 'JOHANA', 'CASTILLO', '', '0000-00-00', '', '', ''),
(100, 'V-26148230', 'MARIA', 'CORTEZ', '', '0000-00-00', '', 'maria.cortez.rita@gmail.com', ''),
(101, 'V-25525013', 'YOEL', 'CASTILLO', '', '0000-00-00', '', 'yoeljoseitok150@hotmail.com', ''),
(102, 'V-19594034', 'KARLA', 'APONTE', '', '0000-00-00', '', 'karla_aponter@hotmail.com', ''),
(103, 'V-20592134', 'MARIANA', 'ALDANA', '', '0000-00-00', '', 'marianaaldana1992@gmail.com', ''),
(104, 'V-23603521', 'MARIELIS', 'RIVERO', '', '0000-00-00', '', 'marielisrive@outlook.com', ''),
(105, 'V-26855636', 'MARCO', 'TORRES', '', '0000-00-00', '', 'marcodavidtc@hotmail.com', ''),
(107, 'V-5624694', 'FLOR', 'REYES', '', '0000-00-00', '', 'rflorbeatriz@yahoo.es', ''),
(108, 'V-14087300', 'Solimar Magladys', 'Graterol Morales', 'masculino', '1975-11-17', '04266312032', 'bond_girls75@hotmail.com', ''),
(109, 'V-8694438', 'JOSE', 'RODRIGUEZ', '', '0000-00-00', '', 'josevicenterodran@hotmail.com', ''),
(110, 'V-16034552', 'GUALYS', 'MARTINEZ', '', '0000-00-00', '', 'gualism@hotmail.com', ''),
(111, 'V-9681091', 'JUAN', 'PRIETO', '', '0000-00-00', '', 'juancarlosprieto1971@hotmail.com', ''),
(112, 'V-13879632', 'ZULAY', 'LARREAL', '', '0000-00-00', '', 'zulaylarreal@hotmail.com', ''),
(113, 'V-23663243', 'JHOSMAR', 'CORRALES', '', '0000-00-00', '', 'jhosmar94@hotmail.com', ''),
(114, 'V-12334706', 'MARIA', 'GÓMEZ', '', '0000-00-00', '', '', ''),
(115, 'V-3334627', 'PEDRO', 'RIOS', '', '0000-00-00', '', '', ''),
(116, 'V-24924110', 'DANIELA', 'SERRANO', '', '0000-00-00', '', 'danilapeque18@gmail.com', ''),
(117, 'V-24924885', 'YOSMIR', 'HERNANDEZ', '', '0000-00-00', '', 'alejandrohernandez_r@hotmail.com', ''),
(118, 'V-21027570', 'JENIRETH', 'MATOS', '', '0000-00-00', '', 'jeni_yo1@hotmail.com', ''),
(119, 'V-26090936', 'JULIA', 'LINARES', '', '0000-00-00', '', 'sofialnrs@gmailcom', ''),
(120, 'V-25525759', 'ITALO', 'VERA', '', '0000-00-00', '', 'fanailtalo@hotmail.com', ''),
(121, 'V-15601549', 'ZORIMAR', 'DUDAMEL', '', '0000-00-00', '', 'lareina07@hotmail.com', ''),
(122, 'V-13499160', 'ROSA', 'OLIVEROS', '', '0000-00-00', '', '', ''),
(123, 'V-8686667', 'Luis Ramon', 'Fuente', 'masculino', '1964-08-01', '04167083542', 'fuenteslr@gmail.com', ''),
(124, 'V-12000698', 'AURA', 'HENRRIQUEZ', '', '0000-00-00', '', '', ''),
(125, 'V-15733780', 'AMERICA', 'HENRRIQUEZ', '', '0000-00-00', '', '', ''),
(136, 'V-8586118', 'Glendys', 'Muñoz', 'femenino', '1963-08-22', '04128489666', 'glendys69@gmail.com', ''),
(129, 'V-54321', 'Elba', 'Chacon', 'femenino', '1995-12-12', '04128318818', 'la picona', ''),
(130, 'V-25976446', 'Rodrigo', 'Colmenares', 'masculino', '1997-12-09', '04124535987', 'rodrigocolmenares0912@hotmail.com', ''),
(131, 'V-8692709', 'José Gregorio', 'Molina Romero', 'masculino', '1970-04-16', '04128888082', 'josemolina7096@gmail.com', ''),
(132, 'V-8585649', 'Douglas Jose', 'Figuera Gil', 'masculino', '1964-02-02', '04164398839', 'douglasjosefigueragil@gmail.com', ''),
(133, 'V-8812217', 'Williams Antonio', 'Villaparedes Alamo', 'masculino', '1967-04-26', '04121369318', 'williamsvillaparedes@gmail.com', ''),
(134, 'V-12482546', 'Yenny Beatriz', 'Gomez Esaa', 'masculino', '1976-06-21', '04149456229', 'emilitola@hotmail.com', ''),
(135, 'V-14389409', 'Yosmel', 'Mujica', 'masculino', '1978-08-03', '04243246184', 'emlitola@hotmail.com', ''),
(137, 'V-17050045', 'Gabriel', 'Vastag', 'masculino', '1983-01-05', '04164450456', 'gabrielvastag@gmail.com', ''),
(138, 'V-17715855', 'Francelys Mariam', 'Delgado Salazar', 'femenino', '1986-07-29', '04243782705', 'felmarisvd@gmail.com', ''),
(139, 'V-17715858', 'Miguel Alfonzo', 'Delgado Salazar', 'masculino', '1985-01-06', '04129673295', 'miguel_alfonzo_14@hotmail.com', ''),
(140, 'V-19410241', 'Diana', 'Laino', 'masculino', '1988-10-31', '04120508802', 'lainodiana|@Hotmail.com', ''),
(141, 'V-5280630', 'Rafael Aristides', 'Gonzalez', 'masculino', '1958-09-03', '04262414252', 'rafgarister@gmail.com', ''),
(142, 'V-24669897', 'Alberto Octavio', 'Pineda', 'masculino', '1946-05-17', '04124449996', 'albertoctaviopineda@gmail.com', ''),
(143, 'V-10625749', 'Freddy Jose', 'Alvarez Belisario', 'masculino', '1970-08-07', '04261361462', 'freddyjalvarez@hotmail.com', ''),
(144, 'V-7214411', 'Jorge David', 'Gomez Aliendo', 'masculino', '1962-11-23', '04123460829', 'gomezaliendojd@hotmail.com', ''),
(145, 'V-7274588', 'Francia', 'Reyes', 'masculino', '1966-03-29', '04167487782', 'franciareyes_@Hotmail.com', ''),
(146, 'V-20267222', 'David Alexander', 'Cordero Urbina', 'masculino', '1991-05-17', '04124871000', 'tacorod02@gmail.com', ''),
(147, 'V-14959841', 'Edwin Jose', 'Borges Sifuentes', 'masculino', '1979-04-01', '04243687096', 'edwin_jose1@hotmail.com', ''),
(148, 'V-23103521', 'Marielis Andreina', 'Rivero Rivero', 'femenino', '1994-04-17', '04124179592', 'marielisrivehotmail.com', ''),
(149, 'V-20592314', 'Mariana Del Carmen', 'Aldana Llanos', 'masculino', '1992-01-30', '04249313704', 'marianaaldana1992@gmail.com', ''),
(150, 'V-26855307', 'Kleiver Alexander', 'Guevera Liendo', 'masculino', '1999-08-28', '04162340369', 'kleiverguevara22@hotmail.com', ''),
(151, 'V-16346132', 'Angel Edden', 'Rodriguez Rengel', 'masculino', '1982-10-11', '04163388131', 'angel_edden21@hotmail.com', ''),
(152, 'V-24923173', 'Fabiana Alexandra', 'Ruberto Sanchez', 'femenino', '1995-08-02', '04263316883', 'fabii_ruberto@hotmail.com', ''),
(153, 'V-20770785', 'Maria De Los Angeles', 'Nieves De Rodriguez', 'femenino', '1982-12-15', '04264628306', 'angel.edden21@gmail.com', ''),
(154, 'V-8815545', 'Marlene', 'Pinto', 'femenino', '1967-02-22', '04124448791', 'pintomar22@gmail.com', ''),
(155, 'V-24388425', 'Luis Alejandro', 'Ugueto Escobar', 'masculino', '1995-08-04', '04262388985', 'blink242@outlook.com', ''),
(156, 'V-24343170', 'Sthefany Lissete', 'Gomez Tua', 'femenino', '1995-04-09', '04126722912', 'sther10_1995@hotmail.com', ''),
(157, 'V-8582086', 'Lilia Caridad', 'Lugo Flores', 'femenino', '1962-03-08', '04124453040', 'caridad_1962@hotmail.com', ''),
(158, 'V-7474040', 'Ramón', 'García', 'masculino', '1958-02-18', '04141449494', 'ramongarciadiputado@hotmail.com', ''),
(159, 'V-5979574', 'Raiza', 'Yanez Lopez', 'femenino', '1958-02-12', '04161469861', 'zairayanez1258@hotmail.com', ''),
(160, 'V-15733261', 'Antony Eleazar', 'Mayora Pariata', 'masculino', '1981-08-24', '04121323735', 'toros-coleados2010@hotmail.com', ''),
(161, 'V-23795244', 'Carlos Alberto', 'Fuentes Cobo', 'masculino', '1995-09-22', '04128809495', 'codefuentes@outlook.com', ''),
(162, 'V-25067745', 'Jesus Manuel', 'Ibarra Rojas', 'masculino', '1996-03-20', '04124164309', 'jesusmanuelir@gmail.com', ''),
(163, 'V-16760183', 'Aldley Rafaela', 'Algara Martinez', 'femenino', '1982-11-29', '04125091274', 'aldleyalgara@hotmail.com', ''),
(164, 'V-20057901', 'Victor Jose', 'Corzo Valencia', 'masculino', '1991-12-01', '04128318818', 'vittodub@gmail.com', ''),
(165, 'V-17176642', 'Karina Alexandra', 'Rivas Gomez', 'femenino', '1985-10-20', '04167472466', 'karinavnzl@gmail.com', ''),
(166, 'V-6931468', 'Jimy Virgilio', 'Santana Cantos', 'masculino', '1965-06-28', '04166427321', 'jimysantana@gmail.com', ''),
(167, 'V-11178569', 'Yusmara Alejandra', 'Mijares Barrios', 'femenino', '1970-09-25', '04124170305', 'marax057@hormail.com', ''),
(168, 'V-8586097', 'Arcelis', 'Martínez', 'femenino', '1963-11-05', '04129408088', 'aramarmartinez@hotmail.com', ''),
(169, 'V-19595081', 'Adonis', 'Esquea', 'masculino', '1989-09-28', '04162466097', 'adonisesquea@gmail.com', ''),
(170, 'V-18163228', 'Jesus', 'Saturno', 'masculino', '1987-01-22', '04144448888', 'jalejandrosg@gmail.com', ''),
(171, 'V-21027828', 'Francis', 'Montes De Oca', 'femenino', '1993-01-19', '04263318393', 'frann01_19@hotmail.com', ''),
(172, 'V-24669300', 'Laura', 'Prieto', 'femenino', '1994-06-06', '04120446976', 'laurapaola39@hotmail.com', ''),
(173, 'V-26192094', 'Francisco', 'Godoy', 'masculino', '1995-07-03', '04128537322', 'eliasg232@hotmail.com', ''),
(174, 'V-25873203', 'Deivis', 'Hernandez', 'masculino', '1997-01-23', '04128439473', 'elmenor10@hotmail.com', ''),
(175, 'V-11120169', 'Olivia', 'Mota', 'femenino', '1974-06-05', '04162440377', 'mota2505@hotmail.com', ''),
(176, 'V-11240893', 'Ricardo', 'Tovar', 'masculino', '1974-07-13', '04166432963', 'ricardochaparroinia@gmail.com', ''),
(177, 'V-24923246', 'Cesar', 'Eduardo', 'masculino', '1994-06-29', '04125060155', 'cesarvillalba569@gmail.com', ''),
(178, 'V-21602469', 'Eli', 'Tovar', 'masculino', '1994-10-11', '04162460694', 'eli.j.tovar1110@hotmail.com', ''),
(179, 'V-19993935', 'Kenneth', 'Praolini', 'masculino', '1992-06-11', '04265191061', 'kennethprao23@gmail.com', ''),
(180, 'V-22339678', 'John', 'Baddour', 'masculino', '1994-03-14', '04243768994', 'jhonjbm@gmail.com', ''),
(181, 'V-25364697', 'Ydanellys', 'Guerrero', 'femenino', '1996-05-27', '04124601947', 'ydanellys@gmail.com', ''),
(182, 'V-5628460', 'Pablo', 'Carlin', 'masculino', '1960-08-03', '04128888888', 'pablovic1@cantv.net', ''),
(183, 'V-25873036', 'Enmanuel', 'Ramirez', 'masculino', '1995-09-23', '04165413628', 'theenmanuelrmrz@gmail.com', ''),
(184, 'V-3842286', 'Alicia', 'Vasquez', 'femenino', '1954-08-03', '04129403491', 'amachadovjr@yahoo.com', ''),
(185, 'V-23791062', 'Adriana', 'Rivas', 'femenino', '1994-02-02', '04167451648', 'adrianarivas441@gmail.com', ''),
(186, 'V-26003296', 'Jeferson', 'Castro', 'masculino', '1998-02-13', '04269323398', 'jepis98@gmail.com', ''),
(187, 'V-15999945', 'Samuel', 'Romero', 'masculino', '1983-11-20', '04166431370', 'sarlincon@hotmail.com', ''),
(188, 'V-24924790', 'Simon', 'Blanco', 'masculino', '1995-05-26', '04121490066', 'gasperboom79@gmail.com', ''),
(189, 'V-24924913', 'Victor', 'Chati', 'masculino', '1996-05-04', '04243757538', 'victorchati17@gmail.com', ''),
(190, 'V-25618653', 'Armando', 'Gonzalez', 'masculino', '1997-05-19', '04269326257', 'armando_j97@hotmaill.com', ''),
(191, 'V-24924412', 'Daniel', 'Uzcategui', 'masculino', '1996-08-14', '04125311610', 'danieluzcategui2008@hotmail.com', ''),
(192, 'V-17052762', 'Yoheli', 'Salcedo', 'femenino', '1986-09-19', '04121452802', 'yohelismf@gmail.com', ''),
(193, 'V-17717888', 'Karina', 'Camargo', 'femenino', '1988-04-21', '04243438776', 'karivivi12@hotmail.com', ''),
(194, 'V-12480087', 'Ana', 'Garcia', 'femenino', '1976-11-28', '04165100184', 'anaupta@gmail.com', ''),
(195, 'V-23785396', 'Gabrielys', 'Perez', 'femenino', '1996-08-17', '04165147811', 'gaby.gaby1708@hotmail.com', ''),
(196, 'V-20244717', 'Ricardo', 'Paez', 'masculino', '1991-03-16', '04128300386', 'ricardopaez321@gmail.com', ''),
(197, 'V-23795620', 'Francisco', 'Perez', 'masculino', '1994-05-27', '04269458364', 'perez12fran10@gmail.com', ''),
(198, 'V-25070403', 'Jean', 'Milano', 'masculino', '1994-11-01', '04264318834', 'versimilius@hotmail.com', ''),
(199, 'V-26349335', 'Emilbeth', 'Teran', 'femenino', '1997-01-04', '04123451662', 'emilbethteran@gmail.com', ''),
(200, 'V-24924056', 'Lorena', 'Sanchez', 'femenino', '1995-09-16', '04125127296', 'sanchezlorena607@gmail.com', ''),
(201, 'V-23627784', 'Luis', 'Acosta', 'masculino', '1995-10-16', '04243443307', 'acosta.luism6@gmail.com', ''),
(202, 'V-22504753', 'Gisel', 'Ovando', 'femenino', '1995-03-15', '04261437654', 'ovandogisel1@gmail.com', ''),
(203, 'V-21252491', 'Carlos', 'Fuentes', 'masculino', '1995-09-22', '04128809495', 'La haciendita, Cagua', 'asdf@ot.c'),
(204, 'V-123123', 'Armando Esteban', 'Quito', 'masculino', '2016-03-21', '11231231231', 'asdfasdg', 'asf@s.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_completo` varchar(50) NOT NULL,
  `usuario` varchar(10) NOT NULL,
  `clave` varchar(16) NOT NULL,
  `permisos` varchar(50) NOT NULL,
  `estado` enum('activo','bloqueado','restablecer') NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_completo`, `usuario`, `clave`, `permisos`, `estado`) VALUES
(1, 'Yamilet Vivas', 'yamilet', 'asdasd', 'admin', 'activo'),
(2, 'Cesar Mosquera', 'Cesar', '654321', 'cursos,personas,documentos,impresiones', 'activo'),
(3, 'Ruben Santana', 'ruben', '123456', 'personas,impresiones', 'activo'),
(4, 'Gabriel Vastag', 'gabriel', '147258', 'cursos,documentos', 'activo'),
(5, 'uptavsuno', 'uptavs1', 'uptavs1', 'cursos,personas,documentos,impresiones', 'activo'),
(6, 'uptavsdos', 'uptavs2', 'uptavs2', 'cursos,personas,documentos,impresiones', 'activo'),
(7, 'uptavstres', 'uptavs3', 'uptavs3', 'cursos,personas,documentos,impresiones', 'activo'),
(8, 'uptavscuatro', 'uptavs4', 'uptavs4', 'cursos,personas,documentos,impresiones', 'activo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `certificados`
--
ALTER TABLE `certificados`
  ADD PRIMARY KEY (`id_certificado`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id_curso`);

--
-- Indices de la tabla `ediciones`
--
ALTER TABLE `ediciones`
  ADD PRIMARY KEY (`id_edicion`);

--
-- Indices de la tabla `identificadores`
--
ALTER TABLE `identificadores`
  ADD PRIMARY KEY (`id_identificador`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id_persona`),
  ADD UNIQUE KEY `documento` (`documento`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `certificados`
--
ALTER TABLE `certificados`
  MODIFY `id_certificado` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `ediciones`
--
ALTER TABLE `ediciones`
  MODIFY `id_edicion` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `identificadores`
--
ALTER TABLE `identificadores`
  MODIFY `id_identificador` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=205;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
