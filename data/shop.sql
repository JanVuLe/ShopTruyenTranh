-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 13, 2024 lúc 05:53 AM
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
-- Cơ sở dữ liệu: `shop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhmuc`
--

CREATE TABLE `danhmuc` (
  `id` int(11) NOT NULL,
  `tendanhmuc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `danhmuc`
--

INSERT INTO `danhmuc` (`id`, `tendanhmuc`) VALUES
(1, 'Việt Nam'),
(2, 'Nhật Bản'),
(3, 'Trung Quốc'),
(4, 'Hàn Quốc'),
(5, 'Phương Tây');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `diachi`
--

CREATE TABLE `diachi` (
  `id` int(11) NOT NULL,
  `nguoidung_id` int(11) NOT NULL,
  `diachi` varchar(255) NOT NULL,
  `macdinh` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `diachi`
--

INSERT INTO `diachi` (`id`, `nguoidung_id`, `diachi`, `macdinh`) VALUES
(1, 7, 'lx ag', 1),
(2, 7, 'lx ag', 1),
(3, 8, 'gfgfgf', 1),
(4, 10, 'bbbnb', 1),
(5, 7, 'An Giang', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

CREATE TABLE `donhang` (
  `id` int(11) NOT NULL,
  `nguoidung_id` int(11) NOT NULL,
  `diachi_id` int(11) DEFAULT NULL,
  `ngay` datetime NOT NULL DEFAULT current_timestamp(),
  `tongtien` float NOT NULL DEFAULT 0,
  `ghichu` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhangct`
--

CREATE TABLE `donhangct` (
  `id` int(11) NOT NULL,
  `donhang_id` int(11) NOT NULL,
  `mathang_id` int(11) NOT NULL,
  `dongia` float NOT NULL DEFAULT 0,
  `soluong` int(11) NOT NULL DEFAULT 1,
  `thanhtien` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mathang`
--

CREATE TABLE `mathang` (
  `id` int(11) NOT NULL,
  `tenmathang` varchar(255) NOT NULL,
  `tacgia` varchar(50) DEFAULT NULL,
  `mota` text DEFAULT NULL,
  `giagoc` float NOT NULL DEFAULT 0,
  `giaban` float NOT NULL DEFAULT 0,
  `soluongton` int(11) NOT NULL DEFAULT 0,
  `hinhanh` varchar(255) DEFAULT NULL,
  `danhmuc_id` int(11) NOT NULL,
  `luotxem` int(11) NOT NULL DEFAULT 0,
  `luotmua` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `mathang`
--

INSERT INTO `mathang` (`id`, `tenmathang`, `tacgia`, `mota`, `giagoc`, `giaban`, `soluongton`, `hinhanh`, `danhmuc_id`, `luotxem`, `luotmua`) VALUES
(1, 'Nhất Quỷ Nhì Ma, Thứ Ba (Vẫn Là) Takagi Tập 17', 'Soubee Amako', '<p>Ai cũng biết Takagi tinh quái rất hay trêu chọc anh chàng Nishikata, nhưng kì thực vì \"người ta để ý đến cậu nên mới thế\". Còn anh chàng này thì ngày qua ngày, lúc nào cũng tìm cách để trả đũa, cho cô nàng \"biết tay\", nhưng bao giờ cũng là người thua cuộc...! Thời còn đi học là thế. Liệu đến bao giờ chàng trai kia mới lớn và nhận ra tình cảm của cô bạn cùng lớp nhỉ...?</p>', 20000, 30000, 100, 'images/takagi_17.jpg', 2, 0, 0),
(2, 'Nàng Juliet Ở Trường Nội Trú Tập 10', 'Yousuke Kaneda', '<p>Hòa cùng không khí đón chào năm học mới ở Học viện Dahlia, cuộc tuyển cử hội học sinh cũng vô cùng căng thẳng. Inuzuka Romio và Juliet Persia cũng cố gắng bước chân vào hội học sinh nhằm thay đổi luật lệ của học viện, song có vô vàn thử thách họ cần phải vượt qua!</p>', 25000, 35000, 100, 'images/nang_juliet_o_truong_noi_tru_bia_tap_10.jpg', 2, 0, 0),
(3, 'Shadows House Tập 9', 'Soichiro Yamamoto', '<p>Qua lần tổ chức “thị sát”, người lớn đã gài được tai mắt của mình vào tòa nhà trẻ con. Một “buổi họp lớp đêm khuya” được lên kế hoạch tổ chức, luồn lách khỏi sự giám sát của người lớn. Giữa đêm khuya vắng lặng, họ cùng nhau trao đổi những kế sách…</p>', 25000, 45000, 100, 'images/shadows_house_bia_tap_9.jpg', 2, 0, 0),
(4, 'Ninja Rantaro Tập 42', 'So-Ma-To', '<p>“Chào các cháu độc giả yêu quý! Nhắc đến mùa hè là nói đến biển, mà nói đến biển là phải nhắc đến thủy quân! Cho nên vừa rồi bác đã tới thăm nơi nghề săn bắt cá voi kiểu cổ ra đời. Bác đã đến viện bảo tàng cá voi của quận Taiji thuộc tỉnh Wakayama. Dưới sự phối hợp nhịp nhàng của nhóm săn cá, tàu Seko sẵn sàng đương đầu với những chú cá voi khổng lồ. Tàu có mũi nhọn, lướt sóng băng băng và nó trông giống hệt với tàu nhỏ chạy nhanh mà thủy quân thường dùng. Dù đối phương là tàu địch hay cá voi thì chúng vẫn là tàu chiến. Và một lần nữa bác lại được cảm nhận sự khắc nghiệt của những trận chiến trên biển.”</p>', 30000, 38000, 10, 'images/ninja_rantato_bia_tap_42.jpg', 2, 0, 0),
(5, 'Đoàn binh Tây Tiến', 'Quang Dũng', '<p>Có một “Tây Tiến” trong thơ và cũng có một “Tây Tiến” trong văn. Đó chính là những gì chứa đựng trong cuốn sách này! Cảm xúc về một thời “Chiến trường đi chẳng tiếc đời xanh” của nhà thơ Quang Dũng trong bài thơ Tây Tiến dường như chưa đủ với ông. Tấm lòng thiết tha của tác giả những ngày hào hùng ấy đã dẫn đến thiên hồi ký “Đoàn Võ trang Tuyên truyền Biên khu Lào - Việt” (Đoàn binh Tây Tiến) ông viết mấy năm sau. Hơn là một phiên bản văn xuôi của bài thơ, tập hồi ký cho chúng ta biết thêm nhiều điều cụ thể về hoạt động của binh đoàn khi ấy, cũng như về các chiến sĩ Việt - Lào, những người cầm súng và cả những người cầm kèn trong Đoàn Võ trang Tuyên truyền cùng tham gia vào sứ mạng giải phóng đất nước mình và nước bạn khỏi ách thực dân xâm lược…</p>', 30000, 40000, 10, 'images/doan-binh-tay-tien.jpg', 1, 0, 0),
(6, 'Một xu một ngày', 'Walter de la Mare', '<p>Với giọng văn kể khi êm đềm khi thôi thúc và vô cùng lôi cuốn, Walter de la Mare đã đưa người đọc lạc vào những cảnh tượng lạ thường, gặp gỡ những phù thủy và nàng tiên, những thần lùn và người khổng lồ… thân thiện hay hung ác. Có những truyện thật ngọt ngào thơ mộng nhưng có những truyện đẫm màu huyền hoặc, người đọc có lúc hầu như nín thở vì một chi tiết hồi hộp, rồi sau đó lại thở ra khoan khoái. Tập truyện đã nhận được giải thưởng Carnegie Medal năm 1948, giải thưởng văn học danh giá của Anh Quốc dành cho tác phẩm viết cho thiếu nhi và thiếu niên hay nhất.</p>', 90000, 100000, 10, 'images/products/mot-xu-mot-ngay.jpg', 5, 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nguoidung`
--

CREATE TABLE `nguoidung` (
  `id` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `sodienthoai` varchar(10) NOT NULL,
  `matkhau` varchar(255) NOT NULL,
  `hoten` varchar(255) NOT NULL,
  `loai` tinyint(4) NOT NULL DEFAULT 3,
  `trangthai` tinyint(4) NOT NULL DEFAULT 1,
  `hinhanh` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nguoidung`
--

INSERT INTO `nguoidung` (`id`, `email`, `sodienthoai`, `matkhau`, `hoten`, `loai`, `trangthai`, `hinhanh`) VALUES
(1, 'abc@abc.com', '0987612345', 'e10adc3949ba59abbe56e057f20f883e', 'Lê Văn Vũ', 1, 1, 'LeVanVu.jpg'),
(2, 'def@abc.com', '11111111', 'e10adc3949ba59abbe56e057f20f883e', 'Mèo máy Doraemon', 2, 1, 'avatar.jpg'),
(3, 'ghi@abc.com', '0988994685', '900150983cd24fb0d6963f7d28e17f72', 'Nhân viên GHI', 2, 1, NULL),
(7, 'khachhang1@gmail.com', '0123456789', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn Văn Minh', 3, 1, NULL),
(8, 'tva123456@gmail.com', '8877666569', 'f9a38ff5304fe81f652ab83e17b795fc', 'dsdsds', 3, 1, NULL),
(9, 'abc9999@abc.com', '9998878899', 'e10adc3949ba59abbe56e057f20f883e', 'fdfdfdfd', 2, 1, NULL),
(10, 'abc88888888@abc.com', '889898999', 'e10adc3949ba59abbe56e057f20f883e', 'ggggg', 3, 1, NULL),
(11, 'nhanvien@gmail.com', '1231231230', '202cb962ac59075b964b07152d234b70', 'Ai đó vipro', 2, 1, NULL),
(12, 'abcabc@abc.com', '1231231231', '202cb962ac59075b964b07152d234b70', 'khong ten', 3, 1, NULL),
(13, 'abc123@abc.com', '0987654321', '202cb962ac59075b964b07152d234b70', 'testtest', 2, 1, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `diachi`
--
ALTER TABLE `diachi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nguoidung_id` (`nguoidung_id`);

--
-- Chỉ mục cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nguoidung_id` (`nguoidung_id`),
  ADD KEY `diachi_id` (`diachi_id`);

--
-- Chỉ mục cho bảng `donhangct`
--
ALTER TABLE `donhangct`
  ADD PRIMARY KEY (`id`),
  ADD KEY `donhang_id` (`donhang_id`),
  ADD KEY `mathang_id` (`mathang_id`);

--
-- Chỉ mục cho bảng `mathang`
--
ALTER TABLE `mathang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `danhmuc_id` (`danhmuc_id`);

--
-- Chỉ mục cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `diachi`
--
ALTER TABLE `diachi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `donhang`
--
ALTER TABLE `donhang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `donhangct`
--
ALTER TABLE `donhangct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `mathang`
--
ALTER TABLE `mathang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `diachi`
--
ALTER TABLE `diachi`
  ADD CONSTRAINT `diachi_ibfk_1` FOREIGN KEY (`nguoidung_id`) REFERENCES `nguoidung` (`id`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `donhang_ibfk_1` FOREIGN KEY (`nguoidung_id`) REFERENCES `nguoidung` (`id`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `donhangct`
--
ALTER TABLE `donhangct`
  ADD CONSTRAINT `donhangct_ibfk_1` FOREIGN KEY (`donhang_id`) REFERENCES `donhang` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `donhangct_ibfk_2` FOREIGN KEY (`mathang_id`) REFERENCES `mathang` (`id`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `mathang`
--
ALTER TABLE `mathang`
  ADD CONSTRAINT `mathang_ibfk_1` FOREIGN KEY (`danhmuc_id`) REFERENCES `danhmuc` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
