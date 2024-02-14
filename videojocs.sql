-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-02-2024 a las 16:42:59
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
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `videojocs`
--
ALTER TABLE `videojocs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_plataforma` (`id_desenvolupador`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
