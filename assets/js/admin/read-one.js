$(document).ready(function(){
 
    // handle 'read one' button click
    $(document).on('click', '.read-one-admin-button', function(){
        // get product id
		var _id = $(this).attr('data-id');
		// alert(_id);
		// read product record based on given ID
		$.getJSON("http://recordlabel/api/admin/read_single.php?_id=" + _id, function(data){
		    // start html
		    // alert(data.profile_img);
		    switch (data.access_level) {
                case 'Admin':
                    access_level = `<span style="color: #fff;" class="badge badge-primary">`+data.access_level+`</span>`
                    break;
                case 'Auxiliary':
                    access_level = `<span style="color: #fff;" class="badge badge-warning">`+data.access_level+`</span>`
                    break;
                default:
                    access_level = `<span style="color: #fff;" class="badge badge-success">`+data.access_level+`</span>`
            }
			var read_one_admin_html=`
			 	<div class="row">
                    <div class="col-12">
                        <h2 class="page-title">Admin Details</h2>
                    </div>
                </div>
			    <!-- when clicked, it will show the product's list -->
			    <a href='all-admin.php' id='read-products' class='btn btn-primary pull-right m-b-15px all_admin_page' ><span class='glyphicon glyphicon-arrow-left'></span>&nbsp;Go Back
			    </a>
			    <!-- product data will be shown in this table -->
				<div class="card" style="width: 38rem;">
					<div class="preview-image" style="background-image:url(../api/admin/` + data.profile_img + `);width: 400px;height:200px;background-size: contain;background-repeat: no-repeat;"></div>
				  <div class="card-body">
				    <h5 class="card-title">Admin's Address</h5>
				    <p class="card-text">` + data.address + `</p>
				  </div>
				  <ul class="list-group list-group-flush">
				    <li class="list-group-item"><b>Fullname : <b/>` + data.fullname + `</li>
				    <li class="list-group-item"><b>Email : <b/>` + data.email + `</li>
				    <li class="list-group-item"><b>Contact No. : <b/>` + data.contact_number + `</li>
				    <li class="list-group-item"><b>Gender : <b/>` + data.gender + `</li>
				    <li class="list-group-item"><b>Access Level : <b/>` + access_level + `</li>
				    <li class="list-group-item"><b>Created On : <b/>` + data.created + `</li>
				  </ul>
				</div>`;
				// inject html to 'page-content' of our app
				$("#app_div").html(read_one_admin_html);
				 
				// chage page title
				changePageTitle("Read Single Admin");
			});
    });
 
});