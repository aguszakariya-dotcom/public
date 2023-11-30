<?php
session_start();
include_once 'koneksi.php';



// Ambil saldo terakhir dari tabel
$querySaldoTerakhir = mysqli_query($koneksi, 'SELECT saldo FROM cicilan ORDER BY id DESC LIMIT 1');
$saldoTerakhir = mysqli_fetch_assoc($querySaldoTerakhir)['saldo'];

$saldo = mysqli_query($koneksi, "SELECT SUM(jumlah_setor) AS saldo FROM tahapan");
$saldoAkhirTahapan = mysqli_fetch_array($saldo);

// menghitung total Income
$queryTotalSetor = mysqli_query($koneksi, 'SELECT SUM(setor) AS totalSetor FROM cicilan');
$totalSetor = mysqli_fetch_assoc($queryTotalSetor)['totalSetor'];

?>
<?php
if (isset($_GET['p']) && $_GET['p'] == "hapus" && isset($_GET['id'])) {
    $hapus = mysqli_query($koneksi, "DELETE FROM cicilan WHERE id = '" . $_GET['id'] . "'");
    if ($hapus) {
        $_SESSION['sukses'] = "Data berhasil dihapus";
        echo '<script>window.location.href="index.php";</script>';
        exit;
    } else {
        $_SESSION['gagal'] = "Data gagal dihapus";
        echo '<script>window.location.href="index.php";</script>';
        exit;
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tahapan | fendi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/swal.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;500&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/swal.js"></script>
    <style>
        body {
            font-family: 'Quicksand', sans-serif;
            font-size: small;
        }

        .lingkaran {
            align-content: center;
            height: 50px;
            width: 50px;
            background-color: #febcd5;
            border-radius: 100%;
        }

        .lingkaran2 {
            align-content: center;
            height: 50px;
            width: 50px;
            background-color: #bbc1ff;
            border-radius: 100%;
        }

        .lingkaran3 {
            align-content: center;
            height: 50px;
            width: 50px;
            background-color: #00ffff;
            border-radius: 100%;
        }
    </style>
</head>

<body>
    <div class="mx-auto px-2 mt-5 text-center">
        <h1>Celengan</h1>
        <div class="row justify-content-center">
            <div class="col-md-3 col-sm-11 col-md-8 col-xl-3 mt-3 px-2 mx-3">
                <div class="card shadow">
                    <div class="card-header">Input Data</div>
                    <div class="card-body ">
                        <form action="" class="form-input text-sm text-start pr-2" method="post" enctype="multipart/form-data" id="inForm">
                            <div class="mb-2 row">
                                <label class="col-sm-5 col-form-label">Saldo Sebelumnya</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control " name="sebelumnya" id="sebelumnya" value="<?= $saldoTerakhir ?>" hidden="true">
                                    <input type="text" class="form-control fw-bold" value="Rp. <?= number_format($saldoTerakhir, 0, ',', '.'); ?>">
                                </div>
                            </div>
                            <hr>
                            <div class="mb-2 row">
                                <label class="col-sm-5 col-form-label" for="tanggal">Tanggal</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="tanggal" id="tanggal" value="<?= date('d-M-Y'); ?>">
                                </div>
                            </div>
                            <hr>
                            <div class="mb-2 row">
                                <label class="col-sm-5 col-form-label" for="info" id="info">Deskripsi</label>
                                <div class="col-sm-7">
                                    <textarea class="form-control text-capitalize" placeholder="Leave a comment here" name="info" id="info"></textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="mb-2 row">
                                <label class="col-sm-5 col-form-label" for="keluar">Penarikan</label>
                                <div class="col-sm-7">
                                    <input type="number" class="form-control" name="tarik" id="tarik">
                                </div>
                            </div>
                            <hr>
                            <div class="mb-2 row ">
                                <label class="col-sm-5 col-form-label" for="masuk">Setoran</label>
                                <div class="col-sm-7">
                                    <input type="number" class="form-control" name="setor" id="setor">
                                </div>
                            </div>
                            <hr>
                            <div class="mb-2 row">
                                <label class="col-sm-5 col-form-label" for="saldo">Saldo Akhir</label>
                                <div class="col-sm-7">
                                    <input type="number" class="form-control" name="saldo" id="saldo" readonly>
                                </div>
                            </div>
                            <hr>
                            <div class="text-center" id="tombol">
                                <button type="submit" class="btn btn-sm btn-info float-start" id="save" name="save">Save</button>
                                &nbsp;
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    var sebelumnya = document.getElementById('sebelumnya');
                    if (sebelumnya.value === '') {
                        sebelumnya.value = 0;
                    }

                    // Mengganti nilai kosong dengan 0 pada input dengan id 'saldo'
                    var saldo = document.getElementById('saldo');
                    if (saldo.value === '') {
                        saldo.value = 0;
                    }

                    function calculateSaldo() {
                        var keluar = parseFloat(document.getElementById("tarik").value);
                        var masuk = parseFloat(document.getElementById("setor").value);
                        var sebelumnyaValue = parseFloat(document.getElementById("sebelumnya").value);
                        var saldoValue = 0;

                        if (isNaN(sebelumnyaValue)) {
                            if (!isNaN(keluar)) {
                                saldoValue = -keluar;
                            } else if (!isNaN(masuk)) {
                                saldoValue = masuk;
                            }
                        } else {
                            if (!isNaN(keluar)) {
                                saldoValue = sebelumnyaValue - keluar;
                            } else if (!isNaN(masuk)) {
                                saldoValue = sebelumnyaValue + masuk;
                            } else {
                                saldoValue = sebelumnyaValue;
                            }
                        }

                        saldo.value = saldoValue;
                    }

                    // Event listener for input changes
                    document.getElementById("tarik").addEventListener("input", calculateSaldo);
                    document.getElementById("setor").addEventListener("input", calculateSaldo);

                    // Event listener saat form di-submit
                    document.querySelector("form").addEventListener("submit", function(e) {
                        e.preventDefault(); // Mencegah refresh halaman

                        var tanggal = document.getElementById("tanggal").value;

                        if (tanggal === "") {
                            Swal.fire({
                                icon: 'error',
                                title: 'Tanggal belum diisi',
                                text: 'Mohon isi tanggal sebelum menyimpan data!',
                            });
                        } else {
                            // Update saldo
                            calculateSaldo();

                            // Submit form using AJAX
                            $.ajax({
                                url: 'save_data.php',
                                type: 'POST',
                                data: $(this).serialize(),
                                success: function(response) {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        title: 'Data berhasil disimpan',
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then((result) => {
                                        if (result.dismiss === Swal.DismissReason.timer) {
                                            window.location.href = 'index.php';
                                        }
                                    });
                                },
                                error: function(xhr, status, error) {
                                    console.log(xhr.responseText);
                                }
                            });
                        }
                    });
                });
            </script>

            <!-- table -->
            <div class="col-md-10 col-xl-6 col-sm-12 mt-3">
                <div class="card shadow">
                    <div class="card-header fs-6 row  justify-content-center text-center">
                        <?php
                        // // Menghitung total pengeluaran
                        // $queryTotalPengeluaran = mysqli_query($koneksi, 'SELECT SUM(keluar) AS total_pengeluaran FROM dcashflow');
                        // $totalPengeluaran = mysqli_fetch_assoc($queryTotalPengeluaran)['total_pengeluaran'];
                        ?>
                        <?php
                        // menghitung total Income
                        $queryTotalIncome = mysqli_query($koneksi, 'SELECT SUM(tarik) AS total_tarik FROM cicilan');
                        $totalIncome = mysqli_fetch_assoc($queryTotalIncome)['total_tarik'];
                        ?>&nbsp;

                        <table>
                            <tr>
                                <th></th>
                                <th>Pinjaman</th>
                                <th></th>
                                <th>Penarikan</th>
                                <th></th>
                                <th>Saldo</th>
                                <th></th>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="lingkaran shadow fw-bold" style="height: 100px; width: 100px
                            ">0</td>
                                <td></td>
                                <td class="lingkaran2 shadow fw-bold" style="height: 100px; width: 100px
                            "><?= number_format($totalIncome, 0, ',', '.'); ?></td>
                                <td></td>
                                <td class="lingkaran3 shadow fw-bold" style="height: 100px; width: 100px
                            "><?= number_format($saldoTerakhir, 0, ',', '.'); ?></td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-striped" id="cashflowTable">
                            <thead>
                                <tr class="fs-6">
                                    <th scope="col">Tanggal</th>
                                    <th scope="col-2">Keterangan</th>
                                    <th scope="col-1">penarikan</th>
                                    <th scope="col-1">Setoran</th>
                                    <th scope="col-2">Saldo</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $query = mysqli_query($koneksi, 'SELECT * FROM cicilan ORDER BY id ASC');
                                while ($row = mysqli_fetch_assoc($query)) {
                                ?>
                                    <tr>
                                        <td><?= $row['tanggal']; ?></td>
                                        <td><?= $row['info']; ?></td>
                                        <td><?= number_format($row['tarik'], 0, ',', '.'); ?></td>
                                        <td><?= number_format($row['setor'], 0, ',', '.'); ?></td>
                                        <td><?= number_format($row['saldo'], 0, ',', '.'); ?></td>
                                        <td>
                                            <a href="index.php?p=hapus&id=<?= $row['id']; ?>" class="btn btn-sm btn-outline-danger " id="hapusData"><i class="fa-solid fa-trash-can"></i></a>
                                        </td>
                                    </tr>
                                <?php }; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>