<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.digitalvillage.se
 * @since             1.0.0
 * @package           Wcms_Popular_Posts
 *
 * @wordpress-plugin
 * Plugin Name:       Popular Posts
 * Plugin URI:        http://www.popular-posts.com
 * Description:       This is a plugin that keeps track of popular posts and displays them in a top list.
 * Version:           1.0.0
 * Author:            Johan Nordström
 * Author URI:        http://www.digitalvillage.se
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wcms-popular-posts
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wcms-popular-posts-activator.php
 */
function activate_wcms_popular_posts() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wcms-popular-posts-activator.php';
	Wcms_Popular_Posts_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wcms-popular-posts-deactivator.php
 */
function deactivate_wcms_popular_posts() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wcms-popular-posts-deactivator.php';
	Wcms_Popular_Posts_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wcms_popular_posts' );
register_deactivation_hook( __FILE__, 'deactivate_wcms_popular_posts' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wcms-popular-posts.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wcms_popular_posts() {

	$plugin = new Wcms_Popular_Posts();
	$plugin->run();

}
run_wcms_popular_posts();
