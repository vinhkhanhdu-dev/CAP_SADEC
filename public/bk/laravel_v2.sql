-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2025 at 05:20 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `actions`
--

CREATE TABLE `actions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `danhsachmonthis`
--

CREATE TABLE `danhsachmonthis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `maMonHoc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenMonHoc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hinhThucThi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thongTinChiTiet` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ghiChu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `danhsachmonthis`
--

INSERT INTO `danhsachmonthis` (`id`, `maMonHoc`, `tenMonHoc`, `hinhThucThi`, `thongTinChiTiet`, `ghiChu`, `created_at`, `updated_at`) VALUES
(1, 'MONTHI0001', 'Văn', 'Tl', 'V', 'V', '2025-02-11 19:42:52', '2025-02-11 19:42:52'),
(2, 'MONTHI0002', 'Sử', 'TL', 'S', 'S', '2025-02-11 19:43:03', '2025-02-11 19:43:03'),
(3, 'MONTHI0003', 'Địa', 'TL', 'D', 'D', '2025-02-11 19:43:15', '2025-02-11 19:43:15');

-- --------------------------------------------------------

--
-- Table structure for table `danhsachphongthis`
--

CREATE TABLE `danhsachphongthis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `maPhongThi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenPhongThi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ghiChu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `danhsachphongthis`
--

INSERT INTO `danhsachphongthis` (`id`, `maPhongThi`, `tenPhongThi`, `ghiChu`, `created_at`, `updated_at`) VALUES
(1, 'PHONG0001', 'Phòng số 1', '1', '2025-02-11 19:43:26', '2025-02-11 19:43:26'),
(2, 'PHONG0002', 'Phòng số 2', '2', '2025-02-11 19:43:33', '2025-02-11 19:43:33'),
(3, 'PHONG0003', 'Phòng số 3', '3', '2025-02-11 19:43:41', '2025-02-11 19:43:41');

-- --------------------------------------------------------

--
-- Table structure for table `danhsachthisinhs`
--

