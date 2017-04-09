<?php
if($_POST['action']==='contactForm'):
$fname =$_POST['fname'];
$lname =$_POST['lname'];
$eemail =$_POST['eemail'];
$pphone =$_POST['pphone'];
$cname =$_POST['cname'];
$mmessage =$_POST['mmessage'];

$client  = @$_SERVER['HTTP_CLIENT_IP'];
$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
$remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }
    $mail_to = $eemail;
    /* main to contact person*/
	$subject = 'Contact Form';
	$body_message = 'Contact Submission Sent';

	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html\r\n";
	$headers .= "From: Black Diamondz <'blackdiamond@blackdiamond.com.au'>\r\n";
	$headers .= "Reply-To: no_reply@blackdiamond.com.au"."\r\n";
	$headers .= "Date: ".date('r', time())."\r\n";

	$mail_status = mail($mail_to, $subject, $body_message, $headers);

	//sending mail to admin
	$mail_to_admin = 'stephanie@blackdiamondz.com.au,a.kalb@andmine.com';
	$subject_admin = 'Contact Form Details Received';
	$body_message_admin = '<html><head><title>New Contacts</title></head><body>
	<table>
	<tr><td><h3>New Enquiry</h3></td></tr>
	<tr><th> Enquiry Details</th></tr>
	<tr>
	<table style="border:1px solid black;border-collapse:collapse;width:30%">
	</table>
	</tr>
	</table>
	</body>
	</html>';
	$headers_admin  = "MIME-Version: 1.0\r\n";
	$headers_admin .= "Content-type: text/html\r\n";
	$headers_admin .= 'From: '.$fname.' '.$lname.'<'.$eemail.'>'."\r\n";
	$headers_admin .= 'Reply-To: '.$email."\r\n";
	$headers_admin .= "Date: ".date('r', time())."\r\n";

	$mail_status_admin = mail($mail_to_admin, $subject_admin, $body_message_admin, $headers_admin);
	if($mail_status_admin){
		echo $success = "Success";
	}
	else
	{
		echo $success = "Fail";
	}
