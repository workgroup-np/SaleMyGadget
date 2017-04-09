<?php
/**
 * gadget Theme Customizer
 *
 * @package gadget
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function gadget_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
	$wp_customize->get_section( 'title_tagline'  )->title		= __('Site Titles & Tagline','gadget');
	$wp_customize->get_section( 'title_tagline'  )->panel		= 'panel_general';
	$wp_customize->get_section( 'title_tagline'  )->priority	= 10;	
	$wp_customize->get_section( 'header_image'  )->panel	= 'panel_general';
	$wp_customize->get_section( 'colors'  )->panel	= 'gadget_theme_colorcustomize';
	$wp_customize->get_section( 'colors'  )->title	= __( 'Logo Text Color','gadget' );
    $wp_customize->get_section('background_image')->panel = 'panel_general';


	// Theme important links started
   class gadget_Important_Links extends WP_Customize_Control {

      public $type = "gadget-important-links";

      public function render_content() {
         //Add Theme instruction
		 $gadget_features = array(
		 'Features' => array(
               'text' => __('Features 1', 'gadget'),
               'text' => __('Features 2', 'gadget'),
               'text' => __('Features 3', 'gadget'),
               'text' => __('Features 4', 'gadget'),
            ), 
		 
		 );
		 echo '<ul><b>
			<li>' . esc_attr__( '* Fully Mobile Responsive', 'gadget' ) . '</li>
			<li>' . esc_attr__( '* Dedicated Option Panel', 'gadget' ) . '</li>
			<li>' . esc_attr__( '* Customize Theme Color', 'gadget' ) . '</li>
			<li>' . esc_attr__( '* WooCommerce & bbPress Support', 'gadget' ) . '</li>
			<li>' . esc_attr__( '* SEO Optimized', 'gadget' ) . '</li>
			<li>' . esc_attr__( '* Control Individual Meta Option like: Category, date, Author, Tags etc. ', 'gadget' ) . '</li>
			<li>' . esc_attr__( '* Full Support', 'gadget' ) . '</li>
			<li>' . esc_attr__( '* Google Fonts', 'gadget' ) . '</li>
			<li>' . esc_attr__( '* Theme Color Customization', 'gadget' ) . '</li>
			<li>' . esc_attr__( '* Custom CSS', 'gadget' ) . '</li>
			<li>' . esc_attr__( '* Website Layout', 'gadget' ) . '</li>
			<li>' . esc_attr__( '* Select Number of Columns', 'gadget' ) . '</li>
			<li>' . esc_attr__( '* Website Width Control', 'gadget' ) . '</li>
			</b></ul>
		 ';
         $important_links = array(
		 
            'theme-info' => array(
               'link' => esc_url('http://www.insertcart.com/product/gadget-wordpress-theme/'),
               'text' => __('Gadget Pro', 'gadget'),
            ),
            'support' => array(
               'link' => esc_url('http://www.insertcart.com/contact-us/'),
               'text' => __('Contact us', 'gadget'),
            ),         
			'Documentation' => array(
               'link' => esc_url('http://www.insertcart.com/gadget-wordpress-theme-setup-and-documentation/'),
               'text' => __('Documentation', 'gadget'),
            ),			 
         );
         foreach ($important_links as $important_link) {
            echo '<p><a target="_blank" href="' . $important_link['link'] . '" >' . esc_attr($important_link['text']) . ' </a></p>';
         }
               }

   }
      $wp_customize->add_section('gadget_important_links', array(
      'priority' => 1,
      'title' => __('Upgrade to Pro', 'gadget'),
   ));

   $wp_customize->add_setting('gadget_important_links', array(
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'gadget_links_sanitize'
   ));

   $wp_customize->add_control(new gadget_Important_Links($wp_customize, 'important_links', array(
      'section' => 'gadget_important_links',
      'settings' => 'gadget_important_links'
   )));
/**********************************************
* General Settings
**********************************************/	
	if ( class_exists( 'WP_Customize_Panel' ) ):
	
		$wp_customize->add_panel( 'panel_general', array(
			'priority' => 30,
			'capability' => 'edit_theme_options',
			'theme_supports' => '',
			'title' => __( 'General Settings', 'gadget' )
		) );
	
	// /* Background	*/		
		// $wp_customize->add_section( 'gadget_general_background' , array(
				// 'title'       => __( 'Background Settings', 'gadget' ),
				// 'priority'    => 30,
				// 'panel' => 'panel_general'
		// ));
                  // //Background Color
        // $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'background_color', array(
				// 'label'    => __( 'Background Color', 'gadget' ),
				// 'section'  => 'gadget_general_background',
				// 'settings' => 'background_color',
				// 'priority'    => 1,
		// )));
                  // //Background image
        // $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'background_image', array(
				// 'label'    => __( 'Background Image', 'gadget' ),
				// 'section'  => 'gadget_general_background',
				// 'settings' => 'background_image',
				// 'priority'    => 1,
		// )));
	
                
                $wp_customize->add_section('custom_section_css',
		array(
			'title'			=> __( 'Custom CSS', 'gadget' ),			
			'panel'			=> 'panel_general',
                        'priority'    => 32
		)
	);
                $wp_customize->add_setting('custom_css',
		array(
			'default'			=> '',
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'    => 'wp_filter_nohtml_kses',
			'sanitize_js_callback' => 'wp_filter_nohtml_kses'
		)
	);
                $wp_customize->add_control('custom_css',
		array(

			'settings'		=> 'custom_css',
			'section'		=> 'custom_section_css',
			'type'			=> 'textarea',
			'label'			=> __( 'Custom CSS', 'gadget' ),
			'description'	=> __( 'Define custom CSS be used for your site. Do not enclose in script tags.', 'gadget' ),
		)
	);
                
endif;
 
