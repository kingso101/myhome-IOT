
// // jQuery codes
// $(document).ready(function(){
//     // show sign up / registration form
//     $(document).on('click', '#add_genre_page', function(){
//     	// chage page title
//         changePageTitle("Add Genre");
//         // script to show genre list
//         showGenre();
//         // calll function every 7 seconds
//         setInterval(function(){ 
// 		    showGenre();
// 		}, 7000);

//         // function to show list of products
// 	    function showGenre(){
	     
// 	        // get list of products from the A PI
// 	        $.getJSON("http://recordlabel/api/genre/read.php", function(data){
	     
// 	            // html for listing products
// 	            readGenreTemplate(data, "");
	     
// 	            // chage page title
// 	            changePageTitle("Read Genre");
	     
// 	        });
// 	    }
 
//         var html = `
//             <div class="container-fluid" id="app_div">
//                 <div class="row">
//                     <div class="col-12">
//                         <h2 class="page-title">Add Genre</h2>
//                     </div>
//                 </div>
//                 <div class="row">
//                     <div class="col-lg-8 ">
//                         <div class="row">
//                             <div class="card">
//                                 <div class="card-body">
//                                     <div id="errorAlert" style="color: #fff;" class="alert alert-danger errorAlert" role="alert">
// 		                              Incorrect password!! try again.
// 		                            </div>
// 		                            <div class="modal-body">
// 		                                <form id="add_genre_form" class="needs-validation" enctype="multipart/form-data" novalidate>
// 		                                    <div class="form-row">
// 		                                        <div class="col-md-12 mb-6">
// 		                                            <div class="form-group">
// 		                                                <label for="genre_name">Genre Type</label>
// 		                                                <input type="text" class="form-control" id="genre_name" placeholder="Genre Type" name="genre_name">
// 		                                            </div>
// 		                                        </div>
// 		                                    </div>
		                                    
// 		                                    <div class="col-md-12" style="position: relative;">
// 			                                    <button class="btn btn-primary float-right" id="add_genre" name="add_genre" type="submit">Add</button>
// 			                                    <button id="artist_loader" style="display: none;cursor: not-allowed;" class="btn btn-primary float-right" type="button" disabled>
// 			                                        <span class="spinner-border spinner-border-sm" role="status"></span>
// 			                                        Loading...
// 			                                    </button>  
// 	                                        </div></br></br></br>
// 		                                </form>
// 		                            </div>
//                                 </div>
//                             </div>
//                         </div>
//                     </div>
//                     <div class="row">
// 	                    <div class="col-lg-8" >
// 	                        <div class="row">
// 	                            <div class="card">
// 	                                <div class="card-body">
// 	                                    <div id="genreList"></div>
// 	                                </div>
// 	                            </div>
// 	                        </div>
// 	                    </div>
// 	                </div>
//                 </div>
//             </div>
//             `;
 
//         $('#dashboard_add_genre_button').html('');
//         $('#app_div').html(html);
//     });


// 	// trigger when registration form is submitted
// 	$(document).on('submit', '#add_genre_form', function(e){
// 		e.preventDefault();
// 	 	var genre_name = $('#genre_name').val();
	 	
// 	 	if(genre_name == "" ) {
//         	// $('#errorAlert').slideDown(300).delay(5000).slideUp(300).html("Form inputs cannot be empty.");
//             toastr.warning('Form inputs cannot be empty!');
//         }else{
//         	var obj = { "genre_name":genre_name };
// 			var form_data = JSON.stringify(obj);

// 		 	// alert(form_data);
// 		    // submit form data to api
// 		    $.ajax({
// 		        url: "../../../api/genre/create.php",
// 		        type : "POST",
// 		        contentType : 'application/json',
// 		        data : form_data,
// 		        beforeSend: function(){
//                     $('#add_genre').slideUp(300).delay(3000).slideDown(300);
//                     $('#artist_loader').slideDown(300).delay(3000).slideUp(300);
//                 },
// 		        success : function(result) {
// 		        	// alert(result.message);
// 		        	// console.log(result.message);
// 		            toastr.success('Genre added successfully.');
// 		            $("#add_genre_form")[0].reset();
// 		        },
// 		        error: function(xhr, resp, text){
// 		            // on error, tell the user sign up failed
// 		            toastr.error('Unable to add genre. Please contact admin.');
// 		        }
// 		    });
		 
// 		    return false;
//         }
// 	});
	 
// 	// function to make form values to json format
// 	$.fn.serializeObject = function(){
	 
// 	    var o = {};
// 	    var a = this.serializeArray();
// 	    $.each(a, function() {
// 	        if (o[this.name] !== undefined) {
// 	            if (!o[this.name].push) {
// 	                o[this.name] = [o[this.name]];
// 	            }
// 	            o[this.name].push(this.value || '');
// 	        } else {
// 	            o[this.name] = this.value || '';
// 	        }
// 	    });
// 	    return o;
// 	};
// });