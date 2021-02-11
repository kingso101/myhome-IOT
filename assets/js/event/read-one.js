$(document).ready(function(){
 
    // handle 'read one' button click
    $(document).on('click', '.read-one-event-button', function(){
        // get product id
		var _id = $(this).attr('data-id');
		// alert(_id);
		// read product record based on given ID
		$.getJSON("http://recordlabel/api/event/read_single.php?_id=" + _id, function(data){
		    // start html
		    // alert(data.event_img);
			var read_one_event_html=`
			 	<div class="row">
                    <div class="col-12">
                        <h2 class="page-title">Event Details</h2>
                    </div>
                </div>
			    <!-- when clicked, it will show the product's list -->
			    <a href='all-event.php' id='read-products' class='btn btn-primary pull-right m-b-15px all_event_page' ><span class='glyphicon glyphicon-arrow-left'></span>&nbsp;Go Back
			    </a>
			    <!-- product data will be shown in this table -->
				<div class="card" style="width: 38rem;">
					<div class="preview-image" style="background-image:url(../api/event/` + data.event_img + `);width: 400px;height:200px;background-size: contain;background-repeat: no-repeat;"></div>
				  <div class="card-body">
				    <h5 class="card-title">Event Info</h5>
				    <p class="card-text">` + data.event_desc + `</p>
				  </div>
				  <ul class="list-group list-group-flush">
				  <li class="list-group-item"><b>Event Title : <b/>` + data.event_title + `</li>
				    <li class="list-group-item"><b>Event Date : <b/>` + data.event_date + `</li>
				    <li class="list-group-item"><b>Event Time : <b/>` + data.event_time + `</li>
				    <li class="list-group-item"><b>Event Location : <b/>` + data.event_location + `</li>
				  </ul>
				</div>`;
				// inject html to 'page-content' of our app
				$("#app_div").html(read_one_event_html);
				 
				// chage page title
				changePageTitle("Read Single event");
			});
    });
 
});