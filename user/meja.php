<?php
session_start();
include '../admin/koneksi.php';

// Proses pemilihan meja
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['meja_id'])) {
    // Menyimpan ID meja yang dipilih ke session
    $_SESSION['selected_table'] = $_POST['meja_id'];

    // Update status meja menjadi 'used' di database
    $meja_id = $_POST['meja_id'];
    $update_query = "UPDATE meja SET status = 'used' WHERE id = '$meja_id'";

    if ($koneksi->query($update_query) === TRUE) {
        // Meja berhasil dipilih
        header("Location: dinein.php"); // Redirect ke dinein.php
        exit();
    } else {
        echo "Error: " . $koneksi->error;
    }
}

$sql = "SELECT * FROM meja";
$result = $koneksi->query($sql);

$koneksi->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Meja</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        main {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin: 50px auto;
            max-width: 900px;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .meja {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 200px;
            background-color: #3498db;
            color: white;
            font-size: 24px;
            border-radius: 10px;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            position: relative;
        }

        .meja:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .meja.selected {
            background-color: #2ecc71;
            box-shadow: 0 4px 15px rgba(0, 128, 0, 0.2);
        }

        .status {
            position: absolute;
            bottom: 10px;
            font-size: 14px;
            background-color: rgba(0, 0, 0, 0.6);
            padding: 5px;
            border-radius: 5px;
        }

        h1 {
            text-align: center;
        }

        .meja.disabled {
            cursor: not-allowed;
            opacity: 0.5;
        }
    </style>
</head>
<body>

<h1>Silahkan Pilih Meja yang Ready</h1>

<!-- Tombol Kembali -->
<a style="text-decoration: none; color: white;" href="dinein.php">
    <button class="btn btn-success" style="margin-left: 26%; width: 50%; margin-bottom: 10px;">Kembali</button>
</a>

<!-- Tombol Bayar -->
<a style="text-decoration: none; color: white;" href="#" onclick="submitTableSelection()">
    <button class="btn btn-primary" style="margin-left: 26%; width: 50%;">Bayar</button>
</a>

<main id="meja-container">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $status = $row["status"];
            $statusClass = '';
            $onclick = ''; // Secara default tidak ada aksi klik

            if ($status == 'cleaning' || $status == 'used') {
                $statusClass = 'disabled';
            } else {
                $onclick = 'onclick="selectTable(this)"';
            }

            echo '<div class="meja ' . $statusClass . '" data-id="' . $row["id"] . '" data-status="' . $status . '" ' . $onclick . '>
                    ' . $row["no_meja"] . '
                    <div class="status">' . $status . '</div>
                  </div>';
        }
    } else {
        echo "Tidak ada data meja.";
    }
    ?>
</main>

<script>
    let selectedTable = null;  // Untuk melacak meja yang dipilih

    function selectTable(element) {
        // Jika meja ini sedang dalam status disabled (misalnya sedang dibersihkan atau digunakan), maka tidak bisa dipilih
        if (element.classList.contains('disabled')) {
            return;
        }

        if (selectedTable) {
            selectedTable.classList.remove('selected');  // Menghapus kelas "selected" dari meja sebelumnya
            const previousStatusElement = selectedTable.querySelector('.status');
            previousStatusElement.innerHTML = 'Ready';  // Mengatur ulang status meja sebelumnya menjadi "Ready"
            selectedTable.classList.remove('disabled'); // Mengaktifkan kembali meja sebelumnya untuk bisa dipilih lagi
        }

        // Pilih meja yang baru
        element.classList.add('selected');  // Menambahkan kelas "selected" untuk meja yang baru
        const statusElement = element.querySelector('.status');
        statusElement.innerHTML = 'Used';  // Mengubah status meja menjadi "Used"

        // Update meja yang sedang dipilih
        selectedTable = element;

        // Menonaktifkan meja yang sudah dipilih (meja tidak bisa dipilih lagi setelah statusnya "Used")
        setTimeout(() => {
            element.classList.add('disabled');  // Meja yang sudah dipilih tidak bisa dipilih lagi
        }, 1000);  // Beri jeda 1 detik sebelum meja dinonaktifkan
    }

    // Fungsi untuk mengirimkan data meja yang dipilih saat tombol "Bayar" diklik
    function submitTableSelection() {
        if (!selectedTable) {
            alert('Silakan pilih meja terlebih dahulu!');
            return;
        }

        const mejaId = selectedTable.getAttribute('data-id');
        
        // Kirim ID meja ke server untuk disimpan di session dan database
        fetch('meja.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `meja_id=${mejaId}`
        })
        .then(response => response.text())
        .then(data => {
            console.log(data);  // Tampilkan respon dari server
            // Redirect ke halaman pembayaran setelah data terkirim
            window.location.href = 'pembayaran.php';
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
</script>

</body>
</html>
