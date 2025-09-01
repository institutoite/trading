-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-09-2025 a las 14:30:54
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `trading`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `blue_exchange_rates`
--

CREATE TABLE `blue_exchange_rates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `source` varchar(255) NOT NULL,
  `rate` decimal(16,8) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `blue_exchange_rates`
--

INSERT INTO `blue_exchange_rates` (`id`, `date`, `source`, `rate`, `type`, `created_at`, `updated_at`) VALUES
(1, '2025-08-02', 'Seeder', 16.25000000, 'buy', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(2, '2025-08-02', 'Seeder', 16.35000000, 'sell', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(3, '2025-08-03', 'Seeder', 16.17000000, 'buy', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(4, '2025-08-03', 'Seeder', 16.27000000, 'sell', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(5, '2025-08-04', 'Seeder', 16.14000000, 'buy', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(6, '2025-08-04', 'Seeder', 16.24000000, 'sell', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(7, '2025-08-05', 'Seeder', 15.88000000, 'buy', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(8, '2025-08-05', 'Seeder', 15.98000000, 'sell', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(9, '2025-08-06', 'Seeder', 15.86000000, 'buy', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(10, '2025-08-06', 'Seeder', 15.96000000, 'sell', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(11, '2025-08-07', 'Seeder', 15.63000000, 'buy', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(12, '2025-08-07', 'Seeder', 15.73000000, 'sell', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(13, '2025-08-08', 'Seeder', 15.54000000, 'buy', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(14, '2025-08-08', 'Seeder', 15.64000000, 'sell', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(15, '2025-08-09', 'Seeder', 15.32000000, 'buy', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(16, '2025-08-09', 'Seeder', 15.42000000, 'sell', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(17, '2025-08-10', 'Seeder', 15.17000000, 'buy', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(18, '2025-08-10', 'Seeder', 15.27000000, 'sell', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(19, '2025-08-11', 'Seeder', 15.16000000, 'buy', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(20, '2025-08-11', 'Seeder', 15.26000000, 'sell', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(21, '2025-08-12', 'Seeder', 15.06000000, 'buy', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(22, '2025-08-12', 'Seeder', 15.16000000, 'sell', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(23, '2025-08-13', 'Seeder', 14.96000000, 'buy', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(24, '2025-08-13', 'Seeder', 15.06000000, 'sell', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(25, '2025-08-14', 'Seeder', 14.83000000, 'buy', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(26, '2025-08-14', 'Seeder', 14.93000000, 'sell', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(27, '2025-08-15', 'Seeder', 14.56000000, 'buy', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(28, '2025-08-15', 'Seeder', 14.66000000, 'sell', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(29, '2025-08-16', 'Seeder', 14.48000000, 'buy', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(30, '2025-08-16', 'Seeder', 14.58000000, 'sell', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(31, '2025-08-17', 'Seeder', 14.46000000, 'buy', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(32, '2025-08-17', 'Seeder', 14.56000000, 'sell', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(33, '2025-08-18', 'Seeder', 14.34000000, 'buy', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(34, '2025-08-18', 'Seeder', 14.44000000, 'sell', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(35, '2025-08-19', 'Seeder', 14.17000000, 'buy', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(36, '2025-08-19', 'Seeder', 14.27000000, 'sell', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(37, '2025-08-20', 'Seeder', 13.98000000, 'buy', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(38, '2025-08-20', 'Seeder', 14.08000000, 'sell', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(39, '2025-08-21', 'Seeder', 13.88000000, 'buy', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(40, '2025-08-21', 'Seeder', 13.98000000, 'sell', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(41, '2025-08-22', 'Seeder', 13.70000000, 'buy', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(42, '2025-08-22', 'Seeder', 13.80000000, 'sell', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(43, '2025-08-23', 'Seeder', 13.66000000, 'buy', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(44, '2025-08-23', 'Seeder', 13.76000000, 'sell', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(45, '2025-08-24', 'Seeder', 13.48000000, 'buy', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(46, '2025-08-24', 'Seeder', 13.58000000, 'sell', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(47, '2025-08-25', 'Seeder', 13.30000000, 'buy', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(48, '2025-08-25', 'Seeder', 13.40000000, 'sell', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(49, '2025-08-26', 'Seeder', 13.20000000, 'buy', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(50, '2025-08-26', 'Seeder', 13.30000000, 'sell', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(51, '2025-08-27', 'Seeder', 13.13000000, 'buy', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(52, '2025-08-27', 'Seeder', 13.23000000, 'sell', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(53, '2025-08-28', 'Seeder', 12.88000000, 'buy', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(54, '2025-08-28', 'Seeder', 12.98000000, 'sell', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(55, '2025-08-29', 'Seeder', 12.90000000, 'buy', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(56, '2025-08-29', 'Seeder', 13.00000000, 'sell', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(57, '2025-08-30', 'Seeder', 12.64000000, 'buy', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(58, '2025-08-30', 'Seeder', 12.74000000, 'sell', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(59, '2025-08-31', 'Seeder', 12.67000000, 'buy', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(60, '2025-08-31', 'Seeder', 12.77000000, 'sell', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(61, '2025-09-01', 'Seeder', 12.38000000, 'buy', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(62, '2025-09-01', 'Seeder', 12.48000000, 'sell', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(63, '2025-09-01', 'https://www.dolarbluebolivia.click/api/exchange_currencies', 12.07000000, 'buy', '2025-09-01 14:42:16', '2025-09-01 14:42:16'),
(64, '2025-09-01', 'https://www.dolarbluebolivia.click/api/exchange_currencies', 12.14000000, 'sell', '2025-09-01 14:42:16', '2025-09-01 14:42:16'),
(65, '2025-09-01', 'https://www.dolarbluebolivia.click/api/exchange_currencies', 12.06000000, 'buy', '2025-09-01 14:51:03', '2025-09-01 14:51:03'),
(66, '2025-09-01', 'https://www.dolarbluebolivia.click/api/exchange_currencies', 12.12000000, 'sell', '2025-09-01 14:51:03', '2025-09-01 14:51:03'),
(67, '2025-09-01', 'https://www.dolarbluebolivia.click/api/exchange_currencies', 12.04000000, 'buy', '2025-09-01 15:49:47', '2025-09-01 15:49:47'),
(68, '2025-09-01', 'https://www.dolarbluebolivia.click/api/exchange_currencies', 12.11000000, 'sell', '2025-09-01 15:49:47', '2025-09-01 15:49:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `currencies`
--

INSERT INTO `currencies` (`id`, `code`, `name`, `created_at`, `updated_at`) VALUES
(1, 'BOB', 'Boliviano', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(2, 'USD', 'Dólar estadounidense', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(3, 'ARS', 'Peso argentino', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(4, 'CLP', 'Peso chileno', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(5, 'PEN', 'Sol peruano', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(6, 'EUR', 'Euro', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(7, 'BRL', 'Real brasileño', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(8, 'PYG', 'Guaraní paraguayo', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(9, 'COP', 'Peso colombiano', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(10, 'MXN', 'Peso mexicano', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(11, 'GBP', 'Libra esterlina', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(12, 'JPY', 'Yen japonés', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(13, 'CNY', 'Yuan chino', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(14, 'CHF', 'Franco suizo', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(15, 'CAD', 'Dólar canadiense', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(16, 'AUD', 'Dólar australiano', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(17, 'UYU', 'Peso uruguayo', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(18, 'VEF', 'Bolívar venezolano', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(19, 'DOP', 'Peso dominicano', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(20, 'GTQ', 'Quetzal guatemalteco', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(21, 'HNL', 'Lempira hondureño', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(22, 'CRC', 'Colón costarricense', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(23, 'NIO', 'Córdoba nicaragüense', '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(24, 'SVC', 'Colón salvadoreño', '2025-09-01 14:41:53', '2025-09-01 14:41:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `currency_exchange_rates`
--

CREATE TABLE `currency_exchange_rates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `currency` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `rate` decimal(16,8) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `currency_exchange_rates`
--

