<?php ob_start();
	require_once './partials/auth.header.inc.php';
	require '../vendor/autoload.php';

    use AWSCognitoApp\AWSCognitoWrapper;

    $wrapper = new AWSCognitoWrapper();
    $wrapper->initialize();
    $error = '';

    if (!isset($_GET['username'])) {
    	header('Location: 404.php');
    }else{
    	if(isset($_POST['action'])) {
		    $username = htmlspecialchars(strip_tags($_GET['username']));
	    	$confirmation = htmlspecialchars(strip_tags($_POST['confirmation']));
	    	// var_dump($_GET['username']);
	    	// var_dump($_POST['confirmation']);
		    $error = $wrapper->confirmSignup($username, $confirmation);
		    // $error = "";
		    if(empty($error)) {
		        header('Location: ../dashboard.php');
		    }
		}

    	$username = htmlspecialchars(strip_tags($_GET['username']));
    
  
?>
        
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
                                    <h5 class="card-title">Confirm Sign Up</h5>
                                    <form method="POST" id="login_form" >

                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?= $username; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="confirmation">Confirmation Code</label>
                                            <input type="text" class="form-control" name="confirmation" id="confirmation" placeholder="Confirmation code" required>
                                        </div>

                                        <input type='hidden' name='action' value='confirm' />

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary float-right" id="submit" name="submit">Confirm</button>
                                            <button id="loader" style="display: none;cursor: not-allowed;" class="btn btn-primary float-right" type="button" disabled>
                                                <span class="spinner-border spinner-border-sm" role="status"></span>
                                                Loading...
                                            </button>
                                            <!-- <a class="btn btn-text-secondary float-right m-r-sm" href="signup.php"><b>Sign up</b></a></i> -->
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
<?php require_once './partials/auth.footer.inc.php'; ?>