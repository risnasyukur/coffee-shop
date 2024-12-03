<?php
// deletepesanan.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "coffeeshop";

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek apakah koneksi berhasil
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengecek apakah parameter ID ada
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Menghapus data pesanan berdasarkan ID
    $sql = "DELETE FROM pesanan WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Pesanan berhasil dihapus!'); window.location.href = 'lihatpesanan.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
