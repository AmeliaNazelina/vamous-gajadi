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
    .card {
        margin-top: -300px;
        border: none;
    }
    .card h2 {
        font-weight: 700;
    }
    .btn {
        background-color: black;
        color: white;
        border-radius: 0px;
    }
    a {
        color: black;
        font-size: 12px;
    }
    .form-control {
        border-radius: 0 !important;
        border-color: #000 !important;
        color: #000;
        font-size: 12px;
        padding: 15px;
    }
    h5 {
        font-weight: 700;
    }
    .modal-body {
        font-size: 15px;
    }
    footer {
        margin-top: -300px;
    }
</style>

<body>
<!-- Button to trigger modal -->
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4" style="width: 500px;">
        <h2 class="text-center mb-4">Lacak Pesanan Anda</h2>
        <form>
            <div class="mb-3">
                <input type="email" class="form-control" id="email" placeholder="Masukkan nomor resi Anda" required>
            </div>
            <div class="text-center">
                <!-- Button that triggers the modal -->
                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal">Cari</button>
            </div>
        </form>
        <div class="text-center mt-3">
            <a href="#">Bantuan lain?</a>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Lacak Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Pesanan Anda sedang diproses...</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm" data-bs-dismiss="modal" style="border-color: white; background-color: white; color: black;">Tutup</button>
                <button type="button" class="btn btn-sm">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>

<script>
    const myModalEl = document.getElementById('myModal')
myModalEl.addEventListener('hidden.bs.modal', event => {
  // do something...
})
</script>

<?php require 'footer.php'; ?>