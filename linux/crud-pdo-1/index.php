<?php
include 'library.php';
$lib = new Library();
$data_mahasiswa = $lib->show();

if (isset($_GET['hapus_mahasiswa'])) {
    $kd_mahasiswa = $_GET['hapus_mahasiswa'];
    $status_hapus = $lib->delete($kd_mahasiswa);
    if ($status_hapus) {
        header('Location: index.php');
    }
}
?>
<html>

<head>
    <title>CRUD PDO</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
            aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">Navbar</a>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12" style="margin-top:40px;">
                <div class="card">
                    <div class="card-header">
                        <h3>Crud Web 1 PDO</h3>
                    </div>
                    <div class="card-body">
                        <a href="form_add.php" class="btn btn-success">Tambah</a>
                        <hr />
                        <table class="table table-bordered" width="60%">
                            <tr>
                                <th>No</th>
                                <th>Nama Mahasiswa</th>
                                <th>Kelas</th>
                                <th>Jurusan</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Action</th>
                            </tr>
                            <?php
$no = 1;
foreach ($data_mahasiswa as $row) {
    echo "<tr>";
    echo "<td>" . $no . "</td>";
    echo "<td>" . $row['nama_mahasiswa'] . "</td>";
    echo "<td>" . $row['kelas'] . "</td>";
    echo "<td>" . $row['jurusan'] . "</td>";
    echo "<td>" . $row['tempat_lahir'] . "</td>";
    echo "<td>" . date_format(new DateTime($row['tanggal_lahir']), "d M Y") . "</td>";
    echo "<td><a class='btn btn-info' href='form_edit.php?kd_mahasiswa=" . $row['kd_mahasiswa'] . "'>Update</a>
        <a class='btn btn-warning' href='form_show.php?kd_mahasiswa=" . $row['kd_mahasiswa'] . "'>Show</a>
                        <a class='btn btn-danger' href='index.php?hapus_mahasiswa=" . $row['kd_mahasiswa'] . "'>Hapus</a></td>";
    echo "</tr>";
    $no++;
}
?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>