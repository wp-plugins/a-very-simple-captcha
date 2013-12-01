<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
global $wp_version;
if ( version_compare( $wp_version,'3','>=' ) ) {
		add_action( 'comment_form_after_fields', 'bc_sort_comment_after', 1 );
		add_action( 'comment_form_logged_in_after', 'bc_sort_comment_after', 1 );
	}
add_filter( 'preprocess_comment', 'bc_sort_comment_post' );	

function bc_sort_comment_after(){
$bc_sort_number_rand=array_rand(range(1, 9),5);
shuffle($bc_sort_number_rand);
$bc_sort_sort_var=$bc_sort_number_rand;
$bc_sort_value_display=implode("",$bc_sort_number_rand);
//if random selected, we have to do random
$bc_sort_location_value=rand(1,2);
//Checking for Increasing or Decreasing order
	if($bc_sort_location_value==1){
	sort($bc_sort_sort_var);
	$bc_sort_value_passing=implode("",$bc_sort_sort_var);
	echo "<!-- buffercode.com Increasing order Captcha --><lablel>"._e('<b>*</b> Please arrange the below number in <b>increasing order</b><br>','buffercode_captcha')."</label><br>";
	}
	else {
	rsort($bc_sort_sort_var);
	$bc_sort_value_passing=implode("",$bc_sort_sort_var);
	echo "<!-- buffercode.com Decreasing order Captcha --><label>"._e('<b>*</b> Please arrange the below number in <b>decreasing order</b><br>','buffercode_captcha')."</label><br>";
	}

$bc_captcha_image_value=rand(1,4);
echo "<!-- buffercode.com Increasing or Decreasing order Captcha --><label class=\"captcha-label\" style=\"background-image:url(".plugins_url('images/'.$bc_captcha_image_value.'.png' , __FILE__ ).")\">";
echo '<b>'.$bc_sort_value_display.'</b>';
echo "</label>    "; 
echo "<input id=\"bc_sort_captcha_input\" type=\"text\" autocomplete=\"off\" name=\"bc_sort_captcha_value\" value=\"\" maxlength=\"5\" size=\"15\" aria-required=\"true\" style=\"margin-bottom:0;display:inline;font-size: 12px;width: 90px;\" />";
echo '<input type=\'hidden\' value=\''.esc_attr(base64_encode($bc_sort_value_passing)).'\' name=\'bc_sort_captcha_rand_value\' />';
}	

function bc_sort_comment_post($comment){

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
if ($_REQUEST['bc_sort_captcha_value'] =="" && isset($_REQUEST['bc_sort_captcha_value'] ))
		wp_die( __('OOPS! You have missed to enter Captcha!', 'buffercode_captcha' ) );

// Checking for Captcha matching			
if ($_REQUEST['bc_sort_captcha_value']==esc_attr(base64_decode($_REQUEST['bc_sort_captcha_rand_value']))){
		return($comment);
}
else {
		wp_die( __('Error => Incorrect CAPTCHA, Please click back and reenter', 'buffercode_captcha'));
}
}
	

?>