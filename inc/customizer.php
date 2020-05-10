<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


/* Actions */
add_action( 'customize_register', 'understrap_builder_customize_register' ); // Add UnderStrap BUILDER Customizer options
add_action( 'customize_controls_print_styles', 'understrap_builder_customize_style', 999 ); // Style the Customizer for BUILDER
add_action( 'customize_controls_enqueue_scripts', 'understrap_builder_customizer_enqueue' ); // Enqueue scripts for Customizer


/* Additional CSS+JS Needed For Customizer */
function understrap_builder_customizer_enqueue() {
  $the_theme = wp_get_theme();
  // TIPR tooltips
  wp_enqueue_script('tipr-js', get_stylesheet_directory_uri() . '/js/tipr.min.js', array(), $the_theme->get( 'Version' ) );
  wp_enqueue_style('tipr-css', get_stylesheet_directory_uri() . '/css/tipr.css', array(), $the_theme->get( 'Version' ) );
  // Enqueue custom script to initialize the tooltips after jQuery setup
  wp_enqueue_script( 'understrap-builder-customizer-js', get_stylesheet_directory_uri() . '/js/builder-customizer.js', '', $the_theme->get( 'Version' ), true );
}




/* All BUILDER Customizer Code In Here */

if ( ! function_exists( 'understrap_builder_customize_register' ) ) {

  function understrap_builder_customize_register( $wp_customize ) {
    
    global $us_b_potential_bootstrap_color_classes, $us_b_heading_sizes, $builder_default_spacings;
    
    
    /* ============ Start by adding the sections in ============ */
    
    
    /* ======================= NAVBAR PANEL ======================= */
    
    // Theme navbar panel
    $wp_customize->add_panel(
      'understrap_builder_navbar_panel', 
      array(
       'priority'       => 122,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __('Navbar', 'understrap-builder'),
        'description'    => __('Expands into navbar options.', 'understrap-builder'),
      )
    );
    
    // Theme navbar layout section
		$wp_customize->add_section(
			'understrap_builder_navbar_options',
			array(
				'title'       => __( 'Navbar Layout & Style', 'understrap-builder' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'Navbar type and settings', 'understrap-builder' ),
				'priority'    => 10,
        'panel'       => 'understrap_builder_navbar_panel'
			)
		);
    
    // Theme navbar dropdowns section
		$wp_customize->add_section(
			'understrap_builder_navbar_dropdowns',
			array(
				'title'       => __( 'Navbar Dropdowns', 'understrap-builder' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'Navbar dropdown menus', 'understrap-builder' ),
				'priority'    => 20,
        'panel'       => 'understrap_builder_navbar_panel'
			)
		);
    
    // Theme navbar submenu section
		$wp_customize->add_section(
			'understrap_builder_navbar_submenu',
			array(
				'title'       => __( 'Navbar Submenu', 'understrap-builder' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'Navbar submenu', 'understrap-builder' ),
				'priority'    => 30,
        'panel'       => 'understrap_builder_navbar_panel'
			)
		);
    
    // Theme navbar top bar section
		$wp_customize->add_section(
			'understrap_builder_navbar_mobile',
			array(
				'title'       => __( 'Navbar Mobile', 'understrap-builder' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'Navbar mobile appearance', 'understrap-builder' ),
				'priority'    => 35,
        'panel'       => 'understrap_builder_navbar_panel'
			)
		);
    
    // Theme navbar top bar section
		$wp_customize->add_section(
			'understrap_builder_navbar_topbar',
			array(
				'title'       => __( 'Navbar Top Bar', 'understrap-builder' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'Navbar top bar layout and style', 'understrap-builder' ),
				'priority'    => 40,
        'panel'       => 'understrap_builder_navbar_panel'
			)
		);
    
    // Theme navbar scroll section
		$wp_customize->add_section(
			'understrap_builder_navbar_scroll',
			array(
				'title'       => __( 'Navbar Scroll effects', 'understrap-builder' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'Navbar appearance on scroll down. Dependant on the type of navbar you use, fixed or standard', 'understrap-builder' ),
				'priority'    => 50,
        'panel'       => 'understrap_builder_navbar_panel'
			)
		);
    
    /* ======================= NAVBAR PANEL END ======================= */
    
    
    // Theme layout settings section
		$wp_customize->add_section(
			'understrap_builder_layout_options',
			array(
				'title'       => __( 'Layout', 'understrap-builder' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'Layout options, such as container and page width', 'understrap-builder' ),
				'priority'    => 126,
			)
		);
    
    
    /* ======================= SPACINGS PANEL ======================= */
    
    // Theme spacing panel
    $wp_customize->add_panel(
      'understrap_builder_spacings_panel', 
      array(
       'priority'       => 128,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __('Spacings', 'understrap-builder'),
        'description'    => __('Expands into margin and padding options.', 'understrap-builder'),
      )
    );
    
    // Theme navbar spacings section
		$wp_customize->add_section(
			'understrap_builder_spacings_navbar_section',
			array(
				'title'       => __( 'Navbar Spacings', 'understrap-builder' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'Spacings around the navbar.', 'understrap-builder' ),
				'priority'    => 10,
        'panel'       => 'understrap_builder_spacings_panel'
			)
		);
    
    // Theme footer spacings section
		$wp_customize->add_section(
			'understrap_builder_spacings_footer_section',
			array(
				'title'       => __( 'Footer Spacings', 'understrap-builder' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'Spacings around the footer and within the footer.', 'understrap-builder' ),
				'priority'    => 50,
        'panel'       => 'understrap_builder_spacings_panel'
			)
		);
    
    // Theme breadcrumbs spacings section
		$wp_customize->add_section(
			'understrap_builder_spacings_breadcrumbs_section',
			array(
				'title'       => __( 'Breadcrumbs Spacings', 'understrap-builder' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'Spacings around the breadcrumbs.', 'understrap-builder' ),
				'priority'    => 60,
        'panel'       => 'understrap_builder_spacings_panel'
			)
		);
    
    // Theme headers spacings section
		$wp_customize->add_section(
			'understrap_builder_spacings_headers_section',
			array(
				'title'       => __( 'Headers Spacings', 'understrap-builder' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'Spacings around the headers.', 'understrap-builder' ),
				'priority'    => 70,
        'panel'       => 'understrap_builder_spacings_panel'
			)
		);
    
    // Theme author box spacings section
		$wp_customize->add_section(
			'understrap_builder_spacings_author_section',
			array(
				'title'       => __( 'Author Box Spacings', 'understrap-builder' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'Spacings around the author box.', 'understrap-builder' ),
				'priority'    => 90,
        'panel'       => 'understrap_builder_spacings_panel'
			)
		);
    
    // Theme comments spacings section
		$wp_customize->add_section(
			'understrap_builder_spacings_comments_section',
			array(
				'title'       => __( 'Comments Spacings', 'understrap-builder' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'Spacings around the comments.', 'understrap-builder' ),
				'priority'    => 100,
        'panel'       => 'understrap_builder_spacings_panel'
			)
		);
    
    // Theme single post spacings section
		$wp_customize->add_section(
			'understrap_builder_spacings_single_section',
			array(
				'title'       => __( 'Post Spacings', 'understrap-builder' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'Spacings on single posts.', 'understrap-builder' ),
				'priority'    => 110,
        'panel'       => 'understrap_builder_spacings_panel'
			)
		);
    
    // Theme page spacings section
		$wp_customize->add_section(
			'understrap_builder_spacings_page_section',
			array(
				'title'       => __( 'Page Spacings', 'understrap-builder' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'Spacings on pages.', 'understrap-builder' ),
				'priority'    => 120,
        'panel'       => 'understrap_builder_spacings_panel'
			)
		);
    
    /* ======================= SPACINGS PANEL END ======================= */
    
    
    // Theme bootstrap colors settings section
		$wp_customize->add_section(
			'understrap_builder_bs_colors_options',
			array(
				'title'       => __( 'Bootstrap Colors', 'understrap-builder' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'The colors assigned to Bootstrap classes:<ul><li>.bg-[bootstrap-class]</li><li>.text-[bootstrap-class]</li><li>.border-[bootstrap-class]</li><li>.btn-[bootstrap-class]</li></ul>', 'understrap-builder' ),
				'priority'    => 132,
			)
		);
    
    // Theme bootstrap typography settings section
		$wp_customize->add_section(
			'understrap_builder_typography_options',
			array(
				'title'       => __( 'Typography', 'understrap-builder' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'Font and headings settings', 'understrap-builder' ),
				'priority'    => 138,
			)
		);
    
    // Theme layout settings section
		$wp_customize->add_section(
			'understrap_builder_links_options',
			array(
				'title'       => __( 'Links', 'understrap-builder' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'Links and rollover attributes', 'understrap-builder' ),
				'priority'    => 144,
			)
		);
    
    // Theme bootstrap buttons settings section
		$wp_customize->add_section(
			'understrap_builder_buttons_options',
			array(
				'title'       => __( 'Buttons', 'understrap-builder' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'Styles and rollovers of Bootstrap buttons', 'understrap-builder' ),
				'priority'    => 150,
			)
		);
    
    // Theme sidebar settings section
		$wp_customize->add_section(
			'understrap_builder_sidebar_options',
			array(
				'title'       => __( 'Sidebars', 'understrap-builder' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'Sidebar options such as which to show and how.', 'understrap-builder' ),
				'priority'    => 156,
			)
		);
    
    // Theme layout settings section
		$wp_customize->add_section(
			'understrap_builder_footer_options',
			array(
				'title'       => __( 'Footer', 'understrap-builder' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'Footer options, such as size and widgets', 'understrap-builder' ),
				'priority'    => 162,
			)
		);
    
    // Additional code settings section
		$wp_customize->add_section(
			'understrap_builder_code_options',
			array(
				'title'       => __( 'Code', 'understrap-builder' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'Additional code for tracking and JS etc.', 'understrap-builder' ),
				'priority'    => 168,
			)
		);
    
    // Theme hero settings section
		$wp_customize->add_section(
			'understrap_builder_hero_options',
			array(
				'title'       => __( 'Hero', 'understrap-builder' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'Enable the home page hero and select layout.', 'understrap-builder' ),
				'priority'    => 174,
			)
		);
    
    // Theme headers settings section
		$wp_customize->add_section(
			'understrap_builder_headers_options',
			array(
				'title'       => __( 'Headers', 'understrap-builder' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'Choose to show full width beautiful title headers.', 'understrap-builder' ),
				'priority'    => 180,
			)
		);
    
    // Theme mobile settings section
		$wp_customize->add_section(
			'understrap_builder_mobile_options',
			array(
				'title'       => __( 'Mobile', 'understrap-builder' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'Alter the way your site appears on mobile devices.', 'understrap-builder' ),
				'priority'    => 181,
			)
		);
        
    // Theme breadcrumbs section
    $us_b_yoast_plugin_url = '<a href="https://wordpress.org/plugins/wordpress-seo/" target="_blank">Yoast SEO</a>';
    $us_b_navxt_plugin_url = '<a href="https://wordpress.org/plugins/breadcrumb-navxt/" target="_blank">Breadcrumb NavXT</a>';
		$wp_customize->add_section(
			'understrap_builder_breadcrumbs_options',
			array(
				'title'       => __( 'Breadcrumbs', 'understrap-builder' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'Aid site navigation with breadcrumbs. <strong>BUILDER</strong> can show breadcrumbs from these plugins: '.$us_b_yoast_plugin_url.', '.$us_b_navxt_plugin_url ,'understrap-builder' ),
				'priority'    => 182,
			)
		);
    
    // Theme archives section
		$wp_customize->add_section(
			'understrap_builder_archives_options',
			array(
				'title'       => __( 'Archives', 'understrap-builder' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'The layout of archive pages such as blog.', 'understrap-builder' ),
				'priority'    => 186,
			)
		);
    
    // Theme archives section
		$wp_customize->add_section(
			'understrap_builder_postlayout_options',
			array(
				'title'       => __( 'Single Post', 'understrap-builder' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'The layout of single posts.', 'understrap-builder' ),
				'priority'    => 194,
			)
		);
    
    // Theme comments section
		$wp_customize->add_section(
			'understrap_builder_comments_options',
			array(
				'title'       => __( 'Comments', 'understrap-builder' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'Layout and display of comments on single posts.', 'understrap-builder' ),
				'priority'    => 196,
			)
		);
    
    // Theme authors box section
		$wp_customize->add_section(
			'understrap_builder_author_box_options',
			array(
				'title'       => __( 'Author Box', 'understrap-builder' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'Display information about the author at the end of single posts.', 'understrap-builder' ),
				'priority'    => 197,
			)
		);
    /* ============ Add the settings ============== */
    

    // Theme navbar type setting
		$wp_customize->add_setting(
			'understrap_builder_navbar_type',
			array(
				'default'           => 'left-logo',
				'type'              => 'theme_mod',
        'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization',
				'capability'        => 'edit_theme_options',
			)
		);
      
    // Theme navbar position setting
		$wp_customize->add_setting(
			'understrap_builder_navbar_position',
			array(
				'default'           => 'default',
				'type'              => 'theme_mod',
        'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme navbar align setting
		$wp_customize->add_setting(
			'understrap_builder_navbar_align',
			array(
				'default'           => '',
				'type'              => 'theme_mod',
        'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization',
				'capability'        => 'edit_theme_options',
			)
		);

    // Theme navbar position setting
		$wp_customize->add_setting(
			'understrap_builder_navbar_color_scheme',
			array(
				'default'           => 'navbar-dark',
				'type'              => 'theme_mod',
        'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme navbar position setting
		$wp_customize->add_setting(
			'understrap_builder_navbar_bg_color',
			array(
				'default'           => 'bg-primary',
				'type'              => 'theme_mod',
        'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme navbar background when hero is active
		$wp_customize->add_setting(
			'understrap_builder_navbar_bg_hero',
			array(
				'default'           => 'show',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme navbar search show
		$wp_customize->add_setting(
			'understrap_builder_navbar_search_show',
			array(
				'default'           => 0,
				'type'              => 'theme_mod',
        'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_switch_sanitization',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme navbar search show
		$wp_customize->add_setting(
			'understrap_builder_navbar_cta_show',
			array(
				'default'           => 0,
				'type'              => 'theme_mod',
        'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_switch_sanitization',
				'capability'        => 'edit_theme_options',
			)
		);

    // Theme navbar cta show and bg
		$wp_customize->add_setting(
			'understrap_builder_navbar_cta_bg',
			array(
				'default'           => 'disabled',
				'type'              => 'theme_mod',
        'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme navbar cta text
		$wp_customize->add_setting(
			'understrap_builder_navbar_cta_text',
			array(
				'default'           => 'Go Now',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme navbar cta url
		$wp_customize->add_setting(
			'understrap_builder_navbar_cta_url',
			array(
				'default'           => '#',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme navbar cta icon
		$wp_customize->add_setting(
			'understrap_builder_navbar_cta_fa_icon',
			array(
				'default'           => '',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme navbar cta icon side
		$wp_customize->add_setting(
			'understrap_builder_navbar_cta_fa_icon_side',
			array(
				'default'           => 'right',
        'transport'         => 'refresh',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'skyrocket_text_sanitization',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme submenu type setting
		$wp_customize->add_setting(
			'understrap_builder_submenu_type',
			array(
				'default'           => 'none',
				'type'              => 'theme_mod',
        'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization',
				'capability'        => 'edit_theme_options',
			)
		); 
    
    // Theme submenu link width
		$wp_customize->add_setting(
			'understrap_builder_submenu_link_width',
			array(
				'default'           => 'thin',
				'type'              => 'theme_mod',
        'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization',
				'capability'        => 'edit_theme_options'
			)
		);
    
    // Theme submenu show mobile
		$wp_customize->add_setting(
			'understrap_builder_submenu_mobile_show',
			array(
				'default'           => 0,
				'type'              => 'theme_mod',
        'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_switch_sanitization',
				'capability'        => 'edit_theme_options'
			)
		);
    
    // Theme submenu show mobile
		$wp_customize->add_setting(
			'understrap_builder_submenu_home_show',
			array(
				'default'           => 0,
        'transport'         => 'refresh',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'skyrocket_switch_sanitization',
				'capability'        => 'edit_theme_options'
			)
		);
    
    // Theme submenu show mobile
		$wp_customize->add_setting(
			'understrap_builder_submenu_color_scheme',
			array(
				'default'           => 'navbar-dark',
				'type'              => 'theme_mod',
        'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization',
				'capability'        => 'edit_theme_options',
			)
		); 
    
    // Theme submenu show mobile
		$wp_customize->add_setting(
			'understrap_builder_submenu_bg_color',
			array(
				'default'           => 'bg-dark',
				'type'              => 'theme_mod',
        'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization',
				'capability'        => 'edit_theme_options',
			)
		); 
    
    // Theme navbar bottom border or shadow
		$wp_customize->add_setting(
			'understrap_builder_navbar_bottom_border',
			array(
				'default'           => 'default',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'capability'        => 'edit_theme_options',
			)
		); 
    
    // Theme navbar bottom border color class
		$wp_customize->add_setting(
			'understrap_builder_navbar_bottom_border_color',
			array(
				'default'           => 'dark',
				'type'              => 'theme_mod',
        'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization',
				'capability'        => 'edit_theme_options',
			)
		);
    
    
    // Theme navbar dropdown border display
		$wp_customize->add_setting(
			'understrap_builder_navbar_dropdown_border_on',
			array(
				'default'           => 1,
				'type'              => 'theme_mod',
        'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_switch_sanitization',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme navbar dropdown border radius
		$wp_customize->add_setting(
			'understrap_builder_navbar_dropdown_border_radius',
			array(
				'default'           => 5,
				'type'              => 'theme_mod',
        'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_sanitize_integer',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme navbar dropdown bg color
		$wp_customize->add_setting(
			'understrap_builder_navbar_dropdown_bg',
			array(
				'default'           => '',
				'type'              => 'theme_mod',
        'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme navbar dropdown custom bg color
		$wp_customize->add_setting(
			'understrap_builder_navbar_dropdown_custom_bg',
			array(
				'default'           => '',
				'type'              => 'theme_mod',
        'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme navbar dropdown custom bg color
		$wp_customize->add_setting(
			'understrap_builder_navbar_dropdown_border',
			array(
				'default'           => '',
				'type'              => 'theme_mod',
        'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme navbar dropdown link color
		$wp_customize->add_setting(
			'understrap_builder_navbar_dropdown_custom_border',
			array(
				'default'           => '',
				'type'              => 'theme_mod',
        'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme navbar dropdown link color
		$wp_customize->add_setting(
			'understrap_builder_navbar_dropdown_link',
			array(
				'default'           => '',
				'type'              => 'theme_mod',
        'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme navbar dropdown link custom color
		$wp_customize->add_setting(
			'understrap_builder_navbar_dropdown_custom_link',
			array(
				'default'           => '',
				'type'              => 'theme_mod',
        'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme navbar dropdown link hover color
		$wp_customize->add_setting(
			'understrap_builder_navbar_dropdown_link_hover',
			array(
				'default'           => '',
				'type'              => 'theme_mod',
        'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme navbar dropdown link hover cutom color
		$wp_customize->add_setting(
			'understrap_builder_navbar_dropdown_custom_link_hover',
			array(
				'default'           => '',
				'type'              => 'theme_mod',
        'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme navbar dropdown background hover color
		$wp_customize->add_setting(
			'understrap_builder_navbar_dropdown_bg_hover',
			array(
				'default'           => '',
				'type'              => 'theme_mod',
        'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme navbar dropdown background hover custom color
		$wp_customize->add_setting(
			'understrap_builder_navbar_dropdown_custom_bg_hover',
      array(
				'default'           => '',
				'type'              => 'theme_mod',
        'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
				'capability'        => 'edit_theme_options',
			)
		);
    
    
    // Theme navbar scroll effects switch on//off
		$wp_customize->add_setting(
			'understrap_builder_navbar_scroll_switch',
      array(
				'default'           => '',
				'type'              => 'theme_mod',
        'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_switch_sanitization',
				'capability'        => 'edit_theme_options',
			)
		);
    
    
    // Theme layout container setting
		$wp_customize->add_setting(
			'understrap_builder_container_type',
			array(
				'default'           => 'container',
				'type'              => 'theme_mod',
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme layout container width
		$wp_customize->add_setting(
			'understrap_builder_container_width',
			array(
				'default'           => '1140',
				'type'              => 'theme_mod',
				'transport'         => 'refresh',
		    'sanitize_callback' => 'skyrocket_sanitize_integer',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme layout page container setting
		$wp_customize->add_setting(
			'understrap_builder_container_page_type',
			array(
				'default'           => 'default',
				'type'              => 'theme_mod',
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme layout single container setting
		$wp_customize->add_setting(
			'understrap_builder_container_single_type',
			array(
				'default'           => 'default',
				'type'              => 'theme_mod',
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme layout archive container setting
		$wp_customize->add_setting(
			'understrap_builder_container_archive_type',
			array(
				'default'           => 'default',
				'type'              => 'theme_mod',
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme layout header container setting
		$wp_customize->add_setting(
			'understrap_builder_container_header_type',
			array(
				'default'           => 'default',
				'type'              => 'theme_mod',
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme layout footer container setting
		$wp_customize->add_setting(
			'understrap_builder_container_footer_type',
			array(
				'default'           => 'default',
				'type'              => 'theme_mod',
				'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization',
				'capability'        => 'edit_theme_options',
			)
		);
    
    
    // Theme spacings navbar logo
    $wp_customize->add_setting(
			'understrap_builder_spacings_navbar_logo',
			array(
				'default'           => $builder_default_spacings,
				'type'              => 'theme_mod',
        'transport'         => 'refresh',
		    'sanitize_callback' => 'understrap_builder_sanitize_spacings',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme spacings navbar
    $wp_customize->add_setting(
			'understrap_builder_spacings_navbar',
			array(
				'default'           => $builder_default_spacings,
				'type'              => 'theme_mod',
        'transport'         => 'refresh',
		    'sanitize_callback' => 'understrap_builder_sanitize_spacings',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme spacings navbar submenu
    $wp_customize->add_setting(
			'understrap_builder_spacings_navbar_submenu',
			array(
				'default'           => $builder_default_spacings,
				'type'              => 'theme_mod',
        'transport'         => 'refresh',
		    'sanitize_callback' => 'understrap_builder_sanitize_spacings',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme spacings footer widgets
    $wp_customize->add_setting(
			'understrap_builder_spacings_footer_widgets',
			array(
				'default'           => $builder_default_spacings,
				'type'              => 'theme_mod',
        'transport'         => 'refresh',
		    'sanitize_callback' => 'understrap_builder_sanitize_spacings',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme spacings footer menu
    $wp_customize->add_setting(
			'understrap_builder_spacings_footer_menu',
			array(
				'default'           => $builder_default_spacings,
				'type'              => 'theme_mod',
        'transport'         => 'refresh',
		    'sanitize_callback' => 'understrap_builder_sanitize_spacings',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme spacings footer text bar
    $wp_customize->add_setting(
			'understrap_builder_spacings_footer_text_bar',
			array(
				'default'           => $builder_default_spacings,
				'type'              => 'theme_mod',
        'transport'         => 'refresh',
		    'sanitize_callback' => 'understrap_builder_sanitize_spacings',
				'capability'        => 'edit_theme_options',
			)
		);
    
    
    // Theme spacings page go PRO
    if(!function_exists( 'understrap_builder_pro_start' )){
      $wp_customize->add_setting(
        'understrap_builder_spacings_breadcrumbs_pro',
        array(
          'type'              => 'button'
        )
      );
    }
    
    // Theme spacings page go PRO
    if(!function_exists( 'understrap_builder_pro_start' )){
      $wp_customize->add_setting(
        'understrap_builder_spacings_headers_pro',
        array(
          'type'              => 'button'
        )
      );
    }
    
    // Theme spacings page go PRO
    if(!function_exists( 'understrap_builder_pro_start' )){
      $wp_customize->add_setting(
        'understrap_builder_spacings_author_pro',
        array(
          'type'              => 'button'
        )
      );
    }
    
    // Theme spacings page go PRO
    if(!function_exists( 'understrap_builder_pro_start' )){
      $wp_customize->add_setting(
        'understrap_builder_spacings_comments_pro',
        array(
          'type'              => 'button'
        )
      );
    }
    
    // Theme spacings page go PRO
    if(!function_exists( 'understrap_builder_pro_start' )){
      $wp_customize->add_setting(
        'understrap_builder_spacings_single_pro',
        array(
          'type'              => 'button'
        )
      );
    }
    
    // Theme spacings page go PRO
    if(!function_exists( 'understrap_builder_pro_start' )){
      $wp_customize->add_setting(
        'understrap_builder_spacings_page_pro',
        array(
          'type'              => 'button'
        )
      );
    }
    
    
    
    // Theme layout archive container setting
		$wp_customize->add_setting(
			'understrap_builder_bs_color_default',
			array(
				'default'           => 'default',
				'type'              => 'theme_mod',
        'transport'         => 'refresh',
		    'sanitize_callback' => 'skyrocket_text_sanitization',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme layout BS color classes controls
    foreach($us_b_potential_bootstrap_color_classes as $bs_color => $bs_color_default){
      
      $bs_color_lower = strtolower($bs_color);
      
      $wp_customize->add_setting(
        'understrap_builder_bs_color_'.$bs_color_lower,
        array(
          'default'           => $bs_color_default,
          'type'              => 'theme_mod',
          'sanitize_callback' => 'sanitize_hex_color',
          'capability'        => 'edit_theme_options',
        )
      );
      
    }
    
    
    // Theme default font setting
		$wp_customize->add_setting(
			'understrap_builder_typography_default_font',
			array(
				'default'           => '{"font":"Open Sans","regularweight":"regular","italicweight":"italic","boldweight":"700","category":"sans-serif"}',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'skyrocket_google_font_sanitization',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme heading font setting
		$wp_customize->add_setting(
			'understrap_builder_typography_heading_font_custom',
			array(
				'default'           => 0,
				'type'              => 'theme_mod',
        'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_switch_sanitization',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme heading font setting
		$wp_customize->add_setting(
			'understrap_builder_typography_heading_font',
			array(
				'default'           => '{"font":"Open Sans","regularweight":"regular","italicweight":"italic","boldweight":"700","category":"sans-serif"}',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'skyrocket_google_font_sanitization',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme default font setting
		$wp_customize->add_setting(
			'understrap_builder_typography_font_size',
			array(
				'default'           => '1rem',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme default font setting
		$wp_customize->add_setting(
			'understrap_builder_typography_font_size',
			array(
				'default'           => '1rem',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'skyrocket_text_sanitization',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme heading font size default setting
		$wp_customize->add_setting(
			'understrap_builder_typography_heading_font_default',
			array(
				'default'           => 0,
				'type'              => 'theme_mod',
        'transport'         => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme heading font size
    foreach($us_b_heading_sizes as $heading_size => $heading_settings){
      $heading_size_lower = strtolower($heading_size);
      $wp_customize->add_setting(
        'understrap_builder_typography_heading_font_'.$heading_size_lower,
        array(
          'default'           => $heading_settings['default'],
          'type'              => 'theme_mod',
          'sanitize_callback' => 'sanitize_text_field',
          'capability'        => 'edit_theme_options',
        )
      );
    };
    
    // Theme font default line height
		$wp_customize->add_setting(
			'understrap_builder_typography_default_line_height',
			array(
				'default'           => '1.5',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'skyrocket_text_sanitization',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme font default heading line height
		$wp_customize->add_setting(
			'understrap_builder_typography_default_heading_line_height',
			array(
				'default'           => '1.2',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'skyrocket_text_sanitization',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme paragraph margin bottom rem
		$wp_customize->add_setting(
			'understrap_builder_typography_default_p_margin_bottom',
			array(
				'default'           => '1rem',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'skyrocket_text_sanitization',
				'capability'        => 'edit_theme_options',
			)
		);
    
    
    // Theme standard link colour
		$wp_customize->add_setting(
			'understrap_builder_links_color',
			array(
				'default'           => '#7c008c',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_hex_color',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme standard link colour
		$wp_customize->add_setting(
			'understrap_builder_links_decoration',
			array(
				'default'           => 'none',
				'type'              => 'theme_mod',
        'transport'         => 'refresh',
		    'sanitize_callback' => 'skyrocket_text_sanitization',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme standard link rollover color
		$wp_customize->add_setting(
			'understrap_builder_links_rollover_color',
			array(
				'default'           => '#380040',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_hex_color',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme standard link rollover color
		$wp_customize->add_setting(
			'understrap_builder_links_rollover_weight',
			array(
				'default'           => 'normal',
				'type'              => 'theme_mod',
				'transport'         => 'refresh',
		    'sanitize_callback' => 'skyrocket_text_sanitization',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme standard link rollover text decoration
		$wp_customize->add_setting(
			'understrap_builder_links_rollover_decoration',
			array(
				'default'           => 'underline',
				'type'              => 'theme_mod',
				'transport'         => 'refresh',
		    'sanitize_callback' => 'skyrocket_text_sanitization',
				'capability'        => 'edit_theme_options',
			)
		);
    
    
    // Theme buttons curved borders
		$wp_customize->add_setting(
			'understrap_builder_buttons_curved_borders',
			array(
				'default'           => '0.25rem',
				'type'              => 'theme_mod',
				'transport'         => 'refresh',
		    'sanitize_callback' => 'skyrocket_text_sanitization',
				'capability'        => 'edit_theme_options',
			)
		);
      
    // Theme buttons shadow effect
		$wp_customize->add_setting(
			'understrap_builder_buttons_shadow',
			array(
				'default'           => 'none',
				'type'              => 'theme_mod',
				'transport'         => 'refresh',
		    'sanitize_callback' => 'skyrocket_text_sanitization',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme buttons rollover effect
		$wp_customize->add_setting(
			'understrap_builder_buttons_rollover',
			array(
				'default'           => 'none',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'capability'        => 'edit_theme_options',
			)
		);
    
    
    // Theme hero go PRO
    if(!function_exists( 'understrap_builder_pro_start' )){
      $wp_customize->add_setting(
        'understrap_builder_hero_upgrade_pro',
        array(
          'type'              => 'button'
        )
      );
    }
    
    
    // Theme headers go PRO
    if(!function_exists( 'understrap_builder_pro_start' )){
      $wp_customize->add_setting(
        'understrap_builder_headers_upgrade_pro',
        array(
          'type'              => 'button'
        )
      );
    }
    
    
    // Theme breadcrumbs go PRO
    if(!function_exists( 'understrap_builder_pro_start' )){
      $wp_customize->add_setting(
        'understrap_builder_breadcrumbs_upgrade_pro',
        array(
          'type'              => 'button'
        )
      );
    }
    
    
    // Theme mobile go PRO
    if(!function_exists( 'understrap_builder_pro_start' )){
      $wp_customize->add_setting(
        'understrap_builder_mobile_upgrade_pro',
        array(
          'type'              => 'button'
        )
      );
    }
    
    
    // Theme single post go PRO
    if(!function_exists( 'understrap_builder_pro_start' )){
      $wp_customize->add_setting(
        'understrap_builder_single_post_upgrade_pro',
        array(
          'type'              => 'button'
        )
      );
    }
    
    
    // Theme comments go PRO
    if(!function_exists( 'understrap_builder_pro_start' )){
      $wp_customize->add_setting(
        'understrap_builder_comments_upgrade_pro',
        array(
          'type'              => 'button'
        )
      );
    }
    
    
    // Theme author box go PRO
    if(!function_exists( 'understrap_builder_pro_start' )){
      $wp_customize->add_setting(
        'understrap_builder_author_box_upgrade_pro',
        array(
          'type'              => 'button'
        )
      );
    }
    
    
    // Theme sidebars to show setting
		$wp_customize->add_setting(
			'understrap_builder_sidebars_show_default',
			array(
				'default'           => 'right',
				'type'              => 'theme_mod',
				'transport'         => 'refresh',
		    'sanitize_callback' => 'skyrocket_text_sanitization',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme sidebars to show on single posts setting
		$wp_customize->add_setting(
			'understrap_builder_sidebars_show_single',
			array(
				'default'           => 'default',
				'type'              => 'theme_mod',
				'transport'         => 'refresh',
		    'sanitize_callback' => 'skyrocket_text_sanitization',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme sidebars to show on pages setting
		$wp_customize->add_setting(
			'understrap_builder_sidebars_show_page',
			array(
				'default'           => 'default',
				'type'              => 'theme_mod',
				'transport'         => 'refresh',
		    'sanitize_callback' => 'skyrocket_text_sanitization',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme sidebars to show on archives setting
		$wp_customize->add_setting(
			'understrap_builder_sidebars_show_archive',
			array(
				'default'           => 'default',
				'type'              => 'theme_mod',
				'transport'         => 'refresh',
		    'sanitize_callback' => 'skyrocket_text_sanitization',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme width of single sidebar setting
		$wp_customize->add_setting(
			'understrap_builder_sidebars_single_width',
			array(
				'default'           => '4',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme width of dual sidebars setting
		$wp_customize->add_setting(
			'understrap_builder_sidebars_dual_width',
			array(
				'default'           => '3',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme sidebar widget bottom margin 
		$wp_customize->add_setting(
			'understrap_builder_sidebars_widget_margin',
			array(
				'default'           => 'default',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'skyrocket_text_sanitization',
				'capability'        => 'edit_theme_options',
			)
		);
    
    
    // Theme archive go PRO
    if(!function_exists( 'understrap_builder_pro_start' )){
      $wp_customize->add_setting(
        'understrap_builder_archives_upgrade_pro',
        array(
          'type'              => 'button'
        )
      );
    }
    
    
    // Theme post layout go PRO
    if(!function_exists( 'understrap_builder_pro_start' )){
      $wp_customize->add_setting(
        'understrap_builder_postlayout_upgrade_pro',
        array(
          'type'              => 'button'
        )
      );
    }
    
    
    // Theme footer widgets
		$wp_customize->add_setting(
			'understrap_builder_footer_widgets_enable',
			array(
				'default'           => 0,
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme footer text color
		$wp_customize->add_setting(
			'understrap_builder_footer_text_color',
			array(
				'default'           => '',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme footer background color class
		$wp_customize->add_setting(
			'understrap_builder_footer_bg_color',
			array(
				'default'           => '',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme footer border width
		$wp_customize->add_setting(
			'understrap_builder_footer_border',
			array(
				'default'           => '',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'capability'        => 'edit_theme_options',
			)
		);
      
    // Theme footer border color class
		$wp_customize->add_setting(
			'understrap_builder_footer_border_color',
			array(
				'default'           => 'primary',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme footer background image
		$wp_customize->add_setting(
			'understrap_builder_footer_bg_img',
			array(
				'default'           => '',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_url',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme footer background image in fixed position
		$wp_customize->add_setting(
			'understrap_builder_footer_bg_img_fixed',
			array(
				'default'           => 'default',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'capability'        => 'edit_theme_options',
			)
		);

    // Theme footer text left
		$wp_customize->add_setting(
			'understrap_builder_footer_text_left',
			array(
				'default'           => 'Powered By <a href="https://understrap.com/builder/">UnderStrap BUILDER</a>.',
				'type'              => 'theme_mod',
				'transport'         => 'refresh',
		    'sanitize_callback' => 'wp_kses_post',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme footer text right
		$wp_customize->add_setting(
			'understrap_builder_footer_text_right',
			array(
				'default'           => 'Copyright [builder_current_year]',
				'type'              => 'theme_mod',
				'transport'         => 'refresh',
		    'sanitize_callback' => 'wp_kses_post',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Theme footer menu align
		$wp_customize->add_setting(
			'understrap_builder_footer_menu_align',
			array(
				'default'           => 'default',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'capability'        => 'edit_theme_options',
			)
		);
    
    
    // On screen jQuery setting
		$wp_customize->add_setting(
			'understrap_builder_js',
			array(
				'default'           => '',
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Add code between head tags
		$wp_customize->add_setting(
			'understrap_builder_add_head',
			array(
				'default'           => '',
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
			)
		);
    
    // Add code between footer tags
		$wp_customize->add_setting(
			'understrap_builder_add_footer',
			array(
				'default'           => '',
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
			)
		);
    
    
    
    /* ============ Lastly add the controls ============= */
    
    
    // Theme layout navbar type control
    $wp_customize->add_control(
			new Skyrocket_Image_Radio_Button_Custom_Control(
				$wp_customize,
				'understrap_builder_navbar_type',
				array(
					'label'       => __( 'Navbar Type', 'understrap-builder' ),
					'description' => __( 'Bootstrap navbar type.', 'understrap-builder' ),
					'section'     => 'understrap_builder_navbar_options',
					'settings'    => 'understrap_builder_navbar_type',
          'input_attrs' => array('tooltip' => 'below'),
					'choices'     => array(
            'left-logo' => array(
              'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/nav-left-logo.png',
              'name' => __( 'Left Logo', 'understrap-builder' ) 
            ),
            'right-logo' => array(
              'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/nav-right-logo.png',
              'name' => __( 'Right Logo', 'understrap-builder' ) 
            ),
            'left-logo-dual-row' => array(
              'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/nav-left-logo-dual.png',
              'name' => __( 'Left Logo<br>[Dual Row Menu]', 'understrap-builder' ) 
            ),
            'right-logo-dual-row' => array(
              'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/nav-right-logo-dual.png',
              'name' => __( 'Right Logo<br>[Dual Row Menu]', 'understrap-builder' ) 
            ),
            'center-logo-inside' => array(
              'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/nav-center-logo-left.png',
              'name' => __( 'Center Logo<br>[Left Menu]', 'understrap-builder' ) 
            ),
            'center-logo-outside' => array(
              'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/nav-center-logo-dual.png',
              'name' => __( 'Center Logo<br>[Dual Menu]', 'understrap-builder' ) 
            ),
            'center-logo-below' => array(
              'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/nav-center-logo-below.png',
              'name' => __( 'Center Logo<br>[Menu Below]', 'understrap-builder' ) 
            )
					),
					'priority'    => '10',
				)
			)
		);
 
    // Theme layout navbar position
    $wp_customize->add_control(
			new Skyrocket_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'understrap_builder_navbar_position',
				array(
					'label'       => __( 'Navbar Position', 'understrap-builder' ),
					'description' => __( 'Choose the screen position of the main navbar.', 'understrap-builder' ),
					'section'     => 'understrap_builder_navbar_options',
					'settings'    => 'understrap_builder_navbar_position',
					'choices'     => array(
						'default'       => __( 'Default', 'understrap-builder' ),
            'top'           => __( 'Fixed Top', 'understrap-builder' ),
            'bottom'        => __( 'Fixed Bottom', 'understrap-builder' )
					),
					'priority'    => '12',
				)
			)
		);
    
    // Theme layout navbar align
    $wp_customize->add_control(
			new Skyrocket_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'understrap_builder_navbar_align',
				array(
					'label'       => __( 'Navbar Align', 'understrap-builder' ),
					'description' => __( 'Choose how to align the navbar menu.', 'understrap-builder' ),
					'section'     => 'understrap_builder_navbar_options',
					'settings'    => 'understrap_builder_navbar_align',
					'choices'     => array(
						'left'              => __( 'Left', 'understrap-builder' ),
            'center'            => __( 'Center', 'understrap-builder' ),
            ''                  => __( 'Right', 'understrap-builder' )
					),
					'priority'    => '13',
				)
			)
		);

    // Theme layout navbar color scheme
    $wp_customize->add_control(
			new Skyrocket_Image_Radio_Button_Custom_Control(
				$wp_customize,
				'understrap_builder_navbar_color_scheme',
				array(
					'label'       => __( 'Navbar Color Scheme', 'understrap-builder' ),
					'description' => __( 'Choose the navbar Bootstrap color scheme.', 'understrap-builder' ),
					'section'     => 'understrap_builder_navbar_options',
					'settings'    => 'understrap_builder_navbar_color_scheme',
          'input_attrs' => array('tooltip' => 'below'),
					'choices'     => array(
            'navbar-dark' => array(
              'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/nav-left-logo-dark.png',
              'name' => __( 'Dark<br>[Light Text]', 'understrap-builder' ) 
            ),
            'navbar-light' => array(
              'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/nav-left-logo.png',
              'name' => __( 'Light<br>[Dark Text]', 'understrap-builder' ) 
            )
					),
					'priority'    => '14',
				)
			)
		);
    
    // Theme layout navbar background color
    $wp_customize->add_control(
			new Skyrocket_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'understrap_builder_navbar_bg_color',
				array(
					'label'       => __( 'Navbar Background Color', 'understrap-builder' ),
					'description' => __( 'Choose the navbar Bootstrap background class.', 'understrap-builder' ),
					'section'     => 'understrap_builder_navbar_options',
					'settings'    => 'understrap_builder_navbar_bg_color',
					'choices'     => array(
						'bg-primary'       => __( 'Primary [.bg-primary]', 'understrap-builder' ),
            'bg-secondary'     => __( 'Secondary [.bg-secondary]', 'understrap-builder' ),
            'bg-success'       => __( 'Success [.bg-success]', 'understrap-builder' ),
            'bg-danger'        => __( 'Danger [.bg-danger]', 'understrap-builder' ),
            'bg-warning'       => __( 'Warning [.bg-warning]', 'understrap-builder' ),
            'bg-info'          => __( 'Info [.bg-info]', 'understrap-builder' ),
            'bg-light'         => __( 'Light [.bg-light]', 'understrap-builder' ),
            'bg-dark'          => __( 'Dark [.bg-dark]', 'understrap-builder' ),
            ''                 => __( 'Transparent', 'understrap-builder' ),
					),
					'priority'    => '16',
				)
			)
		);
    
    // Theme navbar bottom border
    $wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'understrap_builder_navbar_bottom_border',
				array(
					'label'       => __( 'Navbar Bottom Border / Shadow', 'understrap-builder' ),
					'description' => __( 'Choose to show a border or shadow underneath the main navbar.', 'understrap-builder' ),
					'section'     => 'understrap_builder_navbar_options',
					'settings'    => 'understrap_builder_navbar_bottom_border',
					'type'        => 'select',
					'choices'     => array(
						'default'          => __( 'No Border or Shadow', 'understrap-builder' ),
            'border-1'         => __( 'Border 1px', 'understrap-builder' ),
            'border-2'         => __( 'Border 2px', 'understrap-builder' ),
            'border-3'         => __( 'Border 3px', 'understrap-builder' ),
            'border-4'         => __( 'Border 4px', 'understrap-builder' ),
            'border-5'         => __( 'Border 5px', 'understrap-builder' ),
            'shadow-sm'        => __( 'Shadow - Small', 'understrap-builder' ),
            'shadow-md'        => __( 'Shadow - Medium', 'understrap-builder' ),
            'shadow-lg'        => __( 'Shadow - Large', 'understrap-builder' ),
					),
					'priority'    => '18',
				)
			)
		);
    
    // Theme navbar bottom border color class
    $wp_customize->add_control(
			new Skyrocket_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'understrap_builder_navbar_bottom_border_color',
				array(
					'label'       => __( 'Border Color Class', 'understrap-builder' ),
					'description' => __( 'The color class to apply to the navbar bottom border.', 'understrap-builder' ),
					'section'     => 'understrap_builder_navbar_options',
					'settings'    => 'understrap_builder_navbar_bottom_border_color',
					'choices'     => array(
            'primary'      => __( 'Primary [.bg-primary]', 'understrap-builder' ),
            'secondary'    => __( 'Secondary [.bg-secondary]', 'understrap-builder' ),
            'success'      => __( 'Success [.bg-success]', 'understrap-builder' ),
            'danger'       => __( 'Danger [.bg-danger]', 'understrap-builder' ),
            'warning'      => __( 'Warning [.bg-warning]', 'understrap-builder' ),
            'info'         => __( 'Info [.bg-info]', 'understrap-builder' ),
            'light'        => __( 'Light [.bg-light]', 'understrap-builder' ),
            'dark'         => __( 'Dark (default) [.bg-dark]', 'understrap-builder' )
					),
          'active_callback' => function ($control) {
            return strstr($control->manager->get_setting("understrap_builder_navbar_bottom_border")->value(), 'border');
          },
					'priority'    => '20',
				)
			)
		);
    
    // Theme layout navbar search show
    $wp_customize->add_control(
			new Skyrocket_Toggle_Switch_Custom_control(
				$wp_customize,
				'understrap_builder_navbar_search_show',
				array(
					'label'       => __( 'Navbar Search', 'understrap-builder' ),
					'description' => __( 'Show a search field in navbar.', 'understrap-builder' ),
					'section'     => 'understrap_builder_navbar_options',
					'settings'    => 'understrap_builder_navbar_search_show',
					'priority'    => '24'
				)
			)
		);
    
    // Theme layout navbar search show
    $wp_customize->add_control(
			new Skyrocket_Toggle_Switch_Custom_control(
				$wp_customize,
				'understrap_builder_navbar_cta_show',
				array(
					'label'       => __( 'Navbar CTA', 'understrap-builder' ),
					'description' => __( 'Show a CTA button in navbar.', 'understrap-builder' ),
					'section'     => 'understrap_builder_navbar_options',
					'settings'    => 'understrap_builder_navbar_cta_show',
					'priority'    => '25'
				)
			)
		);

    // Theme layout navbar cta show and bg class
    $wp_customize->add_control(
			new Skyrocket_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'understrap_builder_navbar_cta_bg',
				array(
					'label'       => __( 'Navbar CTA Enable & BG Color', 'understrap-builder' ),
					'description' => __( 'Show button in navbar + choose background class.', 'understrap-builder' ),
					'section'     => 'understrap_builder_navbar_options',
					'settings'    => 'understrap_builder_navbar_cta_bg',
					'choices'     => array(
						'disabled'       => __( 'Disabled', 'understrap-builder' ),
            'primary'        => __( 'Primary [.bg-primary]', 'understrap-builder' ),
            'secondary'      => __( 'Secondary [.bg-secondary]', 'understrap-builder' ),
            'success'        => __( 'Success [.bg-success]', 'understrap-builder' ),
            'danger'         => __( 'Danger [.bg-danger]', 'understrap-builder' ),
            'warning'        => __( 'Warning [.bg-warning]', 'understrap-builder' ),
            'info'           => __( 'Info [.bg-info]', 'understrap-builder' ),
            'light'          => __( 'Light [.bg-light]', 'understrap-builder' ),
            'dark'           => __( 'Dark [.bg-dark]', 'understrap-builder' )
					),
          'active_callback' => function ($control) {
            return $control->manager->get_setting("understrap_builder_navbar_cta_show")->value()!=0;
          },
					'priority'    => '26'
				)
			)
		);
    
    // Theme layout navbar cta text
    $wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'understrap_builder_navbar_cta_text',
				array(
					'label'       => __( 'Navbar CTA Text', 'understrap-builder' ),
					'description' => __( 'The text to show in CTA button.', 'understrap-builder' ),
					'section'     => 'understrap_builder_navbar_options',
					'settings'    => 'understrap_builder_navbar_cta_text',
					'type'        => 'text',
					'priority'    => '28',
          'active_callback' => function ($control) {
            return $control->manager->get_setting("understrap_builder_navbar_cta_show")->value()!=0;
          }
				)
			)
		);
    
    // Theme layout navbar cta url link
    $wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'understrap_builder_navbar_cta_url',
				array(
					'label'       => __( 'Navbar CTA URL', 'understrap-builder' ),
					'description' => __( 'The URL the CTA links to.', 'understrap-builder' ),
					'section'     => 'understrap_builder_navbar_options',
					'settings'    => 'understrap_builder_navbar_cta_url',
					'type'        => 'url',
					'priority'    => '30',
          'active_callback' => function ($control) {
            return $control->manager->get_setting("understrap_builder_navbar_cta_show")->value()!=0;
          }
				)
			)
		);
    
    // Theme layout navbar cta fa icon
    $wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'understrap_builder_navbar_cta_fa_icon',
				array(
					'label'       => __( 'Navbar CTA Icon', 'understrap-builder' ),
					'description' => __( 'Add a Font Awesome icon to the CTA.', 'understrap-builder' ),
					'section'     => 'understrap_builder_navbar_options',
					'settings'    => 'understrap_builder_navbar_cta_fa_icon',
					'type'        => 'select',
          'choices'     => array(
						''            => __( 'None (default)', 'understrap-builder' ),
						'plus'        => __( 'Plus', 'understrap-builder' ),
            'minus'       => __( 'Minus', 'understrap-builder' ),
            'check'       => __( 'Check', 'understrap-builder' ),
            'times'       => __( 'Cross', 'understrap-builder' ),
            'signal'      => __( 'Signal', 'understrap-builder' ),
            'cog'         => __( 'Cog', 'understrap-builder' ),
            'home'        => __( 'Home', 'understrap-builder' ),
            'road'        => __( 'Road', 'understrap-builder' ),
            'download'    => __( 'Download', 'understrap-builder' ),
            'upload'      => __( 'Upload', 'understrap-builder' ),
            'play-circle' => __( 'Play Circle', 'understrap-builder' ),
            'lock'        => __( 'Lock', 'understrap-builder' ),
            'flag'        => __( 'Flag', 'understrap-builder' ),
            'volume-up'   => __( 'Volume Up', 'understrap-builder' ),
            'book'        => __( 'Book', 'understrap-builder' ),
            'map-marker'  => __( 'Map Marker', 'understrap-builder' ),
            'forward'      => __( 'Forward', 'understrap-builder' ),
            'play'         => __( 'Play', 'understrap-builder' ),
            'pause'        => __( 'Pause', 'understrap-builder' ),
            'chevron-right'=> __( 'Chevron Right', 'understrap-builder' ),
            'thumbs-up'    => __( 'Thumbs Up', 'understrap-builder' ),
            'thumbs-down'  => __( 'Thumbs Down', 'understrap-builder' ),
            'arrow-right'  => __( 'Arrow Right', 'understrap-builder' ),
            'arrow-up'     => __( 'Arrow Up', 'understrap-builder' ),
					),
					'priority'    => '32',
          'active_callback' => function ($control) {
            return $control->manager->get_setting("understrap_builder_navbar_cta_show")->value()!=0;
          }
				)
			)
		);
    
    // Theme layout navbar cta fa icon side
    $wp_customize->add_control(
			new Skyrocket_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'understrap_builder_navbar_cta_fa_icon_side',
				array(
					'label'       => __( 'Navbar CTA Icon Side', 'understrap-builder' ),
					'description' => __( 'Set the icon to appear on left or right side of CTA.', 'understrap-builder' ),
					'section'     => 'understrap_builder_navbar_options',
					'settings'    => 'understrap_builder_navbar_cta_fa_icon_side',
          'choices'     => array(
						'left'          => __( 'Left', 'understrap-builder' ),
            'right'         => __( 'Right (default)', 'understrap-builder' )
					),
					'priority'    => '34',
          'active_callback' => function ($control) {
            return $control->manager->get_setting("understrap_builder_navbar_cta_show")->value()!=0;
          }
				)
			)
		);
      
    // Theme layout submenu type control
    $wp_customize->add_control(
			new Skyrocket_Image_Radio_Button_Custom_Control(
				$wp_customize,
				'understrap_builder_submenu_type',
				array(
					'label'       => __( 'Submenu', 'understrap-builder' ),
					'description' => __( 'Choose to show a submenu and type.', 'understrap-builder' ),
					'section'     => 'understrap_builder_navbar_submenu',
					'settings'    => 'understrap_builder_submenu_type',
          'input_attrs' => array('tooltip' => 'above'),
					'choices'     => array(
            'none' => array(
              'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/submenu-disabled.png',
              'name' => __( 'None', 'understrap-builder' )
            ),
            'center' => array(
              'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/submenu-center.png',
              'name' => __( 'Center Align', 'understrap-builder' )
            ),
            'left' => array(
              'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/submenu-left.png',
              'name' => __( 'Left Align', 'understrap-builder' )
            ),
            'right' => array(
              'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/submenu-right.png',
              'name' => __( 'Right Align', 'understrap-builder' )
            )
					),
					'priority'    => '36',
				)
			)
		);
    
    // Theme submenu link width control
    $wp_customize->add_control(
			new Skyrocket_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'understrap_builder_submenu_link_width',
				array(
					'label'       => __( 'Submenu Link Width', 'understrap-builder' ),
					'description' => __( 'Choose the width of the submenu links.', 'understrap-builder' ),
					'section'     => 'understrap_builder_navbar_submenu',
					'settings'    => 'understrap_builder_submenu_link_width',
					'choices'     => array(
						'thin'         => __( 'Thin', 'understrap-builder' ),
            'medium'       => __( 'Medium', 'understrap-builder' ),
            'wide'         => __( 'Wide', 'understrap-builder' ),
            'fill'         => __( 'Fill Submenu', 'understrap-builder' ),
					),
					'priority'    => '38',
          'active_callback' => function ($control) {
            return $control->manager->get_setting("understrap_builder_submenu_type")->value()!='none';
          }
				)
			)
		);
    
    // Theme submenu show on mobile
    $wp_customize->add_control(
			new Skyrocket_Toggle_Switch_Custom_control(
				$wp_customize,
				'understrap_builder_submenu_mobile_show',
				array(
					'label'       => __( 'Show Submenu On Mobile', 'understrap-builder' ),
					'description' => __( 'Choose to show the submenu on mobile screens.', 'understrap-builder' ),
					'section'     => 'understrap_builder_navbar_submenu',
					'settings'    => 'understrap_builder_submenu_mobile_show',
					'priority'    => '40',
          'active_callback' => function ($control) {
            return $control->manager->get_setting("understrap_builder_submenu_type")->value()!='none';
          }
				)
			)
		);
    
    // Theme submenu show on home page
    $wp_customize->add_control(
			new Skyrocket_Toggle_Switch_Custom_control(
				$wp_customize,
				'understrap_builder_submenu_home_show',
				array(
					'label'       => __( 'Show Submenu On Home Page', 'understrap-builder' ),
					'description' => __( 'Choose to show the submenu on the home page.', 'understrap-builder' ),
					'section'     => 'understrap_builder_navbar_submenu',
					'settings'    => 'understrap_builder_submenu_home_show',
					'priority'    => '42',
          'active_callback' => function ($control) {
            return $control->manager->get_setting("understrap_builder_submenu_type")->value()!='none';
          }
				)
			)
		);
    
    // Theme submenu link width control
    $wp_customize->add_control(
			new Skyrocket_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'understrap_builder_submenu_color_scheme',
				array(
					'label'       => __( 'Submenu Color Scheme', 'understrap-builder' ),
					'description' => __( 'Choose the submenu Bootstrap color scheme.', 'understrap-builder' ),
					'section'     => 'understrap_builder_navbar_submenu',
					'settings'    => 'understrap_builder_submenu_color_scheme',
					'choices'     => array(
						'navbar-dark'       => __( 'Dark [Light Text] [.bg-dark]', 'understrap-builder' ),
            'navbar-light'      => __( 'Light [Dark Text] [.bg-light]', 'understrap-builder' )
					),
					'priority'    => '44',
          'active_callback' => function ($control) {
            return $control->manager->get_setting("understrap_builder_submenu_type")->value()!='none';
          }
				)
			)
		);
    
    // Theme submenu show on mobile
    $wp_customize->add_control(
			new Skyrocket_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'understrap_builder_submenu_bg_color',
				array(
					'label'       => __( 'Submenu Background Color', 'understrap-builder' ),
					'description' => __( 'Choose the submenu Bootstrap background class.', 'understrap-builder' ),
					'section'     => 'understrap_builder_navbar_submenu',
					'settings'    => 'understrap_builder_submenu_bg_color',
					'choices'     => array(
						'bg-primary'       => __( 'Primary [.bg-primary]', 'understrap-builder' ),
            'bg-secondary'     => __( 'Secondary [.bg-secondary]', 'understrap-builder' ),
            'bg-success'       => __( 'Success [.bg-success]', 'understrap-builder' ),
            'bg-danger'        => __( 'Danger [.bg-danger]', 'understrap-builder' ),
            'bg-warning'       => __( 'Warning [.bg-warning]', 'understrap-builder' ),
            'bg-info'          => __( 'Info [.bg-info]', 'understrap-builder' ),
            'bg-light'         => __( 'Light [.bg-light]', 'understrap-builder' ),
            'bg-dark'          => __( 'Dark [.bg-dark]', 'understrap-builder' ),
            ''                 => __( 'Transparent', 'understrap-builder' ),
					),
					'priority'    => '46',
          'active_callback' => function ($control) {
            return $control->manager->get_setting("understrap_builder_submenu_type")->value()!='none';
          }
				)
			)
		);
    
    
    // Theme dropdown border or not
    $wp_customize->add_control(
			new Skyrocket_Toggle_Switch_Custom_control(
				$wp_customize,
				'understrap_builder_navbar_dropdown_border_on',
				array(
					'label'       => __( 'Dropdown Border Display', 'understrap-builder' ),
					'description' => __( 'Show a border around the dropdown menus.', 'understrap-builder' ),
					'section'     => 'understrap_builder_navbar_dropdowns',
					'settings'    => 'understrap_builder_navbar_dropdown_border_on',
					'priority'    => '5'
				)
			)
		);
    
    // Theme dropdown border radius
    $wp_customize->add_control(
			new Skyrocket_Slider_Custom_Control(
				$wp_customize,
				'understrap_builder_navbar_dropdown_border_radius',
				array(
					'label'       => __( 'Dropdown Border Radius', 'understrap-builder' ),
					'description' => __( 'Alter the border corner radius in pixels.', 'understrap-builder' ),
					'section'     => 'understrap_builder_navbar_dropdowns',
					'settings'    => 'understrap_builder_navbar_dropdown_border_radius',
          'input_attrs' => array(
            'min' => 0,
            'max' => 25,
            'step' => 1,
          ),
					'priority'    => '8'
				)
			)
		);
    
    // Theme dropdown bg color
    $wp_customize->add_control(
			new Skyrocket_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'understrap_builder_navbar_dropdown_bg',
				array(
					'label'       => __( 'Dropdown Background Color', 'understrap-builder' ),
					'description' => __( 'Choose a Bootstrap class for dropdown color, or select Custom to open a color picker up.', 'understrap-builder' ),
					'section'     => 'understrap_builder_navbar_dropdowns',
					'settings'    => 'understrap_builder_navbar_dropdown_bg',
					'choices'     => array(
						''                 => __( 'Default', 'understrap-builder' ),
            'primary'       => __( 'Primary [.bg-primary]', 'understrap-builder' ),
            'secondary'     => __( 'Secondary [.bg-secondary]', 'understrap-builder' ),
            'success'       => __( 'Success [.bg-success]', 'understrap-builder' ),
            'danger'        => __( 'Danger [.bg-danger]', 'understrap-builder' ),
            'warning'       => __( 'Warning [.bg-warning]', 'understrap-builder' ),
            'info'          => __( 'Info [.bg-info]', 'understrap-builder' ),
            'light'         => __( 'Light [.bg-light]', 'understrap-builder' ),
            'dark'          => __( 'Dark [.bg-dark]', 'understrap-builder' ),
            'custom'           => __( 'Custom', 'understrap-builder' )
					),
					'priority'    => '10'
				)
			)
		);
    
    // Theme custom color for dropdown background
    $wp_customize->add_control(
      new WP_Customize_Color_Control(
        $wp_customize,
        'understrap_builder_navbar_dropdown_custom_bg',
        array(
          'label'       => __( 'Custom Dropdown Background', 'understrap-builder' ),
          'description' => __( 'Non Bootstrap custom dropdown color.', 'understrap-builder' ),
          'section'     => 'understrap_builder_navbar_dropdowns',
          'settings'    => 'understrap_builder_navbar_dropdown_custom_bg',
          'priority'    => '20',
          'active_callback' => function ($control) {
            return $control->manager->get_setting("understrap_builder_navbar_dropdown_bg")->value()=='custom';
          }
        )
      )
    );
    
    // Theme dropdown border color
    $wp_customize->add_control(
			new Skyrocket_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'understrap_builder_navbar_dropdown_border',
				array(
					'label'       => __( 'Dropdown Border Color', 'understrap-builder' ),
					'description' => __( 'Choose a Bootstrap class for dropdown border color, or select Custom to open a color picker up.', 'understrap-builder' ),
					'section'     => 'understrap_builder_navbar_dropdowns',
					'settings'    => 'understrap_builder_navbar_dropdown_border',
					'choices'     => array(
						''                 => __( 'Default', 'understrap-builder' ),
            'primary'       => __( 'Primary [.bg-primary]', 'understrap-builder' ),
            'secondary'     => __( 'Secondary [.bg-secondary]', 'understrap-builder' ),
            'success'       => __( 'Success [.bg-success]', 'understrap-builder' ),
            'danger'        => __( 'Danger [.bg-danger]', 'understrap-builder' ),
            'warning'       => __( 'Warning [.bg-warning]', 'understrap-builder' ),
            'info'          => __( 'Info [.bg-info]', 'understrap-builder' ),
            'light'         => __( 'Light [.bg-light]', 'understrap-builder' ),
            'dark'          => __( 'Dark [.bg-dark]', 'understrap-builder' ),
            'custom'           => __( 'Custom', 'understrap-builder' )
					),
					'priority'    => '30'
				)
			)
		);
    
    // Theme custom color for dropdown border
    $wp_customize->add_control(
      new WP_Customize_Color_Control(
        $wp_customize,
        'understrap_builder_navbar_dropdown_custom_border',
        array(
          'label'       => __( 'Custom Dropdown Border Color', 'understrap-builder' ),
          'description' => __( 'Non Bootstrap custom dropdown border color.', 'understrap-builder' ),
          'section'     => 'understrap_builder_navbar_dropdowns',
          'settings'    => 'understrap_builder_navbar_dropdown_custom_border',
          'priority'    => '40',
          'active_callback' => function ($control) {
            return $control->manager->get_setting("understrap_builder_navbar_dropdown_border")->value()=='custom';
          }
        )
      )
    );
    
    // Theme dropdown link color
    $wp_customize->add_control(
			new Skyrocket_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'understrap_builder_navbar_dropdown_link',
				array(
					'label'       => __( 'Dropdown Link Color', 'understrap-builder' ),
					'description' => __( 'Choose a Bootstrap class for dropdown link color, or select Custom to open a color picker up.', 'understrap-builder' ),
					'section'     => 'understrap_builder_navbar_dropdowns',
					'settings'    => 'understrap_builder_navbar_dropdown_link',
					'choices'     => array(
						''                 => __( 'Default', 'understrap-builder' ),
            'primary'       => __( 'Primary [.bg-primary]', 'understrap-builder' ),
            'secondary'     => __( 'Secondary [.bg-secondary]', 'understrap-builder' ),
            'success'       => __( 'Success [.bg-success]', 'understrap-builder' ),
            'danger'        => __( 'Danger [.bg-danger]', 'understrap-builder' ),
            'warning'       => __( 'Warning [.bg-warning]', 'understrap-builder' ),
            'info'          => __( 'Info [.bg-info]', 'understrap-builder' ),
            'light'         => __( 'Light [.bg-light]', 'understrap-builder' ),
            'dark'          => __( 'Dark [.bg-dark]', 'understrap-builder' ),
            'custom'           => __( 'Custom', 'understrap-builder' )
					),
					'priority'    => '50'
				)
			)
		);
    
    // Theme custom color for dropdown background
    $wp_customize->add_control(
      new WP_Customize_Color_Control(
        $wp_customize,
        'understrap_builder_navbar_dropdown_custom_link',
        array(
          'label'       => __( 'Custom Dropdown Link Color', 'understrap-builder' ),
          'description' => __( 'Non Bootstrap custom dropdown link color.', 'understrap-builder' ),
          'section'     => 'understrap_builder_navbar_dropdowns',
          'settings'    => 'understrap_builder_navbar_dropdown_custom_link',
          'priority'    => '60',
          'active_callback' => function ($control) {
            return $control->manager->get_setting("understrap_builder_navbar_dropdown_link")->value()=='custom';
          }
        )
      )
    );
    
    // Theme dropdown link color
    $wp_customize->add_control(
			new Skyrocket_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'understrap_builder_navbar_dropdown_link_hover',
				array(
					'label'       => __( 'Dropdown Link Hover Color', 'understrap-builder' ),
					'description' => __( 'Choose a Bootstrap class for dropdown link hover color, or select Custom to open a color picker up.', 'understrap-builder' ),
					'section'     => 'understrap_builder_navbar_dropdowns',
					'settings'    => 'understrap_builder_navbar_dropdown_link_hover',
					'choices'     => array(
						''                 => __( 'Default', 'understrap-builder' ),
            'primary'       => __( 'Primary [.bg-primary]', 'understrap-builder' ),
            'secondary'     => __( 'Secondary [.bg-secondary]', 'understrap-builder' ),
            'success'       => __( 'Success [.bg-success]', 'understrap-builder' ),
            'danger'        => __( 'Danger [.bg-danger]', 'understrap-builder' ),
            'warning'       => __( 'Warning [.bg-warning]', 'understrap-builder' ),
            'info'          => __( 'Info [.bg-info]', 'understrap-builder' ),
            'light'         => __( 'Light [.bg-light]', 'understrap-builder' ),
            'dark'          => __( 'Dark [.bg-dark]', 'understrap-builder' ),
            'custom'           => __( 'Custom', 'understrap-builder' )
					),
					'priority'    => '70'
				)
			)
		);
    
    // Theme custom color for dropdown background
    $wp_customize->add_control(
      new WP_Customize_Color_Control(
        $wp_customize,
        'understrap_builder_navbar_dropdown_custom_link_hover',
        array(
          'label'       => __( 'Custom Dropdown Link Hover Color', 'understrap-builder' ),
          'description' => __( 'Non Bootstrap custom dropdown link hover color.', 'understrap-builder' ),
          'section'     => 'understrap_builder_navbar_dropdowns',
          'settings'    => 'understrap_builder_navbar_dropdown_custom_link_hover',
          'priority'    => '80',
          'active_callback' => function ($control) {
            return $control->manager->get_setting("understrap_builder_navbar_dropdown_link_hover")->value()=='custom';
          }
        )
      )
    );
    
    // Theme dropdown background hover link color
    $wp_customize->add_control(
			new Skyrocket_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'understrap_builder_navbar_dropdown_bg_hover',
				array(
					'label'       => __( 'Dropdown Link Hover Background', 'understrap-builder' ),
					'description' => __( 'Choose a Bootstrap class for dropdown link hover background, or select Custom to open a color picker up.', 'understrap-builder' ),
					'section'     => 'understrap_builder_navbar_dropdowns',
					'settings'    => 'understrap_builder_navbar_dropdown_bg_hover',
					'choices'     => array(
						''                 => __( 'Default', 'understrap-builder' ),
            'primary'       => __( 'Primary [.bg-primary]', 'understrap-builder' ),
            'secondary'     => __( 'Secondary [.bg-secondary]', 'understrap-builder' ),
            'success'       => __( 'Success [.bg-success]', 'understrap-builder' ),
            'danger'        => __( 'Danger [.bg-danger]', 'understrap-builder' ),
            'warning'       => __( 'Warning [.bg-warning]', 'understrap-builder' ),
            'info'          => __( 'Info [.bg-info]', 'understrap-builder' ),
            'light'         => __( 'Light [.bg-light]', 'understrap-builder' ),
            'dark'          => __( 'Dark [.bg-dark]', 'understrap-builder' ),
            'transparent'   => __( 'Transparent', 'understrap-builder' ),
            'custom'        => __( 'Custom', 'understrap-builder' )
					),
					'priority'    => '90'
				)
			)
		);
    
    // Theme custom color for dropdown hover background
    $wp_customize->add_control(
      new WP_Customize_Color_Control(
        $wp_customize,
        'understrap_builder_navbar_dropdown_custom_bg_hover',
        array(
          'label'       => __( 'Custom Dropdown Link Hover Background', 'understrap-builder' ),
          'description' => __( 'Non Bootstrap custom dropdown link hover color.', 'understrap-builder' ),
          'section'     => 'understrap_builder_navbar_dropdowns',
          'settings'    => 'understrap_builder_navbar_dropdown_custom_bg_hover',
          'priority'    => '100',
          'active_callback' => function ($control) {
            return $control->manager->get_setting("understrap_builder_navbar_dropdown_bg_hover")->value()=='custom';
          }
        )
      )
    );
    
    
    // Theme navbar scroll effects switch on
    /*$wp_customize->add_control(
      new Skyrocket_Toggle_Switch_Custom_control(
        $wp_customize,
        'understrap_builder_navbar_scroll_switch',
        array(
          'label'       => __( 'Show Navbar Scroll Effect', 'understrap-builder' ),
          'description' => __( 'Turn the navbar scroll effects on/off.', 'understrap-builder' ),
          'section'     => 'understrap_builder_navbar_scroll',
          'settings'    => 'understrap_builder_navbar_scroll_switch',
          'priority'    => '5'
        )
      )
    );*/
    
    
    
    
    // Theme layout container control
    $wp_customize->add_control(
			new Skyrocket_Image_Radio_Button_Custom_Control(
				$wp_customize,
				'understrap_builder_container_type',
				array(
					'label'       => __( 'Default Container Type', 'understrap-builder' ),
					'description' => __( 'Bootstrap container type for boxed or full width.', 'understrap-builder' ),
					'section'     => 'understrap_builder_layout_options',
					'settings'    => 'understrap_builder_container_type',
          'input_attrs' => array('tooltip' => 'below'),
					'choices'     => array(
                'container' => array(
                  'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/sidebar-both.png',
                  'name' => __( 'Fixed Width [".container"]' )
                ),
                'container-fluid' => array(
                  'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/sidebar-none.png',
                  'name' => __( 'Full Width [".container-fluid]' )
                )
					),
					'priority'    => '10',
				)
			)
		);
    
    // Theme layout container width control
    $wp_customize->add_control(
			new Skyrocket_Slider_Custom_Control(
				$wp_customize,
				'understrap_builder_container_width',
				array(
					'label'       => __( 'Container Width (px)', 'understrap-builder' ),
					'description' => __( 'Bootstrap container width in pixels.', 'understrap-builder' ),
					'section'     => 'understrap_builder_layout_options',
					'settings'    => 'understrap_builder_container_width',
          'input_attrs' => array(
              'min' => 500,
              'max' => 1500,
              'step' => 1,
          ),
					'priority'    => '20',
				)
			)
		);
    
    // Theme layout page container control
    $wp_customize->add_control(
			new Skyrocket_Image_Radio_Button_Custom_Control(
				$wp_customize,
				'understrap_builder_container_page_type',
				array(
					'label'       => __( 'Page Container Type', 'understrap-builder' ),
					'description' => __( 'Bootstrap page container type for boxed or full width.', 'understrap-builder' ),
					'section'     => 'understrap_builder_layout_options',
					'settings'    => 'understrap_builder_container_page_type',
          'input_attrs' => array('tooltip' => 'below'),
					'choices'     => array(
						  'default' => array(
                'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/square-default.png',
                'name' => __( 'Same as Default' )
              ),
              'container' => array(
                'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/sidebar-both.png',
                'name' => __( 'Fixed Width [".container"]' )
              ),
              'container-fluid' => array(
                'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/sidebar-none.png',
                'name' => __( 'Full Width [".container-fluid]' )
              )
					),
					'priority'    => '30',
				)
			)
		);
    
    // Theme layout single post container control
    $wp_customize->add_control(
			new Skyrocket_Image_Radio_Button_Custom_Control(
				$wp_customize,
				'understrap_builder_container_single_type',
				array(
					'label'       => __( 'Post Container Type', 'understrap-builder' ),
					'description' => __( 'Bootstrap post container type for boxed or full width.', 'understrap-builder' ),
					'section'     => 'understrap_builder_layout_options',
					'settings'    => 'understrap_builder_container_single_type',
          'input_attrs' => array('tooltip' => 'below'),
					'choices'     => array(
						  'default' => array(
                'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/square-default.png',
                'name' => __( 'Same as Default' )
              ),
              'container' => array(
                'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/sidebar-both.png',
                'name' => __( 'Fixed Width [".container"]' )
              ),
              'container-fluid' => array(
                'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/sidebar-none.png',
                'name' => __( 'Full Width [".container-fluid]' )
              )
					),
					'priority'    => '40',
				)
			)
		);
    
    // Theme layout post archive container control
    $wp_customize->add_control(
			new Skyrocket_Image_Radio_Button_Custom_Control(
				$wp_customize,
				'understrap_builder_container_archive_type',
				array(
					'label'       => __( 'Archive Container Type', 'understrap-builder' ),
					'description' => __( 'Bootstrap archive container type for boxed or full width.', 'understrap-builder' ),
					'section'     => 'understrap_builder_layout_options',
					'settings'    => 'understrap_builder_container_archive_type',
          'input_attrs' => array('tooltip' => 'below'),
					'choices'     => array(
						  'default' => array(
                'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/square-default.png',
                'name' => __( 'Same as Default' )
              ),
              'container' => array(
                'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/sidebar-both.png',
                'name' => __( 'Fixed Width [".container"]' )
              ),
              'container-fluid' => array(
                'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/sidebar-none.png',
                'name' => __( 'Full Width [".container-fluid]' )
              )
					),
					'priority'    => '50',
				)
			)
		);
    
    // Theme layout header container control
    $wp_customize->add_control(
			new Skyrocket_Image_Radio_Button_Custom_Control(
				$wp_customize,
				'understrap_builder_container_header_type',
				array(
					'label'       => __( 'Header Container Type', 'understrap-builder' ),
					'description' => __( 'Bootstrap header container type for boxed or full width.', 'understrap-builder' ),
					'section'     => 'understrap_builder_layout_options',
					'settings'    => 'understrap_builder_container_header_type',
          'input_attrs' => array('tooltip' => 'below'),
					'choices'     => array(
						  'default' => array(
                'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/square-default.png',
                'name' => __( 'Same as Default' )
              ),
              'container' => array(
                'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/sidebar-both.png',
                'name' => __( 'Fixed Width [".container"]' )
              ),
              'container-fluid' => array(
                'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/sidebar-none.png',
                'name' => __( 'Full Width [".container-fluid]' )
              )
					),
					'priority'    => '60',
				)
			)
		);
    
    // Theme layout footer container control
    $wp_customize->add_control(
			new Skyrocket_Image_Radio_Button_Custom_Control(
				$wp_customize,
				'understrap_builder_container_footer_type',
				array(
					'label'       => __( 'Footer Container Type', 'understrap-builder' ),
					'description' => __( 'Bootstrap footer container type for boxed or full width.', 'understrap-builder' ),
					'section'     => 'understrap_builder_layout_options',
					'settings'    => 'understrap_builder_container_footer_type',
          'choices'     => array(
            'default' => array(
              'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/square-default.png',
              'name' => __( 'Same as Default' )
            ),
            'container' => array(
              'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/sidebar-both.png',
              'name' => __( 'Fixed Width [".container"]' )
            ),
            'container-fluid' => array(
              'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/sidebar-none.png',
              'name' => __( 'Full Width [".container-fluid]' )
            )
					),
					'priority'    => '70',
				)
			)
		);
  
    
    // Theme spacings navbar - navbar
    $wp_customize->add_control(
			new BUILDER_Customize_Spacings_Control(
				$wp_customize,
				'understrap_builder_spacings_navbar',
				array(
					'label'       => __( 'Navbar', 'understrap-builder' ),
					'description' => __( 'Alter the spacing around the navbar.', 'understrap-builder' ),
					'section'     => 'understrap_builder_spacings_navbar_section',
					'settings'    => 'understrap_builder_spacings_navbar',
					'priority'    => '10'
				)
			)
		);
    
    // Theme spacings navbar - submenu
    $wp_customize->add_control(
			new BUILDER_Customize_Spacings_Control(
				$wp_customize,
				'understrap_builder_spacings_navbar_submenu',
				array(
					'label'       => __( 'Submenu', 'understrap-builder' ),
					'description' => __( 'Alter the spacing around the navbar submenu.', 'understrap-builder' ),
					'section'     => 'understrap_builder_spacings_navbar_section',
					'settings'    => 'understrap_builder_spacings_navbar_submenu',
					'priority'    => '20',
          'active_callback' => function ($control) {
            return $control->manager->get_setting("understrap_builder_submenu_type")->value()!='none';
          }
				)
			)
		);
    
    // Theme spacings navbar - logo
    $wp_customize->add_control(
			new BUILDER_Customize_Spacings_Control(
				$wp_customize,
				'understrap_builder_spacings_navbar_logo',
				array(
					'label'       => __( 'Logo / Site Title', 'understrap-builder' ),
					'description' => __( 'Alter the spacing around the navbar branding.', 'understrap-builder' ),
					'section'     => 'understrap_builder_spacings_navbar_section',
					'settings'    => 'understrap_builder_spacings_navbar_logo',
					'priority'    => '30'
				)
			)
		);
    
    // Theme spacings footer - footer widgets
    $wp_customize->add_control(
			new BUILDER_Customize_Spacings_Control(
				$wp_customize,
				'understrap_builder_spacings_footer_widgets',
				array(
					'label'       => __( 'Footer Widgets', 'understrap-builder' ),
					'description' => __( 'Alter the spacing around the footer widgets.', 'understrap-builder' ),
					'section'     => 'understrap_builder_spacings_footer_section',
					'settings'    => 'understrap_builder_spacings_footer_widgets',
					'priority'    => '10',
          'active_callback' => function ($control) {
            return $control->manager->get_setting("understrap_builder_footer_widgets_enable")->value()==1;
          }
				)
			)
		);
    
    // Theme spacings footer - footer menu
    $wp_customize->add_control(
			new BUILDER_Customize_Spacings_Control(
				$wp_customize,
				'understrap_builder_spacings_footer_menu',
				array(
					'label'       => __( 'Footer Menu', 'understrap-builder' ),
					'description' => __( 'Alter the spacing around the footer menu.', 'understrap-builder' ),
					'section'     => 'understrap_builder_spacings_footer_section',
					'settings'    => 'understrap_builder_spacings_footer_menu',
					'priority'    => '20'
				)
			)
		);
    
    // Theme spacings footer - footer text bar
    $wp_customize->add_control(
			new BUILDER_Customize_Spacings_Control(
				$wp_customize,
				'understrap_builder_spacings_footer_text_bar',
				array(
					'label'       => __( 'Footer Text Bar', 'understrap-builder' ),
					'description' => __( 'Alter the spacing around the footer text bar.', 'understrap-builder' ),
					'section'     => 'understrap_builder_spacings_footer_section',
					'settings'    => 'understrap_builder_spacings_footer_text_bar',
					'priority'    => '30'
				)
			)
		);
    
    // Theme comments upgrade message control
		$wp_customize->add_control( new Skyrocket_Simple_Notice_Custom_control( $wp_customize, 'understrap_builder_spacings_breadcrumbs_pro',
	array(
		'label' => __( 'Simple Notice Control' ),
		'description' => __('This Custom Control allows you to display a simple title and description to your users. You can even include <a href="http://google.com" target="_blank">basic html</a>.' ),
		'section'     => 'understrap_builder_spacings_breadcrumbs_section',
	)
) );
    
    // Theme comments upgrade message control
    $wp_customize->add_control(
			new BUILDER_Customize_upgrade_Control(
				$wp_customize,
				'understrap_builder_spacings_headers_pro',
				array(
					'label'       => __( 'Available In PRO', 'understrap-builder' ),
					'description' => __( 'Upgrade your BUILDER to PRO to gain access.', 'understrap-builder' ),
					'section'     => 'understrap_builder_spacings_headers_section',
					'settings'    => 'understrap_builder_spacings_headers_pro',
          'type'        => 'button',
					'priority'    => '5',
				)
			)
		);
    
    // Theme comments upgrade message control
    $wp_customize->add_control(
			new BUILDER_Customize_upgrade_Control(
				$wp_customize,
				'understrap_builder_spacings_author_pro',
				array(
					'label'       => __( 'Available In PRO', 'understrap-builder' ),
					'description' => __( 'Upgrade your BUILDER to PRO to gain access.', 'understrap-builder' ),
					'section'     => 'understrap_builder_spacings_author_section',
					'settings'    => 'understrap_builder_spacings_author_pro',
          'type'        => 'button',
					'priority'    => '5',
				)
			)
		);
    
    // Theme comments upgrade message control
    $wp_customize->add_control(
			new BUILDER_Customize_upgrade_Control(
				$wp_customize,
				'understrap_builder_spacings_comments_pro',
				array(
					'label'       => __( 'Available In PRO', 'understrap-builder' ),
					'description' => __( 'Upgrade your BUILDER to PRO to gain access.', 'understrap-builder' ),
					'section'     => 'understrap_builder_spacings_comments_section',
					'settings'    => 'understrap_builder_spacings_comments_pro',
          'type'        => 'button',
					'priority'    => '5',
				)
			)
		);
    
    // Theme comments upgrade message control
    $wp_customize->add_control(
			new BUILDER_Customize_upgrade_Control(
				$wp_customize,
				'understrap_builder_spacings_single_pro',
				array(
					'label'       => __( 'Available In PRO', 'understrap-builder' ),
					'description' => __( 'Upgrade your BUILDER to PRO to gain access.', 'understrap-builder' ),
					'section'     => 'understrap_builder_spacings_single_section',
					'settings'    => 'understrap_builder_spacings_single_pro',
          'type'        => 'button',
					'priority'    => '5',
				)
			)
		);
    
    // Theme comments upgrade message control
    $wp_customize->add_control(
			new BUILDER_Customize_upgrade_Control(
				$wp_customize,
				'understrap_builder_spacings_page_pro',
				array(
					'label'       => __( 'Available In PRO', 'understrap-builder' ),
					'description' => __( 'Upgrade your BUILDER to PRO to gain access.', 'understrap-builder' ),
					'section'     => 'understrap_builder_spacings_page_section',
					'settings'    => 'understrap_builder_spacings_page_pro',
          'type'        => 'button',
					'priority'    => '5',
				)
			)
		);
    
    
    
    // Theme layout BS color BG classes stick with defaults - hides lots of options
    $wp_customize->add_control(
			new Skyrocket_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'understrap_builder_bs_color_default',
				array(
					'label'       => __( 'Use Default Bootstrap Colors', 'understrap-builder' ),
					'description' => __( 'Use default built in Bootstrap colors on site. (refresh after changes to update live color choices in other Customizer sections)', 'understrap-builder' ),
					'section'     => 'understrap_builder_bs_colors_options',
					'settings'    => 'understrap_builder_bs_color_default',
					'choices'     => array(
						'default'       => __( 'Default', 'understrap-builder' ),
            'custom'        => __( 'Custom [Opens Color Pickers]', 'understrap-builder' )
					),
					'priority'    => '5',
				)
			)
		);
    
    // Theme layout BS color classes controls
    foreach($us_b_potential_bootstrap_color_classes as $bs_color => $bs_color_default){
      
      $bs_color_lower = strtolower($bs_color);
      $bs_index = 1;

      $wp_customize->add_control(
        new WP_Customize_Color_Control(
          $wp_customize,
          'understrap_builder_bs_color_'.$bs_color_lower,
          array(
            'label'       => __( $bs_color, 'understrap-builder' ),
            'description' => __( 'Bootstrap class - '.$bs_color_lower.' color.', 'understrap-builder' ),
            'section'     => 'understrap_builder_bs_colors_options',
            'settings'    => 'understrap_builder_bs_color_'.$bs_color_lower,
            'priority'    => 5+(($bs_index++)*5),
            'active_callback' => function ($control) {
              return $control->manager->get_setting("understrap_builder_bs_color_default")->value()=='custom';
            }
          )
        )
      );
    }
    
    
    // Theme default font control
    $wp_customize->add_control(
			new Skyrocket_Google_Font_Select_Custom_Control(
				$wp_customize,
				'understrap_builder_typography_default_font',
				array(
					'label'       => __( 'Default Font', 'understrap-builder' ),
					'description' => __( 'The default font to use across the site.', 'understrap-builder' ),
					'section'     => 'understrap_builder_typography_options',
					'settings'    => 'understrap_builder_typography_default_font',
          'input_attrs' => array(
            'font_count' => 'all',
            'orderby' => 'alpha',
          ),
					'priority'    => '10',
				)
			)
		);
    
    // Theme default font size control
    $wp_customize->add_control(
			new Skyrocket_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'understrap_builder_typography_font_size',
				array(
					'label'       => __( 'Body Font Size', 'understrap-builder' ),
					'description' => __( 'The default font size to use across the site.', 'understrap-builder' ),
					'section'     => 'understrap_builder_typography_options',
					'settings'    => 'understrap_builder_typography_font_size',
          'choices'     => array(
						'0.625rem'       => __( '0.625rem', 'understrap-builder' ),
            '0.75rem'        => __( '0.75rem', 'understrap-builder' ),
						'0.875rem'       => __( '0.875rem', 'understrap-builder' ),
            '1rem'           => __( '1rem (default)', 'understrap-builder' ),
            '1.125rem'       => __( '1.125rem', 'understrap-builder' ),
            '1.25rem'        => __( '1.25rem', 'understrap-builder' ),
						'1.5rem'         => __( '1.5rem', 'understrap-builder' ),
            '1.875rem'       => __( '1.875rem', 'understrap-builder' ),
            '2rem'           => __( '2rem', 'understrap-builder' )
					),
					'priority'    => '15',
				)
			)
		);
    
    // Theme default line height
    $wp_customize->add_control(
			new Skyrocket_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'understrap_builder_typography_default_line_height',
				array(
					'label'       => __( 'Default Line Height', 'understrap-builder' ),
					'description' => __( 'The default line height to use across the site.', 'understrap-builder' ),
					'section'     => 'understrap_builder_typography_options',
					'settings'    => 'understrap_builder_typography_default_line_height',
					'choices'     => array(
              '1'           => __( '1', 'understrap-builder' ),  
              '1.25'        => __( '1.25', 'understrap-builder' ),
              '1.5'         => __( '1.5 (Default)', 'understrap-builder' ),
              '1.75'        => __( '1.75', 'understrap-builder' ),
              '2'           => __( '2', 'understrap-builder' ),
              '2.25'        => __( '2.25', 'understrap-builder' ),
              '2.5'         => __( '2.5', 'understrap-builder' ),
              '3'           => __( '3', 'understrap-builder' )
            ),
					'priority'    => '20',
				)
			)
		);
    
    // Theme default heading line height
    $wp_customize->add_control(
			new Skyrocket_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'understrap_builder_typography_default_p_margin_bottom',
				array(
					'label'       => __( 'Default paragraph margin bottom.', 'understrap-builder' ),
					'description' => __( 'The default paragraph margin bottom in pixels.', 'understrap-builder' ),
					'section'     => 'understrap_builder_typography_options',
					'settings'    => 'understrap_builder_typography_default_p_margin_bottom',
					'choices'     => array(
              '0rem'         => __( '0rem', 'understrap-builder' ), 
              '0.2rem'         => __( '0.2rem', 'understrap-builder' ),  
              '0.4rem'         => __( '0.4rem', 'understrap-builder' ),  
              '0.6rem'         => __( '0.6rem', 'understrap-builder' ),  
              '0.8rem'         => __( '0.8rem', 'understrap-builder' ),    
              '1rem'           => __( '1rem (Default)', 'understrap-builder' ),  
              '1.2rem'         => __( '1.2rem', 'understrap-builder' ),
              '1.4rem'         => __( '1.4rem', 'understrap-builder' ),
              '1.6rem'         => __( '1.6rem', 'understrap-builder' ),
              '1.8rem'         => __( '1.8rem', 'understrap-builder' )
            ),
					'priority'    => '25',
				)
			)
		);
    
    // Theme heading custom font or not control
    $wp_customize->add_control(
			new Skyrocket_Toggle_Switch_Custom_control(
				$wp_customize,
				'understrap_builder_typography_heading_font_custom',
				array(
					'label'       => __( 'Heading Font', 'understrap-builder' ),
					'description' => __( 'Use custom font for headings?', 'understrap-builder' ),
					'section'     => 'understrap_builder_typography_options',
					'settings'    => 'understrap_builder_typography_heading_font_custom',
					'priority'    => '30',
				)
			)
		);
    
    // Theme heading font control
    $wp_customize->add_control(
			new Skyrocket_Google_Font_Select_Custom_Control(
				$wp_customize,
				'understrap_builder_typography_heading_font',
				array(
					'label'       => __( 'Custom Heading Font', 'understrap-builder' ),
					'description' => __( 'The font to use on headings scross the site.', 'understrap-builder' ),
					'section'     => 'understrap_builder_typography_options',
					'settings'    => 'understrap_builder_typography_heading_font',
					'active_callback' => function ($control) {
            return $control->manager->get_setting("understrap_builder_typography_heading_font_custom")->value()==1;
          },
					'priority'    => '40',
				)
			)
		);
    
    // Theme default heading line height
    $wp_customize->add_control(
			new Skyrocket_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'understrap_builder_typography_default_heading_line_height',
				array(
					'label'       => __( 'Default Heading Line Height', 'understrap-builder' ),
					'description' => __( 'The default heading line height.', 'understrap-builder' ),
					'section'     => 'understrap_builder_typography_options',
					'settings'    => 'understrap_builder_typography_default_heading_line_height',
					'choices'     => array(
              '1'           => __( '1', 'understrap-builder' ),  
              '1.2'         => __( '1.2 (Default)', 'understrap-builder' ),
              '1.4'         => __( '1.4', 'understrap-builder' ),
              '1.6'         => __( '1.6', 'understrap-builder' ),
              '1.8'         => __( '1.8', 'understrap-builder' ),
              '2.'          => __( '2', 'understrap-builder' ),
              '2.5'         => __( '2.5', 'understrap-builder' ),
              '3'           => __( '3', 'understrap-builder' )
            ),
					'priority'    => '50',
				)
			)
		);
    
    // Theme heading font size default control
    $wp_customize->add_control(
			new Skyrocket_Toggle_Switch_Custom_control(
				$wp_customize,
				'understrap_builder_typography_heading_font_default',
				array(
					'label'       => __( 'Heading Font Sizes', 'understrap-builder' ),
					'description' => __( 'Use custom heading font sizes.', 'understrap-builder' ),
					'section'     => 'understrap_builder_typography_options',
					'settings'    => 'understrap_builder_typography_heading_font_default',
					'priority'    => '60',
				)
			)
		);
    
    // Theme heading font size picker control
    foreach($us_b_heading_sizes as $heading_size => $heading_size){
      $heading_size_lower = strtolower($heading_size);
      $hs_index = 1;
      $wp_customize->add_control(
        new WP_Customize_Control(
          $wp_customize,
          'understrap_builder_typography_heading_font_'.$heading_size_lower,
          array(
            'label'       => __( 'Custom '.$heading_size.' Font Size', 'understrap-builder' ),
            'description' => __( 'Font size for '.$heading_size.' tags.', 'understrap-builder' ),
            'section'     => 'understrap_builder_typography_options',
            'settings'    => 'understrap_builder_typography_heading_font_'.$heading_size_lower,
            'type'        => 'select',
            'choices'     => array(
              '0.75rem'        => __( '0.75rem', 'understrap-builder' ),
              '0.875rem'       => __( '0.875rem', 'understrap-builder' ),
              '1rem'           => __( '1rem', 'understrap-builder' ),
              '1.125rem'       => __( '1.125rem', 'understrap-builder' ),
              '1.25rem'        => __( '1.25rem', 'understrap-builder' ),
              '1.5rem'         => __( '1.5rem', 'understrap-builder' ),
              '1.75rem'         => __( '1.75rem', 'understrap-builder' ),
              '1.875rem'       => __( '1.875rem', 'understrap-builder' ),
              '2rem'           => __( '2rem', 'understrap-builder' ),
              '2.25rem'        => __( '2.25rem', 'understrap-builder' ),
              '2.5rem'         => __( '2.5rem', 'understrap-builder' ),
              '2.75rem'        => __( '2.75rem', 'understrap-builder' ),
              '3rem'           => __( '3rem', 'understrap-builder' ),
              '3.5rem'         => __( '3.5rem', 'understrap-builder' ),
              '3.75rem'        => __( '3.75rem', 'understrap-builder' ),
              '4rem'           => __( '4rem', 'understrap-builder' ),
            ),
            'active_callback' => function ($control) {
              return $control->manager->get_setting("understrap_builder_typography_heading_font_default")->value()==1;
            },
            'priority'    => 60+(($hs_index++)*5),
          )
        )
      );
    }
    
    
    // Theme link color
    $wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'understrap_builder_links_color',
				array(
					'label'       => __( 'Link Color', 'understrap-builder' ),
					'description' => __( 'Color of standard &lsaquo;a&rsaquo; links.', 'understrap-builder' ),
					'section'     => 'understrap_builder_links_options',
					'settings'    => 'understrap_builder_links_color',
					'priority'    => '10',
				)
			)
		);
    
    // Theme link text decoration
    $wp_customize->add_control(
			new Skyrocket_Image_Radio_Button_Custom_Control(
				$wp_customize,
				'understrap_builder_links_decoration',
				array(
					'label'       => __( 'Link Decoration', 'understrap-builder' ),
					'description' => __( 'Text decoration of standard &lsaquo;a&rsaquo; links.', 'understrap-builder' ),
					'section'     => 'understrap_builder_links_options',
					'settings'    => 'understrap_builder_links_decoration',
          'input_attrs' => array('tooltip' => 'below'),
          'choices'     => array(
              'underline' => array(
                'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/links-decoration-underline.png',
                'name' => __( 'Underline' )
              ),
              'overline' => array(
                'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/links-decoration-overline.png',
                'name' => __( 'Overline' )
              ),
              'line-through' => array(
                'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/links-decoration-strike.png',
                'name' => __( 'Line Through' )
              ),
              'none' => array(
                'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/links-decoration-none.png',
                'name' => __( 'None' )
              )
            ),
					'priority'    => '15',
				)
			)
		);
    
    // Theme link rollover color
    $wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'understrap_builder_links_rollover_color',
				array(
					'label'       => __( 'Link Rollover Color', 'understrap-builder' ),
					'description' => __( 'Color of standard &lsaquo;a&rsaquo; links rollover (hover).', 'understrap-builder' ),
					'section'     => 'understrap_builder_links_options',
					'settings'    => 'understrap_builder_links_rollover_color',
					'priority'    => '20',
				)
			)
		);
    
    // Theme link rollover weight
    $wp_customize->add_control(
			new Skyrocket_Image_Radio_Button_Custom_Control(
				$wp_customize,
				'understrap_builder_links_rollover_weight',
				array(
					'label'       => __( 'Link Rollover Weight', 'understrap-builder' ),
					'description' => __( 'Font weight of standard &lsaquo;a&rsaquo; links rollover (hover).', 'understrap-builder' ),
					'section'     => 'understrap_builder_links_options',
					'settings'    => 'understrap_builder_links_rollover_weight',
          'input_attrs' => array('tooltip' => 'below'),
          'choices'     => array(
              'lighter' => array(
                'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/links-weight-lighter.png',
                'name' => __( 'Lighter' )
              ),
              'normal' => array(
                'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/links-weight-regular.png',
                'name' => __( 'Normal (Default)' )
              ),
              'bold' => array(
                'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/links-weight-bold.png',
                'name' => __( 'Bold' )
              ),
              '900' => array(
                'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/links-decoration-none.png',
                'name' => __( 'Bolder' )
              )
            ),
					'priority'    => '30',
				)
			)
		);
    
    // Theme link rollover text decoration
    $wp_customize->add_control(
			new Skyrocket_Image_Radio_Button_Custom_Control(
				$wp_customize,
				'understrap_builder_links_rollover_decoration',
				array(
					'label'       => __( 'Link Rollover Decoration', 'understrap-builder' ),
					'description' => __( 'Text decoration of standard &lsaquo;a&rsaquo; links rollover (hover).', 'understrap-builder' ),
					'section'     => 'understrap_builder_links_options',
					'settings'    => 'understrap_builder_links_rollover_decoration',
          'input_attrs' => array('tooltip' => 'above'),
          'choices'     => array(
              'underline' => array(
                'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/links-decoration-underline.png',
                'name' => __( 'Underline', 'understrap-builder' )
              ),
              'overline' => array(
                'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/links-decoration-overline.png',
                'name' => __( 'Overline', 'understrap-builder' )
              ),
              'line-through' => array(
                'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/links-decoration-strike.png',
                'name' => __( 'Line Through', 'understrap-builder' )
              ),
              'none' => array(
                'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/links-decoration-none.png',
                'name' => __( 'None', 'understrap-builder' )
              )
            ),
					'priority'    => '40',
				)
			)
		);
    
    
    // Theme buttons curved borders
    $wp_customize->add_control(
			new Skyrocket_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'understrap_builder_buttons_curved_borders',
				array(
					'label'       => __( 'Curved Corners', 'understrap-builder' ),
					'description' => __( 'Size of curved corners.', 'understrap-builder' ),
					'section'     => 'understrap_builder_buttons_options',
					'settings'    => 'understrap_builder_buttons_curved_borders',
          'choices'     => array(
              '0'              => __( 'No Curved Corners', 'understrap-builder' ),
              '0.15rem'        => __( '0.15rem', 'understrap-builder' ),
              '0.25rem'        => __( '0.25rem (Default)', 'understrap-builder' ),
              '0.35rem'        => __( '0.35rem', 'understrap-builder' ),
              '0.45rem'        => __( '0.45rem', 'understrap-builder' ),
              '0.55rem'        => __( '0.55rem', 'understrap-builder' ),
              '0.75rem'        => __( '0.75rem', 'understrap-builder' ),
              '1rem'           => __( '1rem', 'understrap-builder' ),
              '1.5rem'         => __( '1.5rem', 'understrap-builder' ),
              '2rem'           => __( '2rem', 'understrap-builder' )
            ),
					'priority'    => '10',
				)
			)
		);
    
    // Theme buttons shadow effect
    $wp_customize->add_control(
			new Skyrocket_Image_Radio_Button_Custom_Control(
				$wp_customize,
				'understrap_builder_buttons_shadow',
				array(
					'label'       => __( 'Shadow', 'understrap-builder' ),
					'description' => __( 'Show a shadow behind buttons.', 'understrap-builder' ),
					'section'     => 'understrap_builder_buttons_options',
					'settings'    => 'understrap_builder_buttons_shadow',
          'input_attrs' => array('tooltip' => 'below'),
          'choices'     => array(
              'none' => array(
                'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/button-shadow-none.png',
                'name' => __( 'None', 'understrap-builder' )
              ),
              'sm' => array(
                'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/button-shadow-sm.png',
                'name' => __( 'Small Shadow', 'understrap-builder' )
              ),
              'md' => array(
                'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/button-shadow-md.png',
                'name' => __( 'Medium Shadow', 'understrap-builder' )
              ),
              'lg' => array(
                'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/button-shadow-lg.png',
                'name' => __( 'Large Shadow', 'understrap-builder' )
              )
            ),
					'priority'    => '20',
				)
			)
		);
    
    // Theme buttons rollover effect
    $wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'understrap_builder_buttons_rollover',
				array(
					'label'       => __( 'Rollover', 'understrap-builder' ),
					'description' => __( 'Show a button rollover effect.', 'understrap-builder' ),
					'section'     => 'understrap_builder_buttons_options',
					'settings'    => 'understrap_builder_buttons_rollover',
					'type'        => 'select',
          'choices'     => array(
              'none'           => __( "No Effect", 'understrap-builder' ),
              'brighten'       => __( 'Brighten', 'understrap-builder' ),
              'darken'         => __( 'Darken', 'understrap-builder' ),
              'transparent'    => __( 'Make Transparent', 'understrap-builder' ),
            ),
					'priority'    => '30',
				)
			)
		);
    
    
    // Theme hero upgrade message control
    $wp_customize->add_control(
			new BUILDER_Customize_upgrade_Control(
				$wp_customize,
				'understrap_builder_hero_upgrade_pro',
				array(
					'label'       => __( 'Available In PRO', 'understrap-builder' ),
					'description' => __( 'Upgrade your BUILDER to PRO to gain access.', 'understrap-builder' ),
					'section'     => 'understrap_builder_hero_options',
					'settings'    => 'understrap_builder_hero_upgrade_pro',
          'type'        => 'button',
					'priority'    => '5',
				)
			)
		);
    
    
    // Theme headers upgrade message control
    $wp_customize->add_control(
			new BUILDER_Customize_upgrade_Control(
				$wp_customize,
				'understrap_builder_headers_upgrade_pro',
				array(
					'label'       => __( 'Available In PRO', 'understrap-builder' ),
					'description' => __( 'Upgrade your BUILDER to PRO to gain access.', 'understrap-builder' ),
					'section'     => 'understrap_builder_headers_options',
					'settings'    => 'understrap_builder_headers_upgrade_pro',
          'type'        => 'button',
					'priority'    => '5',
				)
			)
		);
    
    
    // Theme breadcrumbs upgrade message control
    $wp_customize->add_control(
			new BUILDER_Customize_upgrade_Control(
				$wp_customize,
				'understrap_builder_breadcrumbs_upgrade_pro',
				array(
					'label'       => __( 'Available In PRO', 'understrap-builder' ),
					'description' => __( 'Upgrade your BUILDER to PRO to gain access.', 'understrap-builder' ),
					'section'     => 'understrap_builder_breadcrumbs_options',
					'settings'    => 'understrap_builder_breadcrumbs_upgrade_pro',
          'type'        => 'button',
					'priority'    => '5',
				)
			)
		);
    
    
    // Theme mobile upgrade message control
    $wp_customize->add_control(
			new BUILDER_Customize_upgrade_Control(
				$wp_customize,
				'understrap_builder_mobile_upgrade_pro',
				array(
					'label'       => __( 'Available In PRO', 'understrap-builder' ),
					'description' => __( 'Upgrade your BUILDER to PRO to gain access.', 'understrap-builder' ),
					'section'     => 'understrap_builder_mobile_options',
					'settings'    => 'understrap_builder_mobile_upgrade_pro',
          'type'        => 'button',
					'priority'    => '5',
				)
			)
		);
    
    
    // Theme archive upgrade message control
    $wp_customize->add_control(
			new BUILDER_Customize_upgrade_Control(
				$wp_customize,
				'understrap_builder_archives_upgrade_pro',
				array(
					'label'       => __( 'Available In PRO', 'understrap-builder' ),
					'description' => __( 'Upgrade your BUILDER to PRO to gain access.', 'understrap-builder' ),
					'section'     => 'understrap_builder_archives_options',
					'settings'    => 'understrap_builder_archives_upgrade_pro',
          'type'        => 'button',
					'priority'    => '5',
				)
			)
		);
    
    
    // Theme single post upgrade message control
    $wp_customize->add_control(
			new BUILDER_Customize_upgrade_Control(
				$wp_customize,
				'understrap_builder_single_post_upgrade_pro',
				array(
					'label'       => __( 'Available In PRO', 'understrap-builder' ),
					'description' => __( 'Upgrade your BUILDER to PRO to gain access.', 'understrap-builder' ),
					'section'     => 'understrap_builder_single_post_options',
					'settings'    => 'understrap_builder_single_post_upgrade_pro',
          'type'        => 'button',
					'priority'    => '5',
				)
			)
		);
    
    
    // Theme comments upgrade message control
    $wp_customize->add_control(
			new BUILDER_Customize_upgrade_Control(
				$wp_customize,
				'understrap_builder_comments_upgrade_pro',
				array(
					'label'       => __( 'Available In PRO', 'understrap-builder' ),
					'description' => __( 'Upgrade your BUILDER to PRO to gain access.', 'understrap-builder' ),
					'section'     => 'understrap_builder_comments_options',
					'settings'    => 'understrap_builder_comments_upgrade_pro',
          'type'        => 'button',
					'priority'    => '5',
				)
			)
		);
    
    
    // Theme author box upgrade message control
    $wp_customize->add_control(
			new BUILDER_Customize_upgrade_Control(
				$wp_customize,
				'understrap_builder_author_box_upgrade_pro',
				array(
					'label'       => __( 'Available In PRO', 'understrap-builder' ),
					'description' => __( 'Upgrade your BUILDER to PRO to gain access.', 'understrap-builder' ),
					'section'     => 'understrap_builder_author_box_options',
					'settings'    => 'understrap_builder_author_box_upgrade_pro',
          'type'        => 'button',
					'priority'    => '5',
				)
			)
		);
    
    
    // Theme sidebar choice default control
    $wp_customize->add_control(
			new Skyrocket_Image_Radio_Button_Custom_Control(
				$wp_customize,
				'understrap_builder_sidebars_show_default',
				array(
					'label'       => __( 'Sidebars To Show By Default', 'understrap-builder' ),
					'description' => __( 'Choose which sidebars to display across the site.', 'understrap-builder' ),
					'section'     => 'understrap_builder_sidebar_options',
					'settings'    => 'understrap_builder_sidebars_show_default',
          'input_attrs' => array('tooltip' => 'below'),
					'choices'     => array(
            'right' => array(
              'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/sidebar-right.png',
              'name' => __( 'Right', 'understrap-builder' ) 
            ),
            'left' => array(
              'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/sidebar-left.png',
              'name' => __( 'Right', 'understrap-builder' ) 
            ),
            'both' => array(
              'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/sidebar-both.png',
              'name' => __( 'Both', 'understrap-builder' ) 
            ),
            'none' => array(
              'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/sidebar-none.png',
              'name' => __( 'None', 'understrap-builder' ) 
            )
					),
					'priority'    => '10',
				)
			)
		);
    
    // Theme sidebar choice default control
    $wp_customize->add_control(
			new Skyrocket_Image_Radio_Button_Custom_Control(
				$wp_customize,
				'understrap_builder_sidebars_show_page',
				array(
					'label'       => __( 'Sidebars To Show On Pages', 'understrap-builder' ),
					'description' => __( 'Choose how to show sidebars on pages.', 'understrap-builder' ),
					'section'     => 'understrap_builder_sidebar_options',
					'settings'    => 'understrap_builder_sidebars_show_page',
          'input_attrs' => array('tooltip' => 'below'),
					'choices'     => array(
            'default' => array(
              'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/sidebar-default.png',
              'name' => __( 'Same As Default', 'understrap-builder' ) 
            ),
            'right' => array(
              'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/sidebar-right.png',
              'name' => __( 'Right', 'understrap-builder' ) 
            ),
            'left' => array(
              'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/sidebar-left.png',
              'name' => __( 'Right', 'understrap-builder' ) 
            ),
            'both' => array(
              'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/sidebar-both.png',
              'name' => __( 'Both', 'understrap-builder' ) 
            ),
            'none' => array(
              'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/sidebar-none.png',
              'name' => __( 'None', 'understrap-builder' ) 
            )
					),
					'priority'    => '20',
				)
			)
		);
    
    // Theme sidebar choice default control
    $wp_customize->add_control(
			new Skyrocket_Image_Radio_Button_Custom_Control(
				$wp_customize,
				'understrap_builder_sidebars_show_single',
				array(
					'label'       => __( 'Sidebars To Show On Posts', 'understrap-builder' ),
					'description' => __( 'Choose how to show sidebars on single posts.', 'understrap-builder' ),
					'section'     => 'understrap_builder_sidebar_options',
					'settings'    => 'understrap_builder_sidebars_show_single',
          'input_attrs' => array('tooltip' => 'below'),
					'choices'     => array(
            'default' => array(
              'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/sidebar-default.png',
              'name' => __( 'Same As Default', 'understrap-builder' ) 
            ),
            'right' => array(
              'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/sidebar-right.png',
              'name' => __( 'Right', 'understrap-builder' ) 
            ),
            'left' => array(
              'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/sidebar-left.png',
              'name' => __( 'Right', 'understrap-builder' ) 
            ),
            'both' => array(
              'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/sidebar-both.png',
              'name' => __( 'Both', 'understrap-builder' ) 
            ),
            'none' => array(
              'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/sidebar-none.png',
              'name' => __( 'None', 'understrap-builder' ) 
            )
					),
					'priority'    => '30',
				)
			)
		);
    
    // Theme sidebar choice default control
    $wp_customize->add_control(
			new Skyrocket_Image_Radio_Button_Custom_Control(
				$wp_customize,
				'understrap_builder_sidebars_show_archive',
				array(
					'label'       => __( 'Sidebars To Show On Archives', 'understrap-builder' ),
					'description' => __( 'Choose how to show sidebars on archive pages.', 'understrap-builder' ),
					'section'     => 'understrap_builder_sidebar_options',
					'settings'    => 'understrap_builder_sidebars_show_archive',
          'input_attrs' => array('tooltip' => 'below'),
					'choices'     => array(
            'default' => array(
              'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/sidebar-default.png',
              'name' => __( 'Same As Default', 'understrap-builder' ) 
            ),
            'right' => array(
              'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/sidebar-right.png',
              'name' => __( 'Right', 'understrap-builder' ) 
            ),
            'left' => array(
              'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/sidebar-left.png',
              'name' => __( 'Right', 'understrap-builder' ) 
            ),
            'both' => array(
              'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/sidebar-both.png',
              'name' => __( 'Both', 'understrap-builder' ) 
            ),
            'none' => array(
              'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'img/customizer/sidebar-none.png',
              'name' => __( 'None', 'understrap-builder' ) 
            )
					),
					'priority'    => '40',
				)
			)
		);
    
    // Theme width of single sidebar control
    $wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'understrap_builder_sidebars_single_width',
				array(
					'label'       => __( 'Single Sidebar Column Width', 'understrap-builder' ),
					'description' => __( 'Bootstrap columns for single sidebar (left or right).', 'understrap-builder' ),
					'section'     => 'understrap_builder_sidebar_options',
					'settings'    => 'understrap_builder_sidebars_single_width',
					'type'        => 'select',
					'choices'     => array(
            '2'     => __( '2 MD Columns', 'understrap-builder' ),
            '3'     => __( '3 MD Columns', 'understrap-builder' ),
						'4'     => __( '4 MD Columns', 'understrap-builder' ),
            '5'     => __( '5 MD Columns', 'understrap-builder' ),
            '6'     => __( '6 MD Columns', 'understrap-builder' ),
            '7'     => __( '7 MD Columns', 'understrap-builder' )
					),
					'priority'    => '50',
				)
			)
		);
    
    // Theme width of dual sidebars control
    $wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'understrap_builder_sidebars_dual_width',
				array(
					'label'       => __( 'Dual Sidebars Column Width', 'understrap-builder' ),
					'description' => __( 'Bootstrap columns for dual sidebars (left & right).', 'understrap-builder' ),
					'section'     => 'understrap_builder_sidebar_options',
					'settings'    => 'understrap_builder_sidebars_dual_width',
					'type'        => 'select',
					'choices'     => array(
            '2'     => __( '2 MD Columns', 'understrap-builder' ),
            '3'     => __( '3 MD Columns', 'understrap-builder' ),
						'4'     => __( '4 MD Columns', 'understrap-builder' ),
            '5'     => __( '5 MD Columns', 'understrap-builder' )
					),
					'priority'    => '60',
				)
			)
		);
    
    // Theme widget top margin
    $wp_customize->add_control(
			new Skyrocket_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'understrap_builder_sidebars_widget_margin',
				array(
					'label'       => __( 'Widget Bottom Margin', 'understrap-builder' ),
					'description' => __( 'Set the bottom margin of widgets in sidebars.', 'understrap-builder' ),
					'section'     => 'understrap_builder_sidebar_options',
					'settings'    => 'understrap_builder_sidebars_widget_margin',
					'choices'     => array(
            'default'      => __( 'None (default)', 'understrap-builder' ),
            '10'           => __( '10px', 'understrap-builder' ),
						'20'           => __( '20px', 'understrap-builder' ),
            '30'           => __( '30px', 'understrap-builder' ),
            '40'           => __( '40px', 'understrap-builder' ),
					),
					'priority'    => '70',
				)
			)
		);
    
    
    // Theme post layout upgrade message control
    $wp_customize->add_control(
			new BUILDER_Customize_upgrade_Control(
				$wp_customize,
				'understrap_builder_postlayout_upgrade_pro',
				array(
					'label'       => __( 'Available In PRO', 'understrap-builder' ),
					'description' => __( 'Upgrade your BUILDER to PRO to gain access.', 'understrap-builder' ),
					'section'     => 'understrap_builder_postlayout_options',
					'settings'    => 'understrap_builder_postlayout_upgrade_pro',
          'type'        => 'button',
					'priority'    => '5',
				)
			)
		);
    
    
    // Theme footer left text control
    $wp_customize->add_control(
			new Skyrocket_TinyMCE_Custom_control(
				$wp_customize,
				'understrap_builder_footer_text_left',
				array(
					'label'       => __( 'Footer Text', 'understrap-builder' ),
					'description' => __( 'The text to display in the last row of footer.', 'understrap-builder' ),
					'section'     => 'understrap_builder_footer_options',
					'settings'    => 'understrap_builder_footer_text_left',
          'input_attrs' => array(
            'toolbar1' => 'bold italic bullist numlist alignleft aligncenter alignright link',
            'toolbar2' => 'formatselect outdent indent | blockquote charmap',
            'mediaButtons' => true,
          ),
					'priority'    => '14',
				)
			)
		);
    
    // Theme footer right text control
    $wp_customize->add_control(
			new Skyrocket_TinyMCE_Custom_control(
				$wp_customize,
				'understrap_builder_footer_text_right',
				array(
					'label'       => __( 'Footer Text Right', 'understrap-builder' ),
					'description' => __( 'Add another column with text in the last row of footer.', 'understrap-builder' ),
					'section'     => 'understrap_builder_footer_options',
					'settings'    => 'understrap_builder_footer_text_right',
          'input_attrs' => array(
            'toolbar1' => 'bold italic bullist numlist alignleft aligncenter alignright link',
            'toolbar2' => 'formatselect outdent indent | blockquote charmap',
            'mediaButtons' => true,
          ),
					'priority'    => '18',
				)
			)
		);
    
    // Theme footer widgets enable control
    $wp_customize->add_control(
			new Skyrocket_Toggle_Switch_Custom_control(
				$wp_customize,
				'understrap_builder_footer_widgets_enable',
				array(
					'label'       => __( 'Footer Widgets', 'understrap-builder' ),
					'description' => __( 'Choose to show widgets in the footer. Don`t forget to add footer widgets', 'understrap-builder' ),
					'section'     => 'understrap_builder_footer_options',
					'settings'    => 'understrap_builder_footer_widgets_enable',
					'priority'    => '20',
				)
			)
		);
    
    // Theme footer text color
    $wp_customize->add_control(
			new Skyrocket_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'understrap_builder_footer_text_color',
				array(
					'label'       => __( 'Footer Text Color', 'understrap-builder' ),
					'description' => __( 'The color class to apply to text in the site footer.', 'understrap-builder' ),
					'section'     => 'understrap_builder_footer_options',
					'settings'    => 'understrap_builder_footer_text_color',
					'choices'     => array(
						''             => __( 'Default', 'understrap-builder' ),
            'primary'      => __( 'Primary [.bg-primary]', 'understrap-builder' ),
            'secondary'    => __( 'Secondary [.bg-secondary]', 'understrap-builder' ),
            'success'      => __( 'Success [.bg-success]', 'understrap-builder' ),
            'danger'       => __( 'Danger [.bg-danger]', 'understrap-builder' ),
            'warning'      => __( 'Warning [.bg-warning]', 'understrap-builder' ),
            'info'         => __( 'Info [.bg-info]', 'understrap-builder' ),
            'light'        => __( 'Light [.bg-light]', 'understrap-builder' ),
            'dark'         => __( 'Dark [.bg-dark]', 'understrap-builder' )
					),
					'priority'    => '26',
				)
			)
		);
    
    // Theme footer background class
    $wp_customize->add_control(
			new Skyrocket_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'understrap_builder_footer_bg_color',
				array(
					'label'       => __( 'Footer Background Color', 'understrap-builder' ),
					'description' => __( 'The background color class to apply to the site footer.', 'understrap-builder' ),
					'section'     => 'understrap_builder_footer_options',
					'settings'    => 'understrap_builder_footer_bg_color',
					'choices'     => array(
						''               => __( 'None', 'understrap-builder' ),
            'primary'        => __( 'Primary [.bg-primary]', 'understrap-builder' ),
            'secondary'      => __( 'Secondary [.bg-secondary]', 'understrap-builder' ),
            'success'        => __( 'Success [.bg-success]', 'understrap-builder' ),
            'danger'         => __( 'Danger [.bg-danger]', 'understrap-builder' ),
            'warning'        => __( 'Warning [.bg-warning]', 'understrap-builder' ),
            'info'           => __( 'Info [.bg-info]', 'understrap-builder' ),
            'light'          => __( 'Light [.bg-light]', 'understrap-builder' ),
            'dark'           => __( 'Dark [.bg-dark]', 'understrap-builder' )
					),
					'priority'    => '28',
				)
			)
		);
    
    // Theme footer border width
    $wp_customize->add_control(
			new Skyrocket_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'understrap_builder_footer_border',
				array(
					'label'       => __( 'Footer Border', 'understrap-builder' ),
					'description' => __( 'Choose to show a footer border and set thickness.', 'understrap-builder' ),
					'section'     => 'understrap_builder_footer_options',
					'settings'    => 'understrap_builder_footer_border',
					'choices'     => array(
						''                   => __( 'None', 'understrap-builder' ),
            'border-1'           => __( '1px', 'understrap-builder' ),
            'border-2'           => __( '2px', 'understrap-builder' ),
            'border-3'           => __( '3px', 'understrap-builder' ),
            'border-4'           => __( '4px', 'understrap-builder' ),
            'border-5'           => __( '5px', 'understrap-builder' )
					),
					'priority'    => '30',
				)
			)
		);
    
    // Theme footer border color class
    $wp_customize->add_control(
			new Skyrocket_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'understrap_builder_footer_border_color',
				array(
					'label'       => __( 'Footer Border Color', 'understrap-builder' ),
					'description' => __( 'The Bootstrap color class to assign to footer border.', 'understrap-builder' ),
					'section'     => 'understrap_builder_footer_options',
					'settings'    => 'understrap_builder_footer_border_color',
					'choices'     => array(
            'primary'        => __( 'Primary (default) [.bg-primary]', 'understrap-builder' ),
            'secondary'      => __( 'Secondary [.bg-secondary]', 'understrap-builder' ),
            'success'        => __( 'Success [.bg-success]', 'understrap-builder' ),
            'danger'         => __( 'Danger [.bg-danger]', 'understrap-builder' ),
            'warning'        => __( 'Warning [.bg-warning]', 'understrap-builder' ),
            'info'           => __( 'Info [.bg-info]', 'understrap-builder' ),
            'light'          => __( 'Light [.bg-light]', 'understrap-builder' ),
            'dark'           => __( 'Dark [.bg-dark]', 'understrap-builder' )
					),
          'active_callback' => function ($control) {
            return $control->manager->get_setting("understrap_builder_footer_border")->value()!='';
          },
					'priority'    => '32',
				)
			)
		);
    
    // Theme footer background image
    $wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'understrap_builder_footer_bg_img',
				array(
					'label'       => __( 'Footer Background Image', 'understrap-builder' ),
					'description' => __( 'Apply an image to the footer background.', 'understrap-builder' ),
					'section'     => 'understrap_builder_footer_options',
					'settings'    => 'understrap_builder_footer_bg_img',
					'priority'    => '34',
				)
			)
		);
    
    // Theme footer background image fixed position
    $wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'understrap_builder_footer_bg_img_fixed',
				array(
					'label'       => __( 'Background Image Fixed (Parallax)', 'understrap-builder' ),
					'description' => __( 'Have the background image move with scroll.', 'understrap-builder' ),
					'section'     => 'understrap_builder_footer_options',
					'settings'    => 'understrap_builder_footer_bg_img_fixed',
					'type'        => 'select',
					'choices'     => array(
						'default'        => __( 'Moves With Scroll', 'understrap-builder' ),
            'fixed'          => __( 'Fixed Background Image', 'understrap-builder' )
					),
          'active_callback' => function ($control) {
            return $control->manager->get_setting("understrap_builder_footer_bg_img")->value()!='';
          },
					'priority'    => '42',
				)
			)
		);
    
    // Theme footer menu align
    $wp_customize->add_control(
			new Skyrocket_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'understrap_builder_footer_menu_align',
				array(
					'label'       => __( 'Menu Align', 'understrap-builder' ),
					'description' => __( 'Align the optional footer menu left, right or center.', 'understrap-builder' ),
					'section'     => 'understrap_builder_footer_options',
					'settings'    => 'understrap_builder_footer_menu_align',
					'choices'     => array(
						'default'         => __( 'Left', 'understrap-builder' ),
            'right'           => __( 'Right', 'understrap-builder' ),
            'center'          => __( 'Center', 'understrap-builder' )
					),
					'priority'    => '50',
				)
			)
		);
    
    
    // On screen jQuery control
    $wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'understrap_builder_js',
				array(
					'label'       => __( 'JavaScript', 'understrap-builder' ),
					'description' => __( 'Add in additional JavaScript to your footer. Do not include &lsaquo;script&rsaquo; tags.', 'understrap-builder' ),
					'section'     => 'understrap_builder_code_options',
					'settings'    => 'understrap_builder_js',
					'type'        => 'textarea',
					'priority'    => '10',
				)
			)
		);
    
    // Add code between header tags
    $wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'understrap_builder_add_head',
				array(
					'label'       => __( 'Add To Head', 'understrap-builder' ),
					'description' => __( 'Script/tracking to add between &lsaquo;head&rsaquo; tags. Add &lsaquo;script&rsaquo; tags if needed.', 'understrap-builder' ),
					'section'     => 'understrap_builder_code_options',
					'settings'    => 'understrap_builder_add_head',
					'type'        => 'textarea',
					'priority'    => '20',
				)
			)
		);
    
    // Add code between footer tags
    $wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'understrap_builder_add_footer',
				array(
					'label'       => __( 'Add To Footer', 'understrap-builder' ),
					'description' => __( 'Script/tracking to add outside of content after &lsaquo;/body&rsaquo; tag. Add &lsaquo;script&rsaquo; tags if needed.', 'understrap-builder' ),
					'section'     => 'understrap_builder_code_options',
					'settings'    => 'understrap_builder_add_footer',
					'type'        => 'textarea',
					'priority'    => '30',
				)
			)
		);
    
    
    /* ====== Add Pencil Icons To Customizer Preview Screen ======= */
    
    // Footer bar left
    $wp_customize->selective_refresh->add_partial( 'understrap_builder_footer_text_left', array(
      'selector' => '#us_b_footer_text_bar_left',
    ));
    
    // Footer bar right
    $wp_customize->selective_refresh->add_partial( 'understrap_builder_footer_text_right', array(
      'selector' => '#us_b_footer_text_bar_right',
    ));
    
    // Navbar CTA
    $wp_customize->selective_refresh->add_partial( 'understrap_builder_navbar_cta_bg', array(
      'selector' => '#us_b_navbar_cta',
    ));
    
    
  }  
  
}


/* Add in the UnderStrap BUILDER Customizer styles */

function understrap_builder_customize_style() {
  ?>
  <style>
    #customize-control-understrap_builder_container_page_type, #customize-control-understrap_builder_footer_widgets_enable, #customize-control-understrap_builder_sidebars_show_page, 
    #customize-control-understrap_builder_sidebars_single_width, #customize-control-understrap_builder_navbar_search_show, 
    #customize-control-understrap_builder_navbar_cta_show, #customize-control-understrap_builder_footer_text_color, #customize-control-understrap_builder_links_rollover_color, 
    #customize-control-understrap_builder_footer_menu_align, #customize-control-understrap_builder_navbar_bottom_border, #customize-control-understrap_builder_postlayout_text, 
    #customize-control-understrap_builder_postlayout_featured_size, #customize-control-understrap_builder_postlayout_meta_pos, #customize-control-understrap_builder_sidebars_widget_margin, 
    #customize-control-understrap_builder_headers_page, #customize-control-understrap_builder_headers_archive, #customize-control-understrap_builder_author_box_page_style, 
    #customize-control-understrap_builder_breadcrumbs_page_display, #customize-control-understrap_builder_breadcrumbs_archive_display, #customize-control-understrap_builder_breadcrumbs_single_post_display, 
    #customize-control-understrap_builder_breadcrumbs_home_page, #customize-control-understrap_builder_typography_heading_font_custom, #customize-control-understrap_builder_navbar_dropdown_link, 
    #customize-control-understrap_builder_navbar_dropdown_border, #customize-control-understrap_builder_navbar_dropdown_link_hover, #customize-control-understrap_builder_navbar_dropdown_bg_hover, 
    #customize-control-understrap_builder_navbar_dropdown_bg {
      padding-top: 10px;
      margin-top: 10px;
      border-top: 1px solid #ddd;
    }
    #accordion-panel-understrap_builder_navbar_panel, #accordion-section-custom_css {
      margin-top: 16px;
    }
    #accordion-section-understrap_builder_layout_options h3, #accordion-section-understrap_builder_footer_options h3, #accordion-section-understrap_builder_code_options h3, 
    #accordion-section-understrap_builder_sidebar_options h3, #accordion-section-understrap_builder_navbar_options h3, #accordion-section-understrap_builder_bs_colors_options h3, 
    #accordion-section-understrap_builder_typography_options h3, #accordion-section-understrap_builder_buttons_options h3, 
    #accordion-section-understrap_builder_links_options h3, #accordion-panel-understrap_builder_spacings_panel h3, #accordion-section-understrap_builder_spacings_navbar_section h3, 
    #accordion-section-understrap_builder_spacings_footer_section h3, #accordion-panel-understrap_builder_navbar_panel h3, #accordion-section-understrap_builder_navbar_submenu h3, 
    #accordion-section-understrap_builder_navbar_dropdowns h3 {
      background-image: url('<?php echo esc_url(get_stylesheet_directory_uri()); ?>/img/builder-logo-mini-64-64.png')!important;
      background-repeat: no-repeat!important;
      background-position: 9px!important;
      background-size: 28px 28px!important;
      padding-left: 48px;
    }
    #accordion-section-understrap_builder_archives_options h3, #accordion-section-understrap_builder_postlayout_options h3, #accordion-section-understrap_builder_hero_options h3, 
    #accordion-section-understrap_builder_headers_options h3, #accordion-section-understrap_builder_comments_options h3, #accordion-section-understrap_builder_author_box_options h3, 
    #accordion-section-understrap_builder_breadcrumbs_options h3, #accordion-section-understrap_builder_mobile_options h3, #accordion-section-understrap_builder_spacings_breadcrumbs_section h3, 
    #accordion-section-understrap_builder_spacings_headers_section h3, #accordion-section-understrap_builder_spacings_author_section h3, #accordion-section-understrap_builder_spacings_comments_section h3, 
    #accordion-section-understrap_builder_spacings_single_section h3, #accordion-section-understrap_builder_spacings_page_section h3, #accordion-section-understrap_builder_navbar_scroll h3, 
    #accordion-section-understrap_builder_navbar_mobile_section h3 {
      background-image: url('<?php echo esc_url(get_stylesheet_directory_uri()); ?>/img/builder-pro-logo-mini-64-64.png')!important;
      background-repeat: no-repeat!important;
      background-position: 9px!important;
      background-size: 28px 28px!important;
      padding-left: 48px;
    }
    #sub-accordion-section-understrap_builder_bs_colors_options .customize-section-description ul {
      margin-top: 12px;
      padding-left: 12px;
    }
    .us_b_restore_default {
      float: right;
      width: 16px;
      height: 16px;
      cursor: pointer;
    }
    .builder_img_radio_parent {
      display: inline-block;
    }
    #customize-control-understrap_builder_navbar_type .builder_img_radio_parent, #customize-control-understrap_builder_navbar_color_scheme .builder_img_radio_parent,
    #customize-control-understrap_builder_submenu_type .builder_img_radio_parent, #customize-control-understrap_builder_buttons_shadow .builder_img_radio_parent, 
    #customize-control-understrap_builder_postlayout_bg .builder_img_radio_parent, #customize-control-understrap_builder_comments_form_layout .builder_img_radio_parent {
      max-width: 46%;
    }
    .tipr_container_below {
      max-width: 140px;
      text-align: center;
    }
    .tipr_point_above, .tipr_point_below {
      background: #eee;
      border: 1px solid #ccc;
    }
    .tipr_content {
      color: #eee;
      background-color: #414141;
    }
    .tipr_point_below:after {
      border-bottom-color: #414141;
    }
    .tipr_point_above:after {
      border-top-color: #414141;
    }
    #customize-control-understrap_builder_links_decoration .builder_img_radio_parent, #customize-control-understrap_builder_links_rollover_weight .builder_img_radio_parent,
    #customize-control-understrap_builder_links_rollover_decoration .builder_img_radio_parent, #customize-control-understrap_builder_sidebars_show_default .builder_img_radio_parent, 
    #customize-control-understrap_builder_sidebars_show_page .builder_img_radio_parent, #customize-control-understrap_builder_sidebars_show_single .builder_img_radio_parent,
    #customize-control-understrap_builder_sidebars_show_archive .builder_img_radio_parent, #customize-control-understrap_builder_hero_layout .builder_img_radio_parent,
    #customize-control-understrap_builder_headers_single .builder_img_radio_parent, #customize-control-understrap_builder_headers_page .builder_img_radio_parent, 
    #customize-control-understrap_builder_headers_archive .builder_img_radio_parent, #customize-control-understrap_builder_archives_cols .builder_img_radio_parent {
      max-width: 22%;
    }
    #customize-control-understrap_builder_sidebars_show_page label:first-of-type .builder_img_radio_parent, #customize-control-understrap_builder_sidebars_show_single label:first-of-type .builder_img_radio_parent, 
    #customize-control-understrap_builder_sidebars_show_archive label:first-of-type .builder_img_radio_parent {
      max-width: 98%;
    }
    .text_radio_button_control .radio-buttons {
      border: none;
    }
    .us_b_tipr img {
      display: block;
    }
    .image_radio_button_control .radio-button-label.us_b_tipr > input:checked + div {
      border: 3px solid #2885bb;
    }
    .image_radio_button_control .radio-button-label.us_b_tipr input + div {
      cursor: pointer;
      border: 3px solid #ddd;
    }
    .text_radio_button_control .radio-button-label > input + span.us_b_curved_corners {
      padding: 20px!important;
      color: #fff;
      background-color: #848484;
      border: 3px solid #fff;
    }
    .text_radio_button_control .radio-button-label > input:checked + span.us_b_curved_corners {
      border: 3px solid #2885bb;
    }
    .wp-core-ui select.disabled, .wp-core-ui select:disabled {
      background-image: none;
    }
    <?php
    // Dynamic BS color classes for Customizer options
    global $us_b_potential_bootstrap_color_classes;
    $understrap_builder_bs_color_default = get_theme_mod( 'understrap_builder_bs_color_default', 'default' );
    if($understrap_builder_bs_color_default != 'default'){
      // Theme layout BS color BG classes controls - custom colors
      foreach($us_b_potential_bootstrap_color_classes as $bs_color => $bs_color_default){
        $bs_color_lower = strtolower($bs_color);
        $understrap_builder_bs_color_default = get_theme_mod( 'understrap_builder_bs_color_'.$bs_color_lower, $bs_color_default );
        if($bs_color_lower == 'light'){ // Dark text for light background
          echo '.text_radio_button_control .radio-button-label > input + span.bg-'.$bs_color_lower.' {background-color:'.$understrap_builder_bs_color_default.';color:#2A2D34}';
        } else {
          echo '.text_radio_button_control .radio-button-label > input + span.bg-'.$bs_color_lower.' {background-color:'.$understrap_builder_bs_color_default.';color:#fff}';
        }
        echo '.text_radio_button_control .radio-button-label > input:checked + span.bg-'.$bs_color_lower.' {border-color:#007cba}';
      }
    } else {
      // Theme layout BS color BG classes controls - use defaults
      foreach($us_b_potential_bootstrap_color_classes as $bs_color => $bs_color_default){
        $bs_color_lower = strtolower($bs_color);
        if($bs_color_lower == 'light'){ // Dark text for light background
          echo '.text_radio_button_control .radio-button-label > input + span.bg-'.$bs_color_lower.' {background-color:'.$bs_color_default.';color:#2A2D34}';
        } else {
          echo '.text_radio_button_control .radio-button-label > input + span.bg-'.$bs_color_lower.' {background-color:'.$bs_color_default.';color:#fff}';
        }
        echo '.text_radio_button_control .radio-button-label > input:checked + span.bg-'.$bs_color_lower.' {border-color:#007cba}';
      }
    }
    ?>    
  </style>
  <script>
    function us_b_restore_default_bs_container(){
      wp.customize( 'understrap_builder_container_width', function ( obj ) {
        obj.set( '1190' );
      } );
    }
  </script>
  <?php
}

?>