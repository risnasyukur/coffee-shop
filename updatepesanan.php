<?php
// editpesanan.php

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

    // Mengambil data pesanan berdasarkan ID
    $sql = "SELECT * FROM pesanan WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        die("Pesanan tidak ditemukan.");
    }
}

// Proses update data setelah form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $nomor_meja = $_POST['nomor_meja'];
    $metode_pembayaran = $_POST['metode_pembayaran'];
    $kopi = $_POST['kopi'];
    $jumlah_kopi = $_POST['jumlah_kopi'];
    $cemilan = $_POST['cemilan'];
    $jumlah_cemilan = $_POST['jumlah_cemilan'];

    // Menentukan harga kopi dan cemilan
    $kopi_prices = [
        'Espresso' => 20000,
        'Latte' => 25000,
        'Americano' => 22000,
        'Cappuccino' => 25000,
        'Flat White' => 28000,
        'Iced Coffe' => 22000,
        'Cold Brew' => 25000,
        'Affogato' => 35000,
    ];
    $cemilan_prices = [
        'Pisang Nugget' => 15000,
        'Roti panggang' => 10000,
        'Belgia Liege Waffle' => 20000,
    ];

    // Menghitung total harga
    $harga_kopi = $kopi_prices[$kopi] * $jumlah_kopi;
    $harga_cemilan = $cemilan_prices[$cemilan] * $jumlah_cemilan;
    $total_harga = $harga_kopi + $harga_cemilan;

    // Menyimpan data yang sudah diupdate ke database
    $update_sql = "UPDATE pesanan SET
                    nama = '$nama',
                    nomor_meja = '$nomor_meja',
                    metode_pembayaran = '$metode_pembayaran',
                    kopi = '$kopi',
                    jumlah_kopi = '$jumlah_kopi',
                    cemilan = '$cemilan',
                    jumlah_cemilan = '$jumlah_cemilan',
                    total_harga = $total_harga
                    WHERE id = $id";

    if ($conn->query($update_sql) === TRUE) {
        // Mengarahkan ke halaman lihatpesanan.php setelah update berhasil
        header("Location: lihatpesanan.php?id=$id");
        exit(); // Menghentikan script setelah redirect
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pesanan</title>
    <style>
       <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pesanan</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            color: #333;
        }

        h2 {
            text-align: center;
            color: #333;
            padding: 20px;
            background-color: #2c3e50;
            color: white;
            margin-bottom: 20px;
        }

        .container {
            width: 50%;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 16px;
            margin: 10px 0 5px;
        }

        input, select {
            padding: 10px;
            margin-bottom: 20px;
            font-size: 16px;
            border: 2px solid #ddd;
            border-radius: 5px;
        }

        input[type="number"] {
            width: 100px;
        }

        select {
            width: 100%;
        }

        .total-price {
            font-size: 18px;
            font-weight: bold;
            color: #e74c3c;
            margin: 20px 0;
        }

        button {
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #2980b9;
        }

        button:active {
            background-color: #1d6fa5;
        }

        /* Responsive Styling */
        @media screen and (max-width: 768px) {
            .container {
                width: 80%;
            }
        }
    </style>

