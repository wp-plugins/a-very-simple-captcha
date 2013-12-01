<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
global $wp_version;
if ( version_compare( $wp_version,'3','>=' ) ) {
		add_action( 'comment_form_after_fields', 'bc_combo_comment_after', 1 );
		add_action( 'comment_form_logged_in_after', 'bc_combo_comment_after', 1 );
	}
add_filter( 'preprocess_comment', 'bc_combo_comment_post' );	

//Function for setting Combo box
function bc_combo_comment_after(){
?>
<!-- buffercode.com Combo Box Captcha input -->
<select name="bc_combo_captcha">
<option value="1" >Am</option>
<option value="2">Am Not</option>
</select>
<label>Spammer!</label>
<input type="hidden" value="<?php echo esc_attr(base64_encode(2)); ?>" name="bc_combo_captcha_value" />
<?php
}	

function bc_combo_comment_post($comment){

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

// Checking for Captcha matching			
if ($_REQUEST['bc_combo_captcha']==esc_attr(base64_decode($_REQUEST['bc_combo_captcha_value']))) {

		return($comment);
}
else {
		wp_die( __('Error => Incorrect CAPTCHA, Please click back and reenter', 'buffercode_captcha'));
}
}

?>