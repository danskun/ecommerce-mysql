<?php
session_start(); // Memulai sesi

// Menghapus semua data sesi
session_unset();  
session_destroy();  // Menghancurkan sesi

// Mengarahkan ke halaman utama
header("Location: index.php");
exit();
?>