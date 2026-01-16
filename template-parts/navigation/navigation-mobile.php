<?php 
    global $fugu_theme_options, $fugu_globals;
    
    $is_side_layout     = ( $fugu_theme_options['menu_mobile_layout'] === 'side' ) ? true : false;
    $show_search        = ( $fugu_globals['shop_search_header'] ) ? apply_filters( 'fugu_mobile_menu_search', false ) : false;
    $menu_allow_icons   = apply_filters( 'fugu_mobile_menu_allow_icons', false );
?>
<div class="fugu-mobile-menu-holder">
    <div id="fugu-mobile-menu" class="fugu-mobile-menu">
        <?php if ( $is_side_layout ) : ?>
        <div class="fugu-mobile-menu-header">
            <div class="fugu-row">
                <div class="col-xs-12">
                    <div class="fugu-mobile-menu-header-inner">
                        <a id="fugu-mobile-menu-close-button"><i class="fugu-font-close2"></i></a>

                        <?php
                            // Login/My Account
                            if ( fugu_woocommerce_activated() && $fugu_theme_options['menu_login'] ) {
                                $myaccount_url = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) );

                                $link_icon = apply_filters( 'fugu_myaccount_icon', $fugu_theme_options['menu_login_icon_html'], 'fugu-font fugu-font-user' );
                                $link_title = ( is_user_logged_in() ) ? esc_html__( 'My account', 'woocommerce' ) : esc_html__( 'Login', 'woocommerce' );

                                printf(
                                    '<a href="%s" id="fugu-mobile-menu-account-btn">%s <span>%s</span></a>',
                                    esc_url( $myaccount_url ),
                                    $link_icon,
                                    $link_title
                                );
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <div class="fugu-mobile-menu-scroll">
            <div class="fugu-mobile-menu-content">
                <div class="fugu-row">
                    <?php if ( $show_search ) : ?>
                    <div class="fugu-mobile-menu-top col-xs-12">
                        <ul id="fugu-mobile-menu-top-ul" class="menu">
                            <li class="fugu-mobile-menu-item-search menu-item">
                                <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                    <input type="search" id="fugu-mobile-menu-shop-search-input" class="fugu-mobile-menu-search" autocomplete="off" value="" name="s" placeholder="<?php esc_attr_e( 'Search products', 'woocommerce' ); ?>" />
                                    <span class="fugu-font fugu-font-search"></span>
                                    <input type="hidden" name="post_type" value="product" />
                                </form>
                            </li>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <div class="fugu-mobile-menu-main col-xs-12">
                        <ul id="fugu-mobile-menu-main-ul" class="menu">
                            <?php do_action( 'fugu_mobile_menu_before_main_menu_items' ); ?>

                            <?php
                            if ( has_nav_menu( 'mobile-menu' ) ) {
                                // Mobile menu
                                wp_nav_menu( array(
                                    'theme_location'	=> 'mobile-menu',
                                    'container'       	=> false,
                                    'fallback_cb'     	=> false,
                                    'after' 	 		=> '<span class="fugu-menu-toggle"></span>',
                                    'walker'            => new FUGU_Sublevel_Walker_Mobile,
                                    'items_wrap'      	=> '%3$s'
                                ) );
                            } else {
                                // Main menu
                                wp_nav_menu( array(
                                    'theme_location'	=> 'main-menu',
                                    'container'       	=> false,
                                    'fallback_cb'     	=> false,
                                    'after' 	 		=> '<span class="fugu-menu-toggle"></span>',
                                    'walker'            => new FUGU_Sublevel_Walker_Mobile,
                                    'items_wrap'      	=> '%3$s'
                                ) );

                                // Right menu                        
                                wp_nav_menu( array(
                                    'theme_location'	=> 'right-menu',
                                    'container'       	=> false,
                                    'fallback_cb'     	=> false,
                                    'after' 	 		=> '<span class="fugu-menu-toggle"></span>',
                                    'items_wrap'      	=> '%3$s'
                                ) );
                            }
                            ?>

                            <?php do_action( 'fugu_mobile_menu_after_main_menu_items' ); ?>
                        </ul>
                    </div>

                    <?php if ( $fugu_theme_options['menu_mobile_secondary_menu'] ) : ?>
                    <div class="fugu-mobile-menu-secondary col-xs-12">
                        <ul id="fugu-mobile-menu-secondary-ul" class="menu">
                            <?php do_action( 'fugu_mobile_menu_before_secondary_menu_items' ); ?>

                            <?php
                            $menu_links = array();

                            // Mobile secondary menu
                            if ( has_nav_menu( 'mobile-menu-secondary' ) ) {
                                $menu_links['top_bar'] = wp_nav_menu( array(
                                    'theme_location'	=> 'mobile-menu-secondary',
                                    'container'       	=> false,
                                    'fallback_cb'     	=> false,
                                    'after' 	 		=> '<span class="fugu-menu-toggle"></span>',
                                    'echo'              => false,
                                    'items_wrap'      	=> '%3$s'
                                ) );
                            }

                            // WooCommerce links
                            if ( ! $is_side_layout && fugu_woocommerce_activated() ) {
                                // Cart
                                /*if ( $fugu_globals['cart_link'] ) {
                                    $menu_links['cart'] = sprintf( '<li class="fugu-mobile-menu-item-cart menu-item"><a href="%s" id="fugu-mobile-menu-cart-btn">%s %s</a></li>',
                                        esc_url( wc_get_cart_url() ),
                                        fugu_get_cart_title( $menu_allow_icons ), // Args: $allow_icon
                                        fugu_get_cart_contents_count()
                                    );
                                }*/

                                // Login/My Account
                                if ( $fugu_theme_options['menu_login'] ) {
                                    $menu_links['my_account'] = '<li class="fugu-menu-item-login menu-item">' . fugu_get_myaccount_link( $menu_allow_icons, true ) . '</li>'; // Args: $allow_icon, $is_mobile_menu
                                }

                                // Wishlist
                                if ( $fugu_globals['wishlist_enabled'] && $fugu_theme_options['menu_wishlist'] ) {
                                    $wishlist_link_escaped = ( function_exists( 'fugu_wishlist_get_header_link' ) ) ? fugu_wishlist_get_header_link( $menu_allow_icons ) : ''; // Args: $allow_icon
                                    $menu_links['wishlist'] = '<li class="fugu-menu-item-wishlist menu-item">' . $wishlist_link_escaped . '</li>';
                                }
                            }

                            $menu_links = apply_filters( 'fugu_mobile_menu_secondary_links', $menu_links );
                            foreach( $menu_links as $menu_link ) {
                                echo $menu_link; // Escaped
                            }
                            ?>

                            <?php do_action( 'fugu_mobile_menu_after_secondary_menu_items' ); ?>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <?php if ( $fugu_theme_options['menu_mobile_social_icons'] ) : ?>
                    <div class="fugu-mobile-menu-social col-xs-12">
                        <?php do_action( 'fugu_mobile_menu_before_social_icons' ); ?>

                        <?php echo fugu_get_social_profiles( 'fugu-mobile-menu-social-ul' ); // Args: $wrapper_class ?>

                        <?php do_action( 'fugu_mobile_menu_after_social_icons' ); ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="fugu-page-overlay fugu-mobile-menu-overlay"></div>
</div>
