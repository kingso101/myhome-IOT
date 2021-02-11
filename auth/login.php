<?php ob_start();
    session_start();
    if(isset($_SESSION['user'])) {
        header("Location: ../dashboard.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin | My Home</title>
        <meta name="description" content="My home connectivity.">
        <link rel="icon" type="image/png" href="../../img/logo.jpg" sizes="32x32">
        <meta name="author" content="HBE Records">
        <!-- Remove Tap Highlight on Windows Phone IE -->
        <meta name="msapplication-tap-highlight" content="no"/>
        <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <!-- Styles -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
        <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../assets/plugins/font-awesome/css/all.min.css" rel="stylesheet">
        <link href="../assets/plugins/waves/waves.min.css" rel="stylesheet">
      
        <!-- Theme Styles -->
        <link href="../assets/css/alpha.min.css" rel="stylesheet">
        <link href="../assets/css/custom.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="login-page sign-in">
        <!-- <div class="loader">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> -->
        
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
                                    <h5 class="card-title">Sign In</h5>
                                    <form id="login_form" >

                                        <div class="form-group">
                                            <label for="email">email</label>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
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
        
        <!-- Javascripts -->
        <script src="../assets/plugins/jquery/jquery-3.4.1.min.js"></script>
        <script src="../assets/plugins/bootstrap/popper.min.js"></script>
        <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/plugins/waves/waves.min.js"></script>
        <script src="../assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="../assets/js/alpha.min.js"></script>
    </body>
</html>