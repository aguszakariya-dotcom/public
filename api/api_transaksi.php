<?php
require_once 'koneksi.php';
// require_once 'core/Database.php'; 

$db = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['rincian'])) {
        $selectedRincian = $_GET['rincian'];

        $query = "SELECT * FROM rincianTransaksi WHERE rincian = :rincian";
        $db->query($query);
        $db->bind('rincian', $selectedRincian);

        $result = $db->single();

        if ($result) {
            $response = [
                'success' => true,
                'data' => [
                    'namaAkun' => $result['namaAkun'],
                    'noAkun' => $result['noAkun']
                ]
            ];
        } else {
            $response = [
                'success' => false
            ];
        }
    } else {
        $response = [
            'success' => false
        ];
    }
} else {
    $response = [
        'success' => false
    ];
}

header('Content-Type: application/json');
echo json_encode($response);
?>
