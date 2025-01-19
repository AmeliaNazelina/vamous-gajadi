<?php
session_start(); // Mulai sesi untuk mengakses session
include 'koneksi.php'; // Pastikan koneksi ke database sudah dilakukan
$pageTitle = "VAMOUZ";
require 'navbar-user.php';
$bgColor = 'black';
$textColor = 'white';

// Definisikan $email dan $alamat dengan nilai default
$email = "Pengguna belum login"; 
$alamat = "Alamat tidak ditemukan";

// Pastikan pengguna sudah login dan session 'user_id' tersedia
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Ambil email dan alamat berdasarkan user_id yang terlogin
    $query = "SELECT email, alamat FROM akun WHERE id_akun = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id); // Bind parameter untuk menghindari SQL injection
    $stmt->execute();
    $stmt->store_result();

    // Jika data ditemukan
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($email, $alamat); // Bind hasil query ke variabel $email dan $alamat
        $stmt->fetch(); // Ambil email dan alamat dari hasil query
    } else {
        $email = "Email tidak ditemukan"; // Jika email tidak ditemukan, set pesan error
        $alamat = "Alamat tidak ditemukan"; // Jika alamat tidak ditemukan, set pesan error
    }
    $stmt->close();
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

    <div class="container">
        <div class="row mt-4">
            <div class="col-7">
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
    <div id="dropdownText" style="display: none;" class="dropdownText mb-3">
        <p><?php echo htmlspecialchars($alamat); ?></p>
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

            <form class="row g-3 needs-validation" novalidate action="proses.php" method="POST">
                <div class="col-md-4 position-relative">
                    <label for="negara" class="form-label">Negara/Wilayah</label>
                    <select class="form-select" id="negara" name="negara" required>
                        <option selected disabled value="">Pilih Negara/Wilayah...</option>
                        <?php
                        // Array berisi daftar negara
                        $countries = [
                            "Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Antigua and Barbuda", 
                            "Argentina", "Armenia", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", 
                            "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bhutan", 
                            "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil", "Brunei", "Bulgaria", 
                            "Burkina Faso", "Burundi", "Cabo Verde", "Cambodia", "Cameroon", "Canada", 
                            "Central African Republic", "Chad", "Chile", "China", "Colombia", "Comoros", 
                            "Congo (Congo-Brazzaville)", "Costa Rica", "Croatia", "Cuba", "Cyprus", "Czechia", 
                            "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt", 
                            "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Eswatini (fmr. Swaziland)", 
                            "Ethiopia", "Fiji", "Finland", "France", "Gabon", "Gambia", "Georgia", "Germany", 
                            "Ghana", "Greece", "Grenada", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", 
                            "Haiti", "Holy See", "Honduras", "Hungary", "Iceland", "India", "Indonesia", "Iran", 
                            "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", 
                            "Kenya", "Kiribati", "Kuwait", "Kyrgyzstan", "Laos", "Latvia", "Lebanon", "Lesotho", 
                            "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", "Madagascar", 
                            "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Mauritania", 
                            "Mauritius", "Mexico", "Micronesia", "Moldova", "Monaco", "Mongolia", "Montenegro", 
                            "Morocco", "Mozambique", "Myanmar (Burma)", "Namibia", "Nauru", "Nepal", "Netherlands", 
                            "New Zealand", "Nicaragua", "Niger", "Nigeria", "North Korea", "North Macedonia", 
                            "Norway", "Oman", "Pakistan", "Palau", "Palestine State", "Panama", "Papua New Guinea", 
                            "Paraguay", "Peru", "Philippines", "Poland", "Portugal", "Qatar", "Romania", "Russia", 
                            "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", 
                            "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Serbia", 
                            "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", 
                            "Somalia", "South Africa", "South Korea", "South Sudan", "Spain", "Sri Lanka", "Sudan", 
                            "Suriname", "Sweden", "Switzerland", "Syria", "Tajikistan", "Tanzania", "Thailand", 
                            "Timor-Leste", "Togo", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", 
                            "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States of America", 
                            "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Yemen", "Zambia", "Zimbabwe"
                        ];

                        // Loop untuk membuat opsi
                        foreach ($countries as $country) {
                            echo "<option value=\"$country\">$country</option>";
                        }
                        ?>
                    </select>
                    <div class="invalid-tooltip">Silakan pilih negara/wilayah yang valid.</div>
                </div>
                <div class="col-md-4 position-relative">
                    <label for="namaDepan" class="form-label">Nama Depan</label>
                    <input type="text" class="form-control" id="namaDepan" name="nama_depan" required>
                    <div class="invalid-tooltip">Nama depan diperlukan.</div>
                </div>
                <div class="col-md-4 position-relative">
                    <label for="namaBelakang" class="form-label">Nama Belakang</label>
                    <input type="text" class="form-control" id="namaBelakang" name="nama_belakang" required>
                    <div class="invalid-tooltip">Nama belakang diperlukan.</div>
                </div>
                <div class="col-md-12 position-relative">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" required>
                    <div class="invalid-tooltip">Alamat diperlukan.</div>
                </div>
                <div class="col-md-6 position-relative">
                    <label for="kecamatan" class="form-label">Kecamatan</label>
                    <input type="text" class="form-control" id="kecamatan" name="kecamatan" required>
                    <div class="invalid-tooltip">Kecamatan diperlukan.</div>
                </div>
                <div class="col-md-6 position-relative">
                    <label for="kota" class="form-label">Kota</label>
                    <input type="text" class="form-control" id="kota" name="kota" required>
                    <div class="invalid-tooltip">Kota diperlukan.</div>
                </div>
                <div class="col-md-6 position-relative">
                    <label for="provinsi" class="form-label">Provinsi</label>
                    <input type="text" class="form-control" id="provinsi" name="provinsi" required>
                    <div class="invalid-tooltip">Provinsi diperlukan.</div>
                </div>
                <div class="col-md-6 position-relative">
                    <label for="kodePos" class="form-label">Kode Pos</label>
                    <input type="text" class="form-control" id="kodePos" name="kode_pos" required>
                    <div class="invalid-tooltip">Kode pos diperlukan.</div>
                </div>
                <div class="col-md-12 position-relative">
                    <label for="noHp" class="form-label">No HP</label>
                    <input type="text" class="form-control" id="noHp" name="no_hp" required>
                    <div class="invalid-tooltip">No HP diperlukan.</div>
                </div>
                <div class="col-12 mb-3">
                    <button class="btn" type="submit">Submit Form</button>
                </div>
                </form>
            </div>
            <div class="col-5">
                <div class="container">
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-2">
                                <div class="position-relative">
                                    <img src="img/produk.jpg" class="img-fluid rounded-start" alt="...">
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-black">1</span>
                                    </div>
                                </div>
                            <div class="col-md-7">
                                <h6 class="card-title">VAMOUS - "REVERS!" Statement T-Shirt (WHITE)</h6>
                            </div>
                            <div class="col-md-3 d-flex justify-content-center align-items-center">
                                <small class="card-title" style="font-size: 12px; text-align: right; color: black; margin-left: auto;">Rp 300.000,00</small>
                            </div>
                        </div>
                    </div>

                    <form class="d-flex" action="">
                        <input class="form-control me-2" type="search" placeholder="Kode diskon" aria-label="Search">
                        <button class="btn" type="submit">Pakai</button>
                    </form>

                    <div class="row mt-3" style="font-size: 12px;">
                        <div class="col-6" style="font-weight: 600;"><p>Subtotal</p></div>
                        <div class="col-6" style="text-align: right;"><p>Rp 300.000,00</p></div>
                    </div>

                    <div class="mt-1" style="font-weight: 600; font-size: 12px;"><p>Diskon Pemesanan</p></div>
                    <div class="row" style="font-size: 12px; margin-top: -15px;">
                        <div class="col-6"><p><i class="bi bi-tags"></i> Potongan harga</p></div>
                        <div class="col-6" style="text-align: right;"><p>- Rp 10.000,00</p></div>
                    </div>

                    <div class="row mt-1" style="font-size: 12px;">
                        <div class="col-3" style="font-weight: 600;"><p>Pengiriman <i class="bi bi-question-circle"></i></p></div>
                        <div class="col-9" style="text-align: right;"><p>Masukkan alamat pengiriman</p></div>
                    </div>

                    <div class="row mt-1" style="font-size: 17px;">
                        <div class="col-3" style="font-weight: 600;"><p>Total</p></div>
                        <div class="col-9" style="font-weight: 600; text-align: right;"><p><span class="me-2" style="font-weight: 300; font-size: 12px;"><i class="bi bi-cash-coin"style="font-size: 9px;"></i> IDR </span>RP 290.000,00</p></div>
                    </div>

                    <div style="font-weight: 600; font-size: 15px;"><p><i class="bi bi-tags me-2"></i>TOTAL PENGHEMATAN <span class="me-2">Rp 10.000,00</span></p></div>
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
</script>