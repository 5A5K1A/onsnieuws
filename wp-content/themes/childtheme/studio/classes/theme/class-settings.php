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

			acf_add_options_page(array(
				'page_title' 	=> __('Instellingen VinceManager ', THEME_SLUG),
				'menu_title'	=> __('VinceManager', THEME_SLUG),
				'menu_slug' 	=> 'studio-vincemanager',
				'capability'	=> 'edit_posts',
				'redirect'		=> false,
				'position'      => '57.7',
				'icon_url'      => 'dashicons-store',
			));

		}
		if( function_exists('acf_add_local_field_group') ) {

			acf_add_local_field_group(array (
				'key' => 'group_vincemanager_settings',
				'title' => 'VinceManager Settings',
				'fields' => array (
					array (
						'key' => 'key_vincemanager_username',
						'label' => 'Username',
						'name' => 'vincemanager_username',
						'type' => 'text',
						'required' => 1,
						'wrapper' => array (
							'width' => '45',
						),
					),
					array (
						'key' => 'key_vincemanager_password',
						'label' => 'Password',
						'name' => 'vincemanager_password',
						'type' => 'text',
						'required' => 1,
						'wrapper' => array (
							'width' => '45',
						),
					),
				),
				'location' => array (
					array (
						array (
							'param' => 'options_page',
							'operator' => '==',
							'value' => 'studio-vincemanager',
						),
					),
				),
				'style' => 'seamless',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'active' => 1,
			));

			acf_add_local_field_group(array (
				'key' => 'group_zendesk_settings',
				'title' => 'Zendesk Settings',
				'fields' => array (
					array (
						'key' => 'key_zendesk_domain',
						'label' => 'Zendesk domain',
						'name' => 'zendesk_domain',
						'type' => 'text',
						'required' => 1,
						'default_value' => 'snappet',
					),
					array (
						'key' => 'key_zendesk_locale',
						'label' => 'Zendesk locale',
						'name' => 'zendesk_locale',
						'type' => 'text',
						'required' => 1,
						'default_value' => 'nl',
					),
					array (
						'key' => 'key_zendesk_message',
						'type' => 'message',
						'message' => 'Klik eerst op bijwerken om de secties op te halen van Zendesk',
						'new_lines' => 'wpautop',
						'esc_html' => 0,
					),
					array (
						'key' => 'key_check_settings',
						'label' => 'Check settings (hiddem)',
						'name' => 'check_settings',
						'type' => 'true_false',
						'wrapper' => array (
							'class' => 'hidden',
						),
						'default_value' => 0,
						'ui' => 0,
						'ui_on_text' => '',
						'ui_off_text' => '',
					),
					array (
						'key' => 'key_zendesk_sections',
						'label' => 'Selecteer Zendesk sectie(s)',
						'name' => 'zendesk_sections',
						'type' => 'select',
						'conditional_logic' => array (
							array (
								array (
									'field' => 'key_check_settings',
									'operator' => '==',
									'value' => '1',
								),
							),
						),
						'allow_null' => 0,
						'multiple' => 1,
						'ui' => 1,
						'ajax' => 1,
						'return_format' => 'array',
					),
				),
				'location' => array (
					array (
						array (
							'param' => 'options_page',
							'operator' => '==',
							'value' => 'studio-zendesk',
						),
					),
				),
				'style' => 'seamless',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'active' => 1,
			));

		}
	}
}
