<?php
session_start(); // Start the session to access user login data
include 'koneksi.php'; // Database connection

$pageTitle = "VAMOUZ";
require 'navbar-user.php';

$bgColor = 'black';
$textColor = 'white';

// Default values for user email and address
$email = "Pengguna belum login";
$alamat = "Alamat tidak ditemukan";

// Default values for checkout products
$produk_checkout = []; // Array to hold checkout products
$total_subtotal = 0; // Initialize total subtotal
$diskon = 0; // Variable for discount value

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Fetch user email and address from the database
    $query_user = "SELECT email, alamat FROM akun WHERE id_akun = ?";
    $stmt_user = $conn->prepare($query_user);
    $stmt_user->bind_param("i", $user_id);
    $stmt_user->execute();
    $stmt_user->store_result();

    // If user data is found, fetch the results
    if ($stmt_user->num_rows > 0) {
        $stmt_user->bind_result($email, $alamat);
        $stmt_user->fetch();
    }
    $stmt_user->close();

    // Fetch products from the checkout table
    $query_product = "SELECT nama_produk, harga, quantity, size FROM checkout WHERE id_akun = ?";
    $stmt_product = $conn->prepare($query_product);
    $stmt_product->bind_param("i", $user_id);
    $stmt_product->execute();
    $result_product = $stmt_product->get_result();

    // If products are found, add them to the checkout array and calculate total subtotal
    while ($product = $result_product->fetch_assoc()) {
        $produk_checkout[] = $product;
        $total_subtotal += $product['harga'] * $product['quantity']; // Accumulate the subtotal for each product
    }
    $stmt_product->close();

    // Check if a discount code is submitted
    if (isset($_POST['kode_diskon'])) {
        $kode_diskon = $_POST['kode_diskon'];

        // Query to check if the discount code is valid
        $query_diskon = "SELECT nilai_diskon, jenis_diskon FROM diskon WHERE kode_diskon = ? AND tanggal_mulai <= CURDATE() AND tanggal_berakhir >= CURDATE() AND status = 'ACTIVE'";
        $stmt_diskon = $conn->prepare($query_diskon);
        $stmt_diskon->bind_param("s", $kode_diskon);
        $stmt_diskon->execute();
        $stmt_diskon->store_result();

        // If the discount code is valid, fetch the discount values
        if ($stmt_diskon->num_rows > 0) {
            $stmt_diskon->bind_result($nilai_diskon, $jenis_diskon);
            $stmt_diskon->fetch();

            // Calculate the discount based on the type of discount
            if ($jenis_diskon == 'PERCENT') {
                $diskon = ($total_subtotal * $nilai_diskon) / 100; // Calculate percentage discount
            } elseif ($jenis_diskon == 'NOMINAL') {
                $diskon = $nilai_diskon; // Apply fixed nominal discount
            }
        }
        $stmt_diskon->close();
    }

    $successMessage = ""; // Pesan sukses jika penghapusan berhasil
    $errorMessage = "";   // Pesan error jika terjadi kesalahan
    
    // Cek jika ada form yang dikirim
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_checkout'])) {
        $id_checkout = intval($_POST['id_checkout']);
    
        // Proses penghapusan data
        $query_delete = "DELETE FROM checkout WHERE id_checkout = $id_checkout";
        $result = mysqli_query($conn, $query_delete);
    
        if ($result) {
            // Pesan sukses dengan link
            echo "<script>
                alert('Data berhasil dihapus. Beralih ke halaman sebelumnya.');
                window.location.href = 'detail-product-user.php';
            </script>";
            exit;
        } else {
            echo "Terjadi kesalahan saat menghapus data.";
        }        
    }

    $query_checkout = "SELECT id_checkout, id_akun, nama_produk, size, quantity, harga, created_at FROM checkout";
    $result = mysqli_query($conn, $query_checkout);

    // Simpan hasil query dalam array
    $dataCheckout = [];
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $dataCheckout[] = $row;
        }
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
    .nav {
        margin-bottom: -15px;
    }
    h6 {
        padding: 15px;
    }
    .card {
        border: none;
    }
    img {
        border-radius: 5px;
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
        color: white;
        border-radius: 0px;
        font-size: 12px;
        padding: 10px;
    }
    .col-7 {
        padding-left: 30px;
    }
    label {
        font-size: 12px;
    }
    .form-select {
        border-radius: 0 !important;
        border-color: #000 !important;
        color: #000;
        font-size: 12px;
        padding: 15px;
        box-shadow: none;
    }
    .form-select:focus {
        box-shadow: none;
    }
    .breadcrumb {
        font-size: 12px;
        color: black;
    }
    .breadcrumb a {
        color: rgba(0, 0, 0, 0.4);
        text-decoration: none;
    }
    .form-check {
        margin-left: 11px;
    }
    .form-check-input:checked {
        background-color: black;
        border-color: black;
        box-shadow: none;
    }
    .form-check-input:hover {
        box-shadow: none;
    }
    .form-check-input:checked:focus {
        box-shadow: none;
    }
    .form-check-input:checked::before {
        color: white; 
    }
    .form-check-input {
        box-shadow: none;
    }
    .dropdownText {
        font-size: 12px;
    }
    .dropdownText p {
        margin-left: 23px;
    }
    .dropdownText {
        transition: all 0.3s ease; /* Animasi untuk kelancaran */
        height: auto; /* Pastikan tingginya menyesuaikan */
        overflow: hidden; /* Hindari elemen bocor */
    }
    .alert {
        color: white;
        border-radius: 0 !important;
        border-color: #000 !important;
        background-color: black;
        font-size: 12px;
    }
