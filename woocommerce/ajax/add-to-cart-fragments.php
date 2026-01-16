<?php
/**
 * 	NM: The template for including AJAX add-to-cart replacement elements/fragments
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Shop notices
fugu_print_shop_notices();

// Cart contents count
echo fugu_get_cart_contents_count();

// Mini cart
global $fugu_globals;
if ( $fugu_globals['cart_panel'] ) {
    echo '<div class="widget_shopping_cart_content">';
    woocommerce_mini_cart();
    echo '</div>';
}
?>
