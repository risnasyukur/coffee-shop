<?php
// Koneksi ke database
$servername = "localhost"; // Ganti dengan server Anda
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "coffeeshop"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menarik data menu kopi dan cemilan
$sql_kopi = "SELECT * FROM menu WHERE jenis_menu = 'Kopi'";
$result_kopi = $conn->query($sql_kopi);

$sql_cemilan = "SELECT * FROM menu WHERE jenis_menu = 'Cemilan'";
$result_cemilan = $conn->query($sql_cemilan);

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Coffee Shop</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lobster&family=Poppins:wght@400;600&display=swap');
        
        .menu-heading {
            font-family: 'Lobster', cursive; 
            font-size: 2.5rem; 
            text-align: center; 
            margin: 20px 0; 
            color: #3B2F2F; 
        }
        
        .menu-item .card-title {
            font-family: 'Lobster', cursive; 
            font-size: 1.5rem; 
            text-align: center; 
        }

        .menu-item .card-text {
            font-family: 'Poppins', sans-serif; 
            font-size: 1rem; 
            text-align: center; 
        }

        .menu-item .card-text strong {
            font-family: 'Poppins', sans-serif; 
            color: #795423; 
            font-weight: bold; 
            font-size: 1.2rem; 
            text-align: center; 
            display: block; 
        }
    </style>
</head>
<body>
    <div class="all-content">
        <nav class="navbar navbar-expand-lg" id="navbar">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php" id="logo"><img src="./images/logo.png" alt=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span><i class="fa-solid fa-bars" style="color: white; font-size: 23px;"></i></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                        <li class="nav-item"><a class="nav-link active" href="menu.php">Menu</a></li>
                        <li class="nav-item"><a class="nav-link" href="order.php">Order</a></li>
                        <li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
                        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                    </ul>
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>

        <section id="menu">
            <div class="container">
                <h2 class="text-center my-4">Menu Kami</h2>

                <!-- Menu Kopi -->
                <h3 class="menu-heading">Kopi</h3>
                <div class="row">
                    <?php
                    if ($result_kopi->num_rows > 0) {
                        while ($row = $result_kopi->fetch_assoc()) {
                            echo "
                            <div class='col-md-4'>
                                <div class='card menu-item'>
                                    <img src='./images/{$row['gambar']}' class='card-img-top' alt='{$row['nama_menu']}'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>{$row['nama_menu']}</h5>
                                        <p class='card-text'>{$row['deskripsi']}</p>
                                        <p class='card-text'><strong>Harga: Rp {$row['harga']}</strong></p>
                                    </div>
                                </div>
                            </div>";
                        }
                    } else {
                        echo "Tidak ada menu kopi.";
                    }
                    ?>
                </div>

                <!-- Menu Cemilan -->
                <h3 class="menu-heading">Cemilan</h3>
                <div class="row">
                    <?php
                    if ($result_cemilan->num_rows > 0) {
                        while ($row = $result_cemilan->fetch_assoc()) {
                            echo "
                            <div class='col-md-4'>
                                <div class='card menu-item'>
                                    <img src='./images/{$row['gambar']}' class='card-img-top' alt='{$row['nama_menu']}'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>{$row['nama_menu']}</h5>
                                        <p class='card-text'>{$row['deskripsi']}</p>
                                        <p class='card-text'><strong>Harga: Rp {$row['harga']}</strong></p>
                                    </div>
                                </div>
                            </div>";
                        }
                    } else {
                        echo "Tidak ada menu cemilan.";
                    }
                    ?>
                </div>

            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</html>
