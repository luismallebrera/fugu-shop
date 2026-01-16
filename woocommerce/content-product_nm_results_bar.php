<?php
/**
 *	NM: Shop - Results bar/button
 */

defined( 'ABSPATH' ) || exit;

global $fugu_theme_options;

$has_results = false;
$results_bar_class = '';
$results_bar_buttons = array();

/* Search */
if ( ! empty( $_REQUEST['s'] ) ) { // Is search query set and not empty?
    $has_results = true;
    $results_bar_class .= ' is-search';
    $results_bar_buttons['search_taxonomy'] = array(
        'parent_class'  => 'fugu-shop-search-reset',
        'id'            => 'fugu-shop-search-taxonomy-reset',
        'title'         => sprintf( esc_html__( 'Search results: &ldquo;%s&rdquo;', 'woocommerce' ), esc_html( $_REQUEST['s'] ) ),
    );
}

/* Category */
if ( is_product_category() ) {    
    $show_active_category = apply_filters( 'fugu_shop_show_active_category', true );
    
    if ( $show_active_category ) {
        $has_results = true;
        $results_bar_buttons['search_taxonomy'] = array(
            'parent_class'  => 'fugu-shop-taxonomy-reset fugu-shop-category-reset',
            'id'            => 'fugu-shop-search-taxonomy-reset',
        );
        $current_term = $GLOBALS['wp_query']->get_queried_object();

        $results_bar_class .= ' is-category';
        $results_bar_buttons['search_taxonomy']['title'] = '<span>' . esc_html__( 'Category', 'woocommerce' ) . ': </span>' . esc_html( $current_term->name );
    }
}

/* Tag */
if ( is_product_tag() ) {
    $has_results = true;
    $results_bar_buttons['search_taxonomy'] = array(
        'parent_class'  => 'fugu-shop-taxonomy-reset fugu-shop-tag-reset',
        'id'            => 'fugu-shop-search-taxonomy-reset',
    );
    $current_term = $GLOBALS['wp_query']->get_queried_object();

    $results_bar_class .= ' is-tag';
    $results_bar_buttons['search_taxonomy']['title'] = '<span>' . esc_html__( 'Tag', 'woocommerce' ) . ': </span>'  . esc_html( $current_term->name );
}

/* Brand */
if ( is_tax( 'product_brand' ) ) {
    $has_results = true;
    $results_bar_buttons['search_taxonomy'] = array(
        'parent_class'  => 'fugu-shop-taxonomy-reset fugu-shop-brand-reset',
        'id'            => 'fugu-shop-search-taxonomy-reset',
    );
    $current_term = $GLOBALS['wp_query']->get_queried_object();
    
    $results_bar_class .= ' is-brand';
    $results_bar_buttons['search_taxonomy']['title'] = '<span>' . esc_html__( 'Brand', 'woocommerce' ) . ': </span>'  . esc_html( $current_term->name );
}

/* Filters */
$show_active_filters = apply_filters( 'fugu_shop_show_active_filters', true );
$active_filters = '';
if ( $show_active_filters ) {
    $active_filters = fugu_get_active_filters();
    if ( $active_filters ) {
        $has_results = true;
        $results_bar_class .= ' has-filters has-individual-filters';
        $results_bar_buttons['active_filters'] = array(
            'parent_class'  => 'fugu-shop-active-filters',
            'id'            => 'fugu-shop-active-filters',
            'html'          => $active_filters,
        );
        $results_bar_buttons['filters'] = array(
            'parent_class'  => 'fugu-shop-filters-reset',
            'id'            => 'fugu-shop-filters-reset',
            'title'         => esc_html__( 'Clear filters', 'woocommerce' ),
        );
    }
} else {
    $filters_count = fugu_get_active_filters_count();
    if ( $filters_count ) {
        $has_results = true;
        $results_bar_class = ' has-filters';
        $results_bar_buttons['filters'] = array(
            'parent_class'  => 'fugu-shop-filters-reset',
            'id'            => 'fugu-shop-filters-reset',
            'title'         => sprintf( esc_html__( 'Filters active %s(%s)%s', 'fugu-framework' ), '<span>', $filters_count, '</span>' )
        );
    }
}

if ( $has_results ) :
?>

<div class="fugu-shop-results-bar <?php echo esc_attr( $results_bar_class ); ?>">
    <ul>
        <?php
            $shop_url_escaped = esc_url( get_permalink( wc_get_page_id( 'shop' ) ) );
            
            foreach ( $results_bar_buttons as $button ) {
                if ( $button['id'] == 'fugu-shop-active-filters' ) {
                    echo $button['html'];
                } else {
                    printf( '<li class="%1$s"><a href="%2$s" id="%3$s" class="fugu-shop-reset-button" data-shop-url="%4$s">%5$s</a></li>',
                        $button['parent_class'],
                        '#',
                        $button['id'],
                        $shop_url_escaped,
                        $button['title']
                    );
                }
            }
        ?>
    </ul>
</div>

<?php endif; ?>
