$(document).ready(function(){
 
    // handle 'read one' button click
    $(document).on('click', '.read-one-release-button', function(){
        // get product id
		var _id = $(this).attr('data-id');
		// alert(_id);
		// read product record based on given ID
		$.getJSON("http://recordlabel/api/release/read_single.php?_id=" + _id, function(data){
		    // start html
		    // alert(data.release_img);
		    var string = new Array();
	        string = data.media_link.split(", ");
	        var media_link = '';
	        $.each(string, function(key, data){
	            media_link+=`<a target='_blank' href='` + data + `'>` + data + `</a><br>`;
	        });

			var read_one_release_html=`
			 	<div class="row">
                    <div class="col-12">
                        <h2 class="page-title">release Details</h2>
                    </div>
                </div>
			    <!-- when clicked, it will show the product's list -->
			    <a href='all-releases.php' id='read-products' class='btn btn-primary pull-right m-b-15px all_release_page' ><span class='glyphicon glyphicon-arrow-left'></span>&nbsp;Go Back
			    </a>
			    <!-- product data will be shown in this table -->
				<div class="card" style="width: 38rem;">
					<div class="preview-image" style="background-image:url(../api/release/` + data.release_img + `);width: 400px;height:200px;background-size: contain;background-repeat: no-repeat;"></div>
				  <div class="card-body">
				    <h5 class="card-title">Release Info</h5>
				    <p class="card-text">` + data.release_info + `</p>
				  </div>
				  <ul class="list-group list-group-flush">
				  <li class="list-group-item"><b>Release Title : <b/>` + data.release_title + `</li>
				    <li class="list-group-item"><b>Release Date : <b/>` + data.release_date + `</li>
				    <li class="list-group-item"><b>Artist : <b/>` + data.artist + `</li>
				    <li class="list-group-item"><b>Producer : <b/>` + data.producer + `</li>
				    <li class="list-group-item"><b>Album/Track Genre : <b/>` + data.genre + `</li>
				    <li class="list-group-item"><b>Album/Created : <b/>` + data.created + `</li>
				    <li class="list-group-item"><b>Media Links : <b/>` + media_link + `</li>
				  </ul>
				</div>`;
				// inject html to 'page-content' of our app
				$("#app_div").html(read_one_release_html);
				 
				// chage page title
				changePageTitle("Read Single album/tracks");
			});
    });
 
});