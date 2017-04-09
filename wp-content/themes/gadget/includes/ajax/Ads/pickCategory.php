<?php
include '../../../../../../wp-load.php';
global $wpdb;
$action=$_GET['action'];
switch($action){
	case 'post-select':
		$post=$_GET['type'];
		$catoption='';
		if($post=="computer"){
			$terms = get_terms( 'computer_cat',array( 'parent' => 0,'hide_empty' => false ) );
			if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
				
				foreach ( $terms as $term ) {
					$catoption.='<option value="'.$term->term_id.'">' . $term->name . '</option>';
				}
			}
		}
		echo json_encode(array('status'=>'success','taxName'=>'computer_cat','returnOption'=>$catoption));
	break;
	case 'cat-select':
		$termID=$_GET['type'];
		$taxName=$_GET['taxName'];
		$subcatoption='';
		if(!empty($termID) && !empty($taxName)){
			//$term_childrens = get_term_children($termID, $taxName); 
			$term_childrens = get_terms( $taxName,array( 'parent' => $termID,'hide_empty' => false ) );
			if ( ! empty( $term_childrens ) && ! is_wp_error( $term_childrens ) ){
				
				foreach ( $term_childrens as $term_child ) {
					//$term = get_term_by( 'id', $term_child, $taxName );
					$subcatoption.='<option value="'.$term_child->term_id.'">' . $term_child->name . '</option>';
				}
			}
		}
		echo json_encode(array('status'=>'success','taxName'=>$taxName,'returnOption'=>$subcatoption));
	break;
	default:
		echo json_encode(array('status'=>'failed','returnOption'=>""));
}