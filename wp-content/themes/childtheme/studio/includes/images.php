<?php

/* Hooks for images
/* ------------------------------------ */

// setup  image sizes: $name, $width, $height, $crop
if( function_exists('add_image_size') ) {
	// setup image sizes: $name, $width, $height, $crop
	// add_image_size( 'header_image', 500, 300, true );
	add_image_size( 'header_image', 1500, 300, true );
	add_image_size( 'new_image', 400, 500, true );
}

// editor images: https://premium.wpmudev.org/blog/adding-custom-images-sizes-to-the-wordpress-media-library/
add_filter('image_size_names_choose', function( $aSizes ) {
	$aAddSizes = array(
		'header_image' => __( 'Header image', 'studio' ),
		'new_image' => __( 'New image', 'studio' ),
	);
	$aNewSizes = array_merge( $aSizes, $aAddSizes );
	return $aNewSizes;
});
