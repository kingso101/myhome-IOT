<?php
// core configuration
include_once "../config/core.php";
 
// destroy session, it will remove ALL session settings
session_start();
unset($_SESSION["id"]);
unset($_SESSION["_id"]);
unset($_SESSION["firstname"]);
unset($_SESSION["lastname"]);
unset($_SESSION["email"]);
unset($_SESSION["access_level"]);
unset($_SESSION["profile_img"]);
session_destroy();
  
//redirect to login page
header("Location: {$home_url}admin/auth/login.php");
?>