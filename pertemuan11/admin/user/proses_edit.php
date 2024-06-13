<?php
session_start();
    // Lakukan koneksi ke database
    $conn = new mysqli('localhost', 'root', '', 'db_pertm9.2');

    // Periksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Memeriksa ubah produk atau user, berdasarkan user_id
    if (isset($_POST['user_id'])) {
        // logic update user
        $user_id = $_POST['user_id'];
        $role_id = $_POST['role_id'];
        $nama_lengkap = $_POST['nama_lengkap'];
        $no_hp = $_POST['no_hp'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // query upfdate user
        if (!empty($password)) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $query = "UPDATE user SET role_id = '$role_id', nama_lengkap = '$nama_lengkap', no_hp = '$no_hp', email = '$email', password = '$hashed_password' WHERE user_id = '$user_id'";
        } else {
            $query = "UPDATE user SET role_id = '$role_id', nama_lengkap = '$nama_lengkap', no_hp = '$no_hp', email = '$email' WHERE user_id = '$user_id'";
        }

        if ($conn->query($query)) {
            header("Location: ../user.php");
            exit;
        } else {
            echo "Error executing query: " . $conn->error;
        }
    } elseif (isset($_POST['produk_id'])) {
        // logic uonpdate produk
        $produk_id = $_POST['produk_id'];
        $nama = $_POST['nama'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];

        // query update produk
        $query = "UPDATE produk SET nama = '$nama', harga = '$harga', stok = '$stok' WHERE produk_id = '$produk_id'";

        if ($conn->query($query)) {
            header("Location: ../produk.php");
            exit;
        } else {
            echo "Error executing query: " . $conn->error;
        }
    }
}
?>