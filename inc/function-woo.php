<?php
/**
 * Include function woocommerce
 */
require get_template_directory() . '/inc/functions-woocommerce/customizer-cart/customizer-cart-main.php';
require get_template_directory() . '/inc/functions-woocommerce/gallery-product/gallery-main.php';
require get_template_directory() . '/inc/functions-woocommerce/tooltip-product.php';
require get_template_directory() . '/inc/functions-woocommerce/swap-image-product.php';
require get_template_directory() . '/inc/functions-woocommerce/woocommerce-grid-list-toggle.php';

/**
 * Register Shop Widget Area
 */
function shtheme_add_sidebar_shop() {
	register_sidebar( array(
		'name'          => esc_html__( 'Shop Sidebar', 'shtheme' ),
		'id'            => 'sidebar-shop',
		'description'   => esc_html__( 'Add widgets here.', 'shtheme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'shtheme_add_sidebar_shop' );

/**
 * Add Support Woocommrce
 */
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'woocommerce_support' );

/**
 * Setup Layout Page Woocommerce
 */
//remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
//remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

function my_theme_wrapper_start() {
	echo '<div class="content-sidebar-wrap">';
	do_action( 'before_main_content' );
	echo '<main id="main" class="site-main" role="main">';
	do_action( 'before_loop_main_content' );
}

function my_theme_wrapper_end() {
	global $sh_option;
	$layout = $sh_option['opt-layout'];
	echo '</main>';
	if( $layout != '1' ) {
		echo '<aside class="sidebar sidebar-primary sidebar-shop" itemscope itemtype="https://schema.org/WPSideBar">';
			if( $sh_option['display-shopsidebar'] == 1 ) {
				dynamic_sidebar( 'sidebar-shop' );
			}
		echo '</aside>';
	}
	echo '</div>';
}

add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

/**
 * Set user role when create account woocommerce
 */
function set_user_role_woocommerce($args) {
	$args['role'] = 'subscriber';
	return $args;
}
add_filter('woocommerce_new_customer_data', 'set_user_role_woocommerce', 10, 1);

/**
 * Show image category product
 */
function woocommerce_category_image($products) {
    $thumbnail_id = get_woocommerce_term_meta( $products, 'thumbnail_id', true );
    $arr = wp_get_attachment_image_src( $thumbnail_id, 'full' );
    $image = $arr[0];
    if ( $image ) {
	    return '<img src="' . $image . '" alt="" />';
	} else {
		return '<img src="'. get_stylesheet_directory_uri() .'/lib/images/img-not-available.jpg" alt="">';
	}
}

/**
 * Edit number product show per page in category product
 */
function woocommerce_edit_loop_shop_per_page( $cols ) {
	global $sh_option;
	if ( $sh_option['number-products-cate'] ) {
		$cols = $sh_option['number-products-cate'];
	} else {
		$cols = get_option( 'posts_per_page' );
	}
	return $cols;
}
add_filter( 'loop_shop_per_page', 'woocommerce_edit_loop_shop_per_page', 20 );

/**
 * Add percent sale in content product template
 */
function add_percent_sale(){
	global $product;
	$regular_price 	= get_post_meta( get_the_ID(), '_regular_price', true);
	$sale_price 	= get_post_meta( get_the_ID(), '_sale_price', true);
	if ( $product->is_on_sale() && $product->is_type( 'simple' ) ) {
		$per = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
		echo '<span class="percent">-'. $per .'%</span>';
	}
}
add_action( 'woocommerce_after_shop_loop_item','add_percent_sale',15 );

/**
 * Add button continue shopping
 */
function wtb_continue_shopping_button() {
	$shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
	echo '<div class="continue_shopping">';
	echo ' <a href="'. $shop_page_url .'" class="button">'. __('Continue Shopping','shtheme') .' →</a>';
	echo '</div>';
}
add_action( 'woocommerce_after_cart_totals', 'wtb_continue_shopping_button' );

/**
 * Overwrite field checkout
 */
function custom_override_checkout_fields( $fields ) {
    unset($fields['billing']['billing_company']);
    unset($fields['billing']['billing_country']);
    unset($fields['billing']['billing_postcode']);

    return $fields;
}
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );


/**
 * Return class layout product
 */
function get_column_product($numcol) {
	global $sh_option;
	switch ($numcol) {
	    case '1':
	        $post_class = 'col-md-12';
	        break;
	    case '2':
	        $post_class = 'col-6';
	        break;
	    case '3':
	        $post_class = 'col-md-4 col-sm-6 col-6';
	        break;
	    case '4':
	        $post_class = 'col-md-3 col-sm-4 col-6';
	        break;
	    case '5':
	        $post_class = 'col-lg-15 col-md-3 col-sm-4 col-6';
	        break;
	    case '6':
	        $post_class = 'col-lg-2 col-md-3 col-sm-4 col-6';
	        break;
	}
	return $post_class;
}

/**
 * Tab Woocommerce
 */
function woo_remove_product_tabs( $tabs ) {
	// unset( $tabs['description'] );
    // unset( $tabs['reviews'] );
    unset( $tabs['additional_information'] );
    return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

function woo_shipping_returns_tabs( $tabs ) {
	$tabs['shipping_returns']['title'] 	= __( 'Shipping & Returns', 'shtheme' );

	$tabs['shipping_returns']['priority']		= 20;

	$tabs['shipping_returns']['callback']		= 'content_tab_shipping_returns';
	return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'woo_shipping_returns_tabs', 98 );

function content_tab_shipping_returns() {
    global $sh_option;
    $shipping_returns 	= $sh_option['shipping-returns'];
    if( $shipping_returns ) {
        $args = array(
            'post_status' => 'publish',
            'post_type' => 'page',
            'p' => $shipping_returns,
        );
        $posts = get_posts($args);
        if (!empty($posts)) {
            echo apply_filters('the_content', $posts[0]->post_content);
        }
    } else {
        _e('Content is updating...','shtheme');
    }

}

/**
 * Customizer number product related
 */
function custom_numberpro_related_products_args( $args ) {
	global $sh_option;
	$numpro_related = $sh_option['number-product-related'];
	$args['posts_per_page'] = $numpro_related; // number related products
	// $args['columns'] 	= 2; // arranged in number columns
	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'custom_numberpro_related_products_args' );

/**
 * Add Button Quick Buy Simple Product In Single Product
 */
function insert_btn_quick_buy(){
	global $post, $product;
	if ( $product->is_type( 'simple' ) ) {
		?>
		<a class="button buy_now ml-2" href="?quick_buy=1&add-to-cart=<?php echo $post->ID?>" class="qn_btn"><?php _e('Quick buy','shtheme'); ?></a>
		<?php
	}
}
add_action( 'woocommerce_after_add_to_cart_button','insert_btn_quick_buy',1 );

/**
 * Redirect To Checkout Page After Click Button Quick Buy
 */
function redirect_to_checkout($checkout_url) {
    global $woocommerce;
    if( ! empty( $_GET['quick_buy'] ) ) {
        $checkout_url = $woocommerce->cart->get_checkout_url();
    }
    return $checkout_url;
}
add_filter ('woocommerce_add_to_cart_redirect', 'redirect_to_checkout');

/**
 * Get Price Product
 */
function get_price_product(){
	global $product;
	if ( $product->is_type( 'simple' ) ) {
		$regular_price 	= get_post_meta( get_the_ID(), '_regular_price', true);
		$sale_price 	= get_post_meta( get_the_ID(), '_sale_price', true);
		if ( empty( $regular_price ) ) {
			echo '<p class="price">'.__( 'Contact', 'shtheme' ).'</p>';
		} elseif ( ! empty( $regular_price ) && empty( $sale_price ) ) {
			echo '<p class="price">'. wc_price( $regular_price) . '</p>';
		} elseif ( ! empty( $regular_price ) && ! empty( $sale_price ) ) {
			echo '<p class="price"><ins>'. wc_price( $sale_price) .'</ins><del>'. wc_price( $regular_price) .'</del></p>'; 
		}
	} elseif( $product->is_type( 'variable' ) ) {
		if( is_product() ) {
			// echo '<p class="price d-none">'. $product->get_price_html() .'</p>';
			echo '<p class="price d-none">'. wc_price(wc_get_price_to_display( $product, array( 'price' => $product->get_price() ) )) .'</p>';
		} else {
			echo '<p class="price">'. wc_price(wc_get_price_to_display( $product, array( 'price' => $product->get_price() ) )) .'</p>';
		}
	}
}
add_action( 'woocommerce_after_shop_loop_item','get_price_product',9 );

/**
 * Display Price For Variable Product Equal Price
 */
function display_equalprice_variable_pro($available_variations, \WC_Product_Variable $variable, \WC_Product_Variation $variation) {
    if (empty($available_variations['price_html'])) {
        $available_variations['price_html'] = '<p class="price">' . $variation->get_price_html() . '</p>';
    }
    return $available_variations;
}
add_filter('woocommerce_available_variation', 'display_equalprice_variable_pro', 10, 3);

/**
 * Title Product content-product.php
 */
function add_title_name_product(){
	echo '<h3 class="woocommerce-loop-product__title"><a 
	title="' . get_the_title() . '" 
	href=" '. get_the_permalink() .' ">' . get_the_title() . '</a></h3>';
}
add_action( 'woocommerce_shop_loop_item_title','add_title_name_product',10 );

/**
 * Include JS CSS Files 
 */
function shtheme_lib_woocommerce_scripts(){

	// Main js
	wp_enqueue_script( 'main-woo-js', SH_DIR . '/lib/js/main-woo.js', array(), '1.0', true );
	// wp_localize_script(	'main-woo-js', 'ajax', array( 'url' => admin_url('admin-ajax.php') ) );
	
	// Woocommerce Style
	wp_enqueue_style( 'woocommerce-style', SH_DIR .'/lib/css/custom-woocommerce.css' );
	wp_enqueue_style( 'woocommerce-layout-style', SH_DIR .'/lib/css/layout-woocommerce.css' );

}
add_action( 'wp_enqueue_scripts', 'shtheme_lib_woocommerce_scripts' , 99 );

/**
 * Insert button share single product
 */
function insert_share_product(){
	?>
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-57e482b2e67c850b"></script>
	<div class="addthis_inline_share_toolbox_4524"></div>
	<?php
}
//add_action( 'woocommerce_share','insert_share_product' );

/**
 * Returns Mini Cart
 *
 * @return string
 */
if( ! function_exists('sh_woocommerce_get__cart_menu_item__content') ) {
	function sh_woocommerce_get__cart_menu_item__content() {
	?>
	<div class="navbar-actions">
		<div class="navbar-actions-shrink shopping-cart">
			<a href="<?php echo get_permalink( wc_get_page_id( 'cart' ) ); ?>" class="shopping-cart-icon-container ffb-cart-menu-item">
				<div class="shopping-cart-icon-wrapper" title="<?php echo WC()->cart->get_cart_contents_count();?>">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <g clip-path="url(#clip0)">
                        <path d="M22 9.10002C21.7 9.00002 21.5 9.10002 21.3 9.20002C21.1 9.40002 20.9 9.60002 20.9 9.90002L19.6 16.8H7.3C6.6 13.3 5.3 6.90002 5.1 6.10002C4.7 4.60002 3.3 4.40002 2.7 4.40002H1C0.5 4.40002 0 4.80002 0 5.40002C0 6.00002 0.4 6.40002 1 6.40002H2.8C3 6.40002 3.1 6.50002 3.1 6.50002C3.1 6.50002 3.1 6.50002 3.1 6.60002C3.3 7.30002 4 10.6 4.6 13.8C5.2 16.7 5.7 19.4 5.7 19.5C5.7 19.6 5.7 19.6 5.8 19.7C5.1 20.1 4.6 20.9 4.6 21.7C4.7 22.9 5.7 24 7 24C8.3 24 9.3 22.9 9.3 21.7V21.4H15.8V21.7C15.8 23 16.9 24 18.1 24C19.4 24 20.4 23 20.4 21.7C20.4 20.4 19.4 19.4 18.1 19.4H8.2C7.9 19.4 7.8 19.3 7.8 19.2C7.8 19.2 7.8 19 7.7 18.9H20.5C21 18.9 21.3 18.6 21.4 18.1L22.9 10.2C23 9.70002 22.6 9.20002 22 9.10002ZM7.3 21.6C7.3 21.8 7.1 21.9 7 21.9C6.9 21.9 6.7 21.7 6.7 21.6C6.7 21.4 6.9 21.3 7 21.3C7.1 21.3 7.3 21.4 7.3 21.6ZM17.7 21.6C17.7 21.4 17.9 21.3 18 21.3C18.2 21.3 18.3 21.5 18.3 21.6C18.3 21.8 18.1 21.9 18 21.9C17.9 21.9 17.7 21.7 17.7 21.6Z" fill="#0C2A4A"></path>
                      </g>
                      <defs>
                        <clipPath id="clip0">
                          <rect width="24" height="24" fill="white"></rect>
                        </clipPath>
                      </defs>
                    </svg>
				</div>
                <div class="shopping-cart-menu-title hidden-xs">
                    <?php echo get_the_title( wc_get_page_id('cart') );?>
                </div>
			</a>
<!--			<div class="shopping-cart-menu-wrapper">-->
<!--				--><?php //wc_get_template( 'cart/mini-cart.php', array('list_class' => ''));?>
<!--			</div>-->
		</div>
	</div>
	<?php
	}
	add_action( 'sh_after_menu', 'sh_woocommerce_get__cart_menu_item__content');
}

function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	ob_start();
	?>
	<div class="navbar-actions">
		<div class="navbar-actions-shrink shopping-cart">
			<a href="<?php echo get_permalink( wc_get_page_id( 'cart' ) ); ?>" class="shopping-cart-icon-container ffb-cart-menu-item">
				<div class="shopping-cart-icon-wrapper" title="<?php echo WC()->cart->get_cart_contents_count();?>">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <g clip-path="url(#clip0)">
                        <path d="M22 9.10002C21.7 9.00002 21.5 9.10002 21.3 9.20002C21.1 9.40002 20.9 9.60002 20.9 9.90002L19.6 16.8H7.3C6.6 13.3 5.3 6.90002 5.1 6.10002C4.7 4.60002 3.3 4.40002 2.7 4.40002H1C0.5 4.40002 0 4.80002 0 5.40002C0 6.00002 0.4 6.40002 1 6.40002H2.8C3 6.40002 3.1 6.50002 3.1 6.50002C3.1 6.50002 3.1 6.50002 3.1 6.60002C3.3 7.30002 4 10.6 4.6 13.8C5.2 16.7 5.7 19.4 5.7 19.5C5.7 19.6 5.7 19.6 5.8 19.7C5.1 20.1 4.6 20.9 4.6 21.7C4.7 22.9 5.7 24 7 24C8.3 24 9.3 22.9 9.3 21.7V21.4H15.8V21.7C15.8 23 16.9 24 18.1 24C19.4 24 20.4 23 20.4 21.7C20.4 20.4 19.4 19.4 18.1 19.4H8.2C7.9 19.4 7.8 19.3 7.8 19.2C7.8 19.2 7.8 19 7.7 18.9H20.5C21 18.9 21.3 18.6 21.4 18.1L22.9 10.2C23 9.70002 22.6 9.20002 22 9.10002ZM7.3 21.6C7.3 21.8 7.1 21.9 7 21.9C6.9 21.9 6.7 21.7 6.7 21.6C6.7 21.4 6.9 21.3 7 21.3C7.1 21.3 7.3 21.4 7.3 21.6ZM17.7 21.6C17.7 21.4 17.9 21.3 18 21.3C18.2 21.3 18.3 21.5 18.3 21.6C18.3 21.8 18.1 21.9 18 21.9C17.9 21.9 17.7 21.7 17.7 21.6Z" fill="#0C2A4A"></path>
                      </g>
                      <defs>
                        <clipPath id="clip0">
                          <rect width="24" height="24" fill="white"></rect>
                        </clipPath>
                      </defs>
                    </svg>
				</div>
                <div class="shopping-cart-menu-title hidden-xs">
                    <?php echo get_the_title( wc_get_page_id('cart') );?>
                </div>
			</a>
<!--			<div class="shopping-cart-menu-wrapper">-->
<!--				--><?php //wc_get_template( 'cart/mini-cart.php', array('list_class' => ''));?>
<!--			</div>-->
		</div>
	</div>
	<?php
	$fragments['.navbar-actions'] = ob_get_clean();
	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );

/**
 * Button Detail In File content-product.php
 */
function insert_size_chart_detail(){
    global $sh_option;
	?>
	<div class="add-size-chart">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sizehart">SIZE GUIDE</button>

        <!-- Modal -->
        <div class="modal fade" id="sizehart" tabindex="-1" role="dialog" aria-labelledby="sizeChartTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php
                        $sizeChart = $sh_option['size-chart'];
                        $i = 1;
                        $j = 1;
                        if(!empty($sizeChart)){
                            echo '<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">';
                                foreach($sizeChart as $size_chart) {
                                    echo '<li class="nav-item" role="presentation">';
                                        echo '<a 
                                                class="nav-link' . (($i === 1) ? ' active' : '') . '" 
                                                id="' . $size_chart['attachment_id'] . '-tab" 
                                                data-toggle="pill" 
                                                href="#tab' . $size_chart['attachment_id'] . '-pill" 
                                                role="tab" 
                                                aria-controls="' . $size_chart['attachment_id'] . '-pill" 
                                                aria-selected="true"
                                            >';
                                            echo $size_chart['title'];
                                        echo '</a>';
                                    echo '</li>';
                                    $i++;
                                }
                            echo '</ul>';
                            echo '<div class="tab-content" id="pills-tabContent">';
                                foreach($sizeChart as $size_chart) {
                                    echo '<div class="tab-pane fade' . (($j === 1)?'show active' : '') . '" id="tab'. $size_chart['attachment_id']. '-pill" role="tabpanel" aria-labelledby="'. $size_chart['attachment_id']. '-tab">';
                                        echo '<img src="'. $size_chart['image'] .'" />';
                                    echo '</div>';
                                    $j++;
                                }
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
	</div>
	<?php
}
add_action( 'woocommerce_single_product_summary','insert_size_chart_detail',25 );

function insert_product_detail_addon(){
    ?>
    <div class="salesgen-bmsm-heading">
        <div class="sgboxes">
            <div class="sgbox1">
                <svg height="512pt" viewBox="0 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg"><path d="m416.667969 0h-321.335938c-52.566406 0-95.332031 42.765625-95.332031 95.332031v264.53125c0 52.566407 42.765625 95.332031 95.332031 95.332031h97.648438l52.414062 52.410157c2.925781 2.929687 6.765625 4.394531 10.605469 4.394531 3.835938 0 7.675781-1.464844 10.605469-4.394531l52.410156-52.410157h97.648437c52.566407 0 95.332032-42.765624 95.332032-95.332031v-264.53125c.003906-52.566406-42.761719-95.332031-95.328125-95.332031zm65.332031 359.863281c0 36.023438-29.308594 65.332031-65.332031 65.332031h-103.863281c-3.976563 0-7.792969 1.582032-10.605469 4.394532l-46.199219 46.195312-46.199219-46.195312c-2.8125-2.816406-6.625-4.394532-10.605469-4.394532h-103.863281c-36.023437 0-65.332031-29.308593-65.332031-65.332031v-264.53125c0-36.023437 29.308594-65.332031 65.332031-65.332031h321.335938c36.023437 0 65.332031 29.308594 65.332031 65.332031zm0 0"></path><path d="m137.859375 134.949219h-50.558594c-2.070312 0-3.75 1.679687-3.75 3.75v10.074219c0 2.070312 1.679688 3.75 3.75 3.75h16.023438v51.378906c0 2.074218 1.679687 3.75 3.75 3.75h11.011719c2.070312 0 3.75-1.675782 3.75-3.75v-51.378906h16.023437c2.070313 0 3.75-1.679688 3.75-3.75v-10.074219c0-2.070313-1.679687-3.75-3.75-3.75zm0 0"></path><path d="m160.804688 207.652344c2.070312 0 3.75-1.675782 3.75-3.75v-22.929688h24.871093v22.929688c0 2.074218 1.679688 3.75 3.75 3.75h11.003907c2.074218 0 3.75-1.675782 3.75-3.75v-65.203125c0-2.070313-1.675782-3.75-3.75-3.75h-11.003907c-2.070312 0-3.75 1.679687-3.75 3.75v24.515625h-24.871093v-24.515625c0-2.070313-1.679688-3.75-3.75-3.75h-11.003907c-2.074219 0-3.75 1.679687-3.75 3.75v65.203125c0 2.074218 1.675781 3.75 3.75 3.75zm0 0"></path><path d="m257.144531 137.1875c-.597656-1.359375-1.945312-2.238281-3.429687-2.238281h-11.753906c-1.484376 0-2.832032.878906-3.433594 2.238281l-28.730469 65.207031c-.511719 1.15625-.402344 2.496094.292969 3.558594.6875 1.0625 1.871094 1.703125 3.140625 1.703125h11.753906c1.484375 0 2.832031-.878906 3.429687-2.242188l5.546876-12.589843h27.753906l5.546875 12.589843c.597656 1.363282 1.945312 2.242188 3.429687 2.242188h11.753906.023438c2.070312 0 3.75-1.679688 3.75-3.75 0-.675781-.179688-1.304688-.488281-1.851562zm-3.210937 37.964844h-12.191406l6.097656-13.820313zm0 0"></path><path d="m351.382812 134.949219h-11.011718c-2.070313 0-3.75 1.679687-3.75 3.75v37.765625l-31.160156-40.066406c-.707032-.914063-1.800782-1.449219-2.957032-1.449219h-11.011718c-2.070313 0-3.75 1.679687-3.75 3.75v65.207031c0 2.070312 1.679687 3.75 3.75 3.75h11.011718c2.070313 0 3.75-1.679688 3.75-3.75v-36.632812l30.222656 38.929687c.710938.917969 1.804688 1.453125 2.960938 1.453125h11.941406c2.070313 0 3.75-1.679688 3.75-3.75v-65.207031c.003906-2.070313-1.675781-3.75-3.746094-3.75zm0 0"></path><path d="m402.949219 167.523438 24.140625-26.289063c1.007812-1.09375 1.269531-2.683594.671875-4.042969-.601563-1.363281-1.945313-2.242187-3.433594-2.242187h-13.992187c-1.039063 0-2.027344.429687-2.734376 1.183593l-23.367187 24.898438v-22.332031c0-2.070313-1.679687-3.75-3.75-3.75h-11.007813c-2.070312 0-3.75 1.679687-3.75 3.75v65.203125c0 2.074218 1.679688 3.75 3.75 3.75h11.007813c2.070313 0 3.75-1.675782 3.75-3.75v-16.808594l5.476563-5.90625 18.941406 24.984375c.710937.933594 1.816406 1.480469 2.988281 1.480469h13.058594c1.410156 0 2.703125-.789063 3.34375-2.042969.640625-1.257813.523437-2.765625-.304688-3.90625zm0 0"></path><path d="m214.449219 248.808594c-.660157-1.1875-1.914063-1.921875-3.269531-1.921875h-12.035157c-1.316406 0-2.535156.691406-3.214843 1.820312l-14.601563 24.3125-14.601563-24.3125c-.679687-1.128906-1.898437-1.820312-3.214843-1.820312h-12.035157c-1.359374 0-2.609374.734375-3.273437 1.921875-.664063 1.183594-.632813 2.636718.078125 3.792968l23.699219 38.554688v24.6875c0 2.070312 1.679687 3.75 3.75 3.75h11.195312c2.070313 0 3.75-1.679688 3.75-3.75v-24.6875l23.695313-38.554688c.714844-1.160156.742187-2.609374.078125-3.792968zm0 0"></path><path d="m247.464844 245.304688c-10.671875 0-19.777344 3.605468-27.0625 10.71875-7.308594 7.140624-11.015625 16.140624-11.015625 26.75 0 10.613281 3.707031 19.613281 11.015625 26.75 7.289062 7.117187 16.394531 10.722656 27.0625 10.722656 10.667968 0 19.769531-3.605469 27.058594-10.722656 7.3125-7.136719 11.019531-16.140626 11.019531-26.75 0-10.609376-3.707031-19.609376-11.019531-26.75-7.285157-7.113282-16.386719-10.71875-27.058594-10.71875zm0 57.367187c-5.457032 0-9.929688-1.886719-13.675782-5.761719-3.777343-3.910156-5.613281-8.53125-5.613281-14.136718 0-5.601563 1.835938-10.226563 5.613281-14.136719 3.746094-3.875 8.21875-5.761719 13.675782-5.761719 5.457031 0 9.929687 1.886719 13.671875 5.757812 3.78125 3.917969 5.621093 8.542969 5.621093 14.140626 0 5.601562-1.839843 10.226562-5.621093 14.136718-3.742188 3.875-8.210938 5.761719-13.671875 5.761719zm0 0"></path><path d="m350.074219 246.886719h-11.007813c-2.070312 0-3.75 1.679687-3.75 3.75v36.101562c0 5.023438-1.203125 8.972657-3.574218 11.738281-2.257813 2.636719-5.292969 3.917969-9.28125 3.917969-3.984376 0-7.019532-1.28125-9.277344-3.917969-2.371094-2.765624-3.574219-6.714843-3.574219-11.738281v-36.101562c0-2.070313-1.679687-3.75-3.75-3.75h-11.007813c-2.074218 0-3.75 1.679687-3.75 3.75v36.566406c0 10.394531 2.980469 18.589844 8.863282 24.363281 5.859375 5.757813 13.429687 8.679688 22.496094 8.679688 9.066406 0 16.636718-2.921875 22.5-8.679688 5.882812-5.773437 8.863281-13.96875 8.863281-24.363281v-36.566406c0-2.070313-1.679688-3.75-3.75-3.75zm0 0"></path></svg>					</div>
            <div class="sgbox2">
                <div class="sgbmsm-title">Buy More Save More!</div>
                <div class="sgbmsm-text">It’s time to give thanks for all the little things.</div>
            </div>
        </div>
    </div>
    <ul class="salesgen-bmsm-items" data-discount_type="items" data-style="style1">
        <li>
            <div class="salesgen-bmsm-item-text">
                <span class="salesgen-bmsm-item-label">5% OFF</span>
                <span class="salesgen-bmsm-item-title-wrp">
					<span class="salesgen-bmsm-item-title"> 2 items get <span class="salesgen-bmsm-item-label2">5% OFF</span></span> on cart total
				</span>
            </div>
        </li>
        <li>
            <div class="salesgen-bmsm-item-text">
                <span class="salesgen-bmsm-item-label">10% OFF</span>
                <span class="salesgen-bmsm-item-title-wrp">
                    <span class="salesgen-bmsm-item-title"> 3 items get <span class="salesgen-bmsm-item-label2">10% OFF</span></span> on cart total
                </span>
            </div>
        </li>
        <li>
            <div class="salesgen-bmsm-item-text">
                <span class="salesgen-bmsm-item-label">15% OFF</span>
                <span class="salesgen-bmsm-item-title-wrp">
                    <span class="salesgen-bmsm-item-title"> 5 items get <span class="salesgen-bmsm-item-label2">15% OFF</span></span> on cart total
                </span>
            </div>
        </li>
    </ul>
    <?php
}
add_action( 'woocommerce_single_product_summary','insert_product_detail_addon',65 );

/**
 * Hook Woocommerce
 */
// File archive-product.php
//remove_action( 'woocommerce_before_shop_loop','woocommerce_result_count',20 );
// remove_action( 'woocommerce_before_shop_loop','woocommerce_catalog_ordering',30 );
//remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb',20 );
remove_action( 'woocommerce_sidebar','woocommerce_get_sidebar',10 );

// File content-product.php
remove_action( 'woocommerce_before_shop_loop_item','woocommerce_template_loop_product_link_open',10 );
remove_action( 'woocommerce_before_shop_loop_item_title','woocommerce_show_product_loop_sale_flash',10 );
remove_action( 'woocommerce_before_shop_loop_item_title','woocommerce_template_loop_product_thumbnail',10 );
remove_action( 'woocommerce_after_shop_loop_item','woocommerce_template_loop_product_link_close',5 );
    remove_action( 'woocommerce_after_shop_loop_item','woocommerce_template_loop_add_to_cart',10 );
    remove_action( 'woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating',5 );
remove_action( 'woocommerce_after_shop_loop_item_title','woocommerce_template_loop_price',10 );
remove_action( 'woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title',10 );

// File content-single-product.php
remove_action( 'woocommerce_single_product_summary','woocommerce_template_single_meta',40 );
add_action( 'woocommerce_single_product_summary','woocommerce_template_single_meta',6 );