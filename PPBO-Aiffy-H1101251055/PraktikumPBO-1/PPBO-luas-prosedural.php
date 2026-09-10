<?php

function luas_persegi_panjang($panjang, $lebar) {
    $luas = $panjang * $lebar;
    return $panjang * $lebar;
}

$panjang = 7;
$lebar = 4;

$luas = luas_persegi_panjang($panjang, $lebar);
echo "Luas persegi panjang dengan panjang $panjang cm dan lebar $lebar cm adalah: $luas cm²";

?>