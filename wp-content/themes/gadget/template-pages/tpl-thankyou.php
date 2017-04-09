<?php 
/*
Template Name:Thank You
*/
if(is_user_logged_in() == false)
{
	wp_redirect( home_url('/login/'));
	exit(); 
}
get_header();
?>
<main id="main">
  <div class="heading-block text-center inner">
    <div class="container">
      <h1>Activation link has been sent in your email. Please check.</h1>
    </div>
  </div>
</main>
<?php get_footer();

