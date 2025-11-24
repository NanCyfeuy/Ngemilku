-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Okt 2025 pada 18.47
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ngemilku`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `lokasi`
--

CREATE TABLE `lokasi` (
  `id_tempat` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `longitude` decimal(10,7) NOT NULL,
  `latitude` decimal(10,7) NOT NULL,
  `hotlink` varchar(255) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `jam_operasional` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `lokasi`
--

INSERT INTO `lokasi` (`id_tempat`, `nama`, `alamat`, `deskripsi`, `longitude`, `latitude`, `hotlink`, `gambar`, `jam_operasional`, `created_at`, `updated_at`) VALUES
(1, 'Martabak & Terang Bulan Mas Dery', 'Jl. Bulu Masomba', 'Martabak manis dan asin dengan berbagai topping pilihan', 119.9061356, -0.9005970, NULL, 'lokasi/FFaa5RPdelN2zHmXDMAl2ba8n8vN0npPzJZm3DTD.jpg', '16:00-22:00', NULL, '2025-10-14 04:59:54'),
(2, 'Pato Donat Outlet Vetran', 'Jl. Veteran', 'Donat dengan berbagai varian rasa yang lembut', 119.8904811, -0.8978650, 'https://www.instagram.com/patodonuts_', 'lokasi/fG4Ss9ZW3m05YUS86t0pAjpib7kX5OdGQmoiZd9a.jpg', '18:00-21:00', NULL, '2025-10-14 07:59:22'),
(3, 'Happy Bread', 'Jl. Veteran', 'Toko roti dengan berbagai pilihan roti fresh', 119.8929667, -0.8978287, 'https://www.instagram.com/happybread.palu', 'lokasi/y13GaKSV45lqXJw5izVHh0tQo0zqKLnp3kdDWLw4.jpg', '07:00-22:00', NULL, '2025-10-14 07:23:37'),
(4, 'Burger Bangor', 'Jl. Basuki Rahmat', 'Burger dengan ukuran jumbo dan rasa yang lezat', 119.8895602, -0.9190618, 'https://www.instagram.com/bangorbasrah.plw', 'lokasi/Pvy2m3lCOl8Uqw4slCJb1qEwKVSiGKhudzVmWjAA.jpg', '10:00-22:30', NULL, '2025-10-14 05:47:07'),
(5, 'Martabak Tik Top', 'Jl. Veteran', 'Martabak spesial dengan topping berlimpah', 119.9021784, -0.8984371, NULL, 'lokasi/wwHF4yCY6EUmJCYPEJPKjLND9sLXAK4tfd8vjkzH.jpg', '17:00-23:00', NULL, '2025-10-14 05:00:24'),
(6, 'Roti Bakar Enal', 'Jl. Veteran', 'Roti bakar dengan berbagai varian selai dan topping', 119.9012765, -0.8989004, NULL, 'lokasi/HlrYreL5ch0Cu0bTpwi3SDDPKDAjguejdo8h4i3V.jpg', '18:00-22:00', NULL, '2025-10-14 05:25:35'),
(7, 'Wafel O Tondo', 'Mouza Supermart, Tondo', 'Wafel dengan berbagai topping lezat', 119.8825121, -0.8491338, 'https://www.instagram.com/wafelo_', 'lokasi/uMTdFi364SVq77iJZuut0qKjC6fGIDhy7Gw3ir1X.jpg', '09:00-22:00', NULL, '2025-10-14 05:56:31'),
(8, 'Roti\'O Bandara Mutiara SIS Al-Jufri', 'Bandara Mutiara SIS Al-Jufri', 'Toko roti dan kue di area bandara', 119.9063198, -0.9190010, 'https://www.instagram.com/rotio.palu', 'lokasi/gafteLBaw2m2rOcxABV3sXrde1NiLyytveq6CWKP.jpg', '06:00-22:00', NULL, '2025-10-14 05:43:01'),
(9, 'Martabak Mas Bro', 'Jl. Veteran', 'Martabak dengan harga terjangkau dan rasa enak', 119.8947282, -0.8988565, NULL, 'lokasi/MJ2X7JdwD8I7WfVWT5txc1ziiLgZtJrXeZKrlhjz.jpg', '18:00-23:00', NULL, '2025-10-14 05:26:00'),
(10, 'Martabak Terang Bulan Holland', 'Jl. Basuki Rahmat', 'Martabak Holland dengan topping keju yang melimpah', 119.8823119, -0.9190383, 'https://www.instagram.com/hollandmartabakpalu/', 'lokasi/759E4qCG9ZOENfOpVmCZJZxgPBJnb0RvOZQ0Jxgz.jpg', '12:00-24:00', NULL, '2025-10-14 05:50:22'),
(11, 'Pizza panjang Erdogan', 'Jl. Wolter Monginsidi', 'Pizza panjang dengan berbagai pilihan topping', 119.8750472, -0.9060594, 'https://www.instagram.com/kebabburger.erdogan', 'lokasi/Tj3AewWMSgAu5wDOGQ46BU7T29arbDF9vLRIGj5s.jpg', '16:00-22:00', NULL, '2025-10-14 05:32:16'),
(12, 'Martabak & Terang Bulan Tegal', 'Jl. Sisingamangaraja', 'Martabak khas Tegal dengan rasa autentik', 119.8859410, -0.8912109, NULL, 'lokasi/9fpmuwJVg7FS1IyPC3IjpcZIpZ7qBXuhm3TngAHa.jpg', '16:00-23:30', NULL, '2025-10-14 05:15:56'),
(13, 'Terang Bulan/Martabak Trans Sulawesi', 'Jl. R.E. Martadinata', 'Martabak di pinggir jalan Trans Sulawesi', 119.8831700, -0.8431400, NULL, 'lokasi/FDo8pnIZftWEsdm6mpwIzUkDsm6XADljj7VM9NJk.jpg', '17:00-24:00', NULL, '2025-10-14 05:52:01'),
(14, 'Roti Bakar Merdeka', 'Jl. R.E. Martadinata', 'Roti bakar dengan konsep kekinian', 119.8831899, -0.8430900, NULL, 'lokasi/Py6uPGLxwyZ84k7AKMq4BNMsBn34GoYJNtXS5F9D.jpg', '15:00-22:00', NULL, '2025-10-14 05:54:26'),
(15, 'Terang Bulan Untad I', 'Jl. Untad 1', 'Martabak favorit mahasiswa Untad', 119.8856799, -0.8431300, NULL, 'lokasi/7yfF4b7qmoaLHKXpei9hb5KMKsma1GVA0GiRCTKK.jpg', '16:00-23:00', NULL, '2025-10-14 05:51:09'),
(16, 'Roti Bakar & Terang Bulan Ocan', 'Jl. R.E Martadinata', 'Kedua menu andalan tersedia di sini', 119.8826399, -0.8485800, NULL, 'lokasi/Ft8QS2sPyKDlYyG7eRmuyuKDNMqu4xwzlPjUOhhE.jpg', '17:00-21:30', NULL, '2025-10-14 05:55:19'),
(17, 'MARTABAK TERANG BULAN HASANUDDIN', 'Jl. Hasanuddin', 'Martabak legendaris di jalan Hasanuddin', 119.8696000, -0.8972500, NULL, 'lokasi/pXfJnC23PjuncQI9dzLi4CIHFqwxUFme32KqtZoa.jpg', '17:00-22:30', NULL, '2025-10-14 07:56:11'),
(18, 'Terang Bulan Podomoro Veteran', 'Jl. Veteran', 'Martabak di kawasan Podomoro Veteran', 119.8942339, -0.8986212, NULL, 'lokasi/9YqygKrkiIWg9HSDjJ9EDJ6p2ryMCxLohXTNL9uD.jpg', '17:00-23:00', NULL, '2025-10-14 05:26:18'),
(19, 'The April', 'Jl. Masjid raya', 'Kafe dengan berbagai dessert dan minuman', 119.8752078, -0.9020064, 'https://www.instagram.com/official.theapril', 'lokasi/Il5lMX7SZHdEgyY7plSBrL8nxlb2UDhMrK6qw56Q.jpg', '17:00-22:00', NULL, '2025-10-14 05:39:40'),
(20, 'BASRENG GHOSTING PALU', 'Jl. Masjid raya', 'Basreng (bakso goreng) dengan berbagai level pedas', 119.8752406, -0.9020505, 'https://www.instagram.com/basreng_ghostingplw', 'lokasi/zJynpJGUgMXMdjcjxTWeOnm4FpTffQORAw8tOKy5.jpg', '11:00-21:00', NULL, '2025-10-14 05:38:10'),
(21, 'Martabak Bintang Terang Bulan 99', 'Jl. Basuki Rahmat', 'Martabak dengan konsep bintang dan variasi topping', 119.8861958, -0.9188521, NULL, 'lokasi/SJqJ8NiF1B3AmuaggikwaU7n1vSoAx4cvJ6FleGB.jpg', '16:00-22:00', NULL, '2025-10-14 05:49:09'),
(22, 'Kebab & Coffe Spot', 'Jl. Masjid Raya', 'Tempat nongkrong dengan kebab dan kopi', 119.8752332, -0.9021586, 'https://www.instagram.com/kebab_coffee_spot', 'lokasi/UcqqOm8vwJ6bYZgMoxM91d4g43j3RUwolcJemAEX.jpg', '10:00-24:00', NULL, '2025-10-14 05:33:37'),
(23, 'Mandiri Holland Terang Bulan Martabak', 'Jl. Wolter Monginsidi', 'Martabak Holland dengan konsep mandiri', 119.8753848, -0.9065030, 'https://www.instagram.com/mandiri_holland', 'lokasi/SBAwwCnweAh1I7S6OEMV0ROBTzejVA8BAk4KvhUH.jpg', '16:00-23:30', NULL, '2025-10-14 05:31:34'),
(24, 'Martabak Golden King', 'Jl. Bulu Masomba', 'Martabak dengan sentuhan royal dan premium', 119.9086147, -0.9016681, NULL, 'lokasi/qNWioNeQaCMtmIUvzJi6b3WLQXxI5gCVMdNcPXUs.jpg', '18:00-22:00', NULL, '2025-10-14 04:53:18'),
(25, 'Kebab Burger Bang Jabir Lasaoni', 'Jl. Bulu Masomba', 'Kebab dan burger dengan racikan spesial', 119.9078897, -0.9016993, NULL, 'lokasi/oXGX1bX6GgEf7RLgtEFTOJRdEDEf2Dg4SvmEnLY2.jpg', '10:00-22:00', NULL, '2025-10-14 07:15:30'),
(26, 'Pizza Umi Sigma', 'Jl. Sisingamangaraja', 'Pizza dengan resep keluarga (Umi)', 119.8858298, -0.8900542, 'https://www.instagram.com/pizzaumipalu', 'lokasi/u0eYnSvtOw4gpEdEzWQo6c7gL9f9b7c8KG4zkrHE.jpg', '15:00-21:30', NULL, '2025-10-14 05:29:30'),
(27, 'Roti Bakar Katuangan 38', 'Jl. Garuda', 'Roti bakar dengan suasana santai', 119.8987690, -0.9103963, NULL, 'lokasi/1gc3w6oXTkPCnXhP15vqhHB28J1MtLvrq6ciiGq2.jpg', '17:00-22:00', NULL, '2025-10-14 05:44:42'),
(28, 'Maleo Bakery', 'Jl. Maleo', 'Bakery dengan roti khas Sulawesi', 119.8990566, -0.9042407, NULL, 'lokasi/2bTZJutvNbZxnATbOZRa3sE6osY52QNHxIhij0vq.jpg', '15:00-21:00', NULL, '2025-10-14 05:29:54'),
(29, 'Yaku Dessert Waffle & Snack Chapter : Tanjung Satu', 'Jl. Tanjung Satu', 'Tempat dessert dengan waffle dan snack kekinian', 119.8824947, -0.9064986, 'https://www.instagram.com/yaku.plw', 'lokasi/PsvLlnawUIzRgb6a67M8TerpsfqSpl3uapa67nvd.jpg', '13:00-22:00', NULL, '2025-10-14 05:19:04'),
(30, 'King Martabak', 'Jl. Bulu Masomba', 'Martabak dengan cita rasa fitrah seorang raja', 119.9068424, -0.9014053, NULL, 'lokasi/b67i6TwqmuR0j6rEJmOVMi6MTPscNiULnuKKsiom.jpg', '16:00-22:00', NULL, '2025-10-14 05:25:20');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '2025_09_06_064008_tb_lokasi', 1),
(3, '2025_10_07_171922_poligon_table', 2),
(4, '2025_10_07_171959_polyline_table', 2);

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
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('eCzoUVtwi55Gtj6t8ScLNufaYuP6TFVSGqYsWgJp', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRHNDbFp4MDc5UWJUMHV1ZGpqellha1JSSU1UNWpMSkN2QmRuNWZ5cyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbiI7fX0=', 1760460378);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'nan', 'tes22@gmail.com', NULL, '$2y$12$/.F2rFHonQK4c4uSBQqsB.Evg5mKULwVpXgZC5UYcYSQppuTVk1Om', NULL, '2025-09-06 10:09:48', '2025-09-06 10:09:48');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id_tempat`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id_tempat` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
