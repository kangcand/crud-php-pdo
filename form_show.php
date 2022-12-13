<?php
include 'library.php';
$lib = new Library();
if (isset($_GET['kd_mahasiswa'])) {
    $kd_mahasiswa = $_GET['kd_mahasiswa'];
    $data_mahasiswa = $lib->get_by_id($kd_mahasiswa);
// } else {
//     header('Location: index.php');
// }

// if (isset($_POST['tombol_update'])) {
//     $kd_mahasiswa = $_POST['kd_mahasiswa'];
//     $nama_mahasiswa = $_POST['nama_mahasiswa'];
//     $kelas = $_POST['kelas'];
//     $tempat_lahir = $_POST['tempat_lahir'];
//     $status_update = $lib->update($kd_mahasiswa, $nama_mahasiswa, $kelas, $tempat_lahir);
//     if ($status_update) {
//         header('Location:index.php');
//     }
}
?>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="bootstrap.min.css">
    </head>
    <body>
    <div class="container"  style="margin-top:40px;">
        <div class="card">
            <div class="card-header">
                <h3>Show Data Mahasiswa</h3>
            </div>
            <div class="card-body">
            <form method="post" action="">
                <input type="hidden" name="kd_mahasiswa" value="<?php echo $data_mahasiswa['kd_mahasiswa']; ?>"/>
                <div class="form-group row">
                    <label for="nama_mahasiswa" class="col-sm-2 col-form-label">Nama Mahasiswa</label>
                    <div class="col-sm-10">
                    <input type="text" name="nama_mahasiswa" class="form-control" id="nama_mahasiswa" value="<?php echo $data_mahasiswa['nama_mahasiswa']; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                    <div class="col-sm-10">
                    <input type="text" value="<?php echo $data_mahasiswa['kelas']; ?>" name="kelas" class="form-control" id="kelas" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                    <div class="col-sm-10">
                    <textarea class="form-control" name="tempat_lahir" id="tempat_lahir" readonly><?php echo $data_mahasiswa['tempat_lahir']; ?></textarea>
                    </div>
                </div>
                 <div class="form-group row">
                    <label for="tempat_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-10">
                    <input class="form-control" type="text" value="<?php echo date_format(new DateTime($data_mahasiswa['tanggal_lahir']), "d M Y"); ?>" name="tempat_lahir" id="tempat_lahir" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tempat_lahir" class="col-sm-2 col-form-label">Jurusan</label>
                    <div class="col-sm-10">
                    <input class="form-control" type="text" value="<?php echo $data_mahasiswa['jurusan']; ?>" name="tempat_lahir" id="tempat_lahir" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tempat_lahir" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                    <a href="index.php" class="btn btn-primary" >Kembali</a>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
    </body>
</html>