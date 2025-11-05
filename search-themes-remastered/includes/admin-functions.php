<?php
/**
 * Admin Functions
 * Handles admin-specific functionality
 */

if (!defined('ABSPATH')) {
    exit;
}

function wpnull_admin_scripts() {
    wp_enqueue_style('wpnull-admin-css', plugins_url('/assets/css/admin.css', dirname(__FILE__)));
    wp_enqueue_script('wpnull-admin-js', plugins_url('/assets/js/admin.js', dirname(__FILE__)));
} 