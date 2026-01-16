<?php fugu_blog_get_ajax_content(); // AJAX: Get blog content only, then exit ?>
<?php
    global $fugu_theme_options;
    
    $show_categories = ( $fugu_theme_options['blog_categories'] ) ? true : false;
    $categories_class = ( $show_categories ) ? '' : ' fugu-blog-categories-disabled';

    $blog_page = fugu_blog_get_static_content();
?>
<?php get_header(); ?>

<div class="fugu-blog-wrap<?php echo esc_attr( $categories_class ); ?>">
    <?php if ( $blog_page ) : ?>
    <div class="fugu-page-full">
        <?php echo $blog_page; ?>
    </div>
	<?php endif; ?>
    
    <?php if ( $show_categories ) : ?>
    <div class="fugu-blog-categories">
        <div class="fugu-row">
            <div class="col-xs-12">
                <?php echo fugu_blog_category_menu(); ?>
            </div>
        </div>
    </div>
	<?php endif; ?>
    
    <?php get_template_part( 'template-parts/blog/content' ); ?>
</div>

<?php get_footer(); ?>