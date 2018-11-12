<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 

include_once '../config/database.php';
include_once '../objects/room.php';
 
$database = new Database();
$db = $database->getConnection();
 
$room = new Room($db);
 
// get posted data //var_dump($data);
$data = json_decode(file_get_contents("php://input"));

// set product property values
$room->name = $data->roomName;
$room->price = $data->roomPrice;
$room->persons = $data->roomPersons;
$room->type = $data->roomType;

// create the product
if($room->create()){
    echo '{';
        echo '"message": "Room created"';
    echo '}';
}
 
// if unable to create the product, tell the user
else{
    echo '{';
        echo '"message": "Unable to create room."';
    echo '}';
}
?>