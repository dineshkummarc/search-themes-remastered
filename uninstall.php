<?php
/**
 * Uninstall operations
 */

if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Clean up transients
global $wpdb;
$wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '%wpnull_%'");

// Remove plugin options
delete_option('wpnull_settings'); 