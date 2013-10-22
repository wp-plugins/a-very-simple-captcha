<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

//adding very simple captcha menu
add_action('admin_menu', 'bc_simple_captcha_menu');

function bc_simple_captcha_menu() {

	add_menu_page('simple captcha id', 'Simple Captcha', 'administrator', __FILE__, 'bc_simple_captcha_settings');

	//call register settings function
	add_action( 'admin_init', 'bc_simple_captcha_register_settings' );
}


function bc_simple_captcha_register_settings() {
	
register_setting( 'bc-simple-captcha-settings-group', 'bc_sort_location' );
//register_setting( 'bc-simple-captcha-settings-group', 'bc_combo_location' );	
}

function bc_simple_captcha_settings() {
?>
<div class="wrap">
<h2>Very Simple Captcha Settings</h2>
<?php
$bc_sort_location_value=get_option('bc_sort_location');
?>

<!-- The below line will used to show the options were saved -->
<?php if( isset($_GET['settings-updated']) ) { ?>
    <div id="message" class="updated fade">
        <p><strong><?php _e('Options Saved...') ?></strong></p>
    </div>
<?php } ?>

<form method="post" action="options.php">
    <?php settings_fields( 'bc-simple-captcha-settings-group' ); ?>
    <?php do_settings_sections( 'bc-simple-captcha-settings-group' );?>
	 
    <table class="form-table">
        <tr valign="top">
        <th scope="row"><?php _e("Select the captcha method",'buffercode_captcha'); ?></th>
        <td>
		<!-- Adding Radio Button to select  -->
		<input type="radio" name="bc_sort_location" value="1"<?php checked( '1', $bc_sort_location_value); ?>> <?php _e("Numbers Sort in Increasing Order",'buffercode_captcha'); ?> <br><br>
		
		<input type="radio" name="bc_sort_location" value="2"<?php checked( '2', $bc_sort_location_value); ?>>  <?php _e("Numbers Sort in Decreasing Order",'buffercode_captcha'); ?> <br><br>
		
		<input type="radio" name="bc_sort_location" value="3"<?php checked( '3', $bc_sort_location_value); ?>>  <?php _e("Combo Box Option",'buffercode_captcha'); ?> <br><br>
		
		<input type="radio" name="bc_sort_location" value="4"<?php checked( '4', $bc_sort_location_value); ?>>  <?php _e("Biggest or Smallest Number",'buffercode_captcha'); ?> <br><br>
		
		<input type="radio" name="bc_sort_location" value="5"<?php checked( '5', $bc_sort_location_value); ?>>  <?php _e("Alphabets only",'buffercode_captcha'); ?> <br><br>
		
				
		</td>
        </tr>
		
		<tr valign="top">
        <th scope="row"><?php _e("Designed by -",'buffercode_captcha'); ?> <a href="http://buffercode.com">Buffercode</a></th>
        </tr>
    </table>

    <?php submit_button(); ?>

</form>
</div>
<?php } ?>