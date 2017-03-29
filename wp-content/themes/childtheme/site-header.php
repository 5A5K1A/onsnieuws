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
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/dist/svg/logo-vanons.svg" alt="<?php bloginfo('name'); ?>" />
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
</header>
