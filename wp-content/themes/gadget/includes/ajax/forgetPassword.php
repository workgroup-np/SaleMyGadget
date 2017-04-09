<?php
//include '../../../../../mail-function.php';
include '../../../../../wp-load.php';
$error = false;
check_ajax_referer( 'forgotPassword' );

$email = $_POST['user_email'];
if( !is_email( $email ) || !email_exists( $email )  ) {
		$error = true;
	}
else{
	$cUser = get_user_by( 'email', $email );
	$salt = wp_generate_password(20);
	$passRecoverKey = sha1($salt . $email . uniqid(time(), true));
	$preparedUrl =  home_url('/password-reset/')."?key=".$passRecoverKey;

	update_user_meta( $cUser->ID, 'passRecoverKey', $passRecoverKey );

 global $EmailMessage;

	$companyname ='Sale My Gadget';
	$companyurl ='http://salemygadget.com/';
	$sendersDomain ='salemygadget.com';
	//$CompanyEmail = 'user.ujjwal@gmail.com';

	$EmailMessage['PlainText'] = "Someone requested that the password be reset for the following account:.\r\n\r\n".
	home_url()."\r\n\r\n".
	"Email =  ".$email."\r\n\r\n".
	"If this was a mistake, just ignore this email and nothing will happen. \r\n\r\n To reset your password, visit the following address:\r\n\r\n".
	 $preparedUrl;

	$EmailMessage['HTML'] = "<html><head><title>title</title></head><body><table>
	<tr><td>Someone requested that the password be reset for the following account:</td></tr>
	<tr><td>Email: $email</td></tr>
	<tr><td>If this was a mistake, just ignore this email and nothing will happen. To reset your password, visit the following address:<a href=\"$preparedUrl\">$preparedUrl</a></td></tr>
	</table></body></html>";


	$SendNotification = new sendNotification($companyname,$companyurl,$sendersDomain,$CompanyEmail);


	$Subject = "Sale My Gadget Password Reset";
	$details['Name'] = $name;
	$details['Email'] = $email;


	$SendNotification->senders_from_name_ = "Sale My Gadget";
	$SendNotification->senders_from_email_ = "rafinkarki@gmail.com";
	$SendNotification->senders_reply_name_ = "Sale My Gadget Team";
	$SendNotification->senders_reply_email_ = $email_new;
	$mail_status =$SendNotification->sendMail($details,$Subject,null,false);
}

if($mail_status):
	$successMessage = array('msg'=>'success');
else:
	$successMessage = array('msg'=>'fail');
endif;
echo json_encode($successMessage);