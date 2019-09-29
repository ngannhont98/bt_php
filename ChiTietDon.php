<?php
require_once 'ChiTietMay.php';

class ChiTietDon extends ChiTietMay
{
    public $loaiChiTiet = 'don';
    public $giaTien;
    public $khoiLuong;

    public function nhapChiTiet()
    {
        parent::nhapChiTiet();

        $this->giaTien = readline('Nhap gia tien: ');
        while( empty($this->giaTien) || strval($this->giaTien) !== strval(intval($this->giaTien)) ) {
            $this->giaTien = readline('Nhap sai (Khong duoc bo trong va chi nhap so nguyen). Nhap lai: ');
        }

        $this->khoiLuong = readline('Nhap khoi luong: ');
        while( empty($this->khoiLuong) || !is_numeric($this->khoiLuong) ) {
            $this->khoiLuong = readline('Nhap sai (Khong duoc bo trong va chi nhap so). Nhap lai: ');
        }
    }

    public function xuatChiTietDon()
    {
        parent::xuatChiTiet();
        echo "Loai chi tiet: " . $this->loaiChiTiet . "\n";
        echo "Gia tien: " . $this->giaTien . "\n";
        echo "Khoi luong: " . $this->khoiLuong . "\n";
    }

    public function tinhTien()
    {
        return $this->giaTien;
    }

    public function tinhKhoiLuong()
    {
        return $this->khoiLuong;
    }

}