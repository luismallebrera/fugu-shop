<?php
	/* Constants & Globals
	==================================================================================================== */

	// Uncomment to include un-minified JavaScript files
	//define( 'FUGU_DEBUG_MODE', TRUE );

	// Constants: Folder directories/uri's
	define( 'FUGU_THEME_DIR', get_template_directory() );
	define( 'FUGU_DIR', get_template_directory() . '/includes' );
	define( 'FUGU_THEME_URI', get_template_directory_uri() );
	define( 'FUGU_URI', get_template_directory_uri() . '/includes' );

	// Constant: Framework namespace
	define( 'FUGU_NAMESPACE', 'fugu-framework' );

	// Constant: Theme version
    $theme = wp_get_theme();
    $theme_parent = $theme->parent();
    $theme_version = ( $theme_parent ) ? $theme_parent->get( 'Version' ) : $theme->get( 'Version' );
    define( 'FUGU_THEME_VERSION', $theme_version );

	// Global: Theme options
	global $fugu_theme_options;

	// Global: Page includes
	global $fugu_page_includes;
	$fugu_page_includes = array();

	// Global: <body> class
	global $fugu_body_class;
	$fugu_body_class = array();

	// Global: Theme globals
	global $fugu_globals;
	$fugu_globals = array();

    // Globals: WooCommerce - Cart panel quantity throttle
    $fugu_globals['cart_panel_qty_throttle'] = intval( apply_filters( 'fugu_cart_panel_qty_throttle', 0 ) );

    // Globals: WooCommerce - Shop search
    $fugu_globals['shop_search_enabled']  = false;
    $fugu_globals['shop_search']          = false;
    $fugu_globals['shop_search_header']   = false;
    $fugu_globals['shop_search_popup']    = false;

    // Globals: WooCommerce - Search suggestions
    $fugu_globals['shop_search_suggestions_max_results'] = 6;

    // Globals: WooCommerce - Shop header
    $fugu_globals['shop_header_centered'] = false;

	// Global: WooCommerce - "Product Slider" shortcode loop
	$fugu_globals['product_slider_loop'] = false;

	// Global: WooCommerce - Shop image lazy-loading
	$fugu_globals['shop_image_lazy_loading'] = false;

    // Globals: WooCommerce - Custom variation controls
    $fugu_globals['pa_color_slug'] = sanitize_title( apply_filters( 'fugu_color_attribute_slug', 'color' ) );
    $fugu_globals['pa_variation_controls'] = array(
        'color' => esc_html__( 'Color', 'fugu-framework-admin' ),
        'image' => esc_html__( 'Image', 'fugu-framework-admin' ),
        'size'  => esc_html__( 'Label', 'fugu-framework-admin' )
    );
    $fugu_globals['pa_cache'] = array();

    // Globals: WooCommerce - Wishlist
    $fugu_globals['wishlist_enabled'] = false;


    /* Admin localisation (must be placed before admin includes)
    ==================================================================================================== */

    if ( defined( 'FUGU_ADMIN_LOCALISATION' ) && is_admin() ) {
        $language_dir = apply_filters( 'fugu_admin_languages_dir', FUGU_THEME_DIR . '/languages/admin' );

        load_theme_textdomain( 'fugu-framework-admin', $language_dir );
        load_theme_textdomain( 'redux-framework', $language_dir );
    }


    /* WP Rocket: Deactivate WooCommerce refresh cart fragments cache: https://docs.wp-rocket.me/article/1100-optimize-woocommerce-get-refreshed-fragments
	==================================================================================================== */

    $wpr_cart_fragments_cache = apply_filters( 'fugu_wpr_cart_fragments_cache', false );
    if ( ! $wpr_cart_fragments_cache ) {
        add_filter( 'rocket_cache_wc_empty_cart', '__return_false' );
    }


    /* Redux theme options framework
	==================================================================================================== */

    if ( ! isset( $redux_demo ) ) {
        require( FUGU_DIR . '/options/options-config.php' );

        // Include: "Custom Code" section class
        if ( ! class_exists( 'FUGU_Custom_Code' ) ) { // Make sure the class isn't defined from an older version of the "Fugu Theme - Content Element" plugin
            include( FUGU_DIR . '/options/custom-code.php' );
        }
        // Add "Custom Code" section
        if ( class_exists( 'FUGU_Custom_Code' ) ) {
            FUGU_Custom_Code::add_settings_section();
        }
    }

    // Get theme options
    $fugu_theme_options = get_option( 'fugu_theme_options' );

    // Is the theme options array saved?
    if ( ! $fugu_theme_options ) {
        // Save default options array
        require( FUGU_DIR . '/options/default-options.php' );
    }

    do_action( 'fugu_theme_options_set' );


	/* Includes
	==================================================================================================== */

    if ( file_exists( FUGU_DIR . '/tgmpa/tp.php' ) ) {
        include( FUGU_DIR . '/tgmpa/tp.php' );
    }

    // Custom CSS
    require( FUGU_DIR . '/custom-styles.php' );

	// Helper functions
	require( FUGU_DIR . '/helpers.php' );

	// Admin meta
	require( FUGU_DIR . '/admin-meta.php' );

    // Block editor (Gutenberg)
    require( FUGU_DIR . '/block-editor/block-editor.php' );

	// Visual composer
	require( FUGU_DIR . '/visual-composer/init.php' );

	if ( fugu_woocommerce_activated() ) {
        // Globals: WooCommerce - Custom variation controls
        $fugu_globals['custom_variation_controls'] = ( $fugu_theme_options['product_display_attributes'] || $fugu_theme_options['shop_filters_custom_controls'] || $fugu_theme_options['product_custom_controls'] ) ? true : false;

        // WooCommerce: Wishlist
		$fugu_globals['wishlist_enabled'] = class_exists( 'FUGU_Wishlist' );

		// WooCommerce: Functions
		include( FUGU_DIR . '/woocommerce/woocommerce-functions.php' );
        // WooCommerce: Template functions
		include( FUGU_DIR . '/woocommerce/woocommerce-template-functions.php' );
        // WooCommerce: Attribute functions
		if ( $fugu_globals['custom_variation_controls'] ) {
            include( FUGU_DIR . '/woocommerce/woocommerce-attribute-functions.php' );
        }

		// WooCommerce: Quick view
		if ( $fugu_theme_options['product_quickview'] ) {
			$fugu_page_includes['quickview'] = true;
			include( FUGU_DIR . '/woocommerce/quickview.php' );
		}

		// WooCommerce: Shop search
        if ( $fugu_theme_options['shop_search'] !== '0' ) {
            // Globals: Shop search
			$fugu_globals['shop_search_enabled'] = true;
            if ( $fugu_theme_options['shop_search'] === 'header' ) {
                $fugu_globals['shop_search_header'] = true;
            }

            include( FUGU_DIR . '/woocommerce/search.php' );

            // WooCommerce: Search suggestions
            if ( ( $fugu_globals['shop_search_header'] && $fugu_theme_options['shop_search_suggestions'] ) || defined( 'FUGU_SUGGESTIONS_INCLUDE' ) ) {
                $fugu_globals['shop_search_suggestions_max_results'] = intval( apply_filters( 'fugu_shop_search_suggestions_max_results', $fugu_theme_options['shop_search_suggestions_max_results'] ) );

                include( FUGU_DIR . '/woocommerce/class-search-suggestions.php' );
            }
		}

        // WooCommerce: Cart - Shipping meter
        if ( $fugu_theme_options['cart_shipping_meter'] ) {
            include( FUGU_DIR . '/woocommerce/class-cart-free-shipping-meter.php' );
        }
	}


    /* Admin includes
	==================================================================================================== */

	if ( is_admin() ) {
        // TGM plugin activation
		require( FUGU_DIR . '/tgmpa/config.php' );

        // Theme setup wizard
        require_once( FUGU_DIR . '/setup/class-fugu-setup.php' );

        if ( fugu_woocommerce_activated() ) {
			// WooCommerce: Product details
			include( FUGU_DIR . '/woocommerce/admin/admin-product-details.php' );
			// WooCommerce: Product categories
			include( FUGU_DIR . '/woocommerce/admin/class-admin-product-categories.php' );
            // WooCommerce: Product attributes
			if ( $fugu_globals['custom_variation_controls'] ) {
                include( FUGU_DIR . '/woocommerce/admin/class-admin-product-attributes.php' );
                include( FUGU_DIR . '/woocommerce/admin/class-admin-product-data.php' );
            }

            // WooCommerce: Product editor blocks
			//include( FUGU_DIR . '/woocommerce/admin/admin-product-editor-blocks.php' );
		}
	}


	/* Globals (requires includes)
	==================================================================================================== */

    // Globals: Login link
    $fugu_globals['login_popup'] = false;

    // Globals: Cart link/panel
	$fugu_globals['cart_link']   = false;
	$fugu_globals['cart_panel']  = false;

    // Globals: Shop filters popup
    $fugu_globals['shop_filters_popup'] = false;

	// Globals: Shop filters scrollbar
	$fugu_globals['shop_filters_scrollbar'] = false;

    // Globals: Infinite load - Snapback cache
    $fugu_globals['snapback_cache'] = 0;
    $fugu_globals['snapback_cache_links'] = '';

	if ( fugu_woocommerce_activated() ) {
		// Global: Shop page id
		$fugu_globals['shop_page_id'] = ( ! empty( $_GET['shop_page'] ) ) ? intval( $_GET['shop_page'] ) : wc_get_page_id( 'shop' );

		// Globals: Login link
		$fugu_globals['login_popup'] = ( $fugu_theme_options['menu_login_popup'] ) ? true : false;

		// Global: Cart link/panel
		if ( $fugu_theme_options['menu_cart'] != '0' && ! $fugu_theme_options['shop_catalog_mode'] ) {
			$fugu_globals['cart_link'] = true;

			// Is mini cart panel enabled?
			if ( $fugu_theme_options['menu_cart'] != 'link' ) {
				$fugu_globals['cart_panel'] = true;
			}
		}

        // Globals: Shop filters popup
        if ( $fugu_theme_options['shop_filters'] == 'popup' ) {
            $fugu_globals['shop_filters_popup'] = true;
        }

		// Globals: Shop filters scrollbar
        if ( $fugu_theme_options['shop_filters_scrollbar'] ) {
			$fugu_globals['shop_filters_scrollbar'] = true;
		}

        // Globals: Shop search
        if ( $fugu_globals['shop_search_enabled'] && ! $fugu_globals['shop_search_header'] ) {
            if ( $fugu_globals['shop_filters_popup'] ) {
                $fugu_globals['shop_search_popup'] = true; // Show search in filters pop-up
            } else {
                $fugu_globals['shop_search'] = true; // Show search in shop header
            }
        }

        // Globals: Infinite load - Snapback cache
        if ( $fugu_theme_options['shop_infinite_load'] !== '0' ) {
            $fugu_globals['snapback_cache'] = apply_filters( 'fugu_infload_snapback_cache', 0 );

            if ( $fugu_globals['snapback_cache'] ) {
                // Shop links that can be used to generate cache
                $snapback_cache_links = array(
                    '.fugu-shop-loop-attribute-link',
                    '.product_type_variable',
                    '.product_type_grouped',
                );
                if ( $fugu_theme_options['product_quickview_link_actions']['link'] !== '1' ) {
                    $snapback_cache_links[] = '.fugu-quickview-btn';
                }
                if ( $fugu_theme_options['product_quickview_link_actions']['thumb'] !== '1' ) {
                    $snapback_cache_links[] = '.fugu-shop-loop-thumbnail-link';
                }
                if ( $fugu_theme_options['product_quickview_link_actions']['title'] !== '1' ) {
                    $snapback_cache_links[] = '.fugu-shop-loop-title-link';
                }

                $snapback_cache_links = apply_filters( 'fugu_infload_snapback_cache_links', $snapback_cache_links );

                $fugu_globals['snapback_cache_links'] = implode ( ', ', $snapback_cache_links );
            }
        }

        // Globals: Product gallery zoom
        $fugu_globals['product_image_hover_zoom'] = ( $fugu_theme_options['product_image_hover_zoom'] ) ? true : false;
	}


	/* Theme Support
	==================================================================================================== */

	if ( ! function_exists( 'fugu_theme_support' ) ) {
		function fugu_theme_support() {
			global $fugu_theme_options;

            // Let WordPress manage the document title (no hard-coded <title> tag in the document head)
            add_theme_support( 'title-tag' );

			// Enables post and comment RSS feed links to head
			add_theme_support( 'automatic-feed-links' );

			// Add thumbnail theme support
			add_theme_support( 'post-thumbnails' );

            // WooCommerce
			add_theme_support( 'woocommerce' );
            add_theme_support( 'wc-product-gallery-slider' );
            if ( $fugu_theme_options['product_image_zoom'] ) {
                add_theme_support( 'wc-product-gallery-lightbox' );
            }

            // Localisation
            // Child theme language directory: wp-content/themes/child-theme-name/languages/xx_XX.mo
            $textdomain_loaded = load_theme_textdomain( 'fugu-framework', get_stylesheet_directory() . '/languages' );
            // Theme language directory: wp-content/themes/theme-name/languages/xx_XX.mo
            if ( ! $textdomain_loaded ) {
                $textdomain_loaded = load_theme_textdomain( 'fugu-framework', FUGU_THEME_DIR . '/languages' );
            }
			// WordPress language directory: wp-content/languages/theme-name/xx_XX.mo
			if ( ! $textdomain_loaded ) {
                load_theme_textdomain( 'fugu-framework', trailingslashit( WP_LANG_DIR ) . 'fugu-framework' );
            }
		}
	}
	add_action( 'after_setup_theme', 'fugu_theme_support' );

	// Maximum width for media
	if ( ! isset( $content_width ) ) {
		$content_width = 1220; // Pixels
	}


	/* Styles
	==================================================================================================== */

	function fugu_styles() {
		global $fugu_theme_options, $fugu_globals, $fugu_page_includes;

        if ( defined( 'FUGU_DEBUG_MODE' ) && FUGU_DEBUG_MODE ) {
            $suffix = '';
        } else {
            $suffix = '.min';
        }

        // Deregister "WPZoom Instagram" widget styles (if widget isn't added)
        if ( defined( 'WPZOOM_INSTAGRAM_VERSION' ) ) {
            $deregister_wpzoom_styles = apply_filters( 'fugu_deregister_wpzoom_styles', true );
            if ( $deregister_wpzoom_styles && ! is_active_widget( false, false, 'wpzoom_instagram_widget', true ) ) {
                wp_deregister_style( 'magnific-popup' );
                wp_deregister_style( 'zoom-instagram-widget' );
            }
        }

		// Enqueue third-party styles
		wp_enqueue_style( 'normalize', FUGU_THEME_URI . '/assets/css/third-party/normalize' . $suffix . '.css', array(), '3.0.2', 'all' );
		wp_enqueue_style( 'slick-slider', FUGU_THEME_URI . '/assets/css/third-party/slick' . $suffix . '.css', array(), '1.5.5', 'all' );
		wp_enqueue_style( 'slick-slider-theme', FUGU_THEME_URI . '/assets/css/third-party/slick-theme' . $suffix . '.css', array(), '1.5.5', 'all' );
        wp_enqueue_style( 'magnific-popup', FUGU_THEME_URI . '/assets/css/third-party/magnific-popup' . $suffix . '.css', array(), false, 'all' );
		if ( $fugu_theme_options['font_awesome'] ) {
            if ( $fugu_theme_options['font_awesome_version'] == '4' ) {
                wp_enqueue_style( 'font-awesome', '//stackpath.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css', array(), false, 'all' );
            } else {
                $font_awesome_cdn_url = apply_filters( 'fugu_font_awesome_cdn_url', 'https://kit-free.fontawesome.com/releases/latest/css/free.min.css' );
                wp_enqueue_style( 'font-awesome', $font_awesome_cdn_url, array(), '5.x', 'all' );
            }
		}

		// Theme styles: Grid (enqueue before shop styles)
		wp_enqueue_style( 'fugu-grid', FUGU_THEME_URI . '/assets/css/grid.css', array(), FUGU_THEME_VERSION, 'all' );

		// WooCommerce styles
		if ( fugu_woocommerce_activated() ) {
            if ( is_cart() ) {
                // Cart panel: Disable on "Cart" page
                $fugu_globals['cart_panel'] = false;
            } else if ( is_checkout() ) {
                // Cart panel: Disable on "Checkout" page
                $fugu_globals['cart_panel'] = false;
            }

            if ( $fugu_theme_options['product_custom_select'] ) {
                wp_enqueue_style( 'selectod', FUGU_THEME_URI . '/assets/css/third-party/selectod' . $suffix . '.css', array(), '3.8.1', 'all' );
            }
			wp_enqueue_style( 'fugu-shop', FUGU_THEME_URI . '/assets/css/shop.css', array(), FUGU_THEME_VERSION, 'all' );
		}

		// Theme styles
		wp_enqueue_style( 'fugu-icons', FUGU_THEME_URI . '/assets/css/font-icons/theme-icons/theme-icons' . $suffix . '.css', array(), FUGU_THEME_VERSION, 'all' );
		wp_enqueue_style( 'fugu-core', FUGU_THEME_URI . '/style.css', array(), FUGU_THEME_VERSION, 'all' );
		wp_enqueue_style( 'fugu-elements', FUGU_THEME_URI . '/assets/css/elements.css', array(), FUGU_THEME_VERSION, 'all' );
	}
	add_action( 'wp_enqueue_scripts', 'fugu_styles', 99 );


	/* Scripts
	==================================================================================================== */

    /* Scripts: Get Path and Suffix presets (includes un-minified scripts in "debug mode") */
    function fugu_scripts_get_presets() {
        $presets = array();

        if ( defined( 'FUGU_DEBUG_MODE' ) && FUGU_DEBUG_MODE ) {
            $presets['path'] = FUGU_THEME_URI . '/assets/js/dev/';
            $presets['suffix'] = '';
        } else {
            $presets['path'] = FUGU_THEME_URI . '/assets/js/';
            $presets['suffix'] = '.min';
        }

        return $presets;
    }

    /* Scripts: Product page  */
    function fugu_scripts_product_page( $presets ) {
        global $fugu_globals;

        if ( $fugu_globals['product_image_hover_zoom'] ) {
            wp_enqueue_script( 'easyzoom', FUGU_THEME_URI . '/assets/js/plugins/easyzoom.min.js', array( 'jquery' ), '2.5.2', true );
        }
        wp_enqueue_script( 'selectod' );
        wp_enqueue_script( 'fugu-shop-add-to-cart' );
        wp_enqueue_script( 'fugu-shop-single-product', $presets['path'] . 'fugu-shop-single-product' . $presets['suffix'] . '.js', array( 'jquery', 'fugu-shop' ), FUGU_THEME_VERSION, true );
    }

    /* Scripts: Enqueue */
	function fugu_scripts() {
		if ( ! is_admin() ) {
			global $fugu_theme_options, $fugu_globals, $fugu_page_includes;

			// Script path and suffix setup (debug mode loads un-minified scripts)
            $presets = fugu_scripts_get_presets();

            // Register scripts
            wp_register_script( 'fugu-masonry', FUGU_THEME_URI . '/assets/js/plugins/masonry.pkgd.min.js', array(), '4.2.2', true ); // Note: Using "fugu-" prefix so the included WP version isn't used (it doesn't support the "horizontalOrder" option)
            wp_register_script( 'smartscroll', FUGU_THEME_URI . '/assets/js/plugins/jquery.smartscroll.min.js', array( 'jquery' ), '1.0', true );

			// Enqueue scripts
			wp_enqueue_script( 'modernizr', FUGU_THEME_URI . '/assets/js/plugins/modernizr.min.js', array( 'jquery' ), '2.8.3', true );
            if ( $fugu_globals['snapback_cache'] ) {
                wp_enqueue_script( 'snapback-cache', FUGU_THEME_URI . '/assets/js/plugins/snapback-cache.min.js', array( 'jquery' ), FUGU_THEME_VERSION, true );
            }
            wp_enqueue_script( 'slick-slider', FUGU_THEME_URI . '/assets/js/plugins/slick.min.js', array( 'jquery' ), '1.5.5', true );
			wp_enqueue_script( 'magnific-popup', FUGU_THEME_URI . '/assets/js/plugins/jquery.magnific-popup.min.js', array( 'jquery' ), '1.2.0', true );
            wp_enqueue_script( 'fugu-core', $presets['path'] . 'fugu-core' . $presets['suffix'] . '.js', array( 'jquery' ), FUGU_THEME_VERSION, true );

			// Enqueue blog scripts
            wp_enqueue_script( 'fugu-blog', $presets['path'] . 'fugu-blog' . $presets['suffix'] . '.js', array( 'jquery' ), FUGU_THEME_VERSION, true );
			if ( $fugu_theme_options['blog_infinite_load'] === 'scroll' ) {
                wp_enqueue_script( 'smartscroll' );
            }

			// WP comments script
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}

			if ( fugu_woocommerce_activated() ) {
				// Register shop/product scripts
				if ( $fugu_theme_options['product_custom_select'] ) {
                    wp_register_script( 'selectod', FUGU_THEME_URI . '/assets/js/plugins/selectod.custom.min.js', array( 'jquery' ), '3.8.1', true );
                }
				if ( $fugu_theme_options['product_ajax_atc'] && get_option( 'woocommerce_cart_redirect_after_add' ) == 'no' ) {
                    wp_register_script( 'fugu-shop-add-to-cart', $presets['path'] . 'fugu-shop-add-to-cart' . $presets['suffix'] . '.js', array( 'jquery', 'fugu-shop' ), FUGU_THEME_VERSION, true );
                }
				wp_register_script( 'fugu-shop', $presets['path'] . 'fugu-shop' . $presets['suffix'] . '.js', array( 'jquery', 'fugu-core'/*, 'selectod'*/ ), FUGU_THEME_VERSION, true );
				wp_register_script( 'fugu-shop-quickview', $presets['path'] . 'fugu-shop-quickview' . $presets['suffix'] . '.js', array( 'jquery', 'fugu-shop', 'wc-add-to-cart-variation' ), FUGU_THEME_VERSION, true );
				wp_register_script( 'fugu-shop-login', $presets['path'] . 'fugu-shop-login' . $presets['suffix'] . '.js', array( 'jquery' ), FUGU_THEME_VERSION, true );
                wp_register_script( 'fugu-shop-infload', $presets['path'] . 'fugu-shop-infload' . $presets['suffix'] . '.js', array( 'jquery', 'fugu-shop' ), FUGU_THEME_VERSION, true );
				wp_register_script( 'fugu-shop-filters', $presets['path'] . 'fugu-shop-filters' . $presets['suffix'] . '.js', array( 'jquery', 'fugu-shop' ), FUGU_THEME_VERSION, true );

				// Login popup
				if ( $fugu_globals['login_popup'] ) {
					wp_enqueue_script( 'fugu-shop-login' );

                    // Enqueue "password strength meter" script
                    // Note: The code below is from the "../plugins/woocommerce/includes/class-wc-frontend-scripts.php" file
                    if ( ! is_cart() || ! is_checkout() || ! is_account_page() ) {
                        if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) && ! is_user_logged_in() ) {
                            wp_enqueue_script( 'wc-password-strength-meter' );
                            wp_localize_script( 'wc-password-strength-meter', 'wc_password_strength_meter_params', apply_filters( 'wc_password_strength_meter_params', array(
                                'min_password_strength' => apply_filters( 'woocommerce_min_password_strength', 3 ),
                                'i18n_password_error'   => esc_attr__( 'Please enter a stronger password.', 'woocommerce' ),
                                'i18n_password_hint'    => esc_attr( wp_get_password_hint() ),
                            ) ) );
                        }
                    }
				}

                // Cart panel - Quantity arrows: Make sure WooCommerce cart fragments script is enqueued
                if ( $fugu_theme_options['cart_panel_quantity_arrows'] ) {
                    wp_enqueue_script( 'wc-cart-fragments' );
                }

                // Product search
                if ( $fugu_globals['shop_search_enabled'] ) {
                    wp_enqueue_script( 'fugu-shop-search', $presets['path'] . 'fugu-shop-search' . $presets['suffix'] . '.js', array( 'jquery' ), FUGU_THEME_VERSION, true );
                }

				// WooCommerce page - Note: Does not include the Cart, Checkout or Account pages
				if ( is_woocommerce() ) {
					// Single product page
					if ( is_product() ) {
                        fugu_scripts_product_page( $presets );
					}
					// Shop page (except Single product, Cart and Checkout)
					else {
                        if ( $fugu_theme_options['shop_infinite_load'] !== '0' ) {
                            wp_enqueue_script( 'smartscroll' );
                            wp_enqueue_script( 'fugu-shop-infload' );
                        }
						wp_enqueue_script( 'fugu-shop-filters' );
					}
				} else {
					// Cart page
					if ( is_cart() ) {
						wp_enqueue_script( 'fugu-shop-cart', $presets['path'] . 'fugu-shop-cart' . $presets['suffix'] . '.js', array( 'jquery', 'fugu-shop' ), FUGU_THEME_VERSION, true );
					}
					// Checkout page
					else if ( is_checkout() ) {
						wp_enqueue_script( 'fugu-shop-checkout', $presets['path'] . 'fugu-shop-checkout' . $presets['suffix'] . '.js', array( 'jquery', 'fugu-shop' ), FUGU_THEME_VERSION, true );
					}
					// Account page
					else if ( is_account_page() ) {
						wp_enqueue_script( 'fugu-shop-login' );
					}
				}
			}

			// Add local Javascript variables
            $local_js_vars = array(
                'themeUri' 				        => FUGU_THEME_URI,
                'ajaxUrl' 				        => admin_url( 'admin-ajax.php', 'relative' ),
                'woocommerceAjaxUrl'            => ( class_exists( 'WC_AJAX' ) ) ? WC_AJAX::get_endpoint( "%%endpoint%%" ) : '',
				'searchUrl'				        => esc_url_raw( add_query_arg( 's', '%%nmsearchkey%%', home_url( '/' ) ) ), // Code from "WC_AJAX->get_endpoint()" WooCommerce function
                'pageLoadTransition'            => intval( $fugu_theme_options['page_load_transition'] ),
                'topBarCycleInterval'           => intval( apply_filters( 'fugu_top_bar_cycle_interval', 5000 ) ),
                'headerPlaceholderSetHeight'    => intval( apply_filters( 'fugu_header_placeholder_set_height', 1 ) ),
                'headerFixedScrollUp'           => intval( $fugu_theme_options['header_fixed_on_scroll_up'] ),
                'cartPanelQtyArrows'            => intval( $fugu_theme_options['cart_panel_quantity_arrows'] ),
                'cartPanelQtyThrottleTimeout'   => $fugu_globals['cart_panel_qty_throttle'],
                'cartPanelShowOnAtc'            => intval( $fugu_theme_options['widget_panel_show_on_atc'] ),
                'cartPanelHideOnAtcScroll'      => ( ! defined( 'FUGU_ATC_SCROLL' ) ) ? 1 : 0,
                'cartShippingMeter'             => intval( $fugu_theme_options['cart_shipping_meter'] ),
                'shopFiltersAjax'		        => esc_attr( $fugu_theme_options['shop_filters_enable_ajax'] ),
                'shopFiltersMobileAutoClose'    => intval( apply_filters( 'fugu_shop_filters_mobile_auto_close', 1 ) ),
                'shopFiltersPopupAutoClose'     => intval( apply_filters( 'fugu_shop_filters_popup_auto_close', 1 ) ),
				'shopAjaxUpdateTitle'	        => intval( $fugu_theme_options['shop_ajax_update_title'] ),
				'shopImageLazyLoad'		        => intval( $fugu_theme_options['product_image_lazy_loading'] ),
                'shopAttsSwapImage'             => intval( $fugu_theme_options['product_attributes_swap_image'] ),
                'shopAttsSwapImageRevert'       => intval( apply_filters( 'fugu_product_attributes_swap_image_revert', 1 ) ),
                'shopAttsSwapImageOnTouch'      => intval( apply_filters( 'fugu_product_attributes_swap_image_ontouch', 1 ) ),
                'shopScrollOffset' 		        => intval( $fugu_theme_options['shop_scroll_offset'] ),
				'shopScrollOffsetTablet'        => intval( $fugu_theme_options['shop_scroll_offset_tablet'] ),
                'shopScrollOffsetMobile'        => intval( $fugu_theme_options['shop_scroll_offset_mobile'] ),
                'shopSearch'                    => ( $fugu_globals['shop_search_enabled']  ) ? 1 : 0,
                'shopSearchHeader'			    => ( $fugu_globals['shop_search_header'] ) ? 1 : 0,
                'shopSearchUrl'                 => esc_url_raw( apply_filters( 'fugu_shop_search_url', add_query_arg( array( 'post_type' => 'product', 's' => '%%nmsearchkey%%' ), home_url( '/' ) ) ) ),
                'shopSearchMinChar'		        => intval( $fugu_theme_options['shop_search_min_char'] ),
				'shopSearchAutoClose'           => 0,//intval( $fugu_theme_options['shop_search_auto_close'] ),
                'searchSuggestions'             => intval( $fugu_theme_options['shop_search_suggestions'] ),
                'searchSuggestionsInstant'      => intval( $fugu_theme_options['shop_search_suggestions_instant'] ),
                'searchSuggestionsMax'          => $fugu_globals['shop_search_suggestions_max_results'],
                'shopAjaxAddToCart'		        => ( $fugu_theme_options['product_ajax_atc'] && get_option( 'woocommerce_cart_redirect_after_add' ) == 'no' ) ? 1 : 0,
                'shopRedirectScroll'            => intval( $fugu_theme_options['product_redirect_scroll'] ),
                'shopCustomSelect'              => intval( $fugu_theme_options['product_custom_select'] ),
                'quickviewLinks'                => $fugu_theme_options['product_quickview_link_actions'],
                'quickViewGalleryInfinite'      => intval( apply_filters( 'fugu_quickview_gallery_infinite', 0 ) ), // Note: Not compatible with variation images (since first image is cloned)
                'galleryZoom'                   => intval( $fugu_theme_options['product_image_zoom'] ),
                'galleryThumbnailsSlider'       => intval( $fugu_theme_options['product_thumbnails_slider'] ),
                'shopYouTubeRelated'            => ( ! defined( 'FUGU_SHOP_YOUTUBE_RELATED' ) ) ? 1 : 0,
                'productPinDetailsOffset'       => intval( apply_filters( 'fugu_product_pin_details_offset', 30 ) ),
                'productAccordionCloseOpen'     => intval( apply_filters( 'fugu_product_accordion_close_open', 1 ) ),
                'checkoutTacLightbox'           => intval( $fugu_theme_options['checkout_tac_lightbox'] ),
                'rowVideoOnTouch'               => ( ! defined( 'FUGU_ROW_VIDEO_ON_TOUCH' ) ) ? 0 : 1,
                'wpGalleryPopup'                => intval( $fugu_theme_options['wp_gallery_popup'] ),
                'touchHover'		            => intval( apply_filters( 'fugu_touch_hover', 0 ) ), // Note: Set to "0" in v3.0.6
                'pushStateMobile'               => intval( apply_filters( 'fugu_push_state_mobile', 1 ) ), // Note: Set to "1" in v2.7.5
                'infloadBuffer'                 => intval( apply_filters( 'fugu_infload_scroll_buffer', 0 ) ),
                'infloadBufferBlog'             => intval( apply_filters( 'fugu_blog_infload_scroll_buffer', 0 ) ),
                'infloadPreserveScrollPos'      => intval( apply_filters( 'fugu_infload_preserve_scroll_position', 1 ) ),
                'infloadSnapbackCache'          => intval( $fugu_globals['snapback_cache'] ),
                'infloadSnapbackCacheLinks'     => esc_attr( $fugu_globals['snapback_cache_links'] ),
			);
    		wp_localize_script( 'fugu-core', 'fugu_wp_vars', $local_js_vars );
		}
	}
	add_action( 'wp_enqueue_scripts', 'fugu_scripts' );


    /* Scripts - Content dependent: Uses globals to check for included content */
	function fugu_scripts_content_dependent() {
		if ( ! is_admin() ) {
			global $fugu_theme_options, $fugu_globals, $fugu_page_includes;

			// Blog
			if ( isset( $fugu_page_includes['blog-masonry'] ) ) {
                wp_enqueue_script( 'fugu-masonry' );
            }

			if ( fugu_woocommerce_activated() ) {
                // Product categories
                if ( isset( $fugu_page_includes['product_categories_masonry'] ) ) {
                    wp_enqueue_script( 'fugu-masonry' );
                }

				// Shop/products
				if ( isset( $fugu_page_includes['products'] ) ) {
					if ( $fugu_theme_options['product_image_lazy_loading'] ) {
                        wp_enqueue_script( 'lazysizes', FUGU_THEME_URI . '/assets/js/plugins/lazysizes.min.js', array(), '4.0.1', true );
                    }
                    wp_enqueue_script( 'selectod' );
					wp_enqueue_script( 'fugu-shop-add-to-cart' );
					if ( $fugu_theme_options['product_quickview'] ) {
						wp_enqueue_script( 'fugu-shop-quickview' );
					}
				} else if ( isset( $fugu_page_includes['wishlist-home'] ) ) {
					wp_enqueue_script( 'fugu-shop-add-to-cart' );
				}

                // Single product: Product page shortcode
                if ( ! is_product() && isset( $fugu_globals['is_product'] ) ) {
                    $presets = fugu_scripts_get_presets();
                    fugu_scripts_product_page( $presets );
                }
				// Single product: Scroll gallery
                if ( isset( $fugu_page_includes['product-layout-scroll'] ) ) {
                    wp_enqueue_script( 'pin', FUGU_THEME_URI . '/assets/js/plugins/jquery.pin.min.js', array( 'jquery' ), '1.0.3', true );
				}
			}
		}
	}
	add_action( 'wp_footer', 'fugu_scripts_content_dependent' );


	/* Admin Assets
	==================================================================================================== */

	function fugu_admin_assets( $hook ) {
		// Styles
		wp_enqueue_style( 'fugu-admin-styles', FUGU_URI . '/assets/css/fugu-wp-admin.css', array(), FUGU_THEME_VERSION, 'all' );

        // Menus page
		if ( 'nav-menus.php' == $hook ) {
            // Init assets for the WP media manager - https://codex.wordpress.org/Javascript_Reference/wp.media
            wp_enqueue_media();

            wp_enqueue_script( 'fugu-admin-menus', FUGU_URI . '/assets/js/fugu-wp-admin-menus.js', array( 'jquery' ), FUGU_THEME_VERSION );
        }
	}
	add_action( 'admin_enqueue_scripts', 'fugu_admin_assets' );


	/* Web fonts
	==================================================================================================== */

	/* Adobe Fonts (formerly Typekit) */
	function fugu_adobe_fonts() {
		global $fugu_theme_options;

        $adobe_fonts_stylesheets = array();

        // Main/body font
        if ( $fugu_theme_options['main_font_source'] === '2' && isset( $fugu_theme_options['main_font_adobefonts_project_id'] ) ) {
            $adobe_fonts_stylesheets[] = $fugu_theme_options['main_font_adobefonts_project_id'];
            wp_enqueue_style( 'fugu-adobefonts-main', '//use.typekit.net/' . esc_attr( $fugu_theme_options['main_font_adobefonts_project_id'] ) . '.css' );
        }

        // Header font
        if ( $fugu_theme_options['header_font_source'] === '2' && isset( $fugu_theme_options['header_font_adobefonts_project_id'] ) ) {
            // Make sure stylesheet name is unique (avoid multiple includes)
            if ( ! in_array( $fugu_theme_options['header_font_adobefonts_project_id'], $adobe_fonts_stylesheets ) ) {
                $adobe_fonts_stylesheets[] = $fugu_theme_options['header_font_adobefonts_project_id'];
                wp_enqueue_style( 'fugu-adobefonts-header', '//use.typekit.net/' . esc_attr( $fugu_theme_options['header_font_adobefonts_project_id'] ) . '.css' );
            }
        }

        // Headings font
        if ( $fugu_theme_options['secondary_font_source'] === '2' && isset( $fugu_theme_options['secondary_font_adobefonts_project_id'] ) ) {
            // Make sure stylesheet name is unique (avoid multiple includes)
            if ( ! in_array( $fugu_theme_options['secondary_font_adobefonts_project_id'], $adobe_fonts_stylesheets ) ) {
                $adobe_fonts_stylesheets[] = $fugu_theme_options['secondary_font_adobefonts_project_id'];
                wp_enqueue_style( 'fugu-adobefonts-secondary', '//use.typekit.net/' . esc_attr( $fugu_theme_options['secondary_font_adobefonts_project_id'] ) . '.css' );
            }
        }
	};
	add_action( 'wp_enqueue_scripts', 'fugu_adobe_fonts' );


    /* WP Customizer - Notice
	==================================================================================================== */

    function fugu_wpcustomizer_notice() {
        $handle = 'fugu-wpcustomizer-notice';

        wp_register_script( $handle, FUGU_URI . '/assets/js/fugu-wpcustomizer-notice.js', array( 'customize-controls' ), FUGU_THEME_VERSION );

        // Get theme name (name changes when child-theme is activated)
        $theme_info = wp_get_theme();
        $theme_name = $theme_info->get('Name');
        $theme_name_nospaces = ( $theme_name ) ? preg_replace( '/\s+/', '', $theme_name ) : 'Fugu'; // Remove whitespace from theme name

        // Create URL for Typography settings page
        $typography_settings_url = admin_url( 'admin.php?page=' . $theme_name_nospaces . '&tab=6' );

        $notice = array(
            'notice' => sprintf(
                esc_html( '%sNote:%s Font settings are available on: <a href="%s">Theme Settings > Typography</a>', 'fugu-framework-admin' ),
                '<strong>',
                '</strong>',
                $typography_settings_url
            )
        );

        wp_localize_script( $handle, 'fugu_wpcustomizer_notice', $notice );
        wp_enqueue_script( $handle );
    }
    add_action( 'customize_controls_enqueue_scripts', 'fugu_wpcustomizer_notice' );


	/* Redux Framework
	==================================================================================================== */

	/* Remove redux sub-menu from "Tools" admin menu */
	function fugu_remove_redux_menu() {
		remove_submenu_page( 'tools.php', 'redux-about' );
	}
	add_action( 'admin_menu', 'fugu_remove_redux_menu', 12 );


	/* Theme Setup
	==================================================================================================== */

    /* Video embeds: Wrap video element in "div" container (to make them responsive) */
    function fugu_wrap_oembed( $html, $url, $attr ) {
        if ( false !== strpos( $url, 'vimeo.com' ) ) {
            return '<div class="fugu-wp-video-wrap fugu-wp-video-wrap-vimeo">' . $html . '</div>';
        }
        if ( false !== strpos( $url, 'youtube.com' ) ) {
            return '<div class="fugu-wp-video-wrap fugu-wp-video-wrap-youtube">' . $html . '</div>';
        }

        return $html;
    }
    add_filter( 'embed_oembed_html', 'fugu_wrap_oembed', 10, 3 );

    function fugu_wrap_video_embeds( $html ) {
        return '<div class="fugu-wp-video-wrap">' . $html . '</div>';
    }
    add_filter( 'video_embed_html', 'fugu_wrap_video_embeds' ); // Jetpack


    /* Body classes
	==================================================================================================== */

    function fugu_body_classes( $classes ) {
        global $fugu_theme_options, $fugu_body_class, $fugu_globals;
        $woocommerce_activated = fugu_woocommerce_activated();

        // Make sure $fugu_body_class is an array
        $fugu_body_class = ( is_array( $fugu_body_class ) ) ? $fugu_body_class : array();

        // Page load transition class
        $fugu_body_class[] = 'fugu-page-load-transition-' . $fugu_theme_options['page_load_transition'];

        // CSS animations preload class
        $fugu_body_class[] = 'fugu-preload';

        // Top bar class
        if ( $fugu_theme_options['top_bar'] ) {
            $fugu_body_class[] = 'has-top-bar top-bar-mobile-' . $fugu_theme_options['top_bar_mobile'];
        }

        // Header: Classes - Fixed
        $header_checkout_allow_fixed = ( $woocommerce_activated && is_checkout() ) ? apply_filters( 'fugu_header_checkout_allow_fixed', false ) : true;
        if ( $fugu_theme_options['header_fixed'] && $header_checkout_allow_fixed ) {
            $fugu_body_class[] = 'header-fixed';
            if ( $fugu_theme_options['header_fixed_on_scroll_up'] ) {
                $fugu_body_class[] = 'header-fixed-on-scroll-up';
            }
        }


        // Header: Classes - Mobile layout
        //$fugu_body_class[] = 'header-mobile-' . $fugu_theme_options['header_layout_mobile'];
        $fugu_body_class[] = apply_filters( 'fugu_body_class_header_mobile', 'header-mobile-default' );

        // Header: Classes - Transparency
        global $post;
        $page_header_transparency = ( $post ) ? get_post_meta( $post->ID, 'fugu_page_header_transparency', true ) : array();
        if ( ! empty( $page_header_transparency ) ) {
            $fugu_body_class[] = 'header-transparency header-transparency-' . $page_header_transparency;
        } else if ( $fugu_theme_options['header_transparency'] ) {
            if ( is_front_page() ) {
                $fugu_body_class[] = ( $fugu_theme_options['header_transparency_homepage'] !== '0' ) ? 'header-transparency header-transparency-' . $fugu_theme_options['header_transparency_homepage'] : '';
            } else if ( is_home() ) { // Note: This is the blog/posts page, not the homepage
                $fugu_body_class[] = ( $fugu_theme_options['header_transparency_blog'] !== '0' ) ? 'header-transparency header-transparency-' . $fugu_theme_options['header_transparency_blog'] : '';
            } else if ( is_singular( 'post' ) ) {
                $fugu_body_class[] = ( $fugu_theme_options['header_transparency_blog_post'] !== '0' ) ? 'header-transparency header-transparency-' . $fugu_theme_options['header_transparency_blog_post'] : '';
            } else if ( $woocommerce_activated ) {
                if ( is_shop() ) {
                    $fugu_body_class[] = ( $fugu_theme_options['header_transparency_shop'] !== '0' ) ? 'header-transparency header-transparency-' . $fugu_theme_options['header_transparency_shop'] : '';
                } else if ( is_product_taxonomy() ) {
                    $fugu_body_class[] = ( $fugu_theme_options['header_transparency_shop_categories'] !== '0' ) ? 'header-transparency header-transparency-' . $fugu_theme_options['header_transparency_shop_categories'] : '';
                } else if ( is_product() ) {
                    $fugu_body_class[] = ( $fugu_theme_options['header_transparency_product'] !== '0' ) ? 'header-transparency header-transparency-' . $fugu_theme_options['header_transparency_product'] : '';
                }
            }
        }

        // Header: Classes - Border
        if ( is_front_page() ) {
            $fugu_body_class[] = 'header-border-' . $fugu_theme_options['home_header_border'];
        } elseif ( $woocommerce_activated && ( is_shop() || is_product_taxonomy() ) ) {
            $fugu_body_class[] = 'header-border-' . $fugu_theme_options['shop_header_border'];
        } else {
            $fugu_body_class[] = 'header-border-' . $fugu_theme_options['header_border'];
        }

        // Header: Mobile menu
        $fugu_body_class[] = 'mobile-menu-layout-' . $fugu_theme_options['menu_mobile_layout'];
        if ( $fugu_theme_options['menu_mobile_layout'] === 'side' ) {
            $fugu_body_class[] = apply_filters( 'fugu_mobile_menu_side_panels_class', 'mobile-menu-panels' );
        }
        if ( $fugu_theme_options['menu_mobile_desktop'] ) {
            $fugu_body_class[] = 'mobile-menu-desktop';
        }

        // Cart panel classes
        $fugu_body_class[] = 'cart-panel-' . $fugu_theme_options['widget_panel_color'];
        if ( $fugu_globals['cart_panel_qty_throttle'] > 0 ) {
            $fugu_body_class[] = 'cart-panel-qty-throttle';
        }

        // WooCommerce: login
        if ( $woocommerce_activated && ! is_user_logged_in() && is_account_page() ) {
            $fugu_body_class[] = 'fugu-woocommerce-account-login';
        }

        // WooCommerce: Catalog mode
        if ( $fugu_theme_options['shop_catalog_mode'] ) {
            $fugu_body_class[] = 'fugu-catalog-mode';
        }

        // WooCommerce: Shop preloading
        //$fugu_body_class[] = 'fugu-shop-preloader-' . $fugu_theme_options['shop_ajax_preloader_style'];
        $fugu_globals['preloader_style'] = apply_filters( 'fugu_shop_ajax_preloader_style', 'spinner' );
        $fugu_body_class[] = 'fugu-shop-preloader-' . $fugu_globals['preloader_style'];

        // WooCommerce: Shop filters scroll
        $shop_scroll_options = apply_filters( 'fugu_shop_scroll_options', array(
            'header'    => false,
            'default'   => true,
            'popup'     => true,
        ) );
        if ( isset( $shop_scroll_options[$fugu_theme_options['shop_filters']] ) && $shop_scroll_options[$fugu_theme_options['shop_filters']] == true ) {
            $fugu_body_class[] = 'fugu-shop-scroll-enabled';
        }

        $body_class = array_merge( $classes, $fugu_body_class );

        return $body_class;
    }
    add_filter( 'body_class', 'fugu_body_classes' );


    /* Header
	==================================================================================================== */

    /* Header: Get classes */
    function fugu_header_get_classes() {
        global $fugu_globals, $fugu_theme_options;

        // Layout class
        $header_classes = $fugu_theme_options['header_layout'];

        // Scroll class
        $header_scroll_class = apply_filters( 'fugu_header_on_scroll_class', 'resize-on-scroll' );
        $header_classes .= ( strlen( $header_scroll_class ) > 0 ) ? ' ' . $header_scroll_class : '';

        // Alternative logo class
        if ( $fugu_theme_options['alt_logo'] && isset( $fugu_theme_options['alt_logo_visibility'] ) ) {
            $alt_logo_class = '';
            foreach( $fugu_theme_options['alt_logo_visibility'] as $key => $val ) {
                if ( $val === '1' ) {
                    $alt_logo_class .= ' ' . $key;
                }
            }
            $header_classes .= $alt_logo_class;
        }

        // Mobile menu class
        $mobile_menu_icon_bold = apply_filters( 'header_mobile_menu_icon_bold', true );
        $header_classes .= ( $mobile_menu_icon_bold ) ? ' mobile-menu-icon-bold' : ' mobile-menu-icon-thin';

        return $header_classes;
    }

    /* Logo: Get logo */
    function fugu_logo() {
        global $fugu_theme_options;

        if ( isset( $fugu_theme_options['logo'] ) && strlen( $fugu_theme_options['logo']['url'] ) > 0 ) {
            $logo = array(
                'id'        => $fugu_theme_options['logo']['id'],
                'url'       => ( is_ssl() ) ? str_replace( 'http://', 'https://', $fugu_theme_options['logo']['url'] ) : $fugu_theme_options['logo']['url'],
                'width'     => $fugu_theme_options['logo']['width'],
                'height'    => $fugu_theme_options['logo']['height']
            );
        } else {
            $logo = array(
                'id'        => '',
                'url'       => FUGU_THEME_URI . '/assets/img/logo-2x.png',
                'width'     => '232',
                'height'    => '33'
            );
        }

        return apply_filters( 'fugu_logo', $logo );
    }

    /* (Included for backwards compatibility) Logo: Get URL */
    function fugu_logo_get_url() {
        global $fugu_theme_options;

        if ( isset( $fugu_theme_options['logo'] ) && strlen( $fugu_theme_options['logo']['url'] ) > 0 ) {
            $logo_url = ( is_ssl() ) ? str_replace( 'http://', 'https://', $fugu_theme_options['logo']['url'] ) : $fugu_theme_options['logo']['url'];
        } else {
            $logo_url = FUGU_THEME_URI . '/assets/img/logo-2x.png';
        }

        return $logo_url;
    }

    /* Alternative logo: Get logo */
    function fugu_alt_logo() {
        global $fugu_theme_options;

        $logo = null;

        if ( $fugu_theme_options['alt_logo'] ) {
            // Logo URL
            if ( isset( $fugu_theme_options['alt_logo_image'] ) && strlen( $fugu_theme_options['alt_logo_image']['url'] ) > 0 ) {
                $logo = array(
                    'id'        => $fugu_theme_options['alt_logo_image']['id'],
                    'url'       => ( is_ssl() ) ? str_replace( 'http://', 'https://', $fugu_theme_options['alt_logo_image']['url'] ) : $fugu_theme_options['alt_logo_image']['url'],
                    'width'     => $fugu_theme_options['alt_logo_image']['width'],
                    'height'    => $fugu_theme_options['alt_logo_image']['height']
                );
            } else {
                $logo = array(
                    'id'        => '',
                    'url'       => FUGU_THEME_URI . '/assets/img/logo-light-2x.png',
                    'width'     => '232',
                    'height'    => '33'
                );
            }
        }

        return apply_filters( 'fugu_alt_logo', $logo );
    }

    /* (Included for backwards compatibility) Alternative logo: Get URL */
    function fugu_alt_logo_get_url() {
        global $fugu_theme_options;

        $logo_url = null;

        if ( $fugu_theme_options['alt_logo'] ) {
            // Logo URL
            if ( isset( $fugu_theme_options['alt_logo_image'] ) && strlen( $fugu_theme_options['alt_logo_image']['url'] ) > 0 ) {
                $logo_url = ( is_ssl() ) ? str_replace( 'http://', 'https://', $fugu_theme_options['alt_logo_image']['url'] ) : $fugu_theme_options['alt_logo_image']['url'];
            } else {
                $logo_url = FUGU_THEME_URI . '/assets/img/logo-light-2x.png';
            }
        }

        return $logo_url;
    }

    /* Header: Mobile menu button */
    function fugu_header_mobile_menu_button() {
        ?>
        <li class="fugu-menu-offscreen menu-item-default">
            <?php //if ( fugu_woocommerce_activated() ) { echo fugu_get_cart_contents_count(); } ?>
            <a href="#" class="fugu-mobile-menu-button clicked">
                <span class="fugu-menu-icon">
                    <span class="line-1"></span>
                    <span class="line-2"></span>
                    <span class="line-3"></span>
                </span>
            </a>
        </li>
        <?php
    }


    /* Menus
	==================================================================================================== */

	if ( ! function_exists( 'fugu_register_menus' ) ) {
		function fugu_register_menus() {
			register_nav_menus(
                array(
                    'top-bar-menu'          => esc_html__( 'Top Bar', 'fugu-framework' ),
                    'main-menu'             => esc_html__( 'Header Main', 'fugu-framework' ),
                    'right-menu'            => esc_html__( 'Header Secondary', 'fugu-framework' ),
                    'mobile-menu'           => esc_html__( 'Mobile', 'fugu-framework-admin' ),
                    'mobile-menu-secondary' => esc_html__( 'Mobile Secondary', 'fugu-framework-admin' ),
                    'footer-menu'           => esc_html__( 'Footer Bar', 'fugu-framework' ),
                )
            );
		}
	}
	add_action( 'init', 'fugu_register_menus' );

    // Menus: Include custom functions
    require( FUGU_DIR . '/menus/menus.php' );
    if ( is_admin() ) {
        require( FUGU_DIR . '/menus/menus-admin.php' );
    }


	/* Blog
	==================================================================================================== */

    /* AJAX: Get blog content */
	function fugu_blog_get_ajax_content() {
        // Is content requested via AJAX?
        if ( isset( $_REQUEST['blog_load'] ) && fugu_is_ajax_request() ) {
            // Include blog content only (no header or footer)
            get_template_part( 'template-parts/blog/content' );
            exit;
        }
    }

    /* Get static content */
    function fugu_blog_get_static_content() {
        global $fugu_theme_options;

        $blog_page = null;

        if ( isset( $fugu_theme_options['blog_static_page'] ) && ! empty( $fugu_theme_options['blog_static_page'] ) ) {
            if ( ! empty( $fugu_theme_options['blog_static_page_id'] ) ) {
                if ( function_exists( 'fugu_blog_index_vc_styles' ) ) {
                    // WPBakery: Include custom styles, if they exists
                    add_action( 'wp_head', 'fugu_blog_index_vc_styles', 1000 );
                }

                // Using "fugu_shop_get_page_content()" function for Elementor support: $blog_page = get_page( $fugu_theme_options['blog_static_page_id'] );
                $blog_page = fugu_shop_get_page_content( $fugu_theme_options['blog_static_page_id'] );
            }
        }

        return $blog_page;
    }

	/* Post excerpt brackets - [...] */
	function fugu_excerpt_read_more( $excerpt ) {
		$excerpt_more = '&hellip;';
		$trans = array(
			'[&hellip;]' => $excerpt_more // WordPress >= v3.6
		);

		return strtr( $excerpt, $trans );
	}
	add_filter( 'wp_trim_excerpt', 'fugu_excerpt_read_more' );

	/* Blog categories menu */
	function fugu_blog_category_menu() {
		global $wp_query, $fugu_theme_options;

		$current_cat = ( is_category() ) ? $wp_query->queried_object->cat_ID : '';

		// Categories order
		$orderby = 'slug';
		$order = 'asc';
		if ( isset( $fugu_theme_options['blog_categories_orderby'] ) ) {
			$orderby = $fugu_theme_options['blog_categories_orderby'];
			$order = $fugu_theme_options['blog_categories_order'];
		}

		$args = array(
			'type'			=> 'post',
			'orderby'		=> $orderby,
			'order'			=> $order,
			'hide_empty'	=> ( $fugu_theme_options['blog_categories_hide_empty'] ) ? 1 : 0,
			'hierarchical'	=> 1,
			'taxonomy'		=> 'category'
		);

		$categories = get_categories( $args );

		$current_class_set = false;
		$categories_output = '';

		// Categories menu divider
		$categories_menu_divider = apply_filters( 'fugu_blog_categories_divider', '<span>&frasl;</span>' );

		foreach ( $categories as $category ) {
			if ( $current_cat == $category->cat_ID ) {
				$current_class_set = true;
				$current_class = ' class="current-cat"';
			} else {
				$current_class = '';
			}
			$category_link = get_category_link( $category->cat_ID );

			$categories_output .= '<li' . $current_class . '>' . $categories_menu_divider . '<a href="' . esc_url( $category_link ) . '">' . esc_attr( $category->name ) . '</a></li>';
		}

		$categories_count = count( $categories );

		// Categories layout classes
		$categories_class = ' toggle-' . $fugu_theme_options['blog_categories_toggle'];
		if ( $fugu_theme_options['blog_categories_layout'] === 'columns' ) {
			$column_small = ( intval( $fugu_theme_options['blog_categories_columns'] ) > 4 ) ? '3' : '2';
			$categories_ul_class = 'columns small-block-grid-' . $column_small . ' medium-block-grid-' . $fugu_theme_options['blog_categories_columns'];
		} else {
			$categories_ul_class = $fugu_theme_options['blog_categories_layout'];
		}

		// "All" category class attr
		$current_class = ( $current_class_set ) ? '' : ' class="current-cat"';

		$output = '<div class="fugu-blog-categories-wrap ' . esc_attr( $categories_class ) . '">';
		$output .= '<ul class="fugu-blog-categories-toggle"><li><a href="#" id="fugu-blog-categories-toggle-link">' . esc_html__( 'Categories', 'fugu-framework' ) . '</a> <em class="count">' . $categories_count . '</em></li></ul>';
		$output .= '<ul id="fugu-blog-categories-list" class="fugu-blog-categories-list ' . esc_attr( $categories_ul_class ) . '"><li' . $current_class . '><a href="' . esc_url( get_post_type_archive_link( 'post' ) ) . '">' . esc_html__( 'All', 'fugu-framework' ) . '</a></li>' . $categories_output . '</ul>';
        $output .= '</div>';

		return $output;
	}

	/* WP gallery */
    add_filter( 'use_default_gallery_style', '__return_false' );
    if ( $fugu_theme_options['wp_gallery_popup'] ) {
        /* WP gallery popup: Set page include value */
        function fugu_wp_gallery_set_include() {
            fugu_add_page_include( 'wp-gallery' );
            return ''; // Returning an empty string will output the default WP gallery
        }
		add_filter( 'post_gallery', 'fugu_wp_gallery_set_include' );
	}


	/* Comments
	==================================================================================================== */

    /* Comments callback */
	function fugu_comments( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;

		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
		?>
		<li class="post pingback">
			<p><?php esc_html_e( 'Pingback:', 'fugu-framework' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( esc_html__( 'Edit', 'fugu-framework' ), ' ' ); ?></p>
		<?php
			break;
			default :
		?>
		<li id="comment-<?php esc_attr( comment_ID() ); ?>" <?php comment_class(); ?>>
            <div class="comment-inner-wrap">
            	<?php if ( function_exists( 'get_avatar' ) ) { echo get_avatar( $comment, '60' ); } ?>

				<div class="comment-text">
                    <p class="meta">
                        <strong itemprop="author"><?php printf( '%1$s', get_comment_author_link() ); ?></strong>
                        <time itemprop="datePublished" datetime="<?php echo get_comment_date( 'c' ); ?>"><?php printf( esc_html__( '%1$s at %2$s', 'fugu-framework' ), get_comment_date(), get_comment_time() ); ?></time>
                    </p>

                    <div itemprop="description" class="description entry-content">
                        <?php if ( $comment->comment_approved == '0' ) : ?>
                            <p class="moderating"><em><?php esc_html_e( 'Your comment is awaiting moderation', 'fugu-framework' ); ?></em></p>
                        <?php endif; ?>

                        <?php comment_text(); ?>
                    </div>

                    <?php
                        $thread_comments = get_option( 'thread_comments' );
                        $user_can_edit_comment = ( current_user_can( 'edit_comment', $comment->comment_ID ) ) ? true : false;

                        if ( $user_can_edit_comment || '1' === $thread_comments ) :
                    ?>
                    <div class="reply">
                        <?php
                            edit_comment_link( esc_html__( 'Edit', 'fugu-framework' ), '<span class="edit-link">', '</span><span> &nbsp;-&nbsp; </span>' );

                            comment_reply_link( array_merge( $args, array(
                                'depth' 	=> $depth,
                                'max_depth'	=> $args['max_depth']
                            ) ) );
                        ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
		<?php
			break;
		endswitch;
	}


	/* Sidebars & Widgets
	==================================================================================================== */

    /* Classic widgets: Enable the classic widgets settings screens */
    $classic_widgets = apply_filters( 'fugu_classic_widgets', true );
    if ( $classic_widgets ) {
        add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' ); // Disables the block editor from managing widgets in the Gutenberg plugin.
        add_filter( 'use_widgets_block_editor', '__return_false' ); // Disables the block editor from managing widgets.
    }

	/* Register/include sidebars & widgets */
	function fugu_widgets_init() {
		global $fugu_globals, $fugu_theme_options;

        // Sidebar: Page
		register_sidebar( array(
			'name' 				=> esc_html__( 'Page', 'fugu-framework' ),
			'id' 				=> 'page',
			'before_widget'		=> '<div id="%1$s" class="widget %2$s">',
			'after_widget' 		=> '</div>',
			'before_title' 		=> '<h3 class="fugu-widget-title">',
			'after_title' 		=> '</h3>'
		) );

		// Sidebar: Blog
		register_sidebar( array(
			'name' 				=> esc_html__( 'Blog', 'fugu-framework' ),
			'id' 				=> 'sidebar',
			'before_widget'		=> '<div id="%1$s" class="widget %2$s">',
			'after_widget' 		=> '</div>',
			'before_title' 		=> '<h3 class="fugu-widget-title">',
			'after_title' 		=> '</h3>'
		) );

		// Sidebar: Shop
		if ( $fugu_globals['shop_filters_scrollbar'] ) {
            register_sidebar( array(
				'name' 				=> esc_html__( 'Shop', 'fugu-framework' ),
				'id' 				=> 'widgets-shop',
				'before_widget'		=> '<li id="%1$s" class="scroll-enabled scroll-type-default widget %2$s"><div class="fugu-shop-widget-col">',
				'after_widget' 		=> '</div></div></li>',
				'before_title' 		=> '<h3 class="fugu-widget-title">',
				'after_title' 		=> '</h3></div><div class="fugu-shop-widget-col"><div class="fugu-shop-widget-scroll">'
			));

            // Prevent empty widget-titles so the scrollbar container is included
            function fugu_widget_title( $title ) {
                if ( strlen( $title ) == 0 ) {
                    $title = '&nbsp;';
                }
                return $title;
            }
            add_filter( 'widget_title', 'fugu_widget_title' );
		} else {
            register_sidebar( array(
				'name' 				=> esc_html__( 'Shop', 'fugu-framework' ),
				'id' 				=> 'widgets-shop',
				'before_widget'		=> '<li id="%1$s" class="widget %2$s"><div class="fugu-shop-widget-col">',
				'after_widget' 		=> '</div></li>',
				'before_title' 		=> '<h3 class="fugu-widget-title">',
				'after_title' 		=> '</h3></div><div class="fugu-shop-widget-col">'
			) );
		}

		// Sidebar: Footer
		register_sidebar( array(
			'name' 				=> esc_html__( 'Footer', 'fugu-framework' ),
			'id' 				=> 'footer',
			'before_widget'		=> '<li id="%1$s" class="widget %2$s">',
			'after_widget' 		=> '</li>',
			'before_title' 		=> '<h3 class="fugu-widget-title">',
			'after_title' 		=> '</h3>'
		) );

		// Sidebar: Visual Composer - Widgetised Sidebar
		register_sidebar( array(
			'name' 				=> esc_html__( '"Widgetised Sidebar" Element', 'fugu-framework' ),
			'id' 				=> 'vc-sidebar',
			'before_widget'		=> '<div id="%1$s" class="widget %2$s">',
			'after_widget' 		=> '</div>',
			'before_title' 		=> '<h3 class="fugu-widget-title">',
			'after_title' 		=> '</h3>'
		) );

		// WooCommerce: Unregister widgets
		unregister_widget( 'WC_Widget_Cart' );
	}
	add_action( 'widgets_init', 'fugu_widgets_init' ); // Register widget sidebars


    /* Footer includes
	==================================================================================================== */

    function fugu_footer_includes() {
        global $fugu_globals, $fugu_page_includes;

        // Mobile menu
        get_template_part( 'template-parts/navigation/navigation', 'mobile' );

        // Cart panel
        if ( $fugu_globals['cart_panel'] ) {
            get_template_part( 'template-parts/woocommerce/cart-panel' );
        }

        // Login panel
        if ( $fugu_globals['login_popup'] && ! is_user_logged_in() && ! is_account_page() ) {
            get_template_part( 'template-parts/woocommerce/login' );
        }

        echo '<div id="fugu-page-overlay" class="fugu-page-overlay"></div>';

        echo '<div id="fugu-quickview" class="clearfix"></div>';

        // Page includes element
		$page_includes_classes = array();
		foreach ( $fugu_page_includes as $class => $value ) {
			$page_includes_classes[] = $class;
        }
        $page_includes_classes = implode( ' ', $page_includes_classes );
		echo '<div id="fugu-page-includes" class="' . esc_attr( $page_includes_classes ) . '" style="display:none;">&nbsp;</div>' . "\n\n";
    }
    add_action( 'wp_footer', 'fugu_footer_includes' );


	/* Contact Form 7
	==================================================================================================== */

    // Disable default CF7 CSS
    add_filter( 'wpcf7_load_css', '__return_false' );
