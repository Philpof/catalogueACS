// $(document) .ready(function(e) {
//       $("#search") .keyup(function() {
//           $("show_up") .show();
//           var text = $(this) .val();
//           $.ajax({
//               type: 'GET',
//               url: 'recherche.php',
//               data: 'txt=' + text,
//               success: function(data) {
//                   $("#show_up") .html(data);
//               }
//
//            )};
//
//      )}
//
// )};


$(function() {

    //autocomplete
    $(".auto").autocomplete({
        source: "recherche.php",
        minLength: 1
    });

});
