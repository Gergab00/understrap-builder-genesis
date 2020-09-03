<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


/* UnderStrap BUILDER Template Functions */

// In HEAD after the wp_head
function understrap_builder_in_head(){
  
  // Load Customizer variables
  $understrap_builder_add_head = get_option( 'understrap_builder_add_head', '');
  
  // Customizer HEAD content
  echo $understrap_builder_add_head;
  
  // Onpage styles, container width class etc.
  check_display_onpage_styles();
  
}

// After /BODY tag and wp_footer function
function understrap_builder_after_footer(){
  
  // Load Customizer variables
  $understrap_builder_add_footer = get_option( 'understrap_builder_add_footer', '');
  $understrap_builder_js = get_option( 'understrap_builder_js', '');
  
  // Customizer after /BODY content
  echo $understrap_builder_add_footer;
  
  check_display_onpage_scripts();
  
  // Customizer additional JS
  if($understrap_builder_js != ''){
    echo '<script>';
    echo $understrap_builder_js;
    echo '</script>';
  }
  
}


// Set the number of posts per page in archives
add_action( 'pre_get_posts', 'understrap_builder_posts_limit' );
function understrap_builder_posts_limit( $query ) {
  if($query->is_main_query() && !is_admin()){
    $understrap_builder_archives_posts_per_page = get_option( 'understrap_builder_archives_posts_per_page', 10);
    $query->set('posts_per_page', esc_attr($understrap_builder_archives_posts_per_page));
  }
}


// If more than one page exists, return TRUE.
function show_posts_nav() {
  global $wp_query;
  return ($wp_query->max_num_pages > 1);
}


// handle the BUILDER spacings JSON string to return classes string
function understrap_builder_spacings_handler($us_b_spacings_string){
  $class_return = '';
  $us_b_spacings_obj = json_decode($us_b_spacings_string);
  
  foreach($us_b_spacings_obj as $possible_spacing_class => $spacing_display_class){
    if($spacing_display_class != '[none]'){
      $class_return .= ' '.$spacing_display_class;
    }
  }
  
  return trim($class_return);
}

/* BUILDER Handle the custom logo classes */
add_filter( 'get_custom_logo', 'understrap_builder_custom_logo' );
function understrap_builder_custom_logo($html) {
  global $builder_default_spacings;
  $understrap_builder_spacings_navbar_logo = get_option( 'understrap_builder_spacings_navbar_logo', $builder_default_spacings );
  $html = str_replace( 'custom-logo-link', 'custom-logo-link '.esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_navbar_logo)), $html );
  return $html;
}

?>