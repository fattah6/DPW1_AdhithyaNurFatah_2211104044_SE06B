<?php
// File: login.php
// Memulai session
session_start();
// Cek apakah username dan password sesuai
if ($_POST['username'] == 'fatah' && $_POST['password'] == 'fatah20')
{
// Menyimpan username dalam session
$_SESSION['username'] = $_POST['username'];
echo "Berhasil masuk!";
echo "<br><a href='index.php'>Kembali ke halaman utama</a>";
} else {
echo "Gagal masuk. Silakan coba lagi.";
echo "<br><a href='index.php'>Kembali ke halaman masuk</a>";
}
?>
