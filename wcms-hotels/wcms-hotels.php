<?php
/**
 * Plugin Name: WCMS Hotel Info
 * Plugin URI: http://localhost
 * Description: Awesome hotels to visit!
 * Version: 1.0.0
 * Author: Johan Nordström
 * License: WTFPL
 */

require "widget-hotel-info.php";

function wcmsh_google_map_api($api){
	$api['key'] = 'AIzaSyAa38IcC1aetYkYfpdKdBWTU3qLtn_UqEE';
	return $api;
}
add_filter('acf/fields/google_map/api', 'wcmsh_google_map_api');

function wcmsh_styles() {
	// lightbox
	wp_enqueue_style('wcmsh-lightbox', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.9.0/css/lightbox.min.css');
	wp_enqueue_script('wcmsh-lightbox', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.9.0/js/lightbox.min.js', array('jquery'), '', true);

	// our plugin's styles
	wp_enqueue_style('wcmsh-styles', plugin_dir_url(__FILE__) . "assets/css/style.css");
}
add_action('wp_enqueue_scripts', 'wcmsh_styles');
