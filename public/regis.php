<?php
include("inc/top.php");
?>
<div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
        <div class="p-3 shadow">
            <h3 class="text-center text-warning">ĐĂNG KÝ</h3>
            <!-- Hiển thị thông báo lỗi -->
            <?php if (!empty($tb)): ?>
                <div class="alert alert-danger text-center" role="alert">
                    <?php echo htmlspecialchars($tb); ?>
                </div>
            <?php endif; ?>
            <form method="post" action="index.php">

                <input class="form-control" type="text" name="txthoten" placeholder="Họ tên" required><br>
                <input class="form-control" type="text" name="txtemail" placeholder="Email" required><br>
                <input class="form-control" type="text" name="txtsdt" placeholder="Số điện thoại" required><br>
                <input class="form-control" type="password" name="txtmatkhau" placeholder="Mật khẩu" required><br>
                <input class="form-control" type="password" name="txtre_matkhau" placeholder="Nhập lại mật khẩu" required><br>

                <input type="hidden" name="action" value="xldangky">
                <div class="d-grid">
                    <input class="btn btn-info btn-block" type="submit" value="Đăng ký">
                </div>
            </form>
            <div id="errorMessage" class="text-danger mt-2"></div>
        </div>
    </div>
    <div class="col-sm-4"></div>
</div>
<?php
include("inc/bottom.php");
?>