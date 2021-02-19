<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// get database connection
include_once '../config/database.php';
 
// instantiate admin object
include_once '../objects/admin.php';
 
// get database connection
$database = new Database();
$db = $database->connect();
 
// prepare admin object
$admin = new Admin($db);
 
// set ID property of record to read
$admin->_id = isset($_GET['_id']) ? $_GET['_id'] : die();
 
// read the details of admin to be edited
$admin->readOne();
 
if($admin->firstname!=null){
    // create array
    $admin_arr = array(
        "id" =>  $admin->id,
        "_id" =>  $admin->_id,
        "firstname" => ucfirst($admin->firstname),
        "lastname" => ucfirst($admin->lastname),
        "fullname" => ucwords($admin->firstname ." ".$admin->lastname),
        "email" => ucfirst($admin->email),
        "gender" => ucfirst($admin->gender),
        "contact_number" => $admin->contact_number,
        "address" => ucfirst($admin->address),
        "access_level" => ucfirst($admin->access_level),
        "password" => $admin->password,
        "profile_img" => $admin->profile_img,
        "created" => $admin->created,
        "modified" => $admin->modified
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($admin_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user admin does not exist
    echo json_encode(array("message" => "Admin does not exist."));
}


?>