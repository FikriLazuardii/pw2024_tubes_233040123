<?php
session_start();
require 'functions.php';

if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $result = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            // set session
            $_SESSION["login"] = true;
            $_SESSION["username"] = $row['username'];
            $_SESSION["role"] = $row['role'];

            if (isset($_POST['remember'])) {
                setcookie('id', $row['id'], time() + 3600); // Cookie berlaku selama 1 jam
                setcookie('key', hash('sha256', $row['username']), time() + 3600);
            }

            header("Location: index.php");
            exit;
        }
    }

    $error = true;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="css/login.css">

    <!-- link font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100;300;400;700&family=Poppins:wght@100;300;400;700&display=swap" rel="stylesheet" />

    <!-- feather icon -->
    <script src="https://unpkg.com/feather-icons"></script>

</head>
<body>
    <div class="wrapper">
        <form action="" method="post">
            <h1>LOGIN</h1>
            <?php if( isset($error) ) : ?>
                <p class="warning">Username / Password Salah !!!</p>
            <?php endif; ?>
            <div class="input-box">
                <label for="username"></label>
                <input type="text" placeholder="username" required name="username" id="username">
                 <i class="icon" data-feather="user"></i>
            </div>
             <div class="input-box">
                <label for="email"></label>
                <input type="text" placeholder="email" required name="email" id="email">
                 <i class="icon" data-feather="mail"></i>
            </div>
             <div class="input-box">
                <label for="password"></label>
                <input type="password" placeholder="password" required name="password" id="password">
                <i class="icon" data-feather="lock"></i>
             </div>
             <div>
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember me</label>
             </div>

             <button type="submit" class="btn-login" name="login">Login</button>

            <div class="register-link">
             <p>Don't have an account? <a href="registrasi.php">Register</a></p>
            </div>
        </form>
    </div>

    <!-- feather icon -->
    <script>
      feather.replace();
    </script>
</body>
</html>