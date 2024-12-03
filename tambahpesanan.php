<?php
// tambahpesanan.php

// Membuat koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "coffeeshop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $nomor_meja = $_POST['nomor_meja'];
    $metode_pembayaran = $_POST['metode_pembayaran'];
    $kopi = $_POST['kopi'];
    $jumlah_kopi = $_POST['jumlah_kopi'];
    $cemilan = $_POST['cemilan'];
    $jumlah_cemilan = $_POST['jumlah_cemilan'];
    $total_harga = $_POST['total_harga'];

    // Insert data ke database
    $sql = "INSERT INTO pesanan (nama, nomor_meja, metode_pembayaran, kopi, jumlah_kopi, cemilan, jumlah_cemilan, total_harga)
            VALUES ('$nama', '$nomor_meja', '$metode_pembayaran', '$kopi', '$jumlah_kopi', '$cemilan', '$jumlah_cemilan', '$total_harga')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Pesanan berhasil ditambahkan!'); window.location.href = 'lihatpesanan.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pesanan</title>
    <script>
        function hitungTotal() {
            const kopiOptions = document.getElementById('kopi');
            const kopiPrice = parseInt(kopiOptions.options[kopiOptions.selectedIndex].dataset.harga || 0);

            const cemilanOptions = document.getElementById('cemilan');
            const cemilanPrice = parseInt(cemilanOptions.options[cemilanOptions.selectedIndex].dataset.harga || 0);

            const jumlahKopi = parseInt(document.getElementById('jumlah_kopi').value || 0);
            const jumlahCemilan = parseInt(document.getElementById('jumlah_cemilan').value || 0);

            const totalHarga = (kopiPrice * jumlahKopi) + (cemilanPrice * jumlahCemilan);

            document.getElementById('total_harga').value = totalHarga;
        }
    </script>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
            margin: 0;
            color: #333;
        }
        .container {
            background: #fff;
            border-radius: 12px;
            padding: 30px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
            background-color: #fff8e1;
        }
        h2 {
            text-align: center;
            color: #5D4037;
            font-size: 2em;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin: 10px 0 5px;
            font-weight: bold;
            color: #6B4F35;
        }
        input, select, button {
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 16px;
            background-color: #f3e5ab;
        }
        button {
            background-color: #8d6e63;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #6d4c41;
        }
        input[readonly] {
            background-color: #f8f8f8;
        }
        select {
            background-color: #fff9c4;
            border: 1px solid #f0e68c;
        }
        select:focus {
            background-color: #f4ff81;
            outline: none;
            border-color: #c8e6c9;
        }
        .form-group {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Tambah Pesanan Baru</h2>
        <form method="POST" action="tambahpesanan.php">
            <label for="nama">Nama:</label>
            <input type="text" name="nama" id="nama" required>

            <label for="nomor_meja">Nomor Meja:</label>
            <select name="nomor_meja" id="nomor_meja" required>
                <option value="1">Meja 1</option>
                <option value="2">Meja 2</option>
                <option value="3">Meja 3</option>
                <option value="4">Meja 4</option>
                <option value="5">Meja 5</option>
            </select>

            <label for="metode_pembayaran">Metode Pembayaran:</label>
            <select name="metode_pembayaran" id="metode_pembayaran" required>
                <option value="Tunai">Tunai</option>
                <option value="Kartu Kredit">Kartu Kredit</option>
                <option value="E-wallet">E-wallet</option>
            </select>

            <label for="kopi">Kopi:</label>
            <select name="kopi" id="kopi" onchange="hitungTotal()" required>
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

            <label for="jumlah_kopi">Jumlah Kopi:</label>
            <input type="number" name="jumlah_kopi" id="jumlah_kopi" value="1" min="1" onchange="hitungTotal()">

            <label for="cemilan">Cemilan:</label>
            <select name="cemilan" id="cemilan" onchange="hitungTotal()" required>
            <option value="" disabled selected>Pilih Cemilan</option>
                <option value="pisangNugget">Pisang Nugget - Rp 15,000</option>
                <option value="rotiPanggang">Roti Panggang - Rp 10,000</option>
                <option value="belgia liege waffle">Belgia Liege Waffle - Rp 20,000</option>
            </select>

            <label for="jumlah_cemilan">Jumlah Cemilan:</label>
            <input type="number" name="jumlah_cemilan" id="jumlah_cemilan" value="1" min="1" onchange="hitungTotal()">

            <label for="total_harga">Total Harga:</label>
            <input type="text" name="total_harga" id="total_harga" readonly>

            <button type="submit">Tambah Pesanan</button>
        </form>
    </div>
</body>
</html>
