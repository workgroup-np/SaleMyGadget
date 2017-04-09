<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package gadget
 */
?>

	</div><!-- #content -->
<?php get_template_part('template-parts/footer-widget'); ?>

	<footer id="colophon" class="large-12 columns" role="contentinfo">
            <div class="site-footer">
		<div class="large-6 columns site-info">
                    <?php do_action( 'gadget_credits' ); ?>
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'gadget' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'gadget' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<a href="<?php echo esc_url( __( 'http://www.insertcart.com/product/gadget-wordpress-theme/', 'gadget' ) ); ?>"><?php printf( __( 'Gadget %s', 'gadget' ), 'Theme' ); ?></a>
		<?php wp_nav_menu( array( 'theme_location' => 'footer-menu','container_class' => 'menu-centered','menu_id' => 'footerhorizontal', 'menu_class' => 'menu',    'echo' => true,'depth' =>'1','fallback_cb' => false ) ); ?>
		</div><!-- .site-info -->
                <div class="large-6 columns footer-social">
			<?php  if (get_theme_mod('gadget_hidefotshare')!='1') { get_template_part('template-parts/footer-social'); }?>
                </div><!-- .site-info -->
				
            </div>
	</footer><!-- #colophon -->
</div><!-- #page -->


<?php wp_footer(); ?>
</body>
</html>
