<?php
session_start(); // Pastikan session sudah dimulai

$pageTitle = "VAMOUZ";
require 'navbar-user.php';

$error_message = '';
$success_message = '';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login.php");
    exit();
}

// Ambil data pengguna berdasarkan ID yang ada di session
require 'koneksi.php'; // Ganti dengan file koneksi DB kamu

$user_id = $_SESSION['user_id']; // ID pengguna yang login
$query = "SELECT nama_depan, nama_belakang, email FROM akun WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$user_id]);
$user = $stmt->fetch();

// Jika pengguna tidak ditemukan, arahkan kembali ke halaman login
if (!$user) {
    session_destroy(); // Hancurkan session jika pengguna tidak ada
    header("Location: login.php"); // Arahkan ke login
    exit();
}

$name = $user['nama_depan'] . ' ' . $user['nama_belakang'];
$email = $user['email'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = htmlspecialchars($_POST['message']);
    
    // Validasi pesan
    if (empty($message)) {
        $error_message = "Pesan tidak boleh kosong!";
    } else {
        // Simpan pesan ke database
        $query = "INSERT INTO pesan_kontak (nama, email, pesan) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($query);
        if ($stmt->execute([$name, $email, $message])) {
            $success_message = "Pesan berhasil dikirim! Kami akan menghubungi Anda segera.";
        } else {
            $error_message = "Terjadi kesalahan saat menyimpan pesan. Coba lagi nanti.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubungi Kami</title>
</head>

<style>
    form {
        padding-left: 200px;
        padding-right: 200px;
    }
    .btn {
        background-color: black;
        border-radius: 0px;
        color: white;
    }
    h2 {
        font-weight: 700;
        color: black;
    }
    .breadcrumb {
        font-size: 12px;
        color: black;
    }
    .breadcrumb a {
        color: rgba(0, 0, 0, 0.4);
        text-decoration: none;
    }
    .form-control {
        border-radius: 0 !important;
        border-color: #000 !important;
        color: #000;
        font-size: 12px;
        padding: 15px;
    }
</style>
<body>

<div class="container">
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="beranda.php">Beranda</a></li>
        <li class="breadcrumb-item" aria-current="page">Hubungi Kami</li>
    </ol>
    </nav>
</div>

<div class="container">
    <?php if ($error_message): ?>
        <div class="alert alert-danger" role="alert">
            <?= $error_message ?>
        </div>
    <?php endif; ?>
    
    <?php if ($success_message): ?>
        <div class="alert alert-success" role="alert">
            <?= $success_message ?>
        </div>
    <?php endif; ?>

    <form method="POST" class="row g-3 mt-5 mb-5">
        <h2 class="text-center mb-5">Apa yang bisa kami bantu?</h2>
        <div class="col-md-6">
            <label for="inputName4" class="form-label">Nama</label>
            <input type="text" name="name" class="form-control" id="inputName4" value="<?= htmlspecialchars($name) ?>" readonly>
        </div>
        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="inputEmail4" value="<?= htmlspecialchars($email) ?>" readonly>
        </div>
        <div class="col-12">
            <label for="inputAddress" class="form-label">Pesan</label>
            <textarea name="message" class="form-control" id="message" rows="7" required></textarea>
        </div>
        <div class="col-12">
            <button type="submit" class="btn">Kirim</button>
        </div>
    </form>
</div>
</body>
</html>

<?php require 'footer.php'; ?>