/***********************************************
* Woocommerce Store
***********************************************/
	if (class_exists('woocommerce')) { 
		$wp_customize->add_panel( 'gadget_panel_woocommerce', array(
			'priority' => 32,
			'capability' => 'edit_theme_options',
			'theme_supports' => '',
			'title' => __( 'Woocommerce', 'gadget' )
		) );
                	
					
	$wp_customize->add_section( 'gadget_woo_settings' , 
                            array(
				'title'       => __( 'Woo settings & Options', 'gadget' ),
				'priority'    => 30,				
				'panel' => 'gadget_theme_colorcustomize'
		));
         //Show or Hide woo product
                 $wp_customize->add_setting('woocommerce_share_buttons',
	
		array(
			'default'			=> false,
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'gadget_sanitize_checkbox'
		)
	);
                 $wp_customize->add_control(new WP_customize_control ($wp_customize,'woocommerce_share_buttons',
                         array (
                             
                             'settings'		=> 'woocommerce_share_buttons',
                             'section'		=> 'gadget_woo_settings',
                             'type'		=> 'checkbox',                             
                            'label'		=> __( 'Hide Share from single product', 'gadget' )
			
                             
                         )  )); 
			
	

        }
        
        else {
            
	$wp_customize->add_panel( 'gadget_panel_woocommerce', array(
		'priority' => 32,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'WooCommerce', 'gadget' )
	) );
	/* Notice WooCommerce Not Installed */		
	$wp_customize->add_section( 'gadget_woocommercenot' , array(
		'title'       => __( 'WooCommerce Not Installed', 'gadget' ),
		'description' => __('Please install WooCommerce plugin to show these options','gadget'),
		'priority'    => 30,                                
		'panel' => 'gadget_panel_woocommerce'
	));

	$wp_customize->add_setting("woonotinstall", 
		 array(
			 'default' => __('WooCommerce not installed','gadget'), 
			 'sanitize_callback' => 'esc_textarea',
			 "transport" => "postMessage",
			 ));
	$wp_customize->add_control(new WP_Customize_Control( $wp_customize, "woonotinstall",
		array(
		'section'  => 'gadget_woocommercenot',
		"settings" => "woonotinstall",            
		'priority'    => 1,
	)	));
                 
                 
        }

