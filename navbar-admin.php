<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Icon Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            font-family: 'Poppins';
        }
        
    h2 {
        font-weight: 700;
        font-size: 50px;
    }
        #sidebar {
          height: 100vh;
          position: fixed;
          top: 0;
          left: 0;
          z-index: 100;
          background-color: #f8f9fa;
          transition: width 0.3s;
          display: flex;
        flex-direction: column;
        }

        #sidebar .menu-item {
          display: flex;
          align-items: center;
          padding: 10px;
          transition: background-color 0.3s;
        }

        #sidebar .menu-item:hover {
          background-color: #e9ecef;
        }

        #sidebar .menu-item i {
          margin-right: 10px;
        }

        #sidebar.collapsed {
          width: 80px;
        }

        #sidebar.collapsed .menu-text {
          display: none;
        }

        .content {
          margin-left: 150px;
          margin-right: 10px;
          padding: 20px;
          background-color: #f8f9fa;
        }
        #sidebar .menu-item:last-child {
        margin-top: auto; 
      }
      span a {
        text-decoration: none;
        font-size: 12px;
        color: black;
      }
      /* Untuk browser berbasis WebKit seperti Chrome, Edge, Safari */
body::-webkit-scrollbar {
    display: none;
}

/* Untuk Firefox */
body {
    scrollbar-width: none; /* Hilangkan scrollbar */
}

/* Jangan lupa untuk mencegah konten meluap */
body {
    overflow: auto; /* Tetap bisa di-scroll */
}

    </style>

    <body>
         <!-- Sidebar -->
  <div id="sidebar" class="p-3">
    <button class="btn btn-link text-dark" id="toggleSidebar">
    <i class="bi bi-list"></i>
    </button>

    <!-- Menu items -->
    <div class="menu-item">
    <i class="bi bi-person-fill"></i>
      <span class="menu-text"><a href="kelola-akun.php" class="me-2">Akun</a></span>
    </div>
    <div class="menu-item">
    <i class="bi bi-image-alt"></i>
      <span class="menu-text"><a href="konten.php" class="me-2">Konten</a></span>
    </div>
    <div class="menu-item">
    <i class="bi bi-bag-fill"></i>
      <span class="menu-text"><a href="produk.php" class="me-2">Produk</a></span>
    </div>
    <div class="menu-item">
    <i class="bi bi-box2-fill"></i>
      <span class="menu-text"><a href="pesan.php" class="me-2">Pesanan</a></span>
    </div>
    <div class="menu-item">
    <i class="bi bi-tag-fill"></i>
      <span class="menu-text"><a href="diskon.php" class="me-2">Diskon</a></span>
    </div>
    <div class="menu-item">
    <i class="bi bi-send-fill"></i>
      <span class="menu-text"><a href="kirim.php" class="me-2">Kirim</a></span>
    </div>
    <div class="menu-item">
    <i class="bi bi-bank2"></i>
      <span class="menu-text"><a href="bayar.php" class="me-2">Bayar</a></span>
    </div>
    <div class="menu-item">
    <i class="bi bi-bar-chart-fill"></i>
      <span class="menu-text"><a href="laporan.php" class="me-2">Laporan</a></span>
    </div>
    <div class="menu-item">
    <i class="bi bi-globe2"></i>
      <span class="menu-text"><a href="website.php" class="me-2">Website</a></span>
    </div>
    <div class="menu-item">
    <i class="bi bi-star-half"></i>
      <span class="menu-text"><a href="ulasan.php" class="me-2">Ulasan</a></span>
    </div>
    <div class="menu-item">
      <i class="bi bi-door-closed-fill"></i>
      <span class="menu-text"><a href="login.php" class="me-2">Keluar</a></span>
    </div>
  </div>

  <!-- Link to Bootstrap JS and Bootstrap Icons -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
  
  <script>
    // Toggle Sidebar
    const sidebar = document.getElementById("sidebar");
    const toggleSidebarButton = document.getElementById("toggleSidebar");

    toggleSidebarButton.addEventListener("click", function() {
      sidebar.classList.toggle("collapsed");
    });
  </script>
    </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    </html>