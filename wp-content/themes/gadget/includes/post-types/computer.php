<?php
////////////////////////////////////////////////////////////////////
// Register Computer Post Types
////////////////////////////////////////////////////////////////////
if ( !function_exists( 'sale_my_gadget_computer_custom_init' ) ) :
    add_action('init', 'sale_my_gadget_computer_custom_init');
    function sale_my_gadget_computer_custom_init() {
      $labels = array(
        'name' => _x('Computer', 'post type general name'),
        'singular_name' => _x('Computer', 'post type singular name'),
        'add_new' => _x('Add New', 'learning'),
        'add_new_item' => __('Add New Computers'),
        'edit_item' => __('Edit Computers'),
        'new_item' => __('New Computers'),
        'all_items' => __('All Computers'),
        'view_item' => __('View Computers'),
        'search_items' => __('Search Computers'),
        'not_found' =>  __('No Computers found'),
        'not_found_in_trash' => __('No Computers found in Trash'),
        'parent_item_colon' => '',
        'menu_name' => __('Computers')

        );
      $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array( 'title','editor','author' ),
        'menu_icon'   => 'dashicons-desktop',
        );
      register_post_type('computer',$args);
      flush_rewrite_rules();
    }
endif;
////////////////////////////////////////////////////////////////////
// Register Computer Taxonomy
////////////////////////////////////////////////////////////////////
if ( !function_exists( 'sale_my_gadget_computer_taxonomy' ) ) :
    add_action( 'init', 'sale_my_gadget_computer_taxonomy', 0 );
    function sale_my_gadget_computer_taxonomy() {
      $labels = array(
        'name' => _x( 'Brand', 'taxonomy general name' ),
        'singular_name' => _x( 'Brand', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Brand' ),
        'all_items' => __( 'All Brand' ),
        'parent_item' => __( 'Parent Brand' ),
        'parent_item_colon' => __( 'Parent Brand:' ),
        'edit_item' => __( 'Edit Brand' ),
        'update_item' => __( 'Update Brand' ),
        'add_new_item' => __( 'Add New Brand' ),
        'new_item_name' => __( 'New Brand Name' ),
        'menu_name' => __( 'Brands' ),
        );
    // Now register the taxonomy
      register_taxonomy('computer_cat',array('computer'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'computer_cat' ),
        ));
    }
endif;
// //Add custom column
// add_filter('manage_edit-computer_columns', 'computer_columns_head');
// function computer_columns_head($defaults) {
// 	$defaults = array(
// 		'cb'	 	=> '<input type="checkbox" />',
// 		'image'	=>	'Image',
// 		'title' 	=> 'Title',
// 		'date'		=>	'Date'
// 	);
// return $defaults;
// }
// //Add rows data
// add_action( 'manage_computer_posts_custom_column' , 'computer_custom_column', 10, 2 );
// function computer_custom_column($column, $post_id ){
// 	switch ( $column ) {
// 	case 'image':{
// 		$image = get_post_meta( $post_id , '_computer_image' , true );
// 		$img_file='<img src="'.$image.'" width="80" height="80">';
// 		echo $img_file;
// 		break;
// 	}

// 	break;
// 	}
// }

// custom metabox

// // add custom field
// add_action( 'cmb2_admin_init', 'team_metabox' );
// /**
//  * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
//  */
// function team_metabox() {
// 	// Start with an underscore to hide fields from custom fields list
// 	$prefix = '_computer_';
// 	/**
// 	 * Sample metabox to demonstrate each field type included
// 	 */
// 	$cmb_team = new_cmb2_box( array(
// 		'id'            => $prefix . 'metabox',
// 		'title'         => __( 'Computers', 'cmb2' ),
// 		'object_types'  => array( 'computer',), // Post type

// 	) );


// 	$cmb_team->add_field( array(
// 		'name'       => __( 'Image', 'cmb2' ),
// 		'desc'       => __( 'add image for computer points', 'cmb2' ),
// 		'id'         => $prefix . 'image',
// 		'type'       => 'file',
// 		// Optional:
// 		'options' => array(
// 			'url' => false, // Hide the text input for the url
// 			'add_upload_file_text' => 'Add Sevice Image' // Change upload button text. Default: "Add or Upload File"
// 		),
// 	) );

// }