<?php
/**
 * @package WordPress
 * @subpackage ChildTheme
 */
get_header();

get_template_part( 'content', (get_post_format()) ? get_post_format() : get_post_type()  );

get_footer();
