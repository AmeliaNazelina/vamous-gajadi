<?php
$host     = "localhost"; 
$username = "root";      
$password = "";          
$dbname   = "vamous";    

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Membuat koneksi PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Mengatur error mode PDO untuk menangkap exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Menangani error koneksi
    echo "Koneksi gagal: " . $e->getMessage();
    exit();
}
?>
