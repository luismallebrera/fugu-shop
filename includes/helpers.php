<?php
	
	/* Helper Functions
	=============================================================== */
	
	global $fugu_woocommerce_enabled;
	$fugu_woocommerce_enabled = ( class_exists( 'woocommerce' ) ) ? true : false;
	
	
	/* Check if WooCommerce is activated */
	function fugu_woocommerce_activated() {
		global $fugu_woocommerce_enabled;
		return $fugu_woocommerce_enabled;
	}
	
	
	/* Check if current request is made via AJAX */
	function fugu_is_ajax_request() {
		if ( ! empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) == 'xmlhttprequest' ) {
			return true;
		}
			
		return false;
	}
	
	
	/* Check if the current page is a WooCommmerce page */
	function fugu_is_woocommerce_page() {
        $is_woocommerce_page = false;
        
        if ( fugu_woocommerce_activated() ) {
            if ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() ) {
                $is_woocommerce_page = true;
            }
        }
        
        $is_woocommerce_page = apply_filters( 'fugu_is_woocommerce_page', $is_woocommerce_page );
        
		return $is_woocommerce_page;
	}
	
	
	/* Add page include slug */
	function fugu_add_page_include( $slug ) {
		global $fugu_page_includes;
		$fugu_page_includes[$slug] = true;
	}
	
	
	/* Get post categories */
	function fugu_get_post_categories() {
		$args = array(
			'type'			=> 'post',
			'child_of'		=> 0,
			'parent'		=> '',
			'orderby'		=> 'name',
			'order'			=> 'ASC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 1,
			'exclude'		=> '',
			'include'		=> '',
			'number'		=> '',
			'taxonomy'		=> 'category',
			'pad_counts'	=> false
		);
		
		$categories = get_categories( $args );
		
		$return = array( 'All' => '' );
		
		foreach( $categories as $category ) {
            $return[wp_specialchars_decode( $category->name )] = $category->slug;
		}
		
		return $return;
	};
	
    
    /* Get X/Twitter data */
	function fugu_get_x_twitter_data() {
        $data = apply_filters( 'fugu_x_twitter_data', array(
            'title'         => 'X / Twitter',
            'share_title'   => __( 'Share on Twitter', 'fugu-framework' ),
            'icon_class'    => 'fugu-font-x-twitter',
        ) );
        return $data;
    }
	
    
	/* Get social media profiles list */
	if ( ! function_exists( 'fugu_get_social_profiles' ) ) {
		function fugu_get_social_profiles( $wrapper_class = 'fugu-social-profiles-list', $return_meta = false ) {
			global $fugu_theme_options;
			
            $x_twitter_data = fugu_get_x_twitter_data();
            
            $social_profiles_meta = array(
				'facebook'		=> array( 'title' => 'Facebook', 'icon' => 'fugu-font fugu-font-facebook' ),
				'instagram'		=> array( 'title' => 'Instagram', 'icon' => 'fugu-font fugu-font-instagram-filled' ),
				'twitter'		=> array( 'title' => $x_twitter_data['title'], 'icon' => 'fugu-font ' . $x_twitter_data['icon_class'] ),
                'flickr'		=> array( 'title' => 'Flickr', 'icon' => 'fugu-font fugu-font-flickr' ),
				'linkedin'		=> array( 'title' => 'LinkedIn', 'icon' => 'fugu-font fugu-font-linkedin' ),
				'pinterest'		=> array( 'title' => 'Pinterest', 'icon' => 'fugu-font fugu-font-pinterest' ),
                'rss'	        => array( 'title' => 'RSS', 'icon' => 'fugu-font fugu-font-rss-square' ),
                'snapchat'      => array( 'title' => 'Snapchat', 'icon' => 'fugu-font fugu-font-snapchat-ghost' ),
                'behance'		=> array( 'title' => 'Behance', 'icon' => 'fugu-font fugu-font-behance' ),
                'bluesky'		=> array( 'title' => 'Bluesky', 'icon' => 'fugu-font fugu-font-bluesky' ),
                'discord'		=> array( 'title' => 'Discord', 'icon' => 'fugu-font fugu-font-discord' ),
                'dribbble'		=> array( 'title' => 'Dribbble', 'icon' => 'fugu-font fugu-font-dribbble' ),
                'ebay'		    => array( 'title' => 'eBay', 'icon' => 'fugu-font fugu-font-ebay' ),
                'etsy'		    => array( 'title' => 'Etsy', 'icon' => 'fugu-font fugu-font-etsy' ),
				'line'          => array( 'title' => 'LINE', 'icon' => 'fugu-font fugu-font-line-app' ),
                'mastodon'      => array( 'title' => 'Mastodon', 'icon' => 'fugu-font fugu-font-mastodon' ),
                'messenger'     => array( 'title' => 'Messenger', 'icon' => 'fugu-font fugu-font-facebook-messenger' ),
                'mixcloud'      => array( 'title' => 'MixCloud', 'icon' => 'fugu-font fugu-font-mixcloud' ),
                'odnoklassniki' => array( 'title' => 'OK.RU', 'icon' => 'fugu-font fugu-font-odnoklassniki' ),
                'reddit'        => array( 'title' => 'Reddit', 'icon' => 'fugu-font fugu-font-reddit' ),
                'soundcloud'    => array( 'title' => 'SoundCloud', 'icon' => 'fugu-font fugu-font-soundcloud' ),
                'spotify'       => array( 'title' => 'Spotify', 'icon' => 'fugu-font fugu-font-spotify' ),
                'strava'        => array( 'title' => 'Strava', 'icon' => 'fugu-font fugu-font-strava' ),
                'telegram'	    => array( 'title' => 'Telegram', 'icon' => 'fugu-font fugu-font-telegram' ),
                'threads'	    => array( 'title' => 'Threads', 'icon' => 'fugu-font fugu-font-threads' ),
                'tiktok'	    => array( 'title' => 'TikTok', 'icon' => 'fugu-font fugu-font-tiktok' ),
                'tumblr'	    => array( 'title' => 'Tumblr', 'icon' => 'fugu-font fugu-font-tumblr' ),
                'twitch'	    => array( 'title' => 'Twitch', 'icon' => 'fugu-font fugu-font-twitch' ),
				'viber'	        => array( 'title' => 'Viber', 'icon' => 'fugu-font fugu-font-viber' ),
                'vimeo'	        => array( 'title' => 'Vimeo', 'icon' => 'fugu-font fugu-font-vimeo-square' ),
				'vk'			=> array( 'title' => 'VK', 'icon' => 'fugu-font fugu-font-vk' ),
				'weibo'			=> array( 'title' => 'Weibo', 'icon' => 'fugu-font fugu-font-weibo' ),
                'whatsapp'		=> array( 'title' => 'WhatsApp', 'icon' => 'fugu-font fugu-font-whatsapp' ),
				'youtube'		=> array( 'title' => 'YouTube', 'icon' => 'fugu-font fugu-font-youtube' ),
                'email'			=> array( 'title' => 'Email', 'icon' => 'fugu-font fugu-font-envelope' )
			);
            
            // Return meta array?
            if ( $return_meta ) {
                return apply_filters( 'fugu_social_profiles_meta', $social_profiles_meta );
            }
            
            $social_profiles = array();
            foreach( $fugu_theme_options['social_profiles'] as $slug => $url ) {
                // Make sure URL is valid (the Redux framework will enter setting placeholder text as URL when settings panel/section is reset)
                if ( $url !== '' && filter_var( $url, FILTER_VALIDATE_URL ) !== false ) {
                    if ( $slug == 'email' ) {
                        $url = 'mailto:' . $url;
                    }
                    $social_profiles[$slug] = array( 'title' => $social_profiles_meta[$slug]['title'], 'url' => $url, 'icon' => $social_profiles_meta[$slug]['icon'] );
                }
            }
            $social_profiles = apply_filters( 'fugu_social_profiles', $social_profiles );
            
            $rel_attribute = apply_filters( 'fugu_social_profiles_nofollow_attr', 'rel="nofollow"' );
            
            $output = '';
			foreach ( $social_profiles as $slug => $data ) {
                $output .= '<li><a href="' . esc_url( $data['url'] ) . '" target="_blank" title="' . esc_attr( $data['title'] ) . '" ' . $rel_attribute . '><i class="' . esc_attr( $data['icon'] ) . '"></i></a></li>';
            }
			
			return '<ul class="' . $wrapper_class . '">' . $output . '</ul>';
		}
	}
	