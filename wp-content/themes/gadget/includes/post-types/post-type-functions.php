<?php
////////////////////////////////////////////////////////////////////
// Showing Bubble Notifications for Custom Post Types
////////////////////////////////////////////////////////////////////
if ( !function_exists( 'sale_my_gadget_pending_posts_bubble' ) ) :
    add_action( 'admin_menu', 'sale_my_gadget_pending_posts_bubble', 999 );

    function sale_my_gadget_pending_posts_bubble() 
    {
        global $menu;

        // Get all post types and remove Attachments from the list
        // Add '_builtin' => false to exclude Posts and Pages
        $args = array( 'public' => true ); 
        $post_types = get_post_types( $args );
        unset( $post_types['attachment'] );

        foreach( $post_types as $pt )
        {
            // Count posts
            $cpt_count = wp_count_posts( $pt );
            if ( $cpt_count->pending ) 
            {
                // Menu link suffix, Post is different from the rest
                $suffix = ( 'post' == $pt ) ? '' : "?post_type=$pt";

                // Locate the key of 
                $key = recursive_array_search_php_91365( "edit.php$suffix", $menu );

                // Not found, just in case 
                if( !$key )
                    return;

                // Modify menu item
                $menu[$key][0] .= sprintf(
                    '<span class="update-plugins count-%1$s" style="background-color:red;color:black"><span class="plugin-count">%1$s</span></span>',
                    $cpt_count->pending 
                );
            }
        }
    }

    // http://www.php.net/manual/en/function.array-search.php#91365
    function recursive_array_search_php_91365( $needle, $haystack ) 
    {
        foreach( $haystack as $key => $value ) 
        {
            $current_key = $key;
            if( 
                $needle === $value 
                OR ( 
                    is_array( $value )
                    && recursive_array_search_php_91365( $needle, $value ) !== false 
                )
            ) 
            {
                return $current_key;
            }
        }
        return false;
    }
endif;

