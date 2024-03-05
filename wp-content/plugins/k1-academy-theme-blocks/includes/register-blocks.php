<?php
/**
 * Register custom blocks for the K1 Academy theme.
 *
 * @package KingdomOne
 * @subpackage K1AcademyThemeBlocks
 */

namespace KingdomOne\K1AcademyThemeBlocks;

/**
 * Register the custom blocks.
 */
function register_blocks() {
	$blocks = array(
		array( 'name' => 'banner-swiper' ),
		array( 'name' => 'k1-icon' ),
		array( 'name' => 'courses-swiper' ),
	);
	foreach ( $blocks as $block ) {
		register_block_type(
			K1_ACADEMY_THEME_BLOCKS . 'build/blocks/' . $block['name']
		);
	}
}
add_action( 'init', __NAMESPACE__ . '\register_blocks' );

add_filter(
	'block_categories_all',
	function ( $categories ) {

		// Adds a custom category for theme blocks to the top of the list.
		array_unshift(
			$categories,
			array(
				'slug'  => 'k1-academy-theme',
				'title' => 'Kingdom One Academy',
			)
		);
		return $categories;
	}
);