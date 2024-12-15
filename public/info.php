<?php include("inc/top.php"); ?>

<table class="table table-hover table-transparent">
    <tr>
        <th>Mã Đơn Hàng</th>
        <th>Tên người đặt</th>
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
            <td><?php echo $d["hoten"]; ?></td>
            <td><?php echo (new DateTime($d["ngay"]))->format("d-m-Y"); ?></td>
            <td><?php echo $d["tongtien"]; ?></td>
            <td><?php echo $d["ghichu"]; ?></td>
            <td>
                <?php if ($d['trangthai'] == 1) { ?>
                    <a class="btn btn-danger" href="?action=khoa&trangthai=0&madh=<?php echo $d['id'] ?>">Hủy xác nhận</a>
            </td>
        <?php
                } else { ?>
            <a class="btn btn-success" href="?action=khoa&trangthai=1&madh=<?php echo $d['id'] ?>">Xác nhận</a>
        <?php } ?>
        </tr>
    <?php
    endforeach;
    ?>
</table>

<?php include("inc/bottom.php"); ?>