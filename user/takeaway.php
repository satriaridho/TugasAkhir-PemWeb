<?php
session_start();
include "../admin/koneksi.php";

// Query untuk mengambil semua menu dari database
$query = "SELECT * FROM menu";
$result = mysqli_query($koneksi, $query);

// Periksa apakah ada hasil
$menus = []; // Inisialisasi array kosong
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $menus[] = $row; // Menambahkan setiap row ke dalam array $menus
    }
} else {
    $menus = []; // Jika tidak ada data, set $menus ke array kosong
}

// Menambahkan item ke keranjang (melalui POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
    $item_id = $_POST['item_id'];
    $item_name = $_POST['item_name'];
    $item_price = $_POST['item_price'];
    $item_image = $_POST['item_image'];
    
    // Menyimpan item ke dalam session keranjang
    $_SESSION['cart'][] = [
        'id' => $item_id,
        'name' => $item_name,
        'price' => $item_price,
        'image' => $item_image,
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Makan di Tempat </title>
    <link rel="stylesheet" href="../style/dinein.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1> Bawa Pulang</h1>
        <a class="bi bi-arrow-left" href="index.html" style="text-decoration: none; color: black;"></a>
        <a class="arrow" href="index.php" style="text-decoration: none; color: black; display: inline-block;transition: 0.5s; font-family: cursive;">Kembali ke Home</a>
        <div class="container text-center">
            
            <button class=" btn1 btn2 custom-button " id="button2" style="background-color:rgb(155, 155, 155); color: white; transition: 0.7s; padding: 1px 20px; box-shadow: -5px 15px 10px rgba(0, 0, 0, 0.2);" onclick="showCategory('makanan')">
                <h1>Makanan</h1>
            </button>
            <button class=" btn1 btn2 custom-button" id="button2" style="background-color:rgb(155, 155, 155); color: white; transition: 1s; padding: 1px 20px; box-shadow: -5px 15px 10px rgba(0, 0, 0, 0.2);" onclick="showCategory('minuman')">
                <h1>Minuman</h1>
            </button>
            <div class="grid" data-aos="fade-up"
            data-aos-anchor-placement="bottom-bottom" data-aos-delay="200" style="transition: 0.7s;">
            <?php
            if (!empty($menus)) {
                foreach ($menus as $menu) {
                    echo '<div class="grid-item clickable item' . $menu['kategori'] . '" data-harga="' . $menu['harga'] . '" data-name="' . $menu['nama'] . '" id="viewVariant pict" data-aos="fade-up" style="width:100%;">';
                    echo '<img src="../admin/images/' . $menu['gambar'] . '" alt="' . $menu['nama'] . '" style="width:65%;">';
                    echo '<p>' . $menu['nama'] . '</p>';
                    echo '<form method="POST" action="">
                            <input type="hidden" name="item_id" value="' . $menu['id'] . '">
                            <input type="hidden" name="item_name" value="' . $menu['nama'] . '">
                            <input type="hidden" name="item_price" value="' . $menu['harga'] . '">
                            <input type="hidden" name="item_image" value="' . $menu['gambar'] . '">
                            <button type="submit" name="add_to_cart" class="btn btn-secondary">Add to Cart</button>
                        </form>';
                    echo '</div>';
                }
            } else {
                echo '<p>Menu tidak ditemukan</p>';
            }
            ?>
            </div>
        </div>

        <div class="container1 sticky-bottom" style="transition: 0.8s;" data-aos="zoom-in-up" style="transition: 1.1s;">
            <div class="line" style="box-shadow: -2px 10px 5px rgba(0, 0, 0, 0.2);">
                <h1>Pesanan Saya - Bawa Pulang</h1>
            </div>
            <div class="content">
            <p>Total IDR : <span id="total"><?php echo number_format(calculateTotal(), 0, ',', '.'); ?></span> | Item : <span id="item-count"><?php echo count($_SESSION['cart'] ?? []); ?></span></p>
            <div class="container2">
                <a href="keranjangD.php" class="float-end icon-taper" style="text-decoration: none; color: black; margin-top: -35px; transition: 0.5s; font-family: cursive; cursor: pointer;">lihat pesanan saya </a>
                <a class="a1 float-end" style="cursor: pointer; transition: 0.5s; text-decoration: none; color: black;"> >>>> </a>
            </div>
            <button class="btn1" style="box-shadow: -2px 10px 5px rgba(0, 0, 0, 0.2); font-family: cursive;">
                <a href="bayar.php" style="text-decoration: none; color: white;">Pilih Meja</a>
            </button>
        </div>
        </div>
    </div>

    <script src="../style/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>

<?php
// Fungsi untuk menghitung total harga
function calculateTotal() {
    $total = 0;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['price'];
        }
    }
    return $total;
}
?>
