<?php
/**
 * Theme Initialization
 *
 * @package KingdomOne
 */

namespace KingdomOne;

/**
 * Theme_Init
 */
class Theme_Init {
	/**
	 * Theme_Init constructor.
	 */
	public function __construct() {
		add_filter( 'x_enqueue_parent_stylesheet', '__return_true' );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );
	}

	/**
	 * Enqueue child styles & scripts
	 */
	public function enqueue_assets() {
		$theme_assets = require_once get_stylesheet_directory() . '/build/global.asset.php';
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
}
