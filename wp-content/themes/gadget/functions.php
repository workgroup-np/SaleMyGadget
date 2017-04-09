<?php
////////////////////////////////////////////////////////////////////
// Setting Theme-options
////////////////////////////////////////////////////////////////////
include_once( trailingslashit( get_template_directory() ) . 'lib/plugin-activation.php' );
include_once( trailingslashit( get_template_directory() ) . 'lib/theme-config.php' );
include_once( trailingslashit( get_template_directory() ) . 'lib/metaboxes.php' );
include_once( trailingslashit( get_template_directory() ) . 'lib/include-kirki.php' );
require_once( trailingslashit( get_template_directory() ) . 'lib/customize-pro/class-customize.php' );





add_action( 'after_setup_theme', 'sale_my_gadget_setup' );

if ( !function_exists( 'sale_my_gadget_setup' ) ) :

	function sale_my_gadget_setup() {
		// Theme lang
		load_theme_textdomain( 'sale-my-gadget', get_template_directory() . '/assets/languages' );

		// Add Title Tag Support
		add_theme_support( 'title-tag' );

		// Register Menus
		register_nav_menus(
		array(
			'main_menu'	 => __( 'Main Menu', 'sale-my-gadget' ),
			'top_menu'	 => __( 'Top Menu', 'sale-my-gadget' ),
		)
		);

		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 300, 300, true );
		add_image_size( 'sale-my-gadget-single', 688, 325, true );
		add_image_size( 'sale-my-gadget-carousel', 270, absint( get_theme_mod( 'carousel-height', 423 ) ), true );
		add_image_size( 'sale-my-gadget-category', 600, 600, true );
		add_image_size( 'sale-my-gadget-widget', 60, 60, true );

		// Add Custom logo Support
		add_theme_support( 'custom-logo', array(
			'height'		 => 100,
			'width'			 => 400,
			'flex-height'	 => true,
			'flex-width'	 => true,
		) );

		// Add Custom Background Support
		$args = array(
			'default-color' => 'ffffff',
		);
		add_theme_support( 'custom-background', $args );

		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'woocommerce' );
	}

endif;


add_action( 'admin_init', 'sale_my_gadget_notice_ignore' );

function sale_my_gadget_notice_ignore() {
	global $current_user;
	$user_id = $current_user->ID;
	/* If user clicks to ignore the notice, add that to their user meta */
	if ( isset( $_GET[ 'sale_my_gadget_notice_ignore' ] ) && '0' == $_GET[ 'sale_my_gadget_notice_ignore' ] ) {
		add_user_meta( $user_id, 'sale_my_gadget_ignore_notice', 'true', true );
	}
}


////////////////////////////////////////////////////////////////////
// Register Custom Post Types ( Gadets)
////////////////////////////////////////////////////////////////////
include_once( trailingslashit( get_template_directory() ) . 'includes/post-types/post-type-functions.php' );
include_once( trailingslashit( get_template_directory() ) . 'includes/post-types/computer.php' );
include_once( trailingslashit( get_template_directory() ) . 'includes/post-types/mobile.php' );

////////////////////////////////////////////////////////////////////
// Connect User Functions
////////////////////////////////////////////////////////////////////
include_once( trailingslashit( get_template_directory() ) . 'includes/user-functions.php' );


////////////////////////////////////////////////////////////////////
// Change Author to Vendor
////////////////////////////////////////////////////////////////////
function sale_my_gadget_remove_menu_items() {
    if( !current_user_can( 'administrator' ) ):
        remove_menu_page( 'edit.php?post_type=page' );
    	remove_menu_page('tools.php');
    	remove_menu_page('edit-comments.php');
    endif;
}
add_action( 'admin_menu', 'sale_my_gadget_remove_menu_items' );
function sale_my_gadget_change_role_name() {
	global $wp_roles;
	if ( ! isset( $wp_roles ) )
	$wp_roles = new WP_Roles();
	$wp_roles->roles['author']['name'] = 'Vendor';
	$wp_roles->role_names['author'] = 'Vendor';
}
add_action('init', 'sale_my_gadget_change_role_name');


