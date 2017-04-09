<?php
/**
 * Add meta box
 *
 */
function gadgetpage_add_meta_boxes( $post ){
	add_meta_box( 'food_meta_box', __( '<span class="dashicons dashicons-layout"></span> Page Layout Select [Pro Only]', 'gadget' ), 'gadgetpage_build_meta_box', 'page', 'side', 'high' );
}
add_action( 'add_meta_boxes', 'gadgetpage_add_meta_boxes' );
/**
 * Build custom field meta box
 *
 * @param post $post The post object
 */
function gadgetpage_build_meta_box( $post ){
	// make sure the form request comes from WordPress
	wp_nonce_field( basename( __FILE__ ), 'gadgetpagemeta_meta_box_nonce' );
	// retrieve the _food_gadgetpagemeta current value
	$current_gadgetpagemeta = get_post_meta( $post->ID, '_food_gadgetpagemeta', true );
	
	$upgradetopro = 'Layout Select for current Page only - for website layout please choose from theme options <a href="' . esc_url('http://www.insertcart.com/product/gadget-wordpress-theme/','gadget') . '" target="_blank">' . esc_attr__( 'Get Gadget Pro', 'gadget' ) . '</a>';

	?>
	<div class='inside'>

		<h4><?php echo $upgradetopro; ?></h4>
		<p>
			<input type="radio" name="gadgetpagemeta" value="rsd" <?php checked( $current_gadgetpagemeta, 'rsd' ); ?> /> <?php _e('Right Sidebar - Default','gadget'); ?><br />
			<input type="radio" name="gadgetpagemeta" value="ls" <?php checked( $current_gadgetpagemeta, 'ls' ); ?> /> <?php _e('Left Sidebar','gadget'); ?><br/>
			<input type="radio" name="gadgetpagemeta" value="lr" <?php checked( $current_gadgetpagemeta, 'lr' ); ?> />     <?php _e('Left - Right Sidebars','gadget'); ?> <br/>
			<input type="radio" name="gadgetpagemeta" value="fc" <?php checked( $current_gadgetpagemeta, 'fc' ); ?> /> <?php _e('Full Content - No Sidebar','gadget'); ?>
		</p>

		

	</div>
	<?php
}
/**
 * Store custom field meta box data
 *
 * @param int $post_id The post ID.
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/save_post
 */
function gadgetpage_save_meta_box_data( $post_id ){
	// verify meta box nonce
	if ( !isset( $_POST['gadgetpagemeta_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['gadgetpagemeta_meta_box_nonce'], basename( __FILE__ ) ) ){
		return;
	}
	// return if autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
		return;
	}
  // Check the user's permissions.
	if ( ! current_user_can( 'edit_post', $post_id ) ){
		return;
	}
	// store custom fields values
	// gadgetpagemeta string
	if ( isset( $_REQUEST['gadgetpagemeta'] ) ) {
		update_post_meta( $post_id, '_food_gadgetpagemeta', sanitize_text_field( $_POST['gadgetpagemeta'] ) );
	}

}
add_action( 'save_post', 'gadgetpage_save_meta_box_data' );