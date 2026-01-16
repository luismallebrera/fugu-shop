<?php

/*
 *	NM: Custom code
 */

class FUGU_Custom_Code {
	
    /* Init */
	function init() {
        // Include custom styles
        add_action( 'fugu_custom_styles', array( $this, 'include_custom_styles' ) );

        // Include custom scripts
        $custom_js_action_priority = apply_filters( 'fugu_custom_js_action_priority', 100 );
        add_action( 'wp_enqueue_scripts', array( $this, 'include_custom_scripts' ), $custom_js_action_priority );
    }
    
    
    /* Include custom styles */
    function include_custom_styles() {
        global $fugu_theme_options;
        
        if ( $fugu_theme_options && isset( $fugu_theme_options['custom_css'] ) ) {
            echo $fugu_theme_options['custom_css'];
        }
    }
    
    
    /* Include custom scripts */
    function include_custom_scripts() {
        global $fugu_theme_options;

        // Custom JavaScript
        if ( $fugu_theme_options && isset( $fugu_theme_options['custom_js'] ) && ! empty( $fugu_theme_options['custom_js'] ) ) {
            $custom_js_deps = apply_filters( 'fugu_custom_js_deps', array( 'fugu-core' ) );
            // Add with "dummy" handle: https://wordpress.stackexchange.com/a/311279/2807
            wp_register_script( 'fugu-custom-js', '', $custom_js_deps, '', true );
            wp_enqueue_script( 'fugu-custom-js' );
            wp_add_inline_script( 'fugu-custom-js', $fugu_theme_options['custom_js'] );
        }
    }
    
    
    /* 
     * Add settings section
     *
     * Note: method called from "../functions.php"
     */
    public static function add_settings_section() {
        if ( class_exists( 'Redux' ) && ! is_customize_preview() ) {
            $opt_name = 'fugu_theme_options';
            
            Redux::setSection( $opt_name, array(
                'title'		=> __( 'Custom Code', 'fugu-framework-admin' ),
                'icon'		=> 'el-icon-lines',
                'fields'	=> array(
                    array(
                        'id'		=> 'custom_css',
                        'type'		=> 'ace_editor',
                        'title'		=> __( 'CSS', 'fugu-framework-admin' ),
                        'description' => __( "Add custom CSS to the head/top of the site.", 'fugu-framework-admin' ),
                        'mode'		=> 'css',
                        'theme'		=> 'chrome',
                        'default'	=> ''
                    ),
                    array(
                        'id'		=> 'custom_js',
                        'type'		=> 'ace_editor',
                        'title'		=> __( 'JavaScript', 'fugu-framework-admin' ),
                        'description' => __( "Add custom JavaScript to the footer/bottom of the site.", 'fugu-framework-admin' ),
                        'mode'		=> 'javascript',
                        'theme'		=> 'chrome',
                        'default'	=> ''
                    )
                )
            ) );
        }
    }
	
}

$FUGU_Custom_Code = new FUGU_Custom_Code();
$FUGU_Custom_Code->init();
