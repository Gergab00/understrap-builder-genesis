<?php
/**
 * Onpage styles to display dynamically on the front end.
 *
 * @package understrap-builder
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// CSS to display at top of page to override BS defaults
function check_display_onpage_styles(){
  
  global $us_b_potential_bootstrap_color_classes, $us_b_heading_sizes;
  
  $styles_to_display = '';
  $us_b_current_bootstrap_colors = array();
  
  // Container class override
  $understrap_builder_container_width = get_option( 'understrap_builder_container_width', '' );
  if($understrap_builder_container_width != ''){ $styles_to_display .= '.container{max-width:'.esc_attr($understrap_builder_container_width, 'understrap-builder').'px}'; }
  
  // Navbar position paddings
  $understrap_builder_navbar_position = get_option( 'understrap_builder_navbar_position', 'default' );
  if($understrap_builder_navbar_position == 'bottom'){ $styles_to_display .= '#page{padding-bottom:140px}'; }
  if($understrap_builder_navbar_position == 'top'){ $styles_to_display .= '#page{padding-top:140px}#us_b_hero{margin-top:-140px}'; }
  
  // Bootstrap colors and defaults
  $understrap_builder_bs_color_default = get_option( 'understrap_builder_bs_color_default', 'default' );
  if($understrap_builder_bs_color_default != 'default'){
    // Theme layout BS color BG classes controls
    foreach($us_b_potential_bootstrap_color_classes as $bs_color => $bs_color_default){
      $bs_color_lower = strtolower($bs_color);
      $understrap_builder_bs_color_default = get_option( 'understrap_builder_bs_color_'.$bs_color_lower, $bs_color_default );
      $styles_to_display .= '.bg-'.$bs_color_lower.'{background-color:'.$understrap_builder_bs_color_default.'!important}'; 
      $styles_to_display .= '.text-'.$bs_color_lower.'{color:'.$understrap_builder_bs_color_default.'!important}';
      $styles_to_display .= 'a.text-'.$bs_color_lower.':hover{color:'.$understrap_builder_bs_color_default.'!important}';
      $styles_to_display .= '.border-'.$bs_color_lower.'{border-color:'.$understrap_builder_bs_color_default.'!important}';
      $styles_to_display .= '.btn-'.$bs_color_lower.'{background-color:'.$understrap_builder_bs_color_default.'!important;border-color:'.$understrap_builder_bs_color_default.'!important}';
      $us_b_current_bootstrap_colors[$bs_color_lower] = $understrap_builder_bs_color_default;
    }
  } else {
    $us_b_current_bootstrap_colors = $us_b_potential_bootstrap_color_classes;
  }
  
  // Navbar dropdowns
  $understrap_builder_navbar_dropdown_border_on = get_option( 'understrap_builder_navbar_dropdown_border_on', 1 );
  if($understrap_builder_navbar_dropdown_border_on == 0){
    $styles_to_display .= '.dropdown-menu{border:none!important}'; 
  }
  $understrap_builder_navbar_dropdown_border_radius = get_option( 'understrap_builder_navbar_dropdown_border_radius', 5 );
  $styles_to_display .= '.dropdown-menu{border-radius:'.esc_attr($understrap_builder_navbar_dropdown_border_radius).'px!important}'; 
  
  $understrap_builder_navbar_dropdown_bg = get_option( 'understrap_builder_navbar_dropdown_bg', '' );
  if($understrap_builder_navbar_dropdown_bg == 'custom'){
    $understrap_builder_navbar_dropdown_custom_bg = get_option( 'understrap_builder_navbar_dropdown_custom_bg', '' );
    $styles_to_display .= '.dropdown-menu{background-color:'.esc_attr($understrap_builder_navbar_dropdown_custom_bg).'!important}'; 
  } else if($understrap_builder_navbar_dropdown_bg != ''){
    $us_b_bs_dd_bg_class = esc_attr($understrap_builder_navbar_dropdown_bg);
    $styles_to_display .= '.dropdown-menu{background-color:'.$us_b_current_bootstrap_colors[esc_attr($us_b_bs_dd_bg_class)].'!important}';
  }
  $understrap_builder_navbar_dropdown_border = get_option( 'understrap_builder_navbar_dropdown_border', '' );
  if($understrap_builder_navbar_dropdown_border == 'custom'){
    $understrap_builder_navbar_dropdown_custom_border = get_option( 'understrap_builder_navbar_dropdown_custom_border', '' );
    $styles_to_display .= '.dropdown-menu{border-color:'.esc_attr($understrap_builder_navbar_dropdown_custom_border).'!important}'; 
  } else if($understrap_builder_navbar_dropdown_border != ''){
    $styles_to_display .= '.dropdown-menu{border-color:'.$us_b_current_bootstrap_colors[esc_attr($understrap_builder_navbar_dropdown_border)].'!important}';
  }
  $understrap_builder_navbar_dropdown_link = get_option( 'understrap_builder_navbar_dropdown_link', '' );
  if($understrap_builder_navbar_dropdown_link == 'custom'){
    $understrap_builder_navbar_dropdown_custom_link = get_option( 'understrap_builder_navbar_dropdown_custom_link', '' );
    $styles_to_display .= '.dropdown-menu a{color:'.esc_attr($understrap_builder_navbar_dropdown_custom_link).'!important}'; 
  } else if($understrap_builder_navbar_dropdown_link != ''){
    $styles_to_display .= '.dropdown-menu a{color:'.$us_b_current_bootstrap_colors[esc_attr($understrap_builder_navbar_dropdown_link)].'!important}';
  }
  $understrap_builder_navbar_dropdown_link_hover = get_option( 'understrap_builder_navbar_dropdown_link_hover', '' );
  if($understrap_builder_navbar_dropdown_link_hover == 'custom'){
    $understrap_builder_navbar_dropdown_custom_link_hover = get_option( 'understrap_builder_navbar_dropdown_custom_link_hover', '' );
    $styles_to_display .= '.dropdown-menu a:hover{color:'.esc_attr($understrap_builder_navbar_dropdown_custom_link_hover).'!important}'; 
  } else if($understrap_builder_navbar_dropdown_link_hover != ''){
    $styles_to_display .= '.dropdown-menu a:hover{color:'.$us_b_current_bootstrap_colors[esc_attr($understrap_builder_navbar_dropdown_link_hover)].'!important}';
  }
  $understrap_builder_navbar_dropdown_bg_hover = get_option( 'understrap_builder_navbar_dropdown_bg_hover', '' );
  if($understrap_builder_navbar_dropdown_bg_hover == 'custom'){
    $understrap_builder_navbar_dropdown_custom_bg_hover = get_option( 'understrap_builder_navbar_dropdown_custom_bg_hover', '' );
    $styles_to_display .= '.dropdown-item:focus,.dropdown-item:hover,.dropdown-item:active{background-color:'.esc_attr($understrap_builder_navbar_dropdown_custom_bg_hover).'!important}'; 
  } else if($understrap_builder_navbar_dropdown_bg_hover == 'transparent'){
    $styles_to_display .= '.dropdown-item:focus,.dropdown-item:hover,.dropdown-item:active{background-color:transparent!important}'; 
  } else if($understrap_builder_navbar_dropdown_bg_hover != ''){
    $styles_to_display .= '.dropdown-item:focus,.dropdown-item:hover,.dropdown-item:active{background-color:'.$us_b_current_bootstrap_colors[esc_attr($understrap_builder_navbar_dropdown_bg_hover)].'!important}';
  }

  // Typography
  $understrap_builder_typography_default_font = json_decode(get_option( 'understrap_builder_typography_default_font', '{"font":"Open Sans","regularweight":"regular","italicweight":"italic","boldweight":"700","category":"sans-serif"}' ));
  $understrap_builder_typography_heading_font_custom = get_option('understrap_builder_typography_heading_font_custom', 1);
  $understrap_builder_typography_heading_font = json_decode(get_option( 'understrap_builder_typography_heading_font', '{"font":"Open Sans","regularweight":"regular","italicweight":"italic","boldweight":"700","category":"sans-serif"}' ));
  $styles_to_display .= "body{font-family:".$understrap_builder_typography_default_font->font.", ".$understrap_builder_typography_default_font->category."}";
  if($understrap_builder_typography_heading_font_custom == 0){
    $styles_to_display .= "h1,h2,h3,h4,h5,h6{font-family:".$understrap_builder_typography_default_font->font.", ".$understrap_builder_typography_default_font->category."!important}";
  } else {
    $styles_to_display .= "h1,h2,h3,h4,h5,h6{font-family:".$understrap_builder_typography_heading_font->font.", ".$understrap_builder_typography_heading_font->category."!important}";
  }
  $understrap_builder_typography_font_size = get_option( 'understrap_builder_typography_font_size', '' );
  if($understrap_builder_typography_font_size != ''){
    $styles_to_display .= 'body{font-size:'.$understrap_builder_typography_font_size.'!important}';
  }
  $understrap_builder_typography_heading_font_default = get_option( 'understrap_builder_typography_heading_font_default', 0 );
  if($understrap_builder_typography_heading_font_default == 1){
    foreach($us_b_heading_sizes as $heading_size => $heading_settings){
      $heading_size_lower = strtolower($heading_size);
      $understrap_builder_heading_size = get_option( 'understrap_builder_typography_heading_font_'.$heading_size_lower, $heading_settings['default'] );
      if($understrap_builder_heading_size != $heading_settings['default']){
        $styles_to_display .= $heading_size_lower.'{font-size:'.esc_attr($understrap_builder_heading_size).'!important}';
      }
    }
  }
  $understrap_builder_typography_default_line_height = get_option( 'understrap_builder_typography_default_line_height', '1.5' );
  $understrap_builder_typography_default_heading_line_height = get_option( 'understrap_builder_typography_default_heading_line_height', '1.2' );
  $understrap_builder_typography_default_p_margin_bottom = get_option( 'understrap_builder_typography_default_p_margin_bottom', '1rem' );
  if($understrap_builder_typography_default_line_height != '1.5'){
    $styles_to_display .= 'body{line-height:'.$understrap_builder_typography_default_line_height.'}';
  }
  if($understrap_builder_typography_default_heading_line_height != '1.2'){
    $styles_to_display .= '.h1,.h2,.h3,.h4,.h5,.h6,h1,h2,h3,h4,h5,h6{line-height:'.$understrap_builder_typography_default_heading_line_height.'}';
  }
  if($understrap_builder_typography_default_p_margin_bottom != '1rem'){
    $styles_to_display .= 'p{margin-bottom:'.$understrap_builder_typography_default_p_margin_bottom.'}';
  }
  
  
  
  // Links
  $understrap_builder_links_color = get_option( 'understrap_builder_links_color', '#7c008c' );
  $understrap_builder_links_decoration = get_option( 'understrap_builder_links_decoration', 'none' );
  $understrap_builder_links_rollover_color = get_option( 'understrap_builder_links_rollover_color', '#380040' );
  $understrap_builder_links_rollover_weight = get_option( 'understrap_builder_links_rollover_weight', 'normal' );
  $understrap_builder_links_rollover_decoration = get_option( 'understrap_builder_links_rollover_decoration', 'underline' );
  if($understrap_builder_links_color != '#7c008c'){
    $styles_to_display .= 'a:not(.btn){color:'.$understrap_builder_links_color.'}';
  }
  if($understrap_builder_links_decoration != 'none'){
    $styles_to_display .= 'a:not(.btn){text-decoration:'.$understrap_builder_links_decoration.'}';
  }
  if($understrap_builder_links_rollover_color != '#380040'){
    $styles_to_display .= 'a:not(.btn):hover{color:'.$understrap_builder_links_rollover_color.'}';
  }
  if($understrap_builder_links_rollover_weight != 'normal'){
    $styles_to_display .= 'a:not(.btn):hover{font-weight:'.$understrap_builder_links_rollover_weight.'}';
  }
  if($understrap_builder_links_rollover_decoration != 'underline'){
    $styles_to_display .= 'a:not(.btn):hover{text-decoration:'.$understrap_builder_links_rollover_decoration.'}';
  }
  
  
  // Buttons
  $understrap_builder_buttons_curved_borders = get_option( 'understrap_builder_buttons_curved_borders', '0.25rem' );
  $understrap_builder_buttons_shadow = get_option( 'understrap_builder_buttons_shadow', 'none' );
  $understrap_builder_buttons_rollover = get_option( 'understrap_builder_buttons_rollover', 'none' );
  if($understrap_builder_buttons_curved_borders != '0.25rem'){
    $styles_to_display .= '.btn{border-radius:'.$understrap_builder_buttons_curved_borders.'!important}';
  }
  if($understrap_builder_buttons_shadow == 'sm'){
    $styles_to_display .= '.btn{-webkit-box-shadow: 1px 1px 4px 0px rgba(0,0,0,0.25);-moz-box-shadow: 1px 1px 4px 0px rgba(0,0,0,0.25);box-shadow: 1px 1px 4px 0px rgba(0,0,0,0.25);}';
  } else if($understrap_builder_buttons_shadow == 'md'){
    $styles_to_display .= '.btn{-webkit-box-shadow: 2px 2px 10px 0px rgba(0,0,0,0.35);-moz-box-shadow: 2px 2px 10px 0px rgba(0,0,0,0.35);box-shadow: 2px 2px 10px 0px rgba(0,0,0,0.35);}';
  } else if($understrap_builder_buttons_shadow == 'lg'){
    $styles_to_display .= '.btn{-webkit-box-shadow: 2px 2px 20px 0px rgba(0,0,0,0.45);-moz-box-shadow: 2px 2px 20px 0px rgba(0,0,0,0.45);box-shadow: 2px 2px 20px 0px rgba(0,0,0,0.45);}';
  }
  if($understrap_builder_buttons_rollover == 'brighten'){
    $styles_to_display .= '.btn:hover{filter:brightness(108%)!important}';
  } else if($understrap_builder_buttons_rollover == 'darken') {
    $styles_to_display .= '.btn:hover{filter:brightness(95%)!important}';
  } else if($understrap_builder_buttons_rollover == 'transparent') {
    $styles_to_display .= '.btn:hover{opacity:0.75!important;transition:opacity 0.4s;}';
  }
  

  // Hero
  $understrap_builder_hero_layout = get_option( 'understrap_builder_hero_layout', 'disabled');
  if($understrap_builder_hero_layout != 'disabled'){
    // Load additional hero styles if hero not disabled
    $understrap_builder_hero_vertical_margin = get_option( 'understrap_builder_hero_vertical_margin', 100);
    $understrap_builder_hero_vertical_margin_mobile = get_option( 'understrap_builder_hero_vertical_margin_mobile', 50);
    $understrap_builder_hero_bg_img = get_option( 'understrap_builder_hero_bg_img', '');
    $styles_to_display .= "#us_b_hero > div{margin-top:".esc_attr($understrap_builder_hero_vertical_margin)."px;margin-bottom:".esc_attr($understrap_builder_hero_vertical_margin)."px}";
    $styles_to_display .= "@media(max-width:768px){#us_b_hero > div{margin-top:".esc_attr($understrap_builder_hero_vertical_margin_mobile)."px;margin-bottom:".esc_attr($understrap_builder_hero_vertical_margin_mobile)."px}}";
    if($understrap_builder_hero_bg_img != ''){
      $understrap_builder_hero_bg_img_fixed = get_option( 'understrap_builder_hero_bg_img_fixed', 'default');
      $understrap_builder_hero_bg_img_fixed_add = '';
      if($understrap_builder_hero_bg_img_fixed != 'default'){ $understrap_builder_hero_bg_img_fixed_add = 'background-attachment:fixed;'; }
      $styles_to_display .= "#us_b_navbar_hero_wrap{background-image:url('".esc_url($understrap_builder_hero_bg_img)."');$understrap_builder_hero_bg_img_fixed_add}";
    }
  }
  
  // Animated burger
  $understrap_builder_mobile_hamburger_style = get_option( 'understrap_builder_mobile_hamburger_style', '');
  if($understrap_builder_mobile_hamburger_style == 'animate-spin'){
    $styles_to_display .= '.understrap_builder_navbar_toggler .top-bar{transform:rotate(-225deg);transform-origin:40% 180%}.understrap_builder_navbar_toggler .middle-bar{opacity:0}.understrap_builder_navbar_toggler .bottom-bar{transform:rotate(225deg);transform-origin:43% -90%}.understrap_builder_navbar_toggler.collapsed .top-bar{transform:rotate(0)}.understrap_builder_navbar_toggler.collapsed .middle-bar{opacity:1}.understrap_builder_navbar_toggler.collapsed .bottom-bar{transform:rotate(0)}';
  }
  if($understrap_builder_mobile_hamburger_style == 'animate-left'){
    $styles_to_display .= '.understrap_builder_navbar_toggler .top-bar{transform:rotate(-45deg);transform-origin:85% 100%}.understrap_builder_navbar_toggler .middle-bar{opacity:0}.understrap_builder_navbar_toggler .bottom-bar{transform:rotate(45deg);transform-origin:90% 10%}.understrap_builder_navbar_toggler.collapsed .top-bar{transform:rotate(0)}.understrap_builder_navbar_toggler.collapsed .middle-bar{opacity:1}.understrap_builder_navbar_toggler.collapsed .bottom-bar{transform:rotate(0)}';
  }
  if($understrap_builder_mobile_hamburger_style == 'animate-right'){
    $styles_to_display .= '.understrap_builder_navbar_toggler .top-bar{transform:rotate(45deg);transform-origin:10% 10%}.understrap_builder_navbar_toggler .middle-bar{opacity:0}.understrap_builder_navbar_toggler .bottom-bar{transform:rotate(-45deg);transform-origin:10% 90%}.understrap_builder_navbar_toggler.collapsed .top-bar{transform:rotate(0)}.understrap_builder_navbar_toggler.collapsed .middle-bar{opacity:1}.understrap_builder_navbar_toggler.collapsed .bottom-bar{transform:rotate(0)}';
  }
  
  // Footer
  $understrap_builder_footer_bg_img = get_option( 'understrap_builder_footer_bg_img', '' );
  if($understrap_builder_footer_bg_img != ''){
    $understrap_builder_footer_bg_img_fixed = get_option( 'understrap_builder_footer_bg_img_fixed', 'default');
    $understrap_builder_footer_bg_img_fixed_add = '';
    if($understrap_builder_footer_bg_img_fixed != 'default'){ $understrap_builder_footer_bg_img_fixed_add = 'background-attachment:fixed;'; }
    $styles_to_display .= "#wrapper-footer{background-image:url('".esc_url($understrap_builder_footer_bg_img)."');$understrap_builder_footer_bg_img_fixed_add}";
  }
  
  

  if($styles_to_display != ''){
  ?>
  <style><?php echo $styles_to_display; ?></style>
  <?php
  }
  
}

?>