</style>
<body>
<div class="container">
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="beranda-user.php">Beranda</a></li>
        <li class="breadcrumb-item" aria-current="page">Checkout</li>
    </ol>
    </nav>
</div>

<?php if ($successMessage): ?>
        <div class="alert">
            <?php echo $successMessage; ?>
        </div>
    <?php endif; ?>

    <?php if ($errorMessage): ?>
        <div class="alert">
            <?php echo $errorMessage; ?>
        </div>
    <?php endif; ?>

    <div class="container">
        <div class="row mt-4">
            <div class="col-5">
                <div class="row mt-3">
                    <div class="col-12" style="font-weight: 600; font-size: 15px;"><p>Akun</p></div>
                    <div class="col-12" style="font-size: 12px; margin-top: -10px;"><p><?php echo htmlspecialchars($email); ?></p></div>
                </div>
                <hr style="margin-top: -5px;">
                
                <div class="row mt-3">
    <div class="col-12" style="font-weight: 600; font-size: 15px;">
        <p>Pengantaran</p>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" onclick="toggleForm()">
        <label class="form-check-label" for="flexCheckDefault">
            Alamat Utama
        </label>
    </div>

    <!-- Dropdown yang akan muncul jika checkbox dicentang -->
    <div id="dropdownText" style="display: none;" class="dropdownText">
        <p><?php echo htmlspecialchars($alamat); ?> <a href="alamat.php" style="color: black;">ubah alamat?</a></p>
    </div>

    <script>
        function toggleForm() {
            var checkbox = document.getElementById('flexCheckDefault');
            var dropdown = document.getElementById('dropdownText');
            var form = document.querySelector('form');  // Menangkap seluruh form

            // Jika checkbox dicentang, sembunyikan form
            if (checkbox.checked) {
                dropdown.style.display = 'block';  // Menampilkan dropdown
                form.style.display = 'none';  // Menyembunyikan form
            } else {
                dropdown.style.display = 'none';  // Menyembunyikan dropdown
                form.style.display = 'block';  // Menampilkan form
            }
        }
    </script>
