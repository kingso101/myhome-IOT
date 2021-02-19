<?php
// required headers
header("Access-Control-Allow-Origin: http://recordlabel/");
header("Content-Type: application/json; multipart/form-data; boundary=MultipartBoundry; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Access-Control-Allow-Methods, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate artist object
include_once '../objects/artist.php';
 
// get database connection
$database = new Database();
$db = $database->connect();
 
// prepare artist object
$artist = new Artist($db);
 
// get id of artist to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of artist to be edited
// $artist->_id = isset($_POST['_id']) ? $_POST['_id'] : die();
$artist->_id = $data->_id;
 
// set artist property values
$artist->firstname = $data->up_fname;
$artist->lastname = $data->up_lname;
$artist->stage_name = $data->up_stage_name;
$artist->artist_gender = $data->up_artist_gender;
$artist->age = $data->up_age;
$artist->location = $data->up_location;
$artist->genre = $data->up_genre;
$artist->info = $data->up_info;
$artist->artist_img = $data->up_artist_img;
$artist->modified = date('Y-m-d H:i:s');


// update the admin
if($artist->update()){
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "Artist was updated."));
}
 
// if unable to update the artist, tell the user
else{
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to update artist."));
}


?>