endif;
if("registrationForm"==$_POST['action']):
	include '../../../../../wp-load.php';
	include '../../../../../mail-function.php';
		$type = $_POST['type'];
		$upload_overrides = array( 'test_form' => false );
		$uploadedfiles = $_FILES['cover_letter'];
		$fileSize =ceil($uploadedfiles['size']/1048576);
		//if($fileSize<=7):
		//if($_FILES['file']):
			require_once( ABSPATH . 'wp-admin/includes/file.php' );
		$file_cover = array(
		      'name'     => $uploadedfiles['name'],
		      'type'     => $uploadedfiles['type'],
		      'tmp_name' => $uploadedfiles['tmp_name'],
		      'error'    => $uploadedfiles['error'],
		      'size'     => $uploadedfiles['size']
		    );
		$movefile = wp_handle_upload( $file_cover, $upload_overrides );
		$resumeFiles = $_FILES['resume_letter'];
		$resumeFilesSize =ceil($resumeFiles['size']/1048576);
		//if($fileSize<=7):
		//if($_FILES['file']):
			require_once( ABSPATH . 'wp-admin/includes/file.php' );
		$file_resume = array(
		      'name'     => $resumeFiles['name'],
		      'type'     => $resumeFiles['type'],
		      'tmp_name' => $resumeFiles['tmp_name'],
		      'error'    => $resumeFiles['error'],
		      'size'     => $resumeFiles['size']
		    );
		$resumeFilesMove = wp_handle_upload( $file_resume, $upload_overrides );

		$profileImageFiles = $_FILES['profile_image'];
		$profileImageFilesSize =ceil($profileImageFiles['size']/1048576);
		//if($fileSize<=7):
		//if($_FILES['file']):
			require_once( ABSPATH . 'wp-admin/includes/file.php' );
		$profile_image_files = array(
		      'name'     => $profileImageFiles['name'],
		      'type'     => $profileImageFiles['type'],
		      'tmp_name' => $profileImageFiles['tmp_name'],
		      'error'    => $profileImageFiles['error'],
		      'size'     => $profileImageFiles['size']
		    );
		$profileIamgeFilesMove = wp_handle_upload( $profile_image_files, $upload_overrides );
		// var_dump($movefile);
		// var_dump($resumeFilesMove);
		// exit;
		//endif;
	$fname =$_POST['fname'];
	$lname =$_POST['lname'];
	$email =$_POST['email'];
	$company =$_POST['company'];
	$industry =$_POST['industry'];
	$location =$_POST['talentlocation'];
	$expertise =$_POST['expertise'];
	$salary =$_POST['salary'];
	$contact_number = $_POST['contact_number'];
	$workplace = $_POST['workplace'];

	$interest_in = $_POST['interest_in'];
	$work_type = $_POST['work_type'];
	$mobile = $_POST['mobile'];
	$phone = $_POST['phone'];
	$skills = $_POST['skills'];
	$mrole = $_POST['mrole'];
	$prev_exp = $_POST['prev_exp'];
	$level_education = $_POST['level_education'];

	global $wpdb;
			$user_login = explode("@", $_POST['email']);
		if ( username_exists( $user_login[0] ) ){

				$user_login[0].= "-".date('YmdHms');
				//$error = 'Username is already registered';
		}if ( email_exists($_POST['email']) ){
				$error = 'Email is already registered';
		}
		if (!$error){
			$userdata = array(
				'user_login' => esc_attr( $email ),
				'first_name' => esc_attr( $fname ),
				'last_name' => esc_attr( $lname ),
				'user_email' => esc_attr( $email ),
				'role' => $type,
				'user_pass'   =>  $_POST['password']
			);
			$token = bin2hex(random_bytes(9));
			$user_id = wp_insert_user( $userdata );
			update_usermeta( $user_id, 'iname', $_POST['industry'] );
			update_usermeta( $user_id, 'cname', $_POST['company'] );
			update_usermeta( $user_id, 'contact_number', $_POST['contact_number'] );
			update_usermeta( $user_id, 'workplace', $_POST['workplace'] );
			update_usermeta( $user_id, 'talentlocation', $_POST['talentlocation'] );
			update_usermeta( $user_id, 'description', $_POST['user_desc'] );
			update_usermeta( $user_id, 'cover_letter', $movefile['url'] );
			update_usermeta( $user_id, 'resume_letter', $resumeFilesMove['url'] );
			update_usermeta( $user_id, 'cupp_upload_meta', $profileIamgeFilesMove['url'] );
			update_usermeta( $user_id, 'activationToken', $token );
			$wpdb->update( $wpdb->users, array('user_status' => 1), array('ID' => $user_id));
			if($type=='employee')
			{
				update_usermeta( $user_id, 'interest_in', $_POST['interest_in'] );
				update_usermeta( $user_id, 'salary', $_POST['salary'] );
				update_usermeta( $user_id, 'work_type', $_POST['work_type'] );
				update_usermeta( $user_id, 'mobile', $_POST['mobile'] );
				update_usermeta( $user_id, 'phone', $_POST['phone'] );
				update_usermeta( $user_id, 'skills', $_POST['skills'] );
				update_usermeta( $user_id, 'mrole', $_POST['mrole'] );
				update_usermeta( $user_id, 'prev_exp', $_POST['prev_exp'] );
				update_usermeta( $user_id, 'level_education', $_POST['level_education'] );

			}elseif($type=='client')
			{

			}
	 //print_r($userdata);exit;
//$insert = $wpdb->insert($wpdb->prefix.'register', array( 'fname' => $fname, 'lname' => $lname,'email'=>$email,'company'=>$company,'industry'=>$industry,'type'=>$type,'location'=>$location,'expertise'=>$expertise,'salary'=>$salary ), array( '%s', '%s','%s', '%s','%s','%s','%s','%s','%s' ) );

		$mail_to = $email;
		$subject = 'Black Diamondz Activation Link';
		$body_message = 'Please click <a href="'.home_url('/activation?email='.$email.'&token='.$token).'">link</a> to activate your account';
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html\r\n";
		$headers .= "From: Black Diamondz <'blackdiamond@blackdiamond.com.au'>\r\n";
		$headers .= "Reply-To: no_reply@blackdiamond.com.au"."\r\n";
		$headers .= "Date: ".date('r', time())."\r\n";
/*using php mailer*/
$EmailMessage['PlainText'] ='Please click <a href="'.home_url('/activation?email='.$email.'&token='.$token).'">link</a> to activate your account';
$EmailMessage['HTML'] ='Please click <a href="'.home_url('/activation?email='.$email.'&token='.$token).'">link</a> to activate your account';
		$companyname ='Black Diamondz';
		$companyurl ='http://bdrecruitment.com/';
		$sendersDomain ='bdrecruitment.com';
		$CompanyEmail = 'blackdiamond@blackdiamond.com.au';
		$SendNotification = new sendNotification($companyname,$companyurl,$sendersDomain,$CompanyEmail);

		$Subject = 'Black Diamondz Activation Link';
		$details['Name'] = strip_tags($fname);
		$details['Email'] = $mail_to;
		//$SendNotification->debug = true;
		//echo "789";
		//$details['Name'] = "Rajendra, iPad";
		//$details['Email'] = "r.bhattarai@andmine.com,ipad@andmine.com";

		$SendNotification->senders_from_name_ = "Black Diamondz";
		$SendNotification->senders_from_email_ = "blackdiamond@blackdiamond.com.au";
		$SendNotification->senders_reply_name_ = "Black Diamondz";
		$SendNotification->senders_reply_email_ = "no_reply@blackdiamond.com.au";
		// without attachment
		//$SendNotification->sendMail($details,$Subject,null,false);
		// with attachment
		$mail_status = $SendNotification->sendMail($details,$Subject,null,false);

		//$mail_status = mail($mail_to, $subject, $body_message, $headers);
	if($mail_status):
		$successMessage = array('msg'=>'success');
	else:
		$successMessage = array('msg'=>'fial');
	endif;
	echo json_encode($successMessage);
}
endif;



