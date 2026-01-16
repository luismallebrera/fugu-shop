<?php
/**
 *	NM: Shop - Filters popup
 */

defined( 'ABSPATH' ) || exit;

global $fugu_globals, $fugu_theme_options;
?>

<div id="fugu-shop-sidebar-popup-button"><span><?php esc_html_e( 'Filter', 'woocommerce' ); ?></span><i class="fugu-font fugu-font-chevron-thin-up"></i></div>

<div class="fugu-shop-sidebar-popup-holder">
    <div id="fugu-shop-sidebar-popup" class="fugu-shop-sidebar-popup">
        <a href="#" id="fugu-shop-sidebar-popup-close-button"><i class="fugu-font-close2"></i></a>

        <div class="fugu-shop-sidebar-popup-inner">
            <?php if ( $fugu_globals['shop_search_popup'] ) : ?>
            <div id="fugu-shop-search" class="fugu-shop-search fugu-shop-search-popup">
                <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <input type="text" id="fugu-shop-search-input" autocomplete="off" value="" name="s" placeholder="<?php esc_attr_e( 'Search products', 'woocommerce' ); ?>" />
                    <span class="fugu-search-icon fugu-font fugu-font-search"></span>
                    <input type="hidden" name="post_type" value="product" />
                </form>

                <div id="fugu-shop-search-notice"><span><?php printf( esc_html__( 'press %sEnter%s to search', 'fugu-framework' ), '<u>', '</u>' ); ?></span></div>
            </div>
            <?php endif; ?>

            <div id="fugu-shop-sidebar" class="fugu-shop-sidebar fugu-shop-sidebar-popup" data-sidebar-layout="popup">
                <ul id="fugu-shop-widgets-ul">
                    <?php
                        if ( is_active_sidebar( 'widgets-shop' ) ) {
                            dynamic_sidebar( 'widgets-shop' );
                        }
                    ?>
                </ul>
            </div>

            <div class="fugu-shop-sidebar-popup-buttons">
                <a href="#" id="fugu-shop-sidebar-popup-reset-button" class="button"><span><?php esc_html_e( 'Reset', 'woocommerce' ); ?></span><i class="fugu-font-replay"></i></a>
            </div>
        </div>
    </div>
    
    <div class="fugu-page-overlay fugu-shop-popup-filters"></div>
</div>
