// // product list html
// function readArtistTemplate(data, keywords){
 
//     var read_artist_html=`
//         <div class="container-fluid" id="app_div">
//                 <div class="row">
//                     <div class="col-12">
//                         <h2 class="page-title">All Artist</h2>
//                     </div>
//                 </div>
//                 <div class="row">
//                     <div class="col-lg-12" >
//                         <div class="row">
//                             <div class="card">
//                                 <div class="card-body">
//                                     <div class="table-container">
//                                         <div class="table-responsive">
//                                             <table class="table">
//                                                 <thead>
//                                                     <tr>
//                                                         <th scope="col">S/N</th>
//                                                         <th style="width:8%;" scope="col">Fullname</th>
//                                                         <th scope="col">Stage Name</th>
//                                                         <th style="width:20%;" scope="col">Description</th>
//                                                         <th scope="col">Gender</th>
//                                                         <th scope="col">Age</th>
//                                                         <th scope="col">Genre</th>
//                                                         <th scope="col">Location</th>
//                                                         <th style="width:95%;"scope="col">Action</th>
//                                                     </tr>
//                                                 </thead>
//                                                 <tbody>`;
 
 
//     // loop through returned list of data
//     var sn = 0;
//     $.each(data.records, function(key, val) {
//         // for serial numbering
//         sn++;
//         // creating new table row per record
//         read_artist_html+=`<tr>
//             <th scope="row">` + sn + `</th>
//             <td>` + val.fullname + `
//                 <img style="display:block;" src="` + val.artist_img + `" width="100px" height="100px" class="preview" />
//             </td>
//             <td>` + val.stage_name + `</td>
//             <td>` + val.info + `</td>
//             <td>` + val.artist_gender + `</td>
//             <td>` + val.age + ` Yrs</td>
//             <td>` + val.genre + `</td>
//             <td>` + val.location + `</td>
//             <td class="btnBasket">
//                 <button type="button" class="actionBtn btn-sm btn btn-primary read-one-artist-button" data-id='` + val._id + `'>
//                     <span class='glyphicon glyphicon-eye-open'></span>Read
//                 </button>
//                 <button type="button" class="actionBtn btn-sm btn btn-info update-artist-button" data-id='` + val._id + `'>
//                     <span class='glyphicon glyphicon-edit'></span>Edit
//                 </button>
//                 <button type="button" class="actionBtn btn-sm btn btn-danger delete-artist-button" data-id='` + val._id + `'>
//                     <span class='glyphicon glyphicon-remove'></span>Delete
//                 </button>
//             </td>
//         </tr>`;
//     });
 
//     // end table
//     read_artist_html+=`</tbody></table>`;
 
//     // inject to 'page-content' of our app
//     $("#app_div").html(read_artist_html);
// }