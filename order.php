<?php
// order.php

// Membuat koneksi ke database
$servername = "localhost"; // Ganti dengan server Anda
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "coffeeshop"; // Ganti dengan nama database Anda

$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek apakah koneksi berhasil
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mendapatkan data yang dikirim dari form
    $nama = $_POST['nama'];
    $nomorMeja = $_POST['nomorMeja'];
    $metodePembayaran = $_POST['metodePembayaran'];
    $kopi = $_POST['kopi'];
    $jumlahKopi = $_POST['jumlahKopi'];
    $cemilan = $_POST['cemilan'];
    $jumlahCemilan = $_POST['jumlahCemilan'];

    // Harga untuk menu kopi dan cemilan
    $hargaKopi = [
        "espresso" => 20000,
        "americano" => 22000,
        "cappuccino" => 25000,
        "latte" => 25000,
        "mocha" => 30000,
        "flat white" => 28000,
        "iced coffe" => 22000,
        "cold brew" => 25000,
        "affogato" => 35000
    ];

    $hargaCemilan = [
        "pisangNugget" => 15000,
        "rotiPanggang" => 10000,
        "belgia liege waffle" => 20000,
        "churros" => 25000,
        "french fries" => 12000,
        "bakso crispy" => 18000
    ];

    // Menghitung total harga
    $totalHarga = 0;
    if ($kopi && $jumlahKopi) {
        $totalHarga += $hargaKopi[$kopi] * $jumlahKopi;
    }
    if ($cemilan && $jumlahCemilan) {
        $totalHarga += $hargaCemilan[$cemilan] * $jumlahCemilan;
    }

    // Menyimpan data pesanan ke dalam database
    $sql = "INSERT INTO pesanan (nama, nomor_meja, metode_pembayaran, kopi, jumlah_kopi, cemilan, jumlah_cemilan, total_harga) 
            VALUES ('$nama', $nomorMeja, '$metodePembayaran', '$kopi', $jumlahKopi, '$cemilan', $jumlahCemilan, $totalHarga)";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Pesanan berhasil disimpan!'); window.location.href='order.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Coffee Shop</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <style>
        /* Gaya untuk halaman order dengan warna dan animasi */
        body {
            background-color: #f5f5f5;
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            padding: 0;
        }

        .order-container {
            margin: 60px auto;
            padding: 40px;
            border: 1px solid #6a4e34;
            border-radius: 15px;
            max-width: 800px;
            background-color: #e5d7b8;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h2 {
            text-align: center;
            color: #6a4e34;
            font-weight: 600;
            margin-bottom: 30px;
        }

        h3 {
            color: #8b4513;
            margin-top: 20px;
            font-weight: 600;
        }

        .form-label {
            color: #6a4e34;
        }

        .total {
            font-weight: bold;
            font-size: 1.5rem;
            text-align: right;
            color: #8b4513;
        }

        .btn-primary {
            background-color: #6a4e34;
            border: none;
        }

        .btn-primary:hover {
            background-color: #8b4513;
            transition: background-color 0.3s ease;
        }

        .btn-primary:active {
            transform: scale(0.98);
        }
    </style>
</head>
<body>
    <div class="all-content">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg" id="navbar">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.html" id="logo"><img src="./images/logo.png" alt=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span><i class="fa-solid fa-bars" style="color: white; font-size: 23px;"></i></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="menu.php">Menu</a></li>
                        <li class="nav-item"><a class="nav-link active" href="order.php">Order</a></li>
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

        <!-- Order Section -->
        <section class="order-container">
            <h2 class="text-center">Pesan Sekarang</h2>

            <form action="order.php" method="POST">
                <!-- Informasi Pelanggan -->
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama:</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama" required>
                </div>
                <div class="mb-3">
                    <label for="nomorMeja" class="form-label">Nomor Meja:</label>
                    <input type="number" class="form-control" id="nomorMeja" name="nomorMeja" placeholder="Masukkan Nomor Meja" required>
                </div>
                <div class="mb-3">
                    <label for="metodePembayaran" class="form-label">Metode Pembayaran:</label>
                    <select id="metodePembayaran" name="metodePembayaran" class="form-select" required>
                        <option value="" disabled selected>Pilih Metode Pembayaran</option>
                        <option value="Tunai">Tunai</option>
                        <option value="Kartu Kredit">Kartu Kredit</option>
                        <option value="E-wallet">E-wallet</option>
                    </select>
                </div>

                <!-- Daftar Menu Kopi -->
                <h3>Kopi</h3>
                <div class="mb-3">
                    <label for="kopiSelect" class="form-label">Pilih Menu Kopi:</label>
                    <select id="kopiSelect" name="kopi" class="form-select">
                        <option value="" disabled selected>Pilih Kopi</option>
                        <option value="espresso">Espresso - Rp 20,000</option>
                        <option value="americano">Americano - Rp 22,000</option>
                        <option value="cappuccino">Cappuccino - Rp 25,000</option>
                        <option value="latte">Latte - Rp 25,000</option>
                        <option value="mocha">Mocha - Rp 30,000</option>
                        <option value="flat white">Flat White - Rp 28,000</option>
                        <option value="iced coffe">Iced Coffee - Rp 22,000</option>
                        <option value="cold brew">Cold Brew - Rp 25,000</option>
                        <option value="affogato">Affogato - Rp 35,000</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jumlahKopi" class="form-label">Jumlah Kopi:</label>
                    <input type="number" class="form-control" id="jumlahKopi" name="jumlahKopi" value="1" min="1">
                </div>

                <!-- Daftar Menu Cemilan -->
                <h3>Cemilan</h3>
                <div class="mb-3">
                    <label for="cemilanSelect" class="form-label">Pilih Cemilan:</label>
                    <select id="cemilanSelect" name="cemilan" class="form-select">
                        <option value="" disabled selected>Pilih Cemilan</option>
                        <option value="pisangNugget">Pisang Nugget - Rp 15,000</option>
                        <option value="rotiPanggang">Roti Panggang - Rp 10,000</option>
                        <option value="belgia liege waffle">Belgia Liege Waffle - Rp 20,000</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jumlahCemilan" class="form-label">Jumlah Cemilan:</label>
                    <input type="number" class="form-control" id="jumlahCemilan" name="jumlahCemilan" value="1" min="1">
                </div>

                <!-- Tombol Kirim -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Pesan Sekarang</button>
                </div>
            </form>
        </section>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
