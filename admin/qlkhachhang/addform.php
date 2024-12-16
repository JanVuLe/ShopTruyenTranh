<?php include("../inc/top.php"); ?>

<h3 style="text-transform: uppercase;">Thêm khách hàng</h3>
<div>
    <form method="post">
        <div class="my-3">
            <input class="form-control" type="email" name="txtemail" placeholder="Email" required>
        </div>
        <div class="my-3">
            <input class="form-control" type="number" name="txtdienthoai" placeholder="Số điện thoại" required>
        </div>
        <div class="my-3">
            <input class="form-control" type="text" name="txthoten" placeholder="Họ tên" required>
        </div>
        <div class="my-3">
            <input type="hidden" name="action" value="xlthem">
            <input class="btn btn-primary" type="submit" value="Thêm">
            <a href="index.php" class="btn btn-warning">Hủy</a>
        </div>
    </form>
</div>

<?php include("../inc/bottom.php"); ?>