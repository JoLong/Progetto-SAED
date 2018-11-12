<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/room.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare room object
$room = new Room($db);
 
// set ID property of room to be edited
$room->id = isset($_GET["id"]) ? $_GET["id"] : "";
 
// set room property values
$room->name = isset($_GET["name"]) ? $_GET["name"] : "";
$room->price = isset($_GET["price"]) ? $_GET["price"] : "";
$room->persons = isset($_GET["persons"]) ? $_GET["persons"] : "";
$room->type =  isset($_GET["type"]) ? $_GET["type"] : "";

// update the room
if($room->update()){
    echo '{';
        echo '"message": "Room updated"';
    echo '}';
}
 
// if unable to update the room, tell the user
else{
    echo '{';
        echo '"message": "Unable to update room"';
    echo '}';
}
?>