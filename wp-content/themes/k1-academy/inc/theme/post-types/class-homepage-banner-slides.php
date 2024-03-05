<?php
/**
 * Builds the Homepage Banner Slides Post Type
 *
 * @package KingdomOne
 */

namespace KingdomOne;

/**
 * Homepage Banner Slides
 */
class Homepage_Banner_Slides {
	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_post_type' ) );
		add_action( 'acf/include_fields', array( $this, 'add_acf_fields' ) );
	}
	/**
	 * Add ACF Fields
	 */
	public function add_acf_fields() {
		if ( ! function_exists( 'acf_add_local_field_group' ) ) {
			return;
		}

		acf_add_local_field_group(
			array(
				'key'                   => 'group_65e67b2233dfa',
				'title'                 => 'Post Type — Homepage Banner Slides',
				'fields'                => array(
					array(
						'key'                   => 'field_65e67b47b26fd',
						'label'                 => 'Slider Order',
						'name'                  => 'slider_order',
						'aria-label'            => '',
						'type'                  => 'number',
						'instructions'          => '',
						'required'              => 0,
						'conditional_logic'     => 0,
						'wrapper'               => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'admin_column_enabled'  => 1,
						'admin_column_position' => '',
						'admin_column_width'    => '',
						'default_value'         => 1,
						'min'                   => '',
						'max'                   => '',
						'placeholder'           => '',
						'step'                  => '',
						'prepend'               => '',
						'append'                => '',
					),
					array(
						'key'                  => 'field_65e67b22b26fc',
						'label'                => 'Slider Url',
						'name'                 => 'slider_url',
						'aria-label'           => '',
						'type'                 => 'link',
						'instructions'         => '',
						'required'             => 0,
						'conditional_logic'    => 0,
						'wrapper'              => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'admin_column_enabled' => 0,
						'return_format'        => 'array',
					),
				),
				'location'              => array(
					array(
						array(
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => 'homepage-slide',
						),
					),
				),
				'menu_order'            => 0,
				'position'              => 'normal',
				'style'                 => 'default',
				'label_placement'       => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen'        => '',
				'active'                => true,
				'description'           => '',
				'show_in_rest'          => 1,
			)
		);
	}

	/**
	 * Register Post Type
	 */
	public function register_post_type() {
		register_post_type(
			'homepage-slide',
			array(
				'labels'           => array(
					'name'                     => 'Homepage Banner Slides',
					'singular_name'            => 'Homepage Banner Slide',
					'menu_name'                => 'Homepage Banner Slider',
					'all_items'                => 'All Slides',
					'edit_item'                => 'Edit Slide',
					'view_item'                => 'View Slide',
					'view_items'               => 'View Slides',
					'add_new_item'             => 'Add New Slide',
					'add_new'                  => 'Add New Slide',
					'new_item'                 => 'New Slide',
					'parent_item_colon'        => 'Parent Slide:',
					'search_items'             => 'Search Slides',
					'not_found'                => 'No slides found',
					'not_found_in_trash'       => 'No slides found in Trash',
					'archives'                 => 'Slide Archives',
					'attributes'               => 'Slide Attributes',
					'insert_into_item'         => 'Insert into slide',
					'uploaded_to_this_item'    => 'Uploaded to this slide',
					'filter_items_list'        => 'Filter slides list',
					'filter_by_date'           => 'Filter slides by date',
					'items_list_navigation'    => 'Slides list navigation',
					'items_list'               => 'Slides list',
					'item_published'           => 'Slide published.',
					'item_published_privately' => 'Slide published privately.',
					'item_reverted_to_draft'   => 'Slide reverted to draft.',
					'item_scheduled'           => 'Slide scheduled.',
					'item_updated'             => 'Slide updated.',
					'item_link'                => 'Slide Link',
					'item_link_description'    => 'A link to a slide.',
				),
				'description'      => 'Powers the Homepage Hero Slider',
				'public'           => true,
				'show_in_rest'     => true,
				'rest_base'        => 'homepage-slides',
				'rest_namespace'   => 'k1academy/v1',
				// 'rest_controller_class' => 'KingdomOne\\K1_REST_Controller',
				'menu_position'    => 10,
				'menu_icon'        => 'dashicons-images-alt',
				'supports'         => array(
					0 => 'title',
					// 1 => 'editor',
					2 => 'thumbnail',
				),
				'delete_with_user' => false,
			)
		);
	}
}