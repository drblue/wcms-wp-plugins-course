<?php
/**
 * Plugin Name: WCMS Gear
 * Plugin URI: http://localhost
 * Description: Awesome gear to rent!
 * Version: 1.0.0
 * Author: Johan Nordström
 * License: WTFPL
 */

require "widget-gear-info.php";
require "acf.php";
require "cpt.php";
require "ct.php";

function wcms_the_content_filter($content) {
	if (get_post_type() !== 'gear') {
		return $content;
	}

	// get image gallery
	$images = get_field('gallery');

	$html = "";
	if (!empty($images)) {
		$html .= "<div class='wcms-gear-gallery'>";
		foreach ($images as $image) {
			$image_url = $image['url'];
			$thumb_url = $image['sizes']['thumbnail'];
			$html .= "<a href='{$image_url}' data-lightbox='wcms-gear-gallery'><img src='{$thumb_url}'></a>";
		}
		$html .= "</div>";
	}

	return $html . $content;
}
add_filter('the_content', 'wcms_the_content_filter');


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
