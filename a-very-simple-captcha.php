<?php
/*
Plugin Name: A Very Simple Captcha
Plugin URI: http://buffercode.com/simple-captcha-for-wordpress/
Description: This Plugin provides high level of captcha for your blog with wide variety of captcha methods and models.
Version: 2.4.1
Author: vinoth06
Author URI: http://buffercode.com/
License: GPLv2
*/

//Menu added//
include('include/bc_very-simple-captcha-menu.php');

function bc_very_simple_language() {
  load_plugin_textdomain( 'bc-language', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action('plugins_loaded', 'bc_very_simple_language');

//Adding CSS Font
function bc_very_simple_captcha_font_css() {
wp_enqueue_style( 'captcha-style',plugins_url('css\captcha-style.css',__FILE__) );
}
add_action( 'wp_enqueue_scripts', 'bc_very_simple_captcha_font_css' );
//Sorting concepts added//

$bc_sort_location_value=get_option('bc_sort_location');
//Value selected from Admin dashboard

if($bc_sort_location_value==1){
include('include/bc_very-simple-captcha-sort.php');
}
elseif($bc_sort_location_value==2)
{
include('include/bc_very-simple-captcha-combo.php');
}
elseif($bc_sort_location_value==3)
{
include('include/bc_very-simple-captcha-big-small.php');
}
elseif($bc_sort_location_value==4)
{
include('include/bc_very-simple-captcha-alphabets.php');
}
elseif($bc_sort_location_value==5)
{
include('include/bc_very-simple-captcha-add-sub.php');
}
elseif($bc_sort_location_value==6)
{
include('include/bc_very-simple-captcha-checkbox.php');
}

?>