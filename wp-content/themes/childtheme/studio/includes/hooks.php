<?php

/* Hooks
/* ------------------------------------ */

/* Customize the search form
/* ------------------------------------ */
add_filter( 'get_search_form', function( $form ) {
	$sSearchHolder = __('Wat zoek je?', THEME_SLUG);
	return <<<EOHTML
		<form method="get" class="searchform" action="/">
			<div class="input-group">
				<input name="s" type="search" class="form-control" placeholder="{$sSearchHolder}">
				<span class="input-group-btn">
					<button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-search"></span></button>
				</span>
			</div>
		</form>
EOHTML;
});

function GetFaqSearchForm( $searchterm = NULL ) {
	$placeholder = __('FAQ doorzoeken', THEME_SLUG);
	if( $searchterm ) { $placeholder .= '" value="'.$searchterm; }
	return <<<EOHTML
		<form method="get" class="searchform" action="">
			<div class="input-group">
				<input name="search" type="search" class="form-control" placeholder="{$placeholder}">
				<span class="input-group-btn">
					<button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-search"></span></button>
				</span>
			</div>
		</form>
EOHTML;
};

/*  Add responsive container to embeds
/* ------------------------------------ */
function studio_embed_html( $html, $url, $attr ) {

	// ugly version load oembed class
	require_once('wp-includes/class-oembed.php');

	// slow process to check data type
	$oEmbed   = new WP_oEmbed();
	$provider = $oEmbed->get_provider( $url, $args );
	$data     = $oEmbed->fetch( $provider, $url, $args );

	// if type is video
	if( $data->type == 'video' ) {

		// check if class already exists
		if( strpos($html, 'class="') ) {
			// add class
			$html = str_replace( 'class="', 'class="embed-responsive-item ', $html );
		} else {
			// dirty string replace to add class
			$html = str_replace( '<iframe', '<iframe class="embed-responsive-item"', $html );
		}

		return <<<EOHTML
	<div class="embed-responsive embed-responsive-16by9">
		{$html}
	</div>

EOHTML;
	}

	return $html;

}

add_filter( 'embed_oembed_html', 'studio_embed_html', 10, 3 );
add_filter( 'video_embed_html', 'studio_embed_html', 10, 3 );

/* Move Yoast to bottom
/* ------------------------------------ */
add_filter( 'wpseo_metabox_prio', function() {
	return 'low';
});

/*  Modify TinyMCE
/* ------------------------------------ */
add_filter( 'tiny_mce_before_init', function( $toolbars ) {

	# customize the buttons
	// $toolbars['toolbar1'] = 'bold,italic,underline,bullist,numlist,hr,blockquote,link,unlink,justifyleft,justifycenter,justifyright,justifyfull,outdent,indent';
	// $toolbars['toolbar2'] = 'formatselect,pastetext,pasteword,charmap,undo,redo';

	# Keep the "kitchen sink" open:
	$toolbars[ 'wordpress_adv_hidden' ] = FALSE;

	return $toolbars;
});

/* Add in a core button that's disabled by default
/* ------------------------------------ */
add_filter( 'mce_buttons_2', function( $buttons ) {
	// Add in a core button that's disabled by default
	$buttons[] = 'styleselect';
	return $buttons;
});

/* Callback function to filter the MCE settings
/* ------------------------------------ */
add_filter( 'tiny_mce_before_init', function( $toolbars ) {

	// Define the style_formats array
	$style_formats = array(
		// Each array child is a format with it's own settings
		array(
			'title' => 'Default button',
			'block' => 'span',
			'classes' => 'btn btn-default',
			'wrapper' => false,
		),
		array(
			'title' => 'Primary button',
			'block' => 'span',
			'classes' => 'btn btn-primary',
			'wrapper' => false,
		),
		array(
			'title' => 'Info button',
			'block' => 'span',
			'classes' => 'btn btn-info',
			'wrapper' => false,
		),
		array(
			'title' => 'Success button',
			'block' => 'span',
			'classes' => 'btn btn-success',
			'wrapper' => false,
		),
		array(
			'title' => 'Warning button',
			'block' => 'span',
			'classes' => 'btn btn-warning',
			'wrapper' => false,
		),
		array(
			'title' => 'Danger button',
			'block' => 'span',
			'classes' => 'btn btn-danger',
			'wrapper' => false,
		),
	);
	// Insert the array, JSON ENCODED, into 'style_formats'
	$toolbars['style_formats'] = json_encode( $style_formats );
	return $toolbars;
});

/* replaces [...] with ... in excerpt
/* ------------------------------------ */
add_filter( 'excerpt_more', function( $more ) {
	return '...';
});

/*
	Gravity Forms Bootstrap Styles

	Applies bootstrap classes to various common field types.
	* Requires Bootstrap to be in use by the theme.

	Using this function allows use of Gravity Forms default CSS
	* in conjuction with Bootstrap (benefit for fields types such as Address).

	@see  gform_field_content
	* @link http://www.gravityhelp.com/documentation/page/Gform_field_content

	@return string Modified field content
*/
add_filter( 'gform_field_content', function( $content, $field, $value, $lead_id, $form_id ) {

	// Currently only applies to most common field types, but could be expanded.
	if($field["type"] != 'hidden' && $field["type"] != 'list' && $field["type"] != 'multiselect' && $field["type"] != 'checkbox' && $field["type"] != 'fileupload' && $field["type"] != 'date' && $field["type"] != 'html' && $field["type"] != 'address') {
		$content = str_replace('class=\'medium', 'class=\'form-control medium', $content);
	}
	if($field["type"] == 'name' || $field["type"] == 'address') {
		$content = str_replace('<input ', '<input class=\'form-control\' ', $content);
	}
	if($field["type"] == 'textarea') {
		$content = str_replace('class=\'textarea', 'class=\'form-control textarea', $content);
	}
	if($field["type"] == 'checkbox') {
		$content = str_replace('li class=\'', 'li class=\'checkbox ', $content);
		$content = str_replace('<input ', '<input style=\'margin-left:1px;\' ', $content);
	}
	if($field["type"] == 'radio') {
		$content = str_replace('li class=\'', 'li class=\'radio ', $content);
		$content = str_replace('<input ', '<input style=\'margin-left:1px;\' ', $content);
	}
	if($field["type"] == 'date') {
		$content = str_replace('select', 'select class="form-control" ', $content);
	}
	return $content;
}, 10, 5);

