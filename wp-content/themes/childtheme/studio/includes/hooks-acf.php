<?php

/* Hooks based on ACF fields
/* ------------------------------------ */

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

/* Dynamically fill the metabox values
/* ------------------------------------ */
add_filter('acf/load_field/key=field_58db81fbe5018', function( $field ) {

	// reset choices
	$field['choices'] = array();

	// get the choices from the Zendesk options page
	$aZendesk = get_field('zendesk_faqsections', 'options');

	foreach($aZendesk as $key => $aSection) {
		# category_zendesk & category_name
		$choices[$key] = $aSection['category_name'];
	}
	asort($choices);
	$field['choices'] = $choices;

	// return the field
	return $field;

});

