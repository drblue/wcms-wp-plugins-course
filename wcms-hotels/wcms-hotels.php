<?php
/**
 * Plugin Name: WCMS Hotel Info
 * Plugin URI: http://localhost
 * Description: Awesome hotels to visit!
 * Version: 1.0.0
 * Author: Johan Nordström
 * License: WTFPL
 */

/**
 * Load and init CPT Template Injector with our CPTs
 */
require "WCMS_Plugin_Helper_CPT_Template_Injector.php";

WCMS_Plugin_Helper\CPT_Template_Injector::init([
	'hotel'
]);

/**
 * Hotel Info Widget
 */
require "widget-hotel-info.php";

/**
 * Add our Google Maps API key to the ACF plugin.
 */
function wcmsh_google_map_api($api){
	$api['key'] = 'AIzaSyAa38IcC1aetYkYfpdKdBWTU3qLtn_UqEE';
	return $api;
}
add_filter('acf/fields/google_map/api', 'wcmsh_google_map_api');

/**
 * Styles and scripts.
 */
function wcmsh_styles() {
	// lightbox
	wp_enqueue_style('wcmsh-lightbox', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.9.0/css/lightbox.min.css');
	wp_enqueue_script('wcmsh-lightbox', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.9.0/js/lightbox.min.js', array('jquery'), '', true);

	// our plugin's styles
	wp_enqueue_style('wcmsh-styles', plugin_dir_url(__FILE__) . "assets/css/style.css");
	wp_enqueue_script('wcmsh-script', plugin_dir_url(__FILE__) . "assets/js/script.js", array('jquery', 'wcmsh-lightbox'), '', true);
}
add_action('wp_enqueue_scripts', 'wcmsh_styles');
