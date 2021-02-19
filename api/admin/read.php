<?php
// HEADERS
header('Access-Control-Allow-Origin: *');
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
 
// query admin
$stmt = $admin->read();
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){
 
    // admin array
    $admin_arr=array();
    $admin_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
        $created = strtotime($created);
        
        // if (strlen($address) <= 50) {
        //   $address = $address;
        // } else {
        //   $address = substr($address, 0, 50) . '...';
        // }
        $contact_number = $contact_number;
 
        $admin_item = array(
            "id" =>  $id,
            "_id" =>  $_id,
            "firstname" => ucfirst($firstname),
            "lastname" => ucfirst($lastname),
            "fullname" => ucwords($firstname ." ".$lastname),
            "email" => ucfirst($email),
            "gender" => ucfirst($gender),
            "contact_number" => $contact_number,
            "address" => ucfirst($address),
            "access_level" => ucfirst($access_level),
            "password" => $password,
            "profile_img" => $profile_img,
            "created" => date('M d Y', $created),
            "modified" => $modified
        );
 
        array_push($admin_arr["records"], $admin_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show admin data in json format
    echo json_encode($admin_arr);
}else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no admin found
    echo json_encode(
        array("message" => "No admin found.")
    );
}