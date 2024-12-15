<?php
class DONHANGCT
{
	private $id;
	private $donhang_id;
	private $mathang_id;
	private $dongia;
	private $soluong;
	private $thanhtien;

	public function getid()
	{
		return $this->id;
	}
	public function setid($value)
	{
		$this->id = $value;
	}
	public function getdonhang_id()
	{
		return $this->donhang_id;
	}
	public function setdonhang_id($value)
	{
		$this->donhang_id = $value;
	}
	public function getmathang_id()
	{
		return $this->mathang_id;
	}
	public function setmathang_id($value)
	{
		$this->mathang_id = $value;
	}
	public function getdongia()
	{
		return $this->dongia;
	}
	public function setdongia($value)
	{
		$this->dongia = $value;
	}
	public function getsoluong()
	{
		return $this->soluong;
	}
	public function setsoluong($value)
	{
		$this->soluong = $value;
	}
	public function getthanhtien()
	{
		return $this->thanhtien;
	}
	public function setthanhtien($value)
	{
		$this->thanhtien = $value;
	}

	// Thêm chi tiết đơn hàng mới, trả về khóa của dòng mới thêm
	public function themchitietdonhang($donhang_id, $mathang_id, $dongia, $soluong, $thanhtien)
	{
		$db = DATABASE::connect();
		try {
			$sql = "INSERT INTO donhangct(donhang_id, mathang_id, dongia, soluong, thanhtien) 
					VALUES(:donhang_id, :mathang_id, :dongia, :soluong, :thanhtien)";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(':donhang_id', $donhang_id);
			$cmd->bindValue(':mathang_id', $mathang_id);
			$cmd->bindValue(':dongia', $dongia);
			$cmd->bindValue(':soluong', $soluong);
			$cmd->bindValue(':thanhtien', $thanhtien);
			$cmd->execute();
			$id = $db->lastInsertId();
			return $id;
		} catch (PDOException $e) {
			$error_message = $e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}

	// Lấy chi tiết đơn hàng
	function layctdonhang()
	{
		$dbcon = DATABASE::connect();
		try {
			$sql = "SELECT donhangct.*, mathang.tenmathang, mathang.hinhanh
					FROM donhangct, mathang
					WHERE donhangct.mathang_id = mathang.id";
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

	// Lấy chi tiết đơn hàng theo đơn hàng id
	public function layctdonhangtheodonhang($donhang_id)
	{
		$dbcon = DATABASE::connect();
		try {
			$sql = "SELECT donhangct.*, mathang.tenmathang, mathang.hinhanh
					FROM donhangct, mathang
					WHERE donhangct.mathang_id = mathang.id AND donhangct.donhang_id = :madh";
			$cmd = $dbcon->prepare($sql);
			$cmd->bindValue(":madh", $donhang_id);
			$cmd->execute();
			$result = $cmd->fetchAll();
			return $result;
		} catch (PDOException $e) {
			$error_message = $e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}
}
