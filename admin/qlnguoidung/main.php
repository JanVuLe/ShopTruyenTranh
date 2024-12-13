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
  <!-- Form tìm kiếm người dùng theo email -->
  <div class="mb-3">
    <h3 style="text-transform: uppercase;">Danh sách người dùng</h3>
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
    <!-- Thêm nút trở về danh sách người dùng -->
    <?php if (isset($_GET["email"]) && $_GET["email"] != ''): ?>
      <a href="index.php?action=macdinh" class="btn btn-outline-secondary mt-2">Trở về</a>
    <?php endif; ?>
  </div>
  <!-- Bản danh sách -->
  <table class="table table-hover">
    <thead>
      <tr>
        <th><a href="index.php?sort=email">Email</a></th>
        <th><a href="index.php?sort=sodienthoai">Số điện thoại</a></th>
        <th><a href="index.php?sort=hoten">Họ tên</a></th>
        <th><a href="index.php?sort=loai">Loại quyền</a></th>
        <th>Trạng thái</th>
        <th>Khóa</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($nguoidung as $nd): ?>
        <tr>
          <td><?php echo htmlspecialchars($nd["email"]); ?></td>
          <td><?php echo htmlspecialchars($nd["sodienthoai"]); ?></td>
          <td><?php echo htmlspecialchars($nd["hoten"]); ?></td>
          <td>
            <?php
            echo ($nd["loai"] == 1) ? "Quản trị" : (($nd["loai"] == 2) ? "Nhân viên" : "Khách hàng");
            ?>
          </td>
          <td>
            <?php
            if ($nd["loai"] != 1) {
              echo ($nd["trangthai"] == 1) ? "Kích hoạt" : "Khóa";
            }
            ?>
          </td>
          <td>
            <?php if ($nd["loai"] != 1): ?>
              <div class="form-check form-switch">
                <input
                  class="form-check-input"
                  type="checkbox"
                  id="switch-<?php echo $nd['id']; ?>"
                  <?php echo $nd['trangthai'] == 1 ? 'checked' : ''; ?>
                  onchange="toggleStatus(<?php echo $nd['id']; ?>, this.checked)">
              </div>
            <?php endif; ?>
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