<?php

/**
 * Register post types and taxonomies
 */
add_action( 'after_setup_theme', function() {

	// register theme settings
	// Theme_Settings::Register();

	// register all models
	//	Marker::Register();

	// register all taxonomies
	//	Taxonomy_Year::Register();

	// Setup Footer Widget columns in: snippet-footer-widgets.php
	//	Sidebar_Footer::Register();

	// add css for editor
	add_editor_style( 'dist/css/app.css' );

}, 15 );

/**
 * Enqueue styles and scripts
 */
add_action( 'wp_enqueue_scripts', function() {

	## Enqueue styles ##
	wp_enqueue_style( 'app', get_stylesheet_directory_uri() . '/dist/css/app.min.css', '', '', 'screen' ); // main style
	// wp_enqueue_style( 'print', get_stylesheet_directory_uri() . '/dist/css/print.min.css', '', '', 'print' ); // print style

	## Enqueue scripts ##
	// wp_enqueue_script( 'jquery'); // jQuery, in head
	// wp_enqueue_script( 'vendor', get_stylesheet_directory_uri() . '/dist/js/vendor.min.js', array( 'jquery' ), '' ); // vendor scripts, in head
	// wp_enqueue_script( 'app', get_stylesheet_directory_uri() . '/dist/js/app.min.js', array( 'vendor' ), '', $in_footer = true ); // app scripts, in footer
});
