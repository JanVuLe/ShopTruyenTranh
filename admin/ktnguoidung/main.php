<?php include("../inc/top.php"); ?>

<h4 class="text-info">Đơn hàng mới nhất</h4>
<!-- Danh sách đơn hàng mới nhất -->
<?php if (isset($donhang)) { ?>
    <table class="table table-hover custom-table">
        <tr>
            <th>ID</th>
            <th>ID người đặt</th>
            <th>Ngày đặt</th>
            <th>Tổng tiền</th>
            <th>Ghi chú</th>
            <th>Trạng thái</th>
        </tr>
        <?php
        foreach ($donhang as $d):
        ?>
            <tr>
                <td>
                    <a class="btn btn-outline-info" href="index.php?action=chitiet&id=<?php echo $d["id"]; ?>">
                        <?php echo $d["id"]; ?>
                    </a>
                </td>
                <td><?php echo $d["nguoidung_id"]; ?></td>
                <td><?php echo (new DateTime($d["ngay"]))->format("d-m-Y"); ?></td>
                <td><?php echo $d["tongtien"]; ?></td>
                <td><?php echo $d["ghichu"]; ?></td>
                <td><a href="../qldonhang/index.php" class="btn btn-warning">Chờ xác nhận</a></td>
            </tr>
        <?php
        endforeach;
        ?>
    </table>
<?php } else {
    echo '<h3 class="text-warning">Hiện tại không có đơn hàng mới</h3>';
} ?>
<?php include("../inc/bottom.php"); ?>