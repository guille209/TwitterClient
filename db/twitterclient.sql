-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-05-2015 a las 13:15:43
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
`hashtaglist_id` int(11) NOT NULL,
  `user_id` varchar(128) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `hashtag` varchar(256) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tweet`
--

CREATE TABLE IF NOT EXISTS `tweet` (
`tweet_id` int(11) NOT NULL,
  `user_id` varchar(152) NOT NULL,
  `text` varchar(256) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `tweet`
--

INSERT INTO `tweet` (`tweet_id`, `user_id`, `text`, `date`) VALUES
(15, '4', 'Mi primer tweet programado!', '1992-12-01 16:01:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`user_id` int(11) NOT NULL,
  `oauth_token` varchar(256) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `oauth_token_secret` varchar(256) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`user_id`, `oauth_token`, `oauth_token_secret`) VALUES
(4, 'NvgLu76DBG1UgzsNYngCzqqn4UGm2blr', 'XpJ3ZZeBVlvwrAB5MpQ1BNTBFChmxOMz');

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

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `hashtaglist`
--
ALTER TABLE `hashtaglist`
MODIFY `hashtaglist_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tweet`
--
ALTER TABLE `tweet`
MODIFY `tweet_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;