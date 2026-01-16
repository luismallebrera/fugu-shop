<?php
	global $fugu_theme_options, $post;
    
    // Sidebar
    $post_class = 'fugu-post-sidebar-' . $fugu_theme_options['single_post_sidebar'];
	$show_sidebar = ( $fugu_theme_options['single_post_sidebar'] != 'none' ) ? true : false;
    $post_column_class = ( $show_sidebar ) ? 'col col-md-9 col-sm-12 col-xs-12' : 'fugu-post-col';
    
    // Featured image
    $has_featured_image = ( $fugu_theme_options['single_post_display_featured_image'] && has_post_thumbnail() ) ? true : false;
    $post_class .= ( $has_featured_image ) ? ' has-featured-image' : '';

    // Comments
    $show_comments = ( comments_open() || get_comments_number() ) ? true : false;
    $post_class .= ( $show_comments ) ? ' has-post-comments' : ' no-post-comments';
?>

<?php get_header(); ?>

<div class="fugu-post <?php echo esc_attr( $post_class ); ?>">
    
<?php if ( have_posts() ) : ?>

	<?php while ( have_posts() ) : the_post(); ?>    	
	
	<div class="fugu-post-body">
        <div class="fugu-row">
            <div class="fugu-post-content-col <?php echo esc_attr( $post_column_class ); ?>">
                <header class="fugu-post-header entry-header">
                    <?php if ( $has_featured_image ) : ?>
                    <div class="fugu-post-featured-image <?php echo esc_attr( $fugu_theme_options['single_post_featured_image_aspect_ratio'] ); ?>">
                        <?php the_post_thumbnail(); ?>
                    </div>
                    <?php endif; ?>

                    <h1><?php the_title(); ?></h1>

                    <div class="fugu-single-post-meta-top">
                        <span><em><?php esc_html_e( 'By', 'fugu-framework' ); ?> <?php the_author_posts_link(); ?> </em><time><?php esc_html_e( 'on', 'fugu-framework' ); ?> <?php the_date(); ?></time></span>
                    </div>
                </header>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="fugu-post-content entry-content clear">
                        <?php the_content(); ?>
                        
                        <?php
                            wp_link_pages( array(
                                'before' 		=> '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'fugu-framework' ) . '</span>',
                                'after' 		=> '</div>',
                                'link_before'	=> '<span>',
                                'link_after'	=> '</span>'
                            ) );
                        ?>
                    </div>
                </article>
                
                <?php
                    $categories_list = get_the_category_list( '<span>,</span> ' );
                    $tag_list = get_the_tag_list( '<div class="fugu-single-post-tags widget_tag_cloud">', '', '</div>' );
                    $meta_class = ( $categories_list || $tag_list ) ? 'has-meta' : 'no-meta';
                ?>
                <div class="fugu-single-post-meta-wrap <?php echo esc_attr( $meta_class ); ?>">
                    <div class="fugu-single-post-meta">
                    <?php
                        if ( $tag_list ) {
                            echo $tag_list;
                        }
                    
                        if ( $categories_list ) {
                            echo '<div class="fugu-single-post-categories">' . esc_html__( 'Posted in ', 'fugu-framework' ) . $categories_list . '.</div>';
                        }
                    ?>
                    </div>

                    <?php do_action( 'fugu_after_post' ); ?>
                </div>
            </div>
            
            <?php if ( $show_sidebar ) : ?>
            <div class="fugu-post-sidebar-col col-md-3 col-sm-12 col-xs-12">
                <?php get_sidebar(); ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
	
    <div class="fugu-post-pagination">
        <div class="fugu-row">
            <div class="col-xs-12">
                <div class="fugu-post-pagination-inner">
                    <div class="fugu-post-prev">
                        <?php next_post_link( '%link', '<span class="short-title">' . esc_html__( 'Previous', 'fugu-framework' ) . '</span><span class="long-title">%title</span>', false ); ?>
                    </div>

                    <div class="fugu-post-next">
                        <?php previous_post_link( '%link', '<span class="short-title">' . esc_html__( 'Next', 'fugu-framework' ) . '</span><span class="long-title">%title</span>', false ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
	<?php endwhile; ?>
		   
<?php else : ?>

	<div class="col col-xs-8 centered">
		<?php get_template_part( 'content', 'none' ); ?>
	</div>
	
<?php endif; ?>

<?php if ( $show_comments ) : ?>
	<div id="comments" class="fugu-comments">
		<div class="fugu-row">
			<div class="<?php echo esc_attr( $post_column_class ); ?>">
				<?php comments_template(); ?>
			</div>
		</div>
	</div>
<?php endif; ?>

<?php 
if ( $fugu_theme_options['single_post_related'] ) :
    $term_ids = wp_get_post_categories( $post->ID );
    
    if ( $term_ids ) :
    
    $args = apply_filters( 'fugu_related_posts_args', array(
        'ignore_sticky_posts'   => 1,
        'no_found_rows'         => 1,
        'posts_per_page'        => intval( $fugu_theme_options['single_post_related_per_page'] ),
        'orderby'               => 'rand',
        'category__in'          => $term_ids,
        'post__not_in'          => array( $post->ID )
    ) );

    $related_posts = new WP_Query( $args );
    
    if ( $related_posts->have_posts() ) :
    
    // Columns
    $columns_large = $fugu_theme_options['single_post_related_columns'];
    $columns_medium = ( intval( $columns_large ) < 4 ) ? $columns_large : '4';
    $columns_small = ( intval( $columns_large ) > 1 ) ? '2' : '1';
	$columns_class = apply_filters( 'fugu_related_posts_columns_class', 'small-block-grid-' . $columns_small . ' medium-block-grid-' . $columns_medium . ' large-block-grid-' . $fugu_theme_options['single_post_related_columns'] );
    ?>
    <div class="fugu-related-posts">
        <div class="fugu-row">
            <div class="col-xs-12">
                <h2><?php _e( 'Related Posts', 'fugu-framework' ); ?></h2>
                
                <ul class="<?php echo esc_attr( $columns_class ); ?>">
                <?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
                    <li>
                        <a href="<?php echo esc_url( get_permalink() ); ?>" class="fugu-related-posts-image">
                            <?php the_post_thumbnail(); ?>
                            <div class="fugu-image-overlay"></div>
                        </a>

                        <div class="fugu-related-posts-content">
                            <div class="fugu-post-meta"><?php the_time( get_option( 'date_format' ) ); ?></div>
                            <h3><a href="<?php echo esc_url( get_permalink() ); ?>" class="dark"><?php the_title(); ?></a></h3>
                            <div class="fugu-related-posts-excerpt"><?php esc_html( the_excerpt() ); ?></div>
                        </div>
                    </li>
                <?php endwhile; ?>
                </ul>
            </div>
        </div>
    </div>
<?php 
    endif;
    
    endif;
    
    wp_reset_postdata();
endif;
?>
    
</div>

<?php get_footer(); ?>
