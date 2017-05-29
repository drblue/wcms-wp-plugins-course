<?php
/**
 * Plugin Name: Testimonials
 * Plugin URI: http://localhost
 * Description: This plugin adds Testimonials to the website.
 * Version: 1.0.0
 * Author: Johan Nordström
 * License: WTFPL
 */

function cptui_register_my_cpts_testimonial() {
	/**
	 * Post Type: Testimonials.
	 */

	$labels = array(
		"name" => __( 'Testimonials', 'twentyseventeen' ),
		"singular_name" => __( 'Testimonial', 'twentyseventeen' ),
	);

	$args = array(
		"label" => __( 'Testimonials', 'twentyseventeen' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "testimonial", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "testimonial", $args );
}
add_action( 'init', 'cptui_register_my_cpts_testimonial' );

function jn_testimonials_shortcode() {

	$html = "";

	// create query and get all testimonials in the database
	$testimonial_query = new WP_Query(['post_type' => 'testimonial']);
	if ($testimonial_query->have_posts()) {
		$html = $html . "<h2>Testimonials from our valued Customers</h2>";
		$html = $html . "<ul>";
		while ($testimonial_query->have_posts()) {
			$testimonial_query->the_post();

			$title = get_the_title();
			$content = get_the_content();

			$html = $html . "<li>{$content} -{$title}</li>";
		}
		$html = $html . "</ul>";
		wp_reset_postdata();
	}

	return $html;
}
add_shortcode('testimonials', 'jn_testimonials_shortcode');
