<?php

/**
 * Kirki Advanced Customizer
 * 
 * @package sale-my-gadget
 */
// Early exit if Kirki is not installed.
if ( !class_exists( 'Kirki' ) ) {
	return;
}
load_theme_textdomain( 'sale-my-gadget', get_template_directory().'/languages' );

/* Register Kirki config */
Kirki::add_config( 'sale_my_gadget_settings', array(
	'capability'	 => 'edit_theme_options',
	'option_type'	 => 'theme_mod',
) );

/**
 * Add sections
 */
if ( class_exists( 'WooCommerce' ) && get_option( 'show_on_front' ) != 'page' && !is_child_theme() ) {
	Kirki::add_section( 'sale_my_gadget_woo_demo_section', array(
		'title'		 => __( 'WooCommerce Homepage Demo', 'sale-my-gadget' ),
		'priority'	 => 10,
	) );
}

Kirki::add_section( 'sale_my_gadget_layout_section', array(
	'title'			 => __( 'Main styling', 'sale-my-gadget' ),
	'priority'		 => 10,
) );

Kirki::add_section( 'sale_my_gadget_sidebar_section', array(
	'title'			 => __( 'Sidebars', 'sale-my-gadget' ),
	'priority'		 => 10,
	'description'	 => __( 'Sidebar layouts.', 'sale-my-gadget' ),
) );

Kirki::add_section( 'sale_my_gadget_top_bar_section', array(
	'title'		 => __( 'Top Bar', 'sale-my-gadget' ),
	'priority'	 => 10,
) );

Kirki::add_section( 'sale_my_gadget_search_bar_section', array(
	'title'			 => __( 'Search Bar', 'sale-my-gadget' ),
	'priority'		 => 10,
) );

if ( class_exists( 'WooCommerce' ) ) {
	Kirki::add_section( 'sale_my_gadget_woo_section', array(
		'title'		 => __( 'WooCommerce', 'sale-my-gadget' ),
		'priority'	 => 10,
	) );
}

Kirki::add_section( 'sale_my_gadget_links_section', array(
	'title'		 => __( 'Theme Important Links', 'sale-my-gadget' ),
	'priority'	 => 190,
) );

/**
 * Add fields
 */
