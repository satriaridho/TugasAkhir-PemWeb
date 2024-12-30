<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Menu</h1>
</div>

<?php
$id = $_GET['id'];
$kelas = $koneksi->prepare("CALL getMenuId(:id)");
$kelas->bindParam(':id', $id);
$kelas->execute();

$data = $kelas->fetch();
?>

<div class="card">
    <div class="card-body">
        <form action="../kontrol/kontrolMenu.php?aksi=edit" method="post" enctype="multipart/form-data">
            <table class="table">
                <tr>
                    <td>
                        <input type="file" name="gambar" class="form-control mb-2" placeholder="Masukan Gambar (Wajib .png)">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="nama" class="form-control mb-2" placeholder="Masukan Nama Menu" value="<?= htmlspecialchars($data['nama']) ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <select name="kategori" class="form-control mb-2">
                            <option <?= $data['kategori'] == "Makanan" ? "selected" : ""; ?> value="Makanan">Makanan</option>
                            <option <?= $data['kategori'] == "Minuman" ? "selected" : ""; ?> value="Minuman">Minuman</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="harga" class="form-control mb-2" placeholder="Masukan Harga" value="<?= htmlspecialchars($data['harga']) ?>">
                    </td>
                </tr>
            </table>
            <input type="hidden" name="id" value="<?= htmlspecialchars($data['id']) ?>">
            <button class="btn btn-primary w-100">Simpan</button>
        </form>
    </div>
</div>