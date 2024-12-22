<?php include("../inc/top.php"); ?>

<h3>Thêm mặt hàng</h3>
<br>
<form method="post" enctype="multipart/form-data" action="index.php">
	<input type="hidden" name="action" value="xulythem">
	<div class="mb-3 mt-3">
		<label for="optdanhmuc" class="form-label">Truyện</label>
		<select class="form-select" name="optdanhmuc">
			<?php
			foreach ($danhmuc as $d):
			?>
				<option value="<?php echo $d["id"]; ?>"><?php echo $d["tendanhmuc"]; ?></option>
			<?php
			endforeach;
			?>
		</select>
	</div>
	<div class="mb-3 mt-3">
		<label for="txttenmathang" class="form-label">Tên truyện</label>
		<input class="form-control" type="text" name="txttenmathang" placeholder="Nhập tên" required>
	</div>
	<div class="mb-3 mt-3">
		<label for="txttenmathang" class="form-label">Tác giả</label>
		<input class="form-control" type="text" name="txttacgia" placeholder="Nhập tên tác giả" required>
	</div>
	<div class="mb-3 mt-3">
		<label for="txtgiaban" class="form-label">Giá gốc</label>
		<input class="form-control" type="number" name="txtgiagoc" value="0">
	</div>
	<div class="mb-3 mt-3">
		<label for="optkhuyenmai" class="form-label">Khuyến mãi</label>
		<select class="form-select" name="optkhuyenmai">
			<option value="" selected>Không</option>
			<?php
			foreach ($khuyenmai as $k):
			?>
				<option value="<?php echo $k["id"]; ?>"><?php echo $k["tenkhuyenmai"]; ?></option>
			<?php
			endforeach;
			?>
		</select>
	</div>
	<div class="mb-3 mt-3">
		<label for="txtsoluong" class="form-label">Số lượng</label>
		<input class="form-control" type="number" name="txtsoluong" value="0">
	</div>
	<div class="mb-3 mt-3">
		<label for="txtmota" class="form-label">Mô tả nội dung</label>
		<textarea id="txtmota" rows="5" class="form-control" name="txtmota" placeholder="Nhập mô tả" required></textarea>
	</div>
	<div class="mb-3 mt-3">
		<label>Hình ảnh</label>
		<input class="form-control" type="file" name="filehinhanh">
	</div>
	<div class="mb-3 mt-3">
		<input type="submit" value="Lưu" class="btn btn-success">
		<a href="index.php" class="btn btn-warning"> Hủy</a>
	</div>
</form>

<?php include("../inc/bottom.php"); ?>