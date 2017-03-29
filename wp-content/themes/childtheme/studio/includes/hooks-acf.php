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
