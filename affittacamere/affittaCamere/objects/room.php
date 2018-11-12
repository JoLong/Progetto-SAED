<?php

class Room{
 
    // database connection and table name
    private $conn;
    private $table_name = "rooms";
 
    // object properties
    public $id;
    public $name;
    public $price;
    public $persons;
    public $type;
    public $occuped_from;
    public $occuped_to;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read rooms by type
    public function readRooms($roomType) {
        
        $query = "SELECT
                    p.id, p.name, p.price, p.persons, p.occupated_from, p.occupated_to
                FROM
                    " . $this->table_name . " p
                WHERE p.type = '" . strtoupper($roomType) . "'
                ORDER BY
                    p.price DESC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // read all rooms
    public function read(){
 
    // select all query
    $query = "SELECT
                p.id, p.name, p.description, p.price, p.persons, p.occupation
            FROM
                " . $this->table_name . " p
            ORDER BY
                p.price DESC";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
    }

    // create room
    function create(){

        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    name=:name, 
                    price=:price, 
                    persons=:persons, 
                    type=:type"; //, occupation=:occupation";
     
        // prepare query
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->persons=htmlspecialchars(strip_tags($this->persons));
        $this->type=htmlspecialchars(strip_tags($this->type));
     
        // bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":persons", $this->persons);
        $stmt->bindParam(":type", $this->type);
       
        // execute query
        if($stmt->execute()){
            return true;
        }
        var_dump($stmt->errorInfo());
        return false;
    }

    // used when filling up the update room form
    function readOne(){
     
        // query to read single record
        $query = "SELECT
                p.id, p.name, p.description, p.price, p.persons, p.occupation
                FROM
                " . $this->table_name . " p
                WHERE
                    p.id = ?
                LIMIT
                    0,1";
     
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
     
        // bind id of room to be updated
        $stmt->bindParam(1, $this->id);
     
        // execute query
        $stmt->execute();
     
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
        // set values to object properties
        $this->name = $row['name'];
        $this->price = $row['price'];
        $this->description = $row['description'];
        $this->persons = $row['persons'];
        $this->occupation = $row['occupation'];
    }

    // update the room
    function update(){
     
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    name = :name,
                    price = :price,
                    persons = :persons,
                    type = :type
                WHERE
                    id = :id";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->persons=htmlspecialchars(strip_tags($this->persons));
        $this->type=htmlspecialchars(strip_tags($this->type));
        $this->id=htmlspecialchars(strip_tags($this->id));
     
        // bind new values
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':persons', $this->persons);
        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':id', $this->id);
     
        // execute the query
        if($stmt->execute()){
            return true;
        }
     
        return false;
    }

    // update the room
    function prenote(){

        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    occupated_from = date(:occuped_from),
                    occupated_to = date(:occuped_to)
                WHERE
                    id = :id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->occuped_from=htmlspecialchars(strip_tags($this->occuped_from));
        $this->occuped_to=htmlspecialchars(strip_tags($this->occuped_to));
        $this->id=htmlspecialchars(strip_tags($this->id));

        // bind new values
        $stmt->bindParam(':occuped_from', $this->occuped_from);
        $stmt->bindParam(':occuped_to', $this->occuped_to);
        $stmt->bindParam(':id', $this->id);

        // execute the query
        if($stmt->execute()){
            return true;
        }

        return false;
    }

    // update the room
    function undoPrenote(){

        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    occupated_from = null,
                    occupated_to = null
                WHERE
                    id = :id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->id=htmlspecialchars(strip_tags($this->id));

        // bind new values
        $stmt->bindParam(':id', $this->id);

        // execute the query
        if($stmt->execute()){
            return true;
        }

        return false;
    }

    // delete the room
    function delete(){
     
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";

        // prepare query
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->id=htmlspecialchars(strip_tags($this->id));

        // bind id of record to delete
        $stmt->bindParam(':id', $this->id);
     
        // execute query
        if($stmt->execute()){
            return true;
        }
     
        return false;
     
    }

    // search rooms
    function search($keywords){
     
        // select all query
        $query = "SELECT
                    p.id, p.name, p.description, p.price, p.persons, p.occupation
                FROM
                    " . $this->table_name . " p
                WHERE
                    p.name LIKE ? OR p.description LIKE ? 
                ORDER BY
                    p.price DESC";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";
     
        // bind
        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);
        $stmt->bindParam(3, $keywords);
     
        // execute query
        $stmt->execute();
     
        return $stmt;
    }

}