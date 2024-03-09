-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-03-2024 a las 22:43:08
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
(1, 'accion'),
(2, 'aventura'),
(3, 'rol'),
(4, 'fantasia'),
(5, 'arcade'),
(6, 'deporte'),
(7, 'estrategia'),
(8, 'simulacion'),
(9, 'juego de mesa'),
(10, 'futurista'),
(11, 'Carreras'),
(12, 'Construcción');

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
(129, 'Nintendo DS'),
(130, 'PlayStation VR');

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

--
-- Volcado de datos para la tabla `videojocs`
--

INSERT INTO `videojocs` (`id`, `nom`, `data_llancament`, `pegi`, `id_desenvolupador`) VALUES
(5, 'The Legend of Zelda: Breath of the Wild', '2017-03-03', 0, 1),
(6, 'The Witcher 3: Wild Hunt', '2015-05-19', 0, 2),
(7, 'Red Dead Redemption 2', '2018-10-26', 0, 3),
(8, 'Super Mario Odyssey', '2017-10-27', 0, 1),
(9, 'Cyberpunk 2077', '2020-12-10', 0, 2),
(10, 'God of War', '2018-04-20', 0, 4),
(11, 'Horizon Zero Dawn', '2017-02-28', 0, 5),
(12, 'The Elder Scrolls V: Skyrim', '2011-11-11', 12, 6),
(13, 'Final Fantasy VII Remake', '2020-04-10', 0, 7),
(14, 'Minecraft', '2011-11-18', 0, 8),
(15, 'The Last of Us Part II', '2020-06-19', 0, 9),
(16, 'Genshin Impact', '2020-09-28', 0, 10),
(17, 'Assassin\'s Creed Valhalla', '2020-11-10', 0, 11),
(18, 'Pokémon FireRed / LeafGreen', '2004-01-29', 0, 12),
(19, 'Animal Crossing: New Horizons', '2020-03-20', 0, 1),
(20, 'Demon\'s Souls', '2020-11-12', 0, 13),
(21, 'Call of Duty: Modern Warfare (2019)', '2019-10-25', 0, 14),
(22, 'Marvel\'s Spider-Man: Miles Morales', '2020-11-12', 0, 15),
(23, 'Hades', '2020-09-17', 0, 16),
(24, 'Death Stranding', '2019-11-08', 0, 17),
(25, 'Stardew Valley', '2016-02-26', 0, 18),
(26, 'Ghost of Tsushima', '2020-07-17', 0, 19),
(27, 'Resident Evil Village', '2021-05-07', 0, 20),
(28, 'Sekiro: Shadows Die Twice', '2019-03-22', 0, 21),
(29, 'DOOM Eternal', '2020-03-20', 0, 22),
(30, 'Ratchet & Clank: Rift Apart', '2021-06-11', 0, 15),
(31, 'It Takes Two', '2021-03-26', 0, 23),
(32, 'Pokémon Diamond/Pearl', '2006-09-28', 0, 12),
(33, 'Hitman 3', '2021-01-20', 0, 24),
(34, 'Persona 5 Royal', '2020-03-31', 0, 25),
(35, 'Metroid Dread', '2021-10-08', 0, 1),
(36, 'Monster Hunter Rise', '2021-03-26', 0, 20),
(37, 'Little Nightmares II', '2021-02-11', 0, 26),
(38, 'Outriders', '2021-04-01', 0, 27),
(39, 'Kena: Bridge of Spirits', '2021-09-21', 0, 28),
(40, 'Mass Effect Legendary Edition', '2021-05-14', 0, 29),
(41, 'Chicory: A Colorful Tale', '2021-06-10', 0, 30),
(42, 'Scarlet Nexus', '2021-06-25', 0, 31),
(43, 'New Pokémon Snap', '2021-04-30', 0, 32),
(44, 'Back 4 Blood', '2021-10-12', 0, 33),
(45, 'NieR Replicant ver.1.22474487139...', '2021-04-23', 0, 34),
(46, 'Pokémon Black/White', '2010-03-04', 0, 12),
(47, 'Riders Republic', '2021-10-28', 0, 35),
(48, 'The Medium', '2021-01-28', 0, 36),
(49, 'Resident Evil 3 Remake', '2020-04-03', 0, 20),
(50, 'Bravely Default II', '2021-02-26', 0, 37),
(51, 'Age of Empires IV', '2021-10-28', 0, 38),
(52, 'Halo Infinite', '2021-12-08', 0, 39),
(53, 'Far Cry 6', '2021-10-07', 0, 11),
(54, 'Deathloop', '2021-09-14', 0, 40),
(55, 'Deathloop', '2021-09-14', 0, 40),
(56, 'Deathloop', '2021-09-14', 0, 40);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `videojoc_genere`
--

