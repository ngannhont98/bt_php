<?php
require_once 'May.php';

class Kho
{
    public $maKho;
    public $DS_May = [];

    public function nhapKho()
    {
        while (empty($this->maKho)) {
            $this->maKho = readline('Nhap ma kho: ');
        }


        $soluongMay = readline('Nhap so luong may trong kho: ');
        while( empty($soluongMay) || strval($soluongMay) !== strval(intval($soluongMay)) ){
            $soluongMay = readline('Nhap sai (Khong duoc bo trong va chi nhap so nguyen). Nhap lai: ');
        }

        for ($i = 1; $i <= $soluongMay; $i++) {
            echo "============================================================= \n";
            echo "Nhap may thu $i: \n";
            $may = new May();
            $may->nhapMay();
            $this->DS_May[] = $may;
        }
    }

    public function xuatKho()
    {
        return [
            'maKho' => $this->maKho,
            'DS_may' => $this->DS_May
        ];
    }

    public function tinhTienKho()
    {
        $tongTien = 0;
        foreach ($this->DS_May as $May) {
            $tongTien = $tongTien + $May->tinhTienMay();
        }
        return $tongTien;
    }

    public function tinhKL_Kho()
    {
        $tongKL = 0;
        foreach ($this->DS_May as $May) {
            $tongKL = $tongKL + $May->tinhKL_May();
        }
        return $tongKL;
    }
}

$kho = new Kho();
$kho->nhapKho();
echo "\n";
print_r($kho->xuatKho());
echo "\n Tong KL la: ";
print_r($kho->tinhKL_Kho());
echo "\n Tong tien: ";
print_r($kho->tinhTienKho());