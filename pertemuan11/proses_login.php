<?php
session_start();

// Cek apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lakukan operasi pengecekan login di database
    require_once('connect.php');

    // Escape input data untuk menghindari SQL injection
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    // Query untuk memeriksa kecocokan email dan password di tabel pengguna
    $query = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Login berhasil, simpan data pengguna ke dalam session
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
        $_SESSION['role_id'] = $user['role_id']; // Menyimpan peran pengguna dalam session

        // Redirect berdasarkan peran pengguna
        switch ($user['role_id']) {
            case 1: // Admin
                header("Location: admin/produk.php");
                break;
            case 2: // User
                header("Location: index.php");
                break;
            case 3: // Penjual
                // Untuk penjual, dialihkan ke halaman admin/produk.php dan admin/transaksi.php
                header("Location: admin/produk.php");
                // tambahkan redirect ke halaman transaksi.php di sini jika dibutuhkan
                // header("Location: admin/transaksi.php");
                break;
            default:
                // Redirect ke halaman default jika role tidak ditemukan
                header("Location: index.php");
        }
        exit();
    } else {
        echo "Login gagal. Silakan cek kembali email dan password Anda.";
    }

    // Tutup koneksi database
    $conn->close();
}
?>
