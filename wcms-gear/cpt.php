<?php

function cptui_register_my_cpts() {

	/**
	 * Post Type: Gears.
	 */

	$labels = array(
		"name" => __( 'Gears', 'twenty-seventeen-child' ),
		"singular_name" => __( 'Gear', 'twenty-seventeen-child' ),
	);

	$args = array(
		"label" => __( 'Gears', 'twenty-seventeen-child' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => true,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "gear", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "gear", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );
