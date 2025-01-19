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
</style>

<body>
<div class="container">
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="beranda-user.php">Beranda</a></li>
        <li class="breadcrumb-item" aria-current="page">Lokasi</li>
    </ol>
    </nav>
</div>

    <div class="container">
    <div class="row">
        <div class="col-6">
            <p class="text-justify"><span style="font-weight: 700;"><img src="img/logo.png" width="150px" heightauto></span> is a modern clothing brand that combines sleek style with lasting durability. Designed for everyday wear, its versatile pieces blend clean designs with tough, high-quality materials.</p>
            <p class="text-justify">Whether you're navigating the city or exploring the outdoors, Vamous offers stylish, reliable apparel that keeps up with your lifestyle. Simple, strong, and timeles.</p>
        </div>
        <div class="col-6"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15846.200466901391!2d107.6212606678481!3d-6.824438543098183!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e18213ec2283%3A0xc13bb5c37585e7!2sVamous!5e0!3m2!1sid!2sid!4v1732113493063!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
    </div>
    </div>
</body>
</html>

<?php require 'footer.php'; ?>