Kirki::add_field( 'sale_my_gadget_settings', array(
	'type'			 => 'switch',
	'settings'		 => 'demo_front_page',
	'label'			 => __( 'Enable Demo Homepage?', 'sale-my-gadget' ),
	'description'	 => sprintf( __( 'When the theme is first installed and WooCommerce plugin activated, the demo mode would be turned on. This will display some sample/example content to show you how the website can be possibly set up. When you are comfortable with the theme options, you should turn this off. You can create your own unique homepage - Check the %s page for more informations.', 'sale-my-gadget' ), '<a href="' . esc_url( admin_url( 'themes.php?page=sale-my-gadget-welcome' ) ) . '"><strong>' . __( 'Theme info', 'sale-my-gadget' ) . '</strong></a>' ),
	'section'		 => 'sale_my_gadget_woo_demo_section',
	'default'		 => 1,
	'priority'		 => 10,
) );
Kirki::add_field( 'sale_my_gadget_settings', array(
	'type'				 => 'radio-buttonset',
	'settings'			 => 'front_page_demo_style',
	'label'				 => esc_html__( 'Homepage Demo Styles', 'sale-my-gadget' ),
	'description'		 => sprintf( __( 'The demo homepage is enabled. You can choose from some predefined layouts or make your own %s.', 'sale-my-gadget' ), '<a href="' . esc_url( admin_url( 'themes.php?page=sale-my-gadget-welcome' ) ) . '"><strong>' . __( 'custom homepage template', 'sale-my-gadget' ) . '</strong></a>' ),
	'section'			 => 'sale_my_gadget_woo_demo_section',
	'default'			 => 'style-one',
	'priority'			 => 10,
	'choices'			 => array(
		'style-one'	 => __( 'Layout one', 'sale-my-gadget' ),
		'style-two'	 => __( 'Layout two', 'sale-my-gadget' ),
	),
	'active_callback'	 => array(
		array(
			'setting'	 => 'demo_front_page',
			'operator'	 => '==',
			'value'		 => 1,
		),
	),
) );
Kirki::add_field( 'sale_my_gadget_settings', array(
	'type'				 => 'switch',
	'settings'			 => 'front_page_demo_carousel',
	'label'				 => __( 'Homepage Carousel', 'sale-my-gadget' ),
	'description'		 => esc_html__( 'Enable or disable demo homepage carousel with random products.', 'sale-my-gadget' ),
	'section'			 => 'sale_my_gadget_woo_demo_section',
	'default'			 => 1,
	'priority'			 => 10,
	'active_callback'	 => array(
		array(
			'setting'	 => 'demo_front_page',
			'operator'	 => '==',
			'value'		 => 1,
		),
	),
) );
Kirki::add_field( 'sale_my_gadget_settings', array(
	'type'				 => 'custom',
	'settings'			 => 'demo_page_intro_widgets',
	'label'				 => __( 'Homepage Widgets', 'sale-my-gadget' ),
	'section'			 => 'sale_my_gadget_woo_demo_section',
	'description'		 => esc_html__( 'You can set your own widgets. Go to Appearance - Widgets and drag and drop your widgets to "Homepage Sidebar" area.', 'sale-my-gadget' ),
	'priority'			 => 10,
	'active_callback'	 => array(
		array(
			'setting'	 => 'demo_front_page',
			'operator'	 => '==',
			'value'		 => 1,
		),
	),
) );
Kirki::add_field( 'sale_my_gadget_settings', array(
	'type'				 => 'custom',
	'settings'			 => 'demo_page_intro',
	'label'				 => __( 'Products', 'sale-my-gadget' ),
	'section'			 => 'sale_my_gadget_woo_demo_section',
	'description'		 => esc_html__( 'If you dont see any products or categories on your homepage, you dont have any products probably. Create some products and categories first.', 'sale-my-gadget' ),
	'priority'			 => 10,
	'active_callback'	 => array(
		array(
			'setting'	 => 'demo_front_page',
			'operator'	 => '==',
			'value'		 => 1,
		),
	),
) );
Kirki::add_field( 'sale_my_gadget_settings', array(
	'type'				 => 'custom',
	'settings'			 => 'demo_dummy_content',
	'label'				 => __( 'Need Dummy Products?', 'sale-my-gadget' ),
	'section'			 => 'sale_my_gadget_woo_demo_section',
	'description'		 => sprintf( esc_html__( 'When the theme is first installed, you dont have any products probably. You can easily import dummy products with only few clicks. Check %s tutorial.', 'sale-my-gadget' ), '<a href="' . esc_url( 'https://docs.woocommerce.com/document/importing-woocommerce-dummy-data/' ) . '" target="_blank"><strong>' . __( 'THIS', 'sale-my-gadget' ) . '</strong></a>' ),
	'priority'			 => 10,
) );
Kirki::add_field( 'sale_my_gadget_settings', array(
	'type'				 => 'custom',
	'settings'			 => 'demo_pro_features',
	'label'				 => __( 'Need More Features?', 'sale-my-gadget' ),
	'section'			 => 'sale_my_gadget_woo_demo_section',
	'description'		 => '<a href="' . esc_url( 'http://themes4wp.com/product/sale-my-gadget-pro/' ) . '" target="_blank" class="button button-primary">' . sprintf( esc_html__( 'Learn more about %s PRO', 'sale-my-gadget' ), 'Alpha Store' ) . '</a>',
	'priority'			 => 10,
) );

Kirki::add_field( 'sale_my_gadget_settings', array(
	'type'        => 'slider',
	'settings'    => 'carousel-height',
	'label'       => esc_attr__( 'Homepage carousel maximum height of images', 'sale-my-gadget' ),
	'description' => esc_attr__( 'After changing this setting you may need to regenerate your thumbnails.', 'sale-my-gadget' ),
	'section'     => 'sale_my_gadget_layout_section',
	'default'     => 423,
	'choices'     => array(
		'min'  => 150,
		'max'  => 600,
		'step' => 1,
	),
) );
Kirki::add_field( 'sale_my_gadget_settings', array(
	'type'        => 'spacing',
	'settings'    => 'logo-spacing',
	'label'       => __( 'Logo Spacing', 'sale-my-gadget' ),
	'section'     => 'sale_my_gadget_layout_section',
	'default'     => array(
		'top'    => '20px',
		'bottom' => '10px',
		'left'   => '0px',
		'right'  => '0px',
	),
	'priority'    => 10,
	'output'	 => array(
		array(
			'element'	 => '.custom-logo-link img',
			'property'	 => 'margin',
		),
	),
) );

