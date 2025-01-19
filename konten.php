<?php
$pageTitle = "VAMOUS";
require 'navbar-admin.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
    .tab-content {
        background-color: white;
    }
    .nav-link {
        color: black;
        padding-left: 20px;
        padding-right: 20px;
        font-size: 15px;
    }
    .nav-link:focus {
        color: rgba(0, 0, 0, 0.5);
    }
    .nav-link:hover {
        color: rgba(0, 0, 0, 0.5);
    }
     #preview {
        max-width: 100%; /* Maksimalkan ukuran gambar */
        max-height: 250px; /* Batasi tinggi gambar */
        display: none; /* Tidak tampilkan preview sampai gambar dipilih */
    }
    .form-control, .form-select {
        margin-bottom: 15px;
    }
    .img-preview-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 15px;
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
    input[type="radio"]:checked {
        background-color: black;
        border-color: black;
    }
    input[type="radio"] {
        accent-color: black; /* Mengubah warna radio button */
    }
    </style>
    <!-- Script untuk preview gambar -->
    <script>
        function previewImage() {
            const file = document.querySelector('#gambar').files[0];
            const reader = new FileReader();
            reader.onloadend = function () {
                const img = document.querySelector('#preview');
                img.src = reader.result;
                img.style.display = 'block'; // Tampilkan gambar preview
            }
            if (file) {
                reader.readAsDataURL(file);
            }
        }
        
        function validateImage() {
            const file = document.querySelector('#gambar').files[0];
            const img = new Image();
            img.onload = function() {
                if (img.width !== 1920 || img.height !== 500) {
                    alert("Ukuran gambar tidak sesuai. Harus 1920x500");
                    document.querySelector('#gambar').value = ''; // Reset file input
                }
            }
            img.src = URL.createObjectURL(file);
        }
    </script>
</style>
<body>
    <div class="content">
        <h2 class="mb-4">Konten</h2>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Iklan</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Produk</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Logo</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <div class="container">
            <?php
include('koneksi.php');

// Cek jika form sudah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gambar = $_FILES['gambar']['name'];
    $keterangan = $_POST['keterangan'];
    $halaman_ke = $_POST['halaman_ke'];

    // Menyimpan gambar di folder 'konten'
    $target_dir = "konten/";
    $target_file = $target_dir . basename($gambar);
    move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file);

    // Query untuk mengecek apakah sudah ada data dengan halaman_ke tertentu
    $checkQuery = "SELECT * FROM konten WHERE halaman_ke = :halaman_ke";
    
    try {
        // Menyiapkan statement untuk pengecekan
        $stmtCheck = $pdo->prepare($checkQuery);
        $stmtCheck->bindParam(':halaman_ke', $halaman_ke);
        $stmtCheck->execute();
        
        // Jika data sudah ada (update)
        if ($stmtCheck->rowCount() > 0) {
            $sql = "UPDATE konten SET gambar = :gambar, keterangan = :keterangan WHERE halaman_ke = :halaman_ke";
        } else {
            // Jika data belum ada (insert)
            $sql = "INSERT INTO konten (gambar, keterangan, halaman_ke) VALUES (:gambar, :keterangan, :halaman_ke)";
        }

        // Menyiapkan statement
        $stmt = $pdo->prepare($sql);
        
        // Mengikat parameter
        $stmt->bindParam(':gambar', $gambar);
        $stmt->bindParam(':keterangan', $keterangan);
        $stmt->bindParam(':halaman_ke', $halaman_ke);
        
        // Menjalankan query
        $stmt->execute();
        
        // Menampilkan pesan alert jika data berhasil disimpan atau diupdate
        echo "<script>alert('Data berhasil disimpan/diupdate.');</script>";
        
    } catch (PDOException $e) {
        // Menangani error
        echo "Error: " . $e->getMessage();
    }
}
?>

<!-- Form untuk upload konten -->
<form action="" method="post" enctype="multipart/form-data">
    <div class="row">
        <!-- Kolom Kiri (Upload Image) -->
        <div class="col-md-6">
            <div class="mb-3">
                <label for="gambar" class="form-label mt-3">Upload Gambar</label>
                <input type="file" class="form-control" id="gambar" name="gambar" onchange="previewImage();" required>
                <img id="preview" src="#" alt="Preview Gambar" class="img-fluid mt-2" style="display:none;">
            </div>
        </div>

        <!-- Kolom Kanan (Keterangan & Halaman) -->
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label mt-3">Keterangan</label><br>
                <input type="radio" id="iklan" name="keterangan" value="iklan" checked>
                <label for="iklan">Iklan</label>
            </div>

            <div class="mb-3">
                <label for="halaman_ke" class="form-label">Halaman Ke</label>
                <select class="form-select" id="halaman_ke" name="halaman_ke" required>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </div>
        </div>
    </div>

    <button type="submit" class="btn mb-3">Simpan</button>
</form>

            </div>
            </div>
            
            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                <div class="container">
                <?php
include('koneksi.php');

