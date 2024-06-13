<?php 
session_start(); 
include '../../connect.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    // mengambil data user_id dari user yang sedang login 
    $userId = $_SESSION['user_id']; 

    // mengambil data dari inputan user 
    $nama = $_POST['nama']; 
    $harga = $_POST['harga']; 
    $stok = $_POST['stok']; 

    // memasukan data menggunakan query sql 
    $query = "INSERT INTO produk (user_id, nama, harga, stok) VALUES ('$userId', '$nama', '$harga', '$stok')"; 

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
    <title>Tambah Produk</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Tambah Produk</h2>
        <form method="POST">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nama">Nama:</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="harga">Harga:</label>
                    <input type="number" class="form-control" id="harga" name="harga" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="stok">Stok:</label>
                    <input type="number" class="form-control" id="stok" name="stok" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="../produk.php" class="btn btn-secondary">Batal</a>
        </form>

        <!-- Daftar Produk -->
        <h2 class="mt-4">Daftar Produk</h2>
        <div class="table-responsive mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Stok</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Ambil data produk dari database
                    $query_produk = "SELECT * FROM produk";
                    $result_produk = $conn->query($query_produk);

                    // Loop untuk menampilkan data produk
                    while ($row_produk = $result_produk->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo $row_produk['nama']; ?></td>
                            <td><?php echo $row_produk['harga']; ?></td>
                            <td><?php echo $row_produk['stok']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
