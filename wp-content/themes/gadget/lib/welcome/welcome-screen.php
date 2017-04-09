<?php
/**
 * Welcome Screen Class
 */
class sale_my_gadget_Welcome {
	/**
	 * Constructor for the welcome screen
	 */
	public function __construct() {
		/* create dashbord page */
		add_action( 'admin_menu', array( $this, 'sale_my_gadget_welcome_register_menu' ) );
		/* activation notice */
		add_action( 'admin_enqueue_scripts', array( $this, 'sale_my_gadget_welcome_style_and_scripts' ) );
		
		/* load welcome screen */
		add_action( 'sale_my_gadget_welcome', array( $this, 'sale_my_gadget_welcome_getting_started' ), 	    10 );
    add_action( 'sale_my_gadget_welcome', array( $this, 'sale_my_gadget_welcome_actions_required' ),      20 );
		add_action( 'sale_my_gadget_welcome', array( $this, 'sale_my_gadget_welcome_contribute' ), 		        30 );
		add_action( 'sale_my_gadget_welcome', array( $this, 'sale_my_gadget_welcome_support' ), 			        40 );
    add_action( 'sale_my_gadget_welcome', array( $this, 'sale_my_gadget_welcome_free_pro' ), 				      50 );
    add_action( 'sale_my_gadget_welcome', array( $this, 'sale_my_gadget_welcome_woo_themes' ), 60 );
    
    /* activation notice */
		add_action( 'load-themes.php', array( $this, 'sale_my_gadget_activation_admin_notice' ) );
	}
  /**
	 * Adds an admin notice upon successful activation.
	 */
	public function sale_my_gadget_activation_admin_notice() {
		global $pagenow;

		if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', array( $this, 'sale_my_gadget_welcome_admin_notice' ), 99 );
		}
	}

	/**
	 * Display an admin notice linking to the welcome screen
	 */
	public function sale_my_gadget_welcome_admin_notice() {
		?>
			<div class="updated notice is-dismissible">
				<p><?php printf( esc_html( 'Welcome! Thank you for choosing %1s! To fully take advantage of the best our theme can offer please make sure you visit our %2s.', 'sale-my-gadget' ), 'Alpha Store', '<a href="' . esc_url( admin_url( 'themes.php?page=sale-my-gadget-welcome' ) ) . '">' . esc_html( 'welcome page', 'sale-my-gadget' ) . '</a>' ); ?></p>
				<p><a href="<?php echo esc_url( admin_url( 'themes.php?page=sale-my-gadget-welcome' ) ); ?>" class="button" style="text-decoration: none;"><?php printf( esc_html( 'Get started with %1s', 'sale-my-gadget' ), 'Alpha Store' ); ?></a></p>
			</div>
		<?php
	}
	/**
	 * Creates the dashboard page
	 * @see  add_theme_page()
	 */
	public function sale_my_gadget_welcome_register_menu() {
		add_theme_page( 'About Alpha Store', __( 'About Alpha Store', 'sale-my-gadget' ), 'activate_plugins', 'sale-my-gadget-welcome', array( $this, 'sale_my_gadget_welcome_screen' ) );
	}
	/**
	 * Load welcome screen css and javascript
	 */
	public function sale_my_gadget_welcome_style_and_scripts( $hook_suffix ) {
		if ( 'appearance_page_sale-my-gadget-welcome' == $hook_suffix ) {
			wp_enqueue_style( 'sale-my-gadget-welcome-screen-css', get_template_directory_uri() . '/lib/welcome/css/welcome.css' );
			wp_enqueue_script( 'sale-my-gadget-welcome-screen-js', get_template_directory_uri() . '/lib/welcome/js/welcome.js', array('jquery') );
		}
	}
	
	/**
	 * Welcome screen content
	 */
	public function sale_my_gadget_welcome_screen($counter) {
		require_once( ABSPATH . 'wp-load.php' );
		require_once( ABSPATH . 'wp-admin/admin.php' );
		require_once( ABSPATH . 'wp-admin/admin-header.php' );
    global $counter;
		?>

		<ul class="sale-my-gadget-nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#getting_started" aria-controls="getting_started" role="tab" data-toggle="tab"><?php esc_html_e( 'Getting started','sale-my-gadget'); ?></a></li>
      <li role="presentation" class="sale-my-gadget-tab sale-my-gadget-w-red-tab"><a href="#actions_required" aria-controls="actions_required" role="tab" data-toggle="tab"><?php esc_html_e( 'Actions recommended','sale-my-gadget'); ?></a></li>
			<li role="presentation"><a href="#contribute" aria-controls="contribute" role="tab" data-toggle="tab"><?php esc_html_e( 'Contribute','sale-my-gadget'); ?></a></li>
			<li role="presentation"><a href="#support" aria-controls="support" role="tab" data-toggle="tab"><?php esc_html_e( 'Support','sale-my-gadget'); ?></a></li>
      <li role="presentation"><a href="#free_pro" aria-controls="free_pro" role="tab" data-toggle="tab"><?php esc_html_e( 'Free VS PRO','sale-my-gadget'); ?></a></li>
      <li role="presentation"><a href="#woo_themes" aria-controls="woo_themes" role="tab" data-toggle="tab"><?php esc_html_e( 'Woo Themes', 'sale-my-gadget' ); ?></a></li>
		</ul>

		<div class="sale-my-gadget-tab-content">

			<?php do_action( 'sale_my_gadget_welcome' ); ?>

		</div>
		<?php
  	}
  	/**
  	 * Getting started
  	 */
  	public function sale_my_gadget_welcome_getting_started() {
  		require_once( get_template_directory() . '/lib/welcome/sections/getting-started.php' );
  	}
    /**
  	 * Actions required
  	 */
  	public function sale_my_gadget_welcome_actions_required() {
  		require_once( get_template_directory() . '/lib/welcome/sections/actions-required.php' );
  	}
  	/**
  	 * Contribute
  	 */
  	public function sale_my_gadget_welcome_contribute() {
  		require_once( get_template_directory() . '/lib/welcome/sections/contribute.php' );
  	}
  	/**
  	 * Support
  	 */
  	public function sale_my_gadget_welcome_support() {
  		require_once( get_template_directory() . '/lib/welcome/sections/support.php' );
  	}
    /**
  	 * Free vs PRO
  	 */
    public function sale_my_gadget_welcome_free_pro() {
  		require_once( get_template_directory() . '/lib/welcome/sections/free_pro.php' );
  	}
    /**
  	 * Woo themes
  	 */
    public function sale_my_gadget_welcome_woo_themes() {
		require_once( get_template_directory() . '/lib/welcome/sections/woo-themes.php' );
	}
}
$GLOBALS['sale_my_gadget_Welcome'] = new sale_my_gadget_Welcome();