<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

require 'functions.php';

// Pagnination
// Konfigurasi
$jumlahDataPerHalaman = 2;
$jumlahData = count(query("SELECT * FROM inspirasi"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$page = ( isset($_GET["page"]) ) ? $_GET["page"] : 1;
$awalData = ( $jumlahDataPerHalaman * $page ) - $jumlahDataPerHalaman;

$inspirasi = query("SELECT * FROM inspirasi LIMIT $awalData, $jumlahDataPerHalaman");

// tombol cari ditekan
if( isset($_POST["cari"]) ) {
    $inspirasi = cari($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>

    <link rel="stylesheet" href="css/admin.css">

    <!-- link font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100;300;400;700&family=Poppins:wght@100;300;400;700&display=swap" rel="stylesheet" />

</head>
<body>
    
<h1>Tambah Destinasi</h1>

<a href="index.php"><button class="cool-button">Halaman Utama</button></a>
<a href="tambah.php"><button class="cool-button">Tambah Destinasi</button></a>
<a href="print.php" target="_blank"><button class="cool-button">Print</button></a>
<br><br>


    <form action="" method="post">
        <input class="search-input" type="text" name="keyword" size="40" autofocus="" placeholder="masukan keyword pencarian" autocomplete="off" id="keyword">
        <button class="search-button" type="submit" name="cari" id="tombol-cari">Cari!</button>
    </form>
<br>

<!-- navigasi -->
 <div class="pagination">
 <?php if( $page > 1 ) : ?>
<a href="?page=<?= $page - 1?>">&laquo;</a>
<?php endif; ?>

 <?php for($i = 1; $i <= $jumlahHalaman; $i++ ) : ?>
    <?php if( $i == $page ) : ?>
    <a href="?page=<?= $i ?>" style="font-weight: bold; color: red;"><?= $i; ?></a>
    <?php else : ?>
        <a href="?page=<?= $i ?>"><?= $i; ?></a>
    <?php endif; ?>
 <?php endfor; ?>

 <?php if( $page < $jumlahHalaman ) : ?>
<a href="?page=<?= $page + 1 ?>">&raquo;</a>
<?php endif; ?>
 </div>
<br>


<div class="table-admin" id="container">
<table border="1" cellpadding="10" cellspacing="0">
<thead>
<tr>
    <th>No.</th>
    <th>Judul</th>
    <th>Konten</th>
    <th>Gambar</th>
    <th>Aksi</th>
</tr>
</thead>
<tbody>
<?php $i = 1; ?>
<?php foreach( $inspirasi as $row ) : ?>
<tr>
    <td><?php echo $i; ?></td>

    <td><?php echo $row["judul"]?></td>
    <td><?php echo $row["konten"]?></td>
    <td><img src="img/<?= $row["gambar"]; ?>" width="50"></td>
    <td>
        <span class="action-btn"> 
            <a href="ubah.php?id_inspirasi=<?= $row["id_inspirasi"] ?>">ubah</a>
            <a href="hapus.php?id_inspirasi=<?= $row["id_inspirasi"]; ?>"  onclick="return confirm('yakin?');">hapus</a>
        </span>  
    </td>

</tr>
<?php $i++; ?>
<?php endforeach; ?>

</tbody>
</table>
</div>

<script src="js/ajax.js"></script>

</body>
</html>