jQuery(document).ready(function() {

	jQuery( "#sortable" ).sortable();
	
	jQuery( "#sortable" ).disableSelection();
	

	
	jQuery('.wp-full-overlay-sidebar-content').prepend('<a style="width: 80%; margin: 5px auto 5px auto; display: block; text-align: center;" href="http://www.insertcart.com" class="button" target="_blank">{support}</a>'.replace('{support}',gadget-cust-script.support));
	
	jQuery('.wp-full-overlay-sidebar-content').prepend('<a style="width: 80%; margin: 5px auto 5px auto; display: block; text-align: center;" href="http://www.insertcart.com/gadget-wordpress-theme-setup-and-documentation/" class="button" target="_blank">{documentation}</a>'.replace('{documentation}',gadget-cust-script.documentation));
	
	jQuery('.wp-full-overlay-sidebar-content').prepend('<a style="width: 80%; margin: 5px auto 5px auto; display: block; text-align: center;" href="http://www.insertcart.com/product/gadget-wordpress-theme/" class="button" target="_blank">{pro}</a>'.replace('{pro}',gadget-cust-script.pro));
	
	
	jQuery( '.ui-state-default' ).on( 'mousedown', function() {

		jQuery( '#customize-header-actions #save' ).trigger( 'click' );

	});
	
});
