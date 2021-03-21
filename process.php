<?php ob_start();

if (isset($_POST['id']) && isset($_POST['email']) && isset($_POST['firstname']) && isset($_POST['phoneNumber']) && isset($_POST['token'])) {
	session_start();

	$token = $_POST['token'];
	$id=htmlspecialchars(strip_tags($_POST['id']));
    $email=htmlspecialchars(strip_tags($_POST['email']));
    $phoneNumber=htmlspecialchars(strip_tags($_POST['phoneNumber']));
    $firstname=htmlspecialchars(strip_tags($_POST['firstname']));

	$_SESSION['id'] = $id;
	$_SESSION['bearer_token'] = $token;
	$_SESSION['email'] = ucfirst($email);
	$_SESSION['phoneNumber'] = $phoneNumber;
	$_SESSION['firstname'] = ucfirst($firstname);

	return true;
}
return false;




?>