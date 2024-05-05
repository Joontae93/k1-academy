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
		/** Sets Yoast to bottom of Custom Fields */
		add_filter(
			'wpseo_metabox_prio',
			function (): string {
				return 'low';
			}
		);
	}

	/**
	 * Enqueue child styles & scripts
	 */
	public function enqueue_assets() {
		$theme_assets = require_once get_stylesheet_directory() . '/build/global.asset.php';
		wp_enqueue_style(
			'k1-academy-child',
			get_stylesheet_directory_uri() . '/build/global.css',
			array( 'x-child', ...$theme_assets['dependencies'] ),
			$theme_assets['version']
		);
		wp_enqueue_script(
			'k1-academy-child',
			get_stylesheet_directory_uri() . '/build/global.js',
			array( 'x-site', ...$theme_assets['dependencies'] ),
			$theme_assets['version'],
			array( 'strategy' => 'defer' )
		);
		wp_localize_script(
			'k1-academy-child',
			'k1AcademyData',
			array(
				'root_url' => get_site_url(),
			'day'      => date( 'D' ), // phpcs:ignore
			'year'     => date( 'Y' ), // phpcs:ignore
			)
		);
	}
}