<?php

class WCMS_Gear_Info_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'wcms-gear-info-widget',  // Base ID
			'WCMS Gear Info'   // Name
		);

		add_action('widgets_init', function() {
			register_widget('WCMS_Gear_Info_Widget');
		});
	}

	public $args = array(
		'before_title'  => '<h4 class="widgettitle">',
		'after_title'   => '</h4>',
		'before_widget' => '<div class="widget-wrap">',
		'after_widget'  => '</div></div>'
	);

	public function widget($args, $instance) {

		$price = get_field('price');
		$email = get_field('email');
		$phone = get_field('phone');

		$post_id = get_the_ID();
		$gear_type = get_the_term_list($post_id, 'gear_type', null, ', ', null);

		echo $args['before_widget'];

		if (!empty($instance['title'])) {
			echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
		}

		echo '<div class="textwidget">';

		// details
		echo "<p>Price: {$price}</p>";
		echo "<p>Gear Type: {$gear_type}</p>";
		echo "<p>Email: <a href=\"mailto:{$email}\">{$email}</a></p>";
		echo "<p>Phone: {$phone}</p>";

		echo '</div>';
		echo $args['after_widget'];
	}

	public function form($instance) {

		$title = ! empty($instance['title']) ? $instance['title'] : esc_html__('', 'text_domain');
		$show_map = $instance['show_map'];
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
$wcms_gear_info_widget = new WCMS_Gear_Info_Widget();
