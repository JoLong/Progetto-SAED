<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 

include_once '../config/database.php';
include_once '../objects/user.php';
 
$database = new Database();
$db = $database->getConnection();
 
$user = new User($db);
 
// get posted data //var_dump($data);
$data = json_decode(file_get_contents("php://input"));

//$username=isset($_GET["username"]) ? $_GET["username"] : "";
//$email=isset($_GET["email"]) ? $_GET["email"] : "";
//$psw=isset($_GET["psw"]) ? $_GET["psw"] : "";
//$adminUser=isset($_GET["adminUser"]) ? $_GET["adminUser"] : "";

// set product property values
$user->username = $data->username;
$user->email = $data->email;
$user->password = $data->psw;
$user->adminUser = $data->adminUser;

//$user->username = $username;
//$user->email = $email;
//$user->password = $psw;
//$user->adminUser = $adminUser;


// create the user
if($user->register(
	$user->username,
	$user->email,
	$user->password,
	$user->adminUser
	)){
    
   	echo json_encode(
    	array("message" => "User created.")
	);  
    
}
 
// if unable to create the product, tell the user
else{
  	echo json_encode(
    	array("message" => "User not created.")
    	);
}
?>