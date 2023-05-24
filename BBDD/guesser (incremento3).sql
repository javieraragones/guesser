-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-05-2023 a las 01:30:51
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
-- Estructura de tabla para la tabla `emojis_juego`
--

CREATE TABLE `emojis_juego` (
  `id` int(11) NOT NULL,
  `nombre` varchar(155) NOT NULL,
  `emoji` varchar(155) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `emojis_juego`
--

INSERT INTO `emojis_juego` (`id`, `nombre`, `emoji`, `fecha`) VALUES
(1, 'Plants vs. Zombies', '🌻🌵🌞🧟‍♂️', '2023-05-25'),
(2, 'Fruit Ninja', '🍉🍍🔪🐱‍👤', '2023-05-26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emojis_pelicula`
--

CREATE TABLE `emojis_pelicula` (
  `id` int(11) NOT NULL,
  `nombre` varchar(155) NOT NULL,
  `emoji` varchar(10) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `emojis_pelicula`
--

INSERT INTO `emojis_pelicula` (`id`, `nombre`, `emoji`, `fecha`) VALUES
(1, 'Cars', '🏁🍃⛽️🚗', '2023-05-25'),
(2, 'La Máscara', '🐶🤓👺🤪🕺', '2023-05-26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emojis_serie`
--

CREATE TABLE `emojis_serie` (
  `id` int(11) NOT NULL,
  `nombre` varchar(155) NOT NULL,
  `emoji` varchar(10) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `emojis_serie`
--

INSERT INTO `emojis_serie` (`id`, `nombre`, `emoji`, `fecha`) VALUES
(1, 'The Office', '👔🤓📠📎💻', '2023-05-25'),
(2, 'Breaking Bad', '🌵🤓🧪💊💰', '2023-05-26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotogramas_juego`
--

CREATE TABLE `fotogramas_juego` (
  `id` int(11) NOT NULL,
  `nombre` varchar(155) NOT NULL,
  `img1` varchar(2500) NOT NULL,
  `img2` varchar(2500) NOT NULL,
  `img3` varchar(2500) NOT NULL,
  `img4` varchar(2500) NOT NULL,
  `img5` varchar(2500) NOT NULL,
  `img6` varchar(2500) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `fotogramas_juego`
--

INSERT INTO `fotogramas_juego` (`id`, `nombre`, `img1`, `img2`, `img3`, `img4`, `img5`, `img6`, `fecha`) VALUES
(0, 'Elden Ring', 'https://sm.ign.com/t/ign_es/photo/default/eldenring-07-4k-1623357441325_gbp4.1080.jpg', 'https://sm.ign.com/t/ign_es/photo/default/eldenring-14-4k-1623357441327_4cau.1080.jpg', 'https://sm.ign.com/t/ign_es/photo/default/eldenring-10-4k-1623357441333_kc12.1080.jpg', 'https://sm.ign.com/t/ign_es/photo/default/eldenring-06-4k-1623357441337_8vty.1080.jpg', 'https://sm.ign.com/t/ign_es/photo/default/eldenring-02-4k-1623357441329_3ync.1080.jpg', 'https://sm.ign.com/t/ign_es/photo/default/eldenring-01-4k-1623357441326_ukup.1080.jpg', '2023-05-25'),
(0, 'Uncharted 4', 'https://areajugones.sport.es/wp-content/uploads/2016/05/uncharted4_athiefsendypox3.png', 'https://areajugones.sport.es/wp-content/uploads/2016/05/uncharted4_athiefsend7osqd.png', 'https://areajugones.sport.es/wp-content/uploads/2016/05/tyYOs6C.jpg', 'https://areajugones.sport.es/wp-content/uploads/2016/05/1463167836-uncharted-tm-4-a-thief-s-end-20160513210435.png', 'https://areajugones.sport.es/wp-content/uploads/2016/05/CihmavGXAAI2-yL.jpg', 'https://areajugones.sport.es/wp-content/uploads/2016/05/uncharted4_athiefsend2hk4j.png', '2023-05-26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotogramas_pelicula`
--

CREATE TABLE `fotogramas_pelicula` (
  `id` int(11) NOT NULL,
  `nombre` varchar(155) NOT NULL,
  `img1` varchar(2500) NOT NULL,
  `img2` varchar(2500) NOT NULL,
  `img3` varchar(2500) NOT NULL,
  `img4` varchar(2500) NOT NULL,
  `img5` varchar(2500) NOT NULL,
  `img6` varchar(2500) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `fotogramas_pelicula`
--

INSERT INTO `fotogramas_pelicula` (`id`, `nombre`, `img1`, `img2`, `img3`, `img4`, `img5`, `img6`, `fecha`) VALUES
(1, 'Spider-Man', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/70bb8570f5e711eab5c010ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/37e407eef5e811eab5c010ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/d523ad02f5e811eab5c010ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/60f4ea30f5e911eab5c010ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/44e3e3faf5e911eab5c010ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/04c46efcf5e911eab5c010ddb1aba44f.jpeg', '2023-05-25'),
(2, 'Joker', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/86d07298186111ebb16110ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/b54cb99c186111ebb16110ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/c6c92920186211ebb16110ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/c0dd1d2a185b11ebb16110ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/0749d280185c11ebb16110ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/ae9cd76e186411ebb16110ddb1aba44f.jpeg', '2023-05-26');

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
  `img6` varchar(2500) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `fotogramas_serie`
--

INSERT INTO `fotogramas_serie` (`id`, `nombre`, `img1`, `img2`, `img3`, `img4`, `img5`, `img6`, `fecha`) VALUES
(1, 'Arcane', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/d9cf518864bb11ecb28810ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/e15f080264bc11ecb28810ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/d6bf9d9a6cdb11eca10110ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/c92175426ce411eca10110ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/e7c187b264b511ecb28810ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/7b8e63d66cfc11ec9e4b10ddb1aba44f.jpeg', '2023-05-25'),
(2, 'The Witcher', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/0d945254849a11ec98dd10ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/ad82777c849b11ec98dd10ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/ee6e9198849c11ec98dd10ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/748ff4ba848911ec98dd10ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/2dff2a90848711ec98dd10ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/332d8774849011ec98dd10ddb1aba44f.jpeg', '2023-05-26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personajes_juego`
--

CREATE TABLE `personajes_juego` (
  `id` int(11) NOT NULL,
  `nombre` varchar(155) NOT NULL,
  `nombre_juego` varchar(155) NOT NULL,
  `img` varchar(2500) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `personajes_juego`
--

INSERT INTO `personajes_juego` (`id`, `nombre`, `nombre_juego`, `img`, `fecha`) VALUES
(1, 'Sonic', 'Sonic', 'https://cdn.hobbyconsolas.com/sites/navi.axelspringer.es/public/media/image/2022/11/sonic-frontiers-2864625.jpg?tf=3840x', '2023-05-25'),
(2, 'Crash Bandicoot', 'Crash Bandicoot', 'https://arc-anglerfish-arc2-prod-elcomercio.s3.amazonaws.com/public/2SUPBJOGVNDHRHTHDGGMBRUQ7M.jpg', '2023-05-26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personajes_pelicula`
--

CREATE TABLE `personajes_pelicula` (
  `id` int(11) NOT NULL,
  `nombre` varchar(155) NOT NULL,
  `nombre_pelicula` varchar(155) NOT NULL,
  `img` varchar(2500) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `personajes_pelicula`
--

INSERT INTO `personajes_pelicula` (`id`, `nombre`, `nombre_pelicula`, `img`, `fecha`) VALUES
(1, 'Tony Montana', 'Scarface', 'https://cloudfront-us-east-1.images.arcpublishing.com/infobae/AU26WJKLD5GDBA5RGARUJVV37E.jpg', '2023-05-25'),
(2, 'Rocky Balboa', 'Rocky Balboa', 'https://media.gq.com.mx/photos/5ebcabaafc5059515dd87b93/16:9/pass/FOTOO%20PORTADA.png', '2023-05-26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personajes_serie`
--

CREATE TABLE `personajes_serie` (
  `id` int(11) NOT NULL,
  `nombre` varchar(155) NOT NULL,
  `nombre_serie` varchar(155) NOT NULL,
  `img` varchar(2500) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `personajes_serie`
--

INSERT INTO `personajes_serie` (`id`, `nombre`, `nombre_serie`, `img`, `fecha`) VALUES
(1, 'Sheldon Cooper', 'The Big Bang Theory', 'https://cdn.hobbyconsolas.com/sites/navi.axelspringer.es/public/media/image/2020/03/sheldon-cooper-1902835.jpeg?tf=3840x', '2023-05-25'),
(2, 'Ellie', 'The Last of Us', 'https://cdn.hobbyconsolas.com/sites/navi.axelspringer.es/public/media/image/2022/11/last-us-2888538.jpg?tf=3840x', '2023-05-26');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `emojis_juego`
--
ALTER TABLE `emojis_juego`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fecha` (`fecha`);

--
-- Indices de la tabla `emojis_pelicula`
--
ALTER TABLE `emojis_pelicula`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fecha` (`fecha`);

--
-- Indices de la tabla `emojis_serie`
--
ALTER TABLE `emojis_serie`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fecha` (`fecha`);

--
-- Indices de la tabla `fotogramas_juego`
--
ALTER TABLE `fotogramas_juego`
  ADD UNIQUE KEY `fecha` (`fecha`);

--
-- Indices de la tabla `fotogramas_pelicula`
--
ALTER TABLE `fotogramas_pelicula`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fecha` (`fecha`);

--
-- Indices de la tabla `fotogramas_serie`
--
ALTER TABLE `fotogramas_serie`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fecha` (`fecha`);

--
-- Indices de la tabla `personajes_juego`
--
ALTER TABLE `personajes_juego`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fecha` (`fecha`);

--
-- Indices de la tabla `personajes_pelicula`
--
ALTER TABLE `personajes_pelicula`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fecha` (`fecha`);

--
-- Indices de la tabla `personajes_serie`
--
ALTER TABLE `personajes_serie`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fecha` (`fecha`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `emojis_juego`
--
ALTER TABLE `emojis_juego`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `emojis_pelicula`
--
ALTER TABLE `emojis_pelicula`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `emojis_serie`
--
ALTER TABLE `emojis_serie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `fotogramas_pelicula`
--
ALTER TABLE `fotogramas_pelicula`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `fotogramas_serie`
--
ALTER TABLE `fotogramas_serie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `personajes_juego`
--
ALTER TABLE `personajes_juego`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `personajes_pelicula`
--
ALTER TABLE `personajes_pelicula`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `personajes_serie`
--
ALTER TABLE `personajes_serie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
