<?php
// Memulai session
session_start();
// Cek apakah pengguna sudah masuk
if (isset($_SESSION['username'])) {
    echo "Selamat datang, " . $_SESSION['username'] . "!";
    echo "<br><a href='logout.php'>Keluar</a>";
    } else {
    echo "Silakan masuk:";
    echo "<form action='login.php' method='post'>";
    echo "Username: <input type='text' name='username'><br>";
    echo "Password: <input type='password' name='password'><br>";
    echo "<input type='submit' value='Masuk'>";
    echo "</form>";
    }
    // Mengambil data dari cookies
    if (isset($_COOKIE['last_visit'])) {
    $lastVisit = $_COOKIE['last_visit'];
    echo "<br>Anda mengunjungi halaman ini terakhir kali pada: " .
    $lastVisit;
    } else {
    echo "<br>Ini adalah kunjungan pertama Anda.";
    }
    // Menampilkan form upload file
    echo "<br><br>Upload file:";
    echo "<form action='upload.php' method='post'
    enctype='multipart/form-data'>";
    echo "<input type='file' name='file'><br>";
    echo "<input type='submit' value='Upload'>";
    echo "</form>";
    ?>