/***********************************************
* Social Profiles
***********************************************/
            if ( class_exists( 'WP_Customize_Panel' ) ):
	
		$wp_customize->add_panel( 'gadget_panel_social', array(
			'priority' => 33,
			'capability' => 'edit_theme_options',
			'theme_supports' => '',
			'title' => __( 'Social Media', 'gadget' )
		) );
		
		$wp_customize->add_section( 'gadget_socialshare' , array(
				'title'       => __( 'Social Share in Post', 'gadget' ),

				'panel' => 'gadget_panel_social'
		));
		
		//Show or Hide woo product
                 $wp_customize->add_setting('gadget_sharelink',
	
		array(
			'default'			=> false,
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'gadget_sanitize_checkbox'
		)
	);
                 $wp_customize->add_control(new WP_customize_control ($wp_customize,'gadget_sharelink',
                         array (
                             
                             'settings'		=> 'gadget_sharelink',
                             'section'		=> 'gadget_socialshare',
                             'type'		=> 'checkbox',                             
                            'label'		=> __( 'Hide Social Post Share buttons', 'gadget' )
			
                             
                         )  )); 
		
		
		$wp_customize->add_section( 'gadget_social_links' , array(
				'title'       => __( 'Social Profile Links Footer', 'gadget' ),
				'priority'    => 30	,
				'panel' => 'gadget_panel_social'
		));
            
			
			//Show or Hide woo product
                 $wp_customize->add_setting('gadget_hidefotshare',
	
		array(
			'default'			=> false,
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',			
			'sanitize_callback'	=> 'gadget_sanitize_checkbox'
		)
	);
                 $wp_customize->add_control(new WP_customize_control ($wp_customize,'gadget_hidefotshare',
                         array (
                             
                             'settings'		=> 'gadget_hidefotshare',
                             'section'		=> 'gadget_social_links',
                             'type'		=> 'checkbox',
							 'priority'    => 1,							 
                             'label'		=> __( 'Hide Social Post Share buttons', 'gadget' )
			
                             
                         )  )); 
			
                /* Facebook */	
		 $wp_customize->add_setting("gadget_facebook", 
                         array(
                             'default' =>'',
                             'sanitize_callback' => 'esc_url_raw',
                             'capability' => 'edit_theme_options',
                             'type' => 'theme_mod',
                             'transport' => 'postMessage'
                             
                             ));
		 $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "gadget_facebook",
                          array(              
                              "label" => __("Facebook Link", "gadget"),
                                'section'  => 'gadget_social_links',
                                'settings' => 'gadget_facebook',
                                'type' => 'url',
                                'priority'    => 2,
                             )	));
	/* Twitter */		
		
		 $wp_customize->add_setting("gadget_twitter", 
                         array(
                             'default' =>'',
                             'sanitize_callback' => 'esc_url_raw',
                             'capability' => 'edit_theme_options',
                             'type' => 'theme_mod',
                             'transport' => 'postMessage'
                             
                             ));
		 $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "gadget_twitter",
                          array(              
                              "label" => __("Twitter Link", "gadget"),
                                'section'  => 'gadget_social_links',
                                'settings' => 'gadget_twitter',
                                'type' => 'url',
                                'priority'    => 3,
                             )	));
	/* Google Plus */		
		
		 $wp_customize->add_setting("gadget_googleplus", 
                         array(
                             'default' =>'',
                             'sanitize_callback' => 'esc_url_raw',
                             'capability' => 'edit_theme_options',
                             'type' => 'theme_mod',
                             'transport' => 'postMessage'
                             
                             ));
		 $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "gadget_googleplus",
                          array(              
                              "label" => __("Google Plus Link", "gadget"),
                                'section'  => 'gadget_social_links',
                                'settings' => 'gadget_googleplus',
                                'type' => 'url',
                                'priority'    => 4,
                             )	));
	/* Linkedin */		
		
		 $wp_customize->add_setting("gadget_linkedin", 
                         array(
                             'default' =>'',
                             'sanitize_callback' => 'esc_url_raw',
                             'capability' => 'edit_theme_options',
                             'type' => 'theme_mod',
                             'transport' => 'postMessage'
                             
                             ));
		 $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "gadget_linkedin",
                          array(              
                              "label" => __("LinkedIn", "gadget"),
                                'section'  => 'gadget_social_links',
                                'settings' => 'gadget_linkedin',
                                'type' => 'url',
                                'priority'    => 5,
                              
                             )	));

	/* dribbble */		
		
		 $wp_customize->add_setting("gadget_dribbble", 
                         array(
                             'default' =>'',
                             'sanitize_callback' => 'esc_url_raw',
                             'capability' => 'edit_theme_options',
                             'type' => 'theme_mod',
                             'transport' => 'postMessage'
                             
                             ));
		 $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "gadget_dribbble",
                          array(              
                              "label" => __("Dribbble", "gadget"),
                                'section'  => 'gadget_social_links',
                                'settings' => 'gadget_dribbble',
                                'type' => 'url',
                                'priority'    => 6,
                             )	));
		/* vimeo */		
		
		 $wp_customize->add_setting("gadget_vimeo", 
                         array(
                             'default' =>'',
                             'sanitize_callback' => 'esc_url_raw',
                             'capability' => 'edit_theme_options',
                             'type' => 'theme_mod',
                             'transport' => 'postMessage'
                             
                             ));
		 $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "gadget_vimeo",
                          array(              
                              "label" => __("Vimeo", "gadget"),
                                'section'  => 'gadget_social_links',
                                'settings' => 'gadget_vimeo',
                                'type' => 'url',
                                'priority'    => 7,
                             )	));	
                 /* rss */		
		
		 $wp_customize->add_setting("gadget_rss", 
                         array(
                             'default' =>'',
                             'sanitize_callback' => 'esc_url_raw',
                             'capability' => 'edit_theme_options',
                             'type' => 'theme_mod',
                             'transport' => 'postMessage'
                             
                             ));
		 $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "gadget_rss",
                          array(              
                              "label" => __('RSS Feed', 'gadget'),
                                'section'  => 'gadget_social_links',
                                'settings' => 'gadget_rss',
                                'type' => 'url',
                                'priority'    => 8,
                             )	));
                 
                /* instagram */		
		
		 $wp_customize->add_setting("gadget_instagram", 
                         array(
                             'default' =>'',
                             'sanitize_callback' => 'esc_url_raw',
                             'capability' => 'edit_theme_options',
                             'type' => 'theme_mod',
                             'transport' => 'postMessage'
                             
                             ));
		 $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "gadget_instagram",
                          array(              
                              "label" => __("Instagram", "gadget"),
                                'section'  => 'gadget_social_links',
                                'settings' => 'gadget_instagram',
                                'type' => 'url',
                                'priority'    => 9,
                             )	)); 
                 
                /* pinterest */		
		
		 $wp_customize->add_setting("gadget_pinterest", 
                         array(
                             'default' =>'',
                             'sanitize_callback' => 'esc_url_raw',
                             'capability' => 'edit_theme_options',
                             'type' => 'theme_mod',
                             'transport' => 'postMessage'
                             
                             ));
		 $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "gadget_pinterest",
                          array(              
                              "label" => __("Pinterest", "gadget"),
                                'section'  => 'gadget_social_links',
                                'settings' => 'gadget_pinterest',
                                'type' => 'url',
                                'priority'    => 10,
                             )	)); 
                 
                  /* youtube */		
		
		 $wp_customize->add_setting("gadget_youtube", 
                         array(
                             'default' =>'',
                             'sanitize_callback' => 'esc_url_raw',
                             'capability' => 'edit_theme_options',
                             'type' => 'theme_mod',
                             'transport' => 'postMessage'
                             
                             ));
		 $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "gadget_youtube",
                          array(              
                              "label" => __("Youtube", "gadget"),
                                'section'  => 'gadget_social_links',
                                'settings' => 'gadget_youtube',
                                'type' => 'url',
                                'priority'    => 11,
                             )	)); 
                 
                  /* skype */		
		
		 $wp_customize->add_setting("gadget_skype", 
                         array(
                             'default' =>'',
                             'sanitize_callback' => 'esc_url_raw',
                             'capability' => 'edit_theme_options',
                             'type' => 'theme_mod',
                             'transport' => 'postMessage'
                             
                             ));
		 $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "gadget_skype",
                          array(              
                              "label" => __("Skype", "gadget"),
                                'section'  => 'gadget_social_links',
                                'settings' => 'gadget_skype',
                                'type' => 'url',
                                'priority'    => 12,
                             )	)); 
                 
                  /* flickr */		
		
		 $wp_customize->add_setting("gadget_flickr", 
                         array(
                             'default' =>'',
                             'sanitize_callback' => 'esc_url_raw',
                             'capability' => 'edit_theme_options',
                             'type' => 'theme_mod',
                             'transport' => 'postMessage'
                             
                             ));
		 $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "gadget_flickr",
                          array(              
                              "label" => __("Flickr", "gadget"),
                                'section'  => 'gadget_social_links',
                                'settings' => 'gadget_flickr',
                                'type' => 'url',
                                'priority'    => 13,
                             )	)); 
                 
                 endif;
  
