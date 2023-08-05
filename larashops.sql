-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Agu 2023 pada 19.48
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `larashops`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `attributes`
--

CREATE TABLE `attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `validation` varchar(255) DEFAULT NULL,
  `is_required` tinyint(1) NOT NULL DEFAULT 0,
  `is_unique` tinyint(1) NOT NULL DEFAULT 0,
  `is_filterable` tinyint(1) NOT NULL DEFAULT 0,
  `is_configurable` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `attributes`
--

INSERT INTO `attributes` (`id`, `code`, `name`, `type`, `validation`, `is_required`, `is_unique`, `is_filterable`, `is_configurable`, `created_at`, `updated_at`) VALUES
(1, 'size', 'Size', 'select', NULL, 0, 0, 1, 1, '2023-08-04 10:38:57', '2023-08-04 10:38:57'),
(2, 'color', 'Color', 'select', NULL, 0, 0, 1, 1, '2023-08-04 10:39:14', '2023-08-04 10:39:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `attribute_options`
--

CREATE TABLE `attribute_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `attribute_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `attribute_options`
--

INSERT INTO `attribute_options` (`id`, `attribute_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 2, 'Original', '2023-08-04 10:39:26', '2023-08-04 10:39:26'),
(2, 2, 'Black', '2023-08-04 10:39:43', '2023-08-04 10:39:43'),
(3, 1, 'XL', '2023-08-04 10:39:53', '2023-08-04 10:39:53'),
(4, 1, 'M', '2023-08-04 10:39:57', '2023-08-04 10:39:57'),
(5, 1, 'L', '2023-08-04 10:40:00', '2023-08-04 10:40:00'),
(6, 1, 'XXL', '2023-08-04 10:40:05', '2023-08-04 10:40:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `parent_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Pakaian Pria', 'pakaian-pria', 0, '2023-08-04 10:38:17', '2023-08-04 10:38:17'),
(2, 'Pakaian Wanita', 'pakaian-wanita', 0, '2023-08-04 10:38:37', '2023-08-04 10:38:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(61, '2014_10_12_000000_create_users_table', 1),
(62, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(63, '2014_10_12_100000_create_password_resets_table', 1),
(64, '2019_08_19_000000_create_failed_jobs_table', 1),
(65, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(66, '2023_07_29_135318_create_categories_table', 1),
(67, '2023_07_30_043100_create_products_table', 1),
(68, '2023_07_30_071129_create_attributes_table', 1),
(69, '2023_07_30_071356_product_attribute_values', 1),
(70, '2023_07_30_071738_create_product_inventories_table', 1),
(71, '2023_07_30_071856_create_product_categories_table', 1),
(72, '2023_07_30_071953_create_product_images_table', 1),
(73, '2023_07_31_064456_add_columns_to_attributes_table', 1),
(74, '2023_07_31_065112_create_attribute_options_table', 1),
(75, '2023_08_01_170717_remove_column_product_attribute_value_id_in_product_inventories_table', 1),
(76, '2023_08_01_171205_add_parent_id_and_type_to_products_table', 1),
(77, '2023_08_01_171437_alter_as_nullable_column_in_products_table', 1),
(78, '2023_08_01_171741_alter_attribute_relation_in_product_attribute_values_table', 1),
(79, '2023_08_02_110951_create_permission_tables', 1),
(80, '2023_08_03_140217_add_full_text_search_index_to_products_table', 1),
(81, '2023_08_03_162536_rename_column_and_columns_in_users_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view_users', 'web', '2023-08-04 10:27:26', '2023-08-04 10:27:26'),
(2, 'add_users', 'web', '2023-08-04 10:27:26', '2023-08-04 10:27:26'),
(3, 'edit_users', 'web', '2023-08-04 10:27:26', '2023-08-04 10:27:26'),
(4, 'delete_users', 'web', '2023-08-04 10:27:26', '2023-08-04 10:27:26'),
(5, 'view_roles', 'web', '2023-08-04 10:27:26', '2023-08-04 10:27:26'),
(6, 'add_roles', 'web', '2023-08-04 10:27:26', '2023-08-04 10:27:26'),
(7, 'edit_roles', 'web', '2023-08-04 10:27:26', '2023-08-04 10:27:26'),
(8, 'delete_roles', 'web', '2023-08-04 10:27:26', '2023-08-04 10:27:26'),
(9, 'view_products', 'web', '2023-08-04 10:27:26', '2023-08-04 10:27:26'),
(10, 'add_products', 'web', '2023-08-04 10:27:26', '2023-08-04 10:27:26'),
(11, 'edit_products', 'web', '2023-08-04 10:27:26', '2023-08-04 10:27:26'),
(12, 'delete_products', 'web', '2023-08-04 10:27:26', '2023-08-04 10:27:26'),
(13, 'view_orders', 'web', '2023-08-04 10:27:26', '2023-08-04 10:27:26'),
(14, 'add_orders', 'web', '2023-08-04 10:27:26', '2023-08-04 10:27:26'),
(15, 'edit_orders', 'web', '2023-08-04 10:27:26', '2023-08-04 10:27:26'),
(16, 'delete_orders', 'web', '2023-08-04 10:27:26', '2023-08-04 10:27:26'),
(17, 'view_categories', 'web', '2023-08-04 10:27:26', '2023-08-04 10:27:26'),
(18, 'add_categories', 'web', '2023-08-04 10:27:26', '2023-08-04 10:27:26'),
(19, 'edit_categories', 'web', '2023-08-04 10:27:26', '2023-08-04 10:27:26'),
(20, 'delete_categories', 'web', '2023-08-04 10:27:26', '2023-08-04 10:27:26'),
(21, 'view_attributes', 'web', '2023-08-04 10:27:26', '2023-08-04 10:27:26'),
(22, 'add_attributes', 'web', '2023-08-04 10:27:26', '2023-08-04 10:27:26'),
(23, 'edit_attributes', 'web', '2023-08-04 10:27:26', '2023-08-04 10:27:26'),
(24, 'delete_attributes', 'web', '2023-08-04 10:27:26', '2023-08-04 10:27:26'),
(25, 'view_shipments', 'web', '2023-08-04 10:27:26', '2023-08-04 10:27:26'),
(26, 'add_shipments', 'web', '2023-08-04 10:27:26', '2023-08-04 10:27:26'),
(27, 'edit_shipments', 'web', '2023-08-04 10:27:26', '2023-08-04 10:27:26'),
(28, 'delete_shipments', 'web', '2023-08-04 10:27:26', '2023-08-04 10:27:26'),
(29, 'view_slides', 'web', '2023-08-04 10:27:26', '2023-08-04 10:27:26'),
(30, 'add_slides', 'web', '2023-08-04 10:27:26', '2023-08-04 10:27:26'),
(31, 'edit_slides', 'web', '2023-08-04 10:27:26', '2023-08-04 10:27:26'),
(32, 'delete_slides', 'web', '2023-08-04 10:27:26', '2023-08-04 10:27:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
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
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `sku` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `weight` decimal(15,2) DEFAULT NULL,
  `width` decimal(10,2) DEFAULT NULL,
  `height` decimal(10,2) DEFAULT NULL,
  `length` decimal(10,2) DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `parent_id`, `user_id`, `sku`, `type`, `name`, `slug`, `price`, `weight`, `width`, `height`, `length`, `short_description`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 'AB1214', 'configurable', 'Kaos Polos', 'kaos-polos', NULL, NULL, NULL, NULL, NULL, 'What is Lorem Ipsum?\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'What is Lorem Ipsum?\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nWhy do we use it?\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\r\n\r\n\r\nWhere does it come from?\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', 1, '2023-08-04 10:40:39', '2023-08-04 10:42:07'),
(2, 1, 1, 'AB1214-3-2', 'simple', 'Kaos Polos - XL - Black', 'kaos-polos-xl-black', 120000.00, 1500.00, NULL, NULL, NULL, NULL, NULL, 1, '2023-08-04 10:40:39', '2023-08-04 10:42:07'),
(3, 1, 1, 'AB1214-4-2', 'simple', 'Kaos Polos - M - Black', 'kaos-polos-m-black', 120000.00, 1500.00, NULL, NULL, NULL, NULL, NULL, 1, '2023-08-04 10:40:39', '2023-08-04 10:42:07'),
(4, 1, 1, 'AB1214-5-2', 'simple', 'Kaos Polos - L - Black', 'kaos-polos-l-black', 120000.00, 1500.00, NULL, NULL, NULL, NULL, NULL, 1, '2023-08-04 10:40:39', '2023-08-04 10:42:07'),
(5, 1, 1, 'AB1214-6-2', 'simple', 'Kaos Polos - XXL - Black', 'kaos-polos-xxl-black', 120000.00, 1500.00, NULL, NULL, NULL, NULL, NULL, 1, '2023-08-04 10:40:39', '2023-08-04 10:42:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_attribute_values`
--

CREATE TABLE `product_attribute_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `attribute_id` bigint(20) UNSIGNED NOT NULL,
  `text_value` text DEFAULT NULL,
  `boolean_value` tinyint(1) DEFAULT NULL,
  `integer_value` int(11) DEFAULT NULL,
  `float_value` decimal(8,2) DEFAULT NULL,
  `datetime_value` datetime DEFAULT NULL,
  `date_value` date DEFAULT NULL,
  `json_value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `product_attribute_values`
--

INSERT INTO `product_attribute_values` (`id`, `product_id`, `attribute_id`, `text_value`, `boolean_value`, `integer_value`, `float_value`, `datetime_value`, `date_value`, `json_value`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'XL', NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-04 10:40:39', '2023-08-04 10:40:39'),
(2, 2, 2, 'Black', NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-04 10:40:39', '2023-08-04 10:40:39'),
(3, 3, 1, 'M', NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-04 10:40:39', '2023-08-04 10:40:39'),
(4, 3, 2, 'Black', NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-04 10:40:39', '2023-08-04 10:40:39'),
(5, 4, 1, 'L', NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-04 10:40:39', '2023-08-04 10:40:39'),
(6, 4, 2, 'Black', NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-04 10:40:39', '2023-08-04 10:40:39'),
(7, 5, 1, 'XXL', NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-04 10:40:39', '2023-08-04 10:40:39'),
(8, 5, 2, 'Black', NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-04 10:40:39', '2023-08-04 10:40:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `product_categories`
--

INSERT INTO `product_categories` (`id`, `product_id`, `category_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `path` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_inventories`
--

CREATE TABLE `product_inventories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `product_inventories`
--

INSERT INTO `product_inventories` (`id`, `product_id`, `qty`, `created_at`, `updated_at`) VALUES
(1, 2, 10, '2023-08-04 10:42:07', '2023-08-04 10:42:07'),
(2, 3, 10, '2023-08-04 10:42:07', '2023-08-04 10:42:07'),
(3, 4, 10, '2023-08-04 10:42:07', '2023-08-04 10:42:07'),
(4, 5, 10, '2023-08-04 10:42:07', '2023-08-04 10:42:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2023-08-04 10:27:33', '2023-08-04 10:27:33'),
(2, 'User', 'web', '2023-08-04 10:27:33', '2023-08-04 10:27:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(5, 2),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(9, 2),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(13, 2),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(17, 2),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(21, 2),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(25, 2),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(29, 2),
(30, 1),
(31, 1),
(32, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `postcode` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `phone`, `email_verified_at`, `password`, `remember_token`, `company`, `address1`, `address2`, `province_id`, `city_id`, `postcode`, `created_at`, `updated_at`) VALUES
(1, 'Gempita ', 'Rizki Ramadhan', 'admin@gmail.com', NULL, '2023-08-04 10:27:33', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Tvxgn5s31M', NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-04 10:27:33', '2023-08-04 10:27:33'),
(2, 'Singgih', 'Aji', 'user@gmail.com', NULL, '2023-08-04 10:27:33', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Fb6giORSf4', NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-04 10:27:33', '2023-08-04 10:27:33');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `attribute_options`
--
ALTER TABLE `attribute_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attribute_options_attribute_id_foreign` (`attribute_id`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_user_id_foreign` (`user_id`),
  ADD KEY `products_parent_id_foreign` (`parent_id`);
ALTER TABLE `products` ADD FULLTEXT KEY `search` (`name`,`slug`,`short_description`,`description`);

--
-- Indeks untuk tabel `product_attribute_values`
--
ALTER TABLE `product_attribute_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_attribute_values_product_id_foreign` (`product_id`),
  ADD KEY `product_attribute_values_attribute_id_foreign` (`attribute_id`);

--
-- Indeks untuk tabel `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_categories_product_id_foreign` (`product_id`),
  ADD KEY `product_categories_category_id_foreign` (`category_id`);

--
-- Indeks untuk tabel `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indeks untuk tabel `product_inventories`
--
ALTER TABLE `product_inventories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_inventories_product_id_foreign` (`product_id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `attribute_options`
--
ALTER TABLE `attribute_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `product_attribute_values`
--
ALTER TABLE `product_attribute_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `product_inventories`
--
ALTER TABLE `product_inventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `attribute_options`
--
ALTER TABLE `attribute_options`
  ADD CONSTRAINT `attribute_options_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `product_attribute_values`
--
ALTER TABLE `product_attribute_values`
  ADD CONSTRAINT `product_attribute_values_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`),
  ADD CONSTRAINT `product_attribute_values_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `product_categories`
--
ALTER TABLE `product_categories`
  ADD CONSTRAINT `product_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_categories_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `product_inventories`
--
ALTER TABLE `product_inventories`
  ADD CONSTRAINT `product_inventories_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
