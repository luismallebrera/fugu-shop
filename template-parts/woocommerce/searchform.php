<?php
    global $fugu_theme_options;
?>
<div class="fugu-header-search-holder">
    <div id="fugu-header-search">
        <a href="#" id="fugu-header-search-close" class="fugu-font fugu-font-close2"></a>

        <div class="fugu-header-search-wrap">
            <div class="fugu-header-search-form-wrap">
                <form id="fugu-header-search-form" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <a id="fugu-header-search-clear-button" class="button border">
                        <i class="fugu-font-close2"></i>
                        <span><?php esc_html_e( 'Clear', 'woocommerce' ); ?></span>
                    </a>
                    <i class="fugu-font fugu-font-search"></i>
                    <input type="text" id="fugu-header-search-input" autocomplete="off" value="" name="s" placeholder="<?php esc_attr_e( 'Search products', 'woocommerce' ); ?>&hellip;" />
                    <input type="hidden" name="post_type" value="product" />
                </form>
            </div>

            <?php
                if ( strlen( $fugu_theme_options['shop_search_keywords'] ) > 1 ) :

                $search_keywords = explode( ',', $fugu_theme_options['shop_search_keywords'] );
            ?>
            <div id="fugu-search-keywords" class="show">
                <strong class="fugu-search-keywords-title"><?php echo esc_html( $fugu_theme_options['shop_search_keywords_title'] ); ?></strong>
                <ul class="fugu-search-keywords-list">
                <?php
                    foreach ( $search_keywords as $search_keyword ) {
                        printf(
                            '<li><a href="%s" class="button border"><i class="fugu-font-search"></i>%s</a></li>',
                            esc_url( home_url( '?s=' . $search_keyword . '&post_type=product' ) ),
                            esc_html( $search_keyword )
                        );
                    }
                ?>
                </ul>
            </div>
            <?php endif; ?>

            <?php
                if ( $fugu_theme_options['shop_search_suggestions'] ) :

                // Column class
                $columns_class = apply_filters( 'fugu_search_suggestions_product_columns_class', 'block-grid-single-row xsmall-block-grid-2 small-block-grid-4 medium-block-grid-5 large-block-grid-6');
            ?>
            <div id="fugu-search-suggestions-notice">
                <span class="txt-press-enter"><?php printf( esc_html__( 'press %sEnter%s to search', 'fugu-framework' ), '<u>', '</u>' ); ?></span>
                <span class="txt-has-results"><?php esc_html_e( 'Search results', 'woocommerce' ); ?>:</span>
                <span class="txt-no-results"><?php esc_html_e( 'No products found.', 'woocommerce' ); ?></span>
            </div>

            <div id="fugu-search-suggestions">
                <div class="fugu-search-suggestions-inner">
                    <ul id="fugu-search-suggestions-product-list" class="<?php echo esc_attr( $columns_class ); ?>"></ul>
                </div>
            </div>
            <?php else : ?>
            <div id="fugu-header-search-notice"><span><?php printf( esc_html__( 'press %sEnter%s to search', 'fugu-framework' ), '<u>', '</u>' ); ?></span></div>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="fugu-page-overlay fugu-header-search-overlay"></div>
</div>
