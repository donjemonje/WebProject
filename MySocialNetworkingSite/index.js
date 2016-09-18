

// A $( document ).ready() block.
$(document).ready(function () {
    console.log("ready!");
		
	if( $('#email').val().length !== 0 ) {
	$( "#register-form-link" ).trigger( "click" );
		
	}
    
	//$("#register-form-link").on("click", function () {
		
		
      //  $(this).parents('p').addClass('warning');
    //}
    //});
});