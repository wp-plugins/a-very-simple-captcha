<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
 
 function bc_encrypt($bc_passing_value)
    { $bc_key_value = get_option('bc_sort_key');
        return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $bc_key_value, $bc_passing_value, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))));
    }

    function bc_decrypt($bc_passing_value)
    { $bc_key_value = get_option('bc_sort_key');
        return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $bc_key_value, base64_decode($bc_passing_value), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
    } 
	
	
?>