if('talentSearch'==$_POST['action']):
	include '../../../../../wp-load.php';

	if(is_user_logged_in()){
		$user_lof = 'true';
	}
	else
	{
		$user_lof = 'false';
	}

	$talentKey = $_POST['talentKey'];
	$talentLocation = $_POST['talentLocation'];

	$skills = $_POST['skills'];
	$mrole = $_POST['mrole'];
	$level_education = $_POST['level_education'];
	$interest_in = $_POST['interest_in'];
	$work_type = $_POST['work_type'];

	$data='<div class="container"><div class="block-title"><h2><span>Results</span></h2></div><ul class="result-thumb">';
	$count=1;
	global $wpdb;
$args = array(
			'role'         => 'employee',
			'orderby'      => 'login',
			'order'        => 'ASC',
			'search'         => '*'.esc_attr( $talentKey ).'*',
			 'search_columns' => array(
										'user_login',
										'user_nicename',
										'user_email',
										'user_url',
									),
			'count_total'  => true,
			'fields'       => 'all',
				'meta_query' => array(
					// array(
					// 	'key'     => 'featured_user',
					// 	'value'   => 'on',
					// 	'compare' => '===',
					// ),
					array(
						'key'     => 'interest_in',
						'value'   => $interest_in,
						'compare' => '===',
					),
					array(
						'key'     => 'work_type',
						'value'   => $work_type,
						'compare' => '===',
					),
					array(
						'key'     => 'skills',
						'value'   => $skills,
						'compare' => 'LIKE',
					),
					array(
						'key'     => 'level_education',
						'value'   => $level_education,
						'compare' => '===',
					),
					array(
						'key'     => 'mrole',
						'value'   => $mrole,
						'compare' => '===',
					),
					array(
						'key'     => 'talentlocation',
						'value'   => $talentLocation,
						'compare' => '===',
					),
				),
			);
$user_args = array(
					'role'         => 'employee',
					'orderby'      => 'login',
					'order'        => 'ASC',
					//'search'	   =>esc_sql('%'.$talentKey.'%'),
					'count_total'  => true,
					'fields'       => 'all',
				);
