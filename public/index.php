<?php
session_start();
require("../model/database.php");
require("../model/danhmuc.php");
require("../model/mathang.php");
require("../model/giohang.php");
require("../model/khachhang.php");
require("../model/diachi.php");
require("../model/donhang.php");
require("../model/donhangct.php");
require("../model/nguoidung.php");

$dm = new DANHMUC();
$danhmuc = $dm->laydanhmuc();
$mh = new MATHANG();
$mathangxemnhieu = $mh->laymathangxemnhieu();
$dh = new DONHANG();
$dhct = new DONHANGCT();
$donhangct = $dhct->layctdonhang();
$nd = new NGUOIDUNG();
if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
} else {
    $action = "null";
}


switch ($action) {
    case "null":
        $mathang = $mh->laymathang();
        include("main.php");
        break;
    case "gioithieu":
        include("gioithieu.php");
        break;
    case "group":
        if (isset($_REQUEST["id"])) {
            $madm = $_REQUEST["id"];
            $dmuc = $dm->laydanhmuctheoid($madm);
            $tendm =  $dmuc["tendanhmuc"];
            $mathang = $mh->laymathangtheodanhmuc($madm);
            include("group.php");
        } else {
            include("main.php");
        }
        break;
    case "detail":
        if (isset($_GET["id"])) {
            $mahang = $_GET["id"];
            // tăng lượt xem lên 1
            $mh->tangluotxem($mahang);
            // lấy thông tin chi tiết mặt hàng
            $mhct = $mh->laymathangtheoid($mahang);
            // lấy các mặt hàng cùng danh mục
            $madm = $mhct["danhmuc_id"];
            $mathang = $mh->laymathangtheodanhmuc($madm);
            include("detail.php");
        }
        break;
    case "chovaogio":
        if (isset($_REQUEST["id"]))
            $id = $_REQUEST["id"];
        if (isset($_REQUEST["soluong"]))
            $soluong = $_REQUEST["soluong"];
        else
            $soluong = 1;

        if (isset($_SESSION['giohang'][$id])) { // nếu đã có trong giỏ thi tăng số lượng
            $soluong += $_SESSION['giohang'][$id];
            $_SESSION['giohang'][$id] = $soluong;
        } else {       // nếu chưa thì thêm vào giỏ
            themhangvaogio($id, $soluong);
        }

        //themhangvaogio($_REQUEST["id"], $soluong);

        $giohang = laygiohang();
        include("cart.php");
        break;
    case "giohang":
        $giohang = laygiohang();
        include("cart.php");
        break;
    case "capnhatgio":
        if (isset($_REQUEST["mh"])) {
            $mh = $_REQUEST["mh"];
            foreach ($mh as $id => $soluong) {

                $soluongton = laysoluongton($id);
                if ($soluongton == 0) {
                    $tb = "Mặt hàng $id đã hết hàng!";
                    continue;
                }
                if ($soluong > 0) {
                    capnhatsoluong($id, $soluong);
                } else
                    xoamotmathang($id);
            }
        }
        $giohang = laygiohang();
        include("cart.php");
        break;
    case "xoagiohang":
        xoagiohang();
        $giohang = laygiohang();
        include("cart.php");
        break;
    case "thanhtoan":
        $giohang = laygiohang();

        include("checkout.php");
        break;
    case "luudonhang":

        $diachi = $_POST["txtdiachi"];
        if (!isset($_SESSION["khachhang"])) {
            $email = $_POST["txtemail"];
            $hoten = $_POST["txthoten"];
            $sodienthoai = $_POST["txtsodienthoai"];

            // lưu thông tin khách nếu chưa có trong db (kiểm tra email có tồn tại chưa)
            // xử lý thêm...
            $kh = new KHACHHANG();
            $khachhang_id = $kh->themkhachhang($email, $sodienthoai, $hoten);
        } else {
            $khachhang_id = $_SESSION["khachhang"]["id"];

            //$dc = new DIACHI();
            //$diachi = $dc->laydiachikhachhang($khachhang_id);            
            //$diachi_id = $diachi["id"];
        }
        // lưu địa chỉ giao hàng // cần xử lý địa chỉ cho 2 trường hợp if... else bên trên
        $dc = new DIACHI();
        $diachi_id = $dc->themdiachi($khachhang_id, $diachi);

        // lưu đơn hàng
        $dh = new DONHANG();
        $tongtien = tinhtiengiohang();
        $donhang_id = $dh->themdonhang($khachhang_id, $diachi_id, $tongtien);

        // lưu chi tiết đơn hàng
        $ct = new DONHANGCT();
        $giohang = laygiohang();
        foreach ($giohang as $id => $mh) {
            $dongia = $mh["giaban"];
            $soluong = $mh["soluong"];
            $thanhtien = $mh["thanhtien"];
            $ct->themchitietdonhang($donhang_id, $id, $dongia, $soluong, $thanhtien);
            $mh = new MATHANG();
            $mh->capnhatsoluong($id, $soluong);
        }
        // xóa giỏ hàng
        xoagiohang();
        // chuyển đến trang cảm ơn
        include("message.php");
        break;
    case "dangnhap":
        include("loginform.php");
        break;
    case "dangky":
        include("regis.php");
        break;
    case "xldangky":
        $hoten = $_POST["txthoten"];
        $email = $_POST["txtemail"];
        $sodt = $_POST["txtsdt"];
        $matkhau = $_POST["txtmatkhau"];
        $re_matkhau = $_POST["txtre_matkhau"];

        if ($matkhau !== $re_matkhau) {
            $tb = "Mật khẩu không khớp. Vui lòng nhập lại.";
            include("regis.php");
            break;
        }

        $nd->sethoten($hoten);
        $nd->setemail($email);
        $nd->setsodienthoai($sodt);
        $nd->setmatkhau($matkhau);
        $nd->setloai(3);
        if ($nd->laythongtinnguoidung($email)) {   // có thể kiểm tra thêm số đt không trùng
            $tb = "Email này đã được cấp tài khoản!";
            include("regis.php");
        } else {
            if (!$nd->themnguoidung($nd)) {
                $tb = "Không thêm được!";
                include("regis.php");
            } else {
                $kh = new KHACHHANG();
                if ($kh->kiemtrakhachhanghople($email, $matkhau) == TRUE) {
                    $_SESSION['khachhang'] = $kh->laythongtinkhachhang($email);
                    include('info.php');
                } else {
                    $tb = "Đăng ký không thành công!";
                    include("regis.php");
                }
            }
        }
        break;
    case "xldangnhap":
        $email = $_POST["txtemail"];
        $matkhau = $_POST["txtmatkhau"];
        $kh = new KHACHHANG();
        $khachhang = $kh->laythongtinkhachhang($email);
        if (!$khachhang) {
            $tb = "Email này chưa được đăng ký!";
            include("loginform.php");
        } else {
            if ($kh->kiemtrakhachhanghople($email, $matkhau) == TRUE) {
                $_SESSION["khachhang"] = $khachhang; // $kh->laythongtinkhachhang($email);
                // đọc thông tin (đơn hàng) của kh
                include("info.php");
            } else {
                $tb = "Mật khẩu không đúng!";
                include("loginform.php");
            }
        }
        break;
    case "thongtin":
        // đọc thông tin các đơn của khách
        if (isset($_GET["mand"])) {
            // Lấy đơn hàng theo id người dùng
            $donhang = $_GET["mand"];
            $danhsachdh = $dh->laydonhangtheoidnguoidung($donhang);
            if (!$danhsachdh) {
                echo "Không có đơn hàng cho người dùng này.";
                exit;
            }

            // Lấy chi tiết đơn hàng
            $chiTietDonHang = [];
            foreach ($danhsachdh as $donhang) {
                $chiTietDonHang[$donhang['id']] = $dhct->layctdonhangtheodonhang($donhang['id']);
            }

            include("info.php");
        }
        break;
    case "dangxuat":
        unset($_SESSION["khachhang"]);
        // chuyển về trang chủ
        /*        // xử lý phân trang
        $tongmh = $mh->demtongsomathang();   // tổng số mặt hàng
        $soluong = 4;                           // số lượng mh hiển thị trên trang 
        $tongsotrang = ceil($tongmh/$soluong);  // tổng số trang
        if(!isset($_REQUEST["trang"]))          // trang hiện hành: mặc định là trang đầu
            $tranghh = 1;   
        else                                    // hoặc hiển thị trang do người dùng chọn
            $tranghh = $_REQUEST["trang"];
        if($tranghh > $tongsotrang)
            $tranghh = $tongsotrang;
        else if($tranghh < 1)
            $tranghh = 1;
        $batdau = ($tranghh-1)*$soluong;          // mặt hàng bắt đầu sẽ lấy
        $mathang = $mh->laymathangphantrang($batdau, $soluong);
        */
        $mathang = $mh->laymathang();
        include("main.php");
        break;
    case "timkiem":
        $tensp = isset($_GET["tensp"]) ? $_GET["tensp"] : '';
        $mathang = $mh->timkiemtheoten($tensp);
        include("main.php");
        break;
    default:
        break;
}
