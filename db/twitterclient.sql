-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-05-2015 a las 11:22:51
-- Versión del servidor: 5.6.20
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `twitterclient`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hashtaglist`
--

CREATE TABLE IF NOT EXISTS `hashtaglist` (
  `hashtaglist_id` int(128) NOT NULL,
  `user_id` varchar(128) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `hashtag` varchar(256) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tweet`
--

CREATE TABLE IF NOT EXISTS `tweet` (
  `tweet_id` int(11) NOT NULL,
  `user_id` varchar(152) NOT NULL,
  `text` varchar(256) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` varchar(128) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `oauth_token` varchar(256) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `oauth_token_secret` varchar(256) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `hashtaglist`
--
ALTER TABLE `hashtaglist`
 ADD PRIMARY KEY (`hashtaglist_id`);

--
-- Indices de la tabla `tweet`
--
ALTER TABLE `tweet`
 ADD PRIMARY KEY (`tweet_id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
