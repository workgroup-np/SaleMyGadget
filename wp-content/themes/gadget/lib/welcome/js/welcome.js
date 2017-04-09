jQuery(document).ready(function() {

  var counter = jQuery('#counter-count').data('counter');
  if ( counter != '0')  {  
    jQuery('li.sale-my-gadget-w-red-tab a').append('<span class="sale-my-gadget-actions-count">' + counter + '</span>');
  } else {
    jQuery('.sale-my-gadget-tab').removeClass( 'sale-my-gadget-w-red-tab' );
  }
	/* Tabs in welcome page */
	function sale_my_gadget_welcome_page_tabs(event) {
		jQuery(event).parent().addClass("active");
        jQuery(event).parent().siblings().removeClass("active");
        var tab = jQuery(event).attr("href");
        jQuery(".sale-my-gadget-tab-pane").not(tab).css("display", "none");
        jQuery(tab).fadeIn();
	}

	var sale_my_gadget_actions_anchor = location.hash;

	if( (typeof sale_my_gadget_actions_anchor !== 'undefined') && (sale_my_gadget_actions_anchor != '') ) {
		sale_my_gadget_welcome_page_tabs('a[href="'+ sale_my_gadget_actions_anchor +'"]');
	}

    jQuery(".sale-my-gadget-nav-tabs a").click(function(event) {
        event.preventDefault();
		sale_my_gadget_welcome_page_tabs(this);
    });

 /* Tab Content height matches admin menu height for scrolling purpouses */
		$tab = jQuery('.sale-my-gadget-tab-content > div');
		$admin_menu_height = jQuery('#adminmenu').height();
    if( (typeof $tab !== 'undefined') && (typeof $admin_menu_height !== 'undefined') )
  {
		$newheight = $admin_menu_height - 180;
		$tab.css('min-height',$newheight);
  }
});
