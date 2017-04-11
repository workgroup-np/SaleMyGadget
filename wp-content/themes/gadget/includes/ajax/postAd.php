<?php 
if("postAd"==$_POST['action']):
	include '../../../../../wp-load.php';
var_dump($_POST);die(); 	
	//include '../../../../../mail-function.php';
	global $wpdb;
		$type = $_POST['type'];
		$upload_overrides = array( 'test_form' => false );
		$profileImageFiles = $_FILES['postAd'];
		$profileImageFilesSize =ceil($profileImageFiles['size']/1048576);
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
		$postAd_files = array(
		      'name'     => $profileImageFiles['name'],
		      'type'     => $profileImageFiles['type'],
		      'tmp_name' => $profileImageFiles['tmp_name'],
		      'error'    => $profileImageFiles['error'],
		      'size'     => $profileImageFiles['size']
		    );
		$profileIamgeFilesMove = wp_handle_upload( $postAd_files, $upload_overrides );
		$url = sanitize_text_field($_POST['queryString']);
		$title = sanitize_text_field($_POST['title']);
		$description = wp_kses_post($_POST['description']);

		$parts = parse_url($url);
		parse_str($parts['path'], $queryString);
		$my_post = array(
		  'post_title' => $title,
		  'post_content' => $description,
		  'post_type'     => $queryString['postType'],
		  'post_status'   => 'publish',
		);
		if($queryString['cat']){
		    $my_post['tax_input']=array(
		                    'partner_cat'=>array(
		                        $queryString['cat']
		                    )
		            );
		}
		if($queryString['subcat']){
		    array_push($my_post['tax_input']['partner_cat'],$queryString['subcat']);
		}if($queryString['subcat1']){
		    array_push($my_post['tax_input']['partner_cat'],$queryString['subcat1']);
		}
		$my_post = array(
			'post_title' => $title,
			'post_content' => $description,
			'post_status' => 'publish',
			'post_type' => 'computer',
			'tax_input'=>array('computer_cat'=>$_POST['fish_species_by_water']),
		);
		$post_id = wp_insert_post($my_post);
	    add_user_meta( $user_id, 'userActivation', $userActivationkey);		
		update_usermeta( $user_id, 'cupp_upload_meta', $profileIamgeFilesMove['url'] );	
		update_usermeta( $user_id, 'mobile', $_POST['mobile'] );
	    add_user_meta( $user_id, 'address', $address);		
	    add_user_meta( $user_id, 'city', $city);		
	

		$mail_to = $email;
		$subject = 'Gadget';
		$body_message = 'Please click <a href="'.home_url('/user-activation?email='.$email.'&token='.$token).'">link</a> to activate your account';
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html\r\n";
		$headers .= "From: Sale My Gadget \r\n";
		$headers .= "Reply-To: no_reply@salemygadget.com.au"."\r\n";
		$headers .= "Date: ".date('r', time())."\r\n";
		/*using php mailer*/
		$EmailMessage['PlainText'] ='Please click <a href="'.home_url('/user-activation?email='.$email.'&token='.$token).'">link</a> to activate your account';
		$EmailMessage['HTML'] ='Please click <a href="'.home_url('/user-activation?email='.$email.'&token='.$token).'">link</a> to activate your account';
		$companyname ='Sale My Gadget';
		$companyurl ='http://salemygadget.com/';
		$sendersDomain ='salemygadget.com';
		$CompanyEmail = 'salemygadget@salemygadget.com.au';
		//$SendNotification = new sendNotification($companyname,$companyurl,$sendersDomain,$CompanyEmail);

		$Subject = 'Sale My Gadget Activation Link';
		$details['Name'] = strip_tags($title);
		$details['Email'] = $mail_to;

		// $SendNotification->senders_from_name_ = "Sale My Gadget";
		// $SendNotification->senders_from_email_ = "salemygadget@salemygadget.com.au";
		// $SendNotification->senders_reply_name_ = "Sale My Gadget";
		// $SendNotification->senders_reply_email_ = "no_reply@salemygadget.com.au";
		//$mail_status = $SendNotification->sendMail($details,$Subject,null,false);

		//$mail_status = mail($mail_to, $subject, $body_message, $headers);
	if($mail_status):
		$successMessage = array('msg'=>'success');
	else:
		$successMessage = array('msg'=>'fail');
	endif;
	echo json_encode($successMessage);
endif;