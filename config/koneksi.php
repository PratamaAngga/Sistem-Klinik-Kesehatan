<?php
class Koneksi {
    private $host = "localhost";
    private $port = "5432";
    private $dbname = "klinik_kesehatan";
    private $user = "postgres";
    private $password = "123";
    public $conn;

    public function getKoneksi()
    {
        try {
            $this->conn = new PDO(
                "pgsql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->dbname,
                $this->user,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;

        } catch (PDOException $e) {
            die("Koneksi gagal: " . $e->getMessage());
        }
    }
}
