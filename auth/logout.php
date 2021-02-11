<?php 
session_start();
session_destroy();

header("Location: https://smartsurvelliance1ea3c54c-1ea3c54c-dev.auth.us-east-1.amazoncognito.com/login?client_id=d9423d0k0uisl7epfa9ffupge&response_type=token&scope=aws.cognito.signin.user.admin+email+openid+phone+profile&redirect_uri=https://smart-surveillance-web-app.herokuapp.com/process.php");
exit();

?>
