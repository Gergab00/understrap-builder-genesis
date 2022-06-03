<?php

/* BULDER - This is the themes functions.php file and will most probably be overwritten when the theme is updated. To add your own PHP code: go to /inc/builder_custom_code.php - it won't be overwritten on update */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


// Default globals
global $us_b_potential_bootstrap_color_classes, $us_b_heading_sizes, $builder_default_spacings;
$us_b_potential_bootstrap_color_classes = array('Primary'   => '#6761A8', 
                                           'Secondary' => '#EEB902', 
                                           'Success'   => '#97CC04', 
                                           'Info'      => '#187BCA', 
                                           'Warning'   => '#F45D01', 
                                           'Danger'    => '#FE4A49', 
                                           'Light'     => '#FBFFF1', 
                                           'Dark'      => '#2A2D34',
                                           'Color-1'   => '#28AAE1',
                                           'Color-2'   => '#D7EDF9'
                                          );
$us_b_heading_sizes = array('H1' => array('default' => '2.5rem'), 
                            'H2' => array('default' => '2rem'), 
                            'H3' => array('default' => '1.75rem'), 
                            'H4' => array('default' => '1.5rem'), 
                            'H5' => array('default' => '1.25rem'), 
                            'H6' => array('default' => '1rem'));
$builder_default_spacings = '{"mt": "", "mr": "", "mb": "", "ml": "", "pt": "", "pr": "", "pb": "", "pl": ""}';



/* Actions */
add_action( 'wp_enqueue_scripts', 'understrap_builder_remove_scripts', 20 ); // Remove UnderStrap Defaults
add_action( 'wp_enqueue_scripts', 'understrap_builder_enqueue_styles' ); // Add in UnderStrap BUIDLER styles & scripts
add_action( 'after_setup_theme', 'understrap_builder_add_child_theme_textdomain' ); // Assign language folder



/* Includes */
require_once( trailingslashit( get_stylesheet_directory() ). 'inc/customizer.php' );
require_once( trailingslashit( get_stylesheet_directory() ). 'inc/onpage_styles.php' );
require_once( trailingslashit( get_stylesheet_directory() ). 'inc/builder_template_functions.php' );
require_once( trailingslashit( get_stylesheet_directory() ). 'inc/onpage_scripts.php' );
require_once( trailingslashit( get_stylesheet_directory() ). 'inc/additional_menus.php' );
require_once( trailingslashit( get_stylesheet_directory() ). 'inc/builder_wpadmin_functions.php' );
require_once( trailingslashit( get_stylesheet_directory() ). 'inc/builder_options_page.php' );
require_once( trailingslashit( get_stylesheet_directory() ). 'inc/builder_importables.php' );
require_once( trailingslashit( get_stylesheet_directory() ). 'inc/builder-custom-comments.php' );
require_once( trailingslashit( get_stylesheet_directory() ). 'inc/builder_admin_bar.php' );
require_once( trailingslashit( get_stylesheet_directory() ). 'inc/post_page_meta.php' );
require_once( trailingslashit( get_stylesheet_directory() ). 'inc/builder_custom_customizers.php' );
require_once( trailingslashit( get_stylesheet_directory() ). 'inc/builder_custom_code.php' );
require_once( trailingslashit( get_stylesheet_directory() ). 'inc/class-wp-bootstrap-navwalker.php');
require_once( trailingslashit( get_stylesheet_directory() ). 'inc/genesis_template_functions.php');

require_once( trailingslashit( get_stylesheet_directory() ). 'inc/TGM-Plugin-Activation/class-tgm-plugin-activation.php' );

require_once( trailingslashit( get_stylesheet_directory() ). 'inc/Customizer-Custom-Controls/custom-controls.php' );





/* PUC Update For BUILDER*/
// https://github.com/YahnisElsts/plugin-update-checker
require( trailingslashit( get_stylesheet_directory() ). 'inc/plugin-update-checker.php' );
global $BUILDERUpdateChecker;
$BUILDERUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://understrap.com/update/understrap_builder_latest.json#'.urlencode(get_home_url()),
	__FILE__, 
	'understrap-builder'
);



