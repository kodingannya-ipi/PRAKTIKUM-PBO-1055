<?php

class Mobil {
    private $merk;
    private $warna;
    private $kecepatan;

    public function __construct($merk, $warna, $kecepatan) {
        $this->merk = $merk;
        $this->setWarna($warna);
        $this->setKecepatan($kecepatan);
    }

    public function getMerk() { return $this->merk; }
    public function getWarna() { return $this->warna; }
    public function getKecepatan() { return $this->kecepatan; }
    public function setKecepatan($kecepatan) {
        if ($kecepatan < 0) {
            echo "Kecepatannya tidak boleh negatif, diganti ke 0 km/jam.<br>";
            $this->kecepatan = 0;
            return false;
        }
        if ($kecepatan > 200) {
            echo "Kecepatannya maksimal 200 km/jam, diganti ke 200 km/jam.<br>";
            $this->kecepatan = 200;
            return false;
        }
        $this->kecepatan = $kecepatan;
        return true;
    }

    public function setWarna($warna) {
        $warna = trim($warna);
        if ($warna === "") {
            echo "Warnanya tidak boleh kosong, diganti ke 'Tidak Diketahui'.<br>";
            $this->warna = "Tidak Diketahui";
            return false;
        }
        if (strlen($warna) < 3) {
            echo "Warnanya minimal 3 karakter, diganti ke 'Tidak Diketahui'.<br>";
            $this->warna = "Tidak Diketahui";
            return false;
        }
        $this->warna = $warna;
        return true;
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

echo "<br>=== Informasi Mobil 1 ===<br>";
$mobil1->getInfo(); $mobil1->jalankan(); $mobil1->berhenti();

echo "<br>=== Informasi Mobil 2 ===<br>";
$mobil2->getInfo(); $mobil2->jalankan(); $mobil2->berhenti();

echo "<br>=== Informasi Mobil 3 ===<br>";
$mobil3->getInfo(); $mobil3->jalankan(); $mobil3->berhenti();

?>