<?php
require_once 'May.php';

class Kho
{
    public $maKho;
    public $DS_May = [];
    public $soluongMay;

    public function nhapKho()
    {
        while (empty($this->maKho)) {
            $this->maKho = readline('Nhap ma kho: ');
        }

        $this->soluongMay = readline('Nhap so luong may trong kho: ');
        while( empty($this->soluongMay) || strval($this->soluongMay) !== strval(intval($this->soluongMay)) ){
            $this->soluongMay = readline('Nhap sai (Khong duoc bo trong va chi nhap so nguyen). Nhap lai: ');
        }

        for ($i = 1; $i <= $this->soluongMay; $i++) {
            echo "================================================================\n";
            echo "Nhap may thu $i: \n";
            $may = new May();
            $may->nhapMay();
            $this->DS_May[$i] = $may;
        }
    }

    public function xuatKho()
    {
        echo "Ma kho: " . $this->maKho . "\n";
        echo "So luong may: " . $this->soluongMay . "\n";
        for ($i = 1; $i <= $this->soluongMay; $i++) {
            echo "\n";
            echo "============================================================================\n";
            echo "================================ MAY THU $i ================================\n";
            $this->DS_May[$i]->xuatMay();
        }

        echo "============================================================================\n";
        $tien=$this->tinhTienKho();
        echo "TONG TIEN CUA KHO $this->maKho: ";
        echo str_pad($tien, 47, "-", STR_PAD_LEFT);
        echo "\n";

        $KL=$this->tinhKL_Kho();
        echo "TONG KHOI LUONG KHO $this->maKho: ";
        echo str_pad($KL, 40, "-", STR_PAD_LEFT);
        echo "\n";
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
print_r($kho->xuatKho());
