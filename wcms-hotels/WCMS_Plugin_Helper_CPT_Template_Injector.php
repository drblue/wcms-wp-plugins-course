<?php
/**
 * The WCMS Custom Post Type Template Injector.
 *
 * @since 1.0.0
 * @package WCMS Plugin Helper/Templates
 * @author Johan Nordström <johan@digitalvillage.se>
 */

namespace WCMS_Plugin_Helper;

/**
 * Custom Post Type Template Injector.
 *
 * @since 1.0.0
 * @package WCMS Plugin Helper/Templates
 * @author Johan Nordström <johan@digitalvillage.se>
 */
class CPT_Template_Injector {

	protected static $_instance = null;

	protected $custom_post_types = [];

	/**
	 * Main CPT_Template_Injector Instance.
	 *
	 * Ensures only one instance of CPT_Template_Injector is loaded or can be loaded.
	 *
	 * @since 1.0
	 * @static
	 * @param array Array with one or more CPT slugs.
	 */
	public static function init($custom_post_types) {
		if (is_null(self::$_instance)) {
			self::$_instance = new self($custom_post_types);
		} else {
			(self::$_instance)->add_custom_post_types($custom_post_types);
		}
	}

	/**
	 * CPT_Template_Injector Constructor.
	 *
	 * @param array Array with one or more CPT slugs.
	 * @since 1.0
	 */
	public function __construct(Array $custom_post_types) {
		define('CPT_TI_PLUGIN_BASENAME', plugin_basename(__FILE__));
		define('CPT_TI_ABSPATH', trailingslashit(dirname(__FILE__)));
		define('CPT_TI_TEMPLATES_ABSPATH', trailingslashit(CPT_TI_ABSPATH . '/templates'));

		$this->custom_post_types = $custom_post_types;
		$this->init_hooks();
	}

	/**
	 * Hook into actions and filters.
	 * @since 1.0
	 */
	private function init_hooks() {
		add_filter('template_include', [$this, 'template_include_filter'], 99);
	}

	/**
	 * Get default template paths to search.
	 * @since 1.0
	 * @static
	 * @return array
	 */
	private static function get_default_template_paths() {
		return [
			get_stylesheet_directory() . "/templates",
			get_template_directory() . "/templates",
			CPT_TI_TEMPLATES_ABSPATH,
		];
	}

	/**
	 * Add Custom Post Types to our existing instance.
	 * @since 1.0
	 * @param array Custom Post Types to add.
	 */
	private function add_custom_post_types($custom_post_types) {
		$this->custom_post_types = array_merge($this->custom_post_types, $custom_post_types);
	}

	/**
	 * Hook into actions and filters.
	 * @since 1.0
	 * @static
	 * @param array $templates Templates to search for.
	 * @param array $templates Paths to search in.
	 * @return string|bool $template
	 */
	private static function find_highest_priority_template($templates, $paths = []) {
		if (empty($paths)) {
			$paths = self::get_default_template_paths();
		}

		foreach ($paths as $path) {
			foreach ($templates as $template) {
				if (file_exists($path . "/" . $template)) {
					return $path . "/" . $template;
				}
			}
		}

		return false;
	}

	/**
	 * Checks the helper's registered CPTs and returns the
	 * CPT-specific template, if one exists, in the following order:
	 *
	 * /themes/<child-theme>/templates/<template>.php
	 * /themes/<parent-theme>/templates/<template>.php
	 * /plugins/<plugin-name>/templates/<template>.php
	 *
	 * where <template> is replaced with with more fine-grained searches
	 * at first, followed by less and less granularity, all according to
	 * how WordPress itself loads templates (see Template Hierarchy Diagram).
	 *
	 * @return template to load
	 * @author Johan Nordström <johan@digitalvillage.se>
	 */
	function template_include_filter($origin_template) {
		$post_type = get_post_type();

		// if template being loaded isn't one of our post types, just bail
		if (array_search($post_type, $this->custom_post_types) === false) {
			return $origin_template;
		}

		$object = get_queried_object();
		$templates = [];

		if (is_tax()) {
			if (!empty($object->slug)) {
				$taxonomy = $object->taxonomy;
				$slug_decoded = urldecode($object->slug);
				if ($slug_decoded !== $object->slug) {
					$templates[] = "taxonomy-{$taxonomy}-{$slug_decoded}.php";
				}

				$templates[] = "taxonomy-{$taxonomy}-{$object->slug}.php";
				$templates[] = "taxonomy-{$taxonomy}.php";
			}
			$templates[] = 'taxonomy.php';

		} elseif (is_single()) {
			$name_decoded = urldecode($object->post_name);
			if ($name_decoded !== $object->post_name) {
				$templates[] = "single-{$object->post_type}-{$name_decoded}.php";
			}

			$templates[] = "single-{$object->post_type}-{$object->post_name}.php";
			$templates[] = "single-{$object->post_type}.php";

			$templates[] = "single.php";

		} elseif (is_category()) {
			if (!empty($object->slug)) {
				$slug_decoded = urldecode($object->slug);
				if ($slug_decoded !== $object->slug) {
					$templates[] = "category-{$slug_decoded}.php";
				}

				$templates[] = "category-{$object->slug}.php";
				$templates[] = "category-{$object->term_id}.php";
			}
			$templates[] = 'category.php';

		} elseif (is_tag()) {
			if (!empty($object->slug)) {
				$slug_decoded = urldecode($object->slug);
				if ($slug_decoded !== $object->slug) {
					$templates[] = "tag-{$slug_decoded}.php";
				}

				$templates[] = "tag-{$object->slug}.php";
				$templates[] = "tag-{$object->term_id}.php";
			}
			$templates[] = 'tag.php';

		} elseif (is_archive()) {
			$templates[] = "archive-{$post_type}.php";
			$templates[] = "archive.php";
		}

		$template = self::find_highest_priority_template($templates);
		if ($template) {
			return $template;
		}

		// always return origin template as a fail-safe
		return $origin_template;
	}

}
