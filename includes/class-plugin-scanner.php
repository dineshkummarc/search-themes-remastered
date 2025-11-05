<?php
/**
 * Plugin Scanner
 * Scans and validates plugin files
 */

if (!defined('ABSPATH')) exit;

class WP_Null_Plugin_Scanner {
    private $signatures = array(
        'malware' => array(
            'eval(base64_decode',
            'shell_exec(',
            'base64_decode(str_rot13',
            'gzinflate(base64_decode'
        ),
        'nulled' => array(
            'cracked by',
            'nulled by',
            'removed license check',
            '@package Nulled'
        )
    );
    
    public function scan_plugin($file) {
        if (!file_exists($file)) {
            return false;
        }

        $content = file_get_contents($file);
        $results = array(
            'safe' => true,
            'threats' => array(),
            'signature' => md5_file($file)
        );

        foreach ($this->signatures as $type => $patterns) {
            foreach ($patterns as $pattern) {
                if (stripos($content, $pattern) !== false) {
                    $results['safe'] = false;
                    $results['threats'][] = array(
                        'type' => $type,
                        'pattern' => $pattern
                    );
                }
            }
        }

        return $results;
    }
} 