/***********************************************
* Sidebar Widget
***********************************************/
		$wp_customize->add_panel( 'gadget_theme_widgets', array(
			'priority' => 34,
			'capability' => 'edit_theme_options',
			'theme_supports' => '',
			'title' => __( 'Popular\Recent Post in sidebar', 'gadget' )
		) );
//Show or Hide Widget
                 $wp_customize->add_setting('hide_sidebar_widget',
		// $args
		array(
			'default'			=> false,
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'gadget_sanitize_checkbox'
		)
	);
                 $wp_customize->add_control(new WP_customize_control ($wp_customize,'hide_sidebar_widget',
                         array (
                             
                             'settings'		=> 'hide_sidebar_widget',
                             'section'		=> 'gadget_theme_widget1',
                             'type'			=> 'checkbox',                             
			'label'			=> __( 'Hide these Posts', 'gadget' )
			
                             
                         )  ));
	/* Popular\Latest Post Widget */		
		$wp_customize->add_section( 'gadget_theme_widget1' , array(
				'title'       => __( 'Popular/Latest Posts', 'gadget' ),
				'priority'    => 30,                              
				'panel' => 'gadget_theme_colorcustomize'
		));

		
       $wp_customize->add_setting('gadget_widget_range',
		array(
			'default'			=> '5',
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'gadget_sanitize_select'
		));
                 
                 $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gadget_widget_range',
		array(
			'settings'		=> 'gadget_widget_range',
			'section'		=> 'gadget_theme_widget1',
			'type'			=> 'select',
			'label'			=> __( 'Choose Numbers post to display', 'gadget' ),
			'choices'		=> array(
				'1' => __( '1', 'gadget' ),
				'2' => __( '2', 'gadget' ),
				'3' => __( '3', 'gadget' ),
				'4' => __( '4', 'gadget' ),
				'5' => __( '5', 'gadget' ),			
				'6' => __( '6', 'gadget' ),			
				'7' => __( '7', 'gadget' ),			
				'8' => __( '8', 'gadget' ),			
				'9' => __( '9', 'gadget' ),			
				'10' => __( '10', 'gadget' )			
			)
		)));
                 
                 //Popular widget name
                 $wp_customize->add_setting('popular_widget_name',
		array(
			'default'		=> __('Popular Posts','gadget'),
			'type'			=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
                       'sanitize_callback'	=> 'sanitize_text_field'
		));
                 
                 
                 $wp_customize->add_control(new WP_customize_control ($wp_customize,'popular_widget_name',
                         array (
                             
                             'settings'		=> 'popular_widget_name',
                             'section'		=> 'gadget_theme_widget1',
                             'type'			=> 'text',
			'label'			=> __( 'Popular Post name', 'gadget' )
			
                             
                         )  ));
                         
                 //Recent widget name
                 $wp_customize->add_setting('recent_widget_name',
		array(
			'default'		=> __('Recent Posts','gadget'),
			'type'			=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
                       'sanitize_callback'	=> 'gadget_sanitize_nohtml'
		));
                 
                 
                 $wp_customize->add_control(new WP_customize_control ($wp_customize,'recent_widget_name',
                         array (
                             
                             'settings'		=> 'recent_widget_name',
                             'section'		=> 'gadget_theme_widget1',
                             'type'			=> 'text',
			'label'			=> __( 'Recent Post name', 'gadget' )
			
                             
                         )  ));
                     
   
                        
/***********************************************
* Theme Color Customize
***********************************************/
if ( class_exists( 'WP_Customize_Panel' ) ):
	
		$wp_customize->add_panel( 'gadget_theme_colorcustomize', array(
			'priority' => 35,
			'capability' => 'edit_theme_options',
			'theme_supports' => '',
			'title' => __( 'Theme Settings & Color', 'gadget' )
		) );

      
  
/*************Theme Options****************/       
   $wp_customize->add_section( 'gadget_themeoption' , array(
				'title'       => __( 'Theme Features', 'gadget' ),
				'priority'    => 35,
				'panel' => 'gadget_theme_colorcustomize'
		));              
    //Hide new ticker
              $wp_customize->add_setting('gadget_backtotop',
	
		array(
			'default'			=> false,
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'gadget_sanitize_checkbox'
		)
	);
                 $wp_customize->add_control(new WP_customize_control ($wp_customize,'gadget_backtotop',
                         array (
                             
                             'settings'		=> 'gadget_backtotop',
                             'section'		=> 'gadget_themeoption',
                             'type'		=> 'checkbox',                             
                            'label'		=> __( 'Hide Back to Top Icon', 'gadget' )
			
                             
                         )  )); 

 //Post Date
              $wp_customize->add_setting('gadget_posted_date',
	
		array(
			'default'			=> false,
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'gadget_sanitize_checkbox'
		)
	);
                 $wp_customize->add_control(new WP_customize_control ($wp_customize,'gadget_posted_date',
                         array (
                             
                             'settings'		=> 'gadget_posted_date',
                             'section'		=> 'gadget_themeoption',
                             'type'		=> 'checkbox',                             
                            'label'		=> __( 'Check to Hide Post meta date ', 'gadget' )
			
                             
                         )  ));   						 

						  //Hide random post
              $wp_customize->add_setting('gadget_randompost',
	
		array(
			'default'			=> false,
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'gadget_sanitize_checkbox'
		)
	);
                 $wp_customize->add_control(new WP_customize_control ($wp_customize,'gadget_randompost',
                         array (
                             
                             'settings'		=> 'gadget_randompost',
                             'section'		=> 'gadget_themeoption',
                             'type'		=> 'checkbox',                             
                            'label'		=> __( 'Check to Hide random post ', 'gadget' )
			
                             
                         )  ));
  //Hide comment number
              $wp_customize->add_setting('comment_number',
	
		array(
			'default'			=> false,
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'gadget_sanitize_checkbox'
		)
	);
                 $wp_customize->add_control(new WP_customize_control ($wp_customize,'comment_number',
                         array (
                             
                             'settings'		=> 'comment_number',
                             'section'		=> 'gadget_themeoption',
                             'type'		=> 'checkbox',                             
                            'label'		=> __( 'Check to Hide Comment Number ', 'gadget' )
			
                             
                         )  )); 						 
