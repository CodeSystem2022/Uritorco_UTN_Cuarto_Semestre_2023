-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 01-01-2023 a las 19:54:28
-- Versión del servidor: 8.0.23
-- Versión de PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda_online`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int NOT NULL,
  `nombres` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `dni` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `estatus` tinyint NOT NULL,
  `fecha_alta` datetime NOT NULL,
  `fecha_modifica` datetime DEFAULT NULL,
  `fecha_baja` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id` int NOT NULL,
  `id_transaccion` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `status` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `id_cliente` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `medio_pago` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra`
--

CREATE TABLE `detalle_compra` (
  `id` int NOT NULL,
  `id_compra` int NOT NULL,
  `id_producto` int NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `descuento` tinyint NOT NULL DEFAULT '0',
  `id_categoria` int NOT NULL,
  `activo` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `descuento`, `id_categoria`, `activo`) VALUES
(1, 'Zapatos color cafe', '<p>Zapato Confort casual para caballero color café, con corte de piel natural vacuno, acabado flother, diseño de costura en los costados y sutil diseño punteado.</p>\r\n<br>\r\n<b>Características:</b><br>\r\nMarca: Cklass<br>\r\nColección: Otoño-Invierno 2021<br>\r\nModelo: 273-29<br>\r\nColor: Café<br>\r\nMaterial corte: Piel Natural Vacuno<br>\r\nMaterial Suela: Sintética<br>', '599.00', 10, 1, 1),
(2, 'Laptop 15.6\" con Windows 10', 'Capacidad:<b>12 GB RAM</b> | <b>512 GB SSD</b>\r\n<br>\r\nProcesador:<b>Intel Core i7 1165G7</b>\r\n<br>\r\nTarj. gráfica:<b>Intel Iris Xe Graphics G7 96EUs</b>\r\n\r\n<br>\r\n\r\n<p><b>Más detalles de este producto</b></p>\r\n<ul>\r\n<li>Pantalla LCD de 15.6\".</li>\r\n<li>Resolución de 1920x1080 px.</li>\r\n<li>Es antirreflejo.</li>\r\n<li>Es táctil.</li>\r\n<li>Conexión wifi y bluetooth.</li>\r\n<li>Cuenta con 3 puertos USB y puerto HDMI.</li>\r\n</ul>', '11999.00', 0, 1, 1),
(3, 'Smartphone Negro 32gb Dual Sim 3gb Ram', '<p>Galaxy A02 es un equipo que te brinda excelentes beneficios: Su doble cámara trasera de 13 MP +2 MP y una cámara frontal de 5 MP te permitirán capturar los mejores momentos con una gran calidad.</p>\r\n\r\nMemoria interna: <b>32 GB</b>\r\n<br>\r\nMemoria RAM: <b>3 GB</b>\r\n<br>\r\nCámara frontal principal: <b>5 Mpx</b>\r\n<br>\r\nCámara trasera principal: <b>13 Mpx</b>', '2899.00', 0, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `usuario` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `activacion` int NOT NULL DEFAULT '0',
  `token` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `token_password` varchar(40) COLLATE utf8_spanish_ci DEFAULT NULL,
  `password_request` int NOT NULL DEFAULT '0',
  `id_cliente` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
