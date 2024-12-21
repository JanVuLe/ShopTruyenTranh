<?php include("../inc/top.php"); ?>

<div class="container mt-4">
    <?php if (!empty($tb)): ?>
        <div class="toast-container position-fixed top-0 end-0 p-3">
            <div id="toastNotification" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="5000">
                <div class="d-flex">
                    <div class="toast-body">
                        <?php echo $tb; ?>
                    </div>
                    <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <form class="d-flex" action="index.php" method="get">
        <input type="hidden" name="action" value="timkiem">
        <input
            class="form-control"
            type="search"
            name="tenkhuyenmai"
            placeholder="Tìm kiếm theo tên khuyến mãi"
            aria-label="Tìm kiếm"
            value="<?php echo isset($_GET["tenkhuyenmai"]) ? ($_GET["tenkhuyenmai"]) : ''; ?>">
        <button type="submit" class="btn btn-outline-info">Tìm kiếm</button>
    </form>
    <br>
    <a href="index.php?action=them" class="btn btn-primary mb-3">Thêm Khuyến Mãi</a>
    <hr>
    <h2 class="mb-4">Danh Sách Khuyến Mãi</h2>
    <table class="table table-bordered table-hover custom-table">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Tên Khuyến Mãi</th>
                <th>Mô Tả</th>
                <th>Ngày Bắt Đầu</th>
                <th>Ngày Kết Thúc</th>
                <th>Phần Trăm Giảm</th>
                <th>Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($khuyenmai as $k): ?>
                <tr>
                    <td><?php echo $k["id"]; ?></td>
                    <td><?php echo $k["tenkhuyenmai"]; ?></td>
                    <td><?php echo $k["mota"]; ?></td>
                    <td><?php echo date("d/m/Y", strtotime($k["ngaybatdau"])); ?></td>
                    <td><?php echo date("d/m/Y", strtotime($k["ngayketthuc"])); ?></td>
                    <td><?php echo $k["phantramgiam"]; ?>%</td>
                    <td>
                        <a href="index.php?action=sua&id=<?php echo $k['id']; ?>" class="btn btn-warning btn-sm" title="Sửa">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="index.php?action=xoa&id=<?php echo $k['id']; ?>" class="btn btn-danger btn-sm" title="Xóa">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br>
    <?php if (isset($_GET["tenkhuyenmai"]) && $_GET["tenkhuyenmai"] != ''): ?>
        <a href="index.php?action=macdinh" class="btn btn-outline-secondary mt-2">Trở về</a>
    <?php endif; ?>
</div>

<?php include("../inc/bottom.php"); ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toastEl = document.getElementById('toastNotification');
        if (toastEl) {
            const toast = new bootstrap.Toast(toastEl, {
                animation: true, // Hiệu ứng mượt mà
                autohide: true, // Tự động ẩn
                delay: 5000 // 5 giây
            });
            toast.show();
        }
    });
</script>