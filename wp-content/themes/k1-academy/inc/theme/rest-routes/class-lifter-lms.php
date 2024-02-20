<?php
/**
 * Custom Lifter LMS Rest Route
 *
 * @package KingdomOne
 */

namespace KingdomOne;

class Lifter_LMS_REST_Controller {
	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'rest_api_init', array( $this, 'register_rest_routes' ) );
	}

	/**
	 * Register Rest Routes
	 */
	public function register_rest_routes() {
		register_rest_route(
			'k1academy/v1',
			'/lifter-lms/courses/categories',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'get_course_categories' ),
				'permission_callback' => function () {
					return current_user_can( 'edit_posts' );
				},
			)
		);
	}

	/**
	 * Get Courses
	 */
	public function get_course_categories() {
		$response = new \WP_REST_Response( null, 200 );
		$response->set_data( get_terms( 'course_cat' ) );

		return rest_ensure_response( $response );
	}
}
