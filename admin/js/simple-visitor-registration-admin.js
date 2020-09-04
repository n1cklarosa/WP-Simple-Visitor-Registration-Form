(function( $ ) {
	'use strict';
	$( document ).ready(function() {

		$( "#remove_visitor_entries" ).click(function() {
				
			if (confirm("Are you sure? This is permanent") == true) {
				jQuery.ajax({
					type:"POST",
					dataType: 'json',
					url: wp_ajax.ajax_url,
					data: {
						action: "delete_all_database_entries",  
						security : wp_ajax._nonce 
					},
					success: function(data){   
			
						if(data.status === true){
							alert("Success! All entries have been removed")
						} else {
							alert("There was an error - ")
						}
					},
					error: function(results) {
						alert("There was an error ")
					}
				});
			}  
			
		});
	}); 
})( jQuery ); 

