<?php

// Customize ACF path
function set_acf_settings_path( $path ) {

    // update path
    $path = plugin_dir_path(__FILE__) . '/acf-pro/';

    // return
    return $path;
}
add_filter('acf/settings/path', 'set_acf_settings_path');


// Customize ACF dir
function set_acf_settings_dir( $dir ) {

    // update path
    $dir = plugin_dir_url(__FILE__) . '/acf-pro/';

    // return
    return $dir;
}
add_filter('acf/settings/dir', 'set_acf_settings_dir');

// Hide ACF field group menu item
// add_filter('acf/settings/show_admin', '__return_false');

// Set ACF JSON save folder
function set_acf_json_save_folder( $path ) {
    $path = dirname(__FILE__) . '/includes/acf-json';
    return $path;
}
add_filter('acf/settings/save_json', 'set_acf_json_save_folder');

// Add ACF JSON save folder to ACF search path
function add_acf_json_load_folder( $paths ) {
    unset($paths[0]);
    $paths[] = dirname(__FILE__) . '/includes/acf-json';
    return $paths;
}
add_filter('acf/settings/load_json', 'add_acf_json_load_folder');

// Include ACF (should always be done last!)
require "acf-pro/acf.php";
