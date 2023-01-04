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
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=data_mahasiswa.xls");
    ?>
    <table class="table">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Jurusan</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
        </tr>
        <?php
$no = 1;
    foreach ($data_mahasiswa as $mhs) {?>
        <tr>
            <td>
                <?php echo $no++; ?>
            </td>
            <td>
                <?php echo $mhs['nama_mahasiswa']; ?>
            </td>
            <td>
                <?php echo $mhs['kelas']; ?>
            </td>
            <td>
                <?php echo $mhs['jurusan']; ?>
            </td>
            <td>
                <?php echo $mhs['tempat_lahir']; ?>
            </td>
            <td>
                <?php echo date_format(new DateTime($mhs['tanggal_lahir']), "d M Y") ?>
            </td>
        </tr>
        <?php }?>
    </table>
</body>

</html>
<?php }?>