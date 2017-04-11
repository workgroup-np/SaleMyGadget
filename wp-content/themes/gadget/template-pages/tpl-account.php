<?php
/*
Template Name: My Account
 */
get_header();
get_template_part( 'template-parts/template-part', 'head' );
if(is_user_logged_in())
{
	$current_user = wp_get_current_user();
?>
	<section class="signin-frame js-scroll-section">
		<div class="container">
			<div class="signin-content">
				<div class="block-title mark-center">
					<h2><span>Hi <?php echo $current_user->display_name;?></span></h2>
				</div>
				<ul>
					<li>
						<a href="<?php echo home_url('/wp-admin/');?>" class="btn btn-default"><?php esc_html_e( 'View my dashboard','sale-my-gadget');?></a>
					</li>
					<li>
						<a href="<?php echo home_url('/pick-category/');?>" class="btn btn-default"><?php esc_html_e( 'Post Ads','sale-my-gadget');?></a>
					</li>
					<li>
						<a href="<?php echo home_url('/logout/');?>" class="btn btn-default"><?php esc_html_e( 'Logout','sale-my-gadget');?></a>
					</li>
				</ul>
			</div>
		</div>
	</section>
<?php 
}
get_footer();?>