<?php ob_start();
	require_once './partials/auth.header.inc.php';
	require '../vendor/autoload.php';

    use AWSCognitoApp\AWSCognitoWrapper;

    $wrapper = new AWSCognitoWrapper();
    $wrapper->initialize();
    // $error = '';

    $entercode = false;

	if(isset($_POST['action'])) {

	    if($_POST['action'] === 'code') {
	        $username = htmlspecialchars(strip_tags($_POST['username']));

	        $error = $wrapper->sendPasswordResetMail($username);

	        if(empty($error)) {
	            header('Location: forgotpassword.php?username=' . $username);
	        }
	    }

	    if($_POST['action'] == 'reset') {

	        $code = htmlspecialchars(strip_tags($_POST['code']));
	        $password = htmlspecialchars(strip_tags($_POST['password']));
	        $username = htmlspecialchars(strip_tags($_POST['username']));

	        $error = $wrapper->resetPassword($code, $password, $username);

	        // TODO: show message on new page that password has been reset
	        if(empty($error)) {
	            header('Location: login.php?status=true&message=password was reset successfully.');
	        }
	    }
	}

	if(isset($_GET['username'])) {
	    $entercode = true;
	}


?>
        <?php if($entercode) { ?>

        <div class="alpha-app">
            <div class="container">
                <div class="login-container">
                    <div class="row justify-content-center row align-items-center">
                        <div class="col-lg-4 col-md-6">
                            <div class="card login-box">
                                <div class="card-body">
                                    <div id="errorAlert" style="color: #fff;width:100%;display: none;position: absolute;top: 0;left: 0%;text-align: center;" class="alert alert-danger errorAlert" role="alert">
                                        Incorrect password!! try again.
                                    </div>
                                    <p style='color: red;'><?php if (isset($error)) { echo $error; } ?></p> 
                                    <h5 class="card-title">Forgot Password</h5>
                                    <i style="font-size: 13px;color: #f5f5f5;" class="text-muted">If your account was found, an email has been sent to the associated email address. Enter the code and your new password.</i>
                                    <form method="POST" id="forgot_password_form" >

                                        <div class="form-group">
                                            <label for="code">Code</label>
                                            <input type="text" class="form-control" name="code" id="code" placeholder="Code" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                                        </div>
                                        
                                        <input type='hidden' name="username" id="username"/>
                                        <input type='hidden' name='action' value='reset' />

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary float-right" id="submit" name="submit">Reset Password</button>
                                            <button id="loader" style="display: none;cursor: not-allowed;" class="btn btn-primary float-right" type="button" disabled>
                                                <span class="spinner-border spinner-border-sm" role="status"></span>
                                                Loading...
                                            </button>
                                            <!-- <a class="btn text-muted float-right m-r-sm" href="signup.php"><b>Sign up</b></a></i> -->
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } else { ?>

        <div class="alpha-app">
            <div class="container">
                <div class="login-container">
                    <div class="row justify-content-center row align-items-center">
                        <div class="col-lg-4 col-md-6">
                            <div class="card login-box">
                                <div class="card-body">
                                    <div id="errorAlert" style="color: #fff;width:100%;display: none;position: absolute;top: 0;left: 0%;text-align: center;" class="alert alert-danger errorAlert" role="alert">
                                        Incorrect password!! try again.
                                    </div>
                                    <p style='color: red;'><?php if (isset($error)) { echo $error; } ?></p> 
                                    <h5 class="card-title">Forgot Password</h5>
                                    <i style="font-size: 13px;color: #f5f5f5;" class="text-muted">Enter your username and we will send you a reset code to your email address.</i>
                                    <form method="POST" id="forgot_password_form" >

                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
                                        </div>
                                        
                                        <input type='hidden' name='action' value='register' />
            							<input type='hidden' name='action' value='code' />

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary float-right" id="submit" name="submit">Receive Code</button>
                                            <button id="loader" style="display: none;cursor: not-allowed;" class="btn btn-primary float-right" type="button" disabled>
                                                <span class="spinner-border spinner-border-sm" role="status"></span>
                                                Loading...
                                            </button>
                                            <!-- <a class="btn text-muted float-right m-r-sm" href="signup.php"><b>Sign up</b></a></i> -->
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>]
        <?php }?>



<?php require_once './partials/auth.footer.inc.php'; ?>