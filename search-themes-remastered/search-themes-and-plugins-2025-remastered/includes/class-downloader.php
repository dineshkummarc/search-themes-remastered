<?php
/**
 * Download Manager Class
 * Handles all download related operations
 */

if (!defined('ABSPATH')) {
    exit;
}

class WP_Plugin_Download_Manager {
    private $allowed_hosts = array(
        'wordpress.org',
        'downloads.wordpress.org',
        'plugins.svn.wordpress.org'
    );
    
    private $download_path;
    private $max_size = 104857600; // 100MB
    
    public function __construct() {
        $this->download_path = WP_CONTENT_DIR . '/wpnull/downloads/';
        add_action('init', array($this, 'handle_download_request'));
    }

    public function handle_download_request() {
        if (!isset($_GET['download_plugin'])) return;
        
        $this->verify_request();
        $plugin_slug = sanitize_text_field($_GET['download_plugin']);
        
        $api = new WP_Null_API();
        $plugin_data = $api->get_plugin_info($plugin_slug);
        
        if (!$plugin_data) {
            wp_die('Plugin information not found');
        }

        $download_url = $this->process_download_url($plugin_data->download_link);
        
        if (!$download_url) {
            wp_die('Invalid download URL');
        }

        $this->send_file($download_url, $plugin_slug);
    }

    private function verify_request() {
        if (!current_user_can('manage_options')) {
            wp_die('Unauthorized access');
        }

        check_admin_referer('plugin_download_nonce');
    }

    private function process_download_url($url) {
        $host = parse_url($url, PHP_URL_HOST);
        
        if (!in_array($host, $this->allowed_hosts)) {
            return false;
        }
        
        return $url;
    }

    private function send_file($url, $slug) {
        $tmp_file = download_url($url);
        
        if (is_wp_error($tmp_file)) {
            wp_die('Download failed');
        }

        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename="' . $slug . '.zip"');
        header('Content-Length: ' . filesize($tmp_file));
        
        readfile($tmp_file);
        unlink($tmp_file);
        exit;
    }
} 