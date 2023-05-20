-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-05-2023 a las 20:50:34
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `guesser`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emojis_serie`
--

CREATE TABLE `emojis_serie` (
  `id` int(11) NOT NULL,
  `nombre` varchar(155) NOT NULL,
  `emoji` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `emojis_serie`
--

INSERT INTO `emojis_serie` (`id`, `nombre`, `emoji`) VALUES
(1, 'Squid Game', '🦑🎮🍟🧂🥙'),
(2, 'Suits', '⚖👔'),
(3, 'The walking dead', '🚶‍♂️💀');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotogramas_película`
--

CREATE TABLE `fotogramas_película` (
  `id` int(11) NOT NULL,
  `nombre` varchar(155) NOT NULL,
  `img1` varchar(2500) NOT NULL,
  `img2` varchar(2500) NOT NULL,
  `img3` varchar(2500) NOT NULL,
  `img4` varchar(2500) NOT NULL,
  `img5` varchar(2500) NOT NULL,
  `img6` varchar(2500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `fotogramas_película`
--

INSERT INTO `fotogramas_película` (`id`, `nombre`, `img1`, `img2`, `img3`, `img4`, `img5`, `img6`) VALUES
(2, 'Arcane', 'Arcane/1Arcane.jpg', 'Arcane/2Arcane.jpg', 'Arcane/3Arcane.jpg', 'Arcane/4Arcane.jpg', 'Arcane/5Arcane.jpg', 'Arcane/6Arcane.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotogramas_serie`
--

CREATE TABLE `fotogramas_serie` (
  `id` int(11) NOT NULL,
  `nombre` varchar(155) NOT NULL,
  `img1` varchar(2500) NOT NULL,
  `img2` varchar(2500) NOT NULL,
  `img3` varchar(2500) NOT NULL,
  `img4` varchar(2500) NOT NULL,
  `img5` varchar(2500) NOT NULL,
  `img6` varchar(2500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `fotogramas_serie`
--

INSERT INTO `fotogramas_serie` (`id`, `nombre`, `img1`, `img2`, `img3`, `img4`, `img5`, `img6`) VALUES
(1, 'Peaky Blinders', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/c92d5d5a2f8811ed99f410ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/8cb8bf2a2f8a11ed99f410ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/1cdfaa922f8f11ed99f410ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/df5502222f8d11ed99f410ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/2e5caeb22f8c11ed99f410ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/08e6c5022f8f11ed99f410ddb1aba44f.jpeg'),
(2, 'Breaking Bad', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/e6bc96426e1311eca18510ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/7fb84f686e1811eca18510ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/6db245f06e1b11eca18510ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/9b5ccc1e6e1611eca18510ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/b797b8e26e1311eca18510ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/e3fd19a06e1211eca18510ddb1aba44f.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personajes_serie`
--

CREATE TABLE `personajes_serie` (
  `id` int(11) NOT NULL,
  `nombre` varchar(155) NOT NULL,
  `nombre_serie` varchar(155) NOT NULL,
  `img` varchar(2500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `personajes_serie`
--

INSERT INTO `personajes_serie` (`id`, `nombre`, `nombre_serie`, `img`) VALUES
(1, 'Walter White', 'Breaking Bad', 'https://upload.wikimedia.org/wikipedia/en/0/03/Walter_White_S5B.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `emojis_serie`
--
ALTER TABLE `emojis_serie`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `fotogramas_película`
--
ALTER TABLE `fotogramas_película`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `fotogramas_serie`
--
ALTER TABLE `fotogramas_serie`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personajes_serie`
--
ALTER TABLE `personajes_serie`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `emojis_serie`
--
ALTER TABLE `emojis_serie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `fotogramas_película`
--
ALTER TABLE `fotogramas_película`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `fotogramas_serie`
--
ALTER TABLE `fotogramas_serie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `personajes_serie`
--
ALTER TABLE `personajes_serie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
