<?php
// Cek jika user memiliki level admin
if (empty($_SESSION['USER']['level'] == "admin")) {
    die("Permission denied 666");
}

// Query untuk mendapatkan data pesanan dan informasi terkait dari tabel menu dan meja
$petugas = $koneksi->prepare("
    SELECT 
        p.id, m.nama AS menu_nama, p.id_meja, me.no_meja, p.pembayaran, p.total
    FROM pesananuser p
    LEFT JOIN menu m ON p.id_menu = m.id
    LEFT JOIN meja me ON p.id_meja = me.id
");
$petugas->execute();

// Ambil semua hasil query
$pesananData = $petugas->fetchAll();
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard Pesanan</h1>
</div>

<div class="card">
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pesanan</th>
                    <th>No Meja</th>
                    <th>Pembayaran</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop melalui data pesanan dan tampilkan di tabel
                foreach ($pesananData as $no => $data):
                ?>
                    <tr>
                        <td><?= $no + 1 ?></td>
                        <td><?= htmlspecialchars($data['menu_nama']) ?></td> <!-- Nama menu -->
                        <td><?= htmlspecialchars($data['no_meja']) ?></td> <!-- Nomor meja -->
                        <td><?= htmlspecialchars($data['pembayaran']) ?></td> <!-- Pembayaran -->
                        <td><?= htmlspecialchars($data['total']) ?></td> <!-- Harga total -->
                        
                    </tr>
                <?php
                endforeach;
                ?>
            </tbody>
        </table>
    </div>
</div>
