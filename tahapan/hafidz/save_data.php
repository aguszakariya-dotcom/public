<?php
// save_data.php

include_once 'koneksi.php';

$tanggal = $_POST['tanggal'];
$tarik = $_POST['tarik'];
$setor = $_POST['setor'];
$saldo = $_POST['saldo'];
$keterangan = ucwords($_POST['keterangan']);

// Perform necessary database operations, e.g., insert the data into the table
$sql = "INSERT INTO hfd (tanggal, tarik, setor, saldo ,keterangan) VALUES (
    '$tanggal', '$tarik', '$setor', '$saldo', '$keterangan')";

if (mysqli_query($koneksi, $sql)) {
    echo "Success! Data berhasil diinput";
} else {
    echo "Error: " . mysqli_error($koneksi);
}

mysqli_close($koneksi);
?>
