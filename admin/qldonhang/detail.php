<?php include("../inc/top.php"); ?>

<h3 class="text-info">Chi Tiết đơn hàng:</h3>
<table class="table table-hover">
    <tr>
        <th>Hình ảnh</th>
        <th>Tên hàng</th>
        <th>Đơn giá</th>
        <th>Số lượng</th>
    </tr>
    <?php foreach ($donhangct as $dhct): ?>
        <tr>
            <td><img width="50" src="../../<?php echo $dhct["hinhanh"]; ?>"></td>
            <td><?php echo $dhct["tenmathang"]; ?></td>
            <td><?php echo number_format($dhct["dongia"]); ?>đ</td>
            <td><input type="number" name="dhct[<?php echo $id; ?>]" value="<?php echo $dhct["soluong"]; ?>"></td>
        </tr>
    <?php endforeach; ?>
</table>
<a class="btn btn-primary" href="index.php" role="button">Trở về</a>
<?php include("../inc/bottom.php"); ?>