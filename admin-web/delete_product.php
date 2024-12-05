<?php
include('config.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Mengambil nama gambar untuk dihapus
    $sql = "SELECT gambar FROM products WHERE id='$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $gambar = $row['gambar'];

    // Hapus gambar dari folder uploads
    if ($gambar != "") {
        unlink("uploads/" . $gambar);
    }

    // Hapus data produk dari database
    $sql = "DELETE FROM products WHERE id='$id'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Produk berhasil dihapus!";
        header("Location: index.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
