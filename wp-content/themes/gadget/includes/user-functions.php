<?php
if ( !function_exists( 'sale_my_gadget_remove_website_row_wpse_94963_css' ) ) :
	function sale_my_gadget_remove_website_row_wpse_94963_css()
	{
	    echo '<style>tr.user-url-wrap,tr.user-profile-picture{ display: none; }#cupp_container { background: #f1f1f1;}</style>';
	}
	add_action( 'admin_head-user-edit.php', 'sale_my_gadget_remove_website_row_wpse_94963_css' );
	add_action( 'admin_head-profile.php',   'sale_my_gadget_remove_website_row_wpse_94963_css' );
endif;
if ( !function_exists( 'tsb_new_contact_methods' ) ) :
	function tsb_new_contact_methods($contactmethods) {
		$contactmethods['mobile'] = 'Mobile Number';
		$contactmethods['address'] = 'Address';
		$contactmethods['city'] = 'City';
		
		return $contactmethods;
	}
	add_filter('user_contactmethods','tsb_new_contact_methods',0);
endif;