<?php
require '../functions.php';
$keyword = $_GET["keyword"];

$query = "SELECT * FROM inspirasi
                WHERE
                judul LIKE '%$keyword%' OR
                konten LIKE '%$keyword%'
                ";
$inspirasi = query($query);
?>

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