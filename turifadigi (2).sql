-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-05-2025 a las 00:27:46
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `turifadigi`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditorias`
--

CREATE TABLE `auditorias` (
  `id_auditoria` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `acciones` text NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `boletos`
--

CREATE TABLE `boletos` (
  `id_boleto` int(11) NOT NULL,
  `id_rifa` int(11) NOT NULL,
  `id_datos` int(11) DEFAULT NULL,
  `numero_boleto` varchar(4) NOT NULL,
  `estado` enum('disponible','reservado','vendido') NOT NULL DEFAULT 'disponible'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras_boletos`
--

CREATE TABLE `compras_boletos` (
  `id_compra` int(11) NOT NULL,
  `id_rifa` int(11) NOT NULL,
  `fecha_compra` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` enum('pendiente','pagado','cancelado') NOT NULL DEFAULT 'pendiente',
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id_configuracion` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `boletos` varchar(8) NOT NULL,
  `precios` decimal(10,2) NOT NULL,
  `estado` int(11) NOT NULL,
  `fecha_configurada` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_personales`
--

CREATE TABLE `datos_personales` (
  `id_datos` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `ubicacion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compras`
--

CREATE TABLE `detalle_compras` (
  `id_detalle` int(11) NOT NULL,
  `id_compra` int(11) NOT NULL,
  `id_boleto` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id_pago` int(11) NOT NULL,
  `id_datos` int(11) NOT NULL,
  `titular` varchar(100) NOT NULL,
  `referencia` varchar(20) NOT NULL,
  `metodo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `premios`
--

CREATE TABLE `premios` (
  `id_premio` int(11) NOT NULL,
  `id_rifa` int(11) NOT NULL,
  `id_tipo_premio` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `boletos_minimos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rifas`
--

CREATE TABLE `rifas` (
  `id_rifa` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `estado` enum('activa','finalizada','cancelada') NOT NULL DEFAULT 'activa',
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_premios`
--

CREATE TABLE `tipos_premios` (
  `id_tipo_premio` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `correo` varchar(500) NOT NULL,
  `nivel` int(12) NOT NULL,
  `estado` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `auditorias`
--
ALTER TABLE `auditorias`
  ADD PRIMARY KEY (`id_auditoria`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `boletos`
--
ALTER TABLE `boletos`
  ADD PRIMARY KEY (`id_boleto`),
  ADD KEY `id_rifa` (`id_rifa`),
  ADD KEY `id_datos` (`id_datos`);

--
-- Indices de la tabla `compras_boletos`
--
ALTER TABLE `compras_boletos`
  ADD PRIMARY KEY (`id_compra`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id_configuracion`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `datos_personales`
--
ALTER TABLE `datos_personales`
  ADD PRIMARY KEY (`id_datos`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `detalle_compras`
--
ALTER TABLE `detalle_compras`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_compra` (`id_compra`),
  ADD KEY `id_boleto` (`id_boleto`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id_pago`);

--
-- Indices de la tabla `premios`
--
ALTER TABLE `premios`
  ADD PRIMARY KEY (`id_premio`),
  ADD KEY `id_rifa` (`id_rifa`),
  ADD KEY `id_tipo_premio` (`id_tipo_premio`);

--
-- Indices de la tabla `rifas`
--
ALTER TABLE `rifas`
  ADD PRIMARY KEY (`id_rifa`);

--
-- Indices de la tabla `tipos_premios`
--
ALTER TABLE `tipos_premios`
  ADD PRIMARY KEY (`id_tipo_premio`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `auditorias`
--
ALTER TABLE `auditorias`
  MODIFY `id_auditoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `boletos`
--
ALTER TABLE `boletos`
  MODIFY `id_boleto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compras_boletos`
--
ALTER TABLE `compras_boletos`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `datos_personales`
--
ALTER TABLE `datos_personales`
  MODIFY `id_datos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_compras`
--
ALTER TABLE `detalle_compras`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `premios`
--
ALTER TABLE `premios`
  MODIFY `id_premio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rifas`
--
ALTER TABLE `rifas`
  MODIFY `id_rifa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipos_premios`
--
ALTER TABLE `tipos_premios`
  MODIFY `id_tipo_premio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `auditorias`
--
ALTER TABLE `auditorias`
  ADD CONSTRAINT `auditorias_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `boletos`
--
ALTER TABLE `boletos`
  ADD CONSTRAINT `boletos_ibfk_1` FOREIGN KEY (`id_rifa`) REFERENCES `rifas` (`id_rifa`),
  ADD CONSTRAINT `boletos_ibfk_2` FOREIGN KEY (`id_datos`) REFERENCES `datos_personales` (`id_datos`);

--
-- Filtros para la tabla `datos_personales`
--
ALTER TABLE `datos_personales`
  ADD CONSTRAINT `fk_datos_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `detalle_compras`
--
ALTER TABLE `detalle_compras`
  ADD CONSTRAINT `detalle_compras_ibfk_1` FOREIGN KEY (`id_boleto`) REFERENCES `boletos` (`id_boleto`),
  ADD CONSTRAINT `detalle_compras_ibfk_2` FOREIGN KEY (`id_compra`) REFERENCES `compras_boletos` (`id_compra`);

--
-- Filtros para la tabla `premios`
--
ALTER TABLE `premios`
  ADD CONSTRAINT `premios_ibfk_1` FOREIGN KEY (`id_tipo_premio`) REFERENCES `tipos_premios` (`id_tipo_premio`),
  ADD CONSTRAINT `premios_ibfk_2` FOREIGN KEY (`id_rifa`) REFERENCES `rifas` (`id_rifa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
