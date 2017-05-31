<?php
/**
 * Plugin Name: WCMS Movie Database
 * Plugin URI: http://localhost
 * Description: Much better than IMDB! No fan-boys!
 * Version: 1.0.0
 * Author: Johan Nordström
 * License: WTFPL
 */

function wm_get_meta_box( $meta_boxes ) {
	$prefix = 'wm-';

	$meta_boxes[] = array(
		'id' => 'movie-info',
		'title' => esc_html__( 'Movie Info', 'wcms-moviedb' ),
		'post_types' => array( 'movie' ),
		'context' => 'normal',
		'priority' => 'default',
		'autosave' => false,
		'fields' => array(
			array(
				'id' => $prefix . 'movie-length',
				'type' => 'number',
				'name' => esc_html__( 'Length', 'wcms-moviedb' ),
				'desc' => esc_html__( 'Length of Movie in minutes', 'wcms-moviedb' ),
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'wm_get_meta_box' );
