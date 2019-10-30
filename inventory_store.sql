-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 29 Okt 2019 pada 03.01
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 7.1.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_store`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barcodes`
--

CREATE TABLE `barcodes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barcodes`
--

INSERT INTO `barcodes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(5, '8999908000101', '2019-10-03 19:14:03', '2019-10-22 19:20:54'),
(6, '8999908000200', '2019-10-03 19:15:52', '2019-10-03 19:15:52'),
(8, '8999908000705', '2019-10-21 05:38:56', '2019-10-21 05:38:56'),
(17, '4070071967072', '2019-10-25 08:53:52', '2019-10-25 08:53:52'),
(18, '799418201542', '2019-10-25 17:57:48', '2019-10-25 17:57:48'),
(19, '799418201542', '2019-10-28 04:38:17', '2019-10-28 04:38:17'),
(20, '1234567890128', '2019-10-28 04:39:37', '2019-10-28 04:39:37'),
(21, '4070071967072', '2019-10-28 04:42:24', '2019-10-28 04:42:24'),
(22, '1234567890128', '2019-10-28 05:08:39', '2019-10-28 05:08:39'),
(23, '5901234123457', '2019-10-28 05:10:39', '2019-10-28 05:10:39'),
(24, '712345678911', '2019-10-28 05:15:01', '2019-10-28 05:15:01'),
(25, '705632085943', '2019-10-28 05:16:16', '2019-10-28 05:16:16'),
(26, '7123456789015', '2019-10-28 05:16:45', '2019-10-28 05:16:45'),
(27, '9002236311036', '2019-10-28 05:42:36', '2019-10-28 05:42:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Food', '2019-10-02 02:52:50', '2019-10-02 02:52:50'),
(2, 'Drink', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `key_api` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `companies`
--

INSERT INTO `companies` (`id`, `name`, `address`, `email`, `key_api`, `logo`) VALUES
(1, 'My Computer', 'Orlando Street, CA, 5467', 'abedputra@gmail.com', '1234567890', 'logo.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `customers`
--

INSERT INTO `customers` (`id`, `name`, `address`, `email`, `phone`, `created_at`, `updated_at`) VALUES
(1, 'Adrino Inc', 'Dolbihi, street', 'adrino@gmail.com', '988283923', '2019-10-20 18:37:09', '2019-10-28 17:36:38'),
(2, 'Paseo inc', 'Gorin, street 304', 'paseo@gmail.com', '989099099', '2019-10-21 00:03:28', '2019-10-28 17:46:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_12_18_035002_create_customers_table', 1),
(4, '2018_12_18_035015_create_sales_table', 1),
(5, '2018_12_18_035038_create_suppliers_table', 1),
(6, '2018_12_18_041830_create_categories_table', 1),
(7, '2018_12_18_042809_create_products_table', 1),
(8, '2018_12_18_043146_create_product_masuk_table', 1),
(9, '2018_12_18_043233_create_product_keluar_table', 1),
(10, '2018_12_19_044911_add_field_role_to_table_users', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `barcode_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `price`, `image`, `qty`, `barcode_id`, `created_at`, `updated_at`) VALUES
(4, 1, 'Bread O', 5000, NULL, 1, 5, '2019-10-03 19:14:03', '2019-10-28 17:58:03'),
(10, 2, 'Sprite', 2000, NULL, 13, 20, '2019-10-28 04:39:37', '2019-10-28 17:58:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_in`
--

CREATE TABLE `product_in` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `supplier_id` int(10) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `product_in`
--

INSERT INTO `product_in` (`id`, `product_id`, `supplier_id`, `qty`, `date`, `created_at`, `updated_at`) VALUES
(2, 4, 1, 9, '2019-10-31', '2019-10-20 18:37:35', '2019-10-20 18:37:35'),
(6, 4, 1, 20, '2019-10-23', '2019-10-22 19:37:47', '2019-10-22 19:37:47'),
(8, 4, 1, 1, '2019-10-23', '2019-10-22 20:39:14', '2019-10-22 20:39:14'),
(10, 4, 1, 22, '2019-10-23', '2019-10-22 21:14:40', '2019-10-22 21:14:40'),
(12, 10, 1, 3, '2019-10-31', '2019-10-28 17:58:26', '2019-10-28 17:58:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_out`
--

CREATE TABLE `product_out` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `product_out`
--

INSERT INTO `product_out` (`id`, `product_id`, `customer_id`, `qty`, `date`, `created_at`, `updated_at`) VALUES
(3, 4, 1, 1, '2019-10-31', '2019-10-20 23:31:09', '2019-10-20 23:31:09'),
(4, 4, 2, 154, '2019-10-29', '2019-10-28 15:39:28', '2019-10-28 15:39:28'),
(5, 10, 2, 10, '2019-10-31', '2019-10-28 17:58:46', '2019-10-28 17:58:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sales`
--

CREATE TABLE `sales` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sales`
--

INSERT INTO `sales` (`id`, `name`, `address`, `email`, `phone`, `created_at`, `updated_at`) VALUES
(1, 'Coca-cola', 'Domgrot, street', 'coca@gmail.com', '0987823232', '2019-10-20 18:36:41', '2019-10-28 17:54:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `address`, `email`, `phone`, `created_at`, `updated_at`) VALUES
(1, 'Universal', 'Terminaltion, Street 4043', 'universal@gmail.com', '90890890', '2019-10-20 18:36:12', '2019-10-28 17:57:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','staff') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'staff'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$JARVHhIlI3NV6h0qur5NxengTvKfwGS0zGaMaFcmql0E5WiJZYGn2', 'NqPwgoGCnWoQug9pQmtNpH49KvYVMCG3r6mDjBc6j1x3WtyYhFrc3FmSXvY8', '2019-10-02 02:47:55', '2019-10-02 02:47:55', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barcodes`
--
ALTER TABLE `barcodes`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `fk_barcode_products_barcoce_id` (`barcode_id`);

--
-- Indeks untuk tabel `product_in`
--
ALTER TABLE `product_in`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_in_product_id_foreign` (`product_id`),
  ADD KEY `product_in_supplier_id_foreign` (`supplier_id`);

--
-- Indeks untuk tabel `product_out`
--
ALTER TABLE `product_out`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_out_product_id_foreign` (`product_id`),
  ADD KEY `product_out_customer_id_foreign` (`customer_id`);

--
-- Indeks untuk tabel `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT untuk tabel `barcodes`
--
ALTER TABLE `barcodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `product_in`
--
ALTER TABLE `product_in`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `product_out`
--
ALTER TABLE `product_out`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_barcode_products_barcoce_id` FOREIGN KEY (`barcode_id`) REFERENCES `barcodes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `product_in`
--
ALTER TABLE `product_in`
  ADD CONSTRAINT `product_in_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_in_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `product_out`
--
ALTER TABLE `product_out`
  ADD CONSTRAINT `product_out_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_out_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
