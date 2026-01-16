<?php
	global $fugu_theme_options, $fugu_page_includes;
	
    // Masonry grid
    if ( $fugu_theme_options['blog_grid_masonry'] ) {
        fugu_add_page_include( 'blog-masonry');
    }

	// Grid column classes
	$columns_large = $fugu_theme_options['blog_grid_columns'];
	$columns_medium = ( intval( $columns_large ) > 3 ) ? '3' : '2';
	$columns_class = apply_filters( 'fugu_blog_grid_columns_class', 'xsmall-block-grid-1 small-block-grid-1 medium-block-grid-' . $columns_medium . ' large-block-grid-' . $columns_large );

    // Image size slug
    $image_size = apply_filters( 'fugu_blog_image_size', '' );
?>
<div class="fugu-blog-grid">
    <ul id="fugu-blog-list" class="<?php echo esc_attr( $columns_class ); ?>">
        <?php while ( have_posts() ) : the_post(); // Start the Loop ?>
        <li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php if ( has_post_thumbnail() ) : ?>
            <div class="fugu-post-thumbnail">
                <a href="<?php echo esc_url( get_permalink() ); ?>">
                    <?php the_post_thumbnail( $image_size ); ?>
                    <div class="fugu-image-overlay"></div>
                </a>
            </div>
            <?php endif; ?>

            <div class="fugu-post-meta">
                <span><?php the_time( get_option( 'date_format' ) ); ?></span>
            </div>

            <h2 class="fugu-post-title"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>

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
                        
                        <a href="<?php echo esc_url( get_permalink() ); ?>" class="fugu-post-read-more">
                            <span><?php esc_html_e( 'More', 'fugu-framework' ); ?></span><i class="fugu-font fugu-font-angle-thin-right"></i>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </li>
        <?php endwhile; ?>
    </ul>
</div>