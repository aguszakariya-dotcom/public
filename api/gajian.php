<?php
require_once 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Lakukan kueri untuk mengambil data dari database berdasarkan ID
    $query = "SELECT * FROM gajian WHERE id = $id";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        die("Error: " . mysqli_error($koneksi));
    }

    $data = mysqli_fetch_assoc($result);

    // Mengembalikan data dalam format JSON
    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    // Jika tidak ada parameter ID, kembalikan semua data
    $query = "SELECT * FROM gajian";
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
}
// if ($_SERVER['REQUEST_METHOD'] === 'GET') {
//     // Ambil total berdasarkan nama dan tanggal hari ini
//     $selectedNama = $_GET['nama'];
//     $today = date('d-M-Y');
//     $queryTotal = mysqli_query($koneksi, "SELECT SUM(total) as total FROM gajian WHERE nama = '$selectedNama' AND date = '$today'");
//     $result = mysqli_fetch_assoc($queryTotal);
//     echo json_encode(['total' => $result['total']]);
// }