<?php include("../inc/top.php"); ?>

<?php
// Số đơn hàng hiển thị trên mỗi trang
$itemsPerPage = 5;

// Lấy trang hiện tại từ tham số GET
$currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;

// Tính toán tổng số trang
$totalItems = count($donhang); // Tổng số đơn hàng
$totalPages = ceil($totalItems / $itemsPerPage); // Tổng số trang

// Đảm bảo trang hiện tại không vượt quá giới hạn
if ($currentPage < 1) $currentPage = 1;
if ($currentPage > $totalPages) $currentPage = $totalPages;

// Tính toán vị trí bắt đầu và kết thúc
$startIndex = ($currentPage - 1) * $itemsPerPage;
$donhangToShow = array_slice($donhang, $startIndex, $itemsPerPage);
?>
<!-- Bảng chọn thời gian -->
<div class="container-custom">
    <div class="row">
        <!-- Form bên trái -->
        <div class="col-md-6">
            <div class="form-container">
                <h3 class="text-center">Chọn Khoảng Thời Gian</h3>
                <form method="post" action="index.php">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="start_date" class="form-label">Ngày Bắt Đầu</label>
                            <input type="date" id="start_date" name="start_date" class="form-control" value="<?php echo isset($_POST['start_date']) ? $_POST['start_date'] : ''; ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="end_date" class="form-label">Ngày Kết Thúc</label>
                            <input type="date" id="end_date" name="end_date" class="form-control" value="<?php echo isset($_POST['end_date']) ? $_POST['end_date'] : ''; ?>" required>
                        </div>
                    </div>
                    <input type="hidden" name="action" value="guibaocao">
                    <input class="btn btn-primary" type="submit" value="Gửi Báo Cáo">
                </form>
            </div>
        </div>

        <!-- Doanh thu bên phải -->
        <div class="col-md-6">
            <div class="revenue-container">
                <h3 class="text-center">Doanh Thu Theo Ngày</h3>
                <?php if (isset($tongtien) && !empty($tongtien)): ?>
                    <?php foreach ($tongtien as $tt): ?>
                        <ul class="list-group">
                            <li class="list-group-item">Ngày: <?php echo $tt['ngay']; ?> - Doanh thu: <?php echo number_format($tt['tong_donhang'], 0, ',', '.'); ?> VND</li>
                        </ul>
                    <?php endforeach; ?>
                    <li class="list-group-item"><strong>Tổng Doanh Thu: </strong><?php echo number_format($tongtienall, 0, ',', '.'); ?> VND</li>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    // Tự động gán ngày hiện tại vào trường ngày kết thúc
    document.addEventListener('DOMContentLoaded', () => {
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('end_date').value = today;
    });
</script>
<br>
<hr>
<!-- Bảng danh sách đơn hàng -->
<h4 class="text-info">Danh sách đơn hàng</h4>
<table class="table table-hover custom-table">
    <tr>
        <th>ID</th>
        <th>Tên người đặt</th>
        <th>Ngày đặt</th>
        <th>Tổng tiền</th>
        <th>Ghi chú</th>
    </tr>
    <?php
    foreach ($donhangToShow as $d):
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
        </tr>
    <?php
    endforeach;
    ?>
</table>
<!-- Liên kết phân trang -->
<nav aria-label="Page navigation">
    <ul class="pagination">
        <!-- Nút "Trước" -->
        <?php if ($currentPage > 1): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?php echo $currentPage - 1; ?>">Trước</a>
            </li>
        <?php endif; ?>

        <!-- Các nút số trang -->
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?php if ($i == $currentPage) echo 'active'; ?>">
                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
        <?php endfor; ?>

        <!-- Nút "Sau" -->
        <?php if ($currentPage < $totalPages): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?php echo $currentPage + 1; ?>">Sau</a>
            </li>
        <?php endif; ?>
    </ul>
</nav>
<?php include("../inc/bottom.php"); ?>