<?php
session_start();
require("../../model/database.php");
require("../../model/nguoidung.php");
require("../../model/donhang.php");

// Biến $isLogin cho biết người dùng đăng nhập chưa
$isLogin = isset($_SESSION["nguoidung"]);


// Xét xem có thao tác nào được chọn
if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
} elseif ($isLogin == FALSE) {  // chưa đăng nhập
    $action = "dangnhap";
} else {   // mặc định
    $action = "macdinh";
}

$nd = new NGUOIDUNG();
$dh = new DONHANG();
$donhang = $dh->laydonhangmoi();
switch ($action) {
    case "macdinh":
        include("main.php");
        break;
    case "dangnhap":
        include("login.php");
        break;
    case "xldangnhap":
        $email = $_REQUEST["txtemail"];
        $matkhau = $_REQUEST["txtmatkhau"];
        $tb = '';
        if (!$email && !$matkhau) {
            $tb = "Hãy nhập thông tin.";
        } else if (!$email) {
            $tb = "Hãy nhập thông email.";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // Kiểm tra định dạng email
            $tb = "Email không đúng định dạng. Vui lòng nhập lại.";
        } else if (!$matkhau) {
            $tb = "Hãy nhập mật khẩu.";
        }
        if ($tb) {
            include("login.php");
            break;
        }
        $nguoidung = $nd->timkiemtheoemail($email);
        if (!$nguoidung) {
            $tb = "Email này chưa được đăng ký.";
            include("login.php");
        } else {
            if ($nd->kiemtranguoidunghople($email, $matkhau) == TRUE) {
                $nguoidung = $nd->laythongtinnguoidung($email);
                if ($nguoidung["loai"] == 1 || $nguoidung["loai"] == 2) {
                    $_SESSION["nguoidung"] = $nguoidung; // đặt biến session
                    include("main.php");
                } else {
                    $tb = "Tài khoản này không có quyền try cập.";
                    include("login.php");
                }
            } else {
                $tb = "Mật khẩu không đúng.";
                include("login.php");
            }
        }
        break;
    case "dangky":
        include("regis.php");
        break;
    case "xldangky":
        $email = $_REQUEST["txtemail"];
        $matkhau = $_REQUEST["txtmatkhau"];
        $nl_matkhau = $_REQUEST["txtnl_matkhau"];
        $tb = '';
        if (!$email && !$matkhau && !$nl_matkhau) {
            $tb = "Hãy nhập thông tin.";
        } else if (!$email) {
            $tb = "Hãy nhập thông email.";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // Kiểm tra định dạng email
            $tb = "Email không đúng định dạng. Vui lòng nhập lại.";
        } else if (!$matkhau) {
            $tb = "Hãy nhập mật khẩu.";
        } else if (!$nl_matkhau) {
            $tb = "Hãy nhập lại mật khẩu.";
        } else if ($matkhau != $nl_matkhau) {
            $tb = "Mật khẩu không trùng khớp.";
        }
        if ($tb) {
            include("regis.php");
            break;
        }
        break;
    case "dangxuat":
        unset($_SESSION["nguoidung"]);  // hủy biến session
        //include("login.php");         // hiển thị trang login
        header("location:../../index.php");     // hoặc chuyển hướng ra bên ngoài (trang dành cho khách)
        break;
    case "hoso":
        include("profile.php");
        break;
    case "xlhoso":
        $mand = $_POST["txtid"];
        $email = $_POST["txtemail"];
        $sodt = $_POST["txtdienthoai"];
        $hoten = $_POST["txthoten"];
        $hinhanh = $_POST["txthinhanh"];

        if ($_FILES["fhinh"]["name"] != null) {
            $hinhanh = basename($_FILES["fhinh"]["name"]);
            $duongdan = "../../images/users/" . $hinhanh;
            move_uploaded_file($_FILES["fhinh"]["tmp_name"], $duongdan);
        }

        $nd->setid($mand);
        $nd->setemail($email);
        $nd->setsodienthoai($sodt);
        $nd->sethoten($hoten);
        $nd->sethinhanh($hinhanh);

        $nd->capnhatnguoidung($nd);

        $_SESSION["nguoidung"] = $nd->laythongtinnguoidung($email);
        include("main.php");
        break;
    case "matkhau":
        include("changepass.php");
        break;
    case "doimatkhau":
        if (isset($_POST["txtemail"]) && isset($_POST["txtmatkhaumoi"]))
            $nd->doimatkhau($_POST["txtemail"], $_POST["txtmatkhaumoi"]);
        include("main.php");
        break;
    default:
        break;
}
