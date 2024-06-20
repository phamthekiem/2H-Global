<?php
/**
 * Template for Logo Header
 *
 * @package SH_Theme
 */

global $sh_option;
?>
<div class="header-main">
	<div class="container">
		<div class="site-branding">
			<?php
			if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
			endif;
			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?>
		</div><!-- .site-branding -->

		<div class="header-content">
			<a id="showmenu" class="d-lg-none">
				<span class="hamburger hamburger--collapse">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</span>
			</a>
			<div class="row align-items-center">
				<div class="col-xl-2 col-lg-2">
					<div class="logo">
						<?php display_logo();?>
					</div>
				</div>
				<div class="col-xl-1"></div>
				<div class="col-xl-9 col-lg-10">
					<div class="row justify-content-between align-items-center">
						<div class="col-5">
							<div class="p-4 my-border rounded-pill d-flex justify-content-between">
								<input class="w-75" type="search" placeholder="Search">
								<button class="w-20 border-0 bg-white"><i class="fa-solid fa-magnifying-glass"></i></button>
							</div>
						</div>

						<div class="col-5">
							
						</div>
					</div>
					<?php do_action( 'sh_after_menu' );?>
				</div>
			</div>
		</div>

	</div>
</div>
<?php if ( has_nav_menu( 'menu-1' ) ) { ?>
	<nav id="site-navigation" class="main-navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
		<div class="container">
			<?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu', 'menu_class' => 'menu clearfix' ) ); ?>
		</div>
	</nav>
<?php } // end check menu ?>