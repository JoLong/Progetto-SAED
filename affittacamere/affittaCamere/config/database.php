<?php

class Database{
 
    // db credentials
    private $host = "localhost";
    private $dbName = "albergo";
    private $userName = "root";
    private $psw = "Test1234";
    public $conn;

    // get the database connection
    public function getConnection(){

        $this->conn = null;
 
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbName, $this->userName, $this->psw);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}
?>