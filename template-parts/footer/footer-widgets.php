<?php
	global $fugu_theme_options;
	
	// Layout classes
	$border_class = ( $fugu_theme_options['footer_widgets_border'] ) ? ' has-border' : '';
	$row_class = ' fugu-row-' . $fugu_theme_options['footer_widgets_layout'];
	
	// Grid columns class
	$columns_medium = ( intval( $fugu_theme_options['footer_widgets_columns'] ) < 2 ) ? '1' : '2';
	$columns_class = apply_filters( 'fugu_footer_widgets_columns_class', 'xsmall-block-grid-1  small-block-grid-1 medium-block-grid-' . $columns_medium . ' large-block-grid-' . $fugu_theme_options['footer_widgets_columns'] );
?>	
<div class="fugu-footer-widgets<?php echo esc_attr( $border_class ); ?> clearfix">
    <div class="fugu-footer-widgets-inner">
        <div class="fugu-row <?php echo esc_attr( $row_class ); ?>">
            <div class="col-xs-12">
                <ul class="fugu-footer-block-grid <?php echo esc_attr( $columns_class ); ?>">
                    <?php dynamic_sidebar( 'footer' ); ?>
                </ul>
            </div>
        </div>
    </div>
</div>