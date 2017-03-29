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
		'supports'            => array( 'title','editor', 'author' ),
		'rewrite'             => array(
			'slug'                => 'faq',
		),
	);
}
