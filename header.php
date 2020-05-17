<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package understrap-builder
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Load Customizer variables
$understrap_builder_container_type = get_theme_mod( 'understrap_builder_container_type', 'container');
$understrap_builder_container_header_type = get_theme_mod( 'understrap_builder_container_header_type', 'default');
$understrap_builder_hero_layout = get_theme_mod( 'understrap_builder_hero_layout', 'disabled');
$understrap_builder_hero_bg_class = get_theme_mod( 'understrap_builder_hero_bg_class', '');
$understrap_builder_navbar_type = get_theme_mod( 'understrap_builder_navbar_type', 'left-logo');
$understrap_builder_navbar_position = get_theme_mod( 'understrap_builder_navbar_position', 'default');
$understrap_builder_submenu_type = get_theme_mod( 'understrap_builder_submenu_type', 'none');
$understrap_builder_submenu_link_width = get_theme_mod( 'understrap_builder_submenu_link_width', 'thin');
$understrap_builder_submenu_mobile_show = get_theme_mod( 'understrap_builder_submenu_mobile_show', 'disabled');
$understrap_builder_submenu_home_show = get_theme_mod( 'understrap_builder_submenu_home_show', 'disabled');
$understrap_builder_navbar_search_show = get_theme_mod( 'understrap_builder_navbar_search_show', 'enabled');
$understrap_builder_navbar_cta_show = get_theme_mod( 'understrap_builder_navbar_cta_show', 0);
$understrap_builder_navbar_cta_bg = get_theme_mod( 'understrap_builder_navbar_cta_bg', 'disabled');
$understrap_builder_navbar_cta_text = get_theme_mod( 'understrap_builder_navbar_cta_text', 'Go Now');
$understrap_builder_navbar_cta_url = get_theme_mod( 'understrap_builder_navbar_cta_url', '#');
$understrap_builder_navbar_cta_fa_icon = get_theme_mod( 'understrap_builder_navbar_cta_fa_icon', '');
$understrap_builder_navbar_cta_fa_icon_side = get_theme_mod( 'understrap_builder_navbar_cta_fa_icon_side', 'right');
$understrap_builder_navbar_color_scheme = get_theme_mod( 'understrap_builder_navbar_color_scheme', 'navbar-dark');
$understrap_builder_navbar_bg_color = get_theme_mod( 'understrap_builder_navbar_bg_color', 'bg-primary');
$understrap_builder_navbar_bg_hero = get_theme_mod( 'understrap_builder_navbar_bg_hero', 'show');
$understrap_builder_submenu_color_scheme = get_theme_mod( 'understrap_builder_submenu_color_scheme', 'navbar-dark');
$understrap_builder_submenu_bg_color = get_theme_mod( 'understrap_builder_submenu_bg_color', 'bg-dark');
$understrap_builder_navbar_bottom_border = get_theme_mod( 'understrap_builder_navbar_bottom_border', 'default');
$understrap_builder_navbar_bottom_border_color = get_theme_mod( 'understrap_builder_navbar_bottom_border_color', 'dark');
$understrap_builder_mobile_navbar_breakpoint = get_theme_mod( 'understrap_builder_mobile_navbar_breakpoint', 'md');
$understrap_builder_navbar_align = get_theme_mod( 'understrap_builder_navbar_align', '');


global $builder_default_spacings;
$understrap_builder_spacings_navbar = get_theme_mod( 'understrap_builder_spacings_navbar', $builder_default_spacings );
$understrap_builder_spacings_navbar_submenu = get_theme_mod( 'understrap_builder_spacings_navbar_submenu', $builder_default_spacings );
$understrap_builder_spacings_navbar_logo = get_theme_mod( 'understrap_builder_spacings_navbar_logo', $builder_default_spacings );


// Handle container type
if($understrap_builder_container_header_type != 'default'){
  $understrap_builder_container_type = $understrap_builder_container_header_type;
}

// Handle navbar position
$us_b_wrapper_nav_class = '';
if($understrap_builder_navbar_position == 'top'){
  $us_b_wrapper_nav_class = ' fixed-top';
}
if($understrap_builder_navbar_position == 'bottom'){
  $us_b_wrapper_nav_class = ' fixed-bottom';
}

// Handle navbar bottom border or shadow
$us_b_navbar_border_shadow_class = '';
if(strstr($understrap_builder_navbar_bottom_border, 'border')){
  $understrap_builder_border_width = str_replace('border-','', $understrap_builder_navbar_bottom_border);
  $us_b_navbar_border_shadow_class = 'border-'.$understrap_builder_navbar_bottom_border_color.' us_b_b_border-'.$understrap_builder_border_width;
} else if(strstr($understrap_builder_navbar_bottom_border, 'shadow')) {
  $understrap_builder_shadow = str_replace('shadow-','', $understrap_builder_navbar_bottom_border);
  $us_b_navbar_border_shadow_class = ' us_b_b_shadow-'.$understrap_builder_shadow;
}

// Handle navbar and submenu background color
$us_b_navbar_background_class = $understrap_builder_navbar_bg_color;
$us_b_submenu_background_class = $understrap_builder_submenu_bg_color;
if($understrap_builder_navbar_bg_hero == 'transparent' && is_front_page()){
  $us_b_navbar_background_class = '';
  $us_b_submenu_background_class = '';
  $us_b_navbar_border_shadow_class = '';
}