/*************ticker****************/       
   $wp_customize->add_section( 'gadget_ticker' , array(
				'title'       => __( 'News Ticker', 'gadget' ),
				'priority'    => 31,
				'panel' => 'gadget_theme_colorcustomize'
		));              
    //Hide new ticker
              $wp_customize->add_setting('hide_news_ticker',
	
		array(
			'default'			=> false,
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'gadget_sanitize_checkbox'
		)
	);
                 $wp_customize->add_control(new WP_customize_control ($wp_customize,'hide_news_ticker',
                         array (
                             
                             'settings'		=> 'hide_news_ticker',
                             'section'		=> 'gadget_ticker',
                             'type'		=> 'checkbox',                             
                            'label'		=> __( 'Hide News Ticker', 'gadget' )
			
                             
                         )  ));    
						 
	//Choose Category One
 $wp_customize->add_setting('tickercategory', array(
        'default'        => '1',
          'sanitize_callback'	=> 'gadget_sanitize_html'         
		));
$wp_customize->add_control(
    new WP_Customize_Category_Control(   $wp_customize,
        'tickercategory',
        array(
			'label'    => __('News Ticker Category (Only display category which has at least one post.','gadget' ),
			'settings' => 'tickercategory',
			'section'		=> 'gadget_ticker'
        )
    )
);

                  //Ticker name
                 $wp_customize->add_setting('ticker_name',
		array(
			'default'		=> __('News','gadget'),
			'type'			=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
                       'sanitize_callback'	=> 'sanitize_text_field'
		));
                 
                 
                 $wp_customize->add_control(new WP_customize_control ($wp_customize,'ticker_name',
                         array (
                             
                             'settings'		=> 'ticker_name',
                             'section'		=> 'gadget_ticker',
                             'type'			=> 'text',
			'label'			=> __( 'Put Name for news ticker box', 'gadget' )
			
                             
                         )  ));
  
                 
endif; 
/***********************************************
* Main Index page
***********************************************/
if ( class_exists( 'WP_Customize_Panel' ) ):
	
		$wp_customize->add_panel( 'gadget_theme_mainindex', array(
			'priority' => 35,
			'capability' => 'edit_theme_options',
			'theme_supports' => '',
			'title' => __( 'Main Index Page', 'gadget' )
		) );
		$wp_customize->add_section( 'gadget_frontpageindex' , array(
				'title'       => __( 'Enable Front Page', 'gadget' ),
				'panel' => 'gadget_theme_mainindex'
		));
		
		  //Show or Hide woo product
      $wp_customize->add_setting('gadget_enablefrontpage',	
		array(
			'default'			=> true,
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'gadget_sanitize_checkbox'
		)
	);
		 $wp_customize->add_control(new WP_customize_control ($wp_customize,'gadget_enablefrontpage',
				 array (
					 
					 'settings'		=> 'gadget_enablefrontpage',
					 'section'		=> 'gadget_frontpageindex',
					 'type'		=> 'checkbox',                             
					'label'		=> __( 'Enable Custom Front Page', 'gadget')	
					 
				 )  ));			
		
		$wp_customize->add_section( 'gadget_theme_featuredarea' , array(
				'title'       => __( 'Featured Area', 'gadget' ),
				'panel' => 'gadget_theme_mainindex'
		));
		
		
		   $wp_customize->add_setting('featured_image',
		array(
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'gadget_sanitize_image'
		)
	);
                $wp_customize->add_control(
		new WP_Customize_Image_Control(	$wp_customize,	'featured_image1',
			array(
				'settings'		=> 'featured_image',
				'section'		=> 'gadget_theme_featuredarea',
				'label'			=> __( 'Featured Image', 'gadget' )
				
			)
		)
	);
                
                 $wp_customize->add_setting('featured_textarea',
		array(
			
                    'default'			=> __('This is Features Area Put text or HTML here','gadget'),
			'type'			=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback' => 'gadget_sanitize_html'
		)
	);
                $wp_customize->add_control('featured_textarea',
		array(
			'settings'		=> 'featured_textarea',
			'section'		=> 'gadget_theme_featuredarea',
			'type'			=> 'textarea',
			'label'			=> __( 'Featured Area text', 'gadget' ),
			'description'	=> __( 'Write anything you want about image or website. HTML allowed here.', 'gadget' ),
		)
	);
                
                
		$wp_customize->add_section( 'gadget_theme_frontpage' , array(
				'title'       => __( 'Front Page Customize', 'gadget' ),
				'panel' => 'gadget_theme_mainindex'
		));
 //Blog Label Color
  $wp_customize->add_setting('blog_front_name',
		array(
			'default'		=> __('Blog Posts','gadget'),
			'type'			=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
                       'sanitize_callback'	=> 'gadget_sanitize_nohtml'
		));
                 
                 
                 $wp_customize->add_control(new WP_customize_control ($wp_customize,'blog_front_name',
                         array (
                             
                             'settings'		=> 'blog_front_name',
                             'section'		=> 'gadget_theme_frontpage',
                             'type'			=> 'text',
							'label'			=> __( 'Latest Posts label name change', 'gadget' )
			
                             
                         )  ));
						 
	   //Show or Hide woo product
                 $wp_customize->add_setting('gadget_catehidelatest',
	
		array(
			'default'			=> false,
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'gadget_sanitize_checkbox'
		)
	);
                 $wp_customize->add_control(new WP_customize_control ($wp_customize,'gadget_catehidelatest',
                         array (
                             
                             'settings'		=> 'gadget_catehidelatest',
                             'section'		=> 'gadget_theme_frontpage',
                             'type'		=> 'checkbox',                             
                            'label'		=> __( 'Hide Latest Posts', 'gadget' )
			
                             
                         )  ));					 
 $wp_customize->add_setting('bloglabel_color',
	
		array(
			'default'			=> '#ff3838',
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'sanitize_hex_color'
		)
	);
                 $wp_customize->add_control(new WP_Customize_Color_Control ($wp_customize,'bloglabel_color',
                         array (
                             
                             'settings'		=> 'bloglabel_color',
                             'section'		=> 'gadget_theme_frontpage'
			
                             
                         )  ));
						 
   $wp_customize->add_setting('gadget_latestpost_range',
		array(
			'default'			=> '5',
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'gadget_sanitize_select'
		));
                 
                 $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gadget_latestpost_range',
		array(
			'settings'		=> 'gadget_latestpost_range',
			'section'		=> 'gadget_theme_frontpage',
			'type'			=> 'select',
			'choices'		=> array(
				'3' => __( '3', 'gadget' ),
				'6' => __( '6', 'gadget' ),
				'9' => __( '9', 'gadget' ),
				'12' => __( '12', 'gadget' ),
				'15' => __( '15', 'gadget' ),
				'18' => __( '18', 'gadget' ),
				'21' => __( '21', 'gadget' ),
			)
		)));  
                
                         
                 //Blog Posts name
 //Choose Category One
 $wp_customize->add_setting('gadget_catechoose1', array(
        'default'        => '1',
          'sanitize_callback'	=> 'gadget_sanitize_html'         
		));
