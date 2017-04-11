<?php
include '../../../../../../wp-load.php';
global $wpdb;
$action=$_GET['action'];
switch($action){
	case 'post-select':
		$post=$_GET['type'];
		$catoption='';
		$taxonomies = get_object_taxonomies( $post, 'object' );
		foreach($taxonomies as $tax){
		  	$catoption.='<optgroup label="'.$tax->labels->singular_name.'">';
			$taxName=$tax->name;
		  	$terms = get_terms( $taxName,array( 'parent' => 0,'hide_empty' => false ) );
			if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
				
				foreach ( $terms as $term ) {
					$catoption.='<option value="'.$term->term_id.'">' . $term->name . '</option>';
				}
			}
			$catoption.='</optgroup>';
		}			
		echo json_encode(array('status'=>'success','returnOption'=>$catoption));
	break;
	case 'cat-select':
		$termID=$_GET['type'];
		$subcatoption='';
		if(!empty($termID)){
			$term = get_term($termID); 
			$taxName=$term->taxonomy;
			$term_childrens = get_terms( $taxName,array( 'parent' => $termID,'hide_empty' => false ) );
			if ( ! empty( $term_childrens ) && ! is_wp_error( $term_childrens ) ){				
				foreach ( $term_childrens as $term_child ) {
					$subcatoption.='<option value="'.$term_child->term_id.'">' . $term_child->name . '</option>';
				}
			}
		}
		echo json_encode(array('status'=>'success','taxName'=>$taxName,'returnOption'=>$subcatoption));
	break;
	default:
		echo json_encode(array('status'=>'failed','returnOption'=>""));
}