// Cek jika form sudah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gambar = $_FILES['gambar']['name'];
    $keterangan = $_POST['keterangan'];
    $halaman_ke = $_POST['halaman_ke'];

    // Menyimpan gambar di folder 'konten'
    $target_dir = "konten/";
    $target_file = $target_dir . basename($gambar);
    move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file);

    // Query untuk mengecek apakah sudah ada data dengan halaman_ke tertentu
    $checkQuery = "SELECT * FROM konten WHERE halaman_ke = :halaman_ke";
    
    try {
        // Menyiapkan statement untuk pengecekan
        $stmtCheck = $pdo->prepare($checkQuery);
        $stmtCheck->bindParam(':halaman_ke', $halaman_ke);
        $stmtCheck->execute();
        
        // Jika data sudah ada (update)
        if ($stmtCheck->rowCount() > 0) {
            $sql = "UPDATE konten SET gambar = :gambar, keterangan = :keterangan WHERE halaman_ke = :halaman_ke";
        } else {
            // Jika data belum ada (insert)
            $sql = "INSERT INTO konten (gambar, keterangan, halaman_ke) VALUES (:gambar, :keterangan, :halaman_ke)";
        }

        // Menyiapkan statement
        $stmt = $pdo->prepare($sql);
        
        // Mengikat parameter
        $stmt->bindParam(':gambar', $gambar);
        $stmt->bindParam(':keterangan', $keterangan);
        $stmt->bindParam(':halaman_ke', $halaman_ke);
        
        // Menjalankan query
        $stmt->execute();
        
        // Menampilkan pesan alert jika data berhasil disimpan atau diupdate
        echo "<script>alert('Data berhasil disimpan/diupdate.');</script>";
        
    } catch (PDOException $e) {
        // Menangani error
        echo "Error: " . $e->getMessage();
    }
}
?>

<!-- Form untuk upload konten -->
<form action="" method="post" enctype="multipart/form-data">
    <div class="row">
        <!-- Kolom Kiri (Upload Image) -->
        <div class="col-md-6">
            <div class="mb-3">
                <label for="gambar" class="form-label mt-3">Upload Gambar</label>
                <input type="file" class="form-control" id="gambar" name="gambar" onchange="previewImage();" required>
                <img id="preview" src="#" alt="Preview Gambar" class="img-fluid mt-2" style="display:none;">
            </div>
        </div>

        <!-- Kolom Kanan (Keterangan & Halaman) -->
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label mt-3">Keterangan</label><br>
                <input type="radio" id="iklan" name="keterangan" value="iklan" checked>
                <label for="iklan">Iklan</label>
            </div>

            <div class="mb-3">
                <label for="halaman_ke" class="form-label">Halaman Ke</label>
                <select class="form-select" id="halaman_ke" name="halaman_ke" required>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
        </div>
    </div>

    <button type="submit" class="btn mb-3">Simpan</button>
</form>

                </div>
            </div>
            <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                <div class="container">
                <?php
// Cek jika form sudah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Menangkap data dari form
    $gambar = $_FILES['gambar']['name'];
    $file_tmp = $_FILES['gambar']['tmp_name'];  // Nama file sementara

    // Menentukan direktori tujuan penyimpanan gambar
    $target_dir = "konten/";  // Direktori untuk menyimpan gambar
    $target_file = $target_dir . basename($gambar);

    // Menangkap keterangan dan halaman dari form
    $keterangan = $_POST['keterangan'];  // Cuma ada "logo"
    $halaman_ke = $_POST['halaman_ke'];  // Pilihan halaman 6 atau 7

    // Memindahkan gambar ke folder tujuan
    if (move_uploaded_file($file_tmp, $target_file)) {
        echo "<script>alert('Gambar berhasil diupload.');</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat mengupload gambar.');</script>";
    }

    // Proses simpan data ke database jika diperlukan
    // Tambahkan kode untuk memasukkan data ke database jika perlu
}
?>

<!-- Form untuk upload gambar -->
<form action="" method="post" enctype="multipart/form-data">
    <div class="row">
        <!-- Kolom Kiri (Upload Gambar) -->
        <div class="col-md-6">
            <div class="mb-3">
                <label for="gambar" class="form-label mt-3">Upload Gambar</label>
                <input type="file" class="form-control" id="gambar" name="gambar" onchange="previewImage();" required>
                <img id="preview" src="#" alt="Preview Gambar" class="img-fluid mt-2" style="display:none;">
            </div>
        </div>

        <!-- Kolom Kanan (Keterangan & Halaman) -->
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label mt-3">Keterangan</label><br>
                <!-- Hanya ada satu radio button untuk "Logo" -->
                <input type="radio" id="logo" name="keterangan" value="logo" checked>
                <label for="logo">Logo</label>
            </div>

            <div class="mb-3">
                <label for="halaman_ke" class="form-label">Halaman Ke</label>
                <!-- Dropdown untuk memilih halaman 6 atau 7 -->
                <select class="form-select" id="halaman_ke" name="halaman_ke" required>
                    <option value="6">6</option>
                    <option value="7">7</option>
                </select>
            </div>
        </div>
    </div>

    <button type="submit" class="btn">Upload Gambar</button>
</form>

<!-- Script untuk menampilkan preview gambar -->
<script>
function previewImage() {
    var file = document.getElementById('gambar').files[0];
    var reader = new FileReader();
    reader.onload = function(e) {
        var preview = document.getElementById('preview');
        preview.style.display = 'block';
        preview.src = e.target.result;
    };
    reader.readAsDataURL(file);
}
</script>

                </div>
            </div>
        </div>
        </div>
    </div>
</body>
</html>

<script>
    const triggerTabList = document.querySelectorAll('#myTab button')
triggerTabList.forEach(triggerEl => {
  const tabTrigger = new bootstrap.Tab(triggerEl)

  triggerEl.addEventListener('click', event => {
    event.preventDefault()
    tabTrigger.show()
  })
})
</script>