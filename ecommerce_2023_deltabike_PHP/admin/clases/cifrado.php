<?php 

define('KEY_CIFRADO', 'ABCFASDF**123**321');
define('METODO', 'aes-128-cbc');

function cifrar($data) {
    $iv_length = openssl_cipher_iv_length(METODO);
    $iv = openssl_random_pseudo_bytes($iv_length);
    $cipher = openssl_encrypt($data, METODO, KEY_CIFRADO, OPENSSL_RAW_DATA, $iv);

    return base64_encode($iv).':'.base64_encode($cipher);
}

function descrifrar($input){
    $parts = explode(':', $input);
    $iv = base64_decode($parts[0]);
    $cipher = base64_decode($parts[1]);

    return openssl_decrypt($cipher, METODO, KEY_CIFRADO, OPENSSL_RAW_DATA, $iv);
}


?>
