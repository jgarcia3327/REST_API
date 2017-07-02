jQuery(document).ready(function() {

  jQuery("form#add-book").submit(function(event) {
    $.ajax({
      method: "POST",
      url: "REST/insert/books/",
      dataType: "json",
      data: $(this).serializeArray()
    }).done(function( result ) {
      console.log(result);
      console.log(result.id);
      //alert( "Data Saved ID : " + result.id );
    });
  });

});
