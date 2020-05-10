<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap-builder
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


// Load Customizer variables
$understrap_builder_container_type = get_theme_mod( 'understrap_builder_container_type', 'container');
$understrap_builder_container_footer_type = get_theme_mod( 'understrap_builder_container_footer_type', 'default');
$understrap_builder_footer_text_left = get_theme_mod( 'understrap_builder_footer_text_left', '<img class="alignnone wp-image-16" src="https://understrap.com/builder-logo-mini-64-64.png" alt="UnderStrap BUILDER Logo" width="24" height="24">&nbsp; Powered By <a href="https://understrap.com/builder/">UnderStrap BUILDER</a>.' );
$understrap_builder_footer_text_right = get_theme_mod( 'understrap_builder_footer_text_right', '<p style="text-align: right;">Copyright [builder_current_year]</p>' );
$understrap_builder_footer_widgets_enable = get_theme_mod( 'understrap_builder_footer_widgets_enable', 0);
$understrap_builder_footer_bg_color = get_theme_mod( 'understrap_builder_footer_bg_color', '' );
$understrap_builder_footer_border = get_theme_mod( 'understrap_builder_footer_border', '' );
$understrap_builder_footer_border_color = get_theme_mod( 'understrap_builder_footer_border_color', 'primary' );
$understrap_builder_footer_text_color = get_theme_mod( 'understrap_builder_footer_text_color', '' );
$understrap_builder_footer_menu_align = get_theme_mod( 'understrap_builder_footer_menu_align', 'default' );

global $builder_default_spacings;
$understrap_builder_spacings_footer_menu = get_theme_mod( 'understrap_builder_spacings_footer_menu', $builder_default_spacings );
$understrap_builder_spacings_footer_text_bar = get_theme_mod( 'understrap_builder_spacings_footer_text_bar', $builder_default_spacings );


// Handle container type
if($understrap_builder_container_footer_type != 'default'){
  $understrap_builder_container_type = $understrap_builder_container_footer_type;
}

// Footer classes logic
$us_b_footer_classes = '';
if($understrap_builder_footer_bg_color != ''){ $us_b_footer_classes .= ' bg-'.$understrap_builder_footer_bg_color; }
if($understrap_builder_footer_text_color != ''){ $us_b_footer_classes .= ' text-'.$understrap_builder_footer_text_color; }
if($understrap_builder_footer_border != ''){
  $us_b_footer_classes .= ' us_b_t_'.$understrap_builder_footer_border.' border-'.$understrap_builder_footer_border_color;
}

// Footer menu align
$us_b_footer_menu_classes = '';
if($understrap_builder_footer_menu_align == 'right'){
  $us_b_footer_menu_classes = ' justify-content-end';
} else if($understrap_builder_footer_menu_align == 'center'){
  $us_b_footer_menu_classes = ' justify-content-center';
}


?>

<div class="wrapper" id="wrapper-footer">
  
  <footer class="site-footer<?php echo esc_attr($us_b_footer_classes) ?>" id="us_b_footer">

	  <div class="<?php echo esc_attr($understrap_builder_container_type, 'understrap-builder'); ?>">
      
      <?php if($understrap_builder_footer_widgets_enable == 1){ get_template_part( 'global-templates/footer-sidebar-check' ); } ?>
      
      <?php if(has_nav_menu('us_b_footer_bar')){ ?>
      
      <div class="row <?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_footer_menu)); ?>">
        <div class="col">
          <?php wp_nav_menu(
            array(
              'theme_location'  => 'us_b_footer_bar',
              'container_class' => '',
              'container_id'    => '',
              'menu_class'      => 'nav'.$us_b_footer_menu_classes,
              'fallback_cb'     => '',
              'menu_id'         => 'footer-menu',
              'depth'           => 1,
              'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
            )
          ); ?>
        </div>
      </div>
      
      <?php } ?>

      <?php if($understrap_builder_footer_text_left != '' || $understrap_builder_footer_text_right != ''){ ?>
      <div class="site-info <?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_footer_text_bar)); ?>" id="us_b_footer_text_bar">
        
        <div class="row">

          <?php if($understrap_builder_footer_text_left != ''){ ?>
			    <div class="col-md-6" id="us_b_footer_text_bar_left">
            <?php echo wpautop(do_shortcode(understrap_builder_convert_text_date($understrap_builder_footer_text_left), 'understrap-builder')); ?>
          </div>
          <?php } ?>
          
          <?php if($understrap_builder_footer_text_right != ''){ ?>
          <div class="col-md-6" id="us_b_footer_text_bar_right">
            <?php echo wpautop(do_shortcode(understrap_builder_convert_text_date($understrap_builder_footer_text_right), 'understrap-builder')); ?>
          </div>
          <?php } ?>
          
        </div>

      </div><!-- .site-info -->
      <?php } ?>

	  </div><!-- container end -->
    
  </footer><!-- #colophon -->

</div><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

<?php understrap_builder_after_footer(); ?>

</html>

