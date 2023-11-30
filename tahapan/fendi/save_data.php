<?php

include_once 'koneksi.php';

$tanggal = $_POST['tanggal'];
$info = ucwords($_POST['info']);
$tarik = $_POST['tarik'];
$setor = $_POST['setor'];
$saldo = $_POST['saldo'];

// Perform necessary database operations, e.g., insert the data into the table
$sql = "INSERT INTO cicilan (tanggal, info, tarik, setor, saldo) VALUES (
    '$tanggal', '$info', '$tarik', '$setor', '$saldo')";

if (mysqli_query($koneksi, $sql)) {
    echo "Success! Data berhasil diinput";
} else {
    echo "Error: " . mysqli_error($koneksi);
}

mysqli_close($koneksi);
