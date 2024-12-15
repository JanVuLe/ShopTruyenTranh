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
  <!-- Xử lý phân trang -->
  <?php
  $itemsPerPage = 10; // Số người dùng hiển thị trên mỗi trang
  $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1; // Trang hiện tại
  $totalItems = count($nguoidung); // Tổng số người dùng
  $totalPages = ceil($totalItems / $itemsPerPage); // Tổng số trang

  // Đảm bảo trang hiện tại không vượt quá giới hạn
  if ($currentPage < 1) $currentPage = 1;
  if ($currentPage > $totalPages) $currentPage = $totalPages;

  // Tính toán vị trí bắt đầu và kết thúc
  $startIndex = ($currentPage - 1) * $itemsPerPage;
  $nguoidungToShow = array_slice($nguoidung, $startIndex, $itemsPerPage);
  ?>
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
      <?php foreach ($nguoidungToShow as $nd): ?>
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
  <!-- Liên kết phân trang -->
  <nav aria-label="Page navigation">
    <ul class="pagination">
      <?php if ($currentPage > 1): ?>
        <li class="page-item">
          <a class="page-link" href="?page=<?php echo $currentPage - 1; ?>">Trước</a>
        </li>
      <?php endif; ?>
      <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <li class="page-item <?php if ($i == $currentPage) echo 'active'; ?>">
          <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
        </li>
      <?php endfor; ?>
      <?php if ($currentPage < $totalPages): ?>
        <li class="page-item">
          <a class="page-link" href="?page=<?php echo $currentPage + 1; ?>">Sau</a>
        </li>
      <?php endif; ?>
    </ul>
  </nav>
</div>
<?php include("../inc/bottom.php"); ?>
<script>
  function toggleStatus(userId, isChecked) {
    const newStatus = isChecked ? 1 : 0;
    const url = `?action=khoa&trangthai=${newStatus}&mand=${userId}`;
    window.location.href = url;
  }
</script>