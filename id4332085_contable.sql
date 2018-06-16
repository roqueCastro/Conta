-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 27-03-2018 a las 14:20:14
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `id4332085_contable`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fiador`
--

CREATE TABLE `fiador` (
  `id_fia` int(11) NOT NULL,
  `nombre_fia` varchar(80) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gasto`
--

CREATE TABLE `gasto` (
  `id_gas` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `precio` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_sal` int(11) NOT NULL,
  `id_usu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `gasto`
--

INSERT INTO `gasto` (`id_gas`, `nombre`, `precio`, `fecha`, `id_sal`, `id_usu`) VALUES
(1, 'guaro', 20000, '2018-01-01 05:00:00', 2, 1),
(2, 'memoria SD 32G', 30000, '2018-01-01 05:00:00', 2, 1),
(3, 'recarga SIM Claro', 1000, '2018-01-01 05:00:00', 2, 1),
(4, 'Gasolina Moto Lorena Pitaliito', 5000, '2018-01-01 05:00:00', 2, 1),
(5, 'recarga SIM Claro', 1000, '2018-01-02 05:00:00', 2, 1),
(6, 'Juego Sniper', 8000, '2018-01-02 05:00:00', 3, 1),
(7, 'Mama Comida', 20000, '2018-01-15 05:00:00', 4, 1),
(8, 'Curso Mecanica', 30000, '2018-01-15 05:00:00', 4, 1),
(9, 'Gasolina', 5000, '2018-01-15 05:00:00', 4, 1),
(11, 'Gel Ego', 2000, '2018-01-15 05:00:00', 4, 1),
(12, 'Recarga ', 1000, '2018-01-15 05:00:00', 4, 1),
(13, 'guarde ', 50000, '2018-01-15 05:00:00', 4, 1),
(15, 'guara', 34000, '2018-03-10 01:20:27', 4, 1),
(16, 'panel', 1200, '2018-03-12 23:26:49', 4, 1),
(17, 'almuerzo', 2000, '2018-03-12 23:28:11', 5, 1),
(18, 'Almuerzo', 2000, '2018-03-13 13:32:28', 5, 1),
(19, 'Desayuno', 2000, '2018-03-13 20:21:36', 5, 1),
(21, '2 Aguas', 600, '2018-03-13 20:22:46', 5, 1),
(22, 'almuerzo', 2000, '2018-03-14 17:10:49', 5, 1),
(23, 'mecato tarde', 3400, '2018-03-14 17:11:06', 5, 1),
(24, 'celular', 210000, '2018-03-14 23:39:45', 7, NULL),
(25, 'reloj', 150000, '2018-03-14 23:49:40', 8, NULL),
(26, 'soldadura Moto', 6000, '2018-03-15 14:54:39', 5, 1),
(27, 'peluquiada', 8000, '2018-03-15 22:52:05', 5, 1),
(30, 'almuerzo', 2000, '2018-03-16 21:26:10', 5, 1),
(32, 'Arroz florhuila', 1200, '2018-03-16 23:26:20', 10, NULL),
(33, 'yjug', 5000, '2018-03-17 04:47:15', 12, NULL),
(34, 'almuerzo', 30000, '2018-03-18 18:18:23', 11, 1),
(36, 'recarga', 2000, '2018-03-18 18:20:11', 11, 1),
(37, 'recarga', 2000, '2018-03-20 01:40:10', 11, 1),
(38, 'almuerzo', 2000, '2018-03-20 15:48:52', 11, 1),
(43, 'carrós ', 6000, '2018-03-20 23:42:05', 13, 8),
(44, 'mirca', 3000, '2018-03-20 23:42:16', 13, 8),
(45, 'tornillos moto Lorena', 1000, '2018-03-21 14:22:25', 11, 1),
(46, 'almuerzo', 2000, '2018-03-21 17:22:35', 11, 1),
(50, 'carrito', 20000, '2018-03-22 04:48:12', 13, 8),
(51, 're', 20000, '2018-03-22 04:49:42', 13, 8),
(52, 'nn', 20000, '2018-03-22 04:51:23', 13, 8),
(53, 'sorteo', 20000, '2018-03-22 05:05:10', 13, 8),
(55, 'parqueadero', 2000, '2018-03-23 03:24:44', 11, 1),
(56, 'gasolina', 3000, '2018-03-23 03:25:12', 11, 1),
(57, 'arepa ', 1000, '2018-03-23 03:25:29', 11, 1),
(58, 'agridulces', 2000, '2018-03-23 03:25:54', 11, 1),
(59, 'cerveza ', 2000, '2018-03-24 00:58:48', 11, 1),
(60, 'lavada de llantas', 2000, '2018-03-25 21:06:11', 15, 1),
(61, 'recarga', 1000, '2018-03-25 21:06:21', 15, 1),
(62, 'Arroz ', 20000, '2018-03-25 21:42:38', 16, 9),
(63, 'Arroz ', 20000, '2018-03-25 21:42:48', 16, 9),
(64, 'déspinchada', 5000, '2018-03-25 23:22:18', 15, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamo`
--

CREATE TABLE `prestamo` (
  `id_pre` int(11) NOT NULL,
  `precio_pre` int(11) NOT NULL,
  `id_usu` int(11) NOT NULL,
  `id_fia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `prestamo`
--

INSERT INTO `prestamo` (`id_pre`, `precio_pre`, `id_usu`, `id_fia`) VALUES
(1, 17000, 8, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `saldo`
--

CREATE TABLE `saldo` (
  `id_sal` int(11) NOT NULL,
  `n_saldo` int(11) NOT NULL,
  `id_sem` int(11) NOT NULL,
  `id_usu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `saldo`
--

INSERT INTO `saldo` (`id_sal`, `n_saldo`, `id_sem`, `id_usu`) VALUES
(2, 117000, 1, 1),
(3, 60000, 2, 1),
(4, 150000, 3, 1),
(5, 1000, 4, 1),
(6, 5000, 1, 3),
(7, 10000, 1, 4),
(8, 785000, 2, 4),
(9, 20000, 1, 5),
(10, 18800, 1, 6),
(11, 0, 5, 1),
(12, 605000, 1, 7),
(13, 40000, 1, 8),
(15, 12000, 6, 1),
(16, 1180000, 1, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usu` int(11) NOT NULL,
  `nombres_usu` varchar(60) NOT NULL,
  `telefono` varchar(60) NOT NULL,
  `correo_usu` varchar(60) NOT NULL,
  `pass_usu` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usu`, `nombres_usu`, `telefono`, `correo_usu`, `pass_usu`) VALUES
(1, 'Roque Castro Garzon', '3219368149', 'rokke1558@gmail.com', 'roke3215569231'),
(2, 'roque cas', '3215569231', 'rokke@gmail.con', '12'),
(3, 'juan', '32156648', 'roque', '12'),
(4, 'John Walter castro', '3003456783', 'johnwmotier@gmail.com', '1083874895'),
(5, 'Lorena Castro', '3227098495', 'lorenarros@hotmail.com', 'hijodemicorazon'),
(6, 'Yilber cano Grijalba', '3173252069', 'thor1994@hotmail.es', 'casimiro1994'),
(7, 'rr', '3215569287', 'roke', '1'),
(8, 'prueba', '123', 'prueba', 'prueba'),
(9, 'Justo Ortiz Garzon', '3165301599', 'justoog01@gmail.com', 'justicoog01');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `fiador`
--
ALTER TABLE `fiador`
  ADD PRIMARY KEY (`id_fia`);

--
-- Indices de la tabla `gasto`
--
ALTER TABLE `gasto`
  ADD PRIMARY KEY (`id_gas`),
  ADD KEY `id_sal` (`id_sal`);

--
-- Indices de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD PRIMARY KEY (`id_pre`);

--
-- Indices de la tabla `saldo`
--
ALTER TABLE `saldo`
  ADD PRIMARY KEY (`id_sal`),
  ADD KEY `id_sem` (`id_sem`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usu`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `fiador`
--
ALTER TABLE `fiador`
  MODIFY `id_fia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gasto`
--
ALTER TABLE `gasto`
  MODIFY `id_gas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  MODIFY `id_pre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `saldo`
--
ALTER TABLE `saldo`
  MODIFY `id_sal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
