<?php
require_once 'ChiTietMay.php';
require_once 'ChiTietDon.php';

class ChiTietPhuc extends ChiTietMay
{
    public $loaiChiTiet = 'phuc';
    public $DS_ChiTietCon = [];
    public $soluongChiTiet;

    public function nhapChiTiet()
    {
        parent::nhapChiTiet();

        $this->soluongChiTiet = readline('Nhap so luong chi tiet con cua chi tiet phuc: ');
        while( empty($this->soluongChiTiet) || strval($this->soluongChiTiet) !== strval(intval($this->soluongChiTiet)) ) {
            $this->soluongChiTiet = readline('Nhap sai (Khong duoc bo trong va chi nhap so nguyen). Nhap lai: ');
        }


        for ($i = 1; $i <= $this->soluongChiTiet; $i++) {
            echo "========================================================\n";
            $loai = readline("Nhap loai cua chi tiet phuc thu $i [1=>DON ; 2=>PHUC]: ");
            while( empty($loai) || (($loai != 1) && ($loai != 2)) ) {
                $loai = readline("Nhap sai (Khong duoc bo trong va chi nhap 1 hoac 2). Nhap lai: [1=>DON ; 2=>PHUC]: ");
            }

            $con = null;
            if ($loai == 1) {
                $con = new ChiTietDon();
            }
            if ($loai == 2) {
                $con = new ChiTietPhuc();
            }
            $con->nhapChiTiet();
            $this->DS_ChiTietCon[$i] = $con;
        }
    }

    public function xuatChiTiet()
    {
        parent::xuatChiTiet();
        echo "Loai chi tiet: " . $this->loaiChiTiet . "\n";
        echo "So luong chi tiet con cua chi tiet phuc: " . $this->soluongChiTiet . "\n";
        for ($i = 1; $i <= $this->soluongChiTiet; $i++) {
            echo "==================== CHI TIET CON THU $i ====================\n";

            if ($this->DS_ChiTietCon[$i]->loaiChiTiet === 'phuc'){
                $this->DS_ChiTietCon[$i]->xuatChiTiet();
            }
            if ($this->DS_ChiTietCon[$i]->loaiChiTiet === 'don'){
                $this->DS_ChiTietCon[$i]->xuatChiTietDon();
            }
        }
    }

    public function tinhTienPhuc(){
        $tongTien = 0;
        foreach($this->DS_ChiTietCon as $chitietmay){
            if($chitietmay->loaiChiTiet == 'don'){
                $tongTien = $tongTien + $chitietmay->tinhTien();
            }
            if($chitietmay->loaiChiTiet == 'phuc'){
                $tongTien = $tongTien + $chitietmay->tinhTienPhuc();
            }
        }
        return $tongTien;
    }

    public function tinhKL_Phuc(){
        $tongKL = 0;
        foreach($this->DS_ChiTietCon as $chitietmay){
            if($chitietmay->loaiChiTiet == 'don'){
                $tongKL = $tongKL + $chitietmay->tinhKhoiLuong();
            }
            if($chitietmay->loaiChiTiet == 'phuc'){
                $tongKL = $tongKL + $chitietmay->tinhKL_Phuc();
            }
        }
        return $tongKL;
    }
}
