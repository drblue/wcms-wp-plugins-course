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
