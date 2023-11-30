<?php
require_once 'koneksi.php';

// Lakukan kueri untuk mengambil data dari database
$query = "SELECT * FROM pola_transaksi";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Error: " . mysqli_error($koneksi));
}

$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Mengembalikan data dalam format JSON
header('Content-Type: application/json');
echo json_encode($data);