if($talentKey!='')
{

			$user_arg['search']= '*'.esc_attr( $talentKey ).'*';
			 $user_arg['search_columns']= array(
										'user_login',
										'user_nicename',
										'user_email',
										'user_url',
									);
}
$user_args['meta_query'] = array('relation' => 'AND');
if($interest_in!='')
{
	array_push($user_args['meta_query'],	array(
							'key'     => 'interest_in',
							'value'   => $interest_in,
							'compare' => '==='
						));
}

if($work_type!='')
{
	array_push($user_args['meta_query'],	array(
							'key'     => 'work_type',
							'value'   => $work_type,
							'compare' => '==='
						));
}

if($skills!='')
{
	array_push($user_args['meta_query'],	array(
							'key'     => 'skills',
							'value'   => $skills,
							'compare' => 'LIKE'
						));
}

if($level_education!='')
{
	array_push($user_args['meta_query'],	array(
							'key'     => 'level_education',
							'value'   => $level_education,
							'compare' => '==='
						));
}

if($mrole!='')
{
	array_push($user_args['meta_query'],	array(
							'key'     => 'mrole',
							'value'   => $mrole,
							'compare' => '==='
						));
}

if($talentLocation!='')
{
	array_push($user_args['meta_query'],	array(
							'key'     => 'talentLocation',
							'value'   => $talentLocation,
							'compare' => '==='
						));
}

$f_staff_details = get_users( $user_args );
// $whole_query ="SELECT bd_users.* FROM bd_users INNER JOIN bd_usermeta ON ( bd_users.ID = bd_usermeta.user_id ) INNER JOIN bd_usermeta AS mt1 ON ( bd_users.ID = mt1.user_id ) INNER JOIN bd_usermeta AS mt2 ON ( bd_users.ID = mt2.user_id ) INNER JOIN bd_usermeta AS mt3 ON ( bd_users.ID = mt3.user_id ) INNER JOIN bd_usermeta AS mt4 ON ( bd_users.ID = mt4.user_id ) INNER JOIN bd_usermeta AS mt5 ON ( bd_users.ID = mt5.user_id ) INNER JOIN bd_usermeta AS mt6 ON ( bd_users.ID = mt6.user_id ) WHERE 1=1 AND ( ( ( ( bd_usermeta.meta_key = 'interest_in' AND CAST(bd_usermeta.meta_value AS CHAR) = '".$interest_in."' ) AND ( mt1.meta_key = 'work_type' AND CAST(mt1.meta_value AS CHAR) = '".$work_type."' ) AND ( mt2.meta_key = 'skills' AND CAST(mt2.meta_value AS CHAR) LIKE '%".$skills."%' ) AND ( mt3.meta_key = 'level_education' AND CAST(mt3.meta_value AS CHAR) = '".$level_education."' ) AND ( mt4.meta_key = 'mrole' AND CAST(mt4.meta_value AS CHAR) = '".$mrole."' ) AND ( mt5.meta_key = 'talentlocation' AND CAST(mt5.meta_value AS CHAR) = '".$talentLocation."' ) ) AND ( ( ( mt6.meta_key = 'bd_capabilities' AND CAST(mt6.meta_value AS CHAR)  LIKE '%\"employee\"%' ) ) ) ) ) AND (user_login LIKE '%".$talentKey."%' OR user_url LIKE '%".$talentKey."%' OR user_email LIKE '%".$talentKey."%' OR user_nicename LIKE '%".$talentKey."%' OR display_name LIKE '%".$talentKey."%') ORDER BY user_login ASC";

//$f_staff_details = $wpdb->get_results($whole_query);
if($f_staff_details!=''):
	foreach($f_staff_details as $f_staff_detail){
		$img_src =get_user_meta( $f_staff_detail->ID,'cupp_upload_meta',true );
		if($img_src!='')
		{
			$img_src_a = aq_resize( $img_src, $width = 193, $height = 265, $crop = true, $single = true, $upscale = true );
		}
		else
		{
			$img_src_a = get_bloginfo("template_url").'/assets/images/img-staff.jpg';
		}
		//$data .= '<li><div class="staff-frame"><img src="'.$img_src_a.'" alt="image description" width="176" height="247"><span class="hover-detail"><span class="name">'.$f_staff_detail->display_name.'</span><a href="#!" class="btn btn-default talent_details" id="'.$f_staff_detail->ID.'">Find Out More</a></span></div></li>';
		$data .='<li><div class="staff-frame"><img src="'.$img_src_a.'" alt="image description" width="193" height="265"><div class="hover-frame"><div class="name"><h3>'.$f_staff_detail->display_name.'</h3></div><div class="btn-group"><a href="#!" class="btn btn-default talent_details" id="'.$f_staff_detail->ID.'">Find Out More</a></div></div></div></li>';
		$count++;
	}
