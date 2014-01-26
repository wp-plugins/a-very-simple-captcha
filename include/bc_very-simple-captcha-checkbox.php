<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
global $wp_version;
if ( version_compare( $wp_version,'3','>=' ) ) {
		add_action( 'comment_form_after_fields', 'bc_checkbox_comment_after', 1 );
		add_action( 'comment_form_logged_in_after', 'bc_checkbox_comment_after', 1 );
	}
add_filter( 'preprocess_comment', 'bc_checkbox_comment_post' );	

//Function for setting checkbox box
function bc_checkbox_comment_after(){
?>
<!-- buffercode.com checkbox Box Captcha input -->
<input type="checkbox" value="1" name="bc_checkbox_captcha">&nbsp;&nbsp;<?php _e('Am Not Spammer','buffercode_captcha') ?></input>
<input type="hidden" value="<?php echo esc_attr(base64_encode(1)); ?>" name="bc_combo_captcha_value" />
<?php
}	

function bc_checkbox_comment_post($comment){

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

if (!isset($_REQUEST['bc_checkbox_captcha'])) {
		wp_die( __('You have not selected it, Please click back and reenter', 'buffercode_captcha'));
}
// Checking for Captcha matching			
if ($_REQUEST['bc_checkbox_captcha']==esc_attr(base64_decode($_REQUEST['bc_combo_captcha_value']))) {
		return($comment);
}
else {
		wp_die( __('Error => Incorrect CAPTCHA, Please click back and reenter', 'buffercode_captcha'));
}
}

?>