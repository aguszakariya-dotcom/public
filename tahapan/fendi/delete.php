<?php
session_start();
include 'koneksi.php';

// Memeriksa apakah parameter id telah diterima
if (isset($_GET['id'])) {
    // Mengambil ID yang dikirim melalui parameter GET
    $id = $_GET['id'];

    // Mendapatkan informasi data yang akan dihapus
    $getDataQuery = "SELECT * FROM cicilan WHERE ID = '$id'";
    $getDataResult = mysqli_query($koneksi, $getDataQuery);
    $data = mysqli_fetch_assoc($getDataResult);

    // Jika data ditemukan
    if ($data) {
        // Tampilkan pesan konfirmasi penghapusan menggunakan SweetAlert2
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Anda yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Tidak',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika konfirmasi di-approve, hapus data
                    deleteData('$id');
                } else {
                    // Jika konfirmasi dibatalkan, kembali ke halaman utama
                    window.location.href = 'index.php';
                }
            });

            function deleteData(id) {
                // Kirim request AJAX ke delete_process.php untuk menghapus data
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'delete.php?id=' + id, true);
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        // Jika penghapusan berhasil, tampilkan pesan sukses
                        Swal.fire({
                            title: 'Sukses',
                            text: 'Data berhasil dihapus',
                            icon: 'success',
                        }).then(() => {
                            // Kembali ke halaman utama
                            window.location.href = 'index.php';
                        });
                    } else {
                        // Jika terjadi kesalahan, tampilkan pesan error
                        Swal.fire({
                            title: 'Error',
                            text: 'Terjadi kesalahan saat menghapus data',
                            icon: 'error',
                        }).then(() => {
                            // Kembali ke halaman utama
                            window.location.href = 'index.php';
                        });
                    }
                };
                xhr.send();
            }
        </script>
        ";
    } else {
        // Jika data tidak ditemukan, kembali ke halaman utama
        header("Location: index.php");
        exit;
    }
} else {
    // Jika parameter id tidak diterima, kembali ke halaman utama
    header("Location: index.php");
    exit;
}
?>
