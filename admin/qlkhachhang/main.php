<?php include("../inc/top.php"); ?>

<div>
    <!-- Thông báo lỗi nếu có -->
    <?php
    if (isset($tb)) {
    ?>
        <div class="alert alert-danger alert-dismissible fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Lỗi!</strong> <?php echo $tb; ?>
        </div>
    <?php
    }
    ?>
    <!-- Nút mở hộp modal chứa form thêm mới -->
    <div><a class="btn btn-outline-success" href="index.php?action=them"><span class="glyphicon glyphicon-plus"></span>Thêm người dùng</a></div>

    <br>
    <!-- Form tìm kiếm khách hàng theo email -->
    <div class="mb-3">
        <h3 style="text-transform: uppercase;">Danh sách khách hàng</h3>
        <form class="d-flex" action="index.php" method="get">
            <input type="hidden" name="action" value="timkiem">
            <input
                class="form-control"
                type="search"
                name="email"
                placeholder="Tìm kiếm theo email"
                aria-label="Tìm kiếm"
                value="<?php echo isset($_GET["email"]) ? htmlspecialchars($_GET["email"]) : ''; ?>">
            <button type="submit" class="btn btn-outline-info">Tìm kiếm</button>
        </form>
        <!-- Thêm nút trở về danh sách khách hàng -->
        <?php if (isset($_GET["email"]) && $_GET["email"] != ''): ?>
            <a href="index.php?action=macdinh" class="btn btn-outline-secondary mt-2">Trở về</a>
        <?php endif; ?>
    </div>
    <!-- Bản danh sách -->
    <table class="table table-hover custom-table">
        <thead>
            <tr>
                <th><a href="index.php?sort=email">Email</a></th>
                <th><a href="index.php?sort=sodienthoai">Số điện thoại</a></th>
                <th><a href="index.php?sort=hoten">Họ tên</a></th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($khachhang as $kh): ?>
                <tr>
                    <td><?php echo $kh["email"]; ?></td>
                    <td><?php echo $kh["sodienthoai"]; ?></td>
                    <td><?php echo $kh["hoten"]; ?></td>
                    <td>
                        <?php
                        if ($kh["loai"] != 1) {
                            echo ($kh["trangthai"] == 1) ? "Kích hoạt" : "Khóa";
                        }
                        ?>
                    </td>
                    <td>
                        <?php if ($kh["loai"] != 1): ?>
                            <div class="d-flex align-items-center">
                                <div class="form-check form-switch">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        id="switch-<?php echo $kh['id']; ?>"
                                        <?php echo $kh['trangthai'] == 1 ? 'checked' : ''; ?>
                                        onchange="toggleStatus(<?php echo $kh['id']; ?>, this.checked)">
                                </div>
                            <?php endif; ?>
                            <a href="index.php?action=xoa&mand=<?php echo $kh['id']; ?>" class="btn btn-danger btn-sm" title="Xóa">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                            </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include("../inc/bottom.php"); ?>
<script>
    function toggleStatus(userId, isChecked) {
        const newStatus = isChecked ? 1 : 0;
        const url = `?action=khoa&trangthai=${newStatus}&mand=${userId}`;
        window.location.href = url;
    }
</script>