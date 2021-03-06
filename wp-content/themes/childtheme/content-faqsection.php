<?php $sSearchString = getValue('search'); ?>

<main class="articles container">

	<?php if (have_posts()) : ?>

	<header>
		<h1><?php _e('FAQ Search: ', THEME_SLUG); ?></h1>
		<p><?php echo GetFaqSearchForm( $sSearchString ); ?></p>
	</header>

	<?php if( !empty($sSearchString) ) :
		$oSearch   = new Control_Zendesk_Search();
		$oResponse = $oSearch->GetSearchResults($sSearchString);

		if( $oResponse->error != TRUE ) :
			foreach( (array)$oResponse->results as $key => $oResult ) :
				Template::Render( 'snippet-article', array('oArticle' => $oResult, 'sSectionId' => 'search') );
			endforeach;
		endif;

		else :
			while (have_posts()) : the_post(); ?>

		<?php $aSections = get_field('show_section'); ?>

		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">

		<?php if( is_single() ) : ?>
			<header>
				<h1><?php the_title(); ?></h1>
			</header>
			<div class="entry">
				<?php the_content(); ?>
			</div>

		<?php foreach( (array)$aSections as $key => $aSection ) : ?>
			<div class="section-<?php echo $key; ?>">
			<?php Template::Render( 'snippet-section', array('aSection' => $aSection) ); ?>
			</div>
		<?php endforeach; ?>


		<?php else : ?>
			<header>
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			</header>
			<div class="entry">
				<?php the_excerpt(); ?>
			</div>
		<?php endif; ?>

		</article>

	<?php endwhile;
	endif; ?>

	<?php else : get_template_part('snippet', 'not-found'); endif; ?>
</main>
