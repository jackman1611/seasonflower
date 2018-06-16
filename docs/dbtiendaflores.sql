-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-05-2018 a las 16:37:06
-- Versión del servidor: 10.1.29-MariaDB
-- Versión de PHP: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbtiendaflores`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas`
--

CREATE TABLE `cuentas` (
  `id` int(11) NOT NULL,
  `nombrecuenta` varchar(45) NOT NULL,
  `ncuenta` varchar(20) NOT NULL,
  `vencemm` int(11) NOT NULL,
  `venceyy` int(11) NOT NULL,
  `fkusuario` int(11) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cuentas`
--

INSERT INTO `cuentas` (`id`, `nombrecuenta`, `ncuenta`, `vencemm`, `venceyy`, `fkusuario`, `created_at`) VALUES
(1, 'Joel 1', '4242424242424242', 2, 2020, 14, '2018-04-30 17:38:12.891849'),
(2, 'santarder', '4444444444444444', 4, 2020, 18, '2018-05-02 17:33:53.269238'),
(3, 'Master', '5555555555554444', 6, 2022, 14, '2018-05-18 16:02:00.425922'),
(4, 'Sin fondos', '4000000000000127', 5, 2025, 14, '2018-05-18 16:22:58.219211'),
(5, 'Declinada', '4000000000000002', 10, 2028, 14, '2018-05-18 16:27:29.435230'),
(6, 'Joel', '4242424242424242', 3, 2023, 19, '2018-05-24 20:31:15.965658');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones`
--

CREATE TABLE `direcciones` (
  `id` int(11) NOT NULL,
  `direccion` mediumtext NOT NULL,
  `fkusuario` int(11) NOT NULL,
  `cp` varchar(7) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `direcciones`
--

INSERT INTO `direcciones` (`id`, `direccion`, `fkusuario`, `cp`, `created_at`) VALUES
(19, 'asdasdasdasasdzwads, coyoacan', 18, '11111', '2018-05-25 18:28:13.396664'),
(20, 'Ave. insurgentes n° 225,Cuauhtémoc.', 19, '22222', '2018-05-25 18:28:13.474793'),
(21, 'coacalco,Coyoacán.', 14, '33333', '2018-05-25 18:28:13.474793'),
(22, 'Coacalco,Iztacalco.', 19, '55712', '2018-05-25 18:35:00.063300');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `flores`
--

CREATE TABLE `flores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `created_at` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `flores`
--

INSERT INTO `flores` (`id`, `nombre`, `imagen`, `created_at`) VALUES
(1, 'Orquidea', 'img/img_flower/orquidias.jpg', ''),
(2, 'Tulipanes', 'img/img_flower/tulipanes.jpg', ''),
(3, 'rosas rojas', 'img/img_flower/rosas.jpg', ''),
(4, 'rosas blancas', 'img/img_flower/rosas blancas.jpg', ''),
(5, 'Alcatraces', 'img/img_flower/alcatraces.jpg', ''),
(6, 'girasol', 'img/img_flower/girasol.jpg', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `floresxtemp`
--

CREATE TABLE `floresxtemp` (
  `id` int(11) NOT NULL,
  `fkflor` int(11) NOT NULL,
  `fktemporada` int(11) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `floresxtemp`
--

INSERT INTO `floresxtemp` (`id`, `fkflor`, `fktemporada`, `created_at`) VALUES
(16, 2, 3, '2018-04-09 16:51:37.333748');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden`
--

CREATE TABLE `orden` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `iddireccion` int(11) NOT NULL,
  `iscomplete` int(11) NOT NULL,
  `isrejected` int(11) NOT NULL,
  `isactive` int(11) NOT NULL,
  `create` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `orden`
--

INSERT INTO `orden` (`id`, `nombre`, `idusuario`, `iddireccion`, `iscomplete`, `isrejected`, `isactive`, `create`) VALUES
(54, 'Joel', 19, 20, 0, 0, 0, '2018-05-25 18:15:25.650313');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidosdireccion`
--

CREATE TABLE `pedidosdireccion` (
  `id` int(11) NOT NULL,
  `fechadeentrega` date NOT NULL,
  `horadeentrega` time NOT NULL,
  `fkdireccion` int(11) NOT NULL,
  `fkusuario` int(11) NOT NULL,
  `nombrerecibe` varchar(45) NOT NULL,
  `fkorden` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedidosdireccion`
--

INSERT INTO `pedidosdireccion` (`id`, `fechadeentrega`, `horadeentrega`, `fkdireccion`, `fkusuario`, `nombrerecibe`, `fkorden`, `created_at`) VALUES
(1, '2018-05-03', '04:12:08', 19, 18, 'laura', 1, '2018-05-03 21:12:11.591389'),
(2, '2018-05-07', '05:55:52', 21, 14, 'joel', 1, '2018-05-07 22:55:53.870359'),
(3, '2018-05-24', '03:30:38', 20, 19, 'Joel', 1, '2018-05-24 20:30:40.046627'),
(4, '2018-05-24', '03:32:55', 20, 19, 'qwe', 1, '2018-05-24 20:32:56.822017'),
(5, '2018-05-25', '09:23:58', 20, 19, 'Joel', 1, '2018-05-25 14:23:59.691320'),
(6, '2018-05-25', '11:48:44', 20, 19, 'Joel', 1, '2018-05-25 16:48:46.722854'),
(7, '2018-05-25', '01:14:20', 20, 19, 'Joel', 1, '2018-05-25 18:14:21.440315');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `descripcion` mediumtext NOT NULL,
  `stock` int(15) NOT NULL,
  `precio` int(11) NOT NULL,
  `ofer` varchar(3) NOT NULL DEFAULT '0',
  `timeofer` int(11) NOT NULL,
  `inicio` date NOT NULL,
  `final` date NOT NULL,
  `precioofer` int(11) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `imagen`, `descripcion`, `stock`, `precio`, `ofer`, `timeofer`, `inicio`, `final`, `precioofer`, `created_at`) VALUES
(14, 'producto 1', 'img/img_pro/product14-500x630.jpg', '<p>flores con peluche</p>\r\n', 9, 123, '0', 23, '0000-00-00', '0000-00-00', 100, '2018-05-25 22:31:49.897500'),
(15, 'producto 2', 'img/img_pro/product15-500x630.jpg', '<p>ramo de rosas con un oso de peluche&nbsp;</p>\r\n\r\n<p>Un&nbsp;<strong>texto</strong>&nbsp;es una composici&oacute;n de&nbsp;<a href=\"https://es.wikipedia.org/wiki/Signo_ling%C3%BC%C3%ADstico\" title=\"Signo lingüístico\">signos</a>&nbsp;codificados en un&nbsp;<a href=\"https://es.wikipedia.org/wiki/Sistema_de_escritura\" title=\"Sistema de escritura\">sistema de escritura</a>&nbsp;que forma una unidad de&nbsp;<a href=\"https://es.wikipedia.org/wiki/Significado\" title=\"Significado\">sentido</a>.</p>\r\n\r\n<p>Tambi&eacute;n es una composici&oacute;n de caracteres imprimibles (con&nbsp;<a href=\"https://es.wikipedia.org/wiki/Grafema\" title=\"Grafema\">grafema</a>) generados por un&nbsp;<a href=\"https://es.wikipedia.org/wiki/Algoritmo\" title=\"Algoritmo\">algoritmo</a>&nbsp;de&nbsp;<a href=\"https://es.wikipedia.org/wiki/Criptograf%C3%ADa\" title=\"Criptografía\">cifrado</a>&nbsp;que, aunque no tienen sentido para cualquier persona, s&iacute; puede ser descifrado por su destinatario original. En otras palabras, un texto es un entramado de signos con una intenci&oacute;n comunicativa que adquiere sentido en determinado contexto.</p>\r\n\r\n<p>Las ideas esenciales que comunica un texto est&aacute;n contenidas en lo que se suele denominar &laquo;macroproposiciones&raquo;, unidades estructurales de nivel superior o global, que otorgan coherencia al texto constituyendo su hilo central, el esqueleto estructural que cohesiona elementos ling&uuml;&iacute;sticos formales de alto nivel, como los t&iacute;tulos y subt&iacute;tulos, la secuencia de p&aacute;rrafos, etc. En contraste, las &laquo;microproposiciones&raquo; son los elementos coayudantes de la cohesi&oacute;n de un texto, pero a nivel m&aacute;s particular o local. Esta distinci&oacute;n fue realizada por&nbsp;<a href=\"https://es.wikipedia.org/wiki/Teun_van_Dijk\" title=\"Teun van Dijk\">Teun van Dijk</a>&nbsp;en 1980.<a href=\"https://es.wikipedia.org/wiki/Texto#cite_note-1\">1</a>?</p>\r\n', 5, 250, '0', 23, '2018-04-24', '2018-04-25', 200, '2018-05-07 21:25:54.830737'),
(16, 'Casate conmigo', 'img/img_pro/product12-600x756.jpg', '<p>alcatraces con rosas</p>\r\n', 17, 250, '0', 23, '0000-00-00', '0000-00-00', 200, '2018-05-24 20:31:27.281780'),
(17, 'perdoname', 'img/img_pro/product13-600x756.jpg', '<p>arreglo con 100 rosas</p>\r\n', 8, 500, '0', 23, '0000-00-00', '0000-00-00', 300, '2018-05-25 16:47:44.440817'),
(18, 'amigos', 'img/img_pro/product18-500x630.jpg', '<p>arreglo de madera con girasoles</p>\r\n', 45, 100, '0', 23, '0000-00-00', '0000-00-00', 1000, '2018-05-04 20:09:25.696997'),
(19, 'producto3', 'img/img_pro/tulipanes.jpg', '<p>arreglo floral con tulipanes</p>\r\n', 23, 150, '0', 0, '0000-00-00', '0000-00-00', 100, '2018-04-26 14:51:39.788832'),
(20, 'Tulipanes', 'img/img_pro/tulipanes 1.jpg', '', 25, 200, '0', 0, '0000-00-00', '0000-00-00', 10, '2018-04-26 14:51:39.788832'),
(21, 'Recuerdos', 'img/img_pro/rosas arreglo 1.jpg', '', 120, 550, '0', 23, '0000-00-00', '0000-00-00', 0, '2018-05-21 18:32:11.279703');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productorecomendacion`
--

CREATE TABLE `productorecomendacion` (
  `id` int(11) NOT NULL,
  `fkpro` int(11) NOT NULL,
  `fkrecomendaciones` int(11) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productorecomendacion`
--

INSERT INTO `productorecomendacion` (`id`, `fkpro`, `fkrecomendaciones`, `created_at`) VALUES
(1, 14, 2, '2018-04-16 14:19:59.659171'),
(2, 14, 3, '2018-04-16 14:19:59.727804'),
(3, 14, 5, '2018-04-16 14:19:59.827704'),
(4, 15, 4, '2018-04-16 14:20:36.982772'),
(5, 15, 6, '2018-04-16 14:20:37.161213'),
(6, 15, 7, '2018-04-16 14:20:37.314274'),
(7, 16, 2, '2018-04-16 21:28:11.379996'),
(8, 16, 3, '2018-04-16 21:28:11.457148'),
(9, 16, 4, '2018-04-16 21:28:11.556331'),
(10, 16, 5, '2018-04-16 21:28:11.804813'),
(11, 16, 6, '2018-04-16 21:28:11.856215'),
(12, 16, 7, '2018-04-16 21:28:11.903750'),
(13, 17, 2, '2018-04-16 21:28:53.147348'),
(14, 17, 3, '2018-04-16 21:28:53.318251'),
(15, 17, 4, '2018-04-16 21:28:53.359478'),
(16, 17, 5, '2018-04-16 21:28:53.426874'),
(17, 17, 6, '2018-04-16 21:28:53.593257'),
(18, 17, 7, '2018-04-16 21:28:53.628478'),
(19, 18, 2, '2018-04-16 21:33:47.885699'),
(20, 18, 3, '2018-04-16 21:33:48.070419'),
(21, 18, 4, '2018-04-16 21:33:48.133041'),
(22, 18, 5, '2018-04-16 21:33:48.201203'),
(23, 18, 6, '2018-04-16 21:33:48.301108'),
(24, 18, 7, '2018-04-16 21:33:48.469767'),
(25, 19, 2, '2018-04-16 21:37:38.349574'),
(26, 19, 3, '2018-04-16 21:37:38.397080'),
(27, 19, 4, '2018-04-16 21:37:38.465598'),
(28, 19, 5, '2018-04-16 21:37:38.627457'),
(29, 19, 6, '2018-04-16 21:37:38.664935'),
(30, 19, 7, '2018-04-16 21:37:38.696292'),
(31, 20, 3, '2018-04-24 15:39:05.254278'),
(32, 20, 5, '2018-04-24 15:39:11.150133'),
(33, 21, 3, '2018-05-04 20:55:27.600736'),
(34, 21, 5, '2018-05-04 20:55:27.684866'),
(35, 21, 7, '2018-05-04 20:55:27.723367');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productosvendidos`
--

CREATE TABLE `productosvendidos` (
  `id` int(11) NOT NULL,
  `fkpro` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fkusuario` int(11) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_orden`
--

CREATE TABLE `producto_orden` (
  `id` int(11) NOT NULL,
  `fkpro` int(11) NOT NULL,
  `fkorden` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto_orden`
--

INSERT INTO `producto_orden` (`id`, `fkpro`, `fkorden`, `cantidad`, `created_at`) VALUES
(47, 14, 54, 1, '2018-05-25 22:31:49.833346');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recomendacion`
--

CREATE TABLE `recomendacion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` mediumtext NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `ismain` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `recomendacion`
--

INSERT INTO `recomendacion` (`id`, `nombre`, `descripcion`, `imagen`, `ismain`, `created_at`) VALUES
(2, 'Clasico', '', 'img/img_reco/cate1.png', 1, '2018-05-04 20:52:41.721902'),
(3, 'Ella', '', 'img/img_reco/cate2.png', 1, '2018-05-04 20:53:01.685942'),
(4, 'El', '', 'img/img_reco/cate3.png', 1, '2018-05-04 20:53:11.305512'),
(5, 'Minis', '', 'img/img_reco/58952809f757e339aae73a3683f75087--buttercream-flowers-buttercream-frosting.jpg', 0, '2018-04-12 15:19:09.587720'),
(6, 'Macetas', '', 'img/img_reco/terrario-di-cactus-387208.jpg', 0, '2018-04-12 15:19:21.646670'),
(7, 'Especiales', '', 'img/img_reco/eaf10f677b443ca2a47d26f30b4998a9.jpg', 0, '2018-04-12 16:55:19.294212');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `created_at`) VALUES
(1, 'Administrador', '2018-04-04 21:55:42.644213'),
(2, 'Usuario', '2018-04-04 21:55:24.532373');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `fkpro` int(11) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `slider`
--

INSERT INTO `slider` (`id`, `nombre`, `imagen`, `fkpro`, `created_at`) VALUES
(4, 'imagen 1', 'img/img_slider/product15-600x756.jpg', 14, '2018-05-04 16:40:48.832087'),
(5, 'imagen 2', 'img/img_slider/product17-600x756.jpg', 14, '2018-05-04 16:41:05.999335'),
(6, 'imagen 3', 'img/img_slider/product18-600x756.jpg', 14, '2018-05-04 16:41:17.917567'),
(7, 'imagen 4', 'img/img_slider/product21-600x756.jpg', 14, '2018-05-04 16:41:31.384346'),
(8, 'imagen 1', 'img/img_slider/product14-600x756.jpg', 15, '2018-05-04 16:42:42.865327'),
(9, 'imagen 2', 'img/img_slider/product15-600x756.jpg', 15, '2018-05-04 16:42:56.285234'),
(10, 'imagen 3', 'img/img_slider/product17-600x756.jpg', 15, '2018-05-04 16:43:10.082978'),
(11, 'imagen 4', 'img/img_slider/product21-600x756.jpg', 15, '2018-05-04 16:43:21.552360'),
(12, 'imagen 1', 'img/img_slider/product13-500x630.jpg', 16, '2018-05-04 18:17:38.495426'),
(13, 'imagen 2', 'img/img_slider/product16-600x756.jpg', 16, '2018-05-04 18:17:49.972242'),
(14, 'imagen 3', 'img/img_slider/product21-600x756.jpg', 16, '2018-05-04 18:18:01.101617'),
(15, 'imagen 4', 'img/img_slider/product24-600x756.jpg', 16, '2018-05-04 18:18:13.801090'),
(16, 'imagen 5', 'img/img_slider/product26-600x756.jpg', 16, '2018-05-04 18:18:29.154296'),
(17, 'imagen 1', 'img/img_slider/product16-500x630.jpg', 17, '2018-05-04 20:08:28.101068'),
(18, 'imagen 2', 'img/img_slider/product16-600x756.jpg', 17, '2018-05-04 20:08:39.110604'),
(19, 'imagen 3', 'img/img_slider/product18-600x756.jpg', 17, '2018-05-04 20:08:50.118671'),
(20, 'imagen 4', 'img/img_slider/product21-600x756.jpg', 17, '2018-05-04 20:09:00.136974'),
(21, 'imagen 1', 'img/img_slider/product24-600x756.jpg', 18, '2018-05-04 20:09:45.025383'),
(22, 'imagen 2', 'img/img_slider/product25-600x756.jpg', 18, '2018-05-04 20:09:55.349495'),
(23, 'imagen 3', 'img/img_slider/product26-600x756.jpg', 18, '2018-05-04 20:10:04.960306'),
(24, 'imagen 4', 'img/img_slider/product27-600x756.jpg', 18, '2018-05-04 20:10:14.627405');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarjetas`
--

CREATE TABLE `tarjetas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `descripcion` longtext NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tarjetas`
--

INSERT INTO `tarjetas` (`id`, `nombre`, `imagen`, `descripcion`, `created_at`) VALUES
(3, 'Tarjeta 1', 'img/img_tarjetas/images (3).jpg', '', '2018-04-26 21:49:25.936917'),
(4, 'tarjeta 2', 'img/img_tarjetas/eaf10f677b443ca2a47d26f30b4998a9.jpg', '', '2018-04-26 21:50:48.709352'),
(5, 'tarjeta 3', 'img/img_tarjetas/terrario-di-cactus-387208.jpg', '', '2018-04-26 21:48:50.955796'),
(6, 'unica', 'img/img_tarjetas/515.jpg', '', '2018-04-26 21:49:42.294929');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarpro`
--

CREATE TABLE `tarpro` (
  `id` int(11) NOT NULL,
  `fktarjeta` int(11) NOT NULL,
  `fkpro` int(11) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tarpro`
--

INSERT INTO `tarpro` (`id`, `fktarjeta`, `fkpro`, `created_at`) VALUES
(15, 4, 14, '2018-04-26 21:50:03.803323'),
(16, 4, 15, '2018-04-26 21:50:03.845104'),
(17, 4, 16, '2018-04-26 21:50:03.976327'),
(18, 4, 17, '2018-04-26 21:50:04.010100'),
(19, 4, 18, '2018-04-26 21:50:04.029506'),
(20, 4, 19, '2018-04-26 21:50:04.060759'),
(21, 4, 20, '2018-04-26 21:50:04.091900'),
(29, 6, 14, '2018-04-26 21:50:26.789279'),
(30, 6, 15, '2018-04-26 21:50:26.904639'),
(31, 6, 16, '2018-04-26 21:50:26.935891'),
(32, 6, 17, '2018-04-26 21:50:26.951518'),
(33, 6, 18, '2018-04-26 21:50:26.988957'),
(34, 6, 19, '2018-04-26 21:50:27.073215'),
(35, 6, 20, '2018-04-26 21:50:27.104630'),
(36, 3, 14, '2018-05-24 21:10:00.930671'),
(37, 3, 15, '2018-05-24 21:10:01.139563'),
(38, 3, 16, '2018-05-24 21:10:01.166936'),
(39, 3, 17, '2018-05-24 21:10:01.194958'),
(40, 3, 20, '2018-05-24 21:10:01.224094'),
(41, 3, 21, '2018-05-24 21:10:01.250752'),
(42, 5, 14, '2018-05-24 21:10:08.779692'),
(43, 5, 15, '2018-05-24 21:10:08.807710'),
(44, 5, 16, '2018-05-24 21:10:08.846730'),
(45, 5, 19, '2018-05-24 21:10:08.874464'),
(46, 5, 20, '2018-05-24 21:10:08.902566'),
(47, 5, 21, '2018-05-24 21:10:08.941142');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temporada`
--

CREATE TABLE `temporada` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` mediumtext NOT NULL,
  `fechainicial` date NOT NULL,
  `fechafinal` date NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `temporada`
--

INSERT INTO `temporada` (`id`, `nombre`, `descripcion`, `fechainicial`, `fechafinal`, `created_at`) VALUES
(3, 'Otoño', '<p>Estaci&oacute;n del a&ntilde;o comprendida entre el verano y el invierno; en el hemisferio norte, se sit&uacute;a aproximadamente entre el 21 de septiembre, equinoccio de oto&ntilde;o, y el 21 de diciembre, solsticio de invierno, y en el hemisferio sur entre el 21 de marzo y el 21 de junio.</p>\r\n\r\n<p><big><em>Las recomendaciones de esta temporada son:</em></big></p>\r\n\r\n<ul>\r\n	<li>orquideas</li>\r\n	<li>petunias</li>\r\n	<li>rosas</li>\r\n</ul>\r\n\r\n<h3><span class=\"marker\">No olvides visitar nuestas redes sociales pra obtener mas informacion de nuestros products y poder contactarnos en caso de que tengas alguna duda.</span></h3>\r\n', '2018-04-24', '2018-04-27', '2018-04-23 21:54:47.820307'),
(4, 'Invierno', '', '2018-04-02', '2018-04-24', '2018-04-23 21:55:23.484894');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temp_reco`
--

CREATE TABLE `temp_reco` (
  `id` int(11) NOT NULL,
  `fktempo` int(11) NOT NULL,
  `fkreco` int(11) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tokenusr`
--

CREATE TABLE `tokenusr` (
  `id` int(11) NOT NULL,
  `correo` varchar(200) NOT NULL,
  `token` varchar(60) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tokenusr`
--

INSERT INTO `tokenusr` (`id`, `correo`, `token`, `created_at`) VALUES
(12, 'ich-element@holi.com', 'c7endfdjwqf9rz5ial482syk7v3hg0fuam1b607opt16x5d1b', '2018-04-13 21:07:02.037541'),
(13, 'frank@ich-element.com', 'o4bry21j97v3f3c02zc6lqa0cgnds1mtike0a8wup7hx565d2', '2018-04-13 21:54:20.801844'),
(14, 'josue@hotmail.com', '1xw9jo41au4cmbh51d658kg7any2380r2b2d4vspfqize5tdl', '2018-04-16 14:24:17.155163'),
(15, 'josue@hotmail.com', 'hk4dsme4a89qyfw4ig5eu84a2t1d3j5p67zx5br0v09clenbo', '2018-04-16 14:51:10.016966'),
(16, 'ich-element@holi.com', 'n2ba5d9kcejewo350u7gx1d47zhf65pfdma0l4vbi8s8qyt1r', '2018-04-16 15:12:53.128487'),
(17, 'josue@hotmail.com', 'aciaf23gmpd4lfb9jv5dk66h06c45ud0nwa1szx9toeyqcr87', '2018-04-16 15:49:35.435412'),
(18, 'ich-element@holi.com', 'gam2dq28vkarct5scdilw51fhd53na64xoc30e68y9zubd7pj', '2018-04-17 20:28:03.836235'),
(19, 'frank@ich-element.com', '9g525pdulve94h69fzyjxft8615merbsk5cb16a7i0awoq3dn', '2018-04-17 20:29:18.762780'),
(20, 'josue@hotmail.com', 'hv2y5xbis6c33d8f5wjf0nad9kgddtp4ra816eoudqm75l9ze', '2018-04-17 20:29:49.919734');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `ap` varchar(45) NOT NULL,
  `am` varchar(45) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` varchar(25) NOT NULL,
  `correo` varchar(200) NOT NULL,
  `passw` varchar(512) NOT NULL,
  `fkroles` int(11) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `ap`, `am`, `direccion`, `telefono`, `correo`, `passw`, `fkroles`, `created_at`) VALUES
(14, 'Administrador', 'Admin', 'Admin', 'Toronto Valle Dorado', '23123123123', 'admin@ich-element.com', '263fec58861449aacc1c328a4aff64aff4c62df4a2d50b3f207fa89b6e242c9aa778e7a8baeffef85b6ca6d2e7dc16ff0a760d59c13c238f6bcdc32f8ce9cc62', 1, '2018-05-18 15:04:20.089787'),
(18, 'josue', 'asdasddsas', 'wefdsfdfsdfdf', 'sdfsdfsdfdsfsdfs', '123456', 'ich-element@holi.com', '263fec58861449aacc1c328a4aff64aff4c62df4a2d50b3f207fa89b6e242c9aa778e7a8baeffef85b6ca6d2e7dc16ff0a760d59c13c238f6bcdc32f8ce9cc62', 2, '2018-04-18 20:12:11.360368'),
(19, 'Joel', 'Garcia', 'Vazquez', 'coacalco', '5525724289', 'jack_kindap@hotmail.com', 'dd4bda2dae851bdc4b6d81e000bc1f52d2092828d9f1e741019b9120c5d53b7b60de4fbdd5f6e64a24b0dcd71ebd4083e2c6fb490e0eaea75d62fc83cce2cf38', 2, '2018-04-23 17:33:02.732972'),
(20, 'pepe', 'asdsdadd', 'asdasdasd', 'asdsdasdasdasdsadsadsa', '1234234234', 'pepe@hotmail.com', '263fec58861449aacc1c328a4aff64aff4c62df4a2d50b3f207fa89b6e242c9aa778e7a8baeffef85b6ca6d2e7dc16ff0a760d59c13c238f6bcdc32f8ce9cc62', 2, '2018-05-02 18:18:47.048148'),
(21, 'asdsdsad', 'asdasd', 'sddadsd', 'asdasdd', '21345', 'hola@hotmail.com', '263fec58861449aacc1c328a4aff64aff4c62df4a2d50b3f207fa89b6e242c9aa778e7a8baeffef85b6ca6d2e7dc16ff0a760d59c13c238f6bcdc32f8ce9cc62', 2, '2018-05-04 16:57:47.895570');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cu_us_idx` (`fkusuario`);

--
-- Indices de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_dir_us_idx` (`fkusuario`);

--
-- Indices de la tabla `flores`
--
ALTER TABLE `flores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `floresxtemp`
--
ALTER TABLE `floresxtemp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_flores_ft_idx` (`fkflor`),
  ADD KEY `fk_temporada_ft_idx` (`fktemporada`);

--
-- Indices de la tabla `orden`
--
ALTER TABLE `orden`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkusuario_idx` (`idusuario`) USING BTREE,
  ADD KEY `fkdireccion_idx` (`iddireccion`) USING BTREE;

--
-- Indices de la tabla `pedidosdireccion`
--
ALTER TABLE `pedidosdireccion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pd_us_idx` (`fkusuario`),
  ADD KEY `fk_pd_dir_idx` (`fkdireccion`) USING BTREE;

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productorecomendacion`
--
ALTER TABLE `productorecomendacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pr_pro_idx` (`fkpro`),
  ADD KEY `fk_pr_rec_idx` (`fkrecomendaciones`);

--
-- Indices de la tabla `productosvendidos`
--
ALTER TABLE `productosvendidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pv_pro_idx` (`fkpro`),
  ADD KEY `fk_pv_us_idx` (`fkusuario`);

--
-- Indices de la tabla `producto_orden`
--
ALTER TABLE `producto_orden`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_po_pro_idx` (`fkpro`),
  ADD KEY `fk_po_or_idx` (`fkorden`);

--
-- Indices de la tabla `recomendacion`
--
ALTER TABLE `recomendacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indices de la tabla `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_sl_pro_idx` (`fkpro`);

--
-- Indices de la tabla `tarjetas`
--
ALTER TABLE `tarjetas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tarpro`
--
ALTER TABLE `tarpro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tar_tp_idx` (`fktarjeta`),
  ADD KEY `fk_pro_tp_idx` (`fkpro`);

--
-- Indices de la tabla `temporada`
--
ALTER TABLE `temporada`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `temp_reco`
--
ALTER TABLE `temp_reco`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tempo_tr_idx` (`fktempo`),
  ADD KEY `fk_reco_tr_idx` (`fkreco`);

--
-- Indices de la tabla `tokenusr`
--
ALTER TABLE `tokenusr`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo_UNIQUE` (`correo`),
  ADD KEY `fk_rol_idx` (`fkroles`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `flores`
--
ALTER TABLE `flores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `floresxtemp`
--
ALTER TABLE `floresxtemp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `orden`
--
ALTER TABLE `orden`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `pedidosdireccion`
--
ALTER TABLE `pedidosdireccion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `productorecomendacion`
--
ALTER TABLE `productorecomendacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `productosvendidos`
--
ALTER TABLE `productosvendidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto_orden`
--
ALTER TABLE `producto_orden`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `recomendacion`
--
ALTER TABLE `recomendacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `tarjetas`
--
ALTER TABLE `tarjetas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tarpro`
--
ALTER TABLE `tarpro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `temporada`
--
ALTER TABLE `temporada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `temp_reco`
--
ALTER TABLE `temp_reco`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tokenusr`
--
ALTER TABLE `tokenusr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cuentas`
--
ALTER TABLE `cuentas`
  ADD CONSTRAINT `fk_cu_us` FOREIGN KEY (`fkusuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD CONSTRAINT `fk_dir_us` FOREIGN KEY (`fkusuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `floresxtemp`
--
ALTER TABLE `floresxtemp`
  ADD CONSTRAINT `fk_flores_ft` FOREIGN KEY (`fkflor`) REFERENCES `flores` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_temporada_ft` FOREIGN KEY (`fktemporada`) REFERENCES `temporada` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `orden`
--
ALTER TABLE `orden`
  ADD CONSTRAINT `orden_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orden_ibfk_2` FOREIGN KEY (`iddireccion`) REFERENCES `direcciones` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pedidosdireccion`
--
ALTER TABLE `pedidosdireccion`
  ADD CONSTRAINT `fk_pd_dir` FOREIGN KEY (`fkdireccion`) REFERENCES `direcciones` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pd_us` FOREIGN KEY (`fkusuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `productorecomendacion`
--
ALTER TABLE `productorecomendacion`
  ADD CONSTRAINT `fk_pr_pro` FOREIGN KEY (`fkpro`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pr_rec` FOREIGN KEY (`fkrecomendaciones`) REFERENCES `recomendacion` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `productosvendidos`
--
ALTER TABLE `productosvendidos`
  ADD CONSTRAINT `fk_pv_pro` FOREIGN KEY (`fkpro`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pv_us` FOREIGN KEY (`fkusuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `producto_orden`
--
ALTER TABLE `producto_orden`
  ADD CONSTRAINT `fk_po_or` FOREIGN KEY (`fkorden`) REFERENCES `orden` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_po_pro` FOREIGN KEY (`fkpro`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `slider`
--
ALTER TABLE `slider`
  ADD CONSTRAINT `fk_sl_pro` FOREIGN KEY (`fkpro`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tarpro`
--
ALTER TABLE `tarpro`
  ADD CONSTRAINT `fk_pro_tp` FOREIGN KEY (`fkpro`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tar_tp` FOREIGN KEY (`fktarjeta`) REFERENCES `tarjetas` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `temp_reco`
--
ALTER TABLE `temp_reco`
  ADD CONSTRAINT `fk_reco_tr` FOREIGN KEY (`fkreco`) REFERENCES `recomendacion` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tempo_tr` FOREIGN KEY (`fktempo`) REFERENCES `temporada` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_rol` FOREIGN KEY (`fkroles`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_role` FOREIGN KEY (`fkroles`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
