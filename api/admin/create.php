<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; multipart/form-data; boundary=MultipartBoundry; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Access-Control-Allow-Methods, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate admin object
include_once '../objects/admin.php';
 
$database = new Database();
$db = $database->connect();
 
$admin = new Admin($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    isset($data->firstname) &&
    isset($data->lastname) &&
    isset($data->email) &&
    isset($data->gender) &&
    isset($data->contact_number) &&
    isset($data->address) &&
    isset($data->password) &&
    isset($data->access_level) &&
    isset($data->profile_img)
    // !isset($data->$_FILES['file']) 
){
    // set admin property values
    $admin->_id = md5(uniqid(mt_rand(), true).microtime(true));
    $admin->firstname = $data->firstname;
    $admin->lastname = $data->lastname;
    $admin->email = $data->email;
    $admin->gender = $data->gender;
    $admin->contact_number = $data->contact_number;
    $admin->address = $data->address;
    $admin->password = $data->password;
    $admin->access_level = $data->access_level;
    $admin->profile_img = $data->profile_img;
    $admin->created = date('Y-m-d H:i:s');

    // $filename = $admin->profile_img;
    // salt for clarity in file name
    list($type, $data) = explode(';', $admin->profile_img); // exploding data for later checking and validating 

    if (preg_match('/^data:image\/(\w+);base64,/', $admin->profile_img, $type)) {
        $data = substr($data, strpos($data, ',') + 1);
        $type = strtolower($type[1]); // jpg, png, gif

        if (!in_array($type, [ 'jpg', 'jpeg', 'gif', 'png' ])) {
            throw new \Exception('invalid image type');
        }

        $data = base64_decode($data);

        if ($data === false) {
            throw new \Exception('base64_decode failed');
        }
    } else {
        throw new \Exception('did not match data URI with image data');
    }

    $filepath = "../../uploads/image_"; // or image.jpg
    // salt for clarity in file name
    $salt = time();
    // destination of the file on the server
    $destination = $filepath .$salt.".".$type;
    $admin->profile_img = $destination;

    if(file_put_contents($destination, $data)){
        // move the uploaded (temporary) file to the specified destination
        if ($admin->create()) {
            // set response code - 201 created
            http_response_code(201);

            echo json_encode(
                array('status' => true,
                    'message' => 'Admin added successfully.')
            );
        } else {
            // set response code - 503 service unavailable
            http_response_code(503);

            echo json_encode(
                array('status' => false,
                    'message' => 'Unable to create admin.')
            );
        }
    }else{
        $result =  "error";
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to create admin. Data is incomplete."));
}

?>