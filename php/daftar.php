<?php
include '../DB_con/dbcon.php';

$edit = isset($_GET['edit']) ? $_GET['edit'] : '';
$query = mysqli_query($koneksi, "SELECT * FROM registrasi WHERE NoReg = '$edit'");
$data = mysqli_fetch_assoc($query);
// print_r($data['Alamat']);
// die;
if (isset($_POST['daftar'])) {
    $nama = $_POST['nama'];
    $jk = $_POST['jk'];
    $alamat = $_POST['Alamat'];
    $agama = $_POST['agama'];
    $asalSekolah = $_POST['asalSekolah'];
    $jurusan = $_POST['jurusan'];
    if ($edit) {
        $update = mysqli_query($koneksi, "UPDATE registrasi SET nama ='$nama', jk = '$jk', Alamat = '$alamat',agama = '$agama', asalSekolah = '$asalSekolah', jurusan = '$jurusan' WHERE NoReg = '$edit'");
        header("Location: lihat_data.php");
        exit;
    } else {
        $insert = mysqli_query($koneksi, "INSERT INTO registrasi (nama, jk, alamat, agama, asalSekolah, jurusan) VALUES('$nama', '$jk', '$alamat', '$agama', '$asalSekolah', '$jurusan')");
        header("Location: lihat_data.php");
        exit;
    }
}
// hapus
if (isset($_GET['hapus'])) {
    $hapus = mysqli_query($koneksi, "DELETE FROM registrasi WHERE NoReg = '$_GET[hapus]'");
    header("Location: lihat_data.php");
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <title>Pendaftaran siswa Baru</title>
</head>

<body class="bg-primary">
    <div class="container card mt-5 ">

        <h1 class="text-center mt-3 "><?php echo ($edit) ? 'Edit Data' : 'Pendaftaran '; ?> Siswa Baru</h1>
        <form action="" method="post">
            <div class="mb-3">
                <label for="" class="form-label"> Nama lengkap</label>
                <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Lengkap" required value="<?= ($edit) ? $data['Nama'] : '' ?>">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Jenis kelamin</label>
                <select name="jk" class="form-select" required>
                    <option value=""> ----silahkan pilih jenis kelamin----</option>
                    <option value="laki-laki" <?= ($edit && $data['JK'] == 'laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
                    <option value="perempuan" <?= ($edit && $data['JK'] == 'perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="" class="form-label"> alamat</label>
                <textarea name="Alamat" class="form-control" placeholder="Masukan Alamat" required value=""><?= ($edit) ? $data['Alamat'] : '' ?></textarea>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Agama</label>
                <select name="agama" class="form-select">
                    <option value="" required> ----silahkan pilih agama----</option>
                    <option value="islam" <?= ($edit && $data['Agama'] == 'islam') ? 'selected' : ''; ?>>islam</option>
                    <option value="kristen" <?= ($edit && $data['Agama'] == 'kristen') ? 'selected' : ''; ?>>kristen</option>
                    <option value="hindu" <?= ($edit && $data['Agama'] == 'hindu') ? 'selected' : ''; ?>>hindu</option>
                    <option value="budha" <?= ($edit && $data['Agama'] == 'budha') ? 'selected' : ''; ?>>budha</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="" class="form-label"> asal Sekolah</label>
                <input type="text" name="asalSekolah" class="form-control" placeholder="Masukan Asal Sekolah" required value="<?= ($edit) ? $data['AsalSekolah'] : '' ?>">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">jurusan</label>
                <select name="jurusan" class="form-select">
                    <option value=""> ----silahkan pilih jurusan----</option>
                    <option value="rpl" <?= ($edit && $data['Jurusan'] == 'rpl') ? 'selected' : ''; ?>>Rekayasa Perangkat Lunak</option>
                    <option value="multimedia" <?= ($edit && $data['Jurusan'] == 'multimedia') ? 'selected' : ''; ?>>multimedia</option>
                    <option value="tkr" <?= ($edit && $data['Jurusan'] == 'tkr') ? 'selected' : ''; ?>>tkr</option>
                    <option value="perhotelan" <?= ($edit && $data['Jurusan'] == 'perhotelan') ? 'selected' : ''; ?>>perhotelan</option>
                    <option value="dkv" <?= ($edit && $data['Jurusan'] == 'dkv') ? 'selected' : ''; ?>>Desain komunikasi visual</option>
                </select>
            </div>
            <button type="submit" name="daftar" class="btn btn-primary p-2 mb-3">simpan</button>
            <a href="../pages/index.html" class="btn btn-danger p-2 mb-3 justify-content-center align-items-center"> Kembali</a>
    </div>

    </form>
</body>

</html>