<?php

    // Register our social media controls
    add_action( 'customize_register', 'skyrocket_register_social_controls' );

    /**
	 * Create our social media controls
	 */
	function skyrocket_register_social_controls( $wp_customize ) {

        // Get our Customizer defaults
		$defaults = skyrocket_generate_defaults();

        /**
		 * Add our Social Icons Section
		 */
		$wp_customize->add_section( 'social_icons_section',
            array(
                'title' => 'Social Icons',
                //'capability' => 'edit_theme_options',
                'description' => esc_html__( 'Add your social media links and we\'ll automatically match them with the appropriate icons. Drag and drop the URLs to rearrange their order.', 'skyrocket' ),
                'priority' => 187,
            )
        );

		// Add our Checkbox switch setting and control for opening URLs in a new tab
		$wp_customize->add_setting( 'social_newtab',
			array(
				'default'           => $defaults['social_newtab'],
                'transport'         => 'postMessage',
                'type'              => 'option',
				'sanitize_callback' => 'skyrocket_switch_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Toggle_Switch_Custom_control( $wp_customize, 'social_newtab',
			array(
				'label' => __( 'Open in new browser tab', 'skyrocket' ),
				'section' => 'social_icons_section'
			)
		) );
		$wp_customize->selective_refresh->add_partial( 'social_newtab',
			array(
				'selector' => '.social',
				'container_inclusive' => false,
				'render_callback' => function() {
					echo skyrocket_get_social_media();
				},
				'fallback_refresh' => true
			)
		);

		// Add our Text Radio Button setting and Custom Control for controlling alignment of icons
		$wp_customize->add_setting( 'social_alignment',
			array(
				'default'           => $defaults['social_alignment'],
                'transport'         => 'postMessage',
                'type'              =>'option',
				'sanitize_callback' => 'skyrocket_radio_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Text_Radio_Button_Custom_Control( $wp_customize, 'social_alignment',
			array(
				'label' => __( 'Alignment', 'skyrocket' ),
				'description' => esc_html__( 'Choose the alignment for your social icons', 'skyrocket' ),
				'section' => 'social_icons_section',
				'choices' => array(
					'alignleft' => __( 'Left', 'skyrocket' ),
					'justify-content-end' => __( 'Right', 'skyrocket'  )
				)
			)
		) );
		$wp_customize->selective_refresh->add_partial( 'social_alignment',
			array(
				'selector' => '.social',
				'container_inclusive' => false,
				'render_callback' => function() {
					echo skyrocket_get_social_media();
				},
				'fallback_refresh' => true
			)
		);

		// Add our Sortable Repeater setting and Custom Control for Social media URLs
		$wp_customize->add_setting( 'social_urls',
			array(
				'default'           => $defaults['social_urls'],
                'transport'         => 'postMessage',
                'type'              => 'option',
				'sanitize_callback' => 'skyrocket_url_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Sortable_Repeater_Custom_Control( $wp_customize, 'social_urls',
			array(
				'label' => __( 'Social URLs', 'skyrocket' ),
				'description' => esc_html__( 'Add your social media links.', 'skyrocket' ),
				'section' => 'social_icons_section',
				'button_labels' => array(
					'add' => __( 'Add Icon', 'skyrocket' ),
				)
			)
		) );
		$wp_customize->selective_refresh->add_partial( 'social_urls',
			array(
				'selector' => '.social',
				'container_inclusive' => false,
				'render_callback' => function() {
					echo skyrocket_get_social_media();
				},
				'fallback_refresh' => true
			)
		);

		// Add our Single Accordion setting and Custom Control to list the available Social Media icons
		$socialIconsList = array(
			'Behance' => __( '<i class="fab fa-behance"></i>', 'skyrocket' ),
			'Bitbucket' => __( '<i class="fab fa-bitbucket"></i>', 'skyrocket' ),
			'CodePen' => __( '<i class="fab fa-codepen"></i>', 'skyrocket' ),
			'DeviantArt' => __( '<i class="fab fa-deviantart"></i>', 'skyrocket' ),
			'Discord' => __( '<i class="fab fa-discord"></i>', 'skyrocket' ),
			'Dribbble' => __( '<i class="fab fa-dribbble"></i>', 'skyrocket' ),
			'Etsy' => __( '<i class="fab fa-etsy"></i>', 'skyrocket' ),
			'Facebook' => '<i class="fab fa-facebook-f"></i>',
			'Flickr' => __( '<i class="fab fa-flickr"></i>', 'skyrocket' ),
			'Foursquare' => __( '<i class="fab fa-foursquare"></i>', 'skyrocket' ),
			'GitHub' => __( '<i class="fab fa-github"></i>', 'skyrocket' ),
			'Google+' => __( '<i class="fab fa-google-plus-g"></i>', 'skyrocket' ),
			'Instagram' => __( '<i class="fab fa-instagram"></i>', 'skyrocket' ),
			'Kickstarter' => __( '<i class="fab fa-kickstarter-k"></i>', 'skyrocket' ),
			'Last.fm' => __( '<i class="fab fa-lastfm"></i>', 'skyrocket' ),
			'LinkedIn' => __( '<i class="fab fa-linkedin-in"></i>', 'skyrocket' ),
			'Medium' => __( '<i class="fab fa-medium-m"></i>', 'skyrocket' ),
			'Patreon' => __( '<i class="fab fa-patreon"></i>', 'skyrocket' ),
			'Pinterest' => __( '<i class="fab fa-pinterest-p"></i>', 'skyrocket' ),
			'Reddit' => __( '<i class="fab fa-reddit-alien"></i>', 'skyrocket' ),
			'Slack' => __( '<i class="fab fa-slack-hash"></i>', 'skyrocket' ),
			'SlideShare' => __( '<i class="fab fa-slideshare"></i>', 'skyrocket' ),
			'Snapchat' => __( '<i class="fab fa-snapchat-ghost"></i>', 'skyrocket' ),
			'SoundCloud' => __( '<i class="fab fa-soundcloud"></i>', 'skyrocket' ),
			'Spotify' => __( '<i class="fab fa-spotify"></i>', 'skyrocket' ),
			'Stack Overflow' => __( '<i class="fab fa-stack-overflow"></i>', 'skyrocket' ),
			'Tumblr' => __( '<i class="fab fa-tumblr"></i>', 'skyrocket' ),
			'Twitch' => __( '<i class="fab fa-twitch"></i>', 'skyrocket' ),
			'Twitter' => __( '<i class="fab fa-twitter"></i>', 'skyrocket' ),
			'Vimeo' => __( '<i class="fab fa-vimeo-v"></i>', 'skyrocket' ),
			'Weibo' => __( '<i class="fab fa-weibo"></i>', 'skyrocket' ),
			'YouTube' => '<i class="fab fa-youtube"></i>',
		);
		$wp_customize->add_setting( 'social_url_icons',
			array(
				'default'           => $defaults['social_url_icons'],
                'transport'         => 'refresh',
                'type'              => 'option',
				'sanitize_callback' => 'skyrocket_text_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Single_Accordion_Custom_Control( $wp_customize, 'social_url_icons',
			array(
				'label' => __( 'View list of available icons', 'skyrocket' ),
				'description' => $socialIconsList,
				'section' => 'social_icons_section'
			)
		) );

		// Add our Checkbox switch setting and Custom Control for displaying an RSS icon
		$wp_customize->add_setting( 'social_rss',
			array(
				'default'           => $defaults['social_rss'],
                'transport'         => 'postMessage',
                'type'              => 'option',
				'sanitize_callback' => 'skyrocket_switch_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Toggle_Switch_Custom_control( $wp_customize, 'social_rss',
			array(
				'label' => __( 'Display RSS icon', 'skyrocket' ),
				'section' => 'social_icons_section'
			)
		) );
		$wp_customize->selective_refresh->add_partial( 'social_rss',
			array(
				'selector' => '.social',
				'container_inclusive' => false,
				'render_callback' => function() {
					echo skyrocket_get_social_media();
				},
				'fallback_refresh' => true
			)
		);

    }
    
