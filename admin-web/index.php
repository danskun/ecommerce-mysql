<?php
include('config.php');

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
    <style>
        /* Pastikan body tidak ada margin atau padding yang menyebabkan jarak dari atas */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0; /* Menghapus margin default */
            padding: 0; /* Menghapus padding default */
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh; /* Memastikan body minimal tinggi 100% dari viewport */
            flex-direction: column;
        }

        /* Kontainer utama, pastikan tidak ada margin atau padding ekstra yang menyebabkan ruang kosong */
        .container {
            width: 90%;
            max-width: 1200px;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin: 0 auto; /* Menjaga kontainer tetap rata tengah */
            display: flex;
            flex-direction: column;
        }

        h1 {
            text-align: center;
            font-size: 32px;
            margin-bottom: 30px;
            color: #333;
        }

        .add-product-btn {
            display: inline-block;      
            padding: 8px 5px;          
            background-color: #4CAF50;  
            color: white;               
            text-decoration: none;      
            border-radius: 4px;         
            margin-bottom: 20px;        
            font-size: 14px;            
            transition: background-color 0.3s; 
            text-align: center;         
            white-space: nowrap;        
            width: auto;                
            max-width: 200px;           
        }
        .add-product-btn:hover {
            background-color: #45a049;
            
        }

        .product-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: flex-start;
        }

        .product-card {
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            width: 280px;
            text-align: center;
            transition: box-shadow 0.3s ease;
            margin: 0 auto;
        }

        .product-card:hover {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .product-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 4px;
            margin-bottom: 15px;
        }

        .product-card h3 {
            font-size: 20px;
            color: #333;
            margin-bottom: 10px;
        }

        .product-card p {
            font-size: 14px;
            color: #666;
            margin-bottom: 15px;
        }

        .product-card .price {
            font-size: 18px;
            color: #4CAF50;
            margin-bottom: 15px;
        }

        .product-card .actions {
            display: flex;
            justify-content: space-between;
        }

        .product-card .actions a {
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
            font-size: 14px;
            transition: color 0.3s;
        }

        .product-card .actions a:hover {
            color: #0056b3;
        }

        /* Media Query untuk perangkat tablet dan ponsel */
        @media (max-width: 768px) {
            .container {
                width: 95%;
            }

            h1 {
                font-size: 28px;
            }

            .product-card {
                width: 100%; /* Lebar penuh pada perangkat kecil */
                max-width: 350px;
                margin-bottom: 20px;
            }

            .add-product-btn {
                width: 100%;
                padding: 12px;
                font-size: 18px;
            }

            .product-list {
                flex-direction: column;
                align-items: center;
            }
        }

        /* Media Query untuk perangkat mobile lebih kecil */
        @media (max-width: 480px) {
            .product-card h3 {
                font-size: 18px;
            }

            .product-card p {
                font-size: 12px;
            }

            .product-card .price {
                font-size: 16px;
            }

            .add-product-btn {
                font-size: 16px;
            }
        }

    </style>
</head>
<body>

    <div class="container">
        <h1>Daftar Produk</h1>
        <a href="create_product.php" class="add-product-btn">Tambah Produk</a>

        <div class="product-list">
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="product-card">
                    <img src="uploads/<?= $row['gambar'] ?>" alt="<?= $row['nama'] ?>">
                    <h3><?= $row['nama'] ?></h3>
                    <p><?= $row['penjelasan'] ?></p>
                    <div class="price">Rp <?= number_format($row['harga'], 2, ',', '.') ?></div>
                    <div class="actions">
                        <a href="update_product.php?id=<?= $row['id'] ?>">Edit</a>
                        <a href="delete_product.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

</body>
</html>
