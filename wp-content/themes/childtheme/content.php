<main class="articles">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<header><?php if( is_single() ) : ?>
				<h1><?php the_title(); ?></h1>
				<?php else : ?>

				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<?php endif; ?>
				<p class="info data"><time datetime="<?php the_time('Y-m-d H:i:s') ?>"><?php the_time( get_option( 'date_format' ) ); ?> <?php the_time() ?></time> door <span class="author"><?php the_author() ?></span></p>
			</header>
			<div class="entry">
				<?php the_content('Read the rest of this entry &raquo;'); ?>
			</div>
			<p class="meta data"><?php the_tags('Tags: ', ', ', '<br />'); ?> <?php _e('Posted in', 'studio'); ?> <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>
		</article>

	<?php endwhile; ?>

	<?php get_template_part('snippet', 'prev-next'); ?>

	<?php if ( comments_open() ) comments_template(); ?>

	<?php else : get_template_part('snippet', 'not-found'); endif; ?>

</main>
