<?php
class KHACHHANG
{

	// Thêm khách hàng mới, trả về khóa của dòng mới thêm
	public function themkhachhang($email, $sodt, $hoten)
	{
		$db = DATABASE::connect();
		try {
			$sql = "INSERT INTO nguoidung(email,matkhau,sodienthoai,hoten,loai,trangthai) VALUES(:email,:matkhau,:sodt,:hoten,3,1)";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(':email', $email);
			$cmd->bindValue(':matkhau', md5($sodt));
			$cmd->bindValue(':sodt', $sodt);
			$cmd->bindValue(':hoten', $hoten);
			$cmd->execute();
			$id = $db->lastInsertId();
			return $id;
		} catch (PDOException $e) {
			$error_message = $e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}
	// Xóa khách hàng
	public function xoakhachhang($mand)
	{
		$db = DATABASE::connect();
		try {
			$sql = "DELETE FROM nguoidung WHERE id = :mand";
			$cmd = $db->prepare($sql);
			$cmd->bindParam(':mand', $mand);
			$cmd->execute();
			return $cmd;
		} catch (PDOException $e) {
			$error_message = $e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}
	// Cập nhật thông tin khách hàng
	public function capnhatkhachhang($mand, $email, $sodt, $hoten)
	{
		$db = DATABASE::connect();
		try {
			$sql = "UPDATE nguoidung SET email = :email, sodienthoai = :sodt, hoten = :hoten WHERE id = :mand";
			$cmd = $db->prepare($sql);
			$cmd->bindParam(':email', $email);
			$cmd->bindParam(':sodt', $sodt);
			$cmd->bindParam(':hoten', $hoten);
			$cmd->bindParam(':mand', $mand);
			$cmd->execute();
			return $cmd;
		} catch (PDOException $e) {
			$error_message = $e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}
	public function kiemtrakhachhanghople($email, $matkhau)
	{
		$db = DATABASE::connect();
		try {
			$sql = "SELECT * FROM nguoidung WHERE email=:email AND matkhau=:matkhau AND trangthai=1 AND loai=3";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(":email", $email);
			$cmd->bindValue(":matkhau", md5($matkhau));
			$cmd->execute();
			$valid = ($cmd->rowCount() == 1);
			$cmd->closeCursor();
			return $valid;
		} catch (PDOException $e) {
			$error_message = $e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}

	// lấy thông tin người dùng có $email
	public function laythongtinkhachhang($email)
	{
		$db = DATABASE::connect();
		try {
			$sql = "SELECT * FROM nguoidung WHERE email=:email AND loai=3";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(":email", $email);
			$cmd->execute();
			$ketqua = $cmd->fetch();
			$cmd->closeCursor();
			return $ketqua;
		} catch (PDOException $e) {
			$error_message = $e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}

	// Lấy khách hàng
	public function laykhachhang()
	{
		$db = DATABASE::connect();
		try {
			$sql = "SELECT * FROM nguoidung WHERE loai=3";
			$cmd = $db->prepare($sql);
			$cmd->execute();
			$ketqua = $cmd->fetchAll();
			$cmd->closeCursor();
			return $ketqua;
		} catch (PDOException $e) {
			$error_message = $e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}

	// Đổi trạng thái
	public function doitrangthai($id, $trangthai)
	{
		$db = DATABASE::connect();
		try {
			$sql = "UPDATE nguoidung set trangthai=:trangthai where id=:id";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(':id', $id);
			$cmd->bindValue(':trangthai', $trangthai);
			$ketqua = $cmd->execute();
			return $ketqua;
		} catch (PDOException $e) {
			$error_message = $e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}

	//Tìm kiếm khách hàng theo tên
	public function timkiemtheoemail($email)
	{
		$db = DATABASE::connect();
		try {
			$sql = "SELECT * FROM nguoidung WHERE email=:email";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(":email", $email);
			$cmd->execute();
			$ketqua = $cmd->fetchAll();
			$cmd->closeCursor();
			return $ketqua;
		} catch (PDOException $e) {
			$error_message = $e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}
}
