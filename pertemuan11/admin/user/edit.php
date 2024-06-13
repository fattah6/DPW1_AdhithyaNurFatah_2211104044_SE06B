<?php
// Sertakan file koneksi database
    // Lakukan koneksi ke database
    $conn = new mysqli('localhost', 'root', '', 'db_pertm9.2');

    // Periksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

// Periksa apakah form telah dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    $role_id = $_POST['role_id'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $no_hp = $_POST['no_hp'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query untuk memperbarui data pengguna
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
    // Logika untuk memperbarui produk
    $produk_id = $_POST['produk_id'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    // Query untuk memperbarui produk
    $query = "UPDATE produk SET nama = '$nama', harga = '$harga', stok = '$stok' WHERE produk_id = '$produk_id'";

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
    <title>Document</title>
</head>
<body>
<!-- Modal edit data -->
<div class="modal fade" id="editDataModal" tabindex="-1" role="dialog" aria-labelledby="editDataModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDataModalLabel">Edit Data Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editPenggunaForm" method="POST" action="user/proses_edit.php">
                        <input type="hidden" id="edit_user_id" name="user_id">
                        <div class="form-group">
                            <label for="edit_role_id">Role</label>
                            <select class="form-control" id="edit_role_id" name="role_id">
                                <option value="1">Admin</option>
                                <option value="2">Penjual</option>
                                <option value="3">User</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_nama_lengkap">Nama Lengkap</label>
                            <input required type="text" class="form-control" id="edit_nama_lengkap" name="nama_lengkap">
                        </div>
                        <div class="form-group">
                            <label for="edit_no_hp">No. HP</label>
                            <input required type="text" class="form-control" id="edit_no_hp" name="no_hp">
                        </div>
                        <div class="form-group">
                            <label for="edit_email">Email</label>
                            <input required type="email" class="form-control" id="edit_email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="edit_password">Password</label>
                            <input type="password" class="form-control" id="edit_password" name="password">
                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password</small>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


<script>
   $('#editDataModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Tombol yang memicu modal
    var userId = button.data('userid'); // Ambil nilai user_id dari atribut data-* tombol
    var modal = $(this);

    // Lakukan permintaan AJAX untuk mengambil data pengguna
    $.ajax({
        url: 'get_user_data.php', // Ganti dengan URL yang benar untuk mengambil data pengguna
        type: 'GET',
        data: { user_id: userId },
        success: function(data) {
            var user = JSON.parse(data);
            if (user.error) {
                alert(user.error);
            } else {
                modal.find('#edit_user_id').val(user.id);
                modal.find('#edit_role_id').val(user.role_id);
                modal.find('#edit_nama_lengkap').val(user.nama_lengkap);
                modal.find('#edit_no_hp').val(user.no_hp);
                modal.find('#edit_email').val(user.email);
                // Password tidak diisi karena pengguna mungkin tidak ingin mengubahnya
            }
        },
        error: function() {
            alert('Gagal mengambil data pengguna.');
        }
    });
});


</script>
</body>
</html>
?>