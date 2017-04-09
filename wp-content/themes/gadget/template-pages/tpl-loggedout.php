<?php
session_start();
/*
Template Name: Log Out
*/

if(is_user_logged_in()){
	$current_user = wp_get_current_user();
	//session_destroy();
	$sessions = WP_Session_Tokens::get_instance($current_user->ID);
	// we have got the sessions, destroy them all!
	$sessions->destroy_all();
	wp_logout();
}