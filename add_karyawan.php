<?php
// Konfigurasi koneksi database
$host = "localhost";
$username = "root";
$password = "";
$database = "coffeeshop";

$conn = new mysqli($host, $username, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Cek apakah data dikirim melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $position = $_POST['position'];
    $phone_number = $_POST['phone_number'];
    $hire_date = $_POST['hire_date'];
    $salary = $_POST['salary'];

    // Query untuk memasukkan data ke tabel karyawan
    $sql = "INSERT INTO karyawan (name, position, phone_number, hire_date, salary) 
            VALUES ('$name', '$position', '$phone_number', '$hire_date', '$salary')";

    if ($conn->query($sql) === TRUE) {
        $message = "Data karyawan berhasil disimpan!";
        $message_type = "success"; // Tipe pesan berhasil
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
        $message_type = "error"; // Tipe pesan error
    }
}

// Tutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Karyawan</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f9;
        }
        .container {
            width: 450px;
            background-color: #ffffff;
            padding: 25px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 22px;
            margin-bottom: 15px;
            color: #444;
            text-align: center;
        }
        form label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #555;
        }
        form input[type="text"],
        form input[type="date"],
        form input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        form input:focus {
            border-color: #007bff;
            outline: none;
        }
        form button {
            width: 100%;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            padding: 12px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        form button:hover {
            background-color: #0056b3;
        }
        .message {
            margin-top: 20px;
            font-size: 16px;
            text-align: center;
            padding: 15px;
            border-radius: 5px;
            display: none;
            font-weight: 500;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }
        .success {
            background-color: #28a745;
            color: #fff;
        }
        .error {
            background-color: #dc3545;
            color: #fff;
        }

        /* Menghilangkan spinner pada input number */
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type="number"] {
            -moz-appearance: textfield;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tambah Karyawan</h1>
        <form action="" method="POST">
            <label for="name">Nama:</label>
            <input type="text" id="name" name="name" required>

            <label for="position">Jabatan:</label>
            <input type="text" id="position" name="position" required>

            <label for="phone_number">No. Telepon:</label>
            <input type="text" id="phone_number" name="phone_number" required>

            <label for="hire_date">Tanggal Bergabung:</label>
            <input type="date" id="hire_date" name="hire_date" required>

            <label for="salary">Gaji (Rp):</label>
            <input type="text" id="salary" name="salary" oninput="this.value=this.value.replace(/[^0-9]/g,'')" placeholder="Masukkan gaji" required>

            <button type="submit">Simpan</button>
        </form>

        <?php if (!empty($message)): ?>
            <div class="message <?php echo $message_type; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>
    </div>

    <script>
        // Menampilkan pesan setelah form disubmit
        <?php if (!empty($message)): ?>
            var messageElement = document.querySelector('.message');
            messageElement.style.display = 'block';
            messageElement.style.opacity = 1; // Tampilkan pesan

            // Menghilangkan pesan setelah 10 detik
            setTimeout(function() {
                messageElement.style.opacity = 0; // Sembunyikan pesan
                setTimeout(function() {
                    messageElement.style.display = 'none'; // Hapus pesan dari tampilan
                }, 500); // Tunggu 0.5 detik untuk efek transisi
            }, 10000); // Tunggu 10 detik sebelum menghilang
        <?php endif; ?>
    </script>
</body>
</html>
