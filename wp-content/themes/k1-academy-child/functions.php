<?php
/**
 * FUNCTIONS.PHP
 * Overwrite or add your own custom functions to Pro in this file.
 *
 * @package KingdomOne
 */

use KingdomOne\LifterLMS\Lifter_Customizations;
use KingdomOne\Theme_Init;

// Load Child Theme Initializer class
require_once get_theme_file_path( '/includes/class-theme-init.php' );
new Theme_Init();

// LifterLMS Customizations
require_once get_theme_file_path( '/includes/class-lifter-customizations.php' );
new Lifter_Customizations();

// ===========================================================================
// Custom Functions
// ===========================================================================

/**
 * Redirect to custom 404 page when no search results are found
 */
function k1_academy_redirect_to_custom_404() {
	global $wp_query;
	if ( is_search() && ! $wp_query->found_posts ) {
		wp_safe_redirect( home_url( '/404' ) );
	}
}
add_action( 'template_redirect', 'k1_academy_redirect_to_custom_404' );
