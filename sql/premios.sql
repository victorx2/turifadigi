-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-05-2025 a las 12:08:16
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
-- Estructura de tabla para la tabla `premios`
--

CREATE TABLE `premios` (
  `id_premio` int(11) NOT NULL,
  `id_rifa` int(11) NOT NULL,
  `id_tipo_premio` int(11) NOT NULL,
  `id_configuracion` int(11) NOT NULL,
  `premio` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `premios`
--
ALTER TABLE `premios`
  ADD PRIMARY KEY (`id_premio`),
  ADD KEY `id_rifa` (`id_rifa`),
  ADD KEY `id_tipo_premio` (`id_tipo_premio`),
  ADD KEY `id_configuracion` (`id_configuracion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `premios`
--
ALTER TABLE `premios`
  MODIFY `id_premio` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

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
