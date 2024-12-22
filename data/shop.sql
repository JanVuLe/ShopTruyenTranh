-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 22, 2024 lúc 12:14 PM
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
(5, 7, 'An Giang', 1),
(6, 12, '123', 1),
(7, 14, 'an giang', 1),
(8, 14, 'ang giang viet nam', 1),
(9, 17, 'mỹ tho', 1),
(10, 17, 'mỹ tho', 1),
(11, 14, 'an giang', 1),
(12, 14, 'mỹ', 1),
(13, 14, 'mỹ', 1),
(14, 14, 'mỹ', 1),
(15, 15, 'an giang', 1),
(16, 15, 'asd', 1),
(17, 15, 'asd', 1);

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
  `ghichu` varchar(255) DEFAULT NULL,
  `trangthai` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `donhang`
--

INSERT INTO `donhang` (`id`, `nguoidung_id`, `diachi_id`, `ngay`, `tongtien`, `ghichu`, `trangthai`) VALUES
(7, 14, 7, '2024-12-15 08:23:05', 100000, NULL, 0),
(8, 14, 8, '2024-12-15 10:10:07', 35000, NULL, 1),
(9, 17, 9, '2024-12-15 20:58:07', 40000, NULL, 1),
(10, 17, 10, '2024-12-15 21:01:47', 70000, NULL, 0),
(11, 14, 11, '2024-12-16 07:24:28', 40000, NULL, 1),
(12, 14, 12, '2024-12-16 07:29:00', 40000, NULL, 1),
(15, 15, 15, '2024-12-20 09:29:34', 25000, NULL, 1),
(16, 15, 16, '2024-12-20 09:44:29', 35000, NULL, 0),
(17, 15, 17, '2024-12-20 09:44:38', 40000, NULL, 0);

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

--
-- Đang đổ dữ liệu cho bảng `donhangct`
--

