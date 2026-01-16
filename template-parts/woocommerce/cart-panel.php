<div class="fugu-cart-panel-holder">
    <div id="fugu-cart-panel">
        <div id="fugu-cart-panel-loader">
            <span class="fugu-loader"><?php esc_html_e( 'Updating', 'woocommerce' ); ?><em>&hellip;</em></span>
        </div>

        <div class="fugu-cart-panel-header">
            <div class="fugu-cart-panel-header-inner">
                <a href="#" id="fugu-cart-panel-close">
                    <span class="fugu-cart-panel-title"><?php esc_html_e( 'Cart', 'woocommerce' ); ?></span>
                    <span class="fugu-cart-panel-close-title"><i class="fugu-font-close2"></i></span>
                </a>
            </div>
        </div>

        <div class="widget_shopping_cart_content">
            <?php woocommerce_mini_cart(); ?>
        </div>
    </div>
    
    <div class="fugu-page-overlay fugu-cart-panel-overlay"></div>
</div>
