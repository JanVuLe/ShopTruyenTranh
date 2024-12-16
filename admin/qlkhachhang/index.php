<?php
session_start();
if (!isset($_SESSION["nguoidung"]))
    header("location:../index.php");

require("../../model/database.php");
require("../../model/nguoidung.php");
require("../../model/khachhang.php");


if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
} else {
    $action = "macdinh";
}

$kh = new KHACHHANG();
$nguoidung = new NGUOIDUNG();

switch ($action) {
    case "macdinh":
        $khachhang = $kh->laykhachhang();
        // sắp xếp
        if ($khachhang === null) {
            $tb = "Không có dữ liệu khách hàng.";
        } else {
            if (isset($_GET["sort"])) {
                $sort = $_GET["sort"];
                switch ($sort) {
                    case 'email':
                        usort($khachhang, function ($a, $b) {
                            return strcmp($a["email"], $b["email"]);
                        });
                        break;
                    case 'sodienthoai':
                        usort($khachhang, function ($a, $b) {
                            return strcmp($b["sodienthoai"], $a["sodienthoai"]);
                        });
                        break;
                    case 'hoten':
                        usort($khachhang, function ($a, $b) {
                            return strcmp($b["hoten"], $a["hoten"]);
                        });
                        break;
                    default:
                        ksort($khachhang);
                        break;
                }
            }
        }
        include("main.php");
        break;
    case "them":
        include("addform.php");
        break;
    case "xoa":
        $mand = $_GET["mand"];
        if ($kh->xoakhachhang($mand)) {
            $tb = "Khách hàng đã được xóa!";
        } else {
            $tb = "Không thể xóa khách hàng!";
        }
        $khachhang = $kh->laykhachhang();
        include("main.php");
        break;
    case "khoa":
        $mand = $_GET["mand"];
        $trangthai = $_GET["trangthai"];
        if (!$kh->doitrangthai($mand, $trangthai)) {
            $tb = "Đã đổi trạng thái!";
        }
        $khachhang = $kh->laykhachhang();
        include("main.php");
        break;
    case "xlthem":
        $email = $_POST["txtemail"];
        $sodt = $_POST["txtdienthoai"];
        $hoten = $_POST["txthoten"];

        $khachhang = $kh->themkhachhang($email, $sodt, $hoten);

        if ($kh->laythongtinkhachhang($email)) {   // có thể kiểm tra thêm số đt không trùng
            $tb = "Email này đã được cấp tài khoản!";
        } else {
            if (!$kh->themkhachhang($email, $sodt, $hoten)) {
                $tb = "Không thêm được!";
            }
        }
        $khachhang = $kh->laykhachhang();
        include("main.php");
        break;
    case "timkiem":
        $email = isset($_GET["email"]) ? $_GET["email"] : '';
        $khachhang = $kh->timkiemtheoemail($email);
        include("main.php");
        break;
    default:
        break;
}
