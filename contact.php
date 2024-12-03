<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "coffeeshop";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Validasi sederhana
    if (!empty($name) && !empty($email) && !empty($message)) {
        // Simpan data ke database
        $stmt = $conn->prepare("INSERT INTO reviews (name, email, message) VALUES (?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("sss", $name, $email, $message);

            if ($stmt->execute()) {
                // Menampilkan pesan sukses setelah data berhasil disimpan
                $success_message = "Pesan Anda telah dikirim dan disimpan. Terima kasih!";
            } else {
                $error_message = "Gagal menyimpan pesan. Silakan coba lagi.";
            }
            $stmt->close();
        } else {
            $error_message = "Terjadi kesalahan pada server. Silakan coba lagi.";
        }
    } else {
        $error_message = "Semua kolom harus diisi!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(to right, #e0c3fc, #8ec5fc); 
            margin: 0;
            padding: 0;
        }

        .contact {
            margin: 60px auto;
            padding: 40px;
            max-width: 800px;
            background-color: #e5d7b8; 
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.5s ease-in-out;
            border: 2px solid #8b4513; 
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .heading6 {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #6a4e34; 
            animation: slideIn 0.5s ease-in-out;
        }

        @keyframes slideIn {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .contact-info {
            margin: 20px 0;
            font-size: 1.1rem;
            color: #6a4e34; 
            transition: transform 0.3s;
        }

        .contact-info:hover {
            transform: scale(1.05);
        }

        footer {
            text-align: center;
            padding: 20px 0;
            background-color: #6a4e34; 
            color: white; 
            position: relative;
            bottom: 0;
            width: 100%;
            margin-top: 20px;
        }

        .form-control {
            margin-bottom: 20px;
            border-radius: 10px;
            border: 1px solid #6a4e34; 
            transition: border-color 0.3s;
        }

        .form-control:focus {
            border-color: #8b4513; 
            box-shadow: 0 0 5px rgba(139, 69, 19, 0.5);
        }

        .btn-success {
            border-radius: 10px;
            transition: background-color 0.3s;
        }

        .btn-success:hover {
            background-color: #8b4513; 
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
                    <span><i class="fa-solid fa-bars" style="color: rgb(133, 80, 80); font-size: 23px;"></i></span>
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

        <section id="contact">
            <div class="contact">
                <h1 class="heading6">Hubungi Kami <span>Untuk Informasi Lebih Lanjut</span></h1>
                <p class="contact-info">Alamat: Jl. Pendidikan No.123, Makassar</p>
                <p class="contact-info">Email: <a href="mailto:info@kopilihdia.com">info@kopilihdia.com</a></p>
                <p class="contact-info">Telepon: <a href="tel:+6212345678">(021) 12345678</a></p>
                <p class="contact-info">Jam Operasional: Senin - Minggu, 08:00 - 20:00</p>

                <h2 class="heading6">Kirim Ulasan</h2>

                <!-- Success or error messages -->
                <?php if (isset($success_message)) : ?>
                    <div class="alert alert-success"><?php echo $success_message; ?></div>
                <?php elseif (isset($error_message)) : ?>
                    <div class="alert alert-danger"><?php echo $error_message; ?></div>
                <?php endif; ?>

                <form method="POST" action="contact.php">
                    <input type="text" name="name" class="form-control" placeholder="Nama" required>
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                    <textarea name="message" class="form-control" rows="4" placeholder="Pesan" required></textarea>
                    <button type="submit" class="btn btn-success">Kirim</button>
                </form>
            </div>
        </section>
    </div>
</body>
</html>
