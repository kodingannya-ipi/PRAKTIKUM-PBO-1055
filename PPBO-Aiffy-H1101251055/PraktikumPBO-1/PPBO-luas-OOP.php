<?php

class persegi_panjang {
    public $panjang;
    public $lebar;

    public function __construct($panjang, $lebar) {
        $this->panjang = $panjang;
        $this->lebar = $lebar;
    }

    public function hitung_luas() {
        return $this->panjang * $this->lebar;
    }
}

$bangun = new persegi_panjang(7, 4);
$luas = $bangun->hitung_luas();

echo "Luas persegi panjang dengan panjang {$bangun->panjang} cm dan lebar {$bangun->lebar} cm adalah: $luas cm²";

?>