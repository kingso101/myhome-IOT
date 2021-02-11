<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; multipart/form-data; boundary=MultipartBoundry; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Access-Control-Allow-Methods, Authorization, X-Requested-With");
 
require '../../vendor/autoload.php';
require '../objects/AWSCognitoWrapper.php';

use AWSCognitoApp\AWSCognitoWrapper;

$wrapper = new AWSCognitoWrapper();
$wrapper->initialize();
$error = '';

$data = json_decode(file_get_contents("php://input"));
// print_r($data);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    isset($data->username) &&
    isset($data->email) &&
    isset($data->password)
    // !isset($data->$_FILES['file']) 
){
    // set admin property values
    $username = $data->username;
	$email = $data->email;
	$password = $data->password;

    $error = $wrapper->signup($username, $email, $password);

    if(empty($error)) {
        header('Location: confirm.php?username=' . $username);
        exit;
        // set response code - 201 created
        http_response_code(201);

        echo json_encode(
            array('status' => true,
                'message' => 'User added successfully.')
        );
    }else {
        // set response code - 503 service unavailable
        http_response_code(503);

        echo json_encode(
            array('status' => false,
                'message' => 'Unable to create admin.')
        );
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to create user. Data is incomplete."));
}

?>