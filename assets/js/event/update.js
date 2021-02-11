$(document).ready(function(){
 
    // show html form when 'update event' button was clicked
    $(document).on('click', '.update-event-button', function(){
        // get event id
		var up_event_id = $(this).attr('data-id');
		// alert(up_event_id);
		// read one record based on given event id
		$.getJSON("http://recordlabel/api/event/read_single.php?_id=" + up_event_id, function(data){	
		    // values will be used to fill out our form
		    var event_id = data.event_id;
		    var event_title = data.event_title;
		    var event_date = data.event_date;
		    // console.log(event_date);
		    var event_time = data.event_time;
		    var event_location = data.event_location;
		    var event_desc = data.event_desc;
		    var event_img = data.event_img;

		    // load list of categories
			$.getJSON("http://recordlabel/api/event/read.php", function(data){
			 
			    // build 'categories option' html
			    // loop through returned list of data
			     
			    // store 'update event' html to this variable
				var update_event_html=`
					<script>
				        function encode() {
					        var selectedfile = document.getElementById("up_event_img").files;
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
					            document.getElementById("up_event_img_base64").value = srcData;
					          }
					          fileReader.readAsDataURL(imageFile);
					        }
				    	}
				    </script>
				    <script>
					  const fileSelector = document.getElementById('up_event_img');
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
	                        <h2 class="page-title">Update event</h2>
	                    </div>
	                </div>
				    <div class="row">
	                    <div class="col-lg-8" >
	                    	
	                        <div class="row">
							    <!-- product data will be shown in this table -->
	                            <div class="card">
	                                <div class="card-body">
	                                	<!-- when clicked, it will show the product's list -->
									    <a href='all-event.php' id='read-products' class='btn btn-primary pull-right m-b-15px all_event_page' ><span class='glyphicon glyphicon-arrow-left'></span>&nbsp;Go Back
					    				</a><br>
	                                    <div class="modal-body">
					                        <form id="update_event_form" class="needs-validation" enctype="multipart/form-data" novalidate>
					                            <div class="form-row">
					                                <div class="col-md-12 mb-3">
					                                    <div class="form-group">
					                                        <tr>
													            <td>Event Title</td>
													            <td><input value=\"` + event_title + `\" type='text' name='up_event_title' id="up_event_title" class='form-control' /></td>
													        </tr>
					                                    </div>
					                                </div>
					                            </div>
					                            <div class="form-row">
					                                <div class="col-md-6 mb-3">
					                                    <div class="form-group">
					                                        <tr>
													            <td>Event Date</td>
													            <td><input value=\"` + event_date + `\" type='text' name='up_event_date' id="up_event_date" class='form-control' /></td>
													        </tr>
					                                    </div>
					                                </div>
					                                <div class="col-md-6 mb-3">
					                                    <div class="form-group">
					                                        <tr>
													            <td>Event Time</td>
													            <td><input value=\"` + event_time + `\" type='text' name='up_event_time' id="up_event_time" class='form-control' /></td>
													        </tr>
					                                    </div>
					                                </div>
					                            </div>
					                            <div class="form-row">
					                                <div class="col-md-12 mb-6">
					                                    <div class="form-group">
					                                        <tr>
													            <td>Event Location</td>
													            <textarea type="text" class="form-control" id="up_event_location" name="up_event_location" class='form-control'>` + event_location + `</textarea></td>
													        </tr>
					                                    </div>
					                                </div>
					                            </div>
					                            <div class="form-row">
					                                <div class="col-md-12 mb-6">
					                                    <div class="form-group">
					                                        <tr>
													            <td>Event Description</td>
													            <textarea type="text" class="form-control" id="up_event_desc" name="up_event_desc" class='form-control'>` + event_desc + `</textarea></td>
													        </tr>
					                                    </div>
					                                </div>
					                            </div>
					                            <div class="form-row" style="position: relative;">
					                                <div class="col-md-6 mb-6">
					                                    <div class="form-group">
					                                        <!-- <label for="up_event_img">Choose Image</label> -->
					                                        <input required type="file" class="form-control InputBox" id="up_event_img" placeholder="Choose Image" name="up_event_img" onchange="encode();">
					                                    </div>
					                                </div>

					                                <div class="col-md-6 mb-6">
					                                    <div class="form-group" style="width: 80px;height: 80px;display: block;position: absolute;top: 0%;left: 0%;z-index:999;">
					                                        <img style="float:left;" src="` + event_img + `" width="100%" height="100%" class="preview" />
					                                    </div>
					                                </div>

					                                <div>
												      <input id="up_event_id" name="up_event_id" value='` + up_event_id + `' type="hidden" />

												      <input id="up_event_img_base64" name="up_event_img_base64" value='` + event_img + `' type="hidden" />
												    </div>

					                                <div class="col-md-6 mb-6">
					                                    <div class="form-group">
					                                        <div style="width: 80px;height: 80px;display: block;position: absolute;top: 0%;left: 0%;" id="targetLayer">

					                                        	<img width="100%" height="100%" class="up_event_preview" id="up_event_preview" src="assets/images/avatars/noimage1.png">

					                                        	
					                                        	
					                                        	<div id="up_dummy" style="width: 80px;height: 80px;display: block;position: absolute;top: 0%;left: 0%;background-image:url(assets/images/avatars/noimage1.png);background-repeat:no-repeat;background-size:cover;">
													    		</div>

					                                        	
					                                    	</div>
					                                    </div>
					                                </div>
					                            </div></br>
					                            <div class="col-md-12" style="position: relative;">
					                                <button class="btn btn-primary float-right" id="update_event" name="update_event" type="submit">Update</button>

					                                <button id="up_event_loader" style="display: none;cursor: not-allowed;" class="btn btn-primary float-right" type="button" disabled>
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
					$("#app_div").html(update_event_html);
					 
					// chage page title
					changePageTitle("Update event");
			});
		});
    });

	// trigger when registration form is submitted
	$(document).on('submit', '#update_event_form', function(e){
		e.preventDefault();
	 	var up_event_id = $('#up_event_id').val();
	 	var up_event_title = $('#up_event_title').val();
        var up_event_date = $('#up_event_date').val();
        var up_event_time = $('#up_event_time').val();
        var up_event_location = $('#up_event_location').val();
        var up_event_desc = $('#up_event_desc').val();
        var regex = /^([0-9]{0,2})$/;
        // var up_event_img = $('#up_event_img').prop('files')[0];
        // var up_event_img = $('#up_event_img').prop('files')[0];
        var up_event_img_base64 = $('#up_event_img_base64').val();
        // alert(up_event_img_base64);
        // alert(up_genre);

        if (up_event_title == "" || up_event_date == "" || up_event_time == "" || up_event_location == "" || up_event_desc == "" ||up_event_img_base64 == "" || up_event_id == "") {
            // $('#errorAlert').slideDown(300).delay(5000).slideUp(300).html("Form inputs cannot be empty.");
            toastr.error('Form inputs cannot be empty!');
        }else{
   //      	const fileSelector = document.getElementById('up_event_img');
			// const fileList = event.target.files;
			// var filesize = fileSelector.files[0].size;
   //      	if(filesize>2000000) {
   //      		toastr.error('File size is greater than 2MB')
   //              return false;
   //          }

            var datePattern = /^[0-9]{2}[\/]{1}[0-9]{2}[\/]{1}[0-9]{4}$/g;
		 	up_event_date_values = up_event_date.match(datePattern);
			if (up_event_date_values == null){
				toastr.warning('Incorrect date format, use DD/MM/YYYY format!');
				return false;
			}

        	var timePattern = /^\d{2,}:\d{2}\s[APap][mM]$/;
		 	up_event_time_values = up_event_time.match(timePattern);
			if (up_event_time_values == null){
				toastr.warning('Incorrect time format, use 00:00 then space am/pm');
				return false;
			}
    											
		    var obj = {"up_event_title":up_event_title, "up_event_date":up_event_date, "up_event_time":up_event_time, "up_event_location":up_event_location, "up_event_desc":up_event_desc, "_id":up_event_id, "up_event_img":up_event_img_base64 };
		    var form_data = JSON.stringify(obj);

		 	// alert(form_data);
		 	// submit form data to api
		    $.ajax({
		        url: "../../../api/event/update.php",
		        type : "PUT",
		        dataType: 'json',
		        contentType : 'application/json',
		        data : form_data,
		        beforeSend: function(){
                    setTimeout(function () {
				        $('#update_event').html('Loading...');
				    }, 100); 
                },
		        success : function(result) {
		        	// alert(result.message);
		        	toastr.success(result.message);
		        	setTimeout(function(){
		        		$('#update_event').delay(3000).html('Update');
					   window.location.reload(true);
					}, 2000);
            		// $("#update_event_form")[0].reset();
            		// document.getElementById("up_dummy").innerHTML = "";
		        },
		        error: function(xhr, resp, text){
		            // on error, tell the user sign up failed
		            setTimeout(function () {
		            	toastr.error("Unable to update event");
				        $('#update_event').html('Update');
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