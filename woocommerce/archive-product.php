<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

global $sh_option;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

?>
<header class="woocommerce-products-header">
	<?php if ( apply_filters( 'woocommerce_show_page_title', true ) && $sh_option['display-pagetitlebar'] == '0' ) : ?>
		<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
	<?php endif; ?>

	<?php
	/**
	 * Hook: woocommerce_archive_description.
	 *
	 * @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 */
	do_action( 'woocommerce_archive_description' );
	?>
</header>
<?php

// Check hierarchy in theme options
if( $sh_option['display-hierarchy-woocommerce'] == '1' && ! is_shop() && is_product_category() ) {
	// Content
	$archive_object = get_queried_object();
	$archive_id 	= $archive_object->term_id;
	$args = array(
		'parent'     	=> $archive_id,
		'hide_empty'  	=> 0,
		'taxonomy'    	=> $archive_object->taxonomy,
	);
	$categories = get_categories( $args );
	if( $categories ) {
		echo '<div class="list-categories">';
			echo '<div class="row">';
			/* Start the Loop */
			foreach ( $categories as $value ) {
				echo '<div class="col-md-3">';
					echo '<div class="list-categories__item">';
						echo '<a class="img" title="' . $value->name . '" href="' . get_term_link( $value->term_id, $archive_object->taxonomy ) . '">' . woocommerce_category_image( $value->term_id ) . '</a>';
				    	echo '<h2><a class="" title="' . $value->name . '" href="' . get_term_link( $value->term_id, $archive_object->taxonomy ) . '">' . $value->name . '</a></h2>';
					echo '</div>';
				echo '</div>';
			}
			echo '</div>';
		echo '</div>';
	}
}

if ( have_posts() ) {

    echo '<div class="row">';

        echo '<div class="col-md-3 col-12 d-none d-lg-block">';
            dynamic_sidebar( 'sidebar-shop' );
        echo '</div>';

        ?>

        <div class="col-md-9 col-12 mb-3 d-block d-lg-none">
            <div class="mobile-toggle-sidebar">
                <button class="btn btn-primary" type="button" id="toggleButton">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.820313 2.25641C0.820313 1.01023 1.83054 0 3.07672 0C4.3229 0 5.33313 1.01023 5.33313 2.25641C5.33313 3.50259 4.3229 4.51282 3.07672 4.51282C1.83054 4.51282 0.820313 3.50259 0.820313 2.25641ZM3.07672 1.23077C2.51028 1.23077 2.05108 1.68996 2.05108 2.25641C2.05108 2.82286 2.51028 3.28205 3.07672 3.28205C3.64317 3.28205 4.10236 2.82286 4.10236 2.25641C4.10236 1.68996 3.64317 1.23077 3.07672 1.23077ZM7.38442 2.25641C7.38442 1.91654 7.65993 1.64103 7.9998 1.64103L14.5639 1.64103C14.9038 1.64103 15.1793 1.91654 15.1793 2.25641C15.1793 2.59628 14.9038 2.8718 14.5639 2.8718L7.9998 2.87179C7.65993 2.87179 7.38442 2.59628 7.38442 2.25641ZM10.6665 8C10.6665 6.75382 11.6767 5.74359 12.9229 5.74359C14.1691 5.74359 15.1793 6.75382 15.1793 8C15.1793 9.24618 14.1691 10.2564 12.9229 10.2564C11.6767 10.2564 10.6665 9.24618 10.6665 8ZM12.9229 6.97436C12.3564 6.97436 11.8972 7.43355 11.8972 8C11.8972 8.56645 12.3564 9.02564 12.9229 9.02564C13.4893 9.02564 13.9485 8.56645 13.9485 8C13.9485 7.43355 13.4893 6.97436 12.9229 6.97436ZM0.820313 8C0.820313 7.66013 1.09583 7.38461 1.4357 7.38461L7.9998 7.38462C8.33967 7.38462 8.61518 7.66013 8.61518 8C8.61518 8.33987 8.33967 8.61539 7.9998 8.61539L1.4357 8.61538C1.09583 8.61538 0.820312 8.33987 0.820313 8ZM0.820313 13.7436C0.820313 12.4974 1.83054 11.4872 3.07672 11.4872C4.3229 11.4872 5.33313 12.4974 5.33313 13.7436C5.33313 14.9898 4.3229 16 3.07672 16C1.83054 16 0.820313 14.9898 0.820313 13.7436ZM3.07672 12.7179C2.51028 12.7179 2.05108 13.1771 2.05108 13.7436C2.05108 14.31 2.51028 14.7692 3.07672 14.7692C3.64317 14.7692 4.10236 14.31 4.10236 13.7436C4.10236 13.1771 3.64317 12.7179 3.07672 12.7179ZM7.38442 13.7436C7.38442 13.4037 7.65993 13.1282 7.9998 13.1282H14.5639C14.9038 13.1282 15.1793 13.4037 15.1793 13.7436C15.1793 14.0835 14.9038 14.359 14.5639 14.359H7.9998C7.65993 14.359 7.38442 14.0835 7.38442 13.7436Z" fill="#0D0C22"></path>
                    </svg>
                    <span>Filters</span>
                </button>

                <div class="toggle-backdrop" id="toggleBackdrop"></div>
                <div class="toggle-content" id="toggleContent">
                    <div class="card card-body">
    <!--                    <button class="btn close-sidebar" type="button" id="closeButton">-->
    <!--                        <i class="fas fa-angle-left"></i>-->
    <!--                    </button>-->
                        <div class="sidebar-content">
                            <?php dynamic_sidebar( 'sidebar-shop' ); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php

        echo '<div class="col-md-9 col-12">';
            echo '<div class="d-flex align-items-center switcher-wrap">';
            /**
             * Hook: woocommerce_before_shop_loop.
             *
             * @hooked wc_print_notices - 10
             * @hooked woocommerce_result_count - 20
             * @hooked woocommerce_catalog_ordering - 30
             */
            do_action( 'woocommerce_before_shop_loop' );
            echo '</div>';

            woocommerce_product_loop_start();

            if ( wc_get_loop_prop( 'total' ) ) {

                while ( have_posts() ) {
                    the_post();

                    /**
                     * Hook: woocommerce_shop_loop.
                     *
                     * @hooked WC_Structured_Data::generate_product_data() - 10
                     */
                    do_action( 'woocommerce_shop_loop' );

                    wc_get_template_part( 'content', 'product' );
                }
            }

            woocommerce_product_loop_end();

            /**
             * Hook: woocommerce_after_shop_loop.
             *
             * @hooked woocommerce_pagination - 10
             */
            do_action( 'woocommerce_after_shop_loop' );
        echo '</div>';

    echo '</div>';

} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
//do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
//do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );
