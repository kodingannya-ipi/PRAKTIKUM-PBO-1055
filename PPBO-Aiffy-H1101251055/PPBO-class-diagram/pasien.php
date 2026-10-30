<?php
// class Pasien: ngurus data identitas dan aktivitas pasien (SRP)
class Pasien {
    private string $idPasien;
    private string $nama;
    private string $alamat;
    private int $noTelepon;

    // 1 pasien bisa punya 0..* pemeriksaan
    private array $riwayat = [];

    // buat bikin ID pemeriksaan otomatis
    private static int $urutan = 0;

    public function __construct(string $idPasien, string $nama, string $alamat, int $noTelepon) {
        $this->idPasien = $idPasien;
        $this->nama = $nama;
        $this->alamat = $alamat;
        $this->noTelepon = $noTelepon;
    }

    public function mendaftar(): void {
        echo "Pasien " . $this->nama . " (" . $this->idPasien . ") berhasil mendaftar." . PHP_EOL;
    }

    public function ubahDataPasien(string $nama, string $alamat, int $noTelepon): void {
        $this->nama = $nama;
        $this->alamat = $alamat;
        $this->noTelepon = $noTelepon;
        echo "Data pasien " . $this->idPasien . " berhasil diubah." . PHP_EOL;
    }

    public function melakukanPemeriksaan(Dokter $dokter, string $tanggal, string $keluhan): Pemeriksaan {
        self::$urutan++;
        $id = "PMK" . str_pad((string) self::$urutan, 3, "0", STR_PAD_LEFT);

        $pemeriksaan = new Pemeriksaan($id, $this, $dokter, $tanggal, $keluhan);
        $this->riwayat[] = $pemeriksaan;

        echo $this->nama . " melakukan pemeriksaan dengan " . $dokter->getNama() . " (" . $id . ")." . PHP_EOL;
        return $pemeriksaan;
    }

    public function lihatRiwayatPemeriksaan(): void {
        echo "== Riwayat Pemeriksaan " . $this->nama . " ==" . PHP_EOL;

        if (count($this->riwayat) === 0) {
            echo "Belum ada riwayat pemeriksaan." . PHP_EOL . "-----------------------------" . PHP_EOL;
            return;
        }

        foreach ($this->riwayat as $p) {
            $p->tampilkanDetail();
        }
    }

    public function getNama(): string { return $this->nama; }
    public function getIdPasien(): string { return $this->idPasien; }
}