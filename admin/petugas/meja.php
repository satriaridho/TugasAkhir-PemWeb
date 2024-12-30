<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard Meja</h1>
</div>
<?php
 if(!empty($_SESSION['USER']['level'] == 'admin')){
?>
<a href="?page=tambah_meja" class="btn btn-success mb-2">Tambah Meja +</a>
<?php
 }
?>
<div class="card">
<div class="card-body">
    <table class="table">
        <tr>
            <td>No Meja</td>
            <td>Status</td>
            <td>Aksi</td>
        </tr>

        <?php
        
            $petugas = $koneksi->prepare("CALL getMeja()");
            $petugas->execute();

            foreach ($petugas->fetchAll() as $no => $data):

        ?>

        <tr>
            <td><?= $data['no_meja'] ?></td>
            <td><?= $data['status'] ?></td>
            <td>
                <a href="?page=edit_meja&id=<?= $data['id'] ?>" class="btn btn-primary">EDIT</a>
                <?php
                  if(!empty($_SESSION['USER']['level'] == 'admin')){
                ?>
                <form action="../kontrol/kontrolMeja.php?aksi=delete" method="post" class="d-inline">
                    <input type="hidden" name="id" value="<?= $data['id'] ?>">
                    <button class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">DELETE</button>
                </form>
                <?php
                  }
                  ?>
            </td>
        </tr>

        <?php
            endforeach
        ?>
    </table>
</div>
</div>