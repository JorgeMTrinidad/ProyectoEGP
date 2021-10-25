-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2021 at 03:43 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proyectoegp`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`, `condicion`, `created_at`, `updated_at`) VALUES
(1, 'Cementos', 'Todos los tipos de cementos', 1, NULL, NULL),
(2, 'Bolsas', 'Todas las bolsas.', 1, NULL, '2021-10-11 06:15:23'),
(3, 'Carpetas', 'Todas las carpetas', 1, '2021-10-10 11:00:21', '2021-10-11 06:15:11'),
(4, 'Lienzos', 'Aquí van todos los lienzos.', 1, '2021-10-12 13:25:06', '2021-10-12 13:25:13'),
(5, 'Block', 'Todos los tipos de blocks.', 1, '2021-10-19 01:12:52', '2021-10-19 01:13:05');

-- --------------------------------------------------------

--
-- Table structure for table `detalle_egresos`
--

CREATE TABLE `detalle_egresos` (
  `id` int(10) UNSIGNED NOT NULL,
  `idegreso` int(10) UNSIGNED NOT NULL,
  `idproducto` int(10) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(11,2) NOT NULL,
  `revision` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detalle_egresos`
--

INSERT INTO `detalle_egresos` (`id`, `idegreso`, `idproducto`, `cantidad`, `precio`, `revision`) VALUES
(1, 2, 1, 10, '25.00', 'CORRECTO'),
(2, 3, 2, 10, '45.00', 'CORRECTO'),
(3, 3, 1, 20, '25.00', 'INCORRECTO'),
(4, 3, 4, 10, '45.00', 'CORRECTO'),
(5, 3, 3, 30, '15.00', 'INCORRECTO'),
(6, 4, 6, 10, '78.00', 'CORRECTO'),
(7, 4, 4, 10, '45.00', 'CORRECTO');

--
-- Triggers `detalle_egresos`
--
DELIMITER $$
CREATE TRIGGER `tr_updStockVenta` AFTER INSERT ON `detalle_egresos` FOR EACH ROW BEGIN
 UPDATE productos SET stock = stock - NEW.cantidad 
 WHERE productos.id = NEW.idproducto;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `detalle_ingresos`
--

CREATE TABLE `detalle_ingresos` (
  `id` int(10) UNSIGNED NOT NULL,
  `idingreso` int(10) UNSIGNED NOT NULL,
  `idproducto` int(10) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(11,2) NOT NULL,
  `revision` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detalle_ingresos`
--

INSERT INTO `detalle_ingresos` (`id`, `idingreso`, `idproducto`, `cantidad`, `precio`, `revision`) VALUES
(2, 6, 1, 10, '12.00', 'CORRECTO'),
(3, 7, 2, 12, '16.00', 'INCORRECTO'),
(7, 11, 1, 10, '10.00', 'CORRECTO'),
(8, 12, 1, 12, '15.00', 'INCORRECTO'),
(9, 13, 1, 5000, '15.00', 'CORRECTO'),
(10, 14, 1, 10, '15.00', 'CORRECTO'),
(11, 14, 2, 1000, '10.00', 'CORRECTO'),
(12, 14, 3, 1000, '10.00', 'CORRECTO'),
(13, 14, 4, 1000, '10.00', 'INCORRECTO'),
(14, 15, 6, 1000, '78.00', 'INCORRECTO');

--
-- Triggers `detalle_ingresos`
--
DELIMITER $$
CREATE TRIGGER `tr_updStockIngreso` AFTER INSERT ON `detalle_ingresos` FOR EACH ROW BEGIN
 UPDATE productos SET stock = stock + NEW.cantidad 
 WHERE productos.id = NEW.idproducto;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `egresos`
--

CREATE TABLE `egresos` (
  `id` int(10) UNSIGNED NOT NULL,
  `idmaestroobras` int(10) UNSIGNED NOT NULL,
  `idusuario` int(10) UNSIGNED NOT NULL,
  `tipo_identificacion` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_egreso` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_egreso` datetime NOT NULL,
  `total` decimal(11,2) NOT NULL,
  `estado` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `egresos`
--

INSERT INTO `egresos` (`id`, `idmaestroobras`, `idusuario`, `tipo_identificacion`, `num_egreso`, `fecha_egreso`, `total`, `estado`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 'PICKINGLIST', '123', '2021-10-18 00:00:00', '250.00', 'Registrado', '2021-10-18 17:31:30', '2021-10-18 17:35:19'),
(3, 1, 1, 'PICKINGLIST', '489', '2021-10-18 00:00:00', '1850.00', 'Registrado', '2021-10-18 18:04:04', '2021-10-18 18:04:04'),
(4, 1, 1, 'PICKINGLIST', 'E000004', '2021-10-18 00:00:00', '1230.00', 'Anulado', '2021-10-18 18:47:09', '2021-10-18 18:47:17');

--
-- Triggers `egresos`
--
DELIMITER $$
CREATE TRIGGER ` tr_updStockEgresoAnular` AFTER UPDATE ON `egresos` FOR EACH ROW BEGIN
  UPDATE productos p
    JOIN detalle_egresos de
      ON de.idproducto = p.id
     AND de.idegreso= new.id
     set p.stock = p.stock + de.cantidad;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `NumAutoEgreso` BEFORE INSERT ON `egresos` FOR EACH ROW BEGIN
  DECLARE next_id INT;

  SET next_id = (SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='egresos');
  SET NEW.num_egreso = CONCAT('E', LPAD(next_id, 6, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ingresos`
--

CREATE TABLE `ingresos` (
  `id` int(10) UNSIGNED NOT NULL,
  `idproveedor` int(10) UNSIGNED NOT NULL,
  `idusuario` int(10) UNSIGNED NOT NULL,
  `tipo_identificacion` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_ingreso` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_ingreso` datetime NOT NULL,
  `total` decimal(11,2) NOT NULL,
  `review` int(11) NOT NULL DEFAULT 0 COMMENT '0=incorrect,1=correct',
  `estado` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ingresos`
--

INSERT INTO `ingresos` (`id`, `idproveedor`, `idusuario`, `tipo_identificacion`, `num_ingreso`, `fecha_ingreso`, `total`, `review`, `estado`, `created_at`, `updated_at`) VALUES
(6, 1, 1, 'FACTURA', '445', '2021-10-18 00:00:00', '120.00', 1, 'Registrado', '2021-10-18 08:34:46', '2021-10-20 22:09:35'),
(7, 1, 1, 'FACTURA', '454', '2021-10-18 00:00:00', '192.00', 1, 'Registrado', '2021-10-18 08:36:32', '2021-10-20 22:09:33'),
(11, 1, 1, 'FACTURA', '445', '2021-10-18 00:00:00', '100.00', 1, 'Registrado', '2021-10-18 16:45:46', '2021-10-20 22:09:30'),
(12, 1, 1, 'FACTURA', '789', '2021-10-18 00:00:00', '180.00', 0, 'Registrado', '2021-10-18 16:46:06', '2021-10-21 18:51:16'),
(13, 1, 1, 'FACTURA', '789', '2021-10-18 00:00:00', '75000.00', 0, 'Registrado', '2021-10-18 17:49:04', '2021-10-21 18:51:26'),
(14, 1, 1, 'FACTURA', '456', '2021-10-18 00:00:00', '30150.00', 0, 'Registrado', '2021-10-18 17:50:00', '2021-10-21 18:51:28'),
(15, 1, 1, 'FACTURA', '687', '2021-10-18 00:00:00', '78000.00', 0, 'Registrado', '2021-10-18 18:33:46', '2021-10-21 18:51:29');

--
-- Triggers `ingresos`
--
DELIMITER $$
CREATE TRIGGER `tr_updStockIngresoAnular` AFTER UPDATE ON `ingresos` FOR EACH ROW BEGIN
  UPDATE productos p
    JOIN detalle_ingresos di
      ON di.idproducto = p.id
     AND di.idingreso = new.id
     set p.stock = p.stock - di.cantidad;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `maestrosobras`
--

CREATE TABLE `maestrosobras` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_documento` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` varchar(70) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `maestrosobras`
--

INSERT INTO `maestrosobras` (`id`, `nombre`, `num_documento`, `direccion`, `telefono`, `email`, `created_at`, `updated_at`) VALUES
(1, 'Juan', '4589', 'Jalapa', '45595083', 'odjfo@gmail.com', '2021-10-13 09:37:27', '2021-10-13 09:37:27'),
(2, 'Federico', '45893', 'Huston', '2342342', 'jorgemariots10@gmail.com', '2021-10-13 10:08:46', '2021-10-13 10:08:46'),
(3, 'Pablo Ortiz', '213342423', 'Santa Rosa', '123124124', 'mi@gmail.com', '2021-10-13 12:28:05', '2021-10-13 13:36:33'),
(4, 'Hernesto', '3234234', 'Santa Rosa', '123124124', 'tu@gmail.com', '2021-10-17 06:26:47', '2021-10-17 06:26:55'),
(5, 'Aroldo', '54684554', 'Jalapa', '546845', 'aroldo@gmail.com', '2021-10-19 01:10:53', '2021-10-19 01:10:53');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2021_10_08_055438_create_categorias_table', 1),
(4, '2021_10_11_002825_create_productos_table', 2),
(5, '2021_10_13_015501_create_proveedores_table', 3),
(7, '2021_10_13_020919_create_maestrosobras_table', 4),
(8, '2021_10_14_024405_create_roles_table', 5),
(9, '2021_10_14_000000_create_users_table', 6),
(10, '2021_10_17_005822_add_features_to_users', 7),
(12, '2021_10_18_053331_create_ingresos_table', 8),
(14, '2021_10_18_053819_create_detalle_ingresoss_table', 9),
(15, '2021_10_18_023942_create_egresos_table', 10),
(16, '2021_10_18_024722_create_detalle_egresos_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `id` int(10) UNSIGNED NOT NULL,
  `idcategoria` int(10) UNSIGNED NOT NULL,
  `codigo` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio_venta` decimal(11,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id`, `idcategoria`, `codigo`, `nombre`, `precio_venta`, `stock`, `condicion`, `created_at`, `updated_at`) VALUES
(1, 1, '77001', 'Bolsas de cemento Progreso', '25.00', -39204, 1, '2021-10-12 11:47:40', '2021-10-12 11:47:57'),
(2, 4, '32423', 'Primer Lienzo', '45.00', -13012, 1, '2021-10-12 13:25:26', '2021-10-18 07:55:52'),
(3, 3, '898', 'Carpeta Femex', '15.00', -13000, 1, '2021-10-18 17:48:03', '2021-10-18 17:48:03'),
(4, 2, '789', 'Bolsa portatil', '45.00', -13000, 1, '2021-10-18 17:48:26', '2021-10-18 17:48:26'),
(6, 1, 'P000006', 'Cementos 2.0', '78.00', -19000, 1, '2021-10-18 18:24:39', '2021-10-18 18:34:23');

--
-- Triggers `productos`
--
DELIMITER $$
CREATE TRIGGER `NumAutoProduct` BEFORE INSERT ON `productos` FOR EACH ROW BEGIN
  DECLARE next_id INT;

  SET next_id = (SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='productos');
  SET NEW.codigo = CONCAT('P', LPAD(next_id, 6, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_documento` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_documento` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` varchar(70) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `proveedores`
--

INSERT INTO `proveedores` (`id`, `nombre`, `tipo_documento`, `num_documento`, `direccion`, `telefono`, `email`, `created_at`, `updated_at`) VALUES
(1, 'Wosowsky Pacheco', 'NIT', '78983049', 'Jalapa', '2312321', 'correo@gmail.com', '2021-10-13 08:07:42', '2021-10-13 12:26:58'),
(2, 'Estuardo', 'DPI', '546584654', 'Orlando', '4894654', 'estuardo@gmail.com', '2021-10-19 01:12:08', '2021-10-19 01:12:08');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `descripcion`, `condicion`) VALUES
(1, 'Supervisor', 'Supervisor', 1),
(2, 'Auxiliar', 'Auxiliar', 1),
(3, 'Auditor', 'Auditor', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_documento` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_documento` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` varchar(70) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `usuario` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT 1,
  `idrol` int(10) UNSIGNED NOT NULL,
  `forget_key` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expire_forget_key` datetime DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nombre`, `tipo_documento`, `num_documento`, `direccion`, `telefono`, `email`, `email_verified_at`, `usuario`, `password`, `condicion`, `idrol`, `forget_key`, `expire_forget_key`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Jorge Trinidad', 'DPI', '3390202612101', 'Jalapa', '45595083', 'jmarxts96@gmail.com', '0000-00-00 00:00:00', 'Jorge', '$2y$10$JpxYgMuMaGyZ5w6fWfqRE.hsnBui9.i03CO3VDru2c/I7S61EnjsO', 1, 1, '15dSHj', '2021-10-24 03:17:54', NULL, NULL, '2021-10-19 04:42:00'),
(2, 'Mario', 'DPI', '324234', 'Jalapa', '23423423', 'mario@gmail.com', '0000-00-00 00:00:00', 'Mario', '$2y$10$JpxYgMuMaGyZ5w6fWfqRE.hsnBui9.i03CO3VDru2c/I7S61EnjsO', 1, 2, 'gIfc2n', '2021-10-24 03:18:38', NULL, '2021-10-14 10:26:37', '2021-10-18 07:56:11'),
(3, 'Federico', 'CODE', '78965', 'Santo Tomas', '54865845', 'fede@gmail.com', NULL, 'Fede', '$2y$10$HVS/Rfs25m/z393R5M88DOnXfAut3LXYMNC4.Bpgv3uRJndRgeqOi', 1, 1, '', NULL, NULL, '2021-10-19 01:10:17', '2021-10-19 01:10:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categorias_nombre_unique` (`nombre`);

--
-- Indexes for table `detalle_egresos`
--
ALTER TABLE `detalle_egresos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_egresos_idegreso_foreign` (`idegreso`),
  ADD KEY `detalle_egresos_idproducto_foreign` (`idproducto`);

--
-- Indexes for table `detalle_ingresos`
--
ALTER TABLE `detalle_ingresos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_ingresos_idingreso_foreign` (`idingreso`),
  ADD KEY `detalle_ingresos_idproducto_foreign` (`idproducto`);

--
-- Indexes for table `egresos`
--
ALTER TABLE `egresos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `egresos_idmaestroobras_foreign` (`idmaestroobras`),
  ADD KEY `egresos_idusuario_foreign` (`idusuario`);

--
-- Indexes for table `ingresos`
--
ALTER TABLE `ingresos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ingresos_idproveedor_foreign` (`idproveedor`),
  ADD KEY `ingresos_idusuario_foreign` (`idusuario`);

--
-- Indexes for table `maestrosobras`
--
ALTER TABLE `maestrosobras`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `maestrosobras_nombre_unique` (`nombre`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `productos_nombre_unique` (`nombre`),
  ADD KEY `productos_idcategoria_foreign` (`idcategoria`);

--
-- Indexes for table `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `proveedores_nombre_unique` (`nombre`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_nombre_unique` (`nombre`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_usuario_unique` (`usuario`),
  ADD KEY `users_idrol_foreign` (`idrol`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `detalle_egresos`
--
ALTER TABLE `detalle_egresos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `detalle_ingresos`
--
ALTER TABLE `detalle_ingresos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `egresos`
--
ALTER TABLE `egresos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ingresos`
--
ALTER TABLE `ingresos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `maestrosobras`
--
ALTER TABLE `maestrosobras`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detalle_egresos`
--
ALTER TABLE `detalle_egresos`
  ADD CONSTRAINT `detalle_egresos_idegreso_foreign` FOREIGN KEY (`idegreso`) REFERENCES `egresos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detalle_egresos_idproducto_foreign` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`id`);

--
-- Constraints for table `detalle_ingresos`
--
ALTER TABLE `detalle_ingresos`
  ADD CONSTRAINT `detalle_ingresos_idingreso_foreign` FOREIGN KEY (`idingreso`) REFERENCES `ingresos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detalle_ingresos_idproducto_foreign` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`id`);

--
-- Constraints for table `egresos`
--
ALTER TABLE `egresos`
  ADD CONSTRAINT `egresos_idmaestroobras_foreign` FOREIGN KEY (`idmaestroobras`) REFERENCES `maestrosobras` (`id`),
  ADD CONSTRAINT `egresos_idusuario_foreign` FOREIGN KEY (`idusuario`) REFERENCES `users` (`id`);

--
-- Constraints for table `ingresos`
--
ALTER TABLE `ingresos`
  ADD CONSTRAINT `ingresos_idproveedor_foreign` FOREIGN KEY (`idproveedor`) REFERENCES `proveedores` (`id`),
  ADD CONSTRAINT `ingresos_idusuario_foreign` FOREIGN KEY (`idusuario`) REFERENCES `users` (`id`);

--
-- Constraints for table `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_idcategoria_foreign` FOREIGN KEY (`idcategoria`) REFERENCES `categorias` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_idrol_foreign` FOREIGN KEY (`idrol`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
