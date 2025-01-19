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
    .btn {
        background-color: white;
        color: black;
        border: 1;
        border-color: black;
    }
    .input-group {
        padding-right: 358px;
    }
    footer a {
        color: black;
        font-size: 12px;
    }
    #carouselExampleCaptions {
    max-width: 1080px; /* Menyesuaikan lebar maksimal carousel dengan ukuran gambar */
    margin: auto; /* Pusatkan carousel */
  }

  /* Atur gambar agar semua bagian terlihat */
  #carouselExampleCaptions img {
    height: 100%;
    width: 100%;
    object-fit: contain; /* Pastikan gambar tampil utuh tanpa cropping */
  }

  /* Atur tinggi carousel */
  .carousel-inner {
    height: 300px; 
  }
  h2 {
    font-weight: 700;
    color: black;
  }
</style>
<body>
<div class="container">
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="beranda.php">Beranda</a></li>
        <li class="breadcrumb-item" aria-current="page">Detail Produk</li>
    </ol>
    </nav>
</div>

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-6">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
  </div>
  <div class="carousel-inner" style="height: 300px;">
    <div class="carousel-item active">
      <img src="img/a.jpg" class="d-block w-100" alt="Slide 1">
      <div class="carousel-caption d-none d-md-block">
        <h5>Slide 1</h5>
        <p>Deskripsi gambar pertama.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="img/b.jpg" class="d-block w-100" alt="Slide 2">
      <div class="carousel-caption d-none d-md-block">
        <h5>Slide 2</h5>
        <p>Deskripsi gambar kedua.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

        </div>
        <div class="col-6">
            <h2>VAMOUS - "REVERS!" Statement T-Shirt (WHITE)</h2>
            <small>RP 300.000,- IDR</small>
            <br><br>
            <button type="button" class="btn me-2">S</button>
            <button type="button" class="btn me-2">M</button>
            <button type="button" class="btn me-2">L</button>
            <button type="button" class="btn me-2">XL</button>
            <br><br>
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

            <br>
            <div class="button">
                <a href="login.php" class="btn" style="width: 499px;">PESAN SEKARANG</a>
                <a href="keranjang.php" class="btn"><i class="bi bi-cart2"></i></a>
            </div>
        </div>
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
    <br>
</footer>