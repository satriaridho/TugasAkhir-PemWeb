<?php

require '../request.php';

if($_GET['aksi'] == "tambah"){
    $no_meja = $_POST['no_meja'];
    $status = $_POST['status'];

    $tambah = $koneksi->prepare("CALL tambahMeja('$no_meja', '$status')");
    $tambah->execute();

    header("location:../petugas?page=meja");

}

if($_GET['aksi'] == "edit"){
    $id_petugas = $_POST['id'];
    $no_meja = $_POST['no_meja'];
    $status = $_POST['status'];

    $edit = $koneksi->prepare("CALL editMeja('$id_petugas', '$no_meja', '$status')");
    $edit->execute();

    header("location:../petugas?page=meja");

}

if($_GET['aksi'] == "delete"){
    $id_petugas = $_POST['id'];

    $hapus = $koneksi->prepare("CALL hapusMeja('$id_petugas')");
    $hapus->execute();

    header("location:../petugas?page=meja");

}



?>