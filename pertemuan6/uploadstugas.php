<?php
session_start();

// Cek apakah user sudah login
if(!isset($_SESSION['username'])){
    header('Location: tugasindex.php');
    exit;
}

// Folder untuk menyimpan file
$target_dir = "uploads/";

// Path file yang diupload
$target_file = $target_dir . basename($_FILES["file"]["name"]);

// Cek apakah file sudah di-upload
if(isset($_FILES["file"])){
    if(move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)){
        echo "File ". basename( $_FILES["file"]["name"]). " berhasil di-upload.";
    } else {
        echo "Maaf, terjadi kesalahan saat meng-upload file.";
    }
}
?>