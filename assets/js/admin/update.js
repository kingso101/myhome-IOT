$(document).ready(function(){
 
    // show html form when 'update admin' button was clicked
    $(document).on('click', '.update-admin-button', function(){
        // get admin id
		var up_id = $(this).attr('data-id');
		// alert(up_id);
		// read one record based on given admin id
		$.getJSON("http://recordlabel/api/admin/read_single.php?_id=" + up_id, function(data){	
		    // values will be used to fill out our form
		    // var id = data.id;
		    var firstname = data.firstname;
		    var lastname = data.lastname;
		    var fullname = data.fullname;
		    var email = data.email;
		    var address = data.address;
		    var contact_number = data.contact_number;
		    var gender = data.gender;
		    var access_level = data.access_level;
		    var profile_img = data.profile_img;

		    // load list of categories
		    // store 'update admin' html to this variable
			var update_admin_html=`
				<script>
			        function encode() {
				        var selectedfile = document.getElementById("up_profile_img").files;
				        if (selectedfile.length > 0) {
				          var imageFile = selectedfile[0];
				          var fileReader = new FileReader();
				          fileReader.onload = function(fileLoadedEvent) {
				            var srcData = fileLoadedEvent.target.result;
				            var newImage = document.createElement('img');
				            newImage.style.width = "100%";
							newImage.style.height = "100%";
				            newImage.src = srcData;
				            document.getElementById("up_dummy").innerHTML = newImage.outerHTML;
				            document.getElementById("up_profile_img_base64").value = srcData;
				          }
				          fileReader.readAsDataURL(imageFile);
				        }
			    	}
			    </script>
			    <script>
				  const fileSelector = document.getElementById('up_profile_img');
				  fileSelector.addEventListener('change', (event) => {
				    const fileList = event.target.files;
				    var filesize = fileSelector.files[0].size;
				    if(filesize>2000000) {
				    	toastr.error('File size is greater than 2MB')
				    }
				  });
				</script>
			    <div class="row">
                    <div class="col-12">
                        <h2 class="page-title">Update admin</h2>
                    </div>
                </div>
			    <div class="row">
                    <div class="col-lg-8 ">
                    	
                        <div class="row">
						    <!-- product data will be shown in this table -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="modal-body">
                                    	<!-- when clicked, it will show the product's list -->
									    <a href='all-admin.php' id='read-products' class='btn btn-primary pull-right m-b-15px all_admin_page'><span class='glyphicon glyphicon-arrow-left'></span>&nbsp;Go Back
						    				</a><br>
				                        <form id="update_admin_form" class="needs-validation" enctype="multipart/form-data" novalidate>
				                            <div class="form-row">
				                                <div class="col-md-6 mb-3">
				                                    <div class="form-group">
				                                        <tr>
												            <td>Firstname</td>
												            <td><input value=\"` + firstname + `\" type='text' name='up_fname' id="up_fname" class='form-control' /></td>
												        </tr>
				                                    </div>
				                                </div>
				                                <div class="col-md-6 mb-3">
				                                    <div class="form-group">
				                                        <tr>
												            <td>Lastname</td>
												            <td><input value=\"` + lastname + `\" type='text' name='up_lname' id="up_lname" class='form-control' /></td>
												        </tr>
				                                    </div>
				                                </div>
				                            </div>
				                            <div class="form-row">
				                                <div class="col-md-6 mb-3">
				                                    <div class="form-group">
				                                        <tr>
												            <td>Email</td>
												            <td><input value=\"` + email + `\" type='text' name='up_email' id="up_email" class='form-control' /></td>
												        </tr>
				                                    </div>
				                                </div>
				                                <div class="col-md-6 mb-3">
				                                    <div class="form-group">
				                                        <tr>
												            <td>Contact Number</td>
												            <td><input value=\"` + contact_number + `\" type='text' name='up_contact_number' id="up_contact_number" class='form-control' /></td>
												        </tr>
				                                    </div>
				                                </div>
				                            </div>
				                            <div class="form-row">
				                                <div class="col-md-6 mb-3">
				                                    <div class="form-group">
				                                        <tr>
												            <td>Access Level</td>
												            <td>
																<select id="up_access_level" name="up_access_level" class="custom-select form-control">
												            		<option value=\"` + access_level + `\" >` + access_level + `</option>
						                                            <option value="superadmin">Super Admin</option>
				                                                    <option value="admin">Admin</option>
				                                                    <option value="auxilliary">Auxilliary Admin</option>
						                                        </select>
												            </td>
												        </tr>
				                                    </div>
				                                </div>
				                                <div class="col-md-6 mb-3">
				                                    <div class="form-group">
					                                    <td>Gender</td>
					                                    <td>
															<select id="up_gender" name="up_gender" class="custom-select form-control">
											            		<option value=\"` + gender + `\" >` + gender + `</option>
					                                            <option value="male">Male</option>
					                                            <option value="female">Female</option>
					                                        </select>
											            </td>
				                                    </div>
				                                </div>
				                            </div>
				                            <div class="form-row">
				                                <div class="col-md-12 mb-6">
				                                    <div class="form-group">
				                                        <tr>
												            <td>Address</td>
												            <textarea type="text" class="form-control" id="up_address" name="up_address" class='form-control'>` + address + `</textarea></td>
												        </tr>
				                                    </div>
				                                </div>
				                            </div>
				                            <div class="form-row" style="position: relative;">
				                                <div class="col-md-6 mb-6">
				                                    <div class="form-group">
				                                        <!-- <label for="up_profile_img">Choose Image</label> -->
				                                        <input required type="file" class="form-control InputBox" id="up_profile_img" placeholder="Choose Image" name="up_profile_img" onchange="encode();">
				                                    </div>
				                                </div>

				                                <div class="col-md-6 mb-6">
				                                    <div class="form-group" style="width: 80px;height: 80px;display: block;position: absolute;top: 0%;left: 0%;">
				                                        <img style="float:left;" src="` + profile_img + `" width="100%" height="100%" class="preview" />
				                                    </div>
				                                </div>

				                                <div>
											      <input id="up_id" name="up_id" value='` + up_id + `' type="hidden" />

											      <input id="up_profile_img_base64" name="up_profile_img_base64" value='` + profile_img + `' type="hidden" />
											    </div>

				                                <div class="col-md-6 mb-6">
				                                    <div class="form-group">
				                                        <div style="width: 80px;height: 80px;display: block;position: absolute;top: 0%;left: 0%;" id="targetLayer">

				                                        	<img width="100%" height="100%" class="up_admin_preview" id="up_admin_preview" src="assets/images/avatars/noimage1.png">

				                                        	
				                                        	
				                                        	<div id="up_dummy" style="width: 80px;height: 80px;display: block;position: absolute;top: 0%;left: 0%;background-image:url(assets/images/avatars/noimage1.png);background-repeat:no-repeat;background-size:cover;">
												    		</div>

				                                        	
				                                    	</div>
				                                    </div>
				                                </div>

				                            </div>
				                            <div class="col-md-12" style="position: relative;">
				                                <button class="btn btn-primary float-right" id="update_admin" name="update_admin" type="submit">Update</button>

				                                <button id="up_admin_loader" style="display: none;cursor: not-allowed;" class="btn btn-primary float-right" type="button" disabled>
				                                    <span class="spinner-border spinner-border-sm" role="status"></span>
				                                    Loading...
				                                </button>  
				                            </div></br></br></br></br></br></br>
				                        </form>
				                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;
				// inject to 'page-content' of our app
				$("#app_div").html(update_admin_html);
				 
				// chage page title
				changePageTitle("Update Admin");
			});
		});	
    });

	// trigger when registration form is submitted
	$(document).on('submit', '#update_admin_form', function(e){
		e.preventDefault();
	 	var up_id = $('#up_id').val();
	 	var up_lname = $('#up_lname').val();
        var up_fname = $('#up_fname').val();
        var up_email = $('#up_email').val();
        var up_access_level = $('#up_access_level').val();
        var up_contact_number = $('#up_contact_number').val();
        var up_gender = $('#up_gender').val();
        var up_address = $('#up_address').val();
        // var up_profile_img = $('#up_profile_img').prop('files')[0];
        // var up_profile_img = $('#up_profile_img').prop('files')[0];
        var up_profile_img_base64 = $('#up_profile_img_base64').val();
        // alert(up_profile_img_base64);
        // alert(up_id);

        if (up_lname == "" || up_fname == "" || up_email == "" || up_access_level == "" || up_contact_number == "" || up_gender == "" || up_address == "" || up_profile_img_base64 == "" || up_id == "") {
            // $('#errorAlert').slideDown(300).delay(5000).slideUp(300).html("Form inputs cannot be empty.");
            toastr.error('Form inputs cannot be empty!');
        }else{
        	// get form data
			    var obj = { "up_lname":up_lname, "up_fname":up_fname, "up_email":up_email, "up_access_level":up_access_level, "up_contact_number":up_contact_number, "up_gender":up_gender, "up_address":up_address, "_id":up_id, "up_profile_img":up_profile_img_base64 };
			    var form_data = JSON.stringify(obj);

			 	// alert(form_data);
			 	// submit form data to api
			    $.ajax({
			        url: "../../../api/admin/update.php",
			        type : "PUT",
			        dataType: 'json',
			        contentType : 'application/json',
			        data : form_data,
			        beforeSend: function(){
                        setTimeout(function () {
					        $('#update_admin').html('Loading...');
					    }, 100); 
                    },
			        success : function(result) {
			        	// alert(result.message);
			        	
			        	setTsetTimeout(function(){
			            	toastr.success(result.message);
			            	$('#update_admin').delay(3000).html('Update');
						   	// window.location.reload(true);
						}, 4000);
	            		// $("#update_admin_form")[0].reset();
	            		// document.getElementById("up_dummy").innerHTML = "";
			        },
			        error: function(xhr, resp, text){
			            // on error, tell the user sign up failed
			            setTimeout(function () {
			            	toastr.error("Unable to update admin");
					        $('#send_message').html('Update');
					    }, 4000); 
			        }
			    });
			    return false;
        }


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