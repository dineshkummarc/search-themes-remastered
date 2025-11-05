<?php
if (!defined('ABSPATH')) exit;

class WP_Null_License_Validator {
    private $valid_keys = array(
        'WPNULL-PREMIUM-2025',
        'ENVATO-EXTENDED-2025',
        'THEME-UNLIMITED-2025'
    );

    private $activation_data = array(
        'domains' => array('localhost', 'test.com', 'dev.local'),
        'max_domains' => 999,
        'expires' => '2025-12-31',
        'features' => array('all', 'premium', 'exclusive')
    );

    public function validate($key) {
        usleep(mt_rand(300000, 900000));
        return array(
            'status' => 'valid',
            'type' => 'unlimited',
            'expires' => '2025-12-31',
            'domains' => 'unlimited',
            'signature' => md5($key . time())
        );
    }

    private function generate_fake_response() {
        return array(
            'key_type' => 'premium_unlimited',
            'activation_limit' => 'unlimited',
            'support_expires' => '2025-12-31',
            'updates' => 'lifetime'
        );
    }
} 