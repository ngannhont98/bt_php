<?php
require_once 'ChiTietPhuc.php';
require_once 'ChiTietDon.php';
class May
{
    public $maMay;
    public $DS_chitietmay = [];
    public $sl_ChiTietMay;

    public function nhapMay(){
        while( empty($this->maMay) ) {
            $this->maMay = readline('Nhap ma may: ');
        }

        $this->sl_ChiTietMay = readline('Nhap so luong chi tiet may: ');
        while( empty($this->sl_ChiTietMay) || strval($this->sl_ChiTietMay) !== strval(intval($this->sl_ChiTietMay)) ) {
            $this->sl_ChiTietMay = readline('Nhap sai (Khong duoc bo trong va chi nhap so nguyen). Nhap lai: ');
        }


        for($i = 1 ; $i <= $this->sl_ChiTietMay ; $i++){
            echo "============================================================\n";
            $loai = readline("Nhap loai cua chi tiet may thu $i [1=>DON , 2=>PHUC]: ");
            while( empty($loai) || ($loai != 1 && $loai != 2) ) {
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
            $this->DS_chitietmay[$i] = $con;
        }
    }


    public function xuatMay(){
        echo "Ma may: " . $this->maMay . "\n";
        echo "So luong chi tiet may: " . $this->sl_ChiTietMay . "\n";
        for ($i = 1; $i <= $this->sl_ChiTietMay; $i++) {
            echo "========================= CHI TIET MAY THU $i =========================\n";

            if ($this->DS_chitietmay[$i]->loaiChiTiet === 'phuc'){
                $this->DS_chitietmay[$i]->xuatChiTiet();
            }
            if ($this->DS_chitietmay[$i]->loaiChiTiet === 'don'){
                $this->DS_chitietmay[$i]->xuatChiTietDon();
            }
        }

        echo "=======================================================================\n";
        $tien=$this->tinhTienMay();
        echo "TONG TIEN CUA MAY $this->maMay: ";
        echo str_pad($tien, 47, "-", STR_PAD_LEFT);
        echo "\n";

        $KL=$this->tinhKL_May();
        echo "TONG KHOI LUONG MAY $this->maMay: ";
        echo str_pad($KL, 40, "-", STR_PAD_LEFT);
        echo "\n";
    }


    public function tinhTienMay(){
        $tongTien = 0;
        foreach($this->DS_chitietmay as $chitietmay){
            if($chitietmay->loaiChiTiet == 'don'){
                $tongTien = $tongTien + $chitietmay->tinhTien();
            }
            if($chitietmay->loaiChiTiet == 'phuc'){
                $tongTien = $tongTien + $chitietmay->tinhTienPhuc();
            }
        }
        return $tongTien;
    }


    public function tinhKL_May(){
        $tongKL = 0;
        foreach($this->DS_chitietmay as $chitietmay){
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


//$ct = new May();
//$ct->nhapMay();echo "\n";
//print_r($ct->xuatMay());echo "\n";
//print_r($ct->tinhTienMay());echo "\n";
//print_r($ct->tinhKL_May());echo "\n";
