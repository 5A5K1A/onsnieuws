<!-- start :: footer -->
<footer class="site-footer">
	<?php
	   if(has_nav_menu('footer'))
	       wp_nav_menu( array('container' => 'nav',
	       'theme_location' => 'footer',
	       'menu_class' => 'menu-footer navbar-nav' )
	   );
	?>
</footer>
