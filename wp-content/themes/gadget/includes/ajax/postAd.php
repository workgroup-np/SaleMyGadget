<?php 
if("postAd"==$_POST['action']):
	include '../../../../../wp-load.php';
	//include '../../../../../mail-function.php';
	global $wpdb;

		$url = $_POST['queryString'];
		$title = sanitize_text_field($_POST['title']);
		$description = wp_kses_post($_POST['description']);

		$parts = parse_url($url);
		parse_str($parts['path'], $queryString);
		var_dump($queryString);
		$Adargs = array(
		  'post_title' => $title,
		  'post_content' => $description,
		  'post_type'     => $queryString['posttype'],
		  'post_status'   => 'publish',
		);
		if($queryString['cat']){
		    $Adargs['tax_input']=array(
		                    $queryString['taxName']=>array(
		                        $queryString['cat']
		                    )
		            );
		}
		if(array_key_exists('subcat', $queryString)){
		    array_push($Adargs['tax_input'][$queryString['taxName']],$queryString['subcat']);
		}if(array_key_exists('subcat1', $queryString)){
		    array_push($Adargs['tax_input'][$queryString['taxName']],$queryString['subcat1']);
		}	

		
		$Adid = wp_insert_post($Adargs);
		if($Adid){
			require_once( ABSPATH . 'wp-admin/includes/image.php' );
	        require_once( ABSPATH . 'wp-admin/includes/file.php' );
	        require_once( ABSPATH . 'wp-admin/includes/media.php' );
	        $attachment_id = media_handle_upload( 'AditemImage', $Adid );
	        if ( !is_wp_error( $attachment_id ) ) {
	            set_post_thumbnail( $Adid, $attachment_id );
	        }
			add_user_meta( $user_id, 'userActivation', $userActivationkey);		
			update_usermeta( $user_id, 'cupp_upload_meta', $profileIamgeFilesMove['url'] );	
			update_usermeta( $user_id, 'mobile', $_POST['mobile'] );
		    add_user_meta( $user_id, 'address', $address);		
		    add_user_meta( $user_id, 'city', $city);	
	        $Message = array('msg'=>'success','Adid'=>$Adid);
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
		}
		else{
			
	        $Message = array('msg'=>'faild','Adid'=>'');
		}
	echo json_encode($Message);
endif;