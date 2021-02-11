$(document).ready(function(){
 
    // show html form when 'update release' button was clicked
    $(document).on('click', '.update-release-button', function(){
        // get release id
		var up_release_id = $(this).attr('data-id');
		// alert(up_release_id);
		// read one record based on given release id
		$.getJSON("http://recordlabel/api/release/read_single.php?_id=" + up_release_id, function(data){	
		    // values will be used to fill out our form
		    var release_id = data.release_id;
		    var release_title = data.release_title;
		    var release_date = data.release_date;
		    // console.log(release_date);
		    var artist = data.artist;
		    var producer = data.producer;
		    var genre = data.genre;
		    var release_info = data.release_info;
		    var media_link = data.media_link;
		    var release_img = data.release_img;

		    // load list of genre categories
			$.getJSON("http://recordlabel/api/artist/read.php", function(data){
				// loop through returned list of data
		        var artist_options_html=`<tr>
				            <td>Artist : ` + artist + `</td>
				            <td><select data-toggle="tooltip" data-placement="top" title="Select multiple music artist" id="up_artist" multiple="multiple" name="up_artist[]" class='form-control'>`;
		 
			        $.each(data.records, function(key, val){
			            // pre-select option is artist id is the same
			            // console.log(data.records);
			            var patt = new RegExp(val.stage_name);
					  	var res = patt.test(artist);
					  	for(var i = 0; i < res.length; i++){
					  		if(res[i] == val.stage_name){ 
				            	artist_options_html+=`<option value='` + val.stage_name + `' selected>` + val.stage_name + `</option>`;
				            }
				        }
				        artist_options_html+=`<option value='` + val.stage_name + `'>` + val.stage_name + `</option>`;	
			        });
		        artist_options_html+=`</select></td></tr>`;
			

			// load list of genre categories
			$.getJSON("http://recordlabel/api/genre/read.php", function(data){
			    // build 'categories option' html
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
			     
			    // store 'update release' html to this variable
				var update_release_html=`
					<script>
				        function encode() {
					        var selectedfile = document.getElementById("up_release_img").files;
					        if (selectedfile.length > 0) {
					          var imageFile = selectedfile[0];
					          var fileReader = new FileReader();
					          fileReader.onload = function(fileLoadedrelease) {
					            var srcData = fileLoadedrelease.target.result;
					            var newImage = document.createElement('img');
					            newImage.style.width = "100%";
								newImage.style.height = "100%";
					            newImage.src = srcData;
					            document.getElementById("up_dummy").innerHTML = newImage.outerHTML;
					            document.getElementById("up_release_img_base64").value = srcData;
					          }
					          fileReader.readAsDataURL(imageFile);
					        }
				    	}
				    </script>
				    <script>
					  const fileSelector = document.getElementById('up_release_img');
					  fileSelector.addreleaseListener('change', (release) => {
					    const fileList = release.target.files;
					    var filesize = fileSelector.files[0].size;
					    if(filesize>2000000) {
					    	toastr.error('File size is greater than 2MB')
					    }
					  });
					</script>
				    <div class="row">
	                    <div class="col-12">
	                        <h2 class="page-title">Update Album/Track</h2>
	                    </div>
	                </div>
				    <div class="row">
	                    <div class="col-lg-8 ">
	                        <div class="row">
							    <!-- product data will be shown in this table -->
	                            <div class="card">
	                                <div class="card-body">
	                                	<!-- when clicked, it will show the product's list -->
									    <a href='all-releases.php' id='read-products' class='btn btn-primary pull-right m-b-15px all_release_page' ><span class='glyphicon glyphicon-arrow-left'></span>&nbsp;Go Back
					    				</a></br>
	                                    <div class="modal-body">
					                        <form id="update_release_form" class="needs-validation" enctype="multipart/form-data" novalidate>
					                            <div class="form-row">
					                                <div class="col-md-12 mb-3">
					                                    <div class="form-group">
					                                        <tr>
													            <td>Album/Track Title</td>
													            <td><input value=\"` + release_title + `\" type='text' name='up_release_title' id="up_release_title" class='form-control' /></td>
													        </tr>
					                                    </div>
					                                </div>
					                            </div>
					                            <div class="form-row">
					                                <div class="col-md-6 mb-3">
					                                    <div class="form-group">
					                                        <tr>
													            <td><div class="form-group">` + artist_options_html + `</div></td>
													        </tr>
					                                    </div>
					                                </div>
					                                <div class="col-md-6 mb-3">
					                                    <div class="form-group">
					                                        <tr>
													            <td>Artist</td>
													            <td><input value=\"` + producer + `\" type='text' name='up_producer' id="up_producer" class='form-control' /></td>
													        </tr>
					                                    </div>
					                                </div>
					                            </div>
					                            <div class="form-row">
					                                <div class="col-md-6 mb-3">
					                                    <div class="form-group">
					                                        <tr>
													            <td>Release Date</td>
													            <td><input value=\"` + release_date + `\" type='text' name='up_release_date' id="up_release_date" class='form-control' /></td>
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
													            <td> Media Links</td>
													            <td><input data-toggle="tooltip" data-placement="top" title="Multiple social media links should be sepreated by coma (,)" type="text" class="form-control" id="up_media_link" value=\"` + media_link + `\ name="up_media_link"></td>
													        </tr>
			                                            </div>
			                                        </div>
			                                    </div>
					                            <div class="form-row">
					                                <div class="col-md-12 mb-6">
					                                    <div class="form-group">
					                                        <tr>
													            <td>Release Description</td>
													            <textarea type="text" class="form-control" id="up_release_info" name="up_release_info" class='form-control'>` + release_info + `</textarea></td>
													        </tr>
					                                    </div>
					                                </div>
					                            </div>
					                            <div class="form-row" style="position: relative;">
					                                <div class="col-md-6 mb-6">
					                                    <div class="form-group">
					                                        <!-- <label for="up_release_img">Choose Image</label> -->
					                                        <input required type="file" class="form-control InputBox" id="up_release_img" placeholder="Choose Image" name="up_release_img" onchange="encode();">
					                                    </div>
					                                </div>

					                                <div class="col-md-6 mb-6">
					                                    <div class="form-group" style="width: 80px;height: 80px;display: block;position: absolute;top: 0%;left: 0%;z-index:999;">
					                                        <img style="float:left;" src="` + release_img + `" width="100%" height="100%" class="preview" />
					                                    </div>
					                                </div>

					                                <div>
												      <input id="up_id" name="up_id" value='` + up_release_id + `' type="hidden" />

												      <input id="up_release_img_base64" name="up_release_img_base64" value='` + release_img + `' type="hidden" />
												    </div>

					                                <div class="col-md-6 mb-6">
					                                    <div class="form-group">
					                                        <div style="width: 80px;height: 80px;display: block;position: absolute;top: 0%;left: 0%;" id="targetLayer">

					                                        	<img width="100%" height="100%" class="up_release_preview" id="up_release_preview" src="assets/images/avatars/noimage1.png">

					                                        	
					                                        	
					                                        	<div id="up_dummy" style="width: 80px;height: 80px;display: block;position: absolute;top: 0%;left: 0%;background-image:url(assets/images/avatars/noimage1.png);background-repeat:no-repeat;background-size:cover;">
													    		</div>

					                                        	
					                                    	</div>
					                                    </div>
					                                </div>
					                            </div></br>
					                            <div class="col-md-12" style="position: relative;">
					                                <button class="btn btn-primary float-right" id="update_release" name="update_release" type="submit">Update</button>

					                                <button id="up_release_loader" style="display: none;cursor: not-allowed;" class="btn btn-primary float-right" type="button" disabled>
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
					$("#app_div").html(update_release_html);
					 
					// chage page title
					changePageTitle("Update release");
				});
			});
		});
    });

	// trigger when registration form is submitted
	$(document).on('submit', '#update_release_form', function(e){
		e.preventDefault();
		// alert('Hey');
	 	var up_id = $('#up_id').val();
	 	var up_release_title = $('#up_release_title').val();
	 	var up_artist = $('#up_artist').val();
	 	var up_producer = $('#up_producer').val();
	 	var up_genre = $('#up_genre').val();
	 	var up_release_date = $('#up_release_date').val();
	 	var up_release_info = $('#up_release_info').val();
	 	var up_media_link = $('#up_media_link').val();
        var up_release_img_base64 = $('#up_release_img_base64').val();
        // alert(up_release_img_base64);
        // alert(up_id);

        if (up_release_title == "" || up_artist == "" || up_producer == "" || up_genre == "" || up_release_date == "" || up_release_info == "" ||up_media_link == "" || up_release_img_base64 == "" || up_id == "") {
            // $('#errorAlert').slideDown(300).delay(5000).slideUp(300).html("Form inputs cannot be empty.");
            toastr.error('Form inputs cannot be empty!');
        }else{
        	// get form data
		    var obj = {"up_release_title":up_release_title, "up_artist":up_artist, "up_producer":up_producer, "up_genre":up_genre, "up_release_date":up_release_date, "up_release_info":up_release_info,"up_media_link":up_media_link, "_id":up_id, "up_release_img":up_release_img_base64 };
		    var form_data = JSON.stringify(obj);

		 	// alert(form_data);
		 	// submit form data to api
		    $.ajax({
		        url: "../../../api/release/update.php",
		        type : "PUT",
		        dataType: 'json',
		        contentType : 'application/json',
		        data : form_data,
		        beforeSend: function(){
                    setTimeout(function () {
				        $('#update_release').html('Loading...');
				    }, 100); 
                },
		        success : function(result) {
		        	// alert(result.message);
		        	toastr.success(result.message);
		        	setTimeout(function(){
		        		$('#add_release').delay(3000).html('Update');
					   window.location.reload(true);
					}, 2000);
            		// $("#update_release_form")[0].reset();
            		// document.getElementById("up_dummy").innerHTML = "";
		        },
		        error: function(xhr, resp, text){
		            // on error, tell the user sign up failed
		            setTimeout(function () {
		            	toastr.error("Unable to update album/track");
				        $('#update_release').html('Update');
				    }, 4000); 
		        }
		    });
		    return false;
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