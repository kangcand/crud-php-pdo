<?php
// kelas mahasiswa
class Mahasiswa extends Connection
{

    // properti
    private $conn;
    private $table = 'tb_mahasiswa';

    // constructor
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // menampilkan semua data dari table mahasiswa
    public function index()
    {
        $query = $this->conn->prepare("SELECT * FROM tb_mahasiswa");
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }

    // menambhkan data mahasiswa
    public function store($nama_mahasiswa, $kelas, $tempat_lahir, $tanggal_lahir, $jurusan)
    {
        $data = $this->conn->prepare('INSERT INTO tb_mahasiswa (nama_mahasiswa,kelas,tempat_lahir,tanggal_lahir,jurusan) VALUES (?, ?, ?, ?, ?)');
        $data->bindParam(1, $nama_mahasiswa);
        $data->bindParam(2, $kelas);
        $data->bindParam(3, $tempat_lahir);
        $data->bindParam(4, $tanggal_lahir);
        $data->bindParam(5, $jurusan);

        $data->execute();
        return $data->rowCount();
    }

    // mengambil data mahasiswa berdasarkan field kd_mahasiswa
    public function show($kd_mahasiswa)
    {
        $query = $this->conn->prepare("SELECT * FROM tb_mahasiswa where kd_mahasiswa=?");
        $query->bindParam(1, $kd_mahasiswa);
        $query->execute();
        return $query->fetch();
    }

    // mengubah data mahasiswa
    public function update($kd_mahasiswa, $nama_mahasiswa, $kelas, $tempat_lahir, $tanggal_lahir, $jurusan)
    {
        $query = $this->conn->prepare('UPDATE tb_mahasiswa set nama_mahasiswa=?, kelas=?, tempat_lahir=?, tanggal_lahir=?, jurusan=? where kd_mahasiswa=?');

        $query->bindParam(1, $nama_mahasiswa);
        $query->bindParam(2, $kelas);
        $query->bindParam(3, $tempat_lahir);
        $query->bindParam(4, $tanggal_lahir);
        $query->bindParam(5, $jurusan);
        $query->bindParam(6, $kd_mahasiswa);

        $query->execute();
        return $query->rowCount();
    }

    // menghapus data mahasiswa berdasarkan data mahasiswa
    public function delete($kd_mahasiswa)
    {
        $query = $this->conn->prepare("DELETE FROM tb_mahasiswa where kd_mahasiswa=?");
        $query->bindParam(1, $kd_mahasiswa);
        $query->execute();
        return $query->rowCount();
    }
}
