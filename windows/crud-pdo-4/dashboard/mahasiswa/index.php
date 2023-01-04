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
    $data_mahasiswa = $mhs->index();

    if (isset($_GET['delete'])) {
        $kd_mahasiswa = $_GET['delete'];
        $status_hapus = $mhs->delete($kd_mahasiswa);
        if ($status_hapus) {
            header('Location: index.php');
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
                        <div class="card-header pb-0 bg-light text-right">
                            <strong>Data Mahasiswa</strong> &nbsp;
                            <a href="/crud-pdo-4/dashboard/mahasiswa/create.php"
                                class="btn btn-sm btn-outline-primary float-lg-end">Tambah</a> &nbsp;
                            <a target="_blank" href="/crud-pdo-4/dashboard/mahasiswa/report-excel.php"
                                class="btn btn-sm btn-info float-lg-end mx-2">Export
                                Excel &nbsp;</a>
                            <button onclick="window.open('/crud-pdo-4/dashboard/mahasiswa/report-pdf.php','_blank')"
                                class="btn btn-sm btn-success float-lg-end mx-2">Export
                                PDF</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-items-center" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Kelas</th>
                                            <th>Jurusan</th>
                                            <th>Tempat Lahir</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
$no = 1;
    foreach ($data_mahasiswa as $mhs) {?>
                                        <tr>
                                            <td style="text-align: center;">
                                                <?php echo $no++; ?>
                                            </td>
                                            <td>
                                                <?php echo $mhs['nama_mahasiswa']; ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php echo $mhs['kelas']; ?>
                                            </td>
                                            <td>
                                                <?php echo $mhs['jurusan']; ?>
                                            </td>
                                            <td style="padding-left: 30px;">
                                                <?php echo $mhs['tempat_lahir']; ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php echo date_format(new DateTime($mhs['tanggal_lahir']), "d M Y") ?>
                                            </td>
                                            <td>
                                                <a href="show.php?kd_mahasiswa=<?php echo $mhs['kd_mahasiswa'] ?>"
                                                    class="btn btn-sm btn-outline-warning">Show</a> |
                                                <a href="edit.php?kd_mahasiswa=<?php echo $mhs['kd_mahasiswa'] ?>"
                                                    class="btn btn-sm btn-outline-success">Edit</a> |
                                                <a href="index.php?delete=<?php echo $mhs['kd_mahasiswa'] ?>"
                                                    class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Apakah anda yakin?')">Delete</a>
                                            </td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
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