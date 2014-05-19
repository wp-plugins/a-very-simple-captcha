<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

//adding very simple captcha menu
add_action('admin_menu', 'bc_simple_captcha_menu');
global $bc_sort_location_value,$bc_sort_location_value_r;
function bc_simple_captcha_menu() {

	add_menu_page('simple captcha id', 'Simple Captcha', 'administrator', __FILE__, 'bc_simple_captcha_settings');


	//call register settings function
	add_action( 'admin_init', 'bc_simple_captcha_register_settings' );
}


function bc_simple_captcha_register_settings() {

register_setting( 'bc-simple-captcha-settings-group', 'bc_sort_location' );
register_setting( 'bc-simple-captcha-settings-group', 'bc_sort_key' );	
//register_setting( 'bc-simple-captcha-settings-group', 'bc_sort_commt_attrib' );	

}

function bc_simple_captcha_settings() {
?>
<div class="wrap">

<img src="<?php echo plugins_url('images/logo.png' , __FILE__ ) ?>" />
<h2>Very Simple Captcha Settings</h2>
<?php
$bc_sort_location_value=get_option('bc_sort_location');
$bc_sort_key_value=get_option('bc_sort_key');
//$bc_sort_commt_attrib=get_option('bc_sort_commt_attrib');

?>

<!-- The below line will used to show the options were saved -->
<?php if( isset($_GET['settings-updated']) ) { ?>
    <div id="message" class="updated fade">
        <p><strong><?php _e('Options Saved...','buffercode_captcha') ?></strong></p>
    </div>
<?php } ?>

<form method="post" action="options.php">
    <?php settings_fields( 'bc-simple-captcha-settings-group' ); ?>
    <?php do_settings_sections( 'bc-simple-captcha-settings-group' );?>
	 
    <table class="form-table">
        <tr valign="top">
        <th scope="row"><?php _e("<b>Select the captcha method</b>",'buffercode_captcha'); ?></th>
        <td>
		<!-- Adding Radio Button to select  -->
		<input type="radio" name="bc_sort_location" value="1"<?php checked( '1', $bc_sort_location_value); ?>> <?php _e("Increasing or Decreasing Order",'buffercode_captcha'); ?> <br><br>
		
		<input type="radio" name="bc_sort_location" value="2"<?php checked( '2', $bc_sort_location_value); ?>>  <?php _e("Combo Box Option",'buffercode_captcha'); ?> <br><br>
		
		<input type="radio" name="bc_sort_location" value="3"<?php checked( '3', $bc_sort_location_value); ?>>  <?php _e("Biggest or Smallest Number",'buffercode_captcha'); ?> <br><br>
		
		<input type="radio" name="bc_sort_location" value="4"<?php checked( '4', $bc_sort_location_value); ?>>  <?php _e("Alphabets",'buffercode_captcha'); ?> <br><br>
		
		<input type="radio" name="bc_sort_location" value="5"<?php checked( '5', $bc_sort_location_value); ?>>  <?php _e("Addition or Subraction",'buffercode_captcha'); ?> <br><br>
	
		<input type="radio" name="bc_sort_location" value="6"<?php checked( '6', $bc_sort_location_value); ?>>  <?php _e("Check Box",'buffercode_captcha'); ?> <br><br>		
		</td>
        </tr>
		<!-- May get this option in next version
		<tr valign="top">
        <th scope="row"><?php //_e("<b>Want to show Comment Attributes at Comment Bottom ?</b>",'buffercode_captcha'); ?></th>
		<td>
		<select name="bc_sort_commt_attrib">
		<option value="show"<?php //echo selected('show',$bc_sort_commt_attrib); ?>>Show</option>
		<option value="hide"<?php //echo selected('hide',$bc_sort_commt_attrib); ?>>Hide</option>
		<option></option>
		</select>
		</td>
		</tr> -->
		
		<?php _e("<h4> Why can't you try PRO Version of Random Captcha - ",'buffercode_captcha'); ?> <a href="http://buffercode.com/high-secure-random-captcha-pro-wordpress/">Random Captcha PRO Version</a>
    </table>

    <?php submit_button(); //echo $bc_sort_location_value;?>

</form>
</div>
<?php } ?>