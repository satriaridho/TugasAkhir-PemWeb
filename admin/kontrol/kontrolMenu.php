<?php

require '../koneksi.php';

if ($_GET['aksi'] == "edit") {
  $id = $_POST['id'];
  $gambar = $_FILES['gambar']['name'];
  $lokasi = $_FILES['gambar']['tmp_name'];
  $nama = $_POST['nama'];
  $kategori = $_POST['kategori'];
  $harga = $_POST['harga'];

  if ($gambar != '') {
      move_uploaded_file($lokasi, "../images/" . $gambar);
  } else {
      $result = $koneksi->query("SELECT gambar FROM menu WHERE id = $id");
      $row = $result->fetch_assoc();
      $gambar = $row['gambar']; // Menetapkan gambar lama
  }

  $query = "UPDATE menu SET gambar = '$gambar', nama = '$nama', kategori = '$kategori', harga = '$harga' WHERE id = $id";

  if ($koneksi->query($query)) {
      header("Location: ../petugas?page=menu");
      exit;
  } else {
      echo "Error executing query: " . $koneksi->error;
  }
}



if($_GET['aksi'] == "delete"){
  $id = $_POST['id'];

  $hapus = $koneksi->prepare("CALL hapusMenu('$id')");
  $hapus->execute();

  header("location:../petugas?page=menu");

}



?>