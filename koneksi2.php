<?php
$servername = "localhost";  // Ganti dengan host database jika diperlukan
$username = "root";         // Ganti dengan username database jika diperlukan
$password = "";             // Ganti dengan password database jika diperlukan
$dbname = "vamous";         // Ganti dengan nama database yang sesuai

// Membuat koneksi
$koneksi = mysqli_connect($servername, $username, $password, $dbname);

// Memeriksa koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
