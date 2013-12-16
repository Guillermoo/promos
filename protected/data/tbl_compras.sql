-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 16-12-2013 a las 13:50:51
-- Versión del servidor: 5.6.15-log
-- Versión de PHP: 5.2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `promos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_compras`
--

CREATE TABLE IF NOT EXISTS `tbl_compras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_promo` int(11) NOT NULL,
  `fecha_compra` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` tinyint(1) NOT NULL COMMENT 'Indica el estado de la venta. Si ya ha sido consumida en el establecimiento valdrá 1. Hasta ese momento valdrá 0',
  `referencia` varchar(256) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Código de referencia que asigna paypal a cada compra',
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`,`id_promo`),
  KEY `id_promo` (`id_promo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_compras`
--
ALTER TABLE `tbl_compras`
  ADD CONSTRAINT `tbl_compras_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_compras_ibfk_2` FOREIGN KEY (`id_promo`) REFERENCES `tbl_promociones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
