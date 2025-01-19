<?php
session_start(); // Start session
include 'koneksi.php'; // Database connection

$pageTitle = "Konfirmasi Pesanan";
require 'navbar-user.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login if user is not logged in
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch user email and address from the database
$query_user = "SELECT email, alamat FROM akun WHERE id_akun = ?";
$stmt_user = $conn->prepare($query_user);
$stmt_user->bind_param("i", $user_id);
$stmt_user->execute();
$stmt_user->store_result();

$email = "";
$alamat = "";

if ($stmt_user->num_rows > 0) {
    $stmt_user->bind_result($email, $alamat);
    $stmt_user->fetch();
}
$stmt_user->close();

// Fetch checkout products from the database
$query_checkout = "SELECT nama_produk, harga, quantity, size FROM checkout WHERE id_akun = ?";
$stmt_checkout = $conn->prepare($query_checkout);
$stmt_checkout->bind_param("i", $user_id);
$stmt_checkout->execute();
$result_checkout = $stmt_checkout->get_result();

$produk_checkout = [];
$total_harga = 0;

while ($product = $result_checkout->fetch_assoc()) {
    $produk_checkout[] = $product;
    $total_harga += $product['harga'] * $product['quantity'];
}
$stmt_checkout->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process order confirmation
    $query_confirm = "INSERT INTO pesanan (id_akun, total_harga, alamat, created_at) VALUES (?, ?, ?, NOW())";
    $stmt_confirm = $conn->prepare($query_confirm);
    $stmt_confirm->bind_param("iis", $user_id, $total_harga, $alamat);

    if ($stmt_confirm->execute()) {
        $order_id = $stmt_confirm->insert_id;

        // Move products from checkout to order details
        foreach ($produk_checkout as $product) {
            $query_order_detail = "INSERT INTO detail_pesanan (id_pesanan, nama_produk, harga, quantity, size) VALUES (?, ?, ?, ?, ?)";
            $stmt_detail = $conn->prepare($query_order_detail);
            $stmt_detail->bind_param("isdis", $order_id, $product['nama_produk'], $product['harga'], $product['quantity'], $product['size']);
            $stmt_detail->execute();
            $stmt_detail->close();
        }

        // Clear checkout for this user
        $query_clear_checkout = "DELETE FROM checkout WHERE id_akun = ?";
        $stmt_clear = $conn->prepare($query_clear_checkout);
        $stmt_clear->bind_param("i", $user_id);
        $stmt_clear->execute();

        // Redirect to payment or success page
        header("Location: pembayaran.php?id_pesanan=$order_id");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
        }
        .product {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }
        .total {
            font-size: 18px;
            font-weight: bold;
            text-align: right;
        }
        .btn {
            background-color: black;
            color: white;
            padding: 10px 20px;
            text-align: center;
            display: block;
            margin: 20px auto;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        .btn:hover {
            background-color: darkgray;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Konfirmasi Pesanan</h2>
    <p>Email: <?php echo htmlspecialchars($email); ?></p>
    <p>Alamat Pengiriman: <?php echo htmlspecialchars($alamat); ?></p>

    <h3>Detail Pesanan</h3>
    <?php foreach ($produk_checkout as $product): ?>
        <div class="product">
            <span><?php echo htmlspecialchars($product['nama_produk']); ?> (<?php echo htmlspecialchars($product['size']); ?>)</span>
            <span><?php echo $product['quantity']; ?> x Rp <?php echo number_format($product['harga'], 0, ',', '.'); ?></span>
        </div>
    <?php endforeach; ?>

    <p class="total">Total: Rp <?php echo number_format($total_harga, 0, ',', '.'); ?></p>

    <form action="" method="POST">
        <a href="https://wa.link/unkopc" class="btn btn-dark w-100">Konfirmasi Pesanan</a>
    </form>
</div>
</body>
</html>
