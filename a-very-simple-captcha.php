<?php
/*
Plugin Name: A Very Simple Captcha
Plugin URI: http://buffercode.com/
Description: This Plugin provides high level of captcha for your blog with wide variety of captcha methods and models.
Version: 1.1.1
Author: vinoth06
Author URI: http://buffercode.com/
License: GPLv2
*/

//Menu added//
include('include/bc_very-simple-captcha-menu.php');

//Sorting concepts added//
$bc_sort_location_value=get_option('bc_sort_location');

//If Sorting selected in Admin dashboard
if($bc_sort_location_value<3){
include('include/bc_very-simple-captcha-sort.php');
}
else
{
include('include/bc_very-simple-captcha-combo.php');
}

?>