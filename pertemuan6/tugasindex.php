<?php
session_start();

// Cek apakah user sudah login
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    echo "Halo, $username! <a href='logouttugas.php'>Logout</a>";
} else {
    // Jika belum login, tampilkan form login
    echo "
    <form action='login.php' method='post'>
        Username: <input type='text' name='username'><br>
        Password: <input type='password' name='password'><br>
        <input type='submit' value='Login'>
    </form>";
}

// Jika user sudah login, tampilkan form upload file
if(isset($_SESSION['username'])){
    echo "
    <form action='uploadtugas.php' method='post' enctype='multipart/form-data'>
        <input type='file' name='file'><br>
        <input type='submit' value='Upload'>
    </form>";
}

// Proses logout
if(isset($_GET['action']) && $_GET['action'] == 'logout'){
    session_destroy();
    header('Location: tugasindex.php');
    exit;
}
?>