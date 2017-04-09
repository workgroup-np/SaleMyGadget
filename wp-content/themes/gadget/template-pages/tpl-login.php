<?php
/*
Template Name: Login
 */
if(is_user_logged_in() == true)
{
	wp_redirect( admin_url());
	exit();
}
else
{
get_header();
get_template_part( 'template-parts/template-part', 'head' );
?>
	<section class="login-frame js-scroll-section">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1">
					<div class="group-frame">
						<div class="block-title mark-center">
							<h2><span><?php esc_html_e( 'Login Details', 'sale-my-gadget' ); ?></span></h2>
						</div>
						<form class="general-form" id="LoginForm" action="#!" method="POST">
							<div class="col-xs-12">
								<div class="form-group">
									<input placeholder="Username" id="username" name="username"  class="form-control" type="text">
								</div>
							</div>
							<div class="col-xs-12">
								<div class="form-group">
									<input placeholder="Password" id="password" name="password" class="form-control" type="password">
								</div>
							</div>
							<div class="col-xs-12">
								<div class="btn-group">
									<input value="Sign in" type="submit" class="btn btn-default">
									<div id="loginerror"></div>
									<div id="loader"></div>
								</div>
								<a href="<?php echo home_url('/register/');?>" class="signup"><?php esc_html_e( 'Signup', 'sale-my-gadget' ); ?></a>
								<p><a href="<?php echo home_url('/lost-password/');?>"><?php esc_html_e( 'Forgot your password? Don’t worry it happens.', 'sale-my-gadget' ); ?></a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php
}
get_footer();?>