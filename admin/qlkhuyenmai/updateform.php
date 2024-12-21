<?php include("../inc/top.php"); ?>

<div class="container mt-4">
    <h2>Cập Nhật Khuyến Mãi</h2>
    <form method="POST" enctype="multipart/form-data" action="index.php">
        <input type="hidden" name="action" value="xulysua">
        <input type="hidden" name="txtid" value="<?php echo $k['id']; ?>">

        <div class="mb-3">
            <label>Tên Khuyến Mãi</label>
            <input type="text" class="form-control" name="txttenkhuyenmai" value="<?php echo $k['tenkhuyenmai']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Mô Tả</label>
            <textarea class="form-control" name="txtmota"><?php echo $k['mota']; ?></textarea>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label>Ngày Bắt Đầu</label>
                <input type="date" class="form-control" name="txtngaybatdau" value="<?php echo $k['ngaybatdau']; ?>" required>
            </div>
            <div class="col-md-6">
                <label>Ngày Kết Thúc</label>
                <input type="date" class="form-control" name="txtngayketthuc" value="<?php echo $k['ngayketthuc']; ?>" required>
            </div>
        </div>
        <div class="mb-3">
            <label>Phần Trăm Giảm</label>
            <input type="number" class="form-control" name="txtphantramgiam" value="<?php echo $k['phantramgiam']; ?>">
        </div>
        <div class="my-3">
            <input class="btn btn-primary" type="submit" value="Lưu">
            <input class="btn btn-warning" type="reset" value="Hủy" onclick="veindex()">
        </div>
    </form>
</div>
<script>
    ClassicEditor
        .create(document.querySelector('#txtmota'))
        .catch(error => {
            console.error(error);
        });

    function veindex() {
        window.location.href = 'index.php';
    }
</script>
<?php include("../inc/bottom.php"); ?>