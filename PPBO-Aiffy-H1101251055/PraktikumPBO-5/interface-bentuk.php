<?php

interface Bentuk {
    public function hitungLuas();
}

class Persegi implements Bentuk {
    private $sisi;

    public function __construct($sisi) {
        $this->sisi = $sisi;
    }

    public function hitungLuas() {
        return $this->sisi * $this->sisi;
    }
}

class Lingkaran implements Bentuk {
    private $radius;

    public function __construct($radius) {
        $this->radius = $radius;
    }

    public function hitungLuas() {
        return 3.14 * $this->radius * $this->radius;
    }
}

$bentukArray = [
    new Persegi(5),
    new Lingkaran(7)
];

foreach ($bentukArray as $bentuk) {
    $namaClass = get_class($bentuk);

    if ($namaClass === 'Persegi') {
        echo "Luas Persegi (sisi=5): " . $bentuk->hitungLuas();
    } elseif ($namaClass === 'Lingkaran') {
        echo "<br> Luas Lingkaran (radius=7): " . $bentuk->hitungLuas() . "<br>";
    }
}

?>