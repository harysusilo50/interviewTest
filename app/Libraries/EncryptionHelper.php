<?php

namespace App\Libraries;

class EncryptionHelper
{
    private $key;
    private $cipher;
    private $options;

    public function __construct()
    {
        $key = getenv('ENC_KEY');
        $this->key = hash('sha256', $key, true);
        $this->cipher = "aes-256-cbc";
        $this->options = 0; // No options
    }

    public function encrypt($data)
    {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->cipher));
        $encryptedData = openssl_encrypt($data, $this->cipher, $this->key, $this->options, $iv);
        return base64_encode($encryptedData . '::' . $iv);
    }

    public function decrypt($data)
    {
        list($encryptedData, $iv) = explode('::', base64_decode($data), 2);
        return openssl_decrypt($encryptedData, $this->cipher, $this->key, $this->options, $iv);
    }
}
