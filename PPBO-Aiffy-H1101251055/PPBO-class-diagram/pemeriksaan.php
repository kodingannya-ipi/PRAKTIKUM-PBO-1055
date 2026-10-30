<?php
// class Pemeriksaan: cuma nyatat 1 kejadian pemeriksaan (SRP)
class Pemeriksaan {
    private string $idPemeriksaan;
    private DateTime $tanggalPemeriksaan;
    private string $keluhan;
    private string $hasilPemeriksaan = "";

    // 1 pemeriksaan punya 1 pasien dan 1 dokter
    private Pasien $pasien;
    private Dokter $dokter;

    public function __construct(string $id, Pasien $pasien, Dokter $dokter, string $tanggal, string $keluhan) {
        $this->idPemeriksaan = $id;
        $this->pasien = $pasien;
        $this->dokter = $dokter;
        $this->tanggalPemeriksaan = new DateTime($tanggal);
        $this->catatKeluhan($keluhan);
    }

    public function catatKeluhan(string $keluhan): void {
        if (trim($keluhan) === "") {
            throw new InvalidArgumentException("Keluhan tidak boleh kosong.");
        }
        $this->keluhan = $keluhan;
    }

    public function catatHasil(string $hasil): void {
        if (trim($hasil) === "") {
            throw new InvalidArgumentException("Hasil pemeriksaan tidak boleh kosong.");
        }
        $this->hasilPemeriksaan = $hasil;
    }

    public function tampilkanDetail(): void {
        $hasil = $this->hasilPemeriksaan === "" ? "(belum diisi)" : $this->hasilPemeriksaan;
        echo "ID Pemeriksaan : " . $this->idPemeriksaan . PHP_EOL;
        echo "Tanggal        : " . $this->tanggalPemeriksaan->format('d-m-Y') . PHP_EOL;
        echo "Pasien         : " . $this->pasien->getNama() . PHP_EOL;
        echo "Dokter         : " . $this->dokter->getNama() . PHP_EOL;
        echo "Keluhan        : " . $this->keluhan . PHP_EOL;
        echo "Hasil          : " . $hasil . PHP_EOL;
        echo "-----------------------------" . PHP_EOL;
    }

    // getter
    public function getIdPemeriksaan(): string { return $this->idPemeriksaan; }
    public function getDokter(): Dokter { return $this->dokter; }
    public function getPasien(): Pasien { return $this->pasien; }
}