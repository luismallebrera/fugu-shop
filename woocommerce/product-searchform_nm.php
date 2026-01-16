<div id="fugu-shop-search">
    <div class="fugu-row">
        <div class="col-xs-12">
            <div class="fugu-shop-search-inner">
                <div class="fugu-shop-search-input-wrap">
                    <a href="#" id="fugu-shop-search-close"><i class="fugu-font fugu-font-close2"></i></a>
                    <form id="fugu-shop-search-form" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <input type="text" id="fugu-shop-search-input" autocomplete="off" value="" name="s" placeholder="<?php esc_attr_e( 'Search products', 'woocommerce' ); ?>" />
                        <input type="hidden" name="post_type" value="product" />
                    </form>
                </div>
                
                <div id="fugu-shop-search-notice"><span><?php printf( esc_html__( 'press %sEnter%s to search', 'fugu-framework' ), '<u>', '</u>' ); ?></span></div>
            </div>
        </div>
    </div>
</div>