<?php
require_once(__DIR__ .'/../config/config.php');
$error = '';

if(isset($_POST['action'])) {

    $username = htmlspecialchars(strip_tags($_POST['username']));
    $email = htmlspecialchars(strip_tags($_POST['email']));
    $phone = htmlspecialchars(strip_tags($_POST['phone']));
    $password1 = htmlspecialchars(strip_tags($_POST['password1']));
    $password2 = htmlspecialchars(strip_tags($_POST['password2']));

    if($_POST['action'] === 'register') {
        if ($password1 !== $password2) {
            $error = 'Password mis-matched.';
        } 

        if ($password1 === $password2) {
            $password = md5($password1);
        } 
        
        $user = array(         
            "username" => $username,
            "email" => $email,
            "phone" => $phone,
            "password" => $password  
        );

        // checking empty fields
        $error = '';
        foreach ($user as $key => $value) {
            if (empty($value)) {
                $error .= $key . ' field is empty<br />';
            }
        }

        if ($error) {
            // print error message & link to the previous page
            echo '<span style="color:red">'.$error.'</span>';
            echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";    
        } else {
            //insert data to database table/collection named 'users'
            $db->users->insert($user);
            
            //display success message
            echo "<font color='green'>Data added successfully.";
            header("Location: login.php");
        }

    }
}

?>

<?php require_once './partials/auth.header.inc.php'; ?>
        
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
                                    <h5 class="card-title">Sign Up</h5>
                                    <form method="POST" id="signup_form" >
                                        <!-- <script>
                                            
                                        </script> -->
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="username" class="form-control" name="username" id="username" placeholder="Username" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="number" class="form-control" name="phone" id="phone" placeholder="Phone Number" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="password1">Password</label>
                                            <input type="password" class="form-control" name="password1" id="password1" placeholder="Password"  required>
                                        </div>
                                        <div class="form-group">
                                            <label for="password2">Re-type Password</label>
                                            <input type="password" class="form-control" name="password2" id="password2" placeholder="Re-type Password"  required>
                                        </div>

                                        <input type='hidden' name='action' value='register' />

                                        <div class="form-group">
                                           	<button type="submit" class="btn btn-primary float-right" id="submit" value="submit">Sign Up</button>
                                            <button id="loader" style="display: none;cursor: not-allowed;" class="btn btn-primary float-right" type="button" disabled>
                                                <span class="spinner-border spinner-border-sm" role="status"></span>
                                                Loading...
                                            </button>
                                            <a class="btn btn-text-secondary float-right m-r-sm" href="login.php"><b>Login</b></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
<?php require_once './partials/auth.footer.inc.php'; ?>