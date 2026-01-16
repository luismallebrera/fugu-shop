<?php
    $show_thumbnail = apply_filters( 'fugu_blog_search_show_thumbnail', true );
?>
<div id="fugu-blog-list" class="fugu-search-results">
    <?php while ( have_posts() ) : the_post(); // Start the Loop ?>
    <div id="post-<?php esc_attr( the_ID() ); ?>" <?php post_class(); ?>>
        <div class="fugu-row">
            <div class="fugu-divider-col col-xs-12">
               <div class="fugu-post-divider">&nbsp;</div>
            </div>
            
            <div class="fugu-title-col col-xs-5">
                <?php
                if ( $show_thumbnail && has_post_thumbnail() ) :
                
                // Image size slug
                $image_size = apply_filters( 'fugu_blog_image_size', '' );
                ?>
                <div class="fugu-post-thumbnail">
                    <a href="<?php echo esc_url( get_permalink() ); ?>">
                        <?php the_post_thumbnail( $image_size ); ?>
                    </a>
                </div>
                <?php endif; ?>
                <div class="fugu-post-header">
                    <h1 class="fugu-post-title"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h1>
                    <div class="fugu-post-meta">
                        <span><?php the_time( get_option( 'date_format' ) ); ?></span>
                    </div>
                </div>
            </div>

            <div class="fugu-content-col col-xs-7">
                <div class="fugu-post-content">
                    <?php the_excerpt(); ?>
                </div>
            </div>
        </div>
    </div>
    <?php endwhile; ?>
</div>