<?php
/**
 *	NM: Shop - Taxonomy banner/header
 */

defined( 'ABSPATH' ) || exit;

global $fugu_theme_options;

// Product taxonomy class
$current_term = get_queried_object();
$taxonomy_class = ( $current_term && isset( $current_term->slug ) ) ? ' term-' . $current_term->slug : '';

// Product taxonomy image
$header_image_class = '';
$header_image_style_attr_escaped = '';
if ( isset( $fugu_theme_options['shop_taxonomy_header_image'] ) && $fugu_theme_options['shop_taxonomy_header_image'] ) {
    $header_image_id    = apply_filters( 'fugu_taxonomy_header_image_id', get_term_meta( get_queried_object_id(), 'thumbnail_id', true ) );
    $header_image_url   = wp_get_attachment_url( $header_image_id );
    
    if ( $header_image_url ) {
        $header_image_class = ' has-image';
        $header_image_style_attr_escaped = ' style="background-image: url(' . esc_url( $header_image_url ) . ');"';
    }
}
    
$header_text_column_class = apply_filters( 'fugu_category_header_column_class', 'col-xs-12 col-' . $fugu_theme_options['shop_taxonomy_header_text_alignment'] );
?>
<div id="fugu-shop-taxonomy-header" class="fugu-shop-taxonomy-header<?php echo esc_attr( $header_image_class ); ?><?php echo esc_attr( $taxonomy_class ); ?>">
    <div class="fugu-shop-taxonomy-header-inner"<?php echo $header_image_style_attr_escaped; ?>>
        <div class="fugu-shop-taxonomy-text align-<?php echo esc_attr( $fugu_theme_options['shop_taxonomy_header_text_alignment'] ); ?>">
            <div class="fugu-row">
                <div class="fugu-shop-taxonomy-text-col <?php echo esc_attr( $header_text_column_class ); ?>">
                    <h1><?php woocommerce_page_title(); ?></h1>
                    <?php
                        /**
                         * woocommerce_archive_description hook
                         *
                         * @hooked woocommerce_taxonomy_archive_description - 10
                         * @hooked woocommerce_product_archive_description - 10
                         */
                        do_action( 'woocommerce_archive_description' );
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>