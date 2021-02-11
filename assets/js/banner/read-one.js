$(document).ready(function(){
 
    // handle 'read one' button click
    $(document).on('click', '.read-one-banner-button', function(){
        // get product id
		var _id = $(this).attr('data-id');
		// alert(_id);
		// read product record based on given ID
		$.getJSON("http://recordlabel/api/banner/read_single.php?_id=" + _id, function(data){
		    // start html
		    // alert(data.banner_img);
		   
			var read_one_banner_html=`
			 	<div class="row">
                    <div class="col-12">
                        <h2 class="page-title">Banner Details</h2>
                    </div>
                </div>
			    <!-- when clicked, it will show the product's list -->
			    <a href='all-banner.php' id='read-products' class='btn btn-primary pull-right m-b-15px all_banner_page' ><span class='glyphicon glyphicon-arrow-left'></span>&nbsp;Go Back
			    </a>
			    <!-- product data will be shown in this table -->
				<div class="card" style="width: 38rem;">
					<div class="preview-image" style="background-image:url(../api/banner/` + data.banner_img + `);width: 450px;height:200px;background-size: contain;background-repeat: no-repeat;"></div>
				  <div class="card-body">
				    <h5 class="card-title">Banner Title</h5>
				    <p class="card-text">` + data.banner_title + `</p>
				  </div>
				</div>`;
				// inject html to 'page-content' of our app
				$("#app_div").html(read_one_banner_html);
				 
				// chage page title
				changePageTitle("Read Single Banner");
			});
    });
 
});