<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
global $wp_version;
if ( version_compare( $wp_version,'3','>=' ) ) {
		add_action( 'comment_form_after_fields', 'bc_alphabets_comment_after', 1 );
		add_action( 'comment_form_logged_in_after', 'bc_alphabets_comment_after', 1 );
	}
add_filter( 'preprocess_comment', 'bc_alphabets_comment_post' );	

function bc_alphabets_comment_after(){
$bc_alphabets_number_rand=substr(str_shuffle(str_repeat("abcdefghjkmnopqrstuvwxyz", 5)), 0, 5);
$bc_alphabets_value_display=$bc_alphabets_number_rand;
$bc_alphabets_value_var=$bc_alphabets_number_rand;

$bc_alphabets_value_passing_1=strtolower($bc_alphabets_value_var);
$bc_alphabets_value_passing_2=strtoupper($bc_alphabets_value_var);

echo "<lablel>"._e('<!-- buffercode.com Alphabets Captcha String --><b>*</b> Please enter the Characters - <b>[Case Sensitive]</b><br>','buffercode_captcha')."</label><br>";

$bc_captcha_image_value=rand(1,3);
?>
<!-- buffercode.com Alphabets Captcha Label -->
<label style="background-image:url('<?php echo plugins_url('images/'.$bc_captcha_image_value.'.png' , __FILE__ ); ?>'); font-family:a<?php echo $bc_captcha_image_value; ?>" class="captcha-label" >  
<?php echo $bc_alphabets_value_display; 
echo "</label>"; 
echo "<!-- buffercode.com Alphabets Captcha input --><input id=\"bc_alphabets_captcha_input\" type=\"text\" autocomplete=\"off\" name=\"bc_alphabets_captcha_value\" value=\"\" maxlength=\"5\" size=\"15\" aria-required=\"true\" style=\"margin-bottom:0;display:inline;font-size: 12px;width: 90px;\" />"; 
echo '<input type=\'hidden\' value=\''.esc_attr(base64_encode($bc_alphabets_value_passing_1)).'\' name=\'bc_alphabets_captcha_rand_value_1\' />';
echo '<input type=\'hidden\' value=\''.esc_attr(base64_encode($bc_alphabets_value_passing_2)).'\' name=\'bc_alphabets_captcha_rand_value_2\' />';

}	

function bc_alphabets_comment_post($comment){

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
 
if ($_REQUEST['bc_alphabets_captcha_value'] =="" && isset($_REQUEST['bc_alphabets_captcha_value'] ))
			wp_die( __('OOPS! You have missed to enter Captcha!', 'buffercode_captcha' ) );

// Checking for Captcha matching			
if (strtolower($_REQUEST['bc_alphabets_captcha_value'])==esc_attr(base64_decode($_REQUEST['bc_alphabets_captcha_rand_value_1'])) ||strtoupper($_REQUEST['bc_alphabets_captcha_value'])==esc_attr(base64_decode($_REQUEST['bc_alphabets_captcha_rand_value_2'] ))) {
		return($comment);
}
else {
		
			wp_die( __('Error => Incorrect CAPTCHA, Please click back and reenter', 'buffercode_captcha'));
}
}


?>