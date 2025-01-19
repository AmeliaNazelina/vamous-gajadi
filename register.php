<?php
$pageTitle = "Sign Up";
require 'navbar.php'; 
require 'koneksi.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_depan = mysqli_real_escape_string($conn, $_POST['nama_depan']);
    $nama_belakang = mysqli_real_escape_string($conn, $_POST['nama_belakang']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Set role sebagai 'user' secara eksplisit
    $role = 'user';

    $query = "INSERT INTO akun (nama_depan, nama_belakang, email, sandi, role) 
              VALUES ('$nama_depan', '$nama_belakang', '$email', '$password', '$role')";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Akun berhasil dibuat!'); window.location.href = 'login.php';</script>";
    } else {
        echo "<script>alert('Gagal membuat akun. Silakan coba lagi.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>
</head>

<style>
    .card {
        margin-top: -200px;
        border: none;
    }
    .card h2 {
        font-weight: 700;
    }
    .btn {
        background-color: black;
        color: white;
        border-radius: 0px;
    }
    .nav {
        display: none;
    }
    a {
        color: black;
        font-size: 12px;
    }
    .form-control {
        border-radius: 0 !important;
        border-color: #000 !important;
        color: #000;
        font-size: 12px;
        padding: 15px;
    }
    footer {
        margin-top: -200px;
    }
</style>
<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4" style="width: 500px;">
            <h2 class="text-center mb-4">BUAT AKUN</h2>
            <form method="POST">
                <div class="mb-3">
                    <input type="text" class="form-control" name="nama_depan" placeholder="Nama depan" required>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" name="nama_belakang" placeholder="Nama belakang" required>
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Sandi" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn">Buat Akun</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

<footer>
    <hr>
    <div class="container">
        <a href="#" style="font-size: 15px;"><i class="bi bi-instagram me-2"></i>Vamouz</a>
        <br><br><a href="tracking.php">Lacak Pesanan</a>
        <br><a href="cs.php">Customer Service</a>
    </div>
</footer>
