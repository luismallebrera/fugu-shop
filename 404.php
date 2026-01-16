<?php get_header(); ?>

<div class="fugu-page-not-found">
    <div class="fugu-row">
        <div class="col-xs-12">
            <div class="fugu-page-not-found-icon">
                <i class="fugu-font fugu-font-close2"></i>
            </div>
            <h2><?php esc_html_e( 'Page not found.', 'fugu-framework' ); ?></h2>
            <p><?php esc_html_e( 'It looks like nothing was found at this location. Click the link below to return home.', 'fugu-framework' ); ?></p>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="button"><i class="fugu-font fugu-font-arrow-left"></i> <?php esc_html_e( 'Home', 'fugu-framework' ); ?></a>
        </div>
    </div>
</div>

<?php 
    global $fugu_theme_options;
    if ( $fugu_theme_options['page_not_found_show_products'] ) :
?>
<div class="fugu-page-not-found-products">
    <div class="fugu-row">
        <div class="col-xs-12">
            <h2 class="fugu-page-not-found-products-heading"><?php esc_html_e( 'Featured products', 'woocommerce' ); ?></h2>
            
            <?php
                global $woocommerce_loop;
                $woocommerce_loop['columns_medium'] = '4';
            
                $shortcode = apply_filters( 'fugu_page_not_found_shortcode', '[featured_products per_page="4" columns="4"]' );
                echo do_shortcode( $shortcode );
            ?>
        </div>
    </div>
</div>
<?php endif; ?>

<?php get_footer(); ?>