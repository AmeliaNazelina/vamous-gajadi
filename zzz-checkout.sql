CREATE TABLE checkout (
    id_checkout INT AUTO_INCREMENT PRIMARY KEY,
    nama_produk VARCHAR(255) NOT NULL,
    size VARCHAR(10) NOT NULL,
    quantity INT NOT NULL,
    harga INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE checkout ADD COLUMN id_akun INT NOT NULL AFTER id_checkout;
