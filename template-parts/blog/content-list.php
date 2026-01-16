<?php
	global $fugu_theme_options;
    
    // Image size slug
    $image_size = apply_filters( 'fugu_blog_image_size', '' );
?>
<div id="fugu-blog-list" class="fugu-blog-list">
    <?php while ( have_posts() ) : the_post(); // Start the Loop ?>
    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="fugu-row">
            <div class="fugu-divider-col col-xs-12">
               <div class="fugu-post-divider">&nbsp;</div>
            </div>
            
            <div class="fugu-title-col col-xs-5">
                <h2 class="fugu-post-title"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
                
                <div class="fugu-post-meta">
                    <span><?php the_time( get_option( 'date_format' ) ); ?></span>
                </div>
                
                <div class="fugu-post-content">
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
                    <?php else : ?>
                    <div class="fugu-post-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                    
                    <a href="<?php echo esc_url( get_permalink() ); ?>" class="fugu-post-read-more">
                        <span><?php esc_html_e( 'More', 'fugu-framework' ); ?></span><i class="fugu-font fugu-font-angle-thin-right"></i>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="fugu-content-col col-xs-7">
                <?php if ( has_post_thumbnail() ) : ?>
                <div class="fugu-post-thumbnail">   
                    <a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_post_thumbnail( $image_size ); ?></a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endwhile; ?>
</div>