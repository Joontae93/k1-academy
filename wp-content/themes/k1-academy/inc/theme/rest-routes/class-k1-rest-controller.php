<?php
/**
 * Custom Rest Route for K1 Blocks to utilize
 *
 * @package KingdomOne
 */

namespace KingdomOne;

/**
 * Custom Rest Route
 */
class K1_REST_Controller {
	private $namespace;
	private $version;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->version   = 1;
		$this->namespace = "k1academy/v{$this->version}";
		add_action( 'rest_api_init', array( $this, 'register_rest_routes' ) );
	}

	/**
	 * Register Rest Routes
	 */
	public function register_rest_routes() {
		register_rest_route(
			$this->namespace,
			'/homepage-slides',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'get_the_slides' ),
				'permission_callback' => function () {
					return current_user_can( 'edit_posts' );
				},
			)
		);
	}

	/**
	 * Get Courses
	 */
	public function get_the_slides() {
		$response = new \WP_REST_Response( null, 200 );
		$slides   = new \WP_Query(
			array(
				'post_type'      => 'homepage-slide',
				'posts_per_page' => 6,
			)
		);
		if ( ! $slides->have_posts() ) {
			$response->set_data( array( 'message' => 'No slides found' ) );
			$response->set_status( 500 );
		} else {
			$data = array();
			while ( $slides->have_posts() ) {
				$slides->the_post();
				$post_id      = get_the_ID();
				$thumbnail_id = get_post_thumbnail_id( $post_id );
				$data[]       = array(
					'title'       => get_the_title(),
					'id'          => $post_id,
					'image'       => array(
						'src'    => \get_the_post_thumbnail_url( $post_id, 'banner_image' ),
						'alt'    => \wp_get_attachment_metadata( $thumbnail_id )['alt'],
						'srcset' => \wp_get_attachment_image_srcset( $thumbnail_id, 'banner_image' ),
					),
					'link'        => get_field( 'slider_url' ),
					'slide_order' => get_field( 'slide_order' ),
				);
			}
			wp_reset_postdata();
			$response->set_data( $data );
		}

		return rest_ensure_response( $response );
	}
}
