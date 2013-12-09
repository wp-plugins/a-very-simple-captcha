<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
global $wp_version;
if ( version_compare( $wp_version,'3','>=' ) ) {
		add_action( 'comment_form_after_fields', 'bc_add_sub_comment_after', 1 );
		add_action( 'comment_form_logged_in_after', 'bc_add_sub_comment_after', 1 );
	}
add_filter( 'preprocess_comment', 'bc_add_sub_comment_post' );	

function bc_add_sub_comment_after(){
$bc_add_sub_number_rand=array_rand(range(00, 99),2);
//shuffle($bc_add_sub_number_rand);
$bc_add_sub_random=rand(1,2);
if($bc_add_sub_random==1){
$bc_add_sub_display=$bc_add_sub_number_rand[1].'-'.$bc_add_sub_number_rand[0];
$bc_add_sub_passing=$bc_add_sub_number_rand[1]-$bc_add_sub_number_rand[0];
}else{
$bc_add_sub_display=$bc_add_sub_number_rand[1].'+'.$bc_add_sub_number_rand[0];
$bc_add_sub_passing=$bc_add_sub_number_rand[1]+$bc_add_sub_number_rand[0];
}
echo "<!-- buffercode.com Add or Subtraction Captcha Label --><label>"._e('<b>*</b> Please Enter the <b>Output</b><br>','buffercode_captcha')."</label><br>";
$bc_captcha_image_value=rand(1,4);
echo "<label class=\"captcha-label\" style=\"background-image:url(".plugins_url('images/'.$bc_captcha_image_value.'.png' , __FILE__ ).")\">";
echo '<b>'.$bc_add_sub_display.'</b>';
echo "</label>    "; 
echo "<!-- buffercode.com Add or Subtraction Captcha input --> <input id=\"bc_add_sub_captcha_input\" type=\"text\" autocomplete=\"off\" name=\"bc_add_sub_captcha_value\" value=\"\" maxlength=\"3\" size=\"15\" aria-required=\"true\" style=\"margin-bottom:0;display:inline;font-size: 12px;width: 90px;\" />";
echo '<input type=\'hidden\' value=\''.esc_attr(base64_encode($bc_add_sub_passing)).'\' name=\'bc_add_sub_captcha_rand_value\' />';

}	

function bc_add_sub_comment_post($comment){

// skip captcha for comment replies from the admin menu
		if ( isset( $_REQUEST['action'] ) && $_REQUEST['action'] == 'replyto-comment' ) {
			// skip capthca
			return $comment;
		}

// Skip captcha for trackback or pingback	
if ( $comment['comment_type'] != '' && $comment['comment_type'] != 'comment' ) {
							 // skip captcha
							 return $comment;
		}

// Checking for Captcha field empty
if ($_REQUEST['bc_add_sub_captcha_value'] =="" && isset($_REQUEST['bc_add_sub_captcha_value'] ))
			wp_die( __('OOPS! You have missed to enter Captcha!', 'buffercode_captcha' ) );

// Checking for Captcha matching			
if ($_REQUEST['bc_add_sub_captcha_value']==esc_attr(base64_decode($_REQUEST['bc_add_sub_captcha_rand_value']))){

		return($comment);
}
else {
		
			wp_die( __('Error => Incorrect CAPTCHA, Please click back and reenter', 'buffercode_captcha'));
}
}


?>