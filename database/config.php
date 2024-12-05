<?php

// Koneksi ke database menggunakan mysqli
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'db_ecommerce';

// Membuat koneksi
$conn = mysqli_connect($host, $username, $password, $database);

// Mengecek koneksi
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
