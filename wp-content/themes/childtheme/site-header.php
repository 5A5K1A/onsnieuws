<header class="site-header">
	<nav class="main navbar navbar-default">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<div class="navbar-brand">
				<a class="logo" href="<?php echo home_url(); ?>">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/dist/img/logo-vanons.png" alt="<?php _e('Logo van ', 'studio'); bloginfo('name'); ?>" />
				</a>
				<p title="<?php bloginfo('description'); ?>" class="description"><?php bloginfo('description'); ?></p>
			</div>
		</div>
		<div class="collapse navbar-collapse">
			<?php
				wp_nav_menu( array(
				    'menu'              => 'primary',
				    'theme_location'    => 'primary',
				    'depth'             => 2,
				    'container'         => '',
				    'container_class'   => '',
				    'menu_class'        => 'nav navbar-nav',
				    'fallback_cb'       => 'bootstrapnavwalker::fallback',
				    'walker'            => new Nav_BootstrapWalker())
				);
			?>
			<?php
				wp_nav_menu( array(
				    'menu'              => 'primary-right',
				    'theme_location'    => 'primary-right',
				    'depth'             => 2,
				    'container'         => '',
				    'container_class'   => '',
				    'menu_class'        => 'nav navbar-nav navbar-right',
				    'fallback_cb'       => 'bootstrapnavwalker::fallback',
				    'walker'            => new Nav_BootstrapWalker())
				);
			?>
		</div>
	</nav>
<?php
	$sImage      = NULL;
	$sImageSize  = 'header_image';
	$iImageID    = ( has_post_thumbnail() && is_single() ) ? get_post_thumbnail_id() : 6 ;
	$sImage      = wp_get_attachment_image( $iImageID, $sImageSize, '', array('itemprop' => 'image', 'class' => 'todo_frontend') );

	if( !empty($sImage) ) : ?>
	<div class="image">
		<?php echo $sImage; ?>
	</div>
<?php endif; ?>
</header>
