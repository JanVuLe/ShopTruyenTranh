            </div>
            </section>

            <!-- Top products -->

            <section class="py-5">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-6">
                    <?php include("inc/carousel.php"); ?>
                  </div>
                  <div class="col-md-6 pt-2">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#menu1">Nổi bật</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#menu2">Xem nhiều</a>
                      </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                      <div id="menu1" class="container tab-pane active"><br>

                        <?php include("inc/topview.php"); ?>

                      </div>
                      <div id="menu2" class="container tab-pane fade"><br>
                        <h3>Sản phẩm xem nhiều</h3>
                        <p>Đang cập nhật...</p>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>

            <!-- Footer-->
            <footer class="py-5 bg-dark">
              <div class="text-center mb-5"><a class="text-warning" href="#top"><i class="bi bi-chevron-up" style="font-size: 3rem; font-weight: bold; color:white;"></i></a></div>
              <div class="container">
                <div class="row">
                  <div class="col-md-6 text-light">
                    <a href="index.php" class="text-decoration-none text-white">
                      <div style="font-size: 30px;">
                        <img src="../images/logo/logoPPT.png" alt="Logo" style="width: 160px; height: 130px;">
                        Cửa Hàng Truyên Tranh
                      </div>
                    </a>
                    <p><b><i class="bi bi-geo-alt"> Địa chỉ:</i></b> xã Hòa An, huyện Chợ Mới, An Giang<br>
                      <b><i class="bi bi-phone"> Điện thoại:</i></b> 078 3839516<br>
                      <b><i class="bi bi-envelope"> Email:</i></b> vu_dth216249@student.agu.edu.vn
                    </p>
                  </div>
                  <div class="col-md-3 text-white">
                    <h4>DANH MỤC HÀNG</h4>
                    <?php foreach ($danhmuc as $d): ?>
                      <a class="list-group-item" href="?action=group&id=<?php echo $d["id"]; ?>">
                        <?php echo $d["tendanhmuc"]; ?>
                      </a>
                    <?php endforeach; ?>
                  </div>
                  <div class="col-md-3 text-white">
                    <h4>DỊCH VỤ KHÁCH HÀNG</h4>
                    <a href="#" class="list-group-item">Hướng dẫn mua hàng</a>
                    <a href="#" class="list-group-item">Câu hỏi thường gặp</a>
                    <a href="#" class="list-group-item">Liên hệ với chúng tôi</a>
                  </div>
                </div>
                <hr class="text-light border-2">
                <p class="m-0 text-center text-warning fw-bolder">Copyright &copy; Cửa hàng truyện tranh 2024</p>
              </div>
            </footer>
            <!-- Mainly scripts -->
            <script src="inc/js/jquery-3.1.1.min.js"></script>
            <script src="inc/js/bootstrap.min.js"></script>
            <script src="inc/js/plugins/metisMenu/jquery.metisMenu.js"></script>
            <script src="inc/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

            <!-- Custom and plugin javascript -->
            <script src="inc/js/inspinia.js"></script>
            <script src="inc/js/plugins/pace/pace.min.js"></script>

            <!-- Flot -->
            <script src="inc/js/plugins/flot/jquery.flot.js"></script>
            <script src="inc/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
            <script src="inc/js/plugins/flot/jquery.flot.resize.js"></script>

            <!-- ChartJS-->
            <script src="inc/js/plugins/chartJs/Chart.min.js"></script>

            <!-- Peity -->
            <script src="inc/js/plugins/peity/jquery.peity.min.js"></script>
            <!-- Peity demo -->
            <script src="inc/js/demo/peity-demo.js"></script>
            </body>

            </html>