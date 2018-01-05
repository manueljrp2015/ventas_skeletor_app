-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-04-2017 a las 20:50:52
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
-- Estructura de tabla para la tabla `tbapp_warehouse`
--

CREATE TABLE `tbapp_warehouse` (
  `id` int(11) NOT NULL,
  `_warehouse` varchar(254) NOT NULL,
  `_managment` varchar(254) NOT NULL,
  `_IDTypew` int(11) NOT NULL,
  `_IDUser` int(11) NOT NULL,
  `_status_warehouse` enum('ac','in') NOT NULL DEFAULT 'ac',
  `_create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `_update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbapp_warehouse`
--
ALTER TABLE `tbapp_warehouse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `_IDTypew` (`_IDTypew`),
  ADD KEY `_IDUser` (`_IDUser`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbapp_warehouse`
--
ALTER TABLE `tbapp_warehouse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbapp_warehouse`
--
ALTER TABLE `tbapp_warehouse`
  ADD CONSTRAINT `tbapp_warehouse_ibfk_1` FOREIGN KEY (`_IDTypew`) REFERENCES `tbapp_warehouse_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbapp_warehouse_ibfk_2` FOREIGN KEY (`_IDUser`) REFERENCES `tbapp_registeruser_app` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