$wp_customize->add_control(
    new WP_Customize_Category_Control(   $wp_customize,
        'gadget_catechoose1',
        array(
            'label'    => 'Font Page Category 1',
            'settings' => 'gadget_catechoose1',
         'section'		=> 'gadget_theme_frontpage'
        )
    )
);
 $wp_customize->add_setting('gadget_catehide1',
	
		array(
			'default'			=> false,
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'gadget_sanitize_checkbox'
		)
	);
                 $wp_customize->add_control(new WP_customize_control ($wp_customize,'gadget_catehide1',
                         array (
                             
                             'settings'		=> 'gadget_catehide1',
                             'section'		=> 'gadget_theme_frontpage',
                             'type'		=> 'checkbox',                             
                            'label'		=> __( 'Hide Category 1', 'gadget' )
			
                             
                         )  ));
 $wp_customize->add_setting('gadget_catecolorone',
	
		array(
			'default'			=> '#3B81DE',
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'sanitize_hex_color'
		)
	);
                 $wp_customize->add_control(new WP_Customize_Color_Control ($wp_customize,'gadget_catecolorone',
                         array (
                             
                             'settings'		=> 'gadget_catecolorone',
                             'section'		=> 'gadget_theme_frontpage'
			
                             
                         )  ));	
 //Choose Category Two
 $wp_customize->add_setting('gadget_catechoose2', array(
        'default'        => '1',
               'sanitize_callback'	=> 'gadget_sanitize_html'   
		));
$wp_customize->add_control(
    new WP_Customize_Category_Control(   $wp_customize,
        'gadget_catechoose2',
        array(
            'label'    => 'Font Page Category 2',
            'settings' => 'gadget_catechoose2',
         'section'		=> 'gadget_theme_frontpage'
        )
    )
);
 $wp_customize->add_setting('gadget_catehide2',
	
		array(
			'default'			=> false,
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'gadget_sanitize_checkbox'
		)
	);
                 $wp_customize->add_control(new WP_customize_control ($wp_customize,'gadget_catehide2',
                         array (
                             
                             'settings'		=> 'gadget_catehide2',
                             'section'		=> 'gadget_theme_frontpage',
                             'type'		=> 'checkbox',                             
                            'label'		=> __( 'Hide Category 2', 'gadget' )
			
                             
                         )  ));
 $wp_customize->add_setting('gadget_catecolortwo',
	
		array(
			'default'			=> '#00D066',
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'sanitize_hex_color'
		)
	);
                 $wp_customize->add_control(new WP_Customize_Color_Control ($wp_customize,'gadget_catecolortwo',
                         array (
                             
                             'settings'		=> 'gadget_catecolortwo',
                             'section'		=> 'gadget_theme_frontpage'
			
                             
                         )  ));			 
 //Choose Category Three
 $wp_customize->add_setting('gadget_catechoose3', array(
        'default'        => '1',
                   'sanitize_callback'	=> 'gadget_sanitize_html'   
		));
$wp_customize->add_control(
    new WP_Customize_Category_Control(   $wp_customize,
        'gadget_catechoose3',
        array(
            'label'    => 'Font Page Category 3',
            'settings' => 'gadget_catechoose3',
         'section'		=> 'gadget_theme_frontpage'
        )
    )
);
 $wp_customize->add_setting('gadget_catehide3',
	
		array(
			'default'			=> false,
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'gadget_sanitize_checkbox'
		)
	);
                 $wp_customize->add_control(new WP_customize_control ($wp_customize,'gadget_catehide3',
                         array (
                             
                             'settings'		=> 'gadget_catehide3',
                             'section'		=> 'gadget_theme_frontpage',
                             'type'		=> 'checkbox',                             
                            'label'		=> __( 'Hide Category 3', 'gadget' )
			
                             
                         )  ));
 $wp_customize->add_setting('gadget_catecolorthree',
	
		array(
			'default'			=> '#FFC107',
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'sanitize_hex_color'
		)
	);
                 $wp_customize->add_control(new WP_Customize_Color_Control ($wp_customize,'gadget_catecolorthree',
                         array (
                             
                             'settings'		=> 'gadget_catecolorthree',
                             'section'		=> 'gadget_theme_frontpage'
			
                             
                         )  ));
         
