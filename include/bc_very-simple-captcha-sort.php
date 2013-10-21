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
$bc_sort_location_value=get_option('bc_sort_location');
//if random selected, we have to do random
if($bc_sort_location_value==4){
$bc_sort_location_value=rand(1,2);
}
//Checking for Increasing or Decreasing order
	if($bc_sort_location_value==1){
	sort($bc_sort_sort_var);
	$bc_sort_value_passing=implode("",$bc_sort_sort_var);
	echo "<lablel>"._e('<b>*</b> Please arrange the below number in <b>increasing order</b><br>','bc_sort_simple_captcha')."</label><br>";
	}
	else {
	rsort($bc_sort_sort_var);
	$bc_sort_value_passing=implode("",$bc_sort_sort_var);
	echo "<lablel>"._e('<b>*</b> Please arrange the below number in <b>decreasing order</b><br>','bc_sort_simple_captcha')."</label><br>";
	}

echo "<lablel>";
echo $bc_sort_value_display;
echo "</label>    "; 
echo "<input id=\"bc_sort_captcha_input\" type=\"text\" autocomplete=\"off\" name=\"bc_sort_captcha_value\" value=\"\" maxlength=\"5\" size=\"15\" aria-required=\"true\" style=\"margin-bottom:0;display:inline;font-size: 12px;width: 90px;\" />"; ?>
<input type="hidden" value="<?php echo $bc_sort_value_passing; ?>" name="bc_sort_captcha_rand_value" />
<?php
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
			wp_die( __('Please Enter Captcha.', 'bc_sort_simple_captcha' ) );

// Checking for Captcha matching			
if ($_REQUEST['bc_sort_captcha_value']==$_REQUEST['bc_sort_captcha_rand_value']) {
		return($comment);
}
else {
		wp_die( __('Error: Incorrect CAPTCHA, Please click back and reenter', 'bc_sort_simple_captcha'));
}
}

?>