<?php
session_start();
if (!isset($_SESSION["nguoidung"]))
    header("location:../index.php");

require("../../model/database.php");
require("../../model/mathang.php");
require("../../model/khuyenmai.php");


if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
} else {
    $action = "macdinh";
}

$mh = new MATHANG();
$km = new KHUYENMAI();

switch ($action) {
    case "macdinh":
        $khuyenmai = $km->laykhuyenmai();
        include("main.php");
        break;
    case "them":
        include("addform.php");
        break;
    case "xulythem":
        $khuyenmai_add = new KHUYENMAI();

        $khuyenmai_add->settenkhuyenmai($_POST["txttenkhuyenmai"]);
        $khuyenmai_add->setmota($_POST["txtmota"]);
        $khuyenmai_add->setngaybatdau($_POST["txtngaybatdau"]);
        $khuyenmai_add->setngayketthuc($_POST["txtngayketthuc"]);
        $khuyenmai_add->setphantramgiam($_POST["txtphantramgiam"]);

        $km->themkhuyenmai($khuyenmai_add);
        $khuyenmai = $km->laykhuyenmai();
        include("main.php");
        break;
    case "xoa":
        $id = $_GET["id"];
        if ($km->xoakhuyenmai($id)) {
            $tb = "Khuyến mãi đã được xóa";
        } else {
            $tb = "Không thể xóa khuyến mãi!";
        }
        $khuyenmai = $km->laykhuyenmai();
        include("main.php");
        break;
    case "sua":
        if (isset($_GET["id"])) {
            $k = $km->laykhuyenmaitheoid($_GET["id"]);
            include("updateform.php");
        } else {
            $khuyenmai = $km->laykhuyenmai();
            include("main.php");
        }
        break;
    case "xulysua":
        $khuyenmai_update = new KHUYENMAI();
        $khuyenmai_update->setid($_POST["txtid"]);
        $khuyenmai_update->settenkhuyenmai($_POST["txttenkhuyenmai"]);
        $khuyenmai_update->setmota($_POST["txtmota"]);
        $khuyenmai_update->setngaybatdau($_POST["txtngaybatdau"]);
        $khuyenmai_update->setngayketthuc($_POST["txtngayketthuc"]);
        $khuyenmai_update->setphantramgiam($_POST["txtphantramgiam"]);

        $km->suakhuyenmai($khuyenmai_update);

        $khuyenmai = $km->laykhuyenmai();
        include("main.php");
        break;
    case "timkiem":
        $tenkhuyenmai = isset($_GET["tenkhuyenmai"]) ? $_GET["tenkhuyenmai"] : '';
        $khuyenmai = $km->timkiemtheoten($tenkhuyenmai);
        include("main.php");
        break;
    default:
        break;
}
