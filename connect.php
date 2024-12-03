<?php
// connect.php

$host = 'localhost';  // Database server address
$dbname = 'coffeeshop';  // Database name
$username = 'root';  // Database username
$password = '';  // Database password

// DSN for PDO connection
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

$status = '';
$status_class = '';

try {
    // Attempt to create a PDO connection
    $pdo = new PDO($dsn, $username, $password);
    
    // Set PDO error mode to exceptions
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // If the connection is successful
    $status = "Koneksi berhasil!";
    $status_class = "success";
} catch (PDOException $e) {
    // Handle connection errors
    $status = "Koneksi gagal: " . $e->getMessage();
    $status_class = "error";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koneksi Database - Coffee Shop</title>
    <link rel="icon" href="https://img.icons8.com/ios/452/coffee.png" type="image/png">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }
        .container h1 {
            color: #2c3e50;
            font-size: 36px;
            margin-bottom: 20px;
        }
        .message {
            padding: 15px;
            margin-top: 20px;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
        }
        .success {
            background-color: #2ecc71;
            color: white;
        }
        .error {
            background-color: #e74c3c;
            color: white;
        }
        .icon {
            font-size: 50px;
            margin-bottom: 10px;
        }
        .icon img {
            width: 40px; /* Adjust the width of the image */
            height: auto; /* Maintain the aspect ratio */
        }
        .btn {
            display: inline-block;
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 18px;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="icon">
            <img src="https://img.icons8.com/ios/452/coffee.png" alt="coffee icon">
        </div>
        <h1>Status Koneksi</h1>
        <div class="message <?php echo $status_class; ?>">
            <?php echo $status; ?>
        </div>
        <a href="index.php" class="btn">Kembali ke Beranda</a>
    </div>

</body>
</html>
