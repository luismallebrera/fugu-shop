<?php
/**
 *	NM: Shop - Filters header
 */

defined( 'ABSPATH' ) || exit;

global $fugu_theme_options, $fugu_globals;

$header_class = '';
$filters_or_search_enabled = false;

// Categories
if ( $fugu_theme_options['shop_categories'] ) {
    fugu_add_page_include( 'shop_categories' );
	
    $show_categories = true;
    $header_class .= ' has-categories';
} else {
	$show_categories = false;
	$header_class .= ' no-categories';
}

// Filters
if ( $fugu_theme_options['shop_filters'] == 'header' ) {
    fugu_add_page_include( 'shop_filters' );
    
	$show_filters = true;
    $filters_or_search_enabled = true;
    $header_class .= ' has-filters';
} else {
	$show_filters = false;
	$header_class .= ' no-filters';
}

// Sidebar
if ( $fugu_theme_options['shop_filters'] == 'default' ) {
    $show_sidebar = true;
    $header_class .= ' has-sidebar';
} else {
    $show_sidebar = false;
    $header_class .= ' no-sidebar';
}

// Search
if ( $fugu_globals['shop_search'] ) {
	$filters_or_search_enabled = true;
    $header_class .= ' has-search';
} else {
    $header_class .= ' no-search';
}

// Header class
if ( $fugu_globals['shop_filters_popup'] || ! $filters_or_search_enabled ) {
    $header_class .= ' centered'; // Add "centered" class to center category-menu when filters and search is disabled
}

// Menu class
$menu_class = $fugu_theme_options['shop_categories_layout'] . ' ' . $fugu_theme_options['shop_categories_thumbnails_layout'];
?>
    <div class="fugu-shop-header<?php echo esc_attr( $header_class ); ?>">
        <div class="fugu-shop-menu <?php echo esc_attr( $menu_class ); ?>">
            <div class="fugu-row">
                <div class="col-xs-12">
                    <div id="fugu-shop-filter-menu-wrap">
                        <ul id="fugu-shop-filter-menu" class="fugu-shop-filter-menu">
                            <?php if ( $show_categories ) : ?>
                            <li class="fugu-shop-categories-btn-wrap" data-panel="cat">
                                <a href="#categories" class="invert-color"><?php esc_html_e( 'Categories', 'woocommerce' ); ?></a>
                            </li>
                            <?php endif; ?>
                            <?php if ( $show_filters ) : ?>
                            <li class="fugu-shop-filter-btn-wrap" data-panel="filter">
                                <a href="#filter" class="invert-color"><i class="fugu-font fugu-font-filter-list"></i><span><?php esc_html_e( 'Filter', 'woocommerce' ); ?></span></a>
                            </li>
                            <?php endif; ?>
                            <?php if ( $show_sidebar ) : ?>
                            <li class="fugu-shop-sidebar-btn-wrap" data-panel="sidebar">
                                <a href="#filter" class="invert-color"><i class="fugu-font fugu-font-filter-list"></i><span><?php esc_html_e( 'Filter', 'woocommerce' ); ?></span></a>
                            </li>
                            <?php endif; ?>
                            <?php 
                                if ( $fugu_globals['shop_search'] ) :

                                $menu_divider_escaped = apply_filters( 'fugu_shop_categories_divider', '<span>&frasl;</span>' );
                            ?>
                            <li class="fugu-shop-search-btn-wrap" data-panel="search">
                                <?php echo $menu_divider_escaped; ?>
                                <a href="#search" id="fugu-shop-search-btn" class="invert-color"><i class="fugu-font fugu-font-search"></i><span><?php esc_html_e( 'Search', 'woocommerce' ); ?></span></a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <?php if ( $show_categories ) : ?>
                    <div id="fugu-shop-categories-wrap">
                        <?php fugu_category_menu(); ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <?php if ( $show_filters ) : ?>
        <div id="fugu-shop-sidebar" class="fugu-shop-sidebar fugu-shop-sidebar-header" data-sidebar-layout="header">
            <div class="fugu-shop-sidebar-inner">
                <div class="fugu-row">
                    <div class="col-xs-12">
                        <ul id="fugu-shop-widgets-ul" class="small-block-grid-<?php echo esc_attr( $fugu_theme_options['shop_filters_columns'] ); ?>">
                            <?php
                                if ( is_active_sidebar( 'widgets-shop' ) ) {
                                    dynamic_sidebar( 'widgets-shop' );
								}
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div id="fugu-shop-sidebar-layout-indicator"></div> <!-- Don't remove (used for testing sidebar/filters layout in JavaScript) -->
        </div>
        <?php endif; ?>
        
        <?php 
			// Search-form
			if ( $fugu_globals['shop_search'] ) {
				wc_get_template( 'product-searchform_nm.php' );
			}
		?>
    </div>
