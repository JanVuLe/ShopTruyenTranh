<?php
require_once '../../model/donhang.php';
$donh = new DONHANG();
$result = $donh->diemdonhangmoi();
$donHangMoi = $donh->laydonhangmoi();
$soLuongDonHangMoi = $result['so_luong'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<title>Trang quản trị - Shop Truyện Tranh</title>
	<!-- link css -->
	<link href="../inc/css/app.css" rel="stylesheet">
	<link href="../inc/css/style.css" rel="stylesheet">
	<link href="../custom/css/customize.css?v=1.0" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
	<!-- script js -->
	<script src="../inc/js/app.js"></script>
	<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="">
					<span class="align-middle">Shop Truyện Tranh</span>
				</a>

				<ul class="sidebar-nav">
					<li class="sidebar-header text-info">
						HỆ THỐNG
					</li>

					<li class="sidebar-item <?php if (strpos($_SERVER['REQUEST_URI'], "ktnguoidung") != false) echo "active"; ?>">
						<a class="sidebar-link" href="../ktnguoidung/index.php">
							<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Bảng điều khiển</span>
						</a>
					</li>

					<?php if (isset($_SESSION["nguoidung"]) && $_SESSION["nguoidung"]["loai"] == 1) { ?>
						<li class="sidebar-item <?php if (strpos($_SERVER['REQUEST_URI'], "qlnguoidung") != false) echo "active"; ?>">
							<a class="sidebar-link" href="../qlnguoidung/index.php">
								<i class="align-middle" data-feather="users"></i> <span class="align-middle">Quản lý người dùng</span>
							</a>
						</li>
					<?php } ?>

					<li class="sidebar-header text-info">
						DANH MỤC
					</li>

					<li class="sidebar-item <?php if (strpos($_SERVER['REQUEST_URI'], "qldanhmuc") != false) echo "active"; ?>">
						<a class="sidebar-link" href="../qldanhmuc/index.php">
							<i class="align-middle" data-feather="grid"></i> <span class="align-middle">Quản lý danh mục</span>
						</a>
					</li>

					<li class="sidebar-item <?php if (strpos($_SERVER['REQUEST_URI'], "qlmathang") != false) echo "active"; ?>">
						<a class="sidebar-link" href="../qlmathang/index.php">
							<i class="align-middle" data-feather="package"></i> <span class="align-middle">Quản lý hàng hóa</span>
						</a>
					</li>

					<li class="sidebar-header text-info">
						KINH DOANH
					</li>

					<li class="sidebar-item <?php if (strpos($_SERVER['REQUEST_URI'], "qlkhachhang") != false) echo "active"; ?>">
						<a class="sidebar-link" href="../qlkhachhang/index.php">
							<i class="align-middle" data-feather="users"></i> <span class="align-middle">Quản lý khách hàng</span>
						</a>
					</li>

					<li class="sidebar-item <?php if (strpos($_SERVER['REQUEST_URI'], "qldonhang") != false) echo "active"; ?>">
						<a class="sidebar-link" href="../qldonhang/index.php">
							<i class="align-middle" data-feather="truck"></i> <span class="align-middle">Quản lý đơn hàng</span>
						</a>
					</li>

					<li class="sidebar-item <?php if (strpos($_SERVER['REQUEST_URI'], "qldoanhthu") != false) echo "active"; ?>">
						<a class="sidebar-link" href="../qldoanhthu/index.php">
							<i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Quản lý doanh thu</span>
						</a>
					</li>

					<li class="sidebar-item <?php if (strpos($_SERVER['REQUEST_URI'], "qlhuyenmai") != false) echo "active"; ?>">
						<a class="sidebar-link" href="../qlkhuyenmai/index.php">
							<i class="align-middle" data-feather="dollar-sign"></i> <span class="align-middle">Quản lý khuyến mãi</span>
						</a>
					</li>
				</ul>
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
					<i class="hamburger align-self-center"></i>
				</a>
				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
								<div class="position-relative">
									<i class="align-middle" data-feather="bell"></i>
									<span class="indicator"><?php echo $soLuongDonHangMoi; ?></span>
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
								<div class="dropdown-menu-header">
									<?php if ($soLuongDonHangMoi > 0): ?>
										<?php echo $soLuongDonHangMoi; ?> đơn hàng mới
									<?php else: ?>
										Không có đơn hàng mới
									<?php endif; ?>
								</div>
								<div class="list-group">
									<?php if (!empty($donHangMoi)) : ?>
										<?php foreach ($donHangMoi as $donHang) : ?>
											<a href="../ktnguoidung/index.php" class="list-group-item">
												<div class="row g-0 align-items-center">
													<div class="col-2">
														<i class="text-danger" data-feather="alert-circle"></i>
													</div>
													<div class="col-10">
														<div class="text-dark">Đơn hàng ID: <?= $donHang['id'] ?></div>
														<div class="text-muted small mt-1">
															Đặt lúc: <?= date('H:i:s', strtotime($donHang['ngay'])) ?>
														</div>
													</div>
												</div>
											</a>
										<?php endforeach; ?>
									<?php else : ?>
										<div class="text-muted small mt-1">Không có đơn hàng mới.</div>
									<?php endif; ?>
								</div>
								<div class="dropdown-menu-footer">
									<a href="#" class="text-muted">Tất cả đơn hàng</a>
								</div>
							</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
								<i class="align-middle" data-feather="settings"></i>
							</a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
								<img src="<?php if ($_SESSION["nguoidung"]["hinhanh"] == NULL) echo "../../images/users/user.png";
											else echo "../../images/users/" . $_SESSION["nguoidung"]["hinhanh"]; ?>" class="avatar img-fluid rounded me-1" />
								<span class="text-dark">Chào <?php if (isset($_SESSION["nguoidung"])) echo $_SESSION["nguoidung"]["hoten"];
																else echo "bạn"; ?></span>
							</a>
							<div class="dropdown-menu dropdown-menu-end">

								<a class="dropdown-item" href="../ktnguoidung/index.php?action=hoso">
									<i class="align-middle me-1" data-feather="user"></i> Hồ sơ cá nhân
								</a>
								<a class="dropdown-item" href="../ktnguoidung/index.php?action=matkhau">
									<i class="align-middle me-1" data-feather="key"></i> Đổi mật khẩu
								</a>

								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="../ktnguoidung/index.php?action=dangxuat"><i class="align-middle me-1" data-feather="log-out"></i> Đăng xuất</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>

			<main class="content">
				<div class="container-fluid p-0">