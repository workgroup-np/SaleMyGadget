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
                                 <input id="AdTitle" name="AdTitle" type="text" class="Adtitle form-control" placeholder="Title..">
                                 <div class="AdtitleMessage"></div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="input-holder col-sm-12">
                                 <textarea class="description form-control" id="Addescription" name="Addescription" placeholder="Description.."></textarea>                                 
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
                           <input type="hidden" name="queryString" id="queryString" value="<?php echo esc_attr($_SERVER['QUERY_STRING']);?>">
                           <input type="hidden" name="AdpostType" id="AdpostType" value="<?php echo esc_attr($_GET['posttype']);?>">
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