-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-02-2024 a las 15:54:58
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `videojocs_projecte`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `desenvolupador`
--

CREATE TABLE `desenvolupador` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `desenvolupador`
--

INSERT INTO `desenvolupador` (`id`, `nom`) VALUES
(1, 'Nintendo'),
(2, 'CD Projekt Red'),
(3, 'Rockstar Games'),
(4, 'Santa Monica Studio'),
(5, 'Guerrilla Games'),
(6, 'Bethesda Game Studios'),
(7, 'Square Enix'),
(8, 'Mojang'),
(9, 'Naughty Dog'),
(10, 'miHoYo'),
(11, 'Ubisoft'),
(12, 'Game Freak'),
(13, 'Bluepoint Games / SIE Japan Studio'),
(14, 'Infinity Ward'),
(15, 'Insomniac Games'),
(16, 'Supergiant Games'),
(17, 'Kojima Productions'),
(18, 'ConcernedApe'),
(19, 'Sucker Punch Productions'),
(20, 'Capcom'),
(21, 'FromSoftware'),
(22, 'id Software'),
(23, 'Hazelight Studios'),
(24, 'IO Interactive'),
(25, 'Atlus'),
(26, 'Tarsier Studios'),
(27, 'People Can Fly'),
(28, 'Ember Lab'),
(29, 'BioWare'),
(30, 'Greg Lobanov'),
(31, 'Bandai Namco Entertainment'),
(32, 'Bandai Namco Studios'),
(33, 'Turtle Rock Studios'),
(34, 'Toylogic'),
(35, 'Ubisoft Annecy'),
(36, 'Bloober Team'),
(37, 'Silicon Studio / Claytechworks'),
(38, 'Relic Entertainment'),
(39, '343 Industries'),
(40, 'Arkane Studios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genere`
--

CREATE TABLE `genere` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `genere`
--

INSERT INTO `genere` (`id`, `nom`) VALUES
(1, 'acccion'),
(2, 'aventura'),
(3, 'rol'),
(4, 'fantasia'),
(5, 'arcade'),
(6, 'deporte'),
(7, 'estrategia'),
(8, 'simulacion'),
(9, 'juego de mesa'),
(10, 'futurista');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plataforma`
--

CREATE TABLE `plataforma` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `plataforma`
--

INSERT INTO `plataforma` (`id`, `nom`) VALUES
(114, 'Nintendo Switch'),
(115, 'PC'),
(116, 'PlayStation 4'),
(117, 'Xbox One'),
(118, 'PlayStation 5'),
(119, 'PlayStation 3'),
(120, 'Xbox 360'),
(121, 'PlayStation'),
(122, 'Xbox'),
(123, 'Switch'),
(124, 'etc.'),
(125, 'iOS'),
(126, 'Android'),
(127, 'Xbox Series X/S'),
(128, 'Game Boy Advance'),
(129, 'Nintendo DS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `videojocs`
--

CREATE TABLE `videojocs` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `data_llancament` date NOT NULL,
  `pegi` int(11) NOT NULL,
  `id_desenvolupador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `videojoc_genere`
--

CREATE TABLE `videojoc_genere` (
  `id_videojoc` int(11) NOT NULL,
  `id_genere` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `videojoc_plataforma`
--

CREATE TABLE `videojoc_plataforma` (
  `id_plataforma` int(11) DEFAULT NULL,
  `id_videojoc` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `desenvolupador`
--
ALTER TABLE `desenvolupador`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `genere`
--
ALTER TABLE `genere`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `plataforma`
--
ALTER TABLE `plataforma`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `videojocs`
--
ALTER TABLE `videojocs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_plataforma` (`id_desenvolupador`);

--
-- Indices de la tabla `videojoc_genere`
--
ALTER TABLE `videojoc_genere`
  ADD KEY `id_videojoc` (`id_videojoc`,`id_genere`),
  ADD KEY `id_genere` (`id_genere`);

--
-- Indices de la tabla `videojoc_plataforma`
--
ALTER TABLE `videojoc_plataforma`
  ADD KEY `id_plataforma` (`id_plataforma`,`id_videojoc`),
  ADD KEY `id_videojoc` (`id_videojoc`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `desenvolupador`
--
ALTER TABLE `desenvolupador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `genere`
--
ALTER TABLE `genere`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `plataforma`
--
ALTER TABLE `plataforma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT de la tabla `videojocs`
--
ALTER TABLE `videojocs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `videojocs`
--
ALTER TABLE `videojocs`
  ADD CONSTRAINT `videojocs_ibfk_2` FOREIGN KEY (`id_desenvolupador`) REFERENCES `desenvolupador` (`id`);

--
-- Filtros para la tabla `videojoc_genere`
--
ALTER TABLE `videojoc_genere`
  ADD CONSTRAINT `videojoc_genere_ibfk_1` FOREIGN KEY (`id_videojoc`) REFERENCES `videojocs` (`id`),
  ADD CONSTRAINT `videojoc_genere_ibfk_2` FOREIGN KEY (`id_genere`) REFERENCES `genere` (`id`);

--
-- Filtros para la tabla `videojoc_plataforma`
--
ALTER TABLE `videojoc_plataforma`
  ADD CONSTRAINT `videojoc_plataforma_ibfk_1` FOREIGN KEY (`id_videojoc`) REFERENCES `videojocs` (`id`),
  ADD CONSTRAINT `videojoc_plataforma_ibfk_2` FOREIGN KEY (`id_plataforma`) REFERENCES `plataforma` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
