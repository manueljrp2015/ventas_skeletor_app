-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-02-2017 a las 13:19:29
-- Versión del servidor: 10.1.9-MariaDB
-- Versión de PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `freelancer`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbapp_country`
--

CREATE TABLE `tbapp_country` (
  `id` int(11) NOT NULL,
  `_country` varchar(254) NOT NULL,
  `_country_status` enum('ac','in') NOT NULL DEFAULT 'ac',
  `_prefix` varchar(8) NOT NULL,
  `_codephone` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbapp_country`
--

INSERT INTO `tbapp_country` (`id`, `_country`, `_country_status`, `_prefix`, `_codephone`) VALUES
(1, 'Venezuela', 'ac', 'VEN', '+58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbapp_registeruser_app`
--

CREATE TABLE `tbapp_registeruser_app` (
  `id` int(11) NOT NULL,
  `_nickname` varchar(254) NOT NULL,
  `_mail` varchar(254) NOT NULL,
  `_key` varchar(254) NOT NULL,
  `_account_id` int(11) NOT NULL,
  `_country_id` int(11) NOT NULL,
  `_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `_update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `_user_status` enum('ac','in','block') NOT NULL DEFAULT 'ac'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbapp_type_account`
--

CREATE TABLE `tbapp_type_account` (
  `id` int(11) NOT NULL,
  `_account` varchar(254) NOT NULL,
  `_account_status` enum('ac','in') NOT NULL DEFAULT 'ac',
  `_account_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbapp_type_account`
--

INSERT INTO `tbapp_type_account` (`id`, `_account`, `_account_status`, `_account_create`) VALUES
(1, 'Freelance', 'ac', '2017-02-14 13:54:03'),
(2, 'Empleador', 'ac', '2017-02-14 13:54:03');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbapp_country`
--
ALTER TABLE `tbapp_country`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbapp_registeruser_app`
--
ALTER TABLE `tbapp_registeruser_app`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbapp_type_account`
--
ALTER TABLE `tbapp_type_account`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbapp_country`
--
ALTER TABLE `tbapp_country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tbapp_registeruser_app`
--
ALTER TABLE `tbapp_registeruser_app`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbapp_type_account`
--
ALTER TABLE `tbapp_type_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
