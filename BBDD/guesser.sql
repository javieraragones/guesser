-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-05-2023 a las 02:42:58
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
(2, 'Fruit Ninja', '🍉🍍🔪🐱‍👤', '2023-05-26'),
(3, 'Angry Birds', '🐦💥🎯😡', '2023-05-27'),
(4, 'Rocket League', '🚀🚗⚽🥅', '2023-05-29'),
(5, '8 Ball Pool', '8️⃣🥎🏊‍♂️', '2023-05-28');

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
(2, 'La Máscara', '🐶🤓👺🤪🕺', '2023-05-26'),
(3, 'Solo en casa', '🏠🙈🎄', '2023-05-27'),
(4, 'Up', '🎈🏠🐶👴🏻', '2023-05-28'),
(5, 'Spider-Man: Homecoming', '🕷🦸‍♀️🏫👷🏻🦅', '2023-05-29');

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
(2, 'Breaking Bad', '🌵🤓🧪💊💰', '2023-05-26'),
(3, 'Suits', '👨👦⚖️👔', '2023-05-29'),
(4, 'The Walking Dead', '👮🏻🏃🧟‍⚔️🚗', '2023-05-27'),
(5, 'Lost', '✈️🏝⛺🆘❓', '2023-05-28');

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
(0, 'Uncharted 4', 'https://areajugones.sport.es/wp-content/uploads/2016/05/uncharted4_athiefsendypox3.png', 'https://areajugones.sport.es/wp-content/uploads/2016/05/uncharted4_athiefsend7osqd.png', 'https://areajugones.sport.es/wp-content/uploads/2016/05/tyYOs6C.jpg', 'https://areajugones.sport.es/wp-content/uploads/2016/05/1463167836-uncharted-tm-4-a-thief-s-end-20160513210435.png', 'https://areajugones.sport.es/wp-content/uploads/2016/05/CihmavGXAAI2-yL.jpg', 'https://areajugones.sport.es/wp-content/uploads/2016/05/uncharted4_athiefsend2hk4j.png', '2023-05-26'),
(0, 'The Last of Us', 'https://media.vandalimg.com/i/220x124/120665/the-last-of-us-parte-i-202261013255064_1.jpg', 'https://media.vandalimg.com/i/220x124/120665/the-last-of-us-parte-i-202261013255064_5.jpg', 'https://media.vandalimg.com/i/220x124/120665/the-last-of-us-parte-i-202261013255064_3.jpg', 'https://media.vandalimg.com/i/220x124/120666/the-last-of-us-parte-i-202212913181771_5.jpg', 'https://media.vandalimg.com/i/220x124/120666/the-last-of-us-parte-i-202212913181771_11.jpg', 'https://media.vandalimg.com/i/220x124/120666/the-last-of-us-parte-i-202212913181771_6.jpg', '2023-05-27'),
(0, 'God of War', 'https://media.vandalimg.com/i/220x124/27407/god-of-war-2018319161748_11.jpg', 'https://media.vandalimg.com/i/220x124/27407/god-of-war-201859182513_5.jpg', 'https://media.vandalimg.com/i/220x124/27407/god-of-war-201859182634_6.jpg', 'https://media.vandalimg.com/i/220x124/27407/god-of-war-2018810114620_2.jpg', 'https://media.vandalimg.com/i/220x124/109060/god-of-war-2021102017141059_2.jpg', 'https://media.vandalimg.com/i/220x124/27407/god-of-war-201859182513_1.jpg', '2023-05-28'),
(0, 'Portal 2', 'https://media.vandalimg.com/t200/37336/portal-2-exhumaos-201639104910_4.jpg', 'https://media.vandalimg.com/t200/12160/201122820281_11.jpg', 'https://media.vandalimg.com/t200/12160/201122820281_4.jpg', 'https://media.vandalimg.com/t200/12160/201122820281_8.jpg', 'https://media.vandalimg.com/t200/12160/2011121113438_3.jpg', 'https://media.vandalimg.com/t200/12160/2011121113438_1.jpg', '2023-05-29');

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
(2, 'Joker', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/86d07298186111ebb16110ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/b54cb99c186111ebb16110ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/c6c92920186211ebb16110ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/c0dd1d2a185b11ebb16110ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/0749d280185c11ebb16110ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/ae9cd76e186411ebb16110ddb1aba44f.jpeg', '2023-05-26'),
(3, 'Top Gun: Maverick', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/3899875e642a11ed8c120612238522d6.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/5907f517642a11ed8c120612238522d6.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/4cd30c5d642c11ed8c120612238522d6.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/e8f7d611642a11ed8c120612238522d6.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/b695b5d9642a11ed8c120612238522d6.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/2d2a4170642b11ed8c120612238522d6.jpeg', '2023-05-27'),
(4, 'Dune', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/f9957cca12e311eb84d610ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/39abf10412e411eb84d610ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/4ebaa96412e411eb84d610ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/a9084ec212e311eb84d610ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/e4f4612812e311eb84d610ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/949622ca12e311eb84d610ddb1aba44f.jpeg', '2023-05-28'),
(5, 'Spider-Man: No Way Home', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/a48d5cee01d311eda58510ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/55231e7e01d211eda58510ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/d6409ff401d211eda58510ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/7516b85001d011eda58510ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/f662e6ac01d211eda58510ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/1b7ddee201d311eda58510ddb1aba44f.jpeg', '2023-05-29');

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
(2, 'The Witcher', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/0d945254849a11ec98dd10ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/ad82777c849b11ec98dd10ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/ee6e9198849c11ec98dd10ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/748ff4ba848911ec98dd10ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/2dff2a90848711ec98dd10ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/332d8774849011ec98dd10ddb1aba44f.jpeg', '2023-05-26'),
(3, 'Breaking Bad', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/067d81566e1111eca18510ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/c141e76e6e1811eca18510ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/ce2b131a6e1811eca18510ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/cdb13de06e1511eca18510ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/cac8e8c86e1311eca18510ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/e3fd19a06e1211eca18510ddb1aba44f.jpeg', '2023-05-27'),
(4, 'Chernobyl', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/91f258fa011a11ed9f7d10ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/eb0b303c012011ed9f7d10ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/b37dd42e011811ed9f7d10ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/141efe6c011811ed9f7d10ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/50227cba011611ed9f7d10ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/2dd8032c011c11ed9f7d10ddb1aba44f.jpeg', '2023-05-28'),
(5, 'Stranger Things', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/7e4611cae8d811ec9d1910ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/939d4de6e8d711ec9d1910ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/471f5514e8c211ec9d1910ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/f1cf157ce8c111ec9d1910ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/4d3f31b4e8d911ec9d1910ddb1aba44f.jpeg', 'https://flim-1-0-2.s3.eu-central-1.amazonaws.com/thumbs/thumbnail/92b4210ceca111ecb4eb10ddb1aba44f.jpeg', '2023-05-29');

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
(2, 'Crash Bandicoot', 'Crash Bandicoot', 'https://arc-anglerfish-arc2-prod-elcomercio.s3.amazonaws.com/public/2SUPBJOGVNDHRHTHDGGMBRUQ7M.jpg', '2023-05-26'),
(3, 'Mario', 'Super Mario Bros', 'https://i.blogs.es/b32659/mario/1366_2000.jpeg', '2023-05-27'),
(4, 'Lara Croft', 'Tomb Raider', 'https://tierragamer.com/wp-content/uploads/2020/07/Lara-Croft-Tomb-Raider-Lesbiana.jpg', '2023-05-28'),
(5, 'Solid Snake', 'Metal Gear', 'https://assetsio.reedpopcdn.com/super_smash_solid_snake_450x300.jpg.jpg?width=1600&height=900&fit=crop&quality=100&format=png&enable=upscale&auto=webp', '2023-05-29');

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
(2, 'Rocky Balboa', 'Rocky Balboa', 'https://media.gq.com.mx/photos/5ebcabaafc5059515dd87b93/16:9/pass/FOTOO%20PORTADA.png', '2023-05-26'),
(3, 'Batman', 'DC Comics', 'https://cloudfront-us-east-1.images.arcpublishing.com/metroworldnews/OMMXHLDAABDBVHRUH2FPDLVZCY.jpg', '2023-05-27'),
(4, 'James Bond', 'James Bond', 'https://i.blogs.es/004ab0/james-bond-omega-destacada/1366_2000.jpeg', '2023-05-29'),
(5, 'Iron Man', 'Iron Man', 'https://lumiere-a.akamaihd.net/v1/images/iron_man_marvel_d9ce0209.jpeg?region=64%2C0%2C712%2C400', '2023-05-28');

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
(2, 'Ellie', 'The Last of Us', 'https://cdn.hobbyconsolas.com/sites/navi.axelspringer.es/public/media/image/2022/11/last-us-2888538.jpg?tf=3840x', '2023-05-26'),
(3, 'Lisa Simpson', 'Los Simpson', 'https://www.latercera.com/resizer/kUrYhV1e4UpyE33JZ_HhgwRk2t8=/900x600/smart/arc-anglerfish-arc2-prod-copesa.s3.amazonaws.com/public/46P3CPCZCFDE7LETEJM2RQANJQ.jpg', '2023-05-27'),
(4, 'John Locke', 'Lost', 'https://collective.world/wp-content/uploads/sites/3/2022/03/Iconic-Inspirational-Lessons-From-Losts-John-Locke-e1646672474503.png?w=1536&h=768&crop=1', '2023-05-28'),
(5, 'Chandler Bing', 'Friends', 'https://imagenes.20minutos.es/files/image_990_v3/uploads/imagenes/2019/09/30/chandler_1.jpg', '2023-05-29');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `emojis_pelicula`
--
ALTER TABLE `emojis_pelicula`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `emojis_serie`
--
ALTER TABLE `emojis_serie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `fotogramas_pelicula`
--
ALTER TABLE `fotogramas_pelicula`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `fotogramas_serie`
--
ALTER TABLE `fotogramas_serie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `personajes_juego`
--
ALTER TABLE `personajes_juego`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `personajes_pelicula`
--
ALTER TABLE `personajes_pelicula`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `personajes_serie`
--
ALTER TABLE `personajes_serie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
