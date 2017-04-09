<?php
include_once('includes/core/core.php');
	include_once 'inc/installs.php';
	include_once 'template-parts/slider.php';	
	include_once 'inc/metabox.php';
	include_once 'inc/pagemetabox.php';
/**
 * gadget functions and definitions
 *
 * @package gadget
 */

if ( ! function_exists( 'gadget_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function gadget_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on gadget, use a find and replace
	 * to change 'gadget' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'gadget', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	//Woocommerce theme support 
	add_theme_support( 'woocommerce' );
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
        set_post_thumbnail_size( 300, 300 );
        add_image_size( 'gadget_themewidget', 65, 65 );
        add_image_size( 'gadget_indeximagebig', 320, 200 );
        add_image_size( 'gadget_indeximage', 85, 85 );
        add_image_size( 'gadget_latestthumbimg', 220, 125 );
        add_image_size( 'gadget_gadgetrandom', 90, 90 );
		
	add_theme_support( 'custom-logo', array(
	'height'      => 120,
	'width'       => 320,
	'flex-height' => true,
	'flex-width'  => true,
	'header-text' => array( 'site-title', 'site-description' ),
) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'topmenu' => esc_html__( 'Top Menu', 'gadget' ),
		'primary' => esc_html__( 'Primary Menu', 'gadget' ),
 		'footer-menu' => esc_html__('Footer Menu', 'gadget'),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );
        /*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css') );

	// Set up the WordPress core custom background feature.
	
add_theme_support( 'custom-background', apply_filters( 'gadget_custom_background_args', array( 
 	        'default-color' => 'f3f3f3', 
 	        'default-image' => '', 
 	    ) ) ); 

}
endif; // gadget_setup
add_action( 'after_setup_theme', 'gadget_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function gadget_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'gadget_content_width', 700 );
        if ( ! isset( $content_width ) ) $content_width = 700;
}
add_action( 'after_setup_theme', 'gadget_content_width', 0 );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function gadget_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'gadget' ),
		'id'            => 'sidebar-1',
		'description'   => __('Sidebar widget for all pages included Post, Pages, Index and archives', 'gadget' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Top Header Area', 'gadget' ),
		'id'            => 'topareawid',
		'description'   => __('Top Header widget are show on right side of logo between two menus','gadget' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Below Navigation', 'gadget' ),
		'id'            => 'belownavi-1',
		'description'   => __('This widget show just above content and below main navigation','gadget' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Single Post Widget', 'gadget' ),
		'id'            => 'singlepostwid',
		'description'   => __('It shows in single posts after title and before content','gadget' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget 1', 'gadget' ),
		'id'            => 'footer-1',
		'description'   => __('Footer widget area first from left','gadget' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget 2', 'gadget' ),
		'id'            => 'footer-2',
		'description'   => __('Footer widget area second from left','gadget' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget 3', 'gadget' ),
		'id'            => 'footer-3',
		'description'   => __('Footer widget area Third from left','gadget' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget 4', 'gadget' ),
		'id'            => 'footer-4',
		'description'   => __('Footer widget area fourth from left','gadget' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Front Page - After Blog Post [Pro Only]', 'gadget' ),
		'id'            => 'fp-blogpost',
		'description'   => __('Widget After blog post in front page','gadget' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Front Page - After Category 1 [Pro Only]', 'gadget' ),
		'id'            => 'fp-catea',
		'description'   => __('Widget After category block in front page','gadget' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Front Page - After Category 2 [Pro Only]', 'gadget' ),
		'id'            => 'fp-cateb',
		'description'   => __('Widget After category block in front page','gadget' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Front Page - After Category 3 [Pro Only]', 'gadget' ),
		'id'            => 'fp-catec',
		'description'   => __('Widget After category block in front page','gadget' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Front Page - After Category 4 [Pro Only]', 'gadget' ),
		'id'            => 'fp-cated',
		'description'   => __('Widget After category block in front page','gadget' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Front Page - After Category 5 [Pro Only]', 'gadget' ),
		'id'            => 'fp-catee',
		'description'   => __('Widget After category block in front page','gadget' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Front Page - After Category 6 [Pro Only]', 'gadget' ),
		'id'            => 'fp-catef',
		'description'   => __('Widget After category block in front page','gadget' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Front Page - After Category 7 [Pro Only]', 'gadget' ),
		'id'            => 'fp-categ',
		'description'   => __('Widget After category block in front page','gadget' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Front Page - After Category 8 [Pro Only]', 'gadget' ),
		'id'            => 'fp-cateh',
		'description'   => __('Widget After category block in front page','gadget' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'gadget_widgets_init' );


/**
 * Enqueue scripts into theme
 */
require get_template_directory() . '/inc/enqueue-scripts.php';
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
//require get_template_directory() . '/inc/customizer-section.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
/**
 * custom-function file.
 */
require get_template_directory() . '/inc/custom-function.php';


function gadget_contactmethods( $contactmethods ) {
    // Add Youtube
    $contactmethods['youtube'] = __('Youtube','gadget');
    // Add Google Plus
    $contactmethods['googleplus'] = __('Google+','gadget');
    // Add Twitter
    $contactmethods['twitter'] = __('Twitter','gadget');
    //Add Facebook
    $contactmethods['facebook'] = __('Facebook','gadget'); 
	// Add Pinterest
    $contactmethods['pinterest'] = __('Pinterest','gadget');
	// Add Instagram
    $contactmethods['instagram'] = __('Instagram','gadget');
	//Add RSS
    $contactmethods['rss'] = __('RSS','gadget');
    return $contactmethods;
    }
add_filter('user_contactmethods','gadget_contactmethods',10,1);

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/template-parts/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'gadget_register_required_plugins' );

function gadget_register_required_plugins() {

   $plugins = array(

	
		
		// This is an example of how to include a plugin from the WordPress Plugin Repository.
		array(
			'name'      => 'Regenerate Thumbnails',
			'slug'      => 'regenerate-thumbnails',
			'required'  => false,
		),

	);


	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.


);	tgmpa( $plugins, $config );

}