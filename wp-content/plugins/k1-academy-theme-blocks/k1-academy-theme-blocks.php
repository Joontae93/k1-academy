<?php
/**
 * Plugin Name: K1 Academy Theme Blocks
 * Plugin URI: https://github.com/kingdom-one/k1-academy
 * Description: Custom Gutenberg blocks for the K1 Academy theme.
 * Version: 1.0
 * Author: Kingdom One
 * Author URI: https://kingdomone.co
 * License: GPL GNU v3 or Later
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: k1-academy-theme-blocks
 * Requires at least: 6.0
 * Requires PHP: 7.4
 * Tested up to: 6.4.3
 *
 * @package KingdomOne
 * @subpackage K1AcademyThemeBlocks
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define the plugin file.
define( 'K1_ACADEMY_THEME_BLOCKS', plugin_dir_path( __FILE__ ) );

// Load the plugin files.
require_once K1_ACADEMY_THEME_BLOCKS . 'includes/register-blocks.php';
