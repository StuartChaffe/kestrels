<header class="site-header">
	<div class="site-header__inner container">
		<a class="site-header__logo" href="<?php echo home_url(); ?>" aria-label="Home">
			<img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.svg" alt="">
		</a>
		<button class="site-header__menu-btn hamburger" data-toggle="#mobile-menu" data-toggle-body-class="nav-open" aria-label="Toggle mobile menu" aria-expanded="false" aria-controls="mobile-menu">
			<span class="hamburger-box">
				<span class="hamburger-inner"></span>
			</span>
		</button>
		<nav class="site-header__nav">
			<?php wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_class'     => 'primary-nav',
				'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
				'walker'         => new BEM_Nav_Walker( 'primary-nav' ),
			) ); ?>
		</nav>
	</div>
</header>

<div class="mobile-menu" id="mobile-menu">
	<nav class="mobile-menu__nav">
		<?php wp_nav_menu( array(
			'theme_location' => 'primary',
			'container'      => false,
			'menu_class'     => 'mobile-nav',
			'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
			'walker'         => new BEM_Nav_Walker( 'mobile-nav' ),
		) ); ?>
	</nav>
</div>
