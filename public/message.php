<?php include("inc/top.php"); ?>

<br><br>
<div class="container">
  <div class="row">
    <h4 class="text-info">Cảm ơn quý khách!</h4>
    <div class="text-warning">
      <p>Đơn hàng mã số <?php echo $donhang_id; ?> trị giá <strong><?php echo number_format($tongtien) ?>đ</strong> sẽ được giao đến quý khách trong thời gian sớm nhất.
    </div>
    <p>
    <p><a href="index.php?action=thongtin&mand=<?php echo $_SESSION["khachhang"]["id"]; ?>">Danh sách đơn hàng</a></p>
  </div>
</div>

<?php include("inc/bottom.php"); ?>