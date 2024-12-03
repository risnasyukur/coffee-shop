<?php
// lihatpesanan.php

// Membuat koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "coffeeshop";

$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek apakah koneksi berhasil
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengambil data pesanan dari database
$sql = "SELECT * FROM `pesanan`";
$result = $conn->query($sql);

if (!$result) {
    die("Query gagal: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Coffee Shop</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f3e9;
            color: #3e2c41;
        }
        .container {
            width: 80%;
            margin: 30px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #6f4f37;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #6f4f37;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        td[colspan="7"] {
            text-align: center;
            font-style: italic;
            color: #888;
        }
        .btn {
            padding: 6px 12px;
            color: white;
            background-color: #4CAF50;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-danger {
            background-color: #f44336;
        }
        .btn:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Daftar Pesanan</h2>
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Nomor Meja</th>
                    <th>Metode Pembayaran</th>
                    <th>Kopi</th>
                    <th>Cemilan</th>
                    <th>Total Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Menampilkan setiap baris data pesanan
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>" . $row["nama"] . "</td>
                            <td>" . $row["nomor_meja"] . "</td>
                            <td>" . $row["metode_pembayaran"] . "</td>
                            <td>" . $row["kopi"] . " (" . $row["jumlah_kopi"] . ")</td>
                            <td>" . $row["cemilan"] . " (" . $row["jumlah_cemilan"] . ")</td>
                            <td>Rp " . number_format($row["total_harga"], 0, ',', '.') . "</td>
                            <td>
                                <a href='updatepesanan.php?id=" . $row['id'] . "' class='btn'>update</a>
                                <a href='deletepesanan.php?id=" . $row['id'] . "' class='btn btn-danger' onclick='return confirm(\"Apakah Anda yakin ingin menghapus pesanan ini?\")'>Delete</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Tidak ada pesanan</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
