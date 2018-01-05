-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-03-2017 a las 20:39:34
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `granja`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbapp_business_config`
--

CREATE TABLE `tbapp_business_config` (
  `id` int(11) NOT NULL,
  `_IDBusiness` int(11) NOT NULL,
  `_values` text,
  `_minbuy` int(11) DEFAULT NULL,
  `_maxbuy` int(11) DEFAULT NULL,
  `_daybuy` varchar(20) DEFAULT NULL,
  `_frequency` enum('fija','eventual') DEFAULT NULL,
  `_create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbapp_business_config`
--

INSERT INTO `tbapp_business_config` (`id`, `_IDBusiness`, `_values`, `_minbuy`, `_maxbuy`, `_daybuy`, `_frequency`, `_create_at`) VALUES
(1, 1, NULL, 10, 50, '3', 'fija', '2017-03-29 14:14:24');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbapp_business_config`
--
ALTER TABLE `tbapp_business_config`
  ADD PRIMARY KEY (`id`),
  ADD KEY `_IDBusiness` (`_IDBusiness`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbapp_business_config`
--
ALTER TABLE `tbapp_business_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbapp_business_config`
--
ALTER TABLE `tbapp_business_config`
  ADD CONSTRAINT `tbapp_business_config_ibfk_1` FOREIGN KEY (`_IDBusiness`) REFERENCES `tbapp_business` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
