
// jQuery codes
$(document).ready(function(){
    // show sign up / registration form
    $(document).on('click', '#add_admin_modal', function(){
    	// alert('Hey!');
 	
        var html = `
	        	<script>
			        function encode() {
				        var selectedfile = document.getElementById("profile_img").files;
				        if (selectedfile.length > 0) {
				          var imageFile = selectedfile[0];
				          var fileReader = new FileReader();
				          fileReader.onload = function(fileLoadedEvent) {
				            var srcData = fileLoadedEvent.target.result;
				            var newImage = document.createElement('img');
				            newImage.style.width = "100%";
							newImage.style.height = "100%";
				            newImage.src = srcData;
				            document.getElementById("dummy").innerHTML = newImage.outerHTML;
				            document.getElementById("profile_img_base64").value = srcData;
				          }
				          fileReader.readAsDataURL(imageFile);
				        }
			    	}
			    </script>
	            <div class="container-fluid" id="app_div">
	                <div class="row">
	                    <div class="col-12">
	                        <h2 class="page-title">Add admin</h2>
	                    </div>
	                </div>
	                <div class="row">
	                    <div class="col-lg-8 >
	                        <div class="row">
	                        	<!-- when clicked, it will show the product's list -->
							    <!-- <div id='read-products' class='btn btn-primary pull-right m-b-15px all_admin_page'>
							        <span class='glyphicon glyphicon-list'></span>&nbsp; All admin
							    </div> -->
							    <a href='all-admin.php' id='read-products' class='btn btn-primary pull-right m-b-15px all_admin_page'><span class='glyphicon glyphicon-arrow-left'></span>&nbsp;Go Back
			    				</a>
							    <!-- product data will be shown in this table -->
	                            <div class="card">
	                                <div class="card-body">
	                                    <div id="errorAlert" style="color: #fff;" class="alert alert-danger errorAlert" role="alert">
			                              Incorrect add_password!! try again.
			                            </div>
			                            <div class="modal-body">
			                                <form id="add_admin_form" class="needs-validation" enctype="multipart/form-data" novalidate>
			                                    <div class="form-row">
			                                        <div class="col-md-6 mb-3">
			                                            <div class="form-group">
			                                                <tr>
													            <td>Firstname</td>
													            <td><input type="text" class="form-control" id="add_firstname" name="add_firstname"></td>
													        </tr>
			                                            </div>
			                                        </div>
			                                        <div class="col-md-6 mb-3">
			                                            <div class="form-group">
			                                                <tr>
													            <td>Lastname</td>
													            <td><input type="text" class="form-control" id="add_lastname" name="add_lastname"></td>
													        </tr> 
			                                            </div>
			                                        </div>
			                                    </div>
			                                    <div class="form-row">
			                                        <div class="col-md-6 mb-3">
			                                            <div class="form-group">
			                                                 <tr>
													            <td>Email</td>
												            	<td><input type="email" class="form-control" id="add_email" placeholder="add_Email" name="add_email"></td>
													        </tr>
			                                            </div>
			                                        </div>
			                                        <div class="col-md-6 mb-3">
			                                            <div class="form-group">
			                                                <tr>
													            <td>Contact Number</td>
													            <td><input type="number" class="form-control" id="add_contact_number" name="add_contact_number"></td>
													        </tr>
			                                            </div>
			                                        </div>
			                                    </div>
			                                    <div class="form-row">
			                                        <div class="col-md-6 mb-3">
			                                            <div class="form-group">
			                                                <tr>
													            <td>Password</td>
													            <td><input type="password" class="form-control" id="add_password1" name="add_password1"></td>
													        </tr>
			                                            </div>
			                                        </div>
			                                        <div class="col-md-6 mb-3">
			                                            <div class="form-group">
			                                                <tr>
													            <td>Re-type Password</td>
													            <td><input type="password" class="form-control" id="add_password2" name="add_password2"></td>
													        </tr>
			                                            </div>
			                                        </div>
			                                    </div>
			                                    <div class="form-row">
			                                        <div class="col-md-6 mb-3">
			                                            <div class="form-group">
			                                            	<tr>
													            <td>Gender</td>
													            <td>
													            	<select id="add_gender" name="add_gender" class="custom-select form-control">
					                                                    <option value="" >Select Gender</option>
					                                                    <option value="male">Male</option>
					                                                    <option value="female">Female</option>
					                                                </select>
													            </td>
													        </tr>
			                                            </div>
			                                        </div>
			                                        <div class="col-md-6 mb-3">
			                                            <div class="form-group">
			                                            	<tr>
													            <td>Access Level</td>
													            <td>
													            	<select id="add_access_level" name="add_access_level" class="custom-select form-control">
					                                                    <option value="" >Select User Type</option>
					                                                    <option value="superadmin">Super Admin</option>
					                                                    <option value="admin">Admin</option>
					                                                    <option value="auxiliary">Auxiliary Admin</option>
					                                                </select>
													            </td>
													        </tr>
			                                            </div>
			                                        </div>
			                                    </div>
			                                    <div class="form-row">
			                                        <div class="col-md-12 mb-6">
			                                            <div class="form-group">
			                                                <tr>
													            <td>Address</td>
													            <td><textarea type="text" class="form-control" id="add_address" name="add_address"></textarea></td>
													        </tr>
			                                            </div>
			                                        </div>
			                                    </div>
			                                    <div class="form-row" style="position: relative;">
			                                        <div class="col-md-6 mb-6">
			                                            <div class="form-group">
			                                                <!-- <label for="profile_img">Choose Image</label> -->
			                                                <input required type="file" class="form-control InputBox" id="profile_img" placeholder="Choose Image" name="profile_img" onchange="encode();">
			                                            </div>
			                                        </div>

			                                        <div>
												      <input id="profile_img_base64" name="profile_img_base64" type="hidden" />
												    </div>

			                                        <div class="col-md-6 mb-6">
			                                            <div class="form-group">
				                                            <div id="dummy" style="width: 80px;height: 80px;display: block;position: absolute;top: 0%;left: 0%;background-image:url(assets/images/avatars/noimage1.png);background-repeat:no-repeat;background-size:cover;">
													    	</div>
			                                            </div>
			                                        </div>

			                                    </div>
			                                    <div class="col-md-12" style="position: relative;">
				                                    <button class="btn btn-primary float-right" id="add_admin" name="add_admin" type="submit">Add</button>
				                                    <button id="admin_loader" style="display: none;cursor: not-allowed;" class="btn btn-primary float-right" type="button" disabled>
				                                        <span class="spinner-border spinner-border-sm" role="status"></span>
				                                        Loading...
				                                    </button>  
		                                        </div></br></br></br>
			                                </form>
			                            </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            `;

 
        $('#dashboard_add_admin_button').html('');
        $('#app_div').html(html);
    });

	$(document).ready(function(){
        $(document).on('submit', '#add_admin_form', function(e){
            e.preventDefault();
            var firstname = $('#add_firstname').val();
            var lastname = $('#add_lastname').val();
            var email = $('#add_email').val();
            var password1 = $('#add_password1').val();
            var password2 = $('#add_password2').val();
            var contact_number = $('#add_contact_number').val();
            var gender = $('#add_gender').val();
            var address = $('#add_address').val();
            var access_level = $('#add_access_level').val();
            var profile_img_base64 = $('#profile_img_base64').val();


            if (firstname == "" || lastname == "" || email == "" || password1 == "" || password2 == "" || gender == "" || contact_number == "" || address == "" || access_level == "" || profile_img == "") {
                toastr.error('Form inputs cannot be empty!');
            }else{
                if (password1 != password2) {
                    toastr.error('Password mis-matched!');
                }else{
                    var password = password1;
                    const fileSelector = document.getElementById('profile_img');
					const fileList = event.target.files;
					var filesize = fileSelector.files[0].size;
                    if(filesize>2000000) {
                        toastr.error('File size is greater than 2MB.');
                        return false;
                    }else{
                        var obj = { "lastname":lastname, "firstname":firstname, "email":email, "password":password, "address":address, "gender":gender, "contact_number":contact_number, "access_level":access_level, "profile_img":profile_img_base64 };
				    	var form_data = JSON.stringify(obj);
                        // alert(form_data);
                        
                        $.ajax({
                            url: '../api/admin/create.php',
                            type : "POST",
					        contentType : 'application/json',
					        data : form_data,
                            // dataType: 'json',
                            beforeSend: function(){
                                setTimeout(function () {
							        $('#add_admin').html('Loading...');
							    }, 100);
                            },
                            success: function(data){
                                // alert(data);
                                $("#add_admin_form")[0].reset();
			            		setTimeout(function(){
					            	toastr.success(result.message);
					            	$('#add_admin').delay(3000).html('Add');
								   	window.location.reload(true);
								}, 3000);
                            },
                            error: function(xhr, resp, text){
					            // on error, tell the user sign up failed
						        setTimeout(function () {
					            	toastr.error(result.message);
							        $('#add_admin').html('Add');
							    }, 4000); 
					        }
                        });
                    }
                }
            }
        });
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