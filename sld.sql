-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-05-2024 a las 07:06:41
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sld`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `docclie` int(11) NOT NULL,
  `nombreclie` varchar(25) NOT NULL,
  `telefonoclie` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`docclie`, `nombreclie`, `telefonoclie`) VALUES
(65763948, 'Santiago', '3163326545');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `codprodu` int(11) NOT NULL,
  `nombreprodu` varchar(25) NOT NULL,
  `precioprodu` decimal(10,6) NOT NULL,
  `existenciaprodu` float NOT NULL,
  `nitprodu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`codprodu`, `nombreprodu`, `precioprodu`, `existenciaprodu`, `nitprodu`) VALUES
(1212, 'Pan', 10.000000, 19, 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `nitpro` int(11) NOT NULL,
  `nombrePro` varchar(25) NOT NULL,
  `contactoPro` varchar(25) NOT NULL,
  `telefonoPro` varchar(10) NOT NULL,
  `direccionPro` varchar(50) NOT NULL,
  `ciudadPro` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`nitpro`, `nombrePro`, `contactoPro`, `telefonoPro`, `direccionPro`, `ciudadPro`) VALUES
(22, 'Acer', 'messi', '3245649855', 'sena', 'barranquilla');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `cargoUsu` int(11) NOT NULL,
  `nombrerol` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`cargoUsu`, `nombrerol`) VALUES
(1, 'Administrador'),
(2, 'Empleado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `usuario`, `password`, `rol`) VALUES
(1, 'presi', '123', 1),
(2, 'lau', '321', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `docUsu` int(15) NOT NULL,
  `nombreUsu` varchar(25) NOT NULL,
  `contraseñaUsu` varchar(25) NOT NULL,
  `telefonoUsu` varchar(10) NOT NULL,
  `ciudadUsu` varchar(30) NOT NULL,
  `direccionUsu` varchar(50) NOT NULL,
  `cargoUsu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`docUsu`, `nombreUsu`, `contraseñaUsu`, `telefonoUsu`, `ciudadUsu`, `direccionUsu`, `cargoUsu`) VALUES
(1005789852, 'Laura Gongora', '258', '3218455879', 'ibague', 'sena', 2),
(1104936650, 'Santiago', '321', '3143872538', 'ibague', 'sena', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `codventa` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `docUsu` int(11) NOT NULL,
  `docclie` int(11) NOT NULL,
  `codprodu` int(11) NOT NULL,
  `observacion` varchar(100) NOT NULL,
  `total` decimal(10,6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish_ci;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`codventa`, `fecha`, `hora`, `docUsu`, `docclie`, `codprodu`, `observacion`, `total`) VALUES
(787, '2024-05-24', '15:42:00', 1005789852, 65763948, 1212, 'producto entregado, venta realizada con exito', 40.000000);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`docclie`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`codprodu`),
  ADD KEY `nitprodu` (`nitprodu`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`nitpro`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`cargoUsu`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rol` (`rol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`docUsu`),
  ADD KEY `cargoUsu` (`cargoUsu`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`codventa`),
  ADD KEY `codprodu` (`codprodu`),
  ADD KEY `docclie` (`docclie`),
  ADD KEY `docUsu` (`docUsu`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `docclie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1104936651;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `codprodu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1415;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `cargoUsu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `docUsu` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1104936652;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `codventa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=788;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`nitprodu`) REFERENCES `proveedores` (`nitpro`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `rol` (`cargoUsu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`cargoUsu`) REFERENCES `rol` (`cargoUsu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`docUsu`) REFERENCES `usuarios` (`docUsu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `venta_ibfk_2` FOREIGN KEY (`docclie`) REFERENCES `cliente` (`docclie`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `venta_ibfk_3` FOREIGN KEY (`codprodu`) REFERENCES `producto` (`codprodu`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
