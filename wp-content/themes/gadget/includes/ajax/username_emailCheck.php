<?php
include '../../../../../wp-load.php';
global $wpdb;
if(isset($_POST) && !empty($_POST))
{
	if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
		die();
	}
	if("usernamecheck"==$_POST['action']){
		$ValueToCheck =  strtolower(trim($_POST["username"])); 
		$parameter="user_login";
	}
	else{
		$ValueToCheck =  strtolower(trim($_POST["email"])); 
		$parameter="user_email";
	}
	$ValueToCheck = filter_var($ValueToCheck, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
	$results = $wpdb->get_results("select * from ".$wpdb->prefix."users WHERE ".$parameter."='$ValueToCheck'");
	$already_exists = $results;
	if($already_exists) {
		$ret=false;
	}else{
		$ret=true;;
	}
	echo(json_encode($ret));
}