// Handle submenu link width
$us_b_submenu_link_width_menu_class_add = '';
if($understrap_builder_submenu_link_width == 'medium'){ $us_b_submenu_link_width_menu_class_add .= ' us_b_subm_medium'; }
if($understrap_builder_submenu_link_width == 'wide'){ $us_b_submenu_link_width_menu_class_add .= ' us_b_subm_wide'; }
if($understrap_builder_submenu_link_width == 'fill'){ $us_b_submenu_link_width_menu_class_add .= ' w-100 nav-fill'; }

// Handle submenu mobile show
$understrap_builder_submenu_classes = 'navbar-expand';
if($understrap_builder_submenu_mobile_show == 0){
  $understrap_builder_submenu_classes .= '-md';
}
if($understrap_builder_submenu_home_show == 0 && is_front_page()){
  $understrap_builder_submenu_classes .= ' d-none';
}

// Handle navbar CTA icon
$understrap_builder_navbar_cta_fa_icon_string = '';
if($understrap_builder_navbar_cta_fa_icon != ''){
  if($understrap_builder_navbar_cta_fa_icon_side == 'left'){
    $understrap_builder_navbar_cta_fa_icon_string = 'mr-1 fa fa-'.esc_attr($understrap_builder_navbar_cta_fa_icon);
  } else {
    $understrap_builder_navbar_cta_fa_icon_string = 'ml-1 fa fa-'.esc_attr($understrap_builder_navbar_cta_fa_icon);
  }
}

// Handle navbar align
$understrap_builder_navbar_align_class = 'ml-auto';
if($understrap_builder_navbar_align == 'center'){
  $understrap_builder_navbar_align_class = 'mx-auto';
} else if($understrap_builder_navbar_align == 'left'){
  $understrap_builder_navbar_align_class = 'mr-auto';
}

?>
<!DOCTYPE html>

<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
  <?php understrap_builder_in_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php do_action( 'wp_body_open' ); ?>
