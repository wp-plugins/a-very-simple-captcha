<?php
/*
Plugin Name: A Very Simple Captcha
Plugin URI: http://buffercode.com/project/a-very-simple-captcha-for-wordpress/
Description: This Plugin provides high level of captcha for your blog with wide variety of captcha methods and models.
Version: 3.0
Author: vinoth06
Author URI: http://buffercode.com/
License: GPLv2

  ////////////////////////////////////////////////////////////////////////////////

  ==== Feature of A Very Simple Captcha ====

  1. User can select wide variety of different logical captcha methods like
 * Biggest Number
 * Smallest Number
 * Increasing Order
 * Decreasing Order
 * Subraction of Two Numbers
 * Addition of Two Numbers
 * Alphabets [Case Sensitive]
 * Pick the Position of the Character 
 * Combo Box 
 * Multiplication 
 * Characters to Numbers
  Or you can make random by using "Random" option to make any of the one above logics with each time page loads.

  2. User can change the captcha background and font color which is suitable for their theme

  3. Random font styles and different image backgrounds for captcha.

 */



// Exit if accessed directly
//adding random captcha menu
add_action('admin_menu', 'bc_random_captcha', 9);
add_action('admin_init', 'bc_random_captcha_register_settings', 1);
add_action('admin_init', 'bc_captcha_js', 1);

function bc_random_captcha() {
    add_menu_page('random captcha id', 'Random Captcha', 'administrator', basename(__FILE__), 'bc_random_captcha_settings');
}

function bc_random_captcha_register_settings() {
    register_setting('bc-random-captcha-settings-group', 'bc_sort_location');
    register_setting('bc-random-captcha-settings-group', 'bc_background_color');
    register_setting('bc-random-captcha-settings-group', 'bc_reg_users');
    register_setting('bc-random-captcha-settings-group', 'bc_font_color');
    register_setting('bc-random-captcha-settings-group', 'bc_set_time_cookie');
}


