<?php
session_start();
require 'functions.php';

// cek apakah pengguna sudah login
if(!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

// ambil username dari sesi
$username = $_SESSION['username'];

//pengguna dari database
$result = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");
$user = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Card</title>
     <!-- link font -->
     <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100;300;400;700&family=Poppins:wght@100;300;400;700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="css/profile.css">
</head>
<body>
    <div class="card">
      <img src="imageasset/profile.jpg" alt="" class="img">
      <h1 class="name">Hallo, <?= htmlspecialchars($username); ?></h1>
      <p class="title"></p>
      <div class="desc">
        <p></p>
      </div>
      <a href="index.php"><button class="btn">Kembali</button></a>
    </div>
</body>
</html>
