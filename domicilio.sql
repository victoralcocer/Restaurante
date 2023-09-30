-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-01-2023 a las 13:47:25
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
-- Base de datos: `domicilio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `cod` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `fecha` date NOT NULL,
  `platos` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`cod`, `usuario`, `fecha`, `platos`) VALUES
(6, 'mateo', '2023-01-24', '1_mateo.txt'),
(7, 'mateo', '2023-01-24', '1_mateo.txt'),
(8, 'mateo', '2023-01-24', '3_mateo.txt'),
(9, 'mateo', '2023-01-24', '4_mateo.txt'),
(10, 'mateo', '2023-01-24', 'Pedido Nº 5 mateo.txt'),
(11, 'vccc', '2023-01-24', 'Pedido Nº 1 vccc.txt'),
(12, 'vccc', '2023-01-24', 'Pedido Nº 2 vccc.txt'),
(13, 'mateo', '2023-01-24', 'mateo 6.txt'),
(14, 'mateo', '2023-01-24', 'mateo 7.txt'),
(15, 'mateo', '2023-01-24', 'mateo 8.txt'),
(16, 'mateo', '2023-01-24', 'mateo 9.txt'),
(17, 'mateo', '2023-01-24', 'mateo 10.txt'),
(18, 'mateo', '2023-01-24', 'mateo 11.txt'),
(19, 'mateo', '2023-01-24', 'mateo 12.txt'),
(20, 'VICTOR', '2023-01-24', 'VICTOR 1.txt'),
(21, 'VICTOR', '2023-01-24', 'VICTOR 2.txt');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `platos`
--

CREATE TABLE `platos` (
  `codigo` int(11) NOT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `precio` decimal(4,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `platos`
--

INSERT INTO `platos` (`codigo`, `categoria`, `nombre`, `descripcion`, `precio`) VALUES
(1, 'carnes', 'plato1', 'descrpcion1', '14.00'),
(2, 'pasta', 'plato2', 'descrpcion2', '17.00'),
(3, 'carnes', 'plato3', 'descrpcion3', '5.00'),
(4, 'ensalada', 'plato4', 'descrpcion4', '6.00'),
(5, 'carnes', 'plato5', 'descrpcion5', '21.00'),
(6, 'pasta', 'plato6', 'descrpcion6', '12.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `contraseña` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`codigo`, `nombre`, `email`, `contraseña`) VALUES
(1, 'vccc', 'alcocer@hotmail', 'Gol23@'),
(5, 'de', 'mia@tu', 'Gol23@'),
(6, 'mateo ', 'eee@ddd', 'Gol23@'),
(7, 'mateo ', 'ssss2d@dd', 'Gol23@'),
(8, 'mateo ', 'qqq@fr', 'Gol23@'),
(9, 'javier', 'rdd@jkhs', 'Gol23@'),
(10, 'hornado', 'fr@ee', 'Gol23@'),
(11, 'mateo ', 'qqq@de', 'Gol23@'),
(12, 'VICTOR ', 'victor@live', 'Gol23@');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`cod`);

--
-- Indices de la tabla `platos`
--
ALTER TABLE `platos`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`codigo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `platos`
--
ALTER TABLE `platos`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
