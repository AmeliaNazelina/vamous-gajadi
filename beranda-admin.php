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
    .d-flex .btn {
        background-color: black;
        color: white;
        border-radius: 0px;
    }
    .form-control {
        border-radius: 0 !important;
        border-color: #000 !important;
        color: black;
        font-size: 12px;
        padding: 15px;
    }
    .card {
        border-radius: 0px;
        border-color: black;
    }
    .col-md-6 i {
        font-size: 100px;
        color: black;
    }
    .col-md-6 h5 {
        font-weight: 700;
        font-size: 25px;
        color: black;
        margin-top: 25px;
        padding-left: 30px;
    }
    .col-md-6 a {
        color: black;
        font-size: 12px;
        padding-left: 30px;
    }
</style>
<body>
    <div class="content">
        <!-- Cari -->
        <form class="d-flex mb-4" role="search">
            <input class="form-control me-2" type="search" placeholder="Masukan kata kunci" aria-label="Search">
            <button class="btn" type="submit">Cari</button>
        </form>

        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card" style="max-width: 360px;">
                    <div class="row g-0">
                        <div class="col-md-6">
                            <div class="card-body">
                                <h5 class="card-title">Akun</h5>
                                <a href="kelola-akun.php" class="card-text">Kunjungi akun</a>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex align-items-center justify-content-center">
                            <i class="bi bi-person-fill"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card" style="max-width: 360px;">
                    <div class="row g-0">
                        <div class="col-md-6">
                            <div class="card-body">
                                <h5 class="card-title">Konten</h5>
                                <a href="konten.php" class="card-text">Kunjungi konten</a>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex align-items-center justify-content-center">
                            <i class="bi bi-image-alt"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card" style="max-width: 360px;">
                    <div class="row g-0">
                        <div class="col-md-6">
                            <div class="card-body">
                                <h5 class="card-title">Produk</h5>
                                <a href="produk.php" class="card-text">Kunjungi produk</a>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex align-items-center justify-content-center">
                            <i class="bi bi-bag-fill"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card" style="max-width: 360px;">
                    <div class="row g-0">
                        <div class="col-md-6">
                            <div class="card-body">
                                <h5 class="card-title">Pesan</h5>
                                <a href="pesan.php" class="card-text">Kunjungi pesan</a>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex align-items-center justify-content-center">
                            <i class="bi bi-box2-fill"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card" style="max-width: 360px;">
                    <div class="row g-0">
                        <div class="col-md-6">
                            <div class="card-body">
                                <h5 class="card-title">Diskon</h5>
                                <a href="diskon.php" class="card-text">Kunjungi diskon</a>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex align-items-center justify-content-center">
                            <i class="bi bi-tag-fill"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card" style="max-width: 360px;">
                    <div class="row g-0">
                        <div class="col-md-6">
                            <div class="card-body">
                                <h5 class="card-title">Kirim</h5>
                                <a href="kirim.php" class="card-text">Kunjungi kirim</a>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex align-items-center justify-content-center">
                            <i class="bi bi-send-fill"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card" style="max-width: 360px;">
                    <div class="row g-0">
                        <div class="col-md-6">
                            <div class="card-body">
                                <h5 class="card-title">Bayar</h5>
                                <a href="bayar.php" class="card-text">Kunjungi bayar</a>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex align-items-center justify-content-center">
                            <i class="bi bi-bank2"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card" style="max-width: 360px;">
                    <div class="row g-0">
                        <div class="col-md-6">
                            <div class="card-body">
                                <h5 class="card-title">Laporan</h5>
                                <a href="laporan.php" class="card-text">Kunjungi laporan</a>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex align-items-center justify-content-center">
                            <i class="bi bi-bar-chart-fill"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card" style="max-width: 360px;">
                    <div class="row g-0">
                        <div class="col-md-6">
                            <div class="card-body">
                                <h5 class="card-title">Website</h5>
                                <a href="website.php" class="card-text">Kunjungi website</a>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex align-items-center justify-content-center">
                            <i class="bi bi-globe2"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card" style="max-width: 360px;">
                    <div class="row g-0">
                        <div class="col-md-6">
                            <div class="card-body">
                                <h5 class="card-title">Ulasan</h5>
                                <a href="ulasan.php" class="card-text">Kunjungi ulasan</a>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex align-items-center justify-content-center">
                            <i class="bi bi-star-half"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</body>
</html>