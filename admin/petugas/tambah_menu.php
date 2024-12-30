<?php

include "../koneksi.php";

if (isset($_POST['submit'])) {
    $gambar = $_FILES['gambar']['name'];
    $lokasi = $_FILES['gambar']['tmp_name'];
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];

    move_uploaded_file(from: $lokasi, to: "../images/". $gambar);
    $query = mysqli_query(mysql: $koneksi, query: "INSERT INTO menu(nama, kategori, harga, gambar) VALUES ('$nama','$kategori','$harga','$gambar')") or die (mysqli_error($koneksi));
    if ($query) {
        echo "<script>alert('Data Berhasil Disimpan')</script>";
        echo "<script>location.href='?page=menu'</script>";
    } else
        echo "<script>alert('Data Gagal Disimpan')</script>";
        echo "<script>location.href='?page=menu'</script>";  
    {
    }}

?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard Menu</h1>
</div>

<div class="card">
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <table class="table">
                <input required type="file" name="gambar" class="form-control mb-2" placeholder="Masukan Gambar (Wajib .png)">
                <input required type="text" name="nama" class="form-control mb-2" placeholder="Masukan Nama Menu">
                
                <select required name="kategori" class="form-control mb-2">
                    <?php
                        $kel = mysqli_query($koneksi, "SELECT DISTINCT kategori FROM menu");
                        while ($data = mysqli_fetch_array($kel)) {
                    ?>
                    <option><?= $data['kategori'] ?></option>
                    <?php
                        }
                    ?>
                </select>

                <input required type="text" name="harga" class="form-control mb-2" placeholder="Masukan Harga">
            </table>
            <button name="submit" type="submit" class="btn btn-primary w-100">Tambah</button>
        </form>
    </div>
</div>
