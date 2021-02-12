<?php 
    require_once 'partials/header.inc.php';
    require_once 'partials/quickSearch.inc.php';
    require_once 'partials/sideBar.inc.php'; 
    require_once 'partials/chatBar.inc.php'; 
?>
            
            
            <div class="page-content">
                <!-- <button id="notificationlabel" type="button" class="btn btn-primary" >
                    Show Notification
                </button> -->
                <!-- <ul class="ul">
                  <li><a target="_blank" title="Goto Support@hberecords.com Webmail" href="https://server.dktlds.com:2096/cpsess8642207488/3rdparty/roundcube/?_task=mail&_mbox=INBOX"><i class="fa fa-cube" aria-hidden="true"></i></a></li>
                </ul> -->
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div id="errorAlert" style="color: #fff;" class="alert alert-danger errorAlert" role="alert">
                              Incorrect password!! try again.
                            </div>
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Admin</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i class="material-icons">close</i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <?php 
                                    // $ip_address = get_client_ip();
                                    // $_id = md5(uniqid(mt_rand(), true).microtime(true));
                                ?>
                                <form id="add_admin_form" class="needs-validation" enctype="multipart/form-data" novalidate>
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="firstname">Firstname</label>
                                                <input type="text" class="form-control" id="firstname" placeholder="Firstname" name="firstname">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="lastname">Lastname</label>
                                                <input type="text" class="form-control" id="lastname" placeholder="Lastname" name="lastname">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="email">email</label>
                                                <input type="text" class="form-control" id="email" placeholder="Email" name="email">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="contact_number ">Contact Number </label>
                                                <input type="text" class="form-control" id="contact_number " placeholder="contact_number " name="contact_number ">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="password1">Password</label>
                                                <input type="password" class="form-control" id="password1" placeholder="Password" name="password1">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="password2">Re-type Password</label>
                                                <input type="password" class="form-control" id="password2" placeholder="Password" name="password2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="gender">Gender</label>
                                                <select id="gender" name="gender" class="custom-select form-control">
                                                    <option value="" >Select Gender</option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="access_level">Access Level</label>
                                                <select id="access_level" name="access_level" class="custom-select form-control">
                                                    <option value="" >Select Access Level</option>
                                                    <option value="superadmin">Super Admin</option>
                                                    <option value="admin">Admin</option>
                                                    <option value="auxilliary">Auxilliary Admin</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 mb-6">
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <textarea type="text" class="form-control" id="address" name="address"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row" style="position: relative;">
                                        <div class="col-md-6 mb-6">
                                            <div class="form-group">
                                                <!-- <label for="profile_img">Choose Image</label> -->
                                                <input required type="file" class="form-control InputBox" id="profile_img" placeholder="Choose Image" name="profile_img" onChange="showPreview(this);">
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-6">
                                            <div class="form-group">
                                                <div style="width: 80px;height: 80px;display: block;position: absolute;top: 0%;left: 0%;" id="targetLayer">
                                                <img width="100%" height="100%" class="preview" id="preview" src="assets/images/avatars/noimage1.png">
                                            </div>
                                            </div>
                                        </div>

                                        <input type="hidden" id="ip_address" name="ip_address" value="<?= $ip_address; ?>">
                                        <input type="hidden" id="_id" name="_id" value="<?= $_id; ?>">
                                    </div>

                                    <button class="btn btn-primary float-right" id="add_admin" name="add_admin" type="submit">Add</button>
                                    <button id="loader" style="display: none;cursor: not-allowed;" class="btn btn-primary float-right" type="button" disabled>
                                        <span class="spinner-border spinner-border-sm" role="status"></span>
                                        Loading...
                                    </button></br></br><br>
                                </form>

                               <script>
                                    function showPreview(objFileInput) {
                                        if (objFileInput.files[0]) {
                                            var fileReader = new FileReader();
                                            fileReader.onload = function (e) {
                                                $("#targetLayer").html('<img src="'+e.target.result+'" width="100%" height="100%" class="preview" />');
                                            }
                                            fileReader.readAsDataURL(objFileInput.files[0]);
                                        }
                                    }

                                    function validate() {
                                        $("#errorAlert").html("");
                                        $(".InputBox").css("border-color","#F0F0F0");
                                        var file_size = $('#profile_img')[0].files[0].size;
                                        if(file_size>2097152) {
                                            $("#errorAlert").html("File size is greater than 2MB");
                                            $(".InputBox").css("border-color","#FF0000");
                                            return false;
                                        } 
                                        return true;
                                    }
                                    $(document).ready(function(){
                                        // $('#add_admin').on('click', function (e) {
                                        $(document).on('submit', '#add_admin', function(){
                                            e.preventDefault();
                                            var lastname = $('#lastname').val();
                                            var firstname = $('#firstname').val();
                                            var email = $('#email').val();
                                            var contact_number = $('#contact_number').val();
                                            var password1 = $('#password1').val();
                                            var password2 = $('#password2').val();
                                            var gender = $('#gender').val();
                                            var _id = $('#_id').val();
                                            var address = $('#address').val();
                                            var access_level = $('#access_level').val();
                                            var ip_address = $('#ip_address').val();
                                            // var profile_img = $('#profile_img').val();
                                            // var profile_img = $('#profile_img').prop('files')[0];
                                            var profile_img = $('#profile_img')[0].files[0];


                                            if (lastname == "" || firstname == "" || _id == "" || email == "" || contact_number == "" || password1 == "" || password2 == "" || gender == "" || access_level == "" || ip_address == "" || address == "" || profile_img == "") {
                                                // $('#errorAlert').slideDown(300).delay(5000).slideUp(300).html("Form inputs cannot be empty.");
                                                toastr.error('Form inputs cannot be empty!')
                                            }else{
                                                // alert(form_data);
                                                if (password1 != password2) {
                                                    // $('#errorAlert').slideDown(300).delay(5000).slideUp(300).html("Password mis-matched!");
                                                    toastr.error('Password mis-matched!')
                                                }else{
                                                    var password = password1;
                                                    var file_size = $('#profile_img')[0].files[0].size;
                                                    if(file_size>2000000) {
                                                         // $('#errorAlert').slideDown(300).delay(5000).slideUp(300).html("File size is greater than 2MB");
                                                         toastr.warning('File size is greater than 2MB')
                                                        return false;
                                                    }else{
                                                        // var form_data = 'username='+ username + 'email='+ email + '&password=' + password + '&ip_address='+ip_address + '&gender='+gender + '&access_level='+access_level + '&profile_img='+profile_img;
                                                        // get form data
                                                        var sign_up_form=$(this);
                                                        var form_data=JSON.stringify(sign_up_form.serializeObject());
                                                        alert(form_data);
                                                        
                                                        $.ajax({
                                                            url: '../api/admin/create.php',
                                                            type: 'POST',
                                                            data: form_data,
                                                            contentType: false,
                                                            cache: false,
                                                            processData:false,
                                                            // dataType: 'json',
                                                            beforeSend: function(){
                                                                $('#add_admin').slideUp(300).delay(8000).slideDown(300);
                                                                $('#loader').slideDown(300).delay(8000).slideUp(300);
                                                                $('#preview').css("src", profile_img);
                                                                $('#preview').css("display", "block");
                                                            },
                                                            success: function(data){
                                                                alert(data);
                                                                console.log(data);
                                                                $("#add_admin_form")[0].reset();
                                                                $("#targetLayer").html('<img src="assets/images/avatars/noimage1.png" width="100%" height="100%" class="preview" />');
                                                                // $("#loader").delay(200).css("display", "none");
                                                                // $("#add_admin").delay(8000).css("display", "block");
                                                                // function pageRedirect() {
                                                                //     window.location.replace("https://www.cdc.gov/");
                                                                // }      
                                                                // setTimeout(pageRedirect, 15000);
                                                            }
                                                        });
                                                    }
                                                }
                                            }
                                        });
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
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="container-fluid" id="app_div">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="page-title">Dashboard</h2>
                            <!-- <a href="#" class="btn btn-text-secondary float-right">Get Info</a>
                            <a href="#" class="btn btn-text-danger float-right m-r-sm">Print</a> -->
                        </div>
                    </div>

                    <!-- <div class="row">
                        <div class="col-lg-12 col-md-6">
                            <div class="card info-card" >
                                <img src="assets/images/banner.png" style="margin: 0 auto;height: auto;max-width: 100%;border: none;display: block;padding: 5px 0;">
                            </div>
                        </div>
                    </div> -->
                    <div class="row">
                        <div class="col-lg-12 col-md-6">
                            <div class="row">
                                <div class="col-lg-3 col-md-6">
                                    <div class="card info-card">
                                        <div class="card-body">
                                            <h5 class="card-title">Revenue</h5>
                                            <div class="info-card-text">
                                                <h3>792.8 $</h3>
                                                <span class="info-card-helper">Last Month</span>
                                            </div>
                                            <div class="info-card-icon">
                                                <i class="material-icons">trending_up</i>
                                            </div>
                                        </div>
                                        <div id="sparkline-bar"></div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="card info-card info-info">
                                        <div class="card-body">
                                            <h5 class="card-title">Page Views</h5>
                                            <div class="info-card-text">
                                                <h3>460.9 K</h3>
                                                <span class="info-card-helper">This Week</span>
                                            </div>
                                            <div class="info-card-icon">
                                                <i class="material-icons-outlined">remove_red_eye</i>
                                            </div>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="card info-card info-warning">
                                        <div class="card-body">
                                            <h5 class="card-title">Sales</h5>
                                            <div class="info-card-text">
                                                <h3>570.4 K</h3>
                                                <span class="info-card-helper">From all markets</span>
                                            </div>
                                            <div class="info-card-icon">
                                                <i class="material-icons">attach_money</i>
                                            </div>
                                        </div>
                                        <div id="sparkline-line"></div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="card info-card info-success">
                                        <div class="card-body">
                                            <h5 class="card-title">Growth</h5>
                                            <div class="info-card-text">
                                                <h3>142,739</h3>
                                                <span class="info-card-helper">New Users</span>
                                            </div>
                                            <div class="info-card-icon">
                                                <i class="material-icons">trending_up</i>
                                            </div>
                                        </div>
                                        <div id="sparkline-bar-2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Reports</h5>
                                    <div class="card-info"><a href="#" class="btn btn-xs btn-text-dark">See all</a></div>
                                    <ul class="report-list list-unstyled">
                                        <li class="report-item">
                                            <div class="report-icon"><i class="material-icons">add</i></div>
                                            <div class="report-text">Alan Grey uploaded new item
                                                <span>This item has to be reviewed, moderators will check it soon.</span>
                                            </div>
                                            <div class="report-helper">45min ago</div>
                                        </li>
                                        <li class="report-item report-info">
                                            <div class="report-icon"><i class="material-icons">code</i></div>
                                            <div class="report-text">David Crook made changes to create-invoice.js
                                                <span>57 lines of code added, 0 removals, 0 errors, 6 warnings</span>
                                            </div>
                                            <div class="report-helper">3h ago</div>
                                        </li>
                                        <li class="report-item report-danger">
                                            <div class="report-icon"><i class="material-icons">error_outline</i></div>
                                            <div class="report-text">Can't retrieve data from server
                                                <span>Server is not responding, please contact provider</span>
                                            </div>
                                            <div class="report-helper">6h ago</div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Server Load</h5>
                                    <div class="card-info"><span class="badge badge-secondary">Optimal</span></div>
                                    <div class="server-load row">
                                        <div class="server-stat col-sm-4">
                                            <p>167GB</p>
                                            <span>Usage</span>
                                        </div>
                                        <div class="server-stat col-sm-4">
                                            <p>320GB</p>
                                            <span>Space</span>
                                        </div>
                                        <div class="server-stat col-sm-4">
                                            <p>57.4%</p>
                                            <span>CPU</span>
                                        </div>
                                    </div>
                                    <div id="dash-flotchart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Analytics</h5>
                                    <div class="card-info"><span>Last week</span></div>
                                    <div id="apex6"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Browsers</h5>
                                    <div class="card-info"><a href="#" class="btn btn-xs btn-text-dark"><i class="material-icons">refresh</i></a></div>
                                    <ul class="list-unstyled browser-list">
                                        <li class="trending-up"><span class="browser-icon"><i class="fab fa-chrome"></i></span>Google Chrome <span class="browser-stat">44% <i class="material-icons">trending_up</i></span></li>
                                        <li class="trending-down"><span class="browser-icon"><i class="fab fa-firefox"></i></span>Mozilla Firefox <span class="browser-stat">23% <i class="material-icons">trending_down</i></span></li>
                                        <li class="trending-down"><span class="browser-icon"><i class="fab fa-opera"></i></span>Opera <span class="browser-stat">13% <i class="material-icons">trending_down</i></span></li>
                                        <li class="trending-up"><span class="browser-icon"><i class="fab fa-edge"></i></span>Microsoft Edge <span class="browser-stat">9% <i class="material-icons">trending_up</i></span></li>
                                        <li class="trending-down"><span class="browser-icon"><i class="fab fa-safari"></i></span>Safari <span class="browser-stat">5% <i class="material-icons">trending_down</i></span></li>
                                        <li class="trending-up"><span class="browser-icon"><i class="fas fa-globe"></i></span>Other <span class="browser-stat">6% <i class="material-icons">trending_up</i></span></li>
                                    </ul>
                                    <a href="#" class="btn btn-text-secondary float-right">Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div><!-- Page Content -->

            <?php 
                require_once 'partials/chatBar.inc.php';
                require_once 'partials/footer.inc.php';
            ?>
            
            
        