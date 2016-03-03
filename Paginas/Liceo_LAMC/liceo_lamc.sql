-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-07-2014 a las 20:08:06
-- Versión del servidor: 5.5.27
-- Versión de PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `liceo_lamc`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ae`
--

CREATE TABLE IF NOT EXISTS `ae` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_ae` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `fechai_ae` date NOT NULL,
  `fechac_ae` date NOT NULL,
  `est` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `ae`
--

INSERT INTO `ae` (`id`, `nombre_ae`, `fechai_ae`, `fechac_ae`, `est`) VALUES
(1, '2013-2014', '2014-06-25', '2014-06-28', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dis_profesor`
--

CREATE TABLE IF NOT EXISTS `dis_profesor` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `d_lunesd` time NOT NULL,
  `d_lunesh` time NOT NULL,
  `d_martesd` time NOT NULL,
  `d_martesh` time NOT NULL,
  `d_miercolesd` time NOT NULL,
  `d_miercolesh` time NOT NULL,
  `d_juevesd` time NOT NULL,
  `d_juevesh` time NOT NULL,
  `d_viernesd` time NOT NULL,
  `d_viernesh` time NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `dis_profesor`
--

INSERT INTO `dis_profesor` (`ID`, `d_lunesd`, `d_lunesh`, `d_martesd`, `d_martesh`, `d_miercolesd`, `d_miercolesh`, `d_juevesd`, `d_juevesh`, `d_viernesd`, `d_viernesh`) VALUES
(2, '23:00:00', '23:00:00', '23:00:00', '18:00:00', '00:00:00', '23:00:00', '20:00:00', '16:00:00', '01:00:00', '20:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `d_documentos`
--

CREATE TABLE IF NOT EXISTS `d_documentos` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `partida_o` enum('SI','NO') COLLATE utf8_unicode_ci DEFAULT NULL,
  `c_partida` enum('SI','NO') COLLATE utf8_unicode_ci DEFAULT NULL,
  `ced_ma` enum('SI','NO') COLLATE utf8_unicode_ci DEFAULT NULL,
  `ced_pa` enum('SI','NO') COLLATE utf8_unicode_ci DEFAULT NULL,
  `ced_re` enum('SI','NO') COLLATE utf8_unicode_ci DEFAULT NULL,
  `ced_es` enum('SI','NO') COLLATE utf8_unicode_ci DEFAULT NULL,
  `boleta` enum('SI','NO') COLLATE utf8_unicode_ci DEFAULT NULL,
  `foto_es` enum('SI','NO') COLLATE utf8_unicode_ci DEFAULT NULL,
  `foto_re` enum('SI','NO') COLLATE utf8_unicode_ci DEFAULT NULL,
  `notas` enum('SI','NO') COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo_notas` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `otros` enum('SI','NO') COLLATE utf8_unicode_ci DEFAULT NULL,
  `pendiente` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `f_entrega` date NOT NULL,
  `obser_do` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `d_documentos`
--

INSERT INTO `d_documentos` (`ID`, `partida_o`, `c_partida`, `ced_ma`, `ced_pa`, `ced_re`, `ced_es`, `boleta`, `foto_es`, `foto_re`, `notas`, `tipo_notas`, `otros`, `pendiente`, `f_entrega`, `obser_do`) VALUES
(1, '', '', '', '', '', '', '', '', '', '', 'Copia', '', 'cedula estudiante', '0000-00-00', 'ninguna					'),
(2, '', '', '', '', '', '', '', '', '', '', 'Original', '', '', '0000-00-00', 'niniguna					'),
(3, '', '', '', '', '', '', '', '', '', '', 'Original', '', '', '0000-00-00', 'niniguna					');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `d_especialidad_pr`
--

CREATE TABLE IF NOT EXISTS `d_especialidad_pr` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `grain_pr` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `esp1_pr` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `esp2_pr` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `mat1_pr` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `mat2_pr` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `esac_pr` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `tiob_pr` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `teoi_pr` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `dicu_pr` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `ci_pr` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ci_pr` (`ci_pr`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `d_especialidad_pr`
--

INSERT INTO `d_especialidad_pr` (`ID`, `grain_pr`, `esp1_pr`, `esp2_pr`, `mat1_pr`, `mat2_pr`, `esac_pr`, `tiob_pr`, `teoi_pr`, `dicu_pr`, `ci_pr`) VALUES
(1, 'profesor', 'fisica', '', 'matematica', 'fisica', 'no', '', 'si', 'E.T. "Jacob Perez Carballo', '7273659'),
(2, 'Postgrado', 'ethbebtehbteb', 'thbtehbtebe', 'thbtebteb', 'hbetbettebet', 'No', '', 'No', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `d_estudiante`
--

CREATE TABLE IF NOT EXISTS `d_estudiante` (
  `ci_es` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `doc_es` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `ape_es` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `nom_es` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `sex_es` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `fechanac_es` date NOT NULL,
  `edad_es` int(2) NOT NULL,
  `lugarnac_es` varchar(18) COLLATE utf8_unicode_ci NOT NULL,
  `vive_es` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `vive_e_es` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `direc_es` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fechain_es` date NOT NULL,
  `obser_es` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ci_es`),
  UNIQUE KEY `ci_es` (`ci_es`),
  UNIQUE KEY `ci_es_2` (`ci_es`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `d_estudiante`
--

INSERT INTO `d_estudiante` (`ci_es`, `doc_es`, `ape_es`, `nom_es`, `sex_es`, `fechanac_es`, `edad_es`, `lugarnac_es`, `vive_es`, `vive_e_es`, `direc_es`, `fechain_es`, `obser_es`) VALUES
('22285281', 'V', 'blanco', 'omar', 'Masculino', '1994-08-13', 19, 'maracay', 'Ambos', 'padre,madre, hermana', 'mi casa	', '2014-06-27', 'ninguna		ertwg5v		'),
('22285282', 'V', 'nuñes', 'alberto', 'Masculino', '1993-11-03', 21, 'delta Amacuro', 'Abuelos', 'Abuela', 'su casa							', '2014-06-30', 'ninguna							'),
('23596741', 'V', 'jose', 'alvarez', 'Masculino', '1995-02-14', 18, 'Valencia', 'Madre', 'madre', 'su casa							', '2014-06-30', 'ninguna							');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `d_madre`
--

CREATE TABLE IF NOT EXISTS `d_madre` (
  `ci_m` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `doc_m` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `nombre_m` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `apellido_m` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `fechan_m` date NOT NULL,
  `grado_in_m` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ocupacion_m` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ltrabajo_m` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `telf_m` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `origen_m` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ec_m` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `direccion_m` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `grupo_fm` varchar(2) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `d_madre`
--

INSERT INTO `d_madre` (`ci_m`, `doc_m`, `nombre_m`, `apellido_m`, `fechan_m`, `grado_in_m`, `ocupacion_m`, `ltrabajo_m`, `telf_m`, `origen_m`, `ec_m`, `direccion_m`, `grupo_fm`) VALUES
('7211821', 'V', 'rosirys josefina', 'escorche castro', '1962-12-22', 'Bachiller', '', 'hogar', '1111111', 'aragua', 'Casado', 'su casa								', 'Si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `d_padre`
--

CREATE TABLE IF NOT EXISTS `d_padre` (
  `ci_p` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `doc_p` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `nombre_p` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `apellido_p` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `fechan_p` date NOT NULL,
  `grado_in_p` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `ocupacion_p` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ltrabajo_p` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `telf_p` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `origen_p` varchar(18) COLLATE utf8_unicode_ci NOT NULL,
  `ec_p` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `direccion_p` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `grupo_fp` varchar(2) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `d_padre`
--

INSERT INTO `d_padre` (`ci_p`, `doc_p`, `nombre_p`, `apellido_p`, `fechan_p`, `grado_in_p`, `ocupacion_p`, `ltrabajo_p`, `telf_p`, `origen_p`, `ec_p`, `direccion_p`, `grupo_fp`) VALUES
('7273659', 'V', 'omar celestino', 'blanco gotto', '1967-09-20', 'Licenciado', 'Profesor', 'U.E.N. "luis augusto machado cisner', '4684654', 'aragua', 'Casado', 'su casa						', 'Si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `d_profesor`
--

CREATE TABLE IF NOT EXISTS `d_profesor` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ci_pr` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `doc_pr` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `ape_pr` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `nom_pr` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `fec_pr` date NOT NULL,
  `lug_pr` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `sex_pr` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `esci_pr` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `pohi_pr` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `cua_pr` int(2) NOT NULL,
  `dire_pr` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `teca_pr` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `tece_pr` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `coel_pr` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ci_pr` (`ci_pr`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `d_profesor`
--

INSERT INTO `d_profesor` (`ID`, `ci_pr`, `doc_pr`, `ape_pr`, `nom_pr`, `fec_pr`, `lug_pr`, `sex_pr`, `esci_pr`, `pohi_pr`, `cua_pr`, `dire_pr`, `teca_pr`, `tece_pr`, `coel_pr`) VALUES
(1, '05651646', 'V', 'jose', 'lopez', '1976-07-15', 'maracay - edo. aragua', 'Masculino', 'Soltero', 'Si', 3, 'su casa thrthr uhkascjksdbgcfjgh', '2462345625', '5416252565', 'hola@hotmail.com'),
(2, '45278787', 'V', 'jose', 'lopez', '1976-07-15', 'maracay - edo. aragua', 'Masculino', 'Soltero', 'Si', 3, 'su casa thrthr', '2462345625', '5416252565', 'hola@hotmail.com'),
(4, '7273659', 'V', 'omar', 'blanco', '1967-09-20', 'maracay - edo. aragua', 'Masculino', 'Casado', 'Si', 2, 'su casa en maracay', '02432360316', '04161378596', 'omar@hotmail.com'),
(5, 'tcunuj', 'V', 'ctubun', 'ctujun', '2014-07-13', 'tucnjujnujnc', 'Masculino', 'Soltero', 'No', 0, 'tcujnjkmkio,itswawtvtvthbb', 'tbehbetb', 'etbhbtebte', 'bhtebhetbthtbebht');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `d_representante`
--

CREATE TABLE IF NOT EXISTS `d_representante` (
  `ci_r` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `doc_r` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_r` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `nombre_r` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `apellido_r` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `fechan_r` date NOT NULL,
  `grado_in_r` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ocupacion_r` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `ltrabajo_r` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `telf_r` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `origen_r` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `ec_r` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `direccion_r` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `grupo_fr` varchar(2) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `d_representante`
--

INSERT INTO `d_representante` (`ci_r`, `doc_r`, `tipo_r`, `nombre_r`, `apellido_r`, `fechan_r`, `grado_in_r`, `ocupacion_r`, `ltrabajo_r`, `telf_r`, `origen_r`, `ec_r`, `direccion_r`, `grupo_fr`) VALUES
('56846465', 'V', 'Otro', 'fuyui', 'ftitiiy', '2014-06-27', 'Ingeniero', 'tyu', 'itytiti', '5546767', 'klgñlergfoernh', 'Divorciad', 'qjniwerfuhbf						', 'No'),
('7211821', 'V', 'Madre', 'rosirys', 'escorche', '1968-12-22', 'Primaria', 'ama de casa', 'su casa', '2360316', 'Maracay Edo. Aragua', 'Soltero', 'su casa							', 'Si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `d_socio-economico`
--

CREATE TABLE IF NOT EXISTS `d_socio-economico` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `adultos_m` int(2) NOT NULL,
  `adultos_f` int(2) NOT NULL,
  `adoles_m` int(2) NOT NULL,
  `adoles_f` int(2) NOT NULL,
  `nino_m` int(2) NOT NULL,
  `nina_f` int(2) NOT NULL,
  `adultos_mm` int(2) NOT NULL,
  `adultos_mf` int(2) NOT NULL,
  `t_familia` int(2) NOT NULL,
  `tipo_casa` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `te_casa` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `mision_v` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `cod_mv` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `mision_bo` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `beneficio` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ingre_fa` int(8) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inasis_pr`
--

CREATE TABLE IF NOT EXISTS `inasis_pr` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ci_pr` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `doc_pr` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `ape_pr` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `nom_pr` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `fecinas_pr` date NOT NULL,
  `jus_pr` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `motina_pr` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ci_pr` (`ci_pr`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `inasis_pr`
--

INSERT INTO `inasis_pr` (`ID`, `ci_pr`, `doc_pr`, `ape_pr`, `nom_pr`, `fecinas_pr`, `jus_pr`, `motina_pr`) VALUES
(1, '22285281', 'V', 'blanco', 'omar', '2014-07-14', 'Justificada', 'consulta con el ortodoncista');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

CREATE TABLE IF NOT EXISTS `materia` (
  `cod_mate` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `nom_mate` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `anio_mate` varchar(1) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso_pr`
--

CREATE TABLE IF NOT EXISTS `permiso_pr` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ci_pr` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `doc_pr` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `ape_pr` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `nom_pr` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `gra_pr` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `supro_pr` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `rem_pr` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `fecper_pr` date NOT NULL,
  `motper_pr` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ci_pr` (`ci_pr`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `permiso_pr`
--

INSERT INTO `permiso_pr` (`ID`, `ci_pr`, `doc_pr`, `ape_pr`, `nom_pr`, `gra_pr`, `supro_pr`, `rem_pr`, `fecper_pr`, `motper_pr`) VALUES
(1, '22289141', 'V', 'torres ', 'armando', '8º B', 'ninguno', 'No Remunerado', '2014-07-14', 'se va pal peru');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reposo_pr`
--

CREATE TABLE IF NOT EXISTS `reposo_pr` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ci_pr` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `doc_pr` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `ape_pr` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `nom_pr` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `orex_pr` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fecin_pr` date NOT NULL,
  `feccul_pr` date NOT NULL,
  `rein_pr` date NOT NULL,
  `des_pr` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ci_pr` (`ci_pr`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `reposo_pr`
--

INSERT INTO `reposo_pr` (`ID`, `ci_pr`, `doc_pr`, `ape_pr`, `nom_pr`, `orex_pr`, `fecin_pr`, `feccul_pr`, `rein_pr`, `des_pr`) VALUES
(1, '22285281', 'V', 'blanco', 'omar', 'XD', '2014-07-01', '2014-07-31', '2014-08-04', '=O');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `retardo_pr`
--

CREATE TABLE IF NOT EXISTS `retardo_pr` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ci_pr` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `doc_pr` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `ape_pr` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `nom_pr` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `hoen_pr` time NOT NULL,
  `holle_pr` time NOT NULL,
  `fecret_pr` date NOT NULL,
  `motret_pr` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `doc_pr` (`doc_pr`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `retardo_pr`
--

INSERT INTO `retardo_pr` (`ID`, `ci_pr`, `doc_pr`, `ape_pr`, `nom_pr`, `hoen_pr`, `holle_pr`, `fecret_pr`, `motret_pr`) VALUES
(1, '22956576', 'V', 'ramirez', 'lisnery', '07:30:00', '08:15:00', '2014-07-17', 'se fue con el narizon');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secciones`
--

CREATE TABLE IF NOT EXISTS `secciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grado` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `seccion` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `capacidad` int(11) NOT NULL,
  `aula` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `secciones`
--

INSERT INTO `secciones` (`id`, `grado`, `seccion`, `capacidad`, `aula`) VALUES
(1, '6', 'A', 25, 'B1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `n_usuario` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `contrasena` varchar(18) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `n_usuario`, `contrasena`, `tipo`) VALUES
(1, 'omar', '1994', 'ADMINISTRADOR');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
