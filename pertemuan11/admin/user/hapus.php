<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Penghapusan</title>
    <!-- Tambahkan link ke Bootstrap CSS di sini -->
</head>
<body>
    <!-- Modal HTML -->
    <div class="modal fade" id="hapusDataModal" tabindex="-1" role="dialog" aria-labelledby="hapusDataModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hapusDataModalLabel">Konfirmasi Penghapusan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data pengguna ini?
                    <form id="deletePenggunaForm" method="POST" action="user/proses_hapus.php">
                        <input type="hidden" id="delete_user_id" name="user_id">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger" form="deletePenggunaForm">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambahkan link ke jQuery dan Bootstrap JS di sini -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <script>
        $('#hapusDataModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Tombol yang memicu modal
            var userId = button.data('userid'); // Ambil nilai user_id dari atribut data-* tombol
            var modal = $(this);
            modal.find('#delete_user_id').val(userId); // Set nilai user_id di dalam form
        });
    </script>
</body>
</html>
