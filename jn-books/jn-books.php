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
	return get_post_meta(get_the_ID(), 'book_author', true);
	// return $book_author;
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
	// alt. 1, hämta custom field 'book_author'
	$book_author = get_post_meta(get_the_ID(), 'book_author', true);

	// alt. 2, gör samma som ovan
	$book_author = jnb_author_shortcode();

	// alt. 3, gör samma som ovan
	$book_author = do_shortcode('book_author');

	// hämta custom field 'book_title'
	$book_title = get_post_meta(get_the_ID(), 'book_title', true);

	// hämta custom field 'book_link'
	$book_link = get_post_meta(get_the_ID(), 'book_link', true);
	if (empty($book_link)) {
		$book_link = "(this book has no link)";
	}

	return "Author: {$book_author}<br />Title: {$book_title}<br />Link: {$book_link}";
}
add_shortcode('book_info', 'jnb_book_info_shortcode');

function jnb_book_reviews_shortcode() {
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
add_shortcode('book_reviews', 'jnb_book_reviews_shortcode');
