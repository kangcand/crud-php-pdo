<?php
require_once '../../library/Connection.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "<script type='text/javascript'>
        alert('Maaf anda harus login terlebih dahulu!');
            window.location = '/login.php'
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

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">PHP PDO</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard/mahasiswa">Mahasiswa</a>
                    </li>
                </ul>
                <?php
if (isset($_SESSION['user_id'])) {?>
                <a href="/logout.php" class="btn btn-outline-success">Logout</a>
                <?php }
    ?>
            </div>
        </div>
    </nav>
    <main>
        <section class="py-5 container">
            <div class="row py-lg-5">
                <div class="col-lg-12 col-md-8 mx-auto">
                    <div class="card">
                        <div class="card-header bg-light">
                            Data Mahasiswa
                            <a href="create.php" class="btn btn-sm btn-outline-primary" style="float:right">Tambah</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Jurusan</th>
                                        <th>Tempat Lahir</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Aksi</th>
                                    </tr>
                                    <?php
$no = 1;
    foreach ($data_mahasiswa as $mhs) {?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $mhs['nama_mahasiswa']; ?></td>
                                        <td><?php echo $mhs['kelas']; ?></td>
                                        <td><?php echo $mhs['jurusan']; ?></td>
                                        <td><?php echo $mhs['tempat_lahir']; ?></td>
                                        <td><?php echo date_format(new DateTime($mhs['tanggal_lahir']), "d M Y") ?></td>
                                        <td>
                                            <a href="show.php?kd_mahasiswa=<?php echo $mhs['kd_mahasiswa'] ?>" class="btn btn-sm btn-outline-warning">Show</a> |
                                            <a href="edit.php?kd_mahasiswa=<?php echo $mhs['kd_mahasiswa'] ?>" class="btn btn-sm btn-outline-success">Edit</a> |
                                            <a href="index.php?delete=<?php echo $mhs['kd_mahasiswa'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah anda yakin?')">Delete</a>
                                        </td>
                                    </tr>
                                    <?php }?>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>

    <div class="container text-center">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <p class="col-md-12 mb-0 text-muted">© <a id="cp"></a> Candra Herdiansyah</p>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script>
        document.getElementById("cp").innerHTML = new Date().getFullYear();
    </script>
</body>

</html>
<?php }?>