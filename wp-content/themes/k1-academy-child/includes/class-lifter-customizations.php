<?php
/**
 * LifterLMS Customizations
 *
 * @package KingdomOne
 * @subpackage LifterLMS
 */

namespace KingdomOne\LifterLMS;

/**
 * LifterLMS Customizations
 */
class Lifter_Customizations {
	/**
	 * Wire up Hooks & callbacks
	 */
	public function __construct() {
		$this->enable_lms_sidebar();
		$this->wrap_lms_with_container();
		add_filter( 'lifterlms_theme_override_directories', array( $this, 'lifter_template_overrides' ), 10, 1 );
	}

	/**
	 * Enables Lifter LMS Sidebar & Theme Compatibility
	 */
	private function enable_lms_sidebar() {
		add_filter( 'llms_get_theme_default_sidebar', array( $this, 'lifter_sidebar_function' ) );
		add_action(
			'after_setup_theme',
			function () {
				add_theme_support( 'lifterlms-sidebars' );
			}
		);
	}

	/**
	 * Display LifterLMS Course and Lesson sidebars on courses and lessons in place of the sidebar returned by this function
	 *
	 * @return string
	 */
	public function lifter_sidebar_function() {
		$my_sidebar_id = 'sidebar-main'; // replace this with your theme's sidebar ID
		return $my_sidebar_id;
	}

	/**
	 * Wrap LifterLMS content with Pro Theme Container div
	 */
	private function wrap_lms_with_container() {
		add_action(
			'lifterlms_before_main_content',
			function () {
				echo '<div class="x-container max width">';
			}
		);
		add_action(
			'lifterlms_after_main_content',
			function () {
				echo '</div>';
			}
		);
	}

	/**
	 * Adds the templates folder to the list of directories to search for LifterLMS templates
	 *
	 * @param  array $dirs Array of paths to directories to load LifterLMS templates from
	 * @return array
	 */
	public function lifter_template_overrides( array $dirs ): array {
		array_unshift( $dirs, get_stylesheet_directory() . '/templates/lifterlms' );
		return $dirs;
	}
}
