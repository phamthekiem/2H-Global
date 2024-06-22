<?php
/**
 * Template Name: Trang chủ
 *
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package SH_Theme
 */

global $sh_option;
get_header(); ?>

	
    <div class="homepage-slider">
        <?php do_action( 'before_loop_main_content' ) ?>
    </div>

    <!-- Product Featured -->
    <div class="homepage-product-featured">
        <div class="heading">
            <?php echo $sh_option['list_product_featured_title'] ?>
        </div>
        <div class="list-featured">
            <?php 
                $numcol = $sh_option['number_product_featured_row'];
                $args = array(
                    'post_type' => 'product',
                    'post__in' => $sh_option['list_product_featured'],
                    'posts_per_page' => -1,
                );
                $the_query = new WP_Query( $args );
                if ( $the_query->have_posts() ) {

                    echo '<div class="sh-product-shortcode column-'. $numcol .'"><ul class="row list-products">';
        
                    while ( $the_query->have_posts() ) {

                        $the_query->the_post();
                        /**
                         * Hook: woocommerce_shop_loop.
                         *
                         * @hooked WC_Structured_Data::generate_product_data() - 10
                         */
                        do_action( 'woocommerce_shop_loop' );
        
                        wc_get_template_part( 'content', 'product' );
        
                    }
                    wp_reset_postdata();
                    echo '</ul></div>';
        
                }
            ?>
            <div class="text-center collection-shop-all ">
                <a href="/product">Shop All</a>
            </div>
        </div>
    </div>

    <!-- Product list -->
    <div class="home-latest-product">
        <?php
            if (class_exists('WooCommerce')) {
                if ($sh_option['list_cat_product']) {
                    $list_cat_product = $sh_option['list_cat_product'];
                    if ($sh_option['number_product']) {
                        $number_product = $sh_option['number_product'];
                    }
                    if ($sh_option['number_product_row']) {
                        $number_product_row = $sh_option['number_product_row'];
                    }
        
                    echo '<div class="row product-wrap">';
                        foreach ($list_cat_product as $key => $idpost) {
                            $args = array(
                                'type' => 'product',
                                'child_of' => $idpost,
                                'taxonomy' => 'product_cat',
                            );
                            $child_categories = get_categories($args);

                            $thumbnail_id = get_woocommerce_term_meta($idpost, 'thumbnail_id', true);
                            $i = 1;
                            $j = 1;
                            $k = 1;
                            echo '<div class="heading-sub-cat-product">';
                                echo '<div class="banner-cat">';
                                    echo '<img class="img-fluid" src="' . wp_get_attachment_url($thumbnail_id) . '">';
                                echo '</div>';

                                echo '<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">';
                                    foreach ($child_categories as $child_category) {
                                        echo '<li class="nav-item" role="presentation">';
                                            echo '<a 
                                                    class="nav-link' . (($i === 1) ? ' active' : '') . '" 
                                                    id="' . $child_category->term_id . '-tab" 
                                                    data-toggle="pill" 
                                                    href="#cate' . $child_category->term_id . '-pill" 
                                                    role="tab" 
                                                    aria-controls="' . $child_category->term_id . '-pill" 
                                                    aria-selected="true"
                                            >';
                                            echo $child_category->name;
                                            echo '</a>';
                                            //echo '<a class="child-category" href="' . get_term_link((int)$child_category->term_id, 'product_cat') . '">' . $child_category->name . '</a>';
                                        echo '</li>';
                                        $i++;
                                    }
                                echo '</ul>';
                                //echo '<a href="' . get_term_link((int)$idpost, 'product_cat') . '" class="font-weight-bold view-all-cate d-none d-lg-block">Xem tất cả</a>';
                            echo '</div>';

                            echo '<div class="list-items">';
                                echo '<div class="tab-content" id="pills-tabContent">';
                                    foreach ($child_categories as $child_category) {
                                        echo '<div class="tab-pane fade' . (($j === 1)?'show active' : '') . '" id="cate'. $child_category->term_id. '-pill" role="tabpanel" aria-labelledby="'. $child_category->term_id. '-tab">';
                                            echo '<div class="items-product">';
                                                echo do_shortcode('[shproduct posts_per_page="'. $number_product. '" categories="'. $child_category->term_id. '" numcol="'. $number_product_row. '"]');
                                            echo '</div>';
                                        echo '</div>';
                                        $j++;
                                    }
                                    //echo do_shortcode('[shproduct posts_per_page="' . $number_product . '" categories="' . $idpost . '" numcol="' . $number_product_row . '"]');
                                echo '</div>';

                                echo '<div class="text-center collection-shop-all ">';
                                    echo '<a href="'. get_term_link((int)$idpost, 'product_cat'). '">Shop All</a>';
                                echo '</div>';

                            echo '</div>';
                        }
                    echo '</div>';
                }
            }
        ?>
    </div>

<?php
get_footer();
