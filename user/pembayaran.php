<?php
session_start();
include '../admin/koneksi.php';  // Pastikan koneksi ke database sudah benar

$success_message = "";
$error_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $meja_id = $_POST['meja_id']; // ID meja yang dipilih
    $metodeBayar = $_POST['pembayaran'];
    $total = $_POST['cart']; // Total yang dihitung sebelumnya
    
    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        $error_message = "Keranjang kosong. Silakan pilih menu terlebih dahulu.";
    } else {
        $cart_items = [];
        foreach ($_SESSION['cart'] as $item) {
            $cart_items[] = [
                'id_menu' => $item['id'],  // ID menu
                'nama' => $item['name'],   // Nama item
                'harga' => $item['price'], // Harga item
                'gambar' => $item['image'] // Gambar item
            ];
        }
        $cart_items_json = json_encode($cart_items); // Mengonversi array menjadi JSON string

        $query_pesanan = "INSERT INTO pesananuser (id_meja, pembayaran, total, cart_items) 
                          VALUES ('$meja_id', '$metodeBayar', '$total', '$cart_items_json')";
        
        if (mysqli_query($koneksi, $query_pesanan)) {
            $success_message = "Pesanan berhasil disimpan!";
            unset($_SESSION['cart']); // Kosongkan keranjang setelah pesanan disimpan
        } else {
            $error_message = "Gagal menyimpan pesanan: " . mysqli_error($koneksi);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Pembayaran Meja</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        .container {
            max-width: 800px;
            margin-top: 50px;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="text-center">Pembayaran Meja</h1>

    <?php if ($success_message): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $success_message; ?>
        </div>
    <?php elseif ($error_message): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error_message; ?>
        </div>
    <?php endif; ?>

    <form action="pembayaran.php" method="POST">
        <div class="mb-3">
            <label for="metodeBayar" class="form-label">Metode Bayar</label>
            <select name="pembayaran" class="form-control mb-2" required>
                <option value="qris">QRis</option>
                <option value="cash">Cash</option>
            </select>

            <label for="cart" class="form-label">Total Pembayaran</label>
            <input type="text" class="form-control" id="cart" name="cart" required value="<?php
                $total = 0;
                if (!empty($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $item) {
                        $total += $item['price'];
                    }
                }
                echo number_format($total, 0, ',', '.');
            ?>" readonly>
        </div>

        <div class="d-flex justify-content-between">
            <a href="meja.php" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Bayar</button>
        </div>
    </form>
</div>
</body>
</html>