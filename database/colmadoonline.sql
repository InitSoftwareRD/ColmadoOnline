-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-11-2019 a las 22:45:27
-- Versión del servidor: 10.1.35-MariaDB
-- Versión de PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `colmadoonline`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('A','I') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'BEBIDA', 'A', '2019-11-02 20:44:06', '2019-11-02 20:44:06'),
(2, 'COMIDAS', 'A', '2019-11-04 20:28:05', '2019-11-04 20:28:05'),
(3, 'JUGO NATURALES', 'I', '2019-11-15 22:27:21', '2019-11-15 22:27:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `customers`
--

INSERT INTO `customers` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2019-11-02 20:43:40', '2019-11-02 20:43:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `image_product`
--

CREATE TABLE `image_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ruta` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `tipo` enum('P','S') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `image_product`
--

INSERT INTO `image_product` (`id`, `ruta`, `product_id`, `tipo`, `created_at`, `updated_at`) VALUES
(1, 'images/1572727476coca-cola-classic.jpg', 1, 'P', '2019-11-02 20:44:36', '2019-11-02 20:44:36'),
(2, 'images/15728994027up.jpg', 2, 'P', '2019-11-04 20:30:02', '2019-11-04 20:30:02'),
(3, 'images/1572899426download.jpg', 3, 'P', '2019-11-04 20:30:26', '2019-11-04 20:30:26'),
(4, 'images/1572899452JUGO_DE_LIMON.jpg', 4, 'P', '2019-11-04 20:30:52', '2019-11-04 20:30:52'),
(5, 'images/1572899480lechoza.jpg', 5, 'P', '2019-11-04 20:31:20', '2019-11-04 20:31:20'),
(6, 'images/1573857050jugo-de-naranja-natural.jpg', 6, 'P', '2019-11-15 22:30:51', '2019-11-15 22:30:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(39, '2014_10_11_012313_create_rol_table', 1),
(40, '2014_10_12_000000_create_users_table', 1),
(41, '2014_10_12_100000_create_password_resets_table', 1),
(42, '2014_10_20_145410_create_order_status_table', 1),
(43, '2018_10_15_011337_create_category_table', 1),
(44, '2019_08_19_000000_create_failed_jobs_table', 1),
(45, '2019_10_15_011038_create_customers_table', 1),
(46, '2019_10_15_011132_create_orders_table', 1),
(47, '2019_10_15_011251_create_products_table', 1),
(48, '2019_10_15_011288_create_order_product_table', 1),
(49, '2019_10_15_011308_create_offers_table', 1),
(50, '2019_10_20_143825_create_image_product_table', 1),
(51, '2019_10_21_215409_create_order_tracking_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `offers`
--

CREATE TABLE `offers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `begin_at` timestamp NULL DEFAULT NULL,
  `end_at` timestamp NULL DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('A','I') COLLATE utf8mb4_unicode_ci NOT NULL,
  `promotion_text` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `total` double(8,2) NOT NULL,
  `paid_with` double(8,2) DEFAULT NULL,
  `change` double(8,2) DEFAULT NULL,
  `ping` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `canal` enum('I','C') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `customer_id`, `total`, `paid_with`, `change`, `ping`, `location`, `canal`, `created_at`, `updated_at`) VALUES
(9, 1, 1, 15550.00, NULL, NULL, '255995', NULL, 'C', '2019-11-04 20:31:53', '2019-11-04 20:31:53'),
(10, 1, 1, 61200.00, NULL, NULL, '367042', NULL, 'C', '2019-11-04 20:32:48', '2019-11-04 20:32:48'),
(11, 1, 1, 45450.00, NULL, NULL, '860709', NULL, 'C', '2019-11-04 20:33:42', '2019-11-04 20:33:42'),
(12, 1, 1, 30700.00, NULL, NULL, '142204', NULL, 'C', '2019-11-15 21:51:46', '2019-11-15 21:51:46'),
(13, 1, 1, 15200.00, NULL, NULL, '503080', NULL, 'C', '2019-11-15 22:42:11', '2019-11-15 22:42:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order_product`
--

CREATE TABLE `order_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double(8,2) NOT NULL,
  `subtotal` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `order_product`
--

INSERT INTO `order_product` (`id`, `order_id`, `product_id`, `quantity`, `price`, `subtotal`, `created_at`, `updated_at`) VALUES
(3, 9, 1, 1, 200.00, 200.00, '2019-11-04 20:31:53', '2019-11-04 20:31:53'),
(4, 9, 2, 1, 150.00, 150.00, '2019-11-04 20:31:53', '2019-11-04 20:31:53'),
(5, 9, 3, 1, 15000.00, 15000.00, '2019-11-04 20:31:53', '2019-11-04 20:31:53'),
(6, 9, 4, 1, 100.00, 100.00, '2019-11-04 20:31:53', '2019-11-04 20:31:53'),
(7, 9, 5, 1, 100.00, 100.00, '2019-11-04 20:31:53', '2019-11-04 20:31:53'),
(8, 10, 2, 4, 150.00, 600.00, '2019-11-04 20:32:48', '2019-11-04 20:32:48'),
(9, 10, 1, 3, 200.00, 600.00, '2019-11-04 20:32:48', '2019-11-04 20:32:48'),
(10, 10, 3, 4, 15000.00, 60000.00, '2019-11-04 20:32:48', '2019-11-04 20:32:48'),
(11, 11, 1, 1, 200.00, 200.00, '2019-11-04 20:33:42', '2019-11-04 20:33:42'),
(12, 11, 2, 1, 150.00, 150.00, '2019-11-04 20:33:42', '2019-11-04 20:33:42'),
(13, 11, 3, 3, 15000.00, 45000.00, '2019-11-04 20:33:42', '2019-11-04 20:33:42'),
(14, 11, 4, 1, 100.00, 100.00, '2019-11-04 20:33:42', '2019-11-04 20:33:42'),
(15, 12, 2, 1, 150.00, 150.00, '2019-11-15 21:51:46', '2019-11-15 21:51:46'),
(16, 12, 3, 1, 15000.00, 15000.00, '2019-11-15 21:51:46', '2019-11-15 21:51:46'),
(17, 12, 4, 1, 100.00, 100.00, '2019-11-15 21:51:46', '2019-11-15 21:51:46'),
(18, 12, 5, 3, 100.00, 300.00, '2019-11-15 21:51:46', '2019-11-15 21:51:46'),
(19, 12, 3, 1, 15000.00, 15000.00, '2019-11-15 21:51:46', '2019-11-15 21:51:46'),
(20, 12, 2, 1, 150.00, 150.00, '2019-11-15 21:51:47', '2019-11-15 21:51:47'),
(21, 13, 3, 1, 15000.00, 15000.00, '2019-11-15 22:42:11', '2019-11-15 22:42:11'),
(22, 13, 6, 1, 200.00, 200.00, '2019-11-15 22:42:11', '2019-11-15 22:42:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order_status`
--

CREATE TABLE `order_status` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `order_status`
--

INSERT INTO `order_status` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'En Espera', NULL, NULL),
(2, 'En Proceso', NULL, NULL),
(3, 'Preparado', NULL, NULL),
(4, 'En Camino', NULL, NULL),
(5, 'Finalizado', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order_tracking`
--

CREATE TABLE `order_tracking` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `order_status` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `order_tracking`
--

INSERT INTO `order_tracking` (`id`, `order_id`, `order_status`, `created_at`, `updated_at`) VALUES
(3, 9, 1, '2019-11-04 20:31:53', '2019-11-04 20:31:53'),
(4, 10, 1, '2019-11-04 20:32:48', '2019-11-04 20:32:48'),
(5, 11, 1, '2019-11-04 20:33:42', '2019-11-04 20:33:42'),
(6, 9, 2, '2019-11-05 08:15:30', NULL),
(7, 9, 1, '2019-11-07 22:49:32', '2019-11-07 22:49:32'),
(8, 9, 3, '2019-11-07 22:53:10', '2019-11-07 22:53:10'),
(9, 9, 1, '2019-11-07 22:53:24', '2019-11-07 22:53:24'),
(10, 9, 3, '2019-11-07 22:53:36', '2019-11-07 22:53:36'),
(11, 9, 5, '2019-11-07 23:01:02', '2019-11-07 23:01:02'),
(12, 9, 2, '2019-11-07 23:02:31', '2019-11-07 23:02:31'),
(13, 9, 2, '2019-11-07 23:03:41', '2019-11-07 23:03:41'),
(14, 9, 3, '2019-11-07 23:03:56', '2019-11-07 23:03:56'),
(15, 9, 1, '2019-11-07 23:06:36', '2019-11-07 23:06:36'),
(16, 9, 2, '2019-11-07 23:07:56', '2019-11-07 23:07:56'),
(17, 9, 3, '2019-11-07 23:08:06', '2019-11-07 23:08:06'),
(18, 9, 5, '2019-11-08 00:29:59', '2019-11-08 00:29:59'),
(19, 10, 2, '2019-11-08 00:40:13', '2019-11-08 00:40:13'),
(20, 12, 1, '2019-11-15 21:51:47', '2019-11-15 21:51:47'),
(21, 12, 2, '2019-11-15 21:56:03', '2019-11-15 21:56:03'),
(22, 13, 1, '2019-11-15 22:42:11', '2019-11-15 22:42:11'),
(23, 13, 2, '2019-11-15 22:45:16', '2019-11-15 22:45:16'),
(24, 10, 3, '2019-11-19 22:24:18', '2019-11-19 22:24:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `ingredients` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `status` enum('A','I') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `description`, `ingredients`, `price`, `status`, `created_at`, `updated_at`) VALUES
(1, 'SODA', 1, 'Los mismo de siempre', 'Los mismos de siempre', 200.00, 'A', '2019-11-02 20:44:36', '2019-11-02 20:44:36'),
(2, 'SEVEN UP', 1, 'Los mismo de siempre', 'Los mismos de siempre', 150.00, 'A', '2019-11-04 20:30:02', '2019-11-04 20:30:02'),
(3, 'SANDWICH', 2, 'Los mismo de siempre', 'Los mismos de siempre', 15000.00, 'A', '2019-11-04 20:30:26', '2019-11-04 20:30:26'),
(4, 'JUGO DE LIMON', 1, 'Los mismo de siempre', 'Los mismos de siempre', 100.00, 'A', '2019-11-04 20:30:52', '2019-11-04 20:30:52'),
(5, 'BATIDO DE LECHOZA', 1, 'Los mismo de siempre', 'Los mismos de siempre', 100.00, 'A', '2019-11-04 20:31:20', '2019-11-04 20:31:20'),
(6, 'JUGO NARANJA', 3, 'Los mismo de siempre', 'Los mismos de siempre', 200.00, 'A', '2019-11-15 22:30:50', '2019-11-15 22:30:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Cliente', NULL, NULL),
(2, 'Delivery', NULL, NULL),
(3, 'Cajero', NULL, NULL),
(4, 'Administrador', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sex` enum('M','F','O') COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identity` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('A','I') COLLATE utf8mb4_unicode_ci NOT NULL,
  `rol_id` bigint(20) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `sex`, `email`, `email_verified_at`, `password`, `identity`, `phone`, `status`, `rol_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Cristian', 'Gomez', 'M', 'cgomez@alaver.com.do', NULL, '$2y$10$M0OCL5HfGw75O/wLAeEqjetCoa0sltct1QU/m5PFkdsOV2ni7Qx1q', NULL, '8292956010', 'A', 1, NULL, '2019-11-02 20:43:40', '2019-11-02 20:43:40'),
(2, 'Randy', 'Dilone', 'M', 'rdilone@alaver.com.do', NULL, '$2y$10$VG7A1YEtIttjSKgMhM7U3OICVLLh8Q/6VSnXwgDNf5d6wLyMNzDCy', NULL, '8292956010', 'A', 4, '4sVZcZQiJonSSlMZjiV2Ko23qswIEkYu7D7DqeQ71RKqLW3kqPRjPcFD5z8F', '2019-11-09 23:50:13', '2019-11-09 23:50:13'),
(3, 'Erimir', 'Reyes', 'M', 'reyes@reyes.com', NULL, '$2y$10$CpkSsxU5DijHLa9cLTmAQ.LBSB2TOF3dloiArHc3CQGgV8xY1s4DC', NULL, '8292956010', 'A', 2, NULL, '2019-11-15 22:23:49', '2019-11-15 22:23:49');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_name_unique` (`name`);

--
-- Indices de la tabla `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_user_id_unique` (`user_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `image_product`
--
ALTER TABLE `image_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `image_product_product_id_foreign` (`product_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offers_product_id_foreign` (`product_id`);

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_customer_id_foreign` (`customer_id`);

--
-- Indices de la tabla `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_product_order_id_foreign` (`order_id`),
  ADD KEY `order_product_product_id_foreign` (`product_id`);

--
-- Indices de la tabla `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `order_tracking`
--
ALTER TABLE `order_tracking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_tracking_order_id_foreign` (`order_id`),
  ADD KEY `order_tracking_order_status_foreign` (`order_status`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_rol_id_foreign` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `image_product`
--
ALTER TABLE `image_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `offers`
--
ALTER TABLE `offers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `order_product`
--
ALTER TABLE `order_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `order_tracking`
--
ALTER TABLE `order_tracking`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `image_product`
--
ALTER TABLE `image_product`
  ADD CONSTRAINT `image_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Filtros para la tabla `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `offers_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Filtros para la tabla `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `order_product_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Filtros para la tabla `order_tracking`
--
ALTER TABLE `order_tracking`
  ADD CONSTRAINT `order_tracking_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_tracking_order_status_foreign` FOREIGN KEY (`order_status`) REFERENCES `order_status` (`id`);

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_rol_id_foreign` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
