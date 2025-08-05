<?php
include '../DB_con/dbcon.php';
session_start();

$query =  mysqli_query($koneksi, "SELECT * FROM registrasi");
$data = mysqli_fetch_all($query, MYSQLI_ASSOC);

if (isset($_GET['cari'])) {
    $cari = $_GET['cari'];
    $cariData = mysqli_query($koneksi, "SELECT * FROM registrasi WHERE Nama LIKE '%$cari%' OR alamat LIKE '%$cari%' OR asalSekolah LIKE '%$cari%' OR jurusan LIKE '%$cari%'");
    $data = mysqli_fetch_all($cariData, MYSQLI_ASSOC);

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <title>Data siswa baru</title>
</head>
<style>
    @media print {
        .no-print {
            display: none;
        }
    }
</style>

<body>
    <div class="container mt-5">
        <a href="daftar.php" class="btn btn-primary mb-3 no-print">Tambah</a>
        <a href="" class="btn btn-primary mb-3 no-print" onclick="window.print()">print</a>
        <form class="d-flex mb-3" method="get" action="">
            <input type="text" name="cari" placeholder="Cari data" class="form-control me-2 no-print">
            <button type="submit" class="btn btn-primary me-2 no-print">Cari</button>
            <a href="lihat_data.php" class="btn btn-secondary no-print">Reset</a>
        </form>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>Agama</th>
                    <th>Asal Sekolah</th>
                    <th>Jurusan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $key => $value) :
                ?>

                    <tr>
                        <td><?= $key + 1; ?></td>
                        <td><?= $value['Nama']; ?></td>
                        <td><?= $value['JK']; ?></td>
                        <td><?= $value['Alamat']; ?></td>
                        <td><?= $value['Agama']; ?></td>
                        <td><?= $value['AsalSekolah']; ?></td>
                        <td><?= $value['Jurusan']; ?></td>
                        <td>
                            <a href="daftar.php?edit=<?= $value['NoReg'] ?>" class="btn btn-warning no-print">edit</a>
                            <a href="daftar.php?hapus=<?= $value['NoReg'] ?>" class="btn btn-danger no-print" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($data)) : ?>
                    <div class="alert alert-danger">
                        Tidak ada data
                    </div>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>