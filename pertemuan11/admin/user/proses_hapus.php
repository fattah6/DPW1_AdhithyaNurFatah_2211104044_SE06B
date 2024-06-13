<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['user_id'];

    // Lakukan koneksi ke database
    $conn = new mysqli('localhost', 'root', '', 'db_pertm9.2');

    // Periksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Query untuk menghapus pengguna
    $sql = "DELETE FROM user WHERE user_id = ?";
    $stmt = $conn->prepare($sql);

    // Periksa apakah statement berhasil disiapkan
    if ($stmt === false) {
        die("Terjadi kesalahan dalam penyiapan statement: " . $conn->error);
    }

    $stmt->bind_param("i", $userId);

    if ($stmt->execute()) {
        header("Location: ../user.php");
        exit();
        // Redirect atau beri pesan sukses
    } else {
        echo "Terjadi kesalahan: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Metode pengiriman tidak valid.";
}
?>
