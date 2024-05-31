<?php
// koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "pw2024_tubes_233040123");

function query($query) {
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data) {
    global $koneksi;

    $judul = htmlspecialchars($data["judul"]);
    $konten = htmlspecialchars($data["konten"]);

    // upload gambar
    $gambar = upload();
    if( !$gambar ) {
        return false;
    }

        // query insert data
    $query = "INSERT INTO inspirasi
    VALUES
    ('0', '$judul', '$konten', '$gambar')
    ";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}


function upload() {

    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if( $error === 4 ) {
        echo "<script>
                alert('pilih gambar terlebih dahulu!');
            </script>";
        return false;
    }

    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
        echo "<script>
                alert('yang anda upload bukan gambar!');
            </script>";
        return false;
    }

    // cek jika ukurannya terlalu besar
    if( $ukuranFile > 1000000 ) {
        echo "<script>
                alert('ukuran gambar terlalu besar!');
            </script>";
        return false;
    }

    // lolos pengecekan, gambar siap diupload
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}


function hapus($id) {
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM inspirasi WHERE id_inspirasi = $id");
    return mysqli_affected_rows($koneksi);
}

function ubah($data) {
    global $koneksi;

    $id = $data["id_inspirasi"];
    $judul = htmlspecialchars($data["judul"]);
    $konten = htmlspecialchars($data["konten"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    // cek apakah user pilih gambar baru atau tidak
    if( $_FILES['gambar']['error'] === 4 ) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    $query = "UPDATE inspirasi SET
                judul = '$judul',
                konten = '$konten',
                gambar = '$gambar'
                WHERE id_inspirasi = $id
                ";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function cari($keyword) {
    $query = "SELECT * FROM inspirasi
                WHERE
                judul LIKE '%$keyword%' OR
                konten LIKE '%$keyword%'
                ";
    return query($query);
}


function registrasi($data) {
    global $koneksi;

    $username = strtolower(stripslashes($data["username"]));
    $email = strtolower(stripslashes($data["email"]));
    $password = mysqli_real_escape_string($koneksi, $data["password"]);
    $password2 = mysqli_real_escape_string($koneksi, $data["password2"]);

    // cek username udah ada atau belum
   $result =  mysqli_query($koneksi, "SELECT username FROM user WHERE username = '$username'");
   if( mysqli_fetch_assoc($result) ) {
    echo "<script>
    alert('username sudah terdaftar!')
    </script>";
    return false;
   }
    

    // cek konfirmasi password 
    if( $password !== $password2 ) {
        echo "<script>
        alert('konfirmasi password tidak sesuai!')
        </script>";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambah user baru ke database
    mysqli_query($koneksi, "INSERT INTO user VALUES('0', '$username', '$email', '$password')");

    return mysqli_affected_rows($koneksi);

}

?>