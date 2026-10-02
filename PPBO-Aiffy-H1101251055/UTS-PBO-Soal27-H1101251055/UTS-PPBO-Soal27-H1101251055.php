<?php
// abstract class
abstract class LayananLaundry{
    // property pakai protected modifier
    protected $id;
    protected $nama;
    protected $hargaDasar;

// constructor
public function __construct($id, $nama, $hargaDasar){
    $this->id = $id;
    $this->nama = $nama;
    $this->hargaDasar = $hargaDasar;
}
// getter
public function getId(){
    return $this->id;
}
// getter
public function getNama(){
    return $this->nama;
}
// getter
public function getHargaDasar(){
    return $this->hargaDasar;
}
// abstract hitungTotal() dan getJenis()
abstract public function hitungTotal();
abstract public function getJenis();
}

// child class CuciKering 
class CuciKering extends LayananLaundry{
    // property kg di private
    private $kg;
    public function __construct($id, $nama, $hargaDasar, $kg){
        parent::__construct($id, $nama, $hargaDasar);
        $this->kg = $kg;
    }
// getter
public function getKg(){
    return $this->kg;
}
// getter
public function getJenis(){
    return "Cuci Kering";
}
// ngitung harga dasar + (2000 * kg)
public function hitungTotal(){
    return $this->hargaDasar + (2000 * $this->kg);
}
// bonyus
public function cetakDetail(){
    echo "ID: " . $this->id . "<br>";
    echo "Nama: " . $this->nama . "<br>";
    echo "Jenis: " . $this->getJenis() . "<br>";
    echo "Harga Dasar: Rp" . number_format($this->hargaDasar, 0, ',', '.') . "<br>";
    echo "Berat (kg): " . $this->kg . "<br>";
    echo "Total Harga: Rp" . number_format($this->hitungTotal(), 0, ',', '.') . "<br>";
}
}

// child class CuciSetrika
class CuciSetrika extends LayananLaundry{
    // property kg di private
    private $kg;
    public function __construct($id, $nama, $hargaDasar, $kg){
        parent::__construct($id, $nama, $hargaDasar);
        $this->kg = $kg;
}
// getter
public function getKg(){
    return $this->kg;
}
// getter
public function getJenis(){
    return "Cuci Setrika";
}
// ngitung harga dasar + (5000 * kg)
public function hitungTotal(){
    $total = $this->hargaDasar + (5000 * $this->kg);
    if ($this->kg > 5) {
        $total = $total - ($total * 0.1); // diskon 10% jika kg > 5
    }
    return $total;
}
// bonyus
public function cetakDetail(){
    echo "ID: " . $this->id . "<br>";
    echo "Nama: " . $this->nama . "<br>";
    echo "Jenis: " . $this->getJenis() . "<br>";
    echo "Harga Dasar: Rp" . number_format($this->hargaDasar, 0, ',', '.') . "<br>";
    echo "Berat (kg): " . $this->kg . "<br>";
    echo "Total Harga: Rp" . number_format($this->hitungTotal(), 0, ',', '.') . "<br>";
}
}

// child class Express
class Express extends LayananLaundry{
    // property kg di private
    private $kg;
    public function __construct($id, $nama, $hargaDasar, $kg){
        parent::__construct($id, $nama, $hargaDasar);
        $this->kg = $kg;
}
// getter
public function getKg(){
    return $this->kg;
}
// getter
public function getJenis(){
    return "Express";
}
// ngitung harga dasar * 1.5 + (3000 * kg)
public function hitungTotal(){
    return ($this->hargaDasar * 1.5) + (3000 * $this->kg);
}
// bonyus
public function cetakDetail(){
    echo "ID: " . $this->id . "<br>";
    echo "Nama: " . $this->nama . "<br>";
    echo "Jenis: " . $this->getJenis() . "<br>";
    echo "Harga Dasar: Rp" . number_format($this->hargaDasar, 0, ',', '.') . "<br>";
    echo "Berat (kg): " . $this->kg . "<br>";
    echo "Total Harga: Rp" . number_format($this->hitungTotal(), 0, ',', '.') . "<br>";
}
}

// instansiasi 5 objek
$daftar = [
    new CuciKering("CK01", "Aiffy Ragta Aqilla", 10000, 4),
    new CuciSetrika("CS01", "Mellly", 15000, 6),
    new Express("EX01", "Nikoleta Febrina Listya Priyono", 20000, 5),
    new CuciKering("CK02", "Khairunisa Ansyari Ramadhan", 12000, 2),
    new CuciSetrika("CS02", "Sri Wahyuni", 18000, 3)
];

// loopinh array, tampilkan data tiap layanan laundry
echo "Daftar Layanan Laundry<br><br>";
$totalSemuanya = 0;
foreach ($daftar as $item) {
    $item->cetakDetail();
    echo "<br>";
    $totalSemuanya = $totalSemuanya + $item->hitungTotal();
}
// tampilkan total semua layanan laundry
echo "Total Semua Layanan: Rp" . number_format($totalSemuanya, 0, ',', '.') . "<br>";
?>