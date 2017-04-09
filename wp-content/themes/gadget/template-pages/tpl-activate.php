<?php 
/*
  Template Name: User Activation
 */

if(isset($_GET['token'])) { 

	$token = esc_attr($_GET['token']);
	global $wpdb;
	$userId = $wpdb->get_var( "SELECT user_id FROM $wpdb->usermeta WHERE meta_value = '$token'" );
	
	if(!empty($userId)) {
		$wpdb->update( $wpdb->users, 
						  array('user_status' => 0), 
						  array('ID' => $userId)
						  );
		//remove activationKey from userMeta				  
		$wpdb->delete( $wpdb->usermeta,
						 array('meta_value' => $token)
						 );				 
	}
}		
header( 'Location:' . home_url('/login/?login=activated') ); 
exit;