<?php

/* Hooks based on ACF fields
/* ------------------------------------ */

/* Register the Google API key
/* ------------------------------------ */
add_action('acf/init', function() {
	acf_update_setting('google_api_key', GOOGLE_API_KEY);
});
add_filter('acf/fields/google_map/api', function( $api ){
	$api['key'] = GOOGLE_API_KEY;
	return $api;
});

/* Safe all ACF Pro in project repo
/* ------------------------------------ */
add_filter('acf/settings/save_json', function( $path ) {
	return get_stylesheet_directory() . '/studio/includes/acf-json';
});

/* Load all ACF Pro from project repo
/* ------------------------------------ */
add_filter('acf/settings/load_json', function( $paths ) {
	unset($paths[0]); // remove original path (optional)
	$paths[] = get_stylesheet_directory() . '/studio/includes/acf-json';
	return $paths;
});

/* Exclude current post/page & unpublished ones from relationship field results
/* ------------------------------------ */
add_filter('acf/fields/relationship/query', function( $args, $field, $post ) {
	$args['post__not_in'] = array( $post );
	$args['post_status']  = 'publish';
	return $args;
}, 10, 3);

/* First make sure Zendesk settings are provided
/* ------------------------------------ */
add_action('acf/save_post', function() {
	$screen = get_current_screen();
	if (strpos($screen->id, "studio-zendesk") == true) {
		$sDomain = get_field('zendesk_domain', 'options');
		$sLocale = get_field('zendesk_locale', 'options');

		if( !empty($sDomain) && !empty($sLocale) ) {

			// @todo: extra check on getting sections

			update_field( 'check_settings', 1, 'options' );
		}
	}
}, 20);


/* Dynamically fill the Zendesk Settings faqsections values
/* ------------------------------------ */
add_filter('acf/load_field/key=field_58db7a57c4ef8', function( $field ) {

	// reset choices
	$field['choices'] = array();

	// get the choices from the Zendesk
	$oZendeskSection = new Control_Zendesk_Section();
	$aSections = $oZendeskSection->GetAllSections();

	foreach( (array)$aSections as $key => $aSection) {
		# category_zendesk & category_name
		$choices[$key] = $aSection->name;
	}
	// sort array
	asort($choices);
	$field['choices'] = $choices;

	// return the field
	return $field;
});

/* Dynamically fill the faqsection metabox values
/* ------------------------------------ */
add_filter('acf/load_field/key=field_58db81fbe5018', function( $field ) {

	// reset choices
	$field['choices'] = array();

	// get the choices from the Zendesk options page
	$aZendesk = get_field('zendesk_sections', 'options');

	// loop sections to fill array for metabox
	foreach( (array)$aZendesk as $aSection ) {
		# category_zendesk & category_name
		$choices[$aSection['value']] = $aSection['label'];
	}
	// sort array
	asort($choices);
	$field['choices'] = $choices;

	// add instructions
	$field['instructions'] = __("Can't find your section? Check the <a href=\"/wp-admin/admin.php?page=studio-zendesk\">Zendesk Settings</a> if it has been assigned.", 'studio');

	// return the field
	return $field;
});
