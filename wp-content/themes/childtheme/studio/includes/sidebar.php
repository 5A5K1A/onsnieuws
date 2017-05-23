<?php

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'id'            => 'sidebar',
		'name'          => __('Sidebar', THEME_SLUG),
		'description'   => '',
		'class'         => '',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h2 class="title">',
		'after_title'   => '</h2>',
	));
}
