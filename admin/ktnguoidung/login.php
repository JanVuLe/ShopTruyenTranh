<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Đăng Nhập - Shop Truyện Tranh</title>

	<link href="../custom/css/bootstrap.min.css" rel="stylesheet">
	<link href="../custom/font-awesome/css/font-awesome.css" rel="stylesheet">

	<link href="../custom/css/animate.css" rel="stylesheet">
	<link href="../custom/css/style.css" rel="stylesheet">
	<style>
		.image img {
			width: 300px;
			height: 300px;
			max-width: 100%;
			height: auto;
		}
	</style>
</head>

<body class="gray-bg">

	<div class="loginColumns animated fadeInDown">
		<div class="row">

			<div class="col-md-6">
				<h2 class="font-bold">XIN CHÀO!</h2>
				<div class="image"><img src="../custom/img/logo/logoShop.jpg" alt="Cửa Hàng Truyện Tranh"></div>
			</div>
			<div class="col-md-6">
				<h2 class="font-bold">ĐANG NHẬP TÀI KHOẢN</h2>
				<div class="ibox-content">
					<form class="m-t" role="form" action="index.php" method="post">
						<div class="form-group">
							<input class="form-control form-control-lg" type="email" name="txtemail" placeholder="Nhập email" />
						</div>
						<div class="form-group">
							<input class="form-control form-control-lg" type="password" name="txtmatkhau" placeholder="Nhập mật khẩu" />
						</div>
						<input type="hidden" name="action" value="xldangnhap">
						<input type="submit" class="btn btn-primary block full-width m-b" value="Đăng nhập">
						<br>
						<p class="text-muted text-center">
							<small>Bạn chưa có tài khoản?</small>
						</p>
						<a class="btn btn-sm btn-white btn-block" href="register.html">Tạo tài khoản</a>
					</form>
				</div>
			</div>
		</div>
		<hr />
		<div class="row">
			<div class="col-md-6">
				Cửa Hàng Truyện Tanh
			</div>
			<div class="col-md-6 text-right">
				<small>&copy; 2024</small>
			</div>
		</div>
	</div>

</body>

</html>