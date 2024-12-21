<?php
class KHUYENMAI
{
    // khai báo các thuộc tính
    private $id;
    private $tenkhuyenmai;
    private $mota;
    private $ngaybatdau;
    private $ngayketthuc;
    private $phantramgiam;

    public function getid()
    {
        return $this->id;
    }
    public function setid($value)
    {
        $this->id = $value;
    }
    public function gettenkhuyenmai()
    {
        return $this->tenkhuyenmai;
    }
    public function settenkhuyenmai($value)
    {
        $this->tenkhuyenmai = $value;
    }
    public function getmota()
    {
        return $this->mota;
    }
    public function setmota($value)
    {
        $this->mota = $value;
    }
    public function getngaybatdau()
    {
        return $this->ngaybatdau;
    }
    public function setngaybatdau($value)
    {
        $this->ngaybatdau = $value;
    }
    public function getngayketthuc()
    {
        return $this->ngayketthuc;
    }
    public function setngayketthuc($value)
    {
        $this->ngayketthuc = $value;
    }
    public function getphantramgiam()
    {
        return $this->phantramgiam;
    }
    public function setphantramgiam($value)
    {
        $this->phantramgiam = $value;
    }



    // Lấy danh sách
    public function laykhuyenmai()
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT * FROM khuyenmai";
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

    // Lấy khuyến mãi theo id
    public function laykhuyenmaitheoid($id)
    {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT * FROM khuyenmai WHERE id=:id;";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":id", $id);
            $cmd->execute();
            $result = $cmd->fetch();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Thêm mặt hàng
    public function themkhuyenmai($khuyenmai)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "INSERT INTO khuyenmai(tenkhuyenmai,mota,ngaybatdau,ngayketthuc,phantramgiam)
                        VALUES(:tenkhuyenmai,:mota,:ngaybatdau,:ngayketthuc,:phantramgiam)";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":tenkhuyenmai", $khuyenmai->tenkhuyenmai);
            $cmd->bindValue(":mota", $khuyenmai->mota);
            $cmd->bindValue(":ngaybatdau", $khuyenmai->ngaybatdau);
            $cmd->bindValue(":ngayketthuc", $khuyenmai->ngayketthuc);
            $cmd->bindValue(":phantramgiam", $khuyenmai->phantramgiam);
            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Xóa khuyến mãi
    public function xoakhuyenmai($id)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "DELETE FROM khuyenmai WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindParam(':id', $id);
            $cmd->execute();
            return $cmd;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Sửa khuyến mãi
    public function suakhuyenmai($khuyenmai)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "UPDATE khuyenmai 
                    SET tenkhuyenmai = :tenkhuyenmai, 
                        mota = :mota, 
                        ngaybatdau = :ngaybatdau, 
                        ngayketthuc = :ngayketthuc, 
                        phantramgiam = :phantramgiam
                    WHERE id = :id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":id", $khuyenmai->id);
            $cmd->bindValue(":tenkhuyenmai", $khuyenmai->tenkhuyenmai);
            $cmd->bindValue(":mota", $khuyenmai->mota);
            $cmd->bindValue(":ngaybatdau", $khuyenmai->ngaybatdau);
            $cmd->bindValue(":ngayketthuc", $khuyenmai->ngayketthuc);
            $cmd->bindValue(":phantramgiam", $khuyenmai->phantramgiam);
            return $cmd->execute();
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Tìm kiếm theo tên
    public function timkiemtheoten($tenkhuyenmai)
    {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT * FROM khuyenmai WHERE tenkhuyenmai LIKE :tenkhuyenmai;";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":tenkhuyenmai", "%$tenkhuyenmai%");
            $cmd->execute();
            $ketqua = $cmd->fetchAll();
            return $ketqua;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
}
