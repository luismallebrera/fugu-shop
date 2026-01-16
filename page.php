<?php
    // Only adding the "entry-content" post class on non-woocommerce pages to avoid CSS conflicts
    $post_class = ( fugu_is_woocommerce_page() ) ? '' : 'entry-content';
?>
<?php get_header(); ?>
	
<div class="fugu-page-default fugu-row">
    <div class="fugu-page-default-col col-xs-12">
        <?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class( esc_attr( $post_class ) ); ?>>
            <?php the_content(); ?>
        </div>
        <?php 
			endwhile;
			else :
		?>
        <div class="fugu-page-default-empty">
            <h2><?php esc_html_e( 'Sorry, nothing to display.', 'fugu-framework' ); ?></h2>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php if ( comments_open() || '0' != get_comments_number() ) : // If comments are open or we have at least one comment, load up the comment template ?>
<div class="fugu-page-default-comments fugu-comments">
    <div class="fugu-row">
        <div class="col-xs-12">
            <?php
				// Comments
				comments_template( '', true );
				edit_post_link();
            ?>
        </div>
    </div>
</div>
<?php endif; ?>

<?php get_footer(); ?>