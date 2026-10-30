<?php
// Class Dokter: ngurus data dokter dan aktivitas memeriksa (SRP)
class Dokter {
    private string $idDokter;
    private string $nama;
    private string $spesialisasi;

    // 1 dokter bisa nangani 0..* pemeriksaan
    private array $daftarPemeriksaan = [];

    public function __construct(string $idDokter, string $nama, string $spesialisasi) {
        $this->idDokter = $idDokter;
        $this->nama = $nama;
        $this->spesialisasi = $spesialisasi;
    }

    public function memeriksaPasien(Pemeriksaan $pemeriksaan): void {
        $this->cekPemeriksaanMilikSaya($pemeriksaan);

        $this->daftarPemeriksaan[] = $pemeriksaan;
        echo $this->nama . " sedang memeriksa " . $pemeriksaan->getPasien()->getNama() . "." . PHP_EOL;
    }

    public function isiHasilPemeriksaan(Pemeriksaan $pemeriksaan, string $hasil): void {
        $this->cekPemeriksaanMilikSaya($pemeriksaan);

        $pemeriksaan->catatHasil($hasil);
        echo $this->nama . " mengisi hasil pemeriksaan " . $pemeriksaan->getIdPemeriksaan() . "." . PHP_EOL;
    }

    public function ubahSpesialisasi(string $spesialisasiBaru): void {
        $this->spesialisasi = $spesialisasiBaru;
        echo "Spesialisasi " . $this->nama . " diubah menjadi " . $spesialisasiBaru . "." . PHP_EOL;
    }

    // dokter cm boleh urus pemeriksaan yg emg ditangani dia
    private function cekPemeriksaanMilikSaya(Pemeriksaan $pemeriksaan): void {
        if ($pemeriksaan->getDokter() !== $this) {
            throw new Exception($this->nama . " tidak menangani pemeriksaan " . $pemeriksaan->getIdPemeriksaan() . ".");
        }
    }

    public function getNama(): string { return $this->nama; }
    public function getSpesialisasi(): string { return $this->spesialisasi; }
    public function getJumlahPemeriksaan(): int { return count($this->daftarPemeriksaan); }
}