<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Contoh Website</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include('header.php'); ?>
    <main>
        <h1>Selamat datang di ruang Diskusi</h1>
        <p>Silahkan Registrasikan diri Anda jika berminat menggunakan layanan kami</p>
        <form action="result.php" method="POST">
            <div class="row">
                <label for="name">Nama</label>
                <input type="text" name="name" id="name" placeholder="Nama">
            </div>
            <div class="row">
                <label for="placeofbirth">Tempat Lahir</label>
                <input type="text" name="placeofbirth" id="placeofbirth" placeholder="Tempat Lahir">
            </div>
            <div class="row">
                <label for="birthdate">Tanggal Lahir</label>
                <input type="date" id="birthdate" name="birthdate">
            </div>
            <div class="row">
                <div>
                    <label for="gender">Jenis Kelamin</label>
                    <input type="radio" id="laki" name="gender" value="Laki-laki">
                    <label for="laki">Laki-laki</label>
                </div>
                <div>
                    <input type="radio" id="perempuan" name="gender" value="Perempuan">
                    <label for="perempuan">Perempuan</label>
                </div>
            </div>
            <div class="row">
                <label for="age">Usia</label>
                <input type="number" id="age" name="age" min="1" max="99" placeholder="Usia">
            </div>
            <div class="row">
                <label for="tingkat">Pilih Tingkat</label>
                <select id="tingkat" name="tingkat">
                    <option value="choose" disabled>Pilih Tingkat</option>
                    <option value="SD">SD</option>
                    <option value="SMP">SMP</option>
                    <option value="SMA">SMA</option>
                    <option value="Diploma">Diploma</option>
                    <option value="Sarjana">Sarjana</option>
                </select>
            </div>
            <div class="row">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Email">
            </div>
            <div class="row">
                <label for="phone">Nomor HP</label>
                <input type="text" name="phone" id="phone" placeholder="Nomor HP">
            </div>
            <div class="row">
                <button type="submit" name="submit">Registrasi!</button>
            </div>
        </form>
    </main>
    <?php include('footer.php'); ?>
</body>

</html>