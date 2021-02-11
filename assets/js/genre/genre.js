// // product list html
// function readGenreTemplate(data, keywords){
 
//     var read_genre_html=`
//         <div class="row">
//             <div class="col-12">
//                 <div class="card">
//                     <div class="card-header">
//                         <h3 class="card-title">Fixed Header Table</h3>

//                         <div class="card-tools">
//                             <div class="input-group input-group-sm" style="width: 150px;">
//                                 <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

//                                 <div class="input-group-append">
//                                     <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
//                                 </div>
//                             </div>
//                         </div>
//                     </div>
//                     <!-- /.card-header -->
//                     <div class="card-body table-responsive p-0" style="height: 300px;">
//                         <table class="table table-head-fixed text-nowrap">
//                             <thead>
//                                 <tr>
//                                   <th>S/N</th>
//                                   <th>Genre</th>
//                                   <th>Action</th>
//                                 </tr>
//                               </thead>
//                               <tbody>`;
 
 
//     // loop through returned list of data
//     var sn = 0;
//     $.each(data.records, function(key, val) {
//         // for serial numbering
//         sn++;
//         // creating new table row per record
//         read_genre_html+=`<tr>
//             <td>` + sn + `</td>
//             <td>` + val.genre_name + `</td>
//             <td>
//                 <button type="button" class="actionBtn btn-sm btn btn-danger delete-genre-button" data-id='` + val._id + `'>
//                     <span class='glyphicon glyphicon-remove'></span>Delete
//                 </button>
//             </td>
//         </tr>`;
//     });
 
//     // end table
//     read_genre_html+=`</tbody></table>`;
 
//     // inject to 'page-content' of our app
//     $("#genreList").html(read_genre_html);
// }