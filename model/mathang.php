<?php
class MATHANG
{
    // khai báo các thuộc tính
    private $id;
    private $tenmathang;
    private $tacgia;
    private $mota;
    private $giagoc;
    private $soluongton;
    private $hinhanh;
    private $danhmuc_id;
    private $luotxem;
    private $luotmua;
    private $id_khuyenmai;

    public function getid()
    {
        return $this->id;
    }
    public function setid($value)
    {
        $this->id = $value;
    }
    public function gettenmathang()
    {
        return $this->tenmathang;
    }
    public function settenmathang($value)
    {
        $this->tenmathang = $value;
    }
    public function gettacgia()
    {
        return $this->tacgia;
    }
    public function settacgia($value)
    {
        $this->tacgia = $value;
    }
    public function getmota()
    {
        return $this->mota;
    }
    public function setmota($value)
    {
        $this->mota = $value;
    }
    public function getgiagoc()
    {
        return $this->giagoc;
    }
    public function setgiagoc($value)
    {
        $this->giagoc = $value;
    }
    public function getsoluongton()
    {
        return $this->soluongton;
    }
    public function setsoluongton($value)
    {
        $this->soluongton = $value;
    }
    public function gethinhanh()
    {
        return $this->hinhanh;
    }
    public function sethinhanh($value)
    {
        $this->hinhanh = $value;
    }
    public function getdanhmuc_id()
    {
        return $this->danhmuc_id;
    }
    public function setdanhmuc_id($value)
    {
        $this->danhmuc_id = $value;
    }
    public function getluotxem()
    {
        return $this->luotxem;
    }
    public function setluotxem($value)
    {
        $this->luotxem = $value;
    }
    public function getluotmua()
    {
        return $this->luotmua;
    }
    public function setluotmua($value)
    {
        $this->luotmua = $value;
    }
    public function getid_khuyenmai()
    {
        return $this->id_khuyenmai;
    }
    public function setid_khuyenmai($value)
    {
        $this->id_khuyenmai = $value;
    }


    // Lấy danh sách
    public function laymathang()
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT * FROM mathang ORDER BY id DESC";
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

    // Lấy mặt hàng kèm khuyến mãi
    public function laymathangkhuyenmai()
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT  mh.*,
                            COALESCE(
                                mh.giagoc * (1 - km.phantramgiam / 100), 
                                mh.giagoc
                            ) AS giaban, km.tenkhuyenmai, km.ngaybatdau, km.ngayketthuc, km.phantramgiam
                    FROM mathang mh
                    LEFT JOIN 
                        khuyenmai km ON mh.id_khuyenmai = km.id
                    WHERE 
                        km.ngaybatdau <= CURDATE() AND km.ngayketthuc >= CURDATE()
                        OR mh.id_khuyenmai IS NULL";
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
    // Lấy danh sách mặt hàng thuộc 1 danh mục
    public function laymathangtheodanhmuc($danhmuc_id)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT * FROM mathang WHERE danhmuc_id=:madm";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":madm", $danhmuc_id);
            $cmd->execute();
            $result = $cmd->fetchAll();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Lấy mặt hàng theo danh muc kèm khuyến mãi
    public function laymathangkhuyenmaitheodanhmuc($danhmuc_id)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT  mh.*,
                            COALESCE(
                                mh.giagoc * (1 - km.phantramgiam / 100), 
                                mh.giagoc
                            ) AS giaban, km.tenkhuyenmai, km.ngaybatdau, km.ngayketthuc, km.phantramgiam
                    FROM mathang mh
                    LEFT JOIN 
                        khuyenmai km ON mh.id_khuyenmai = km.id
                    WHERE 
                        km.ngaybatdau <= CURDATE() AND km.ngayketthuc >= CURDATE()
                        OR mh.id_khuyenmai IS NULL
                        AND danhmuc_id=:madm";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":madm", $danhmuc_id);
            $cmd->execute();
            $result = $cmd->fetchAll();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Lấy mặt hàng theo id
    public function laymathangtheoid($id)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT * FROM mathang WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
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

    //Lấy mặt hàng theo id và khuyến mãi
    public function laymathangkhuyenmaitheoid($id)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT  mh.*,
                            COALESCE(
                                mh.giagoc * (1 - km.phantramgiam / 100), 
                                mh.giagoc
                            ) AS giaban, km.tenkhuyenmai, km.ngaybatdau, km.ngayketthuc, km.phantramgiam
                    FROM mathang mh
                    LEFT JOIN 
                        khuyenmai km ON mh.id_khuyenmai = km.id
                    WHERE
                        mh.id=:id";
            $cmd = $dbcon->prepare($sql);
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

