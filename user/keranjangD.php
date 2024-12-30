<?php
session_start();

// Fungsi untuk menghapus item dari keranjang
if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    unset($_SESSION['cart'][$remove_id]);
    $_SESSION['cart'] = array_values($_SESSION['cart']);  // Reindex array setelah item dihapus
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h3 {
            color: #343a40;
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fafafa;
            margin-bottom: 10px;
            transition: transform 0.3s ease;
        }

        .cart-item:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .cart-item img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }

        .cart-item .item-details {
            flex-grow: 1;
            margin-left: 15px;
        }

        .cart-item .item-details p {
            margin: 0;
        }

        .remove-btn {
            background-color: transparent;
            border: none;
            color: #dc3545;
            font-size: 1.5rem;
            cursor: pointer;
            transition: color 0.3s;
        }

        .remove-btn:hover {
            color: #a71d2a;
        }

        .btn-custom {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            text-align: center;
            font-size: 16px;
            width: 100%;
            margin-top: 20px;
            transition: background-color 0.3s;
        }

        .btn-custom:hover {
            background-color: #218838;
        }

        .total-price {
            font-size: 1.25rem;
            font-weight: bold;
            margin-top: 20px;
        }

        .empty-cart {
            color: #6c757d;
            text-align: center;
            font-size: 1.2rem;
            margin-top: 50px;
        }
    </style>
</head>
<body>

<div class="container my-5">
    <h3>Keranjang Anda</h3>

    <?php
    if (empty($_SESSION['cart'])) {
        echo "<p class='empty-cart'>Keranjang Anda kosong.</p>";
    } else {
        echo "<ul class='list-unstyled'>";
        foreach ($_SESSION['cart'] as $index => $item) {
            echo "<li class='cart-item'>";
            echo "<div class='item-details'>";
            echo "<img src='../admin/images/" . $item['image'] . "' alt='" . $item['name'] . "'>";
            echo "<p><strong>" . $item['name'] . "</strong></p>";
            echo "<p>IDR " . number_format($item['price'], 0, ',', '.') . "</p>";
            echo "</div>";
            echo "<button class='remove-btn' onclick='removeItem($index)'>
                    <i class='bi bi-trash'></i>
                </button>";
            echo "</li>";
        }
        echo "</ul>";
    }
    ?>

    <div class="total-price">
        Total: IDR 
        <?php
        $total = 0;
        if (!empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
                $total += $item['price'];
            }
        }
        echo number_format($total, 0, ',', '.');
        ?>
    </div>

    <a href="dinein.php" class="btn btn-outline-secondary btn-custom">Kembali ke Home</a>
    <a href="meja.php" class="btn btn-outline-secondary btn-custom">Pilih Meja</a>
</div>

<script>
    function removeItem(index) {
        if (confirm('Apakah Anda yakin ingin menghapus item ini dari keranjang?')) {
            window.location.href = 'keranjangD.php?remove=' + index;
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
