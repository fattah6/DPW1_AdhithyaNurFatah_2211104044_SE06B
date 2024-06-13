<?php
if (isset($_POST['submit'])) {
    $nama = $_POST['name'];
    $tempat_lahir = $_POST['placeofbirth'];
    $tanggal_lahir = $_POST['birthdate'];
    $jenis_kelamin = isset($_POST['gender']) ? $_POST['gender'] : ''; // Periksa apakah kunci 'gender' ada dalam $_POST
    $umur = $_POST['age'];
    $tingkat = $_POST['tingkat'];
    $email = $_POST['email'];
    $nomor_hp = $_POST['phone'];

    // Memeriksa apakah semua input telah diisi
    if (empty($nama) || empty($tempat_lahir) || empty($tanggal_lahir) || empty($jenis_kelamin) || empty($umur) || $tingkat == "choose" || empty($email) || empty($nomor_hp)) {
        echo "Mohon lengkapi semua kolom isian.";
    } else {
        // Semua input telah diisi
        // Lanjutkan dengan pemrosesan data atau tindakan lainnya
        echo "Terima kasih telah melakukan registrasi!<br>";
        echo "Berikut adalah ringkasan registrasi Anda:<br>";
        echo "<strong>Nama:</strong> $nama<br>";
        echo "<strong>Tempat Lahir:</strong> $tempat_lahir<br>";
        echo "<strong>Tanggal Lahir:</strong> $tanggal_lahir<br>";
        echo "<strong>Jenis Kelamin:</strong> $jenis_kelamin<br>";
        echo "<strong>Usia:</strong> $umur tahun<br>";
        echo "<strong>Tingkat:</strong> $tingkat<br>";
        echo "<strong>Email:</strong> $email<br>";
        echo "<strong>Nomor HP:</strong> $nomor_hp<br>";
    }
}
