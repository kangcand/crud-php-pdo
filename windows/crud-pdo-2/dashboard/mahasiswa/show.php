<?php
require_once '../../library/Connection.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "<script type='text/javascript'>
        alert('Maaf anda harus login terlebih dahulu!');
            window.location = '/crud-pdo-2/login.php'
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
                        <a class="nav-link" href="/crud-pdo-2/dashboard/mahasiswa">Mahasiswa</a>
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
                <div class="col-lg-10 col-md-8 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h3>Edit Data Mahasiswa</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" action="">
                                <div class="form-group">
                                    <label for="nama_mahasiswa" class="col-form-label">Nama Mahasiswa</label>
                                    <div class="col-sm-12">
                                        <input type="text" name="nama_mahasiswa" class="form-control"
                                            id="nama_mahasiswa" value="<?php echo $data_mahasiswa['nama_mahasiswa']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="kelas" class="col-form-label">Kelas</label>
                                    <div class="col-sm-12">
                                        <input type="text" name="kelas" class="form-control" value="<?php echo $data_mahasiswa['kelas']; ?>" id="kelas" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tempat_lahir" class="col-form-label">Tempat Lahir</label>
                                    <div class="col-sm-12">
                                        <textarea class="form-control" name="tempat_lahir" id="tempat_lahir" readonly><?php echo $data_mahasiswa['tempat_lahir']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tempat_lahir" class="col-form-label">Tanggal Lahir</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="tanggal_lahir"
                                            id="tanggal_lahir" value="<?php echo $data_mahasiswa['tanggal_lahir']; ?>" readonly></input>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="jurusan" class="col-form-label">Jurusan</label>
                                    <div class="col-sm-12">
                                        <input type="text" name="kelas" class="form-control" value="<?php echo $data_mahasiswa['jurusan']; ?>" id="kelas" readonly>
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