<?php
$pageTitle = "VAMOUZ";
require 'navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
    form {
        padding-left: 200px;
        padding-right: 200px;
    }
    .form-control {
        border-radius: 0 !important;
        border-color: #000 !important;
        color: #000;
        font-size: 12px;
        padding: 15px;
    }
    .btn {
        background-color: black;
        border-radius: 0px;
        color: white;
    }
    footer a {
        color: black;
        font-size: 12px;
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
<form class="row g-3 mt-1 mb-5">
<h2 class="text-center mb-5">Apa yang bisa kami bantu?</h2>
  <div class="col-md-6">
    <label for="inputEmail4" class="form-label">Nama</label>
    <input type="name" class="form-control" id="inputName4">
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Email</label>
    <input type="email" class="form-control" id="inputEmail4">
  </div>
  <div class="col-12">
    <label for="inputAddress" class="form-label">Pesan</label>
    <textarea class="form-control" id="message" rows="7"></textarea>
</div>
  <div class="col-12">
    <button type="submit" class="btn">Kirim</button>
  </div>
</form>
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
    <br>
</footer>