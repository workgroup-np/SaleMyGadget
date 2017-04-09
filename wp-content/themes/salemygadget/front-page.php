<?php

/**
 * The front page template for our theme.
 *
 *
 * @package gadget
 */
 if(get_theme_mod('gadget_enablefrontpage') =='true' ) :{
	 get_template_part('template-parts/featured-home');
 }
 elseif(get_option('show_on_front')== 'page') : {
   get_template_part('page');
    
} 
 else :{
     get_template_part('index');
 }
 endif;