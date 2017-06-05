<?php

class WCMS_Hotel_Info_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'wcms-hotel-info-widget',  // Base ID
			'WCMS Hotel Info'   // Name
		);

		add_action('widgets_init', function() {
			register_widget('WCMS_Hotel_Info_Widget');
		});
	}

	public $args = array(
		'before_title'  => '<h4 class="widgettitle">',
		'after_title'   => '</h4>',
		'before_widget' => '<div class="widget-wrap">',
		'after_widget'  => '</div></div>'
	);

	public function widget($args, $instance) {

		$rooms = get_field('rooms');
		$map = get_field('map');
		$phone = get_field('phone');
		$email = get_field('email');
		$price = get_field('price');
		$images = get_field('gallery');

		echo $args['before_widget'];

		if (!empty($instance['title'])) {
			echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
		}

		echo '<div class="textwidget">';

		// details
		echo "<p>Rooms: {$rooms}</p>";
		echo "<p>Address: {$map['address']}</p>";
		echo "<p>Email: <a href=\"mailto:{$email}\">{$email}</a></p>";
		echo "<p>Phone: {$phone}</p>";
		echo "<p>Price/night: {$price} kr</p>";

		// image gallery
		if (!empty($images)) {
			echo "<p><strong>Image Gallery</strong></p>";
			echo "<ul class='wcmsh-image-gallery'>";
			foreach ($images as $image) {
				echo "<li><a href='{$image['url']}' data-lightbox='wcmsh-image-gallery'><img src='{$image['sizes']['thumbnail']}' /></a></li>";
			}
			echo "</ul>";
		}

		// map
		if (!empty($map) && $instance['show_map'] === true) {
			$map_code = file_get_contents(__DIR__ . "/map.html");
			echo $map_code;
			echo '<div class="acf-map">
					<div class="marker" data-lat="' . $map['lat'] . '" data-lng="' . $map['lng'] . '"></div>
				</div>';
		}

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
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('show_map')); ?>"><?php esc_attr_e('Show map:', 'text_domain'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('show_map')); ?>" name="<?php echo esc_attr($this->get_field_name('show_map')); ?>" type="checkbox" <?php echo ($show_map) ? "checked" : ""; ?>>
		</p>
		<?php

	}

	public function update($new_instance, $old_instance) {

		$instance = array();
		$instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
		$instance['show_map'] = (!empty($new_instance['show_map']));

		return $instance;
	}

}
$wcms_hotel_info_widget = new WCMS_Hotel_Info_Widget();
