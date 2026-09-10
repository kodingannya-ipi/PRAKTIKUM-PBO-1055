<?php

class Product {

    public $nama;
    public $harga;
    public $kategori;

    public function __construct($nama, $harga, $kategori) {
        $this->nama = $nama;
        $this->harga = $harga;
        $this->kategori = $kategori;
        echo "Ting! produk $this->nama ditambahkan.<br>";
    }

    public function getInfo() {
        return "Nama: $this->nama, Kategori: $this->kategori, Harga: Rp" . number_format($this->harga, 0, ',', '.');
    }

    public function applyDiskon($persen) {
        $potongan = $this->harga * ($persen / 100);
        $this->harga = $this->harga - $potongan;
    }

    public function __destruct() {
        echo "<br>Produk $this->nama telah dihapus dari histori.";
    }
}

$produk1 = new Product("Chanel Allure Lip Gloss", 1100000, "Kosmetik");
$produk2 = new Product("Miss Dior Blooming Bouquet", 2500000, "Parfum");

echo "<br>=== Sebelum Diskon ===<br>";
echo $produk1->getInfo() . "<br>";
echo $produk2->getInfo() . "<br><br>";

$produk1->applyDiskon(10);
$produk2->applyDiskon(20);

echo "=== Setelah Diskon ===<br>";
echo $produk1->getInfo() . "<br>";
echo $produk2->getInfo() . "<br>";

?>