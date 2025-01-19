<?php
$pageTitle = "VAMOUS";
require 'navbar-user.php';
require 'koneksi2.php';

// Query untuk mengambil data produk
$query = "SELECT foto_produk1, foto_produk2 FROM produk LIMIT 1"; // Mengambil satu baris data produk
$result = mysqli_query($koneksi, $query);

// Pastikan ada data yang ditemukan
if ($row = mysqli_fetch_assoc($result)) {
    $foto_produk1 = $row['foto_produk1'];
    $foto_produk2 = $row['foto_produk2'];
}

// Query untuk mengambil data produk tertentu
$query = "SELECT nama_produk, harga_produk FROM produk WHERE id_produk = 1"; // Ganti `1` dengan ID produk yang relevan
$result = mysqli_query($koneksi, $query);

// Ambil data produk jika ditemukan
if ($row = mysqli_fetch_assoc($result)) {
    $nama_produk = $row['nama_produk'];
    $harga_produk = $row['harga_produk'];
} else {
    $nama_produk = "Produk tidak ditemukan";
    $harga_produk = 0;
}

// Menangani pengiriman form
$successMessage = ""; // Variabel untuk pesan sukses
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $size = mysqli_real_escape_string($koneksi, $_POST['size']);
    $quantity = mysqli_real_escape_string($koneksi, $_POST['quantity']);
    $nama_produk = mysqli_real_escape_string($koneksi, $_POST['nama_produk']);
    $harga = mysqli_real_escape_string($koneksi, $_POST['harga']);

    // Menyimpan produk ke dalam database checkout (tabel checkout) tanpa mengalihkan ke halaman lain
    $query_insert = "INSERT INTO checkout (nama_produk, size, quantity, harga) VALUES ('$nama_produk', '$size', '$quantity', '$harga')";
    $result_insert = mysqli_query($koneksi, $query_insert);
    
    if ($result_insert) {
        // Set pesan sukses
        $successMessage = "Produk berhasil ditambahkan ke keranjang! <a href='checkout.php' class='alert-link'>Beralih ke halaman Checkout!</a>";
    } else {
        $successMessage = "Gagal menambahkan produk ke keranjang.";
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
    #carouselExampleCaptions {
        max-width: 1080px; 
        margin: auto; 
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

    .selected-size {
        background-color: black !important;
        color: white !important;
    }
    
    .alert {
        color: white;
        border-radius: 0 !important;
        border-color: #000 !important;
        background-color: black;
        font-size: 12px;
    }

    .alert a {
      color: white;
    }
</style>

<body>
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="beranda-user.php">Beranda</a></li>
            <li class="breadcrumb-item" aria-current="page">Detail Produk</li>
        </ol>
    </nav>

    <!-- Bootstrap Alert Message -->
    <?php if ($successMessage): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $successMessage; ?>
        </div>
    <?php endif; ?>

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
                    <!-- Slide 1 -->
                    <div class="carousel-item active">
                        <img src="<?php echo $foto_produk1; ?>" class="d-block w-100" alt="Slide 1">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Slide 1</h5>
                            <p>Deskripsi gambar pertama.</p>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="carousel-item">
                        <img src="<?php echo $foto_produk2; ?>" class="d-block w-100" alt="Slide 2">
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
            <!-- Nama Produk -->
            <h2><?php echo isset($nama_produk) ? $nama_produk : 'Nama Produk Tidak Ditemukan'; ?></h2>
            <small>RP <?php echo isset($harga_produk) ? number_format($harga_produk, 0, ',', '.') : '0'; ?> IDR</small>
            <br><br>

            <!-- Ukuran Produk -->
            <form method="POST" action="">
                <input type="hidden" name="nama_produk" value="VAMOUS - 'REVERS!' Statement T-Shirt (WHITE)">
                <input type="hidden" name="harga" value="300000">

                <button type="button" class="btn me-2 size-btn" data-size="S">S</button>
                <button type="button" class="btn me-2 size-btn" data-size="M">M</button>
                <button type="button" class="btn me-2 size-btn" data-size="L">L</button>
                <button type="button" class="btn me-2 size-btn" data-size="XL">XL</button>
                <input type="hidden" id="size" name="size" required>
                <br><br>

                <!-- Jumlah Produk -->
                <div class="input-group">
                    <button class="btn btn-outline-secondary" type="button" id="decrement">-</button>
                    <input type="text" class="form-control text-center" id="quantity" name="quantity" value="1" readonly>
                    <button class="btn btn-outline-secondary" type="button" id="increment">+</button>
                </div>
                <br>

                <!-- Tombol -->
                <div class="button">
                    <button type="submit" name="add_to_cart" class="btn" style="width: 499px;">PESAN SEKARANG</button>
                    <!-- Keranjang -->
                    <a href="keranjang-user.php" class="btn"><i class="bi bi-cart2"></i></a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fungsi untuk mengubah ukuran yang dipilih
        const sizeButtons = document.querySelectorAll('.size-btn');
        const sizeInput = document.getElementById('size');

        sizeButtons.forEach(button => {
            button.addEventListener('click', function() {
                sizeButtons.forEach(btn => btn.classList.remove('selected-size'));
                button.classList.add('selected-size');
                sizeInput.value = button.getAttribute('data-size');
            });
        });

        // Fungsi untuk mengubah jumlah
        let quantityInput = document.getElementById('quantity');
        let decrementButton = document.getElementById('decrement');
        let incrementButton = document.getElementById('increment');

        decrementButton.addEventListener('click', function() {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        });

        incrementButton.addEventListener('click', function() {
            let currentValue = parseInt(quantityInput.value);
            quantityInput.value = currentValue + 1;
        });
    });
</script>
</body>
</html>

<?php require 'footer.php'; ?>