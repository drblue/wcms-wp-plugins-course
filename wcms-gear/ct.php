<?php

function cptui_register_my_taxes() {

	/**
	 * Taxonomy: Gear Types.
	 */

	$labels = array(
		"name" => __( 'Gear Types', 'twenty-seventeen-child' ),
		"singular_name" => __( 'Gear Type', 'twenty-seventeen-child' ),
	);

	$args = array(
		"label" => __( 'Gear Types', 'twenty-seventeen-child' ),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => true,
		"label" => "Gear Types",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'type', 'with_front' => true, ),
		"show_admin_column" => false,
		"show_in_rest" => false,
		"rest_base" => "",
		"show_in_quick_edit" => false,
	);
	register_taxonomy( "gear_type", array( "gear" ), $args );
}

add_action( 'init', 'cptui_register_my_taxes' );
