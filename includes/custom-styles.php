<?php
/**
 * Custom styles
 */
if ( ! function_exists( 'fugu_custom_styles_generate' ) ) :

function fugu_custom_styles_generate( $action_value_placeholder = null, $save_styles = true ) {
	global $fugu_theme_options;
	
	/**
     * Fonts
     */
    // Font
    if ( $fugu_theme_options['main_font_source'] === '2' && isset( $fugu_theme_options['main_font_adobefonts_project_id'] ) ) {
        $body_font_css = 'body{font-family:"' . $fugu_theme_options['main_adobefonts_font'] . '",sans-serif;}'; // Adobe Fonts font
    } else if ( $fugu_theme_options['main_font_source'] === '3' ) {
        $body_font_css = $fugu_theme_options['main_font_custom_css']; // Custom CSS
    } else {
        $body_font_css = 'body{font-family:"' . $fugu_theme_options['main_font']['font-family'] . '",sans-serif;}'; // Standard + Google Webfonts font
    }
    
    // Font - Header
    $header_font_enabled = ( $fugu_theme_options['header_font_source'] !== '0' ) ? true : false;
    if ( $header_font_enabled ) {
        if ( $fugu_theme_options['header_font_source'] == '2' && isset( $fugu_theme_options['header_font_adobefonts_project_id'] ) ) {
            $header_font = $fugu_theme_options['header_adobefonts_font']; // Adobe Fonts font
        } else {
            $header_font = $fugu_theme_options['header_font']['font-family']; // Standard + Google Webfonts font
        }
    }
    
    // Font - Headings
    $headings_font_enabled = ( $fugu_theme_options['secondary_font_source'] !== '0' ) ? true : false;
    if ( $headings_font_enabled ) {
        if ( $fugu_theme_options['secondary_font_source'] == '2' && isset( $fugu_theme_options['secondary_font_adobefonts_project_id'] ) ) {
            $headings_font = $fugu_theme_options['secondary_adobefonts_font']; // Adobe Fonts font
        } else {
            $headings_font = $fugu_theme_options['secondary_font']['font-family']; // Standard + Google Webfonts font
        }
    }
    
	/**
     * Header height
     */
	$header_spacing_desktop = intval( $fugu_theme_options['header_spacing_top'] ) + intval( $fugu_theme_options['header_spacing_bottom'] );
    $header_spacing_alt = intval( $fugu_theme_options['header_spacing_top_alt'] ) + intval( $fugu_theme_options['header_spacing_bottom_alt'] );
    
    $logo_height_desktop = intval( $fugu_theme_options['logo_height'] );
    $logo_height_tablet = intval( $fugu_theme_options['logo_height_tablet'] );
    $logo_height_mobile = intval( $fugu_theme_options['logo_height_mobile'] );
    
    $menu_height_desktop = intval( $fugu_theme_options['menu_height'] );
    $menu_height_tablet = intval( $fugu_theme_options['menu_height_tablet'] );
    $menu_height_mobile = intval( $fugu_theme_options['menu_height_mobile'] );
    
    // Desktop
    if ( strpos( $fugu_theme_options['header_layout'], 'stacked' ) !== false ) { // Is a "stacked" header layout enabled?
        $header_height_desktop = $menu_height_desktop;
        $stacked_logo_height_desktop = ( $logo_height_desktop > $menu_height_desktop ) ? $logo_height_desktop : $menu_height_desktop;
        $header_total_height_desktop = $header_spacing_desktop + $stacked_logo_height_desktop + intval( $fugu_theme_options['logo_spacing_bottom'] ) + $header_height_desktop;
    } else {
        $header_height_desktop = ( $logo_height_desktop > $menu_height_desktop ) ? $logo_height_desktop : $menu_height_desktop;
        $header_total_height_desktop = $header_spacing_desktop + $header_height_desktop;
    }
    // Tablet
    $header_height_tablet = ( $logo_height_tablet > $menu_height_tablet ) ? $logo_height_tablet : $menu_height_tablet;
    $header_total_height_tablet = $header_spacing_alt + $header_height_tablet;
    // Mobile
    $header_height_mobile = ( $logo_height_mobile > $menu_height_mobile ) ? $logo_height_mobile : $menu_height_mobile;
    $header_total_height_mobile = $header_spacing_alt + $header_height_mobile;
    
    /**
     * Border radius
     */
    $border_radius_image_fullwidth_breakpoint = apply_filters( 'fugu_border_radius_image_fullwidth_breakpoint', 1440 );
    
    /**
     * Shop: Preloader gradient - Convert hex color to CSS gradient with rgba colors
     */
    //$preloader_foreground_color = $fugu_theme_options['shop_ajax_preloader_foreground_color'];
    //$preloader_background_color = $fugu_theme_options['shop_ajax_preloader_background_color'];
    $preloader_foreground_color = '#eeeeee';
    $preloader_background_color = '#ffffff';
    
    list( $preloader_foreground_r, $preloader_foreground_g, $preloader_foreground_b ) = sscanf( $preloader_foreground_color, '#%02x%02x%02x' );
    
    $preloader_foreground_rgb = $preloader_foreground_r . ',' . $preloader_foreground_g . ',' . $preloader_foreground_b;
    
    $preloader_foreground_gradient = 'linear-gradient(90deg, rgba(' . $preloader_foreground_rgb . ',0) 20%, rgba(' . $preloader_foreground_rgb . ',0.3) 50%, rgba(' . $preloader_foreground_rgb . ',0) 70%)';
    
	/** 
	 * NOTE: Keep CSS formatting unchanged (single whitespaces will not be minified, only new-lines and tab-indents)
	 */
	ob_start();
?>
<style>
/* Variables
--------------------------------------------------------------- */
:root
{   
    --fugu--font-size-xsmall:<?php echo intval( $fugu_theme_options['font_size_xsmall'] ); ?>px;
    --fugu--font-size-small:<?php echo intval( $fugu_theme_options['font_size_small'] ); ?>px;
    --fugu--font-size-medium:<?php echo intval( $fugu_theme_options['font_size_medium'] ); ?>px;
    --fugu--font-size-large:<?php echo intval( $fugu_theme_options['font_size_large'] ); ?>px;
    --fugu--color-font:<?php echo esc_attr( $fugu_theme_options['main_font_color'] ); ?>;
    --fugu--color-font-strong:<?php echo esc_attr( $fugu_theme_options['font_strong_color'] ); ?>;
    --fugu--color-font-highlight:<?php echo esc_attr( $fugu_theme_options['highlight_color'] ); ?>;
    --fugu--color-border:<?php echo esc_attr( $fugu_theme_options['borders_color'] ); ?>;
    --fugu--color-divider:<?php echo esc_attr( $fugu_theme_options['dividers_color'] ); ?>;
    --fugu--color-button:<?php echo esc_attr( $fugu_theme_options['button_font_color'] ); ?>;
	--fugu--color-button-background:<?php echo esc_attr( $fugu_theme_options['button_background_color'] ); ?>;
    --fugu--color-body-background:<?php echo esc_attr( $fugu_theme_options['main_background_color'] ); ?>;
    --fugu--border-radius-container:<?php echo intval( $fugu_theme_options['border_radius_container'] ); ?>px;
    --fugu--border-radius-image:<?php echo intval( $fugu_theme_options['border_radius_image'] ); ?>px;
    --fugu--border-radius-image-fullwidth:<?php echo intval( apply_filters( 'fugu_border_radius_image_fullwidth', 0 ) ); ?>px;
    --fugu--border-radius-inputs:<?php echo intval( $fugu_theme_options['border_radius_form_inputs'] ); ?>px;
    --fugu--border-radius-button:<?php echo intval( $fugu_theme_options['border_radius_button'] ); ?>px;
    --fugu--mobile-menu-color-font:<?php echo esc_attr( $fugu_theme_options['slide_menu_font_color'] ); ?>;
    --fugu--mobile-menu-color-font-hover:<?php echo esc_attr( $fugu_theme_options['slide_menu_font_highlight_color'] ); ?>;
    --fugu--mobile-menu-color-border:<?php echo esc_attr( $fugu_theme_options['slide_menu_border_color'] ); ?>;
    --fugu--mobile-menu-color-background:<?php echo esc_attr( $fugu_theme_options['slide_menu_background_color'] ); ?>;
    --fugu--shop-preloader-color:<?php echo esc_attr( $preloader_background_color ); ?>;
    --fugu--shop-preloader-gradient:<?php echo esc_attr( $preloader_foreground_gradient ); ?>;
    --fugu--shop-rating-color:<?php echo esc_attr( $fugu_theme_options['shop_rating_color'] ); ?>;
    --fugu--single-product-background-color:<?php echo esc_attr( $fugu_theme_options['single_product_background_color'] ); ?>;
    --fugu--single-product-background-color-mobile:<?php echo esc_attr( $fugu_theme_options['single_product_background_color_mobile'] ); ?>;
    --fugu--single-product-mobile-gallery-width:<?php echo intval( $fugu_theme_options['product_image_max_size'] ); ?>px;
}
/* Typography
--------------------------------------------------------------- */
<?php
echo $body_font_css;

if ( $headings_font_enabled ) :
?>
h1,
h2,
h3,
h4,
h5,
h6,
.fugu-alt-font
{
	font-family:"<?php echo esc_attr( $headings_font ); ?>",sans-serif;
}
<?php endif; ?>

/* Typography: Header Menu
--------------------------------------------------------------- */
/* style.css */
.fugu-menu li a
{
    <?php if ( $header_font_enabled ) : ?>
	font-family:"<?php echo esc_attr( $header_font ); ?>",sans-serif;
    <?php endif; ?>
	font-size:<?php echo intval( $fugu_theme_options['font_size_header_menu'] ); ?>px;
    font-weight:<?php echo esc_attr( $fugu_theme_options['font_weight_header_menu'] ); ?>;
    <?php if ( ! empty( $fugu_theme_options['letter_spacing_header_menu'] ) ) : ?>
    letter-spacing:<?php echo intval( $fugu_theme_options['letter_spacing_header_menu'] ); ?>px;
    <?php endif; ?>
}

/* Typography: Mobile Menu
--------------------------------------------------------------- */
/* style.css */
#fugu-mobile-menu .menu > li > a
{
    <?php if ( $header_font_enabled ) : ?>
	font-family:"<?php echo esc_attr( $header_font ); ?>",sans-serif;
    <?php endif; ?>
    /*font-size:<?php echo intval( $fugu_theme_options['font_size_mobile_menu'] ); ?>px;*/
    font-weight:<?php echo esc_attr( $fugu_theme_options['font_weight_mobile_menu'] ); ?>;
    <?php if ( ! empty( $fugu_theme_options['letter_spacing_mobile_menu'] ) ) : ?>
    letter-spacing:<?php echo intval( $fugu_theme_options['letter_spacing_mobile_menu'] ); ?>px;
    <?php endif; ?>
}
#fugu-mobile-menu-main-ul.menu > li > a
{
    font-size:<?php echo intval( $fugu_theme_options['font_size_mobile_menu'] ); ?>px;
}
#fugu-mobile-menu-secondary-ul.menu li a,
#fugu-mobile-menu .sub-menu a
{
    font-size:<?php echo intval( $fugu_theme_options['font_size_mobile_menu_secondary'] ); ?>px;
}

/* Typography: Body Text - Large
--------------------------------------------------------------- */
/* fugu-js_composer.css */
.vc_tta.vc_tta-accordion .vc_tta-panel-title > a,
.vc_tta.vc_general .vc_tta-tab > a,
/* elements.css */
.fugu-team-member-content h2,
.fugu-post-slider-content h3,
.vc_pie_chart .wpb_pie_chart_heading,
.wpb_content_element .wpb_tour_tabs_wrapper .wpb_tabs_nav a,
.wpb_content_element .wpb_accordion_header a,
/* shop.css */
#order_review .shop_table tfoot .order-total,
#order_review .shop_table tfoot .order-total,
.cart-collaterals .shop_table tr.order-total,
.shop_table.cart .fugu-product-details a,
#fugu-shop-sidebar-popup #fugu-shop-search input,
.fugu-shop-categories li a,
.fugu-shop-filter-menu li a,
.woocommerce-message,
.woocommerce-info,
.woocommerce-error,
/* style.css */
blockquote,
.commentlist .comment .comment-text .meta strong,
.fugu-related-posts-content h3,
.fugu-blog-no-results h1,
.fugu-term-description,
.fugu-blog-categories-list li a,
.fugu-blog-categories-toggle li a,
.fugu-blog-heading h1,
#fugu-mobile-menu-top-ul .fugu-mobile-menu-item-search input
{
	font-size:<?php echo intval( $fugu_theme_options['font_size_large'] ); ?>px;
}
@media all and (max-width:768px)
{
    /* elements.css */
	.vc_toggle_title h3
    {
		font-size:<?php echo intval( $fugu_theme_options['font_size_large'] ); ?>px;
	}
}
@media all and (max-width:400px)
{
    /* shop.css */
    #fugu-shop-search input
    {
        font-size:<?php echo intval( $fugu_theme_options['font_size_large'] ); ?>px;
    }
}

/* Typography: Body Text - Medium
--------------------------------------------------------------- */
/* elements.css */
.add_to_cart_inline .add_to_cart_button,
.add_to_cart_inline .amount,
.fugu-product-category-text > a,
.fugu-testimonial-description,
.fugu-feature h3,
.fugu_btn,
.vc_toggle_content,
.fugu-message-box,
.wpb_text_column,
/* shop.css */
#fugu-wishlist-table ul li.title .woocommerce-loop-product__title,
.fugu-order-track-top p,
.customer_details h3,
.woocommerce-order-details .order_details tbody,
.woocommerce-MyAccount-content .shop_table tr th,
.woocommerce-MyAccount-navigation ul li a,
.fugu-MyAccount-user-info .fugu-username,
.fugu-MyAccount-dashboard,
.fugu-myaccount-lost-reset-password h2,
.fugu-login-form-divider span,
.woocommerce-thankyou-order-details li strong,
.woocommerce-order-received h3,
#order_review .shop_table tbody .product-name,
.woocommerce-checkout .fugu-coupon-popup-wrap .fugu-shop-notice,
.fugu-checkout-login-coupon .fugu-shop-notice,
.shop_table.cart .fugu-product-quantity-pricing .product-subtotal,
.shop_table.cart .product-quantity,
.shop_attributes tr th,
.shop_attributes tr td,
#tab-description,
.woocommerce-tabs .tabs li a,
.woocommerce-product-details__short-description,
.fugu-shop-no-products h3,
.fugu-infload-controls a,
#fugu-shop-browse-wrap .term-description,
.list_nosep .fugu-shop-categories .fugu-shop-sub-categories li a,
.fugu-shop-taxonomy-text .term-description,
.fugu-shop-loop-details h3,
.woocommerce-loop-category__title,
/* style.css */
div.wpcf7-response-output,
.wpcf7 .wpcf7-form-control,
.widget_search button,
.widget_product_search #searchsubmit,
#wp-calendar caption,
.widget .fugu-widget-title,
.post .entry-content,
.comment-form p label,
.no-comments,
.commentlist .pingback p,
.commentlist .trackback p,
.commentlist .comment .comment-text .description,
.fugu-search-results .fugu-post-content,
.post-password-form > p:first-child,
.fugu-post-pagination a .long-title,
.fugu-blog-list .fugu-post-content,
.fugu-blog-grid .fugu-post-content,
.fugu-blog-classic .fugu-post-content,
.fugu-blog-pagination a,
.fugu-blog-categories-list.columns li a,
.page-numbers li a,
.page-numbers li span,
#fugu-widget-panel .total,
#fugu-widget-panel .fugu-cart-panel-item-price .amount,
#fugu-widget-panel .quantity .qty,
#fugu-widget-panel .fugu-cart-panel-quantity-pricing > span.quantity,
#fugu-widget-panel .product-quantity,
.fugu-cart-panel-product-title,
#fugu-widget-panel .product_list_widget .empty,
#fugu-cart-panel-loader h5,
.fugu-widget-panel-header,
.button,
input[type=submit]
{
	font-size:<?php echo intval( $fugu_theme_options['font_size_medium'] ); ?>px;
}
@media all and (max-width:991px)
{
    /* shop.css */
    #fugu-shop-sidebar .widget .fugu-widget-title,
	.fugu-shop-categories li a
    {
		font-size:<?php echo intval( $fugu_theme_options['font_size_medium'] ); ?>px;
	}
}
@media all and (max-width:768px)
{
    /* fugu-js_composer.css */
    .vc_tta.vc_tta-accordion .vc_tta-panel-title > a,
    .vc_tta.vc_tta-tabs.vc_tta-tabs-position-left .vc_tta-tab > a,
    .vc_tta.vc_tta-tabs.vc_tta-tabs-position-top .vc_tta-tab > a,
    /* elements.css */
    .wpb_content_element .wpb_tour_tabs_wrapper .wpb_tabs_nav a,
	.wpb_content_element .wpb_accordion_header a,
    /* style.css */
	.fugu-term-description
    {
		font-size:<?php echo intval( $fugu_theme_options['font_size_medium'] ); ?>px;
	}
}
@media all and (max-width:550px)
{
    /* shop.css */
    .shop_table.cart .fugu-product-details a,
    .fugu-shop-notice,
    /* style.css */
    .fugu-related-posts-content h3
    {
        font-size:<?php echo intval( $fugu_theme_options['font_size_medium'] ); ?>px;
    }
}
@media all and (max-width:400px)
{
    /* elements.css */
    .fugu-product-category-text .fugu-product-category-heading,
    .fugu-team-member-content h2,
    /* shop.css */
    #fugu-wishlist-empty h1,
    .cart-empty,
    .fugu-shop-filter-menu li a,
    /* style.css */
	.fugu-blog-categories-list li a
    {
		font-size:<?php echo intval( $fugu_theme_options['font_size_medium'] ); ?>px;
	}
}

/* Typography: Body Text - Small
--------------------------------------------------------------- */
/* elements.css */
.vc_progress_bar .vc_single_bar .vc_label,
/* shop.css */
.woocommerce-tabs .tabs li a span,
#fugu-shop-sidebar-popup-reset-button,
#fugu-shop-sidebar-popup .fugu-shop-sidebar .widget:last-child .fugu-widget-title,
#fugu-shop-sidebar-popup .fugu-shop-sidebar .widget .fugu-widget-title,
.woocommerce-loop-category__title .count,
/* style.css */
span.wpcf7-not-valid-tip,
.widget_rss ul li .rss-date,
.wp-caption-text,
.comment-respond h3 #cancel-comment-reply-link,
.fugu-blog-categories-toggle li .count,
.fugu-menu-wishlist-count,
.fugu-menu li.fugu-menu-offscreen .fugu-menu-cart-count,
.fugu-menu-cart .count,
.fugu-menu .sub-menu li a,
body
{
	font-size:<?php echo intval( $fugu_theme_options['font_size_small'] ); ?>px;
}
@media all and (max-width:768px)
{
    /* style.css */
	.wpcf7 .wpcf7-form-control
    {
		font-size:<?php echo intval( $fugu_theme_options['font_size_small'] ); ?>px;
	}
}
@media all and (max-width:400px)
{
    /* style.css */
    .fugu-blog-grid .fugu-post-content,
    .header-mobile-default .fugu-menu-cart.no-icon .count
    {
        font-size:<?php echo intval( $fugu_theme_options['font_size_small'] ); ?>px;
    }
}

/* Typography: Body Text - Extra Small
--------------------------------------------------------------- */
/* shop.css */
#fugu-wishlist-table .fugu-variations-list,
.fugu-MyAccount-user-info .fugu-logout-button.border,
#order_review .place-order noscript,
#payment .payment_methods li .payment_box,
#order_review .shop_table tfoot .woocommerce-remove-coupon,
.cart-collaterals .shop_table tr.cart-discount td a,
#fugu-shop-sidebar-popup #fugu-shop-search-notice,
.wc-item-meta,
.variation,
.woocommerce-password-hint,
.woocommerce-password-strength,
.fugu-validation-inline-notices .form-row.woocommerce-invalid-required-field:after
{
    font-size:<?php echo intval( $fugu_theme_options['font_size_xsmall'] ); ?>px;
}

/* Typography: Body - Style
--------------------------------------------------------------- */
body
{
    font-weight:<?php echo esc_attr( $fugu_theme_options['font_weight_body'] ); ?>;
    <?php if ( ! empty( $fugu_theme_options['letter_spacing_body'] ) ) : ?>
    letter-spacing:<?php echo intval( $fugu_theme_options['letter_spacing_body'] ); ?>px;
    <?php endif; ?>
}

/* Typography: Headings - Style
--------------------------------------------------------------- */
h1, .h1-size
{
    font-weight:<?php echo esc_attr( $fugu_theme_options['font_weight_h1'] ); ?>;
    <?php if ( ! empty( $fugu_theme_options['letter_spacing_h1'] ) ) : ?>
    letter-spacing:<?php echo intval( $fugu_theme_options['letter_spacing_h1'] ); ?>px;
    <?php endif; ?>
}
h2, .h2-size
{
    font-weight:<?php echo esc_attr( $fugu_theme_options['font_weight_h2'] ); ?>;
    <?php if ( ! empty( $fugu_theme_options['letter_spacing_h2'] ) ) : ?>
    letter-spacing:<?php echo intval( $fugu_theme_options['letter_spacing_h2'] ); ?>px;
    <?php endif; ?>
}
h3, .h3-size
{
    font-weight:<?php echo esc_attr( $fugu_theme_options['font_weight_h3'] ); ?>;
    <?php if ( ! empty( $fugu_theme_options['letter_spacing_h3'] ) ) : ?>
    letter-spacing:<?php echo intval( $fugu_theme_options['letter_spacing_h3'] ); ?>px;
    <?php endif; ?>
}
h4, .h4-size,
h5, .h5-size,
h6, .h6-size
{
    font-weight:<?php echo esc_attr( $fugu_theme_options['font_weight_h456'] ); ?>;
    <?php if ( ! empty( $fugu_theme_options['letter_spacing_h456'] ) ) : ?>
    letter-spacing:<?php echo intval( $fugu_theme_options['letter_spacing_h456'] ); ?>px;
    <?php endif; ?>
}
    
/* Typography: Color
--------------------------------------------------------------- */
/* style.css */
body
{
	color:<?php echo esc_attr( $fugu_theme_options['main_font_color'] ); ?>;
}
/* fugu-portfolio.css */
.fugu-portfolio-single-back a span {
    background:<?php echo esc_attr( $fugu_theme_options['main_font_color'] ); ?>;
}

/* magnific-popup.css */
.mfp-close,
/* elements.css */
.wpb_content_element .wpb_tour_tabs_wrapper .wpb_tabs_nav li.ui-tabs-active a,
.vc_pie_chart .vc_pie_chart_value,
.vc_progress_bar .vc_single_bar .vc_label .vc_label_units,
.fugu-testimonial-description,
/* shop.css */
.form-row label,
.woocommerce-form__label,
#fugu-shop-search-close:hover,
.products .price .amount,
.fugu-shop-loop-actions > a,
.fugu-shop-loop-actions > a:active,
.fugu-shop-loop-actions > a:focus,
.fugu-infload-controls a,
.woocommerce-breadcrumb a, .woocommerce-breadcrumb span,
.variations,
.woocommerce-grouped-product-list-item__label a,
.woocommerce-grouped-product-list-item__price ins .amount,
.woocommerce-grouped-product-list-item__price > .amount,
.fugu-quantity-wrap .quantity .fugu-qty-minus,
.fugu-quantity-wrap .quantity .fugu-qty-plus,
.product .summary .single_variation_wrap .fugu-quantity-wrap label:not(.fugu-qty-label-abbrev),
.woocommerce-tabs .tabs li.active a,
.shop_attributes th,
.product_meta,
.shop_table.cart .fugu-product-details a,
.shop_table.cart .product-quantity,
.shop_table.cart .fugu-product-quantity-pricing .product-subtotal,
.shop_table.cart .product-remove a,
.cart-collaterals,
.fugu-cart-empty,
#order_review .shop_table,
#payment .payment_methods li label,
.woocommerce-thankyou-order-details li strong,
.wc-bacs-bank-details li strong,
.fugu-MyAccount-user-info .fugu-username strong,
.woocommerce-MyAccount-navigation ul li a:hover,
.woocommerce-MyAccount-navigation ul li.is-active a,
.woocommerce-table--order-details,
#fugu-wishlist-empty .note i,
/* style.css */
a.dark,
a:hover,
.fugu-blog-heading h1 strong,
.fugu-post-header .fugu-post-meta a,
.fugu-post-pagination a,
.commentlist > li .comment-text .meta strong,
.commentlist > li .comment-text .meta strong a,
.comment-form p label,
.entry-content strong,
blockquote,
blockquote p,
.widget_search button,
.widget_product_search #searchsubmit,
.widget_recent_comments ul li .comment-author-link,
.widget_recent_comments ul li:before
{
    color:<?php echo esc_attr( $fugu_theme_options['font_strong_color'] ); ?>;
}
/* shop.css */
@media all and (max-width: 991px)
{
    .fugu-shop-menu .fugu-shop-filter-menu li a:hover,
    .fugu-shop-menu .fugu-shop-filter-menu li.active a,
    #fugu-shop-sidebar .widget.show .fugu-widget-title,
	#fugu-shop-sidebar .widget .fugu-widget-title:hover
    {
        color:<?php echo esc_attr( $fugu_theme_options['font_strong_color'] ); ?>;
    }
}
/* fugu-portfolio.css */
.fugu-portfolio-single-back a:hover span
{
    background:<?php echo esc_attr( $fugu_theme_options['font_strong_color'] ); ?>;
}

/* elements.css */
.wpb_content_element .wpb_tour_tabs_wrapper .wpb_tabs_nav a,
.wpb_content_element .wpb_accordion_header a,
/* shop.css */
#fugu-shop-search-close,
.woocommerce-breadcrumb,
.fugu-single-product-menu a,
.star-rating:before,
.woocommerce-tabs .tabs li a,
.product_meta span.sku,
.product_meta a,
/* style.css */
.fugu-post-meta,
.fugu-post-pagination a .short-title,
.commentlist > li .comment-text .meta time
{
    color:<?php echo esc_attr( $fugu_theme_options['font_subtle_color'] ); ?>;
}

/* elements.css */
.vc_toggle_title i,
/* shop.css */
#fugu-wishlist-empty p.icon i,
/* style.css */
h1
{
	color:<?php echo esc_attr( $fugu_theme_options['heading_1_color'] ); ?>;
}
h2
{
	color:<?php echo esc_attr( $fugu_theme_options['heading_2_color'] ); ?>;
}
h3
{
	color:<?php echo esc_attr( $fugu_theme_options['heading_3_color'] ); ?>;
}
h4, h5, h6
{
	color:<?php echo esc_attr( $fugu_theme_options['heading_456_color'] ); ?>;
}

/* Highlight color: Font
--------------------------------------------------------------- */
a,
a.dark:hover,
a.gray:hover,
a.invert-color:hover,
.fugu-highlight-text,
.fugu-highlight-text h1,
.fugu-highlight-text h2,
.fugu-highlight-text h3,
.fugu-highlight-text h4,
.fugu-highlight-text h5,
.fugu-highlight-text h6,
.fugu-highlight-text p,
.fugu-menu-wishlist-count,
.fugu-menu-cart a .count,
.fugu-menu li.fugu-menu-offscreen .fugu-menu-cart-count,
.page-numbers li span.current,
.page-numbers li a:hover,
.fugu-blog .sticky .fugu-post-thumbnail:before,
.fugu-blog .category-sticky .fugu-post-thumbnail:before,
.fugu-blog-categories-list li a:hover,
.fugu-blog-categories ul li.current-cat a,
.widget ul li.active,
.widget ul li a:hover,
.widget ul li a:focus,
.widget ul li a.active,
#wp-calendar tbody td a,
/* elements.css */
.fugu-banner-link.type-txt:hover,
.fugu-banner.text-color-light .fugu-banner-link.type-txt:hover,
.fugu-portfolio-categories li.current a,
.add_to_cart_inline ins,
.fugu-product-categories.layout-separated .product-category:hover .fugu-product-category-text > a,
/* shop.css */
.woocommerce-breadcrumb a:hover,
.products .price ins .amount,
.products .price ins,
.no-touch .fugu-shop-loop-actions > a:hover,
.fugu-shop-menu ul li a:hover,
.fugu-shop-menu ul li.current-cat > a,
.fugu-shop-menu ul li.active a,
.fugu-shop-heading span,
.fugu-single-product-menu a:hover,
.woocommerce-product-gallery__trigger:hover,
.woocommerce-product-gallery .flex-direction-nav a:hover,
.product-summary .price .amount,
.product-summary .price ins,
.product .summary .price .amount,
.fugu-product-wishlist-button-wrap a.added:active,
.fugu-product-wishlist-button-wrap a.added:focus,
.fugu-product-wishlist-button-wrap a.added:hover,
.fugu-product-wishlist-button-wrap a.added,
.woocommerce-tabs .tabs li a span,
.product_meta a:hover,
.fugu-order-view .commentlist li .comment-text .meta,
.fugu_widget_price_filter ul li.current,
.post-type-archive-product .widget_product_categories .product-categories > li:first-child > a,
.widget_product_categories ul li.current-cat > a,
.widget_layered_nav ul li.chosen a,
.widget_layered_nav_filters ul li.chosen a,
.product_list_widget li ins .amount,
.woocommerce.widget_rating_filter .wc-layered-nav-rating.chosen > a,
.fugu-wishlist-button.added:active,
.fugu-wishlist-button.added:focus,
.fugu-wishlist-button.added:hover,
.fugu-wishlist-button.added,
/* slick-theme.css */
.slick-prev:not(.slick-disabled):hover,
.slick-next:not(.slick-disabled):hover,
/* Flickity - style.css */
.flickity-button:hover,
/* fugu-portfolio.css */
.fugu-portfolio-categories li a:hover
{
	color:<?php echo esc_attr( $fugu_theme_options['highlight_color'] ); ?>;
}

/* Highlight color: Border
--------------------------------------------------------------- */
.fugu-blog-categories ul li.current-cat a,
/* elements.css */
.fugu-portfolio-categories li.current a,
/* shop.css */
.woocommerce-product-gallery.pagination-enabled .flex-control-thumbs li img.flex-active,
.widget_layered_nav ul li.chosen a,
.widget_layered_nav_filters ul li.chosen a,
/* slick-theme.css */
.slick-dots li.slick-active button,
/* Flickity - style.css */
.flickity-page-dots .dot.is-selected
{
	border-color:<?php echo esc_attr( $fugu_theme_options['highlight_color'] ); ?>;
}

/* Highlight color: Background
--------------------------------------------------------------- */
/*.blockUI.blockOverlay:after,
.fugu-loader:after,*/
.fugu-image-overlay:before,
.fugu-image-overlay:after,
.gallery-icon:before,
.gallery-icon:after,
.widget_tag_cloud a:hover,
.widget_product_tag_cloud a:hover
{
	background:<?php echo esc_attr( $fugu_theme_options['highlight_color'] ); ?>;
}
@media all and (max-width:400px)
{	
    /* shop.css */
    .woocommerce-product-gallery.pagination-enabled .flex-control-thumbs li img.flex-active,
    /* slick-theme.css */
	.slick-dots li.slick-active button,
    /* Flickity - style.css */
    .flickity-page-dots .dot.is-selected
	{
		background:<?php echo esc_attr( $fugu_theme_options['highlight_color'] ); ?>;
	}
}

/* Borders & Dividers
--------------------------------------------------------------- */
/* style.css */
.header-border-1 .fugu-header,
.fugu-blog-list .fugu-post-divider,
#fugu-blog-pagination.infinite-load,
.fugu-post-pagination,
.no-post-comments .fugu-related-posts,
.fugu-footer-widgets.has-border,
/* shop.css */
#fugu-shop-browse-wrap.fugu-shop-description-borders .term-description,
.fugu-shop-sidebar-default #fugu-shop-sidebar .widget,
.products.grid-list li:not(:last-child) .fugu-shop-loop-product-wrap,
.fugu-infload-controls a,
.woocommerce-tabs,
.upsells,
.related,
.shop_table.cart tr td,
#order_review .shop_table tbody tr th,
#order_review .shop_table tbody tr td,
#payment .payment_methods,
#payment .payment_methods li,
.woocommerce-MyAccount-orders tr td,
.woocommerce-MyAccount-orders tr:last-child td,
.woocommerce-table--order-details tbody tr td,
.woocommerce-table--order-details tbody tr:first-child td,
.woocommerce-table--order-details tfoot tr:last-child td,
.woocommerce-table--order-details tfoot tr:last-child th,
#fugu-wishlist-table > ul > li,
#fugu-wishlist-table > ul:first-child > li,
/* elements.css */
.wpb_accordion .wpb_accordion_section,
/* fugu-portfolio.css */
.fugu-portfolio-single-footer
{
    border-color:<?php echo esc_attr( $fugu_theme_options['borders_color'] ); ?>;
}
/* style.css */
.fugu-search-results .fugu-post-divider
{
    background:<?php echo esc_attr( $fugu_theme_options['borders_color'] ); ?>;
}

/* style.css */
.fugu-blog-categories-list li span,
/* fugu-portfolio.css */
.fugu-portfolio-categories li span
{
    color: <?php echo esc_attr( $fugu_theme_options['dividers_color'] ); ?>;
}
/* style.css */
.fugu-post-meta:before,
/* elements.css */
.fugu-testimonial-author span:before
{
    background:<?php echo esc_attr( $fugu_theme_options['dividers_color'] ); ?>;
}

/* Border radius
--------------------------------------------------------------- */
.fugu-border-radius
{
    border-radius:<?php echo intval( $fugu_theme_options['border_radius_container'] ); ?>px;
}
@media (max-width:<?php echo intval( $border_radius_image_fullwidth_breakpoint ); ?>px)
{
    .fugu-page-wrap .elementor-column-gap-no .fugu-banner-slider,
    .fugu-page-wrap .elementor-column-gap-no .fugu-banner,
    .fugu-page-wrap .elementor-column-gap-no img,
    .fugu-page-wrap .fugu-row-full-nopad .fugu-banner-slider,
    .fugu-page-wrap .fugu-row-full-nopad .fugu-banner,
    .fugu-page-wrap .fugu-row-full-nopad .fugu-banner-image,
    .fugu-page-wrap .fugu-row-full-nopad img
    {
        border-radius:var(--fugu--border-radius-image-fullwidth);
    }
}

/* Button
--------------------------------------------------------------- */
.button,
input[type=submit],
.widget_tag_cloud a, .widget_product_tag_cloud a,
/* elements.css */
.add_to_cart_inline .add_to_cart_button,
/* shop.css */
#fugu-shop-sidebar-popup-button,
.products.grid-list .fugu-shop-loop-actions > a:first-of-type,
.products.grid-list .fugu-shop-loop-actions > a:first-child,
#order_review .shop_table tbody .product-name .product-quantity
{
	color:<?php echo esc_attr( $fugu_theme_options['button_font_color'] ); ?>;
	background-color:<?php echo esc_attr( $fugu_theme_options['button_background_color'] ); ?>;
}

.button:hover,
input[type=submit]:hover
/* shop.css */
.products.grid-list .fugu-shop-loop-actions > a:first-of-type,
.products.grid-list .fugu-shop-loop-actions > a:first-child
{
	color:<?php echo esc_attr( $fugu_theme_options['button_font_color'] ); ?>;
}

/* Button - Border
--------------------------------------------------------------- */
#fugu-blog-pagination a,
.button.border
{
	border-color:<?php echo esc_attr( $fugu_theme_options['button_border_color'] ); ?>;
}
#fugu-blog-pagination a,
#fugu-blog-pagination a:hover,
.button.border,
.button.border:hover
{
	color:<?php echo esc_attr( $fugu_theme_options['button_border_font_color'] ); ?>;
}
#fugu-blog-pagination a:not([disabled]):hover,
.button.border:not([disabled]):hover
{
	color:<?php echo esc_attr( $fugu_theme_options['button_border_font_color'] ); ?>;
    border-color:<?php echo esc_attr( $fugu_theme_options['button_border_hover_color'] ); ?>;
}

    
/* Quantity
--------------------------------------------------------------- */
/* shop.css */
.product-summary .quantity .fugu-qty-minus,
.product-summary .quantity .fugu-qty-plus
{
	color:<?php echo esc_attr( $fugu_theme_options['button_background_color'] ); ?>;
}

<?php if ( $fugu_theme_options['full_width_layout'] ) : ?>
/* Grid - Full width
--------------------------------------------------------------- */
.fugu-row
{
	max-width:none;
}
.woocommerce-cart .fugu-page-wrap-inner > .fugu-row,
.woocommerce-checkout .fugu-page-wrap-inner > .fugu-row
{
	max-width:1280px;
}
@media (min-width: 1400px)
{
	.fugu-row
	{
		padding-right:2.5%;
		padding-left:2.5%;
	}
}
<?php endif; ?>

/* Background
--------------------------------------------------------------- */
.fugu-page-wrap
{
	<?php if ( strlen( $fugu_theme_options['main_background_image']['url'] ) > 0 ) : ?>
	background-image:url("<?php echo esc_url( $fugu_theme_options['main_background_image']['url'] ); ?>");
	<?php if ( $fugu_theme_options['main_background_image_type'] == 'fixed' ) : ?>
	background-attachment:fixed;
	background-size:cover;
	<?php else : ?>
	background-repeat:repeat;
	background-position:0 0;
	<?php endif; endif; ?>
	background-color:<?php echo esc_attr( $fugu_theme_options['main_background_color'] ); ?>;
}
.fugu-divider .fugu-divider-title,
.fugu-header-search
{
    background:<?php echo esc_attr( $fugu_theme_options['main_background_color'] ); ?>;
}
.woocommerce-cart .blockOverlay,
.woocommerce-checkout .blockOverlay {
    background-color:<?php echo esc_attr( $fugu_theme_options['main_background_color'] ); ?> !important;
}
    
/* Top bar
--------------------------------------------------------------- */
.fugu-top-bar
{
    border-color:<?php echo esc_attr( $fugu_theme_options['top_bar_border_color'] ); ?>;
	background:<?php echo esc_attr( $fugu_theme_options['top_bar_background_color'] ); ?>;
}
.fugu-top-bar .fugu-top-bar-text,
.fugu-top-bar .fugu-top-bar-text a,
.fugu-top-bar .fugu-menu > li > a,
.fugu-top-bar .fugu-menu > li > a:hover,
.fugu-top-bar-social li i
{
	color:<?php echo esc_attr( $fugu_theme_options['top_bar_font_color'] ); ?>;
}

/* Header
--------------------------------------------------------------- */
.fugu-header-placeholder
{
	height:<?php echo $header_total_height_desktop; ?>px;
}
.fugu-header
{
	line-height:<?php echo $header_height_desktop; ?>px;
	padding-top:<?php echo intval( $fugu_theme_options['header_spacing_top'] ); ?>px;
	padding-bottom:<?php echo intval( $fugu_theme_options['header_spacing_bottom'] ); ?>px;
	background:<?php echo esc_attr( $fugu_theme_options['header_background_color'] ); ?>;
}
.home .fugu-header
{
	background:<?php echo esc_attr( $fugu_theme_options['header_home_background_color'] ); ?>;
}
.mobile-menu-open .fugu-header
{
	background:<?php echo esc_attr( $fugu_theme_options['header_slide_menu_open_background_color'] ); ?> !important;
}
.header-on-scroll .fugu-header,
.home.header-transparency.header-on-scroll .fugu-header
{
	background:<?php echo esc_attr( $fugu_theme_options['header_float_background_color'] ); ?>;
}
.header-on-scroll .fugu-header:not(.static-on-scroll)
{
    padding-top:<?php echo intval( $fugu_theme_options['header_spacing_top_alt'] ); ?>px;
	padding-bottom:<?php echo intval( $fugu_theme_options['header_spacing_bottom_alt'] ); ?>px;
}
.fugu-header.stacked .fugu-header-logo,
.fugu-header.stacked-logo-centered .fugu-header-logo,
.fugu-header.stacked-centered .fugu-header-logo
{
    padding-bottom:<?php echo intval( $fugu_theme_options['logo_spacing_bottom'] ); ?>px;
}
.fugu-header-logo svg,
.fugu-header-logo img
{
	height:<?php echo $logo_height_desktop; ?>px;
}
@media all and (max-width:991px)
{
    .fugu-header-placeholder
    {
        height:<?php echo $header_total_height_tablet; ?>px;
    }
    .fugu-header
    {
        line-height:<?php echo $header_height_tablet; ?>px;
        padding-top:<?php echo intval( $fugu_theme_options['header_spacing_top_alt'] ); ?>px;
        padding-bottom:<?php echo intval( $fugu_theme_options['header_spacing_bottom_alt'] ); ?>px;
	}
    .fugu-header.stacked .fugu-header-logo,
    .fugu-header.stacked-logo-centered .fugu-header-logo,
    .fugu-header.stacked-centered .fugu-header-logo
    {
        padding-bottom:0px;
    }
    .fugu-header-logo svg,
    .fugu-header-logo img
	{
		height:<?php echo $logo_height_tablet; ?>px;
	}
}
@media all and (max-width:400px)
{
    .fugu-header-placeholder
    {
        height:<?php echo $header_total_height_mobile; ?>px;
    }
    .fugu-header
    {
        line-height:<?php echo $header_height_mobile; ?>px;
	}
    .fugu-header-logo svg,
	.fugu-header-logo img
	{
		height:<?php echo $logo_height_mobile; ?>px;
	}
}

/* Menus
--------------------------------------------------------------- */
.fugu-menu li a
{
	color:<?php echo esc_attr( $fugu_theme_options['header_navigation_color'] ); ?>;
}
.fugu-menu li a:hover
{
	color:<?php echo esc_attr( $fugu_theme_options['header_navigation_highlight_color'] ); ?>;
}

/* Menu: Header transparency */
.header-transparency-light:not(.header-on-scroll):not(.mobile-menu-open) #fugu-main-menu-ul > li > a,
.header-transparency-light:not(.header-on-scroll):not(.mobile-menu-open) #fugu-right-menu-ul > li > a
{
	color:<?php echo esc_attr( $fugu_theme_options['header_transparency_light_navigation_color'] ); ?>;
}
.header-transparency-dark:not(.header-on-scroll):not(.mobile-menu-open) #fugu-main-menu-ul > li > a,
.header-transparency-dark:not(.header-on-scroll):not(.mobile-menu-open) #fugu-right-menu-ul > li > a
{
	color:<?php echo esc_attr( $fugu_theme_options['header_transparency_dark_navigation_color'] ); ?>;
}
.header-transparency-light:not(.header-on-scroll):not(.mobile-menu-open) #fugu-main-menu-ul > li > a:hover,
.header-transparency-light:not(.header-on-scroll):not(.mobile-menu-open) #fugu-right-menu-ul > li > a:hover
{
	color:<?php echo esc_attr( $fugu_theme_options['header_transparency_light_navigation_highlight_color'] ); ?>;
}
.header-transparency-dark:not(.header-on-scroll):not(.mobile-menu-open) #fugu-main-menu-ul > li > a:hover,
.header-transparency-dark:not(.header-on-scroll):not(.mobile-menu-open) #fugu-right-menu-ul > li > a:hover
{
	color:<?php echo esc_attr( $fugu_theme_options['header_transparency_dark_navigation_highlight_color'] ); ?>;
}
.no-touch .header-transparency-light:not(.header-on-scroll):not(.mobile-menu-open) .fugu-header:hover
{
    background-color:<?php echo esc_attr( $fugu_theme_options['header_transparency_light_hover_background_color'] ); ?>;
}
.no-touch .header-transparency-dark:not(.header-on-scroll):not(.mobile-menu-open) .fugu-header:hover
{
    background-color:<?php echo esc_attr( $fugu_theme_options['header_transparency_dark_hover_background_color'] ); ?>;
}

/* Menu: Dropdown */
.fugu-menu .sub-menu
{
	background:<?php echo esc_attr( $fugu_theme_options['dropdown_menu_background_color'] ); ?>;
}
.fugu-menu .sub-menu li a
{
	color:<?php echo esc_attr( $fugu_theme_options['dropdown_menu_font_color'] ); ?>;
}
.fugu-menu .megamenu > .sub-menu > ul > li:not(.fugu-menu-item-has-image) > a,
.fugu-menu .sub-menu li a .label,
.fugu-menu .sub-menu li a:hover
{
	color:<?php echo esc_attr( $fugu_theme_options['dropdown_menu_font_highlight_color'] ); ?>;
}

/* Menus: Megamenu - Full width */
.fugu-menu .megamenu.full > .sub-menu
{
    padding-top:<?php echo intval( $fugu_theme_options['megamenu_full_top_spacing'] ); ?>px;
    padding-bottom:<?php echo intval( $fugu_theme_options['megamenu_full_bottom_spacing'] ); ?>px;
    background:<?php echo esc_attr( $fugu_theme_options['dropdown_menu_full_background_color'] ); ?>;
}
.fugu-menu .megamenu.full > .sub-menu > ul
{
    max-width:<?php echo intval( $fugu_theme_options['megamenu_full_max_width'] ); ?>px;
}
.fugu-menu .megamenu.full .sub-menu li a
{
	color:<?php echo esc_attr( $fugu_theme_options['dropdown_menu_full_font_color'] ); ?>;
}
.fugu-menu .megamenu.full > .sub-menu > ul > li:not(.fugu-menu-item-has-image) > a,
.fugu-menu .megamenu.full .sub-menu li a:hover
{
	color:<?php echo esc_attr( $fugu_theme_options['dropdown_menu_full_font_highlight_color'] ); ?>;
}

/* Menus: Megamenu - Thumbnails */
.fugu-menu .megamenu > .sub-menu > ul > li.fugu-menu-item-has-image
{
    border-right-color:<?php echo esc_attr( $fugu_theme_options['dropdown_menu_thumbnails_border_color'] ); ?>;
}

/* Menu icon */
.fugu-menu-icon span
{
    background:<?php echo esc_attr( $fugu_theme_options['header_navigation_color'] ); ?>;
}
/* Menu icon: Header transparency */
.header-transparency-light:not(.header-on-scroll):not(.mobile-menu-open) .fugu-menu-icon span
{
	background:<?php echo esc_attr( $fugu_theme_options['header_transparency_light_navigation_color'] ); ?>;
}
.header-transparency-dark:not(.header-on-scroll):not(.mobile-menu-open) .fugu-menu-icon span
{
	background:<?php echo esc_attr( $fugu_theme_options['header_transparency_dark_navigation_color'] ); ?>;
}

/* Mobile menu
--------------------------------------------------------------- */
#fugu-mobile-menu-top-ul .fugu-mobile-menu-item-search input,
#fugu-mobile-menu-top-ul .fugu-mobile-menu-item-search span,
.fugu-mobile-menu-social-ul li a
{
    color:<?php echo esc_attr( $fugu_theme_options['slide_menu_font_color'] ); ?>;
}
.no-touch #fugu-mobile-menu .menu a:hover,
#fugu-mobile-menu .menu li.active > a,
#fugu-mobile-menu .menu > li.active > .fugu-menu-toggle:before,
#fugu-mobile-menu .menu a .label,
.fugu-mobile-menu-social-ul li a:hover
{
    color:<?php echo esc_attr( $fugu_theme_options['slide_menu_font_highlight_color'] ); ?>;
}

/* Footer widgets
--------------------------------------------------------------- */
.fugu-footer-widgets
{
    padding-top:<?php echo intval( $fugu_theme_options['footer_widgets_spacing_top'] ); ?>px;
    padding-bottom:<?php echo intval( $fugu_theme_options['footer_widgets_spacing_bottom'] ); ?>px;
	background-color:<?php echo esc_attr( $fugu_theme_options['footer_widgets_background_color'] ); ?>;
}
.fugu-footer-widgets,
.fugu-footer-widgets .widget ul li a,
.fugu-footer-widgets a
{
	color:<?php echo esc_attr( $fugu_theme_options['footer_widgets_font_color'] ); ?>;
}
.fugu-footer-widgets .widget .fugu-widget-title
{
	color:<?php echo esc_attr( $fugu_theme_options['footer_widgets_title_font_color'] ); ?>;
}
.fugu-footer-widgets .widget ul li a:hover,
.fugu-footer-widgets a:hover
{
	color:<?php echo esc_attr( $fugu_theme_options['footer_widgets_highlight_font_color'] ); ?>;
}
.fugu-footer-widgets .widget_tag_cloud a:hover,
.fugu-footer-widgets .widget_product_tag_cloud a:hover
{
	background:<?php echo esc_attr( $fugu_theme_options['footer_widgets_highlight_font_color'] ); ?>;
}
@media all and (max-width:991px)
{
    .fugu-footer-widgets
    {
        padding-top:<?php echo intval( $fugu_theme_options['footer_widgets_spacing_top_alt'] ); ?>px;
        padding-bottom:<?php echo intval( $fugu_theme_options['footer_widgets_spacing_bottom_alt'] ); ?>px;
    }
}

/* Footer bar
--------------------------------------------------------------- */
.fugu-footer-bar
{
	color:<?php echo esc_attr( $fugu_theme_options['footer_bar_font_color'] ); ?>;
}
.fugu-footer-bar-inner
{
	padding-top:<?php echo intval( $fugu_theme_options['footer_bar_spacing_top'] ); ?>px;
    padding-bottom:<?php echo intval( $fugu_theme_options['footer_bar_spacing_bottom'] ); ?>px;
	background-color:<?php echo esc_attr( $fugu_theme_options['footer_bar_background_color'] ); ?>;
}
.fugu-footer-bar a
{
	color:<?php echo esc_attr( $fugu_theme_options['footer_bar_font_color'] ); ?>;
}
.fugu-footer-bar a:hover
{
	color:<?php echo esc_attr( $fugu_theme_options['footer_bar_highlight_font_color'] ); ?>;
}
.fugu-footer-bar .menu > li
{
	border-bottom-color:<?php echo esc_attr( $fugu_theme_options['footer_bar_menu_border_color'] ); ?>;
}
.fugu-footer-bar-social a
{
    color:<?php echo esc_attr( $fugu_theme_options['footer_bar_social_icons_color'] ); ?>;
}
.fugu-footer-bar-social a:hover
{
    color:<?php echo esc_attr( $fugu_theme_options['footer_bar_social_icons_hover_color'] ); ?>;
}
@media all and (max-width:991px)
{
    .fugu-footer-bar-inner
    {
        padding-top:<?php echo intval( $fugu_theme_options['footer_bar_spacing_top_alt'] ); ?>px;
        padding-bottom:<?php echo intval( $fugu_theme_options['footer_bar_spacing_bottom_alt'] ); ?>px;
    }
}

/* Blog: Single post
--------------------------------------------------------------- */
.fugu-comments
{
	background:<?php echo esc_attr( $fugu_theme_options['single_post_comments_background_color'] ); ?>;
}
.fugu-comments .commentlist > li,
.fugu-comments .commentlist .pingback,
.fugu-comments .commentlist .trackback
{
	border-color:<?php echo esc_attr( $fugu_theme_options['single_post_comments_dividers_color'] ); ?>;
}
    
/* Shop
--------------------------------------------------------------- */
#fugu-shop-products-overlay,
#fugu-shop
{
	background-color:<?php echo esc_attr( $fugu_theme_options['shop_background_color'] ); ?>;
}
/* Shop - Taxonomy header */
#fugu-shop-taxonomy-header.has-image
{
    height:<?php echo intval( $fugu_theme_options['shop_taxonomy_header_image_height'] ); ?>px;
}
.fugu-shop-taxonomy-text-col
{
    max-width:<?php echo ( strlen( $fugu_theme_options['shop_taxonomy_header_text_max_width'] ) > 0 ) ? intval( $fugu_theme_options['shop_taxonomy_header_text_max_width'] ) . 'px' : 'none'; ?>;
}
.fugu-shop-taxonomy-text h1
{
    color:<?php echo esc_attr( $fugu_theme_options['shop_taxonomy_header_heading_color'] ); ?>;
}
.fugu-shop-taxonomy-text .term-description
{
    color:<?php echo esc_attr( $fugu_theme_options['shop_taxonomy_header_description_color'] ); ?>;
}
@media all and (max-width:991px)
{
    #fugu-shop-taxonomy-header.has-image
    {
        height:<?php echo intval( $fugu_theme_options['shop_taxonomy_header_image_height_tablet'] ); ?>px;
    }
}
@media all and (max-width:768px)
{
    #fugu-shop-taxonomy-header.has-image
    {
        height:<?php echo intval( $fugu_theme_options['shop_taxonomy_header_image_height_mobile'] ); ?>px;
    }
}   
/* Shop - Filters: Scrollbar */
.fugu-shop-widget-scroll
{
	/*height:<?php //echo intval( $fugu_theme_options['shop_filters_height'] ); ?>px;*/
    max-height:<?php echo intval( $fugu_theme_options['shop_filters_height'] ); ?>px;
}
/* Shop - Label: Sale */
.onsale
{
	color:<?php echo esc_attr( $fugu_theme_options['sale_flash_font_color'] ); ?>;
	background:<?php echo esc_attr( $fugu_theme_options['sale_flash_background_color'] ); ?>;
}
/* Shop - Label: Sale */
.fugu-label-itsnew
{
	color:<?php echo esc_attr( $fugu_theme_options['new_flash_font_color'] ); ?>;
	background:<?php echo esc_attr( $fugu_theme_options['new_flash_background_color'] ); ?>;
}
/* Shop - Label: Out of stock */
.products li.outofstock .fugu-shop-loop-thumbnail > .woocommerce-LoopProduct-link:after
{
    color:<?php echo esc_attr( $fugu_theme_options['outofstock_flash_font_color'] ); ?>;
    background:<?php echo esc_attr( $fugu_theme_options['outofstock_flash_background_color'] ); ?>;
}
/* Shop - Products: Thumbnail background color */
.fugu-shop-loop-thumbnail
{
	background:<?php echo esc_attr( $fugu_theme_options['shop_thumbnail_background_color'] ); ?>;
}

/* Single product
--------------------------------------------------------------- */
.fugu-featured-video-icon
{
	color:<?php echo esc_attr( $fugu_theme_options['featured_video_icon_color'] ); ?>;
	background:<?php echo esc_attr( $fugu_theme_options['featured_video_background_color'] ); ?>;
}
@media all and (max-width:1080px)
{
    .woocommerce-product-gallery.pagination-enabled .flex-control-thumbs
    {
        background-color:<?php echo esc_attr( $fugu_theme_options['main_background_color'] ); ?>;
    }
}
/* Single product - Summary: Variation controls - Color */
.fugu-variation-control.fugu-variation-control-color li i
{
    width:<?php echo intval( $fugu_theme_options['product_swatches_color_radius'] ); ?>px;
    height:<?php echo intval( $fugu_theme_options['product_swatches_color_radius'] ); ?>px;
}
/* Single product - Summary: Variation controls - Image */
.fugu-variation-control.fugu-variation-control-image li .fugu-pa-image-thumbnail-wrap
{
    width:<?php echo intval( $fugu_theme_options['product_swatches_image_radius'] ); ?>px;
    height:<?php echo intval( $fugu_theme_options['product_swatches_image_radius'] ); ?>px;
}

<?php if ( $fugu_theme_options['page_not_found_show_products'] ) : ?>
/* Page not found
--------------------------------------------------------------- */
.error404 .fugu-page-wrap
{
    background-color:<?php echo esc_attr( $fugu_theme_options['single_product_background_color'] ); ?>;
}
.fugu-page-not-found
{
    background-color:<?php echo esc_attr( $fugu_theme_options['main_background_color'] ); ?>;
}
<?php endif; ?>

/* Custom CSS
--------------------------------------------------------------- */
<?php

if ( ! class_exists( 'FUGU_Custom_Code' ) && isset( $fugu_theme_options['custom_css'] ) ) {
    echo $fugu_theme_options['custom_css'];
}
do_action( 'fugu_custom_styles' ); // Custom styles output via plugin
?>
</style>
<?php
	$styles = ob_get_clean();
	
	// Remove comments
    $styles = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $styles );
	
	// Remove new-lines, tab-indents and spaces (excluding single spaces)
	$styles = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '   ', '    ' ), '', $styles );
	
    // Remove "<style>" tags
    $styles = strip_tags( $styles );
    
    if ( $save_styles ) {
        // Save styles to WP settings db
        update_option( 'fugu_theme_custom_styles', $styles, true );
    } else {
        return $styles;
    }
}

