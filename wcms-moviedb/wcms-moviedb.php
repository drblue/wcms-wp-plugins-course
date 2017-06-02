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
			array(
				'id' => $prefix . 'trailer-url',
				'type' => 'url',
				'name' => esc_html__( 'Trailer URL', 'wcms-moviedb' ),
				'desc' => esc_html__( 'URL to movie trailer', 'wcms-moviedb' ),
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'wm_get_meta_box' );

function wm_movie_content_filter($content) {
	if (get_post_type() === "movie") {
		// get the movie length
		$movie_length = rwmb_meta('wm-movie-length', []);
		$content .= " <p>Movie length: {$movie_length} minutes</p>";

		// get the movie trailer URL
		$trailer_url = rwmb_meta('wm-trailer-url', []);
		$content .= " <p>Movie trailer: <a href='{$trailer_url}'>Youtube</a></p>";

		// get the movie genres
		$movie_genres = get_the_term_list(
			get_the_ID(), // current post's id
			"movie-genre", // taxonomy to get terms for
			"<p>Genres: ", // prefix result with empty string
			", ", // separate result with ", "
			"</p>" // suffix result with empty string
		);
		$content .= $movie_genres;
	}
	return $content;
}
add_filter('the_content', 'wm_movie_content_filter');
