<?php
/**
 * File Operations Helper
 */

if (!defined('ABSPATH')) exit;

class WP_Null_File_Helper {
    private $allowed_extensions = array('zip', 'rar', '7z');
    private $max_file_size = 52428800; // 50MB
} 