INSERT INTO `donhangct` (`id`, `donhang_id`, `mathang_id`, `dongia`, `soluong`, `thanhtien`) VALUES
(12, 7, 9, 40000, 1, 40000),
(13, 7, 8, 35000, 1, 35000),
(14, 7, 7, 25000, 1, 25000),
(15, 8, 8, 35000, 1, 35000),
(16, 9, 9, 40000, 1, 40000),
(17, 10, 8, 35000, 2, 70000),
(18, 11, 9, 40000, 1, 40000),
(19, 12, 9, 40000, 1, 40000),
(20, 15, 15, 25000, 1, 25000),
(21, 16, 8, 35000, 1, 35000),
(22, 17, 14, 40000, 1, 40000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khuyenmai`
--

CREATE TABLE `khuyenmai` (
  `id` int(11) NOT NULL,
  `tenkhuyenmai` varchar(255) NOT NULL,
  `mota` text DEFAULT NULL,
  `ngaybatdau` date NOT NULL,
  `ngayketthuc` date NOT NULL,
  `phantramgiam` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khuyenmai`
--

INSERT INTO `khuyenmai` (`id`, `tenkhuyenmai`, `mota`, `ngaybatdau`, `ngayketthuc`, `phantramgiam`) VALUES
(1, 'Giang Sinh', 'Mã giảm giá giáng sinh', '2024-12-22', '2024-12-31', 40),
(2, 'Tet', 'Mã giảm giá Tết ', '2024-12-22', '2024-12-31', 50);

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
  `soluongton` int(11) NOT NULL DEFAULT 0,
  `hinhanh` varchar(255) DEFAULT NULL,
  `danhmuc_id` int(11) NOT NULL,
  `luotxem` int(11) NOT NULL DEFAULT 0,
  `luotmua` int(11) NOT NULL DEFAULT 0,
  `id_khuyenmai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `mathang`
--

INSERT INTO `mathang` (`id`, `tenmathang`, `tacgia`, `mota`, `giagoc`, `soluongton`, `hinhanh`, `danhmuc_id`, `luotxem`, `luotmua`, `id_khuyenmai`) VALUES
(1, 'Nhất Quỷ Nhì Ma, Thứ Ba (Vẫn Là) Takagi Tập 17', 'Soubee Amako', '<p>Ai cũng biết Takagi tinh quái rất hay trêu chọc anh chàng Nishikata, nhưng kì thực vì \"người ta để ý đến cậu nên mới thế\". Còn anh chàng này thì ngày qua ngày, lúc nào cũng tìm cách để trả đũa, cho cô nàng \"biết tay\", nhưng bao giờ cũng là người thua cuộc...! Thời còn đi học là thế. Liệu đến bao giờ chàng trai kia mới lớn và nhận ra tình cảm của cô bạn cùng lớp nhỉ...?</p>', 20000, 100, 'images/products/nhatban/takagi_17.jpg', 2, 1, 0, NULL),
(2, 'Nàng Juliet Ở Trường Nội Trú Tập 10', 'Yousuke Kaneda', '<p>Hòa cùng không khí đón chào năm học mới ở Học viện Dahlia, cuộc tuyển cử hội học sinh cũng vô cùng căng thẳng. Inuzuka Romio và Juliet Persia cũng cố gắng bước chân vào hội học sinh nhằm thay đổi luật lệ của học viện, song có vô vàn thử thách họ cần phải vượt qua!</p>', 25000, 100, 'images/products/nhatban/nang_juliet_o_truong_noi_tru_bia_tap_10.jpg', 2, 3, 0, NULL),
(3, 'Shadows House Tập 9', 'Soichiro Yamamoto', '<p>Qua lần tổ chức “thị sát”, người lớn đã gài được tai mắt của mình vào tòa nhà trẻ con. Một “buổi họp lớp đêm khuya” được lên kế hoạch tổ chức, luồn lách khỏi sự giám sát của người lớn. Giữa đêm khuya vắng lặng, họ cùng nhau trao đổi những kế sách…</p>', 25000, 100, 'images/products/nhatban/shadows_house_bia_tap_9.jpg', 2, 0, 0, NULL),
(4, 'Ninja Rantaro Tập 42', 'So-Ma-To', '<p>“Chào các cháu độc giả yêu quý! Nhắc đến mùa hè là nói đến biển, mà nói đến biển là phải nhắc đến thủy quân! Cho nên vừa rồi bác đã tới thăm nơi nghề săn bắt cá voi kiểu cổ ra đời. Bác đã đến viện bảo tàng cá voi của quận Taiji thuộc tỉnh Wakayama. Dưới sự phối hợp nhịp nhàng của nhóm săn cá, tàu Seko sẵn sàng đương đầu với những chú cá voi khổng lồ. Tàu có mũi nhọn, lướt sóng băng băng và nó trông giống hệt với tàu nhỏ chạy nhanh mà thủy quân thường dùng. Dù đối phương là tàu địch hay cá voi thì chúng vẫn là tàu chiến. Và một lần nữa bác lại được cảm nhận sự khắc nghiệt của những trận chiến trên biển.”</p>', 30000, 10, 'images/products/nhatban/ninja_rantato_bia_tap_42.jpg', 2, 0, 0, NULL),
(5, 'Đoàn binh Tây Tiến', 'Quang Dũng', '<p>Có một “Tây Tiến” trong thơ và cũng có một “Tây Tiến” trong văn. Đó chính là những gì chứa đựng trong cuốn sách này! Cảm xúc về một thời “Chiến trường đi chẳng tiếc đời xanh” của nhà thơ Quang Dũng trong bài thơ Tây Tiến dường như chưa đủ với ông. Tấm lòng thiết tha của tác giả những ngày hào hùng ấy đã dẫn đến thiên hồi ký “Đoàn Võ trang Tuyên truyền Biên khu Lào - Việt” (Đoàn binh Tây Tiến) ông viết mấy năm sau. Hơn là một phiên bản văn xuôi của bài thơ, tập hồi ký cho chúng ta biết thêm nhiều điều cụ thể về hoạt động của binh đoàn khi ấy, cũng như về các chiến sĩ Việt - Lào, những người cầm súng và cả những người cầm kèn trong Đoàn Võ trang Tuyên truyền cùng tham gia vào sứ mạng giải phóng đất nước mình và nước bạn khỏi ách thực dân xâm lược…</p>', 30000, 10, 'images/products/vietnam/doan-binh-tay-tien.jpg', 1, 1, 0, 1),
(6, 'Một xu một ngày', 'Walter de la Mare', '<p>Với giọng văn kể khi êm đềm khi thôi thúc và vô cùng lôi cuốn, Walter de la Mare đã đưa người đọc lạc vào những cảnh tượng lạ thường, gặp gỡ những phù thủy và nàng tiên, những thần lùn và người khổng lồ… thân thiện hay hung ác. Có những truyện thật ngọt ngào thơ mộng nhưng có những truyện đẫm màu huyền hoặc, người đọc có lúc hầu như nín thở vì một chi tiết hồi hộp, rồi sau đó lại thở ra khoan khoái. Tập truyện đã nhận được giải thưởng Carnegie Medal năm 1948, giải thưởng văn học danh giá của Anh Quốc dành cho tác phẩm viết cho thiếu nhi và thiếu niên hay nhất.</p>', 90000, 10, 'images/products/phuongtay/mot-xu-mot-ngay.jpg', 5, 2, 0, 1),
(7, 'Văn học tuổi hoa', 'Nguyễn Thị Ngọc Tú', '<p>Mùa nghỉ hè năm ấy, cậu bé Tuấn về quê hương, cái làng muối yên bình ven biển. Cậu bé làm quen bạn mới, giúp đỡ xóm làng… Câu chuyện tái hiện vẻ đẹp và thú vui tuổi thơ miền duyên hải Bắc Bộ, đời sống sôi nổi của diêm dân thời kì dốc sức vì sự nghiệp xây dựng và bảo vệ Tổ quốc, cũng như truyền thống cách mạng bất khuất của họ.</p>', 35000, 9, 'images/products/vietnam/van-hoc-tuoi-hoa_canh-dong-bo-bien.jpg', 1, 1, 0, NULL),
(8, 'Hành tinh kì lạ', 'Viết Linh', '<p>Một người cha đi tìm con và lạc đến xứ sở người máy ở một hành tinh xa lạ. Ông đã chứng kiến cuộc sống sinh hoạt của thế giới người máy khác xa với tưởng tượng của con người. Ở đấy, ông gặp bao điều kì lạ và cả những nguy hiểm, rủi ro. Liệu ông có bảo toàn được tính mạng, trở về Trái Đất và tìm được người con thân yêu của mình?</p>', 50000, 15, 'images/products/vietnam/hanh-tinh-ki-la_bia_tb.jpg', 1, 5, 0, NULL),
(9, 'Siêu nhân cua', 'Võ Diệu Thanh', '<p>Chắc rằng bạn đã hơn một lần mê mẩn những bộ phim, quyển sách về siêu nhân và nguệch ngoạc vẽ ra theo tưởng tượng của mình. Bạn cũng từng bắt chước y chang hình mẫu trong sách giáo khoa khi làm bài tập vẽ. Thế rồi một cô giáo dạy mĩ thuật cá tính xuất hiện, làm đảo lộn mọi thứ bạn vẫn hình dung trước đây. Cô hướng dẫn bạn những tuyệt chiêu để trở thành họa sĩ nhí đặc biệt. Cô đưa bạn đến một vùng đất hoàn toàn mới, ở đó, mọi sự sáng tạo dù có kì khôi thế nào vẫn được hào hứng đón nhận. Ở đó, có một Siêu nhân Cua thật lạ lùng, một hình tượng độc đáo mà bạn chỉ có thể tìm thấy trong cuốn sách này.</p>', 60000, 96, 'images/products/vietnam/sieu-nhan-cua_bia.jpg', 1, 1, 0, NULL),
(10, 'Tủ sách tuổi thần tiên - Tiên Út và Phù thủy Nhí', 'Nguyên Hương', '<p>Các tiên nhỏ phải học tập rất gắt mới có được quyền phép. Phù thủy Nhí sinh ra đã có sẵn áo choàng phép thuật. Tiên nhỏ phải cẩn trọng khi sử dụng phép thuật giúp người, phù thủy lại dùng phép thuật hại người mà không hề đắn đo. Chuyện gì xảy ra khi bộ tứ Tài Lanh, Cà Kheo, Láu Táu và Leng Keng có được áo choàng phép thuật của phù thủy Nhí? Phù thủy Nhí bị biến hình, tình bạn có giải cứu được cậu?</p>', 45000, 4, 'images/products/vietnam/tu-sach-tuoi-than-tien_son-ca-trong-chiec-long-bac.jpg', 1, 40, 0, NULL),
(13, 'Quán trọ Ancuta', 'Mihail Sadoveanu', '<p>Những cuộc đời, số phận, cảnh ngộ có thật được các lữ khách kể lại trong Quán trọ Ancuţa giúp người đọc mường tượng ra những khoảng khắc lịch sử của đất nước Rumani. Dữ dội, khốc liệt, nghĩa trượng, trung thành... tính cách các nhân vật riêng biệt nhưng vẫn tạo nên một nét chung nhân văn.</p>', 50000, 10, 'images/products/phuongtay/tac-pham-chon-loc_van-hoc-rumani_quan-tro-ancuta.jpg', 5, 4, 0, 1),
(14, 'Hoa Vô Lệ', ' Suly', 'Truyện ngôn tình', 50000, 9, 'images/products/trungquoc/500-500_37174df6-d1be-44b9-80e8.jpg', 3, 0, 0, NULL),
(15, 'Hôm Nay Lại Là Một Ngày Không Muốn Đi Làm', 'Tiểu Lam', 'Hôm nay lại là một ngày không muốn đi làm – Cuốn truyện tranh dành riêng cho dân đi làm.', 30000, 9, 'images/products/trungquoc/hom-nay-lai-la.jpg', 3, 0, 0, NULL),
(16, 'Lang Gia Bảng Tập', 'Hải Yến', 'Vốn là thiếu soái quân Xích Diễm năm xưa, Lâm Thù - nay là Mai Trường Tô bỗng nhiên trở thành tâm điểm chú ý. Tất cả mọi người truyền tai nhau rằng ai có được Mai Trường Tô - người đứng đầu trong bảng xếp hạng Lang Gia sẽ có được thiên hạ. Do vậy, các phe phái quyền lực trong triều đều muốn lôi kéo nhân vật bí ẩn này về bên mình. Trước muôn vàn sự lựa chọn, rốt cục Mai Trường Tô sẽ chọn ai để phò tá? Đồng thời, bản án oan 12 năm về trước của bảy vạn quân Xích Diễm liệu có được y lật lại thành công?', 50000, 10, 'images/products/trungquoc/bia_ao_lang_gia_bang.jpg', 3, 0, 0, NULL),
(17, 'Anh Trai Tôi Là Đồ Ngốc Tập 2', 'Cát Xuyên Lưu', 'Tập 2 “Anh trai tôi là đồ ngốc” là phần tiếp nối những câu chuyện ấm áp, cảm động và hài hước của hai anh em có khoảng cách cả về tuổi tác lẫn chiều cao. Một cô em gái dễ thương và có phần “độc đoán”, trong khi người anh trai tuy thích bắt nạt em gái nhưng thực chất lại là một người anh tốt, yêu thương em gái. Tập truyện miêu tả một cách tinh tế những điều nhỏ nhặt bình thường trong cuộc sống của hai nhân vật chính với tính cách khác biệt, đồng thời cũng thể hiện tình bạn thời thơ ấu của hai anh em với những người bạn… Từ đây các câu chuyện hàng ngày thú vị và vui nhộn không kém phần ấm áp, nước mắt nhất định không thể bỏ qua…', 30000, 5, 'images/products/trungquoc/bia_anh_trai_toi_la_do_ngoc_2.jpg', 3, 0, 0, NULL),
(18, 'Thám tử lừng danh Conan - Tập 104', 'Gosho Aoyama', 'Cái chết bí ẩn của kì thủ thiên tài “Koji Haneda”. Sự thật đằng sau vụ án ngủ quên. Sau 17 năm, giờ đây, tất cả sẽ bừng tỉnh...', 25000, 10, 'images/products/nhatban/104_e62ae2d405c9475f8742d2a760a8b79d_large.jpg', 2, 2, 0, NULL),
(19, 'Tranh truyện dân gian Việt Nam - Tấm Cám', 'Mai Long, Hồng Hà', 'Những câu chuyện dân gian nuôi dưỡng tâm hồn các em, giúp các em biết học điều hay lẽ phải, yêu cái thiện, ghét cái xấu và trân trọng truyền thống cha ông. Bộ sách Tranh truyện dân gian Việt Nam là món quà ý nghĩa với những câu chuyện được tuyển chọn và biên soạn kĩ lưỡng. Phần tranh vẽ minh họa sinh động, gần gũi giúp các em dễ dàng hơn trong việc tiếp cận và ghi nhớ câu chuyện.', 20000, 10, 'images/products/vietnam/tam-cam.jpg', 1, 0, 0, 2);

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
(1, 'abc@abc.com', '0987612345', '202cb962ac59075b964b07152d234b70', 'Lê Văn Vũ', 1, 1, 'LeVanVu.jpg'),
(2, 'def@abc.com', '11111111', 'e10adc3949ba59abbe56e057f20f883e', 'Mèo máy Doraemon', 2, 1, 'avatar.jpg'),
(3, 'ghi@abc.com', '0988994685', '900150983cd24fb0d6963f7d28e17f72', 'Nhân viên GHI', 2, 1, NULL),
(7, 'khachhang1@gmail.com', '0123456789', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn Văn Minh', 3, 1, NULL),
(8, 'tva123456@gmail.com', '8877666569', 'f9a38ff5304fe81f652ab83e17b795fc', 'dsdsds', 3, 1, NULL),
(9, 'abc9999@abc.com', '9998878899', 'e10adc3949ba59abbe56e057f20f883e', 'fdfdfdfd', 2, 1, NULL),
(10, 'abc88888888@abc.com', '889898999', 'e10adc3949ba59abbe56e057f20f883e', 'ggggg', 3, 1, NULL),
(11, 'nhanvien@gmail.com', '1231231230', '202cb962ac59075b964b07152d234b70', 'Ai đó vipro', 2, 1, NULL),
(12, 'abcabc@abc.com', '1231231231', '202cb962ac59075b964b07152d234b70', 'khong ten', 3, 1, NULL),
(13, 'abc123@abc.com', '0987654321', '202cb962ac59075b964b07152d234b70', 'testtest', 2, 1, NULL),
(14, 'khachhang2@gmail.com', '0987654322', 'e10adc3949ba59abbe56e057f20f883e', 'khách hàng', 3, 1, NULL),
(15, 'khachhang3@gmail.com', '1234567890', '202cb962ac59075b964b07152d234b70', 'Khánh Hàng 3', 3, 1, NULL),
(17, 'khachhang4@gmail.com', '1234567890', '202cb962ac59075b964b07152d234b70', 'Khánh Hàng 4', 3, 1, NULL),
(18, 'khachhang5@gmail.com', '1234567890', '202cb962ac59075b964b07152d234b70', 'Khánh Hàng 5', 3, 1, NULL);

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
-- Chỉ mục cho bảng `khuyenmai`
--
ALTER TABLE `khuyenmai`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `mathang`
--
ALTER TABLE `mathang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `danhmuc_id` (`danhmuc_id`),
  ADD KEY `fk_mathang_khuyenmai` (`id_khuyenmai`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `donhang`
--
ALTER TABLE `donhang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `donhangct`
--
ALTER TABLE `donhangct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `khuyenmai`
--
ALTER TABLE `khuyenmai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `mathang`
--
ALTER TABLE `mathang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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
  ADD CONSTRAINT `fk_mathang_khuyenmai` FOREIGN KEY (`id_khuyenmai`) REFERENCES `khuyenmai` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `mathang_ibfk_1` FOREIGN KEY (`danhmuc_id`) REFERENCES `danhmuc` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
