<!DOCTYPE html>
<html>

<?php include('../ktnguoidung/head.php') ?>

<body class="gray-bg">

	<div class="loginColumns animated fadeInDown">
		<div class="row">

			<div class="col-md-6">
				<h2 class="font-bold">XIN CHÀO!</h2>
				<div class="image"><img src="../custom/img/logo/logoShop.jpg" alt="Cửa Hàng Truyện Tranh"></div>
			</div>
			<div class="col-md-6">
				<h2 class="font-bold">ĐANG NHẬP TÀI KHOẢN</h2>
				<?php if (!empty($tb)): ?>
					<div class="alert alert-danger text-center" role="alert">
						<?php echo htmlspecialchars($tb); ?>
					</div>
				<?php endif; ?>
				<div class="ibox-content">
					<form class="m-t" role="form" action="index.php" method="post" id="mainForm">
						<div class="form-group">
							<input class="form-control form-control-lg" type="email" name="txtemail" placeholder="Nhập email" />
						</div>
						<div class="form-group">
							<input class="form-control form-control-lg" type="password" name="txtmatkhau" placeholder="Nhập mật khẩu" />
						</div>
						<input type="hidden" name="action" id="actionField" value="">
						<button type="button" class="btn btn-primary block full-width m-b" id="loginBtn">Đăng nhập</button>
						<!-- <input type="hidden" name="action" value="xldangnhap">
						<input type="submit" class="btn btn-primary block full-width m-b" value="Đăng nhập"> -->
						<a class="text-muted text-center" href="">Quên mật khẩu?</a>
						<br>
						<br>
						<p class="text-muted text-center">
							<small>Bạn chưa có tài khoản?</small>
						</p>

						<button type="button" class="btn btn-sm btn-white block full-width m-b" id="registerBtn">Đăng ký</button>
						<!-- <input type="submit" class="btn btn-sm btn-white block full-width m-b" value="Đăng ký">
						<input type="hidden" name="action" value="dangky"> -->
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
	<script>
		document.getElementById('loginBtn').addEventListener('click', function() {
			document.getElementById('actionField').value = 'xldangnhap'; // Đặt giá trị action cho đăng nhập
			document.getElementById('mainForm').submit(); // Gửi biểu mẫu
		});

		document.getElementById('registerBtn').addEventListener('click', function() {
			document.getElementById('actionField').value = 'dangky'; // Đặt giá trị action cho đăng ký
			document.getElementById('mainForm').submit(); // Gửi biểu mẫu
		});
	</script>
</body>

</html>