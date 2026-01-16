<?php
    
	/* WPBakery Page Builder: Initialize
	================================================== */
	
	if ( class_exists( 'WPBakeryVisualComposerAbstract' ) ) {
		global $fugu_theme_options, $fugu_globals;
		
        
		// Globals: "Stock" features
        $fugu_globals['vcomp_enable_frontend'] = ( $fugu_theme_options['vcomp_enable_frontend'] != '0' ) ? true : false;
        $fugu_globals['vcomp_stock'] = ( $fugu_theme_options['vcomp_stock'] != '0' ) ? true : false;
        
        
		// Theme directory
		define( 'FUGU_VC_DIR', FUGU_DIR . '/visual-composer/' );
		
		
		// Enable 'theme mode' (disables plugin update message)
		if ( function_exists( 'vc_set_as_theme' ) ) {
			vc_set_as_theme( true );
		}
		
        
        /* Admin body class */
        function fugu_vc_admin_body_class( $classes ) {
            $classes .= ' fugu-vcomp-stock ';
            return $classes;
        }
        if ( $fugu_globals['vcomp_stock'] ) {
            add_filter( 'admin_body_class', 'fugu_vc_admin_body_class' );
        }
		
        
		// Disable frontend editor
		if ( ! $fugu_globals['vcomp_enable_frontend'] ) {
			vc_disable_frontend();
		}
		
        
        /* Frontend assets */
        function fugu_vc_frontend_assets() {
            global $fugu_globals;
            
            $style_handle = 'fugu_js_composer_front';
            $script_handle = 'fugu_composer_front_js';
            
            if ( ! $fugu_globals['vcomp_enable_frontend'] && ! $fugu_globals['vcomp_stock'] ) {
                // Important: Use the default style/script handles to make sure inline styles/scripts are included (deregistering the default styles/scripts disables these) - https://wordpress.stackexchange.com/questions/262235/dequeue-only-stylesheets-but-not-inline-style-added-using-wp-add-inline-style
                $style_handle = 'js_composer_front';
                $script_handle = 'wpb_composer_front_js';
                
                // Deregister styles
                wp_deregister_style( 'js_composer_front' );

                // Deregister scripts
                wp_deregister_script( 'wpb_composer_front_js' );

                // Disable "enqueueStyle()" function (looks through the content for "vc_row" elements using "preg_match()")
                remove_action( 'wp_enqueue_scripts', array( wpbakery(), 'enqueueStyle' ) ); // "enqueueStyle()" is located in: "../js_composer/include/classes/core/class-vc-base.php"
            } else {
                // Add class to "body" when default elements/resources are enabled (used to override default styling)
                global $fugu_body_class;
                $fugu_body_class[] = 'fugu-wpb-default';
            }
            
            if ( ! $fugu_globals['vcomp_stock'] ) {
                // Deregister styles
                wp_deregister_style( 'font-awesome' );
                
                // Enqueue frontend styles (original stylesheet with unused styles removed)
                wp_enqueue_style( $style_handle, FUGU_THEME_URI . '/assets/css/visual-composer/fugu-js_composer.css', array(), FUGU_THEME_VERSION, 'all' );

                // Enqueue frontend scripts (original file with unused scripts removed)
                wp_enqueue_script( $script_handle, FUGU_THEME_URI . '/assets/js/visual-composer/fugu-js_composer_front.min.js', array( 'jquery' ), FUGU_THEME_VERSION, true );
            }
            
            /* Scripts that should always be disabled: */
            
            // Causes error on "add to cart" from quick-view: Disable custom WooCommerce add-to-cart script (action is located in: "../js_composer/include/autoload/vendors/woocommerce.php)
            remove_action( 'wp_enqueue_scripts', 'vc_woocommerce_add_to_cart_script' );
        }
        add_action( 'wp_enqueue_scripts', 'fugu_vc_frontend_assets', 1 );
        
        
		if ( ! $fugu_globals['vcomp_stock'] ) {
            /* "tta" resources (accordions, tabs, tour) */
            function fugu_vc_tta_resources() {
                if ( wp_script_is( 'vc_accordion_script' ) || wp_script_is( 'vc_tabs_script' ) ) { // Make sure the stock "tta" scripts are enqueued
                    // Deregister styles
                    wp_deregister_style( 'vc_tta_style' );
                    
                    // Deregister scripts
                    wp_deregister_script( 'vc_accordion_script' );
                    wp_deregister_script( 'vc_tta_autoplay_script' );
                    wp_deregister_script( 'vc_tabs_script' );

                    // Enqueue scripts
                    wp_enqueue_script( 'fugu_accordions_tabs', FUGU_THEME_URI . '/assets/js/visual-composer/fugu-accordions-tabs.min.js', array( 'jquery' ), FUGU_THEME_VERSION, true );
                }
            }
            add_action( 'wp_footer', 'fugu_vc_tta_resources', 10 );
        }
		
		
		// Set element template files directory
		$vc_element_templates_dir = FUGU_VC_DIR . '/element-templates/';
		vc_set_shortcodes_templates_dir( $vc_element_templates_dir );
		
		
		// Check if "CF7" is enabled
		global $fugu_cf7_enabled;
		$fugu_cf7_enabled = ( defined( 'WPCF7_PLUGIN' ) ) ? true : false;
		
		
		if ( is_admin() ) {
			// Page templates
			include( FUGU_VC_DIR . '/page-templates.php' );
			
			
			// Include elements configuration
			include( FUGU_DIR . '/visual-composer/elements-config.php' );
			
            
			// Include custom params
			include( FUGU_VC_DIR . '/params/iconpicker.php' );
            
            
            if ( ! $fugu_globals['vcomp_stock'] ) {
				if ( fugu_woocommerce_activated() ) {
					/* Remove default WooCommerce elements */
					function fugu_vc_remove_woocommerce_elements() {
						vc_remove_element( 'woocommerce_cart' );
						vc_remove_element( 'woocommerce_checkout' );
						vc_remove_element( 'woocommerce_my_account' );
						vc_remove_element( 'product' );
						vc_remove_element( 'product_page' );
						vc_remove_element( 'product_categories' );
					}
					add_action( 'vc_build_admin_page', 'fugu_vc_remove_woocommerce_elements', 11 ); // Hook for admin editor
					add_action( 'vc_load_shortcode', 'fugu_vc_remove_woocommerce_elements', 11 ); // Hook for frontend editor
				}
                
                
                /* Remove admin menus */
				function fugu_vc_remove_admin_menus() {
					// Note: Removed after 7.7 update since automapper can't be disabled by default with custom code (see "vc_automapper()->setDisabled( true )" below): remove_submenu_page( 'vc-general', 'vc-automapper' );
					remove_submenu_page( 'vc-general', 'edit.php?post_type=vc_grid_item' );
				}
				add_action( 'admin_menu', 'fugu_vc_remove_admin_menus', 1000 );
                
                
                // Disable shortcode automapper feature
				/* Note: vc_automapper deprecated in 7.7: if ( function_exists( 'vc_automapper' ) ) {
					vc_automapper()->setDisabled( true );
				}*/
			}
			
			
			/* Remove "vc_teaser" metabox */
			function fugu_vc_remove_teaser_metabox() {
				remove_meta_box( 'vc_teaser', '', 'side' );
			}
			add_action( 'admin_head', 'fugu_vc_remove_teaser_metabox' );
			
			
			// Set default editor post types (will not be used if the "content_types" VC setting is already saved - see fix below)
			$post_types = array(
				'page',
                'portfolio'
			);
			vc_set_default_editor_post_types( $post_types );
			
			// Default editor post types: Un-comment and refresh WP admin to save/reset the "content_types" VC option
			// NOTE: Remember to comment-out after page refresh!
			//vc_settings()->set( 'content_types', $post_types );
		}
		
		
		/* Remove header meta tag */
		/*function fugu_vc_remove_meta() {
			remove_action( 'wp_head', array( wpbakery(), 'addMetaData' ) );
		}
		add_action( 'init', 'fugu_vc_remove_meta', 100 );*/
        
        
        
		/*
		 * VC: Output custom styles - The plugin doesn't output custom styles on non-singular pages (like blog-index and shop archives)
		 *
		 * See "addFrontCss()" in "../js_composer/include/classes/core/class-vc-base.php"
		 */
		function fugu_vc_addFrontCss( $page_id ) {
			// Get custom styles from the post meta (returns empty strings if no results)
			$post_custom_css = get_post_meta( $page_id, '_wpb_post_custom_css', true );
			$shortcodes_custom_css = get_post_meta( $page_id, '_wpb_shortcodes_custom_css', true );
							
			if ( $post_custom_css != '' || $shortcodes_custom_css != '' ) {
				echo '<style type="text/css" class="fugu-vc-styles">' . $post_custom_css . $shortcodes_custom_css . '</style>';
			}
		}
		
		
		/* Shop: Output custom styles for page content on shop archives */
		function fugu_shop_vc_styles() {
			if ( is_shop() || is_product_taxonomy() ) {
				$shop_page_content_id = fugu_shop_get_page_content_id();
                
				fugu_vc_addFrontCss( $shop_page_content_id );
			}
		}
		if ( fugu_woocommerce_activated() ) {
			add_action( 'wp_head', 'fugu_shop_vc_styles', 1000 );
		}
		
		
		/* Blog: Output custom styles for page content on blog index archive */
		function fugu_blog_index_vc_styles() {
			global $fugu_theme_options;
			
			fugu_vc_addFrontCss( $fugu_theme_options['blog_static_page_id'] );
		}
		
	}
