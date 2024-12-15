<?php
class DONHANG
{
	private $id;
	private $nguoidung_id;
	private $diachi_id;
	private $ngay;
	private $tongtien;
	private $ghichu;
	private $trangthai;

	public function getid()
	{
		return $this->id;
	}
	public function setid($value)
	{
		$this->id = $value;
	}
	public function getnguoidung_id()
	{
		return $this->nguoidung_id;
	}
	public function setnguoidung_id($value)
	{
		$this->nguoidung_id = $value;
	}
	public function getdiachi_id()
	{
		return $this->diachi_id;
	}
	public function setdiachi_id($value)
	{
		$this->diachi_id = $value;
	}
	public function getngay()
	{
		return $this->ngay;
	}
	public function setngay($value)
	{
		$this->ngay = $value;
	}
	public function gettongtien()
	{
		return $this->tongtien;
	}
	public function settongtien($value)
	{
		$this->tongtien = $value;
	}
	public function getghichu()
	{
		return $this->ghichu;
	}
	public function setghichu($value)
	{
		$this->ghichu = $value;
	}
	public function gettrangthai()
	{
		return $this->trangthai;
	}
	public function settrangthai($value)
	{
		$this->trangthai = $value;
	}


	// Thêm đơn hàng mới, trả về khóa của dòng mới thêm
	public function themdonhang($nguoidung_id, $diachi_id, $tongtien)
	{
		$db = DATABASE::connect();
		try {
			$sql = "INSERT INTO donhang(nguoidung_id, diachi_id, tongtien) 
					VALUES(:nguoidung_id,:diachi_id,:tongtien)";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(':nguoidung_id', $nguoidung_id);
			$cmd->bindValue(':diachi_id', $diachi_id);
			$cmd->bindValue(':tongtien', $tongtien);
			$cmd->execute();
			$id = $db->lastInsertId();
			return $id;
		} catch (PDOException $e) {
			$error_message = $e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}
	// Lấy đơn hàng
	public function laydonhang()
	{
		$dbcon = DATABASE::connect();
		try {
			$sql = "SELECT dh.*, nd.hoten, dc.diachi 
					FROM donhang dh, nguoidung nd, diachi dc 
					WHERE dh.nguoidung_id = nd.id AND dh.diachi_id = dc.id;";
			$cmd = $dbcon->prepare($sql);
			$cmd->execute();
			$result = $cmd->fetchAll();
			return $result;
		} catch (PDOException $e) {
			$error_message = $e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}

	// Lấy đơn hàng theo id người dùng
	public function laydonhangtheoidnguoidung($nguoidung_id)
	{
		$dbcon = DATABASE::connect();
		try {
			$sql = "SELECT dh.*, nd.hoten, dc.diachi 
					FROM donhang dh, nguoidung nd, diachi dc 
					WHERE dh.nguoidung_id = nd.id AND dh.diachi_id = dc.id AND nd.id = :mand";
			$cmd = $dbcon->prepare($sql);
			$cmd->bindValue(":mand", $nguoidung_id);
			$cmd->execute();
			$result = $cmd->fetchAll();
			return $result;
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
			$sql = "UPDATE donhang set trangthai=:trangthai where id=:id";
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
}
