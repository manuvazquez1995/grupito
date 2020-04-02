-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-04-2020 a las 23:15:28
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `idUsuario` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `online` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`idUsuario`, `email`, `password`, `nombre`, `apellidos`, `direccion`, `telefono`, `online`) VALUES
(3, 'administrador@tienda.com', '$2y$10$k9Dj19oGzq/ykEoDSHF9QOIugeE4PYEa3ir1vyhRLPRXZsNdwxA0O', 'Jelorio', 'López López', 'Calle no se sabe', '666666666', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallepedido`
--

CREATE TABLE `detallepedido` (
  `idDetallePedido` int(11) NOT NULL,
  `idPedido` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detallepedido`
--

INSERT INTO `detallepedido` (`idDetallePedido`, `idPedido`, `idProducto`, `cantidad`, `precio`) VALUES
(8, 5, 1, 1, '6.00'),
(9, 5, 6, 4, '8.50'),
(10, 6, 1, 1, '6.00'),
(11, 7, 2, 1, '49.99'),
(12, 8, 1, 2, '6.00'),
(14, 13, 1, 2, '6.00'),
(15, 13, 3, 1, '9.99');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadopedidos`
--

CREATE TABLE `estadopedidos` (
  `idEstado` int(11) NOT NULL,
  `estado` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `estadopedidos`
--

INSERT INTO `estadopedidos` (`idEstado`, `estado`) VALUES
(1, 'ENVIADO'),
(2, 'ANULADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `idPedido` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total` decimal(10,2) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `online` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`idPedido`, `idUsuario`, `fecha`, `total`, `estado`, `online`) VALUES
(5, 3, '2020-03-05 13:28:23', '40.00', 1, 0),
(6, 3, '2020-03-05 13:57:38', '6.00', 1, 0),
(7, 3, '2020-03-05 13:58:28', '49.99', 2, 0),
(8, 3, '2020-03-05 14:10:17', '12.00', 2, 0),
(13, 4, '2020-04-02 18:14:42', '21.99', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idProducto` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `introDescripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `imagen` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `precioOferta` decimal(10,2) NOT NULL,
  `online` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProducto`, `nombre`, `introDescripcion`, `descripcion`, `imagen`, `precio`, `precioOferta`, `online`) VALUES
(1, 'Cine', 'Compre aquí su entrada de cine.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus et tellus ullamcorper, venenatis metus eget, fermentum leo. Curabitur fermentum mollis quam eu lacinia. Sed nec ex scelerisque, scelerisque dui vitae, interdum dui.', 'cine.jpg', '8.00', '6.00', 1),
(2, 'Tarjeta regalo', 'Tarjeta regalo para hacer compras en diversos establecimiento.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus et tellus ullamcorper, venenatis metus eget, fermentum leo. Curabitur fermentum mollis quam eu lacinia. Sed nec ex scelerisque, scelerisque dui vitae, interdum dui.', 'cupon.jpg', '50.00', '49.99', 1),
(3, 'Patinaje', 'Entrada pista de patinaje', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus et tellus ullamcorper, venenatis metus eget, fermentum leo. Curabitur fermentum mollis quam eu lacinia. Sed nec ex scelerisque, scelerisque dui vitae, interdum dui.', 'patinaje.jpg', '20.00', '9.99', 1),
(4, 'Pies', 'Masaje de pies.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus et tellus ullamcorper, venenatis metus eget, fermentum leo. Curabitur fermentum mollis quam eu lacinia. Sed nec ex scelerisque, scelerisque dui vitae, interdum dui.', 'pies.jpg', '40.00', '32.95', 1),
(5, 'Sonrisa', 'Mantén tus dientes sanos y fuertes.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus et tellus ullamcorper, venenatis metus eget, fermentum leo. Curabitur fermentum mollis quam eu lacinia. Sed nec ex scelerisque, scelerisque dui vitae, interdum dui.', 'sonrisa.jpg', '200.00', '180.00', 1),
(6, 'Sushi', 'Pescado crudo al mejor precio.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus et tellus ullamcorper, venenatis metus eget, fermentum leo. Curabitur fermentum mollis quam eu lacinia. Sed nec ex scelerisque, scelerisque dui vitae, interdum dui.', 'sushi.jpg', '10.00', '8.50', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `online` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `email`, `password`, `nombre`, `apellidos`, `direccion`, `telefono`, `online`) VALUES
(2, 'manuel@tienda.com', '$2y$10$UYVp2QXJ.w.hYl16Me5PN.AUByqByr/1x3gb92p5FcRM3aZlInF/O', 'Manuel', 'Vázquez Suárezzx', 'Dirección 27', '9999999999', 0),
(3, 'manuvazquez1995@gmail.com', '$2y$10$He7NNx33K/C.Xbn3BktfpeEScuCbB/ZvM4uWymsxL48guVnetqTvy', 'Manuel', 'Va Su', 'Calle Redondela, Nº666', '666666666', 0),
(4, 'manu@tienda.com', '$2y$10$v5KFqV.UIZzTwZ7Djgc3e.beYmLupaVeGONSbEIQcgjEQSU8Kfq/W', 'Manu', 'Va Su', 'Calle 14', '111222333', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idUsuario`);

--
-- Indices de la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD PRIMARY KEY (`idDetallePedido`),
  ADD KEY `idPedido` (`idPedido`),
  ADD KEY `idProducto` (`idProducto`);

--
-- Indices de la tabla `estadopedidos`
--
ALTER TABLE `estadopedidos`
  ADD PRIMARY KEY (`idEstado`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idPedido`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `estado` (`estado`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idProducto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  MODIFY `idDetallePedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `estadopedidos`
--
ALTER TABLE `estadopedidos`
  MODIFY `idEstado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD CONSTRAINT `detallepedido_ibfk_1` FOREIGN KEY (`idPedido`) REFERENCES `pedidos` (`idPedido`),
  ADD CONSTRAINT `detallepedido_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`estado`) REFERENCES `estadopedidos` (`idEstado`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
