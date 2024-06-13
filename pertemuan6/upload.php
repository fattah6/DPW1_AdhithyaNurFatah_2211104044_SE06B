<?php
// Cek apakah file telah diupload
if (isset($_FILES['file'])) {
$file = $_FILES['file'];
// Lokasi penyimpanan file
$targetDir = "uploads/";
$targetFile = $targetDir . basename($file['name']);
// Pindahkan file ke lokasi penyimpanan
if (move_uploaded_file($file['tmp_name'], $targetFile)) {
echo "File berhasil diupload.";
} else {
echo "Gagal mengupload file.";
}
}
?>