</div>
</div>
<div class="col-1"></div>
            <div class="col-6">
                <div class="container">
                    <?php if (!empty($produk_checkout)): ?>
                        <!-- Loop untuk menampilkan produk jika ada -->
                        <?php foreach ($produk_checkout as $product): ?>
                            <div class="card mb-3">
                                <div class="row g-0">
                                    <div class="col-md-2">
                                        <div class="position-relative">
                                            <img src="img/produk.jpg" class="img-fluid rounded-start" alt="...">
                                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-black"><?php echo $product['quantity']; ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <h6 class="card-title"><?php echo htmlspecialchars($product['nama_produk']); ?></h6>
                                    </div>
                                    <div class="col-md-3 d-flex justify-content-center align-items-center">
                                        <small class="card-title" style="font-size: 12px; text-align: right; color: black; margin-left: auto;">
                                            <p>Rp <?php echo number_format($product['harga'], 0, ',', '.'); ?>,00</p>
                                            <p style="font-weight: 700;"><?php echo htmlspecialchars($product['size']); ?></p>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="alert alert-warning" role="alert">
                            Belum ada produk dalam checkout.
                        </div>
                    <?php endif; ?>


                    <form class="d-flex" action="" method="POST">
                        <input class="form-control me-2" type="search" placeholder="Kode diskon" name="kode_diskon" aria-label="Search">
                        <button class="btn" type="submit">Pakai</button>
                    </form>

                    <div class="row mt-3" style="font-size: 12px;">
                        <div class="col-6" style="font-weight: 600;"><p>Subtotal</p></div>
                        <div class="col-6" style="text-align: right;">
                        <p>Rp <?php echo number_format($total_subtotal, 0, ',', '.'); ?>,00</p>
                        </div>
                    </div>

                    <div class="mt-1" style="font-weight: 600; font-size: 12px;"><p>Diskon Pemesanan</p></div>
                    <div class="row" style="font-size: 12px; margin-top: -15px;">
                    <?php if ($diskon > 0) { ?>
                            <div class="col-6" style="font-weight: 600;"><p><i class="bi bi-tags me-1"></i>Potongan Diskon</p></div>
                            <div class="col-6" style="text-align: right;">
                                <p>- Rp <?php echo number_format($diskon, 0, ',', '.'); ?>,00</p>
                            </div>
                    <?php } ?>
                    </div>

                    <div class="row mt-1" style="font-size: 12px;">
                        <div class="col-3" style="font-weight: 600;"><p>Pengiriman <i class="bi bi-question-circle"></i></p></div>
                        <div class="col-9" style="text-align: right;"><p><?php echo htmlspecialchars($alamat); ?></p></div>
                    </div>

                    <div class="row mt-1" style="font-size: 17px;">
                        <div class="col-3" style="font-weight: 600;"><p>Total</p></div>
                        <div class="col-9" style="font-weight: 600; text-align: right;"><p><span class="me-2" style="font-weight: 300; font-size: 12px;"><i class="bi bi-cash-coin"style="font-size: 9px;"></i> IDR </span>Rp <?php echo number_format($total_subtotal - $diskon, 0, ',', '.'); ?>,00</p></div>
                    </div>

                    <?php foreach ($dataCheckout as $checkout): ?>
                    
                    <div class="row mb-2">
                        <div class="col-6">
                            <form id="formHapus_<?php echo $checkout['id_checkout']; ?>" method="POST" action="">
                                <input type="hidden" name="id_checkout" value="<?php echo $checkout['id_checkout']; ?>">
                                <input type="hidden" name="id_akun" value="<?php echo $checkout['id_akun']; ?>">
                                <input type="hidden" name="nama_produk" value="<?php echo $checkout['nama_produk']; ?>">
                                <input type="hidden" name="size" value="<?php echo $checkout['size']; ?>">
                                <input type="hidden" name="quantity" value="<?php echo $checkout['quantity']; ?>">
                                <input type="hidden" name="harga" value="<?php echo $checkout['harga']; ?>">
                                <input type="hidden" name="created_at" value="<?php echo $checkout['created_at']; ?>">
                                
                                <!-- Tombol Hapus -->
                                <button type="button" class="btn-hapus btn flex-fill" style="width: 100%;" data-id="<?php echo $checkout['id_checkout']; ?>">Kembali</button>
                            </form>
                            <?php endforeach; ?>
                        </div>
                        <div class="col-6">
                            <a href="pesanan-saya.php" class="btn" style="width: 100%;">Checkout</a>
                        </div>
                    </div>

                    <div style="font-weight: 600; font-size: 15px;"><p><i class="bi bi-tags me-2"></i>TOTAL PENGHEMATAN <span class="me-2 text-danger"><u>Rp <?php echo number_format($diskon, 0, ',', '.'); ?>,00</u></span></p></div>
                </div>
            </div>
        </div> 
    </div>
</body>
</html>

<?php require 'footer.php'; ?>

<script>
    function toggleDropdown() {
    var checkbox = document.getElementById('flexCheckDefault');
    var dropdown = document.getElementById('dropdownText');
    
    if (checkbox.checked) {
        dropdown.style.display = 'block';
    } else {
        dropdown.style.display = 'none';
    }
}

function toggleDropdown() {
    var checkbox = document.getElementById('flexCheckDefault');
    var dropdown = document.getElementById('dropdownText');
    
    if (checkbox.checked) {
        dropdown.style.visibility = 'visible';
        dropdown.style.height = 'auto'; // Pastikan tinggi elemen
    } else {
        dropdown.style.visibility = 'hidden';
        dropdown.style.height = '0'; // Set tinggi 0 untuk menghindari celah
    }
}
    
document.querySelectorAll('.btn-hapus').forEach(button => {
    button.addEventListener('click', function (e) {
        e.preventDefault(); // Mencegah reload halaman

        // Ambil data ID dari atribut data-id
        const id_checkout = this.getAttribute('data-id');

        // Konfirmasi penghapusan
        if (confirm('Apakah Anda yakin ingin kebali? Sistem akan secara otomatis menghapus item ini?')) {
            // Kirim permintaan AJAX
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '', true); // URL kosong berarti file yang sama
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            // Tangani respon
            xhr.onload = function () {
            if (xhr.status === 200) {
                // Ganti isi halaman dengan pesan berisi tautan
                const message = `
                    <div style="text-align: center; margin-top: 50px;">
                        <p>Kurang puas dengan pilihannya? Yuk cari ukuran lain yang lebih cocok!  
                            <a href="detail-product-user.php" class="alert-link">disini</a>.
                        </p>
                    </div>
                `;
                document.body.innerHTML = message; // Tampilkan pesan

                // Redirect otomatis setelah beberapa detik
                setTimeout(() => {
                    window.location.href = 'detail-product-user.php'; // Arahkan ke halaman sebelumnya
                }, 3000);
            } else {
                alert('Terjadi kesalahan saat menghapus data.');
            }
        };

            // Kirim data ke server
            xhr.send('id_checkout=' + id_checkout);
        }
    });
});
</script>