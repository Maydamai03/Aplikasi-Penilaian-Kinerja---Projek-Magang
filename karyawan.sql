-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2025 at 04:47 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `karyawan`
--

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_divisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id`, `nama_divisi`, `created_at`, `updated_at`) VALUES
(1, 'Software', '2025-08-07 23:02:56', '2025-08-07 23:02:56'),
(2, 'Hardware', '2025-08-07 23:02:56', '2025-08-07 23:02:56'),
(3, 'Content Creator', '2025-08-07 23:02:56', '2025-08-07 23:02:56'),
(4, 'Human Resources', '2025-08-07 23:02:56', '2025-08-07 23:02:56'),
(5, 'Finance', '2025-08-07 23:02:56', '2025-08-07 23:02:56');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `nama_jabatan`, `created_at`, `updated_at`) VALUES
(1, 'Staff', '2025-08-07 23:02:56', '2025-08-07 23:02:56'),
(2, 'Senior Staff', '2025-08-07 23:02:56', '2025-08-07 23:02:56'),
(3, 'Supervisor', '2025-08-07 23:02:57', '2025-08-07 23:02:57'),
(4, 'Manager', '2025-08-07 23:02:57', '2025-08-07 23:02:57');

-- --------------------------------------------------------

--
-- Table structure for table `job_lists`
--

CREATE TABLE `job_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `karyawan_id` bigint(20) UNSIGNED NOT NULL,
  `shift` enum('Pagi','Siang') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe_job` enum('Tetap','Opsional') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_pekerjaan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `durasi_waktu` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_lists`
--

INSERT INTO `job_lists` (`id`, `karyawan_id`, `shift`, `tipe_job`, `nama_pekerjaan`, `deskripsi_pekerjaan`, `durasi_waktu`, `created_at`, `updated_at`) VALUES
(3, 1, 'Siang', 'Tetap', 'Like semua postingan akun Instagram DECAA dengan akun Pribadi', NULL, 1, '2025-08-07 23:09:39', '2025-08-07 23:09:39'),
(4, 1, 'Siang', 'Tetap', 'Like semua postingan akun TikTok DECAA dengan akun Pribadi', NULL, 1, '2025-08-07 23:09:49', '2025-08-07 23:09:49'),
(13, 1, 'Pagi', 'Tetap', 'Like semua postingan akun Instagram DECAA dengan akun Pribadi', NULL, 1, '2025-08-08 04:07:36', '2025-08-08 04:07:36'),
(14, 1, 'Pagi', 'Tetap', 'Like semua postingan akun TikTok DECAA dengan akun Pribadi', NULL, 1, '2025-08-08 04:07:48', '2025-08-08 04:07:48'),
(15, 1, 'Pagi', 'Tetap', 'Like semua postingan akun Facebook DECAA dengan akun Pribadi', NULL, 1, '2025-08-08 04:07:59', '2025-08-08 04:07:59'),
(16, 1, 'Pagi', 'Tetap', 'Komen postingan instagram decaahardware.id dengan akun Pribadi', NULL, 1, '2025-08-08 04:08:10', '2025-08-08 04:08:10'),
(17, 1, 'Pagi', 'Tetap', 'Komen postingan TikTok decaahardware.id dengan akun Pribadi', NULL, 1, '2025-08-08 04:08:21', '2025-08-08 04:08:21'),
(18, 1, 'Pagi', 'Tetap', 'Komen postingan Facebook decaahardware.id dengan akun Pribadi', NULL, 1, '2025-08-08 04:08:37', '2025-08-08 04:08:37'),
(19, 1, 'Pagi', 'Tetap', 'Komen postingan Instagram decaasoftware.id & decaarobotics.id dengan akun Pribadi', NULL, 1, '2025-08-08 04:08:50', '2025-08-08 04:08:50'),
(20, 1, 'Pagi', 'Tetap', 'Komen postingan TikTok decaasoftware.id & decaarobotics.id dengan akun Pribadi', NULL, 1, '2025-08-08 04:09:03', '2025-08-08 04:09:03'),
(21, 1, 'Pagi', 'Tetap', 'Komen postingan Facebook decaasoftware.id & decaarobotics.id dengan akun Pribadi', NULL, 1, '2025-08-08 04:09:18', '2025-08-08 04:09:18'),
(22, 1, 'Pagi', 'Tetap', 'Open Store (Open shift, check semua perangkat listrik kantor & store)', NULL, 30, '2025-08-08 04:09:35', '2025-08-08 04:09:35'),
(23, 1, 'Pagi', 'Tetap', 'Membersihkan & merapikan laptop, peripheral, kaca etalase & membersihkan halaman', NULL, 30, '2025-08-08 04:09:46', '2025-08-08 04:09:46'),
(24, 1, 'Pagi', 'Tetap', 'Broadcast/blasting whatsapp promo laptop/peripheral/aksesoris yang sudah ada', NULL, 30, '2025-08-08 04:09:58', '2025-08-08 04:09:58'),
(25, 1, 'Pagi', 'Tetap', 'Followup minimal 5 user hardware (target prospek)', NULL, 1, '2025-08-08 04:10:10', '2025-08-08 04:10:10'),
(26, 1, 'Pagi', 'Tetap', 'Followup minimal 10 instansi desa/sekolah (target sampai dapat prospek)', NULL, 1, '2025-08-08 04:10:21', '2025-08-08 04:10:21'),
(27, 1, 'Pagi', 'Tetap', 'Buat ide promo penjualan untuk besok', NULL, 30, '2025-08-08 04:10:37', '2025-08-08 04:10:37'),
(28, 1, 'Pagi', 'Tetap', 'Eksekusi & finishing design promo', NULL, 30, '2025-08-08 04:10:48', '2025-08-08 04:10:48'),
(29, 1, 'Pagi', 'Tetap', 'Cari database user baru minimal 25', NULL, 90, '2025-08-08 04:10:58', '2025-08-08 04:38:34');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nip` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_telepon` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_profil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `divisi_id` bigint(20) UNSIGNED NOT NULL,
  `jabatan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tanggal_masuk` date NOT NULL,
  `status_karyawan` enum('Aktif','Cuti','Resign') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `nip`, `nama_lengkap`, `tanggal_lahir`, `email`, `nomor_telepon`, `alamat`, `foto_profil`, `divisi_id`, `jabatan_id`, `tanggal_masuk`, `status_karyawan`, `created_at`, `updated_at`) VALUES
