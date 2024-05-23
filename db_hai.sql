-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3308
-- Thời gian đã tạo: Th5 22, 2024 lúc 07:58 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `db_hai`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `login_tbl`
--

CREATE TABLE `login_tbl` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `login_tbl`
--

INSERT INTO `login_tbl` (`id`, `username`, `password`, `user_type`) VALUES
(1, 'admin', 'admin', 1),
(2, 'nam@gmail.com', '0123456789', 2),
(3, 'thang@gmail.com', '0123456788', 2),
(4, 'thong@gmail.com', '0123456787', 2),
(5, 'vuong@gmail.com', '0123456786', 2),
(6, 'nhuan@gmail.com', '0123456785', 2),
(7, 'a@gmail.com', '0123456784', 2),
(8, 'b@gmail.com', '0123456783', 2),
(9, 'c@gmail.com', '0123456782', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lop_tbl`
--

CREATE TABLE `lop_tbl` (
  `id_lop` int(255) NOT NULL,
  `ten_lop` varchar(255) NOT NULL,
  `ngay_them` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `lop_tbl`
--

INSERT INTO `lop_tbl` (`id_lop`, `ten_lop`, `ngay_them`) VALUES
(1, 'D21CQCN01-B', '2024-04-23 15:11:03'),
(2, 'D21CQCN02-B', '2024-04-23 15:12:02'),
(3, 'D21CQCN03-B', '2024-04-23 15:11:03'),
(4, 'D21CQCN04-B', '2024-04-23 15:11:03'),
(5, 'D21CQCN05-B', '2024-04-23 15:11:03'),
(6, 'D21CQCN06-B', '2024-04-23 15:11:03'),
(7, 'D21CQCN07-B', '2024-04-23 15:11:03'),
(8, 'D21CQCN08-B', '2024-04-23 15:11:03'),
(11, 'D21CQCN09-B', '2024-05-21 17:55:08');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nghi_phep`
--

CREATE TABLE `nghi_phep` (
  `id` int(255) NOT NULL,
  `id_sinhvien` int(255) NOT NULL,
  `ly_do` varchar(255) NOT NULL,
  `chi_tiet` text NOT NULL,
  `ngay_bat_dau` date NOT NULL,
  `ngay_ket_thuc` date NOT NULL,
  `ngay_tao_don` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `trang_thai` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `nghi_phep`
--

INSERT INTO `nghi_phep` (`id`, `id_sinhvien`, `ly_do`, `chi_tiet`, `ngay_bat_dau`, `ngay_ket_thuc`, `ngay_tao_don`, `trang_thai`) VALUES
(3, 3, 'Gãy chân', 'Đi xe gãy chân', '2024-05-23', '2024-05-25', '2024-05-22 17:56:43', 1),
(4, 0, 'Bị ốm', 'Em bị ốm 2 tháng nay', '2024-05-22', '2024-05-25', '2024-05-21 17:47:14', 0),
(5, 3, 'Bị ốm', 'Em bị ốm 2 tháng nay', '2024-05-22', '2024-05-25', '2024-05-22 17:56:44', 1),
(6, 0, 'Bị ốm', 'Em bị ốm 2 tháng nay', '2024-05-22', '2024-05-24', '2024-05-21 17:58:05', 0),
(7, 9, 'Bị ốm', 'Em bị ốm 2 tháng nay', '2024-05-22', '2024-05-31', '2024-05-22 17:56:44', 1),
(8, 3, 'Mất xe', 'Mất xe máy', '2024-05-22', '2024-05-24', '2024-05-22 17:56:44', 1),
(9, 9, 'Mất xe', 'Mất xe máy', '2024-05-22', '2024-05-23', '2024-05-22 17:56:43', 1),
(10, 3, 'Gãy tay', 'Đi xe gãy tay', '2024-05-23', '2024-05-25', '2024-05-22 17:56:42', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sinh_vien_tbl`
--

CREATE TABLE `sinh_vien_tbl` (
  `id_sv` int(255) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `ngay_sinh` varchar(255) NOT NULL,
  `gioi_tinh` varchar(255) NOT NULL,
  `so_dien_thoai` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dia_chi` varchar(255) NOT NULL,
  `id_lop` int(11) NOT NULL,
  `ngay_vao_hoc` date NOT NULL,
  `ngay_them` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `anh` varchar(255) NOT NULL DEFAULT 'default_avata.png',
  `ngay_cap_nhat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sinh_vien_tbl`
--

INSERT INTO `sinh_vien_tbl` (`id_sv`, `ten`, `ngay_sinh`, `gioi_tinh`, `so_dien_thoai`, `email`, `dia_chi`, `id_lop`, `ngay_vao_hoc`, `ngay_them`, `anh`, `ngay_cap_nhat`) VALUES
(2, 'Phạm Hoài Nam', '2003-08-24', 'Nam', '0123456789', 'nam@gmail.com', 'Kim Chung, Đông Anh, Hà Nội', 1, '2024-04-23', '2024-05-21 17:19:16', 'default_avatar.svg', '2024-04-23'),
(3, 'Nguyễn Quang Thắng', '2003-01-01', 'Nam', '0123456788', 'thang@gmail.com', 'Hà Đông, Hà Nội', 2, '2024-04-23', '2024-05-21 17:19:16', 'default_avatar.svg', '2024-04-23'),
(4, 'Đào Duy Thông', '2003-01-01', 'Nam', '0123456787', 'thong@gmail.com', 'Hà Đông, Hà Nội', 3, '2024-04-23', '2024-05-21 17:19:16', 'default_avatar.svg', '2024-04-23'),
(5, 'Lê Minh Vuong', '2003-01-01', 'Nam', '0123456786', 'vuong@gmail.com', 'Hà Đông, Hà Nội', 4, '2024-04-23', '2024-05-21 17:19:16', 'default_avatar.svg', '2024-04-23'),
(6, 'Hồ Văn Nhuận', '2003-01-01', 'Nam', '0123456785', 'nhuan@gmail.com', 'Hà Đông, Hà Nội', 5, '2024-04-23', '2024-05-21 17:19:16', 'default_avatar.svg', '2024-04-23'),
(7, 'Lê Văn A', '2003-01-01', 'Nam', '0123456784', 'a@gmail.com', 'Ba Đình, Hà Nội', 6, '2024-04-23', '2024-05-21 17:19:16', 'default_avatar.svg', '2024-04-23'),
(8, 'Nguyễn Văn B', '2003-01-01', 'Nam', '0123456783', 'b@gmail.com', 'Thanh Xuân, Hà Nội', 7, '2024-04-23', '2024-05-21 17:19:16', 'default_avatar.svg', '2024-04-23'),
(9, 'Nguyễn Thị C', '2003-01-01', 'Nữ', '0123456782', 'c@gmail.com', 'Đống Đa, Hà Nội', 8, '2024-04-23', '2024-05-21 17:19:16', 'default_avatar.svg', '2024-04-23'),
(10, 'Nguyễn Thanh Hải', '2003-11-03', 'Nam', '0967726886', 'hai@gmail.com', 'Đại Áng, Hà Nội', 1, '2024-05-22', '2024-05-22 15:43:19', 'default_avatar.svg', '2024-05-22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tien_dich_vu_tbl`
--

CREATE TABLE `tien_dich_vu_tbl` (
  `id_tien` int(255) NOT NULL,
  `id_sinhvien` int(255) NOT NULL,
  `tong` bigint(255) NOT NULL,
  `da_dong` bigint(255) NOT NULL,
  `con_lai` bigint(255) NOT NULL,
  `ngay_them` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ngay_cap_nhat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tien_dich_vu_tbl`
--

INSERT INTO `tien_dich_vu_tbl` (`id_tien`, `id_sinhvien`, `tong`, `da_dong`, `con_lai`, `ngay_them`, `ngay_cap_nhat`) VALUES
(1, 2, 100000, 25000, 75000, '2024-05-22 15:06:27', '2024-05-22'),
(2, 3, 150000, 100000, 50000, '2024-05-21 17:32:20', '2024-05-22'),
(3, 4, 50000, 25000, 25000, '2024-04-23 15:58:21', '2024-04-23'),
(4, 5, 200000, 200000, 0, '2024-04-23 15:58:21', '2024-04-23'),
(5, 6, 150000, 0, 150000, '2024-05-22 15:07:40', '2024-05-23'),
(6, 7, 200000, 200000, 0, '2024-04-23 15:58:21', '2024-04-23'),
(7, 8, 50000, 30000, 20000, '2024-05-22 17:18:06', '2024-05-23'),
(8, 9, 100000, 50000, 50000, '2024-05-22 15:07:22', '2024-05-22'),
(28, 10, 900000, 800000, 100000, '2024-05-22 17:55:46', '2024-05-23');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `login_tbl`
--
ALTER TABLE `login_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `lop_tbl`
--
ALTER TABLE `lop_tbl`
  ADD PRIMARY KEY (`id_lop`);

--
-- Chỉ mục cho bảng `nghi_phep`
--
ALTER TABLE `nghi_phep`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sinh_vien_tbl`
--
ALTER TABLE `sinh_vien_tbl`
  ADD PRIMARY KEY (`id_sv`);

--
-- Chỉ mục cho bảng `tien_dich_vu_tbl`
--
ALTER TABLE `tien_dich_vu_tbl`
  ADD PRIMARY KEY (`id_tien`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `login_tbl`
--
ALTER TABLE `login_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `lop_tbl`
--
ALTER TABLE `lop_tbl`
  MODIFY `id_lop` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `nghi_phep`
--
ALTER TABLE `nghi_phep`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `sinh_vien_tbl`
--
ALTER TABLE `sinh_vien_tbl`
  MODIFY `id_sv` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `tien_dich_vu_tbl`
--
ALTER TABLE `tien_dich_vu_tbl`
  MODIFY `id_tien` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
