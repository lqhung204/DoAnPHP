-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 02, 2023 lúc 11:26 AM
-- Phiên bản máy phục vụ: 10.4.25-MariaDB
-- Phiên bản PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shopquanao`
--
CREATE DATABASE IF NOT EXISTS `shopquanao` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `shopquanao`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `color`
--

CREATE TABLE `color` (
  `color_id` int(50) NOT NULL,
  `colorName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `color`
--

INSERT INTO `color` (`color_id`, `colorName`) VALUES
(5, 'Đen'),
(6, 'Trắng'),
(7, 'Đỏ'),
(8, 'Xanh');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(50) NOT NULL,
  `customerName` varchar(255) NOT NULL,
  `phoneNumber` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `sexual` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `emolyee`
--

CREATE TABLE `emolyee` (
  `employee_id` int(50) NOT NULL,
  `employeeName` varchar(500) DEFAULT NULL,
  `phoneNumber` varchar(500) DEFAULT NULL,
  `userName` varchar(500) DEFAULT NULL,
  `passWord` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `oder`
--

CREATE TABLE `oder` (
  `oder_id` int(11) NOT NULL,
  `employee_id` int(50) NOT NULL,
  `customer_id` int(50) NOT NULL,
  `createDay` date NOT NULL,
  `total` double NOT NULL,
  `customerName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `oderdetail`
--

CREATE TABLE `oderdetail` (
  `product_id` int(50) NOT NULL,
  `oder_id` int(50) NOT NULL,
  `quantity` int(50) NOT NULL,
  `unitPice` double NOT NULL,
  `detail_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `productName` varchar(500) NOT NULL,
  `colorID` int(50) NOT NULL,
  `unit` int(50) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `available` int(50) DEFAULT NULL,
  `productPicture` varchar(500) NOT NULL,
  `typeproduct_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`product_id`, `productName`, `colorID`, `unit`, `price`, `available`, `productPicture`, `typeproduct_id`) VALUES
(22, '                                 Áo Thun Có Cổ               ', 6, 100, 99000, 10, 'uploads/20230326095630ao-thun-co-tron-mau-trang.jpg', 5),
(23, 'Áo Khoác Đen                 ', 5, 190, 250000, 10, 'uploads/202303260957038b1d543f33529e2f63adeb1eac3703b0.jpg', 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `typeofproduct`
--

CREATE TABLE `typeofproduct` (
  `typeproduct_id` int(50) NOT NULL,
  `typeName` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `typeofproduct`
--

INSERT INTO `typeofproduct` (`typeproduct_id`, `typeName`) VALUES
(5, '                       Áo Thun                         '),
(6, '                          Áo Khoác                      '),
(7, '                            Quần                    ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `userID` int(10) NOT NULL,
  `userName` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`userID`, `userName`, `email`, `password`) VALUES

(15, 'admin', 'admin@gmail.com', '0192023a7bbd73250516f069df18b500');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`color_id`);

--
-- Chỉ mục cho bảng `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Chỉ mục cho bảng `emolyee`
--
ALTER TABLE `emolyee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Chỉ mục cho bảng `oder`
--
ALTER TABLE `oder`
  ADD PRIMARY KEY (`oder_id`),
  ADD KEY `employee_id` (`employee_id`,`customer_id`),
  ADD KEY `custom_employee` (`customer_id`);

--
-- Chỉ mục cho bảng `oderdetail`
--
ALTER TABLE `oderdetail`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `detail_floid` (`product_id`),
  ADD KEY `details_oder` (`oder_id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `flower_colorid` (`colorID`),
  ADD KEY `typeflower` (`typeproduct_id`);

--
-- Chỉ mục cho bảng `typeofproduct`
--
ALTER TABLE `typeofproduct`
  ADD PRIMARY KEY (`typeproduct_id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `color`
--
ALTER TABLE `color`
  MODIFY `color_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `emolyee`
--
ALTER TABLE `emolyee`
  MODIFY `employee_id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `oder`
--
ALTER TABLE `oder`
  MODIFY `oder_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `oderdetail`
--
ALTER TABLE `oderdetail`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `typeofproduct`
--
ALTER TABLE `typeofproduct`
  MODIFY `typeproduct_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `oder`
--
ALTER TABLE `oder`
  ADD CONSTRAINT `custom_employee` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `oder_employ` FOREIGN KEY (`employee_id`) REFERENCES `emolyee` (`employee_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `oderdetail`
--
ALTER TABLE `oderdetail`
  ADD CONSTRAINT `detail_floid` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `details_oder` FOREIGN KEY (`oder_id`) REFERENCES `oder` (`oder_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `flower_colorid` FOREIGN KEY (`colorID`) REFERENCES `color` (`color_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `typeflower` FOREIGN KEY (`typeproduct_id`) REFERENCES `typeofproduct` (`typeproduct_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
