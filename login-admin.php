<?php
session_start();
if (isset($_SESSION['login'])) {
    header("location:index.php");
    exit();
}

include("database/config.php");
$username = "";
$password = "";
$err = "";

if (isset($_POST['login'])) {
    $username   = $_POST['username'];
    $password   = $_POST['password'];
    
    // Validasi input
    if ($username == '' || $password == '') {
        $err .= "<li>Silakan masukkan username dan password</li>";
    }

    if (empty($err)) {
        // Menggunakan prepared statement untuk menghindari SQL Injection
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        // Memastikan ada data pengguna
        if ($result->num_rows == 0) {
            $err .= "<li>Akun tidak ditemukan</li>";
        } else {
            $r1 = $result->fetch_assoc();
            // Mengecek password
            if ($r1['password'] != md5($password)) {
                $err .= "<li>Password salah</li>";
            } else {
                // Mengambil akses_id dan memverifikasi apakah user adalah admin
                $akses_id = $r1['akses_id'];
                if ($akses_id != 0) {  // 1 bisa dianggap sebagai ID untuk Admin
                    $err .= "<li>Kamu tidak punya akses ke halaman admin</li>";
                }
            }
        }
    }

    // Jika tidak ada error, set session dan arahkan ke halaman admin
    if (empty($err)) {
        $_SESSION['admin_username'] = $username;
        $_SESSION['admin_akses'] = $r1['akses_id'];  // Set akses_id ke session
        header("location:admin-web/index.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Muli:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style-with-prefix.css">
    <style>
        .srouce-title {
            text-align: left;
            color: #111111;
        }
        .error-message {
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="main-container">
    <div class="form-container">
        <div class="srouce-title">
            <h2>Login Admin</h2>
        </div>
        
        <!-- Tampilkan error jika ada -->
        <?php if (!empty($err)): ?>
            <div class="error-message">
                <ul><?php echo $err; ?></ul>
            </div>
        <?php endif; ?>
        
        <form action="" method="POST" class="the-form">
            <label for="username">Email</label>
            <input type="email" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" name="login" class="btn">Login</button>
        </form>
    </div>
</div>

</body>
</html>
