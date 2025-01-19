<?php
session_start(); // Pastikan session sudah dimulai

$pageTitle = "Akun";
require 'navbar-user.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login.php");
    exit();
}

// Koneksi ke database
require 'koneksi.php'; // Ganti dengan file koneksi DB kamu

$user_id = $_SESSION['user_id']; // ID pengguna yang login

// Ambil data pengguna berdasarkan ID (ganti 'id' menjadi 'id_akun')
$query = "SELECT nama_depan, nama_belakang, alamat FROM akun WHERE id_akun = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$user_id]);
$user = $stmt->fetch();

// Jika pengguna tidak ditemukan, arahkan kembali ke halaman login
if (!$user) {
    // Cek apakah session ID ada tetapi tidak ditemukan di database, bisa berarti session sudah kadaluarsa
    session_destroy(); // Hancurkan session jika pengguna tidak ada
    header("Location: login.php"); // Arahkan ke login
    exit();
}

// Gabungkan nama depan dan belakang
$full_name = $user['nama_depan'] . " " . $user['nama_belakang'];

// Cek alamat
$alamat = $user['alamat'] ? $user['alamat'] : 'Alamat belum diatur';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<style>
    .icon-text a {
        color: black;
        font-size: 12px;
    }
    h1 {
        font-weight: 700;
    }
    h4 {
        font-weight: 500;
        color: black;
    }
    .icon-text {
        display: flex;
        align-items: center; 
    }
    .icon-text i {
        margin-right: 5px; 
        font-size: 17px;
    }
    .btn {
        background-color: black;
        color: white;
        border-radius: 0px;
        padding-left: 30px;
        padding-right: 30px;
        padding-top: 10px;
        padding-bottom: 10px;
        font-size: 15px;
        font-weight: 300;
    }
    .card h5 {
        font-size: 12px;
    }
    .card p {
        font-size: 10px;
    }
    .card p a {
        color: black;
    }
    .card-body {
        padding: 10px;
    }
    .col-3 .d-flex {
        height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 20px;
        background-color: #f8f9fa;
    }
    .d-flex p {
        margin-bottom: 1px;
    }
    .d-flex a {
        color: black;
        font-size: 12px;
    }
</style>

<body>
    <div class="container mt-3 mb-5">
        <div class="row">
            <div class="col-3">
                <h1>Akun</h1>
                <div class="icon-text">
                    <i class="bi bi-box-arrow-left me-2"></i><a href="beranda.php">Logout</a>
                </div>
                <br><br>
                <a href="tracking-user.php" class="btn">Lacak Pesanan</a>
                <br><hr>
                <h4>Riwayat Pesanan</h4>
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="img/produk.jpg" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">VAMOUS - "REVERS!" Statement T-Shirt (WHITE)</h5>
                                <p class="card-text"><small class="text-body-secondary"><a href="keranjang.php">Lihat selengkapnya</a></small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6"></div>
            <div class="col-3 d-flex">
                <div class="mt-auto" style="color: black;">
                    <h3 style="font-weight: 700;">Detail Akun</h3>
                    <p style="font-weight: 600;"><?= htmlspecialchars($full_name) ?></p> 
                    <p style="font-size: 12px;"><?= htmlspecialchars($alamat) ?></p>  
                    <br>
                    <a href="alamat.php">Ubah alamat</a>  
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php require 'footer.php'; ?>
