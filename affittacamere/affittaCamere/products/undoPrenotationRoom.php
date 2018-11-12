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


// get id of room to be edited
$data = json_decode(file_get_contents("php://input"));

// get id
$roomId=isset($_GET["id"]) ? $_GET["id"] : "";

// set ID property of room to be edited
$room->id = $roomId;

// update the room
if($room->undoPrenote()){
    echo '{';
        echo '"message": "Room unprenotated"';
    echo '}';
}

// if unable to update the room, tell the user
else{
    echo '{';
        echo '"message": "Unable to prenotate room"';
    echo '}';
}




function setDate($date)
{
    $month = getMonth(substr($date, 4, 3));
    return substr($date, 11, 4) . '' . $month . '' . substr($date, 8, 2);
}

 function getMonth($month)
{
    $up = null;
    switch ($month) {
        case('Jan'):
            $up = '01';
            break;
        case('Feb'):
            $up = '02';
            break;
        case('Mar'):
            $up = '03';
            break;
        case('Apr'):
            $up = '04';
            break;
        case('May'):
            $up = '05';
            break;
        case('Jun'):
            $up = '06';
            break;
        case('Jul'):
            $up = '07';
            break;
        case('Aug'):
            $up = '08';
            break;
        case('Sep'):
            $up = '09';
            break;
        case('Oct'):
            $up = '10';
            break;
        case('Nov'):
            $up = '11';
            break;
        case('Dec'):
            $up = '12';
            break;
    }

    return $up;
}

?>