(1, '12322999', 'Hermawan', '2003-07-28', 'Hermawan@gmail.com', '08123456789', 'Jl Kemerdekaan No 15 blok M', 'XVEpm6fLzjNzmo5mHvUrORsLBBNbFFfNU43X6fFc.png', 1, 1, '2024-02-07', 'Aktif', '2025-08-07 23:03:46', '2025-08-08 00:53:26');

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
(26, '2014_10_12_000000_create_users_table', 1),
(27, '2014_10_12_100000_create_password_resets_table', 1),
(28, '2019_08_19_000000_create_failed_jobs_table', 1),
(29, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(30, '2025_07_24_042226_create_divisi_table', 1),
(31, '2025_07_24_042622_create_jabatan_table', 1),
(32, '2025_07_24_042623_create_karyawan_table', 1),
(33, '2025_07_24_042635_create_job_lists_table', 1),
(34, '2025_07_24_042642_create_penilaian_kinerja_table', 1);

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
-- Table structure for table `penilaian_kinerja`
--

CREATE TABLE `penilaian_kinerja` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_list_id` bigint(20) UNSIGNED NOT NULL,
  `penilai_id` bigint(20) UNSIGNED NOT NULL,
  `skala` enum('Tidak Dikerjakan','Melakukan Tapi Tidak Benar','Melakukan Dengan Benar') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai` decimal(8,3) NOT NULL,
  `catatan_penilai` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_penilaian` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('superadmin','admin') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'superadmin@app.com', NULL, '$2y$10$ZjF782.ysEzLtegcGlxB9eMyG69o8kgVEBpAYohoydLVlv9hOOJxe', 'superadmin', NULL, '2025-08-07 23:02:56', '2025-08-07 23:02:56'),
(2, 'Admin', 'admin@app.com', NULL, '$2y$10$XYw7oj8r.uY/UMQXm2FYnOS58yiy4zF5UlxUBonZpiPRKjFfzlZsm', 'admin', NULL, '2025-08-07 23:02:56', '2025-08-07 23:02:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `divisi_nama_divisi_unique` (`nama_divisi`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jabatan_nama_jabatan_unique` (`nama_jabatan`);

--
-- Indexes for table `job_lists`
--
ALTER TABLE `job_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_lists_karyawan_id_foreign` (`karyawan_id`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `karyawan_nip_unique` (`nip`),
  ADD UNIQUE KEY `karyawan_email_unique` (`email`),
  ADD KEY `karyawan_divisi_id_foreign` (`divisi_id`),
  ADD KEY `karyawan_jabatan_id_foreign` (`jabatan_id`);

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
-- Indexes for table `penilaian_kinerja`
--
ALTER TABLE `penilaian_kinerja`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penilaian_kinerja_job_list_id_foreign` (`job_list_id`),
  ADD KEY `penilaian_kinerja_penilai_id_foreign` (`penilai_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `job_lists`
--
ALTER TABLE `job_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `penilaian_kinerja`
--
ALTER TABLE `penilaian_kinerja`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `job_lists`
--
ALTER TABLE `job_lists`
  ADD CONSTRAINT `job_lists_karyawan_id_foreign` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `karyawan_divisi_id_foreign` FOREIGN KEY (`divisi_id`) REFERENCES `divisi` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `karyawan_jabatan_id_foreign` FOREIGN KEY (`jabatan_id`) REFERENCES `jabatan` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `penilaian_kinerja`
--
ALTER TABLE `penilaian_kinerja`
  ADD CONSTRAINT `penilaian_kinerja_job_list_id_foreign` FOREIGN KEY (`job_list_id`) REFERENCES `job_lists` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `penilaian_kinerja_penilai_id_foreign` FOREIGN KEY (`penilai_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
