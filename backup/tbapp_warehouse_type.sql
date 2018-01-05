-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-04-2017 a las 20:51:43
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
-- Estructura de tabla para la tabla `tbapp_warehouse_type`
--

CREATE TABLE `tbapp_warehouse_type` (
  `id` int(11) NOT NULL,
  `_warehouse_type` varchar(254) NOT NULL,
  `_status_type` enum('ac','in') NOT NULL DEFAULT 'ac',
  `_create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbapp_warehouse_type`
--

INSERT INTO `tbapp_warehouse_type` (`id`, `_warehouse_type`, `_status_type`, `_create_at`) VALUES
(1, 'ALMACEN PRINCIPAL', 'ac', '2017-04-10 11:01:31'),
(2, 'ALMACEN DE PRODUCCION', 'ac', '2017-04-10 11:01:31');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbapp_warehouse_type`
--
ALTER TABLE `tbapp_warehouse_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbapp_warehouse_type`
--
ALTER TABLE `tbapp_warehouse_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
