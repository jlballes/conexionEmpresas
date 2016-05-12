-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:3306
-- Tiempo de generación: 13-05-2016 a las 00:14:22
-- Versión del servidor: 5.5.42
-- Versión de PHP: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dokify`
--
CREATE DATABASE IF NOT EXISTS `dokify` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `dokify`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conexiones`
--

DROP TABLE IF EXISTS `conexiones`;
CREATE TABLE `conexiones` (
  `idEmpresa1` int(10) unsigned NOT NULL,
  `idEmpresa2` int(10) unsigned NOT NULL,
  `idConexion` int(10) unsigned NOT NULL,
  `posicion` int(10) unsigned NOT NULL,
  `tipoRelacion` varchar(1) NOT NULL COMMENT 'c: cliente, p: proveedor, a: ambos'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `conexiones`
--

INSERT INTO `conexiones` (`idEmpresa1`, `idEmpresa2`, `idConexion`, `posicion`, `tipoRelacion`) VALUES
(1, 3, 1, 1, 'C'),
(1, 4, 3, 3, 'A'),
(2, 8, 2, 1, 'C'),
(3, 4, 1, 2, 'P'),
(3, 6, 4, 1, 'A'),
(4, 9, 1, 3, 'C'),
(4, 9, 3, 4, 'P'),
(5, 6, 3, 1, 'C'),
(6, 1, 3, 2, 'C'),
(8, 7, 2, 2, 'P');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

DROP TABLE IF EXISTS `empresas`;
CREATE TABLE `empresas` (
  `id` int(10) unsigned NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id`, `nombre`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'C'),
(4, 'D'),
(5, 'E'),
(6, 'F'),
(7, 'X'),
(8, 'Y'),
(9, 'Z'),
(19, 'W');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `conexiones`
--
ALTER TABLE `conexiones`
  ADD PRIMARY KEY (`idEmpresa1`,`idEmpresa2`,`idConexion`),
  ADD KEY `fk_id_e2` (`idEmpresa2`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `conexiones`
--
ALTER TABLE `conexiones`
  ADD CONSTRAINT `fk_id_e2` FOREIGN KEY (`idEmpresa2`) REFERENCES `empresas` (`id`),
  ADD CONSTRAINT `fk_id_e1` FOREIGN KEY (`idEmpresa1`) REFERENCES `empresas` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