endif; 
/***********************************************
* Sidebar Widget
***********************************************/
if ( class_exists( 'WP_Customize_Panel' ) ):
	
		$wp_customize->add_panel( 'gadget_slider', array(
			'priority' => 38,
			'capability' => 'edit_theme_options',
			'theme_supports' => '',
			'title' => __( 'Slider', 'gadget' )
                    
		) );

 $wp_customize->add_section( 'slider_section' , array(
				'title'       => __( 'Slider Settings', 'gadget' ),
				'priority'    => 31,
				'panel' => 'gadget_slider'
		));   
//Show or Hide Widget
        $wp_customize->add_setting('hide_slider',
		array(
			'default'			=> false,
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'gadget_sanitize_checkbox'
		)
	);
                 $wp_customize->add_control(new WP_customize_control ($wp_customize,'hide_slider',
                         array (
                             
                             'settings'		=> 'hide_slider',
                             'section'		=> 'slider_section',
                             'type'		=> 'checkbox',                             
							'label'			=> __( 'Show slider', 'gadget' )
			
                             
                         )  ));
						 
						 
	//Disable caption
			$wp_customize->add_setting('slider_caption',
			array(
			'default'			=> 'block',
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'gadget_sanitize_select'
			)
			);
			$wp_customize->add_control(new WP_customize_control ($wp_customize,'slider_caption',
				 array (
					 
					 'settings'		=> 'slider_caption',
					 'section'		=> 'slider_section',
					 'type'			=> 'radio',                             
					'label'			=> __( 'Show or Hide Caption Text', 'gadget' ),
					'choices' => array(          
							'block' => __('Show','gadget'),
							'none' => __('Hide','gadget'),
                         )

					 
				 )  ));					 
						 
	   $wp_customize->add_setting('gadget_slider_range',
		array(
			'default'			=> '5',
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
            'transport' 		=> 'postMessage',
			'sanitize_callback'	=> 'gadget_sanitize_select'
		));
                 
                 $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gadget_slider_range',
		array(
			'settings'		=> 'gadget_slider_range',
			'section'		=> 'slider_section',
			'type'			=> 'select',
			'label'			=> __( 'Choose slides to display', 'gadget' ),
			'choices'		=> array(
				'2' => __( '1', 'gadget' ),
				'3' => __( '2', 'gadget' ),
				'4' => __( '3', 'gadget' ),
				'5' => __( '4', 'gadget' ),
				'6' => __( '5', 'gadget' ),
			)
		)));
		 //Width of slider
 $wp_customize->add_setting('range_fieldslide',
		array(
			'default'			=> 100,
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			 'sanitize_callback'	=> 'gadget_sanitize_html'   
		)
	);
              
						 
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize,'range_fieldslide',
  array(
    'type'        => 'range',
	'settings'		=> 'range_fieldslide',
    'priority'    => 10,
    'section'     => 'slider_section',
    'label'       => 'Slider Width',
    'description' => 'Control width of slider in Percentage % max:100, min:59.',
    'input_attrs' => array(
        'min'   => 59,
        'max'   => 100,
        'step'  => 5,
    ),
) ));
		
		
	
		
                 
                     
                     /* Slide 1	*/		
		$wp_customize->add_section( 'gadget_slide1' , array(
				'title'       => __( 'Add Slide 1', 'gadget' ),
				'priority'    => 31,
				'panel' => 'gadget_slider'
		));

		$wp_customize->add_setting( 'slide_image1', array('sanitize_callback' => 'esc_url_raw'));
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'slide_image1', array(
				'label'    => __( 'Image 1', 'gadget' ),
				'section'  => 'gadget_slide1',
				'settings' => 'slide_image1',
				'priority'    => 1,
		)));
                 $wp_customize->add_setting("slide_caption1", 
                         array(
                            'default' => __('Slide 1 caption text','gadget'), 
                             'sanitize_callback' => 'gadget_sanitize_html',
                              ));
		 $wp_customize->add_control(new WP_Customize_Control( $wp_customize, "slide_caption1",
                            array(
                                "label" => __("Slide 1 caption text", "gadget"),
                                'section'  => 'gadget_slide1',
                                "settings" => "slide_caption1",
                                "type" => "textarea",
                                     
        )	));
	

                     /* Slide 2	*/		
		$wp_customize->add_section( 'gadget_slide2' , array(
				'title'       => __( 'Add Slide 2', 'gadget' ),
				'priority'    => 32,
				'panel' => 'gadget_slider'
		));

		$wp_customize->add_setting( 'slide_image2', array('sanitize_callback' => 'esc_url_raw'));
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'slide_image2', array(
				'label'    => __( 'Image 2', 'gadget' ),
				'section'  => 'gadget_slide2',
				'settings' => 'slide_image2',
				'priority'    => 1,
		)));
                 $wp_customize->add_setting("slide_caption2", 
                         array(
                            'default' => __('Slide 2 caption text','gadget'), 
                             'sanitize_callback' => 'gadget_sanitize_html',
                              ));
		 $wp_customize->add_control(new WP_Customize_Control( $wp_customize, "slide_caption2",
                            array(
                                "label" => __("Slide 2 caption text", "gadget"),
                                'section'  => 'gadget_slide2',
                                "settings" => "slide_caption2",
                                "type" => "textarea",
                                     
        )	));
                 
                    /* Slide 3	*/		
		$wp_customize->add_section( 'gadget_slide3' , array(
				'title'       => __( 'Add Slide 3', 'gadget' ),
				'priority'    => 33,
				'panel' => 'gadget_slider'
		));

		$wp_customize->add_setting( 'slide_image3', array('sanitize_callback' => 'esc_url_raw'));
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'slide_image3', array(
				'label'    => __( 'Image 3', 'gadget' ),
				'section'  => 'gadget_slide3',
				'settings' => 'slide_image3',
				'priority'    => 1,
		)));
                 $wp_customize->add_setting("slide_caption3", 
                         array(
                            'default' => __('Slide 3 caption text','gadget'), 
                             'sanitize_callback' => 'gadget_sanitize_html',
                              ));
		 $wp_customize->add_control(new WP_Customize_Control( $wp_customize, "slide_caption3",
                            array(
                                "label" => __("Slide 3 caption text", "gadget"),
                                'section'  => 'gadget_slide3',
                                "settings" => "slide_caption3",
                                "type" => "textarea",
                                     
        )	));
                 
                    /* Slide 4	*/		
		$wp_customize->add_section( 'gadget_slide4' , array(
				'title'       => __( 'Add Slide 4', 'gadget' ),
				'priority'    => 44,
				'panel' => 'gadget_slider'
		));

		$wp_customize->add_setting( 'slide_image4', array('sanitize_callback' => 'esc_url_raw'));
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'slide_image4', array(
				'label'    => __( 'Image 4', 'gadget' ),
				'section'  => 'gadget_slide4',
				'settings' => 'slide_image4',
				'priority'    => 1,
		)));
                 $wp_customize->add_setting("slide_caption4", 
                         array(
                            'default' => __('Slide 4 caption text','gadget'), 
                             'sanitize_callback' => 'gadget_sanitize_html',
                              ));
		 $wp_customize->add_control(new WP_Customize_Control( $wp_customize, "slide_caption4",
                            array(
                                "label" => __("Slide 4 caption text", "gadget"),
                                'section'  => 'gadget_slide4',
                                "settings" => "slide_caption4",
                                "type" => "textarea",
                                     
        )	));
                 
                       /* Slide 5	*/		
		$wp_customize->add_section( 'gadget_slide5' , array(
				'title'       => __( 'Add Slide 5', 'gadget' ),
				'priority'    => 55,
				'panel' => 'gadget_slider'
		));

		$wp_customize->add_setting( 'slide_image5', array('sanitize_callback' => 'esc_url_raw'));
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'slide_image5', array(
				'label'    => __( 'Image 5', 'gadget' ),
				'section'  => 'gadget_slide5',
				'settings' => 'slide_image5',
				'priority'    => 1,
		)));
                 $wp_customize->add_setting("slide_caption5", 
                         array(
                            'default' => __('Slide 5 caption text','gadget'), 
                             'sanitize_callback' => 'gadget_sanitize_html',
                              ));
		 $wp_customize->add_control(new WP_Customize_Control( $wp_customize, "slide_caption5",
                            array(
                                "label" => __("Slide 5 caption text Upgrade to pro for more slides", "gadget"),
                                'section'  => 'gadget_slide5',
                                "settings" => "slide_caption5",
                                "type" => "textarea",
                                     
        )	));                 
	endif;
}

