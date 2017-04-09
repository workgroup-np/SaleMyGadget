<?php
/*
  Template Name: Password Change
 */

if(!isset($_GET['key'])) wp_redirect( home_url() );
$key = esc_attr($_GET['key']);
global $wpdb;
$userId = $wpdb->get_var( "SELECT user_id FROM $wpdb->usermeta WHERE meta_value = '$key'" );
if(empty($userId)) wp_redirect( home_url() );

get_header();
get_template_part( 'template-parts/template-part', 'head' );
?>
<main id="main">
  <div class="login-content text-center">
    <div class="container">
      <div class="login-block">
        
        <div class="error"></div>
        
        <form id="newPassword" method="post" action="" class="login-form">
          <fieldset>
            <div class="form-group">
              <input type="password" name="password" id="password" class="form-control" placeholder="New Password">
            </div>
            <div class="form-group">
              <input type="password" name="cpassword" id="cpassword" class="form-control" placeholder="Confirm Password">
            </div>
            <div class="btn-holder">
              <input type="submit" name="resetPassword" value="Reset Password" id="forget_submit" class="btn-default">
              <input type="hidden" name="key" value="<?php echo esc_attr($key);?>" id="key" class="btn-default">
            </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</main>
<?php get_footer();?>