endif;

// Redux: Options saved - https://docs.reduxframework.com/core/advanced/actions-hooks/
add_action( 'redux/options/fugu_theme_options/saved', 'fugu_custom_styles_generate', 10, 2 );
// WP Customizer: Options saved - Added "100" priority to make sure the settings are saved by Redux first
add_action( 'customize_save_after', 'fugu_custom_styles_generate', 100, 2 );


/*
 *  Make sure custom theme styles are saved
 */
function fugu_custom_styles_install() {
	if ( ! get_option( 'fugu_theme_custom_styles' ) && get_option( 'fugu_theme_options' ) ) {
		fugu_custom_styles_generate();
	}
}
// Redux: When registering the options - https://docs.reduxframework.com/core/advanced/actions-hooks/
add_action( 'redux/options/fugu_theme_options/register', 'fugu_custom_styles_install' );


/*
 *  WP Upgrader: Save custom styles after updating theme - Note: Untested with Envato Market plugin
 */
function fugu_custom_styles_generate_after_theme_update( $upgrader_object, $options ) {
    if ( $options['action'] == 'update' && $options['type'] == 'theme' ) {
        foreach( $options['themes'] as $theme_slug ) {
            if ( $theme_slug == 'savoy' ) {
                fugu_custom_styles_generate();
            }
        }
    }
}
add_action( 'upgrader_process_complete', 'fugu_custom_styles_generate_after_theme_update', 10, 2 );


