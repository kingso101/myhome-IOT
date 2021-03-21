<?php ob_start();
    session_start();
    if(isset($_SESSION['_id'])) {
        header("Location: ../dashboard.php");
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
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary float-right" id="submit" name="submit">
                                                <span id="loader" style="display: none;cursor: not-allowed;" class="spinner-border spinner-border-sm" role="status"></span>&nbsp;Sign In
                                            </button>
                                            
                                            <!-- <a style="font-size: 9px;width: 120px;font-weight: bolder;" class="btn btn-text-secondary float-left m-r-sm" href="forgotpassword.php"><b>Forgot Password</b></a></i>
                                            <a class="btn btn-text-secondary float-right m-r-sm" href="signup.php"><b>Sign up</b></a></i> -->
                                        </div>
                                    </form>
                                    <script>
                                        // trigger when login form is submitted
                                        $(document).on('submit', '#login_form', function(e){
                                            e.preventDefault();
                                            var email = $('#email').val();
                                            var password = $('#password').val();
                                            if (email == "" || password == "") {
                                                // $('#errorAlert').slideDown(300).delay(5000).slideUp(300).html("");
                                                toastr.error('Form inputs cannot be empty.');
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
                                                // console.log(form_data);
                                                // submit form data to api
                                                $.ajax({
                                                    url: "https://smart-ss-staging.herokuapp.com/api/v1/users/login",
                                                    type : "POST",
                                                    // headers: {
                                                    //     Authorization: 'Bearer ' + token
                                                    // },
                                                    contentType : 'application/json',
                                                    data : form_data,
                                                    beforeSend: function(){
                                                        // $('#submit').slideUp(300).delay(6000).slideDown(300);
                                                        // $('#loader').slideDown(200).delay(6000).slideUp(200);
                                                        // $("#loader").css("display","block");
                                                        // console.log(form_data);
                                                        $('#submit').html('<span id="loader" style="display: block;cursor: not-allowed;" class="spinner-border spinner-border-sm" role="status"></span>&nbsp;Loading...');
                                                    },
                                                    success : function(result){
                                                        // alert(result);
                                                        var timeleft = 4;
                                                        var downloadTimer = setInterval(function(){
                                                        timeleft--;
                                                        document.getElementById("countdowntimer").textContent = timeleft;
                                                        if(timeleft <= 0)
                                                            clearInterval(downloadTimer);
                                                        },1000);
                                                        toastr.success('Login was successful, you will be re-directed in <span id="countdowntimer">4</span> seconds.');
                                                        // console.log(result.user);
                                                        setTimeout(function() {
                                                            $('#submit').html('Sign In');

                                                            $.post("../process.php", {
                                                                id: result.user.id,
                                                                token: result.token, 
                                                                email: result.user.email, 
                                                                firstname: result.user.firstName,
                                                                phoneNumber: result.user.phoneNumber
                                                            })
                                                            .done(function(data) {
                                                                window.location.href = "../dashboard.php";
                                                            });
                                                        }, 4000);
                                                    },
                                                    error: function(error){
                                                        // console.log(error.responseJSON.error);
                                                        // console.log(error);
                                                        // console.log(error.responseJSON.error);
                                                        // console.log(error.responseText);
                                                        setTimeout(function() {
                                                            $("#login_form")[0].reset();
                                                            $('#submit').html('Sign In');
                                                            toastr.error('Login Failed. '+error.responseJSON.error);
                                                        }, 5000);
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