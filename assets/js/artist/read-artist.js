// $(document).ready(function(){
     
//     // show list of product on first load
//     // showArtists();

//     // when a 'read products' button was clicked
//     $(document).on('click', '.all_artist_page', function(){
//         showArtists();
//         // calll function every 7 seconds
//         // setInterval(function(){ 
//         //     showArtists();
//         // }, 7000); 
//     });
     

//     // function to show list of products
//     function showArtists(){
     
//         // get list of products from the API
//         $.getJSON("http://recordlabel/api/artist/read.php", function(data){
     
//             // html for listing products
//             readArtistTemplate(data, "");
     
//             // chage page title
//             changePageTitle("Read Artists");
     
//         });
//     }
// });