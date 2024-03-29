<?php
/**
 * LifterLMS Customizations
 *
 * @package KingdomOne
 * @subpackage LifterLMS
 */

// Lifter LMS Sidebar Functions
// ===========================================================================
/**
 * Display LifterLMS Course and Lesson sidebars on courses and lessons in place of the sidebar returned by this function
 *
 * @return string
 */
function k1_academy_llms_sidebar_function() {

	$my_sidebar_id = 'sidebar-main'; // replace this with your theme's sidebar ID

	return $my_sidebar_id;
}
add_filter( 'llms_get_theme_default_sidebar', 'k1_academy_llms_sidebar_function' );

/**
 * Declare explicit theme support for LifterLMS course and lesson sidebars
 *
 * @return void
 */
function k1_academy_llms_theme_support() {
	add_theme_support( 'lifterlms-sidebars' );
}
add_action( 'after_setup_theme', 'k1_academy_llms_theme_support' );


// Add X-Container Styles to Lifter LMS via Hooks

/**
 * Add the x-container class to the main LifterLMS content area
 */
function k1_academy_begin_x_container() {
	echo '<div class="x-container max width">';
}

/**
 * Close the x-container div
 */
function k1_academy_end_x_container() {
	echo '</div>';
}
add_action( 'lifterlms_before_main_content', 'k1_academy_begin_x_container' );
add_action( 'lifterlms_after_main_content', 'k1_academy_end_x_container' );
