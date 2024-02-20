<?php
/**
 * Initializes the Theme
 *
 * @package KingdomOne
 * @since 1.3
 */

namespace KingdomOne;

/** Builds the Theme */
class Theme_Init {
	/** Constructor */
	public function __construct() {
		$this->load_required_files();
		$this->k1academy_set_environment();
		$this->disable_discussion();
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_k1academy_scripts' ) );
		add_action( 'after_setup_theme', array( $this, 'k1academy_theme_support' ) );
		add_action( 'init', array( $this, 'alter_post_types' ) );
	}

	/** Load required files. */
	private function load_required_files() {
		$base_path = get_template_directory() . '/inc';
		require_once $base_path . '/theme/theme-functions.php';

		$asset_loaders = array( 'enum-enqueue-type', 'class-asset-loader' );
		foreach ( $asset_loaders as $asset_loader ) {
			require_once $base_path . '/theme/asset-loader/' . $asset_loader . '.php';
		}

		$navwalkers = array( 'navwalker', 'mega-menu' );
		foreach ( $navwalkers as $navwalker ) {
			require_once $base_path . '/theme/navwalkers/class-' . $navwalker . '.php';
		}

		require_once $base_path . '/theme/class-allow-svg.php';
		new Allow_SVG();

		require_once $base_path . '/theme/rest-routes/class-k1-rest-controller.php';
		new K1_REST_Controller();
	}

	/** Remove comments, pings and trackbacks support from posts types. */
	private function disable_discussion() {
		// Close comments on the front-end
		add_filter( 'comments_open', '__return_false', 20, 2 );
		add_filter( 'pings_open', '__return_false', 20, 2 );

		// Hide existing comments.
		add_filter( 'comments_array', '__return_empty_array', 10, 2 );

		// Remove comments page in menu.
		add_action(
			'admin_menu',
			function () {
				remove_menu_page( 'edit-comments.php' );
			}
		);

		// Remove comments links from admin bar.
		add_action(
			'init',
			function () {
				if ( is_admin_bar_showing() ) {
					remove_action( 'admin_bar_menu', 'wp_admin_bar_comments_menu', 60 );
				}
			}
		);
	}

	/** Sets an Environment Variable */
	private function k1academy_set_environment() {
		$server_name = $_SERVER['SERVER_NAME'];

		if ( false !== strpos( $server_name, '.local' ) ) {
			$_ENV['k1academy_ENV'] = 'dev';
		} elseif ( false !== strpos( $server_name, 'wpengine' ) ) {
			$_ENV['k1academy_ENV'] = 'stage';
		} else {
			$_ENV['k1academy_ENV'] = 'prod';
		}
	}

	/**
	 * Adds scripts with the appropriate dependencies
	 */
	public function enqueue_k1academy_scripts() {

		$bootstrap = new Asset_Loader(
			'bootstrap',
			Enqueue_Type::both,
			'vendors',
			array(
				'scripts' => array(),
				'styles'  => array(),
			)
		);

		// $fontawesome = new Asset_Loader( 'fontawesome', Enqueue_Type::style, 'vendors' );

		$global_scripts = new Asset_Loader(
			'global',
			Enqueue_Type::both,
			null,
			array(
				'scripts' => array( 'bootstrap' ),
				'styles'  => array( 'bootstrap' ),
			)
		);
		wp_localize_script( 'global', 'k1AcademySiteData', array( 'rootUrl' => home_url() ) );

		// style.css
		wp_enqueue_style(
			'main',
			get_stylesheet_uri(),
			array( 'global' ),
			wp_get_theme()->get( 'Version' )
		);

		// $this->remove_wordpress_styles(
		// array(
		// 'classic-theme-styles',
		// 'wp-block-library',
		// 'dashicons',
		// 'global-styles',
		// )
		// );
	}

	/**
	 * Provide an array of handles to dequeue.
	 *
	 * @param array $handles the script/style handles to dequeue.
	 */
	private function remove_wordpress_styles( array $handles ) {
		foreach ( $handles as $handle ) {
			wp_dequeue_style( $handle );
		}
	}

	/** Registers Theme Supports */
	public function k1academy_theme_support() {
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'title-tag' );

		add_image_size( 'banner_image', 3840, 2160 );
		add_image_size( 'course_preview_thumb', 796, 428 );

		register_nav_menus(
			array(
				'logged_in_menu'  => 'Logged In Menu',
				'logged_out_menu' => 'Logged Out Menu',
				'footer_menu'     => 'Footer Menu',
			)
		);
	}

	/** Remove post type support from posts types. */
	public function alter_post_types() {
		$post_types = array( 'post', 'page' );
		foreach ( $post_types as $post_type ) {
			$this->disable_post_type_support( $post_type );
		}
	}

	/** Disable post-type-supports from posts
	 *
	 * @param string $post_type the post type to remove supports from.
	 */
	private function disable_post_type_support( string $post_type ) {
		$supports = array( 'comments', 'trackbacks' );
		foreach ( $supports as $support ) {
			if ( post_type_supports( $post_type, $support ) ) {
				remove_post_type_support( $post_type, $support );
			}
		}
	}
}
