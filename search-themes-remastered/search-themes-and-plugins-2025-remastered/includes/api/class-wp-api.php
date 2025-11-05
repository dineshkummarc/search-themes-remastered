<?php
/**
 * WordPress API Handler
 * Manages WordPress.org API connections
 */

if (!defined('ABSPATH')) exit;

class WP_Null_API {
    private $endpoints = array(
        'plugins' => 'https://api.wordpress.org/plugins/info/1.2/',
        'themes'  => 'https://api.wordpress.org/themes/info/1.1/'
    );
    
    public function get_plugin_info($slug) {
        $cache_key = 'wpnull_plugin_' . md5($slug);
        $cached = get_transient($cache_key);
        
        if ($cached !== false) {
            return $this->decrypt_data($cached);
        }

        $response = wp_remote_get($this->endpoints['plugins'] . '?action=plugin_information&request[slug]=' . $slug);
        
        if (is_wp_error($response)) {
            return false;
        }

        $data = json_decode(wp_remote_retrieve_body($response));
        set_transient($cache_key, $this->encrypt_data($data), 12 * HOUR_IN_SECONDS);
        
        return $data;
    }

    private function encrypt_data($data) {
        $key = wp_salt('auth');
        $encoded = base64_encode(serialize($data));
        return openssl_encrypt($encoded, 'AES-256-CBC', $key);
    }

    private function decrypt_data($data) {
        $key = wp_salt('auth');
        $decoded = openssl_decrypt($data, 'AES-256-CBC', $key);
        return unserialize(base64_decode($decoded));
    }
} 