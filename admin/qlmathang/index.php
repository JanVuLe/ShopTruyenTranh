<?php
session_start();
if (!isset($_SESSION["nguoidung"]))
    header("location:../index.php");

require("../../model/database.php");
require("../../model/danhmuc.php");
require("../../model/mathang.php");

// Xét xem có thao tác nào được chọn
if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
} else {
    $action = "xem";
}

$dm = new DANHMUC();
$danhmuc = $dm->laydanhmuc();
$mh = new MATHANG();

switch ($action) {
    case "xem":
        $mathang = $mh->laymathang();
        include("main.php");
        break;
    case "them":
        $danhmuc = $dm->laydanhmuc();
        include("addform.php");
        break;
    case "xulythem":
        $mathanghh = new MATHANG();
        // xử lý file upload
        $danhmuc_id = $_POST["optdanhmuc"];
        $thu_muc = "";
        switch ($danhmuc_id) {
            case "1":
                $thu_muc = "vietnam";
                break;
            case "2":
                $thu_muc = "nhatban";
                break;
            case "3":
                $thu_muc = "trungquoc";
                break;
            case "4":
                $thu_muc = "hanquoc";
                break;
            case "5":
                $thu_muc = "phuongtay";
                break;
            default:
                $thu_muc = "";
        }
        $thu_muc_anh = "images/products/" . $thu_muc . "/";
        $hinhanh = $thu_muc_anh . basename($_FILES["filehinhanh"]["name"]); // Đường dẫn lưu trong CSDL
        $duongdan = "../../" . $hinhanh;
        // $hinhanh = "images/products/../" . basename($_FILES["filehinhanh"]["name"]); // đường dẫn ảnh lưu trong db
        // $duongdan = "../../../" . $hinhanh; // nơi lưu file upload (đường dẫn tính theo vị trí hiện hành)
        move_uploaded_file($_FILES["filehinhanh"]["tmp_name"], $duongdan);
        // xử lý thêm	
        $mathanghh->settenmathang($_POST["txttenmathang"]);
        $mathanghh->settacgia($_POST["txttacgia"]);
        $mathanghh->setmota($_POST["txtmota"]);
        $mathanghh->setgiagoc($_POST["txtgianhap"]);
        $mathanghh->setgiaban($_POST["txtgiaban"]);
        $mathanghh->setsoluongton($_POST["txtsoluong"]);
        $mathanghh->setdanhmuc_id($_POST["optdanhmuc"]);
        $mathanghh->sethinhanh($hinhanh);
        $mh->themmathang($mathanghh);
        $mathang = $mh->laymathang();
        include("main.php");
        break;
    case "xoa":
        if (isset($_GET["id"])) {
            $mathanghh = new MATHANG();
            $mathanghh->setid($_GET["id"]);
            $mh->xoamathang($mathanghh);
        }
        $mathang = $mh->laymathang();
        include("main.php");
        break;
    case "chitiet":
        if (isset($_GET["id"])) {
            $m = $mh->laymathangtheoid($_GET["id"]);
            include("detail.php");
        } else {
            $mathang = $mh->laymathang();
            include("main.php");
        }
        break;
    case "sua":
        if (isset($_GET["id"])) {
            $m = $mh->laymathangtheoid($_GET["id"]);
            $danhmuc = $dm->laydanhmuc();
            include("updateform.php");
        } else {
            $mathang = $mh->laymathang();
            include("main.php");
        }
        break;
    case "xulysua":
        $mathanghh = new MATHANG();
        $mathanghh->setid($_POST["txtid"]);
        $mathanghh->setdanhmuc_id($_POST["optdanhmuc"]);
        $mathanghh->settenmathang($_POST["txttenhang"]);
        $mathanghh->settacgia($_POST["txttacgia"]);
        $mathanghh->setmota($_POST["txtmota"]);
        $mathanghh->setgiagoc($_POST["txtgiagoc"]);
        $mathanghh->setgiaban($_POST["txtgiaban"]);
        $mathanghh->setsoluongton($_POST["txtsoluongton"]);
        $mathanghh->setluotxem($_POST["txtluotxem"]);
        $mathanghh->setluotmua($_POST["txtluotmua"]);
        //Xử lý ảnh
        $hinhanh = $_POST["txthinhcu"];
        // upload file mới (nếu có)
        if ($_FILES["filehinhanh"]["name"] != "") {
            //Kiểm tra danh mục
            $danhmuc_id = $_POST["optdanhmuc"];
            $thu_muc = "";
            switch ($danhmuc_id) {
                case "1":
                    $thu_muc = "vietnam";
                    break;
                case "2":
                    $thu_muc = "nhatban";
                    break;
                case "3":
                    $thu_muc = "trungquoc";
                    break;
                case "4":
                    $thu_muc = "hanquoc";
                    break;
                case "5":
                    $thu_muc = "phuongtay";
                    break;
                default:
                    $thu_muc = "";
            }
            $thu_muc_anh = "images/products/" . $thu_muc . "/";
            $hinhanh = $thu_muc_anh . basename($_FILES["filehinhanh"]["name"]);
            $duongdan = "../../" . $hinhanh;
            move_uploaded_file($_FILES["filehinhanh"]["tmp_name"], $duongdan);
        }
        $mathanghh->sethinhanh($hinhanh);
        // sửa mặt hàng
        $mh->suamathang($mathanghh);

        // hiển thị ds mặt hàng
        $mathang = $mh->laymathang();
        include("main.php");
        break;

    default:
        break;
}
