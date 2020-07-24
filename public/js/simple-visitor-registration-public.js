(function( $ ) {
	'use strict'; 

    jQuery(document).ready(function($) { 

	    jQuery('#simplevisitorregistration-userdetails').on('submit',function(e){
	        e.preventDefault();  
	        var that = $(this)
	        var newFirstName = jQuery('#fname').val(); 
	        var newLastName = jQuery('#lname').val();
	        var newUserEmail = jQuery('#email').val();
	        var cfield1 = jQuery('#cfield1').val();
	        var phone = jQuery('#phone').val();
	        // var newUserPasswordConfirm = jQuery('#new-user-password-confirm').val();
	        jQuery('.register-message').text("Loading....").show();
 
	        jQuery.ajax({
				type:"POST",
	            dataType: 'json',
				url: wp_ajax.ajax_url,
				data: {
					action: "register_user_front_end",
					// recaptcha: response,  
					phone : phone,
					fname : newFirstName,
					lname : newLastName,
					email : newUserEmail,
					cfield1 : cfield1
				},
				success: function(data){  
					jQuery('.register-message').text(data.message).show();
					if (data.status == true){
						that.trigger("reset");;
	                    // document.location.href = data.redirecturl;
	                } else if (data.status == false){
	                    // document.location.href = data.redirecturl;
	                    jQuery('.register-message').text(data.message).show();
	                }  
				},
				error: function(results) {

				}
	        });
	    });
 
    });
})( jQuery );

 