////////////////////////////////////////////////////////////////////
// Enqueue Styles (normal style.css and bootstrap.css)
////////////////////////////////////////////////////////////////////
function sale_my_gadget_theme_stylesheets() {
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css', array(), '3.3.4', 'all' );
	wp_enqueue_style( 'sale-my-gadget-custom-css', get_template_directory_uri() . '/assets/css/custom.css', array(), '', 'all' );
	wp_enqueue_style( 'sale-my-gadget-stylesheet', get_stylesheet_uri(), array(), '1.2.7', 'all' );
	// load Font Awesome css
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '4.6.3' );
	wp_enqueue_style( 'flexslider', get_template_directory_uri() . '/assets/css/flexslider.css', array(), '2.6.3' );
}

add_action( 'wp_enqueue_scripts', 'sale_my_gadget_theme_stylesheets' );

////////////////////////////////////////////////////////////////////
// Register Bootstrap JS with jquery
////////////////////////////////////////////////////////////////////
function sale_my_gadget_theme_js() {
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.js', array( 'jquery' ), '3.3.4' );
	wp_enqueue_script( 'sale-my-gadget-validate-js', get_template_directory_uri() . '/assets/js/jquery.validate.min.js', array( 'jquery' ), '' );
	// wp_enqueue_script( 'sale-my-gadget-map-js', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyC5oDlm-3nj6DZDyapBVSRody71Ix42C8M&libraries=places', array( 'jquery' ), '' );
	// wp_enqueue_script( 'sale-my-gadget-captcha-js', 'https://www.google.com/recaptcha/api.js', array( 'jquery' ), '' );
	//wp_enqueue_script( 'sale-my-gadget-facebook-js', get_template_directory_uri() . '/assets/js/facebook-sdk.js', array( 'jquery' ), '' );
	wp_enqueue_script( 'sale-my-gadget-theme-js', get_template_directory_uri() . '/assets/js/customscript.js', array( 'jquery' ), '1.0.2' );
	wp_localize_script( 'sale-my-gadget-theme-js', 'objectL10n', array(
		'compare'	 => esc_html__( 'Compare Product', 'sale-my-gadget' ),
		'qview'		 => esc_html__( 'Quick View', 'sale-my-gadget' ),
		'directory_url' => get_stylesheet_directory_uri(),
		'site_url' => home_url('/'),
	) );
	wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/assets/js/jquery.flexslider-min.js', array( 'jquery' ), '2.6.3' );
}

add_action( 'wp_enqueue_scripts', 'sale_my_gadget_theme_js' );

////////////////////////////////////////////////////////////////////
// Register Custom Navigation Walker include custom menu widget to use walkerclass
////////////////////////////////////////////////////////////////////

require_once(trailingslashit( get_template_directory() ) . 'lib/wp_bootstrap_navwalker.php');

////////////////////////////////////////////////////////////////////
// Register Widgets
////////////////////////////////////////////////////////////////////

add_action( 'widgets_init', 'sale_my_gadget_widgets_init' );

function sale_my_gadget_widgets_init() {
	register_sidebar(
	array(
		'name'			 => __( 'Right Sidebar', 'sale-my-gadget' ),
		'id'			 => 'sale-my-gadget-right-sidebar',
		'before_widget'	 => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'	 => '</aside>',
		'before_title'	 => '<h3 class="widget-title">',
		'after_title'	 => '</h3>',
	) );

	register_sidebar(
	array(
		'name'			 => __( 'Left Sidebar', 'sale-my-gadget' ),
		'id'			 => 'sale-my-gadget-left-sidebar',
		'before_widget'	 => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'	 => '</aside>',
		'before_title'	 => '<h3 class="widget-title">',
		'after_title'	 => '</h3>',
	) );
	register_sidebar(
	array(
		'name'			 => __( 'Homepage Sidebar', 'sale-my-gadget' ),
		'id'			 => 'sale-my-gadget-home-sidebar',
		'before_widget'	 => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'	 => '</aside>',
		'before_title'	 => '<h3 class="widget-title">',
		'after_title'	 => '</h3>',
	) );
	register_sidebar(
	array(
		'name'			 => __( 'Footer Section', 'sale-my-gadget' ),
		'id'			 => 'sale-my-gadget-footer-area',
		'description'	 => __( 'Content Footer Section', 'sale-my-gadget' ),
		'before_widget'	 => '<div id="%1$s" class="widget %2$s col-md-' . absint( get_theme_mod( 'footer-sidebar-size', 3 ) ) . '">',
		'after_widget'	 => '</div>',
		'before_title'	 => '<h3 class="widget-title">',
		'after_title'	 => '</h3>',
	) );
}

