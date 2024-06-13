<?php
session_start();

function check_access($required_role) {
    if (!isset($_SESSION['role_id'])) {
        // Jika tidak ada role_id di session, redirect ke halaman login
        header("Location: login.php");
        exit();
    }

    $role_id = $_SESSION['role_id'];
    
    // Cek apakah peran pengguna memenuhi syarat akses
    if ($required_role === 'admin' && $role_id != 1) {
        // Jika role_id bukan admin
        header("Location: index.php");
        exit();
    } elseif ($required_role === 'penjual' && $role_id != 1 && $role_id != 3) {
        // Jika role_id bukan admin atau penjual
        header("Location: index.php");
        exit();
    } elseif ($required_role === 'user' && $role_id != 2) {
        // Jika role_id bukan user
        header("Location: index.php");
        exit();
    }
}
