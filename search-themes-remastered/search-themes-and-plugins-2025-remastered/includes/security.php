<?php
/**
 * Security Functions
 * Handles all security related operations
 */

if (!defined('ABSPATH')) {
    exit;
}

function wpnull_verify_request() {
    if (!check_ajax_referer('wpnull_nonce', 'nonce', false)) {
        wp_send_json_error('Invalid security token');
    }
}

function wpnull_sanitize_data($data) {
    if (is_array($data)) {
        foreach ($data as $key => $value) {
            $data[$key] = wpnull_sanitize_data($value);
        }
    } else {
        $data = sanitize_text_field($data);
    }
    return $data;
} 