Kirki::add_field( 'sale_my_gadget_settings', array(
	'type'			 => 'switch',
	'settings'		 => 'rigth-sidebar-check',
	'label'			 => __( 'Right Sidebar', 'sale-my-gadget' ),
	'description'	 => __( 'Enable the Right Sidebar', 'sale-my-gadget' ),
	'section'		 => 'sale_my_gadget_sidebar_section',
	'default'		 => 1,
	'priority'		 => 10,
) );

Kirki::add_field( 'sale_my_gadget_settings', array(
	'type'		 => 'radio-buttonset',
	'settings'	 => 'right-sidebar-size',
	'label'		 => __( 'Right Sidebar Size', 'sale-my-gadget' ),
	'section'	 => 'sale_my_gadget_sidebar_section',
	'default'	 => '3',
	'priority'	 => 10,
	'choices'	 => array(
		'1'	 => '1',
		'2'	 => '2',
		'3'	 => '3',
		'4'	 => '4',
	),
) );

Kirki::add_field( 'sale_my_gadget_settings', array(
	'type'			 => 'switch',
	'settings'		 => 'left-sidebar-check',
	'label'			 => __( 'Left Sidebar', 'sale-my-gadget' ),
	'description'	 => __( 'Enable the Left Sidebar', 'sale-my-gadget' ),
	'section'		 => 'sale_my_gadget_sidebar_section',
	'default'		 => 0,
	'priority'		 => 10,
) );

Kirki::add_field( 'sale_my_gadget_settings', array(
	'type'		 => 'radio-buttonset',
	'settings'	 => 'left-sidebar-size',
	'label'		 => __( 'Left Sidebar Size', 'sale-my-gadget' ),
	'section'	 => 'sale_my_gadget_sidebar_section',
	'default'	 => '3',
	'priority'	 => 10,
	'choices'	 => array(
		'1'	 => '1',
		'2'	 => '2',
		'3'	 => '3',
		'4'	 => '4',
	),
) );
Kirki::add_field( 'sale_my_gadget_settings', array(
	'type'		 => 'radio-buttonset',
	'settings'	 => 'footer-sidebar-size',
	'label'		 => __( 'Footer Widget Area Columns', 'sale-my-gadget' ),
	'section'	 => 'sale_my_gadget_sidebar_section',
	'default'	 => '3',
	'priority'	 => 10,
	'choices'	 => array(
		'12' => '1',
		'6'	 => '2',
		'4'	 => '3',
		'3'	 => '4',
	),
) );


Kirki::add_field( 'sale_my_gadget_settings', array(
	'type'			 => 'toggle',
	'settings'		 => 'sale_my_gadget_account',
	'label'			 => __( 'My Account/Login', 'sale-my-gadget' ),
	'description'	 => __( 'Enable or Disable My Account/Login link', 'sale-my-gadget' ),
	'section'		 => 'sale_my_gadget_top_bar_section',
	'default'		 => 1,
	'priority'		 => 10,
) );


Kirki::add_field( 'sale_my_gadget_settings', array(
	'type'			 => 'toggle',
	'settings'		 => 'sale_my_gadget_socials',
	'label'			 => __( 'Social Icons', 'sale-my-gadget' ),
	'description'	 => __( 'Enable or Disable the social icons', 'sale-my-gadget' ),
	'section'		 => 'sale_my_gadget_top_bar_section',
	'default'		 => 0,
	'priority'		 => 10,
) );
$s_social_links = array(
	'twp_social_facebook'	 => __( 'Facebook', 'sale-my-gadget' ),
	'twp_social_twitter'	 => __( 'Twitter', 'sale-my-gadget' ),
	'twp_social_google'		 => __( 'Google-Plus', 'sale-my-gadget' ),
	'twp_social_instagram'	 => __( 'Instagram', 'sale-my-gadget' ),
	'twp_social_pin'		 => __( 'Pinterest', 'sale-my-gadget' ),
	'twp_social_youtube'	 => __( 'YouTube', 'sale-my-gadget' ),
	'twp_social_reddit'		 => __( 'Reddit', 'sale-my-gadget' ),
	'twp_social_linkedin'	 => __( 'LinkedIn', 'sale-my-gadget' ),
	'twp_social_skype'		 => __( 'Skype', 'sale-my-gadget' ),
	'twp_social_vimeo'		 => __( 'Vimeo', 'sale-my-gadget' ),
	'twp_social_flickr'		 => __( 'Flickr', 'sale-my-gadget' ),
	'twp_social_dribble'	 => __( 'Dribbble', 'sale-my-gadget' ),
	'twp_social_envelope-o'	 => __( 'Email', 'sale-my-gadget' ),
	'twp_social_rss'		 => __( 'Rss', 'sale-my-gadget' ),
);

