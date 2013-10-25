<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
global $wp_version;
if ( version_compare( $wp_version,'3','>=' ) ) {
		add_action( 'comment_form_after_fields', 'buffercode_captcha_main', 1 );
		add_action( 'comment_form_logged_in_after', 'buffercode_captcha_main', 1 );
	}
add_filter( 'preprocess_comment', 'bc_big_small_comment_post' );	

function buffercode_captcha_main(){
/////////////////////////////////////////////////////////////////////////
//////Variable - Big or Small number Captcha - buffercode.com/////
///////////////////////////////////////////////////////////////////////

$bc_big_small_number_rand=array_rand(range(00, 99),3);
shuffle($bc_big_small_number_rand);
$bc_big_small_sort_var=$bc_big_small_number_rand;
$bc_big_small_value_display=implode("&nbsp;&nbsp;",$bc_big_small_number_rand);

/////////////////////////////////////////////////////////////////////////////////////
//Variable - Sort in Increasing or Decreasing Order Captcha - buffercode.com//
///////////////////////////////////////////////////////////////////////////////////

$bc_sort_number_rand=array_rand(range(1, 9),5);
shuffle($bc_sort_number_rand);
$bc_sort_sort_var=$bc_sort_number_rand;
$bc_sort_value_display=implode("",$bc_sort_number_rand);

/////////////////////////////////////////////////////////////////////////////////////
//Variable - Addition or Subtraction Number Captcha - buffercode.com/////////
///////////////////////////////////////////////////////////////////////////////////

$bc_add_sub_number_rand=array_rand(range(00, 99),2);
$bc_add_sub_random=rand(1,2);

/////////////////////////////////////////////////////////////////
///////////Random Number Generator////////////////////////
////////////////////////////////////////////////////////////////

$bc_captcha_random_value=rand(1,7);
$bc_captcha_image_value=rand(1,4);
////////////////////////////////////////////////////////////////
//////If 1 - Biggest Value Captcha ///////////////////////////
///////////////////////////////////////////////////////////////

	if($bc_captcha_random_value==1){
	$bc_big_small_sort_var_max=max($bc_big_small_sort_var);
	$bc_captcha_input_passing=$bc_big_small_sort_var_max;
	echo "<!-- buffercode.com Biggest Captcha --><label>"._e('<b>*</b> Please enter the <b>Biggest Number</b><br>','buffercode_captcha')."</label><br>";
	echo "<label class=\"captcha-label\" style=\"background-image:url(".plugins_url('images/'.$bc_captcha_image_value.'.png' , __FILE__ ).")\">";
	echo '<b>'.$bc_big_small_value_display.'</b>';
	echo "</label>    "; 
	echo "<!-- buffercode.com Biggest Captcha input --><input id=\"bc_captcha_input_value\" type=\"text\" autocomplete=\"off\" name=\"bc_captcha_req_text\" value=\"\" maxlength=\"2\" size=\"15\" aria-required=\"true\" style=\"margin-bottom:0;display:inline;font-size: 12px;width: 90px;\" />"; 
	echo '<input type=\'hidden\' value=\''.$bc_captcha_input_passing.'\' name=\'bc_captcha_req_value\' />';
	
	}
////////////////////////////////////////////////////////////////
//////If 2 - Smallest Value Captcha //////////////////////////
//////////////////////////////////////////////////////////////
	
	elseif($bc_captcha_random_value==2){
	$bc_big_small_sort_var_min=min($bc_big_small_sort_var);
	$bc_captcha_input_passing=$bc_big_small_sort_var_min;
	echo "<!-- buffercode.com Smallest Captcha input --><label>"._e('<b>*</b> Please enter the <b>Smallest Number</b><br>','buffercode_captcha')."</label><br>";
	//$bc_captcha_image_value=rand(1,4);
	echo "<label class=\"captcha-label\" style=\"background-image:url(".plugins_url('images/'.$bc_captcha_image_value.'.png' , __FILE__ ).")\">";
	echo '<b>'.$bc_big_small_value_display.'</b>';
	echo "</label>    "; 
	echo "<!-- buffercode.com Smallest Captcha input --><input id=\"bc_captcha_input_value\" type=\"text\" autocomplete=\"off\" name=\"bc_captcha_req_text\" value=\"\" maxlength=\"2\" size=\"15\" aria-required=\"true\" style=\"margin-bottom:0;display:inline;font-size: 12px;width: 90px;\" />"; 
	echo '<input type=\'hidden\' value=\''.$bc_captcha_input_passing.'\' name=\'bc_captcha_req_value\' />';
	}

////////////////////////////////////////////////////////////////
//////If 3 - Sort in Increasing Order Captcha ////////////////
//////////////////////////////////////////////////////////////

	elseif($bc_captcha_random_value==3){
	sort($bc_sort_sort_var);
	$bc_captcha_input_passing=implode("",$bc_sort_sort_var);
	echo "<!-- buffercode.com Increasing order Captcha --><lablel>"._e('<b>*</b> Please arrange the below number in <b>increasing order</b><br>','buffercode_captcha')."</label><br>";
	//$bc_captcha_image_value=rand(1,4);
	echo "<!-- buffercode.com Increasing order Captcha --><label class=\"captcha-label\" style=\"background-image:url(".plugins_url('images/'.$bc_captcha_image_value.'.png' , __FILE__ ).")\">";
	echo '<b>'.$bc_sort_value_display.'</b>';
	echo "</label>    "; 
	echo "<!-- buffercode.com Biggest or Smallest Captcha input --><input id=\"bc_captcha_input_value\" type=\"text\" autocomplete=\"off\" name=\"bc_captcha_req_text\" value=\"\" maxlength=\"5\" size=\"15\" aria-required=\"true\" style=\"margin-bottom:0;display:inline;font-size: 12px;width: 90px;\" />"; 
	echo '<input type=\'hidden\' value=\''.$bc_captcha_input_passing.'\' name=\'bc_captcha_req_value\' />';
	}
////////////////////////////////////////////////////////////////
//////If 4 - Sort in Decreasing Order Captcha ///////////////
//////////////////////////////////////////////////////////////
	
	elseif($bc_captcha_random_value==4) {
	rsort($bc_sort_sort_var);
	$bc_captcha_input_passing=implode("",$bc_sort_sort_var);
	echo "<!-- buffercode.com Decreasing order Captcha --><label>"._e('<b>*</b> Please arrange the below number in <b>decreasing order</b><br>','buffercode_captcha')."</label><br>";
	//	$bc_captcha_image_value=rand(1,4);
	echo "<!-- buffercode.com Decreasing order Captcha --><label class=\"captcha-label\" style=\"background-image:url(".plugins_url('images/'.$bc_captcha_image_value.'.png' , __FILE__ ).")\">";
	echo '<b>'.$bc_sort_value_display.'</b>';
	echo "</label>    "; 
	echo "<!-- buffercode.com Biggest or Smallest Captcha input --><input id=\"bc_captcha_input_value\" type=\"text\" autocomplete=\"off\" name=\"bc_captcha_req_text\" value=\"\" maxlength=\"5\" size=\"15\" aria-required=\"true\" style=\"margin-bottom:0;display:inline;font-size: 12px;width: 90px;\" />"; 
	echo '<input type=\'hidden\' value=\''.$bc_captcha_input_passing.'\' name=\'bc_captcha_req_value\' />';
	}

///////////////////////////////////////////////
//////If 5 - Subtraction Captcha ////////////
/////////////////////////////////////////////

	elseif($bc_captcha_random_value==5) {
	$bc_add_sub_display=$bc_add_sub_number_rand[1].'-'.$bc_add_sub_number_rand[0];
	$bc_captcha_input_passing=$bc_add_sub_number_rand[1]-$bc_add_sub_number_rand[0];
	echo "<!-- buffercode.com Addition Captcha Label --><label>"._e('<b>*</b> Please <b>Subtract</b> the Values<br>','buffercode_captcha')."</label><br>";
	//$bc_captcha_image_value=rand(1,4);
	echo "<label class=\"captcha-label\" style=\"background-image:url(".plugins_url('images/'.$bc_captcha_image_value.'.png' , __FILE__ ).")\">";
	echo '<b>'.$bc_add_sub_display.'</b>';
	echo "</label>    "; 
	echo "<!-- buffercode.com Biggest or Smallest Captcha input --><input id=\"bc_captcha_input_value\" type=\"text\" autocomplete=\"off\" name=\"bc_captcha_req_text\" value=\"\" maxlength=\"2\" size=\"15\" aria-required=\"true\" style=\"margin-bottom:0;display:inline;font-size: 12px;width: 90px;\" />"; 
	echo '<input type=\'hidden\' value=\''.$bc_captcha_input_passing.'\' name=\'bc_captcha_req_value\' />';
	}

///////////////////////////////////////////////
//////If 6 -  Addition Captcha ///////////////
/////////////////////////////////////////////

	elseif($bc_captcha_random_value==6) {
	$bc_add_sub_display=$bc_add_sub_number_rand[1].'+'.$bc_add_sub_number_rand[0];
	$bc_captcha_input_passing=$bc_add_sub_number_rand[1]+$bc_add_sub_number_rand[0];
	echo "<!-- buffercode.com Subtraction Captcha Label --><label>"._e('<b>*</b> Please <b>Add</b> the Values<br>','buffercode_captcha')."</label><br>";
	//$bc_captcha_image_value=rand(1,4);
	echo "<label class=\"captcha-label\" style=\"background-image:url(".plugins_url('images/'.$bc_captcha_image_value.'.png' , __FILE__ ).")\">";
	echo '<b>'.$bc_add_sub_display.'</b>';
	echo "</label>    "; 
	echo "<!-- buffercode.com Biggest or Smallest Captcha input --><input id=\"bc_captcha_input_value\" type=\"text\" autocomplete=\"off\" name=\"bc_captcha_req_text\" value=\"\" maxlength=\"3\" size=\"15\" aria-required=\"true\" style=\"margin-bottom:0;display:inline;font-size: 12px;width: 90px;\" />";
	echo '<input type=\'hidden\' value=\''.$bc_captcha_input_passing.'\' name=\'bc_captcha_req_value\' />';
	}

///////////////////////////////////////////////
////// If 7 -  Alphabets //////////////////////
/////////////////////////////////////////////
	elseif($bc_captcha_random_value==7) {
	$bc_alphabets_number_rand=substr(str_shuffle(str_repeat("abcdefghjkmnopqrstuvwxyz", 5)), 0, 5);
	$bc_captcha_input_passing=$bc_alphabets_number_rand;

	echo "<lablel>"._e('<b>*</b> Please enter the Characters - <b>[Case Sensitive]</b><br>','buffercode_captcha')."</label><br>";
	//$bc_captcha_image_value=rand(1,4);
	?>
	<label style="background-image:url('<?php echo plugins_url('images/'.$bc_captcha_image_value.'.png' , __FILE__ ); ?>'); font-family:a<?php echo $bc_captcha_image_value; ?>" class="captcha-label" >  
	<?php echo $bc_alphabets_number_rand;
	echo "</label>"; 
	echo "<!-- buffercode.com Biggest or Smallest Captcha input --><input id=\"bc_captcha_input_value\" type=\"text\" autocomplete=\"off\" name=\"bc_captcha_req_text\" value=\"\" maxlength=\"5\" size=\"15\" aria-required=\"true\" style=\"margin-bottom:0;display:inline;font-size: 12px;width: 90px;\" />";
	echo '<input type=\'hidden\' value=\''.$bc_captcha_input_passing.'\' name=\'bc_captcha_req_value\' />';
	}	
}

function bc_big_small_comment_post($comment){

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
if ($_REQUEST['bc_captcha_req_text'] =="" && isset($_REQUEST['bc_captcha_req_text'] ))
			wp_die( __('OOPS! You have missed to enter Captcha!', 'buffercode_captcha' ) );

// Checking for Captcha matching			
if ($_REQUEST['bc_captcha_req_text']==$_REQUEST['bc_captcha_req_value']) {
		return($comment);
}
else {
		
		wp_die( __('Error => Incorrect CAPTCHA, Please click back and reenter', 'buffercode_captcha'));
}
}

?>