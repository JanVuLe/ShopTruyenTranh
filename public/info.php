<?php include("inc/top.php"); ?>

<h3 class="text-info">Danh sách đơn hàng</h3>

<ul class="order-list">
    <?php
    if (!empty($danhsachdh)) {
        foreach ($danhsachdh as $d):
    ?>
            <li class="order-item">
                <div><strong>Mã Đơn Hàng:</strong>
                    <a href="index.php?action=chitiet&id=<?php echo $d["id"]; ?>">
                        <?php echo $d["id"]; ?>
                    </a>
                </div>
                <div><strong>Tên người đặt:</strong> <?php echo htmlspecialchars($d["hoten"]); ?></div>
                <div><strong>Ngày đặt:</strong> <?php echo (new DateTime($d["ngay"]))->format("d-m-Y"); ?></div>
                <div><strong>Tổng tiền:</strong> <?php echo number_format($d["tongtien"], 0, ',', '.'); ?> đ</div>
                <div><strong>Ghi chú:</strong> <?php echo htmlspecialchars($d["ghichu"]); ?></div>
                <div><strong>Trạng thái:</strong>
                    <?php
                    if ($d['trangthai'] == 1) {
                        echo "<span class='badge bg-success'>Đã xác nhận</span>";
                    } else {
                        echo "<span class='badge bg-warning'>Chờ xác nhận</span>";
                    }
                    ?>
                </div>
                <!-- Hiển thị chi tiết đơn hàng -->
                <div class="order-details">
                    <h4 class="text-warning">Chi tiết đơn hàng</h4>
                    <ul class="detail-list">
                        <?php
                        if (!empty($chiTietDonHang[$d['id']])) {
                            foreach ($chiTietDonHang[$d['id']] as $ct):
                        ?>
                                <li class="detail-item">
                                    <img src="../<?php echo htmlspecialchars($ct['hinhanh']); ?>" alt="<?php echo htmlspecialchars($ct['tenmathang']); ?>" class="item-image">
                                    <span class="item-name"><?php echo htmlspecialchars($ct['tenmathang']); ?></span>
                                    <span class="item-quantity">Số lượng: <?php echo $ct['soluong']; ?></span>
                                    <span class="item-price">Giá: <?php echo number_format($ct['dongia'], 0, ',', '.'); ?> đ</span>
                                </li>
                        <?php
                            endforeach;
                        } else {
                            echo "<li>Không có chi tiết đơn hàng.</li>";
                        }
                        ?>
                    </ul>
                </div>
            </li>
    <?php
        endforeach;
    } else {
        echo "<li>Không có đơn hàng nào.</li>";
    }
    ?>
</ul>

<?php include("inc/bottom.php"); ?>