////////////////////////////////////////////////////////////////////
// Register hook and action to set Main content area col-md- width based on sidebar declarations
////////////////////////////////////////////////////////////////////

add_action( 'sale_my_gadget_main_content_width_hook', 'sale_my_gadget_main_content_width_columns' );

function sale_my_gadget_main_content_width_columns() {

	$columns = '12';

	if ( get_theme_mod( 'rigth-sidebar-check', 1 ) != 0 ) {
		$columns = $columns - absint( get_theme_mod( 'right-sidebar-size', 3 ) );
	}

	if ( get_theme_mod( 'left-sidebar-check', 0 ) != 0 ) {
		$columns = $columns - absint( get_theme_mod( 'left-sidebar-size', 3 ) );
	}

	echo $columns;
}

function sale_my_gadget_main_content_width() {
	do_action( 'sale_my_gadget_main_content_width_hook' );
}


////////////////////////////////////////////////////////////////////
// Set Content Width
////////////////////////////////////////////////////////////////////

function sale_my_gadget_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'sale_my_gadget_content_width', 800 );
}
add_action( 'after_setup_theme', 'sale_my_gadget_content_width', 0 );

////////////////////////////////////////////////////////////////////
// Schema.org microdata
////////////////////////////////////////////////////////////////////
function sale_my_gadget_tag_schema() {
	$schema = 'http://schema.org/';

	// Is single post

	if ( is_single() ) {
		$type = 'WebPage';
	}
	// Is author page
	elseif ( is_author() ) {
		$type = 'ProfilePage';
	}

	// Is search results page
	elseif ( is_search() ) {
		$type = 'SearchResultsPage';
	} else {
		$type = 'WebPage';
	}

	echo 'itemscope itemtype="' . $schema . $type . '"';
}

if ( !function_exists( 'sale_my_gadget_breadcrumb' ) ) :

