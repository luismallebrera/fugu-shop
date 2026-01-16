<?php
	// Ubermenu
	if ( function_exists( 'ubermenu' ) ) {
		$ubermenu = true;
		$ubermenu_wrap_open = '<div class="fugu-ubermenu-wrap clear">';
		$ubermenu_wrap_close = '</div>';
	} else {
		$ubermenu = false;
		$ubermenu_wrap_open = $ubermenu_wrap_close = '';
	}
?>
<div class="fugu-row">
    <?php echo $ubermenu_wrap_open; ?>
    
    <?php
        // Include header logo
        get_template_part( 'template-parts/header/header', 'logo' );
    ?>

    <div class="fugu-main-menu-wrap col-xs-6">
        <nav class="fugu-main-menu">
            <ul id="fugu-main-menu-ul" class="fugu-menu">
                <?php fugu_header_mobile_menu_button(); ?>
                
                <?php
                    if ( ! $ubermenu ) {
                        wp_nav_menu( array(
                            'theme_location'	=> 'main-menu',
                            'container'       	=> false,
                            'fallback_cb'     	=> false,
                            'walker'            => new FUGU_Sublevel_Walker,
                            'items_wrap'      	=> '%3$s'
                        ) );
                    }
                ?>
            </ul>
        </nav>

        <?php if ( $ubermenu ) { ubermenu( 'main', array( 'theme_location' => 'main-menu' ) ); } ?>
    </div>

    <div class="fugu-right-menu-wrap col-xs-6">
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
            </ul>
        </nav>
    </div>

    <?php echo $ubermenu_wrap_close; ?>
</div>