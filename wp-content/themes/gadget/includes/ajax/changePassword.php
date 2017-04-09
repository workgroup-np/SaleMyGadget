<?php
session_start();
ob_start();
include '../../../../../wp-load.php';
global $wpdb;
$errors = array();
if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
	$key=$_POST['key'];
	$userId = $wpdb->get_var( "SELECT user_id FROM $wpdb->usermeta WHERE meta_value = '$key'" );
	$password = $_POST['password'];
	wp_set_password($password,$userId);
	delete_user_meta($userId,'passRecoverKey');
	echo json_encode(array('msg'=>'success','message'=>'done'));	
}
else
{
	echo json_encode(array('msg'=>'failed','message'=>"Couldnot Change Password"));
}