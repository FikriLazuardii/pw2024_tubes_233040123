<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
  header("Location: login.php");
  exit;
}

require 'functions.php';

// ambil data di URL
$id = $_GET["id_inspirasi"];

//query data mahasiswa berdasarkan id
$ins = query("SELECT * FROM inspirasi WHERE id_inspirasi = $id")[0];


// cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["submit"]) ) {

    // cek apakah data berhasil diubah atau tidak
    if( ubah($_POST) > 0 ) {
        echo "
        <script>
            alert('data berhasil diubah!');
            document.location.href = 'admin.php';
            </script>
            ";
    } else {
        echo "
        <script>
            alert('data gagal diubah!');
            document.location.href = 'admin.php';
            </script>
            ";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ubah data Destinasi</title>
</head>
<body>
    <h1>Ubah data Destinasi</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_inspirasi" value="<?= $ins["id_inspirasi"] ?>">
        <input type="hidden" name="gambarLama" value="<?= $ins["gambar"] ?>">
        <ul>
            <li>
                <label for="judul">Judul: </label>
                <input type="text" name="judul" id="judul" requied value="<?= $ins["judul"] ?>">
            </li>
            <li>
                <label for="konten">Konten: </label>
                <input type="text" name="konten" id="konten" required value="<?= $ins["konten"] ?>">
            </li>
            <li>
                <label for="gambar">Gambar: </label> <br>
                <img src="img/<?= $ins['gambar']; ?>" width="40" alt=""> <br>
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <button type="submit" name="submit">Ubah Data</button>
            </li>
        </ul>
    </form>
</body>
</html>