<?php
/**
 * FUNCTIONS.PHP
 * Overwrite or add your own custom functions to Pro in this file.
 *
 * @package KingdomOne
 */

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
// 01. Enqueue Parent Stylesheet
// 02. Additional Functions
// =============================================================================

// Enqueue Parent Stylesheet
// =============================================================================

add_filter( 'x_enqueue_parent_stylesheet', '__return_true' );


// Additional Functions
// =============================================================================

/**
 * Enqueue child styles & scripts
 */
function k1_academy_child_enqueue_styles() {
	$theme_assets = require_once get_template_directory() . '/build/global.asset.php';
	wp_enqueue_style(
		'global',
		get_stylesheet_directory_uri() . '/build/index.css',
		$theme_assets['dependencies'],
		$theme_assets['version']
	);
	wp_enqueue_script(
		'global',
		get_stylesheet_directory_uri() . '/build/index.js',
		$theme_assets['dependencies'],
		$theme_assets['version'],
		array( 'strategy' => 'defer' )
	);
	wp_localize_script(
		'global',
		'k1AcademyData',
		array(
			'root_url' => get_site_url(),
			'day'      => date( 'D' ), // phpcs:ignore
			'year'     => date( 'Y' ), // phpcs:ignore
		)
	);
}
add_action( 'wp_enqueue_scripts', 'k1_academy_child_enqueue_styles' );

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


require_once get_theme_file_path( '/includes/llms-customizations.php' );
