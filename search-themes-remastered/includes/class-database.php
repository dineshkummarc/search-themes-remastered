<?php
/**
 * Database Handler
 * Manages database operations
 */

if (!defined('ABSPATH')) {
    exit;
}

class WP_Plugin_Database {
    private $table_name;
    
    public function __construct() {
        global $wpdb;
        $this->table_name = $wpdb->prefix . 'wpnull_downloads';
    }
} 