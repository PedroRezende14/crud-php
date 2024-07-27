<?php

class Conexao {
    private $host = 'db';  
    private $port = '5432'; 
    private $nomeBanco = 'postgres'; 
    private $user = 'postgres'; 
    private $senha = '123456'; 
    private $conn;

    public function connect() {
        $this->conn = null;

        try {
            $dsn = 'pgsql:host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->nomeBanco;
            $this->conn = new PDO($dsn, $this->user, $this->senha);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }

        return $this->conn;
    }
}

?>
