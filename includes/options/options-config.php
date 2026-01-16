<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
	}

    // This is your option name where all the Redux data is stored.
    $opt_name = 'fugu_theme_options';
	

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // NM: Disable tracking
		'disable_tracking' => true,
		// TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
		'menu_title'			=> __( 'Theme Settings', 'fugu-framework-admin' ),
		'page_title'			=> __( 'Theme Settings', 'fugu-framework-admin' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => 'AIzaSyAX_2L_UzCDPEnAHTG7zhESRVpMPS4ssII',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => false,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => false,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        'forced_dev_mode_off'  => true,
        // Show the time the page took to load, etc
        'update_notice'        => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => apply_filters( 'fugu_options_enable_customizer_fields', true ),
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => 90,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        'footer_credit'     => '&nbsp;',
		// Footer credit text

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.
		'system_info'          => false,
        // REMOVE

        //'compiler'             => true,
		
        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                )
            )
        )
    );
	
    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */
	
	
    /*
     *
     * ---> START SECTIONS
     *
     */
	
	Redux::setSection( $opt_name, array(
		'title'		=> __( 'General', 'fugu-framework-admin' ),
		'icon'		=> 'el-icon-cog',
		'fields'	=> array(
            array(
				'id' 		=> 'full_width_layout',
				'type' 		=> 'switch', 
				'title' 	=> __( 'Full Width Layout', 'fugu-framework-admin' ),
				'default'	=> 0,
				'on' 		=> 'Enable',
				'off' 		=> 'Disable'
			),
			array(
				'id' 		=> 'page_load_transition',
				'type' 		=> 'switch', 
				'title' 	=> __( 'Page Load Transition', 'fugu-framework-admin' ),
				'default'	=> 0,
				'on' 		=> 'Enable',
				'off' 		=> 'Disable'
			),
			array(
				'id' 		=> 'font_awesome',
				'type' 		=> 'switch', 
				'title' 	=> __( 'Font Awesome', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Include Font Awesome icon library.', 'fugu-framework-admin' ),
				'default'	=> 0,
				'on' 		=> 'Enable',
				'off' 		=> 'Disable'
			),
            array(
				'id'		=> 'font_awesome_version',
				'type'		=> 'select',
				'title'		=> __( 'Font Awesome - Version', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Select Font Awesome version.', 'fugu-framework-admin' ),
				'options'	=> array( 'latest' => 'Latest', '4' => '4.7.0 (Bootstrap CDN)' ),
				'default'	=> 'latest',
                'required'  => array( 'font_awesome', '=', '1' )
			),
            array(
				'id'		=> 'wp_gallery_popup',
				'type'		=> 'switch', 
				'title'		=> __( 'WordPress Gallery Popup', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Modal popup for the default WordPress Gallery.', 'fugu-framework-admin' ),
				'default'	=> 0,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
            array(
				'id' 		=> 'page_not_found_show_products',
				'type' 		=> 'switch', 
				'title' 	=> __( 'Page Not Found - Featured Products', 'fugu-framework-admin' ),
				'default'	=> 0,
				'on' 		=> 'Enable',
				'off' 		=> 'Disable'
			)
		)
	) );

    Redux::setSection( $opt_name, array(
		'title'		=> __( 'Top Bar', 'fugu-framework-admin' ),
		'icon'		=> 'el-icon-minus',
		'fields'	=> array(
			array(
				'id' 		=> 'top_bar',
				'type' 		=> 'switch', 
				'title' 	=> __( 'Top Bar', 'fugu-framework-admin' ),
				'default'	=> 0,
				'on' 		=> 'Enable',
				'off' 		=> 'Disable'
			),
            array(
				'id'		=> 'top_bar_mobile',
				'type'		=> 'select',
				'title'		=> __( 'Display on Tablet/Mobile', 'fugu-framework-admin' ),
				'options'	=> array( 'none' => 'None', 'lc' => 'Left (text) column', 'rc' => 'Right (menu) column' ),
				'default'	=> '0'
			),
            array(
				'id'		    => 'top_bar_text',
				'type'		    => 'textarea',
				'title' 	    => __( 'Text', 'fugu-framework-admin' ),
				'subtitle'	    => __( 'HTML allowed.', 'fugu-framework-admin' ),
                'default'	    => __( 'Welcome to our shop!', 'fugu-framework-admin' ),
				'description'   => sprintf(
                    __( '%1$sCycles:%2$s To display a loop with text "cycles", separate each cycle/text with %1$s||%2$s characters%3$sExample: Text for cycle 1||Text for cycle 2', 'fugu-framework-admin' ),
                    '<strong>',
                    '</strong>',
                    '<br><br>'
                ),
                'validate'	    => 'html'
			),
			array(
				'id'			=> 'top_bar_left_column_size',
				'type'			=> 'slider',
				'title'			=> __( 'Text Column Size', 'fugu-framework-admin' ),
				'subtitle'		=> __( 'Select size-span of Text column.', 'fugu-framework-admin' ),
				'default'		=> 6,
				'min'			=> 1,
				'max'			=> 12,
				'step'			=> 1,
				'display_value'	=> 'text'
			),
			array(
				'id'		=> 'top_bar_social_icons',
				'type'		=> 'select',
				'title'		=> __( 'Social Icons', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Display icons from the "Social Profiles" settings tab.', 'fugu-framework-admin' ),
				'options'	=> array( '0' => 'None', 'l_c' => 'Display in left (text) column', 'r_c' => 'Display in right (menu) column' ),
				'default'	=> '0'
			)
		)
	) );
	
	Redux::setSection( $opt_name, array(
		'title'		=> __( 'Header', 'fugu-framework-admin' ),
		'icon'		=> 'el-icon-chevron-up',
		'fields'	=> array(
			array(
				'id' 		=> 'header_layout',
				'type' 		=> 'image_select',
				'title' 	=> __( 'Layout', 'fugu-framework-admin' ),
				'options'	=> array(
                    'centered'              => array( 'title' => 'Centered Logo', 'img' => FUGU_URI . '/assets/img/option-panel/header-centered.png' ),
					'default' 	            => array( 'title' => 'Logo & Menu Left', 'img' => FUGU_URI . '/assets/img/option-panel/header-default.png' ),
                    'menu-centered'         => array( 'title' => 'Centered Menu', 'img' => FUGU_URI . '/assets/img/option-panel/header-menu-centered.png' ),
                    'stacked'               => array( 'title' => 'Stacked', 'img' => FUGU_URI . '/assets/img/option-panel/header-stacked.png' ),
                    'stacked-logo-centered' => array( 'title' => 'Stacked, Logo Centered', 'img' => FUGU_URI . '/assets/img/option-panel/header-stacked-logo-centered.png' ),
                    'stacked-centered'      => array( 'title' => 'Stacked Centered', 'img' => FUGU_URI . '/assets/img/option-panel/header-stacked-centered.png' )
				),
				'default' 	=> 'centered'
			),
            /*array(
				'id'		=> 'header_layout_mobile',
				'type'		=> 'select',
				'title' 	=> __( 'Layout - Mobile', 'fugu-framework-admin' ),
                'options'	=> array( 'default' => 'Show Cart link', 'alt' => 'Hide Cart link and left-align Logo' ),
				'default'	=> 'default'
			),*/
			array(
				'id'		=> 'header_fixed',
				'type'		=> 'switch', 
				'title'		=> __( 'Sticky', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Make header "stick" to the top when scrolling.', 'fugu-framework-admin' ),
				'default'	=> 1,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
            array(
				'id'		=> 'header_fixed_on_scroll_up',
				'type'		=> 'switch', 
				'title'		=> __( 'Sticky - Upwards scroll only', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Only make header "stick" when scrolling upwards.', 'fugu-framework-admin' ),
				'default'	=> 0,
				'on'		=> 'Enable',
				'off'		=> 'Disable',
                'required'  => array( 'header_fixed', '=', '1' ),
			),
            array (
				'id'	=> 'header_info_transparency',
				'icon'	=> true,
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Transparency', 'fugu-framework-admin' ) . '</h3>',
			),
            array(
				'id'		=> 'header_transparency',
				'type'		=> 'switch', 
				'title' 	=> __( 'Transparency', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'To enable transparency for individual pages, use the "Header Transparency" meta-box when editing a page.', 'fugu-framework-admin' ),
				'default'	=> 0,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
            array(
				'id'		=> 'header_transparency_homepage',
				'type'		=> 'select',
				'title' 	=> __( 'Transparency - Homepage', 'fugu-framework-admin' ),
				'options'	=> array( '0' => 'Disable', 'light' => 'Light', 'dark' => 'Dark' ),
				'default'	=> '0',
                'required'  => array( 'header_transparency', '=', '1' )
			),
            array(
				'id'		=> 'header_transparency_shop',
				'type'		=> 'select',
				'title' 	=> __( 'Transparency - Shop', 'fugu-framework-admin' ),
				'options'	=> array( '0' => 'Disable', 'light' => 'Light', 'dark' => 'Dark' ),
				'default'	=> '0',
                'required'  => array( 'header_transparency', '=', '1' )
			),
            array(
				'id'		=> 'header_transparency_shop_categories',
				'type'		=> 'select',
				'title' 	=> __( 'Transparency - Shop Categories', 'fugu-framework-admin' ),
				'options'	=> array( '0' => 'Disable', 'light' => 'Light', 'dark' => 'Dark' ),
				'default'	=> '0',
                'required'  => array( 'header_transparency', '=', '1' )
			),
            array(
				'id'		=> 'header_transparency_product',
				'type'		=> 'select',
				'title' 	=> __( 'Transparency - Single Product', 'fugu-framework-admin' ),
				'options'	=> array( '0' => 'Disable', 'light' => 'Light', 'dark' => 'Dark' ),
				'default'	=> '0',
                'required'  => array( 'header_transparency', '=', '1' )
			),
            array(
				'id'		=> 'header_transparency_blog',
				'type'		=> 'select',
				'title' 	=> __( 'Transparency - Blog', 'fugu-framework-admin' ),
				'options'	=> array( '0' => 'Disable', 'light' => 'Light', 'dark' => 'Dark' ),
				'default'	=> '0',
                'required'  => array( 'header_transparency', '=', '1' )
			),
            array(
				'id'		=> 'header_transparency_blog_post',
				'type'		=> 'select',
				'title' 	=> __( 'Transparency - Blog Post', 'fugu-framework-admin' ),
				'options'	=> array( '0' => 'Disable', 'light' => 'Light', 'dark' => 'Dark' ),
				'default'	=> '0',
                'required'  => array( 'header_transparency', '=', '1' )
			),
            array (
				'id'	=> 'header_info_spacing',
				'icon'	=> true,
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Spacing', 'fugu-framework-admin' ) . '</h3>',
			),
            array(
				'id'			=> 'header_spacing_top',
				'type'			=> 'slider',
				'title'			=> __( 'Top', 'fugu-framework-admin' ),
				'default'		=> 17,
				'min'			=> 0,
				'max'			=> 250,
				'step'			=> 1,
				'display_value'	=> 'text'
			),
            array(
				'id'			=> 'header_spacing_top_alt',
				'type'			=> 'slider',
				'title'			=> __( 'Top - Sticky, Tablet & Mobile', 'fugu-framework-admin' ),
				'subtitle'		=> __( 'Top spacing on "Sticky", Tablet and Mobile.', 'fugu-framework-admin'),
				'default'		=> 10,
				'min'			=> 0,
				'max'			=> 250,
				'step'			=> 1,
				'display_value'	=> 'text'
			),
            array(
				'id'			=> 'logo_spacing_bottom',
				'type'			=> 'slider',
				'title'			=> __( 'Logo - Bottom', 'fugu-framework-admin' ),
				'subtitle'		=> __( 'Bottom logo spacing.', 'fugu-framework-admin'),
				'default'		=> 0,
				'min'			=> 0,
				'max'			=> 250,
				'step'			=> 1,
				'display_value'	=> 'text',
                'required'		=> array( 'header_layout', 'equals', array( 'stacked', 'stacked-logo-centered', 'stacked-centered' ) )
			),
			array(
				'id'			=> 'header_spacing_bottom',
				'type'			=> 'slider',
				'title'			=> __( 'Bottom', 'fugu-framework-admin' ),
				'default'		=> 17,
				'min'			=> 0,
				'max'			=> 250,
				'step'			=> 1,
				'display_value'	=> 'text'
			),
            array(
				'id'			=> 'header_spacing_bottom_alt',
				'type'			=> 'slider',
				'title'			=> __( 'Bottom - Sticky, Tablet & Mobile', 'fugu-framework-admin' ),
				'subtitle'		=> __( 'Bottom spacing on "Sticky", Tablet and Mobile.', 'fugu-framework-admin'),
				'default'		=> 10,
				'min'			=> 0,
				'max'			=> 250,
				'step'			=> 1,
				'display_value'	=> 'text'
			),
            array (
				'id'	=> 'header_info_border',
				'icon'	=> true,
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Border', 'fugu-framework-admin' ) . '</h3>',
			),
			array(
				'id'		=> 'header_border',
				'type'		=> 'switch', 
				'title'		=> __( 'Border', 'fugu-framework-admin' ),
				'default'	=> 1,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
			array(
				'id'		=> 'home_header_border',
				'type'		=> 'switch', 
				'title'		=> __( 'Border - Homepage', 'fugu-framework-admin' ),
				'default'	=> 1,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
			array(
				'id'		=> 'shop_header_border',
				'type'		=> 'switch', 
				'title'		=> __( 'Border - Shop', 'fugu-framework-admin' ),
				'default'	=> 1,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
            array (
				'id'	=> 'header_info_logo',
				'icon'	=> true,
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Logo', 'fugu-framework-admin' ) . '</h3>',
			),
			array(
				'id'	=> 'logo',
				'type'	=> 'media', 
				'title'	=> __( 'Image', 'fugu-framework-admin' )
			),
			array(
				'id'			=> 'logo_height',
				'type'			=> 'slider',
				'title'			=> __( 'Logo Height', 'fugu-framework-admin' ),
				'default'		=> 16,
				'min'			=> 10,
				'max'			=> 500,
				'step'			=> 1,
				'display_value'	=> 'text'
			),
			array(
				'id'			=> 'logo_height_tablet',
				'type'			=> 'slider',
				'title'			=> __( 'Logo Height - Tablet', 'fugu-framework-admin' ),
				'default'		=> 16,
				'min'			=> 10,
				'max'			=> 500,
				'step'			=> 1,
				'display_value'	=> 'text'
			),
			array(
				'id'			=> 'logo_height_mobile',
				'type'			=> 'slider',
				'title'			=> __( 'Logo Height - Mobile', 'fugu-framework-admin' ),
				'default'		=> 16,
				'min'			=> 10,
				'max'			=> 500,
				'step'			=> 1,
				'display_value'	=> 'text'
			),
            array (
				'id'	=> 'header_info_alt_logo',
				'icon'	=> true,
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Alternative Logo', 'fugu-framework-admin' ) . '</h3>',
			),
			array(
				'id'		=> 'alt_logo',
				'type'		=> 'switch', 
				'title' 	=> __( 'Alternative Logo', 'fugu-framework-admin' ),
				'default'	=> 0,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
            array(
				'id'	=> 'alt_logo_image',
				'type'	=> 'media', 
				'title'	=> __( 'Image', 'fugu-framework-admin' ),
                'required'	=> array( 'alt_logo', '=', '1' )
			),
			array(
				'id'		=> 'alt_logo_visibility',
				'type'      => 'checkbox',
				'title'		=> __( 'Visibility', 'fugu-framework-admin' ),
				'options'	=> array(
                    'alt-logo-home'                         => __( 'Homepage', 'fugu-framework-admin' ),
                    'alt-logo-fixed'                        => __( 'Sticky header', 'fugu-framework-admin' ),
                    'alt-logo-tablet'                       => __( 'Tablet header', 'fugu-framework-admin' ),
                    'alt-logo-mobile'                       => __( 'Mobile header', 'fugu-framework-admin' ),
                    'alt-logo-mobile-menu-open'             => __( 'Tablet/Mobile menu open', 'fugu-framework-admin' ),
                    'alt-logo-header-transparency-light'    => __( 'Transparent header - Light', 'fugu-framework-admin' ),
                    'alt-logo-header-transparency-dark'     => __( 'Transparent header - Dark', 'fugu-framework-admin' )
                ),
				'required'  => array( 'alt_logo', '=', '1' )
			),
            array (
				'id'	=> 'header_info_menu',
				'icon'	=> true,
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Menu', 'fugu-framework-admin' ) . '</h3>',
			),
			array(
				'id'			=> 'menu_height',
				'type'			=> 'slider',
				'title'			=> __( 'Menu Height', 'fugu-framework-admin' ),
				'default'		=> 50,
				'min'			=> 50,
				'max'			=> 500,
				'step'			=> 1,
				'display_value'	=> 'text'
			),
            array(
				'id'			=> 'menu_height_tablet',
				'type'			=> 'slider',
				'title'			=> __( 'Menu Height - Tablet', 'fugu-framework-admin' ),
				'default'		=> 50,
				'min'			=> 50,
				'max'			=> 500,
				'step'			=> 1,
				'display_value'	=> 'text'
			),
            array(
				'id'			=> 'menu_height_mobile',
				'type'			=> 'slider',
				'title'			=> __( 'Menu Height - Mobile', 'fugu-framework-admin' ),
				'default'		=> 50,
				'min'			=> 50,
				'max'			=> 500,
				'step'			=> 1,
				'display_value'	=> 'text'
			),
            array (
				'id'	=> 'header_info_menu_login',
				'icon'	=> true,
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Menu - Login/My Account', 'fugu-framework-admin' ) . '</h3>',
			),
            array(
				'id'		=> 'menu_login',
				'type'		=> 'switch', 
				'title'		=> __( 'Link', 'fugu-framework-admin' ),
				'subtitle'		=> __( 'Display link in header menu.', 'fugu-framework-admin' ),
				'default'	=> 1,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
			array(
				'id'		=> 'menu_login_popup',
				'type'		=> 'switch', 
				'title'		=> __( 'Popup', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Login/register popup window.', 'fugu-framework-admin' ),
				'default'	=> 0,
				'on'		=> 'Enable',
				'off'		=> 'Disable',
				'required'	=> array( 'menu_login', '=', '1' )
			),
			array(
				'id'		=> 'menu_login_icon',
				'type'		=> 'switch', 
				'title'		=> __( 'Icon', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Display menu icon (instead of text).', 'fugu-framework-admin' ),
				'default'	=> 0,
				'on'		=> 'Enable',
				'off'		=> 'Disable',
				'required'	=> array( 'menu_login', '=', '1' )
			),
            array(
				'id'		=> 'menu_login_icon_html',
				'type'		=> 'text',
				'title'		=> __( 'Icon HTML', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Menu icon markup (must be valid HTML).', 'fugu-framework-admin' ),
                'description'   => esc_html( 'Default: <i class="fugu-myaccount-icon fugu-font fugu-font-head"></i>' ),
                'default'	=> '<i class="fugu-myaccount-icon fugu-font fugu-font-head"></i>',
                'validate'	=> 'html',
                'required'	=> array( 'menu_login_icon', '=', '1' )
			),
            array (
				'id'	=> 'header_info_menu_cart',
				'icon'	=> true,
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Menu - Cart', 'fugu-framework-admin' ) . '</h3>',
			),
			array(
				'id'		=> 'menu_cart',
				'type'		=> 'select',
				'title'		=> __( 'Link', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Configure link in header menu.', 'fugu-framework-admin' ),
				'options'	=> array( 'link' => 'Link (static)', '1' => 'Link to Cart Panel', '0' => 'Disable' ),
				'default'	=> '1'
			),
			array(
				'id'		=> 'menu_cart_icon',
				'type'		=> 'switch', 
				'title'		=> __( 'Icon', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Display menu icon (instead of text).', 'fugu-framework-admin' ),
				'default'	=> 1,
				'on'		=> 'Enable',
				'off'		=> 'Disable',
				'required'	=> array( 'menu_cart', '!=', '0' )
			),
            array(
				'id'		=> 'menu_cart_icon_html',
				'type'		=> 'text',
				'title'		=> __( 'Icon HTML', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Menu icon markup (must be valid HTML).', 'fugu-framework-admin' ),
                'description'   => esc_html( 'Default: <i class="fugu-menu-cart-icon fugu-font fugu-font-cart"></i>' ),
                'default'	=> '<i class="fugu-menu-cart-icon fugu-font fugu-font-cart"></i>',
                'validate'	=> 'html',
                'required'	=> array( 'menu_cart_icon', '=', '1' )
			),
            array (
				'id'	=> 'header_info_megamenu',
				'icon'	=> true,
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Mega Menu: Full Width', 'fugu-framework-admin' ) . '</h3>',
			),
            array(
				'id'			=> 'megamenu_full_max_width',
				'type'			=> 'slider',
				'title'			=> __( 'Maximum Width', 'fugu-framework-admin' ),
				'subtitle'		=> __( 'Menu content max-width.', 'fugu-framework-admin'),
				'default'		=> 1080,
				'min'			=> 1,
				'max'			=> 3000,
				'step'			=> 1,
				'display_value'	=> 'text'
			),
            array(
				'id'			=> 'megamenu_full_top_spacing',
				'type'			=> 'slider',
				'title'			=> __( 'Top Spacing', 'fugu-framework-admin' ),
				'default'		=> 28,
				'min'			=> 0,
				'max'			=> 250,
				'step'			=> 1,
				'display_value'	=> 'text'
			),
            array(
				'id'			=> 'megamenu_full_bottom_spacing',
				'type'			=> 'slider',
				'title'			=> __( 'Bottom Spacing', 'fugu-framework-admin' ),
				'default'		=> 15,
				'min'			=> 0,
				'max'			=> 250,
				'step'			=> 1,
				'display_value'	=> 'text'
			),
            array (
				'id'	=> 'header_info_menu_mobile',
				'icon'	=> true,
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Menu: Mobile', 'fugu-framework-admin' ) . '</h3>',
			),
            array(
				'id' 		=> 'menu_mobile_layout',
				'type' 		=> 'image_select',
				'title' 	=> __( 'Layout', 'fugu-framework-admin' ),
				'options'	=> array(
                    'side'  => array( 'title' => 'Side', 'img' => FUGU_URI . '/assets/img/option-panel/mobile-menu-side.png' ),
                    'top'   => array( 'title' => 'Top', 'img' => FUGU_URI . '/assets/img/option-panel/mobile-menu-top.png' ),
				),
				'default' 	=> 'side',
			),
            array(
				'id'		=> 'menu_mobile_desktop',
				'type'		=> 'switch', 
				'title'		=> __( 'Enable on Desktop', 'fugu-framework-admin' ),
				'default'	=> 0,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
            array(
				'id'		=> 'menu_mobile_secondary_menu',
				'type'		=> 'switch', 
				'title'		=> __( 'Secondary Menu', 'fugu-framework-admin' ),
				'default'	=> 1,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
            array(
				'id'		=> 'menu_mobile_social_icons',
				'type'		=> 'switch', 
				'title'		=> __( 'Social Icons', 'fugu-framework-admin' ),
				'default'	=> 0,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			)
		)
	) );
	
	Redux::setSection( $opt_name, array(
		'title'		=> __( 'Footer', 'fugu-framework-admin' ),
		'icon'		=> 'el-icon-chevron-down',
		'fields'	=> array(
			array(
				'id'		=> 'footer_sticky',
				'type'		=> 'switch', 
				'title'		=> __( 'Align to Bottom', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Always align footer to the page bottom.', 'fugu-framework-admin' ),
				'default'	=> 1,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
			array (
				'id'	=> 'footer_widgets_info',
				'icon'	=> true,
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Widgets', 'fugu-framework-admin' ) . '</h3>',
			),
			array(
				'id'		=> 'footer_widgets_layout',
				'type'		=> 'select',
				'title'		=> __( 'Layout', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Select a layout for the widgets section.', 'fugu-framework-admin' ),
				'options'	=> array( 'boxed' => 'Boxed', 'full' => 'Full', 'full-nopad' => 'Full (no padding)' ),
				'default'	=> 'boxed'
			),
			array(
				'id'		=> 'footer_widgets_border',
				'type'		=> 'switch',
				'title'		=> __( 'Top Border', 'fugu-framework-admin' ),
				'default'	=> 1,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
			array(
				'id'			=> 'footer_widgets_columns',
				'type'			=> 'slider',
				'title'			=> __( 'Columns', 'fugu-framework-admin' ),
				'subtitle'		=> __( 'Select the number of widget columns to display.', 'fugu-framework-admin' ),
				'default'		=> 2,
				'min'			=> 1,
				'max'			=> 4,
				'step'			=> 1,
				'display_value'	=> 'text'
			),
            array(
				'id'			=> 'footer_widgets_spacing_top',
				'type'			=> 'slider',
				'title'			=> __( 'Spacing - Top', 'fugu-framework-admin' ),
				'default'		=> 55,
				'min'			=> 0,
				'max'			=> 250,
				'step'			=> 1,
				'display_value'	=> 'text'
			),
            array(
				'id'			=> 'footer_widgets_spacing_top_alt',
				'type'			=> 'slider',
				'title'			=> __( 'Spacing - Top: Tablet & Mobile', 'fugu-framework-admin' ),
				'default'		=> 55,
				'min'			=> 0,
				'max'			=> 250,
				'step'			=> 1,
				'display_value'	=> 'text'
			),
			array(
				'id'			=> 'footer_widgets_spacing_bottom',
				'type'			=> 'slider',
				'title'			=> __( 'Spacing - Bottom', 'fugu-framework-admin' ),
				'default'		=> 15,
				'min'			=> 0,
				'max'			=> 250,
				'step'			=> 1,
				'display_value'	=> 'text'
			),
            array(
				'id'			=> 'footer_widgets_spacing_bottom_alt',
				'type'			=> 'slider',
				'title'			=> __( 'Spacing - Bottom: Tablet & Mobile', 'fugu-framework-admin' ),
				'default'		=> 15,
				'min'			=> 0,
				'max'			=> 250,
				'step'			=> 1,
				'display_value'	=> 'text'
			),
			array (
				'id'	=> 'footer_bar_info',
				'icon'	=> true,
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Bar', 'fugu-framework-admin' ) . '</h3>',
			),
            array(
				'id' 		=> 'footer_bar_layout',
				'type' 		=> 'image_select',
				'title' 	=> __( 'Layout', 'fugu-framework-admin' ),
				'options'	=> array(
					'default'   => array( 'alt' => 'Default', 'img' => FUGU_URI . '/assets/img/option-panel/footer-bar-default.png' ),
                    'stacked'   => array( 'alt' => 'Stacked', 'img' => FUGU_URI . '/assets/img/option-panel/footer-bar-stacked.png' ),
                    'centered'  => array( 'alt' => 'Centered', 'img' => FUGU_URI . '/assets/img/option-panel/footer-bar-centered.png' )
				),
				'default' 	=> 'default'
			),
			array(
				'id'	=> 'footer_bar_logo',
				'type'	=> 'media', 
				'title'	=> __( 'Logo Image', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Maximum height is 30 pixels.', 'fugu-framework-admin' )
			),
			array(
				'id'		=> 'footer_bar_text',
				'type'		=> 'text',
				'title'		=> __( 'Copyright', 'fugu-framework-admin' ),
				'validate'	=> 'html'
			),
			array(
				'id'		=> 'footer_bar_text_cr_year',
				'type'		=> 'switch', 
				'title'		=> __( 'Copyright - Copyright & Year', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Display copyright symbol (©) and year before the text.', 'fugu-framework-admin' ),
				'default'	=> 0,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
            array(
				'id'		=> 'footer_bar_custom_content',
				'type'		=> 'textarea',
				'title'		=> __( 'Text', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'HTML allowed.', 'fugu-framework-admin' ),
				'validate'	=> 'html',
                //'required'	=> array( 'footer_bar_content', '=', 'custom' )
			),
			array(
				'id'		=> 'footer_bar_content',
				'type'		=> 'select',
				'title'		=> __( 'Right Column', 'fugu-framework-admin' ),
                'subtitle'	=> __( 'Select content to display in the right/bottom column.', 'fugu-framework-admin' ),
				'options'	=> array(
                    'social_icons'      => 'Social icons',
                    'copyright_text'    => 'Copyright',
                    'custom'            => 'Text',
                    'social_copyright'  => 'Social icons and Copyright',
                ),
				'default'	=> 'copyright_text'
			),
            array(
				'id'			=> 'footer_bar_spacing_top',
				'type'			=> 'slider',
				'title'			=> __( 'Spacing - Top', 'fugu-framework-admin' ),
				'default'		=> 30,
				'min'			=> 0,
				'max'			=> 250,
				'step'			=> 1,
				'display_value'	=> 'text'
			),
            array(
				'id'			=> 'footer_bar_spacing_top_alt',
				'type'			=> 'slider',
				'title'			=> __( 'Spacing - Top: Tablet & Mobile', 'fugu-framework-admin' ),
				'default'		=> 30,
				'min'			=> 0,
				'max'			=> 250,
				'step'			=> 1,
				'display_value'	=> 'text'
			),
			array(
				'id'			=> 'footer_bar_spacing_bottom',
				'type'			=> 'slider',
				'title'			=> __( 'Spacing - Bottom', 'fugu-framework-admin' ),
				'default'		=> 30,
				'min'			=> 0,
				'max'			=> 250,
				'step'			=> 1,
				'display_value'	=> 'text'
			),
            array(
				'id'			=> 'footer_bar_spacing_bottom_alt',
				'type'			=> 'slider',
				'title'			=> __( 'Spacing - Bottom: Tablet & Mobile', 'fugu-framework-admin' ),
				'default'		=> 30,
				'min'			=> 0,
				'max'			=> 250,
				'step'			=> 1,
				'display_value'	=> 'text'
			)
		)
	) );
	
	Redux::setSection( $opt_name, array(
		'title'		=> __( 'Styling', 'fugu-framework-admin' ),
		//'icon'		=> 'el-icon-eye-open',
        'icon'		=> 'el-icon-adjust',
		'fields'	=> array(
            array(
				'id'	=> 'info_typography',
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Typography', 'fugu-framework-admin' ) . '</h3>'
			),
			array(
				'id'			=> 'main_font_color',
				'type'			=> 'color',
				'title'			=> __( 'Font Color', 'fugu-framework-admin' ),
				'default'		=> '#777777',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
            array(
				'id'			=> 'font_strong_color',
				'type'			=> 'color',
				'title'			=> __( 'Font Color - Strong Text', 'fugu-framework-admin' ),
                'default'		=> '#282828',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
            array(
				'id'			=> 'font_subtle_color',
				'type'			=> 'color',
				'title'			=> __( 'Font Color - Subtle Text', 'fugu-framework-admin' ),
				'default'		=> '#a1a1a1',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
            array(
				'id'			=> 'highlight_color',
				'type'			=> 'color',
				'title'			=> __( 'Font Color - Highlighted Text', 'fugu-framework-admin' ),
				'default'		=> '#dc9814',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
            array(
				'id'			=> 'heading_1_color',
				'type'			=> 'color',
				'title'			=> __( 'Heading 1 Color', 'fugu-framework-admin' ),
				'default'		=> '#282828',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
            array(
				'id'			=> 'heading_2_color',
				'type'			=> 'color',
				'title'			=> __( 'Heading 2 Color', 'fugu-framework-admin' ),
				'default'		=> '#282828',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
            array(
				'id'			=> 'heading_3_color',
				'type'			=> 'color',
				'title'			=> __( 'Heading 3 Color', 'fugu-framework-admin' ),
				'default'		=> '#282828',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
            array(
				'id'			=> 'heading_456_color',
				'type'			=> 'color',
				'title'			=> __( 'Heading 4, 5 and 6 Color', 'fugu-framework-admin' ),
				'default'		=> '#282828',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
			array(
				'id'	=> 'info_styling_background',
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Background', 'fugu-framework-admin' ) . '</h3>'
			),
			array(
				'id'			=> 'main_background_color',
				'type'			=> 'color',
				'title'			=> __( 'Main Background Color', 'fugu-framework-admin' ),
				'default'		=> '#ffffff',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
			array(
				'id'	=> 'main_background_image',
				'type'	=> 'media', 
				'url'	=> true,
				'title'	=> __( 'Background Image', 'fugu-framework-admin' )
			),
			array(
				'id'		=> 'main_background_image_type',
				'type'		=> 'select',
				'title'		=> __( 'Background Image - Type', 'fugu-framework-admin' ),
				'options'	=> array( 'fixed' => 'Fixed (full)', 'repeat' => 'Repeat (pattern)' ),
				'default'	=> 'fixed'
			),
            
            array(
				'id'	=> 'info_styling_borders_dividers',
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Borders & Dividers', 'fugu-framework-admin' ) . '</h3>'
			),
            array(
				'id'			=> 'borders_color',
				'type'			=> 'color',
				'title'			=> __( 'Borders Color', 'fugu-framework-admin' ),
				'default'		=> '#eeeeee',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
            array(
				'id'			=> 'dividers_color',
				'type'			=> 'color',
				'title'			=> __( 'Dividers Color', 'fugu-framework-admin' ),
				'default'		=> '#cccccc',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
            
			array(
				'id'	=> 'info_styling_top_bar',
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Top Bar', 'fugu-framework-admin' ) . '</h3>'
			),
			array(
				'id'			=> 'top_bar_font_color',
				'type'			=> 'color',
				'title'			=> __( 'Font Color', 'fugu-framework-admin' ),
				'default'		=> '#eeeeee',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
            array(
				'id'			=> 'top_bar_border_color',
				'type'			=> 'color',
				'title'			=> __( 'Border Color', 'fugu-framework-admin' ),
				'transparent'	=> true,
				'default'		=> 'transparent',
				'validate'		=> 'color'
			),
			array(
				'id'			=> 'top_bar_background_color',
				'type'			=> 'color',
				'title'			=> __( 'Background Color', 'fugu-framework-admin' ),
				'transparent'	=> true,
				'default'		=> '#282828',
				'validate'		=> 'color'
			),
			array(
				'id'	=> 'info_styling_header',
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Header', 'fugu-framework-admin' ) . '</h3>'
			),
			array(
				'id'			=> 'header_navigation_color',
				'type'			=> 'color',
				'title'			=> __( 'Menu: Font Color', 'fugu-framework-admin' ),
				'default'		=> '#707070',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
			array(
				'id'			=> 'header_navigation_highlight_color',
				'type'			=> 'color',
				'title'			=> __( 'Menu: Font Color - "Hover" State', 'fugu-framework-admin' ),
				'transparent'	=> false,
				'default'		=> '#282828',
				'validate'		=> 'color'
			),
			array(
				'id'		=> 'header_background_color',
				'type'		=> 'color',
				'title'		=> __( 'Background Color', 'fugu-framework-admin' ),
				'default'	=> '#ffffff',
				'validate'	=> 'color'
			),
			array(
				'id'		=> 'header_home_background_color',
				'type'		=> 'color',
				'title'		=> __( 'Background Color - Homepage', 'fugu-framework-admin' ),
				'default'	=> '#ffffff',
				'validate'	=> 'color'
			),
			array(
				'id'		=> 'header_float_background_color',
				'type'		=> 'color',
				'title'		=> __( 'Background Color - Sticky', 'fugu-framework-admin' ),
				'default'	=> '#ffffff',
				'validate'	=> 'color'
			),
			array(
				'id'			=> 'header_slide_menu_open_background_color',
				'type'			=> 'color',
				'title'			=> __( 'Background Color - Mobile Menu Open', 'fugu-framework-admin' ),
				'default'		=> '#ffffff',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
            array(
				'id'	=> 'info_styling_header_transparency_light',
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Transparent Header: Light', 'fugu-framework-admin' ) . '</h3>'
			),
			array(
				'id'			=> 'header_transparency_light_navigation_color',
				'type'			=> 'color',
				'title'			=> __( 'Menu: Font Color', 'fugu-framework-admin' ),
				'default'		=> '#ffffff',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
			array(
				'id'			=> 'header_transparency_light_navigation_highlight_color',
				'type'			=> 'color',
				'title'			=> __( 'Menu: Font Color - "Hover" State', 'fugu-framework-admin' ),
				'transparent'	=> false,
				'default'		=> '#dcdcdc',
				'validate'		=> 'color'
			),
            array(
				'id'			=> 'header_transparency_light_hover_background_color',
				'type'			=> 'color',
				'title'			=> __( 'Background Color - "Hover" State', 'fugu-framework-admin' ),
				'transparent'	=> true,
				'default'		=> 'transparent',
				'validate'		=> 'color'
			),
            array(
				'id'	=> 'info_styling_header_transparency_dark',
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Transparent Header: Dark', 'fugu-framework-admin' ) . '</h3>'
			),
			array(
				'id'			=> 'header_transparency_dark_navigation_color',
				'type'			=> 'color',
				'title'			=> __( 'Menu: Font Color', 'fugu-framework-admin' ),
				'default'		=> '#282828',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
			array(
				'id'			=> 'header_transparency_dark_navigation_highlight_color',
				'type'			=> 'color',
				'title'			=> __( 'Menu: Font Color - "Hover" State', 'fugu-framework-admin' ),
				'transparent'	=> false,
				'default'		=> '#707070',
				'validate'		=> 'color'
			),
            array(
				'id'			=> 'header_transparency_dark_hover_background_color',
				'type'			=> 'color',
				'title'			=> __( 'Background Color - "Hover" State', 'fugu-framework-admin' ),
				'transparent'	=> true,
				'default'		=> 'transparent',
				'validate'		=> 'color'
			),
			array(
				'id'	=> 'info_styling_dropdown_menu',
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Dropdown Menu', 'fugu-framework-admin' ) . '</h3>'
			),
			array(
				'id'			=> 'dropdown_menu_font_color',
				'type'			=> 'color',
				'title'			=> __( 'Font Color', 'fugu-framework-admin' ),
				'transparent'	=> false,
				'default'		=> '#a0a0a0',
				'validate'		=> 'color'
			),
			array(
				'id'			=> 'dropdown_menu_font_highlight_color',
				'type'			=> 'color',
				'title'			=> __( 'Font Color - "Hover" State', 'fugu-framework-admin' ),
				'transparent'	=> false,
				'default'		=> '#eeeeee',
				'validate'		=> 'color'
			),
			array(
				'id'			=> 'dropdown_menu_background_color',
				'type'			=> 'color',
				'title'			=> __( 'Background Color', 'fugu-framework-admin' ),
				'default'		=> '#282828',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
            array(
				'id'	=> 'info_styling_dropdown_menu_full',
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Dropdown Menu: Full Width', 'fugu-framework-admin' ) . '</h3>'
			),
			array(
				'id'			=> 'dropdown_menu_full_font_color',
				'type'			=> 'color',
				'title'			=> __( 'Font Color', 'fugu-framework-admin' ),
				'transparent'	=> false,
				'default'		=> '#777777',
				'validate'		=> 'color'
			),
			array(
				'id'			=> 'dropdown_menu_full_font_highlight_color',
				'type'			=> 'color',
				'title'			=> __( 'Font Color - "Hover" State', 'fugu-framework-admin' ),
				'transparent'	=> false,
				'default'		=> '#282828',
				'validate'		=> 'color'
			),
			array(
				'id'			=> 'dropdown_menu_full_background_color',
				'type'			=> 'color',
				'title'			=> __( 'Background Color', 'fugu-framework-admin' ),
				'default'		=> '#ffffff',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
            array(
				'id'	=> 'info_styling_dropdown_menu_thumbnails',
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Dropdown Menu: Thumbnails', 'fugu-framework-admin' ) . '</h3>'
			),
            array(
				'id'			=> 'dropdown_menu_thumbnails_border_color',
				'type'			=> 'color',
				'title'			=> __( 'Divider Color', 'fugu-framework-admin' ),
                'default'		=> '#eeeeee',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
            array(
				'id'	=> 'info_styling_slide_menu',
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Mobile Menu', 'fugu-framework-admin' ) . '</h3>'
			),
            array(
				'id'			=> 'slide_menu_font_color',
				'type'			=> 'color',
				'title'			=> __( 'Font Color', 'fugu-framework-admin' ),
                'default'		=> '#707070',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
            array(
				'id'			=> 'slide_menu_font_highlight_color',
				'type'			=> 'color',
				'title'			=> __( 'Font Color - "Hover" State', 'fugu-framework-admin' ),
                'default'		=> '#282828',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
            array(
				'id'			=> 'slide_menu_border_color',
				'type'			=> 'color',
				'title'			=> __( 'Divider Color', 'fugu-framework-admin' ),
                'default'		=> '#eeeeee',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
            array(
				'id'			=> 'slide_menu_background_color',
				'type'			=> 'color',
				'title'			=> __( 'Background Color', 'fugu-framework-admin' ),
                'default'		=> '#ffffff',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
            array(
				'id'	=> 'info_styling_button',
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Buttons', 'fugu-framework-admin' ) . '</h3>'
			),
			array(
				'id'			=> 'button_font_color',
				'type'			=> 'color',
				'title'			=> __( 'Font Color', 'fugu-framework-admin' ),
				'default'		=> '#ffffff',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
			array(
				'id'			=> 'button_background_color',
				'type'			=> 'color',
				'title'			=> __( 'Background Color', 'fugu-framework-admin' ),
				'default'		=> '#282828',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
            array(
				'id'	=> 'info_styling_button_border',
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Buttons - Border', 'fugu-framework-admin' ) . '</h3>'
			),
			array(
				'id'			=> 'button_border_font_color',
				'type'			=> 'color',
				'title'			=> __( 'Font Color', 'fugu-framework-admin' ),
				'default'		=> '#282828',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
			array(
				'id'			=> 'button_border_color',
				'type'			=> 'color',
				'title'			=> __( 'Border Color', 'fugu-framework-admin' ),
				'default'		=> '#aaaaaa',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
            array(
				'id'			=> 'button_border_hover_color',
				'type'			=> 'color',
				'title'			=> __( 'Border Color - "Hover" State', 'fugu-framework-admin' ),
				'default'		=> '#282828',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
			array(
				'id'	=> 'info_styling_footer_widgets',
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Footer Widgets', 'fugu-framework-admin' ) . '</h3>'
			),
			array(
				'id'			=> 'footer_widgets_font_color',
				'type'			=> 'color',
				'title'			=> __( 'Font Color', 'fugu-framework-admin' ),
				'default'		=> '#777777',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
			array(
				'id'			=> 'footer_widgets_title_font_color',
				'type'			=> 'color',
				'title'			=> __( 'Font Color - Titles', 'fugu-framework-admin' ),
				'default'		=> '#282828',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
			array(
				'id'			=> 'footer_widgets_highlight_font_color',
				'type'			=> 'color',
				'title'			=> __( 'Font Color - "Hover" State', 'fugu-framework-admin' ),
				'default'		=> '#dc9814',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
			array(
				'id'			=> 'footer_widgets_background_color',
				'type'			=> 'color',
				'title'			=> __( 'Background Color', 'fugu-framework-admin' ),
				'default'		=> '#ffffff',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
			array(
				'id'	=> 'info_styling_footer_bar',
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Footer Bar', 'fugu-framework-admin' ) . '</h3>'
			),
			array(
				'id'			=> 'footer_bar_font_color',
				'type'			=> 'color',
				'title'			=> __( 'Font Color', 'fugu-framework-admin' ),
				'default'		=> '#aaaaaa',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
			array(
				'id'			=> 'footer_bar_highlight_font_color',
				'type'			=> 'color',
				'title'			=> __( 'Font Color - "Hover" State', 'fugu-framework-admin' ),
				'default'		=> '#eeeeee',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
            array(
				'id'			=> 'footer_bar_social_icons_color',
				'type'			=> 'color',
				'title'			=> __( 'Social Icons Color', 'fugu-framework-admin' ),
				'default'		=> '#eeeeee',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
            array(
				'id'			=> 'footer_bar_social_icons_hover_color',
				'type'			=> 'color',
				'title'			=> __( 'Social Icons Color - "Hover" State', 'fugu-framework-admin' ),
				'default'		=> '#c6c6c6',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
			array(
				'id'			=> 'footer_bar_menu_border_color',
				'type'			=> 'color',
				'title'			=> __( 'Divider Color (Mobile)', 'fugu-framework-admin' ),
				'default'		=> '#3a3a3a',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
			array(
				'id'			=> 'footer_bar_background_color',
				'type'			=> 'color',
				'title'			=> __( 'Background Color', 'fugu-framework-admin' ),
				'default'		=> '#282828',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
            array(
				'id'	=> 'info_styling_single_post',
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Blog - Single Post', 'fugu-framework-admin' ) . '</h3>'
			),
            array(
				'id'			=> 'single_post_comments_background_color',
				'type'			=> 'color',
				'title'			=> __( 'Comments - Background Color', 'fugu-framework-admin' ),
				'default'		=> '#f7f7f7',
                'transparent'	=> false,
				'validate'		=> 'color'
			),
            array(
				'id'			=> 'single_post_comments_dividers_color',
				'type'			=> 'color',
				'title'			=> __( 'Comments - Dividers Color', 'fugu-framework-admin' ),
				'default'		=> '#e7e7e7',
                'transparent'	=> false,
				'validate'		=> 'color'
			),
			array(
				'id'	=> 'info_styling_shop',
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Shop', 'fugu-framework-admin' ) . '</h3>'
			),
            array(
				'id'			=> 'shop_thumbnail_background_color',
				'type'			=> 'color',
				'title'			=> __( 'Thumbnail - Background Color', 'fugu-framework-admin' ),
				'default'		=> '#eeeeee',
				'transparent'	=> true,
				'validate'		=> 'color'
			),
            array(
				'id'			=> 'shop_taxonomy_header_heading_color',
				'type'			=> 'color',
				'title'			=> __( 'Category Banner - Heading Color', 'fugu-framework-admin' ),				
				'default'		=> '#282828',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
            array(
				'id'			=> 'shop_taxonomy_header_description_color',
				'type'			=> 'color',
				'title'			=> __( 'Category Banner - Description Color', 'fugu-framework-admin' ),
				'default'		=> '#777777',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
            array(
				'id'			=> 'shop_rating_color',
				'type'			=> 'color',
				'title'			=> __( 'Rating Color', 'fugu-framework-admin' ),
				'default'		=> '#dc9814',
				'transparent'	=> false,
				'validate'		=> 'color',
			),
			array(
				'id'			=> 'sale_flash_font_color',
				'type'			=> 'color',
				'title'			=> __( 'Label: Sale - Font Color', 'fugu-framework-admin' ),
				'default'		=> '#282828',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
			array(
				'id'			=> 'sale_flash_background_color',
				'type'			=> 'color',
				'title'			=> __( 'Label: Sale - Background Color', 'fugu-framework-admin' ),
				'default'		=> '#ffffff',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
            array(
				'id'			=> 'new_flash_font_color',
				'type'			=> 'color',
				'title'			=> __( 'Label: New - Font Color', 'fugu-framework-admin' ),
				'default'		=> '#ffffff',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
			array(
				'id'			=> 'new_flash_background_color',
				'type'			=> 'color',
				'title'			=> __( 'Label: New - Background Color', 'fugu-framework-admin' ),
				'default'		=> '#282828',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
            array(
				'id'			=> 'outofstock_flash_font_color',
				'type'			=> 'color',
				'title'			=> __( 'Label: Out-of-Stock - Font Color', 'fugu-framework-admin' ),
				'default'		=> '#282828',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
			array(
				'id'			=> 'outofstock_flash_background_color',
				'type'			=> 'color',
				'title'			=> __( 'Label: Out-of-Stock - Background Color', 'fugu-framework-admin' ),
				'default'		=> '#ffffff',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
            /*array(
				'id'			=> 'shop_ajax_preloader_background_color',
				'type'			=> 'color',
				'title'			=> __( 'AJAX Preloader - Background Color', 'fugu-framework-admin' ),
				'default'		=> '#eeeeee',
				'transparent'	=> false,
				'validate'		=> 'color',
                'required'		=> array( 'shop_ajax_preloader_style', '=', 'placeholders' ),
			),
            array(
				'id'			=> 'shop_ajax_preloader_foreground_color',
				'type'			=> 'color',
				'title'			=> __( 'AJAX Preloader - Foreground Color', 'fugu-framework-admin' ),
				'default'		=> '#ffffff',
				'transparent'	=> false,
				'validate'		=> 'color',
                'required'		=> array( 'shop_ajax_preloader_style', '=', 'placeholders' ),
			),*/
            array(
				'id'			=> 'shop_background_color',
				'type'			=> 'color',
				'title'			=> __( 'Background Color', 'fugu-framework-admin' ),
				'default'		=> '#ffffff',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
			array(
				'id'	=> 'info_styling_shop_single_product',
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Single Product', 'fugu-framework-admin' ) . '</h3>'
			),
			array(
				'id'			=> 'featured_video_icon_color',
				'type'			=> 'color',
				'title'			=> __( 'Featured Video Icon - Font Color', 'fugu-framework-admin' ),
				'default'		=> '#282828',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
			array(
				'id'			=> 'featured_video_background_color',
				'type'			=> 'color',
				'title'			=> __( 'Featured Video Icon - Background Color', 'fugu-framework-admin' ),
				'default'		=> '#ffffff',
				'transparent'	=> false,
				'validate'		=> 'color'
			),
            array(
				'id'			=> 'single_product_background_color',
				'type'			=> 'color',
				'title'			=> __( 'Background Color', 'fugu-framework-admin' ),
				'default'		=> '#eeeeee',
                'transparent'	=> true,
				'validate'		=> 'color'
			),
            array(
				'id'			=> 'single_product_background_color_mobile',
				'type'			=> 'color',
				'title'			=> __( 'Background Color - Mobile', 'fugu-framework-admin' ),
				'default'		=> '#eeeeee',
                'transparent'	=> true,
				'validate'		=> 'color'
			),
            array(
				'id'	=> 'info_border_radius',
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Border Radius', 'fugu-framework-admin' ) . '</h3>'
			),
            array(
                'id'			=> 'border_radius_container',
                'type'			=> 'slider',
                'title'			=> __( 'Containers (pop-ups etc.)', 'fugu-framework-admin' ),
                'default'		=> 0,
                'min'			=> 0,
                'max'			=> 30,
                'step'			=> 1,
                'display_value'	=> 'text'
            ),
            array(
                'id'			=> 'border_radius_image',
                'type'			=> 'slider',
                'title'			=> __( 'Images', 'fugu-framework-admin' ),
                'default'		=> 0,
                'min'			=> 0,
                'max'			=> 30,
                'step'			=> 1,
                'display_value'	=> 'text'
            ),
            array(
                'id'			=> 'border_radius_form_inputs',
                'type'			=> 'slider',
                'title'			=> __( 'Form Inputs', 'fugu-framework-admin' ),
                'default'		=> 0,
                'min'			=> 0,
                'max'			=> 30,
                'step'			=> 1,
                'display_value'	=> 'text'
            ),
            array(
                'id'			=> 'border_radius_button',
                'type'			=> 'slider',
                'title'			=> __( 'Buttons', 'fugu-framework-admin' ),
                'default'		=> 0,
                'min'			=> 0,
                'max'			=> 30,
                'step'			=> 1,
                'display_value'	=> 'text'
            ),
		)
	) );
    
    $typography_fields_panel_only = array();
    if ( ! is_customize_preview() ) {
        $typography_fields_panel_only = array(
            // Font
            array (
                'id'	=> 'main_font_info',
                'type'	=> 'info',
                'icon'	=> true,
                'raw'	=> '<h3 style="margin: 0;">' . __( 'Font', 'fugu-framework-admin' ) . '</h3>',
            ),
            array(
                'id'		=> 'main_font_source',
                'type'		=> 'radio',
                'title'		=> __( 'Font Source', 'fugu-framework-admin' ),
                'options'	=> array(
                    '1'	=> 'Standard + Google Webfonts', 
                    '2'	=> 'Adobe Fonts',
                    '3'	=> 'Custom CSS'
                ),
                'default'	=> '1'
            ),
            array (
                'id'			=> 'main_font',
                'type'			=> 'typography',
                'title'			=> __( 'Font Face', 'fugu-framework-admin' ),
                'line-height'	=> false,
                'text-align'	=> false,
                'font-style'	=> false,
                'font-weight'	=> false,
                'font-size'		=> false,
                'color'			=> false,
                'all_styles'    => true, // Note: Don't disable - Used to generate font-weight(s) based on theme-settings in: "../plugins/fugu-theme-settings/includes/options/ReduxCore/inc/fields/typography/field_typography.php" (see "makeGoogleWebfontLink()" function)
                'default'		=> array (
                    'font-family'	=> 'Roboto',
                    'subsets'		=> '',
                ),
                'required'		=> array( 'main_font_source', '=', '1' )
            ),
            array(
                'id'		=> 'main_font_adobefonts_project_id',
                'type'		=> 'text',
                'title'		=> __( 'Adobe Fonts - Project ID', 'fugu-framework-admin' ),
                'desc'	    => __( 'Enter the ID for your Web Project', 'fugu-framework-admin' ),
                'default'	=> '',
                'required'	=> array( 'main_font_source', '=', '2' )
            ),
            array (
                'id'		=> 'main_adobefonts_font',
                'type'		=> 'text',
                'title'		=> __( 'Adobe Fonts - Font', 'fugu-framework-admin' ),
                'desc'	    => __( 'CSS font name i.e: futura-pt', 'fugu-framework-admin' ),
                'default'	=> '',
                'required'	=> array( 'main_font_source', '=', '2' )
            ),
            array(
                'id'		=> 'main_font_custom_css',
                'type'		=> 'ace_editor',
                'title' 	=> __( 'Custom CSS', 'fugu-framework-admin' ),
                'subtitle' 		=> __( 'Example: body { font-family: "Proxima Nova Regular", sans-serif; }', 'fugu-framework-admin' ),
                'mode'		=> 'css',
                'theme'		=> 'chrome',
                'default'	=> '',
                'required'	=> array( 'main_font_source', '=', '3' )
            ),
            // Font - Header menus
            array (
                'id'	=> 'header_font_info',
                'icon'	=> true,
                'type'	=> 'info',
                'raw'	=> '<h3 style="margin: 0;">' . __( 'Font - Header Menus', 'fugu-framework-admin' ) . '</h3>',
            ),
            array(
                'id'		=> 'header_font_source',
                'type'		=> 'radio',
                'title'		=> __('Font Source', 'fugu-framework-admin'),
                'options'	=> array(
                    '0' => '(none)',
                    '1'	=> 'Standard + Google Webfonts', 
                    '2'	=> 'Adobe Fonts'
                ),
                'default'	=> '0'
            ),
            array (
                'id'			=> 'header_font',
                'type'			=> 'typography',
                'title'			=> __( 'Font Face', 'fugu-framework-admin' ),
                'line-height'	=> false,
                'text-align'	=> false,
                'font-style'	=> false,
                'font-weight'	=> false,
                'font-size'		=> false,
                'color'			=> false,
                'all_styles'    => true,
                'default'		=> array (
                    'font-family'	=> 'Roboto',
                    'subsets'		=> '',
                ),
                'required'		=> array( 'header_font_source', '=', '1' )
            ),
            array(
                'id'		=> 'header_font_adobefonts_project_id',
                'type'		=> 'text',
                'title'		=> __( 'Adobe Fonts - Project ID', 'fugu-framework-admin' ), 
                'desc'	    => __( 'Enter the ID for your Web Project', 'fugu-framework-admin' ),
                'default'	=> '',
                'required'	=> array( 'header_font_source', '=', '2' )
            ),
            array (
                'id'		=> 'header_adobefonts_font',
                'type'		=> 'text',
                'title'		=> __( 'Adobe Fonts - Font', 'fugu-framework-admin' ),
                'desc'	    => __( 'CSS font name i.e: futura-pt', 'fugu-framework-admin' ),
                'default'	=> '',
                'required'	=> array( 'header_font_source', '=', '2' )
            ),
            // Font - Headings
            array (
                'id'	=> 'secondary_font_info',
                'icon'	=> true,
                'type'	=> 'info',
                'raw'	=> '<h3 style="margin: 0;">' . __( 'Font - Headings', 'fugu-framework-admin' ) . '</h3>',
            ),
            array(
                'id'		=> 'secondary_font_source',
                'type'		=> 'radio',
                'title'		=> __('Font Source', 'fugu-framework-admin'),
                'options'	=> array(
                    '0' => '(none)',
                    '1'	=> 'Standard + Google Webfonts', 
                    '2'	=> 'Adobe Fonts'
                ),
                'default'	=> '0'
            ),
            array (
                'id'			=> 'secondary_font',
                'type'			=> 'typography',
                'title'			=> __( 'Font Face', 'fugu-framework-admin' ),
                'line-height'	=> false,
                'text-align'	=> false,
                'font-style'	=> false,
                'font-weight'	=> false,
                'font-size'		=> false,
                'color'			=> false,
                'all_styles'    => true,
                'default'		=> array (
                    'font-family'	=> 'Roboto',
                    'subsets'		=> '',
                ),
                'required'		=> array( 'secondary_font_source', '=', '1' )
            ),
            array(
                'id'		=> 'secondary_font_adobefonts_project_id',
                'type'		=> 'text',
                'title'		=> __( 'Adobe Fonts - Project ID', 'fugu-framework-admin' ), 
                'desc'	    => __( 'Enter the ID for your Web Project', 'fugu-framework-admin' ),
                'default'	=> '',
                'required'	=> array( 'secondary_font_source', '=', '2' )
            ),
            array (
                'id'		=> 'secondary_adobefonts_font',
                'type'		=> 'text',
                'title'		=> __( 'Adobe Fonts - Font', 'fugu-framework-admin' ),
                'desc'	    => __( 'CSS font name i.e: futura-pt', 'fugu-framework-admin' ),
                'default'	=> '',
                'required'	=> array( 'secondary_font_source', '=', '2' )
            ),
        );
    }
    
    $typography_fields = array(
        // Font sizes
        array (
            'id'	=> 'font_sizes_info',
            'type'	=> 'info',
            'icon'	=> true,
            'raw'	=> '<h3 style="margin: 0;">' . __( 'Font Sizes', 'fugu-framework-admin' ) . '</h3>',
        ),
        array(
            'id'			=> 'font_size_header_menu',
            'type'			=> 'slider',
            'title'			=> __( 'Header Menu', 'fugu-framework-admin' ),
            'default'		=> 16,
            'min'			=> 12,
            'max'			=> 20,
            'step'			=> 1,
            'display_value'	=> 'text'
        ),
        array(
            'id'			=> 'font_size_mobile_menu',
            'type'			=> 'slider',
            'title'			=> __( 'Mobile Menu', 'fugu-framework-admin' ),
            'default'		=> 18,
            'min'			=> 10,
            'max'			=> 20,
            'step'			=> 1,
            'display_value'	=> 'text'
        ),
        array(
            'id'			=> 'font_size_mobile_menu_secondary',
            'type'			=> 'slider',
            'title'			=> __( 'Mobile Menu - Secondary', 'fugu-framework-admin' ),
            'default'		=> 15,
            'min'			=> 10,
            'max'			=> 20,
            'step'			=> 1,
            'display_value'	=> 'text'
        ),
        array(
            'id'			=> 'font_size_large',
            'type'			=> 'slider',
            'title'			=> __( 'Body Text - Large', 'fugu-framework-admin' ),
            'default'		=> 18,
            'min'			=> 14,
            'max'			=> 24,
            'step'			=> 1,
            'display_value'	=> 'text'
        ),
        array(
            'id'			=> 'font_size_medium',
            'type'			=> 'slider',
            'title'			=> __( 'Body Text - Medium', 'fugu-framework-admin' ),
            'default'		=> 16,
            'min'			=> 12,
            'max'			=> 20,
            'step'			=> 1,
            'display_value'	=> 'text'
        ),
        array(
            'id'			=> 'font_size_small',
            'type'			=> 'slider',
            'title'			=> __( 'Body Text - Small', 'fugu-framework-admin' ),
            'default'		=> 14,
            'min'			=> 8,
            'max'			=> 16,
            'step'			=> 1,
            'display_value'	=> 'text'
        ),
        array(
            'id'			=> 'font_size_xsmall',
            'type'			=> 'slider',
            'title'			=> __( 'Body Text - Extra Small', 'fugu-framework-admin' ),
            'default'		=> 12,
            'min'			=> 6,
            'max'			=> 14,
            'step'			=> 1,
            'display_value'	=> 'text'
        ),
        // Font weight
        array (
            'id'	=> 'font_weight_info',
            'type'	=> 'info',
            'icon'	=> true,
            'raw'	=> '<h3 style="margin: 0;">' . __( 'Font Weight', 'fugu-framework-admin' ) . '</h3>',
        ),
        array(
            'id'		=> 'font_weight_header_menu',
            'type'		=> 'select',
            'title'		=> __( 'Header Menu', 'fugu-framework-admin' ),
            'options'	=> array(
                'normal' => 'Normal',
                'bold' => 'Bold',
                'bolder' => 'Bolder',
                'inherit' => 'Inherit',
                'lighter' => 'Lighter',
                '100' => '100',
                '200' => '200',
                '300' => '300',
                '400' => '400',
                '500' => '500',
                '600' => '600',
                '700' => '700',
                '800' => '800',
                '900' => '900'
            ),
            'default'	=> 'normal'
        ),
        array(
            'id'		=> 'font_weight_mobile_menu',
            'type'		=> 'select',
            'title'		=> __( 'Mobile Menu', 'fugu-framework-admin' ),
            'options'	=> array(
                'normal' => 'Normal',
                'bold' => 'Bold',
                'bolder' => 'Bolder',
                'inherit' => 'Inherit',
                'lighter' => 'Lighter',
                '100' => '100',
                '200' => '200',
                '300' => '300',
                '400' => '400',
                '500' => '500',
                '600' => '600',
                '700' => '700',
                '800' => '800',
                '900' => '900'
            ),
            'default'	=> 'normal'
        ),
        array(
            'id'		=> 'font_weight_body',
            'type'		=> 'select',
            'title'		=> __( 'Body Text', 'fugu-framework-admin' ),
            'options'	=> array(
                'normal' => 'Normal',
                'bold' => 'Bold',
                'bolder' => 'Bolder',
                'inherit' => 'Inherit',
                'lighter' => 'Lighter',
                '100' => '100',
                '200' => '200',
                '300' => '300',
                '400' => '400',
                '500' => '500',
                '600' => '600',
                '700' => '700',
                '800' => '800',
                '900' => '900'
            ),
            'default'	=> 'normal'
        ),
        array(
            'id'		=> 'font_weight_h1',
            'type'		=> 'select',
            'title'		=> __( 'Heading 1 (h1)', 'fugu-framework-admin' ),
            'options'	=> array(
                'normal' => 'Normal',
                'bold' => 'Bold',
                'bolder' => 'Bolder',
                'inherit' => 'Inherit',
                'lighter' => 'Lighter',
                '100' => '100',
                '200' => '200',
                '300' => '300',
                '400' => '400',
                '500' => '500',
                '600' => '600',
                '700' => '700',
                '800' => '800',
                '900' => '900'
            ),
            'default'	=> 'normal'
        ),
        array(
            'id'		=> 'font_weight_h2',
            'type'		=> 'select',
            'title'		=> __( 'Heading 2 (h2)', 'fugu-framework-admin' ),
            'options'	=> array(
                'normal' => 'Normal',
                'bold' => 'Bold',
                'bolder' => 'Bolder',
                'inherit' => 'Inherit',
                'lighter' => 'Lighter',
                '100' => '100',
                '200' => '200',
                '300' => '300',
                '400' => '400',
                '500' => '500',
                '600' => '600',
                '700' => '700',
                '800' => '800',
                '900' => '900'
            ),
            'default'	=> 'normal'
        ),
        array(
            'id'		=> 'font_weight_h3',
            'type'		=> 'select',
            'title'		=> __( 'Heading 3 (h3)', 'fugu-framework-admin' ),
            'options'	=> array(
                'normal' => 'Normal',
                'bold' => 'Bold',
                'bolder' => 'Bolder',
                'inherit' => 'Inherit',
                'lighter' => 'Lighter',
                '100' => '100',
                '200' => '200',
                '300' => '300',
                '400' => '400',
                '500' => '500',
                '600' => '600',
                '700' => '700',
                '800' => '800',
                '900' => '900'
            ),
            'default'	=> 'normal'
        ),
        array(
            'id'		=> 'font_weight_h456',
            'type'		=> 'select',
            'title'		=> __( 'Heading 4, 5 and 6 (h4, h5, h6)', 'fugu-framework-admin' ),
            'options'	=> array(
                'normal' => 'Normal',
                'bold' => 'Bold',
                'bolder' => 'Bolder',
                'inherit' => 'Inherit',
                'lighter' => 'Lighter',
                '100' => '100',
                '200' => '200',
                '300' => '300',
                '400' => '400',
                '500' => '500',
                '600' => '600',
                '700' => '700',
                '800' => '800',
                '900' => '900'
            ),
            'default'	=> 'normal'
        ),
        // Letter Spacing
        array (
            'id'	=> 'letter_spacing_info',
            'type'	=> 'info',
            'icon'	=> true,
            'raw'	=> '<h3 style="margin: 0;">' . __( 'Letter Spacing', 'fugu-framework-admin' ) . '</h3>',
        ),
        array(
            'id'        => 'letter_spacing_header_menu',
            'type'      => 'text',
            'title'	    => __( 'Header Menu', 'fugu-framework-admin' ),
            //'desc'	    => __( 'Value is in pixels (px)', 'fugu-framework-admin' ),
            'validate'  => 'numeric'
        ),
        array(
            'id'        => 'letter_spacing_mobile_menu',
            'type'      => 'text',
            'title'	    => __( 'Mobile Menu', 'fugu-framework-admin' ),
            'validate'  => 'numeric'
        ),
        array(
            'id'        => 'letter_spacing_body',
            'type'      => 'text',
            'title'	    => __( 'Body Text', 'fugu-framework-admin' ),
            'validate'  => 'numeric'
        ),
        array(
            'id'        => 'letter_spacing_h1',
            'type'      => 'text',
            'title'	    => __( 'Heading 1 (h1)', 'fugu-framework-admin' ),
            'validate'  => 'numeric'
        ),
        array(
            'id'        => 'letter_spacing_h2',
            'type'      => 'text',
            'title'	    => __( 'Heading 2 (h2)', 'fugu-framework-admin' ),
            'validate'  => 'numeric'
        ),
        array(
            'id'        => 'letter_spacing_h3',
            'type'      => 'text',
            'title'	    => __( 'Heading 3 (h3)', 'fugu-framework-admin' ),
            'validate'  => 'numeric'
        ),
        array(
            'id'        => 'letter_spacing_h456',
            'type'      => 'text',
            'title'	    => __( 'Heading 4, 5 and 6 (h4, h5, h6)', 'fugu-framework-admin' ),
            'validate'  => 'numeric'
        ),
    );
    
    $typography_fields_merged = array_merge( $typography_fields_panel_only, $typography_fields );

	Redux::setSection( $opt_name, array(
		'title'		=> __( 'Typography', 'fugu-framework-admin' ),
		'icon'		=> 'el-icon-font',
		'fields'	=> $typography_fields_merged,
	) );
	
	Redux::setSection( $opt_name, array(
		'title'		=> __( 'Shop', 'fugu-framework-admin' ),
		'icon'		=> 'el-icon-shopping-cart',
		'fields'	=> array(
            array(
				'id'		=> 'shop_content_home',
				'type'		=> 'switch',
				'title'		=> __( 'Page Content', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Display page content above WooCommerce shop-catalog.', 'fugu-framework-admin' ),
				'default'	=> 1,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
            array(
				'id'		=> 'shop_page_id',
				'type'		=> 'select',
				'title'		=> __( 'Page', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Select page to display above WooCommerce shop-catalog', 'fugu-framework-admin' ),
				'data'		=> 'pages',
				//'default'	=> 757, // Don't set default page here to avoid changing shop content (set in theme setup if needed instead)
                'required'	=> array( 'shop_content_home', '=', '1' )
			),
            array(
				'id'		=> 'shop_catalog_mode',
				'type'		=> 'switch',
				'title'		=> __( 'Catalog Mode', 'fugu-framework-admin' ),
                'subtitle'	=> __( 'Hide prices, add-to-cart buttons etc. from the shop.', 'fugu-framework-admin' ),
				'default'	=> 0,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
			array(
				'id' 	=> 'shop_category_info',
				'icon'	=> true,
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Category', 'fugu-framework-admin' ) . '</h3>'
			),
            array(
				'id'		=> 'shop_content_taxonomy',
				'type'		=> 'select',
				'title'		=> __( 'Page Content', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Select content to display on category pages.', 'fugu-framework-admin' ),
				'options'	=> array(
                    '0'                 => 'Disable',
                    'taxonomy_header'   => 'Category Banner',
                    'taxonomy_heading'  => 'Category Heading',
                    'shop_page'         => 'Default WooCommerce shop-catalog page (selected above)'
                ),
				'default'	=> '0'
			),
			array(
				'id'		=> 'shop_category_description',
				'type'		=> 'switch',
				'title'		=> __( 'Description', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Display category description.', 'fugu-framework-admin' ),
				'default'	=> 0,
				'on'		=> 'Enable',
				'off'		=> 'Disable',
                'required'	=> array( 'shop_content_taxonomy', '!=', 'taxonomy_header' )
			),
            array(
                'id'		=> 'shop_default_description',
                'type'		=> 'textarea',
                'title'		=> __( 'Description - Default', 'fugu-framework-admin' ),
                'subtitle'	=> __( 'Alternative description when no category is selected.', 'fugu-framework-admin' ),
                'rows'      => 4,
                'validate'	=> 'html',
                'required'	=> array( 'shop_category_description', '=', '1' )
            ),
            array(
				'id'		=> 'shop_description_layout',
				'type'		=> 'select',
				'title'		=> __( 'Description - Layout', 'fugu-framework-admin' ),
				'options'	=> array( 'clean' => 'Text only', 'borders' => 'Text with borders' ),
				'default'	=> 'clean',
                'required'	=> array( 'shop_category_description', '=', '1' )
			),
            array(
				'id'		=> 'shop_description_position',
				'type'		=> 'select',
				'title'		=> __( 'Description - Position', 'fugu-framework-admin' ),
				'options'	=> array( 'top' => 'Above Products', 'bottom' => 'Below Products' ),
				'default'	=> 'top',
                'required'	=> array( 'shop_category_description', '=', '1' )
			),
            array (
				'id' 	=> 'shop_category_banner_info',
				'icon'	=> true,
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Category Banner', 'fugu-framework-admin' ) . '</h3>',
                'required'	=> array( 'shop_content_taxonomy', '=', 'taxonomy_header' )
			),
            array(
				'id'		=> 'shop_taxonomy_header_text_alignment',
				'type'		=> 'select',
				'title'		=> __( 'Text - Alignment', 'fugu-framework-admin' ),
				'options'	=> array( 'left' => 'Left', 'center' => 'Center', 'right' => 'Right' ),
				'default'	=> 'center',
                'required'	=> array( 'shop_content_taxonomy', '=', 'taxonomy_header' )
			),
            array(
                'id'		=> 'shop_taxonomy_header_text_max_width',
                'type' 		=> 'text',
                'title' 	=> __( 'Text - Maximum Width', 'fugu-framework-admin' ),
                'validate'	=> 'numeric',
                'default'	=> '',
                'required'	=> array( 'shop_content_taxonomy', '=', 'taxonomy_header' )
            ),
            array(
				'id'		=> 'shop_taxonomy_header_image',
				'type'		=> 'switch',
				'title'		=> __( 'Category Image', 'fugu-framework-admin' ),
                'subtitle'	=> __( 'Display category image.', 'fugu-framework-admin' ),
				'default'	=> 1,
				'on'		=> 'Enable',
				'off'		=> 'Disable',
                'required'	=> array( 'shop_content_taxonomy', '=', 'taxonomy_header' )
			),
            array(
				'id'			=> 'shop_taxonomy_header_image_height',
				'type'			=> 'slider',
				'title'			=> __( 'Category Image - Height', 'fugu-framework-admin' ),
				'default'		=> 370,
				'min'			=> 1,
				'max'			=> 1000,
				'step'			=> 1,
				'display_value'	=> 'text',
                'required'	=> array( 'shop_content_taxonomy', '=', 'taxonomy_header' )
                //'required'	=> array( 'shop_taxonomy_header_image', '=', 1 ),
			),
            array(
				'id'			=> 'shop_taxonomy_header_image_height_tablet',
				'type'			=> 'slider',
				'title'			=> __( 'Category Image - Height: Tablet', 'fugu-framework-admin' ),
				'default'		=> 370,
				'min'			=> 1,
				'max'			=> 1000,
				'step'			=> 1,
				'display_value'	=> 'text',
                'required'	=> array( 'shop_content_taxonomy', '=', 'taxonomy_header' ),
                //'required'	=> array( 'shop_taxonomy_header_image', '=', 1 ),
			),
            array(
				'id'			=> 'shop_taxonomy_header_image_height_mobile',
				'type'			=> 'slider',
				'title'			=> __( 'Category Image - Height: Mobile', 'fugu-framework-admin' ),
				'default'		=> 210,
				'min'			=> 1,
				'max'			=> 1000,
				'step'			=> 1,
				'display_value'	=> 'text',
                'required'	=> array( 'shop_content_taxonomy', '=', 'taxonomy_header' ),
                //'required'	=> array( 'shop_taxonomy_header_image', '=', 1 ),
			),
			array (
				'id' 	=> 'shop_catalog_info',
				'icon'	=> true,
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Catalog', 'fugu-framework-admin' ) . '</h3>',
			),
            array(
				'id' 		=> 'shop_grid',
				'type' 		=> 'image_select',
				'title' 	=> __( 'Grid', 'fugu-framework-admin' ),
				'options'	=> array(
                    'default'      => array( 'title' => 'Standard (1-6 columns)', 'img' => FUGU_URI . '/assets/img/option-panel/shop-grid-default.png' ),
                    'scattered'    => array( 'title' => 'Scattered (2 columns)', 'img' => FUGU_URI . '/assets/img/option-panel/shop-grid-scattered.png' ),
                    'grid-6n-1-5'  => array( 'title' => 'Variable (2 columns)', 'img' => FUGU_URI . '/assets/img/option-panel/shop-grid-6n-1-5.png' ),
					'grid-10n-1-7' => array( 'title' => 'Variable (3 columns)', 'img' => FUGU_URI . '/assets/img/option-panel/shop-grid-10n-1-7.png' ),
                    'list'         => array( 'title' => 'List (1 column)', 'img' => FUGU_URI . '/assets/img/option-panel/shop-grid-list.png' )
				),
				'default' 	=> 'default'
			),
			array(
				'id'			=> 'shop_columns',
				'type'			=> 'slider',
				'title'			=> __( 'Columns', 'fugu-framework-admin' ),
				'default'		=> 4,
				'min'			=> 1,
				'max'			=> 8,
				'step'			=> 1,
				'display_value'	=> 'text',
                'required'	    => array( 'shop_grid', '=', 'default' )
			),
			array(
				'id'			=> 'shop_columns_mobile',
				'type'			=> 'slider',
				'title'			=> __( 'Columns - Mobile', 'fugu-framework-admin' ),
				'default'		=> 1,
				'min'			=> 1,
				'max'			=> 2,
				'step'			=> 1,
				'display_value'	=> 'text'
			),
			array(
				'id'			=> 'products_per_page',
				'type'			=> 'slider',
				'title'			=> __( 'Products per Page', 'fugu-framework-admin' ),
				'default'		=> 16,
				'min'			=> 1,
				'max'			=> 48,
				'step'			=> 1,
				'display_value'	=> 'text'
			),
            array(
				'id'		=> 'shop_infinite_load',
				'type'		=> 'select',
				'title'		=> __( 'Infinite Load', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Configure "infinite" product loading.', 'fugu-framework-admin' ),
				'options'	=> array( '0' => 'Disable', 'button' => 'Button', 'scroll' => 'Scroll' ),
				'default'	=> 'button'
			),
            array (
				'id' 	=> 'shop_catalog_auto_scroll_info',
				'icon'	=> true,
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Catalog - Auto Scroll', 'fugu-framework-admin' ) . '</h3>',
			),
            array(
				'id'			=> 'shop_scroll_offset',
				'type'			=> 'slider',
				'title'			=> __( 'Scroll Offset', 'fugu-framework-admin' ),
				'subtitle'		=> __( "Used to offset the shop's scroll position (when a category link is clicked for example).", 'fugu-framework-admin' ),
				'default'		=> 70,
				'min'			=> 0,
				'max'			=> 1000,
				'step'			=> 1,
				'display_value'	=> 'text'
			),
            array(
				'id'			=> 'shop_scroll_offset_tablet',
				'type'			=> 'slider',
				'title'			=> __( 'Scroll Offset - Tablet', 'fugu-framework-admin' ),
				'default'		=> 70,
				'min'			=> 0,
				'max'			=> 1000,
				'step'			=> 1,
				'display_value'	=> 'text'
			),
            array(
				'id'			=> 'shop_scroll_offset_mobile',
				'type'			=> 'slider',
				'title'			=> __( 'Scroll Offset - Mobile', 'fugu-framework-admin' ),
				'default'		=> 70,
				'min'			=> 0,
				'max'			=> 1000,
				'step'			=> 1,
				'display_value'	=> 'text'
			),
            array (
				'id' 	=> 'products_info',
				'icon'	=> true,
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Products', 'fugu-framework-admin' ) . '</h3>',
			),
            array(
				'id' 		=> 'products_layout',
				'type' 		=> 'image_select',
				'title' 	=> __( 'Layout', 'fugu-framework-admin' ),
				'options'	=> array(
                    'default'   => array( 'title' => 'Standard', 'img' => FUGU_URI . '/assets/img/option-panel/products-layout-default.png' ),
                    'centered' => array( 'title' => 'Centered', 'img' => FUGU_URI . '/assets/img/option-panel/products-layout-centered.png' ),
					'static-buttons' => array( 'title' => 'Static Buttons', 'img' => FUGU_URI . '/assets/img/option-panel/products-layout-static-buttons.png' ),
                    'static-buttons-on-touch' => array( 'title' => 'Static Buttons (on Mobile)', 'img' => FUGU_URI . '/assets/img/option-panel/products-layout-static-buttons-on-touch.png' ),     
                    'overlay' => array( 'title' => 'Overlay', 'img' => FUGU_URI . '/assets/img/option-panel/products-layout-overlay.png' )
				),
				'default' 	=> 'default'
			),
			array(
				'id'		=> 'product_sale_flash',
				'type'		=> 'select',
				'title'		=> __( 'Label - Sale', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'On-sale label.', 'fugu-framework-admin' ),
				'options'	=> array( '0' => 'Disable', 'txt' => 'Display sale Text', 'pct' => 'Display sale Percentage' ),
				'default'	=> 'pct'
			),
            array(
				'id'		=> 'product_new_flash',
				'type'		=> 'switch',
				'title'		=> __( 'Label - New', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'New product label.', 'fugu-framework-admin' ),
				'default'	=> 0,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
            array (
				'id'		=> 'product_new_flash_text',
				'type'		=> 'text',
				'title'		=> __( 'Label - New: Text', 'fugu-framework-admin' ),
                'default'	=> 'New',
                'validate'	=> 'html',
				'required'  => array( 'product_new_flash', '=', '1' )
			),
            array(
				'id'			=> 'product_new_flash_time_limit',
				'type'			=> 'slider',
				'title'			=> __( 'Label - New: Time limit (days)', 'fugu-framework-admin' ),
                'subtitle'	=> __( 'Time-limit in Days for "New" product label.', 'fugu-framework-admin' ),
				'default'		=> 14,
				'min'			=> 1,
				'max'			=> 365,
				'step'			=> 1,
				'display_value'	=> 'text',
                'required'      => array( 'product_new_flash', '=', '1' )
			),
			array(
				'id'		=> 'product_image_lazy_loading',
				'type'		=> 'switch',
				'title'		=> __( 'Image Lazy Loading', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Lazy load product-images.', 'fugu-framework-admin' ),
				'default'	=> 1,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
            array(
				'id'	=> 'product_placeholder_image',
				'type'	=> 'media', 
				'title'	=> __( 'Image Lazy Loading - Placeholder', 'fugu-framework-admin' ),
                'subtitle'	=> __( 'Display a custom placeholder image while lazy-loading.', 'fugu-framework-admin' ),
                'required'	=> array( 'product_image_lazy_loading', '=', '1' )
			),
			array(
				'id'		=> 'product_hover_image_global',
				'type'		=> 'switch',
				'title'		=> __( 'Hover Image', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Display the second gallery image when a product is "hovered".', 'fugu-framework-admin' ),
				'default'	=> 1,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
            array(
				'id'		=> 'product_display_attributes',
				'type'		=> 'switch',
				'title'		=> __( 'Swatches (Colors/Images)', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Display color/image swatches for variable-product attributes.', 'fugu-framework-admin' ),
				'default'	=> 0,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
            array(
				'id'		=> 'product_attributes_position',
				'type'		=> 'select',
				'title'		=> __( 'Swatches - Position', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Select swatches position.', 'fugu-framework-admin' ),
				'options'	=> array( 'thumbnail' => 'On Thumbnail', 'details' => 'Below Details' ),
				'default'	=> 'thumbnail'
			),
            array(
				'id'		=> 'product_attributes_swap_image',
				'type'		=> 'switch',
				'title'		=> __( 'Swatches - Hover Image', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Display attribute/variation image when a swatch is "hovered".', 'fugu-framework-admin' ),
				'default'	=> 0,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
            array(
				'id'		=> 'product_rating',
				'type'		=> 'switch',
				'title'		=> __( 'Rating', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Display star-rating below product title.', 'fugu-framework-admin' ),
				'default'	=> 0,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
            array(
				'id'		=> 'product_action_link',
				'type'		=> 'switch',
				'title'		=> __( 'Action Link', 'fugu-framework-admin' ),
                'subtitle'	=> __( 'Show product action link (e.g. "Add to cart") ', 'fugu-framework-admin' ),
				'default'	=> 0,
				'on'		=> 'Enable',
				'off'		=> 'Disable',
			),
            array(
				'id'		=> 'product_action_link_position',
				'type'		=> 'select',
				'title'		=> __( 'Action Link - Position', 'fugu-framework-admin' ),
				'options'	=> array( 'thumbnail' => 'On Thumbnail', 'details' => 'Below Title' ),
				'default'	=> 'details',
                'required'	=> array(
                    array( 'product_action_link', '=', 1 ),
                    array( 'products_layout', '!=', 'overlay' ),
                ),
			),
			array (
				'id' 	=> 'product_quickview_info',
				'icon'	=> true,
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Quick View', 'fugu-framework-admin' ) . '</h3>',
			),
			array(
				'id'		=> 'product_quickview',
				'type'		=> 'switch',
				'title'		=> __( 'Quick View', 'fugu-framework-admin' ),
				'default'	=> 1,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
            array(
				'id'		=> 'product_quickview_link',
				'type'		=> 'switch',
				'title'		=> __( 'Link', 'fugu-framework-admin' ),
                'subtitle'	=> __( 'Show Quick View link', 'fugu-framework-admin' ),
				'default'	=> 1,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
            array (
				'id'		=> 'product_quickview_link_label',
				'type'		=> 'text',
				'title'		=> __( 'Link - Label', 'fugu-framework-admin' ),
                'default'	=> '',
                //'validate'	=> 'html',
                'required'	=> array( 'product_quickview_link', '=', '1' ),
			),
            array(
				'id'		=> 'product_quickview_link_actions',
				'type'      => 'checkbox',
				'title'		=> __( 'Link Actions', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Open Quick View when clicking...', 'fugu-framework-admin' ),
                'options'	=> array(
                    'thumb' => __( 'Thumbnail', 'fugu-framework-admin' ),
                    'title' => __( 'Title', 'fugu-framework-admin' ),
                    'link'  => __( 'Link', 'fugu-framework-admin' )
                ),
                'default' => array(
                    'thumb' => '0',
                    'title' => '0',
                    'link'  => '1'
                ),
				'required'	=> array( 'product_quickview', '=', '1' )
			),
			array(
				'id'		=> 'product_quickview_summary_layout',
				'type'		=> 'select',
				'title'		=> __( 'Summary - Layout', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Select product-summary layout.', 'fugu-framework-admin' ),
				'options'	=> array( 'align-top' => 'Align to Top (suitable for shorter images)', 'align-bottom' => 'Align to Bottom' ),
				'default'	=> 'align-top',
				'required'	=> array( 'product_quickview', '=', '1' )
			),
			array(
				'id'		=> 'product_quickview_atc',
				'type'		=> 'switch',
				'title'		=> __( 'Summary - Add to Cart Button', 'fugu-framework-admin' ),
				'default'	=> 1,
				'on'		=> 'Enable',
				'off'		=> 'Disable',
				'required'	=> array( 'product_quickview', '=', '1' )
			),
			array(
				'id'		=> 'product_quickview_details_button',
				'type'		=> 'switch',
				'title'		=> __( 'Summary - Details Button', 'fugu-framework-admin' ),
				'default'	=> 0,
				'on'		=> 'Enable',
				'off'		=> 'Disable',
				'required'	=> array( 'product_quickview', '=', '1' )
			),
			array (
				'id' 	=> 'cart_info',
				'icon'	=> true,
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Cart', 'fugu-framework-admin' ) . '</h3>',
			),
			array(
				'id'		=> 'cart_show_item_price',
				'type'		=> 'switch',
				'title'		=> __( 'Single Item Price', 'fugu-framework-admin' ),
				'default'	=> 0,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
            array (
				'id' 	=> 'cart_info',
				'icon'	=> true,
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Cart Panel', 'fugu-framework-admin' ) . '</h3>',
			),
            array(
				'id'		=> 'widget_panel_show_on_atc',
				'type'		=> 'switch', 
				'title'		=> __( 'Show on add-to-cart', 'fugu-framework-admin' ),
				'default'	=> 1,
				'on'		=> 'Enable',
				'off'		=> 'Disable',
                //'required'	=> array( 'menu_cart', '=', '1' )
			),
            array(
				'id'		=> 'widget_panel_color',
				'type'		=> 'select',
				'title'		=> __( 'Color Scheme', 'fugu-framework-admin' ),
				'options'	=> array( 'light' => 'Light', 'dark' => 'Dark' ),
				'default'	=> 'dark',
                //'required'	=> array( 'menu_cart', '=', '1' )
			),
            array(
				'id'		=> 'cart_panel_quantity_arrows',
				'type'		=> 'switch', 
				'title'		=> __( 'Quantity Arrows', 'fugu-framework-admin' ),
				'default'	=> 1,
				'on'		=> 'Enable',
				'off'		=> 'Disable',
				//'required'	=> array( 'menu_cart', '=', '1' )
			),
            array(
				'id'		=> 'cart_shipping_meter',
				'type'		=> 'switch', 
				'title'		=> __( 'Shipping Meter', 'fugu-framework-admin' ),
				'default'	=> 0,
				'on'		=> 'Enable',
				'off'		=> 'Disable',
			),
            array (
				'id'		=> 'cart_shipping_meter_message',
				'type'		=> 'text',
				'title'		=> __( 'Shipping Meter - Message', 'fugu-framework-admin' ),
                'default'	=> __( 'Spend {remaining} more to get FREE SHIPPING', 'fugu-framework-admin' ),
                //'validate'	=> 'html',
                'required'	=> array( 'cart_shipping_meter', '=', '1' ),
			),
            array (
				'id'		=> 'cart_shipping_meter_message_qualified',
				'type'		=> 'text',
				'title'		=> __( 'Shipping Meter - Qualified Message', 'fugu-framework-admin' ),
                'default'	=> __( 'This order gets FREE SHIPPING!', 'fugu-framework-admin' ),
                //'validate'	=> 'html',
                'required'	=> array( 'cart_shipping_meter', '=', '1' ),
			),
            array (
				'id' 	=> 'checkout_info',
				'icon'	=> true,
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Checkout (classic "shortcode" page)', 'fugu-framework-admin' ) . '</h3>',
			),
			array(
				'id'		=> 'checkout_inline_notices',
				'type'		=> 'switch',
				'title'		=> __( 'Inline Validation Notices', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Display validation notices below input fields.', 'fugu-framework-admin' ),
				'default'	=> 1,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
            array(
				'id'		=> 'checkout_tac_lightbox',
				'type'		=> 'switch',
				'title'		=> __( 'Terms & Conditions Lightbox', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Display "Terms & conditions" in a lightbox window.', 'fugu-framework-admin' ),
				'default'	=> 1,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			)
		)
	) );
	
    Redux::setSection( $opt_name, array(
		'title'		=> __( 'Shop Filters', 'fugu-framework-admin' ),
		//'icon'		=> 'el-icon-shopping-cart',
        //'icon'		=> 'el-icon-adjust-alt',
        'icon'		=> 'el-icon-filter',
		'fields'	=> array(
			array(
				'id'		=> 'shop_header',
				'type'		=> 'switch',
				'title'		=> __( 'Filters Bar', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Display filters bar (categories, filters & search) above shop catalog.', 'fugu-framework-admin' ),
                'default'	=> 1,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
			array(
				'id'		=> 'shop_filters_enable_ajax',
				'type'		=> 'select',
				'title'		=> __( 'AJAX', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Enable AJAX for product filters.', 'fugu-framework-admin' ),
				'options'	=> array( '1' => 'Enable', 'desktop' => 'Disable on Touch devices', '0' => 'Disable' ),
				'default'	=> '1'
			),
			array(
				'id'		=> 'shop_ajax_update_title',
				'type'		=> 'switch',
				'title'		=> __( 'AJAX - Update Page Title', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Update page-title after loading a new page.', 'fugu-framework-admin' ),
				'default'	=> 1,
				'on'		=> 'Enable',
				'off'		=> 'Disable',
				'required'	=> array( 'shop_filters_enable_ajax', '!=', '0' )
			),
            /*array(
				'id'		=> 'shop_ajax_preloader_style',
				'type'		=> 'select',
				'title'		=> __( 'AJAX - Preloader Style', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Select preloader style for when products are loaded.', 'fugu-framework-admin' ),
				'options'	=> array(
                    'spinner'       => 'Spinner',
                    'placeholders'  => 'Placeholders',
                ),
				'default'   => 'spinner',
			),*/
			array (
				'id' 	=> 'shop_header_categories_info',
				'icon'	=> true,
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Categories Menu', 'fugu-framework-admin' ) . '</h3>',
			),
			array(
				'id'		=> 'shop_categories',
				'type'		=> 'switch',
				'title'		=> __( 'Menu', 'fugu-framework-admin' ),
				'default'	=> 1,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
            array(
				'id'		=> 'shop_categories_layout',
				'type'		=> 'select',
				'title'		=> __( 'Layout', 'fugu-framework-admin' ),
                'options'	=> array( 'list_sep' => 'Divided list', 'list_nosep' => 'Undivided list', 'list-spaced' => 'Evenly spaced list (for Centered categories)' ),
				'default'	=> 'list_sep',
				'required'	=> array( 'shop_categories', '=', '1' )
			),
            array(
				'id'		=> 'shop_categories_thumbnails_layout',
				'type'		=> 'select',
				'title'		=> __( 'Layout - Thumbnails', 'fugu-framework-admin' ),
                'options'	=> array( 'thumbnails-top' => 'Above title', '' => 'Left aligned' ),
				'default'	=> 'thumbnails-top',
				'required'	=> array( 'shop_categories_layout', '=', 'list-spaced' )
			),
			array(
				'id'		=> 'shop_categories_top_level',
				'type'		=> 'select',
				//'title'		=> __( 'Display Type', 'fugu-framework-admin' ),
				//'options'	=> array( '1' => 'Show top-level categories', '0' => 'Hide top-level categories' ),
                'title'		=> __( 'Sub Categories', 'fugu-framework-admin' ),
                'options'	=> array( '1' => 'Display below main menu', '0' => 'Display as main menu' ),
				'default'	=> '1',
				'required'	=> array( 'shop_categories', '=', '1' )
			),
            array(
				'id'		=> 'shop_categories_all_link',
				'type'		=> 'switch',
				'title'		=> __( '"All" Link', 'fugu-framework-admin' ),
				'default'	=> 1,
				'on'		=> 'Enable',
				'off'		=> 'Disable',
                'required'	=> array( 'shop_categories', '=', '1' )
			),
            array(
				'id'	    => 'shop_categories_all_link_thumbnail',
				'type'	    => 'media', 
				'title'	    => __( '"All" Link - Thumbnail', 'fugu-framework-admin' ),
                'required'  => array( 'shop_categories_all_link', '=', '1' )
			),
			array(
				'id'		=> 'shop_categories_back_link',
				'type'		=> 'select',
				'title'		=> __( '"Back" Link', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Display "Back" link on sub-category menus.', 'fugu-framework-admin' ),
				'options'	=> array( '0' => 'Disable', '1st' => 'Enable', '2nd' => 'Enable from second sub-category level' ),
				'default'	=> '1st',
				'required'	=> array( 'shop_categories_top_level', '=', '0' )
			),
			array(
				'id'		=> 'shop_categories_hide_empty',
				'type'		=> 'switch',
				'title'		=> __( 'Hide Empty Categories', 'fugu-framework-admin' ),
				'default'	=> 1,
				'on'		=> 'Enable',
				'off'		=> 'Disable',
				'required'	=> array( 'shop_categories', '=', '1' )
			),
			array(
				'id'		=> 'shop_categories_orderby',
				'type'		=> 'select',
				'title'		=> __( 'Order By', 'fugu-framework-admin' ),
				'options'	=> array(
                    'id' => 'ID',
                    'name'          => 'Name/Menu-order',
                    'slug'          => 'Slug',
                    'count'         => 'Count',
                    'term_group'    => 'Term group'
                ),
				'default'	=> 'slug',
				'required'	=> array( 'shop_categories', '=', '1' )
			),
			array(
				'id'		=> 'shop_categories_order',
				'type'		=> 'select',
				'title'		=> __( 'Order', 'fugu-framework-admin' ),
				'options'	=> array( 'asc' => 'Ascending', 'desc' => 'Descending' ),
				'default'	=> 'asc',
				'required'	=> array( 'shop_categories', '=', '1' )
			),
			array (
				'id' 	=> 'shop_filters_info',
				'icon'	=> true,
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Filter Widgets', 'fugu-framework-admin' ) . '</h3>'
			),
            array(
				'id' 		=> 'shop_filters',
				'type' 		=> 'image_select',
				'title' 	=> __( 'Filters', 'fugu-framework-admin' ),
				'options'	=> array(
                    'disabled'  => array( 'title' => __( 'None', 'fugu-framework-admin' ), 'img' => FUGU_URI . '/assets/img/option-panel/filters-none.png' ),
                    'header'    => array( 'title' => __( 'Above Shop', 'fugu-framework-admin' ), 'img' => FUGU_URI . '/assets/img/option-panel/filters-above-shop.png' ),
					'default'   => array( 'title' => __( 'Sidebar', 'fugu-framework-admin' ), 'img' => FUGU_URI . '/assets/img/option-panel/filters-sidebar.png' ),
                    'popup'     => array( 'title' => __( 'Popup', 'fugu-framework-admin' ), 'img' => FUGU_URI . '/assets/img/option-panel/filters-popup.png' )
				),
				'default' 	=> 'disabled'
			),
            array(
				'id'		=> 'shop_filters_custom_controls',
				'type'		=> 'switch',
                'title'		=> __( 'Custom Controls', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Display color/image swatches for variable-product attributes.', 'fugu-framework-admin' ),
				'default'	=> 1,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
            array(
				'id'		=> 'shop_filters_sidebar_position',
				'type'		=> 'select',
				'title'		=> __( 'Sidebar Position', 'fugu-framework-admin' ),
				'options'	=> array( 'left' => 'Left', 'right' => 'Right' ),
				'default'	=> 'left',
				'required'	=> array( 'shop_filters', '=', 'default' )
			),
            array(
				'id'			=> 'shop_filters_columns',
				'type'			=> 'slider',
				'title'			=> __( 'Columns', 'fugu-framework-admin' ),
				'default'		=> 4,
				'min'			=> 1,
				'max'			=> 4,
				'step'			=> 1,
				'display_value'	=> 'text',
				'required'	=> array( 'shop_filters', '=', 'header' )
			),
            array(
				'id'		=> 'shop_filters_scrollbar',
				'type'		=> 'switch',
				'title'		=> __( 'Scrollbar', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Show scrollbar for filters with long content.', 'fugu-framework-admin' ),
				'default'	=> 0,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
			array(
				'id'			=> 'shop_filters_height',
				'type'			=> 'slider',
				'title'			=> __( 'Scrollbar - Filter Max. Height', 'fugu-framework-admin' ),
				'default'		=> 150,
				'min'			=> 80,
				'max'			=> 1000,
				'step'			=> 1,
				'display_value'	=> 'text',
				'required'		=> array( 'shop_filters_scrollbar', '!=', '0' )
			),
			array (
				'id' 	=> 'shop_search_info',
				'icon'	=> true,
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Search', 'fugu-framework-admin' ) . '</h3>',
			),
			array(
				'id'		=> 'shop_search',
				'type'		=> 'select',
				'title'		=> __( 'Search', 'fugu-framework-admin' ),
				'options'	=> array(
                    '0' => 'Disable',
                    'header'    => 'Display in Header',
                    'shop'      => 'Display above Shop'
                ),
				'default'	=> 'header'
			),
			/*array(
				'id'		=> 'shop_search_ajax',
				'type'		=> 'switch',
				'title'		=> __( 'AJAX', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Use AJAX for searching.', 'fugu-framework-admin' ),
				'default'	=> 1,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),*/
            /*array(
				'id'		=> 'shop_search_auto_close',
				'type'		=> 'switch',
				'title'		=> __( 'Auto Close', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Close search-field when performing a search.', 'fugu-framework-admin' ),
				'default'	=> 1,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),*/
			array(
				'id'			=> 'shop_search_min_char',
				'type'			=> 'slider',
				'title'			=> __( 'Minimum Characters', 'fugu-framework-admin' ),
				'subtitle'		=> __( 'Minimum number of characters required to search.', 'fugu-framework-admin' ),
				'default'		=> 2,
				'min'			=> 1,
				'max'			=> 10,
				'step'			=> 1,
				'display_value'	=> 'text'
			),
			array(
				'id'		=> 'shop_search_by_titles',
				'type'		=> 'switch',
				'title'		=> __( 'Titles Only', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Search by product titles only.', 'fugu-framework-admin' ),
				'default'	=> 0,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
            array (
				'id' 	=> 'shop_search_keywords_info',
				'icon'	=> true,
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Search - Keywords (header)', 'fugu-framework-admin' ) . '</h3>',
			),
            array (
				'id'		=> 'shop_search_keywords_title',
				'type'		=> 'text',
				'title'		=> __( 'Title', 'fugu-framework-admin' ),
                'default'	=> 'Suggested Searches',
                'validate'	=> 'html',
			),
            array (
				'id'            => 'shop_search_keywords',
				'type'		    => 'text',
				'title'         => __( 'Keywords', 'fugu-framework-admin' ),
                'default'	    => '',
                'description'   => __( 'Enter a comma separated list of search keywords' ),
                'validate'      => 'no_html',
			),
            array (
				'id' 	=> 'shop_search_suggestions_info',
				'icon'	=> true,
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Search - Suggestions (header)', 'fugu-framework-admin' ) . '</h3>',
			),
            array(
				'id'		=> 'shop_search_suggestions',
				'type'		=> 'switch',
				'title'		=> __( 'Suggestions', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Display search suggestions.', 'fugu-framework-admin' ),
                'default'	=> 0,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
            array(
				'id'			=> 'shop_search_suggestions_max_results',
				'type'			=> 'slider',
				'title'			=> __( 'Maximum Results', 'fugu-framework-admin' ),
				'default'		=> 6,
				'min'			=> 4,
				'max'			=> 12,
				'step'			=> 1,
				'display_value'	=> 'text'
			),
            /*array(
				'id'		=> 'shop_search_suggestions_cache',
				'type'		=> 'switch',
				'title'		=> __( 'Cache Results', 'fugu-framework-admin' ),
				'default'	=> 0,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
            array(
				'id'		=> 'shop_search_suggestions_cache_expiration',
				'type'		=> 'text',
				'title'		=> __( 'Cache Expiration', 'fugu-framework-admin' ),
                'subtitle'	=> __( 'Value is in Hours.', 'fugu-framework-admin' ),
				'default'	=> 12,
                'validate' => 'numeric',
                'required'	=> array( 'shop_search_suggestions_cache', '=', '1' )
			),*/
            array(
				'id'		=> 'shop_search_suggestions_instant',
				'type'		=> 'switch',
				'title'		=> __( 'Instant', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Display suggestions instantly from pre-cached data<br>(product titles are used to find matches).', 'fugu-framework-admin' ),
                'default'	=> 0,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
            array(
				'id'		=> 'shop_search_suggestions_instant_search_sku',
				'type'		=> 'switch',
				'title'		=> __( 'Instant - SKU', 'fugu-framework-admin' ),
                'subtitle'	=> __( 'Search products by SKU.', 'fugu-framework-admin' ),
				'description'	=> sprintf(
                    __( '%sNote: Make sure to Save/Update a product after enabling this setting.%s%sEnabling SKU searching for the standard search requires a plugin, we suggest using %sWooCommerce Search by SKU%s.', 'fugu-framework-admin' ),
                    '<strong>',
                    '</strong>',
                    '<br><br>',
                    '<a href="https://github.com/common-repository/woocommerce-search-by-sku" target="_blank">',
                    '</a>'
                ),
				'default'	=> 0,
				'on'		=> 'Enable',
				'off'		=> 'Disable',
                'required'	=> array( 'shop_search_suggestions_instant', '=', '1' )
			),
		)
	) );

	Redux::setSection( $opt_name, array(
		'title'		=> __( 'Single Product', 'fugu-framework-admin' ),
		'icon'		=> 'el-icon-shopping-cart',
		'fields'	=> array(
            array(
				'id' 		=> 'product_layout',
				'type' 		=> 'image_select',
				'title' 	=> __( 'Layout', 'fugu-framework-admin' ),
				'options'	=> array(
                    'default'                               => array( 'title' => 'Vertical Tumbnails', 'img' => FUGU_URI . '/assets/img/option-panel/product-layout-default.png' ),
					'default-thumbs-h'                      => array( 'title' => 'Horizontal Thumbnails', 'img' => FUGU_URI . '/assets/img/option-panel/product-layout-default-thumbs-h.png' ),
                    'scrolling scrolling-single'            => array( 'title' => 'Scrolling', 'img' => FUGU_URI . '/assets/img/option-panel/product-layout-scrolling.png' ),
                    'scrolling scrolling-grid'              => array( 'title' => 'Scrolling Grid', 'img' => FUGU_URI . '/assets/img/option-panel/product-layout-scrolling-grid.png' ),
                    'scrolling scrolling-variable-grid'     => array( 'title' => 'Scrolling Variable Grid', 'img' => FUGU_URI . '/assets/img/option-panel/product-layout-scrolling-variable-grid.png' ),
                    'scrolling scrolling-variable-grid-2'   => array( 'title' => 'Scrolling Variable Grid 2', 'img' => FUGU_URI . '/assets/img/option-panel/product-layout-scrolling-variable-grid-2.png' ),
                    'expanded'                              => array( 'title' => 'Expanded', 'img' => FUGU_URI . '/assets/img/option-panel/product-layout-expanded.png' )
				),
				'default' 	=> 'default'
			),
			array(
				'id'		=> 'product_navigation_same_term',
				'type'		=> 'switch',
				'title'		=> __( 'Navigation - Same Category', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Navigate within the current category.', 'fugu-framework-admin' ),
				'default'	=> 0,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
            array(
				'id'		=> 'product_redirect_scroll',
				'type'		=> 'switch',
				'title'		=> __( 'Redirect Scroll', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Scroll to shop after clicking a Breadcrumb, Category or Tag link.', 'fugu-framework-admin' ),
				'default'	=> 1,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
            array(
				'id'		=> 'single_product_sale_flash',
				'type'		=> 'select',
				'title'		=> __( 'Sale Label', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'On-sale label.', 'fugu-framework-admin' ),
				'options'	=> array(
                    '0'         => 'Disable',
                    'txt'       => 'Display sale Text',
                    'pct'       => 'Display sale Percentage',
                    'pct-ap'    => 'Display sale Percentage, after price'
                ),
				'default'	=> '0'
			),
            array (
				'id' 	=> 'product_image_info',
				'icon'	=> true,
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Gallery', 'fugu-framework-admin' ) . '</h3>',
			),
			array(
				'id'			=> 'product_image_column_size',
				'type'			=> 'slider',
				'title'			=> __( 'Column Size', 'fugu-framework-admin' ),
				'subtitle'		=> __( 'Select size-span of the gallery column.', 'fugu-framework-admin' ),
				'default'		=> 7,
				'min'			=> 3,
				'max'			=> 8,
				'step'			=> 1,
				'display_value' => 'text',
                'required'      => array( 'product_layout', '!=', 'expanded' )
			),
			array(
				'id'		=> 'product_image_zoom',
				'type'		=> 'switch',
				'title'		=> __( 'Lightbox', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Lightbox gallery for viewing full-size images.', 'fugu-framework-admin' ),
				'default'	=> 1,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
			array(
				'id'		=> 'product_image_hover_zoom',
				'type'		=> 'switch',
				'title'		=> __( 'Zoom', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Mouseover image to zoom and pan.', 'fugu-framework-admin' ),
				'default'	=> 0,
				'on'		=> 'Enable',
				'off'		=> 'Disable'//,
                //'required'	=> array( 'product_layout', '!=', 'scrolling' )
			),
            array(
				'id'			=> 'product_image_max_size',
				'type'			=> 'slider',
				'title'			=> __( 'Tablet/mobile Width', 'fugu-framework-admin' ),
				'subtitle'		=> __( 'Maximum gallery width on tablet/mobile.', 'fugu-framework-admin' ),
				'default'		=> 500,
				'min'			=> 100,
				'max'			=> 1220,
				'step'			=> 1,
				'display_value'	=> 'text'
			),
            array(
				'id'		=> 'product_thumbnails_slider',
				'type'		=> 'switch',
				'title'		=> __( 'Thumbnail Slider', 'fugu-framework-admin' ),
				'default'	=> 0,
				'on'		=> 'Enable',
				'off'		=> 'Disable',
                'required'	=> array( 'product_layout', '=', 'default' )
			),
            array(
				'id'		=> 'product_image_pagination',
				'type'		=> 'switch',
				'title'		=> __( 'Pagination - Tablet/mobile', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Display pagination on tablet/mobile.', 'fugu-framework-admin' ),
				'default'	=> 0,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
			array (
				'id' 	=> 'product_details_info',
				'icon'	=> true,
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Details', 'fugu-framework-admin' ) . '</h3>',
			),
            array(
				'id'		=> 'product_ajax_atc',
				'type'		=> 'switch',
				'title'		=> __( 'AJAX Add-to-Cart', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Enable AJAX for add-to-cart buttons.', 'fugu-framework-admin' ),
				'default'	=> 1,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
            array(
				'id'		=> 'qty_arrows',
				'type'		=> 'switch',
				'title'		=> __( 'Quantity Arrows', 'fugu-framework-admin' ),
				'default'	=> 1,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
            array(
				'id'		=> 'qty_arrows_grouped',
				'type'		=> 'switch',
				'title'		=> __( 'Quantity Arrows - Grouped', 'fugu-framework-admin' ),
				'default'	=> 1,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
            array(
				'id'		=> 'product_share_buttons',
				'type'		=> 'switch',
				'title'		=> __( 'Share Buttons', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Display social share buttons.', 'fugu-framework-admin' ),
				'default'	=> 1,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
            array (
				'id' 	=> 'product_details_variations_info',
				'icon'	=> true,
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Details - Variations', 'fugu-framework-admin' ) . '</h3>',
			),
            array(
				'id'		=> 'product_select_hide_labels',
				'type'		=> 'switch',
				'title'		=> __( 'Hide Labels', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Hide label/name for product variations.', 'fugu-framework-admin' ),
				'default'	=> 0,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
            array(
				'id'		=> 'product_custom_select',
				'type'		=> 'switch',
				'title'		=> __( 'Custom Dropdown', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Display custom dropdown menu for product variations.', 'fugu-framework-admin' ),
				'default'	=> 1,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
            array(
				'id'		=> 'product_custom_controls',
				'type'		=> 'switch',
				'title'		=> __( 'Custom Controls', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Display color/image swatches and size labels for variable-product attributes.', 'fugu-framework-admin' ),
				'default'	=> 0,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
            array(
				'id'			=> 'product_swatches_color_radius',
				'type'			=> 'slider',
				'title'			=> __( 'Color Swatches - Radius', 'fugu-framework-admin' ),
				'subtitle'		=> __( 'Set the radius/size of Color swatches.', 'fugu-framework-admin' ),
				'default'		=> 19,
				'min'			=> 1,
				'max'			=> 100,
				'step'			=> 1,
				'display_value'	=> 'text',
                'required'      => array( 'product_custom_controls', '=', '1' )
			),
            array(
				'id'		=> 'product_swatches_color_tooltip',
				'type'		=> 'switch',
				'title'		=> __( 'Color Swatches - Tooltip', 'fugu-framework-admin' ),
				'default'	=> 0,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
            array(
				'id'			=> 'product_swatches_image_radius',
				'type'			=> 'slider',
				'title'			=> __( 'Image Swatches - Radius', 'fugu-framework-admin' ),
				'subtitle'		=> __( 'Set the radius/size of Image swatches.', 'fugu-framework-admin' ),
				'default'		=> 19,
				'min'			=> 1,
				'max'			=> 100,
				'step'			=> 1,
				'display_value'	=> 'text',
                'required'      => array( 'product_custom_controls', '=', '1' )
			),
            array(
				'id'		=> 'product_swatches_image_tooltip',
				'type'		=> 'switch',
				'title'		=> __( 'Image Swatches - Tooltip', 'fugu-framework-admin' ),
				'default'	=> 0,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
            array (
				'id' 	=> 'product_tabs_info',
				'icon'	=> true,
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Tabs', 'fugu-framework-admin' ) . '</h3>',
			),
            array(
				'id'		=> 'product_tabs_layout',
				'type'		=> 'select',
				'title'		=> __( 'Layout', 'fugu-framework-admin' ),
				'options'	=> array( 'default' => 'Separate Column (Tabs)', 'summary' => 'Summary Column (Accordion)' ),
				'default'	=> 'default'
			),
			array(
				'id'		=> 'product_description_layout',
				'type'		=> 'select',
				'title'		=> __( 'Description Width', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Select product description width.', 'fugu-framework-admin' ),
				'options'	=> array( 'boxed' => 'Boxed', 'full' => 'Full width' ),
				'default'	=> 'boxed',
                'required'  => array( 'product_tabs_layout', '=', 'default' )
			),
            array (
				'id' 	=> 'product_meta_info',
				'icon'	=> true,
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Meta', 'fugu-framework-admin' ) . '</h3>',
			),
            array(
				'id'		=> 'product_meta_layout',
				'type'		=> 'select',
				'title'		=> __( 'Layout', 'fugu-framework-admin' ),
				'options'	=> array( 'default' => 'Separate Column', 'summary' => 'Summary Column' ),
				'default'	=> 'default'
			),
            array (
				'id' 	=> 'product_upsell_related_info',
				'icon'	=> true,
				'type'	=> 'info',
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Up-sells &amp; Related Products', 'fugu-framework-admin' ) . '</h3>',
			),
            array(
				'id'			=> 'product_upsell_related_columns',
				'type'			=> 'slider',
				'title'			=> __( 'Columns', 'fugu-framework-admin' ),
				'default'		=> 4,
				'min'			=> 1,
				'max'			=> 6,
				'step'			=> 1,
				'display_value'	=> 'text'
			),
            array(
				'id'			=> 'product_upsell_related_per_page',
				'type'			=> 'slider',
				'title'			=> __( 'Products per Page', 'fugu-framework-admin' ),
				'subtitle'		=> __( 'Select number of up-sell/related products to display.', 'fugu-framework-admin' ),
				'default'		=> 4,
				'min'			=> 1,
				'max'			=> 48,
				'step'			=> 1,
				'display_value'	=> 'text'
			)
		)
	) );
	
    Redux::setSection( $opt_name, array(
		'title'		=> __( 'My Account', 'fugu-framework-admin' ),
		'icon'		=> 'el el-user',
		'fields'	=> array(
			array(
                'id'		=> 'myaccount_profile_image',
                'type'		=> 'switch',
                'title'		=> __( 'Profile Image', 'fugu-framework-admin' ),
                'subtitle'	=> 'Display <a href="http://en.gravatar.com/" target="_blank">gravatar</a> profile image.',
                'default'	=> 1,
                'on'		=> 'Enable',
                'off'		=> 'Disable'
            ),
            array(
                'id' 		=> 'myaccount_dashboard_text',
				'type'		=> 'textarea',
				'title' 	=> __( 'Dashboard Text', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'HTML allowed.', 'fugu-framework-admin' ),
                'default'	=> '',
				'validate'	=> 'html'
			)
		)
	) );
    
    if ( defined( 'FUGU_WISHLIST_DIR' ) ) {
        Redux::setSection( $opt_name, array(
            'title'		=> __( 'Wishlist', 'fugu-framework-admin' ),
            'icon'		=> 'el-icon-heart',
            'fields'	=> array(
                array(
                    'id'	    => 'wishlist_page_id',
                    'type'	    => 'select',
                    'title'	    => __( 'Wishlist Page', 'fugu-framework-admin' ),
                    'data'	    => 'pages'
                ),
                array(
                    'id'		=> 'menu_wishlist',
                    'type'		=> 'switch', 
                    'title'		=> __( 'Header Link', 'fugu-framework-admin' ),
                    'subtitle'		=> __( 'Display link in header menu (make sure to select the Wishlist Page above as well).', 'fugu-framework-admin' ),
                    'default'	=> 1,
                    'on'		=> 'Enable',
                    'off'		=> 'Disable'
                ),
                array(
                    'id'		=> 'menu_wishlist_icon',
                    'type'		=> 'switch', 
                    'title'		=> __( 'Header Link - Icon', 'fugu-framework-admin' ),
                    'subtitle'	=> __( 'Display menu icon (instead of text).', 'fugu-framework-admin' ),
                    'default'	=> 1,
                    'on'		=> 'Enable',
                    'off'		=> 'Disable',
                    'required'	=> array( 'menu_wishlist', '=', '1' )
                ),
                array(
                    'id'		=> 'menu_wishlist_icon_html',
                    'type'		=> 'text',
                    'title'		=> __( 'Header Link - Icon HTML', 'fugu-framework-admin' ),
                    'subtitle'	=> __( 'Menu icon markup (must be valid HTML).', 'fugu-framework-admin' ),
                    'default'	=> '<i class="fugu-font fugu-font-heart-outline"></i>',
                    'validate'	=> 'html',
                    'required'	=> array( 'menu_wishlist_icon', '=', '1' )
                ),
                array(
                    'id'		=> 'menu_wishlist_count',
                    'type'		=> 'switch', 
                    'title'		=> __( 'Header Link - Count', 'fugu-framework-admin' ),
                    'subtitle'		=> __( 'Display current product-count after link.', 'fugu-framework-admin' ),
                    'default'	=> 0,
                    'on'		=> 'Enable',
                    'off'		=> 'Disable',
                    'required'	=> array( 'menu_wishlist', '=', '1' )
                ),
                array(
                    'id'		=> 'wishlist_require_login',
                    'type'		=> 'switch', 
                    'title'		=> __( 'Require Login', 'fugu-framework-admin' ),
                    'subtitle'		=> __( 'Require login to add products to Wishlist.', 'fugu-framework-admin' ),
                    'default'	=> 0,
                    'on'		=> 'Enable',
                    'off'		=> 'Disable'
                ),
                array(
                    'id'		=> 'wishlist_show_variations',
                    'type'		=> 'switch',
                    'title'		=> __( 'Display Variations', 'fugu-framework-admin' ),
                    'subtitle'	=> __( 'Display variations for products in the wishlist.', 'fugu-framework-admin' ),
                    'default'	=> 0,
                    'on'		=> 'Enable',
                    'off'		=> 'Disable'
                ),
                array(
                    'id'		=> 'wishlist_share',
                    'type'		=> 'switch',
                    'title'		=> __( 'Share Links', 'fugu-framework-admin' ),
                    'subtitle'	=> __( 'Display social share links.', 'fugu-framework-admin' ),
                    'default'	=> 0,
                    'on'		=> 'Enable',
                    'off'		=> 'Disable'
                ),
                array(
                    'id'		=> 'wishlist_share_title',
                    'type'		=> 'text',
                    'title'		=> __( 'Share Title', 'fugu-framework-admin' ),
                    'subtitle'	=> __( 'Enter a title for the social share links.', 'fugu-framework-admin' ),
                    'default'	=> 'My Wishlist',
                    'validate'	=> 'no_html',
                    'required'	=> array( 'wishlist_share', '=', '1' )
                ),
                array(
                    'id'		=> 'wishlist_share_text',
                    'type'		=> 'textarea',
                    'title'		=> __( 'Share Text', 'fugu-framework-admin' ),
                    'subtitle'	=> __( 'Enter a description for the social share links.', 'fugu-framework-admin' ),
                    'description' => __( 'Enter <strong>%wishlist_url%</strong> to display the Wishlist URL.', 'fugu-framework-admin' ),    
                    'rows'      => 4,
                    'validate'	=> 'no_html',
                    'required'	=> array( 'wishlist_share', '=', '1' )
                ),
                array(
                    'id'		=> 'wishlist_share_image_url',
                    'type'		=> 'text',
                    'title'		=> __( 'Share Image URL', 'fugu-framework-admin' ),
                    'subtitle'	=> __( 'Enter a image-URL for the social share links.', 'fugu-framework-admin' ),
                    'validate'	=> 'url',
                    'required'	=> array( 'wishlist_share', '=', '1' )
                )
            )
        ) );
    }
    
    Redux::setSection( $opt_name, array(
		'title'		=> __( 'Blog', 'fugu-framework-admin' ),
		'icon'		=> 'el el-wordpress',
		'fields'	=> array(
			array(
				'id'		=> 'blog_static_page',
				'type'		=> 'switch', 
				'title'		=> __( 'Static Content', 'fugu-framework-admin' ),
				'default'	=> 0,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
			array(
				'id'		=> 'blog_static_page_id',
				'type'		=> 'select',
				'title'		=> __( 'Static Content - Page', 'fugu-framework-admin' ),
				'subtitle'	=> __( "Select a page to display on the blog's index page.", 'fugu-framework-admin' ),
				'data'		=> 'pages',
				'required'	=> array( 'blog_static_page', '=', '1' )
			),
			array (
				'id'	=> 'blog_categories_info',
				'type'	=> 'info',
				'icon'	=> true,
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Categories Menu', 'fugu-framework-admin' ) . '</h3>',
			),
            array(
				'id'		=> 'blog_categories',
				'type'		=> 'switch', 
				'title'		=> __( 'Menu', 'fugu-framework-admin' ),
				'default'	=> 1,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
            array(
				'id'		=> 'blog_categories_hide_empty',
				'type'		=> 'switch',
				'title'		=> __( 'Hide Empty Categories', 'fugu-framework-admin' ),
				'default'	=> 0,
				'on'		=> 'Enable',
				'off'		=> 'Disable',
				'required'	=> array( 'blog_categories', '=', '1' )
			),
			array(
				'id'		=> 'blog_categories_layout',
				'type'		=> 'select',
				'title'		=> __( 'Layout', 'fugu-framework-admin' ),
				'options'	=> array( 'list' => 'Separated list', 'list_nosep' => 'List', 'columns' => 'Columns' ),
				'default'	=> 'list',
                'required'	=> array( 'blog_categories', '=', '1' )
			),
			array(
				'id'			=> 'blog_categories_columns',
				'type'			=> 'slider',
				'title'			=> __( 'Columns', 'fugu-framework-admin' ),
				'default'		=> 4,
				'min'			=> 2,
				'max'			=> 5,
				'step'			=> 1,
				'display_value'	=> 'text',
				'required'	=> array( 'blog_categories_layout', '=', 'columns' )
			),
			array(
				'id'		=> 'blog_categories_toggle',
				'type'		=> 'switch', 
				'title'		=> __( 'Toggle', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Display a link to toggle categories on tablet/mobile.', 'fugu-framework-admin' ),
				'default'	=> 0,
				'on'		=> 'Enable',
				'off'		=> 'Disable',
                'required'	=> array( 'blog_categories', '=', '1' )
			),
			array(
				'id'		=> 'blog_categories_orderby',
				'type'		=> 'select',
				'title'		=> __( 'Order By', 'fugu-framework-admin' ),
				'options'	=> array( 'id' => 'ID', 'name' => 'Name', 'slug' => 'Slug', 'count' => 'Count', 'term_group' => 'Term Group' ),
				'default'	=> 'name',
                'required'	=> array( 'blog_categories', '=', '1' )
			),
			array(
				'id'		=> 'blog_categories_order',
				'type'		=> 'select',
				'title'		=> __( 'Order', 'fugu-framework-admin' ),
				'options'	=> array( 'asc' => 'Ascending', 'desc' => 'Descending' ),
				'default'	=> 'asc',
                'required'	=> array( 'blog_categories', '=', '1' )
			),
			array (
				'id'	=> 'blog_archive_info',
				'type'	=> 'info',
				'icon'	=> true,
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Archive/Listing', 'fugu-framework-admin' ) . '</h3>',
			),
            array(
				'id' 		=> 'blog_layout',
				'type' 		=> 'image_select',
				'title' 	=> __( 'Layout', 'fugu-framework-admin' ),
				'options'	=> array(
                    'grid'      => array( 'alt' => 'Grid', 'img' => FUGU_URI . '/assets/img/option-panel/blog-layout-grid.png' ),
                    'classic'   => array( 'alt' => 'Classic', 'img' => FUGU_URI . '/assets/img/option-panel/blog-layout-classic.png' ),
                    'list'      => array( 'alt' => 'List', 'img' => FUGU_URI . '/assets/img/option-panel/blog-layout-list.png' )
				),
				'default' 	=> 'grid'
			),
			array(
				'id'			=> 'blog_grid_columns',
				'type'			=> 'slider',
				'title'			=> __( 'Grid - Columns', 'fugu-framework-admin' ),
				'default'		=> 3,
				'min'			=> 2,
				'max'			=> 5,
				'step'			=> 1,
				'display_value'	=> 'text',
				'required'	=> array( 'blog_layout', '=', 'grid' )
			),
            array(
				'id'		=> 'blog_grid_masonry',
				'type'		=> 'switch', 
				'title'		=> __( 'Grid - Masonry Layout', 'fugu-framework-admin' ),
				'default'	=> 1,
				'on'		=> 'Enable',
				'off'		=> 'Disable',
                'required'	=> array( 'blog_layout', '=', 'grid' )
			),
            array(
				'id'		=> 'blog_sidebar',
				'type'		=> 'select',
				'title'		=> __( 'Sidebar', 'fugu-framework-admin' ),
				'options'	=> array( 'none' => 'No sidebar', 'left' => 'Sidebar Left', 'right' => 'Sidebar Right' ),
				'default'	=> 'none',
			),
            array(
				'id'		=> 'blog_show_full_posts',
				'type'		=> 'switch', 
				'title'		=> __( 'Show Full Posts', 'fugu-framework-admin' ),
				'default'	=> 0,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
            array(
				'id'		=> 'blog_infinite_load',
				'type'		=> 'select',
				'title'		=> __( 'Infinite Load', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Configure "infinite" product loading.', 'fugu-framework-admin' ),
				'options'	=> array( '0' => 'Disable', 'button' => 'Button', 'scroll' => 'Scroll' ),
				'default'	=> '0'
			),
			array (
				'id'	=> 'blog_single_post_info',
				'type'	=> 'info',
				'icon'	=> true,
				'raw'	=> '<h3 style="margin: 0;">' . __( 'Single Post', 'fugu-framework-admin' ) . '</h3>',
			),
			array(
				'id'		=> 'single_post_sidebar',
				'type'		=> 'select',
				'title'		=> __( 'Layout', 'fugu-framework-admin' ),
				'options'	=> array( 'none' => 'No sidebar', 'left' => 'Sidebar Left', 'right' => 'Sidebar Right' ),
				'default'	=> 'none'
			),
            array(
				'id'		=> 'single_post_display_featured_image',
				'type'		=> 'switch', 
				'title'		=> __( 'Featured Image', 'fugu-framework-admin' ),
				'subtitle'	=> __( 'Display featured image above post.', 'fugu-framework-admin' ),
				'default'	=> 0,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
            array(
				'id'		=> 'single_post_featured_image_aspect_ratio',
				'type'		=> 'select',
				'title'		=> __( 'Featured Image - Aspect Ratio', 'fugu-framework-admin' ),
				'options'	=> array(
                    'aspect-ratio-original'   => 'Original',
                    'aspect-ratio ratio-1-1'  => '1:1',
                    'aspect-ratio ratio-3-2'  => '3:2',
                    'aspect-ratio ratio-4-3'  => '4:3',
                    'aspect-ratio ratio-16-9' => '16:9'
                ),
				'default'	=> 'aspect-ratio-original',
                'required'	=> array( 'single_post_display_featured_image', '=', 1 )
			),
            array(
				'id'		=> 'single_post_related',
				'type'		=> 'switch', 
				'title'		=> __( 'Related Posts', 'fugu-framework-admin' ),
				'default'	=> 0,
				'on'		=> 'Enable',
				'off'		=> 'Disable'
			),
            array(
				'id'			=> 'single_post_related_per_page',
				'type'			=> 'slider',
				'title'			=> __( 'Related Posts - Posts per Page', 'fugu-framework-admin' ),
				'subtitle'		=> __( 'Number of related posts to display.', 'fugu-framework-admin' ),
				'default'		=> 4,
				'min'			=> 1,
				'max'			=> 48,
				'step'			=> 1,
				'display_value'	=> 'text',
                'required'	=> array( 'single_post_related', '=', '1' )
			),
            array(
				'id'			=> 'single_post_related_columns',
				'type'			=> 'slider',
				'title'			=> __( 'Related Posts - Columns', 'fugu-framework-admin' ),
				'default'		=> 4,
				'min'			=> 1,
				'max'			=> 6,
				//'step'			=> 2,
				'display_value'	=> 'text',
                'required'	=> array( 'single_post_related', '=', '1' )
			)
		)
	) );
    
    if ( class_exists( 'FUGU_Portfolio' ) ) {
        Redux::setSection( $opt_name, array(
            'title'		=> __( 'Portfolio', 'fugu-framework-admin' ),
            'icon'		=> 'el el-brush',
            'fields'	=> array(
                array(
                    'id'		=> 'portfolio_gutenberg',
                    'type'		=> 'switch',
                    'title'		=> __( 'Gutenberg Editor', 'fugu-framework-admin' ),
                    'subtitle'	=> __( 'Enable Gutenberg editor for Portfolio pages.', 'fugu-framework-admin' ),
                    'default'	=> 0,
                    'on'		=> 'Enable',
                    'off'		=> 'Disable'
                ),
                array (
                    'id' 	=> 'portfolio_gallery_info',
                    'icon'	=> true,
                    'type'	=> 'info',
                    'raw'	=> '<h3 style="margin: 0;">' . __( 'Archive/Gallery', 'fugu-framework-admin' ) . '</h3>',
                ),
                array(
                    'id'	    => 'portfolio_layout',
                    'type'	    => 'select',
                    'title'	    => __( 'Layout', 'fugu-framework-admin' ),
                    'options'   => array( 
                        'standard'  => 'Standard',
                        'overlay'   => 'Overlay'
                    ),
                    'default'   => 'overlay'
                ),
                array(
                    'id'        => 'portfolio_page_layout',
                    'type'      => 'select',
                    'title'     => __( 'Page Width', 'fugu-framework-admin' ),
                    'options'	=> array( 
                        'full'          => 'Full',
                        'full-nopad'    => 'Full (no padding)',
                        'boxed'         => 'Boxed'
                    ),
                    'default'   => 'boxed'
                ),
                array(
                    'id'		=> 'portfolio_packery',
                    'type'		=> 'switch',
                    'title'		=> __( 'Masonry Grid', 'fugu-framework-admin' ),
                    'subtitle'	=> __( 'Enable "masonry" grid layout.', 'fugu-framework-admin' ),
                    'default'	=> 1,
                    'on'		=> 'Enable',
                    'off'		=> 'Disable'
                ),
                array(
                    'id'		=> 'portfolio_items',
                    'type' 		=> 'text',
                    'title' 	=> __( 'Items', 'fugu-framework-admin' ),
                    'subtitle'	=> __( 'Number of items to display (leave blank for unlimited).', 'fugu-framework-admin' ),
                    'validate'	=> 'numeric',
                    'default'	=> ''
                ),
                array(
                    'id'        => 'portfolio_columns',
                    'type'      => 'select',
                    'title'     => __( 'Items per Row', 'fugu-framework-admin' ),
                    'options'	=> array( 
                        '1' => '1',
                        '2' => '2',
                        '3'	=> '3',
                        '4'	=> '4'
                    ),
                    'default'   => '2'
                ),
                array(
                    'id'        => 'portfolio_order_by',
                    'type'      => 'select',
                    'title'     => __( 'Order By', 'fugu-framework-admin' ),
                    'options'	=> array( 
                        'date'  => 'Date',
                        'title' => 'Title',
                        'rand'  => 'Random'
                    ),
                    'default'   => 'date'
                ),
                array(
                    'id'	    => 'portfolio_order',
                    'type'	    => 'select',
                    'title'	    => __( 'Order', 'fugu-framework-admin' ),
                    'options'   => array(
                        'desc'  => 'Descending',
                        'asc'   => 'Ascending'
                    ),
                    'default'   => 'desc'
                ),
                array (
                    'id' 	=> 'portfolio_categories_info',
                    'icon'	=> true,
                    'type'	=> 'info',
                    'raw'	=> '<h3 style="margin: 0;">' . __( 'Categories Filter', 'fugu-framework-admin' ) . '</h3>',
                ),
                array(
                    'id'		=> 'portfolio_categories',
                    'type'		=> 'switch',
                    'title'		=> __( 'Filter', 'fugu-framework-admin' ),
                    'default'	=> 1,
                    'on'		=> 'Enable',
                    'off'		=> 'Disable'
                ),
                array(
                    'id'        => 'portfolio_categories_alignment',
                    'type'      => 'select',
                    'title'     => __( 'Alignment', 'fugu-framework-admin' ),
                    'options'	=> array( 
                        'left'      => 'Left',
                        'center'    => 'Center',
				        'right'     => 'Right'
                    ),
                    'default'	=> 'left',
                    'required'	=> array( 'portfolio_categories', '=', '1' )
                ),
                array(
                    'id'		=> 'portfolio_categories_js',
                    'type'		=> 'switch',
                    'title'		=> __( 'Animated Sorting', 'fugu-framework-admin' ),
                    'default'	=> 1,
                    'on'		=> 'Enable',
                    'off'		=> 'Disable',
                    'required'	=> array( 'portfolio_categories', '=', '1' )
                ),
                array (
                    'id' 	=> 'portfolio_archive_info',
                    'icon'	=> true,
                    'type'	=> 'info',
                    'raw'	=> '<h3 style="margin: 0;">' . __( 'Archive & Permalinks', 'fugu-framework-admin' ) . '</h3>',
                ),
                array(
                    'id'		=> 'portfolio_archive',
                    'type'		=> 'switch',
                    'title'		=> __( 'Archive', 'fugu-framework-admin' ),
                    'subtitle'	=> __( 'Can be disabled if Portfolio is added via page builder.', 'fugu-framework-admin' ),
                    'description'	=> sprintf(
                        __( '%sNote: Re-save the "Settings > Permalinks" page after changing.%s' ),
                        '<strong>',
                        '</strong>'
                    ),
                    'default'	=> 1,
                    'on'		=> 'Enable',
                    'off'		=> 'Disable',
                    //'flush_permalinks' => true // NM: Doesn't seem to work: https://docs.reduxframework.com/core/the-basics/validation/
                ),
                array(
                    'id'		=> 'portfolio_permalink',
                    'type'		=> 'text',
                    'title'		=> __( 'Archive - Permalink', 'fugu-framework-admin' ),
                    'subtitle'	=> __( 'Enter base parmalink name for the portfolio.', 'fugu-framework-admin' ),
                    'description'	=> sprintf(
                        __( '%sNote: Re-save the "Settings > Permalinks" page after changing.%s' ),
                        '<strong>',
                        '</strong>'
                    ),
                    'default'	=> 'portfolio',
                    'validate'	=> apply_filters( 'fugu_portfolio_permalink_option_validate', '' ), // Use 'unique_slug' to make sure the slug is unique
                    //'flush_permalinks' => true // NM: Doesn't seem to work: https://docs.reduxframework.com/core/the-basics/validation/
                ),
                array(
                    'id'		=> 'portfolio_category_permalink',
                    'type'		=> 'text',
                    'title'		=> __( 'Archive - Category Permalink', 'fugu-framework-admin' ),
                    'subtitle'	=> __( 'Enter base parmalink name for portfolio-categories.', 'fugu-framework-admin' ),
                    'description'	=> sprintf(
                        __( '%sNote: Re-save the "Settings > Permalinks" page after changing.%s' ),
                        '<strong>',
                        '</strong>'
                    ),
                    'default'	=> 'portfolio_category',
                    'validate'	=> apply_filters( 'fugu_portfolio_permalink_option_validate', '' ), // Use 'unique_slug' to make sure the slug is unique
                    //'flush_permalinks' => true // NM: Doesn't seem to work: https://docs.reduxframework.com/core/the-basics/validation/
                )
            )
        ) );
    }
    
	Redux::setSection( $opt_name, array(
        'title'		=> __( 'Social Profiles', 'fugu-framework-admin' ),
		'icon'		=> 'el-icon-share-alt',
        'fields'    => array(
            array(
                'id'        => 'social_profiles',
                'type'      => 'sortable',
                'title'     => __( 'Enter your social profile URLs', 'fugu-framework-admin' ),
                //'label'     => true,
                'subtitle'     => __( 'Drag and drop to change the order of your social profiles.', 'fugu-framework-admin' ),
                'mode'      => 'text',
                'options'   => array(
                    'facebook'              => 'Facebook profile URL',
                    'instagram'             => 'Instagram profile URL',
                    'twitter'               => 'X/Twitter profile URL',
                    'flickr'                => 'Flickr profile URL',
                    'linkedin'              => 'LinkedIn profile URL',
                    'pinterest'             => 'Pinterest profile URL',
                    'rss'                   => 'RSS feed URL',
                    'snapchat'              => 'Snapchat profile URL',
                    'behance'               => 'Behance profile URL',
                    'bluesky'               => 'Bluesky profile URL',
                    'discord'               => 'Discord profile URL',
                    'dribbble'              => 'Dribbble profile URL',
                    'ebay'                  => 'eBay profile URL',
                    'etsy'                  => 'Etsy profile URL',
                    'line'                  => 'LINE chat URL',
                    'mastodon'              => 'Mastodon URL',
                    'messenger'             => 'Messenger URL',
                    'mixcloud'              => 'MixCloud profile URL',
                    'odnoklassniki'         => 'OK.RU profile URL',
                    'reddit'                => 'Reddit profile URL',
                    'soundcloud'            => 'SoundCloud profile URL',
                    'spotify'               => 'Spotify profile URL',
                    'strava'                => 'Strava profile URL',
                    'telegram'              => 'Telegram URL',
                    'threads'               => 'Threads profile URL',
                    'tiktok'                => 'TikTok URL',
                    'tumblr'                => 'Tumblr profile URL',
                    'twitch'                => 'Twitch profile URL',
                    'viber'                 => 'Viber URL',
                    'vimeo'                 => 'Vimeo profile URL',
                    'vk'                    => 'VK profile URL',
                    'weibo'                 => 'Weibo profile URL',
                    'whatsapp'              => 'WhatsApp profile URL',
                    'youtube'               => 'YouTube profile URL',
                    'email'                 => 'Email address'
                )
            )
        )
	) );
    
    if ( ! is_customize_preview() && class_exists( 'WPBakeryVisualComposerAbstract' ) ) {
        Redux::setSection( $opt_name, array(
            'title'		=> __( 'WPBakery', 'fugu-framework-admin' ),
            'icon'		=> 'el-icon-website',
            'fields'	=> array(
                array(
                    'id' 		=> 'vcomp_enable_frontend',
                    'type' 		=> 'switch', 
                    'title' 	=> __( 'Frontend Editor', 'fugu-framework-admin' ),
                    'default'	=> 0,
                    'on' 		=> 'Enable',
                    'off' 		=> 'Disable'
                ),
                array(
                    'id' 		=> 'vcomp_stock',
                    'type' 		=> 'switch', 
                    'title' 	=> __( 'Default Elements', 'fugu-framework-admin' ),
                    'default'	=> 0,
                    'on' 		=> 'Enable',
                    'off' 		=> 'Disable'
                )
            )
        ) );
    }
    
    /*
     * <--- END SECTIONS
     */
	