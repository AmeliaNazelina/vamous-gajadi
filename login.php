<?php
session_start(); // Pastikan session dimulai

$pageTitle = "Sign In";
require 'navbar.php'; // Ganti dengan navbar yang sesuai

require 'koneksi.php';

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Query untuk mengambil data pengguna berdasarkan email
    $query = "SELECT * FROM akun WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
    
        // Verifikasi password tanpa hashing (langsung bandingkan)
        if ($password === $user['sandi']) {  
            // Menyimpan data pengguna di session
            $_SESSION['user_id'] = $user['id_akun'];  // Menyimpan ID pengguna yang benar
            $_SESSION['role'] = $user['role'];  // Menyimpan role pengguna
            $_SESSION['email'] = $user['email']; // Menyimpan email pengguna
            $_SESSION['alamat'] = $user['alamat']; // Menyimpan alamat pengguna

            // Periksa role pengguna dan arahkan ke halaman yang sesuai
            if ($user['role'] === 'admin') {
                header("Location: beranda-admin.php");
                exit();
            } elseif ($user['role'] === 'user') {
                header("Location: beranda-user.php");
                exit();
            } else {
                $error_message = "Role tidak valid.";
            }
        } else {
            $error_message = "Sandi atau email yang kamu input salah!";
        }
    } else {
        $error_message = "Sandi atau email yang kamu input salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        color: black;
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
            <h2 class="text-center mb-4">LOGIN</h2>
            <form method="POST">
                <div class="mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Sandi" required>
                </div>
                <div class="mb-3">
                    <a href="#">Lupa sandi?</a>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn">Masuk</button>
                </div>
            </form>
            <div class="text-center mt-3">
                <a href="register.php">Buat Akun</a>
            </div>
            <?php if ($error_message) : ?>
                <div class="alert alert-danger mt-3" role="alert">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

<?php 
    require 'footer.php';
?>
