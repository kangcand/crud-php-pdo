<?php
// kelas koneksi
class Connection
{
    // properti
    private $host = 'localhost';
    private $dbname = 'crud_pdo';
    private $username = 'root';
    private $password = '123';

    // metode koneksi
    public function connect()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbname, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Koneksi Error: ' . $e->getMessage();
        }
        return $this->conn;
    }
}

// import kelas Login
require_once 'Login.php';

// import kelas Mahasiswa
require_once 'Mahasiswa.php';
