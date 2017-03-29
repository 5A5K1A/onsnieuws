<?php

/* Constants
/* ------------------------------------ */

if( function_exists('get_field') ) {
	define( 'ZD_SUBDOMAIN', get_field('zendesk_domain', 'options') );
	define( 'ZD_LOCALE', get_field('zendesk_locale', 'options') );
}
