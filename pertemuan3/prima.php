<?php
// Fungsi untuk mengecek apakah suatu bilangan prima
function isPrime($number) {
    if ($number <= 1) {
        return false;
    }
    for ($i = 2; $i <= sqrt($number); $i++) {
        if ($number % $i == 0) {
            return false;
        }
    }
    return true;
}

// Menampilkan bilangan prima dari 1 sampai 100
for ($i = 1; $i <= 100; $i++) {
    if (isPrime($i)) {
        echo $i . " adalah bilangan prima <br>";
}
}
?>