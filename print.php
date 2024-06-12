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
    <!-- link font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100;300;400;700&family=Poppins:wght@100;300;400;700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="css/print.css">
</head>
<body>
    <h1>Daftar Destinasi</h1>
    <br>
    <table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Konten</th>
            <th>Gambar</th>
        </tr>
    </thead>';

$i = 1;
foreach ($inspirasi as $row) {
    $html .= '<tbody>
                <tr>
                    <td>' . $i++ . '</td>
                    <td>' . $row["judul"] . '</td>
                    <td>' . $row["konten"] . '</td>
                    <td><img src="img/' . $row["gambar"] . '" alt="Gambar Berita" width="150"></td>
                </tr>
              </tbody>';
}

$html .= '</table>
</body>
</html>';

$mpdf->WriteHTML($html);
$mpdf->Output('Daftar-Destinasi.pdf', 'I');
?>