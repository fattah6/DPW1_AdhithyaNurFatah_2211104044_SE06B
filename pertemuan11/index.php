<?php
session_start();
include 'connect.php';

// Fungsi untuk mengurangi stok barang setelah pembelian
function kurangiStokBarang($conn, $produk_id, $quantity) {
    // Ambil data stok barang sekarang
    $query = "SELECT stok FROM produk WHERE produk_id = $produk_id";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $stok_sekarang = $row['stok'];

    // Kurangi stok barang sesuai dengan quantity pembelian
    $stok_baru = $stok_sekarang - $quantity;

    // Update stok barang di database
    $query = "UPDATE produk SET stok = $stok_baru WHERE produk_id = $produk_id";
    $conn->query($query);
}

// Proses pembelian
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buy_product'])) {
    // Ambil data pembelian dari form
    $produk_id = $_POST['buy_product'];
    $quantity = $_POST['quantity'];
    $user_id = $_SESSION['user_id'];

    // Cek stok barang yang tersedia
    $query = "SELECT stok FROM produk WHERE produk_id = $produk_id";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $stok_tersedia = $row['stok'];

    // Jika stok barang cukup untuk dibeli
    if ($stok_tersedia >= $quantity) {
        // Kurangi stok barang
        kurangiStokBarang($conn, $produk_id, $quantity);

        // Simpan data transaksi
        $query = "INSERT INTO transaksi (user_id, produk_id, quantity) VALUES ($user_id, $produk_id, $quantity)";
        $conn->query($query);

        // Redirect kembali ke halaman index.php setelah pembelian
        header("Location: index.php");
        exit();
    } else {
        // Jika stok barang tidak mencukupi, tampilkan pesan error
        echo "<script>alert('Stok barang tidak mencukupi');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contoh Website</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">
            <h1>Logo</h1>
        </a>
        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register.php">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin/produk.php">Product</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Card Produk -->
    <div class="container mt-5">
        <div class="row">
            <?php
            // Ambil data produk untuk setiap kolom
            $query_produk1 = "SELECT * FROM produk WHERE produk_id = 1";
            $result_produk1 = $conn->query($query_produk1);
            $row_produk1 = $result_produk1->fetch_assoc();

            $query_produk2 = "SELECT * FROM produk WHERE produk_id = 2";
            $result_produk2 = $conn->query($query_produk2);
            $row_produk2 = $result_produk2->fetch_assoc();

            $query_produk3 = "SELECT * FROM produk WHERE produk_id = 4";
            $result_produk3 = $conn->query($query_produk3);
            $row_produk3 = $result_produk3->fetch_assoc();
            ?>

            <!-- Produk Kolom 1 -->
            <div class="col-md-4">
                <div class="card">
                    <!-- Gambar Produk -->
                    <img src="https://www.maternaldisaster.com/wp-content/uploads/2024/05/flox-1.jpg" class="card-img-top" alt="Gambar Produk <?php echo $row_produk1['produk_id']; ?>">
                    <div class="card-body">
                        <!-- Judul Produk -->
                        <h5 class="card-title"><?php echo $row_produk1['nama']; ?></h5>
                        <!-- Harga dan Stok -->
                        <p class="card-text">Harga: $<?php echo $row_produk1['harga']; ?></p>
                        <p class="card-text">Stok: <?php echo $row_produk1['stok']; ?></p>
                        <!-- Form Pembelian -->
                        <form action="index.php" method="POST">
                            <!-- Input Produk ID -->
                            <input type="hidden" name="buy_product" value="<?php echo $row_produk1['produk_id']; ?>">
                            <!-- Input Quantity -->
                            <div class="form-group">
                                <label for="quantity<?php echo $row_produk1['produk_id']; ?>">Jumlah Beli</label>
                                <input required type="number" class="form-control" id="quantity<?php echo $row_produk1['produk_id']; ?>" min="1" value="1" name="quantity">
                            </div>
                            <!-- Tombol Beli -->
                            <button type="submit" class="btn btn-primary">Beli</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Produk Kolom 2 -->
            <div class="col-md-4">
                <div class="card">
                    <!-- Gambar Produk -->
                    <img src="https://www.maternaldisaster.com/wp-content/uploads/2024/03/makies-4.jpg" class="card-img-top" alt="Gambar Produk <?php echo $row_produk2['produk_id']; ?>">
                    <div class="card-body">
                        <!-- Judul Produk -->
                        <h5 class="card-title"><?php echo $row_produk2['nama']; ?></h5>
                        <!-- Harga dan Stok -->
                        <p class="card-text">Harga: $<?php echo $row_produk2['harga']; ?></p>
                        <p class="card-text">Stok: <?php echo $row_produk2['stok']; ?></p>
                        <!-- Form Pembelian -->
                        <form action="index.php" method="POST">
                            <!-- Input Produk ID -->
                            <input type="hidden" name="buy_product" value="<?php echo $row_produk2['produk_id']; ?>">
                            <!-- Input Quantity -->
                            <div class="form-group">
                                <label for="quantity<?php echo $row_produk2['produk_id']; ?>">Jumlah Beli</label>
                                <input required type="number" class="form-control" id="quantity<?php echo $row_produk2['produk_id']; ?>" min="1" value="1" name="quantity">
                            </div>
                            <!-- Tombol Beli -->
                            <button type="submit" class="btn btn-primary">Beli</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Produk Kolom 3 -->
            <div class="col-md-4">
                <div class="card">
                    <!-- Gambar Produk -->
                    <img src="https://www.maternaldisaster.com/wp-content/uploads/2024/05/matefornia-1.jpg" class="card-img-top" alt="Gambar Produk <?php echo $row_produk3['produk_id']; ?>">
                    <div class="card-body">
                        <!-- Judul Produk -->
                        <h5 class="card-title"><?php echo $row_produk3['nama']; ?></h5>
                        <!-- Harga dan Stok -->
                        <p class="card-text">Harga: $<?php echo $row_produk3['harga']; ?></p>
                        <p class="card-text">Stok: <?php echo $row_produk3['stok']; ?></p>
                        <!-- Form Pembelian -->
                        <form action="index.php" method="POST">
                            <!-- Input Produk ID -->
                            <input type="hidden" name="buy_product" value="<?php echo $row_produk3['produk_id']; ?>">
                            <!-- Input Quantity -->
                            <div class="form-group">
                                <label for="quantity<?php echo $row_produk2['produk_id']; ?>">Jumlah Beli</label>
                                <input required type="number" class="form-control" id="quantity<?php echo $row_produk2['produk_id']; ?>" min="1" value="1" name="quantity">
                            </div>
                            <!-- Tombol Beli -->
                            <button type="submit" class="btn btn-primary">Beli</button>
                        </form>
                    </div>
                </div>
            </div>