<?php
session_start();

if( !isset($_SESSION["login"]) ) {
  header("Location: login.php");
  exit;
}

require 'functions.php';
// cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["submit"]) ) {

    // cek apakah data berhasil ditambahkan atau tidak
    if( tambah($_POST) > 0 ) {
        echo "
        <script>
            alert('data berhasil ditambahkan!');
            document.location.href = 'admin.php';
            </script>
            ";
    } else {
        echo "
        <script>
            alert('data gagal ditambahkan!');
            document.location.href = 'admin.php';
            </script>
            ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Destinasi</title>

    <link rel="stylesheet" href="tambah.css">

</head>
<body>
    
    <form action="" method="post" enctype="multipart/form-data">
        <h1>Tambah Destinasi</h1>
        <ul>
            <li>
                <label for="judul">Judul :</label>
                <input class="input-text" type="text" name="judul" id="judul">
            </li>
            <li>
                <label for="konten">Konten :</label>
                <input class="input-text" type="text" name="konten" id="konten">
            </li>
            <li>
                <label for="gambar">Gambar :</label>
                <input class="input-file" type="file" name="gambar" id="gambar">
            </li>
            <li>
                <button class="input-submit" type="submit" name="submit">Tambah Data!</button>
            </li>
        </ul>

    </form>

</body>
</html>