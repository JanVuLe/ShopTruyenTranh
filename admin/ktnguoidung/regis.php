<!DOCTYPE html>
<html>
<?php include("../ktnguoidung/head.php"); ?>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>
                <div class="image"><img src="../custom/img/logo/logoShop.jpg" alt="Cửa Hàng Truyện Tranh"></div>
            </div>
            <br>
            <h3>Tạo tài khoản</h3>
            <p>Tạo tài khoản sử dụng chức năng.</p>
            <?php if (!empty($tb)): ?>
                <div class="alert alert-danger text-center" role="alert">
                    <?php echo htmlspecialchars($tb); ?>
                </div>
            <?php endif; ?>
            <form class="m-t" role="form" action="index.php" method="post" id="mainForm">
                <div class="form-group">
                    <input class="form-control form-control-lg" type="email" name="txtemail" placeholder="Nhập email" />
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" type="password" name="txtmatkhau" placeholder="Nhập mật khẩu" />
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" type="password" name="txtnl_matkhau" placeholder="Nhập lại mật khẩu" />
                </div>
                <input type="hidden" name="action" value="xldangky">
                <button type="submit" id="registerBtn" class="btn btn-primary block full-width m-b">Đăng Ký</button>
                <p class="text-muted text-center"><small>Đã có tài khoản?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="login.php">Login</a>
            </form>
            <p class="m-t"> <small>Của hàng truện tranh &copy; 2024</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="js/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
</body>

</html>