////////////////////////////////////////////////////////////////////
// Breadcrumbs
////////////////////////////////////////////////////////////////////
	function sale_my_gadget_breadcrumb() {
		global $post, $wp_query;

		// schema link

		$schema_link = 'http://data-vocabulary.org/Breadcrumb';
		$home		 = esc_html__( 'Home', 'sale-my-gadget' );
		$delimiter	 = ' &raquo; ';
		$homeLink	 = home_url();
		if ( is_home() || is_front_page() ) {

			// no need for breadcrumbs in homepage
		} else {
			echo '<div id="breadcrumbs" >';
			echo '<div class="breadcrumbs-inner text-right">';

			// main breadcrumbs lead to homepage

			echo '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( $homeLink ) . '">' . '<i class="fa fa-home"></i><span itemprop="title">' . $home . '</span>' . '</a></span>' . $delimiter . ' ';

			// if blog page exists

			if ( 'page' == get_option( 'show_on_front' ) && get_option( 'page_for_posts' ) ) {
				echo '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( get_permalink( get_option( 'page_for_posts' ) ) ) . '">' . '<span itemprop="title">' . esc_html__( 'Blog', 'sale-my-gadget' ) . '</span></a></span>' . $delimiter . ' ';
			}

			if ( is_category() ) {
				$thisCat = get_category( get_query_var( 'cat' ), false );
				if ( $thisCat->parent != 0 ) {
					$category_link = get_category_link( $thisCat->parent );
					echo '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( $category_link ) . '">' . '<span itemprop="title">' . get_cat_name( $thisCat->parent ) . '</span>' . '</a></span>' . $delimiter . ' ';
				}

				$category_id	 = get_cat_ID( single_cat_title( '', false ) );
				$category_link	 = get_category_link( $category_id );
				echo '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( $category_link ) . '">' . '<span itemprop="title">' . single_cat_title( '', false ) . '</span>' . '</a></span>';
			} elseif ( is_single() && !is_attachment() ) {
				if ( get_post_type() != 'post' ) {
					$post_type	 = get_post_type_object( get_post_type() );
					$link		 = get_post_type_archive_link( get_post_type() );
					if ( $link ) {
						printf( '<span><a href="%s">%s</a></span>', esc_url( $link ), $post_type->labels->name );
						echo ' ' . $delimiter . ' ';
					}
					echo get_the_title();
				} else {
					$category = get_the_category();
					if ( $category ) {
						foreach ( $category as $cat ) {
							echo '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( get_category_link( $cat->term_id ) ) . '">' . '<span itemprop="title">' . $cat->name . '</span>' . '</a></span>' . $delimiter . ' ';
						}
					}

					echo get_the_title();
				}
			} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() && !is_search() ) {
				$post_type = get_post_type_object( get_post_type() );
				echo $post_type->labels->singular_name;
			} elseif ( is_attachment() ) {
				$parent = get_post( $post->post_parent );
				echo '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( get_permalink( $parent ) ) . '">' . '<span itemprop="title">' . $parent->post_title . '</span>' . '</a></span>';
				echo ' ' . $delimiter . ' ' . get_the_title();
			} elseif ( is_page() && !$post->post_parent ) {
				echo '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( get_permalink() ) . '">' . '<span itemprop="title">' . get_the_title() . '</span>' . '</a></span>';
			} elseif ( is_page() && $post->post_parent ) {
				$parent_id	 = $post->post_parent;
				$breadcrumbs = array();
				while ( $parent_id ) {
					$page			 = get_page( $parent_id );
					$breadcrumbs[]	 = '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( get_permalink( $page->ID ) ) . '">' . '<span itemprop="title">' . get_the_title( $page->ID ) . '</span>' . '</a></span>';
					$parent_id		 = $page->post_parent;
				}

				$breadcrumbs = array_reverse( $breadcrumbs );
				for ( $i = 0; $i < count( $breadcrumbs ); $i++ ) {
					echo $breadcrumbs[ $i ];
					if ( $i != count( $breadcrumbs ) - 1 )
						echo ' ' . $delimiter . ' ';
				}

				echo $delimiter . '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( get_permalink() ) . '">' . '<span itemprop="title">' . the_title_attribute( 'echo=0' ) . '</span>' . '</a></span>';
			}
			elseif ( is_tag() ) {
				$tag_id = get_term_by( 'name', single_cat_title( '', false ), 'post_tag' );
				if ( $tag_id ) {
					$tag_link = get_tag_link( $tag_id->term_id );
				}

				echo '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( $tag_link ) . '">' . '<span itemprop="title">' . single_cat_title( '', false ) . '</span>' . '</a></span>';
			} elseif ( is_author() ) {
				global $author;
				$userdata = get_userdata( $author );
				echo '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( get_author_posts_url( $userdata->ID ) ) . '">' . '<span itemprop="title">' . $userdata->display_name . '</span>' . '</a></span>';
			} elseif ( is_404() ) {
				echo esc_html__( 'Error 404', 'sale-my-gadget' );
			} elseif ( is_search() ) {
				echo esc_html__( 'Search results for', 'sale-my-gadget' ) . ' ' . get_search_query();
			} elseif ( is_day() ) {
				echo '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '">' . '<span itemprop="title">' . get_the_time( 'Y' ) . '</span>' . '</a></span>' . $delimiter . ' ';
				echo '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ) . '">' . '<span itemprop="title">' . get_the_time( 'F' ) . '</span>' . '</a></span>' . $delimiter . ' ';
				echo '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( get_day_link( get_the_time( 'Y' ), get_the_time( 'm' ), get_the_time( 'd' ) ) ) . '">' . '<span itemprop="title">' . get_the_time( 'd' ) . '</span>' . '</a></span>';
			} elseif ( is_month() ) {
				echo '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '">' . '<span itemprop="title">' . get_the_time( 'Y' ) . '</span>' . '</a></span>' . $delimiter . ' ';
				echo '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ) . '">' . '<span itemprop="title">' . get_the_time( 'F' ) . '</span>' . '</a></span>';
			} elseif ( is_year() ) {
				echo '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '">' . '<span itemprop="title">' . get_the_time( 'Y' ) . '</span>' . '</a></span>';
			}

			if ( get_query_var( 'paged' ) ) {
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() )
					echo ' (';
				echo esc_html__( 'Page', 'sale-my-gadget' ) . ' ' . get_query_var( 'paged' );
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() )
					echo ')';
			}

			echo '</div></div>';
		}
	}

