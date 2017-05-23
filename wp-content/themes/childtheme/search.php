<?php
/**
 * @package WordPress
 * @subpackage ChildTheme
 */

get_header(); ?>

	<section id="content" class="narrowcolumn" role="main">

	<?php if (have_posts()) :
		$sNewerEntries = __('Newer Entries', THEME_SLUG);
		$sOlderEntries = __('Older Entries', THEME_SLUG);
	?>

		<h2 class="pagetitle"><?php _e('Search Results', THEME_SLUG); ?></h2>

		<nav class="navigation" role="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; '.$sOlderEntries) ?></div>
			<div class="alignright"><?php previous_posts_link($sNewerEntries.' &raquo;') ?></div>
		</nav>

		<?php while (have_posts()) : the_post(); ?>

			<article <?php post_class() ?>>
				<h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
				<small><?php the_time('l, F jS, Y') ?></small>

				<p class="postmetadata"><?php the_tags('Tags: ', ', ', '<br />'); ?> <?php _e('Posted in', THEME_SLUG); ?> <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>
			</article>

		<?php endwhile; ?>

		<nav class="navigation" role="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; '.$sOlderEntries) ?></div>
			<div class="alignright"><?php previous_posts_link($sNewerEntries.' &raquo;') ?></div>
		</nav>

	<?php else : ?>

		<h2 class="center"><?php _e('No posts found. Try a different search?', THEME_SLUG); ?></h2>
		<?php get_search_form(); ?>

	<?php endif; ?>

	</section>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
