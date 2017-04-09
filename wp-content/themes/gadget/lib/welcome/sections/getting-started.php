<?php
/**
 * Getting started template
 */

?>

<div id="getting_started" class="sale-my-gadget-tab-pane active">

	<div class="sale-my-gadget-tab-pane-center">

		<h1 class="sale-my-gadget-welcome-title"><?php printf( esc_html__( 'Welcome to %s!', 'sale-my-gadget' ), 'Alpha Store' ); ?></h1>

		<p><?php esc_html_e( 'Our elegant and professional WooCommerce theme, which turns your Wordpress to awesome eCommerce site.','sale-my-gadget'); ?></p>
		<p><?php printf( esc_html__( 'We want to make sure you have the best experience using %1s and that is why we gathered here all the necessary informations for you. We hope you will enjoy using %2s, as much as we enjoy creating great products.', 'sale-my-gadget' ), 'Alpha Store', 'Alpha Store' ); ?>

	</div>

	<hr />

	<div class="sale-my-gadget-tab-pane-center">

		<h1><?php esc_html_e( 'Getting started', 'sale-my-gadget' ); ?></h1>

		<h4><?php esc_html_e( 'Customize everything in a single place.' ,'sale-my-gadget' ); ?></h4>
		<p><?php esc_html_e( 'Using the WordPress Customizer you can easily customize every aspect of the theme.', 'sale-my-gadget' ); ?></p>
    <p><?php esc_html_e( 'This theme uses Kirki toolkit plugin to customize theme. This plugin adds advanced features to the WordPress customizer. Install the plugin before you go to the customizer.', 'sale-my-gadget' ); ?></p>
		<p>
      <?php if ( is_plugin_active( 'kirki/kirki.php' ) ) { ?>
				<span class="sale-my-gadget-w-activated button"><?php esc_html_e( 'Kirki is already activated', 'sale-my-gadget' ); ?></span>
			<?php	} else { ?>
				<a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=kirki' ), 'install-plugin_kirki' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install Kirki Toolkit', 'sale-my-gadget' ); ?></a>
		  <?php	} ?>
      <a href="<?php echo wp_customize_url(); ?>" class="button button-primary"><?php esc_html_e( 'Go to Customizer', 'sale-my-gadget' ); ?></a>
    </p>

	</div>

	<hr />

	<div class="sale-my-gadget-tab-pane-center">

		<h1><?php esc_html_e( 'FAQ', 'sale-my-gadget' ); ?></h1>

	</div>
  <div class="sale-my-gadget-video-tutorial">
    <div class="sale-my-gadget-tab-pane-half sale-my-gadget-tab-pane-first-half">
  		<h4><?php esc_html_e( 'Theme Setup - step by step', 'sale-my-gadget' ); ?></h4>
      <p><?php esc_html_e( 'You can check our video tutorial how to setup the theme. This may help you to understand how the theme works and check if you miss something when you create your website.', 'sale-my-gadget' ); ?></p>
  	  <p><a href="<?php echo esc_url( 'http://demo.themes4wp.com/documentation/homepage-setup-sale-my-gadget/' ); ?>" class="button"><?php esc_html_e( 'View how to do this', 'sale-my-gadget' ); ?></a></p>
    </div>
    <div class="sale-my-gadget-tab-pane-half video">
      <p class="youtube">
			<a href="<?php echo esc_url( 'https://www.youtube.com/watch?v=eb8PrCVajiM' ); ?>" target="_blank" class="button button-primary"><?php esc_html_e( 'Video tutorial on YouTube', 'sale-my-gadget' ); ?></a>
  		</p>
    </div>
  </div>
  
	<div class="sale-my-gadget-tab-pane-half sale-my-gadget-tab-pane-first-half">

		<h4><?php esc_html_e( 'Create unique homepage', 'sale-my-gadget' ); ?></h4>
		<p><?php esc_html_e( 'In the below documentation you will find an easy way to build an unique homepage design.', 'sale-my-gadget' ); ?></p>
		<p><a href="<?php echo esc_url( 'http://demo.themes4wp.com/documentation/homepage-setup-sale-my-gadget/#homepage-content' ); ?>" class="button"><?php esc_html_e( 'View how to do this', 'sale-my-gadget' ); ?></a></p>

		<hr />
		
		<h4><?php esc_html_e( 'Dummy products', 'sale-my-gadget' ); ?></h4>
		<p><?php esc_html_e( 'When the theme is first installed, you dont have any products probably. You can easily import dummy products with only few clicks.', 'sale-my-gadget' ); ?></p>
		<p><a href="<?php echo esc_url( 'https://docs.woocommerce.com/document/importing-woocommerce-dummy-data/' ); ?>" class="button"><?php esc_html_e( 'View how to do this', 'sale-my-gadget' ); ?></a></p>
    
	</div>

	<div class="sale-my-gadget-tab-pane-half">

		<h4><?php esc_html_e( 'Using Shortcodes', 'sale-my-gadget' ); ?></h4>
		<p><?php esc_html_e( 'Shortcodes allow you to create Buy Now buttons, insert products into pages, display related products or featured products, and more.', 'sale-my-gadget' ); ?></p>
		<p><a href="<?php echo esc_url( 'http://demo.themes4wp.com/documentation/using-shortcodes/' ); ?>" class="button"><?php esc_html_e( 'View how to do this', 'sale-my-gadget' ); ?></a></p>

		<hr />
    
    <h4><?php esc_html_e( 'Create a child theme', 'sale-my-gadget' ); ?></h4>
		<p><?php esc_html_e( 'If you want to make changes to the theme\'s files, those changes are likely to be overwritten when you next update the theme. In order to prevent that from happening, you need to create a child theme. For this, please follow the documentation below.', 'sale-my-gadget' ); ?></p>
		<p><a href="<?php echo esc_url( 'http://demo.themes4wp.com/documentation/how-to-create-a-child-theme/' ); ?>" class="button"><?php esc_html_e( 'View how to do this', 'sale-my-gadget' ); ?></a></p>
		
	</div>

	<div class="sale-my-gadget-clear"></div>

	<hr />

	<div class="sale-my-gadget-tab-pane-center">

		<h1><?php esc_html_e( 'View full documentation', 'sale-my-gadget' ); ?></h1>
		<p><?php printf( esc_html__( 'Need more details? Please check our full documentation for detailed information on how to use %s.', 'sale-my-gadget' ), 'Alpha Store' ); ?></p>
		<p><a href="<?php echo esc_url( 'http://demo.themes4wp.com/documentation/category/sale-my-gadget/' ); ?>" class="button button-primary"><?php esc_html_e( 'Read full documentation', 'sale-my-gadget' ); ?></a></p>

	</div>

	<hr />

	<div class="sale-my-gadget-tab-pane-center">
		<h1><?php esc_html_e( 'Recommended plugins', 'sale-my-gadget' ); ?></h1>
	</div>

	<div class="sale-my-gadget-tab-pane-half sale-my-gadget-tab-pane-first-half">
		<!-- Kirki Toolkit -->
		<h4><?php esc_html_e( 'Kirki Toolkit', 'sale-my-gadget' ); ?></h4>
		<p><?php esc_html_e( 'This theme uses Kirki toolkit plugin to customize theme. This plugin adds advanced features to the WordPress customizer. Install the plugin before you go to the customizer.', 'sale-my-gadget' ); ?></p>
		<?php if ( is_plugin_active( 'kirki/kirki.php' ) ) { ?>
			<p><span class="sale-my-gadget-w-activated button"><?php esc_html_e( 'Already activated', 'sale-my-gadget' ); ?></span></p>
		<?php }	else { ?>
			<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=kirki' ), 'install-plugin_kirki' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install Kirki Toolkit', 'sale-my-gadget' ); ?></a></p>
		<?php }	?>
    
		<hr />
    
		<!-- WooCommerce -->
		<h4><?php esc_html_e( 'WooCommerce', 'sale-my-gadget' ); ?></h4>
		<p><?php esc_html_e( 'WooCommerce is a free eCommerce plugin that allows you to sell anything, beautifully. ', 'sale-my-gadget' ); ?></p>
		<?php if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) { ?>
			<p><span class="sale-my-gadget-w-activated button"><?php esc_html_e( 'Already activated', 'sale-my-gadget' ); ?></span></p>
		<?php }	else { ?>
			<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=woocommerce' ), 'install-plugin_woocommerce' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install WooCommerce', 'sale-my-gadget' ); ?></a></p>
		<?php } ?>
    
		<hr />
    
    <!-- CMB2 -->
		<h4><?php esc_html_e( 'CMB2', 'sale-my-gadget' ); ?></h4>
		<p><?php esc_html_e( 'Homepage template options.', 'sale-my-gadget' ); ?></p>
		<?php if ( is_plugin_active( 'cmb2/init.php' ) ) { ?>
			<p><span class="sale-my-gadget-w-activated button"><?php esc_html_e( 'Already activated', 'sale-my-gadget' ); ?></span></p>
		<?php }	else { ?>
			<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=cmb2' ), 'install-plugin_cmb2' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install CMB2', 'sale-my-gadget' ); ?></a></p>
		<?php } ?>
    
		<hr />
    
		<!-- YITH WooCommerce Wishlist -->
		<h4><?php esc_html_e( 'YITH WooCommerce Wishlist', 'sale-my-gadget' ); ?></h4>
		<p><?php esc_html_e( 'Offer to your visitors a chance to add the products of your woocommerce store to a wishlist page', 'sale-my-gadget' ); ?></p>
		<?php if ( is_plugin_active( 'yith-woocommerce-wishlist/init.php' ) ) { ?>
				<p><span class="sale-my-gadget-w-activated button"><?php esc_html_e( 'Already activated', 'sale-my-gadget' ); ?></span></p>
		<?php } else { ?>
      <p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=yith-woocommerce-wishlist' ), 'install-plugin_yith-woocommerce-wishlist' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install YITH WooCommerce Wishlist', 'sale-my-gadget' ); ?></a></p>
  	<?php } ?>
    
		<hr />
    
	</div>

	<div class="sale-my-gadget-tab-pane-half">
  
		<!-- YITH WooCommerce Compare -->
		<h4><?php esc_html_e( 'YITH WooCommerce Compare', 'sale-my-gadget' ); ?></h4>
		<p><?php esc_html_e( 'YITH WooCommerce Compare plugin is an extension of WooCommerce plugin that allow your users to compare some products of your shop.', 'sale-my-gadget' ); ?></p>
 		<?php if ( is_plugin_active( 'yith-woocommerce-compare/init.php' ) ) { ?>
 			<p><span class="sale-my-gadget-w-activated button"><?php esc_html_e( 'Already activated', 'sale-my-gadget' ); ?></span></p>
    <?php } else { ?> 
 			<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=yith-woocommerce-compare' ), 'install-plugin_yith-woocommerce-compare' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install YITH WooCommerce Compare', 'sale-my-gadget' ); ?></a></p>
 		<?php }	?>
    
		<hr />
    
		<!-- YITH WooCommerce Quick View -->
		<h4><?php esc_html_e( 'YITH WooCommerce Quick View', 'sale-my-gadget' ); ?></h4>
		<p><?php esc_html_e( 'This plugin adds the possibility to have a quick preview of the products right from product list.', 'sale-my-gadget' ); ?></p>
		<?php if ( is_plugin_active( 'yith-woocommerce-quick-view/init.php' ) ) { ?>
			<p><span class="sale-my-gadget-w-activated button"><?php esc_html_e( 'Already activated', 'sale-my-gadget' ); ?></span></p>
		<?php	}	else { ?>
			<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=yith-woocommerce-quick-view' ), 'install-plugin_yith-woocommerce-quick-view' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install YITH WooCommerce Quick View', 'sale-my-gadget' ); ?></a></p>
		<?php	} ?>
    
		<hr />
    
		<!-- WooCommerce Shortcodes -->
		<h4><?php esc_html_e( 'WooCommerce Shortcodes', 'sale-my-gadget' ); ?></h4>
		<p><?php esc_html_e( 'This plugin provides a TinyMCE dropdown button for you use all WooCommerce shortcodes.', 'sale-my-gadget' ); ?></p>
		<?php if ( is_plugin_active( 'woocommerce-shortcodes/woocommerce-shortcodes.php' ) ) { ?>
			<p><span class="sale-my-gadget-w-activated button"><?php esc_html_e( 'Already activated', 'sale-my-gadget' ); ?></span></p>
		<?php	}	else { ?>
			<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=woocommerce-shortcodes' ), 'install-plugin_woocommerce-shortcodes' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install WooCommerce Shortcodes', 'sale-my-gadget' ); ?></a></p>
		<?php	} ?>
    
		<hr />

	</div>

	<div class="sale-my-gadget-clear"></div>

</div>
