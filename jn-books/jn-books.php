<?php
/**
 * Plugin Name: Books
 * Plugin URI: http://localhost
 * Description: Awesome books to read!
 * Version: 1.0.0
 * Author: Johan Nordström
 * License: WTFPL
 */

function jnb_author_shortcode() {
	$book_author = get_post_meta(get_the_ID(), 'book_author', true);
	return $book_author;
}
add_shortcode('book_author', 'jnb_author_shortcode');

function jnb_title_shortcode() {
	$book_title = get_post_meta(get_the_ID(), 'book_title', true);
	return $book_title;
}
add_shortcode('book_title', 'jnb_title_shortcode');

function jnb_link_shortcode() {
	$book_link = get_post_meta(get_the_ID(), 'book_link', true);
	return $book_link;
}
add_shortcode('book_link', 'jnb_link_shortcode');

function jnb_book_info_shortcode() {
	$book_author = get_post_meta(get_the_ID(), 'book_author', true);
	$book_title = get_post_meta(get_the_ID(), 'book_title', true);
	$book_link = get_post_meta(get_the_ID(), 'book_link', true);

	return "Author: {$book_author}<br />Title: {$book_title}<br />Link: {$book_link}";
}
add_shortcode('book_info', 'jnb_book_info_shortcode');

function jnb_books() {
	$html = "";
	$books = new WP_Query(['post_type' => 'book_reviews']);
	if ($books->have_posts()) {
		while ($books->have_posts()) {
			$books->the_post();

			$html .= "<article>";
			$title = get_the_title();
			$excerpt = get_the_excerpt();
			$link = get_the_permalink();
			$html .= "<h2>{$title}</h2>";
			$html .= "<p>{$excerpt}</p>";
			$html .= "<a href='{$link}'>Read Moar</a>";
			$html .= "</article>";
		}
		wp_reset_postdata();
	}
	return $html;
}
add_shortcode('book_reviews', 'jnb_books');
