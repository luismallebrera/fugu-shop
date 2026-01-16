<?php
	global $fugu_theme_options;
    
    // Column classes
    $column_left_size = intval( $fugu_theme_options['top_bar_left_column_size'] );
	$column_right_size = 12 - $column_left_size;

    // Create "cycles" from top bar text
    $cycles = explode( '||', $fugu_theme_options['top_bar_text'] );
    $has_cycles = ( count( $cycles ) > 1 ) ? true : false;
    $cycles_class = ( $has_cycles ) ? ' has-cycles' : '';
?>
<div id="fugu-top-bar" class="fugu-top-bar<?php echo esc_attr( $cycles_class ); ?>">
    <div class="fugu-row">
        <div class="fugu-top-bar-left col-xs-<?php echo esc_attr( $column_left_size ); ?>">
            <?php
                // Social icons (left column)
                if ( $fugu_theme_options['top_bar_social_icons'] == 'l_c' ) {
                    echo fugu_get_social_profiles( 'fugu-top-bar-social' ); // Args: $wrapper_class 
                }
            ?>

            <div class="fugu-top-bar-text">
            <?php if ( $has_cycles ) : ?>
                <div class="fugu-top-bar-cycles">
                    <?php 
                        foreach ( $cycles as $i => $cycle ) :
                        
                            $active_class = ( 0 == $i ) ? ' active' : '';
                    ?>
                    <div class="cycle<?php echo esc_attr( $active_class ); ?>">
                        <?php echo wp_kses_post( do_shortcode( $cycle ) ); ?>
                    </div>
                    <?php endforeach; ?>
                </div>        
            <?php else : ?>
                <?php echo wp_kses_post( do_shortcode( $fugu_theme_options['top_bar_text'] ) ); ?>
            <?php endif; ?>
            </div>
        </div>

        <div class="fugu-top-bar-right col-xs-<?php echo esc_attr( $column_right_size ); ?>">
            <?php
                // Social icons (right column)
                if ( $fugu_theme_options['top_bar_social_icons'] == 'r_c' ) {
                    echo fugu_get_social_profiles( 'fugu-top-bar-social' ); // Args: $wrapper_class 
                }
            ?>

            <?php
                // Top-bar menu
                wp_nav_menu( array(
                    'theme_location'	=> 'top-bar-menu',
                    'container'       	=> false,
                    'menu_id'			=> 'fugu-top-menu',
                    'fallback_cb'     	=> false,
                    'items_wrap'      	=> '<ul id="%1$s" class="fugu-menu">%3$s</ul>'
                ) );
            ?>
        </div>
    </div>                
</div>