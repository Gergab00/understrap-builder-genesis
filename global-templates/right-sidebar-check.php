<?php
/**
 * Right sidebar check.
 *
 * @package understrap-builder
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


// Load Customizer variables
$understrap_builder_sidebars_show_default = get_theme_mod( 'understrap_builder_sidebars_show_default', 'right');
$understrap_builder_sidebars_show_page = get_theme_mod( 'understrap_builder_sidebars_show_page', 'default');
$understrap_builder_sidebars_show_single = get_theme_mod( 'understrap_builder_sidebars_show_single', 'default');
$understrap_builder_sidebars_show_archive = get_theme_mod( 'understrap_builder_sidebars_show_archive', 'default');
$understrap_builder_sidebars_single_width = get_theme_mod( 'understrap_builder_sidebars_single_width', '4');
$understrap_builder_sidebars_dual_width = get_theme_mod( 'understrap_builder_sidebars_dual_width', '3');
$understrap_builder_sidebars_widget_margin = get_theme_mod( 'understrap_builder_sidebars_widget_margin', 'default');

// Apply defaults
if($understrap_builder_sidebars_show_page == 'default'){
  $understrap_builder_sidebars_show_page = $understrap_builder_sidebars_show_default;
}
if($understrap_builder_sidebars_show_single == 'default'){
  $understrap_builder_sidebars_show_single = $understrap_builder_sidebars_show_default;
}
if($understrap_builder_sidebars_show_archive == 'default'){
  $understrap_builder_sidebars_show_archive = $understrap_builder_sidebars_show_default;
}

// Work out whether to show right sidebar or not - use column width as true/false
$us_b_show_sidebar_right = 0;
if(is_page()){
  if($understrap_builder_sidebars_show_page == 'right'){
    $us_b_show_sidebar_right = $understrap_builder_sidebars_single_width;
  }
  if($understrap_builder_sidebars_show_page == 'both'){
    $us_b_show_sidebar_right = $understrap_builder_sidebars_dual_width;
  }
  if($understrap_builder_sidebars_show_page == 'none'){
    $us_b_show_sidebar_right = 0;
  }
} else if(is_single()){
  if($understrap_builder_sidebars_show_single == 'right'){
    $us_b_show_sidebar_right = $understrap_builder_sidebars_single_width;
  }
  if($understrap_builder_sidebars_show_single == 'both'){
    $us_b_show_sidebar_right = $understrap_builder_sidebars_dual_width;
  }
  if($understrap_builder_sidebars_show_single == 'none'){
    $us_b_show_sidebar_right = 0;
  }
} else if(is_archive() || is_home()){
  if($understrap_builder_sidebars_show_archive == 'right'){
    $us_b_show_sidebar_right = $understrap_builder_sidebars_single_width;
  }
  if($understrap_builder_sidebars_show_archive == 'both'){
    $us_b_show_sidebar_right = $understrap_builder_sidebars_dual_width;
  }
  if($understrap_builder_sidebars_show_archive == 'none'){
    $us_b_show_sidebar_right = 0;
  }
} else {
  if($understrap_builder_sidebars_show_default == 'right'){
    $us_b_show_sidebar_right = $understrap_builder_sidebars_single_width;
  }
  if($understrap_builder_sidebars_show_default == 'both'){
    $us_b_show_sidebar_right = $understrap_builder_sidebars_dual_width;
  }
  if($understrap_builder_sidebars_show_default == 'none'){
    $us_b_show_sidebar_right = 0;
  }
}

// Show sidebar on page templates that force it
$us_b_current_page_template = get_page_template_slug();
if($us_b_current_page_template == 'page-templates/right-sidebarpage.php'){
  $us_b_show_sidebar_right = $understrap_builder_sidebars_single_width;
}
if($us_b_current_page_template == 'page-templates/both-sidebarspage.php'){
  $us_b_show_sidebar_right = $understrap_builder_sidebars_dual_width;
}


// Sidebar widget bottom margin
$us_b_sidebars_widget_margin_class = '';
if($understrap_builder_sidebars_widget_margin != 'default'){
  $us_b_sidebars_widget_margin_class = 'us_b_widget_margin-'.$understrap_builder_sidebars_widget_margin;
}

?>

<?php if ($us_b_show_sidebar_right > 0) : ?>

  <div class="col-md-<?php echo esc_attr($us_b_show_sidebar_right); ?> <?php echo esc_attr($us_b_sidebars_widget_margin_class); ?> widget-area" id="right-sidebar" role="complementary">
    <?php dynamic_sidebar( 'right-sidebar' ); ?>
  </div><!-- #right-sidebar -->

<?php endif; ?>
