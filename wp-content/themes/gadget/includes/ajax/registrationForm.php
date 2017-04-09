<?php 
if("registrationForm"==$_POST['action']):
	include '../../../../../wp-load.php';
	//include '../../../../../mail-function.php';
	global $wpdb;
		$type = $_POST['type'];
		$upload_overrides = array( 'test_form' => false );
		$profileImageFiles = $_FILES['profile_image'];
		$profileImageFilesSize =ceil($profileImageFiles['size']/1048576);
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
		$profile_image_files = array(
		      'name'     => $profileImageFiles['name'],
		      'type'     => $profileImageFiles['type'],
		      'tmp_name' => $profileImageFiles['tmp_name'],
		      'error'    => $profileImageFiles['error'],
		      'size'     => $profileImageFiles['size']
		    );
		$profileIamgeFilesMove = wp_handle_upload( $profile_image_files, $upload_overrides );
	$fname =$_POST['fname'];
	$lname =$_POST['lname'];
	$email =$_POST['email'];
	$username =$_POST['username'];
	$mobile = $_POST['mobile'];
	$address = $_POST['address'];
	$city = $_POST['city'];
	if ( username_exists( $username ) ){				
		$error = 'Username is already registered';
	}if ( email_exists($_POST['email']) ){
		$error = 'Email is already registered';
	}
	if (!$error){
		$userdata = array(
			'user_login' => esc_attr( $username ),
			'first_name' => esc_attr( $fname ),
			'last_name' => esc_attr( $lname ),
			'user_email' => esc_attr( $email ),
			'role' => 'author',
			'user_pass'   =>  $_POST['password']
		);
		/** Create User Activation key */
	   	$salt = wp_generate_password(20);
	   	$userActivationkey = sha1($salt . $email . uniqid(time(), true));
		$user_id = wp_insert_user( $userdata );
		/** Insert User status as inactive*/
	    $wpdb->update(
	    $wpdb->users,
	    array('user_status' => 1),
	    array('ID' => $user_id)
	    );	
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
		$details['Name'] = strip_tags($fname);
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
}
endif;