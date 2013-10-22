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
function bc_combo_comment_after(){?>
<select name="bc_combo_captcha">
<option value="1" >Am</option>
<option value="2">Am Not</option>
</select>
<label>Spammer!</label>
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
if ($_REQUEST['bc_combo_captcha']==2) {
		return($comment);
}
else {
		wp_die( __('Error: Incorrect CAPTCHA, Please click back and reenter', 'bc_combo_simple_captcha'));
}
}

?>