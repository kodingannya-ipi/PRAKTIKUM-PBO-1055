<?php

function hitung_nilai_akhir($nilai_uts, $nilai_uas, $nilai_tugas) {
    $nilai_akhir = ($nilai_uts * 0.3) + ($nilai_uas * 0.4) + ($nilai_tugas * 0.3);
    return (float) $nilai_akhir;
}

$nilai_uts = 75;
$nilai_uas = 83;
$nilai_tugas = 93;

$nilai_akhir = hitung_nilai_akhir($nilai_uts, $nilai_uas, $nilai_tugas);

echo "Nilai akhir dengan nilai UTS $nilai_uts, nilai UAS $nilai_uas, dan nilai tugas $nilai_tugas adalah: $nilai_akhir";

?>