function bc_random_captcha_settings() {

    $bc_sort_location_value = get_option('bc_sort_location');
    $bc_reg_users_value = get_option('bc_reg_users');
    ?>
    <div class="wrap">

        <h2>Random Captcha Settings</h2>

        <!-- The below line will used to show the options were saved -->
    <?php if (isset($_GET['settings-updated'])) { ?>
            <div id="message" class="updated fade">
                <p><strong><?php _e('Options Saved...', 'buffercode_random_captcha') ?></strong></p>
            </div>
    <?php } ?>

        <form method="post" action="options.php">
            <?php settings_fields('bc-random-captcha-settings-group'); ?>
    <?php do_settings_sections('bc-random-captcha-settings-group'); ?>

            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><?php _e("<b>Select the captcha method</b>", 'buffercode_random_captcha'); ?></th>
                    <td>
                        <!-- Adding Radio Button to select  -->
                        <input type="radio" name="bc_sort_location" value="1"<?php checked('1', $bc_sort_location_value); ?>>  <?php _e("Biggest Number", 'buffercode_random_captcha'); ?> <br><br>

                        <input type="radio" name="bc_sort_location" value="2"<?php checked('2', $bc_sort_location_value); ?>>  <?php _e("Smallest Number", 'buffercode_random_captcha'); ?> <br><br>

                        <input type="radio" name="bc_sort_location" value="3"<?php checked('3', $bc_sort_location_value); ?>> <?php _e("Increasing Order", 'buffercode_random_captcha'); ?> <br><br>

                        <input type="radio" name="bc_sort_location" value="4"<?php checked('4', $bc_sort_location_value); ?>> <?php _e("Decreasing Order", 'buffercode_random_captcha'); ?> <br><br>

                        <input type="radio" name="bc_sort_location" value="5"<?php checked('5', $bc_sort_location_value); ?>>  <?php _e("Subraction  of Two Numbers", 'buffercode_random_captcha'); ?> <br><br>

                        <input type="radio" name="bc_sort_location" value="6"<?php checked('6', $bc_sort_location_value); ?>>  <?php _e("Addition of Two Numbers", 'buffercode_random_captcha'); ?> <br><br>

                        <input type="radio" name="bc_sort_location" value="7"<?php checked('7', $bc_sort_location_value); ?>>  <?php _e("Alphabets [Case Sensitive]", 'buffercode_random_captcha'); ?> <br><br>

                        <input type="radio" name="bc_sort_location" value="8"<?php checked('8', $bc_sort_location_value); ?>><?php _e(" Pick the Position of the Character", 'buffercode_random_captcha'); ?>   <br><br>

                        <input type="radio" name="bc_sort_location" value="9"<?php checked('9', $bc_sort_location_value); ?>><?php _e(" Combo Box", 'buffercode_random_captcha'); ?>   <br><br>

                        <input type="radio" name="bc_sort_location" value="10"<?php checked('10', $bc_sort_location_value); ?>><?php _e(" Multiplication", 'buffercode_random_captcha'); ?>   <br><br>

                        <input type="radio" name="bc_sort_location" value="11"<?php checked('11', $bc_sort_location_value); ?>><?php _e(" Character to Numbers", 'buffercode_random_captcha'); ?>   <br><br>

                        <input type="radio" name="bc_sort_location" value="12"<?php checked('12', $bc_sort_location_value); ?>><?php _e(" Random [High Level of Security]", 'buffercode_random_captcha'); ?>   <br><br>

                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row"><?php _e("<b>Captcha Background Color</b>", 'buffercode_random_captcha'); ?></th>
                    <td>
                        <input  type="text" name="bc_background_color" maxlength="6" value="<?php echo get_option('bc_background_color'); ?>" id="bcolorr"/><b> &nbsp;&nbsp;&nbsp;[Only Color code values with out '#' eg. FFFFFF for White and also not as white]</b>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row"><?php _e("<b>Captcha Font Color</b>", 'buffercode_random_captcha'); ?></th>
                    <td>
                        <input  type="text" name="bc_font_color" maxlength="6" value="<?php echo get_option('bc_font_color'); ?>" id="fcolorr"/><b> &nbsp;&nbsp;&nbsp;[Only Color code values with out '#' eg. FFFFFF for White and also not as white]</b>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row"><?php _e("<b>No Captcha for Registered Users</b>", 'buffercode_random_captcha'); ?></th>
                    <td>
                        <input type="checkbox" name="bc_reg_users" value="1"<?php checked('1', $bc_reg_users_value); ?>>
                    </td>
                </tr>		

                <tr valign="top">
                    <th scope="row"><?php _e("<b>Minimum Comment Time to Consider as a SPAM</b>", 'buffercode_random_captcha'); ?></th>
                    <td>
                        <input  type="text" name="bc_set_time_cookie" maxlength="2" value="<?php echo get_option('bc_set_time_cookie'); ?>"/><b> &nbsp;&nbsp;&nbsp;[In Seconds - Default:10secs]</b>
                    </td>
                </tr>

            </table>
    <?php submit_button(); ?>
        </form>
                <!-- Buffercode.com Feeds Starts -->

        <div class="wrap">
            <h2>Our Other Works</h2>
            <?php
            // Get RSS Feed(s)
            include_once( ABSPATH . WPINC . '/feed.php' );
            $rss = fetch_feed('http://buffercode.com/cat-portifolio/our-works/feed/');

            $maxitems = 0;

            if (!is_wp_error($rss)){
                $maxitems = $rss->get_item_quantity(20);
                $rss_items = $rss->get_items(0, $maxitems);
            }
            ?>

            <ul>
                <?php if ($maxitems == 0) : ?>
                    <li><?php _e('Something Went Wrong', 'bc_comment_signature'); ?></li>
                <?php else : ?>
                    <table class="form-table"  style="background-color:#d3d3d3; border-radius: 10px;">
                        <tr valign="top">
                            <?php foreach ($rss_items as $item) : ?>
                            <td>
                                    <a href="<?php echo esc_url($item->get_permalink()); ?>"
                                       title="<?php printf(__('Posted %s', 'bc_comment_signature'), $item->get_date('j F Y | g:i a')); ?>">
                                           <?php echo esc_html($item->get_title()); ?>
                                    </a>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                    </table>
                <?php endif; ?>
            </ul>
        </div>
        
        <!-- Buffercode.com Feeds Ends -->
    </div>
<?php
}

////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
global $wp_version;
if (version_compare($wp_version, '3', '>=')) {
    add_action('comment_form_after_fields', 'bc_random_captcha_comment', 1);
    add_action('comment_form_logged_in_after', 'bc_random_captcha_comment', 1);
}
add_filter('preprocess_comment', 'bc_random_captcha_comment_form');

