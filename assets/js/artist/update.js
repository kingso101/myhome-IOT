$(document).ready(function(){
 
    // show html form when 'update artist' button was clicked
    $(document).on('click', '.update-artist-button', function(){
        // get artist id
		var up_id = $(this).attr('data-id');
		// alert(up_id);
		// read one record based on given artist id
		$.getJSON("http://recordlabel/api/artist/read_single.php?_id=" + up_id, function(data){	
		    // values will be used to fill out our form
		    var artist_id = data.artist_id;
		    var firstname = data.firstname;
		    var lastname = data.lastname;
		    var fullname = data.fullname;
		    var stage_name = data.stage_name;
		    var info = data.info;
		    var artist_gender = data.artist_gender;
		    var age = data.age;
		    var genre = data.genre;
		    var location = data.location;
		    var social_media_link = data.social_media_link;
		    var artist_img = data.artist_img;
		    var res = genre.split(", ");

		    // load list of categories
			$.getJSON("http://recordlabel/api/genre/read.php", function(data){
			 
			    // build 'categories option' html
			    // loop through returned list of data
		        var genre_options_html=`<tr>
				            <td>Genre : ` + genre + `</td>
				            <td><select data-toggle="tooltip" data-placement="top" title="Select multiple music genre" id="up_genre" multiple="multiple" name="up_genre[]" class='form-control'>`;
		 
		        $.each(data.records, function(key, val){
		            // pre-select option is genre id is the same
		            // console.log(data.records);
		            var patt = new RegExp(val.genre_name);
				  	var res = patt.test(genre);
				  	for(var i = 0; i < res.length; i++){
				  		if(res[i] == val.genre_name){ 
			            	genre_options_html+=`<option value='` + val.genre_name + `' selected>` + val.genre_name + `</option>`;
			            }
			        }
			        genre_options_html+=`<option value='` + val.genre_name + `'>` + val.genre_name + `</option>`;	
		        });
		        genre_options_html+=`</select></td></tr>`;
			     
			    // store 'update artist' html to this variable
				var update_artist_html=`
					<script>
				        function encode() {
					        var selectedfile = document.getElementById("up_artist_img").files;
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
					            document.getElementById("up_artist_img_base64").value = srcData;
					          }
					          fileReader.readAsDataURL(imageFile);
					        }
				    	}
				    </script>
				    <script>
					  const fileSelector = document.getElementById('up_artist_img');
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
	                        <h2 class="page-title">Update Artist</h2>
	                    </div>
	                </div>
				    <div class="row">
	                    <div class="col-lg-8 ">
	                        <div class="row">
							    <!-- product data will be shown in this table -->
	                            <div class="card">
	                                <div class="card-body">
	                               		<!-- when clicked, it will show the product's list -->
										<a href='all-artist.php' id='read-products' class='btn btn-primary pull-right m-b-15px all_artist_page' ><span class='glyphicon glyphicon-arrow-left'></span>&nbsp;Go Back
						    			</a><br>
	                                    <div class="modal-body">
					                        <form id="update_artist_form" class="needs-validation" enctype="multipart/form-data" novalidate>
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
					                                <div class="col-md-12 mb-6">
					                                    <div class="form-group">
					                                        <tr>
													            <td>Stage Name</td>
													            <td><input value=\"` + stage_name + `\" type='text' name='up_stage_name' id="up_stage_name" class='form-control' /></td>
													        </tr>
					                                    </div>
					                                </div>
					                            </div>
					                            <div class="form-row">
					                                <div class="col-md-6 mb-3">
					                                    <div class="form-group">
					                                        <tr>
													            <td>Age</td>
													            <td><input value=\"` + age + `\" type='text' name='up_age' id="up_age" class='form-control' /></td>
													        </tr>
					                                    </div>
					                                </div>
					                                <div class="col-md-6 mb-3">
					                                    <div class="form-group">
					                                        <tr>
													            <td>Location</td>
													            <td><input value=\"` + location + `\" type='text' name='up_location' id="up_location" class='form-control' /></td>
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
																	<select id="up_artist_gender" name="up_artist_gender" class="custom-select form-control">
													            		<option value=\"` + artist_gender + `\" >` + artist_gender + `</option>
							                                            <option value="male">Male</option>
							                                            <option value="female">Female</option>
							                                        </select>
													            </td>
													        </tr>
					                                    </div>
					                                </div>
					                                <div class="col-md-6 mb-3">
					                                    <div class="form-group">` + genre_options_html + `</div>
					                                </div>
					                            </div>
					                            <div class="form-row">
			                                        <div class="col-md-12 mb-6">
			                                            <div class="form-group">
			                                                <tr>
													            <td>Social Media Link</td>
													            <td><input data-toggle="tooltip" data-placement="top" title="Multiple social media links should be sepreated by coma (,)" type="text" class="form-control" id="up_social_media_link" value=\"` + social_media_link + `\ name="up_social_media_link"></td>
													        </tr>
			                                            </div>
			                                        </div>
			                                    </div>
					                            <div class="form-row">
					                                <div class="col-md-12 mb-6">
					                                    <div class="form-group">
					                                        <tr>
													            <td>Info</td>
													            <textarea type="text" class="form-control" id="up_info" name="up_info" class='form-control'>` + info + `</textarea></td>
													        </tr>
					                                    </div>
					                                </div>
					                            </div>
					                            <div class="form-row" style="position: relative;">
					                                <div class="col-md-6 mb-6">
					                                    <div class="form-group">
					                                        <!-- <label for="up_artist_img">Choose Image</label> -->
					                                        <input required type="file" class="form-control InputBox" id="up_artist_img" placeholder="Choose Image" name="up_artist_img" onchange="encode();">
					                                    </div>
					                                </div>

					                                <div class="col-md-6 mb-6">
					                                    <div class="form-group" style="width: 80px;height: 80px;display: block;position: absolute;top: 0%;left: 0%;z-index:999;">
					                                        <img style="float:left;" src="` + artist_img + `" width="100%" height="100%" class="preview" />
					                                    </div>
					                                </div>

					                                <div>
												      <input id="up_id" name="up_id" value='` + up_id + `' type="hidden" />

												      <input id="up_artist_img_base64" name="up_artist_img_base64" value='` + artist_img + `' type="hidden" />
												    </div>

					                                <div class="col-md-6 mb-6">
					                                    <div class="form-group">
					                                        <div style="width: 80px;height: 80px;display: block;position: absolute;top: 0%;left: 0%;" id="targetLayer">

					                                        	<img width="100%" height="100%" class="up_artist_preview" id="up_artist_preview" src="assets/images/avatars/noimage1.png">

					                                        	
					                                        	
					                                        	<div id="up_dummy" style="width: 80px;height: 80px;display: block;position: absolute;top: 0%;left: 0%;background-image:url(assets/images/avatars/noimage1.png);background-repeat:no-repeat;background-size:cover;">
													    		</div>

					                                        	
					                                    	</div>
					                                    </div>
					                                </div>
					                            </div></br>
					                            <div class="col-md-12" style="position: relative;">
					                                <button class="btn btn-primary float-right" id="update_artist" name="update_artist" type="submit">Update</button>

					                                <button id="up_artist_loader" style="display: none;cursor: not-allowed;" class="btn btn-primary float-right" type="button" disabled>
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
					$("#app_div").html(update_artist_html);
					 
					// chage page title
					changePageTitle("Update Artist");
			});
		});
    });

	// trigger when registration form is submitted
	$(document).on('submit', '#update_artist_form', function(e){
		e.preventDefault();
	 	var up_id = $('#up_id').val();
	 	var up_lname = $('#up_lname').val();
        var up_fname = $('#up_fname').val();
        var up_stage_name = $('#up_stage_name').val();
        var up_age = $('#up_age').val();
        var up_location = $('#up_location').val();
        var up_artist_gender = $('#up_artist_gender').val();
        var up_social_media_link = $('#up_social_media_link').val();
        var up_genre = $('#up_genre').val();
        var up_info = $('#up_info').val();
        var regex = /^([0-9]{0,2})$/;
        // var up_artist_img = $('#up_artist_img').prop('files')[0];
        // var up_artist_img = $('#up_artist_img').prop('files')[0];
        var up_artist_img_base64 = $('#up_artist_img_base64').val();
        // alert(up_artist_img_base64);
        // alert(up_genre);

        if (up_lname == "" || up_fname == "" || up_stage_name == "" || up_age == "" || up_location == "" || up_social_media_link == "" || up_artist_gender == "" || up_genre == "" || up_info == "" || up_artist_img_base64 == "" || up_id == "") {
            // $('#errorAlert').slideDown(300).delay(5000).slideUp(300).html("Form inputs cannot be empty.");
            toastr.error('Form inputs cannot be empty!');
        }else{
   //      	const fileSelector = document.getElementById('up_artist_img');
			// const fileList = event.target.files;
			// var filesize = fileSelector.files[0].size;
   //      	if(filesize>2000000) {
   //      		toastr.error('File size is greater than 2MB')
   //              return false;
   //          }

            if(!regex.test(up_age)) {
		        toastr.warning('Age must not be more than 2 digits!')
		    }else{
		    	// get form data
			    var obj = { "up_lname":up_lname, "up_fname":up_fname, "up_stage_name":up_stage_name, "up_age":up_age, "up_location":up_location, "up_artist_gender":up_artist_gender, "up_genre":up_genre, "up_info":up_info, "up_social_media_link":up_social_media_link, "_id":up_id, "up_artist_img":up_artist_img_base64 };
			    var form_data = JSON.stringify(obj);

			 	// alert(form_data);
			 	// submit form data to api
			    $.ajax({
			        url: "../../../api/artist/update.php",
			        type : "PUT",
			        dataType: 'json',
			        contentType : 'application/json',
			        data : form_data,
			        beforeSend: function(){
	                    setTimeout(function () {
					        $('#update_artist').html('Loading...');
					    }, 100); 
	                },
			        success : function(result) {
			        	// alert(result.message);
			        	toastr.success(result.message);
			        	setTimeout(function(){
			        		$('#add_artist').delay(3000).html('Update');
						   window.location.reload(true);
						}, 2000);
	            		// $("#update_artist_form")[0].reset();
	            		// document.getElementById("up_dummy").innerHTML = "";
			        },
			        error: function(xhr, resp, text){
				            // on error, tell the user sign up failed
			            setTimeout(function () {
			            	toastr.error("Unable to update artist");
					        $('#update_artist').html('Update');
					    }, 4000); 
			        }
			    });
			    return false;
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