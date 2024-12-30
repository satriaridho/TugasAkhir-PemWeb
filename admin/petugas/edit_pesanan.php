<?php
$isUpdate = isset($_GET['id']);
$id_pesanan = $_GET['id']; 

if ($isUpdate) {

    try {
        $query = "
            SELECT p.*, pu.id_menu, m.nama, pu.total
            FROM pesanan p
            JOIN pesananuser pu ON p.id_pesanUser = pu.id
            JOIN menu m ON pu.id_menu = m.id
            WHERE p.id = $id_pesanan
        ";
        $stmt = $koneksi->query($query);
        $pesanan = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Error fetching pesanan: " . $e->getMessage());
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uangBayar = $_POST['uangBayar'];
    $kembalian = $_POST['kembalian'];
    $metodeBayar = $_POST['metodeBayar'];
    $status_bayar = $_POST['status_bayar'];

    try {
        if ($isUpdate) {
            $updateQuery = "
                UPDATE pesanan 
                SET uangBayar = :uangBayar, kembalian = :kembalian, 
                    metodeBayar = :metodeBayar, status_bayar = :status_bayar
                WHERE id = :id_pesanan
            ";
            
            $stmt = $koneksi->prepare($updateQuery);
            $stmt->execute([
                ':uangBayar' => $uangBayar,
                ':kembalian' => $kembalian,
                ':metodeBayar' => $metodeBayar,
                ':status_bayar' => $status_bayar,
                ':id_pesanan' => $id_pesanan,
            ]);
        }

        header("Location: ?page=pesanan");
        exit; 
    } catch (PDOException $e) {
      die("Location:?page=pesanan" );
    }
}

?>

<div class="card">
    <div class="card-body">
        <h3><?= $isUpdate ? 'Edit Pesanan' : 'Tambah Pesanan' ?></h3>
        <form method="post">
            <div class="form-group">
                <label for="uangBayar">Uang Bayar</label>
                <input type="number" class="form-control" id="uangBayar" name="uangBayar" value="<?= $pesanan['uangBayar'] ?? '' ?>" required>
            </div>
            <div class="form-group">
                <label for="kembalian">Kembalian</label>
                <input type="number" class="form-control" id="kembalian" name="kembalian" value="<?= $pesanan['kembalian'] ?? '' ?>" required>
            </div>
            <div class="form-group">
                <label for="metodeBayar">Metode Bayar</label>
                <select name="metodeBayar" class="form-control mb-2">
                    <option <?= isset($pesanan['metodeBayar']) && $pesanan['metodeBayar'] == "qris" ? "selected" : "" ; ?> value="qris">QRIS</option>
                    <option <?= isset($pesanan['metodeBayar']) && $pesanan['metodeBayar'] == "cash" ? "selected" : "" ; ?> value="cash">Cash</option>
                </select>
            </div>
            <div class="form-group">
                <label for="status_bayar">Status Bayar</label>
                <select name="status_bayar" class="form-control mb-2">
                    <option <?= isset($pesanan['status_bayar']) && $pesanan['status_bayar'] == "Paid" ? "selected" : "" ; ?> value="Paid">Paid</option>
                    <option <?= isset($pesanan['status_bayar']) && $pesanan['status_bayar'] == "Unpaid" ? "selected" : "" ; ?> value="Unpaid">Unpaid</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary"><?= $isUpdate ? 'Update Pesanan' : 'Tambah Pesanan' ?></button>
            <button class="btn btn-success"><a href="?page=pesanan" style="color: white; text-decoration: none;">Kembali</a></button>

            <div class="invisible">
            <div class="form-group">
                <label for="id_pesanUser">ID Pesan User</label>
                <input type="number" class="form-control" id="id_pesanUser" name="id_pesanUser" value="<?= $pesanan['id_pesanUser'] ?? '' ?>"  >
            </div>
            <div class="form-group">
                <label for="tgl_pesan">Tanggal Pesan</label>
                <input type="date" class="form-control" id="tgl_pesan" name="tgl_pesan" value="<?= $pesanan['tgl_pesan'] ?? '' ?>"  >
            </div>
            <div class="form-group">
                <label for="total">Total</label>
                <input type="number" class="form-control" id="total" name="total" value="<?= $pesanan['total'] ?? '' ?>"  >
            </div>
            <div class="form-group">
                <label for="noMeja">No Meja</label>
                <input type="number" class="form-control" id="noMeja" name="noMeja" value="<?= $pesanan['noMeja'] ?? '' ?>"  >
            </div>
            </div>

           
        </form>
    </div>
</div>

<?php
ob_end_flush();