add_filter( 'gform_submit_button', function( $button, $form ) {
	return "<button class='button btn btn-default' id='gform_submit_button_{$form["id"]}'><span>{$form['button']['text']}</span></button>";
}, 10, 2);

/* Add css class to form
/* ------------------------------------ */
add_filter( 'gform_form_tag', function( $form_tag, $form ) {
	$cssClass = 'class="gform_form gform_form_' . $form['fields'][0]['formId'] . '"';
	$form_tag = str_replace('id=', $cssClass . ' id=', $form_tag );
	return $form_tag;
}, 10, 2 );

/* Nice logo for admin login
/* ------------------------------------ */
add_filter( 'login_headerurl', function() { ?>
 	<style>
 	#login h1 a {
 		background: none;
 	}
 	#login form {
 		background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/src/images/placeholder.gif');
 		background-repeat: no-repeat;
 		background-size: 85%;
 		background-position: center 30px;
 		padding-top: 230px;
 	}
 	</style>
<?php
});

/* Change the admin footer #sluikreclame
/* ------------------------------------ */
add_filter( 'admin_footer_text', function() {
	echo '<span id="footer-thankyou">'.__('This website is developed by', THEME_SLUG).' <a href="https://www.5a2.nl/" target="_blank">studio 5A2</a> </span>';
});

/* Extra filter for the_title breakingpoints
/* ------------------------------------ */
add_filter( 'the_title', function( $title ) {
	return str_replace('||', '&shy;', $title);
});

/* Rename WP standard 'Berichten' to 'Nieuws'
/* ------------------------------------ */
add_action( 'admin_menu', function() {
	global $menu;
	global $submenu;
	$menu[5][0] = 'Nieuws';
	$submenu['edit.php'][5][0] 	= __('Nieuws', THEME_SLUG);
	$submenu['edit.php'][10][0] = __('Nieuws toevoegen', THEME_SLUG);
	$submenu['edit.php'][16][0] = __('Nieuws Tags', THEME_SLUG);
});
add_action( 'init', function() {
	global $wp_post_types;
	$labels = &$wp_post_types['post']->labels;
	$labels->name 			= __('Nieuws', THEME_SLUG);
	$labels->singular_name 	= __('Nieuws', THEME_SLUG);
	$labels->all_items 		= __('Alle nieuws', THEME_SLUG);
	$labels->add_new 		= __('Nieuws toevoegen', THEME_SLUG);
	$labels->add_new_item 	= __('Nieuws toevoegen', THEME_SLUG);
	$labels->edit_item 		= __('Bewerk nieuws', THEME_SLUG);
	$labels->new_item 		= __('Nieuws', THEME_SLUG);
	$labels->view_item 		= __('Bekijk Nieuws', THEME_SLUG);
	$labels->search_items 	= __('Zoek nieuws', THEME_SLUG);
	$labels->not_found 		= __('Geen nieuws gevonden', THEME_SLUG);
	$labels->not_found_in_trash = __('Geen nieuws gevonden gevonden in de prullenbak', THEME_SLUG);
	$labels->all_items 		= __('Alle nieuws', THEME_SLUG);
	$labels->menu_name 		= __('Nieuws', THEME_SLUG);
	$labels->name_admin_bar = __('Nieuws', THEME_SLUG);
});

/* Hide certain admin sections for "simple users"
/* ------------------------------------ */
add_action('wp_dashboard_setup', function() {
	if( current_user_can('editor') ) {
		remove_meta_box('dashboard_quick_press', 'dashboard', 'side'); 			// Quick Press widget
		remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side'); 		// Recent Drafts
		remove_meta_box('dashboard_primary', 'dashboard', 'side'); 				// WordPress.com Blog
		// remove_meta_box('dashboard_secondary', 'dashboard', 'side'); 		// Other WordPress News
		// remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal'); 	// Incoming Links
		// remove_meta_box('dashboard_plugins', 'dashboard', 'normal'); 		// Plugins
		// remove_meta_box('dashboard_right_now', 'dashboard', 'normal'); 		// Right Now
		// remove_meta_box('rg_forms_dashboard', 'dashboard', 'normal'); 		// Gravity Forms
		remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal'); 	// Recent Comments
		// remove_meta_box('icl_dashboard_widget', 'dashboard', 'normal'); 		// Multi Language Plugin
		remove_meta_box('dashboard_activity', 'dashboard', 'normal'); 			// Activity
		remove_action('welcome_panel', 'wp_welcome_panel');
	}
});

/* Convert absolute URLs in content to site relative ones
/* Inspired by http://thisismyurl.com/6166/replace-wordpress-static-urls-dynamic-urls/
/* ------------------------------------ */
add_filter( 'content_save_pre', function( $content ) {

	$sSiteURL = get_bloginfo('url');
	$sNewContent = str_replace(' src=\"'.$sSiteURL, ' src=\"', $content );
	$sFilteredContent = str_replace(' href=\"'.$sSiteURL, ' href=\"', $sNewContent );

	return $sFilteredContent;
},'99');

