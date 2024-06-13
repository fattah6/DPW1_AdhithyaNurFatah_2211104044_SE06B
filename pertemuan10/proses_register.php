<?php
// Cek apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form menggunakan array $_POST
    $nama_lengkap = $_POST['nama_lengkap'];
    $telepon = $_POST['telepon'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash password sebelum disimpan ke database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Koneksi ke database
    require_once('connect.php');

    // Query untuk menyimpan data pengguna baru ke tabel pengguna
    $query = "INSERT INTO pengguna (nama_lengkap, telepon, email, password) VALUES ('$nama_lengkap', '$telepon', '$email', '$hashed_password')";

    if ($conn->query($query) === TRUE) {
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }

    // Tutup koneksi database
    $conn->close();
}
