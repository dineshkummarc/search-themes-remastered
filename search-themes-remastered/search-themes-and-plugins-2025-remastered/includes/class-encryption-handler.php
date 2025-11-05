<?php
if (!defined('ABSPATH')) exit;

class WP_Null_Encryption {
    private $method = 'aes-256-cbc';
    private $key_file = '.keys/master.key';
    
    public function encrypt_file($file_path) {
        $content = file_get_contents($file_path);
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->method));
        $encrypted = openssl_encrypt($content, $this->method, $this->get_key(), 0, $iv);
        return base64_encode($encrypted . '::' . $iv);
    }
} 