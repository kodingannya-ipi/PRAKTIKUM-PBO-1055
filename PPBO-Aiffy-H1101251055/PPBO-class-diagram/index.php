<?php
require_once "Pasien.php";
require_once "Dokter.php";
require_once "Pemeriksaan.php";

try {
    // 1. buat objek
    $dokter1 = new Dokter("D001", "dr. Kimpul", "Umum");
    $dokter2 = new Dokter("D002", "dr. Sashimi", "Anak");

    $pasien1 = new Pasien("P001", "Meli", "Jl. Ahmad Yani, Pontianak", 81234567890);
    $pasien2 = new Pasien("P002", "Lilis", "Jl. Gajah Mada, Pontianak", 85211112222);
    $pasien3 = new Pasien("P003", "Cik", "Jl. Tanjungpura, Pontianak", 81399998888);

    // 2. pasien mendaftar
    echo "=== SIMULASI KLINIK ===" . PHP_EOL;
    $pasien1->mendaftar();
    $pasien2->mendaftar();
    $pasien3->mendaftar();
    echo PHP_EOL;

    // 3. satu pasien periksa lebih dari satu kali 
    $pem1 = $pasien1->melakukanPemeriksaan($dokter1, "2026-10-20", "Demam dan batuk");
    $dokter1->memeriksaPasien($pem1);
    $dokter1->isiHasilPemeriksaan($pem1, "Flu biasa, istirahat dan minum obat");

    $pem2 = $pasien1->melakukanPemeriksaan($dokter1, "2026-10-27", "Batuk belum sembuh");
    $dokter1->memeriksaPasien($pem2);
    $dokter1->isiHasilPemeriksaan($pem2, "Radang tenggorokan");

    // 4. pasien lain dengan dokter lain
    $pem3 = $pasien2->melakukanPemeriksaan($dokter2, "2026-10-28", "Sakit perut");
    $dokter2->memeriksaPasien($pem3);
    $dokter2->isiHasilPemeriksaan($pem3, "Maag ringan");
    echo PHP_EOL;

    // 5. tampilkan detail dan riwayat
    $pem1->tampilkanDetail();
    $pasien1->lihatRiwayatPemeriksaan();

    // pasien 3 belum pernah periksa (multiplicity 0)
    $pasien3->lihatRiwayatPemeriksaan();

    // 6. ubah data
    $pasien2->ubahDataPasien("Citra Lestari", "Jl. Danau Sentarum, Pontianak", 85211112222);
    $dokter2->ubahSpesialisasi("Anak dan Gizi");
    echo PHP_EOL;

    // 7. jumlah pemeriksaan tiap dokter
    echo $dokter1->getNama() . " menangani " . $dokter1->getJumlahPemeriksaan() . " pemeriksaan." . PHP_EOL;
    echo $dokter2->getNama() . " menangani " . $dokter2->getJumlahPemeriksaan() . " pemeriksaan." . PHP_EOL;
    echo PHP_EOL;

    // 8. uji error: dokter yang salah coba isi hasil pemeriksaan orang lain
    echo "=== UJI ERROR ===" . PHP_EOL;
    try {
        $dokter2->isiHasilPemeriksaan($pem1, "Hasil palsu");
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage() . PHP_EOL;
    }

    // keluhan kosong ditolak
    try {
        $pasien3->melakukanPemeriksaan($dokter1, "2026-10-29", "   ");
    } catch (InvalidArgumentException $e) {
        echo "Error: " . $e->getMessage() . PHP_EOL;
    }

} catch (Throwable $e) {
    echo "Terjadi kesalahan: " . $e->getMessage() . PHP_EOL;
}