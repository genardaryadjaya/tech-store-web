<?php
// Include file konfigurasi
require_once __DIR__ . '/../../config.php';

// Koneksi database menggunakan konfigurasi
$conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if (!$conn) {
    die('Gagal koneksi database: ' . mysqli_connect_error());
}

// Set charset ke UTF-8
mysqli_set_charset($conn, "utf8");
?>