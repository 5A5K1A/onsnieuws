<?php

/* Hooks for extra security
/* ------------------------------------ */

/**
 * Filter the standard Wordpress admin error message
 * @return string $message		Error message to be translated
 */
add_filter( 'login_errors', function( $message ) {
	global $errors;

	if( isset($errors->errors['invalid_username']) || isset($errors->errors['incorrect_password']) ) {
		$message = __("<strong>ERROR</strong>: Er is iets mis!", 'studio').' '.sprintf(('<a title="%2$s" href="%1$s">%3$s</a>?'),
		site_url('wp-login.php?action=lostpassword', 'studio'),
		__('Password Lost and Found', 'studio'),
		__('Wachtwoord vergeten', 'studio'));
	}

	return $message;
});
