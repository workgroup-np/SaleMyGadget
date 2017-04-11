<?php
/*
Template Name: Pick Category
 */
get_header();
get_template_part( 'template-parts/template-part', 'head' );
?>
<?php

$args = array(
   'public'   => true,
   '_builtin' => false
   );

$output = 'names'; // names or objects, note names is the default
$operator = 'and'; // 'and' or 'or'

$post_types = get_post_types( $args, $output, $operator ); 
if($post_types){?>
   <label><?php echo esc_html_e('Pick your category','sale-my-gadget');?></label>
   <select name="postTypeSelect" id="postTypeSelect" class="form-group">
      <option value="none"><?php echo esc_html_e('--Choose one of the cateogry--','sale-my-gadget');?></option><?php
      foreach ( $post_types  as $post_type ):
         echo '<option class="" value="'.esc_attr($post_type).'">' . strtoupper(esc_attr($post_type)) . '</option>';
      endforeach;?>
   </select>
   <div class="catOption" style="display: none;">
      <label><?php echo esc_html_e('Pick your category','sale-my-gadget');?></label>
      <select size="6" class="categorySelect" id="categorySelect" name="categorySelect" class="form-group">
      </select>
   </div>
   <div class="subcatOption" style="display: none;">
      <label><?php echo esc_html_e('Pick your subcategory','sale-my-gadget');?></label>
      <select size="6" class="subcategorySelect" id="subcategorySelect" name="subcategorySelect" class="form-group">
      </select>
   </div>
   <div class="subcatOption2" style="display: none;">
      <label><?php echo esc_html_e('Pick your subcategory','sale-my-gadget');?></label>
      <select size="6" class="subcategory2Select" id="subcategory2Select" name="subcategory2Select" class="form-group">
      </select>
   </div>
   <ul class="selected-option">
   </ul>
   <div id="loader" style="display:none;"><img src="<?php bloginfo('template_url');?>/assets/img/loading.gif"></div>
   <a href="<?php echo home_url('/post-ads');?>" name="proceed" id="proceed" class="proceed-btn disabled"><?php _e('Proceed','sale-my-gadget');?></a>
<?php   
}
get_footer();?>