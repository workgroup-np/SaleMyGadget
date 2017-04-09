<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    echo '<ul class="social">';

    /* facebook */
    if( get_theme_mod('gadget_facebook') ):
            echo '<a target="_blank" alt="Facebook" href="'.esc_url(get_theme_mod('gadget_facebook','gadget')).'"><i class="fa fa-facebook"></i></a>';
    endif;
    /* twitter */
    if(get_theme_mod('gadget_twitter') ):
            echo '<a target="_blank" href="'.esc_url(get_theme_mod('gadget_twitter','gadget')).'"><i class="fa fa-twitter"></i></a>';
    endif;
    /* googleplus */
    if(get_theme_mod('gadget_googleplus') ):
            echo '<a target="_blank" href="'.esc_url(get_theme_mod('gadget_googleplus','gadget')).'"><i class="fa fa-google-plus"></i></a>';
    endif;
    /* linkedin */
    if( get_theme_mod('gadget_linkedin') ):
            echo '<a target="_blank" href="'.esc_url(get_theme_mod('gadget_linkedin','gadget')).'"><i class="fa fa-linkedin"></i></a>';
    endif;
    /* dribbble */
    if(get_theme_mod('gadget_dribbble') ):
            echo '<a target="_blank" href="'.esc_url(get_theme_mod('gadget_dribbble','gadget')).'"><i class="fa fa-dribbble"></i></a>';
    endif;
    /* vimeo */
    if( get_theme_mod('gadget_vimeo')):
            echo '<a target="_blank" href="'.esc_url(get_theme_mod('gadget_vimeo','gadget')).'"><i class="fa fa-vimeo-square"></i></a>';
    endif;
    /* rss */
    if( get_theme_mod('gadget_rss') ):
            echo '<a target="_blank" href="'.esc_url(get_theme_mod('gadget_rss','gadget')).'"><i class="fa fa-rss"></i></a>';
    endif;
    /* instagram */
    if( get_theme_mod('gadget_instagram') ):
            echo '<a target="_blank" href="'.esc_url(get_theme_mod('gadget_instagram','gadget')).'"><i class="fa fa-instagram"></i></a>';
    endif;
    /* pinterest */
    if( get_theme_mod('gadget_pinterest') ):
            echo '<a target="_blank" href="'.esc_url(get_theme_mod('gadget_pinterest','gadget')).'"><i class="fa fa-pinterest"></i></a>';
    endif;
    /* youtube */
    if( get_theme_mod('gadget_youtube')):
            echo '<a target="_blank" href="'.esc_url(get_theme_mod('gadget_youtube','gadget')).'"><i class="fa fa-youtube"></i></a>';
    endif;
    /* skype */
    if( get_theme_mod('gadget_skype') ):
            echo '<a target="_blank" href="'.esc_url(get_theme_mod('gadget_skype','gadget')).'"><i class="fa fa-skype"></i></a>';
    endif;
    /* flickr */
    if( get_theme_mod('gadget_flickr') ):
            echo '<a target="_blank" href="'.esc_url(get_theme_mod('gadget_flickr','gadget')).'"><i class="fa fa-flickr"></i></a>';
    endif;
    
    echo '</ul>';