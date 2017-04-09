<?php
session_start();
ob_start();
include '../../../../../wp-load.php';
global $wpdb;
if( 'POST' == $_SERVER['REQUEST_METHOD']) {
	$username = $wpdb->escape($_REQUEST['username']);
	$password = $wpdb->escape($_REQUEST['password']);
	$userInfo = get_user_by( 'login', $username );
	if($userInfo==true){
		$user_meta=get_userdata($userInfo->ID);
		$user_roles=$user_meta->roles;
		$login_data = array();
		$login_data['user_login'] = $username;//'admin';
		$login_data['user_password'] = $password;
		if(in_array('author',$user_roles))
		{
			if($userInfo->user_status==0){
				$user_verify = wp_signon( $login_data, false );
				if ( is_wp_error($user_verify) )
				    {
				    	echo json_encode(array('msg'=>'failed','message'=>'Authentication Failed'));
				    }
				else
				    {
				    	echo json_encode(array('msg'=>'success','message'=>'done'));
				    }
			}
			else
			{
				echo json_encode(array('msg'=>'failed','message'=>'Did not activate your account'));
			}
		}
		else
		{
			echo json_encode(array('msg'=>'failed','message'=>"Maybe you're not a author?"));
		}
	}else
		{
			echo json_encode(array('msg'=>'failed','message'=>"Not Registered"));
		}
}