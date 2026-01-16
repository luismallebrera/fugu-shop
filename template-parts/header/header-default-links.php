<?php
global $fugu_globals, $fugu_theme_options;

$default_links = array();

// Search
if ( $fugu_globals['shop_search_header'] ) {
    $search_icon_html = apply_filters( 'fugu_header_search_icon_html', '<i class="fugu-font fugu-font-search"></i>' );
    
    $default_links['search'] = sprintf(
        '<li class="fugu-menu-search menu-item-default has-icon"><a href="#" id="fugu-menu-search-btn" aria-label="%s">%s</a></li>',
        esc_html__( 'Search', 'woocommerce' ),
        $search_icon_html
    );
}

// Login/My Account
if ( fugu_woocommerce_activated() && $fugu_theme_options['menu_login'] ) {
    $icon_class = ( $fugu_theme_options['menu_login_icon'] ) ? 'has-icon' : 'no-icon';
    
    $default_links['my_account'] = sprintf(
        '<li class="fugu-menu-account menu-item-default %s" aria-label="%s">%s</li>',
        esc_attr( $icon_class ),
        esc_html__( 'My account', 'woocommerce' ),
        fugu_get_myaccount_link( true ) // Args: $is_header
    );
}

// Wishlist
if ( $fugu_globals['wishlist_enabled'] && $fugu_theme_options['menu_wishlist'] ) {
    $icon_class = array();
    $icon_class[] = ( $fugu_theme_options['menu_wishlist_icon'] ) ? 'has-icon' : 'no-icon';
    $icon_class[] = apply_filters( 'fugu_header_wishlist_icon_hide_class', 'if-zero-hide-icon' );
    $icon_class = implode( ' ', $icon_class );
    
    $wishlist_link_escaped = ( function_exists( 'fugu_wishlist_get_header_link' ) ) ? fugu_wishlist_get_header_link() : '';
    
    $default_links['wishlist'] = sprintf(
        '<li class="fugu-menu-wishlist menu-item-default %s" aria-label="%s">%s</li>',
        esc_attr( $icon_class ),
        esc_html__( 'Wishlist', 'fugu-wishlist' ),
        $wishlist_link_escaped
    );
}

// Cart
if ( $fugu_globals['cart_link'] ) {
    $icon_class = ( $fugu_theme_options['menu_cart_icon'] ) ? 'has-icon' : 'no-icon';
    $cart_url = ( $fugu_globals['cart_panel'] ) ? '#' : wc_get_cart_url();
    
    $default_links['cart'] = sprintf(
        '<li class="fugu-menu-cart menu-item-default %s"><a href="%s" id="fugu-menu-cart-btn">%s %s</a></li>',
        esc_attr( $icon_class ),
        esc_url( $cart_url ),
        fugu_get_cart_title(),
        fugu_get_cart_contents_count()
    );
}

$default_links = apply_filters( 'fugu_header_default_links', $default_links );

foreach( $default_links as $default_link ) {
    echo $default_link;
}
