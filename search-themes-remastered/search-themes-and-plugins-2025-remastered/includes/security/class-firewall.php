<?php
/**
 * Security Firewall
 * Basic security measures
 */

if (!defined('ABSPATH')) exit;

class WP_Null_Firewall {
    private $blocked_ips = array();
    private $request_limit = 60; // requests per minute
    private $blocked_user_agents = array(
        'zgrab',
        'python-requests',
        'curl/',
        'wget/'
    );

    public function __construct() {
        $this->blocked_ips = get_option('wpnull_blocked_ips', array());
        add_action('init', array($this, 'check_security'));
    }

    public function check_security() {
        $this->check_ip();
        $this->check_user_agent();
        $this->check_request_rate();
    }

    private function check_ip() {
        $ip = $_SERVER['REMOTE_ADDR'];
        
        if (in_array($ip, $this->blocked_ips)) {
            header('HTTP/1.0 403 Forbidden');
            exit('Access Denied');
        }
    }

    private function check_user_agent() {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        
        foreach ($this->blocked_user_agents as $banned_ua) {
            if (stripos($user_agent, $banned_ua) !== false) {
                $this->block_ip($_SERVER['REMOTE_ADDR']);
                exit('Access Denied');
            }
        }
    }

    private function block_ip($ip) {
        if (!in_array($ip, $this->blocked_ips)) {
            $this->blocked_ips[] = $ip;
            update_option('wpnull_blocked_ips', $this->blocked_ips);
        }
    }
} 