endif;
////////////////////////////////////////////////////////////////////
// Social links
////////////////////////////////////////////////////////////////////
if ( !function_exists( 'sale_my_gadget_social_links' ) ) :

	/**
	 * This function is for social links display on header
	 *
	 * Get links through Theme Options
	 */
	function sale_my_gadget_social_links() {
		$twp_social_links	 = array( 
			'twp_social_facebook'	 => 'facebook',
			'twp_social_twitter'	 => 'twitter', 
			'twp_social_google'		 => 'google-plus',
			'twp_social_instagram'	 => 'instagram',
			'twp_social_pin'		 => 'pinterest',
			'twp_social_youtube'	 => 'youtube',
			'twp_social_reddit'		 => 'reddit',
			'twp_social_linkedin'	 => 'linkedin',
			'twp_social_skype'		 => 'skype',
			'twp_social_vimeo'		 => 'vimeo',
			'twp_social_flickr'		 => 'flickr',
			'twp_social_dribble'	 => 'dribbble',
			'twp_social_envelope-o'	 => 'envelope-o',
			'twp_social_rss'		 => 'rss',
		);
		?>
		<div class="social-links">
			<ul>
				<?php
				$i					 = 0;
				$twp_links_output	 = '';
				foreach ( $twp_social_links as $key => $value ) {
					$link = get_theme_mod( $key, '' );
					if ( !empty( $link ) ) {
						$twp_links_output .=
						'<li><a href="' . esc_url( $link ) . '" target="_blank"><i class="fa fa-' . strtolower( $value ) . '"></i></a></li>';
					}
					$i++;
				}
				echo $twp_links_output;
				?>
			</ul>
		</div><!-- .social-links -->
		<?php
	}

endif;


////////////////////////////////////////////////////////////////////
// Excerpt functions
////////////////////////////////////////////////////////////////////
function sale_my_gadget_excerpt_length( $length ) {
	return 25;
}

add_filter( 'excerpt_length', 'sale_my_gadget_excerpt_length', 999 );

function sale_my_gadget_excerpt_more( $more ) {
	return '&hellip;';
}

add_filter( 'excerpt_more', 'sale_my_gadget_excerpt_more' );

////////////////////////////////////////////////////////////////////
// Schema publisher function
////////////////////////////////////////////////////////////////////
if ( !function_exists( 'sale_my_gadget_entry_publisher' ) ) {
	function sale_my_gadget_entry_publisher() {
		$image_id = get_theme_mod( 'custom_logo' );
		$img	 = wp_get_attachment_image_src( $image_id, 'full' );
		// Uncomment your choice below.
		$publisher = 'https://schema.org/Organization';
		//$publisher = 'https://schema.org/Person';
		$publisher_name =  get_bloginfo( 'name', 'display' );
		$logo = $img[0]; 
		$logo_width = $img[1]; 
		$logo_height = $img[2]; 
		
		if ( ! isset( $publisher ) || ! isset( $logo ) || ! isset( $publisher_name ) ) {
			return;
		}
		printf( '<div itemprop="publisher" itemscope itemtype="%s">', esc_url( $publisher ) );
			echo '<div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">';
				printf( '<meta itemprop="url" content="%s">', esc_url( $logo ) );
				printf( '<meta itemprop="width" content="%d">', esc_attr( $logo_width ) );
				printf( '<meta itemprop="height" content="%d">', esc_attr( $logo_height ) );
			echo '</div>';
			printf( '<meta itemprop="name" content="%s">', esc_attr( $publisher_name ) );
		echo '</div>';
	}
}

////////////////////////////////////////////////////////////////////
// Authenticate User
////////////////////////////////////////////////////////////////////
add_filter('authenticate', 'sale_my_gadget_allow_email_login', 20, 3);
function sale_my_gadget_allow_email_login( $user, $username, $password ) {
	$user = get_user_by( 'login', $username );
	if ( $user )
		$username = $user->user_login;
	$userStatus = $user->user_status;
	if($userStatus == 0){
		$pass = wp_authenticate_username_password(null, $username, $password );
		return $pass;
	}
}

////////////////////////////////////////////////////////////////////
// Logout Redirect
////////////////////////////////////////////////////////////////////

function sale_my_gadget_logout_redirect_home(){
	wp_safe_redirect(home_url('/login'));
	exit;
}
add_action('wp_logout', 'sale_my_gadget_logout_redirect_home');