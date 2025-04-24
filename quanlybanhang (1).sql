-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 24, 2025 lúc 04:17 PM
-- Phiên bản máy phục vụ: 5.7.34
-- Phiên bản PHP: 8.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quanlybanhang`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bannuocmia`
--

CREATE TABLE `bannuocmia` (
  `id` int(11) NOT NULL,
  `ten_mat_hang` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `so_luong` int(11) DEFAULT NULL,
  `don_gia` decimal(15,0) DEFAULT NULL,
  `don_vi` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `hinh_thuc` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `ngay_ban` datetime DEFAULT NULL,
  `nguoighi` text COLLATE utf8mb4_vietnamese_ci,
  `nguoisua` text COLLATE utf8mb4_vietnamese_ci,
  `thanh_tien` decimal(15,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `bannuocmia`
--

INSERT INTO `bannuocmia` (`id`, `ten_mat_hang`, `so_luong`, `don_gia`, `don_vi`, `hinh_thuc`, `ngay_ban`, `nguoighi`, `nguoisua`, `thanh_tien`) VALUES
(1, 'Nước mía', 2, 5000, 'Ly', 'Tại quán', '2025-04-15 18:45:00', 'kz20112023', 'kz20112023', 10000),
(2, 'Nước mía', 2, 10000, 'Ly', 'Tại quán', '2025-04-16 11:25:00', 'kz20112023', 'kz20112023', 20000),
(3, 'Nước mía', 4, 10000, 'Ly', 'Ship (A Dũng)', '2025-04-17 11:14:00', 'kz20112023', 'kz20112023', 40000),
(4, 'Nước mía', 2, 10000, 'Ly', 'Tại quán', '2025-04-17 12:15:00', 'kz20112023', 'kz20112023', 20000),
(5, 'Nước Mía', 2, 10000, 'Ly', 'Tại quán', '2025-04-17 17:25:00', 'kz20112023', 'kz20112023', 20000),
(6, 'Nước mía', 4, 10000, 'Ly', 'Ship (Anh Dũng)', '2025-04-18 11:25:00', 'kz20112023', 'kz20112023', 40000),
(7, 'Nước mía', 2, 10000, 'Ly', 'Tại quán', '2025-04-18 14:15:00', 'kz20112023', 'kz20112023', 20000),
(8, 'Nước mía', 3, 10000, 'Ly', 'Tại quán', '2025-04-18 17:20:00', 'kz20112023', 'kz20112023', 30000),
(9, 'Nước mía', 2, 10000, 'Ly', 'Tại quán', '2025-04-20 14:40:00', 'kz20112023', 'kz20112023', 20000),
(10, 'Nước mía', 4, 10000, 'Ly', 'Ship (a Pháp)', '2025-04-20 15:43:00', 'kz20112023', 'kz20112023', 40000),
(11, 'Nước mía', 1, 10000, 'Ly', 'Tại quán', '2025-04-20 17:25:00', 'kz20112023', 'kz20112023', 10000),
(12, 'Nước mía', 4, 10000, 'Ly', 'Ship (a Pháp, a dũng mua)', '2025-04-20 18:35:00', 'kz20112023', 'kz20112023', -40000),
(13, 'Nước mía', 4, 10000, 'Ly', 'Ship (kz)', '2025-04-20 20:00:00', 'kz20112023', 'kz20112023', 40000),
(14, 'Nước mía', 2, 5000, 'Ly', 'Tại quán', '2025-04-20 20:00:00', 'kz20112023', 'kz20112023', 10000),
(15, 'Nước mía', 5, 10000, 'Ly', 'Ship (Pháp, Khiêm)', '2025-04-21 10:45:00', 'kz20112023', 'kz20112023', 50000),
(16, 'Nước mía', 1, 10000, 'Ly', 'Ship (Khiêm)', '2025-04-21 12:40:00', 'kz20112023', 'kz20112023', 10000),
(17, 'Nước mía', 1, 10000, 'Ly', 'Ship', '2025-04-21 13:20:00', 'kz20112023', 'kz20112023', 10000),
(18, 'Nước mía', 2, 10000, 'Ly', 'Ship', '2025-04-21 15:20:00', 'kz20112023', 'kz20112023', 20000),
(19, 'Nước mía', 1, 5000, 'Ly', 'Tại quán', '2025-04-21 17:10:00', 'kz20112023', 'kz20112023', 5000),
(24, 'Nước mía', 1, 10000, 'Ly', 'Ship', '2025-04-22 12:01:05', 'kz20112023', 'kz20112023', 10000),
(25, 'Nước mía', 2, 10000, 'Ly', 'Ship (Anh Pháp)', '2025-04-22 13:44:29', 'kz20112023', 'kz20112023', 20000),
(26, 'Nước mía', 1, 10000, 'Ly', 'Tại quán', '2024-04-22 11:49:20', 'kz20112023', 'kz20112023', 10000),
(27, 'Nước mía', 1, 10000, 'Ly', 'Ship', '2025-04-22 11:00:23', 'kz20112023', 'kz20112023', 10000),
(28, 'Nước mía', 1, 10000, 'Ly', 'Ship(chuyển khoản)', '2025-04-22 18:43:39', 'kz20112023', 'kz20112023', 10000),
(29, 'Nước mía', 2, 10000, 'Ly', 'Tại quán', '2025-04-22 10:42:08', 'kz20112023', 'kz20112023', 20000),
(30, 'Nước mía ( ko đạt yêu cầu, nhạt quá)', 4, 10000, 'Ly', 'Ship(Khiêm, Pháp)', '2025-04-22 14:19:58', 'kz20112023', 'kz20112023', 0),
(31, 'Nước mía', 5, 10000, 'Ly', 'Ship (Anh Pháp)', '2025-04-23 12:35:13', 'kz20112023', 'kz20112023', 50000),
(32, 'Nước mía', 1, 10000, 'Ly', 'Tại quán', '2025-04-23 12:10:47', 'kz20112023', 'kz20112023', 10000),
(33, 'Nước mía', 2, 10000, 'Ly', 'Tại quán', '2025-04-23 13:40:09', 'kz20112023', 'kz20112023', 20000),
(34, 'Nước mía', 1, 10000, 'Ly', 'Ship', '2025-04-23 16:25:48', 'kz20112023', 'kz20112023', 10000),
(35, 'Nước mía', 2, 10000, 'Ly', 'Tại quán', '2025-04-23 16:18:16', 'kz20112023', 'kz20112023', 20000),
(36, 'Nước mía', 2, 10000, 'Ly', 'Tại quán', '2025-04-23 13:38:42', 'kz20112023', 'kz20112023', 20000),
(37, 'Nước mía', 3, 10000, 'Ly', 'Ship', '2025-04-23 15:54:44', 'kz20112023', 'kz20112023', 30000),
(38, 'Nước mía', 1, 5000, 'Ly', 'Ship', '2025-04-23 17:07:10', 'kz20112023', 'kz20112023', 5000),
(39, 'Nước mía', 2, 5000, 'Ly', 'Ship', '2025-04-24 09:24:24', 'kz20112023', 'kz20112023', 10000),
(40, 'Nước mía', 1, 10000, 'Ly', 'Ship', '2025-04-24 12:27:00', 'kz20112023', 'kz20112023', 10000),
(41, 'Nước mía', 1, 10000, 'Ly', 'Ship', '2025-04-24 15:25:00', 'kz20112023', 'kz20112023', 10000),
(42, 'Nước mía', 22, 10000, 'ly', 'Ship(pháp, cị linh)', '2025-04-24 15:05:00', 'kz20112023', 'kz20112023', 220000),
(43, 'Nước mía', 4, 10000, 'Ly', 'Ship', '2025-04-24 17:37:04', 'kz20112023', 'kz20112023', 40000),
(44, 'Nước mía', 1, 10000, 'Ly', 'Ship (Pháp)', '2025-04-24 19:18:22', 'kz20112023', 'kz20112023', 10000),
(45, '', 2, 10000, 'Ly', 'Tại quán', '2025-04-24 19:49:49', 'kz20112023', 'kz20112023', 20000),
(46, 'Nước mía', 1, 10000, 'Ly', 'Tại quán', '2025-04-24 20:17:05', 'kz20112023', 'kz20112023', 10000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bunhen`
--

CREATE TABLE `bunhen` (
  `id` int(11) NOT NULL,
  `ten_mat_hang` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `so_luong` int(11) DEFAULT NULL,
  `don_gia` decimal(15,0) DEFAULT NULL,
  `don_vi` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `loaisp` text COLLATE utf8mb4_vietnamese_ci,
  `hinh_thuc` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `ngay_ban` datetime DEFAULT NULL,
  `nguoighi` text COLLATE utf8mb4_vietnamese_ci,
  `nguoisua` text COLLATE utf8mb4_vietnamese_ci,
  `thanh_tien` decimal(15,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitieu`
--

CREATE TABLE `chitieu` (
  `id` int(11) NOT NULL,
  `ten_mat_hang` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `so_luong` int(11) DEFAULT NULL,
  `don_gia` decimal(15,0) DEFAULT NULL,
  `don_vi` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `ngay_mua` datetime DEFAULT NULL,
  `nguoi_mua` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `nguoighi` text COLLATE utf8mb4_vietnamese_ci,
  `nguoisua` text COLLATE utf8mb4_vietnamese_ci,
  `thanh_tien` decimal(15,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `chitieu`
--

INSERT INTO `chitieu` (`id`, `ten_mat_hang`, `so_luong`, `don_gia`, `don_vi`, `ngay_mua`, `nguoi_mua`, `nguoighi`, `nguoisua`, `thanh_tien`) VALUES
(1, 'Xô nhựa', 1, 40000, 'Cái', '2025-04-15 00:00:00', 'A Pháp', 'kz20112023', 'kz20112023', 40000),
(2, 'Xô đá', 1, 125000, 'Cái', '2025-04-15 00:00:00', 'A Pháp', 'kz20112023', 'kz20112023', 125000),
(3, 'Xô nhựa', 1, 40000, 'Cái', '2025-04-15 00:00:00', 'A Pháp', 'kz20112023', 'kz20112023', 40000),
(4, 'Xô đá', 1, 125000, 'Cái', '2025-04-15 00:00:00', 'A Pháp', 'kz20112023', 'kz20112023', 125000),
(5, 'Cốc Nhựa', 0, 0, '', '2025-04-15 00:00:00', 'A Dũng', 'kz20112023', 'kz20112023', 0),
(6, '1 ráy, 1 cây lau nhà, 1 dao', 1, 120000, 'Cái,Cái,Con', '2025-04-17 00:00:00', 'A Dũng', 'kz20112023', 'kz20112023', 120000),
(7, 'Hốt rác', 1, 35000, 'Cái', '2025-04-17 00:00:00', 'A Pháp', 'kz20112023', 'kz20112023', 35000),
(8, '5m Dây điện 2.5', 5, 14500, 'Mét', '2025-04-19 00:00:00', 'A Pháp', 'kz20112023', 'kz20112023', 72500),
(9, 'Aptomat', 1, 60000, 'Cái', '2025-04-19 00:00:00', 'A Pháp', 'kz20112023', 'kz20112023', 60000),
(10, 'Ổ 3 lỗ', 1, 20000, 'Cái', '2025-04-19 00:00:00', 'A Pháp', 'kz20112023', 'kz20112023', 20000),
(11, 'khoá việt tiệp', 1, 45000, 'Cái', '2025-04-19 00:00:00', 'A Pháp', 'kz20112023', 'kz20112023', 45000),
(12, 'vit + tắc kê + đinh', 1, 15000, 'Cái, cái, cái', '2025-04-19 00:00:00', 'A Pháp', 'kz20112023', 'kz20112023', 15000),
(13, 'Dao chặt mía', 1, 100000, 'Con', '2025-04-20 00:00:00', 'kz', 'kz20112023', 'kz20112023', 100000),
(14, 'Xô nhựa', 1, 40000, 'Cái', '2025-04-15 00:00:00', 'A Pháp', 'kz20112023', 'kz20112023', 40000),
(15, 'Xô đá', 1, 125000, 'Cái', '2025-04-15 00:00:00', 'A Pháp', 'kz20112023', 'kz20112023', 125000),
(16, 'Cốc Nhựa', 0, 0, '', '2025-04-15 00:00:00', 'A Dũng', 'kz20112023', 'kz20112023', 0),
(17, '1 ráy, 1 cây lau nhà, 1 dao', 1, 120000, 'Cái,Cái,Con', '2025-04-17 00:00:00', 'A Dũng', 'kz20112023', 'kz20112023', 120000),
(18, 'Hốt rác', 1, 35000, 'Cái', '2025-04-17 00:00:00', 'A Pháp', 'kz20112023', 'kz20112023', 35000),
(19, '5m Dây điện 2.5', 5, 14500, 'Mét', '2025-04-19 00:00:00', 'A Pháp', 'kz20112023', 'kz20112023', 72500),
(20, 'Aptomat', 1, 60000, 'Cái', '2025-04-19 00:00:00', 'A Pháp', 'kz20112023', 'kz20112023', 60000),
(21, 'Ổ 3 lỗ', 1, 20000, 'Cái', '2025-04-19 00:00:00', 'A Pháp', 'kz20112023', 'kz20112023', 20000),
(22, 'khoá việt tiệp', 1, 45000, 'Cái', '2025-04-19 00:00:00', 'A Pháp', 'kz20112023', 'kz20112023', 45000),
(23, 'vit + tắc kê + đinh', 1, 15000, 'Cái, cái, cái', '2025-04-19 00:00:00', 'A Pháp', 'kz20112023', 'kz20112023', 15000),
(24, 'Dao chặt mía', 1, 100000, 'Con', '2025-04-20 00:00:00', 'kz', 'kz20112023', 'kz20112023', 100000),
(25, 'Ống hút', 0, 0, '', '2025-04-21 00:00:00', 'A Dũng', 'kz20112023', 'kz20112023', 0),
(26, 'Ly thuỷ tinh', 0, 0, '', '2025-04-21 00:00:00', 'A Dũng', 'kz20112023', 'kz20112023', 0),
(27, 'ống phi 21', 1, 36000, 'Ống', '2025-04-19 00:00:00', 'A Pháp', 'kz20112023', 'kz20112023', 36000),
(28, 'ống chữ T 21', 1, 6000, 'Ống', '2025-04-19 00:00:00', 'A Pháp', 'kz20112023', 'kz20112023', 6000),
(29, 'Co Con 21', 1, 7000, 'Ống', '2025-04-19 00:00:00', 'A Pháp', 'kz20112023', 'kz20112023', 7000),
(30, 'Co 21', 1, 5000, 'Ống', '2025-04-19 00:00:00', 'A Pháp', 'kz20112023', 'kz20112023', 5000),
(31, 'Keo dán ống PVC', 1, 10000, 'Tuýp', '2025-04-19 00:00:00', 'A Pháp', 'kz20112023', 'kz20112023', 10000),
(32, '1 Búp sen (vòi hoa sen), 1 Bi móc', 1, 5000, 'Cái', '2025-04-19 00:00:00', 'A Pháp', 'kz20112023', 'kz20112023', 5000),
(33, 'Quạt Công nghiệp Lifan', 1, 1080000, 'Cái', '2025-04-19 00:00:00', 'A Pháp', 'kz20112023', 'kz20112023', 1080000),
(34, 'Thùng nhựa để bã mía', 1, 180000, 'Cái', '2025-04-21 00:00:00', 'kz', 'kz20112023', 'kz20112023', 180000),
(35, 'Máy Nước Mía', 1, 9800000, 'Máy', '2025-04-08 00:00:00', 'Đaika', 'kz20112023', 'kz20112023', 9800000),
(36, 'Bàn Nhựa', 8, 100000, 'Cái', '2025-04-08 00:00:00', 'Đaika', 'kz20112023', 'kz20112023', 800000),
(37, 'Ghế nhựa', 32, 85000, 'Cái', '2025-04-08 00:00:00', 'Đaika', 'kz20112023', 'kz20112023', 2720000),
(38, 'Ly nhựa bán mia loại 10k', 1, 35000, 'Cầu', '2025-04-24 12:25:00', 'Kz', 'kz20112023', 'kz20112023', 35000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ngansachcuatoi`
--

CREATE TABLE `ngansachcuatoi` (
  `id` int(11) NOT NULL,
  `NganSachHienTai` decimal(10,0) NOT NULL DEFAULT '0',
  `nguoighi` text COLLATE utf8mb4_vietnamese_ci,
  `nguoisua` text COLLATE utf8mb4_vietnamese_ci,
  `ngay_nhap` datetime DEFAULT NULL,
  `thanh_tien` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `ngansachcuatoi`
--

INSERT INTO `ngansachcuatoi` (`id`, `NganSachHienTai`, `nguoighi`, `nguoisua`, `ngay_nhap`, `thanh_tien`) VALUES
(1, 106000, 'kz20112023', 'kz20112023', '2025-04-24 07:55:51', 0),
(2, 126000, 'kz20112023', 'kz20112023', '2025-04-24 22:40:10', 0),
(3, -35000, 'kz20112023', 'kz20112023', '2025-04-24 12:41:22', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhapda`
--

CREATE TABLE `nhapda` (
  `id` int(11) NOT NULL,
  `ten_mat_hang` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `so_luong` int(11) DEFAULT NULL,
  `don_gia` decimal(15,0) DEFAULT NULL,
  `don_vi` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `ngay_nhap` datetime DEFAULT NULL,
  `nguoi_nhap` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `nguoighi` text COLLATE utf8mb4_vietnamese_ci,
  `nguoisua` text COLLATE utf8mb4_vietnamese_ci,
  `thanh_tien` decimal(15,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `nhapda`
--

INSERT INTO `nhapda` (`id`, `ten_mat_hang`, `so_luong`, `don_gia`, `don_vi`, `ngay_nhap`, `nguoi_nhap`, `nguoighi`, `nguoisua`, `thanh_tien`) VALUES
(1, 'Đá cục', 1, 10000, 'Túi', '2025-04-15 18:35:00', 'A Pháp', 'kz20112023', 'kz20112023', 10000),
(2, 'Đá bi', 1, 30000, 'Bao', '2025-04-17 11:35:00', 'A Pháp', 'kz20112023', 'kz20112023', 30000),
(3, 'Đá bi', 1, 30000, 'Bao', '2025-04-20 13:45:00', 'kz', 'kz20112023', 'kz20112023', 30000),
(4, 'Đá bi', 1, 30000, 'Bao', '2025-04-22 11:00:00', 'kz,A Pháp', 'kz20112023', 'kz20112023', 30000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhapmia`
--

CREATE TABLE `nhapmia` (
  `id` int(11) NOT NULL,
  `ten_mat_hang` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `so_luong` int(11) DEFAULT NULL,
  `don_gia` decimal(15,0) DEFAULT NULL,
  `don_vi` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `ngay_nhap` datetime DEFAULT NULL,
  `nguoi_nhap` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `nguoighi` text COLLATE utf8mb4_vietnamese_ci,
  `nguoisua` text COLLATE utf8mb4_vietnamese_ci,
  `thanh_tien` decimal(15,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `nhapmia`
--

INSERT INTO `nhapmia` (`id`, `ten_mat_hang`, `so_luong`, `don_gia`, `don_vi`, `ngay_nhap`, `nguoi_nhap`, `nguoighi`, `nguoisua`, `thanh_tien`) VALUES
(1, 'Mía trắng - cạo + chặt', 1, 0, 'Bó Nhỏ', '2025-04-15 18:15:00', 'A Dũng (Đã trả)', 'kz20112023', 'kz20112023', 0),
(2, 'Mía trắng', 1, 120000, 'Bó', '2025-04-17 12:01:00', 'A Dũng (A Pháp trả)', 'kz20112023', 'kz20112023', 120000),
(3, 'Mía trắng', 1, 120000, 'Bó', '2025-04-21 06:00:00', 'A Pháp', 'kz20112023', 'kz20112023', 120000),
(4, 'Mía trắng + cạo', 1, 130000, 'Bó', '2025-04-23 15:00:00', 'kz', 'kz20112023', 'kz20112023', 130000),
(5, 'Mía trắng + cạo', 1, 130000, 'Bó', '2025-04-24 14:40:00', '( A Dũng)', 'kz20112023', 'kz20112023', 130000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhapquat`
--

CREATE TABLE `nhapquat` (
  `id` int(11) NOT NULL,
  `ten_mat_hang` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `so_luong` int(11) DEFAULT NULL,
  `don_gia` decimal(15,0) DEFAULT NULL,
  `don_vi` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `ngay_nhap` datetime DEFAULT NULL,
  `nguoi_nhap` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `thanh_tien` decimal(15,0) DEFAULT NULL,
  `nguoighi` text COLLATE utf8mb4_vietnamese_ci,
  `nguoisua` text COLLATE utf8mb4_vietnamese_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `nhapquat`
--

INSERT INTO `nhapquat` (`id`, `ten_mat_hang`, `so_luong`, `don_gia`, `don_vi`, `ngay_nhap`, `nguoi_nhap`, `thanh_tien`, `nguoighi`, `nguoisua`) VALUES
(1, 'Túi tắc (quá quắt)', 1, 20000, 'Túi', '2025-04-21 08:25:00', 'KZ', 20000, 'kz20112023', 'kz20112023'),
(2, 'Túi tắc (quá quắt)', 1, 10000, 'Túi', '2025-04-15 08:24:00', 'A Pháp', 10000, 'kz20112023', 'kz20112023'),
(3, 'Chanh', 1, 10000, 'Túi', '2025-04-15 18:33:00', 'A Pháp', 10000, 'kz20112023', 'kz20112023'),
(4, 'Túi tắc (quá quắt)	', 1, 0, 'túi', '2025-04-24 14:24:53', '(Chị linh_vkADũng)', 0, 'kz20112023', 'kz20112023');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tiendiennuoc`
--

CREATE TABLE `tiendiennuoc` (
  `id` int(11) NOT NULL,
  `ten` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `don_gia` decimal(15,2) DEFAULT NULL,
  `so_cong_to_thang_truoc` int(11) DEFAULT NULL,
  `so_cong_to_thang_sau` int(11) DEFAULT NULL,
  `tu_ngay_den_ngay` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `ngay_dong` datetime DEFAULT NULL,
  `nguoi_dong` text COLLATE utf8mb4_vietnamese_ci,
  `nguoighi` text COLLATE utf8mb4_vietnamese_ci,
  `nguoisua` text COLLATE utf8mb4_vietnamese_ci,
  `thanh_tien` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bannuocmia`
--
ALTER TABLE `bannuocmia`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `bunhen`
--
ALTER TABLE `bunhen`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `chitieu`
--
ALTER TABLE `chitieu`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ngansachcuatoi`
--
ALTER TABLE `ngansachcuatoi`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `nhapda`
--
ALTER TABLE `nhapda`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `nhapmia`
--
ALTER TABLE `nhapmia`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `nhapquat`
--
ALTER TABLE `nhapquat`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tiendiennuoc`
--
ALTER TABLE `tiendiennuoc`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bannuocmia`
--
ALTER TABLE `bannuocmia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT cho bảng `bunhen`
--
ALTER TABLE `bunhen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `chitieu`
--
ALTER TABLE `chitieu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT cho bảng `ngansachcuatoi`
--
ALTER TABLE `ngansachcuatoi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `nhapda`
--
ALTER TABLE `nhapda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `nhapmia`
--
ALTER TABLE `nhapmia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `nhapquat`
--
ALTER TABLE `nhapquat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `tiendiennuoc`
--
ALTER TABLE `tiendiennuoc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
