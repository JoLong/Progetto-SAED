<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


// include database and object files
include_once '../config/database.php';
include_once '../objects/room.php';


// instantiate database and room object
$database = new Database();
$db = $database->getConnection();

// initialize object
$room = new Room($db);

 // get roomType
$type=isset($_GET["type"]) ? $_GET["type"] : "";

// query rooms
$stmt = $room->readRooms($type);

$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){
 
    // rooms array
    $rooms_arr=array();
    $rooms_arr["records"]=array();
 
    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 
        extract($row);
 
        $room_item = array(
            "id" => $id,
            "name" => $name,
            "price" => $price,
            "type" => html_entity_decode($type),
            "persons" => $persons,
            "occupated_from" => $occupated_from,
            "occupated_to" => $occupated_to
        );

 
        array_push($rooms_arr["records"], $room_item);
    }
 
    echo json_encode($rooms_arr);
}
 
else{
    echo json_encode(
        array("message" => "No rooms found.")
    );
}
?>