endif;
$data .='</ul></div>';
		echo json_encode(array('msg'=>'success','content'=>$data,'count'=>$count,'userloging'=>$user_lof));
endif;


if('haveAquestion'==$_POST['action']):
	include '../../../../../wp-load.php';
	$have_fname =$_POST['have_fname'];
	$have_lname =$_POST['have_lname'];
	$have_email = $_POST['have_email'];
	$have_phone = $_POST['have_phone'];
	$have_company =$_POST['have_company'];
	$have_message = $_POST['have_message'];

	global $wpdb;
	$insert = $wpdb->insert('bd_have_a_question', 	array( 'first_name' => $have_fname, 'last_name' => $have_lname,'email' =>$have_email, 'phone' =>$have_phone,'company' =>$have_company, 'message' =>$have_message,'time'=>time() ) );
	if($insert)
	{
		$mail_to = $have_email;
		$subject = 'Have A Question Form';
		//$body_message = 'Question has been Sent';
		$image = 'http://bdrecruitment.com/wp-content/uploads/2016/09/1474605420-300x42.png';
						$body_message = '<div style="text-align:center;font-size: 18px;max-width: 600px;margin: 0 auto;">
								<img src="'.$image.'" alt="Blac Diamondz Inquiry" /> <br><br>
								<br><br>Hi there,<br /><br />
								Firstly, thank you for taking the time to make an enquiry through BDRC.<br><br>
								This is a courtesy email to let you know that we have received your message. We are excited to hear from talented candidates who are interested in finding the best possible new roles and clients who would like to find out more about BDRC and the difference we can bring to your business! We will do our best to get back to you within 24 hours.<br><br>
								If you have any questions, please feel free to use directly.<br><br>
								Warmest regards,<br><br>Black Diamondz Recruitment Concierge <br>World Square. Suite 31. Level 2. 650 George Street. Sydney. 2000<br> P <a href="tel:+61282808280">+61282808280</a> M <a href="+61414552299">+61414552299 </a> W <a href="http://bdrecruitment.com/">bdrecruitment.com</a><br></div>';

		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html\r\n";
		$headers .= "From: Black Diamondz <'blackdiamond@blackdiamond.com.au'>\r\n";
		$headers .= "Reply-To: no_reply@blackdiamond.com.au"."\r\n";
		$headers .= "Date: ".date('r', time())."\r\n";

		$mail_status = mail($mail_to, $subject, $body_message, $headers);

		//sending mail to admin
		$mail_to_admin = 'stephanie@blackdiamondz.com.au,a.kalb@andmine.com';
		$subject_admin = 'Have A Question Received';
		$body_message_admin = '<html><head><title>New Question</title></head><body>
		<table>
		<tr><td><h3>New Question</h3></td></tr>
		<tr><td><strong>FROM</strong> : '.$have_fname.' '.$have_lname.'</td></tr>
		<tr><td><strong>Email</strong> : '.$have_email.'</td></tr>
		<tr><td><strong>Phone</strong> : '.$have_phone.'</td></tr>
		<tr><td><strong>Company</strong> : '.$have_company.'</td></tr>
		<tr><td><strong>Question Detail (message)</strong> : '.$have_message.'</td></tr>
		</table>
		</body>
		</html>';
		$headers_admin  = "MIME-Version: 1.0\r\n";
		$headers_admin .= "Content-type: text/html\r\n";
		$headers_admin .= 'From: '.$have_fname.' '.$have_lname.'<'.$have_email.'>'."\r\n";
		$headers_admin .= 'Reply-To: '.$have_email."\r\n";
		$headers_admin .= "Date: ".date('r', time())."\r\n";

		$mail_status_admin = mail($mail_to_admin, $subject_admin, $body_message_admin, $headers_admin);
		if($mail_status_admin){
		echo json_encode(array('msg'=>'success'));
		}
		else
		{
			echo json_encode(array('msg'=>'fail'));
		}
	}
	else
	{
		echo json_encode(array('msg'=>'fail','reason'=>'fail to save on db'));
	}