//Adding CSS Font
function bc_random_captcha_font_css() {
    wp_enqueue_style('captcha-style', plugins_url('css\captcha-style.css', __FILE__));
}

add_action('wp_enqueue_scripts', 'bc_random_captcha_font_css');

function bc_captcha_js() {
    wp_enqueue_script('captcha-script', plugins_url('js\captcha.js', __FILE__));
}

///////////////////////////////////////////////////////////////////////
/////// Cookie set //////////////////////////////////////////////////
add_action('init', 'bc_set_cookie');

function bc_set_cookie() {
    $bc_set_time_cookie_value = get_option('bc_set_time_cookie');
    if (!isset($bc_set_time_cookie_value)) {
        $bc_set_time_cookie_value = 20;
    }
    setcookie("bc_test_cookie", 'buffercode.com', time() + $bc_set_time_cookie_value);
}

function bc_random_captcha_comment() {
    $bc_captcha_random_value = get_option('bc_sort_location');
    $bc_background_value = get_option('bc_background_color');
    $bc_reg_users_value = get_option('bc_reg_users');
    $bc_font_value = get_option('bc_font_color');
    if (is_user_logged_in() && $bc_reg_users_value == 1) {
        return true;
    } else {
/////////////////////////////////////////////////////////////////////////
//////Variable - Big or Small number Captcha ///////////////////////
///////////////////////////////////////////////////////////////////////
        $bc_big_small_number_rand = array_rand(range(00, 99), 3);
        shuffle($bc_big_small_number_rand);
        $bc_big_small_sort_var = $bc_big_small_number_rand;
        $bc_big_small_value_display = implode("&nbsp;&nbsp;", $bc_big_small_number_rand);

/////////////////////////////////////////////////////////////////////////////////////
//Variable - Sort in Increasing or Decreasing Order Captcha //
///////////////////////////////////////////////////////////////////////////////////

        $bc_sort_number_rand = array_rand(range(1, 9), 5);
        shuffle($bc_sort_number_rand);
        $bc_sort_sort_var = $bc_sort_number_rand;
        $bc_sort_value_display = implode("", $bc_sort_number_rand);

/////////////////////////////////////////////////////////////////////////////////////
//Variable - Addition or Subtraction Number Captcha/////////
///////////////////////////////////////////////////////////////////////////////////

        $bc_add_sub_number_rand = array_rand(range(00, 99), 2);
//$bc_add_sub_random=rand(1,2);
/////////////////////////////////////////////////////////////////////////////////////
//Variable - Multiply Number Captcha/////////
///////////////////////////////////////////////////////////////////////////////////

        $bc_multiply_number_rand = array_rand(range(0, 9), 2);
        shuffle($bc_multiply_number_rand);

/////////////////////////////////////////////////////////////////
///////////Random Number Generator////////////////////////
////////////////////////////////////////////////////////////////
        if ($bc_captcha_random_value == 12) {
            $bc_captcha_random_value = rand(1, 11);
        }
        $bc_captcha_image_value = rand(1, 3);
////////////////////////////////////////////////////////////////
//////If 1 - Biggest Value Captcha ///////////////////////////
///////////////////////////////////////////////////////////////

        if ($bc_captcha_random_value == 1) {
            $bc_big_small_sort_var_max = max($bc_big_small_sort_var);
            $bc_captcha_input_passing = $bc_big_small_sort_var_max;
            echo "<label>" . _e('<b>*</b> Please enter the <b>Biggest Number</b><br>', 'random_captcha') . "</label><br>";
            ?>
            <!-- Buffercode Random Captcha : Biggest Number -->
            <div class="buffercode_random_captcha" style="background:#<?php echo $bc_background_value; ?>; border:none;">
                <label style="background-image:url('<?php echo plugins_url('images/' . $bc_captcha_image_value . '.png', __FILE__); ?>'); font-family:a<?php echo $bc_captcha_image_value; ?>; color:#<?php echo $bc_font_value; ?>; " class="captcha-label" >  
            <?php
            echo $bc_big_small_value_display;
            echo "</label>";
            echo "<input id=\"bc_captcha_input_value\" type=\"text\" autocomplete=\"off\" name=\"bc_captcha_req_text\" value=\"\" maxlength=\"2\" size=\"15\" aria-required=\"true\" style=\"margin-bottom:5px;display:inline;font-size: 12px;width: 90px; height:30px;\" />";
            ?>
            </div>
            <?php
            echo '<input type="hidden" name="bc_captcha_req_value" value="' . esc_attr(base64_encode($bc_captcha_input_passing)) . '">';
        }
////////////////////////////////////////////////////////////////
//////If 2 - Smallest Value Captcha //////////////////////////
//////////////////////////////////////////////////////////////
        elseif ($bc_captcha_random_value == 2) {
            $bc_big_small_sort_var_min = min($bc_big_small_sort_var);
            $bc_captcha_input_passing = $bc_big_small_sort_var_min;
            echo "<label>" . _e('<b>*</b> Please enter the <b>Smallest Number</b><br>', 'random_captcha') . "</label><br>";
            ?>
            <!-- Buffercode Random Captcha : Smallest Number -->
            <div class="buffercode_random_captcha" style="background:#<?php echo $bc_background_value; ?>; border:none; ">
                <label style="background-image:url('<?php echo plugins_url('images/' . $bc_captcha_image_value . '.png', __FILE__); ?>'); font-family:a<?php echo $bc_captcha_image_value; ?>;  color:#<?php echo $bc_font_value; ?>;" class="captcha-label" >  
            <?php
            echo $bc_big_small_value_display;
            echo "</label>";
            echo "<input id=\"bc_captcha_input_value\" type=\"text\" autocomplete=\"off\" name=\"bc_captcha_req_text\" value=\"\" maxlength=\"2\" size=\"15\" aria-required=\"true\" style=\"margin:5px;display:inline;font-size: 12px;width: 90px; height:30px;\" />";
            ?>
            </div>
            <?php
            echo '<input type="hidden" name="bc_captcha_req_value" value="' . esc_attr(base64_encode($bc_captcha_input_passing)) . '">';
        }

////////////////////////////////////////////////////////////////
//////If 3 - Sort in Increasing Order Captcha ////////////////
//////////////////////////////////////////////////////////////
        elseif ($bc_captcha_random_value == 3) {
            sort($bc_sort_sort_var);
            $bc_captcha_input_passing = implode("", $bc_sort_sort_var);
            echo "<lablel>" . _e('<b>*</b> Please arrange the below number in <b>increasing order</b><br>', 'random_captcha') . "</label><br>";
            ?>
            <!-- Buffercode Random Captcha : Sort in Increasing Order -->
            <div class="buffercode_random_captcha" style="background:#<?php echo $bc_background_value; ?>; border:none;">
                <label style="background-image:url('<?php echo plugins_url('images/' . $bc_captcha_image_value . '.png', __FILE__); ?>'); font-family:a<?php echo $bc_captcha_image_value; ?>; color:#<?php echo $bc_font_value; ?>;" class="captcha-label" >  
            <?php
            echo $bc_sort_value_display;
            echo "</label>";
            echo "<input id=\"bc_captcha_input_value\" type=\"text\" autocomplete=\"off\" name=\"bc_captcha_req_text\" value=\"\" maxlength=\"5\" size=\"15\" aria-required=\"true\" style=\"margin-bottom:5px;display:inline;font-size: 12px;width: 90px; height:30px;\" />";
            ?>
            </div>
            <?php
            echo '<input type="hidden" name="bc_captcha_req_value" value="' . esc_attr(base64_encode($bc_captcha_input_passing)) . '">';
        }
////////////////////////////////////////////////////////////////
//////If 4 - Sort in Decreasing Order Captcha ///////////////
//////////////////////////////////////////////////////////////
        elseif ($bc_captcha_random_value == 4) {
            rsort($bc_sort_sort_var);
            $bc_captcha_input_passing = implode("", $bc_sort_sort_var);
            echo "<label>" . _e('<b>*</b> Please arrange the below number in <b>decreasing order</b><br>', 'random_captcha') . "</label><br>";
            ?>
            <!-- Buffercode Random Captcha : Sort in Decreasing Order -->
            <div class="buffercode_random_captcha" style="background:#<?php echo $bc_background_value; ?>; border:none;">
                <label style="background-image:url('<?php echo plugins_url('images/' . $bc_captcha_image_value . '.png', __FILE__); ?>'); font-family:a<?php echo $bc_captcha_image_value; ?>;  color:#<?php echo $bc_font_value; ?>; " class="captcha-label" >  
            <?php
            echo $bc_sort_value_display;
            echo "</label>";
            echo "<input id=\"bc_captcha_input_value\" type=\"text\" autocomplete=\"off\" name=\"bc_captcha_req_text\" value=\"\" maxlength=\"5\" size=\"15\" aria-required=\"true\" style=\"margin-bottom:5px;display:inline;font-size: 12px;width: 90px; height:30px;\" />";
            ?>
            </div>
            <?php
            echo '<input type="hidden" name="bc_captcha_req_value" value="' . esc_attr(base64_encode($bc_captcha_input_passing)) . '">';
        }

///////////////////////////////////////////////
//////If 5 - Subtraction Captcha ////////////
/////////////////////////////////////////////
        elseif ($bc_captcha_random_value == 5) {
            $bc_add_sub_display = $bc_add_sub_number_rand[1] . '-' . $bc_add_sub_number_rand[0];
            $bc_captcha_input_passing = $bc_add_sub_number_rand[1] - $bc_add_sub_number_rand[0];
            echo "<label>" . _e('<b>*</b> Please <b>Subtract</b> the Values<br>', 'random_captcha') . "</label><br>";
            ?>
            <!-- Buffercode Random Captcha : Subtraction Numbers -->
            <div class="buffercode_random_captcha" style="background:#<?php echo $bc_background_value; ?>; border:none;">
                <label style="background-image:url('<?php echo plugins_url('images/' . $bc_captcha_image_value . '.png', __FILE__); ?>'); font-family:a<?php echo $bc_captcha_image_value; ?>; color:#<?php echo $bc_font_value; ?>; " class="captcha-label" >  
            <?php
            echo $bc_add_sub_display;
            echo "</label>";
            echo "<input id=\"bc_captcha_input_value\" type=\"text\" autocomplete=\"off\" name=\"bc_captcha_req_text\" value=\"\" maxlength=\"2\" size=\"15\" aria-required=\"true\" style=\"margin-bottom:5px;display:inline;font-size: 12px;width: 90px; height:30px;\" />";
            ?>
            </div>
            <?php
            echo '<input type="hidden" name="bc_captcha_req_value" value="' . esc_attr(base64_encode($bc_captcha_input_passing)) . '">';
        }

///////////////////////////////////////////////
//////If 6 -  Addition Captcha ///////////////
/////////////////////////////////////////////
        elseif ($bc_captcha_random_value == 6) {
            $bc_add_sub_display = $bc_add_sub_number_rand[1] . '+' . $bc_add_sub_number_rand[0];
            $bc_captcha_input_passing = $bc_add_sub_number_rand[1] + $bc_add_sub_number_rand[0];
            echo "<label>" . _e('<b>*</b> Please <b>Add</b> the Values<br>', 'random_captcha') . "</label><br>";
            ?>
            <!-- Buffercode Random Captcha : Addition Numbers -->
            <div class="buffercode_random_captcha" style="background:#<?php echo $bc_background_value; ?>; border:none;">
                <label style="background-image:url('<?php echo plugins_url('images/' . $bc_captcha_image_value . '.png', __FILE__); ?>'); font-family:a<?php echo $bc_captcha_image_value; ?>; color:#<?php echo $bc_font_value; ?>; " class="captcha-label" >  
            <?php
            echo $bc_add_sub_display;
            echo "</label>";
            echo "<input id=\"bc_captcha_input_value\" type=\"text\" autocomplete=\"off\" name=\"bc_captcha_req_text\" value=\"\" maxlength=\"3\" size=\"15\" aria-required=\"true\" style=\"margin-bottom:5px;display:inline;font-size: 12px;width: 90px; height:30px;\" />";
            ?>
            </div>
            <?php
            echo '<input type="hidden" name="bc_captcha_req_value" value="' . esc_attr(base64_encode($bc_captcha_input_passing)) . '">';
        }


///////////////////////////////////////////////
////// If 7 -  Alphabets //////////////////////
/////////////////////////////////////////////
        elseif ($bc_captcha_random_value == 7) {
            $bc_alphabets_number_rand = substr(str_shuffle(str_repeat("ABDEGHNTRQYabcdeghnqrty", 5)), 0, 5);
            $bc_captcha_input_passing = $bc_alphabets_number_rand;

            echo "<lablel>" . _e('<b>*</b> Please enter the Characters - <b>[Case Sensitive]</b><br>', 'random_captcha') . "</label><br>";
            ?>
            <!-- Buffercode Random Captcha : Alphabets  -->
            <div class="buffercode_random_captcha" style="background:#<?php echo $bc_background_value; ?>; border:none;">
                <label style="background-image:url('<?php echo plugins_url('images/' . $bc_captcha_image_value . '.png', __FILE__); ?>'); font-family:a<?php echo $bc_captcha_image_value; ?>; color:#<?php echo $bc_font_value; ?>; " class="captcha-label" >  
            <?php
            echo $bc_alphabets_number_rand;
            echo "</label>";
            echo "<input id=\"bc_captcha_input_value\" type=\"text\" autocomplete=\"off\" name=\"bc_captcha_req_text\" value=\"\" maxlength=\"5\" size=\"15\" aria-required=\"true\" style=\"margin-bottom:5px;display:inline;font-size: 12px;width: 90px; height:30px;\" />";
            ?>
            </div>
            <?php
            echo '<input type="hidden" name="bc_captcha_req_value" value="' . esc_attr(base64_encode($bc_captcha_input_passing)) . '">';
        }

///////////////////////////////////////////////////////
////// If 8 - Find Digit Position //////////////////////
/////////////////////////////////////////////////////
        elseif ($bc_captcha_random_value == 8) {
            $bc_digit_number_rand = substr(str_shuffle(str_repeat("ABDEGHNTRQYabdeghnqrty", 5)), 0, 5);
            $bc_digit_position = rand(1, 5);
            $bc_captcha_input_passing = $bc_digit_number_rand[$bc_digit_position - 1];

            echo "<lablel>" . _e('<b>*</b> Please enter the <b>' . $bc_digit_position . ' </b>Characters - <b>[Case Sensitive]</b><br>', 'random_captcha') . "</label><br>";
            ?>
            <!-- Buffercode Random Captcha : Alphabets  -->
            <div class="buffercode_random_captcha" style="background:#<?php echo $bc_background_value; ?>; border:none;">
                <label style="background-image:url('<?php echo plugins_url('images/' . $bc_captcha_image_value . '.png', __FILE__); ?>'); font-family:a<?php echo $bc_captcha_image_value; ?>; color:#<?php echo $bc_font_value; ?>; " class="captcha-label" >  
            <?php
            echo $bc_digit_number_rand;
            echo "</label>";
            echo "<input id=\"bc_captcha_input_value\" type=\"text\" autocomplete=\"off\" name=\"bc_captcha_req_text\" value=\"\" maxlength=\"1\" size=\"15\" aria-required=\"true\" style=\"margin-bottom:5px;display:inline;font-size: 12px;width: 90px; height:30px;\" />";
            ?>
            </div>
            <?php
            echo '<input type="hidden" name="bc_captcha_req_value" value="' . esc_attr(base64_encode($bc_captcha_input_passing)) . '">';
        }

///////////////////////////////////////////////////////
////// If 9 - Combox  //////////////////////
/////////////////////////////////////////////////////
        elseif ($bc_captcha_random_value == 9) {
            ?>

            <select name="bc_captcha_req_text">
                <option value="1" >Am</option>
                <option value="2">Am Not</option>
            </select>
            <label>Spammer!</label>
                    <?php
                    echo '<input type="hidden" name="bc_captcha_req_value" value="' . esc_attr(base64_encode(2)) . '">';
                }

                ///////////////////////////////////////////////////////
////// If 10 - Multiplication  //////////////////////
/////////////////////////////////////////////////////
                elseif ($bc_captcha_random_value == 10) {
                    $bc_add_sub_display = $bc_multiply_number_rand[1] . ' x ' . $bc_multiply_number_rand[0];
                    $bc_captcha_input_passing = $bc_multiply_number_rand[1] * $bc_multiply_number_rand[0];
                    echo "<label>" . _e('<b>*</b> Please <b>Multiply</b> the Values<br>', 'random_captcha') . "</label><br>";
                    ?>
            <!-- Buffercode Random Captcha : Multiply Numbers -->
            <div class="buffercode_random_captcha" style="background:#<?php echo $bc_background_value; ?>; border:none;">
                <label style="background-image:url('<?php echo plugins_url('images/' . $bc_captcha_image_value . '.png', __FILE__); ?>'); font-family:a<?php echo $bc_captcha_image_value; ?>; color:#<?php echo $bc_font_value; ?>; " class="captcha-label" >  
            <?php
            echo $bc_add_sub_display;
            echo "</label>";
            echo "<input id=\"bc_captcha_input_value\" type=\"text\" autocomplete=\"off\" name=\"bc_captcha_req_text\" value=\"\" maxlength=\"2\" size=\"15\" aria-required=\"true\" style=\"margin-bottom:5px;display:inline;font-size: 12px;width: 90px; height:30px;\" />";
            ?>
            </div>
            <?php
            echo '<input type="hidden" name="bc_captcha_req_value" value="' . esc_attr(base64_encode($bc_captcha_input_passing)) . '">';
        }

///////////////////////////////////////////////////////
////// If 11 - Characters to Numbers //////////////////////
/////////////////////////////////////////////////////
        elseif ($bc_captcha_random_value == 11) {
            $bc_char_digit_rand = array_rand(range(0, 9), 2);
            $bc_char_digit = array(
                0 => "Zero",
                1 => "One",
                2 => "Two",
                3 => "Three",
                4 => "Four",
                5 => "Five",
                6 => "Six",
                7 => "Seven",
                8 => "Eight",
                9 => "Nine",
            );

            $bc_char_digit_display = $bc_char_digit[$bc_char_digit_rand[0]] . '  ' . $bc_char_digit[$bc_char_digit_rand[1]];
            $bc_captcha_input_passing = implode("", $bc_char_digit_rand);
            echo "<label>" . _e('<b>*</b> Please enter the<b> Numbers</b><br>', 'random_captcha') . "</label><br>";
            ?>
            <!-- Buffercode Random Captcha : Characters to Numbers -->
            <div class="buffercode_random_captcha" style="background:#<?php echo $bc_background_value; ?>; border:none;">
                <label style="background-image:url('<?php echo plugins_url('images/' . $bc_captcha_image_value . '.png', __FILE__); ?>'); font-family:a<?php echo $bc_captcha_image_value; ?>; color:#<?php echo $bc_font_value; ?>; " class="captcha-label" >  
            <?php
            echo $bc_char_digit_display;
            echo "</label>";
            echo "<input id=\"bc_captcha_input_value\" type=\"text\" autocomplete=\"off\" name=\"bc_captcha_req_text\" value=\"\" maxlength=\"2\" size=\"15\" aria-required=\"true\" style=\"margin-bottom:5px;display:inline;font-size: 12px;width: 90px; height:30px;\" />";
            ?>
            </div>
            <?php
            echo '<input type="hidden" name="bc_captcha_req_value" value="' . esc_attr(base64_encode($bc_captcha_input_passing)) . '">';
        }
    }
}

