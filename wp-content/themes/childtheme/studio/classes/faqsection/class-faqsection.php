<?php

/**
 * Custom Post Type subclass
 */
class FaqSection extends PostType {
	/**
	 * Required variables
	 */
	protected $post_type = 'faqsection';
	protected $label_name = 'FAQ Section';
	protected $label_name_singular = 'FAQ Section';
	protected $args = array(
		'menu_icon' => 'dashicons-editor-help',
		'labels'              => array(
			'add_new_item'          => 'Nieuwe Vragen sectie',
			'add_new'               => 'Nieuwe Vragen sectie',
			'all_items'           	=> 'Alle Vragen secties',
		),
		'exclude_from_search' => false,
		'supports'            => array( 'title', 'editor', 'author', 'thumbnail' ),
		'rewrite'             => array(
			'slug'                => 'faq',
		),
	);

	public static function Register_Fields() {

		// setup theme settings
		if( function_exists('acf_add_local_field_group') ) {
			acf_add_local_field_group(array (
				'key' => 'group_faq_sections',
				'title' => 'FAQ Sections',
				'fields' => array (
					array (
						'key' => 'key_show_section',
						'label' => 'Select the section(s) to show',
						'name' => 'show_section',
						'type' => 'checkbox',
						'instructions' => 'Can\'t find your section? Check the <a href="/wp-admin/admin.php?page=studio-zendesk">Zendesk Settings</a> if it has been assigned.',
						'choices' => array (
						),
						'allow_custom' => 0,
						'save_custom' => 0,
						'default_value' => array (
						),
						'layout' => 'vertical',
						'toggle' => 0,
						'return_format' => 'array',
					),
				),
				'location' => array (
					array (
						array (
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'faqsection',
						),
					),
				),
				'menu_order' => 0,
				'position' => 'side',
				'style' => 'default',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'active' => 1,
			));
		}
	}
}
