<?php
session_start();

// Hapus session
session_destroy();

// Redirect ke halaman login
header('Location: tugasindex.php?action=logout');
exit;
?>