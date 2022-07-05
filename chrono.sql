CREATE DATABASE chrono;


-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-06-2022 a las 06:31:58
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `chrono`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_tareas`
--

CREATE TABLE `estados_tareas` (
  `idEstadoTarea` int(11) NOT NULL,
  `estado` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estados_tareas`
--

INSERT INTO `estados_tareas` (`idEstadoTarea`, `estado`) VALUES
(1, 'Por hacer'),
(2, 'En desarrollo'),
(3, 'Completada'),
(4, 'Finalizó');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_usuarios`
--

CREATE TABLE `estados_usuarios` (
  `idEstadoUsuario` int(11) NOT NULL,
  `estado` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estados_usuarios`
--

INSERT INTO `estados_usuarios` (`idEstadoUsuario`, `estado`) VALUES
(1, 'Activo'),
(2, 'Inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiquetas`
--

CREATE TABLE `etiquetas` (
  `idEtiqueta` int(11) NOT NULL,
  `etiqueta` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `etiquetas`
--

INSERT INTO `etiquetas` (`idEtiqueta`, `etiqueta`) VALUES
(1, 'Programar'),
(2, 'Leer'),
(3, 'Dormir'),
(4, 'Gymrat');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `idRol` int(11) NOT NULL,
  `rol` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`idRol`, `rol`) VALUES
(1, 'Administrador'),
(2, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `idTarea` int(11) NOT NULL,
  `nombreTarea` varchar(45) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `idEstadoTarea` int(11) DEFAULT 1,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`idTarea`, `nombreTarea`, `fecha`, `hora`, `idEstadoTarea`, `idUsuario`) VALUES
(1, 'Sociales', '2022-04-29', '05:00:00', 4, 2),
(2, 'Cita médica', '2022-04-30', '08:00:00', 3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `correoElectronico` varchar(255) NOT NULL,
  `nombreDeUsuario` varchar(16) NOT NULL,
  `contrasena` varchar(45) NOT NULL,
  `creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `descripcion` varchar(90) DEFAULT NULL,
  `idRol` int(11) NOT NULL DEFAULT 2,
  `idEstadoUsuario` int(11) NOT NULL DEFAULT 1,
  `pregunta` varchar(200) DEFAULT NULL,
  `respuesta` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nombre`, `correoElectronico`, `nombreDeUsuario`, `contrasena`, `creacion`, `descripcion`, `idRol`, `idEstadoUsuario`, `pregunta`, `respuesta`) VALUES
(1, 'Santiago Molano Holguín', 'molanosantiagoplay@gmail.com', 'ferssan', '7243a1840fc5c155a3aa0e615d223a1a', '2022-05-04 20:53:40', '', 1, 1, '', ''),
(2, 'Santiago Molano', 'smolano1@misena.edu.co', 'mxlano', 'c4a79ed5c86c02f0666df20cd649d27d', '2022-05-04 20:00:41', '', 2, 1, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_etiquetas`
--

CREATE TABLE `usuarios_etiquetas` (
  `idUsuarioEtiqueta` int(11) NOT NULL,
  `idEtiqueta` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios_etiquetas`
--

INSERT INTO `usuarios_etiquetas` (`idUsuarioEtiqueta`, `idEtiqueta`, `idUsuario`) VALUES
(1, 1, 2),
(2, 2, 2),
(3, 3, 2),
(4, 4, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `estados_tareas`
--
ALTER TABLE `estados_tareas`
  ADD PRIMARY KEY (`idEstadoTarea`);

--
-- Indices de la tabla `estados_usuarios`
--
ALTER TABLE `estados_usuarios`
  ADD PRIMARY KEY (`idEstadoUsuario`);

--
-- Indices de la tabla `etiquetas`
--
ALTER TABLE `etiquetas`
  ADD PRIMARY KEY (`idEtiqueta`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`idTarea`),
  ADD KEY `idEstadoTarea` (`idEstadoTarea`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `correoElectronico` (`correoElectronico`),
  ADD UNIQUE KEY `nombreDeUsuario` (`nombreDeUsuario`),
  ADD KEY `idRol` (`idRol`),
  ADD KEY `idEstadoUsuario` (`idEstadoUsuario`);

--
-- Indices de la tabla `usuarios_etiquetas`
--
ALTER TABLE `usuarios_etiquetas`
  ADD PRIMARY KEY (`idUsuarioEtiqueta`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idEtiqueta` (`idEtiqueta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `estados_tareas`
--
ALTER TABLE `estados_tareas`
  MODIFY `idEstadoTarea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `estados_usuarios`
--
ALTER TABLE `estados_usuarios`
  MODIFY `idEstadoUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `etiquetas`
--
ALTER TABLE `etiquetas`
  MODIFY `idEtiqueta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `idTarea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios_etiquetas`
--
ALTER TABLE `usuarios_etiquetas`
  MODIFY `idUsuarioEtiqueta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD CONSTRAINT `tareas_ibfk_1` FOREIGN KEY (`idEstadoTarea`) REFERENCES `estados_tareas` (`idEstadoTarea`),
  ADD CONSTRAINT `tareas_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `roles` (`idRol`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`idEstadoUsuario`) REFERENCES `estados_usuarios` (`idEstadoUsuario`);

--
-- Filtros para la tabla `usuarios_etiquetas`
--
ALTER TABLE `usuarios_etiquetas`
  ADD CONSTRAINT `usuarios_etiquetas_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`),
  ADD CONSTRAINT `usuarios_etiquetas_ibfk_2` FOREIGN KEY (`idEtiqueta`) REFERENCES `etiquetas` (`idEtiqueta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
