$(document).ready(function(){
 
    // show html form when 'update banner' button was clicked
    $(document).on('click', '.update-banner-button', function(){
        // get banner id
		var up_id = $(this).attr('data-id');
		// alert(up_id);
		// read one record based on given banner id
		$.getJSON("http://recordlabel/api/banner/read_single.php?_id=" + up_id, function(data){	
		    // values will be used to fill out our form
		    // var id = data.id;
		    var banner_title = data.banner_title;
		    var banner_img = data.banner_img;

		    // load list of categories
		    // store 'update banner' html to this variable
			var update_banner_html=`
				<script>
			        function encode() {
				        var selectedfile = document.getElementById("up_banner_img").files;
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
				            document.getElementById("up_banner_img_base64").value = srcData;
				          }
				          fileReader.readAsDataURL(imageFile);
				        }
			    	}
			    </script>
			    <script>
				  const fileSelector = document.getElementById('up_banner_img');
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
                        <h2 class="page-title">Update banner</h2>
                    </div>
                </div>
			    <div class="row">
                    <div class="col-lg-8 >
                        <div class="row">
						    <!-- product data will be shown in this table -->
                            <div class="card">
                                <div class="card-body">
                                	<!-- when clicked, it will show the product's list -->
							    	<a href='all-banner.php' id='read-products' class='btn btn-primary pull-right m-b-15px all_banner_page'><span class='glyphicon glyphicon-arrow-left'></span>&nbsp;Go Back
				    				</a><br>
                                    <div class="modal-body">
				                        <form id="update_banner_form" class="needs-validation" enctype="multipart/form-data" novalidate>
				                            <div class="form-row">
				                                <div class="col-md-12 mb-6">
				                                    <div class="form-group">
				                                        <tr>
												            <td>Banner Title</td>
												            <td><input value=\"` + banner_title + `\" type='text' name='up_banner_title' id="up_banner_title" class='form-control' /></td>
												        </tr>
				                                    </div>
				                                </div>
				                            </div>
				                            <div class="form-row" style="position: relative;">
				                                <div class="col-md-6 mb-6">
				                                    <div class="form-group">
				                                        <!-- <label for="up_banner_img">Choose Image</label> -->
				                                        <input required type="file" class="form-control InputBox" id="up_banner_img" placeholder="Choose Image" name="up_banner_img" onchange="encode();">
				                                    </div>
				                                </div>

				                                <div class="col-md-6 mb-6">
				                                    <div class="form-group" style="width: 80px;height: 80px;display: block;position: absolute;top: 0%;left: 0%;">
				                                        <img style="float:left;" src="` + banner_img + `" width="100%" height="100%" class="preview" />
				                                    </div>
				                                </div>

				                                <div>
											      <input id="up_id" name="up_id" value='` + up_id + `' type="hidden" />

											      <input id="up_banner_img_base64" name="up_banner_img_base64" value='` + banner_img + `' type="hidden" />
											    </div>

				                                <div class="col-md-6 mb-6">
				                                    <div class="form-group">
				                                        <div style="width: 80px;height: 80px;display: block;position: absolute;top: 0%;left: 0%;z-index:999;" id="targetLayer">

				                                        	<img width="100%" height="100%" class="up_banner_preview" id="up_banner_preview" src="assets/images/avatars/noimage1.png">

				                                        	
				                                        	
				                                        	<div id="up_dummy" style="width: 80px;height: 80px;display: block;position: absolute;top: 0%;left: 0%;background-image:url(assets/images/avatars/noimage1.png);background-repeat:no-repeat;background-size:cover;">
												    		</div>

				                                        	
				                                    	</div>
				                                    </div>
				                                </div>

				                            </div>
				                            <div class="col-md-12" style="position: relative;">
				                                <button class="btn btn-primary float-right" id="update_banner" name="update_banner" type="submit">Update</button>

				                                <button id="up_banner_loader" style="display: none;cursor: not-allowed;" class="btn btn-primary float-right" type="button" disabled>
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
				$("#app_div").html(update_banner_html);
				 
				// chage page title
				changePageTitle("Update banner");
			});
		});	
    });

	// trigger when registration form is submitted
	$(document).on('submit', '#update_banner_form', function(e){
		e.preventDefault();
	 	var up_id = $('#up_id').val();
	 	var up_banner_title = $('#up_banner_title').val();
        var up_banner_img_base64 = $('#up_banner_img_base64').val();
        // alert(up_banner_img_base64);
        // alert(up_id);

        if (up_banner_title == "" || up_banner_img_base64 == "" || up_id == "") {
            // $('#errorAlert').slideDown(300).delay(5000).slideUp(300).html("Form inputs cannot be empty.");
            toastr.error('Form inputs cannot be empty!');
        }else{
        	// get form data
			    var obj = {"up_banner_title":up_banner_title, "_id":up_id, "up_banner_img":up_banner_img_base64 };
			    var form_data = JSON.stringify(obj);

			 	// alert(form_data);
			 	// submit form data to api
			    $.ajax({
			        url: "../../../api/banner/update.php",
			        type : "PUT",
			        dataType: 'json',
			        contentType : 'application/json',
			        data : form_data,
			        beforeSend: function(){
	                    setTimeout(function () {
					        $('#update_banner').html('Loading...');
					    }, 100); 
	                },
			        success : function(result) {
			        	// alert(result.message);
			        	toastr.success(result.message);
			        	setTimeout(function(){
			        		$('#add_banner').delay(3000).html('Update');
						   window.location.reload(true);
						}, 2000);
	            		// $("#update_banner_form")[0].reset();
	            		// document.getElementById("up_dummy").innerHTML = "";
			        },
			        error: function(xhr, resp, text){
			            // on error, tell the user sign up failed
			            setTimeout(function () {
			            	toastr.error("Unable to update banner");
					        $('#update_banner').html('Update');
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