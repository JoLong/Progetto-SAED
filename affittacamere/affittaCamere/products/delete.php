<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
 
// include database and object file
include_once '/var/www/affittaCamere/config/database.php';
include_once '/var/www/affittaCamere/objects/room.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare room object
$room = new Room($db);

// set room id to be deleted
$room->id = isset($_GET["id"]) ? $_GET["id"] : "";

// delete the room
if($room->delete()){
    echo '{';
        echo '"message": "Room deleted"';
    echo '}';
}
 
// if unable to delete the room
else{
    echo '{';
        echo '"message": "Unable to delete room."';
    echo '}';
}
?>