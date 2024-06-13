<?php
// Memulai session
session_start();
// Menghapus data session
session_unset();
session_destroy();
// Menghapus cookie terkait kunjungan terakhir
setcookie('last_visit', '', time() - 3600);
echo "Berhasil keluar!";
echo "<br><a href='index.php'>Kembali ke halaman utama</a>";
?>