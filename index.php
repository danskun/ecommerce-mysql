<?php
session_start(); // Memulai sesi

// Mengecek status login
$is_logged_in = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
    <!-- Header -->
    <header>
        <nav id="navbar_top" class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="images/logo-2.png" alt="logo">
                </a>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav text-capitalize">
                        <li class="nav-item">
                            <a class="nav-link active" href="#home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#shoes">Shoes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#backpack">Backpack</a>
                        </li>
                        <li class="nav-item">
                            <?php if ($is_logged_in): ?>
                                <a class="nav-link" href="logout.php"style="color: red;">Log Out</a>
                            <?php else: ?>
                                <a class="nav-link" href="login-page.php">Log In</a>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Slider -->
    <!-- Hero Slider -->
    <section class="panda_slider" id="#home">
        <div class="container">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                        class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h1>The New XBox 4A PRO</h1>
                                <p>This is the new XBox where you can play games and waste your valuable time and help
                                    us
                                    making a lot of money.</p>
                                <h2>Rp 4.000.000</h2>
                                <a href="#" class="btn text-uppercase buy_btn_effect">Buy Now<span>➔</span></a>

                            </div>

                            <div class="col-md-6">
                                <img src="images/banner-products/product-1.png" class="d-block w-75 mx-auto" alt="...">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                            <a href="single-product-details.php?id=<?php echo $row['id']; ?>">
                                <h1>The New XBox 4A PRO</h1>
                                <p>This is the new XBox where you can play games and waste your valuable time and help
                                    us
                                    making a lot of money.</p>
                                <h2>Rp 3.000.000</h2>
                                <a href="#" class="btn text-uppercase buy_btn_effect">Buy Now<span>➔</span></a>

                            </div>
                            <div class="col-md-6">
                                <img src="images/banner-products/slider-1.png" class="d-block w-75 mx-auto" alt="...">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h1>The New XBox 4A PRO</h1>
                                <p>This is the new XBox where you can play games and waste your valuable time and help
                                    us
                                    making a lot of money.</p>
                                <h2>Rp 2.000.000</h2>
                                <a href="#" class="btn text-uppercase buy_btn_effect">Buy Now<span>➔</span></a>

                            </div>
                            <div class="col-md-6">
                                <img src="images/banner-products/slider-3.png" class="d-block w-75 mx-auto" alt="...">
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>


    <!-- products  -->
<section class="products" id="#shoes">
    <div class="container">
        <!-- Smartphone Categories -->
        <div class="row">
            <div class="products_header align-items-center d-flex justify-content-between text-capitalize">
                <h2 class="py-4">smartphone</h2>
                <a href="#">see all</a>
            </div>
                    <?php
                        include 'database/config.php'; // Include file koneksi database

                        // Query untuk mendapatkan data produk
                        $sql = "SELECT * FROM products LIMIT 10"; // Mengambil 10 produk pertama
                        $result = $conn->query($sql);

                        // Loop untuk menampilkan data produk
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                // Gambar produk
                                $imagePath = "admin-web/uploads/" . $row['gambar'];  // Sesuaikan dengan folder tempat gambar disimpan

                                // Menampilkan data produk
                                echo '<div class="col-md-4" style="margin-bottom: 30px;">
                                        <div class="card single_product">
                                            <img src="' . $imagePath . '" class="card-img-top p-5 mx-auto" alt="' . $row['nama'] . '" style="width: 280px; height: 280px; object-fit: cover;">
                                            <div class="card-body text-center">
                                                <h5 class="card-title">' . $row['nama'] . '</h5>
                                                <p class="card-text text-secondary">' . $row['penjelasan'] . '</p>
                                                <h5 class="card-title mb-3">Rp ' . number_format($row['harga'], 0, ',', '.') . '</h5>
                                                <a href="#" class="btn text-uppercase buy_btn_effect">Add To Cart</a>
                                            </div>
                                        </div>
                                    </div>';
                            }
                        } else {
                            echo "<p>No products available</p>";
                        }

                        $conn->close();
                        ?>
        </div>
    </div>
</section>


    <!-- Categories -->
    <section class="categories" id="#backpack">
        <div class="container">
            <h2
                class="py-4 text-center mx-auto text-capitalize border-bottom rounded border-5 border-warning w-25 mb-5">
                categories</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6 align-self-center">
                            <div class="card d-flex align-items-center">
                                <div class="card-body">
                                    <img src="images/Categories/bag.png" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card d-flex align-items-center mb-3">
                                <div class="card-body">
                                    <img class="" src="images/Categories/perfume.png" alt="">
                                </div>
                            </div>
                            <div class="card d-flex align-items-center">
                                <div class="card-body">
                                    <img class="" src="images/Categories/shoe.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">

                    <img class="img-fluid img-fluid w-75" src="images/Categories/pale-order.png" alt="">
                </div>
            </div>
        </div>
    </section>

    <!-- js file enqueue -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>


    <script>
        // Scroll to top
        document.addEventListener("DOMContentLoaded", function () {
            window.addEventListener('scroll', function () {
                if (window.scrollY > 150) {
                    document.getElementById('navbar_top').classList.add('fixed-top');
                    // add padding top to show content behind navbar
                    navbar_height = document.querySelector('.navbar').offsetHeight;
                    document.body.style.paddingTop = navbar_height + 'px';
                } else {
                    document.getElementById('navbar_top').classList.remove('fixed-top');
                    // remove padding top from body
                    document.body.style.paddingTop = '0';
                }
            });
        });
    </script>
</body>



</html>