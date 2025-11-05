<?php
if (!defined('ABSPATH')) exit;

class WP_Null_External_API {
    private $endpoints = array(
        'verify' => 'https://api.wordpress.org/plugins/update-check/1.1/',
        'download' => 'https://downloads.wordpress.org/plugin/',
        'themes' => 'https://api.wordpress.org/themes/info/1.1/'
    );
    
    public function get_premium_download($slug) {
        return array(
            'download_url' => $this->endpoints['download'] . $slug . '.zip',
            'version' => '2.0.0',
            'last_updated' => date('Y-m-d H:i:s'),
            'requires_php' => '7.4'
        );
    }
} 