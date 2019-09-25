<?php
require_once 'ChiTietMay.php';
require_once 'ChiTietDon.php';

class ChiTietPhuc extends ChiTietMay
{
    public $loaiChiTiet = 'phuc';
    public $DS_ChiTietCon = [];

    public function nhapChiTiet()
    {
        parent::nhapChiTiet();

        $soluongChiTiet = readline('Nhap so luong chi tiet con cua chi tiet phuc: ');
        while( empty($soluongChiTiet) || strval($soluongChiTiet) !== strval(intval($soluongChiTiet)) ) {
            $soluongChiTiet = readline('Nhap sai (Khong duoc bo trong va chi nhap so nguyen). Nhap lai: ');
        }


        for ($i = 1; $i <= $soluongChiTiet; $i++) {
            $loai = readline("Nhap loai cua chi tiet thu $i [1=>DON ; 2=>PHUC]: ");
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
            $this->DS_ChiTietCon[] = $con;
        }
    }

    public function xuatChiTiet()
    {
        return [
            'maChiTiet' => parent::xuatChiTiet(),
            'loaiChiTiet' => $this->loaiChiTiet,
            'ds_ChiTietCon' => $this->DS_ChiTietCon
        ];
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

    public function tinhKL(){
        $tongKL = 0;
        foreach($this->DS_ChiTietCon as $chitietmay){
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
