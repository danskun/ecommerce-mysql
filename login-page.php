<?php
session_start();
include("database/config.php");

$username = "";
$password = "";
$err = "";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validasi input
    if (empty($username) || empty($password)) {
        $err .= "<li>Silakan masukkan username dan password</li>";
    }

    if (empty($err)) {
        // Cek di database
        $sql1 = "SELECT * FROM users WHERE email = '$username'";
        $q1 = mysqli_query($conn, $sql1);
        $r1 = mysqli_fetch_array($q1);

        // Cek password
        if ($r1['password'] != md5($password)) {
            $err .= "<li>Akun tidak ditemukan</li>";
        }
    }

    if (empty($err)) {
        // Set session untuk login
        $_SESSION['login'] = true;
        $_SESSION['user_id'] = $r1['id'];

        // Redirect ke halaman index setelah login
        header("Location: index.php");
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
            <h2>Ecommerce</h2>
        </div>
        <form action="" method="POST" class="the-form">
            <label for="username">Email</label>
            <input type="email" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" name="login" class="btn">Login</button>
        </form>
    </div>
</div>

        </div><!-- FORM BODY -->

        <div class="form-footer">
            <div>
                <span>Don't have an account?</span> <a href="#">Sign Up</a>
            </div>
        </div><!-- FORM FOOTER -->

    </div><!-- FORM CONTAINER -->

</body>
</html>
