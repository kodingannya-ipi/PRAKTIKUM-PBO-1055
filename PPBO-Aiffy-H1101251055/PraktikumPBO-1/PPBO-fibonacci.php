<?php

$n = 10; 
$a = 0;
$b = 1;

echo "Deret Fibonacci hingga $n bilangan: <br>";

for ($i = 0; $i <= $n; $i++) {
    echo $a . " ";

    $c = $a + $b;
    $a = $b;
    $b = $c;
}
?>