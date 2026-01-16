<?php fugu_blog_get_ajax_content(); // AJAX: Get blog content only, then exit ?>
<?php
    global $fugu_theme_options;

    $show_categories = ( $fugu_theme_options['blog_categories'] ) ? true : false;
    $categories_class = ( $show_categories ) ? '' : ' fugu-blog-categories-disabled';
?>
<?php get_header(); ?>

<div class="fugu-blog-wrap<?php echo esc_attr( $categories_class ); ?>">
    <?php if ( $show_categories ) : ?>
    <div class="fugu-blog-categories">
        <div class="fugu-row">
            <div class="col-xs-12">
                <?php echo fugu_blog_category_menu(); ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <?php
		// Category description
		$category_description = category_description();
		if ( ! empty( $category_description ) ) :
	?>
    <div class="fugu-term-description fugu-category-description">
        <div class="fugu-row">
            <div class="col-xs-12">
                <?php echo $category_description; ?>
            </div>
        </div>
    </div>
	<?php endif; ?>
    
    <?php get_template_part( 'template-parts/blog/content' ); ?>
</div>

<?php get_footer(); ?>