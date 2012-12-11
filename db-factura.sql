-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-11-2012 a las 20:54:26
-- Versión del servidor: 5.5.19
-- Versión de PHP: 5.4.0RC4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `db-factura`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra_factura`
--

CREATE TABLE IF NOT EXISTS `compra_factura` (
  `id_factura` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `num_factura` int(11) NOT NULL,
  KEY `id_factura` (`id_factura`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compra_factura`
--

INSERT INTO `compra_factura` (`id_factura`, `id_usuario`, `num_factura`) VALUES
(1, 2, 100000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadisticas`
--

CREATE TABLE IF NOT EXISTS `estadisticas` (
  `id_indicador` int(11) NOT NULL AUTO_INCREMENT,
  `inscritos_primer_cuatrimestre` int(11) NOT NULL,
  `solicitantes_exani2` int(11) NOT NULL,
  `alumnos_dados_baja` int(11) NOT NULL,
  `total_matriculados` int(11) NOT NULL,
  `total_reprobados` int(11) NOT NULL,
  `total_egresados` int(11) NOT NULL,
  `total_ingresados` int(11) NOT NULL,
  PRIMARY KEY (`id_indicador`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `estadisticas`
--

INSERT INTO `estadisticas` (`id_indicador`, `inscritos_primer_cuatrimestre`, `solicitantes_exani2`, `alumnos_dados_baja`, `total_matriculados`, `total_reprobados`, `total_egresados`, `total_ingresados`) VALUES
(1, 150, 203, 13, 160, 6, 60, 150),
(2, 134, 213, 4, 144, 7, 55, 134),
(3, 146, 221, 5, 156, 4, 66, 146),
(4, 132, 190, 7, 142, 8, 45, 132),
(5, 166, 177, 9, 177, 9, 77, 166),
(6, 123, 155, 3, 132, 3, 66, 123),
(7, 164, 188, 5, 175, 6, 55, 164),
(8, 147, 176, 8, 157, 8, 77, 147),
(9, 175, 192, 11, 187, 5, 56, 175),
(10, 134, 162, 5, 144, 7, 77, 134),
(11, 135, 184, 3, 146, 8, 66, 135),
(12, 166, 177, 6, 177, 9, 88, 166);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE IF NOT EXISTS `facturas` (
  `id_factura` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `nombre_fact` varchar(100) NOT NULL,
  `ruta` varchar(100) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `fecha_compra` date NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `status_compra` int(11) NOT NULL,
  PRIMARY KEY (`id_factura`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`id_factura`, `id_usuario`, `nombre_fact`, `ruta`, `fecha_creacion`, `fecha_compra`, `precio`, `status_compra`) VALUES
(1, 2, 'Factura 1', '', '2012-11-01', '2012-11-02', '199.00', 1),
(2, 2, 'Factura 2', '', '2012-11-04', '2012-11-05', '199.00', 0),
(3, 2, 'Factura 3', '', '2012-11-13', '2012-11-13', '199.00', 0),
(4, 2, 'Factura 4', '', '2012-11-13', '2012-11-14', '199.00', 0),
(5, 2, 'Factura 5', '', '2012-11-16', '2012-11-17', '199.00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresos`
--

CREATE TABLE IF NOT EXISTS `ingresos` (
  `id_ingreso` bigint(50) NOT NULL AUTO_INCREMENT,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_ingreso`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=63 ;

--
-- Volcado de datos para la tabla `ingresos`
--

INSERT INTO `ingresos` (`id_ingreso`, `fecha`, `usuario`) VALUES
(1, '2012-08-16 08:41:12', 5),
(2, '2012-08-16 08:42:34', 5),
(3, '2012-08-16 08:43:39', 5),
(4, '2012-08-16 08:45:02', 9),
(5, '2012-08-16 21:13:32', 4),
(6, '2012-08-17 00:25:27', 4),
(7, '2012-08-17 00:31:26', 4),
(8, '2012-08-17 04:19:04', 4),
(9, '2012-08-17 11:07:08', 5),
(10, '2012-08-17 11:14:18', 9),
(11, '2012-08-17 11:19:04', 5),
(12, '2012-08-17 11:22:39', 9),
(13, '2012-08-17 13:11:11', 6),
(14, '2012-08-17 15:57:19', 5),
(15, '2012-08-17 16:00:08', 6),
(16, '2012-08-17 16:13:58', 5),
(17, '2012-08-17 16:27:46', 5),
(18, '2012-08-17 16:31:38', 6),
(19, '2012-08-17 20:31:22', 4),
(20, '2012-08-17 20:34:01', 4),
(21, '2012-08-17 21:33:55', 4),
(22, '2012-08-17 21:35:59', 9),
(23, '2012-08-17 21:52:50', 4),
(24, '2012-08-17 23:27:20', 4),
(25, '2012-10-02 22:32:32', 2),
(26, '2012-10-02 22:33:18', 1),
(27, '2012-10-02 22:33:54', 2),
(28, '2012-10-02 22:38:07', 6),
(29, '2012-10-02 23:01:33', 2),
(30, '2012-10-02 23:08:46', 2),
(31, '2012-10-15 02:56:35', 2),
(32, '2012-10-15 02:59:41', 2),
(33, '2012-10-15 03:02:48', 4),
(34, '2012-10-15 03:50:04', 4),
(35, '2012-10-30 01:02:42', 5),
(36, '2012-10-30 01:03:26', 2),
(37, '2012-11-13 00:54:48', 5),
(38, '2012-11-22 00:25:31', 5),
(39, '2012-11-22 00:35:34', 2),
(40, '2012-11-22 00:38:35', 2),
(41, '2012-11-22 00:39:23', 5),
(42, '2012-11-22 01:02:16', 5),
(43, '2012-11-22 01:03:43', 2),
(44, '2012-11-22 04:24:22', 2),
(45, '2012-11-22 04:35:54', 2),
(46, '2012-11-22 04:55:16', 2),
(47, '2012-11-22 09:30:09', 3),
(48, '2012-11-22 09:31:32', 2),
(49, '2012-11-22 09:43:29', 2),
(50, '2012-11-22 09:49:35', 2),
(51, '2012-11-22 10:02:39', 3),
(52, '2012-11-22 10:08:38', 2),
(53, '2012-11-22 10:10:24', 3),
(54, '2012-11-22 10:18:52', 2),
(55, '2012-11-22 10:27:47', 3),
(56, '2012-11-22 10:30:52', 2),
(57, '2012-11-22 10:31:12', 3),
(58, '2012-11-22 10:38:14', 2),
(59, '2012-11-22 10:49:10', 2),
(60, '2012-11-22 11:08:38', 2),
(61, '2012-11-22 18:03:58', 2),
(62, '2012-11-22 18:07:50', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `intrusos`
--

CREATE TABLE IF NOT EXISTS `intrusos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `usuario` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `ip` varchar(14) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `intrusos`
--

INSERT INTO `intrusos` (`id`, `fecha`, `usuario`, `password`, `ip`) VALUES
(1, '2012-08-17 21:35:44', 'alumnos', '123456', '127.0.0.1'),
(2, '2012-10-02 22:33:04', 'MANAGER', 'MANAGER', '127.0.0.1'),
(3, '2012-10-15 02:55:51', 'juanito', '', '127.0.0.1'),
(4, '2012-10-15 03:02:39', 'marcelo', '12345', '127.0.0.1'),
(5, '2012-11-22 00:32:44', 'juanito', '123456', '127.0.0.1'),
(6, '2012-11-22 00:33:20', 'juanito', '123456', '127.0.0.1'),
(7, '2012-11-22 00:34:13', 'claudia', '123456', '127.0.0.1'),
(8, '2012-11-22 00:35:49', 'juanito', '123456', '127.0.0.1'),
(9, '2012-11-22 10:10:17', 'marco', 'marco', '127.0.0.1'),
(10, '2012-11-22 10:38:00', 'juanito', 'juanito', '127.0.0.1'),
(11, '2012-11-22 10:48:06', 'sd', 'sdf', '127.0.0.1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(11) NOT NULL,
  `password` char(11) NOT NULL,
  `tipo` char(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `ap_paterno` varchar(30) NOT NULL,
  `ap_materno` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `password`, `tipo`, `nombre`, `ap_paterno`, `ap_materno`, `email`) VALUES
(1, 'MANAGER', '123456', 'A0x1', 'FabiÃ¡n', 'Muñoz', 'Flores', ''),
(2, 'juanito', '123456', 'P0x1', 'Juan Bruno', 'DÃ­az', 'GarcÃ­a', 'jDiaz@hotmail.com'),
(3, 'marco', '123456', 'P0x1', 'Marco Feito', 'Gonzales', 'Flores', 'mGonzales@hotmail.com'),
(4, 'marcelo', '123456', 'P0x1', 'Marcelo', 'Covarrubia', 'Corage', 'mCova@hotmail.com'),
(5, 'claudia', '123456', 'P0x1', 'Claudia Mayra', 'Sahagun', 'Barrios', 'csahagun@hotmai.com'),
(6, 'alumno', '123456', 'P0x2', 'Lucho Alfredo', 'Mardones', 'Flores', 'luchito_22@hotmail.com'),
(7, 'macaro', '123456', 'P0x2', 'Marco Antonio', 'Figueroa', 'Guitierrez', ''),
(8, 'Laelia', '123456', 'P0x2', 'Laelia', 'Mayonga', 'Correa', ''),
(9, 'Evelia', '123456', 'P0x2', 'Evelia', 'Haro', 'Salcedo', ''),
(10, 'Edelmiro', '123456', 'P0x2', 'Edelmiro', 'Corona', 'Venegas', ''),
(11, 'Mamerto', '123456', 'P0x2', 'Mamerto', 'Garza', 'Montemayor', ''),
(12, 'Joselin', '123456', 'P0x2', 'Joselin', 'Lebron', 'Prado', ''),
(13, 'Pedro', '123456', 'P0x2', 'Pedro', 'Granado', 'Cotto', ''),
(14, 'Tabare', '123456', 'P0x2', 'Tabare', 'Alcala', 'Aparicio', ''),
(15, 'Valeska', '123456', 'P0x2', 'Valeska', 'Covarrubias', 'Terrazas', ''),
(16, 'Kurt', '123456', 'P0x2', 'Kurt', 'Colunga', 'Rubio', ''),
(17, 'Fusiano', '123456', 'P0x2', 'Fusiano', 'Meraz', 'Girón', ''),
(18, 'Lotario', '123456', 'P0x2', 'Lotario', 'Zamudio', 'Rubio', ''),
(19, 'Adena', '123456', 'P0x2', 'Adena', 'Mora', 'Haro', ''),
(20, 'Rinaldo', '123456', 'P0x2', 'Rinaldo', 'Calvillo', 'Meza', ''),
(21, 'Geppeto', '123456', 'P0x2', 'Geppeto', 'Zaragoza', 'Contreras', ''),
(22, 'Leylen', '123456', 'P0x2', 'Leylen', 'Palomo', 'Lebron', ''),
(23, 'Rosina', '123456', 'P0x2', 'Rosina', 'Regalado', 'Betancourt', ''),
(24, 'Siro', '123456', 'P0x2', 'Siro', 'Gonzales', 'Esquivel', ''),
(25, 'Talia', '123456', 'P0x2', 'Talia', 'Trejo', 'Godoy', ''),
(26, 'Adrian', '123456', 'P0x2', 'Adrian', 'Duenas', 'Apodaca', ''),
(27, 'Ald', '123456', 'P0x2', 'Ald', 'Murillo', 'Valdivia', ''),
(28, 'Neera', '123456', 'P0x2', 'Neera', 'Alicea', 'Torres', ''),
(29, 'Audomaro', '123456', 'P0x2', 'Audomaro', 'Lucero', 'Velazquez', ''),
(30, 'Casimiro', '123456', 'P0x2', 'Casimiro', 'Martinez', 'Mendez', ''),
(31, 'Pehuen', '123456', 'P0x2', 'Pehuen', 'Salinas', 'Carrera', ''),
(32, 'Rosicler', '123456', 'P0x2', 'Rosicler', 'Lujan', 'Marquez', ''),
(33, 'Gianna', '123456', 'P0x2', 'Gianna', 'Rivera', 'Camarillo', ''),
(34, 'Othello', '123456', 'P0x2', 'Othello', 'Soria', 'Muro', ''),
(35, 'Katrina', '123456', 'P0x2', 'Katrina', 'Toro', 'Farias', ''),
(36, 'Cordelia', '123456', 'P0x2', 'Cordelia', 'Bueno', 'Varela', ''),
(37, 'Ioav', '123456', 'P0x2', 'Ioav', 'Viera', 'Ulloa', ''),
(38, 'Hullen', '123456', 'P0x2', 'Hullen', 'Candelaria', 'Baeza', ''),
(39, 'Carlos', '123456', 'P0x2', 'Carlos', 'Centeno', 'Quintana', ''),
(40, 'Debora', '123456', 'P0x2', 'Debora', 'Mel', 'Trozo', ''),
(41, 'Florinda', '123456', 'P0x2', 'Florinda', 'Leal', 'Mesas', ''),
(42, 'Xena', '123456', 'P0x2', 'Xena', 'Prieto', 'Solorio', ''),
(43, 'Edison', '123456', 'P0x2', 'Edison', 'Ontiveros', 'Rosado', ''),
(44, 'Casio', '123456', 'P0x2', 'Casio', 'Leon', 'Lomeli', ''),
(45, 'Marcos', '123456', 'P0x2', 'Bicor', 'Marcos', 'Baca', '');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compra_factura`
--
ALTER TABLE `compra_factura`
  ADD CONSTRAINT `compra_factura_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compra_factura_ibfk_1` FOREIGN KEY (`id_factura`) REFERENCES `facturas` (`id_factura`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `facturas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
