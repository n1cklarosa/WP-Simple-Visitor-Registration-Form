(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
 	

})( jQuery ); 


jQuery( document ).ready(function() {
     jQuery('.colorfield').each(function(){
  
            jQuery(this).wpColorPicker();
    });
});


jQuery(document).ready(function($) {	
 
	$('#target_livestream').autocomplete({
		source: function(name, response) {
			console.log(name)
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: '/wp-admin/admin-ajax.php',
				data: 'action=get_livestreams&name='+name.term,
				success: function(data) {
					response(data);
				}
			});
		},
		select: function (event, ui) {
	        $('#target_livestream').val(ui.item.label); // display the selected text
	        $('#target_livestream_id').val(ui.item.value); // save selected id to hidden input
	        $('#selected_livestream span').html("<a href='/wp-admin/post.php?post="+ui.item.value+"&action=edit' target='_new'>"+ui.item.label+"</a>"); // save selected id to hidden input
	         return false;
	    },
		minLength : 2
	});

});