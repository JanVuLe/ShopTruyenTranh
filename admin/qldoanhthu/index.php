<?php
session_start();
if (!isset($_SESSION["nguoidung"]))
    header("location:../index.php");

require("../../model/database.php");
require("../../model/diachi.php");
require("../../model/donhang.php");
require("../../model/nguoidung.php");
require("../../model/donhangct.php");

// Xét xem có thao tác nào được chọn
if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
} else {
    $action = "xem";
}

$dh = new DONHANG();
$dhct = new DONHANGCT();
$donhangct = $dhct->layctdonhang();
$dc = new DIACHI();
$diachi = $dc->laydiachi();
$nd = new NGUOIDUNG();
$nguoidung = $nd->laydanhsachnguoidung();

switch ($action) {
    case "xem":
        $donhang = $dh->laydonhangxacnhan();
        include("main.php");
        break;
    case "chitiet":
        if (isset($_GET["id"])) {
            $donhangct = $dhct->layctdonhangtheodonhang($_GET["id"]);
            include("detail.php");
        } else {
            $mathang = $mh->laymathang();
            include("main.php");
        }
        break;
    case "khoa":
        $madh = $_GET["madh"];
        $trangthai = $_GET["trangthai"];
        if (!$dh->doitrangthai($madh, $trangthai)) {
            $tb = "Đã đổi trạng thái!";
        }
        $donhang = $dh->laydonhang();
        include("main.php");
        break;
    case "guibaocao":
        $start_date = $_POST["start_date"];
        $end_date = $_POST["end_date"];
        $donhang = $dh->laydonhangtheongay($start_date, $end_date);
        $tongtien = $dh->tongtientheongay($start_date, $end_date);
        $tongtienall = 0;
        foreach ($tongtien as $row) {
            $tongtienall += $row["tong_donhang"];
        }
        include("main.php");
        break;
    default:
        break;
}
