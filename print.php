<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "pw2024_tubes_233040123");

function query($query) {
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// Mengambil data berita
$inspirasi = query("SELECT * FROM inspirasi");

require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();

$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Destinasi</title>
</head>
<body>
    <h1>Daftar Destinasi</h1>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Konten</th>
            <th>Gambar</th>
        </tr>';

$i = 1;
foreach ($inspirasi as $row) {
    $html .= '<tr>
        <td>' . $i++ . '</td>
        <td>' . $row["judul"] . '</td>
        <td>' . $row["konten"] . '</td>
         <td><img src="img/' . $row["gambar"] . '" alt="Gambar Berita" width="150"></td>
    </tr>';
}

$html .= '</table>
</body>
</html>';

$mpdf->WriteHTML($html);
$mpdf->Output('Daftar-Destinasi.pdf', 'I');
?>