<?php
/**
*
* Metaboxes
*
*/
require_once 'cmb_extension/cmb-field-select2.php';
add_action( 'cmb2_init', 'sale_my_gadget_homepage_template_metaboxes' );

function sale_my_gadget_homepage_template_metaboxes() {
    
    if ( class_exists( 'WooCommerce' ) ) {
    $prefix = 'sale_my_gadget';

	$cmb = new_cmb2_box( array(
		'id'           => $prefix .'_home_settings',
		'title'        => __( 'Homepage Settings', 'sale-my-gadget' ),
		'object_types' => array( 'page', ),
		'show_on'       => array( 'key' => 'page-template', 'value' => array('template-home.php', 'template-home-sidebar.php') ),
		'context'       => 'normal',
    'priority'      => 'high',
    'show_names'    => true,
	) );
	$cmb->add_field( array(
    'name'   => __( 'Carousel', 'sale-my-gadget' ),
    'desc'   => __( 'Enable or disable carousel', 'sale-my-gadget' ),
    'id'     => $prefix .'_slider_on',
    'default' => 'off',
    'type'    => 'radio_inline',
    'options' => array(
        'on' => __( 'On', 'sale-my-gadget' ),
        'off'   => __( 'Off', 'sale-my-gadget' ),
    ),
  ) );
  $cmb->add_field( array(
		'name'   => __( 'Carousel background', 'sale-my-gadget' ),
		'id'     => $prefix .'_image',
		'type' => 'file',
    'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
	) );
	$cmb->add_field( array(
    'name'   => __( 'Products', 'sale-my-gadget' ),
    'desc'   => __( 'Select at least 5 products', 'sale-my-gadget' ),
    'id'     => $prefix .'_carousel_select',
    'type'    => 'pw_multiselect',
    'options' => sale_my_gadget_posts_template( 'product' )
  ) );

  }     
}

add_action( 'cmb2_init', 'sale_my_gadget_homepage_sidebar_template_metaboxes' );

function sale_my_gadget_homepage_sidebar_template_metaboxes() {
    
    if ( class_exists( 'WooCommerce' ) ) {
    $prefix = 'sale_my_gadget';

    
    $cmb = new_cmb2_box( array(
        'id'            => 'homepage_metabox_sidebar',
        'title'         => __( 'Sidebars', 'sale-my-gadget' ),
        'object_types'  => array( 'page', ), // Post type 
        'show_on'       => array( 'key' => 'page-template', 'value' => 'template-home-sidebar.php' ),
        'context'       => 'side',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
    ) );
    $cmb->add_field( array(
        'name'   => __( 'Sidebar position', 'sale-my-gadget' ),
    		'id'     => $prefix .'_sidebar_position',
    		'default' => 'left',
        'type'    => 'select',
        'options' => array(
            'left'  => __( 'Left', 'sale-my-gadget' ),
            'right' => __( 'Right', 'sale-my-gadget' ),
        ),
    ) );
  }     
}

if( !function_exists('sale_my_gadget_posts_template') ) :
    function sale_my_gadget_posts_template( $type = 'post', $id = true ) {
        $posts = get_posts( array(
            'posts_per_page' => -1,
            'post_type' => $type,
            'post_status' => 'publish',
        ));
        $output = array();
        foreach( $posts as $post ) {
            $output[$post->ID] = $post->post_name;
        }                                                                                                                  
        return $output;
    }   
endif;  