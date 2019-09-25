<?php
require_once 'ChiTietPhuc.php';
require_once 'ChiTietDon.php';
class May
{
    public $maMay;
    public $DS_chitietmay = [];

    public function nhapMay(){
        while( empty($this->maMay) ) {
            $this->maMay = readline('Nhap ma may: ');
        }

        $sl_ChiTietMay = readline('Nhap so luong chi tiet may: ');
        while( empty($sl_ChiTietMay) || strval($sl_ChiTietMay) !== strval(intval($sl_ChiTietMay)) ) {
            $sl_ChiTietMay = readline('Nhap sai (Khong duoc bo trong va chi nhap so nguyen). Nhap lai: ');
        }


        for($i = 1 ; $i <= $sl_ChiTietMay ; $i++){
            echo "======================================================\n";
            $loai = readline("Nhap loai chi tiet thu $i [1=>DON , 2=>PHUC]: ");
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
            $this->DS_chitietmay[] = $con;
        }
    }


    public function xuatMay(){
        return [
           'maMay' => $this->maMay,
           'DS_chitietmay' => $this->DS_chitietmay
        ];
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
                $tongKL = $tongKL + $chitietmay->tinhKL();
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