function bc_random_captcha_comment_form($comment) {
    $bc_footer_comment_value = get_option('bc_footer_comment');
    global $bc_reg_users_value;
    if (is_user_logged_in() && $bc_reg_users_value == 1) {
        return $comment;
    }

// skip captcha for comment replies from the admin menu
    if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'replyto-comment') {
        // skip capthca
        return $comment;
    }

// Skip captcha for trackback or pingback	
    if ($comment['comment_type'] != '' && $comment['comment_type'] != 'comment') {
        // skip captcha
        return $comment;
    }

//check for timeout
    if (!isset($_COOKIE['bc_test_cookie'])) {

// Checking for Captcha field empty
        if ($_REQUEST['bc_captcha_req_text'] == "" && isset($_REQUEST['bc_captcha_req_text']))
            wp_die(__('OOPS! You have missed to enter Captcha!', 'random_captcha'));

// Checking for Captcha matching			
        if ($_REQUEST['bc_captcha_req_text'] == esc_attr(base64_decode($_REQUEST['bc_captcha_req_value']))) {
            return $comment;
        } else {
            wp_die(__('Error => Incorrect CAPTCHA, Please click back and reenter', 'random_captcha'));
        }
    } else {
        wp_die(__('You are moving fast - Are you Bot ?', 'random_captcha'));
    }
}

///Uninstall Hook
function bc_random_delete() {
    global $wpdb;
    delete_option('bc_sort_location');
    delete_option('bc_reg_users');
}

register_uninstall_hook(__FILE__, 'bc_random_delete');
?>