<?php
require 'functions.php';
$inspirasi = query("SELECT * FROM inspirasi");

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

    <link rel="stylesheet" href="admin.css">

    <!-- link font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100;300;400;700&family=Poppins:wght@100;300;400;700&display=swap" rel="stylesheet" />

</head>
<body>
    
<h1>Tambah Destinasi</h1>

<button class="cool-button"><a href="tambah.php">Tambah Destinasi</a></button>
<br><br>


    <form action="" method="post">
        <input class="search-input" type="text" name="keyword" size="40" autofocus="" placeholder="masukan keyword pencarian" autocomplete="off">
        <button class="search-button" type="submit" name="cari">Cari!</button>
    </form>
<br>

<div class="table-admin">
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
    <td><?php echo $i ?></td>

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

</body>
</html>