CREATE TABLE `danhsachthisinhs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `maThiSinh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenThiSinh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ngaySinh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gioiTinh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hsLop` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ketQua` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `noiSinh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ghiChu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maKhoiThi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maNamHoc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `danhsachthisinhs`
--

INSERT INTO `danhsachthisinhs` (`id`, `maThiSinh`, `tenThiSinh`, `ngaySinh`, `gioiTinh`, `hsLop`, `ketQua`, `noiSinh`, `ghiChu`, `maKhoiThi`, `maNamHoc`, `created_at`, `updated_at`) VALUES
(1, 'SBD0001', 'Nguyễn Văn An', '01/01/1998', 'Nam', NULL, NULL, 'Trà Vinh', '', 'KHOI0002', 'NH0002', '2025-02-11 19:44:18', '2025-02-11 19:44:18'),
(2, 'SBD0002', 'Nguyễn Văn B', '02/01/1998', 'Nam', NULL, NULL, 'Trà Vinh', '', 'KHOI0002', 'NH0002', '2025-02-11 19:44:18', '2025-02-11 19:44:18'),
(3, 'SBD0003', 'Nguyễn Văn C', '03/01/1998', 'Nam', NULL, NULL, 'Trà Vinh', '', 'KHOI0002', 'NH0002', '2025-02-11 19:44:18', '2025-02-11 19:44:18'),
(4, 'SBD0004', 'Nguyễn Văn D', '04/01/1998', 'Nam', NULL, NULL, 'Trà Vinh', '', 'KHOI0002', 'NH0002', '2025-02-11 19:44:18', '2025-02-11 19:44:18'),
(5, 'SBD0005', 'Nguyễn Văn E', '05/01/1998', 'Nam', NULL, NULL, 'Trà Vinh', '', 'KHOI0002', 'NH0002', '2025-02-11 19:44:18', '2025-02-11 19:44:18'),
(6, 'SBD0006', 'Nguyễn Văn F', '06/01/1998', 'Nam', NULL, NULL, 'Trà Vinh', '', 'KHOI0002', 'NH0002', '2025-02-11 19:44:18', '2025-02-11 19:44:18'),
(7, 'SBD0007', 'Nguyễn Văn G', '07/01/1998', 'Nam', NULL, NULL, 'Trà Vinh', '', 'KHOI0002', 'NH0002', '2025-02-11 19:44:18', '2025-02-11 19:44:18'),
(8, 'SBD0008', 'Nguyễn Văn H', '08/01/1998', 'Nam', NULL, NULL, 'Trà Vinh', '', 'KHOI0002', 'NH0002', '2025-02-11 19:44:18', '2025-02-11 19:44:18'),
(9, 'SBD0009', 'Nguyễn Văn Q', '09/01/1998', 'Nam', NULL, NULL, 'Trà Vinh', '', 'KHOI0002', 'NH0002', '2025-02-11 19:44:18', '2025-02-11 19:44:18'),
(10, 'SBD0010', 'Nguyễn Văn W', '10/01/1998', 'Nam', NULL, NULL, 'Trà Vinh', '', 'KHOI0002', 'NH0002', '2025-02-11 19:44:18', '2025-02-11 19:44:18'),
(11, 'SBD0011', 'Nguyễn Văn R', '11/01/1998', 'Nam', NULL, NULL, 'Trà Vinh', '', 'KHOI0002', 'NH0002', '2025-02-11 19:44:18', '2025-02-11 19:44:18'),
(12, 'SBD0012', 'Nguyễn Văn T', '12/01/1998', 'Nam', NULL, NULL, 'Trà Vinh', '', 'KHOI0002', 'NH0002', '2025-02-11 19:44:18', '2025-02-11 19:44:18'),
(13, 'SBD0013', 'Nguyễn Văn V', '13/01/1998', 'Nam', NULL, NULL, 'Trà Vinh', '', 'KHOI0002', 'NH0002', '2025-02-11 19:44:18', '2025-02-11 19:44:18'),
(14, 'SBD0014', 'Nguyễn Văn Y', '14/01/1998', 'Nam', NULL, NULL, 'Trà Vinh', '', 'KHOI0002', 'NH0002', '2025-02-11 19:44:18', '2025-02-11 19:44:18'),
(15, 'SBD0015', 'Nguyễn Văn Z', '15/01/1998', 'Nam', NULL, NULL, 'Trà Vinh', '', 'KHOI0002', 'NH0002', '2025-02-11 19:44:18', '2025-02-11 19:44:18');

-- --------------------------------------------------------

--
-- Table structure for table `danhsachthisinhthuocphongthis`
--

CREATE TABLE `danhsachthisinhthuocphongthis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ketQua` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maThiSinh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maKhoiThi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maNamHoc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maPhongThi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maMonHoc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maDonVi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maKyThi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ghiChu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `danhsachthisinhthuocphongthis`
--

INSERT INTO `danhsachthisinhthuocphongthis` (`id`, `ketQua`, `maThiSinh`, `maKhoiThi`, `maNamHoc`, `maPhongThi`, `maMonHoc`, `maDonVi`, `maKyThi`, `ghiChu`, `created_at`, `updated_at`) VALUES
(46, NULL, 'SBD0001', 'KHOI0002', 'NH0002', 'PHONG0001', 'MONTHI0003', 'DV0001', 'KTH0001', '', '2025-02-11 19:49:41', '2025-02-11 19:49:41'),
(47, NULL, 'SBD0001', 'KHOI0002', 'NH0002', 'PHONG0001', 'MONTHI0002', 'DV0001', 'KTH0001', '', '2025-02-11 19:49:41', '2025-02-11 19:49:41'),
(48, NULL, 'SBD0001', 'KHOI0002', 'NH0002', 'PHONG0001', 'MONTHI0001', 'DV0001', 'KTH0001', '', '2025-02-11 19:49:41', '2025-02-11 19:49:41'),
(49, NULL, 'SBD0002', 'KHOI0002', 'NH0002', 'PHONG0001', 'MONTHI0003', 'DV0001', 'KTH0001', '', '2025-02-11 19:49:41', '2025-02-11 19:49:41'),
(50, NULL, 'SBD0002', 'KHOI0002', 'NH0002', 'PHONG0001', 'MONTHI0002', 'DV0001', 'KTH0001', '', '2025-02-11 19:49:41', '2025-02-11 19:49:41'),
(51, NULL, 'SBD0002', 'KHOI0002', 'NH0002', 'PHONG0001', 'MONTHI0001', 'DV0001', 'KTH0001', '', '2025-02-11 19:49:41', '2025-02-11 19:49:41'),
(52, NULL, 'SBD0003', 'KHOI0002', 'NH0002', 'PHONG0001', 'MONTHI0003', 'DV0001', 'KTH0001', '', '2025-02-11 19:49:41', '2025-02-11 19:49:41'),
(53, NULL, 'SBD0003', 'KHOI0002', 'NH0002', 'PHONG0001', 'MONTHI0002', 'DV0001', 'KTH0001', '', '2025-02-11 19:49:41', '2025-02-11 19:49:41'),
(54, NULL, 'SBD0003', 'KHOI0002', 'NH0002', 'PHONG0001', 'MONTHI0001', 'DV0001', 'KTH0001', '', '2025-02-11 19:49:41', '2025-02-11 19:49:41'),
(55, NULL, 'SBD0004', 'KHOI0002', 'NH0002', 'PHONG0001', 'MONTHI0003', 'DV0001', 'KTH0001', '', '2025-02-11 19:49:41', '2025-02-11 19:49:41'),
(56, NULL, 'SBD0004', 'KHOI0002', 'NH0002', 'PHONG0001', 'MONTHI0002', 'DV0001', 'KTH0001', '', '2025-02-11 19:49:41', '2025-02-11 19:49:41'),
(57, NULL, 'SBD0004', 'KHOI0002', 'NH0002', 'PHONG0001', 'MONTHI0001', 'DV0001', 'KTH0001', '', '2025-02-11 19:49:41', '2025-02-11 19:49:41'),
(58, NULL, 'SBD0005', 'KHOI0002', 'NH0002', 'PHONG0001', 'MONTHI0003', 'DV0001', 'KTH0001', '', '2025-02-11 19:49:41', '2025-02-11 19:49:41'),
(59, NULL, 'SBD0005', 'KHOI0002', 'NH0002', 'PHONG0001', 'MONTHI0002', 'DV0001', 'KTH0001', '', '2025-02-11 19:49:41', '2025-02-11 19:49:41'),
(60, NULL, 'SBD0005', 'KHOI0002', 'NH0002', 'PHONG0001', 'MONTHI0001', 'DV0001', 'KTH0001', '', '2025-02-11 19:49:41', '2025-02-11 19:49:41'),
(61, NULL, 'SBD0006', 'KHOI0002', 'NH0002', 'PHONG0002', 'MONTHI0003', 'DV0001', 'KTH0001', '', '2025-02-11 19:49:41', '2025-02-11 19:49:41'),
(62, NULL, 'SBD0006', 'KHOI0002', 'NH0002', 'PHONG0002', 'MONTHI0002', 'DV0001', 'KTH0001', '', '2025-02-11 19:49:41', '2025-02-11 19:49:41'),
(63, NULL, 'SBD0006', 'KHOI0002', 'NH0002', 'PHONG0002', 'MONTHI0001', 'DV0001', 'KTH0001', '', '2025-02-11 19:49:41', '2025-02-11 19:49:41'),
(64, NULL, 'SBD0007', 'KHOI0002', 'NH0002', 'PHONG0002', 'MONTHI0003', 'DV0001', 'KTH0001', '', '2025-02-11 19:49:41', '2025-02-11 19:49:41'),
(65, NULL, 'SBD0007', 'KHOI0002', 'NH0002', 'PHONG0002', 'MONTHI0002', 'DV0001', 'KTH0001', '', '2025-02-11 19:49:41', '2025-02-11 19:49:41'),
(66, NULL, 'SBD0007', 'KHOI0002', 'NH0002', 'PHONG0002', 'MONTHI0001', 'DV0001', 'KTH0001', '', '2025-02-11 19:49:41', '2025-02-11 19:49:41'),
(67, NULL, 'SBD0008', 'KHOI0002', 'NH0002', 'PHONG0002', 'MONTHI0003', 'DV0001', 'KTH0001', '', '2025-02-11 19:49:41', '2025-02-11 19:49:41'),
(68, NULL, 'SBD0008', 'KHOI0002', 'NH0002', 'PHONG0002', 'MONTHI0002', 'DV0001', 'KTH0001', '', '2025-02-11 19:49:41', '2025-02-11 19:49:41'),
(69, NULL, 'SBD0008', 'KHOI0002', 'NH0002', 'PHONG0002', 'MONTHI0001', 'DV0001', 'KTH0001', '', '2025-02-11 19:49:41', '2025-02-11 19:49:41'),
(70, NULL, 'SBD0009', 'KHOI0002', 'NH0002', 'PHONG0002', 'MONTHI0003', 'DV0001', 'KTH0001', '', '2025-02-11 19:49:41', '2025-02-11 19:49:41'),
(71, NULL, 'SBD0009', 'KHOI0002', 'NH0002', 'PHONG0002', 'MONTHI0002', 'DV0001', 'KTH0001', '', '2025-02-11 19:49:41', '2025-02-11 19:49:41'),
(72, NULL, 'SBD0009', 'KHOI0002', 'NH0002', 'PHONG0002', 'MONTHI0001', 'DV0001', 'KTH0001', '', '2025-02-11 19:49:41', '2025-02-11 19:49:41'),
(73, NULL, 'SBD0011', 'KHOI0002', 'NH0002', 'PHONG0002', 'MONTHI0003', 'DV0001', 'KTH0001', '', '2025-02-11 19:49:41', '2025-02-11 19:49:41'),
(74, NULL, 'SBD0011', 'KHOI0002', 'NH0002', 'PHONG0002', 'MONTHI0002', 'DV0001', 'KTH0001', '', '2025-02-11 19:49:41', '2025-02-11 19:49:41'),
(75, NULL, 'SBD0011', 'KHOI0002', 'NH0002', 'PHONG0002', 'MONTHI0001', 'DV0001', 'KTH0001', '', '2025-02-11 19:49:41', '2025-02-11 19:49:41'),
(76, NULL, 'SBD0012', 'KHOI0002', 'NH0002', 'PHONG0003', 'MONTHI0003', 'DV0001', 'KTH0001', '', '2025-02-11 19:49:41', '2025-02-11 19:49:41'),
(77, NULL, 'SBD0012', 'KHOI0002', 'NH0002', 'PHONG0003', 'MONTHI0002', 'DV0001', 'KTH0001', '', '2025-02-11 19:49:41', '2025-02-11 19:49:41'),
(78, NULL, 'SBD0012', 'KHOI0002', 'NH0002', 'PHONG0003', 'MONTHI0001', 'DV0001', 'KTH0001', '', '2025-02-11 19:49:41', '2025-02-11 19:49:41'),
(79, NULL, 'SBD0013', 'KHOI0002', 'NH0002', 'PHONG0003', 'MONTHI0003', 'DV0001', 'KTH0001', '', '2025-02-11 19:49:41', '2025-02-11 19:49:41'),
(80, NULL, 'SBD0013', 'KHOI0002', 'NH0002', 'PHONG0003', 'MONTHI0002', 'DV0001', 'KTH0001', '', '2025-02-11 19:49:41', '2025-02-11 19:49:41'),
(81, NULL, 'SBD0013', 'KHOI0002', 'NH0002', 'PHONG0003', 'MONTHI0001', 'DV0001', 'KTH0001', '', '2025-02-11 19:49:41', '2025-02-11 19:49:41'),
(82, NULL, 'SBD0010', 'KHOI0002', 'NH0002', 'PHONG0003', 'MONTHI0003', 'DV0001', 'KTH0001', '', '2025-02-11 19:49:41', '2025-02-11 19:49:41'),
(83, NULL, 'SBD0010', 'KHOI0002', 'NH0002', 'PHONG0003', 'MONTHI0002', 'DV0001', 'KTH0001', '', '2025-02-11 19:49:41', '2025-02-11 19:49:41'),
(84, NULL, 'SBD0010', 'KHOI0002', 'NH0002', 'PHONG0003', 'MONTHI0001', 'DV0001', 'KTH0001', '', '2025-02-11 19:49:41', '2025-02-11 19:49:41'),
(85, NULL, 'SBD0014', 'KHOI0002', 'NH0002', 'PHONG0003', 'MONTHI0003', 'DV0001', 'KTH0001', '', '2025-02-11 19:49:41', '2025-02-11 19:49:41'),
(86, NULL, 'SBD0014', 'KHOI0002', 'NH0002', 'PHONG0003', 'MONTHI0002', 'DV0001', 'KTH0001', '', '2025-02-11 19:49:41', '2025-02-11 19:49:41'),
(87, NULL, 'SBD0014', 'KHOI0002', 'NH0002', 'PHONG0003', 'MONTHI0001', 'DV0001', 'KTH0001', '', '2025-02-11 19:49:41', '2025-02-11 19:49:41'),
(88, NULL, 'SBD0015', 'KHOI0002', 'NH0002', 'PHONG0003', 'MONTHI0003', 'DV0001', 'KTH0001', '', '2025-02-11 19:49:41', '2025-02-11 19:49:41'),
(89, NULL, 'SBD0015', 'KHOI0002', 'NH0002', 'PHONG0003', 'MONTHI0002', 'DV0001', 'KTH0001', '', '2025-02-11 19:49:41', '2025-02-11 19:49:41'),
(90, NULL, 'SBD0015', 'KHOI0002', 'NH0002', 'PHONG0003', 'MONTHI0001', 'DV0001', 'KTH0001', '', '2025-02-11 19:49:41', '2025-02-11 19:49:41');

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
-- Table structure for table `khoithis`
--

CREATE TABLE `khoithis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `maKhoiThi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenKhoiThi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thongTinChiTiet` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ghiChu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `khoithis`
--