/* Remove UnderStrap Defaults */
function understrap_builder_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );
    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );
}



/* Remove some UnderStrap page templates */
function understrap_builder_remove_page_templates( $templates ) {
  unset( $templates['page-templates/blank.php'] );
  unset( $templates['page-templates/empty.php'] );
  return $templates;
}
add_filter( 'theme_page_templates', 'understrap_builder_remove_page_templates' );



/* Remove some UnderStrap sidebar locations */
function understrap_builder_unregister_sidebars(){
  unregister_sidebar( 'hero' );
  unregister_sidebar( 'herocanvas' );
  unregister_sidebar( 'statichero' );
}
add_action( 'widgets_init', 'understrap_builder_unregister_sidebars', 99 );



/* Add in UnderStrap BUIDLER Styles & scripts */
function understrap_builder_enqueue_styles() {
  
	$the_theme = wp_get_theme();
  
  wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.css', array(), $the_theme->get( 'Version' ) );
  wp_enqueue_style( 'custom-editor-style', get_stylesheet_directory_uri() . '/css/custom-editor-style.css', array(), $the_theme->get( 'Version' ) );
  wp_enqueue_script( 'jquery');
  wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), $the_theme->get( 'Version' ), true );
  wp_enqueue_script( 'wow', get_stylesheet_directory_uri() . '/js/wow.js', array(), $the_theme->get( 'Version' ), true );
  wp_enqueue_style( 'understrap-builder-styles', get_stylesheet_directory_uri() . '/css/understrap-builder.min.css', array(), $the_theme->get( 'Version' ) );
  //wp_enqueue_script( 'understrap-builder-scripts', get_stylesheet_directory_uri() . '/js/understrap-builder.min.js', array(), $the_theme->get( 'Version' ), true );
  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
  // BUILDER Google fonts
  $us_b_font_families = array();
  $us_b_subsets = 'latin';
  $understrap_builder_typography_default_font = json_decode(get_theme_mod( 'understrap_builder_typography_default_font', '{"font":"Open Sans","regularweight":"regular","italicweight":"italic","boldweight":"700","category":"sans-serif"}' ), true);
  $understrap_builder_typography_heading_font_custom = get_theme_mod('understrap_builder_typography_heading_font_custom', 1);
  $understrap_builder_typography_heading_font = json_decode(get_theme_mod( 'understrap_builder_typography_heading_font', '{"font":"Open Sans","regularweight":"regular","italicweight":"italic","boldweight":"700","category":"sans-serif"}' ), true);
  if('off' !== $understrap_builder_typography_default_font){
    $us_b_font_families[] = $understrap_builder_typography_default_font['font'] . ':' . $understrap_builder_typography_default_font['regularweight'] . ',' . $understrap_builder_typography_default_font['italicweight'] . ',' . $understrap_builder_typography_default_font['boldweight'];
  }
	if('off' !== $understrap_builder_typography_heading_font && $understrap_builder_typography_heading_font_custom == 0){
    $us_b_font_families[] = $understrap_builder_typography_heading_font['font'] . ':' . $understrap_builder_typography_heading_font['regularweight'] . ',' . $understrap_builder_typography_heading_font['italicweight'] . ',' . $understrap_builder_typography_heading_font['boldweight'];
  }	
  $us_b_query_args = array(
    'family' => urlencode(implode( '|', $us_b_font_families)),
    'subset' => urlencode($us_b_subsets),
    'display' => urlencode('fallback')
  );
  //$us_b_fonts_url = add_query_arg( $us_b_query_args, "https://fonts.googleapis.com/css" );
  $us_b_fonts_url = add_query_arg( $us_b_query_args, "https://fonts.google.com/" );
  if (!empty( $us_b_fonts_url)){
		wp_enqueue_style( 'builder-fonts', esc_url_raw($us_b_fonts_url), array(), null );
	}  
  
}

/* Assign language folder */
function understrap_builder_add_child_theme_textdomain() {
    load_child_theme_textdomain( 'understrap-builder', get_stylesheet_directory() . '/languages' );
}