<div class="site" id="page">
  
  <?php if(is_front_page() && $understrap_builder_hero_layout != 'disabled'){ ?>
  <div id="us_b_navbar_hero_wrap" class="<?php echo esc_attr($understrap_builder_hero_bg_class); ?>">
  <?php } ?>

	<!-- ******************* The Navbar Area ******************* -->
	<div id="wrapper-navbar" itemscope itemtype="http://schema.org/WebSite" class="wrapper-navbar<?php echo esc_attr($us_b_wrapper_nav_class); ?>">
    
    <div id="us_b_navbar_border_shadow" class="position-relative <?php echo esc_attr($us_b_navbar_border_shadow_class); ?>">

      <a class="skip-link sr-only sr-only-focusable" href="#content"><?php esc_html_e( 'Skip to content', 'understrap-builder' ); ?></a>

      <?php if($understrap_builder_navbar_type == 'left-logo'){ /* ============== MAIN MENUS ================ The left hand logo navbar type */ ?>

        <nav class="navbar navbar-expand-<?php echo esc_attr($understrap_builder_mobile_navbar_breakpoint); ?> <?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_navbar)); ?> <?php echo esc_attr($understrap_builder_navbar_color_scheme); ?> <?php echo esc_attr($us_b_navbar_background_class); ?> us_b_main_menu main_menu_left">      

          <div class="<?php echo esc_attr($understrap_builder_container_type, 'understrap-builder'); ?>">

            <!-- Your site title as branding in the menu -->
            <?php if ( ! has_custom_logo() ) { ?>

              <?php if ( is_front_page() && is_home() ) : ?>

                <h1 class="navbar-brand <?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_navbar_logo)); ?>"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>

              <?php else : ?>

                <a class="navbar-brand <?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_navbar_logo)); ?>" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a>

              <?php endif; ?>


            <?php } else {
              genesis_custom_logo_setup();
            } ?><!-- end custom logo -->

            
            <?php if(($us_b_locations = get_nav_menu_locations()) && $us_b_locations['primary'] != 0) { ?>
            
              <button class="navbar-toggler understrap_builder_navbar_toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'understrap-builder' ); ?>">
                <span class="understrap_builder_icon_bar top-bar"></span>
                <span class="understrap_builder_icon_bar middle-bar"></span>
                <span class="understrap_builder_icon_bar bottom-bar"></span>				
              </button>
            
              <?php wp_nav_menu(
                array(
                  'theme_location'  => 'primary',
                  'container_class' => 'collapse navbar-collapse',
                  'container_id'    => 'navbarNavDropdown',
                  'menu_class'      => 'navbar-nav '.esc_attr($understrap_builder_navbar_align_class),
                  'fallback_cb'     => '',
                  'menu_id'         => 'main-menu',
                  'depth'           => 3,
                  'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
                )
              ); ?>
            
            <?php } else { ?>
              
              <?php if(is_customize_preview()){ ?>
                <div class="alert alert-danger mt-2" role="alert" style="font-size:14px">
                  Don't forget to add a menu to the location "Primary Menu".
                  This message isn't shown on the front end.
                </div>
              <?php } ?>
              
            <?php } ?>

            <?php if($understrap_builder_navbar_cta_show != 0){ ?>
              <a href="<?php echo esc_attr($understrap_builder_navbar_cta_url); ?>" 
                 class="btn btn-<?php echo esc_attr($understrap_builder_navbar_cta_bg); ?> ml-3 d-none d-<?php echo esc_attr($understrap_builder_mobile_navbar_breakpoint); ?>-inline px-3 py-2<?php if($understrap_builder_navbar_search_show == 1){ echo ' mr-3'; } ?>" id="us_b_navbar_cta">
                
                <?php if($understrap_builder_navbar_cta_fa_icon_side == 'left'){ ?>
                  <i class="<?php echo esc_attr($understrap_builder_navbar_cta_fa_icon_string); ?>"></i> 
                <?php } ?>
                
                <?php echo esc_attr($understrap_builder_navbar_cta_text); ?> 
                
                <?php if($understrap_builder_navbar_cta_fa_icon_side == 'right'){ ?>
                  <i class="<?php echo esc_attr($understrap_builder_navbar_cta_fa_icon_string); ?> "></i> 
                <?php } ?>
                
              </a>
            <?php } ?>

            <?php if($understrap_builder_navbar_search_show == 1){ ?>
              <form class="form-inline ml-3 d-none d-<?php echo esc_attr($understrap_builder_mobile_navbar_breakpoint); ?>-inline" _lpchecked="1" action="<?php echo esc_url(home_url('/')); ?>" method="get" id="us_b_search">
                <input class="form-control" type="text" placeholder="<?php esc_attr_e( 'Search', 'understrap' ); ?>" aria-label="<?php esc_attr_e( 'Search', 'understrap' ); ?>" name="s" />
              </form>
            <?php } ?>

          </div>

        </nav>

      <?php } else if($understrap_builder_navbar_type == 'right-logo'){ /* The right hand logo navbar type */ ?>

        <nav class="navbar navbar-expand-<?php echo esc_attr($understrap_builder_mobile_navbar_breakpoint); ?> <?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_navbar)); ?> <?php echo esc_attr($understrap_builder_navbar_color_scheme); ?> <?php echo esc_attr($us_b_navbar_background_class); ?> 
                    <?php echo esc_attr($us_b_navbar_border_shadow_class); ?> us_b_main_menu main_menu_right">

          <div class="<?php echo esc_attr($understrap_builder_container_type, 'understrap-builder'); ?>">

            <?php if($understrap_builder_navbar_search_show == 1){ ?>
              <form class="form-inline mr-3 d-none d-<?php echo esc_attr($understrap_builder_mobile_navbar_breakpoint); ?>-inline" _lpchecked="1" action="<?php echo esc_url(home_url('/')); ?>" method="get" id="us_b_search">
                <input class="form-control" type="text" placeholder="<?php esc_attr_e( 'Search', 'understrap' ); ?>" aria-label="<?php esc_attr_e( 'Search', 'understrap' ); ?>" name="s" />
              </form>
            <?php } ?>

            <?php if($understrap_builder_navbar_cta_show != 0){ ?>
              <a href="<?php echo esc_attr($understrap_builder_navbar_cta_url); ?>" class="btn btn-<?php echo esc_attr($understrap_builder_navbar_cta_bg); ?> mr-3 d-none d-<?php echo esc_attr($understrap_builder_mobile_navbar_breakpoint); ?>-inline px-3 py-2" id="us_b_navbar_cta">
                
                <?php if($understrap_builder_navbar_cta_fa_icon_side == 'left'){ ?>
                  <i class="<?php echo esc_attr($understrap_builder_navbar_cta_fa_icon_string); ?>"></i> 
                <?php } ?>
                
                <?php echo esc_attr($understrap_builder_navbar_cta_text); ?> 
                
                <?php if($understrap_builder_navbar_cta_fa_icon_side == 'right'){ ?>
                  <i class="<?php echo esc_attr($understrap_builder_navbar_cta_fa_icon_string); ?> "></i> 
                <?php } ?>
                
              </a>
            <?php } ?>
            
            <?php if(($us_b_locations = get_nav_menu_locations()) && $us_b_locations['primary'] != 0) { ?>

              <!-- The WordPress Menu goes here -->
              <?php wp_nav_menu(
                array(
                  'theme_location'  => 'primary',
                  'container_class' => 'collapse navbar-collapse',
                  'container_id'    => 'navbarNavDropdown',
                  'menu_class'      => 'navbar-nav '.esc_attr($understrap_builder_navbar_align_class),
                  'fallback_cb'     => '',
                  'menu_id'         => 'main-menu',
                  'depth'           => 2,
                  'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
                )
              ); ?>

              <button class="navbar-toggler understrap_builder_navbar_toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'understrap-builder' ); ?>">
                <span class="understrap_builder_icon_bar top-bar"></span>
                <span class="understrap_builder_icon_bar middle-bar"></span>
                <span class="understrap_builder_icon_bar bottom-bar"></span>				
              </button>
            
            <?php } else { ?>
            
              <?php if(is_customize_preview()){ ?>
                <div class="alert alert-danger mt-2" role="alert" style="font-size:14px">
                  Don't forget to add a menu to the location "Primary Menu". 
                  This message isn't shown on the front end.
                </div>
              <?php } ?>
              
            <?php } ?>

            <!-- Your site title as branding in the menu -->
            <?php if ( ! has_custom_logo() ) { ?>

              <?php if ( is_front_page() && is_home() ) : ?>

                <h1 class="navbar-brand <?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_navbar_logo)); ?>"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>

              <?php else : ?>

                <a class="navbar-brand <?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_navbar_logo)); ?>" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a>

              <?php endif; ?>


            <?php } else {
              genesis_custom_logo_setup();
            } ?><!-- end custom logo -->

          </div>

        </nav>

      <?php } else if($understrap_builder_navbar_type == 'left-logo-dual-row'){ /* The left hand logo with dual right rows navbar type */ ?>

        <nav class="navbar navbar-expand-<?php echo esc_attr($understrap_builder_mobile_navbar_breakpoint); ?> <?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_navbar)); ?> <?php echo esc_attr($understrap_builder_navbar_color_scheme); ?> <?php echo esc_attr($us_b_navbar_background_class); ?> us_b_main_menu main_menu_left_dual_row">      

          <div class="<?php echo esc_attr($understrap_builder_container_type, 'understrap-builder'); ?>">

            <!-- Your site title as branding in the menu -->
            <?php if ( ! has_custom_logo() ) { ?>

              <?php if ( is_front_page() && is_home() ) : ?>

                <h1 class="navbar-brand <?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_navbar_logo)); ?>"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>

              <?php else : ?>

                <a class="navbar-brand <?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_navbar_logo)); ?>" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a>

              <?php endif; ?>


            <?php } else {
              genesis_custom_logo_setup();
            } ?><!-- end custom logo -->

            
            <div class="flex-column">
              
              <div class="flex-row us_b_dual_row_1 mt-3 text-right">
                
                <?php if($understrap_builder_navbar_cta_show != 0){ ?>
                  <a href="<?php echo esc_attr($understrap_builder_navbar_cta_url); ?>" 
                     class="btn btn-<?php echo esc_attr($understrap_builder_navbar_cta_bg); ?> ml-3 d-none d-<?php echo esc_attr($understrap_builder_mobile_navbar_breakpoint); ?>-inline px-3 py-2<?php if($understrap_builder_navbar_search_show == 1){ echo ' mr-3'; } ?>" id="us_b_navbar_cta">

                    <?php if($understrap_builder_navbar_cta_fa_icon_side == 'left'){ ?>
                      <i class="<?php echo esc_attr($understrap_builder_navbar_cta_fa_icon_string); ?>"></i> 
                    <?php } ?>

                    <?php echo esc_attr($understrap_builder_navbar_cta_text); ?> 

                    <?php if($understrap_builder_navbar_cta_fa_icon_side == 'right'){ ?>
                      <i class="<?php echo esc_attr($understrap_builder_navbar_cta_fa_icon_string); ?> "></i> 
                    <?php } ?>

                  </a>
                <?php } ?>

                <?php if($understrap_builder_navbar_search_show == 1){ ?>
                  <form class="form-inline ml-3 d-none d-<?php echo esc_attr($understrap_builder_mobile_navbar_breakpoint); ?>-inline" _lpchecked="1" action="<?php echo esc_url(home_url('/')); ?>" method="get" id="us_b_search">
                    <input class="form-control" type="text" placeholder="<?php esc_attr_e( 'Search', 'understrap' ); ?>" aria-label="<?php esc_attr_e( 'Search', 'understrap' ); ?>" name="s" />
                  </form>
                <?php } ?>
                
              </div>
              
              <div class="flex-row us_b_dual_row_1 mt-3 text-right text-<?php echo esc_attr($understrap_builder_mobile_navbar_breakpoint); ?>-left">

                <?php if(($us_b_locations = get_nav_menu_locations()) && $us_b_locations['primary'] != 0) { ?>

                  <button class="navbar-toggler understrap_builder_navbar_toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'understrap-builder' ); ?>">
                    <span class="understrap_builder_icon_bar top-bar"></span>
                    <span class="understrap_builder_icon_bar middle-bar"></span>
                    <span class="understrap_builder_icon_bar bottom-bar"></span>				
                  </button>

                  <!-- The WordPress Menu goes here -->
                  <?php wp_nav_menu(
                    array(
                      'theme_location'  => 'primary',
                      'container_class' => 'collapse navbar-collapse',
                      'container_id'    => 'navbarNavDropdown',
                      'menu_class'      => 'navbar-nav '.esc_attr($understrap_builder_navbar_align_class),
                      'fallback_cb'     => '',
                      'menu_id'         => 'main-menu',
                      'depth'           => 2,
                      'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
                    )
                  ); ?>

                <?php } else { ?>

                  <?php if(is_customize_preview()){ ?>
                    <div class="alert alert-danger mt-2" role="alert" style="font-size:14px">
                      Don't forget to add a menu to the location "Primary Menu". 
                      This message isn't shown on the front end.
                    </div>
                  <?php } ?>

                <?php } ?>

              </div>
              
            </div>

          </div>

        </nav>

      <?php } else if($understrap_builder_navbar_type == 'right-logo-dual-row'){ /* The right hand logo with dual left rows navbar type */ ?>

        <nav class="navbar navbar-expand-<?php echo esc_attr($understrap_builder_mobile_navbar_breakpoint); ?> <?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_navbar)); ?> <?php echo esc_attr($understrap_builder_navbar_color_scheme); ?> <?php echo esc_attr($us_b_navbar_background_class); ?> 
                    <?php echo esc_attr($us_b_navbar_border_shadow_class); ?> us_b_main_menu main_menu_right_dual_row">

          <div class="<?php echo esc_attr($understrap_builder_container_type, 'understrap-builder'); ?>">
            
            <div class="flex-column">
              
              <div class="flex-row us_b_dual_row_1 mt-3">

                <?php if($understrap_builder_navbar_search_show == 1){ ?>
                  <form class="form-inline mr-3 ml-2 d-none d-<?php echo esc_attr($understrap_builder_mobile_navbar_breakpoint); ?>-inline" _lpchecked="1" action="<?php echo esc_url(home_url('/')); ?>" method="get" id="us_b_search">
                    <input class="form-control" type="text" placeholder="<?php esc_attr_e( 'Search', 'understrap' ); ?>" aria-label="<?php esc_attr_e( 'Search', 'understrap' ); ?>" name="s" />
                  </form>
                <?php } ?>

                <?php if($understrap_builder_navbar_cta_show != 0){ ?>
                  <a href="<?php echo esc_attr($understrap_builder_navbar_cta_url); ?>" class="btn btn-<?php echo esc_attr($understrap_builder_navbar_cta_bg); ?> ml-2 mr-3 d-none d-<?php echo esc_attr($understrap_builder_mobile_navbar_breakpoint); ?>-inline px-3 py-2" id="us_b_navbar_cta">

                    <?php if($understrap_builder_navbar_cta_fa_icon_side == 'left'){ ?>
                      <i class="<?php echo esc_attr($understrap_builder_navbar_cta_fa_icon_string); ?>"></i> 
                    <?php } ?>

                    <?php echo esc_attr($understrap_builder_navbar_cta_text); ?> 

                    <?php if($understrap_builder_navbar_cta_fa_icon_side == 'right'){ ?>
                      <i class="<?php echo esc_attr($understrap_builder_navbar_cta_fa_icon_string); ?> "></i> 
                    <?php } ?>

                  </a>
                <?php } ?>
                
              </div>
              
              <div class="flex-row us_b_dual_row_1 mt-3">

                <?php if(($us_b_locations = get_nav_menu_locations()) && $us_b_locations['primary'] != 0) { ?>
                
                  <button class="navbar-toggler understrap_builder_navbar_toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'understrap-builder' ); ?>">
                    <span class="understrap_builder_icon_bar top-bar"></span>
                    <span class="understrap_builder_icon_bar middle-bar"></span>
                    <span class="understrap_builder_icon_bar bottom-bar"></span>				
                  </button>

                  <!-- The WordPress Menu goes here -->
                  <?php wp_nav_menu(
                    array(
                      'theme_location'  => 'primary',
                      'container_class' => 'collapse navbar-collapse',
                      'container_id'    => 'navbarNavDropdown',
                      'menu_class'      => 'navbar-nav '.esc_attr($understrap_builder_navbar_align_class),
                      'fallback_cb'     => '',
                      'menu_id'         => 'main-menu',
                      'depth'           => 2,
                      'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
                    )
                  ); ?>

                <?php } else { ?>

                  <?php if(is_customize_preview()){ ?>
                    <div class="alert alert-danger mt-2" role="alert" style="font-size:14px">
                      Don't forget to add a menu to the location "Primary Menu". 
                      This message isn't shown on the front end.
                    </div>
                  <?php } ?>

                <?php } ?>
                
              </div>
              
            </div>

            <!-- Your site title as branding in the menu -->
            <?php if ( ! has_custom_logo() ) { ?>

              <?php if ( is_front_page() && is_home() ) : ?>

                <h1 class="navbar-brand <?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_navbar_logo)); ?>"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>

              <?php else : ?>

                <a class="navbar-brand <?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_navbar_logo)); ?>" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a>

              <?php endif; ?>


            <?php } else {
              genesis_custom_logo_setup();
            } ?><!-- end custom logo -->

          </div>

        </nav>
      
      <?php } else if($understrap_builder_navbar_type == 'center-logo-inside'){ /* The center logo with inside aligned menus type */ ?>

        <nav class="navbar navbar-expand-<?php echo esc_attr($understrap_builder_mobile_navbar_breakpoint); ?> <?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_navbar)); ?> <?php echo esc_attr($understrap_builder_navbar_color_scheme); ?> <?php echo esc_attr($us_b_navbar_background_class); ?> 
                    <?php echo esc_attr($us_b_navbar_border_shadow_class); ?> us_b_main_menu main_menu_center_inside">

          <div class="<?php echo esc_attr($understrap_builder_container_type, 'understrap-builder'); ?>">
            
            <?php if(($us_b_locations = get_nav_menu_locations()) && $us_b_locations['primary'] != 0) { ?>

              <button class="navbar-toggler understrap_builder_navbar_toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'understrap-builder' ); ?>">
                <span class="understrap_builder_icon_bar top-bar"></span>
                <span class="understrap_builder_icon_bar middle-bar"></span>
                <span class="understrap_builder_icon_bar bottom-bar"></span>				
              </button>

              <div class="navbar-collapse collapse w-25 order-2 order-<?php echo esc_attr($understrap_builder_mobile_navbar_breakpoint); ?>-0" id="navbarNavDropdown">
                <?php wp_nav_menu(
                  array(
                    'theme_location'  => 'primary',
                    'container_id'    => '',
                    'menu_class'      => 'navbar-nav '.esc_attr($understrap_builder_navbar_align_class),
                    'fallback_cb'     => '',
                    'menu_id'         => 'main-menu',
                    'depth'           => 2,
                    'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
                  )
                ); ?>
              </div>
            
            <?php } else { ?>
            
              <?php if(is_customize_preview()){ ?>
                <div class="alert alert-danger mt-2" role="alert" style="font-size:14px">
                  Don't forget to add a menu to the location "Primary Menu". 
                  This message isn't shown on the front end.
                </div>
              <?php } ?>
              
            <?php } ?>

            <div class="mx-auto order-1 w-50">

              <!-- Your site title as branding in the menu -->
              <?php if ( ! has_custom_logo() ) { ?>

                <?php if ( is_front_page() && is_home() ) : ?>

                  <h1 class="navbar-brand <?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_navbar_logo)); ?>"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>

                <?php else : ?>

                  <a class="navbar-brand <?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_navbar_logo)); ?>" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a>

                <?php endif; ?>

              <?php } else { ?>

                <div class="text-center">
                  <?php genesis_custom_logo_setup(); ?>
                </div>

              <?php } ?><!-- end custom logo -->

            </div>

            <div class="navbar-collapse collapse w-25 order-2 dual-collapse2">

              <?php if($understrap_builder_navbar_cta_show != 0){ ?>
                <a href="<?php echo esc_attr($understrap_builder_navbar_cta_url); ?>" 
                   class="btn btn-<?php echo esc_attr($understrap_builder_navbar_cta_bg); ?> ml-auto d-none d-lg-inline px-3 py-2<?php if($understrap_builder_navbar_search_show == 1){ echo ' mr-3'; } ?>" id="us_b_navbar_cta">

                  <?php if($understrap_builder_navbar_cta_fa_icon_side == 'left'){ ?>
                    <i class="<?php echo esc_attr($understrap_builder_navbar_cta_fa_icon_string); ?>"></i> 
                  <?php } ?>

                  <?php echo esc_attr($understrap_builder_navbar_cta_text); ?> 

                  <?php if($understrap_builder_navbar_cta_fa_icon_side == 'right'){ ?>
                    <i class="<?php echo esc_attr($understrap_builder_navbar_cta_fa_icon_string); ?> "></i> 
                  <?php } ?>

                </a>
              <?php } ?>
              <?php if($understrap_builder_navbar_search_show == 1){ ?>
                <form class="form-inline d-none d-lg-inline ml-auto" _lpchecked="1" action="<?php echo esc_url(home_url('/')); ?>" method="get" id="us_b_search">
                  <input class="form-control" type="text" placeholder="<?php esc_attr_e( 'Search', 'understrap' ); ?>" aria-label="<?php esc_attr_e( 'Search', 'understrap' ); ?>" name="s" />
                </form>
              <?php } ?>

            </div>

          </div>
        </nav>

      <?php } else if($understrap_builder_navbar_type == 'center-logo-outside'){ /* The center logo with outside aligned menus type */ ?>

        <nav class="navbar navbar-expand-<?php echo esc_attr($understrap_builder_mobile_navbar_breakpoint); ?> <?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_navbar)); ?> <?php echo esc_attr($understrap_builder_navbar_color_scheme); ?> <?php echo esc_attr($us_b_navbar_background_class); ?> 
                    <?php echo esc_attr($us_b_navbar_border_shadow_class); ?> us_b_main_menu main_menu_center_outside">

          <div class="<?php echo esc_attr($understrap_builder_container_type, 'understrap-builder'); ?>">

            <?php if(($us_b_locations = get_nav_menu_locations()) && $us_b_locations['primary'] != 0) { ?>
            
              <div class="navbar-collapse collapse w-100 order-2 order-<?php echo esc_attr($understrap_builder_mobile_navbar_breakpoint); ?>-0 dual-collapse2" id="navbarNavDropdown">
                <?php wp_nav_menu(
                  array(
                    'theme_location'  => 'primary',
                    'container_class' => '',
                    'container_id'    => '',
                    'menu_class'      => 'navbar-nav '.esc_attr($understrap_builder_navbar_align_class),
                    'fallback_cb'     => '',
                    'menu_id'         => 'main-menu',
                    'depth'           => 2,
                    'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
                  )
                ); ?>
              </div>
            
            <?php } else { ?>
            
              <?php if(is_customize_preview()){ ?>
                <div class="alert alert-danger mt-2" role="alert" style="font-size:14px">
                  Don't forget to add a menu to the location "Primary Menu". 
                  This message isn't shown on the front end.
                </div>
              <?php } ?>
            
            <?php } ?>

            <div class="mx-auto order-1 w-25">

              <!-- Your site title as branding in the menu -->
              <?php if ( ! has_custom_logo() ) { ?>

                <?php if ( is_front_page() && is_home() ) : ?>

                  <h1 class="navbar-brand <?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_navbar_logo)); ?>"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>

                <?php else : ?>

                  <a class="navbar-brand <?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_navbar_logo)); ?>" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a>

                <?php endif; ?>

              <?php } else { ?>

                <div class="text-center">
                  <?php genesis_custom_logo_setup(); ?>
                </div>

              <?php } ?><!-- end custom logo -->

            </div>
            
            <?php if(($us_b_locations = get_nav_menu_locations()) && ($us_b_locations['primary'] != 0 || $us_b_locations['us_b_additonal_primary_menu'] != 0)) { ?>

              <button class="navbar-toggler understrap_builder_navbar_toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'understrap-builder' ); ?>">
                <span class="understrap_builder_icon_bar top-bar"></span>
                <span class="understrap_builder_icon_bar middle-bar"></span>
                <span class="understrap_builder_icon_bar bottom-bar"></span>				
              </button>
            
            <?php } ?>

            <div class="navbar-collapse collapse w-100 order-2 dual-collapse2">

              <?php if(($us_b_locations = get_nav_menu_locations()) && $us_b_locations['us_b_additonal_primary_menu'] != 0) { ?>
              
                <?php wp_nav_menu(
                  array(
                    'theme_location'  => 'us_b_additonal_primary_menu',
                    'container_class' => 'ml-auto',
                    'container_id'    => 'navbarNavDropdownAdditional',
                    'menu_class'      => 'navbar-nav '.esc_attr($understrap_builder_navbar_align_class),
                    'fallback_cb'     => '',
                    'menu_id'         => 'additional-main-menu',
                    'depth'           => 2,
                    'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
                  )
                ); ?>
              
              <?php } else { ?>
              
                <?php if(is_customize_preview()){ ?>
                  <div class="alert alert-danger mt-2" role="alert" style="font-size:14px">
                    Don't forget to add a menu to the location "Additional Primary Menu". 
                    This message isn't shown on the front end.
                  </div>
                <?php } ?>
              
              <?php } ?>

              <?php if($understrap_builder_navbar_cta_show != 0){ ?>
                <a href="<?php echo esc_attr($understrap_builder_navbar_cta_url); ?>" class="btn btn-<?php echo esc_attr($understrap_builder_navbar_cta_bg); ?> ml-auto d-none d-lg-inline px-3 py-2 mr-3" id="us_b_navbar_cta">
                  
                  <?php if($understrap_builder_navbar_cta_fa_icon_side == 'left'){ ?>
                    <i class="<?php echo esc_attr($understrap_builder_navbar_cta_fa_icon_string); ?>"></i> 
                  <?php } ?>

                  <?php echo esc_attr($understrap_builder_navbar_cta_text); ?> 

                  <?php if($understrap_builder_navbar_cta_fa_icon_side == 'right'){ ?>
                    <i class="<?php echo esc_attr($understrap_builder_navbar_cta_fa_icon_string); ?> "></i> 
                  <?php } ?>
                  
                </a>
              <?php } ?>

              <?php if($understrap_builder_navbar_search_show == 1){ ?>
                <form class="form-inline d-none d-lg-inline ml-auto" _lpchecked="1" action="<?php echo esc_url(home_url('/')); ?>" method="get" id="us_b_search">
                  <input class="form-control" type="text" placeholder="<?php esc_attr_e( 'Search', 'understrap' ); ?>" aria-label="<?php esc_attr_e( 'Search', 'understrap' ); ?>" name="s" />
                </form>
              <?php } ?>

            </div>

          </div>
        </nav>

      <?php } else if($understrap_builder_navbar_type == 'center-logo-below'){ /* The center logo with main menu below */ ?>

        <nav class="navbar navbar-expand-<?php echo esc_attr($understrap_builder_mobile_navbar_breakpoint); ?> <?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_navbar)); ?> <?php echo esc_attr($understrap_builder_navbar_color_scheme); ?> 
                    <?php echo esc_attr($us_b_navbar_background_class); ?> us_b_main_menu main_menu_center_below_top">

          <div class="<?php echo esc_attr($understrap_builder_container_type, 'understrap-builder'); ?>">

            <div class="order-0 w-25 d-none d-<?php echo esc_attr($understrap_builder_mobile_navbar_breakpoint); ?>-flex"></div>
            
            <div class="mx-auto order-1 w-50">

              <!-- Your site title as branding in the menu -->
              <?php if ( ! has_custom_logo() ) { ?>

                <?php if ( is_front_page() && is_home() ) : ?>

                  <h1 class="navbar-brand <?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_navbar_logo)); ?>"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>

                <?php else : ?>

                  <a class="navbar-brand <?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_navbar_logo)); ?>" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a>

                <?php endif; ?>

              <?php } else { ?>

                <div class="text-center">
                  <?php genesis_custom_logo_setup(); ?>
                </div>

              <?php } ?><!-- end custom logo -->

            </div>
            
            <div class="navbar-collapse collapse w-25 order-2 dual-collapse2">

              <?php if($understrap_builder_navbar_cta_show != 0){ ?>
                <a href="<?php echo esc_attr($understrap_builder_navbar_cta_url); ?>" 
                   class="btn btn-<?php echo esc_attr($understrap_builder_navbar_cta_bg); ?> ml-auto d-none d-lg-inline px-3 py-2<?php if($understrap_builder_navbar_search_show == 1){ echo ' mr-3'; } ?>" id="us_b_navbar_cta">

                  <?php if($understrap_builder_navbar_cta_fa_icon_side == 'left'){ ?>
                    <i class="<?php echo esc_attr($understrap_builder_navbar_cta_fa_icon_string); ?>"></i> 
                  <?php } ?>

                  <?php echo esc_attr($understrap_builder_navbar_cta_text); ?> 

                  <?php if($understrap_builder_navbar_cta_fa_icon_side == 'right'){ ?>
                    <i class="<?php echo esc_attr($understrap_builder_navbar_cta_fa_icon_string); ?> "></i> 
                  <?php } ?>

                </a>
              <?php } ?>
              <?php if($understrap_builder_navbar_search_show == 1){ ?>
                <form class="form-inline d-none d-lg-inline ml-auto" _lpchecked="1" action="<?php echo esc_url(home_url('/')); ?>" method="get" id="us_b_search">
                  <input class="form-control" type="text" placeholder="<?php esc_attr_e( 'Search', 'understrap' ); ?>" aria-label="<?php esc_attr_e( 'Search', 'understrap' ); ?>" name="s" />
                </form>
              <?php } ?>

            </div>
            
            <?php if(($us_b_locations = get_nav_menu_locations()) && $us_b_locations['primary'] != 0) { ?>
            
              <button class="navbar-toggler understrap_builder_navbar_toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'understrap-builder' ); ?>">
                <span class="understrap_builder_icon_bar top-bar"></span>
                <span class="understrap_builder_icon_bar middle-bar"></span>
                <span class="understrap_builder_icon_bar bottom-bar"></span>				
              </button>
            
            <?php } ?>

          </div>
        </nav>        
            
        <?php if(($us_b_locations = get_nav_menu_locations()) && $us_b_locations['primary'] != 0) { ?>

          <nav class="navbar navbar-expand-<?php echo esc_attr($understrap_builder_mobile_navbar_breakpoint); ?> <?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_navbar)); ?> <?php echo esc_attr($understrap_builder_navbar_color_scheme); ?> <?php echo esc_attr($us_b_navbar_background_class); ?> 
                              <?php echo esc_attr($us_b_navbar_border_shadow_class); ?> us_b_main_menu main_menu_center_below_bottom">
            <div class="<?php echo esc_attr($understrap_builder_container_type, 'understrap-builder'); ?>">
              <div class="navbar-collapse collapse" id="navbarNavDropdown">
                <?php wp_nav_menu(
                  array(
                    'theme_location'  => 'primary',
                    'container'       => false,
                    'menu_class'      => 'navbar-nav '.esc_attr($understrap_builder_navbar_align_class),
                    'fallback_cb'     => '',
                    'menu_id'         => 'main-menu',
                    'depth'           => 2,
                    'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
                  )
                ); ?>
              </div>
            </div>
          </nav>

        <?php } else { ?>

          <?php if(is_customize_preview()){ ?>
            <div class="text-center">
              <div class="alert alert-danger mt-2 text-center d-inline-block" role="alert" style="font-size:14px">
                Don't forget to add a menu to the location "Primary Menu". 
                This message isn't shown on the front end.
              </div>
            </div>
          <?php } ?>

        <?php } ?>
      
      <?php } ?>
      


      <?php if($understrap_builder_submenu_type == 'left'){ /* ============== SUBMENUS ================ The left hand submenu type */  ?>

        <nav class="navbar <?php echo esc_attr($understrap_builder_submenu_classes); ?> <?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_navbar_submenu)); ?> <?php echo esc_attr($understrap_builder_submenu_color_scheme); ?> <?php echo esc_attr($us_b_submenu_background_class); ?> p-0 us_b_submenu submenu_left">

          <div class="<?php echo esc_attr($understrap_builder_container_type, 'understrap-builder'); ?>">
            <!-- The WordPress Menu goes here -->
            <?php wp_nav_menu(
              array(
                'theme_location'  => 'us_b_submenu',
                'container_class' => 'collapse navbar-collapse',
                'container_id'    => 'navbarNavDropdownSubmenu',
                'menu_class'      => 'navbar-nav align-items-start nav-fill'.$us_b_submenu_link_width_menu_class_add,
                'fallback_cb'     => '',
                'menu_id'         => 'main-menu',
                'depth'           => 2,
                'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
              )
            ); ?>
          </div>

        </nav>

      <?php } else if($understrap_builder_submenu_type == 'right'){ /* The right hand submenu type */  ?>

        <nav class="navbar <?php echo esc_attr($understrap_builder_submenu_classes); ?> <?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_navbar_submenu)); ?> <?php echo esc_attr($understrap_builder_submenu_color_scheme); ?> <?php echo esc_attr($us_b_submenu_background_class); ?> p-0 us_b_submenu submenu_right">

          <div class="<?php echo esc_attr($understrap_builder_container_type, 'understrap-builder'); ?>">
            <!-- The WordPress Menu goes here -->
            <?php wp_nav_menu(
              array(
                'theme_location'  => 'us_b_submenu',
                'container_class' => 'collapse navbar-collapse',
                'container_id'    => 'navbarNavDropdownSubmenu',
                'menu_class'      => 'navbar-nav align-items-start nav-fill ml-auto'.$us_b_submenu_link_width_menu_class_add,
                'fallback_cb'     => '',
                'menu_id'         => 'main-menu',
                'depth'           => 2,
                'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
              )
            ); ?>
          </div>

        </nav>

      <?php } else if($understrap_builder_submenu_type == 'center'){ /* The center aligned submenu type */  ?>

        <nav class="navbar <?php echo esc_attr($understrap_builder_submenu_classes); ?> <?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_navbar_submenu)); ?> <?php echo esc_attr($understrap_builder_submenu_color_scheme); ?> <?php echo esc_attr($us_b_submenu_background_class); ?> p-0 us_b_submenu submenu_center">

          <div class="<?php echo esc_attr($understrap_builder_container_type, 'understrap-builder'); ?>">
            <!-- The WordPress Menu goes here -->
            <?php wp_nav_menu(
              array(
                'theme_location'  => 'us_b_submenu',
                'container_class' => 'collapse navbar-collapse',
                'container_id'    => 'navbarNavDropdownSubmenu',
                'menu_class'      => 'navbar-nav mx-auto align-items-start'.$us_b_submenu_link_width_menu_class_add,
                'fallback_cb'     => '',
                'menu_id'         => 'main-menu',
                'depth'           => 2,
                'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
              )
            ); ?>
          </div>

        </nav>

      <?php } ?>
      
    </div>

	</div><!-- #wrapper-navbar end -->
