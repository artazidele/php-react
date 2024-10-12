<?php
include_once 'config.php';

class Database
{
    private $host = HOST;
    private $user = USER;
    private $password = PASSWORD;
    private $database = DATABASE;
    private $connection;
    private $error;

    public function __construct() 
    {
        $this->connect();
    }

    private function connect() 
    {
        $this->connection = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        if (!$this->connection) {
            $this->error = "Database connection failed";
        }
    }

    public function getConnection() {
        return $this->connection;
    }
}
?>