INSERT INTO `currency_exchange_rates` (`id`, `date`, `currency`, `type`, `rate`, `created_at`, `updated_at`) VALUES
(1, '2025-09-01', 'Euro', 'buy', 0.86000000, '2025-09-01 14:42:16', '2025-09-01 15:49:47'),
(2, '2025-09-01', 'Euro', 'sell', 0.87000000, '2025-09-01 14:42:16', '2025-09-01 15:49:47'),
(3, '2025-09-01', 'Libra Esterlina', 'buy', 0.75000000, '2025-09-01 14:42:16', '2025-09-01 15:49:47'),
(4, '2025-09-01', 'Libra Esterlina', 'sell', 0.75000000, '2025-09-01 14:42:16', '2025-09-01 15:49:47'),
(5, '2025-09-01', 'Peso Argentino', 'buy', 1362.89000000, '2025-09-01 14:42:16', '2025-09-01 15:49:47'),
(6, '2025-09-01', 'Peso Argentino', 'sell', 1353.10000000, '2025-09-01 14:42:16', '2025-09-01 15:49:47'),
(7, '2025-09-01', 'Peso Chileno', 'buy', 977.00000000, '2025-09-01 14:42:16', '2025-09-01 15:49:47'),
(8, '2025-09-01', 'Peso Chileno', 'sell', 969.51000000, '2025-09-01 14:42:16', '2025-09-01 15:49:47'),
(9, '2025-09-01', 'Real Brasileño', 'buy', 5.43000000, '2025-09-01 14:42:16', '2025-09-01 15:49:47'),
(10, '2025-09-01', 'Real Brasileño', 'sell', 5.43000000, '2025-09-01 14:42:16', '2025-09-01 15:49:47'),
(11, '2025-09-01', 'Sol Peruano', 'buy', 3.58000000, '2025-09-01 14:42:16', '2025-09-01 15:49:47'),
(12, '2025-09-01', 'Sol Peruano', 'sell', 3.54000000, '2025-09-01 14:42:16', '2025-09-01 15:49:47'),
(13, '2025-09-01', 'Yuan Chino', 'buy', 7.14000000, '2025-09-01 14:42:16', '2025-09-01 15:49:47'),
(14, '2025-09-01', 'Yuan Chino', 'sell', 7.14000000, '2025-09-01 14:42:16', '2025-09-01 15:49:47'),
(15, '2025-09-01', 'blue', 'buy', 12.04000000, '2025-09-01 14:42:16', '2025-09-01 15:49:47'),
(16, '2025-09-01', 'blue', 'sell', 12.11000000, '2025-09-01 14:42:16', '2025-09-01 15:49:47'),
(17, '2025-09-01', 'official', 'buy', 6.86000000, '2025-09-01 14:42:16', '2025-09-01 15:49:47'),
(18, '2025-09-01', 'official', 'sell', 6.96000000, '2025-09-01 14:42:16', '2025-09-01 15:49:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exchange_rates`
--

CREATE TABLE `exchange_rates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from_currency_id` bigint(20) UNSIGNED NOT NULL,
  `to_currency_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `rate` decimal(16,8) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `exchange_rates`
--

INSERT INTO `exchange_rates` (`id`, `from_currency_id`, `to_currency_id`, `date`, `rate`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2025-09-01', 0.14000000, '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(2, 2, 1, '2025-09-01', 7.00000000, '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(3, 1, 3, '2025-09-01', 3.50000000, '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(4, 3, 2, '2025-09-01', 0.00100000, '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(5, 2, 3, '2025-09-01', 950.00000000, '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(6, 1, 4, '2025-09-01', 120.00000000, '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(7, 4, 2, '2025-09-01', 0.00110000, '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(8, 2, 4, '2025-09-01', 900.00000000, '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(9, 1, 5, '2025-09-01', 0.38000000, '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(10, 5, 2, '2025-09-01', 0.27000000, '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(11, 2, 5, '2025-09-01', 3.70000000, '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(12, 3, 4, '2025-09-01', 8.50000000, '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(13, 4, 3, '2025-09-01', 0.12000000, '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(14, 3, 5, '2025-09-01', 0.00400000, '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(15, 5, 3, '2025-09-01', 250.00000000, '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(16, 4, 5, '2025-09-01', 0.00300000, '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(17, 5, 4, '2025-09-01', 330.00000000, '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(18, 1, 6, '2025-09-01', 0.13000000, '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(19, 6, 1, '2025-09-01', 7.70000000, '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(20, 2, 6, '2025-09-01', 0.92000000, '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(21, 6, 2, '2025-09-01', 1.09000000, '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(22, 3, 6, '2025-09-01', 0.00090000, '2025-09-01 14:41:53', '2025-09-01 14:41:53'),
(23, 6, 3, '2025-09-01', 1100.00000000, '2025-09-01 14:41:53', '2025-09-01 14:41:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_08_27_000000_create_currencies_table', 1),
(6, '2025_08_27_000001_create_exchange_rates_table', 1),
(7, '2025_08_28_000000_create_blue_exchange_rates_table', 1),
(8, '2025_08_28_000001_create_currency_exchange_rates_table', 1),
(9, '2025_09_01_101854_create_official_exchange_rates_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `official_exchange_rates`
--

CREATE TABLE `official_exchange_rates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `currency` varchar(255) NOT NULL DEFAULT 'usd',
  `buy` decimal(10,4) NOT NULL,
  `sell` decimal(10,4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `official_exchange_rates`
--

INSERT INTO `official_exchange_rates` (`id`, `date`, `currency`, `buy`, `sell`, `created_at`, `updated_at`) VALUES
(1, '2025-09-01', 'usd', 6.8600, 6.9600, '2025-09-01 14:41:53', '2025-09-01 14:41:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `blue_exchange_rates`
--
ALTER TABLE `blue_exchange_rates`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `currencies_code_unique` (`code`);

--
-- Indices de la tabla `currency_exchange_rates`
--
ALTER TABLE `currency_exchange_rates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `currency_exchange_rates_date_currency_type_unique` (`date`,`currency`,`type`);

--
-- Indices de la tabla `exchange_rates`
--
ALTER TABLE `exchange_rates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `exchange_rates_from_currency_id_to_currency_id_date_unique` (`from_currency_id`,`to_currency_id`,`date`),
  ADD KEY `exchange_rates_to_currency_id_foreign` (`to_currency_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `official_exchange_rates`
--
ALTER TABLE `official_exchange_rates`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `blue_exchange_rates`
--
ALTER TABLE `blue_exchange_rates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de la tabla `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `currency_exchange_rates`
--
ALTER TABLE `currency_exchange_rates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `exchange_rates`
--
ALTER TABLE `exchange_rates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `official_exchange_rates`
--
ALTER TABLE `official_exchange_rates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `exchange_rates`
--
ALTER TABLE `exchange_rates`
  ADD CONSTRAINT `exchange_rates_from_currency_id_foreign` FOREIGN KEY (`from_currency_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exchange_rates_to_currency_id_foreign` FOREIGN KEY (`to_currency_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
