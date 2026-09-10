<?php

class Mobil {
    public $merk;
    public $warna;
    public $kecepatan;

    public function __construct($merk, $warna, $kecepatan) {
        $this->merk = $merk;
        $this->warna = $warna;
        $this->kecepatan = $kecepatan;
    }

    public function getInfo() {
        echo "Merk: " . $this->merk . "<br>";
        echo "Warna: " . $this->warna . "<br>";
        echo "Kecepatan: " . $this->kecepatan . " km/jam<br>";
    }

    public function jalankan() {
        echo " Brum brum.. mobil " . $this->merk . " sedang berjalan dengan kecepatan " . $this->kecepatan . " km/jam.<br>";
    }

    public function berhenti() {
        echo " Etss.. mobil " . $this->merk . " berhenti.<br>";
    }

    public function __destruct() {
        echo " <br> Objek mobil " . $this->merk . " telah dihancurkan.";
    }
}

$mobil1 = new Mobil("Porsche Carrera 911", "Biru", 294);
$mobil2 = new Mobil("BMW M5", "Hitam", 315);
$mobil3 = new Mobil("Rolls Royce Phantom", "Hitam", 250);

echo "=== Informasi Mobil 1 ===<br>";
$mobil1->getInfo();
$mobil1->jalankan();
$mobil1->berhenti();

echo "<br>=== Informasi Mobil 2 ===<br>";
$mobil2->getInfo();
$mobil2->jalankan();
$mobil2->berhenti();

echo "<br>=== Informasi Mobil 3 ===<br>";
$mobil3->getInfo();
$mobil3->jalankan();
$mobil3->berhenti();

?>