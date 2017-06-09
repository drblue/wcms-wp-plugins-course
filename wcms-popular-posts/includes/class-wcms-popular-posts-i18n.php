<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://www.digitalvillage.se
 * @since      1.0.0
 *
 * @package    Wcms_Popular_Posts
 * @subpackage Wcms_Popular_Posts/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wcms_Popular_Posts
 * @subpackage Wcms_Popular_Posts/includes
 * @author     Johan Nordström <johan@digitalvillage.se>
 */
class Wcms_Popular_Posts_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wcms-popular-posts',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
