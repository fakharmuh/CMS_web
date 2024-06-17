<?php
session_start();
$server = "localhost";
$user = "root";
$pass = "";
$database = "webpage";
$conn = mysqli_connect($server, $user, $pass, $database);
if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>
