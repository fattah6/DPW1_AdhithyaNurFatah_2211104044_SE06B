<?php
session_start();
include '../connect.php';

// Verifikasi apakah pengguna sudah login
if (!isset($_SESSION['role_id'])) {
    // Jika belum, arahkan ke halaman login
    header("Location: ../login.php");
    exit();
}

// Verifikasi role pengguna
if ($_SESSION['role_id'] != 1 && $_SESSION['role_id'] != 2) {
    // Jika bukan admin atau penjual, arahkan ke halaman default
    header("Location: ../index.php");
    exit();
}

// Jika tombol edit diklik
if (isset($_GET['id'])) {
    $produk_id = $_GET['id'];
    
    // Query untuk mengambil data produk berdasarkan produk_id
    $query_produk = "SELECT * FROM produk WHERE produk_id = ?";
    $stmt = $conn->prepare($query_produk);
    $stmt->bind_param("i", $produk_id);
    $stmt->execute();
    $result_produk = $stmt->get_result();

    // Pastikan produk dengan produk_id tertentu ada dalam database
    if ($result_produk->num_rows === 0) {
        echo "Produk tidak ditemukan";
        exit();
    }

    // Mengambil data produk dari hasil query
    $row_produk = $result_produk->fetch_assoc();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,
initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.c
ss">
</head>

<body>
    <!-- Sidebar -->
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="produk.php">Produk</a>
                        </li>
                         <li class="nav-item">
                            <a class="nav-link" href="transaksi.php">Transaksi</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- Content -->
           <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
   
            <!-- Content -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>Produk</h2>
                    <a href="produk/tambah.php" class="btn btn-primary">Tambah Data</a>
                </div>
                <div class="table-responsive mt-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Produk ID</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Ambil data produk dari database
                            include '../connect.php'; // Sambungkan ke database
                            $query_produk = "SELECT * FROM produk";
                            $result_produk = $conn->query($query_produk);

                            // Loop untuk menampilkan data produk
                            while ($row_produk = $result_produk->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?php echo $row_produk['produk_id']; ?></td>
                                    <td><?php echo $row_produk['nama']; ?></td>
                                    <td><?php echo $row_produk['harga']; ?></td>
                                    <td><?php echo $row_produk['stok']; ?></td>
                                    <td>
                                        <a href="produk/ubah.php?id=<?php echo $row_produk['produk_id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                        <a href="produk/hapus.php?id=<?php echo $row_produk['produk_id']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
