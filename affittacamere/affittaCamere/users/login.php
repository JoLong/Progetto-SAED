<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');


 
// include database and object files
include_once '/var/www/affittaCamere/config/database.php';
include_once '/var/www/affittaCamere/objects/user.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
$user_item = null;
 
 // get username
$username=isset($_GET["username"]) ? $_GET["username"] : "";

 // get password
$password=isset($_GET["password"]) ? $_GET["password"] : "";

// prepare user object
$user = new User($db);

// query users
$object = $user->login($username, $password);

if ( isset($object) ) {
    
    $user_item=array(
        "token" => $object['token'],
        "adminUser" => $object['adminUser']
    );

    //echo json_encode($user_item);
}

else{
    echo json_encode(
        array("message" => "No user found.")
    );  
}
// make it json format
print_r(json_encode($user_item));
?>