<?php include("../inc/top.php");
?>
<h3>Quản lý mặt hàng</h3>
<br>
<a href="index.php?action=them" class="btn btn-info">
	<i class="align-middle" data-feather="plus-circle"></i>
	Thêm mặt hàng
</a>
<hr>
<div class="d-block">
	<select class="js-example-basic-single w-25" id="chondm">
		<option value="0">[Chọn danh mục]</option>
		<?php $selectedId = $_GET['selectedId'];
		foreach ($danhmuc as $d): ?>
			<option value="<?php echo $d['id'] ?>" <?php if ($d['id'] == $selectedId) echo ' selected'; ?>><?php echo $d['tendanhmuc'] ?></option>
		<?php endforeach; ?>
	</select>
	<script>
		$(document).ready(function() {
			$('.js-example-basic-single').select2();
			$('#chondm').on('change', function() {
				let selectedValue = $(this).val();
				if (selectedValue) {
					window.location.href = `?selectedId=${selectedValue}`;
				}
			});
		});
	</script>
</div>

<br>
<!-- Lấy tên danh mục -->
<?php
if (isset($_GET['selectedId'])) {
	$itemsPerPage = 3; // Số lượng mỗi mặt hàng trong 1 trang
	$currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1; // Kiểm tra trang hiện tai, nếu không có thì mặc định là 1
	$filteredItems = array_filter($mathang, fn($m) => $m["danhmuc_id"] == $_GET['selectedId']); // Filter by selected danh mục
	$totalItems = count($filteredItems);
	$totalPages = ceil($totalItems / $itemsPerPage);

	if ($totalPages == 0) {
		$totalPages = 1;
	}

	$startIndex = ($currentPage - 1) * $itemsPerPage;


	$itemsToShow = array_slice($filteredItems, $startIndex, $itemsPerPage);


	if ($currentPage > $totalPages) {
		$currentPage = $totalPages;
	}
?>
	<table class="table table-hover">
		<tr>
			<th>Tên mặt hàng</th>
			<th>Giá bán</th>
			<th>Số lượng</th>
			<th>Hình ảnh</th>
			<th>Sửa</th>
			<th>Xóa</th>
		</tr>
		<?php
		foreach ($itemsToShow as $m):
			if ($m["danhmuc_id"] == $selectedId) {
		?>
				<tr>
					<td>
						<a style="color: inherit;" href="index.php?action=chitiet&id=<?php echo $m["id"]; ?>">
							<?php echo $m["tenmathang"]; ?>
						</a>
					</td>
					<td><?php echo $m["giaban"]; ?></td>
					<td><?php echo $m["soluongton"]; ?></td>
					<td>
						<a href="index.php?action=chitiet&id=<?php echo $m["id"]; ?>">
							<img src="../../<?php echo $m["hinhanh"]; ?>" width="80" class="img-thumbnail"></a>
					</td>
					<td><a class="btn btn-warning" href="index.php?action=sua&id=<?php echo $m["id"]; ?>"><i class="align-middle" data-feather="edit"></a></td>
					<td><a class="btn btn-danger" href="index.php?action=xoa&id=<?php echo $m["id"]; ?>"><i class="align-middle" data-feather="trash-2"></a></td>
				</tr>
		<?php
			}
		endforeach;
		?>
	</table>
	<!-- Pagination Links -->
	<nav aria-label="Page navigation">
		<ul class="pagination">
			<?php if ($currentPage > 1): ?>
				<li class="page-item">
					<a class="page-link" href="?selectedId=<?php echo $selectedId; ?>&page=<?php echo $currentPage - 1; ?>">Trước</a>
				</li>
			<?php endif; ?>
			<?php for ($i = 1; $i <= $totalPages; $i++): ?>
				<li class="page-item <?php if ($i == $currentPage) echo 'active'; ?>">
					<a class="page-link" href="?selectedId=<?php echo $selectedId; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
				</li>
			<?php endfor; ?>
			<?php if ($currentPage < $totalPages): ?>
				<li class="page-item">
					<a class="page-link" href="?selectedId=<?php echo $selectedId; ?>&page=<?php echo $currentPage + 1; ?>">Sau</a>
				</li>
			<?php endif; ?>
		</ul>
	</nav>
<?php } ?>


<script>

</script>
<?php include("../inc/bottom.php"); ?>