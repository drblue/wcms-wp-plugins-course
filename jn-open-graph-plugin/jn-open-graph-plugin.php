<?php
/**
 * Plugin Name: Open Graph plugin
 * Plugin URI: http://www.opengraphplugin.com
 * Description: This plugin adds Open Graph tags to the website.
 * Version: 1.0.0
 * Author: Johan Nordström
 * License: WTFPL
 */

function jn_facebook_tags() {
	if (is_single()) {
		$title = get_the_title();
		echo '<meta property="og:title" content="' . $title . '" />';

		$description = get_the_content();
		echo '<meta property="og:description" content="' . $description . '" />';
	}
}
add_action('wp_head', 'jn_facebook_tags');
