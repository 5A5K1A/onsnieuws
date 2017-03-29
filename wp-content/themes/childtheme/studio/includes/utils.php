<?php

/* Useful utils
/* ------------------------------------ */

/**
 * Strips url from obsolete stuff, for prettier display
 * @param      string  $url    The url
 * @return     string  The cleaned up & pretty url for displaying
 */
function studio_strip_url( $url ) {
	return rtrim( str_replace(array( 'https://', 'http://', 'www.' ), '', $url), '/' );
}

/**
 * Handy util to get string between string-parts
 * @param      string  $string  The string
 * @param      string  $from    The from
 * @param      string  $to      The to
 * @return     string  The part between $to & $from
 */
function studio_get_string_between( $string, $from, $to ) {
	$substring = substr($string, strpos( $string, $from ) + strlen( $from ), strlen( $string ));
	return substr($substring, 0, strpos( $substring, $to ));
}

/**
 * Adds an extra class on content p's
 * @param      string  $sContent  The content
 * @param      string  $sClass    The class
 * @return     string  Pretty content with added class
 */
function studio_add_content_class( $sContent, $sClass = NULL ) {

	$sPrettyContent = apply_filters( 'the_content', $sContent );
	return str_replace( '<p>', '<p class="'.$sClass.'">', $sPrettyContent );
}

/**
 * Creates a link with attributes (if provided) => no more dirty HTML in php
 * @param      string  $url    The url (can be post id too)
 * @param      string  $text   The text
 * @param      array   $attr   The attribute
 * @return     string  The compiled <a href...>
 */
function studio_get_link( $url, $text, $attr = NULL ) {
	// early exit on no values
	if( empty($url) || empty($text) || $url == 'mailto:' || $url == 'tel:' ) { return; }

	// check if url is just a post id
	if( is_int($url) ) {
		$post_id = $url;
		$url     = get_the_permalink( $post_id );
		// early exit
		if( empty($url) ) { return; }
	}

	// setup start of a href
	$html = '<a href="'.str_replace( ' ', '', $url ).'"';

	// add attributes
	foreach( $attr as $name => $value ) { $html .= ' '.$name.'="'.$value.'"'; }

	// finish off the link
	$html .= '>'.$text.'</a>';

	// and return
	return $html;
}
function studio_link( $url, $text, $attr = NULL ) {
	echo studio_get_link( $url, $text, $attr = NULL );
}
