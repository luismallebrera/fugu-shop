<?php
    global $fugu_theme_options;
    
    // Content "slug"
    $content_slug = ( is_search() ) ? 'search' : $fugu_theme_options['blog_layout'];
    $layout_class = apply_filters( 'fugu_blog_layout_class', $content_slug );
    $container_class = 'layout-' . $layout_class;
    
    // Sidebar
    $show_sidebar = ( $fugu_theme_options['blog_sidebar'] !== 'none' && ! is_search() ) ? true : false;
    $show_sidebar = apply_filters( 'fugu_blog_show_sidebar', $show_sidebar );
    $container_class .= ( $show_sidebar ) ? ' has-sidebar sidebar-' . $fugu_theme_options['blog_sidebar'] : ' no-sidebar';

    // Content columns class
    $column_class_content = ( $show_sidebar ) ? apply_filters( 'fugu_blog_content_columns_class', 'col-md-9 col-sm-12 col-xs-12' ) : 'col-xs-12';
?>

<div class="fugu-blog <?php echo esc_attr( $container_class ); ?>">
    <div class="fugu-blog-row fugu-row">
        <div class="fugu-blog-content-col <?php echo esc_attr( $column_class_content ); ?>">
        <?php if ( have_posts() ) : ?>
            <?php get_template_part( 'template-parts/blog/content', $content_slug ); ?>

            <?php get_template_part( 'pagination' ); ?>
        <?php else : ?>
            <?php get_template_part( 'template-parts/blog/content', 'none' ); // If no content, include the "No posts found" template ?>
        <?php endif; ?>
        </div>
        
        <?php 
        if ( $show_sidebar ) :
        
        $column_class_sidebar = apply_filters( 'fugu_blog_sidebar_columns_class', 'col-md-3 col-sm-12 col-xs-12' );
        ?>
        <div class="fugu-blog-sidebar-col <?php echo esc_attr( $column_class_sidebar ); ?>">
            <?php get_sidebar(); ?>
        </div>
        <?php endif; ?>
    </div>
</div>
