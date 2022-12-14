<?php
require_once '../../library/Connection.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "<script type='text/javascript'>
        alert('Maaf anda harus login terlebih dahulu!');
            window.location = '/crud-pdo-4/login.php'
        </script>";
} else {
    $db = new Connection();
    $conn = $db->connect();

    // mahasiswa
    $mhs = new Mahasiswa($conn);

    if (isset($_POST['simpan'])) {
        // $kd_mahasiswa = $_POST['kd_mahasiswa'];
        $nama_mahasiswa = $_POST['nama_mahasiswa'];
        $kelas = $_POST['kelas'];
        $tempat_lahir = $_POST['tempat_lahir'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $jurusan = $_POST['jurusan'];

        $status_add = $mhs->store($nama_mahasiswa, $kelas, $tempat_lahir, $tanggal_lahir, $jurusan);
        if ($status_add) {
            header('Location:index.php');
        }
    }

    ?>
<!DOCTYPE html>
<html lang="en">

<!-- Head -->
<?php include "../../layouts/dashboard/head.php";?>
<!-- Head end -->

<body class="g-sidenav-show  bg-gray-100">
    <!-- Sidebar -->
    <?php include "../../layouts/dashboard/sidebar.php";?>
    <!-- Sidebar end -->
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <?php include "../../layouts/dashboard/nav.php";?>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <!-- content -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <strong>Create Data Mahasiswa</strong>
                        </div>
                        <div class="card-body">
                            <form method="post" action="">
                                <div class="form-group">
                                    <label for="nama_mahasiswa" class="col-form-label">Nama Mahasiswa</label>
                                    <div class="col-sm-12">
                                        <input type="text" name="nama_mahasiswa" class="form-control"
                                            id="nama_mahasiswa">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="kelas" class="col-form-label">Kelas</label>
                                    <div class="col-sm-12">
                                        <input type="text" name="kelas" class="form-control" id="kelas">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tempat_lahir" class="col-form-label">Tempat Lahir</label>
                                    <div class="col-sm-12">
                                        <textarea class="form-control" name="tempat_lahir" id="tempat_lahir"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tempat_lahir" class="col-form-label">Tanggal Lahir</label>
                                    <div class="col-sm-12">
                                        <input type="date" class="form-control" name="tanggal_lahir"
                                            id="tanggal_lahir"></input>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="jurusan" class="col-form-label">Jurusan</label>
                                    <div class="col-sm-12">
                                        <select name="jurusan" class="form-control" id="">
                                            <option value="Teknik Informatika">Teknik Informatika</option>
                                            <option value="Teknik Industri">Teknik Idustri</option>
                                            <option value="Digital Marketing">Digital Marketing</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tempat_lahir" class="col-form-label"></label>
                                    <div class="col-sm-12">
                                        <div class="d-grid gap-2 col-12 mx-auto">
                                            <button name="simpan" class="btn btn-outline-primary"
                                                type="submit">Simpan</button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- content end -->
            <!-- footer -->
            <?php include "../../layouts/dashboard/footer.php";?>
            <!-- footer end -->
        </div>

    </main>

    <!--   Core JS Files   -->
    <?php include "../../layouts/dashboard/scripts.php";?>
    <!-- core js files end -->
</body>

</html>
<?php }?>