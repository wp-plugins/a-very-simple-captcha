<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
global $wp_version;
if ( version_compare( $wp_version,'3','>=' ) ) {
		add_action( 'comment_form_after_fields', 'bc_big_small_comment_after', 1 );
		add_action( 'comment_form_logged_in_after', 'bc_big_small_comment_after', 1 );
	}
add_filter( 'preprocess_comment', 'bc_big_small_comment_post' );	

function bc_big_small_comment_after(){
$bc_big_small_number_rand=array_rand(range(00, 99),3);
shuffle($bc_big_small_number_rand);
$bc_big_small_sort_var=$bc_big_small_number_rand;
$bc_big_small_value_display=implode("&nbsp;&nbsp;",$bc_big_small_number_rand);
//if random selected, we have to do random
$bc_big_small_location_value=rand(1,2);
//Checking for Increasing or Decreasing order
	if($bc_big_small_location_value==1){
	$bc_big_small_sort_var_max=max($bc_big_small_sort_var);
	$bc_big_small_value_passing=$bc_big_small_sort_var_max;
	echo "<!-- buffercode.com Biggest Captcha --><label>"._e('<b>*</b> Please enter the <b>Biggest Number</b><br>','buffercode_captcha')."</label><br>";
	}
	else {
	$bc_big_small_sort_var_min=min($bc_big_small_sort_var);
	$bc_big_small_value_passing=$bc_big_small_sort_var_min;
	echo "<!-- buffercode.com Smallest Captcha input --><label>"._e('<b>*</b> Please enter the <b>Smallest Number</b><br>','buffercode_captcha')."</label><br>";
	}
$bc_captcha_image_value=rand(1,4);
echo "<label class=\"captcha-label\" style=\"background-image:url(".plugins_url('images/'.$bc_captcha_image_value.'.png' , __FILE__ ).")\">";
echo '<b>'.$bc_big_small_value_display.'</b>';
echo "</label>    "; 
echo "<!-- buffercode.com Biggest or Smallest Captcha input --><input id=\"bc_big_small_captcha_input\" type=\"text\" autocomplete=\"off\" name=\"bc_big_small_captcha_value\" value=\"\" maxlength=\"2\" size=\"15\" aria-required=\"true\" style=\"margin-bottom:0;display:inline;font-size: 12px;width: 90px;\" />"; ?>
<input type="hidden" value="<?php echo bc_encrypt($bc_big_small_value_passing); ?>" name="bc_big_small_captcha_rand_value" />
<?php
}	

function bc_big_small_comment_post($comment){

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
if ($_REQUEST['bc_big_small_captcha_value'] =="" && isset($_REQUEST['bc_big_small_captcha_value'] ))
			wp_die( __('OOPS! You have missed to enter Captcha!', 'buffercode_captcha' ) );

// Checking for Captcha matching			
if ($_REQUEST['bc_big_small_captcha_value']==bc_decrypt($_REQUEST['bc_big_small_captcha_rand_value'])) {
		return($comment);
}
else {
	wp_die( __('Error => Incorrect CAPTCHA, Please click back and reenter', 'buffercode_captcha'));
}
}

?>