<?php

include "../koneksi.php";

?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard Menu</h1>
</div>

<a href="?page=tambah_menu" class="btn btn-success mb-2">Tambah Menu +</a>

<div class="card">
<div class="card-body">
    <table class="table">
        <tr>
            <td>No</td>
            <td>Gambar</td>
            <td>Nama</td>
            <td>Kategori</td>
            <td>Harga</td>
            <td>Aksi</td>
        </tr>

        <?php
            
            $i = 1;
            $sis = mysqli_query($koneksi, "SELECT*FROM menu");
            while ($data = mysqli_fetch_array($sis)) {

        ?>

        <tr>
            <td><?= $i++ ?></td>
            <td class="img-fluid img-thumbnail" ><img style="width: 70px; height:auto;" src="../images/<?php echo $data['gambar'] ?>"></td>
            <td><?= $data['nama'] ?></td>
            <td><?= $data['kategori'] ?></td>
            <td><?= number_format($data['harga'], 0, ',', '.') ?></td>
            <td>
                <a href="?page=edit_menu&id=<?= $data['id'] ?>" class="btn btn-primary">EDIT</a>
                <form action="../kontrol/kontrolMenu.php?aksi=delete" method="post" class="d-inline">
                    <input type="hidden" name="id" value="<?= $data['id'] ?>">
                    <button class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">DELETE</button>
                </form>
            </td>
        </tr>

        <?php
        }
        ?>
    </table>
</div>
</div>