-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 19, 2025 lúc 06:30 AM
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
-- Cơ sở dữ liệu: `web_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ctdh`
--

CREATE TABLE `ctdh` (
  `IDDH` int(12) NOT NULL,
  `IDSP` int(12) NOT NULL,
  `SL` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `ctdh`
--

INSERT INTO `ctdh` (`IDDH`, `IDSP`, `SL`) VALUES
(1, 1, 3),
(2, 2, 2),
(3, 3, 3),
(4, 4, 3),
(5, 5, 8),
(6, 6, 6),
(7, 7, 3),
(8, 8, 5),
(6, 1, 1),
(6, 2, 2),
(1, 10, 5),
(6, 10, 5),
(6, 8, 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ctsp`
--

CREATE TABLE `ctsp` (
  `IDSP` int(12) NOT NULL,
  `URL` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `ctsp`
--

INSERT INTO `ctsp` (`IDSP`, `URL`) VALUES
(1, 'img/shop/shop-1.jpg\r\n'),
(2, 'img/shop/shop-2.jpg'),
(3, 'img/shop/shop-3.jpg'),
(4, 'img/shop/shop-4.jpg'),
(5, 'img/shop/shop-5.jpg'),
(6, 'img/shop/shop-6.jpg'),
(7, 'img/shop/shop-7.jpg'),
(8, 'img/shop/shop-8.jpg'),
(9, 'img/shop/shop-9.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dh`
--

CREATE TABLE `dh` (
  `IDDH` int(12) NOT NULL,
  `IDKH` varchar(255) NOT NULL,
  `TONG` decimal(20,0) DEFAULT NULL,
  `TIME` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `TRANGTHAI` enum('Chưa xác nhận','Đã xác nhận','Đang giao','Đã giao - Thành công','Đã giao - Hủy đơn') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `dh`
--

INSERT INTO `dh` (`IDDH`, `IDKH`, `TONG`, `TIME`, `TRANGTHAI`) VALUES
(1, 'KH001', 7935000, '2014-12-12 09:00:00.000000', 'Chưa xác nhận'),
(2, 'KH002', 5132000, '2024-02-04 09:00:00.000000', 'Chưa xác nhận'),
(3, 'KH004', 7530000, '2025-12-29 00:00:00.000000', 'Chưa xác nhận'),
(4, 'KH005', 8997000, '2023-02-12 09:00:00.000000', 'Chưa xác nhận'),
(5, 'KH001', 21632000, '2025-10-20 21:59:00.000000', 'Chưa xác nhận'),
(6, 'KH002', 69072000, '2025-10-20 12:59:00.000000', 'Chưa xác nhận'),
(7, 'KH003', 9369000, '2025-12-01 23:59:00.000000', 'Chưa xác nhận'),
(8, 'KH004', 19995000, '2025-01-10 01:00:00.000000', 'Chưa xác nhận');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `kh`
--

CREATE TABLE `kh` (
  `IDKH` varchar(255) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `DC` varchar(255) NOT NULL,
  `SDT` varchar(20) NOT NULL,
  `STATUS` varchar(50) NOT NULL,
  `MK` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `kh`
--

INSERT INTO `kh` (`IDKH`, `NAME`, `DC`, `SDT`, `STATUS`, `MK`) VALUES
('KH000', 'user', '...', '000', 'Available', 'pass'),
('KH001', 'Nguyễn Văn A', 'Quận Đống Đa, Hà Nội', '0123456789', 'Available', 'pass'),
('KH002', 'Trần Thị B', 'Quận 2, Hồ Chí Minh', '0987654321', 'Available', 'pass'),
('KH003', 'Phạm Văn C', 'Quận 4, Hồ Chí Minh', '0345678901', 'Available', 'pass'),
('KH004', 'Lê Thị D', 'Quận 5, Hồ Chí Minh', '0123456780', 'Available', 'pass'),
('KH005', 'Huy Hồ', 'Quận Bình Tân, Hồ Chí Minh', '0707360972', 'Available', 'pass');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaisp`
--

CREATE TABLE `loaisp` (
  `IDLSP` int(12) NOT NULL,
  `TENLOAI` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `loaisp`
--

INSERT INTO `loaisp` (`IDLSP`, `TENLOAI`) VALUES
(1, 'Nike'),
(2, 'Adidas'),
(3, 'New Balance');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sp`
--

CREATE TABLE `sp` (
  `IDSP` int(11) NOT NULL,
  `IDLSP` int(11) NOT NULL,
  `URL` varchar(255) NOT NULL,
  `TEN` varchar(255) NOT NULL,
  `MOTA` varchar(255) NOT NULL,
  `GIABAN` int(255) NOT NULL,
  `GIABANKM` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sp`
--

INSERT INTO `sp` (`IDSP`, `IDLSP`, `URL`, `TEN`, `MOTA`, `GIABAN`, `GIABANKM`) VALUES
(1, 1, 'img/shop/shop-1.jpg', 'Nike Air Force 1 \'07 High', 'Biểu tượng bóng rổ cổ điển, cổ cao hỗ trợ, da cao cấp, đệm Air êm ái. Phong cách vượt thời gian.', 3450000, 2645000),
(2, 1, 'img/shop/shop-2.jpg', 'Nike SFB Field 2 8”', 'Bốt quân đội bền bỉ, cổ cao bảo vệ, chống thấm nước, đế bám tốt. Phù hợp hoạt động ngoài trời.', 3200000, 2566000),
(3, 2, 'img/shop/shop-3.jpg', 'Campus 00s Shoes\r\n', 'Phong cách trượt ván thập niên 2000, form dáng chunky, chất liệu da lộn, phong cách đường phố năng động.', 4500000, 2510000),
(4, 1, 'img/shop/shop-4.jpg', 'Nikes Air Max', 'Công nghệ đệm Air, nhiều kiểu dáng, êm ái, phù hợp thể thao và thời trang hàng ngày.', 3566000, 2999000),
(5, 2, 'img/shop/shop-5.jpg', 'Adidas Ultraboost', 'Giày chạy bộ cao cấp, đệm Boost êm ái, chất liệu Primeknit, đế Continental bám tốt.', 3588000, 2704000),
(6, 1, 'img/shop/shop-6.jpg', 'Nike Lebron', 'Giày bóng rổ hiệu suất cao, thiết kế mạnh mẽ, đệm Air Max/Zoom Air, độ bền cao.', 5566000, 4500000),
(7, 1, 'img/shop/shop-7.jpg', 'Nike Cortez OG', 'Giày chạy bộ cổ điển, thiết kế đơn giản, chất liệu da/nylon, phong cách vượt thời gian.\r\n', 4444000, 3123000),
(8, 1, 'img/shop/shop-8.jpg', 'Nike Court', 'Giày tennis thanh lịch, chất liệu da, đế bám tốt, hỗ trợ di chuyển trên sân.', 5000000, 3999000),
(9, 3, 'img/shop/shop-9.jpg', 'New Balance 530 Retro ‘Running Navy’ MR530SG', 'Giày chạy bộ retro, thiết kế chunky, chất liệu đa dạng, đệm ABZORB êm ái, phong cách vintage.', 3350000, 2568000),
(10, 1, 'img/shop/shop-10.jpg', 'Blazer Mid 7', 'Giày mid-top cổ điển, chất liệu da lộn, logo Swoosh lớn, đế cao su bám tốt.', 4160000, 1000000),
(11, 1, 'img/shop/shop-11.jpg\r\n', 'Blazer Phantom Low', 'Phiên bản Blazer thấp cổ, thiết kế đơn giản nhưng giữ phong cách vintage.', 3318556, 2456789),
(12, 1, 'img/shop/shop-12.jpg\r\n', 'Nike Dunk Low Retro SE', 'Giày bóng rổ cổ thấp, da cao cấp, phối màu độc đáo, phong cách streetwear.', 3123456, 3101242),
(13, 1, 'img/shop/shop-13.jpg\r\n', 'Nike Dunk Low Nor', 'Phiên bản thấp cổ của dòng Dunk, phù hợp với streetwear, nhiều phối màu khác nhau.', 4450000, 2890123),
(14, 2, 'img/shop/shop-14.jpg\r\n', 'Adizero EVO SL', 'Giày chạy bộ hiệu suất cao, trọng lượng nhẹ, tối ưu tốc độ với công nghệ đệm tiên tiến.', 4469000, 3345678),
(15, 2, 'img/shop/shop-15.jpg\r\n', 'Adidas Reboost 5', 'Giày chạy bộ với bộ đệm Boost, hoàn trả năng lượng, êm ái và đàn hồi.', 3268000, 2678901),
(16, 2, 'img/shop/shop-16.jpg\r\n', 'Adidas Supernova Stride', 'Thiết kế cho chạy bộ, công nghệ đệm kép hỗ trợ, lớp lưới thoáng khí.', 3140000, 3000000),
(17, 2, 'img/shop/shop-17.jpg\r\n', 'Adidas Forum Low', 'Giày bóng rổ cổ thấp, thiết kế retro, dây đai dán đặc trưng, đế cao su bền.', 3790000, 2234567),
(18, 2, 'img/shop/shop-18.jpg\r\n', 'Adidas Samba OG', 'Biểu tượng giày bóng đá đường phố, upper da, mũi suede, đế cao su gum.', 3720000, 3456789),
(19, 2, 'img/shop/shop-19.jpg\r\n', 'Adidas Superstar', 'Mang tính biểu tượng với thiết kế \'vỏ sò\' ở mũi giày, nổi bật trong hip-hop và streetwear.', 3010000, 2957654),
(20, 2, 'img/shop/shop-20.jpg\r\n', 'Adidas Superstar Classic White', 'Phiên bản Superstar cổ điển, màu trắng, logo ba sọc, đế cao su bền chắc.', 4000000, 3210987),
(21, 2, 'img/shop/shop-21.jpg\r\n', 'Adizero Ubersonic 5', 'Giày tennis hiệu suất cao, nhẹ, đế ngoài bám tốt, linh hoạt trên sân đấu.', 3120000, 2765432),
(22, 3, 'img/shop/shop-22.jpg\r\n', 'New Balance 550', 'Thiết kế retro từ thập niên 80, da và lưới thoáng khí, cổ điển nhưng hiện đại.', 3530000, 3098765),
(23, 3, 'img/shop/shop-23.jpg\r\n', 'New Balance 300', 'Giày thể thao nhẹ, phong cách tối giản, thoải mái và dễ kết hợp trang phục.', 3210000, 2345678),
(24, 3, 'img/shop/shop-24.jpg\r\n', 'New Balance CRT300', 'Biến thể của NB 300, thiết kế cổ điển, đế bền bỉ, thích hợp cho đi hằng ngày.', 4000000, 3189012),
(25, 3, 'img/shop/shop-25.jpg\r\n', 'New Balance Beige Green', 'Phối màu be xanh lá, phong cách nhẹ nhàng, dễ phối đồ, phù hợp hàng ngày.', 3190000, 2567890),
(26, 3, 'img/shop/shop-26.jpg\r\n', 'New Balance 501', 'Giày chạy bộ cổ điển, phù hợp cho hoạt động thể thao và đi lại hàng ngày.', 3, 3210456),
(27, 3, 'img/shop/shop-27.jpg\r\n', 'New Balance 300 Beige Navy', 'Mẫu NB 300 phối màu be xanh navy, phong cách vintage và trang nhã.', 3, 2876543),
(28, 3, 'img/shop/shop-28.png\r\n', 'New Balance 574 Legacy Navy', 'Giày lifestyle cổ điển, phối màu navy, đế ENCAP hỗ trợ chân tốt.', 3, 3054321),
(29, 3, 'img/shop/shop-29.jpg\r\n', 'New Balance 2002R', 'Sneaker thời thượng, thiết kế chunky, đệm êm ái, phù hợp casual và thể thao.', 3, 3123456),
(30, 3, 'img/shop/shop-30.png\r\n', 'New Balance 996R', 'Sneaker phong cách retro, bộ đệm nhẹ, thích hợp đi hàng ngày hoặc vận động nhẹ.', 3, 3140890);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `ctdh`
--
ALTER TABLE `ctdh`
  ADD KEY `fk_IDSP` (`IDSP`),
  ADD KEY `fk_IDDH` (`IDDH`);

--
-- Chỉ mục cho bảng `ctsp`
--
ALTER TABLE `ctsp`
  ADD KEY `IDSP` (`IDSP`);

--
-- Chỉ mục cho bảng `dh`
--
ALTER TABLE `dh`
  ADD PRIMARY KEY (`IDDH`),
  ADD KEY `fk_IDKH` (`IDKH`);

--
-- Chỉ mục cho bảng `kh`
--
ALTER TABLE `kh`
  ADD PRIMARY KEY (`IDKH`),
  ADD UNIQUE KEY `NAME` (`NAME`);

--
-- Chỉ mục cho bảng `loaisp`
--
ALTER TABLE `loaisp`
  ADD PRIMARY KEY (`IDLSP`);

--
-- Chỉ mục cho bảng `sp`
--
ALTER TABLE `sp`
  ADD PRIMARY KEY (`IDSP`),
  ADD KEY `fk_IDLSP` (`IDLSP`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `dh`
--
ALTER TABLE `dh`
  MODIFY `IDDH` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `ctdh`
--
ALTER TABLE `ctdh`
  ADD CONSTRAINT `fk_` FOREIGN KEY (`IDSP`) REFERENCES `sp` (`IDSP`),
  ADD CONSTRAINT `fk_IDDH` FOREIGN KEY (`IDDH`) REFERENCES `dh` (`IDDH`),
  ADD CONSTRAINT `fk_IDSP` FOREIGN KEY (`IDSP`) REFERENCES `sp` (`IDSP`);

--
-- Các ràng buộc cho bảng `ctsp`
--
ALTER TABLE `ctsp`
  ADD CONSTRAINT `ctsp_ibfk_1` FOREIGN KEY (`IDSP`) REFERENCES `sp` (`IDSP`);

--
-- Các ràng buộc cho bảng `dh`
--
ALTER TABLE `dh`
  ADD CONSTRAINT `fk_IDKH` FOREIGN KEY (`IDKH`) REFERENCES `kh` (`IDKH`);

--
-- Các ràng buộc cho bảng `sp`
--
ALTER TABLE `sp`
  ADD CONSTRAINT `fk_IDLSP` FOREIGN KEY (`IDLSP`) REFERENCES `loaisp` (`IDLSP`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
