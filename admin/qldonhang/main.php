<?php include("../inc/top.php"); ?>


<h4 class="text-info">Danh sách đơn hàng</h4>
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
<table class="table table-hover">
    <tr>
        <th>ID</th>
        <th>Tên người đặt</th>
        <th>Ngày đặt</th>
        <th>Tổng tiền</th>
        <th>Ghi chú</th>
        <th>Trạng thái</th>
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