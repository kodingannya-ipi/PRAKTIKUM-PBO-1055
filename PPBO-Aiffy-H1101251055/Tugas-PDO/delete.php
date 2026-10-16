<?php
require_once '../Catatan.php';

$id = 12;
$hapus = Catatan::delete($id);

if ($hapus) {
    echo "Catatan {$id} berhasil dihapus";
} else {
    echo "Gagal menghapus catatan";
}