/* Allow HTML in Gutenberg HTML Block */
add_filter( 'wp_kses_allowed_html', 'understrap_builder_allow_iframe_in_editor', 10, 2 );
function understrap_builder_allow_iframe_in_editor( $tags, $context ) {
	if( 'post' === $context ) {
		$tags['iframe'] = array(
			'allowfullscreen' => TRUE,
			'frameborder' => TRUE,
			'height' => TRUE,
			'src' => TRUE,
			'style' => TRUE,
			'width' => TRUE,
		);
	}
	return $tags;
}



/* Convert BUILDER shortcodes to live data in string */
function understrap_builder_convert_text_date($original_string){
  $new_string_to_return = $original_string;
  $this_year = date('Y', time());
  $new_string_to_return = str_replace('[builder_current_year]', $this_year, $original_string);
  return $new_string_to_return;
}



/* Tidy the archive title for PRO headers */
add_filter( 'get_the_archive_title', function ($title) {    
  if ( is_category() ) {   
          $title = single_cat_title( '', false );    
      } elseif ( is_tag() ) {    
          $title = single_tag_title( '', false );    
      } elseif ( is_author() ) {    
          $title = '<span class="vcard">' . get_the_author() . '</span>' ;    
      } elseif ( is_tax() ) { //for custom post types
          $title = sprintf( __( '%1$s', 'understrap-builder' ), single_term_title( '', false ) );
      }    
  return $title;    
});



// Disable Post Formats for BUILDER */
add_action('after_setup_theme', 'understrap_builder_remove_formats', 100);
function understrap_builder_remove_formats(){
  remove_theme_support('post-formats');
}



// Suggested plugins
add_action( 'tgmpa_register', 'understrap_builder_register_required_plugins' );
function understrap_builder_register_required_plugins() {
	$plugins = array(
		array(
			'name'      => 'Bootstrap Blocks',
			'slug'      => 'wp-bootstrap-blocks',
			'required'  => false
		),
    array(
			'name'      => 'Contact Form 7',
			'slug'      => 'contact-form-7',
			'required'  => false
		),
    array(
			'name'      => 'One Click Demo Import',
			'slug'      => 'one-click-demo-import',
			'required'  => false
		)
	);
	tgmpa( $plugins, array() );
}



/**
 * Disable the emoji's
 */
function understrap_builder_disable_emojis() {
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  add_filter( 'tiny_mce_plugins', 'understrap_builder_disable_emojis_tinymce' );
  add_filter( 'wp_resource_hints', 'understrap_builder_disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'understrap_builder_disable_emojis' );

/**
 * Filter function used to remove the tinymce emoji plugin.
 * 
 * @param array $plugins 
 * @return array Difference betwen the two arrays
 */
function understrap_builder_disable_emojis_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param array $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array Difference betwen the two arrays.
 */
function understrap_builder_disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
  if ( 'dns-prefetch' == $relation_type ) {
    /** This filter is documented in wp-includes/formatting.php */
    $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

    $urls = array_diff( $urls, array( $emoji_svg_url ) );
  }
  return $urls;
}


// Remove embed.js
function my_deregister_scripts(){
  wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_footer', 'my_deregister_scripts' );


/* BUILDER Image Sizes */

add_image_size( 'us_b_banner', 1600, 500, true);
add_image_size( 'us_b_button', 350, 350, true);


/* SkyRocket Sex Up Customizer Controls */
// https://github.com/maddisondesigns/customizer-custom-controls

// Enqueue scripts for Customizer preview
if ( ! function_exists( 'skyrocket_customizer_preview_scripts' ) ) {
	function skyrocket_customizer_preview_scripts() {
		wp_enqueue_script( 'skyrocket-customizer-preview', trailingslashit( get_stylesheet_directory_uri() ) . 'js/customizer-preview.js', array( 'customize-preview', 'jquery' ) );
	}
}
add_action( 'customize_preview_init', 'skyrocket_customizer_preview_scripts' );


