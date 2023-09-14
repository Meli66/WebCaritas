-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-08-2023 a las 03:51:29
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tp2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `motivo` varchar(255) DEFAULT NULL,
  `comoNosConociste` varchar(255) DEFAULT NULL,
  `comentario` text DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id`, `nombre`, `telefono`, `email`, `motivo`, `comoNosConociste`, `comentario`, `fecha_creacion`) VALUES
(7, 'Matias Suarez', '123456789', 'matias@suarez', 'voluntariado', 'redes sociales', 'Quisiera ser voluntario , como tendria que hacer', '2023-08-08 04:04:35'),
(10, 'Marcos Lacoa ', '987654321', 'dsa@dsa', 'donacion', 'google', 'Donde podria hacer alguna donacion?', '2023-08-08 04:08:40'),
(12, 'Gonzalo Rey', '231416578976', 'qwe@ewq', 'donacion', 'conocido', 'Quisiera hacer una donacion , como tendria que hacer?', '2023-08-08 04:10:53'),
(13, 'Paula Castaldo', '2345324354', 'fde@fde', 'consultas', 'otro', 'Hola queria saber donde se puede ir ayudar ', '2023-08-08 04:14:18'),
(14, 'Mariela salto', '123456789', 'qwe@asd', 'donacion', 'redes sociales', 'Hola quisiera hacer donacion de ropa , donde la tengo que llevar?', '2023-08-08 04:17:31'),
(15, 'Gaston Cabrol', '9898765432', 'qwe@www', 'consultas', 'redes sociales', 'Quisiera ayudar , como hago?', '2023-08-08 04:26:05'),
(17, 'Nacho ', '123456789', 'qqq@aaa', 'consultas', 'otro', 'Como puedo hacer para ayudar?', '2023-08-08 04:30:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `id` tinyint(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `imagen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`id`, `titulo`, `descripcion`, `imagen`) VALUES
(2, 'prueba', 'prueba', '20230614151024.jpg'),
(3, 'Mural', 'Mi foto es de hace tiempo cuando dibuje el mural!', 'foto3.jpg'),
(4, 'Mural del parque', 'me acuerdo cuando pintamos el mural del parque, que nos llevo mucho tiempo!', 'foto4.jpg'),
(5, 'Dia de pintura', 'Pintando y compartiendo con amigos!', 'foto5.jpg'),
(6, 'Un abrazo nos transforma!', 'Esta es mi foto con Ariel, un nene que conocí en uno de los festejos, es un genio!', 'foto6.jpg'),
(7, 'Dia de huerta', 'Trabajando en equipo para armar una huerta comunitaria!', 'foto7.jpg'),
(8, 'Compartiendo un sabado', 'El ultimo sabado que fui, me puse a jugar y pintar con alexis y martin. La pase genial, hace cuanto no pintaba! ', 'foto8.jpg'),
(9, 'En comunidad', 'Este sabado compartimos un almuerzo con la gente que se acerca.\r\n', 'foto9.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` int(11) NOT NULL,
  `descripcion` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `descripcion`) VALUES
(1, 'Administrador'),
(2, 'Editor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `apellido` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contrasena` varchar(250) NOT NULL,
  `rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `email`, `contrasena`, `rol`) VALUES
(2, 'Melisa', 'Monje', 'melisamonje@gmail.com', '62c8ad0a15d9d1ca38d5dee762a16e01', 2),
(26, 'Gaston', 'Sampataro', 'gsamparo@gmail.com', '5a6c8f8223335c85f54ad39a8a861a9c', 1),
(32, 'Marina', 'Sampataro', 'marinasampa@gmail.com', 'fa9295f7a73db4f4f34982146d20608f', 2),
(33, 'admin', 'admin', 'admin@gmail.com', '1234', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `voluntariado`
--

CREATE TABLE `voluntariado` (
  `id` smallint(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `telefono` decimal(10,0) NOT NULL,
  `email` varchar(255) NOT NULL,
  `comentario` text NOT NULL,
  `motivo` varchar(255) DEFAULT NULL,
  `comoNosConociste` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `voluntariado`
--

INSERT INTO `voluntariado` (`id`, `nombre`, `telefono`, `email`, `comentario`, `motivo`, `comoNosConociste`) VALUES
(2, 'Gaston', '1133584035', 'gsampataro@gmail.com', 'hola como estas, es de prueba ', NULL, NULL),
(3, 'Gaston', '9999999999', 'gsampataro@gmail.com', 'hola que tal ', NULL, NULL),
(5, 'Melisa', '5555', 'meli@lamaskpa.com', 'hola como estas', NULL, NULL),
(6, 'Gaston', '1133584035', 'gsampataro@gmail.com', 'hola ', NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuarios_ibfk_1` (`rol`);

--
-- Indices de la tabla `voluntariado`
--
ALTER TABLE `voluntariado`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `id` tinyint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `voluntariado`
--
ALTER TABLE `voluntariado`
  MODIFY `id` smallint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `rol` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
