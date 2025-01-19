<?php
$pageTitle = "VAMOUS";
require 'navbar-user.php';

require 'koneksi.php';

// Membuat query untuk mengambil gambar berdasarkan ID 1, 2, dan 3
$query = "SELECT gambar FROM konten WHERE id IN (1, 2, 3)";
$stmt = $pdo->prepare($query);
$stmt->execute();

// Menyimpan hasil gambar ke dalam array
$gambar = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $gambar[] = $row['gambar'] ?? 'default-image.jpg';  // Jika tidak ada gambar, tampilkan gambar default
}

// Jika tidak ada gambar yang ditemukan, set gambar default
if (count($gambar) < 3) {
    $gambar = ['default-image.jpg', 'default-image.jpg', 'default-image.jpg'];
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<style>
    .content {
        font-size: 22px;
        color: black;
        padding-left: 500px;
        padding-right: 500px;
    }
    .content span {
        font-weight: 700;
    }
    .content .text {
        font-size: 15px;
    }
    .product {
        padding-left: 300px;
        padding-right: 300px;
    }
    .product .card {
        border: 1px;
        color: black;
    }
    .btn {
        border: 1;
        border-color: white;
        color: white;
        border-radius: 0;
        font-size: 15px;
        margin-top: 600px;
        font-weight: 700;
        padding-left: 250px;
        padding-right: 250px;
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
        <li class="breadcrumb-item"><a href="beranda-user.php">Beranda</a></li>
        <li class="breadcrumb-item" aria-current="page">Item</li>
    </ol>
    </nav>
</div>

<div id="carouselExampleCaptions" class="carousel slide mb-5" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="konten/<?php echo htmlspecialchars($gambar[0]); ?>" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <a href="detail-product-user.php" class="btn">CHECKOUT</a>
      </div>
    </div>
    <div class="carousel-item">
      <img src="konten/<?php echo htmlspecialchars($gambar[1]); ?>" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <a href="detail-product-user.php" class="btn" style="color: white; border-color: #962A2B; background-color: #962A2B;">CHECKOUT</a>
      </div>
    </div>
    <div class="carousel-item">
      <img src="konten/<?php echo htmlspecialchars($gambar[2]); ?>" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
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

</body>
</html>

<?php require 'footer.php'; ?>