-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 18-12-2013 a las 23:49:39
-- Versión del servidor: 5.5.34
-- Versión de PHP: 5.3.10-1ubuntu3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
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
-- Estructura de tabla para la tabla `AuthAssignment`
--

CREATE TABLE IF NOT EXISTS `AuthAssignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `AuthItem`
--

CREATE TABLE IF NOT EXISTS `AuthItem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `AuthItemChild`
--

CREATE TABLE IF NOT EXISTS `AuthItemChild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Rights`
--

CREATE TABLE IF NOT EXISTS `Rights` (
  `itemname` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  PRIMARY KEY (`itemname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_categorias`
--

CREATE TABLE IF NOT EXISTS `tbl_categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_slug` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL COMMENT 'Descripción de la categoría. Ejemplos de promociones que pertenecerían a la categoría',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ciudades`
--

CREATE TABLE IF NOT EXISTS `tbl_ciudades` (
  `idpoblacion` int(11) NOT NULL AUTO_INCREMENT,
  `idprovincia` int(11) unsigned NOT NULL,
  `poblacion` varchar(150) NOT NULL,
  `poblacionseo` varchar(150) DEFAULT NULL,
  `postal` int(5) unsigned zerofill DEFAULT NULL,
  `latitud` decimal(9,6) DEFAULT NULL,
  `longitud` decimal(9,6) DEFAULT NULL,
  PRIMARY KEY (`idpoblacion`),
  UNIQUE KEY `poblacionseo` (`poblacionseo`),
  UNIQUE KEY `lugar` (`latitud`,`longitud`),
  KEY `idprovincia` (`idprovincia`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8175 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_profiles`
--

CREATE TABLE IF NOT EXISTS `tbl_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL COMMENT 'Nombre de la persona de contacto',
  `lastname` varchar(50) DEFAULT NULL,
  `paypal_id` varchar(40) DEFAULT NULL,
  `tipocuenta` int(11) DEFAULT '1',
  `meses` varchar(11) DEFAULT NULL,
  `fecha_activacion` date DEFAULT '0000-00-00' COMMENT 'Fecha en la que se activó el usuario clickando en el email',
  `fecha_fin` date DEFAULT '0000-00-00' COMMENT 'Fecha en la que se le caduca la cuenta',
  `fecha_pago` date DEFAULT '0000-00-00' COMMENT 'Fecha en la que realizó el pago',
  `telefono` varchar(50) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `cp` varchar(11) DEFAULT NULL,
  `barrio` int(11) DEFAULT NULL,
  `direccion` varchar(120) DEFAULT NULL,
  `poblacion_id` varchar(254) NOT NULL,
  PRIMARY KEY (`id`,`user_id`),
  UNIQUE KEY `user_id` (`user_id`),
  KEY `empresa_id` (`id`),
  KEY `tipocuenta` (`tipocuenta`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_profiles_fields`
--

CREATE TABLE IF NOT EXISTS `tbl_profiles_fields` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `varname` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `field_type` varchar(50) NOT NULL,
  `field_size` varchar(15) NOT NULL DEFAULT '0',
  `field_size_min` varchar(15) NOT NULL DEFAULT '0',
  `required` int(1) NOT NULL DEFAULT '0',
  `match` varchar(255) NOT NULL DEFAULT '',
  `range` varchar(255) NOT NULL DEFAULT '',
  `error_message` varchar(255) NOT NULL DEFAULT '',
  `other_validator` varchar(5000) NOT NULL DEFAULT '',
  `default` varchar(255) NOT NULL DEFAULT '',
  `widget` varchar(255) NOT NULL DEFAULT '',
  `widgetparams` varchar(5000) NOT NULL DEFAULT '',
  `position` int(3) NOT NULL DEFAULT '0',
  `visible` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `varname` (`varname`,`widget`,`visible`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_promociones`
--

CREATE TABLE IF NOT EXISTS `tbl_promociones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `titulo_slug` varchar(100) NOT NULL,
  `resumen` varchar(100) NOT NULL,
  `descripcion` varchar(1000) NOT NULL,
  `descripcion_html` varchar(1000) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `fechaCreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `destacado` tinyint(1) NOT NULL,
  `precio` varchar(45) NOT NULL,
  `rebaja` varchar(45) NOT NULL,
  `condiciones` varchar(1000) NOT NULL,
  `stock` varchar(11) NOT NULL,
  `categorias_id` int(11) DEFAULT NULL,
  `votos_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `empresa_id` (`user_id`),
  KEY `categoria_id` (`categorias_id`),
  KEY `votos_id` (`votos_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_provincias`
--

CREATE TABLE IF NOT EXISTS `tbl_provincias` (
  `idprovincia` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `provincia` varchar(50) NOT NULL,
  `provinciaseo` varchar(50) NOT NULL,
  `provincia3` char(3) DEFAULT NULL,
  PRIMARY KEY (`idprovincia`),
  UNIQUE KEY `provinciaseo` (`provinciaseo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=53 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `activkey` varchar(128) NOT NULL DEFAULT '',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastvisit_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `superuser` int(1) NOT NULL DEFAULT '0' COMMENT '-1=SuperAdmin,0=Comprador,1=Admin,2=Empresa',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '0=NoActive,1=Active,-1=Banned,2=Pagar,3=Ok',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `status` (`status`),
  KEY `superuser` (`superuser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=146 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_votos`
--

CREATE TABLE IF NOT EXISTS `tbl_votos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `votos_cantidad` int(11) NOT NULL,
  `votos_media` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `votos_suma` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_category_tirar`
--

CREATE TABLE IF NOT EXISTS `_category_tirar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `root` int(10) unsigned DEFAULT NULL,
  `lft` int(10) unsigned NOT NULL,
  `rgt` int(10) unsigned NOT NULL,
  `level` smallint(5) unsigned NOT NULL,
  `name` varchar(128) NOT NULL,
  `name_slug` varchar(128) NOT NULL,
  `description` varchar(255) NOT NULL COMMENT 'Breve descripción para que la empresa sepa el tipo de categoraía a la que pertenecerá',
  `examples` varchar(255) NOT NULL COMMENT 'Ejemplos de productos que entrarían dentro de esta categoría.',
  PRIMARY KEY (`id`),
  KEY `root` (`root`),
  KEY `lft` (`lft`),
  KEY `rgt` (`rgt`),
  KEY `level` (`level`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=99 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_tbl_contactos`
--

CREATE TABLE IF NOT EXISTS `_tbl_contactos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `cp` varchar(11) DEFAULT NULL,
  `barrio` int(11) DEFAULT NULL,
  `direccion` varchar(120) DEFAULT NULL,
  `poblacion_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `poblacion` (`poblacion_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `AuthAssignment`
--
ALTER TABLE `AuthAssignment`
  ADD CONSTRAINT `AuthAssignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `AuthItemChild`
--
ALTER TABLE `AuthItemChild`
  ADD CONSTRAINT `AuthItemChild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `AuthItemChild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Rights`
--
ALTER TABLE `Rights`
  ADD CONSTRAINT `Rights_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_ciudades`
--
ALTER TABLE `tbl_ciudades`
  ADD CONSTRAINT `tbl_ciudades_ibfk_1` FOREIGN KEY (`idprovincia`) REFERENCES `tbl_provincias` (`idprovincia`);

--
-- Filtros para la tabla `tbl_compras`
--
ALTER TABLE `tbl_compras`
  ADD CONSTRAINT `tbl_compras_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_compras_ibfk_2` FOREIGN KEY (`id_promo`) REFERENCES `tbl_promociones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_empresas`
--
ALTER TABLE `tbl_empresas`
  ADD CONSTRAINT `tbl_empresas_ibfk_14` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_emp_cat`
--
ALTER TABLE `tbl_emp_cat`
  ADD CONSTRAINT `tbl_emp_cat_ibfk_2` FOREIGN KEY (`categoria_id`) REFERENCES `_category_tirar` (`id`),
  ADD CONSTRAINT `tbl_emp_cat_ibfk_3` FOREIGN KEY (`empresa_id`) REFERENCES `tbl_empresas` (`id`);

--
-- Filtros para la tabla `tbl_items`
--
ALTER TABLE `tbl_items`
  ADD CONSTRAINT `tbl_items_ibfk_2` FOREIGN KEY (`foreign_id`) REFERENCES `tbl_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_poblaciones`
--
ALTER TABLE `tbl_poblaciones`
  ADD CONSTRAINT `tbl_poblaciones_ibfk_1` FOREIGN KEY (`idprovincia`) REFERENCES `tbl_provincias` (`idprovincia`);

--
-- Filtros para la tabla `tbl_profiles`
--
ALTER TABLE `tbl_profiles`
  ADD CONSTRAINT `tbl_profiles_ibfk_10` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_profiles_ibfk_5` FOREIGN KEY (`tipocuenta`) REFERENCES `tbl_cuentas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_promociones`
--
ALTER TABLE `tbl_promociones`
  ADD CONSTRAINT `tbl_promociones_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbl_promociones_ibfk_3` FOREIGN KEY (`categorias_id`) REFERENCES `tbl_categorias` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_promociones_ibfk_4` FOREIGN KEY (`votos_id`) REFERENCES `tbl_votos` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
