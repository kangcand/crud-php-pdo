<?php
class Library
{
    public function __construct()
    {
        $host = "localhost";
        $dbname = "crud_pdo";
        $username = "root";
        $password = "123";
        $this->db = new PDO("mysql:host={$host};dbname={$dbname}", $username, $password);
    }

    public function add_data($nama_mahasiswa, $kelas, $tempat_lahir, $tanggal_lahir, $jurusan)
    {
        $data = $this->db->prepare('INSERT INTO tb_mahasiswa (nama_mahasiswa,kelas,tempat_lahir,tanggal_lahir,jurusan) VALUES (?, ?, ?, ?, ?)');
        $data->bindParam(1, $nama_mahasiswa);
        $data->bindParam(2, $kelas);
        $data->bindParam(3, $tempat_lahir);
        $data->bindParam(4, $tanggal_lahir);
        $data->bindParam(5, $jurusan);

        $data->execute();
        return $data->rowCount();
    }
    public function show()
    {
        $query = $this->db->prepare("SELECT * FROM tb_mahasiswa");
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }

    public function get_by_id($kd_mahasiswa)
    {
        $query = $this->db->prepare("SELECT * FROM tb_mahasiswa where kd_mahasiswa=?");
        $query->bindParam(1, $kd_mahasiswa);
        $query->execute();
        return $query->fetch();
    }

    public function update($kd_mahasiswa, $nama_mahasiswa, $kelas, $tempat_lahir, $tanggal_lahir, $jurusan)
    {
        $query = $this->db->prepare('UPDATE tb_mahasiswa set nama_mahasiswa=?, kelas=?, tempat_lahir=?, tanggal_lahir=?, jurusan=? where kd_mahasiswa=?');

        $query->bindParam(1, $nama_mahasiswa);
        $query->bindParam(2, $kelas);
        $query->bindParam(3, $tempat_lahir);
        $query->bindParam(4, $tanggal_lahir);
        $query->bindParam(5, $jurusan);
        $query->bindParam(6, $kd_mahasiswa);

        $query->execute();
        return $query->rowCount();
    }

    public function delete($kd_mahasiswa)
    {
        $query = $this->db->prepare("DELETE FROM tb_mahasiswa where kd_mahasiswa=?");

        $query->bindParam(1, $kd_mahasiswa);

        $query->execute();
        return $query->rowCount();
    }

    // logika login
    public function login($username, $password)
    {
        // buat query
        $query = "SELECT * FROM users WHERE username = :username AND password = :password";

        // persiapkan query
        $stmt = $db->prepare($query);

        // bind nilai
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password', $password);

        // jalankan query
        $stmt->execute();

        // cek apakah pengguna ada
        if ($stmt->rowCount() == 1) {
            // ambil data pengguna
            $user = $stmt->fetch();

            // simpan data pengguna di sesi
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['name'] = $user['name'];

            // redirect ke dashboard
            header('Location: index.php');
            exit;
        } else {
            // login gagal
            $error = "Nama pengguna atau kata sandi salah";
        }
    }

}
