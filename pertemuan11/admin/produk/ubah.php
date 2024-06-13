<?php
session_start();
// Include file koneksi
include '../../connect.php';

// Verifikasi apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    // Jika belum, arahkan ke halaman login
    header("Location: ../../login.php");
    exit();
}

// Pastikan produk_id dikirimkan melalui URL
if (!isset($_GET['id'])) {
    echo "Produk ID tidak ditemukan";
    exit();
}

$produk_id = $_GET['id'];

// Query untuk mengambil data produk berdasarkan produk_id
$query = "SELECT * FROM produk WHERE produk_id = '$produk_id'";
$result = $conn->query($query);

if (!$result) {
    echo "Error executing query: " . $conn->error;
    exit();
}

// Pastikan produk dengan produk_id tertentu ada dalam database
if ($result->num_rows === 0) {
    echo "Produk tidak ditemukan";
    exit();
}

// Mengambil data produk dari hasil query
$produk = $result->fetch_assoc();

// Jika metode request adalah POST, artinya pengguna telah mengirimkan formulir edit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // mengambil data dari inputan user
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    
    // mengubah data menggunakan query sql
    $query = "UPDATE produk SET nama = '$nama', harga = '$harga', stok = '$stok' WHERE produk_id = '$produk_id'";
    
    // jika berhasil maka dialihkan ke halaman produk
    if ($conn->query($query)) {
        header("Location: ../produk.php");
        exit;
    } else {
        echo "Error executing query: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Edit Produk</h2>
        <form method="POST">
            <!-- Produk ID tidak perlu dimasukkan sebagai input field karena sudah ada di URL -->
            <input type="hidden" name="produk_id" value="<?php echo $produk_id; ?>">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $produk['nama']; ?>">
            </div>
            <div class="form-group">
                <label for="harga">Harga:</label>
                <input type="number" class="form-control" id="harga" name="harga" value="<?php echo $produk['harga']; ?>">
            </div>
            <div class="form-group">
                <label for="stok">Stok:</label>
                <input type="number" class="form-control" id="stok" name="stok" value="<?php echo $produk['stok']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="../produk.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