add_action("customize_register","gadget_customize_register");
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function gadget_customize_preview_js() {
	wp_enqueue_script( 'gadget_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'gadget_customize_preview_js' );

function gadget_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}
function gadget_sanitize_nohtml( $nohtml ) {
	return wp_filter_nohtml_kses( $nohtml );
}
function gadget_sanitize_select( $input, $setting ) {
	
	// Ensure input is a slug.
	$input = sanitize_key( $input );
	
	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;
	
	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}


function gadget_registers() {
	wp_register_script( 'gadget_customizer_script', get_template_directory_uri() . '/js/gadget_customizer.js', array("jquery","gadget_jquery_ui"), '20120206', true  );
	wp_enqueue_script( 'gadget_customizer_script' );
	
	wp_localize_script( 'gadget_customizer_script', 'gadget-cust-script', array(
		'documentation' => __( 'Documentation', 'gadget' ),
		'pro' => __('Upgrade to Pro','gadget'),
		'support' => __('Support Forum','gadget')
		
	) );
}
add_action( 'customize_controls_enqueue_scripts', 'gadget_registers' );


function gadget_sanitize_image( $image, $setting ) {
	/*
	 * Array of valid image file types.
	 *
	 * The array includes image mime types that are included in wp_get_mime_types()
	 */
    $mimes = array(
        'jpg|jpeg|jpe' => 'image/jpeg',
        'gif'          => 'image/gif',
        'png'          => 'image/png',
        'bmp'          => 'image/bmp',
        'tif|tiff'     => 'image/tiff',
        'ico'          => 'image/x-icon'
    );
	// Return an array with file extension and mime_type.
    $file = wp_check_filetype( $image, $mimes );
	// If $image has a valid mime_type, return it; otherwise, return the default.
    return ( $file['ext'] ? $image : $setting->default );
}
function gadget_sanitize_css( $css ) {
	return wp_strip_all_tags( $css );
}

function gadget_sanitize_html( $value ) {
		return $value;
        
}
if (class_exists('WP_Customize_Control')) {
    class WP_Customize_Category_Control extends WP_Customize_Control {
        /**
         * Render the control's content.
         *
         * @since 3.4.0
         */
        public function render_content() {
            $dropdown = wp_dropdown_categories(
                array(
                    'name'              => '_customize-dropdown-categories-' . $this->id,
                    'echo'              => 0,
                    'show_option_none'  => __( '&mdash; Select &mdash;','gadget' ),
                    'option_none_value' => '0',
                    'selected'          => $this->value(),
                )
            );
 
            // Hackily add in the data link parameter.
            $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );
 
            printf(
                '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
                $this->label,
                $dropdown
            );
        }
    }
}