CREATE TABLE `videojoc_genere` (
  `id_videojoc` int(11) NOT NULL,
  `id_genere` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `videojoc_genere`
--

INSERT INTO `videojoc_genere` (`id_videojoc`, `id_genere`) VALUES
(56, 1),
(56, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `videojoc_plataforma`
--

CREATE TABLE `videojoc_plataforma` (
  `id_plataforma` int(11) DEFAULT NULL,
  `id_videojoc` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `videojoc_plataforma`
--

INSERT INTO `videojoc_plataforma` (`id_plataforma`, `id_videojoc`) VALUES
(114, 5),
(114, 8),
(114, 19),
(114, 35),
(114, 36),
(114, 43),
(114, 50),
(115, 6),
(115, 7),
(115, 9),
(115, 11),
(115, 12),
(115, 14),
(115, 16),
(115, 17),
(115, 21),
(115, 23),
(115, 24),
(115, 25),
(115, 27),
(115, 28),
(115, 29),
(115, 31),
(115, 33),
(115, 36),
(115, 37),
(115, 38),
(115, 39),
(115, 40),
(115, 41),
(115, 42),
(115, 44),
(115, 45),
(115, 47),
(115, 48),
(115, 49),
(115, 51),
(115, 52),
(115, 53),
(115, 54),
(115, 54),
(115, 54),
(116, 6),
(116, 7),
(116, 9),
(116, 10),
(116, 11),
(116, 13),
(116, 15),
(116, 17),
(116, 21),
(116, 22),
(116, 24),
(116, 26),
(116, 27),
(116, 28),
(116, 29),
(116, 31),
(116, 33),
(116, 34),
(116, 38),
(116, 39),
(116, 40),
(116, 42),
(116, 44),
(116, 45),
(116, 47),
(116, 49),
(116, 53),
(117, 6),
(117, 7),
(117, 9),
(117, 17),
(117, 21),
(117, 27),
(117, 28),
(117, 29),
(117, 31),
(117, 33),
(117, 38),
(117, 40),
(117, 42),
(117, 44),
(117, 45),
(117, 47),
(117, 49),
(117, 53),
(118, 10),
(118, 15),
(118, 17),
(118, 20),
(118, 22),
(118, 27),
(118, 30),
(118, 31),
(118, 33),
(118, 38),
(118, 39),
(118, 42),
(118, 44),
(118, 47),
(118, 53),
(118, 54),
(118, 54),
(118, 54),
(119, 12),
(120, 12),
(121, 14),
(121, 16),
(121, 25),
(121, 37),
(121, 41),
(122, 14),
(122, 25),
(122, 37),
(123, 14),
(123, 16),
(123, 23),
(123, 25),
(123, 37),
(123, 41),
(124, 14),
(125, 16),
(125, 25),
(126, 16),
(126, 25),
(127, 17),
(127, 27),
(127, 31),
(127, 33),
(127, 38),
(127, 42),
(127, 44),
(127, 47),
(127, 48),
(127, 52),
(127, 53),
(128, 18),
(129, 32),
(129, 46);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `genere`
--
ALTER TABLE `genere`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `plataforma`
--
ALTER TABLE `plataforma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT de la tabla `videojocs`
--
ALTER TABLE `videojocs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

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
