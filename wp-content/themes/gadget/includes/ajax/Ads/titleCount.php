<?php
include '../../../../../../wp-load.php';
global $wpdb;
$return="";
if(!empty($_GET)){
	$posttype=esc_attr($_GET['posttype']);
	$posttitle=esc_attr($_GET['title']);
	$result=$wpdb->get_results("SELECT * FROM ".$wpdb->prefix."posts where post_type='".$posttype."' and post_status<>'trash' and post_title='".$posttitle."'");
	$return=count($result);
}
echo $return;