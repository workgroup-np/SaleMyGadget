<?php
/*
Template Name: Post Ad
*/
if(is_user_logged_in() == false){
   wp_redirect( home_url('/login/?redirect=submit-photo/'));
   exit();
}
get_header();
get_template_part( 'template-parts/template-part', 'head' );


// //exit;
// $current_user = wp_get_current_user();
// $current_user_email =$current_user->user_email;
// $current_display_name = $current_user->display_name;
// $submitting_error='';
// $class ='';
// $message ='';
// $media_erro =false;
// if('POST'===$_SERVER['REQUEST_METHOD']):

//    if( isset($_POST['submit_new']) && 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action']=='gallery_submit' && $_POST['title']!='' && $_POST['description']!='' && ($_POST['my_video_upload']!='' || $_POST['my_image_upload_nonce']!=''))
//    {
//       echo $video_link = $_POST['my_video_upload'];
//       if($video_link=='' && $_POST['my_image_upload_nonce']==''){
//          $media_erro =true;
//       }
// //var_dump($_POST);
//       $my_post = array(
//          'post_title' => $_POST['title'],
//          'post_content' => $_POST['description'],
//          'post_status' => 'draft',
//          'post_type' => 'gallery',
//          'tax_input'=>array('species'=>$_POST['fish_species_by_water']),
//          );
//       $post_id = wp_insert_post($my_post);
// //wp_set_post_terms($post_id,array($_POST['fish_species_by_water']),'',true);
//       update_post_meta($post_id,'fish_species',array($_POST['fish_species_type']));
//       update_post_meta($post_id,'video_link',$video_link);

//       if (isset( $_POST['my_image_upload_nonce']) && $post_id!='' && wp_verify_nonce( $_POST['my_image_upload_nonce'], 'my_image_upload' ))
//       {
//          require_once( ABSPATH . 'wp-admin/includes/image.php' );
//          require_once( ABSPATH . 'wp-admin/includes/file.php' );
//          require_once( ABSPATH . 'wp-admin/includes/media.php' );
//          $attachment_id = media_handle_upload( 'my_image_upload', $post_id );

//          if ( is_wp_error( $attachment_id ) ) {
// //echo 'error';
//             $submitting_error=true;
//             $class ='danger';
//             $message ='Error while uploading';

//          } else {
// //$size = 'full';
// //$image_thumb = wp_get_attachment_image_src( $attachment_id, $size );
//             set_post_thumbnail( $post_id, $attachment_id );
//             $submitting_error=false;
//             $class ='success';
//             $message ='Successfully uploaded';
//             unset($_POST);
//          }

//       }
//       else
//       {
//          $submitting_error=false;
//          $class ='success';
//          $message ='Successfully uploaded';

// // The security check failed, maybe show the user an error.
//       }
//       $headers = 'From:'.$current_display_name.'<'.$current_user_email.'>'."\r\n";
//       wp_mail('james@fishnet.com.au,a.shrestha@andmine.com','gallery Submitted','New gallery post has been submitted',$headers);
//       wp_redirect(home_url('/thank-you/'));
//    }
//    else
//    {
//       $submitting_error=true;
//       $class ='danger';
//       $message ='Error while uploading or no Media uploaded';
//       unset($_POST);
//    }
//    endif;
   ?>
   <main id="main">
      <div class="main-container">

         <div class="frame-holder">
            <?php //get_sidebar('fishnet_dashboard');?>
            <div class="container">
               <div class="form-frontend">
                  <form action="#" method="POST" enctype="multipart/form-data" class="select-form" name="postAd" id="postAd">
                     <div class="member_no box">
                        <legend class="form-subtitle"><?php echo esc_html_e('Enter fields below to submit an your Ad','sale-my-gadget');?></legend>
                        <div class="row">
                           <div class="form-group">
                              <div class="input-holder col-sm-12">
                                 <input id="title" name="title" type="text" value="<?php echo $title;?>" class="title form-control" placeholder="Title..">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="input-holder col-sm-12">
                                 <textarea class="description form-control" id="description" name="description" placeholder="Description.."></textarea>                                 
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="label-holder col-sm-12">
                                 <label for="description"><?php _e('Image','sale-my-gadget');?></label>
                              </div>
                              <div class="input-holder col-sm-12">
                                 <input type="file" name="AditemImage" id="AditemImage" class=""  multiple="false" onchange="readURL(this,'#pp_image');"  />
                                 <img src="<?php echo esc_url(get_bloginfo('template_url').'/assets/img/profile-icon.png');?>" alt="Profile Image" id="pp_image" width="32" height="32" >
                              </div>
                           </div>
                        </div>

                        <div class="btn-holder text-center">
                           <div id="loader" style="display:none;"><img src="<?php bloginfo('template_url');?>/assets/img/loading.gif"></div>
                           <input type="text" name="queryString" id="queryString" value="<?php echo esc_attr($_SERVER['QUERY_STRING']);?>">
                           <input type="submit" id="submit_new" value="Submit" name="submit_new" class="custom-btn block btn" >
                        </div>

                     </div>
                     <!--end of non member-->
                  </form>
               </div><!-- main form div-->
            </div><!--container-->
         </div>
      </div>
   </main>
   <?php
   get_footer();
   ?>