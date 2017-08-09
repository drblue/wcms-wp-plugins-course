<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.digitalvillage.se
 * @since      1.0.0
 *
 * @package    Wcms_Popular_Posts
 * @subpackage Wcms_Popular_Posts/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wcms_Popular_Posts
 * @subpackage Wcms_Popular_Posts/public
 * @author     Johan Nordström <johan@digitalvillage.se>
 */
class Wcms_Popular_Posts_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wcms_Popular_Posts_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wcms_Popular_Posts_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wcms-popular-posts-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wcms_Popular_Posts_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wcms_Popular_Posts_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wcms-popular-posts-public.js', array( 'jquery' ), $this->version, false );

		wp_localize_script($this->plugin_name, 'ajax_object', [
			'ajax_url' => admin_url('admin-ajax.php'),
			'post_id' => get_the_ID(),
		]);

	}

	public function update_post_counter() {
		// here we update this post's counter with +1
		if (is_single() && !is_user_logged_in()) {
			$counter = get_post_meta(get_the_ID(), 'wcms-popular-posts-counter', true);
			if (empty($counter)) {
				$counter = 0;
			}

			$counter = $counter + 1;

			update_post_meta(get_the_ID(), 'wcms-popular-posts-counter', $counter);
		}
	}

	public function the_content_filter($content) {
		if (is_single()) {
			$counter = get_post_meta(get_the_ID(), 'wcms-popular-posts-counter', true);
			$content = "<p><small>This page has been visited <span class='wcms-popular-posts-counter'>{$counter}</span> times.</small></p>" . $content;
		}

		return $content;
	}

}
