
// jQuery codes
$(document).ready(function(){
    // show sign up / registration form
    $(document).on('click', '#add_artist_modal', function(){
    	// chage page title
        changePageTitle("Add Artist");

        // load list of categories
		$.getJSON("http://recordlabel/api/genre/read.php", function(data){
		 	var genre_options_html=`<select data-toggle="tooltip" data-placement="top" title="Select multiple music genre" id="genre" multiple="multiple" name="genre[]" class="custom-select form-control">
		 	<option value="" >Select Genre</option>`;
			$.each(data.records, function(key, val){
			    genre_options_html+=`<option value='` + val.genre_name + `'>` + val.genre_name + `</option>`;
			});
			genre_options_html+=`</select>`;
 
	        var html = `
	        	<script>
			        function encode() {
				        var selectedfile = document.getElementById("artist_img").files;
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
				            document.getElementById("artist_img_base64").value = srcData;
				          }
				          fileReader.readAsDataURL(imageFile);
				        }
			    	}
			    </script>
	            <div class="container-fluid" id="app_div">
	                <div class="row">
	                    <div class="col-12">
	                        <h2 class="page-title">Add Artist</h2>
	                    </div>
	                </div>
	                <div class="row">
	                    <div class="col-lg-8 >
	                        <div class="row">
	                        	<!-- when clicked, it will show the product's list -->
							    <a href='all-artist.php' id='read-products' class='btn btn-primary pull-right m-b-15px all_artist_page' ><span class='glyphicon glyphicon-arrow-left'></span>&nbsp;Go Back
		    					</a>
							    <!-- product data will be shown in this table -->
	                            <div class="card">
	                                <div class="card-body">
	                                    <div id="errorAlert" style="color: #fff;" class="alert alert-danger errorAlert" role="alert">
			                              Incorrect password!! try again.
			                            </div>
			                            <div class="modal-body">
			                                <form id="add_artist_form" class="needs-validation" enctype="multipart/form-data" novalidate>
			                                    <div class="form-row">
			                                        <div class="col-md-6 mb-3">
			                                            <div class="form-group">
			                                                <tr>
													            <td>Firstname</td>
													            <td><input type="text" class="form-control" id="fname" name="fname"></td>
													        </tr>
			                                            </div>
			                                        </div>
			                                        <div class="col-md-6 mb-3">
			                                            <div class="form-group">
			                                                <tr>
													            <td>Lastname</td>
													            <td><input type="text" class="form-control" id="lname" name="lname"></td>
													        </tr> 
			                                            </div>
			                                        </div>
			                                    </div>
			                                    <div class="form-row">
			                                        <div class="col-md-12 mb-6">
			                                            <div class="form-group">
			                                                 <tr>
													            <td>Stage Name</td>
													            <td><input type="text" class="form-control" id="stage_name" placeholder="Stage Name" name="stage_name"></td>
													        </tr>
			                                            </div>
			                                        </div>
			                                    </div>
			                                    <div class="form-row">
			                                        <div class="col-md-6 mb-3">
			                                            <div class="form-group">
			                                                 <tr>
													            <td>Age</td>
													            <td><input type="text" class="form-control" id="age" placeholder="Date Of Birth" name="age"></td>
													        </tr>
			                                            </div>
			                                        </div>
			                                        <div class="col-md-6 mb-3">
			                                            <div class="form-group">
			                                                 <tr>
													            <td>Location</td>
													            <td><input type="text" class="form-control" id="location" placeholder="Location" name="location"></td>
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
													            	<select id="artist_gender" name="artist_gender" class="custom-select form-control">
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
												            <td>Genre</td>
												            <td>` + genre_options_html + `</td>
												        </tr></div>
			                                        </div>
			                                    </div>
			                                    <div class="form-row">
			                                        <div class="col-md-12 mb-6">
			                                            <div class="form-group">
			                                                <tr>
													            <td>Social Media Link</td>
													            <td><input data-toggle="tooltip" data-placement="top" title="Multiple social media links should be sepreated by coma (,)" type="text" class="form-control" id="social_media_link" name="social_media_link"></td>
													        </tr>
			                                            </div>
			                                        </div>
			                                    </div>
			                                    <div class="form-row">
			                                        <div class="col-md-12 mb-6">
			                                            <div class="form-group">
			                                                <tr>
													            <td>Location</td>
													            <td><textarea type="text" class="form-control" id="info" name="info"></textarea></td>
													        </tr>
			                                            </div>
			                                        </div>
			                                    </div>
			                                    <div class="form-row" style="position: relative;">
			                                        <div class="col-md-6 mb-6">
			                                            <div class="form-group">
			                                                <!-- <label for="artist_img">Choose Image</label> -->
			                                                <input required type="file" class="form-control InputBox" id="artist_img" placeholder="Choose Image" name="artist_img" onchange="encode();">
			                                            </div>
			                                        </div>

			                                        <div>
												      <input id="artist_img_base64" name="artist_img_base64" type="hidden" />
												    </div>

			                                        <div class="col-md-6 mb-6">
			                                            <div class="form-group">
				                                            <div id="dummy" style="width: 80px;height: 80px;display: block;position: absolute;top: 0%;left: 0%;background-image:url(assets/images/avatars/noimage1.png);background-repeat:no-repeat;background-size:cover;">
													    	</div>
			                                            </div>
			                                        </div>

			                                    </div>
			                                    <div class="col-md-12" style="position: relative;">
				                                    <button class="btn btn-primary float-right" id="add_artist" name="add_artist" type="submit">Add</button>
				                                    <button id="artist_loader" style="display: none;cursor: not-allowed;" class="btn btn-primary float-right" type="button" disabled>
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
 
	        $('#dashboard_add_artist_button').html('');
	        $('#app_div').html(html);
	    });
    });
	
	// trigger when registration form is submitted
	$(document).on('submit', '#add_artist_form', function(e){
		e.preventDefault();
	 	var lname = $('#lname').val();
        var fname = $('#fname').val();
        var stage_name = $('#stage_name').val();
        var age = $('#age').val();
        var location = $('#location').val();
        var artist_gender = $('#artist_gender').val();
        var social_media_link = $('#social_media_link').val();
        var genre = $('#genre').val();
        var info = $('#info').val();
        var regex = /^([0-9]{0,2})$/;
        // var artist_img = $('#artist_img').prop('files')[0];
        // var artist_img = $('#artist_img').prop('files')[0];
        var artist_img_base64 = $('#artist_img_base64').val();
        // var artist_img = $('#artist_img')[0].files[0].name;
        // alert(artist_img_base64);

        if (lname == "" || fname == "" || stage_name == "" || age == "" || location == "" || social_media_link == "" || artist_gender == "" || genre == "" || info == "" || artist_img_base64 == "") {
            // $('#errorAlert').slideDown(300).delay(5000).slideUp(300).html("Form inputs cannot be empty.");
            toastr.error('Form inputs cannot be empty!');
        }else{
        	const fileSelector = document.getElementById('artist_img');
			const fileList = event.target.files;
			var filesize = fileSelector.files[0].size;
            if(filesize>2000000) {
                // $('#errorAlert').slideDown(300).delay(5000).slideUp(300).html("File size is greater than 2MB");
                toastr.warning('File size is greater than 2MB')
                return false;
            }else{

            	if(!regex.test(age)) {
			        toastr.warning('Age must not be more than 2 digits!')
			    }else{
			    	// get form data
				    // var add_artist_form=$(this);
				    // var form_data=JSON.stringify(add_artist_form.serializeObject());

				    var obj = { "lname":lname, "fname":fname, "stage_name":stage_name, "age":age, "location":location, "social_media_link":social_media_link, "artist_gender":artist_gender, "genre":genre, "info":info, "artist_img":artist_img_base64 };
				    var form_data = JSON.stringify(obj);

				 	// alert(form_data);
				    // submit form data to api
				    $.ajax({
				        url: "../../../api/artist/create.php",
				        type : "POST",
				        contentType : 'application/json',
				        data : form_data,
				        beforeSend: function(){
		                    setTimeout(function () {
						        $('#add_artist').html('Loading...');
						    }, 100); 
		                },
				        success : function(result) {
				        	// alert(result.message);
				        	// console.log(result.message);
				            // if response is a success, tell the user it was a successful sign up & empty the input boxes
				            toastr.success(result.message);
		            		$("#add_artist_form")[0].reset();
		            		document.getElementById("dummy").innerHTML = "";
		            		setTimeout(function(){
				            	$('#add_artist').delay(3000).html('Add');
							   	// window.location.reload(true);
							}, 4000);
				        },
				        error: function(xhr, resp, text){
				            // on error, tell the user sign up failed
				            setTimeout(function () {
				            	toastr.error(result.message);
						        $('#add_artist').html('Add');
						    }, 4000); 
				        }
				    });
				 
				    return false;
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