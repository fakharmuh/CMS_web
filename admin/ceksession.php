<?php
// Cek apakah pengguna sudah login atau belum
if (!isset($_SESSION['email'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login.php");
    exit();
}

// Jika sudah login, lanjutkan ke halaman yang diminta
?>
