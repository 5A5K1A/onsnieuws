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
			'add_new_item'          => 'Nieuw FAQ Section',
			'add_new'               => 'Nieuw FAQ Section',
			'all_items'           	=> 'Alle FAQ Sections',
		),
		'exclude_from_search' => false,
	);


}
