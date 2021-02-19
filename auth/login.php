<?php ob_start();
    session_start();
    if(isset($_SESSION['user'])) {
        header("Location: ../dashboard.php");
    }

    // if(isset($_POST['action'])) {

    //     $email = htmlspecialchars(strip_tags($_POST['email']));
    //     $password = htmlspecialchars(strip_tags($_POST['password']));

    //     // if($_POST['action'] === 'login') {
    //     //     try {
    //     //         $user = $userCollection->findOne(['email' => 'fuhaustin@gmail.com']);
    //     //         var_dump($user);

    //     //     } catch (Exception $e) {
    //     //         echo $e->getMessage();
    //     //     }
    //     // }

    //     if($_POST['action'] === 'login') {
    //         try {
    //             $user = $userCollection->findOne(['email'=> $email, 'password'=> $password]);
    //             if ($user) {
    //                 foreach ($user as $value) {
    //                     $username = $value['username'];
    //                     echo $username;
    //                 }
    //                 // var_dump($user);
    //             }else {
    //                 echo "Email or password is incorrect.";
    //             }
    //         } catch (Exception $e) {
    //             echo $e->getMessage();
    //         }
    //     }
    // }

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
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary float-right" id="submit" name="submit">Sign In</button>
                                            <button id="loader" style="display: none;cursor: not-allowed;" class="btn btn-primary float-right" type="button" disabled>
                                                <span class="spinner-border spinner-border-sm" role="status"></span>
                                                Loading...
                                            </button>
                                        </div>
                                    </form>
                                    <script>
                            // trigger when login form is submitted
                            $(document).on('submit', '#login_form', function(e){
                                e.preventDefault();
                                var email = $('#email').val();
                                var password = $('#password').val();
                                if (email == "" || password == "") {
                                    $('#errorAlert').slideDown(300).delay(5000).slideUp(300).html("Form inputs cannot be empty.");
                                }else{
                                    
                                    // function to make form values to json format
                                    $.fn.serializeObject = function(){
                                        var o = {};
                                        var a = this.serializeArray();
                                        $.each(a, function() {
                                            if (o[this.name] !== undefined) {
                                                if (!o[this.name].push) {
                                                    o[this.name] = [o[this.name]];
                                                }
                                                o[this.name].push(this.value || '');
                                            } else {
                                                o[this.name] = this.value || '';
                                            }
                                        });
                                        return o;
                                    };
                                    
                                    // get form data
                                    var login_form = $(this);
                                    var form_data = JSON.stringify(login_form.serializeObject());
                                    // alert(form_data);
                                    // console.log(form_data);
                                    // submit form data to api
                                    $.ajax({
                                        url: "../../api/auth/login.php",
                                        type : "POST",
                                        contentType : 'application/json',
                                        data : form_data,
                                        beforeSend: function(){
                                            $('#submit').slideUp(300).delay(6000).slideDown(300);
                                            $('#loader').slideDown(200).delay(6000).slideUp(200);
                                            $('#submit').html('Loading...');
                                        },
                                        success : function(result){
                                            // alert(result.status);
                                            if(result.status == "Done"){
                                                // alert('Hello!');
                                                // console.log(result.status);
                                                setTimeout(function() {
                                                    window.location.href = "../dashboard.php";
                                                }, 2000);
                                                $('#submit').html('Sign In');
                                            }else{
                                                $('#errorAlert').delay(6000).slideDown(300).html("Login failed. Email or password is incorrect.").delay(6000).slideUp(300);
                                                $('#submit').html('Sign In');
                                                // alert('Error.');
                                            }
                                        },
                                        error: function(result){
                                            if(result.status === "Not done"){
                                                // alert('Not Done.');
                                                console.log(result.status);
                                            }
                                            // on error, tell the user login has failed & empty the input boxes
                                             $('#errorAlert').delay(6000).slideDown(300).html("Login failed. Email or password is incorrect.").delay(6000).slideUp(300);
                                            login_form.find('input').val('');
                                            $('#submit').html('Sign In');
                                        }
                                    });
                                 
                                    return false;
                                }
                            });
                        </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
<?php require_once './partials/auth.footer.inc.php'; ?>