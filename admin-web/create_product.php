<?php
include('config.php');

// Pastikan folder uploads ada dan dapat ditulis
$upload_dir = 'uploads/';
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true); // Membuat folder uploads jika belum ada
}

// Maksimal ukuran file yang diizinkan (misalnya 5MB)
$max_file_size = 5 * 1024 * 1024; // 5MB

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $penjelasan = $_POST['penjelasan'];

    // Menangani file gambar yang diupload
    $gambar = $_FILES['gambar']['name'];
    $gambar_tmp = $_FILES['gambar']['tmp_name'];
    $gambar_size = $_FILES['gambar']['size'];
    $gambar_error = $_FILES['gambar']['error'];
    $gambar_ext = strtolower(pathinfo($gambar, PATHINFO_EXTENSION));

    // Cek apakah file yang diupload adalah gambar
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($gambar_ext, $allowed_extensions)) {
        die("Hanya file dengan ekstensi JPG, JPEG, PNG, atau GIF yang diperbolehkan.");
    }

    // Cek ukuran file
    if ($gambar_size > $max_file_size) {
        die("Ukuran file terlalu besar. Maksimal 5MB.");
    }

    // Membuat nama file yang aman (misalnya mengganti spasi dengan underscore)
    $gambar_new_name = str_replace(" ", "_", basename($gambar));
    $gambar_path = $upload_dir . $gambar_new_name;

    // Pindahkan file ke direktori tujuan
    if ($gambar_error === UPLOAD_ERR_OK) {
        if (!move_uploaded_file($gambar_tmp, $gambar_path)) {
            die("Gagal mengupload file gambar.");
        }
    } else {
        die("Terjadi kesalahan saat mengupload gambar. Error Code: " . $gambar_error);
    }

    // Membersihkan input untuk keamanan
    $nama = $conn->real_escape_string($nama);
    $harga = $conn->real_escape_string($harga);
    $penjelasan = $conn->real_escape_string($penjelasan);
    $gambar_db = $conn->real_escape_string($gambar_new_name);

    // Query untuk memasukkan data produk ke database
    $sql = "INSERT INTO products (nama, harga, penjelasan, gambar) 
            VALUES ('$nama', '$harga', '$penjelasan', '$gambar_db')";

    if ($conn->query($sql) === TRUE) {
        // Produk berhasil ditambahkan, redirect ke index.php
        header("Location: index.php"); // Mengarahkan kembali ke index.php
        exit(); // Pastikan script tidak melanjutkan eksekusi lebih lanjut setelah redirect
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Produk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-top: 20px;
        }

        form {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 50%;
            margin: 30px auto;
            padding: 20px;
        }

        label {
            font-size: 16px;
            color: #555;
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="number"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        textarea {
            resize: vertical;
            height: 100px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Optional: Add responsiveness */
        @media screen and (max-width: 768px) {
            form {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <h1>Tambah Produk</h1>
    <form action="create_product.php" method="post" enctype="multipart/form-data">
        <label for="nama">Nama Produk:</label>
        <input type="text" id="nama" name="nama" required><br>

        <label for="harga">Harga Produk:</label>
        <input type="number" id="harga" name="harga" required><br>

        <label for="penjelasan">Penjelasan Produk:</label>
        <textarea id="penjelasan" name="penjelasan"></textarea><br>

        <label for="gambar">Gambar Produk:</label>
        <input type="file" id="gambar" name="gambar" required><br>

        <input type="submit" value="Tambah Produk">
    </form>
</body>
</html>
