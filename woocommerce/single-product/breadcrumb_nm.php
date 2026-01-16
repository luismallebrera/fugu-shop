<?php
/**
 *  NM: Single Product breadrumb and navigation
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $fugu_globals, $fugu_theme_options;

?>

<div class="fugu-single-product-top">
    <div class="fugu-row">
        <div class="col-xs-9">
            <?php
                // Is the shop displaying on the home-page?
                $shop_on_homepage = ( $fugu_globals['shop_page_id'] == intval( get_option('page_on_front') ) );
                
                $shop_title = apply_filters( 'fugu_woocommerce_breadcrumb_home_title', esc_html_x( 'Shop', 'Page title', 'woocommerce' ) );
            
                /* Breadcrumb */
                woocommerce_breadcrumb( array(
                    'delimiter'   	=> '<span class="delimiter">/</span>',
                    'wrap_before'	=> '<nav id="fugu-breadcrumb" class="woocommerce-breadcrumb" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '>',
                    'wrap_after'	=> '</nav>',
                    'home'			=> ( $shop_on_homepage ) ? $shop_title : esc_html_x( 'Home', 'breadcrumb', 'woocommerce' )
                ) );
            ?>
        </div>

        <div class="col-xs-3">
            <div class="fugu-single-product-menu">
                <?php
                    // Product navigation
                    $navigate_same_term = ( $fugu_theme_options['product_navigation_same_term'] ) ? true : false;

                    /* Product navigation */
                    next_post_link( '%link', apply_filters( 'fugu_single_product_menu_next_icon', '<i class="fugu-font fugu-font-media-play flip"></i>' ), $navigate_same_term, array(), 'product_cat' );
                    previous_post_link( '%link', apply_filters( 'fugu_single_product_menu_prev_icon', '<i class="fugu-font fugu-font-media-play"></i>' ), $navigate_same_term, array(), 'product_cat' );
                ?>
            </div>
        </div>
    </div>
</div>
