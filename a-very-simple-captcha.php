<?php
/*
Plugin Name: A Very Simple Captcha
Plugin URI: http://buffercode.com/simple-captcha-for-wordpress/
Description: This Plugin provides high level of captcha for your blog with wide variety of captcha methods and models.
Version: 1.3
Author: vinoth06
Author URI: http://buffercode.com/
License: GPLv2
*/

//Menu added//
include('include/bc_very-simple-captcha-menu.php');

//Adding CSS Font
function bc_very_simple_captcha_font_css() {
wp_enqueue_style( 'captcha-style',plugins_url('css\captcha-style.css',__FILE__) );
}
add_action( 'wp_enqueue_scripts', 'bc_very_simple_captcha_font_css' );
//Sorting concepts added//
$bc_sort_location_value=get_option('bc_sort_location');

//If Sorting selected in Admin dashboard
if($bc_sort_location_value<3){
include('include/bc_very-simple-captcha-sort.php');
}
elseif($bc_sort_location_value==3)
{
include('include/bc_very-simple-captcha-combo.php');
}
elseif($bc_sort_location_value==4)
{
include('include/bc_very-simple-captcha-big-small.php');
}
elseif($bc_sort_location_value==5)
{
include('include/bc_very-simple-captcha-alphabets.php');
}
?>