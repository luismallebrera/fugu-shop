<?php
	global $fugu_theme_options;
    
    $content_column_class = apply_filters( 'fugu_blog_content_classic_columns_class', 'col-xs-12' );

    // Image size slug
    $image_size = apply_filters( 'fugu_blog_image_size', '' );
?>
<div id="fugu-blog-list" class="fugu-blog-classic">
    <?php while ( have_posts() ) : the_post(); // Start the Loop ?>
    <div id="post-<?php esc_attr( the_ID() ); ?>" <?php post_class(); ?>>
        <div class="fugu-post-divider">&nbsp;</div>
        
        <?php if ( has_post_thumbnail() ) : ?>
        <div class="fugu-post-thumbnail">   
            <a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_post_thumbnail( $image_size ); ?></a>
        </div>
        <?php endif; ?>
        
        <div class="fugu-blog-header fugu-row">
            <div class="<?php echo esc_attr( $content_column_class ); ?>">
                <h2 class="fugu-post-title"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>

                <div class="fugu-post-meta">
                    <span><?php the_time( get_option( 'date_format' ) ); ?></span>
                </div>
            </div>
        </div>

        <div class="fugu-post-content fugu-row">
            <div class="<?php echo esc_attr( $content_column_class ); ?>">
            <?php if ( $fugu_theme_options['blog_show_full_posts'] === '1' ) : ?>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
                <?php
                    wp_link_pages( array(
                        'before' 		=> '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'fugu-framework' ) . '</span>',
                        'after' 		=> '</div>',
                        'link_before'	=> '<span>',
                        'link_after'	=> '</span>'
                    ) );
                ?>
                <div class="fugu-post-content-comments-link">
                    <a href="<?php echo esc_url( get_permalink() ); ?>#comments">
                        <i class="fugu-font fugu-font-messenger"></i>
                        <span><?php comments_number( esc_html__( 'Leave a comment', 'fugu-framework' ), esc_html__( '1 comment', 'fugu-framework' ), esc_html__( '% comments', 'fugu-framework' ) ); ?></span>
                    </a>
                </div>
            <?php else : ?>
                <div class="fugu-post-excerpt">
                    <?php the_excerpt(); ?>
                </div>
            <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endwhile; ?>
</div>