INSERT INTO `khoithis` (`id`, `maKhoiThi`, `tenKhoiThi`, `thongTinChiTiet`, `ghiChu`, `created_at`, `updated_at`) VALUES
(1, 'KHOI0001', 'Khối 12', '12', '12', '2025-02-11 19:42:36', '2025-02-11 19:42:36'),
(2, 'KHOI0002', 'Khối 11', '11', '11', '2025-02-11 19:42:42', '2025-02-11 19:42:42');

-- --------------------------------------------------------

--
-- Table structure for table `kythis`
--

CREATE TABLE `kythis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `maKyThi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenKyThi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thongTinChiTiet` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ghiChu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kythis`
--

INSERT INTO `kythis` (`id`, `maKyThi`, `tenKyThi`, `thongTinChiTiet`, `ghiChu`, `created_at`, `updated_at`) VALUES
(1, 'KTH0001', 'Thi học kỳ 1', '1', '1', '2025-02-11 19:42:16', '2025-02-11 19:42:16'),
(2, 'KTH0002', 'Thi học kỳ 2', '2', '2', '2025-02-11 19:42:27', '2025-02-11 19:42:27');

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
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(3, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(4, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(5, '2016_06_01_000004_create_oauth_clients_table', 1),
(6, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(7, '2019_08_19_000000_create_failed_jobs_table', 1),
(8, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(9, '2021_09_09_002827_create_permission_tables', 1),
(10, '2023_03_08_035555_create_table_provinces', 1),
(11, '2023_06_03_001247_modules', 1),
(12, '2023_06_03_002610_actions', 1),
(13, '2023_06_04_072043_roles', 1),
(14, '2023_06_04_143329_users', 1),
(15, '2025_02_07_084242_thong_tin_don_vi', 1),
(16, '2025_02_07_084318_ky_thi', 1),
(17, '2025_02_07_084331_khoi_thi', 1),
(18, '2025_02_07_084341_mon_thi', 1),
(19, '2025_02_07_084432_danh_sach_phong_thi', 1),
(20, '2025_02_10_141042_danh_sach_nam_hoc', 1),
(21, '2025_02_10_141131_danh_sach_thi_sinh', 1),
(22, '2025_02_11_142020_danh_sach_thi_sinh_thuoc_phong_thi', 1);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_parent` bigint(20) UNSIGNED DEFAULT NULL,
  `index` int(11) DEFAULT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `code`, `name`, `id_parent`, `index`, `alias`, `class`, `icon`, `path`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'MD0001', 'Quản lý hệ thống', NULL, 1, '/*', '#', 'el-icon-platform-eleme', '/', NULL, 1, NULL, NULL),
(2, 'MD0002', 'Quyền', 1, NULL, '/list-role/*', '#', NULL, '/list-role', NULL, 1, NULL, NULL),
(3, 'MD0003', 'Module', 1, NULL, '/list-module/*', '#', NULL, '/list-module', NULL, 1, NULL, NULL),
(4, 'MD0004', 'Tài khoản', 1, NULL, '/list-user/*', '#', NULL, '/list-user', NULL, 1, NULL, NULL),
(5, 'MD0005', 'Quản lý danh sách', NULL, 1, '/*', '#', 'el-icon-platform-eleme', '/', NULL, 1, NULL, NULL),
(6, 'MD0006', 'Thông tin đơn vị', 5, NULL, '/thongtindonvi/*', '#', NULL, '/thongtindonvi', NULL, 1, NULL, NULL),
(7, 'MD0007', 'Danh sách kỳ thi', 5, NULL, '/danhsachkythi/*', '#', NULL, '/danhsachkythi', NULL, 1, NULL, NULL),
(8, 'MD0008', 'Danh sách khối thi', 5, NULL, '/danhsachkhoithi/*', '#', NULL, '/danhsachkhoithi', NULL, 1, NULL, NULL),
(9, 'MD0009', 'Danh sách môn thi', 5, NULL, '/danhsachmonthi/*', '#', NULL, '/danhsachmonthi', NULL, 1, NULL, NULL),
(10, 'MD0010', 'Danh sách phòng thi', 5, NULL, '/danhsachphongthi/*', '#', NULL, '/danhsachphongthi', NULL, 1, NULL, NULL),
(11, 'MD0011', 'Danh sách năm học', 5, NULL, '/danhsachnamhoc/*', '#', NULL, '/danhsachnamhoc', NULL, 1, NULL, NULL),
(12, 'MD0012', 'Danh sách thí sinh', NULL, NULL, '/danhsachthisinh/*', '#', NULL, '/danhsachthisinh', NULL, 1, NULL, NULL),
(13, 'MD0013', 'Kết quả sắp phòng thi', NULL, NULL, '/ketquasapphongthi/*', '#', NULL, '/ketquasapphongthi', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `namhocs`
--

CREATE TABLE `namhocs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `maNamHoc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenNamHoc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ghiChu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `namhocs`
--

INSERT INTO `namhocs` (`id`, `maNamHoc`, `tenNamHoc`, `ghiChu`, `created_at`, `updated_at`) VALUES
(1, 'NH0001', '2015-2016', '1516', '2025-02-11 19:43:56', '2025-02-11 19:43:56'),
(2, 'NH0002', '2016-2017', '1617', '2025-02-11 19:44:04', '2025-02-11 19:44:04');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('c4c0589415a66033b27c033795c6e60052c4de236913c4cdaa7fa484ac4e6df2111e5555a12a816d', 1, 1, 'Personal Access Token', '[]', 0, '2025-02-11 19:41:48', '2025-02-11 19:41:48', '2026-02-12 02:41:48');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'zDF5zx88PyPcFX0eXTTtqHJ76Dt2BPM2gH3xSulp', NULL, 'http://localhost', 1, 0, 0, '2025-02-11 19:40:31', '2025-02-11 19:40:31'),
(2, NULL, 'Laravel Password Grant Client', 'scFjkvtpCwhDh7btTdhU7ajcwU4jh6WPmo7mv46q', 'users', 'http://localhost', 0, 1, 0, '2025-02-11 19:40:31', '2025-02-11 19:40:31');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-02-11 19:40:31', '2025-02-11 19:40:31');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ProvinceCode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ProvinceName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ProvinceParent` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Level` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_parent` bigint(20) UNSIGNED DEFAULT NULL,
  `ListAction` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ListModule` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `code`, `name`, `id_parent`, `ListAction`, `ListModule`, `created_at`, `updated_at`) VALUES
(1, 'R0001', 'Admin', NULL, '[]', '[\"MD0001\",\"MD0002\",\"MD0003\",\"MD0004\",\"MD0005\",\"MD0006\",\"MD0007\",\"MD0008\",\"MD0009\",\"MD0010\",\"MD0011\",\"MD0012\",\"MD0013\"]', NULL, NULL),
(2, 'R0002', 'User', NULL, '[]', '[]', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `thongtindonvis`
--

CREATE TABLE `thongtindonvis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `maDonVi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenDonVi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thongTinChiTiet` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ghiChu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `thongtindonvis`
--

INSERT INTO `thongtindonvis` (`id`, `maDonVi`, `tenDonVi`, `thongTinChiTiet`, `ghiChu`, `created_at`, `updated_at`) VALUES
(1, 'DV0001', 'Trường THPT Hòa Minh', 'HM', NULL, '2025-02-11 19:42:04', '2025-02-11 19:42:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chucvu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `donvicongtac` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_module_default` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `chucvu`, `donvicongtac`, `phone_number`, `note`, `email`, `email_verified_at`, `password`, `id_module_default`, `role_code`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'dev', 'dev', '0868350978', '123', 'admin@gmail.com', NULL, '$2y$10$bBahqOSLRy2DDWoKqwPuBOtfEuMSx7Khx7jJke3GGk3RAhu9m.zbK', '4', 'R0001', NULL, NULL, NULL),
(2, 'user', 'dev', 'dev', '0868350978', '123', 'user@gmail.com', NULL, '$2y$10$6hq2tZw7I2WPkP5XJuSrZemUjwpq3wZ/mbaNHTZnwnnZ0ha.9vKIO', '7', 'R0002', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `actions_code_unique` (`code`),
  ADD KEY `actions_module_code_foreign` (`module_code`);

--
-- Indexes for table `danhsachmonthis`
--
ALTER TABLE `danhsachmonthis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `danhsachmonthis_mamonhoc_unique` (`maMonHoc`);

--
-- Indexes for table `danhsachphongthis`
--
ALTER TABLE `danhsachphongthis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `danhsachphongthis_maphongthi_unique` (`maPhongThi`);

--
-- Indexes for table `danhsachthisinhs`
--
ALTER TABLE `danhsachthisinhs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `danhsachthisinhs_mathisinh_unique` (`maThiSinh`),
  ADD KEY `danhsachthisinhs_makhoithi_foreign` (`maKhoiThi`),
  ADD KEY `danhsachthisinhs_manamhoc_foreign` (`maNamHoc`);

--
-- Indexes for table `danhsachthisinhthuocphongthis`
--
ALTER TABLE `danhsachthisinhthuocphongthis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `danhsachthisinhthuocphongthis_mathisinh_foreign` (`maThiSinh`),
  ADD KEY `danhsachthisinhthuocphongthis_makhoithi_foreign` (`maKhoiThi`),
  ADD KEY `danhsachthisinhthuocphongthis_manamhoc_foreign` (`maNamHoc`),
  ADD KEY `danhsachthisinhthuocphongthis_maphongthi_foreign` (`maPhongThi`),
  ADD KEY `danhsachthisinhthuocphongthis_mamonhoc_foreign` (`maMonHoc`),
  ADD KEY `danhsachthisinhthuocphongthis_madonvi_foreign` (`maDonVi`),
  ADD KEY `danhsachthisinhthuocphongthis_makythi_foreign` (`maKyThi`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `khoithis`
--
ALTER TABLE `khoithis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `khoithis_makhoithi_unique` (`maKhoiThi`);

--
-- Indexes for table `kythis`
--
ALTER TABLE `kythis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kythis_makythi_unique` (`maKyThi`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `modules_code_unique` (`code`),
  ADD KEY `modules_id_parent_foreign` (`id_parent`);

--
-- Indexes for table `namhocs`
--
ALTER TABLE `namhocs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `namhocs_manamhoc_unique` (`maNamHoc`),
  ADD UNIQUE KEY `namhocs_tennamhoc_unique` (`tenNamHoc`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `provinces_provincecode_unique` (`ProvinceCode`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_code_unique` (`code`),
  ADD KEY `roles_id_parent_foreign` (`id_parent`);

--
-- Indexes for table `thongtindonvis`
--
ALTER TABLE `thongtindonvis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `thongtindonvis_madonvi_unique` (`maDonVi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_code_foreign` (`role_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actions`
--
ALTER TABLE `actions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `danhsachmonthis`
--
ALTER TABLE `danhsachmonthis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `danhsachphongthis`
--
ALTER TABLE `danhsachphongthis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `danhsachthisinhs`
--
ALTER TABLE `danhsachthisinhs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `danhsachthisinhthuocphongthis`
--
ALTER TABLE `danhsachthisinhthuocphongthis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `khoithis`
--
ALTER TABLE `khoithis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kythis`
--
ALTER TABLE `kythis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `namhocs`
--
ALTER TABLE `namhocs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `thongtindonvis`
--
ALTER TABLE `thongtindonvis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `actions`
--
ALTER TABLE `actions`
  ADD CONSTRAINT `actions_module_code_foreign` FOREIGN KEY (`module_code`) REFERENCES `modules` (`code`) ON DELETE CASCADE;

--
-- Constraints for table `danhsachthisinhs`
--
ALTER TABLE `danhsachthisinhs`
  ADD CONSTRAINT `danhsachthisinhs_makhoithi_foreign` FOREIGN KEY (`maKhoiThi`) REFERENCES `khoithis` (`maKhoiThi`),
  ADD CONSTRAINT `danhsachthisinhs_manamhoc_foreign` FOREIGN KEY (`maNamHoc`) REFERENCES `namhocs` (`maNamHoc`);

--
-- Constraints for table `danhsachthisinhthuocphongthis`
--
ALTER TABLE `danhsachthisinhthuocphongthis`
  ADD CONSTRAINT `danhsachthisinhthuocphongthis_madonvi_foreign` FOREIGN KEY (`maDonVi`) REFERENCES `thongtindonvis` (`maDonVi`),
  ADD CONSTRAINT `danhsachthisinhthuocphongthis_makhoithi_foreign` FOREIGN KEY (`maKhoiThi`) REFERENCES `khoithis` (`maKhoiThi`),
  ADD CONSTRAINT `danhsachthisinhthuocphongthis_makythi_foreign` FOREIGN KEY (`maKyThi`) REFERENCES `kythis` (`maKyThi`),
  ADD CONSTRAINT `danhsachthisinhthuocphongthis_mamonhoc_foreign` FOREIGN KEY (`maMonHoc`) REFERENCES `danhsachmonthis` (`maMonHoc`),
  ADD CONSTRAINT `danhsachthisinhthuocphongthis_manamhoc_foreign` FOREIGN KEY (`maNamHoc`) REFERENCES `namhocs` (`maNamHoc`),
  ADD CONSTRAINT `danhsachthisinhthuocphongthis_maphongthi_foreign` FOREIGN KEY (`maPhongThi`) REFERENCES `danhsachphongthis` (`maPhongThi`),
  ADD CONSTRAINT `danhsachthisinhthuocphongthis_mathisinh_foreign` FOREIGN KEY (`maThiSinh`) REFERENCES `danhsachthisinhs` (`maThiSinh`);

--
-- Constraints for table `modules`
--
ALTER TABLE `modules`
  ADD CONSTRAINT `modules_id_parent_foreign` FOREIGN KEY (`id_parent`) REFERENCES `modules` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `roles_id_parent_foreign` FOREIGN KEY (`id_parent`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_code_foreign` FOREIGN KEY (`role_code`) REFERENCES `roles` (`code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
laravel_v2