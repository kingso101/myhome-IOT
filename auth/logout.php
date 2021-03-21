<?php 
session_start();

require_once(__DIR__ .'/../config/core.php');

unset($_SESSION["bearer_token"]);
unset($_SESSION["id"]);
unset($_SESSION["firstname"]);
unset($_SESSION["email"]);
unset($_SESSION["phoneNumber"]);
// unset($_SESSION["profile_img"]);
session_destroy();
  
//redirect to login page
header("Location: {$_ENV['BASE_URL']}/auth/login.php");

exit();

?>
