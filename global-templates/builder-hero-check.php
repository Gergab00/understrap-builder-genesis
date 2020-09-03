<?php
/**
 * Hero check for BUILDER
 *
 * @package understrap-builder
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
if(!is_user_logged_in() && get_option('usblkv')!='1'){return'';}

// Load Customizer variables
$understrap_builder_container_type = get_option( 'understrap_builder_container_type', 'container');
$understrap_builder_hero_layout = get_option( 'understrap_builder_hero_layout', 'disabled');
$understrap_builder_hero_2_mobile = get_option( 'understrap_builder_hero_2_mobile', 'default');
$understrap_builder_hero_col_1_width = get_option( 'understrap_builder_hero_col_1_width', 6);
$understrap_builder_hero_col_2_width = get_option( 'understrap_builder_hero_col_2_width', 6);
$understrap_builder_hero_content_1 = get_option( 'understrap_builder_hero_content_1', '');
$understrap_builder_hero_content_2 = get_option( 'understrap_builder_hero_content_2', '');
$understrap_builder_hero_text_class = get_option( 'understrap_builder_hero_text_class', '');
$understrap_builder_hero_page = get_option( 'understrap_builder_hero_page', '');

// Handle second column mobile display
$understrap_builder_second_col_classes = '';
if($understrap_builder_hero_2_mobile == 'hide'){
  $understrap_builder_second_col_classes = ' d-lg-block d-none';
}

// Check for disabled or hero layout
if(is_front_page() && $understrap_builder_hero_layout != 'disabled'){
  ?>
  <div class="wrapper <?php echo esc_attr($understrap_builder_hero_text_class); ?>" id="us_b_hero">
    
      <div class="<?php echo esc_attr( $understrap_builder_container_type ); ?>" id="wrapper-static-content" tabindex="-1">
    
        <div class="row">
          
          <?php if($understrap_builder_hero_layout == 'single-col'){ ?>
          
            <div class="col" id="us_b_hero_single_col">
              <?php echo wpautop(do_shortcode($understrap_builder_hero_content_1)); ?>
            </div>
            
          <?php } else if($understrap_builder_hero_layout == 'double-col'){ ?>
            
            <div class="col-md-<?php echo esc_attr($understrap_builder_hero_col_1_width); ?>" id="us_b_hero_left_col">
              <div class="us_b_hero_left_content">
                <?php echo wpautop(do_shortcode($understrap_builder_hero_content_1)); ?>
              </div>
            </div>
          
            <div class="col-md-<?php echo esc_attr($understrap_builder_hero_col_2_width.$understrap_builder_second_col_classes); ?>" id="us_b_hero_right_col">
              <div class="us_b_hero_right_content">
                <?php echo wpautop(do_shortcode($understrap_builder_hero_content_2)); ?>
              </div>
            </div>
          
          <?php } else if($understrap_builder_hero_layout == 'page' && $understrap_builder_hero_page != '' && $understrap_builder_hero_page != '0'){ ?>
          
            <div class="col" id="us_b_hero_page_content">
              <?php echo wpautop(do_shortcode(apply_filters('the_content', get_post_field('post_content', $understrap_builder_hero_page)))); ?>
            </div>
          
          <?php } ?>
          
        </div>

     </div>

  </div>

</div><!-- Nav+Hero Wrapper -->
<?php } ?>