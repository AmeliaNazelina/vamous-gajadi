<?php
$pageTitle = "VAMOUS";
require 'navbar-admin.php';
// Include file koneksi
include 'koneksi.php';

// Cek apakah form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_produk = $_POST['nama_produk'];
    $harga_produk = $_POST['harga_produk'];
    $ukuran = $_POST['ukuran'];
    $stok_produk = $_POST['stok_produk'];

    // Upload foto produk 1
    $foto_produk1 = $_FILES['foto_produk1']['name'];
    $tmp_name1 = $_FILES['foto_produk1']['tmp_name'];
    $path1 = "uploads/" . $foto_produk1;

    // Upload foto produk 2
    $foto_produk2 = $_FILES['foto_produk2']['name'];
    $tmp_name2 = $_FILES['foto_produk2']['tmp_name'];
    $path2 = "uploads/" . $foto_produk2;

    // Pindahkan file ke folder uploads
    if (move_uploaded_file($tmp_name1, $path1)) {
        if (!empty($foto_produk2)) {
            move_uploaded_file($tmp_name2, $path2);
        } else {
            $path2 = null; // Jika foto produk 2 tidak ada
        }

        // Simpan data ke database
        $sql = "INSERT INTO produk (foto_produk1, foto_produk2, nama_produk, harga_produk, ukuran, stok_produk) 
                VALUES ('$path1', '$path2', '$nama_produk', '$harga_produk', '$ukuran', '$stok_produk')";

        if ($conn->query($sql) === TRUE) {
            $message = "Data produk berhasil disimpan.";
        } else {
            $message = "Error: " . $conn->error;
        }
    } else {
        $message = "Gagal mengupload foto produk 1.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    .img-preview {
        max-width: 100%;
        height: auto;
        margin-top: 10px;
    }
    .content .btn {
        background-color: black;
        color: white;
        border-radius: 0px;
        font-size: 12px;
        padding: 15px;
    }
    .form-control {
        border-radius: 0 !important;
        border-color: #000 !important;
        color: black;
        font-size: 12px;
        padding: 15px;
    }
    .form-select {
        border-radius: 0 !important;
        border-color: #000 !important;
        color: #000;
        font-size: 12px;
        padding: 15px;
        box-shadow: none;
    }
    label {
        color: black;
        font-size: 12px;
    }
    .alert {
        color: white;
        border-radius: 0 !important;
        border-color: #000 !important;
        background-color: black;
        font-size: 12px;
    }
    thead {
        color: white;
        font-weight: 400;
        text-align: center;
    }
    table {
        text-align: center;
    }
</style>
</head>
<body>
<div class="content">
    <h2 class="mb-4">Input Produk</h2>
    <hr>

    <!-- Pesan berhasil atau gagal -->
    <?php if (isset($message)): ?>
        <div class="alert"><?php echo $message; ?></div>
    <?php endif; ?>

    <form action="" method="POST" enctype="multipart/form-data" class="mb-3">
        <div class="row">
            <!-- Foto Produk 1 -->
            <div class="col-md-6 mb-3">
                <label for="foto_produk1" class="form-label">Foto Produk 1</label>
                <input type="file" class="form-control" id="foto_produk1" name="foto_produk1" accept="image/*" onchange="previewImage(this, 'preview1')" required>
                <img id="preview1" class="img-preview">
            </div>
            <!-- Foto Produk 2 -->
            <div class="col-md-6 mb-3">
                <label for="foto_produk2" class="form-label">Foto Produk 2</label>
                <input type="file" class="form-control" id="foto_produk2" name="foto_produk2" accept="image/*" onchange="previewImage(this, 'preview2')">
                <img id="preview2" class="img-preview">
            </div>
        </div>

        <div class="row">
            <!-- Nama Produk -->
            <div class="col-md-3 mb-3">
                <label for="nama_produk" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Nama produk" required>
            </div>

            <!-- Harga Produk -->
            <div class="col-md-3 mb-3">
                <label for="harga_produk" class="form-label">Harga Produk</label>
                <input type="number" class="form-control" id="harga_produk" name="harga_produk" placeholder="Harga produk" step="0.01" min="0" required>
            </div>

            <!-- Ukuran Produk -->
            <div class="col-md-3 mb-3">
                <label for="ukuran" class="form-label">Ukuran Produk</label>
                <select class="form-select" id="ukuran" name="ukuran" required>
                    <option value="" disabled selected>Pilih ukuran</option>
                    <option value="S">S</option>
                    <option value="M">M</option>
                    <option value="L">L</option>
                    <option value="XL">XL</option>
                </select>
            </div>

            <!-- Stok Produk -->
            <div class="col-md-3 mb-3">
                <label for="stok_produk" class="form-label">Stok Produk</label>
                <input type="number" class="form-control" id="stok_produk" name="stok_produk" placeholder="Stok produk" min="0" required>
            </div>
        </div>

        <!-- Tombol Submit -->
        <button type="submit" class="btn">Simpan Produk</button>
    </form>
    <hr>

    <?php
// Include file koneksi
include 'koneksi.php';

// Query untuk mendapatkan data dari tabel produk
$sql = "SELECT * FROM produk";
$result = $conn->query($sql);

// Mulai tabel HTML
echo '<table class="table table-bordered table-hover">';
echo '<thead class="table">';
echo '<tr>';
echo '<th>Foto Produk 1</th>';
echo '<th>Foto Produk 2</th>';
echo '<th>Nama Produk</th>';
echo '<th>Harga Produk</th>';
echo '<th>Ukuran</th>';
echo '<th>Stok Produk</th>';
echo '<th>Aksi</th>'; // Tambahkan kolom aksi
echo '</tr>';
echo '</thead>';
echo '<tbody>';

// Periksa apakah ada data
if ($result->num_rows > 0) {
    // Tampilkan setiap baris data
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td><img src="' . $row['foto_produk1'] . '" alt="Foto 1" style="width: 100px; height: auto;"></td>';
        echo '<td><img src="' . $row['foto_produk2'] . '" alt="Foto 2" style="width: 100px; height: auto;"></td>';
        echo '<td>' . $row['nama_produk'] . '</td>';
        echo '<td>Rp ' . number_format($row['harga_produk'], 2, ',', '.') . '</td>';
        echo '<td>' . $row['ukuran'] . '</td>';
        echo '<td>' . $row['stok_produk'] . '</td>';
        echo '<td>';
        echo '<a href="produk.php?hapus=' . $row['id'] . '" class="btn btn-sm">Hapus</a>';
        echo '</td>';
        echo '</tr>';
    }
} else {
    // Jika tidak ada data
    echo '<tr>';
    echo '<td colspan="8" class="text-center">Tidak ada data produk</td>';
    echo '</tr>';
}

echo '</tbody>';
echo '</table>';
?>

<?php
// Include file koneksi
include 'koneksi.php';

// Proses penghapusan data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    // Pastikan ID adalah angka
    if (is_numeric($id)) {
        // Query untuk menghapus data produk berdasarkan ID
        $sql = "DELETE FROM produk WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Produk berhasil dihapus!'); window.location.href = 'produk.php';</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan dalam penghapusan data.');</script>";
        }
    }
}
?>


</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Fungsi untuk preview gambar
    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);
        const file = input.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        } else {
            preview.src = ""; // Hapus preview jika tidak ada file
        }
    }
</script>

</body>
</html>
