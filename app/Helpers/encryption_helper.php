<?php

use Config\Encryption;
use Config\Services;

if (!function_exists('encrypt_id')) {
    function encrypt_id($id)
    {
        $config = config(Encryption::class);
        $config->key = getenv('ENC_KEY');
        $encryption = service('encrypter');
        return $encryption->encrypt($id);
    }
}

if (!function_exists('decrypt_id')) {
    function decrypt_id($encrypted_id)
    {
        $config = config(Encryption::class);
        $config->key = getenv('ENC_KEY');
        $encryption = service('encrypter');
        return $encryption->decrypt($encrypted_id);
    }
}
