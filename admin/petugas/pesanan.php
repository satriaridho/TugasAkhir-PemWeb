<?php
if (empty($_SESSION['USER']['level'] == "admin")) {
    die("Permission denied 666");
}
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard Pesanan</h1>
</div>

<div class="card">
    <div class="card-body">
        <table class="table">
            <tr>
                <td>No</td>
                <td>Pesanan</td>
                <td>Total</td>
                <td>Tanggal Pesan</td>
                <td>Uang Bayar</td>
                <td>Kembalian</td>
                <td>Metode Bayar</td>
                <td>Status Bayar</td>
                <td>No Meja</td>
                <td>Aksi</td>
            </tr>

            <?php
            $petugas = $koneksi->prepare("
            SELECT p.*, pu.id_menu, m.nama, pu.total, p.noMeja, me.no_meja
            FROM pesanan p
            JOIN pesananuser pu ON p.id_pesanUser = pu.id
            JOIN menu m ON pu.id_menu = m.id
            LEFT JOIN meja me ON p.noMeja = me.id
            ");
            $petugas->execute();

            foreach ($petugas->fetchAll() as $no => $data):
            ?>

            <tr>
                <td><?= $no + 1 ?></td>
                <td><?= $data['nama'] ?></td>
                <td><?= $data['total'] ?></td>
                <td><?= $data['tgl_pesan'] ?></td>
                <td><?= $data['uangBayar'] ?></td>
                <td><?= $data['kembalian'] ?></td>
                <td><?= $data['metodeBayar'] ?></td>
                <td><?= $data['status_bayar'] ?></td>
                <td><?= $data['no_meja'] ?></td>
                <td>
                    <a href="?page=edit_pesanan&id=<?= $data['id'] ?>" class="btn btn-primary">EDIT</a>
                </td>
            </tr>

            <?php
            endforeach
            ?>
        </table>
    </div>
</div>
