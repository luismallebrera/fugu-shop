<?php
    global $fugu_theme_options;

    $infinite_load = ( $fugu_theme_options['blog_infinite_load'] ) ? true : false;
    
    if ( $infinite_load ) {
        $container_class = 'infinite-load ' . $fugu_theme_options['blog_infinite_load'] . '-mode';
        $next_posts_link = get_next_posts_link( esc_html__( 'Load More', 'fugu-framework' ) );
        $previous_posts_link = null;
    } else {
        $container_class = 'static';
        $next_posts_link = get_next_posts_link( esc_html__( 'Older Posts', 'fugu-framework' ) );
        $previous_posts_link = get_previous_posts_link( esc_html__( 'Newer Posts', 'fugu-framework' ) );
    }

    $show_pagination = ( $next_posts_link || $previous_posts_link ) ? true : false;
?>
<?php if ( $show_pagination ) : ?>
<div id="fugu-blog-pagination" class="<?php echo esc_attr( $container_class ); ?>">
    <div class="fugu-row">
        <div class="col-xs-12">
            <?php if ( $infinite_load ) : ?>
            <div id="fugu-blog-infinite-load">
                <?php echo $next_posts_link; ?>
            </div>
            <?php elseif ( function_exists( 'wp_pagenavi' ) ) : ?>
                <?php wp_pagenavi(); ?>
            <?php else : ?>
            <div class="fugu-blog-prev">
                <?php echo $next_posts_link; ?>
            </div>
            
            <div class="fugu-blog-next">
                <?php echo $previous_posts_link; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php endif; ?>