/*
 *  Theme update: Make sure styles are regenerated
 */
if ( is_admin() ) {
    $styles_updated = get_option( 'fugu_theme_v310_styles_updated', false );
    if ( ! $styles_updated ) {
        fugu_custom_styles_generate();
        update_option( 'fugu_theme_v310_styles_updated', '1' );
    }
}


/*
 *  Print custom styles
 */
$include_custom_styles = apply_filters( 'fugu_include_custom_styles', true );
if ( $include_custom_styles ) {
    function fugu_custom_styles() {
        // Get custom styles
        $styles = ( is_customize_preview() ) ? fugu_custom_styles_generate( null, false ) : get_option( 'fugu_theme_custom_styles' );

        /* Translation styles - Including these here so they work with language-switchers */
        $translation_styles = '.products li.outofstock .fugu-shop-loop-thumbnail > .woocommerce-LoopProduct-link:after{content:"' . esc_html__( 'Out of stock', 'woocommerce' ) . '";}'; // Shop: "Out of stock" flash
        $translation_styles .= '.fugu-validation-inline-notices .form-row.woocommerce-invalid-required-field:after{content:"' . esc_html__( 'Required field.', 'fugu-framework' ) . '";}'; // Checkout: Form validation text
        $translation_styles .= '.theme-savoy .wc-block-cart.wp-block-woocommerce-filled-cart-block:before{content:"' . esc_html__( 'Shopping Cart', 'fugu-framework' ) . '";}'; // Cart block: Heading
        
        echo '<style type="text/css" class="fugu-custom-styles">' . $styles . '</style>' . "\n";
        echo '<style type="text/css" class="fugu-translation-styles">' . $translation_styles . '</style>' . "\n";
    }
    $custom_styles_action_priority = apply_filters( 'fugu_custom_styles_action_priority', 100 );
    add_action( 'wp_head', 'fugu_custom_styles', $custom_styles_action_priority );
}
