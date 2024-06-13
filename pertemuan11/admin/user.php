<?php
// Sertakan file koneksi ke database
include '../connect.php';

// Jalankan query untuk mengambil data
$sql = "SELECT u.nama_lengkap, u.no_hp, u.email, password, r.name as role_name, u.user_id, u.role_id
        FROM user u 
        JOIN role r ON u.role_id = r.role_id";
$result = $conn->query($sql);

// Periksa jika query berhasil dijalankan
if (!$result) {
    die("Query error: " . $conn->error);
}
?>

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
    <!-- Sidebar -->
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">Riwayat Pembelian</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Pengguna</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="produk.php">Produk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="role.php">Role</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- Content -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>Pengguna</h2>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahDataModal">
                        Tambah Data
                    </button>
                </div>
                <div class="table-responsive mt-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Role</th>
                                <th>Nama Lengkap</th>
                                <th>No. HP</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row['role_name'] . "</td>";
                                    echo "<td>" . $row['nama_lengkap'] . "</td>";
                                    echo "<td>" . $row['no_hp'] . "</td>";
                                    echo "<td>" . $row['email'] . "</td>";
                                    echo '<td>
                                        <button type="button" class="btn btn-primary btn-sm editBtn" 
                                                data-toggle="modal" data-target="#editDataModal"
                                                data-user_id="' . $row['user_id'] . '"
                                                data-role_id="' . $row['role_id'] . '"
                                                data-nama_lengkap="' . $row['nama_lengkap'] . '"
                                                data-no_hp="' . $row['no_hp'] . '"
                                                data-email="' . $row['email'] . '"
                                                data-password="' . $row['password'] . '">Edit</button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusDataModal" data-userid="' . $row['user_id'] . '">Hapus</button>
                                    </td>';
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>Tidak ada data pengguna</td></tr>";
                            }
                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
    <!-- Modal tambah data -->
    <?php include 'user/edit.php'; ?>

    <!-- Modal tambah data -->
    <?php include 'user/tambah.php'; ?>
    <!-- Modal hapus data -->
    <?php include 'user/hapus.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.editBtn').on('click', function() {
                const user_id = $(this).data('user_id');
                const role_id = $(this).data('role_id');
                const nama_lengkap = $(this).data('nama_lengkap');
                const no_hp = $(this).data('no_hp');
                const email = $(this).data('email');
                const password = $(this).data('password');

                $('#edit_user_id').val(user_id);
                $('#edit_role_id').val(role_id);
                $('#edit_nama_lengkap').val(nama_lengkap);
                $('#edit_no_hp').val(no_hp);
                $('#edit_email').val(email);
                $('#edit_password').val(password);
            });
        });
    </script>
</body>

</html>
