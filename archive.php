<?php fugu_blog_get_ajax_content(); // AJAX: Get blog content only, then exit ?>
<?php get_header(); ?>

<div class="fugu-blog-wrap">
    <div class="fugu-blog-heading">
    	<div class="fugu-row">	
        	<div class="col-xs-12">
                <h1>
                    <?php
                        if ( is_day() ) {
                            printf( esc_html__( 'Daily Archives: %s', 'fugu-framework' ), '<strong>' . get_the_date() . '</strong>' );
						} elseif ( is_month() ) {
                            printf( esc_html__( 'Monthly Archives: %s', 'fugu-framework' ), '<strong>' . get_the_date( 'F Y' ) . '</strong>' );
                        } elseif ( is_year() ) {
                            printf( esc_html__( 'Yearly Archives: %s', 'fugu-framework' ), '<strong>' . get_the_date( 'Y' ) . '</strong>' );
                        } else {
                            esc_html_e( 'Archives', 'fugu-framework' );
						}
                    ?>
                </h1>
            </div>
		</div>
    </div>
				
	<?php get_template_part( 'template-parts/blog/content' ); ?>
</div>

<?php get_footer(); ?>