-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-09-2025 a las 21:24:55
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
-- Base de datos: `odiseoshop`
--
CREATE DATABASE IF NOT EXISTS `odiseoshop` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `odiseoshop`;

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre`) VALUES
(1, 'Ropa Superior'),
(2, 'Ropa Inferior'),
(3, 'Ropa Formal'),
(4, 'Ropa Deportiva'),
(5, 'Calzado'),
(6, 'Accesorios');

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) DEFAULT 0,
  `imagen` varchar(255) DEFAULT NULL,
  `imagenes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`imagenes`)),
  `marca` varchar(100) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `id_subcategoria` int(11) DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `ultima_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subcategorias`
--

CREATE TABLE `subcategorias` (
  `id_subcategoria` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcategorias`
--

INSERT INTO `subcategorias` (`id_subcategoria`, `id_categoria`, `nombre`) VALUES
(1, 1, 'Camisetas Básicas'),
(2, 1, 'Camisetas Estampadas'),
(3, 1, 'Polos'),
(4, 1, 'Oversize'),
(5, 1, 'Camisas Formales'),
(6, 1, 'Camisas Casual'),
(7, 1, 'Camisas de lino'),
(8, 1, 'Camisas manga corta'),
(9, 1, 'Suéteres'),
(10, 1, 'Buzos'),
(11, 1, 'Hoodies'),
(12, 1, 'Cardigans'),
(13, 1, 'Chaquetas de denim'),
(14, 1, 'Chaquetas de cuero'),
(15, 1, 'Bomber'),
(16, 1, 'Abrigos largos'),
(17, 1, 'Chalecos'),
(18, 2, 'Jeans Skinny'),
(19, 2, 'Jeans Slim'),
(20, 2, 'Jeans Regular'),
(21, 2, 'Jeans Rotos'),
(22, 2, 'Pantalones Cargo'),
(23, 2, 'Joggers'),
(24, 2, 'Chinos'),
(25, 2, 'Pantalones Formales'),
(26, 2, 'Shorts Casual'),
(27, 2, 'Shorts Deportivos'),
(28, 2, 'Shorts Cargo'),
(29, 3, 'Trajes - Sacos'),
(30, 3, 'Trajes - Pantalones de vestir'),
(31, 3, 'Camisas Formales'),
(32, 3, 'Corbatas'),
(33, 3, 'Pajaritas'),
(34, 3, 'Chalecos de vestir'),
(35, 4, 'Camisetas deportivas'),
(36, 4, 'Shorts deportivos'),
(37, 4, 'Joggers deportivos'),
(38, 4, 'Sudaderas'),
(39, 4, 'Ropa de gimnasio'),
(40, 5, 'Sneakers'),
(41, 5, 'Zapatos formales'),
(42, 5, 'Botas'),
(43, 5, 'Sandalias'),
(44, 6, 'Gorras'),
(45, 6, 'Sombreros'),
(46, 6, 'Cinturones'),
(47, 6, 'Carteras / Billeteras'),
(48, 6, 'Relojes'),
(49, 6, 'Gafas de sol'),
(50, 6, 'Bufandas'),
(51, 6, 'Guantes');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `correo` varchar(150) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `direccion_envio` varchar(255) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `imagen_perfil` longtext DEFAULT NULL,
  `rol` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `correo`, `clave`, `direccion_envio`, `telefono`, `fecha_registro`, `imagen_perfil`, `rol`) VALUES
(1, 'Hector', 'Maza', 'manuelhmhd@gmail.com', '12345', 'cl 46n #4n 31', '3054780788', '2025-09-13 02:25:15', NULL, '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_subcategoria` (`id_subcategoria`);

--
-- Indexes for table `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD PRIMARY KEY (`id_subcategoria`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subcategorias`
--
ALTER TABLE `subcategorias`
  MODIFY `id_subcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`id_subcategoria`) REFERENCES `subcategorias` (`id_subcategoria`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD CONSTRAINT `subcategorias_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;