endif;


if('sendQuestion'==$_POST['action']):
	include '../../../../../wp-load.php';
	$have_fname =$_POST['fname'];
	$have_lname =$_POST['lname'];
	$have_email = $_POST['eemail'];
	$have_phone = $_POST['pphone'];
	$have_company =$_POST['cname'];
	$have_message = $_POST['send_message'];

	global $wpdb;
	$insert = $wpdb->insert('bd_send_a_question', 	array( 'first_name' => $have_fname, 'last_name' => $have_lname,'email' =>$have_email, 'phone' =>$have_phone,'company' =>$have_company, 'message' =>$have_message,'time'=>time() ) );
	if($insert)
	{
		$mail_to = $have_email;
		$subject = 'Send Us Question Form';
				$image = 'http://bdrecruitment.com/wp-content/uploads/2016/09/1474605420-300x42.png';
						$body_message = '<div style="text-align:center;font-size: 18px;max-width: 600px;margin: 0 auto;">
								<img src="'.$image.'" alt="Blac Diamondz Inquiry" /> <br><br>
								<br><br>Hi there,<br /><br />
								Firstly, thank you for taking the time to make an enquiry through BDRC.<br><br>
								This is a courtesy email to let you know that we have received your message. We are excited to hear from talented candidates who are interested in finding the best possible new roles and clients who would like to find out more about BDRC and the difference we can bring to your business! We will do our best to get back to you within 24 hours.<br><br>
								If you have any questions, please feel free to use directly.<br><br>
								Warmest regards,<br><br>Black Diamondz Recruitment Concierge <br>World Square. Suite 31. Level 2. 650 George Street. Sydney. 2000<br> P <a href="tel:+61282808280">+61282808280</a> M <a href="+61414552299">+61414552299 </a> W <a href="http://bdrecruitment.com/">bdrecruitment.com</a><br></div>';

		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html\r\n";
		$headers .= "From: Black Diamondz <'blackdiamond@blackdiamond.com.au'>\r\n";
		$headers .= "Reply-To: no_reply@blackdiamond.com.au"."\r\n";
		$headers .= "Date: ".date('r', time())."\r\n";

		$mail_status = mail($mail_to, $subject, $body_message, $headers);

		//sending mail to admin
		$mail_to_admin = 'stephanie@blackdiamondz.com.au,a.kalb@andmine.com';
		$subject_admin = 'Send Us Question Received';
		$body_message_admin = '<html><head><title>New Question</title></head><body>
		<table>
		<tr><td><h3>New Question</h3></td></tr>
		<tr><td><strong>FROM</strong> : '.$have_fname.' '.$have_lname.'</td></tr>
		<tr><td><strong>Email</strong> : '.$have_email.'</td></tr>
		<tr><td><strong>Phone</strong> : '.$have_phone.'</td></tr>
		<tr><td><strong>Company</strong> : '.$have_company.'</td></tr>
		<tr><td><strong>Question Detail (message)</strong> : '.$have_message.'</td></tr>
		</table>
		</body>
		</html>';
		$headers_admin  = "MIME-Version: 1.0\r\n";
		$headers_admin .= "Content-type: text/html\r\n";
		$headers_admin .= 'From: '.$have_fname.' '.$have_lname.'<'.$have_email.'>'."\r\n";
		$headers_admin .= 'Reply-To: '.$have_email."\r\n";
		$headers_admin .= "Date: ".date('r', time())."\r\n";

		$mail_status_admin = mail($mail_to_admin, $subject_admin, $body_message_admin, $headers_admin);
		if($mail_status_admin){
		echo json_encode(array('msg'=>'success'));
		}
		else
		{
			echo json_encode(array('msg'=>'fail'));
		}
	}
	else
	{
		echo json_encode(array('msg'=>'fail','reason'=>'fail to save on db'));
	}
endif;
?>