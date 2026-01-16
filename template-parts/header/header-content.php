<?php
    global $fugu_globals, $fugu_theme_options;
    
    // Header classes
    $header_classes = fugu_header_get_classes();
?>
<div id="fugu-header-placeholder" class="fugu-header-placeholder"></div>

<header id="fugu-header" class="fugu-header <?php echo esc_attr( $header_classes ); ?> clear">
        <div class="fugu-header-inner">
        <?php
            // Include header layout
            if ( $fugu_theme_options['header_layout'] == 'centered' ) {
                get_template_part( 'template-parts/header/header', 'layout-centered' );
            } else {
                get_template_part( 'template-parts/header/header', 'layout' );
            }
        ?>
    </div>
</header>

<?php
    // Shop search
    if ( $fugu_globals['shop_search_header'] ) {
        get_template_part( 'template-parts/woocommerce/searchform' );
    }
?>