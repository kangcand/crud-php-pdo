<?php
require_once './library.php';
$lib = new Library();
if (isset($_POST['tombol_tambah'])) {
    $nama_mahasiswa = $_POST['nama_mahasiswa'];
    $kelas = $_POST['kelas'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jurusan = $_POST['jurusan'];

    $add_status = $lib->add_data($nama_mahasiswa, $kelas, $tempat_lahir, $tanggal_lahir, $jurusan);
    if ($add_status) {
        header('Location: index.php');
    }
    // var_dump($tanggal_lahir);
}
?>
<html>
    <head>
        <title>Add Data Mahasiswa</title>
        <link rel="stylesheet" href="bootstrap.min.css">
    </head>
    <body>
    <div class="container" style="margin-top:40px;">
        <div class="card">
            <div class="card-header">
                <h3>Tambah Data Mahasiswa</h3>
            </div>
            <div class="card-body">
            <form method="post" action="">
                <div class="form-group row">
                    <label for="nama_mahasiswa" class="col-sm-2 col-form-label">Nama Mahasiswa</label>
                    <div class="col-sm-10">
                    <input type="text" name="nama_mahasiswa" class="form-control" id="nama_mahasiswa">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                    <div class="col-sm-10">
                    <input type="text" name="kelas" class="form-control" id="kelas">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                    <div class="col-sm-10">
                    <textarea class="form-control" name="tempat_lahir" id="tempat_lahir"></textarea>
                    </div>
                </div>
                 <div class="form-group row">
                    <label for="tempat_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-10">
                    <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir"></input>
                    </div>
                </div>
                 <div class="form-group row">
                    <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                    <div class="col-sm-10">
                    <select name="jurusan" class="form-control" id="">
                        <option value="Teknik Informatika">Teknik Informatika</option>
                        <option value="Teknik Industri">Teknik Idustri</option>
                        <option value="Digital Marketing">Digital Marketing</option>
                    </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tempat_lahir" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                    <input type="submit" name="tombol_tambah" class="btn btn-primary" value="Tambah">
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
    </body>
</html>
