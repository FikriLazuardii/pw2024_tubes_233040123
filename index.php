<?php
session_start();

if( !isset($_SESSION["login"]) ) {
  header("Location: login.php");
  exit;
}

require 'functions.php';

// ambil username dari sesi
$username = $_SESSION['username'];

// ambil data pengguna dari database
$result = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");
$user = mysqli_fetch_assoc($result);

$inspirasi = query("SELECT * FROM inspirasi");

// tombol cari ditekan
if( isset($_POST["cari"]) ) {
    $inspirasi = cari($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tourism</title>

    <!-- link font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100;300;400;700&family=Poppins:wght@100;300;400;700&display=swap" rel="stylesheet" />

    <!-- my style -->
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/responsive.css" />

    <!-- box icon -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

    <!-- feather icon -->
    <script src="https://unpkg.com/feather-icons"></script>

  </head>

  <body>
    <!-- Navbar -->
    <nav class="navbar">
      <a href="#" class="navbar-logo"><img src="imageasset/logotrip.png" alt="" /></a>

      <div class="navbar-nav">
        <a href="#home">HOME</a>
        <a href="#about">ABOUT US</a>
        <a href="#products">DESTINATION</a>
      </div>

      <div class="navbar-extra">
        <a href="#" id="search-button"><i data-feather="search"></i> </a>
        <a href="#" id="user-button" onclick="toggleMenu()"><i data-feather="user"></i> </a>
        <a href="#" id="hamburger-menu"><i data-feather="menu"></i> </a>
      </div>

      <div class="sub-menu-wrap" id="subMenu">
        <div class="sub-menu">
          <div class="user-info">
            <img class="dropdown-img" src="imageasset/user.png" alt="">
            <h2><?= htmlspecialchars($username); ?></h2>
          </div>
          <hr>

          <a href="profile.php" class="sub-menu-link">
            <img src="imageasset/user.png">
            <p>Edit Profile</p>
          </a>
          <a href="admin.php" class="sub-menu-link">
            <img src="imageasset/setting.png">
            <p>Halaman Admin</p>
          </a>
          <a href="logout.php" class="sub-menu-link">
            <img src="imageasset/logout.png">
            <p>Logout</p>
          </a>

        </div>
      </div>

      <!-- Search Form -->
      <form class="search-form" action="" method="post">
        <input type="text" name="keyword" size="40" autofocus="" placeholder="masukan keyword pencarian" autocomplete="off">
        <button type="submit" name="cari"><i data-feather="search"></i></button>
      </form>
      <!-- Search Form End -->
    </nav>
    <!-- Navbar End -->

    <!-- Hero Section -->
    <section class="hero" id="home">
      <main class="content">
        <h1>
          NIKMATI<span> LIBURAN</span><br />
          BERSAMA<span> KAMI</span>
        </h1>
        <p>TOURISM INDONESIA</p>
        <a href="#menu" class="cta">BOOK NOW</a>
      </main>
    </section>
    <!-- Hero Section End -->

    <!-- About Section -->
    <section id="about" class="about">
      <h2><span>ABOUT</span> US</h2>

      <div class="row">
        <div class="about-img">
          <img src="imageasset/aboutlogo.jpg" alt="Tentang Kami" />
        </div>
        <div class="content">
          <h3>TOURISM INDONESIA</h3>
          <p>
            Tourism Indonesia merupakan salah satu startup pariwisata yang memberikan fasilitas pemesanan atau booking hotel secara real time.
          </p>
          <p>
            Selain itu, informasi mengenai lokasi wisata juga dikemas secara modern dan lengkap. Tourism Indonesia telah bekerja sama dengan banyak akomodasi dan agen perjalanan wisata.
          </p>
        </div>
      </div>
    </section>
    <!-- About Section End -->

    <!-- Langganan -->
    <div class="subscription-form">
        <div class="content-langganan">
            <h1>Dapatkan E-Book Travel Gratis dengan Berlangganan</h1>
            <form>
                <input type="email" placeholder="Enter your email address ..." required>
                <button type="submit">BERLANGGANAN</button>
            </form>
            <p class="error-message">This field is required.</p>
        </div>
    </div>

    <!-- Destination Section -->
    <section class="products" id="products">
      <h2><span>DESTINASI</span> PILIHAN</h2>
      <div class="pembungkus">
      <?php foreach( $inspirasi as $row ) : ?>
      <div class="container">
         <div class="card">
          <div class="img-box">
            <img src="img/<?= $row["gambar"]; ?>" alt="">
          </div>
          <div class="content">
           <h2 class="judul-destinasi"><?php echo $row["judul"]?></h2>
            <p class="kata-inspirasi"><?php echo $row["konten"]?></p>
             <a href="">Read More</a>
           </div>
        </div>
       </div>
      <?php endforeach; ?>
      </div>
    </section>
    <!-- Destination End -->

    <!-- Banner -->
    <div class="banner">
        <div class="overlay">
            <h1>Telusuri 5 Pesona Wisata di Indonesia</h1>
            <a href="#" class="button">Info Selengkapnya</a>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <div class="footer-left">
                <img src="imageasset/logotourism.png" alt="Wonderful Indonesia Logo" class="logo">
                <div class="social-media">
                </div>
            </div>
            <div class="footer-right">
                <p>Kunjungi situs lainnya</p>
                <select>
                    <option>Pilih Situs</option>
                </select>
                <nav>
                    <a href="#">Kebijakan Cookie</a>
                    <a href="#">Kebijakan Privasi</a>
                    <a href="#">Syarat dan Ketentuan</a>
                    <a href="#">Hubungi Kami</a>
                </nav>
            </div>
        </div>
    </footer>
    <!-- Footer End -->

    <!-- feather icon -->
    <script>
      feather.replace();
    </script>

    <!-- my java -->
    <script src="js/script.js"></script>

    <script>
      let subMenu = document.getElementById("subMenu");

      function toggleMenu(){
        subMenu.classList.toggle("open-menu")
      }

    </script>
  </body>
</html>
