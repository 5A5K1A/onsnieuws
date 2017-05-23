<?php

class Theme_Settings {

	public static function Register() {

		// setup theme settings
		if( function_exists('acf_add_options_page') ) {

			acf_add_options_page(array(
				'page_title' 	=> __('Instellingen Zendesk ', THEME_SLUG),
				'menu_title'	=> __('Zendesk', THEME_SLUG),
				'menu_slug' 	=> 'studio-zendesk',
				'capability'	=> 'edit_posts',
				'redirect'		=> false,
				'position'      => '57.5',
				'icon_url'      => 'dashicons-forms',
			));

		}
	}
}
