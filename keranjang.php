<?php
$pageTitle = "VAMOUZ";
require 'navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
    .breadcrumb {
        font-size: 12px;
        color: black;
    }
    .breadcrumb a {
        color: rgba(0, 0, 0, 0.4);
        text-decoration: none;
    }
    h3 {
        font-weight: 700;
        margin-top: 150px;
    }
    a {
        color: black;
    }
</style>
<body>
<div class="container">
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="beranda.php">Beranda</a></li>
        <li class="breadcrumb-item" aria-current="page">Keranjang</li>
    </ol>
    </nav>
</div>

<div class="container">
    <div class="text-center">
        <h3>Oops! Anda belum memesan apapun!</h3>
        <p><small><a href="register.php">Buat akun?</a></small></p>
    </div>
</div>
</body>
</html>