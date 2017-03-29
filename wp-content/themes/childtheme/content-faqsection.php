<main class="articles">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<?php $aSections = get_field('show_section'); ?>

		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<header>
				<h1><?php the_title(); ?></h1>xxx
			</header>
			<div class="entry">
				<?php the_content(); ?>
			</div>
		</article>

	<?php endwhile; ?>

	<?php else : get_template_part('snippet', 'not-found'); endif; ?>
</main>
