<?php fugu_blog_get_ajax_content(); // AJAX: Get blog content only, then exit ?>
<?php get_header(); ?>

<div class="fugu-blog-wrap">
	<div class="fugu-blog-heading">
    	<div class="fugu-row">	
        	<div class="col-xs-12">
                <h1><?php wp_kses( printf( __( '%s Search Results for: %s', 'fugu-framework' ), $wp_query->found_posts, '<strong>' . get_search_query() . '</strong>' ), array( 'strong' => array() ) ); ?></h1>
            </div>
        </div>
	</div>
	
    <?php get_template_part( 'template-parts/blog/content' ); ?>
</div>

<?php get_footer(); ?>