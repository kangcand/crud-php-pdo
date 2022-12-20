<?php

// kelas login
class Login extends Connection
{
    // properti
    private $conn;
    private $table = 'users';

    // constructor
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // metode login
    public function login($username, $password)
    {
        // query
        $query = 'SELECT * FROM ' . $this->table . ' WHERE username = :username AND password = :password';

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // bind param
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);

        // execute query
        $stmt->execute();

        return $stmt;
    }
}
