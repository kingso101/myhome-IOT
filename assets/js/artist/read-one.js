$(document).ready(function(){
 
    // handle 'read one' button click
    $(document).on('click', '.read-one-artist-button', function(){
        // get product id
		var _id = $(this).attr('data-id');
		// alert(_id);
		// read product record based on given ID
		$.getJSON("http://recordlabel/api/artist/read_single.php?_id=" + _id, function(data){
		    // start html
		    // alert(data.artist_img);
		    var string = new Array();
	        string = data.social_media_link.split(", ");
	        var social_media_link = '';
	        $.each(string, function(key, data){
	            social_media_link+=`<a target='_blank' href='` + data + `'>` + data + `</a><br>`;
	        });

			var read_one_artist_html=`
			 	<div class="row">
                    <div class="col-12">
                        <h2 class="page-title">Artist Details</h2>
                    </div>
                </div>
			    <!-- when clicked, it will show the product's list -->
			    <a href='all-artist.php' id='read-products' class='btn btn-primary pull-right m-b-15px all_artist_page' ><span class='glyphicon glyphicon-arrow-left'></span>&nbsp;Go Back
			    </a>
			    <!-- product data will be shown in this table -->
				<div class="card" style="width: 38rem;">
					<div class="preview-image" style="background-image:url(../api/artist/` + data.artist_img + `);width: 400px;height:200px;background-size: contain;background-repeat: no-repeat;"></div>
				  <div class="card-body">
				    <h5 class="card-title">Artist Info</h5>
				    <p class="card-text">` + data.info + `</p>
				  </div>
				  <ul class="list-group list-group-flush">
				    <li class="list-group-item"><b>Fullname : <b/>` + data.fullname + `</li>
				    <li class="list-group-item"><b>Stage Name : <b/>` + data.stage_name + `</li>
				    <li class="list-group-item"><b>Age : <b/>` + data.age + `yrs</li>
				    <li class="list-group-item"><b>Gender : <b/>` + data.artist_gender + `</li>
				    <li class="list-group-item"><b>Music Genre : <b/>` + data.genre + `</li>
				    <li class="list-group-item"><b>Location : <b/>` + data.location + `</li>
				    <li style="float:left;" class="list-group-item"><b>Social Media Links : <b/>` + social_media_link + `</li>
				  </ul>
				</div>`;
				// inject html to 'page-content' of our app
				$("#app_div").html(read_one_artist_html);
				 
				// chage page title
				changePageTitle("Read Single Artist");
			});
    });
 
});