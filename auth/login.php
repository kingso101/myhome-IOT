<?php 
    require_once(__DIR__ .'/../vendor/autoload.php');
    require_once(__DIR__ .'/../config/autoloaders.php');

    $error = '';

    if(isset($_POST['action'])) {

        $phone = htmlspecialchars(strip_tags($_POST['phone']));
        $password = htmlspecialchars(strip_tags($_POST['password']));

        if($_POST['action'] === 'login') {
            try {
                // $user = $db->$userCollection->find(array('phone'=> $phone, 'password'=> $password));
                // if($user) {
                //     // print_r($user);
                //     var_dump($user);
                // }

                $document = $db->$userCollection->findOne(['_id' => '6026232d36421d70a83291fa']);

                var_dump($document);

            } catch (Exception $e) {
                echo $e->getMessage();
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
                                    <h5 class="card-title">Sign In</h5>
                                    <form method="POST" id="login_form" >

                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="number" class="form-control" name="phone" id="phone" placeholder="Phone" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                                        </div>

                                        <input type='hidden' name='action' value='login' />

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary float-right" id="submit" name="submit">Sign In</button>
                                            <button id="loader" style="display: none;cursor: not-allowed;" class="btn btn-primary float-right" type="button" disabled>
                                                <span class="spinner-border spinner-border-sm" role="status"></span>
                                                Loading...
                                            </button>
                                            <a style="font-size: 9px;width: 120px;font-weight: bolder;" class="btn btn-text-secondary float-left m-r-sm" href="forgotpassword.php"><b>Forgot Password</b></a></i>
                                            <a class="btn btn-text-secondary float-right m-r-sm" href="signup.php"><b>Sign up</b></a></i>
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