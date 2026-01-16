<?php
    global $fugu_theme_options;

	// Ubermenu
	if ( function_exists( 'ubermenu' ) ) {
		$ubermenu = true;
		$ubermenu_wrap_open = '<div class="fugu-ubermenu-wrap clear">';
		$ubermenu_wrap_close = '</div>';
	} else {
		$ubermenu = false;
		$ubermenu_wrap_open = $ubermenu_wrap_close = '';
	}
    
    // Mobile menu button position
    $mobile_menu_button_inline = ( strpos( $fugu_theme_options['header_layout'], 'stacked' ) !== false ) ? true : false;
    $mobile_menu_button_right_menu = apply_filters( 'fugu_mobile_menu_button_inline', false );
?>
<div class="fugu-header-row fugu-row">
    <div class="fugu-header-col col-xs-12">
        <?php echo $ubermenu_wrap_open; ?>
        
        <div class="fugu-header-left">
            <?php if ( ! $mobile_menu_button_inline ) : ?>
            <nav class="fugu-mobile-menu-button-wrapper">
                <ul id="fugu-mobile-menu-button-ul" class="fugu-menu">
                    <?php fugu_header_mobile_menu_button(); ?>
                </ul>
            </nav>
            <?php endif; ?>

            <?php
                // Include header logo
                get_template_part( 'template-parts/header/header', 'logo' );
            ?>
        </div>
        
        <?php if ( $ubermenu ) : ?>
            <?php ubermenu( 'main', array( 'theme_location' => 'main-menu' ) ); ?>
        <?php else : ?>               
        <nav class="fugu-main-menu">
            <ul id="fugu-main-menu-ul" class="fugu-menu">
                <?php if ( $mobile_menu_button_inline ) : ?>
                    <?php fugu_header_mobile_menu_button(); ?>
                <?php endif; ?>
                
                <?php
                    wp_nav_menu( array(
                        'theme_location'	=> 'main-menu',
                        'container'       	=> false,
                        'fallback_cb'     	=> false,
                        'walker'            => new FUGU_Sublevel_Walker,
                        'items_wrap'      	=> '%3$s'
                    ) );
                ?>
            </ul>
        </nav>
        <?php endif; ?>

        <nav class="fugu-right-menu">
            <ul id="fugu-right-menu-ul" class="fugu-menu">
                <?php
                    wp_nav_menu( array(
                        'theme_location'	=> 'right-menu',
                        'container'       	=> false,
                        'fallback_cb'     	=> false,
                        'walker'            => new FUGU_Sublevel_Walker,
                        'items_wrap'      	=> '%3$s'
                    ) );
                    
                    // Include default links (Login, Cart etc.)
                    get_template_part( 'template-parts/header/header', 'default-links' );
                ?>
                
                <?php if ( $mobile_menu_button_right_menu ) : ?>
                    <?php fugu_header_mobile_menu_button(); ?>
                <?php endif; ?>
            </ul>
        </nav>

        <?php echo $ubermenu_wrap_close; ?>
    </div>
</div>