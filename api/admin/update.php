<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Access-Control-Allow-Methods, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate admin object
include_once '../objects/admin.php';
 
// get database connection
$database = new Database();
$db = $database->connect();
 
// prepare admin object
$admin = new Admin($db);
 
// get id of admin to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of admin to be edited
$admin->_id = $data->_id;
 
// set admin property values
$admin->firstname = $data->up_fname;
$admin->lastname = $data->up_lname;
$admin->email = $data->up_email;
$admin->gender = $data->up_gender;
$admin->contact_number = $data->up_contact_number;
$admin->address = $data->up_address;
$admin->access_level = $data->up_access_level;
// $admin->password = $data->password;
$admin->profile_img = $data->up_profile_img;
$admin->modified = date('Y-m-d H:i:s');

if (preg_match('/uploads\/image_/', $admin->profile_img)) {
	// update the admin
	if($admin->update()){
	    // set response code - 200 ok
	    http_response_code(200);
	 
	    // tell the user
	    echo json_encode(array("message" => "Admin was updated successfully."));
	}
	 
	// if unable to update the admin, tell the user
	else{
	    // set response code - 503 service unavailable
	    http_response_code(503);
	 
	    // tell the user
	    echo json_encode(array("message" => "Unable to update admin."));
	}

}else{
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

	    $filepath = "../../uploads/image_"; // or image.jpg
		// salt for clarity in file name
		$salt = time();
		// destination of the file on the server
		$destination = $filepath .$salt.".".$type;
		$admin->profile_img = $destination;
		if(file_put_contents($destination, $data)){
		    // move the uploaded (temporary) file to the specified destination
		    // update the admin
			if($admin->update()){
			    // set response code - 200 ok
			    http_response_code(200);
			 
			    // tell the user
			    echo json_encode(array("message" => "Admin was updated."));
			}
			 
			// if unable to update the admin, tell the user
			else{
			    // set response code - 503 service unavailable
			    http_response_code(503);
			 
			    // tell the user
			    echo json_encode(array("message" => "Unable to update admin."));
			}
		}else{
		    $result =  "error";
		}
	}
}


?>