/**
 * Return an unordered list of linked social media icons, based on the urls provided in the Customizer Sortable Repeater
 * This is a sample function to display some social icons on your site.
 * This sample function is also used to show how you can call a PHP function to refresh the customizer preview.
 * Add the following code to header.php if you want to see the sample social icons displayed in the customizer preview and your theme.
 * Before any social icons display, you'll also need to add the relevent URL's to the Header Navigation > Social Icons section in the Customizer.
 * <div class="social">
 *	 <?php echo skyrocket_get_social_media(); ?>
 * </div>
 *
 * @return string Unordered list of linked social media icons
 */
if ( ! function_exists( 'skyrocket_get_social_media' ) ) {
	function skyrocket_get_social_media() {
		$defaults = skyrocket_generate_defaults();
		$output = array();
		$social_icons = skyrocket_generate_social_urls();
		$social_urls = explode( ',', get_option( 'social_urls', $defaults['social_urls'] ) );
		$social_newtab = get_option( 'social_newtab', $defaults['social_newtab'] );
		$social_alignment = get_option( 'social_alignment', $defaults['social_alignment'] );

		foreach( $social_urls as $key => $value ) {
			if ( !empty( $value ) ) {
				$domain = str_ireplace( 'www.', '', parse_url( $value, PHP_URL_HOST ) );
				$index = array_search( strtolower( $domain ), array_column( $social_icons, 'url' ) );
				if( false !== $index ) {
					$output[] = sprintf( '<li class="nav-item %1$s"><a class="nav-link" href="%2$s" title="%3$s"%4$s><i class="%5$s"></i></a></li>',
						$social_icons[$index]['class'],
						esc_url( $value ),
						$social_icons[$index]['title'],
						( !$social_newtab ? '' : ' target="_blank"' ),
						$social_icons[$index]['icon']
					);
				}
				else {
					$output[] = sprintf( '<li class="nosocial"><a href="%2$s"%3$s><i class="%4$s"></i></a></li>',
						$social_icons[$index]['class'],
						esc_url( $value ),
						( !$social_newtab ? '' : ' target="_blank"' ),
						'fas fa-globe'
					);
				}
			}
		}

		if( get_option( 'social_rss', $defaults['social_rss'] ) ) {
			$output[] = sprintf( '<li class="%1$s"><a href="%2$s" title="%3$s"%4$s><i class="%5$s"></i></a></li>',
				'rss',
				home_url( '/feed' ),
				'Subscribe to my RSS feed',
				( !$social_newtab ? '' : ' target="_blank"' ),
				'fas fa-rss'
			);
		}

		if ( !empty( $output ) ) {
			$output = apply_filters( 'skyrocket_social_icons_list', $output );
			array_unshift( $output, '<ul class="nav ' . $social_alignment . '">' );
			$output[] = '</ul>';
		}

		return implode( '', $output );
	}
}

