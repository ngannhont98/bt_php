<?php


class ChiTietMay
{

    public $maChiTiet;

    public function nhapChiTiet()
    {
        while( empty($this->maChiTiet) ) {
            $this->maChiTiet = readline('Nhap ma chi tiet may: ');
        }
    }

    public function xuatChiTiet()
    {
       return $this->maChiTiet;
    }
}