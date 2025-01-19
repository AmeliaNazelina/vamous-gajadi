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
    .list-group-item {
    background-color: white;
    color: black; 
    }
    .list-group-item-action.active {
    background-color: black; 
    color: white; 
    border-color: black;
    }
    footer a {
        color: black;
        font-size: 12px;
    }
    h4 {
      font-weight: 700;
      color: black;
    }
    p {
      text-align: justify;
      color: black;
    }
</style>
<body>
<div class="container">
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="beranda.php">Beranda</a></li>
        <li class="breadcrumb-item" aria-current="page">Tentang Kami</li>
    </ol>
    </nav>
</div>

<div class="container mt-5 mb-5">
<div class="row">
  <div class="col-4">
    <div id="list-example" class="list-group">
      <a class="list-group-item list-group-item-action" href="#list-item-1">Kualitas</a>
      <a class="list-group-item list-group-item-action" href="#list-item-2">Kepercayaan</a>
      <a class="list-group-item list-group-item-action" href="#list-item-3">Pilihan</a>
      <a class="list-group-item list-group-item-action" href="#list-item-4">Gaya Hidup</a>
    </div>
  </div>
  <div class="col-8">
    <div data-bs-spy="scroll" data-bs-target="#list-example" data-bs-smooth-scroll="true" class="scrollspy-example" tabindex="0">
      <h4 id="list-item-1">Paduan Kualitas dan Desain yang Tak Tertandingi untuk Kaos dan Relawan Wear</h4>
      <p>Brand "VAMOUZ" dikenal karena kualitas bahan yang nyaman dan desain yang stylish. Memilih kaos dan relawan wear dari VAMOUZ bukan hanya soal penampilan, tetapi juga kenyamanan saat digunakan dalam berbagai aktivitas. Bahan yang ringan dan mudah menyerap keringat membuat produk ini cocok untuk dipakai dalam cuaca panas atau saat beraktivitas seharian.</p>
      <h4 id="list-item-2">Kepercayaan Terhadap VAMOUZ: Brand yang Memahami Kebutuhan Pakaian Kasual dan Relawan</h4>
      <p>VAMOUZ tidak hanya menawarkan kaos yang nyaman, tetapi juga relawan wear yang fungsional dan stylish. Dengan desain yang modern dan bahan yang tahan lama, VAMOUZ memahami kebutuhan para konsumen yang mencari pakaian kasual untuk sehari-hari dan pakaian yang bisa menunjang kegiatan sosial atau relawan dengan tetap terlihat keren.</p>
      <h4 id="list-item-3">Pilihan Cerdas untuk Kaos dan Relawan Wear yang Trendy dan Terjangkau</h4>
      <p>Dengan harga yang bersaing dan pilihan desain yang kekinian, VAMOUZ menjadi pilihan utama bagi banyak orang yang mencari kaos atau relawan wear. Tidak hanya sekadar fashion, tetapi juga sebagai pernyataan gaya hidup yang mendukung kegiatan positif dan sosial. Desain yang sederhana namun elegan sangat cocok untuk berbagai suasana, dari santai hingga acara komunitas.</p>
      <h4 id="list-item-4">Pakaian yang Menyatu dengan Aktivitas Sosial dan Gaya Hidup Kasual</h4>
      <p>VAMOUZ menawarkan pakaian yang tidak hanya stylish tetapi juga mendukung kegiatan sosial seperti relawan. Memilih kaos dan relawan wear dari VAMOUZ adalah pilihan yang tepat bagi mereka yang ingin tetap terlihat fashionable tanpa mengorbankan kenyamanan. Brand ini memberikan solusi praktis bagi mereka yang aktif dan peduli terhadap isu-isu sosial sambil tetap menjaga penampilan yang fresh.</p>
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

<script>
document.querySelectorAll('#nav-tab>[data-bs-toggle="tab"]').forEach(el => {
  el.addEventListener('shown.bs.tab', () => {
    const target = el.getAttribute('data-bs-target')
    const scrollElem = document.querySelector(`${target} [data-bs-spy="scroll"]`)
    bootstrap.ScrollSpy.getOrCreateInstance(scrollElem).refresh()
  })
})

const firstScrollSpyEl = document.querySelector('[data-bs-spy="scroll"]')
firstScrollSpyEl.addEventListener('activate.bs.scrollspy', () => {
  // do something...
})
</script>