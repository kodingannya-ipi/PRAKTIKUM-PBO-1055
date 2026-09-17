<?php
class Produk {
    protected $nama;
    protected $merek;
    protected $harga;

    public function __construct($nama, $merek, $harga){
        $this->nama = $nama;
        $this->merek = $merek;

        if ($harga <= 0) {
            echo "Harga tidak valid, harga diatur ke 0<br>";
            $harga = 0;
        }
        $this->harga = $harga;
    }

    public function getInfo(){
        echo "Merek: " . $this->merek . "<br>";
        echo "Harga: Rp " . number_format($this->harga, 0, ',', '.') . "<br>";
    }
}

class Makanan extends Produk {
    protected $tanggalKadaluarsa;
    protected $status;

    public function __construct($nama, $merek, $harga, $tanggalKadaluarsa, $status){
        parent::__construct($nama, $merek, $harga);
        $this->tanggalKadaluarsa = $tanggalKadaluarsa;
        $this->status = $status;
    }

    public function getInfo(){
        echo "Produk: Makanan - " . $this->nama . "<br>";
        parent::getInfo();
        echo "Tanggal Kadaluarsa: " . $this->tanggalKadaluarsa . "<br>";
        echo "Status: " . $this->status . "<br>";
    }
}

class Elektronik extends Produk {
    protected $garansi;

    public function __construct($nama, $merek, $harga, $garansi){
        parent::__construct($nama, $merek, $harga);
        $this->garansi = $garansi;
    }

    public function getInfo(){ 
        echo "Produk: Elektronik - " . $this->nama . "<br>";
        parent::getInfo();
        echo "Garansi: " . $this->garansi . " bulan<br>";
    }
}

$mieInstan = new Makanan("Mie Instan", "Indomie", 3500, "2025-06-30", "Segar");
$mieInstan->getInfo();

echo "<br>";

$smartTV = new Elektronik("Smart TV", "Samsung", 5000000, 12);
$smartTV->getInfo();

?>