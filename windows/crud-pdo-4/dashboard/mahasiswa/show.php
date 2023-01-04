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

    if (isset($_GET['kd_mahasiswa'])) {
        $kd_mahasiswa = $_GET['kd_mahasiswa'];
        $data_mahasiswa = $mhs->show($kd_mahasiswa);
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
                            <h3>Edit Data Mahasiswa</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" action="">
                                <div class="form-group">
                                    <label for="nama_mahasiswa" class="col-form-label">Nama Mahasiswa</label>
                                    <div class="col-sm-12">
                                        <input type="text" name="nama_mahasiswa" class="form-control"
                                            id="nama_mahasiswa" value="<?php echo $data_mahasiswa['nama_mahasiswa']; ?>"
                                            readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="kelas" class="col-form-label">Kelas</label>
                                    <div class="col-sm-12">
                                        <input type="text" name="kelas" class="form-control"
                                            value="<?php echo $data_mahasiswa['kelas']; ?>" id="kelas" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tempat_lahir" class="col-form-label">Tempat Lahir</label>
                                    <div class="col-sm-12">
                                        <textarea class="form-control" name="tempat_lahir" id="tempat_lahir"
                                            readonly><?php echo $data_mahasiswa['tempat_lahir']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tempat_lahir" class="col-form-label">Tanggal Lahir</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="tanggal_lahir" id="tanggal_lahir"
                                            value="<?php echo $data_mahasiswa['tanggal_lahir']; ?>" readonly></input>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="jurusan" class="col-form-label">Jurusan</label>
                                    <div class="col-sm-12">
                                        <input type="text" name="kelas" class="form-control"
                                            value="<?php echo $data_mahasiswa['jurusan']; ?>" id="kelas" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tempat_lahir" class="col-form-label"></label>
                                    <div class="col-sm-12">
                                        <div class="d-grid gap-2 col-12 mx-auto">
                                            <a href="index.php" class="btn btn-outline-primary"
                                                type="submit">Kembali</a>
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