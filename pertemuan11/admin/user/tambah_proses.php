<?php
session_start();
// Sertakan file koneksi ke database
include '../../connect.php';

// Periksa apakah form sudah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $role_id = $_POST['role_id'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $no_hp = $_POST['no_hp'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Query untuk menambahkan data pengguna baru
    $sql = "INSERT INTO user (role_id, nama_lengkap, no_hp, email, password) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issss", $role_id, $nama_lengkap, $no_hp, $email, $password);

    // Jalankan query
    if ($stmt->execute()) {
        // Jika berhasil, arahkan kembali ke halaman index.php
        header("Location: ../user.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Tutup statement
    $stmt->close();
}

// Tutup koneksi
$conn->close();
?>