foreach ( $s_social_links as $keys => $values ) {
	Kirki::add_field( 'sale_my_gadget_settings', array(
		'type'			 => 'text',
		'settings'		 => $keys,
		'label'			 => $values,
		'description'	 => sprintf( __( 'Insert your custom link to show the %s icon.', 'sale-my-gadget' ), $values ),
		'help'			 => __( 'Leave blank to hide icon.', 'sale-my-gadget' ),
		'section'		 => 'sale_my_gadget_top_bar_section',
		'default'		 => '',
		'priority'		 => 10,
		'active_callback'	 => array(
			array(
				'setting'	 => 'sale_my_gadget_socials',
				'operator'	 => '==',
				'value'		 => 1,
			),
		),
	) );
}
Kirki::add_field( 'sale_my_gadget_settings', array(
	'type'				 => 'textarea',
	'settings'			 => 'infobox-text',
	'label'				 => __( 'Search bar info text', 'sale-my-gadget' ),
	'help'				 => __( 'You can add custom text', 'sale-my-gadget' ),
	'section'			 => 'sale_my_gadget_search_bar_section',
	'sanitize_callback'	 => 'wp_kses_post',
	'default'			 => '',
	'priority'			 => 10,
	'transport'			 => 'postMessage',
    'js_vars'   => array(
        array(
            'element'  => '.top-infobox',
            'function' => 'html',
            'property' => ''
        ),
    ),
) );

if ( function_exists( 'YITH_WCWL' ) ) {
	Kirki::add_field( 'sale_my_gadget_settings', array(
		'type'			 => 'toggle',
		'settings'		 => 'wishlist-top-icon',
		'label'			 => __( 'Header Wishlist icon', 'sale-my-gadget' ),
		'description'	 => __( 'Enable or disable heart icon with counter in header', 'sale-my-gadget' ),
		'section'		 => 'sale_my_gadget_woo_section',
		'default'		 => 0,
		'priority'		 => 10,
	) );
}
Kirki::add_field( 'sale_my_gadget_settings', array(
	'type'			 => 'toggle',
	'settings'		 => 'woo-breadcrumbs',
	'label'			 => __( 'Breadcrumbs', 'sale-my-gadget' ),
	'description'	 => __( 'Enable or disable breadcrumbs on WooCommerce pages', 'sale-my-gadget' ),
	'section'		 => 'sale_my_gadget_woo_section',
	'default'		 => 0,
	'priority'		 => 10,
) );
Kirki::add_field( 'sale_my_gadget_settings', array(
	'type'			 => 'toggle',
	'settings'		 => 'cart-top-icon',
	'label'			 => __( 'Header Cart', 'sale-my-gadget' ),
	'description'	 => __( 'Enable or disable header cart', 'sale-my-gadget' ),
	'section'		 => 'sale_my_gadget_woo_section',
	'default'		 => 1,
	'priority'		 => 10,
) );
Kirki::add_field( 'sale_my_gadget_settings', array(
	'type'		 => 'code',
	'settings'	 => 'cart-banner',
	'label'		 => __( 'HTML banner', 'sale-my-gadget' ),
	'section'	 => 'sale_my_gadget_woo_section',
	'choices'	 => array(
		'label'		 => __( 'Banner code', 'sale-my-gadget' ),
		'language'	 => 'html',
		'theme'		 => 'monokai',
	),
	'default'	 => '',
	'priority'	 => 10,
	'active_callback'    => ( function_exists( 'YITH_WCWL' ) ) ? array(
		array(
			'setting'  => 'cart-top-icon',
			'operator' => '==',
			'value'    => 0,
		),
		array(
			'setting'  => 'wishlist-top-icon',
			'operator' => '==',
			'value'    => 0,
		),
	) : array(
		array(
			'setting'  => 'cart-top-icon',
			'operator' => '==',
			'value'    => 0,
		),
	),
) );
Kirki::add_field( 'sale_my_gadget_settings', array(
	'type'			 => 'slider',
	'settings'		 => 'archive_number_products',
	'label'			 => __( 'Number of products', 'sale-my-gadget' ),
	'description'	 => __( 'Change number of products displayed per page in archive(shop) page.', 'sale-my-gadget' ),
	'section'		 => 'sale_my_gadget_woo_section',
	'default'		 => 24,
	'priority'		 => 10,
	'choices'		 => array(
		'min'	 => 2,
		'max'	 => 60,
		'step'	 => 1
	),
) );
Kirki::add_field( 'sale_my_gadget_settings', array(
	'type'			 => 'slider',
	'settings'		 => 'archive_number_columns',
	'label'			 => __( 'Number of products per row', 'sale-my-gadget' ),
	'description'	 => __( 'Change the number of product columns per row in archive(shop) page.', 'sale-my-gadget' ),
	'section'		 => 'sale_my_gadget_woo_section',
	'default'		 => 4,
	'priority'		 => 10,
	'choices'		 => array(
		'min'	 => 2,
		'max'	 => 5,
		'step'	 => 1
	),
) );
Kirki::add_field( 'sale_my_gadget_settings', array(
	'type'		 => 'color',
	'settings'	 => 'color_site_title',
	'label'		 => __( 'Site title color', 'sale-my-gadget' ),
	'help'		 => __( 'Site title text color, if not defined logo.', 'sale-my-gadget' ),
	'section'	 => 'colors',
	'default'	 => '#fff',
	'priority'	 => 10,
	'output'	 => array(
		array(
			'element'	 => 'h2.site-title a, h1.site-title a',
			'property'	 => 'color',
		),
	),
	'transport'	 => 'auto',
) );
Kirki::add_field( 'sale_my_gadget_settings', array(
	'type'		 => 'color',
	'settings'	 => 'color_site_desc',
	'label'		 => __( 'Site description color', 'sale-my-gadget' ),
	'help'		 => __( 'Site description text color, if not defined logo.', 'sale-my-gadget' ),
	'section'	 => 'colors',
	'default'	 => '#fff',
	'priority'	 => 10,
	'output'	 => array(
		array(
			'element'	 => 'h2.site-desc, h3.site-desc',
			'property'	 => 'color',
		),
	),
	'transport'	 => 'auto',
) );

