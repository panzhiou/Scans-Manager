-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-03-2016 a las 01:40:03
-- Versión del servidor: 5.6.26
-- Versión de PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyectons`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sm_archives`
--

CREATE TABLE IF NOT EXISTS `sm_archives` (
  `id` int(11) NOT NULL,
  `codma` int(11) NOT NULL,
  `codch` int(11) NOT NULL,
  `filename` varchar(128) NOT NULL,
  `size` int(11) NOT NULL,
  `created` date NOT NULL,
  `updated` date NOT NULL,
  `lastdownload` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sm_chapters`
--

CREATE TABLE IF NOT EXISTS `sm_chapters` (
  `codch` int(11) NOT NULL,
  `codma` int(11) NOT NULL,
  `codsc` int(11) NOT NULL,
  `chapter` int(11) NOT NULL,
  `language` varchar(16) DEFAULT NULL,
  `name` varchar(256) DEFAULT NULL,
  `uniqid` varchar(128) DEFAULT NULL,
  `hidden` int(11) DEFAULT NULL,
  `download1` varchar(256) NOT NULL,
  `download2` varchar(256) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sm_groups`
--

CREATE TABLE IF NOT EXISTS `sm_groups` (
  `id` mediumint(8) unsigned NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sm_login_attempts`
--

CREATE TABLE IF NOT EXISTS `sm_login_attempts` (
  `id` int(11) unsigned NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sm_mangas`
--

CREATE TABLE IF NOT EXISTS `sm_mangas` (
  `codma` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `uniqid` varchar(256) NOT NULL,
  `stub` varchar(256) NOT NULL,
  `hidden` int(11) DEFAULT NULL,
  `author` varchar(512) NOT NULL,
  `artist` varchar(512) NOT NULL,
  `type` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `description` text,
  `thumbail` varchar(512) NOT NULL,
  `adult` tinyint(2) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sm_news`
--

CREATE TABLE IF NOT EXISTS `sm_news` (
  `codnews` int(11) NOT NULL,
  `title` varchar(256) DEFAULT NULL,
  `slug` varchar(256) DEFAULT NULL,
  `text` text,
  `created` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sm_scans`
--

CREATE TABLE IF NOT EXISTS `sm_scans` (
  `codsc` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sm_users`
--

CREATE TABLE IF NOT EXISTS `sm_users` (
  `id` int(11) unsigned NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sm_users_groups`
--

CREATE TABLE IF NOT EXISTS `sm_users_groups` (
  `id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `sm_archives`
--
ALTER TABLE `sm_archives`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sm_chapters`
--
ALTER TABLE `sm_chapters`
  ADD PRIMARY KEY (`codch`),
  ADD KEY `codma` (`codma`),
  ADD KEY `codsc` (`codsc`);

--
-- Indices de la tabla `sm_groups`
--
ALTER TABLE `sm_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sm_login_attempts`
--
ALTER TABLE `sm_login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sm_mangas`
--
ALTER TABLE `sm_mangas`
  ADD PRIMARY KEY (`codma`);

--
-- Indices de la tabla `sm_news`
--
ALTER TABLE `sm_news`
  ADD PRIMARY KEY (`codnews`);

--
-- Indices de la tabla `sm_scans`
--
ALTER TABLE `sm_scans`
  ADD PRIMARY KEY (`codsc`);

--
-- Indices de la tabla `sm_users`
--
ALTER TABLE `sm_users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sm_users_groups`
--
ALTER TABLE `sm_users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `sm_archives`
--
ALTER TABLE `sm_archives`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `sm_chapters`
--
ALTER TABLE `sm_chapters`
  MODIFY `codch` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `sm_groups`
--
ALTER TABLE `sm_groups`
  MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `sm_login_attempts`
--
ALTER TABLE `sm_login_attempts`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `sm_mangas`
--
ALTER TABLE `sm_mangas`
  MODIFY `codma` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `sm_news`
--
ALTER TABLE `sm_news`
  MODIFY `codnews` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `sm_scans`
--
ALTER TABLE `sm_scans`
  MODIFY `codsc` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `sm_users`
--
ALTER TABLE `sm_users`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `sm_users_groups`
--
ALTER TABLE `sm_users_groups`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `sm_chapters`
--
ALTER TABLE `sm_chapters`
  ADD CONSTRAINT `sm_chapters_ibfk_1` FOREIGN KEY (`codma`) REFERENCES `sm_mangas` (`codma`),
  ADD CONSTRAINT `sm_chapters_ibfk_2` FOREIGN KEY (`codsc`) REFERENCES `sm_scans` (`codsc`);

--
-- Filtros para la tabla `sm_users_groups`
--
ALTER TABLE `sm_users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `sm_groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `sm_users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

INSERT INTO `sm_groups` (`id`, `name`, `description`) VALUES
     (1,'admin','Administrator'),
     (2,'members','General User');

INSERT INTO `sm_users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
     ('1','127.0.0.1','administrator','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36','','admin@admin.com','',NULL,'1268889823','1268889823','1', 'Admin','istrator','ADMIN','0');
	 
INSERT INTO `sm_users_groups` (`id`, `user_id`, `group_id`) VALUES
     (1,1,1),
     (2,1,2);