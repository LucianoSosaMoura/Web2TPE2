-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-11-2022 a las 18:55:10
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
-- Base de datos: `db_tpe`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

CREATE TABLE `ciudades` (
  `idCiudad` int(45) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `provincia` varchar(45) NOT NULL,
  `cantidadHabitantes` int(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ciudades`
--

INSERT INTO `ciudades` (`idCiudad`, `nombre`, `provincia`, `cantidadHabitantes`) VALUES
(4, 'Azul', 'Buenos Aires', 115000),
(7, 'Tandil', 'Buenos Aires', 135000),
(10, 'Benito Juarez', 'Buenos Aires', 54000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destacadas`
--

CREATE TABLE `destacadas` (
  `idDestacada` int(45) NOT NULL,
  `operacion` varchar(45) NOT NULL,
  `descripcion` varchar(450) NOT NULL,
  `precio` int(45) NOT NULL,
  `ciudad` int(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `destacadas`
--

INSERT INTO `destacadas` (`idDestacada`, `operacion`, `descripcion`, `precio`, `ciudad`) VALUES
(1, 'Alquiler', 'Casa', 28000, 10),
(3, 'Venta', 'Casa', 45000, 10),
(5, 'Venta', 'Casa', 65000, 7),
(6, 'Venta', 'Campo', 650000, 7),
(7, 'Venta', 'Campo', 850000, 7),
(8, 'Venta', 'Campo', 850000, 7),
(9, 'Venta', 'Campo', 59000, 7),
(10, 'Venta', 'Departamento', 80000, 7),
(13, 'Alquiler', 'Casa', 40000, 10),
(14, 'Alquiler', 'Casa', 40000, 7),
(17, 'Alquiler', 'Casa', 40000, 7),
(19, 'Venta', 'Casa', 80000, 7),
(21, 'Alquiler', 'Campo', 80000, 7),
(23, 'Venta', 'Campo', 80000, 10),
(24, 'Venta', 'Campo', 80000, 4),
(25, 'Venta', 'Campo', 80000, 7),
(26, 'Venta', 'Campo', 80000, 10),
(27, 'Venta', 'Casa', 850000, 7),
(28, 'Venta', 'Casa', 850000, 10),
(29, 'Venta', 'Departamento', 50000, 4),
(31, 'Venta', 'Departamento', 80000, 7),
(33, 'Alquiler', 'Casa', 85000, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propiedades`
--

CREATE TABLE `propiedades` (
  `idPropiedad` int(45) NOT NULL,
  `operacion` varchar(45) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` int(45) NOT NULL,
  `idCiudad` int(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `propiedades`
--

INSERT INTO `propiedades` (`idPropiedad`, `operacion`, `descripcion`, `precio`, `idCiudad`) VALUES
(2, 'Alquiler', 'Campo', 554000, 10),
(21, 'Alquiler', 'Casa', 225050, 4),
(28, 'Venta', 'Local', 40400, 10),
(31, 'Venta', 'Casa', 2200, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `email` varchar(99) NOT NULL,
  `password` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `email`, `password`) VALUES
(1, 'admin@gmail.com', '$2y$10$YlHfdrSG9cQZBcWikgM69OkfD2hDkwpEuIgdtqu10Va1.LFI/wVzG');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD PRIMARY KEY (`idCiudad`);

--
-- Indices de la tabla `destacadas`
--
ALTER TABLE `destacadas`
  ADD PRIMARY KEY (`idDestacada`),
  ADD KEY `fk_idCiudad` (`ciudad`) USING BTREE;

--
-- Indices de la tabla `propiedades`
--
ALTER TABLE `propiedades`
  ADD PRIMARY KEY (`idPropiedad`),
  ADD KEY `fk_idCiudad` (`idCiudad`) USING BTREE;

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  MODIFY `idCiudad` int(45) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `destacadas`
--
ALTER TABLE `destacadas`
  MODIFY `idDestacada` int(45) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `propiedades`
--
ALTER TABLE `propiedades`
  MODIFY `idPropiedad` int(45) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `destacadas`
--
ALTER TABLE `destacadas`
  ADD CONSTRAINT `destacadas_ibfk_1` FOREIGN KEY (`ciudad`) REFERENCES `ciudades` (`idCiudad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `propiedades`
--
ALTER TABLE `propiedades`
  ADD CONSTRAINT `propiedades_ibfk_1` FOREIGN KEY (`idCiudad`) REFERENCES `ciudades` (`idCiudad`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
