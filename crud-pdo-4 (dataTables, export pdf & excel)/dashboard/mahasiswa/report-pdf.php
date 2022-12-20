<?php
require_once '../../library/Connection.php';
require_once '../../library/fpdf/fpdf.php';

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

    // intance object dan memberikan pengaturan halaman PDF
    $pdf = new FPDF('P', 'mm', 'A4');
    $pdf->AddPage();

    $pdf->SetFont('Times', 'B', 13);
    $pdf->Cell(200, 10, 'Data Mahasiswa', 0, 0, 'C');

    $pdf->Cell(10, 15, '', 0, 1);
    $pdf->SetFont('Times', 'B', 9);
    $pdf->Cell(10, 7, 'No', 1, 0, 'C');
    $pdf->Cell(35, 7, 'Nama Mahasiswa', 1, 0, 'D');
    $pdf->Cell(35, 7, 'Kelas', 1, 0, 'E');
    $pdf->Cell(45, 7, 'Jurusan', 1, 0, 'F');
    $pdf->Cell(35, 7, 'Tempat Lahir', 1, 0, 'G');
    $pdf->Cell(30, 7, 'Tanggal Lahir', 1, 0, 'H');

    $pdf->Cell(10, 7, '', 0, 1);
    $pdf->SetFont('Times', '', 10);
    $no = 1;

    foreach ($data_mahasiswa as $data) {
        $pdf->Cell(10, 6, $no++, 1, 0, 'C');
        $pdf->Cell(35, 6, $data['nama_mahasiswa'], 1, 0);
        $pdf->Cell(35, 6, $data['kelas'], 1, 0);
        $pdf->Cell(45, 6, $data['jurusan'], 1, 0);
        $pdf->Cell(35, 6, $data['tempat_lahir'], 1, 0);
        $pdf->Cell(30, 6, $data['tanggal_lahir'], 1, 1);
    }

    $pdf->Output();
}