/**
* Set our Customizer default options
*/
if ( ! function_exists( 'skyrocket_generate_defaults' ) ) {
	function skyrocket_generate_defaults() {
		$customizer_defaults = array(
			'social_newtab' => 0,
			'social_urls' => '',
			'social_alignment' => 'justify-content-end',
			'social_rss' => 0,
			'social_url_icons' => '',
		);

		return apply_filters( 'skyrocket_customizer_defaults', $customizer_defaults );
	}
}

/**
 * Set our Social Icons URLs.
 * Only needed for our sample customizer preview refresh
 *
 * @return array Multidimensional array containing social media data
 */
if ( ! function_exists( 'skyrocket_generate_social_urls' ) ) {
	function skyrocket_generate_social_urls() {
		$social_icons = array(
			array( 'url' => 'behance.net', 'icon' => 'fab fa-behance fa-2x', 'title' => esc_html__( 'Follow me on Behance', 'skyrocket' ), 'class' => 'behance' ),
			array( 'url' => 'bitbucket.org', 'icon' => 'fab fa-bitbucket fa-2x', 'title' => esc_html__( 'Fork me on Bitbucket', 'skyrocket' ), 'class' => 'bitbucket' ),
			array( 'url' => 'codepen.io', 'icon' => 'fab fa-codepen fa-2x', 'title' => esc_html__( 'Follow me on CodePen', 'skyrocket' ), 'class' => 'codepen' ),
			array( 'url' => 'deviantart.com', 'icon' => 'fab fa-deviantart fa-2x', 'title' => esc_html__( 'Watch me on DeviantArt', 'skyrocket' ), 'class' => 'deviantart' ),
			array( 'url' => 'discord.gg', 'icon' => 'fab fa-discord fa-2x', 'title' => esc_html__( 'Join me on Discord', 'skyrocket' ), 'class' => 'discord' ),
			array( 'url' => 'dribbble.com', 'icon' => 'fab fa-dribbble fa-2x', 'title' => esc_html__( 'Follow me on Dribbble', 'skyrocket' ), 'class' => 'dribbble' ),
			array( 'url' => 'etsy.com', 'icon' => 'fab fa-etsy fa-2x', 'title' => esc_html__( 'favorite me on Etsy', 'skyrocket' ), 'class' => 'etsy' ),
			array( 'url' => 'facebook.com', 'icon' => 'fab fa-facebook-f fa-2x', 'title' => esc_html__( 'Like me on Facebook', 'skyrocket' ), 'class' => 'facebook' ),
			array( 'url' => 'flickr.com', 'icon' => 'fab fa-flickr fa-2x', 'title' => esc_html__( 'Connect with me on Flickr', 'skyrocket' ), 'class' => 'flickr' ),
			array( 'url' => 'foursquare.com', 'icon' => 'fab fa-foursquare fa-2x', 'title' => esc_html__( 'Follow me on Foursquare', 'skyrocket' ), 'class' => 'foursquare' ),
			array( 'url' => 'github.com', 'icon' => 'fab fa-github fa-2x', 'title' => esc_html__( 'Fork me on GitHub', 'skyrocket' ), 'class' => 'github' ),
			array( 'url' => 'instagram.com', 'icon' => 'fab fa-instagram fa-2x', 'title' => esc_html__( 'Follow me on Instagram', 'skyrocket' ), 'class' => 'instagram' ),
			array( 'url' => 'kickstarter.com', 'icon' => 'fab fa-kickstarter-k fa-2x', 'title' => esc_html__( 'Back me on Kickstarter', 'skyrocket' ), 'class' => 'kickstarter' ),
			array( 'url' => 'last.fm', 'icon' => 'fab fa-lastfm fa-2x', 'title' => esc_html__( 'Follow me on Last.fm', 'skyrocket' ), 'class' => 'lastfm' ),
			array( 'url' => 'linkedin.com', 'icon' => 'fab fa-linkedin-in fa-2x', 'title' => esc_html__( 'Connect with me on LinkedIn', 'skyrocket' ), 'class' => 'linkedin' ),
			array( 'url' => 'medium.com', 'icon' => 'fab fa-medium-m fa-2x', 'title' => esc_html__( 'Follow me on Medium', 'skyrocket' ), 'class' => 'medium' ),
			array( 'url' => 'patreon.com', 'icon' => 'fab fa-patreon fa-2x', 'title' => esc_html__( 'Support me on Patreon', 'skyrocket' ), 'class' => 'patreon' ),
			array( 'url' => 'pinterest.com', 'icon' => 'fab fa-pinterest-p fa-2x', 'title' => esc_html__( 'Follow me on Pinterest', 'skyrocket' ), 'class' => 'pinterest' ),
			array( 'url' => 'plus.google.com', 'icon' => 'fab fa-google-plus-g fa-2x', 'title' => esc_html__( 'Connect with me on Google+', 'skyrocket' ), 'class' => 'googleplus' ),
			array( 'url' => 'reddit.com', 'icon' => 'fab fa-reddit-alien fa-2x', 'title' => esc_html__( 'Join me on Reddit', 'skyrocket' ), 'class' => 'reddit' ),
			array( 'url' => 'slack.com', 'icon' => 'fab fa-slack-hash fa-2x', 'title' => esc_html__( 'Join me on Slack', 'skyrocket' ), 'class' => 'slack.' ),
			array( 'url' => 'slideshare.net', 'icon' => 'fab fa-slideshare fa-2x', 'title' => esc_html__( 'Follow me on SlideShare', 'skyrocket' ), 'class' => 'slideshare' ),
			array( 'url' => 'snapchat.com', 'icon' => 'fab fa-snapchat-ghost fa-2x', 'title' => esc_html__( 'Add me on Snapchat', 'skyrocket' ), 'class' => 'snapchat' ),
			array( 'url' => 'soundcloud.com', 'icon' => 'fab fa-soundcloud fa-2x', 'title' => esc_html__( 'Follow me on SoundCloud', 'skyrocket' ), 'class' => 'soundcloud' ),
			array( 'url' => 'spotify.com', 'icon' => 'fab fa-spotify fa-2x', 'title' => esc_html__( 'Follow me on Spotify', 'skyrocket' ), 'class' => 'spotify' ),
			array( 'url' => 'stackoverflow.com', 'icon' => 'fab fa-stack-overflow fa-2x', 'title' => esc_html__( 'Join me on Stack Overflow', 'skyrocket' ), 'class' => 'stackoverflow' ),
			array( 'url' => 'tumblr.com', 'icon' => 'fab fa-tumblr fa-2x', 'title' => esc_html__( 'Follow me on Tumblr', 'skyrocket' ), 'class' => 'tumblr' ),
			array( 'url' => 'twitch.tv', 'icon' => 'fab fa-twitch fa-2x', 'title' => esc_html__( 'Follow me on Twitch', 'skyrocket' ), 'class' => 'twitch' ),
			array( 'url' => 'twitter.com', 'icon' => 'fab fa-twitter fa-2x', 'title' => esc_html__( 'Follow me on Twitter', 'skyrocket' ), 'class' => 'twitter' ),
			array( 'url' => 'vimeo.com', 'icon' => 'fab fa-vimeo-v fa-2x', 'title' => esc_html__( 'Follow me on Vimeo', 'skyrocket' ), 'class' => 'vimeo' ),
			array( 'url' => 'weibo.com', 'icon' => 'fab fa-weibo fa-2x', 'title' => esc_html__( 'Follow me on weibo', 'skyrocket' ), 'class' => 'weibo' ),
			array( 'url' => 'youtube.com', 'icon' => 'fab fa-youtube fa-2x', 'title' => esc_html__( 'Subscribe to me on YouTube', 'skyrocket' ), 'class' => 'youtube' ),
		);

		return apply_filters( 'skyrocket_social_icons', $social_icons );
	}
}

?>