    // Cập nhật lượt xem
    public function tangluotxem($id)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "UPDATE mathang SET luotxem=luotxem+1 WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":id", $id);
            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    // Lấy mặt hàng xem nhiều
    public function laymathangxemnhieu()
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT  mh.*,
                            COALESCE(
                                mh.giagoc * (1 - km.phantramgiam / 100), 
                                mh.giagoc
                            ) AS giaban, km.tenkhuyenmai, km.ngaybatdau, km.ngayketthuc, km.phantramgiam
                    FROM mathang mh
                    LEFT JOIN khuyenmai km ON mh.id_khuyenmai = km.id
                    WHERE 
                        (km.ngaybatdau <= CURDATE() AND km.ngayketthuc >= CURDATE())
                        OR mh.id_khuyenmai IS NULL
                    ORDER BY mh.luotxem DESC
                    LIMIT 3";
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

    // Thêm mới
    public function themmathang($mathang)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "INSERT INTO mathang(tenmathang,tacgia,mota,giagoc,soluongton,danhmuc_id,hinhanh,luotxem,luotmua,id_khuyenmai) 
                VALUES(:tenmathang,:tacgia,:mota,:giagoc,:soluongton,:danhmuc_id,:hinhanh,0,0,:id_khuyenmai)";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":tenmathang", $mathang->tenmathang);
            $cmd->bindValue(":tacgia", $mathang->tacgia);
            $cmd->bindValue(":mota", $mathang->mota);
            $cmd->bindValue(":giagoc", $mathang->giagoc);
            $cmd->bindValue(":soluongton", $mathang->soluongton);
            $cmd->bindValue(":danhmuc_id", $mathang->danhmuc_id);
            $cmd->bindValue(":hinhanh", $mathang->hinhanh);
            $cmd->bindValue(":id_khuyenmai", $mathang->id_khuyenmai);
            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Xóa 
    public function xoamathang($mathang)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "DELETE FROM mathang WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":id", $mathang->id);
            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Cập nhật 
    public function suamathang($mathang)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "UPDATE mathang SET tenmathang=:tenmathang,
                                        tacgia=:tacgia,
                                        mota=:mota,
                                        giagoc=:giagoc,
                                        soluongton=:soluongton,
                                        danhmuc_id=:danhmuc_id,
                                        hinhanh=:hinhanh,
                                        luotxem=:luotxem,
                                        luotmua=:luotmua,
                                        id_khuyenmai=:id_khuyenmai
                                        WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":tenmathang", $mathang->tenmathang);
            $cmd->bindValue(":tacgia", $mathang->tacgia);
            $cmd->bindValue(":mota", $mathang->mota);
            $cmd->bindValue(":giagoc", $mathang->giagoc);
            $cmd->bindValue(":soluongton", $mathang->soluongton);
            $cmd->bindValue(":danhmuc_id", $mathang->danhmuc_id);
            $cmd->bindValue(":hinhanh", $mathang->hinhanh);
            $cmd->bindValue(":luotxem", $mathang->luotxem);
            $cmd->bindValue(":luotmua", $mathang->luotmua);
            $cmd->bindValue(":id_khuyenmai", $mathang->id_khuyenmai);
            $cmd->bindValue(":id", $mathang->id);
            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Cập nhật số lượng tồn
    public function capnhatsoluong($id, $soluong)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "UPDATE mathang SET soluongton=soluongton - :soluong WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":soluong", $soluong);
            $cmd->bindValue(":id", $id);
            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Lấy số lượng tồn của mặt hàng
    public function laysoluongton($id)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT soluongton FROM mathang WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":id", $id);
            $result = $cmd->execute();
            $result = $cmd->fetch();
            return $result;
            return $result ? (int)$result['soluongton'] : 0;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Tìm kiếm theo tên
    public function timkiemtheoten($tenmathang)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT mh.*,
                            COALESCE(
                                mh.giagoc * (1 - km.phantramgiam / 100), 
                                mh.giagoc
                            ) AS giaban, km.tenkhuyenmai, km.ngaybatdau, km.ngayketthuc, km.phantramgiam
                    FROM 
                        mathang mh
                    LEFT JOIN 
                        khuyenmai km ON mh.id_khuyenmai = km.id
                    WHERE 
                        mh.tenmathang LIKE :tenmathang
                        AND (km.ngaybatdau <= CURDATE() AND km.ngayketthuc >= CURDATE() OR mh.id_khuyenmai IS NULL)";
            $cmd = $dbcon->prepare($sql);
            $tenmathang = "%" . $tenmathang . "%";
            $cmd->bindValue(":tenmathang", $tenmathang);
            $result = $cmd->execute();
            $result = $cmd->fetchAll();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
}