</head>
<body>
    <h2>Edit Pesanan</h2>
    <div class="container">
        <form method="POST" action="updatepesanan.php?id=<?php echo $row['id']; ?>" onsubmit="calculateTotal(event)">
            <!-- Form untuk update data pesanan -->
            <label for="nama">Nama:</label>
            <input type="text" name="nama" id="nama" value="<?php echo $row['nama']; ?>" required>
            
            <label for="nomor_meja">Nomor Meja:</label>
            <select name="nomor_meja" id="nomor_meja" required>
                <option value="1" <?php echo ($row['nomor_meja'] == 1) ? 'selected' : ''; ?>>Meja 1</option>
                <option value="2" <?php echo ($row['nomor_meja'] == 2) ? 'selected' : ''; ?>>Meja 2</option>
                <option value="3" <?php echo ($row['nomor_meja'] == 3) ? 'selected' : ''; ?>>Meja 3</option>
                <option value="4" <?php echo ($row['nomor_meja'] == 4) ? 'selected' : ''; ?>>Meja 4</option>
            </select>

            <label for="metode_pembayaran">Metode Pembayaran:</label>
            <select name="metode_pembayaran" id="metode_pembayaran" required>
                <option value="Tunai" <?php echo ($row['metode_pembayaran'] == 'Tunai') ? 'selected' : ''; ?>>Tunai</option>
                <option value="kartu Kredit" <?php echo ($row['metode_pembayaran'] == 'kartu Kredit') ? 'selected' : ''; ?>>Kartu Kredit</option>
                <option value="E-Wallet" <?php echo ($row['metode_pembayaran'] == 'E-wallet') ? 'selected' : ''; ?>>E-wallet</option>
            </select>

            <label for="kopi">Kopi:</label>
            <select name="kopi" id="kopi" onchange="calculateTotal()" required>
                <option value="Espresso" data-price="20000" <?php echo ($row['kopi'] == 'Espresso') ? 'selected' : ''; ?>>Espresso - Rp 20,000</option>
                <option value="Latte" data-price="25000" <?php echo ($row['kopi'] == 'Latte') ? 'selected' : ''; ?>>Latte - Rp 25,000</option>
                <option value="Americano" data-price="22000" <?php echo ($row['kopi'] == 'Americano') ? 'selected' : ''; ?>>Americano - Rp 22,000</option>
                <option value="Cappuccino" data-price="25000" <?php echo ($row['kopi'] == 'Cappuccino') ? 'selected' : ''; ?>>Cappuccino - Rp 25,000</option>
                <option value="Mocha" data-price="30000" <?php echo ($row['kopi'] == 'Mocha') ? 'selected' : ''; ?>>Mocha - Rp 30,000</option>
                <option value="Flat White" data-price="28000" <?php echo ($row['kopi'] == 'Flat White') ? 'selected' : ''; ?>>Flat White - Rp 28,000</option>
                <option value="Iced Coffe" data-price="22000" <?php echo ($row['kopi'] == 'Iced Coffe') ? 'selected' : ''; ?>>Iced Coffe - Rp 22,000</option>
                <option value="Cold Brew" data-price="25000" <?php echo ($row['kopi'] == 'Cold Brew') ? 'selected' : ''; ?>>Cold Brew - Rp 25,000</option>
                <option value="Affogato" data-price="35000" <?php echo ($row['kopi'] == 'Affogato') ? 'selected' : ''; ?>>Affogato - Rp 35,000</option>
            </select>

            <label for="jumlah_kopi">Jumlah Kopi:</label>
            <input type="number" name="jumlah_kopi" id="jumlah_kopi" value="<?php echo $row['jumlah_kopi']; ?>" oninput="calculateTotal()" required>

            <label for="cemilan">Cemilan:</label>
            <select name="cemilan" id="cemilan" onchange="calculateTotal()" required>
                <option value="Pisang Nugget" data-price="15000" <?php echo ($row['cemilan'] == 'Pisang Nugget') ? 'selected' : ''; ?>>Pisang nugget - Rp 15,000</option>
                <option value="Roti Panggang" data-price="10000" <?php echo ($row['cemilan'] == 'Roti Panggang') ? 'selected' : ''; ?>>Roti panggang - Rp 10,000</option>
                <option value="Belgia Liege Waffle" data-price="20000" <?php echo ($row['cemilan'] == 'Belgia Liege Waffle') ? 'selected' : ''; ?>>Belgia Liege Waffle - Rp 20,000</option>
            </select>

            <label for="jumlah_cemilan">Jumlah Cemilan:</label>
            <input type="number" name="jumlah_cemilan" id="jumlah_cemilan" value="<?php echo $row['jumlah_cemilan']; ?>" oninput="calculateTotal()" required>

            <!-- Total Harga -->
            <div class="total-price">
                Total Harga: Rp <span id="totalPrice"><?php echo number_format($row['total_harga'], 0, ',', '.'); ?></span>
            </div>

            <button type="submit">Perbarui Pesanan</button>
        </form>
    </div>

    <script>
        function calculateTotal() {
            // Ambil nilai harga dari opsi yang dipilih
            const kopiPrice = parseFloat(document.querySelector('#kopi option:checked').dataset.price);
            const cemilanPrice = parseFloat(document.querySelector('#cemilan option:checked').dataset.price);
            const jumlahKopi = parseInt(document.getElementById('jumlah_kopi').value);
            const jumlahCemilan = parseInt(document.getElementById('jumlah_cemilan').value);

            // Hitung total harga
            const totalKopi = kopiPrice * jumlahKopi;
            const totalCemilan = cemilanPrice * jumlahCemilan;
            const totalPrice = totalKopi + totalCemilan;

            // Update total harga di halaman
            document.getElementById('totalPrice').textContent = totalPrice.toLocaleString('id-ID');
        }
    </script>
</body>
</html>