$theme_links = array(
	'documentation'	 => array(
		'link'		 => esc_url_raw( 'http://demo.themes4wp.com/documentation/category/sale-my-gadget/' ),
		'text'		 => __( 'Documentation', 'sale-my-gadget' ),
		'settings'	 => 'theme-docs',
	),
	'demo'			 => array(
		'link'		 => esc_url_raw( 'http://demo.themes4wp.com/sale-my-gadget/' ),
		'text'		 => __( 'View Demo', 'sale-my-gadget' ),
		'settings'	 => 'theme-demo',
	),
	'rating'		 => array(
		'link'		 => esc_url_raw( 'https://wordpress.org/support/view/theme-reviews/sale-my-gadget?filter=5' ),
		'text'		 => __( 'Rate This Theme', 'sale-my-gadget' ),
		'settings'	 => 'theme-rate',
	)
);

foreach ( $theme_links as $theme_link ) {
	Kirki::add_field( 'sale_my_gadget_settings', array(
		'type'		 => 'custom',
		'settings'	 => $theme_link[ 'settings' ],
		'section'	 => 'sale_my_gadget_links_section',
		'default'	 => '<div style="padding: 10px; text-align: center; font-size: 22px; font-weight: bold;"><a target="_blank" href="' . $theme_link[ 'link' ] . '" >' . esc_attr( $theme_link[ 'text' ] ) . ' </a></div>',
		'priority'	 => 10,
	) );
}

function sale_my_gadget_configuration() {

	$config[ 'color_back' ]		 = '#192429';
	$config[ 'color_accent' ]	 = '#00a0d2';
	$config[ 'width' ]			 = '25%';

	return $config;
}

add_filter( 'kirki/config', 'sale_my_gadget_configuration' );

/**
 * Add custom CSS styles
 */
function sale_my_gadget_enqueue_header_css() {

	$columns = get_theme_mod( 'archive_number_columns', 4 );

	if ( $columns == '2' ) {
		$css = '@media only screen and (min-width: 769px) {.archive .rsrc-content .woocommerce ul.products li.product{width: 48.05%}}';
	} elseif ( $columns == '3' ) {
		$css = '@media only screen and (min-width: 769px) {.archive .rsrc-content .woocommerce ul.products li.product{width: 30.75%;}}';
	} elseif ( $columns == '5' ) {
		$css = '@media only screen and (min-width: 769px) {.archive .rsrc-content .woocommerce ul.products li.product{width: 16.95%;}}';
	} else {
		$css = '';
	}
	wp_add_inline_style( 'kirki-styles-sale_my_gadget_settings', $css );
}

add_action( 'wp_enqueue_scripts', 'sale_my_gadget_enqueue_header_css', 9999 );

