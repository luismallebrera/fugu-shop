<?php
	global $fugu_theme_options, $fugu_globals;
?>
                </div> <!-- .fugu-page-wrap-inner -->
            </div> <!-- .fugu-page-wrap -->
            
            <footer id="fugu-footer" class="fugu-footer">
                <?php
                    // Footer widgets
                    if ( is_active_sidebar( 'footer' ) ) {
                        get_template_part( 'template-parts/footer/footer', 'widgets' );
                    }
                ?>
                
                <?php
                    // Footer bar (or Elementor Pro footer location)
                    if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) {
						get_template_part( 'template-parts/footer/footer', 'bar' );
					}
                ?>
            </footer>
            
            <?php wp_footer(); // WordPress footer hook ?>
        
        </div> <!-- .fugu-page-overflow -->
	</body>
</html>