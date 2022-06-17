-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 17, 2022 lúc 01:32 PM
-- Phiên bản máy phục vụ: 10.4.20-MariaDB
-- Phiên bản PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quanlylichphongmay`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giangvien`
--

CREATE TABLE `giangvien` (
  `MaGiangVien` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `HoTen` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `GioiTinh` tinyint(1) NOT NULL,
  `Email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SDT` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `giangvien`
--

INSERT INTO `giangvien` (`MaGiangVien`, `HoTen`, `GioiTinh`, `Email`, `SDT`) VALUES
('batman', 'Lê La 2', 0, 'caoducchinh2001@gmail.com', '+29342423423'),
('GV01', 'Giảng viên số 01', 1, 'xuanmanhdao2001@gmail.com', '0332342332'),
('GV02', 'Giảng viên 02', 0, 'xuanmanhdao2001@gmail.com', '+84381723391'),
('GV40', 'Giarg viên số 40', 0, 'xuanmanhdao2001@gmail.com', '045234234234'),
('GV41', 'Giarg viên số 40', 1, 'xuanmanhdao2001@gmail.com', '045234234234'),
('GV42', 'Giarg viên số 40', 0, 'xuanmanhdao2001@gmail.com', '045234234234'),
('GV43', 'Giảng viên test 43', 1, 'phamngochue127@gmail.com', '023423423423'),
('GV60CNTT23', 'Giảng viên công nghệ thông tin k70', 1, 'daoxuannam2k4@gmail.com', '06575675'),
('GV70DCHT21', 'Giảng viên hệ thống K70', 0, 'xuanmanhdao2001@gmail.com', '0452342'),
('superadmin', 'Tài khoản quản lý', 1, 'xuanmanhdao2001@gmail.com', '095633');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lichmuonphong`
--

CREATE TABLE `lichmuonphong` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `NgayMuon` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TietHoc` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `MaPhong` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `MaGiangVien` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Sync` int(11) NOT NULL DEFAULT 0,
  `GhiChu` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lichmuonphong`
--

INSERT INTO `lichmuonphong` (`id`, `NgayMuon`, `TietHoc`, `MaPhong`, `MaGiangVien`, `Sync`, `GhiChu`) VALUES
(14, '12-06-2022', '3,4', 'A6P301', 'GV70DCHT21', 1, '<p>tessstst2</p>'),
(17, '17-06-2022', '3,4', 'A5P101', 'GV60CNTT23', 1, NULL),
(18, '30-05-2022', '4,7', 'A5P101', 'GV70DCHT21', 0, NULL),
(19, '15-07-2022', '5,6', 'A5P391', 'GV60CNTT23', 1, NULL),
(20, '14-06-2022', '2,3', 'A6P301', 'GV60CNTT23', 1, NULL),
(21, '23-06-2022', '3,4,5', 'A5P401', 'superadmin', 1, '<p>Alaoaoaoaoao</p><p><br></p>'),
(22, '17-06-2022', '3,5', 'A5P401', 'batman', 0, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2022_05_26_052847_create_phongs_table', 1),
(5, '2022_05_26_174505_create_giangviens_table', 2),
(6, '2022_05_26_180002_create_giang_viens_table', 3),
(7, '2022_05_27_075909_create_tai_khoans_table', 4),
(8, '2022_05_28_032352_create_lich_muon_phongs_table', 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
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
-- Cấu trúc bảng cho bảng `phong`
--

CREATE TABLE `phong` (
  `MaPhong` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TenPhong` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SoMay` int(11) NOT NULL,
  `TinhTrang` tinyint(1) NOT NULL DEFAULT 0,
  `GhiChu` varchar(2000) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phong`
--

INSERT INTO `phong` (`MaPhong`, `TenPhong`, `SoMay`, `TinhTrang`, `GhiChu`) VALUES
('A5P101', 'P101', 70, 1, '<p><img src=\"https://scontent.fhan9-1.fna.fbcdn.net/v/t39.30808-6/284449907_3154247374789241_202992253735455533_n.jpg?stp=dst-jpg_p640x640&amp;_nc_cat=111&amp;ccb=1-7&amp;_nc_sid=5cd70e&amp;_nc_ohc=U50D8fOZpfAAX-D9mNg&amp;tn=8RE6aX074bk4DJSd&amp;_nc_ht=scontent.fhan9-1.fna&amp;oh=00_AT8zEk--xU9lxHcRVoer5gR5BggGdolMp4zzpJOrIJ3X4Q&amp;oe=62A6403F\" style=\"width: 25%;\">15 máy mới</p><p><br></p>'),
('A5P143', 'P143', 40, 1, '<p>test 25</p>'),
('A5P391', 'P391', 45, 0, '<p>AAAA</p>'),
('A5P401', 'P401', 45, 0, '<p><span style=\"background-color: rgb(255, 255, 255);\"><font color=\"#000000\">Máy số 18 hỏng</font></span></p>'),
('A5P402', 'P402', 34, 0, NULL),
('A5P403', 'P403', 32, 0, '<p>aa2124313</p>'),
('A5P404', 'P404', 65, 1, '<p>Test 14/6/22!</p>'),
('A6P301', 'P301', 56, 0, '<p>Tạo phòng A6P301</p>'),
('A6P404', 'P404', 132, 0, '<p>A</p>'),
('A6P502', 'P502', 48, 0, '<p>Test php artisan serve</p>');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `MaGiangVien` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `MatKhau` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '123456',
  `Quyen` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`MaGiangVien`, `MatKhau`, `Quyen`) VALUES
('batman', '$2y$10$N79pqFaor9kvbR7Aw.btAuZWjyKzqKbdsu0DJssfQrayWlGH2VDn6', 1),
('GV01', '$2y$10$NxHajiiYhNkPKg0zz0w0n.Lxc8GcmLqVr/HAqEjmBoMPbmSHG3C7.', 2),
('GV02', '$2y$10$RoDSHjnBLA2nzp5ZMS8jWepQ7x7Ig6wJo/Exoug.Y24M1o4YMiL4u', 1),
('GV40', '$2y$10$SeM7g6qu/qHTFNol0zVqzuJ/KxHkJv92bXfQozbAWxBty9in1lOM2', 1),
('GV41', '$2y$10$FTKdI6seVych/Qzrgw65a.jq4uOwSdHw/KZQbgnPXdKWLJf0c37Jy', 1),
('GV42', '$2y$10$meMSxaykeIMYgYuF9CEtQO60on8hMKrIDDLEHfseOgnBl0zwZ04jS', 1),
('GV43', '$2y$10$w9Mm17g0iCV7ISursUlbSOPQhx/8quRDI/9lyub.4iaLZ60UA4zKu', 1),
('GV60CNTT23', '$2y$10$WmLp.TP9NFESoGAegvLYaufkYpPtdtRjlhDykt7dR6mc6L9KGjw4y', 1),
('GV70DCHT21', '$2y$10$vL87X3PnzFGg6bkKGf/NU.9ar5AuTWv.72RRPZuHKW/eHMpr/y4g6', 2),
('superadmin', '$2y$10$CJrTrA1Xp6B/SIW4XAJGVeGCEliFllxH75aHI4XqzvOcKD.64FWmi', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `giangvien`
--
ALTER TABLE `giangvien`
  ADD PRIMARY KEY (`MaGiangVien`);

--
-- Chỉ mục cho bảng `lichmuonphong`
--
ALTER TABLE `lichmuonphong`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lichmuonphong_maphong_foreign` (`MaPhong`),
  ADD KEY `lichmuonphong_magiangvien_foreign` (`MaGiangVien`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `phong`
--
ALTER TABLE `phong`
  ADD PRIMARY KEY (`MaPhong`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`MaGiangVien`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `lichmuonphong`
--
ALTER TABLE `lichmuonphong`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `lichmuonphong`
--
ALTER TABLE `lichmuonphong`
  ADD CONSTRAINT `lichmuonphong_magiangvien_foreign` FOREIGN KEY (`MaGiangVien`) REFERENCES `giangvien` (`MaGiangVien`),
  ADD CONSTRAINT `lichmuonphong_maphong_foreign` FOREIGN KEY (`MaPhong`) REFERENCES `phong` (`MaPhong`);

--
-- Các ràng buộc cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD CONSTRAINT `taikhoan_magiangvien_foreign` FOREIGN KEY (`MaGiangVien`) REFERENCES `giangvien` (`MaGiangVien`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
