<?php
require_once '../Catatan.php';

$detail = Catatan::getById(20);

if ($detail) {
    echo "Judul: " . $detail['judul'] . PHP_EOL;
    echo "Isi: " . $detail['isi'] . PHP_EOL;
} else {
    echo "Catatan tidak ditemukan.";
}