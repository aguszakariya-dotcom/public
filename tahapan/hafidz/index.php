<?php
session_start();
include_once 'koneksi.php';

// Ambil saldo terakhir dari tabel
$querySaldoTerakhir = mysqli_query($koneksi, 'SELECT saldo FROM hfd ORDER BY id DESC LIMIT 1');
$saldoTerakhir = mysqli_fetch_assoc($querySaldoTerakhir)['saldo'];

// Menghitung total pengeluaran
// $queryTotalPengeluaran = mysqli_query($koneksi, 'SELECT SUM(keluar) AS total_pengeluaran FROM hfd');
// $totalPengeluaran = mysqli_fetch_assoc($queryTotalPengeluaran)['total_pengeluaran'];

// menghitung total Income
$queryTotalSetor = mysqli_query($koneksi, 'SELECT SUM(setor) AS totalSetor FROM hfd');
$totalSetor = mysqli_fetch_assoc($queryTotalSetor)['totalSetor'];

?>
    <?php
    if (isset($_GET['p']) && $_GET['p'] == "hapus" && isset($_GET['id'])) {
        $hapus = mysqli_query($koneksi, "DELETE FROM hfd WHERE id = '" . $_GET['id'] . "'");
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
<!-- html bootstrap 5.2 -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tahapan | Hafidz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/swal.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;500&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/swal.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            font-size: small;
            /* background-image: url("bgatas.jpg"); */
            /* background-color: darkslategrey; */
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            width: 100%;
        }


        .card {
            background-color: rgba(255, 255, 255, 0.9);
        }

        .active {
            text-decoration: underline !important;
            font-size: 12px;
            color: #F62A01;
            text-shadow: #F73218 3px 6px 10px;
            /* text-overflow: ellipsis; */
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

    <div class="mt-5 px-5">
        <div class="row justify-content-center">
            <!-- form -->
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
                                <label class="col-sm-5 col-form-label" for="keterangan" id="keterangan">Deskripsi</label>
                                <div class="col-sm-7">
                                    <textarea class="form-control text-capitalize" placeholder="Leave a comment here" name="keterangan" id="keterangan"></textarea>
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
                    });
                });
            </script>
            <!-- form-end -->
            <div class="col-md-10 col-xl-6 col-sm-12 mt-3">
                <?php
                $querySaldoTerakhir = mysqli_query($koneksi, 'SELECT saldo FROM hfd ORDER BY id DESC LIMIT 1');
                $saldoTerakhir = mysqli_fetch_assoc($querySaldoTerakhir)['saldo'];

                ?>
                <div class="card">
                    <div class="card-header row  justify-content-center text-center">
                        <?php
                        $queryPenarikan = mysqli_query($koneksi, 'SELECT SUM(tarik) AS totalTarik FROM hfd');
                        $totalPenarikan = mysqli_fetch_assoc($queryPenarikan)['totalTarik'];
                        ?>
                        <table>
                            
                            <tr>
                                <th></th>
                                <th><i data-feather="battery-charging"></i>Pinjaman</th>
                                <th></th>
                                <th><i data-feather="log-out"></i>Penarikan</th>
                                <th></th>
                                <th><i data-feather="sliders"></i>Saldo</th>
                                <th></th>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="lingkaran shadow fw-bold" style="height: 100px; width: 100px"><?= number_format($totalPenarikan, 0, ',', '.'); ?></td>
                                <td class="mx-2"></td>
                                <td class="lingkaran2 shadow fw-bold" style="height: 100px; width: 100px"><?= number_format($totalPenarikan, 0, ',', '.'); ?></td>
                                <td></td>
                                <td class="lingkaran3 shadow fw-bold" style="height: 100px; width: 100px"><?= number_format($saldoTerakhir, 0, ',', '.'); ?></td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <table class="table table-sm table-striped">
                        <thead>
                                <tr">
                                    <th class="col-sm-1">No.</th>
                                    <th class="col-sm-2">Tanggal</th>
                                    <th class="col-sm-3">Keterangan</th>
                                    <th class="col-sm-2">Penarikan</th>
                                    <th class="col-sm-2">Setoran</th>
                                    <th class="col-sm-2">Saldo</th>
                                    <th>Aksi</th>
                                </tr>
                        </thead>
                        <tbody class="isi-table">
                            <?php
                            $no = 1;
                            $query = mysqli_query($koneksi, 'SELECT * FROM hfd ORDER BY id ASC');
                            while ($row = mysqli_fetch_assoc($query)) {
                            ?>
                                <tr style="font-size: smaller;">
                                    <td><?= $no++; ?></td>
                                    <td><?= $row['tanggal']; ?></td>
                                    <td><?= $row['keterangan']; ?></td>
                                    <td class="text-danger"><?=number_format( $row['tarik'],0, ',', '.'); ?></td>
                                    <td class="text-primary"><?=number_format( $row['setor'],0, ',', '.'); ?></td>
                                    <td class="fw-bold">Rp. <?=number_format( $row['saldo'],0, ',', '.'); ?></td>
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

    <script>
        feather.replace()
        function scrollToBottom() {
  var tbody = document.querySelector("tbody");
  tbody.scrollIntoView({
    behavior: "smooth",
  });
}

document.addEventListener("DOMContentLoaded", scrollToBottom);

    </script>

            <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->

</body>

</html>