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
                                <form action="<?php bloginfo('url'); ?>/" method="GET" role="form">
                                    <input type="hidden" name="post_type" value="product">
                                    <input type="text" class="form-control" id="name" name="s" placeholder="Search...">
                                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </form>
							</div>
						</div>

						<div class="col-5">
                            <div class="wishlist-page">
                                <a href="/wishlist" title="<?php _e('View wishlish', 'woocommerce');?>">
                                    <svg width="24" height="24" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M33.6 7.68332C31.8305 5.91333 29.4845 4.8372 26.9887 4.65062C24.4929 4.46404 22.013 5.17942 20 6.66665C17.8794 5.08938 15.24 4.37417 12.6132 4.66505C9.98643 4.95592 7.56741 6.23128 5.8433 8.23429C4.11919 10.2373 3.21805 12.8192 3.32135 15.46C3.42464 18.1008 4.52471 20.6044 6.40001 22.4667L18.8167 34.8833C18.9716 35.0395 19.156 35.1635 19.3591 35.2481C19.5621 35.3328 19.78 35.3763 20 35.3763C20.22 35.3763 20.4379 35.3328 20.641 35.2481C20.8441 35.1635 21.0284 35.0395 21.1833 34.8833L33.6 22.4667C34.5711 21.4962 35.3415 20.3439 35.867 19.0756C36.3926 17.8073 36.6631 16.4479 36.6631 15.075C36.6631 13.7021 36.3926 12.3427 35.867 11.0744C35.3415 9.80608 34.5711 8.65378 33.6 7.68332V7.68332ZM31.25 20.1167L20 31.35L8.75001 20.1167C7.75864 19.1211 7.0833 17.8551 6.80873 16.4772C6.53415 15.0994 6.67256 13.6711 7.2066 12.3716C7.74063 11.0722 8.64651 9.95931 9.81059 9.17269C10.9747 8.38607 12.3451 7.96072 13.75 7.94998C15.6269 7.95458 17.4252 8.70388 18.75 10.0333C18.905 10.1895 19.0893 10.3135 19.2924 10.3981C19.4955 10.4828 19.7133 10.5263 19.9333 10.5263C20.1534 10.5263 20.3712 10.4828 20.5743 10.3981C20.7774 10.3135 20.9617 10.1895 21.1167 10.0333C22.4806 8.85146 24.2425 8.23189 26.0459 8.30003C27.8493 8.36816 29.5595 9.1189 30.8303 10.4003C32.1011 11.6817 32.8377 13.398 32.8908 15.202C32.944 17.0059 32.3098 18.7626 31.1167 20.1167H31.25Z" fill="#F16523"></path>
                                    </svg>
                                    <span class="hidden-xs">Wishlist</span>
                                </a>
                            </div>
                            <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]');
                                do_action( 'sh_after_menu' );
                            ?>
						</div>
					</div>
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