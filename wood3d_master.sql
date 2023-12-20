-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 20, 2023 lúc 04:38 AM
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
-- Cơ sở dữ liệu: `wood3d_master`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill`
--

CREATE TABLE `bill` (
  `id` int(9) NOT NULL,
  `madh` varchar(50) NOT NULL,
  `iduser` int(6) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `date` varchar(50) NOT NULL,
  `ship` int(6) NOT NULL DEFAULT 0,
  `voucher` int(6) NOT NULL DEFAULT 0,
  `total` int(6) NOT NULL,
  `pttt` varchar(50) NOT NULL,
  `note` varchar(255) NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` int(6) NOT NULL,
  `idpro` int(6) NOT NULL,
  `sale` int(6) NOT NULL,
  `name` varchar(500) NOT NULL,
  `img` varchar(255) NOT NULL,
  `quantity` int(3) NOT NULL,
  `option1` varchar(50) NOT NULL,
  `option2` varchar(50) DEFAULT NULL,
  `total` int(6) NOT NULL,
  `idbill` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(5) NOT NULL,
  `name_category` varchar(255) NOT NULL,
  `type` varchar(20) NOT NULL,
  `stt` int(5) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name_category`, `type`, `stt`) VALUES
(21, 'Bàn Vuông', 'img', 0),
(22, 'Bàn Tam Giác', '3d', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `home`
--

CREATE TABLE `home` (
  `id` int(6) NOT NULL,
  `home1` varchar(50) NOT NULL,
  `home2` varchar(50) NOT NULL,
  `home3` varchar(50) NOT NULL,
  `deal1` varchar(50) NOT NULL,
  `login1` varchar(50) NOT NULL,
  `login2` varchar(50) NOT NULL,
  `login3` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `home`
--

INSERT INTO `home` (`id`, `home1`, `home2`, `home3`, `deal1`, `login1`, `login2`, `login3`) VALUES
(1, '1702460237_hero-1.png', '1702460237_hero-2.png', '1702460237_hero-3.png', '1702460253_banner-3.png', '1702460237_thanhcong1.png', '1702460237_canhbao.png', '1702460237_success.gif');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `options_img1` varchar(255) NOT NULL DEFAULT '0',
  `options_img2` varchar(255) NOT NULL DEFAULT '0',
  `options_img3` varchar(255) NOT NULL DEFAULT '0',
  `options_name` varchar(255) NOT NULL,
  `options_name_1` varchar(255) NOT NULL,
  `options_name_2` varchar(255) NOT NULL DEFAULT '0',
  `options_name_3` varchar(255) NOT NULL DEFAULT '0',
  `price_option1` int(5) NOT NULL,
  `price_option2` int(5) NOT NULL DEFAULT 0,
  `price_option3` int(5) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `img` varchar(150) NOT NULL,
  `img2` varchar(150) NOT NULL,
  `glb` varchar(150) NOT NULL DEFAULT '0',
  `price` int(5) NOT NULL DEFAULT 0,
  `sale` int(5) NOT NULL DEFAULT 0,
  `view` int(5) NOT NULL DEFAULT 0,
  `id_category` int(5) NOT NULL,
  `type` varchar(50) NOT NULL,
  `detail` varchar(255) NOT NULL,
  `options_name` varchar(255) DEFAULT NULL,
  `options_name_1` varchar(255) DEFAULT NULL,
  `options_name_2` varchar(255) DEFAULT NULL,
  `options_name_3` varchar(50) DEFAULT NULL,
  `options_img1` varchar(255) NOT NULL DEFAULT '0',
  `options_img2` varchar(255) NOT NULL DEFAULT '0',
  `options_img3` varchar(255) DEFAULT NULL,
  `options_price1` varchar(50) NOT NULL DEFAULT '0',
  `options_price2` varchar(50) NOT NULL DEFAULT '0',
  `options_price3` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT '0',
  `phone` int(6) DEFAULT 0,
  `code` int(5) NOT NULL,
  `status` int(5) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `address`, `phone`, `code`, `status`) VALUES
(10, 'Admin', 'wood3d.master@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '0', 0, 966405, 2),
(185, '12 12', 'worknbtn@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '12, Xã Quỳnh Phú, Huyện Gia Bình, Tỉnh Bắc Ninh', 12, 547413, 1),
(187, '1234', 'nguyenbactrungnam12345@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '1212, Phường 15, Quận Gò Vấp, Thành phố Hồ Chí Minh', 918685740, 389059, 1),
(188, 'Nguyễn  Bắc Trung Nam', 'www@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '42/4 Trung Mỹ Tây 4, Xã Trung Chánh, Huyện Hóc Môn, Thành phố Hồ Chí Minh', 918685740, 899525, 1),
(189, '1 2', '3131', 'e10adc3949ba59abbe56e057f20f883e', '12, Xã Vũ Di, Huyện Vĩnh Tường, Tỉnh Vĩnh Phúc', 1221, 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `voucher`
--

CREATE TABLE `voucher` (
  `id` int(11) NOT NULL,
  `name_voucher` varchar(50) NOT NULL,
  `price_voucher` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `voucher`
--

INSERT INTO `voucher` (`id`, `name_voucher`, `price_voucher`) VALUES
(65, 'Siêu Sale', 500000),
(71, '3', 3);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_bill_user` (`iduser`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `home`
--
ALTER TABLE `home`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product_category` (`id_category`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bill`
--
ALTER TABLE `bill`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `home`
--
ALTER TABLE `home`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;

--
-- AUTO_INCREMENT cho bảng `voucher`
--
ALTER TABLE `voucher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `fk_bill_user` FOREIGN KEY (`iduser`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_category` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
