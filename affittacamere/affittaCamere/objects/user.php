<?php

class User{
 
    // database connection and table name
    private $conn;
    private $table_name = "users";
 
    // object properties
    public $id;
    public $username;
    public $email;
    public $password;
    public $adminUser;
    public $token;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
        
    }


    // create user
    function register($username, $email, $password, $adminUser){
 
        $this->token = bin2hex(openssl_random_pseudo_bytes(16));

        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    username=:username, email=:email, password=:password, adminUser=:adminUser, token=:token";
     
        // prepare query
        $stmt = $this->conn->prepare($query);


     
        // sanitize
        $this->username=htmlspecialchars(strip_tags($this->username));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->password=htmlspecialchars(strip_tags($this->password));
        $this->adminUser=htmlspecialchars(strip_tags($this->adminUser));
     
        // bind values
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":adminUser", $this->adminUser);
        $stmt->bindParam(":token", $this->token);
       
        // execute query
        if($stmt->execute()){
            return true;
        } else {
            var_dump($stmt->errorInfo());
            
            return false;
        }
        
    }


    // log the user
    function login($username, $password){

        // query to read single record
        $query = "SELECT
                p.token, p.adminUser
                FROM
                " . $this->table_name . " p
                WHERE
                    p.username = ? AND p.password = ?
                LIMIT
                    1";
     
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
     
        // search for username
        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $password);     
        
        // execute query
        $stmt->execute();
     
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->token = $row['token'];
        $this->adminUser = $row['adminUser'];

        return $row;

    }
}