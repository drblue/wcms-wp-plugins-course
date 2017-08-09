<?php

class WCMS_Popular_Posts_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'wcms-popular-posts-widget',  // Base ID
			'WCMS Popular Post Counter'   // Name
		);

		add_action('widgets_init', function() {
			register_widget('WCMS_Popular_Posts_Widget');
		});
	}

	public $args = array(
		'before_title'  => '<h4 class="widgettitle">',
		'after_title'   => '</h4>',
		'before_widget' => '<div class="widget-wrap">',
		'after_widget'  => '</div></div>'
	);

	public function widget($args, $instance) {
		if (is_single()) {
			$counter = get_post_meta(get_the_ID(), 'wcms-popular-posts-counter', true);

			echo $args['before_widget'];

			if (!empty($instance['title'])) {
				echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
			}

			echo '<div class="textwidget">';
			echo "<p><small>This page has been visited <span class='wcms-popular-posts-counter'>{$counter}</span> times.</small></p>";
			echo '</div>';
			echo $args['after_widget'];
		}
	}

	public function form($instance) {

		$title = ! empty($instance['title']) ? $instance['title'] : esc_html__('', 'text_domain');
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('Title:', 'text_domain'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
		</p>
		<?php

	}

	public function update($new_instance, $old_instance) {

		$instance = array();
		$instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';

		return $instance;
	}

}
$wcms_Popular_Posts_widget = new WCMS_Popular_Posts_Widget();
