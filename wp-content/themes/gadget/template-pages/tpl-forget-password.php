<?php
/*
  Template Name: Forget Password
 */
get_header();
get_template_part( 'template-parts/template-part', 'head' );
?>
<main id="main"> 
  <div class="login-content text-center">
    <div class="container">
      <h4 id="sent_mail" style="display:none;"><?php esc_html_e( 'Check your email for reset link.', 'sale-my-gadget' ); ?></h4>
      <div class="login-block">
        <h3><?php esc_html_e( 'Please Enter your email to reset password.', 'sale-my-gadget' ); ?></h3>
        <form id="resetPassword" method="post" action="" class="login-form">
          <fieldset>
            <div class="form-group">
              <input type="email" name="user_email" id="user_email" value="<?php echo $_POST['user_email'] ?>" class="form-control" placeholder="Email Address">
            </div>
            <?php wp_nonce_field('forgotPassword'); ?>
            <div class="btn-holder">
              <input type="submit" name="forget_submit" value="Change Password" id="forget_submit" class="btn-default">
            </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</main>
<?php get_footer();?>