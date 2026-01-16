<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 NM: Modified */

defined( 'ABSPATH' ) || exit;

global $product, $fugu_globals, $fugu_theme_options;

// Check if the product is a valid WooCommerce product and ensure its visibility before proceeding.
if ( ! is_a( $product, WC_Product::class ) || ! $product->is_visible() ) {
	return;
}

fugu_add_page_include( 'products' );

$product_class = array();

// Wrapper link
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
$wrapper_link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );

// Product variation attributes
$attributes_escaped = function_exists( 'fugu_template_loop_attributes' ) ? fugu_template_loop_attributes() : null;
if ( $attributes_escaped ) {
    $product_class[] = 'fugu-has-attributes';
}

// Title
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
add_action( 'woocommerce_shop_loop_item_title', 'fugu_template_loop_product_title', 10 );

// Rating
if ( ! $fugu_theme_options['product_rating'] ) {
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
}

// Action link
if ( $fugu_theme_options['product_action_link'] ) {
    if ( $fugu_theme_options['product_action_link_position'] == 'thumbnail' && $fugu_theme_options['products_layout'] !== 'overlay' ) {
        remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
        add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 15 );
    }
} else {
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
}

// Product wrapper class
$product_class = implode( ' ', $product_class );
?>
<li <?php wc_product_class( $product_class, $product ); ?> data-product-id="<?php echo esc_attr( $product->get_id() ); ?>">
	<div class="fugu-shop-loop-product-wrap">
        <?php
        /**
         * Hook: woocommerce_before_shop_loop_item.
         *
         * NM: Removed - @hooked woocommerce_template_loop_product_link_open - 10
         */
        do_action( 'woocommerce_before_shop_loop_item' );
        ?>

        <div class="fugu-shop-loop-thumbnail">
            <?php
                /**
                 * Wishlist button - Note: Centered layout only
                 */
                if ( $fugu_globals['wishlist_enabled'] && $fugu_theme_options['products_layout'] == 'centered' ) { fugu_wishlist_button(); }
            ?>
            
            <a href="<?php echo esc_url( $wrapper_link ); ?>" class="fugu-shop-loop-thumbnail-link woocommerce-LoopProduct-link">
            <?php
            /**
             * Hook: woocommerce_before_shop_loop_item_title.
             *
             * @hooked woocommerce_show_product_loop_sale_flash - 10
             * @hooked woocommerce_template_loop_product_thumbnail - 10
             */
            do_action( 'woocommerce_before_shop_loop_item_title' );
            ?>
            </a>
        </div>
        
        <div class="fugu-shop-loop-details">
            <?php
                /**
                 * Wishlist button
                 */
                if ( $fugu_globals['wishlist_enabled'] && $fugu_theme_options['products_layout'] !== 'centered' ) { fugu_wishlist_button(); }
            ?>

            <div class="fugu-shop-loop-title-price">
            <?php
            /**
             * Hook: woocommerce_shop_loop_item_title.
             *
             * NM: Removed - @hooked woocommerce_template_loop_product_title - 10
             * NM: Added - @hooked fugu_template_loop_product_title - 10
             */
            do_action( 'woocommerce_shop_loop_item_title' );
            
            /**
             * Hook: woocommerce_after_shop_loop_item_title.
             *
             * @hooked woocommerce_template_loop_rating - 5
             * @hooked woocommerce_template_loop_price - 10
             */
            do_action( 'woocommerce_after_shop_loop_item_title' );
            ?>
            </div>

            <div class="fugu-shop-loop-actions">
            <?php
            /**
             * Hook: woocommerce_after_shop_loop_item.
             *
             * NM: Removed - @hooked woocommerce_template_loop_product_link_close - 5
             * @hooked woocommerce_template_loop_add_to_cart - 10
             * NM: Added - @hooked fugu_quickview_include_link - 14
             */
            do_action( 'woocommerce_after_shop_loop_item' );
            ?>
            </div>
        </div>
        
        <?php
            /**
             * Product variation attributes
             */
            if ( $attributes_escaped ) {
                echo $attributes_escaped;
            }
        ?>
    </div>
</li>
