<?php

/* Constants
/* ------------------------------------ */

if( function_exists('get_field') ) {
	define( 'ZD_SUBDOMAIN', get_field('zendesk_domain', 'options') );
	define( 'ZD_LOCALE', get_field('zendesk_locale', 'options') );
}

define('THEME_SLUG', 'studio');
define('BEFORE_SALT', 'hreyw235j234'); // @todo move to wp-config
define('AFTER_SALT', 'kjh2UYRWUbnuh'); // @todo move to wp-config

