<?php
$pageTitle = "VAMOUZ";
require 'navbar-user.php';
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
    .input-group {
        margin-top: 20px;
        padding-right: 470px;
    }
    h1 {
        font-weight: 700;
    }
    .card-text {
        font-size: 25px;
        margin-bottom: -5px;
    }
    .card-text small {
        font-size: 15px;
    }
    .card-body {
        padding: 35px;
    }
    .float-end {
        z-index: 5;
        font-size: 25px;
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
<div class="card mb-3" style="max-width: auto;">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="img/produk.jpg" class="img-fluid rounded-start" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h1 class="card-title">VAMOUS - "REVERS!" Statement T-Shirt (WHITE)</h1>
        <p class="card-text">RP 300.000,- IDR</p>
        <p class="card-text">Size: M</p>
            <div class="input-group">
                <button class="btn btn-outline-secondary" type="button" id="decrement">-</button>
                <input type="text" class="form-control text-center" id="quantity" value="1" readonly>
                <button class="btn btn-outline-secondary" type="button" id="increment">+</button>
            </div>

            <script>
                document.getElementById('decrement').addEventListener('click', function () {
                    var quantity = document.getElementById('quantity');
                    if (parseInt(quantity.value) > 1) {
                        quantity.value = parseInt(quantity.value) - 1;
                    }
                });

                document.getElementById('increment').addEventListener('click', function () {
                    var quantity = document.getElementById('quantity');
                    quantity.value = parseInt(quantity.value) + 1;
                });
            </script>
        <p class="card-text"><small>Perkiraan barang sampai pada tanggal 19/11/2024</small></p>
        <a href="#" class="btn float-end"><i class="bi bi-trash3"></i></a>
      </div>
    </div>
  </div>
</div>
</div>
</body>
</html>

<?php require 'footer.php'; ?>