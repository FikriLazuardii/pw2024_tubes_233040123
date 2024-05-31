<?php

require 'functions.php';

if( isset($_POST["register"]) ) {
    if( registrasi($_POST) > 0 ) {
        echo "<script>
        alert('user baru berhasil ditambahkan!')
        </script>";
    } else {
        echo mysqli_error($koneksi);
    }
    
    } 

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>

    <link rel="stylesheet" href="registrasi.css">

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
            <h1>REGISTRASI</h1>
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
             <div class="input-box">
                <label for="password2"></label>
                <input type="password" placeholder="confrim password" required name="password2" id="password2">
                <i class="icon" data-feather="lock"></i>
             </div>

             <button type="submit" class="btn-register" name="register">Register</button>

            <div class="register-link">
             <p>Don't have an account? <a href="login.php">Login</a></p>
            </div>
        </form>
    </div>

    <!-- feather icon -->
    <script>
      feather.replace();
    </script>
</body>
</html>