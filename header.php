<?php
    global $fugu_theme_options;
    
    $meta_viewport = array( 'width=device-width', 'initial-scale=1.0', 'maximum-scale=1.0', 'user-scalable=no' );
    if ( wp_is_mobile() ) { $meta_viewport[] = 'viewport-fit=cover'; }
    $meta_viewport = apply_filters( 'fugu_head_meta_viewport', $meta_viewport );
?>
<!DOCTYPE html>

<html <?php language_attributes(); ?> class="<?php echo esc_attr( 'footer-sticky-' . $fugu_theme_options['footer_sticky'] ); ?>">
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="<?php echo esc_attr( implode ( ', ', $meta_viewport ) ); ?>">
		<?php wp_head(); ?>
    </head>
    
	<body <?php body_class(); ?>>
        <?php wp_body_open(); ?>
        <?php if ( $fugu_theme_options['page_load_transition'] ) : ?>
        <div id="fugu-page-load-overlay" class="fugu-page-load-overlay"></div>
        <?php endif; ?>
        
        <div class="fugu-page-overflow">
            <div class="fugu-page-wrap">
                <?php
                    // Top bar
                    if ( $fugu_theme_options['top_bar'] ) {
                        get_template_part( 'template-parts/header/header', 'top-bar' );
                    }
                ?>
                            
                <div class="fugu-page-wrap-inner">
                    <?php
                        // Header (or Elementor Pro header location)
						if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) {
							get_template_part( 'template-parts/header/header', 'content' );
						}
                    ?>
