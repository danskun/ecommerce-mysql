<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $penjelasan = $_POST['penjelasan'];

    // Update gambar jika diupload
    $gambar = $_FILES['gambar']['name'];
    if ($gambar != "") {
        $gambar_tmp = $_FILES['gambar']['tmp_name'];
        $gambar_path = "uploads/" . basename($gambar);
        move_uploaded_file($gambar_tmp, $gambar_path);
    } else {
        // Ambil gambar lama
        $gambar = $_POST['gambar_lama'];
    }

    $sql = "UPDATE products SET nama='$nama', harga='$harga', penjelasan='$penjelasan', gambar='$gambar' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<p class='success'>Produk berhasil diperbarui!</p>";
        header("Location: index.php");
    } else {
        echo "<p class='error'>Terjadi kesalahan saat memperbarui produk.</p>";
    }
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id='$id'";
    $result = $conn->query($sql);
    $product = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            height: 100vh;
            padding: 20px;
        }

        .container {
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
            width: 100%;
            max-width: 500px;
            display: flex;
            flex-direction: column;
        }

        h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            color: #555;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            background-color: #f9f9f9;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        textarea {
            height: 120px;
        }

        .image-preview {
            display: block;
            margin: 20px 0;
            text-align: center;
        }

        .image-preview img {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
        }

        .error {
            color: red;
            font-size: 14px;
        }

        .success {
            color: green;
            font-size: 14px;
        }

        .image-preview img {
            width: 150px;
            margin-top: 10px;
            border-radius: 8px;
        }

        /* Responsif untuk perangkat lebih kecil */
        @media (max-width: 768px) {
            .container {
                width: 90%;
                max-width: 450px;
            }

            h1 {
                font-size: 20px;
            }

            label, input[type="text"], input[type="number"], textarea, input[type="file"], input[type="submit"] {
                font-size: 14px;
            }

            .image-preview img {
                width: 100%;
                margin-top: 10px;
            }
        }

        /* Responsif untuk perangkat mobile lebih kecil */
        @media (max-width: 480px) {
            .container {
                width: 95%;
                max-width: 350px;
            }

            h1 {
                font-size: 18px;
            }

            input[type="submit"] {
                font-size: 16px;
            }

            label, input[type="text"], input[type="number"], textarea, input[type="file"] {
                font-size: 12px;
            }
        }

    </style>
</head>
<body>

    <div class="container">
        <h1>Edit Produk</h1>

        <?php if (isset($product)): ?>
        <form action="update_product.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $product['id'] ?>">
            <input type="hidden" name="gambar_lama" value="<?= $product['gambar'] ?>">

            <label for="nama">Nama Produk:</label>
            <input type="text" id="nama" name="nama" value="<?= $product['nama'] ?>" required>

            <label for="harga">Harga Produk:</label>
            <input type="number" id="harga" name="harga" value="<?= $product['harga'] ?>" required>

            <label for="penjelasan">Penjelasan Produk:</label>
            <textarea id="penjelasan" name="penjelasan"><?= $product['penjelasan'] ?></textarea>

            <label for="gambar">Gambar Produk (kosongkan jika tidak diubah):</label>
            <input type="file" id="gambar" name="gambar">

            <div class="image-preview">
                <label>Gambar Saat Ini:</label>
                <img src="uploads/<?= $product['gambar'] ?>" alt="Gambar Produk" />
            </div>

            <input type="submit" value="Update Produk">
        </form>
        <?php else: ?>
            <p class="error">Produk tidak ditemukan.</p>
        <?php endif; ?>

    </div>

</body>
</html>
