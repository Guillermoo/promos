-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 18-12-2013 a las 14:09:37
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

--
-- Volcado de datos para la tabla `tbl_promociones`
--

INSERT INTO `tbl_promociones` (`id`, `user_id`, `estado`, `titulo`, `titulo_slug`, `resumen`, `descripcion`, `descripcion_html`, `fecha_inicio`, `fecha_fin`, `fechaCreacion`, `destacado`, `precio`, `rebaja`, `condiciones`, `stock`, `categorias_id`, `votos_id`) VALUES
(6, 7, 1, 'Pack de 3 cremas', 'pack_3_cremas', 'pack de 3 cremas para la cara', 'pack de 3 cremas para la cara con garantía de calidad', '', '2013-12-18', '2013-12-31', '2013-12-18 11:33:59', 0, '30', '10', '', '20', 1, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
