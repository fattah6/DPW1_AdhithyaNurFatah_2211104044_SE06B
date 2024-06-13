<?php
session_start();

// Data user
$valid_username = 'user';
$valid_password = 'pass';

// Jika form login di-submit
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['fatah'];
    $password = $_POST['fatah'];
    
    // Jika username dan password sesuai
    if($username == $valid_username && $password == $valid_password){
        $_SESSION['username'] = $username;
        header('Location: tugasindex.php');
        exit;
    } else {
        echo "Username atau password salah!";
    }
}
?>