<?php
// Cek apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start(); // Memulai session

    // Lakukan operasi pengecekan login di database
    require_once('connect.php');

    // Ambil data dari form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Buat query untuk mengambil data pengguna berdasarkan email
    $query = "SELECT user_id, email, nama_lengkap, password FROM pengguna WHERE email = ?";

    // Siapkan statement
    $stmt = $conn->prepare($query);

    // Bind parameter
    $stmt->bind_param('s', $email);

    // Eksekusi statement
    $stmt->execute();

    // Dapatkan hasilnya
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Ambil data pengguna
        $user = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Password benar, simpan data pengguna ke dalam session
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['nama_lengkap'] = $user['nama_lengkap'];

            // Login berhasil, redirect ke halaman utama
            header("Location: index.php");
            exit();
        } else {
            // Password salah
            echo "Login gagal. Silakan cek kembali email dan password Anda.";
        }
    } else {
        // Pengguna tidak ditemukan
        echo "Login gagal. Silakan cek kembali email dan password Anda.";
    }

    // Tutup statement dan koneksi database
    $stmt->close();
    $conn->close();
}
