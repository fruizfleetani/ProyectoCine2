-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-02-2022 a las 23:08:21
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `miclinica`
--

-- --------------------------------------------------------

--
-- Create table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `correo` varchar(60) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `apellidos` varchar(90) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Insert `admin`
--

-- Las contraseñas encriptadas son '12345678'


INSERT INTO `admin` (`id`, `correo`, `nombre`, `apellidos`, `password`) VALUES
(1, 'fernando@gmail.com', 'Fernando', 'Ruiz Fleetani', '$2y$04$YwP1ZcC2A4UYaGCSXwuToOkkR3cfQovXC.GEjGOW3qJLfGBPB7/gG');

-- --------------------------------------------------------

--
-- Create table `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `sesion_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Insert `resrervas`
--

INSERT INTO `reservas` VALUES
(3, 4, 1),
(4, 2, 1),
(5, 4, 2);

-- --------------------------------------------------------

--
-- Create table `sesiones`
--

CREATE TABLE `sesiones` (
  `id` int(11) NOT NULL,
  `pelicula` varchar(64) COLLATE utf8_bin NOT NULL,
  `fecha` datetime NOT NULL,
  `butacas_disponibles` int(3) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Insert `sesion`
--

INSERT INTO `sesiones` VALUES
(1, 'Spider-Man', '2022-03-22 16:00', 100),
(2, 'Batman', '2022-03-17 18:00', 200),
(3, 'Los pingüinos de Magadascar', '2022-03-18 20:00', 150),
(4, 'Lo Imposible', '2022-03-14 21:00', 100);

-- --------------------------------------------------------

--
-- Create table `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(64) COLLATE utf8_bin NOT NULL,
  `apellidos` varchar(64) COLLATE utf8_bin NOT NULL,
  `correo` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `alta` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Insert `clientes`
-- 

-- Las contraseñas encriptadas son '12345678'

INSERT INTO `clientes` (`id`, `nombre`, `apellidos`, `correo`, `password`, `alta`) VALUES
(2, 'Paula', 'Huertas Romano', 'paula@gmail.com', '$2y$04$YwP1ZcC2A4UYaGCSXwuToOkkR3cfQovXC.GEjGOW3qJLfGBPB7/gG', 0),
(4, 'Nuria', 'Jiménez Garrido', 'nuria@gmail.com', '$2y$04$YwP1ZcC2A4UYaGCSXwuToOkkR3cfQovXC.GEjGOW3qJLfGBPB7/gG', 1),
(5, 'Maria Isabel', 'Rodriguez', 'fernandilloyt@gmail.com', '$2y$04$YwP1ZcC2A4UYaGCSXwuToOkkR3cfQovXC.GEjGOW3qJLfGBPB7/gG', 1);

--
-- ALTER TABLE
--

--
-- KEYS `admin`
--

ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UQ_Admin_Correo` (`correo`);

--
-- KEYS `reservas`
--

ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_reserva_cliente` (`cliente_id`),
  ADD KEY `fk_reserva_sesion` (`sesion_id`);

--
-- KEYS `sesiones`
--
ALTER TABLE `sesiones`
  ADD PRIMARY KEY (`id`);

--
-- KEYS `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_correo` (`correo`);


--
-- AUTO_INCREMENT `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT `sesiones`
--
ALTER TABLE `sesiones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- FILTROS
--

ALTER TABLE `reservas`
  ADD CONSTRAINT `fk_reserva_sesion` FOREIGN KEY (`sesion_id`) REFERENCES `sesiones` (`id`),
  ADD CONSTRAINT `fk_reserva_cliente` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
