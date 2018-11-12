<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '/var/www/affittaCamere/config/database.php';
include_once '/var/www/affittaCamere/objects/room.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare room object
$room = new Room($db);

// set ID property of product to be edited
$room->id = isset($_GET['id']) ? $_GET['id'] : die();

// read the details of product to be edited
$room->readOne();
 
// create array
$room_arr = array(
    "id" =>  $room->id,
    "name" => $room->name,
    "description" => $room->description,
    "price" => $room->price,
    "persons" => $room->persons,
    "occupation" => $room->occupation
 
);
 
// make it json format
print_r(json_encode($room_arr));
?>