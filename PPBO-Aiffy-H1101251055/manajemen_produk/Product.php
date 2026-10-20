<?php
require_once 'DatabaseConnection.php';

class Product {
    private $nama;
    private $harga;
    private $stok;
    private $db;

    public function __construct() {
        $this->db = DatabaseConnection::getInstance()->getConnection();
    }

    public function setNama($nama)   { $this->nama = $nama;   return $this; }
    public function setHarga($harga) { $this->harga = $harga; return $this; }
    public function setStok($stok)   { $this->stok = $stok;   return $this; }

    // create - tambah data
    public function save() {
        $stmt = $this->db->prepare(
            "INSERT INTO produk (nama, harga, stok) VALUES (:nama, :harga, :stok)"
        );
        return $stmt->execute([
            'nama'  => $this->nama,
            'harga' => $this->harga,
            'stok'  => $this->stok
        ]);
    }

    // read - lihat semua
    public static function findAll() {
        $db = DatabaseConnection::getInstance()->getConnection();
        return $db->query("SELECT * FROM produk ORDER BY id DESC")->fetchAll();
    }

    // read - lihat satu saja, false kalau tidak ada)
    public static function findById($id) {
        $db = DatabaseConnection::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM produk WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    // update - ubah data
    public function update($id) {
        $stmt = $this->db->prepare(
            "UPDATE produk SET nama = :nama, harga = :harga, stok = :stok WHERE id = :id"
        );
        return $stmt->execute([
            'nama'  => $this->nama,
            'harga' => $this->harga,
            'stok'  => $this->stok,
            'id'    => $id
        ]);
    }

    // delete - hapus data
    public static function delete($id) {
        $db = DatabaseConnection::getInstance()->getConnection();
        $stmt = $db->prepare("DELETE FROM produk WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}