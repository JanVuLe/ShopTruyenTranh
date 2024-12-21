<?php include("../inc/top.php"); ?>

<div class="container mt-4">
    <h2>Thêm Khuyến Mãi</h2>
    <form method="POST" enctype="multipart/form-data" action="index.php">
        <input type="hidden" name="action" value="xulythem">
        <div class="mb-3">
            <label>Tên Khuyến Mãi</label>
            <input type="text" class="form-control" name="txttenkhuyenmai" required>
        </div>
        <div class="mb-3">
            <label>Mô Tả</label>
            <textarea class="form-control" name="txtmota"></textarea>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label>Ngày Bắt Đầu</label>
                <input type="date" class="form-control" name="txtngaybatdau" id="ngaybatdau" required>
            </div>
            <div class="col-md-6">
                <label>Ngày Kết Thúc</label>
                <input type="date" class="form-control" name="txtngayketthuc" id="ngayketthuc" required>
            </div>
        </div>
        <div class="mb-3">
            <label>Phần Trăm Giảm</label>
            <input type="number" class="form-control" name="txtphantramgiam" value="0">
        </div>
        <input type="submit" value="Lưu" class="btn btn-success">
        <a href="index.php" class="btn btn-secondary">Quay Lại</a>
    </form>
</div>

<?php include("../inc/bottom.php"); ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Lấy ngày hiện tại theo định dạng YYYY-MM-DD
        let today = new Date();
        let formattedDate = today.toISOString().split('T')[0];

        // Đặt giá trị mặc định cho ô ngày
        document.getElementById('ngaybatdau').value = formattedDate;
        document.getElementById('ngayketthuc').value = formattedDate;
    });
</script>