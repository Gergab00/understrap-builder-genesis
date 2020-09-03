<?php

/**
 * PRO Headers check for pages.
 *
 * @package understrap-builder
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
if(!is_user_logged_in() && get_option('usblkv')!='1'){return'';}

global $us_b_title_shown_already, $us_b_featured_image_already_shown;

$us_b_page_id = get_queried_object_id();

// Load Customizer variables
$understrap_builder_container_type = get_option( 'understrap_builder_container_type', 'container');
$understrap_builder_container_page_type = get_option( 'understrap_builder_container_page_type', 'default');

$understrap_builder_headers_page = get_option( 'understrap_builder_headers_page', '');
$understrap_builder_headers_page_text = get_option( 'understrap_builder_headers_page_text', '');

global $builder_default_spacings;
$understrap_builder_spacings_headers_wrapper = get_option( 'understrap_builder_spacings_headers_wrapper', $builder_default_spacings );
$understrap_builder_spacings_headers_title = get_option( 'understrap_builder_spacings_headers_title', $builder_default_spacings );
$understrap_builder_spacings_headers_meta = get_option( 'understrap_builder_spacings_headers_meta', $builder_default_spacings );


// Unique page override header meta option
$understrap_builder_override_header = get_post_meta($us_b_page_id, '_us_b_override_header', true);
if($understrap_builder_override_header != ''){
  $understrap_builder_headers_page = $understrap_builder_override_header;
}


// Handle container
if($understrap_builder_container_page_type != 'default'){
  $understrap_builder_container_type = $understrap_builder_container_page_type;
}


// Header
if($understrap_builder_headers_page != 'disable'){ // Not individually disabled
  $us_b_headers_page_wrap_style = '';
  $us_b_headers_page_wrap_class = '';
  $us_b_headers_page_back_style = '';
  $us_b_headers_page_back_class = '';
  if(strstr($understrap_builder_headers_page, 'image-full')){
    if($understrap_builder_headers_page == 'image-full-dark'){
      $us_b_headers_page_wrap_class = 'bg-dark text-light us_b_text_shadow';
    } else {
      $us_b_headers_page_wrap_class = 'bg-light text-dark us_b_text_shadow_light';
    }
    if(has_post_thumbnail($us_b_page_id)){
      $us_b_headers_page_wrap_style = "background: url('".wp_get_attachment_url( get_post_thumbnail_id($us_b_page_id), 'full' )."');background-position:center;background-repeat:no-repeat;background-size:cover;";
    }
  } else if(strstr($understrap_builder_headers_page, 'image-content')){
    if($understrap_builder_headers_page == 'image-content-dark'){
      $us_b_headers_page_wrap_class = 'text-light us_b_text_shadow';
      $us_b_headers_page_back_class = 'bg-dark';
    } else {
      $us_b_headers_page_wrap_class = 'text-dark us_b_text_shadow_light';
      $us_b_headers_page_back_class = 'bg-light';
    }
    if(has_post_thumbnail($us_b_page_id)){
      $us_b_headers_page_back_style = "background: url('".wp_get_attachment_url( get_post_thumbnail_id($us_b_page_id), 'full' )."');background-position:center;background-repeat:no-repeat;background-size:cover;";
    }
  } else if($understrap_builder_headers_page == 'outside'){
    if($understrap_builder_headers_page == 'outside-centered'){
      $us_b_headers_page_wrap_class .= ' text-center';
    }
  }
  // Handle header image only
  $us_b_headers_page_back_full_class = '';
  if($understrap_builder_headers_page_text == 'below'){
    $us_b_headers_page_back_full_class = 'image_only';
    $us_b_headers_page_back_class .= ' image_only';
  }
} else {
  $understrap_builder_headers_page = '';
}


if($understrap_builder_headers_page != '' && $understrap_builder_headers_page != 'centered'){ /* PRO Headers */ ?>
<div class="wrapper <?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_headers_wrapper)); ?> <?php echo esc_attr($us_b_headers_page_wrap_class); ?>" id="headers-page-wrapper" style="<?php echo esc_attr($us_b_headers_page_wrap_style); ?>">
  
  <?php if(strstr($understrap_builder_headers_page, 'outside')){ /* Outside of Content */ ?>
    <div class="<?php echo esc_attr($understrap_builder_container_type); ?>">
      <div class="row">
        <div class="col-12<?php if($understrap_builder_headers_page=='outside-centered'){echo ' text-center';}?>">
          <h1 class="entry-title <?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_headers_title)); ?>"><?php single_post_title(); ?></h1>
          <div id="us_b_page_header_image_full" class="<?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_headers_meta)); ?>">
            <p>
              <i class="fa fa-calendar mr-1"></i>
              <em><?php echo esc_attr(get_the_time('F j, Y', $us_b_page_id)); ?></em>
            </p>
          </div>
        </div>
        <div class="col-12">
          <hr />
        </div>
      </div>
    </div>
  <?php $us_b_title_shown_already = true; } ?>
  
  <?php if(strstr($understrap_builder_headers_page, 'image-full')){ /* Full Width Image Background Light/Dark */ ?>
  <div class="<?php echo esc_attr( $understrap_builder_container_type ); ?> text-center">
    <div id="us_b_page_header_image_full_back" class="row <?php echo esc_attr($us_b_headers_page_back_full_class); ?>">
      <?php if($understrap_builder_headers_page_text == ''){ $us_b_title_shown_already = true; ?>
        <div class="col-12" id="us_b_page_header_image_full_title">
          <h1 class="entry-title <?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_headers_title)); ?>"><?php single_post_title(); ?></h1>
        </div>
        <div class="col-12">
          <div id="us_b_page_header_image_full" class="<?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_headers_meta)); ?>">
            <p>
              <i class="fa fa-calendar mr-1"></i>
              <em><?php echo esc_attr(get_the_time('F j, Y', $us_b_page_id)); ?></em>
            </p>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
  <?php $us_b_featured_image_already_shown = true; } ?>
  
  <?php if(strstr($understrap_builder_headers_page, 'image-content')){ /* Content Width Image Background Light/Dark */ ?>
  <div class="<?php echo esc_attr( $understrap_builder_container_type ); ?> pb-0">
    <div id="us_b_page_header_image_content_back" style="<?php echo esc_attr($us_b_headers_page_back_style); ?>" class="<?php echo esc_attr($us_b_headers_page_back_class); ?>">
      <div class="row">
        <?php if($understrap_builder_headers_page_text == ''){ $us_b_title_shown_already = true; ?>
          <div class="col-12" id="us_b_header_image_content_title">
            <h1 class="entry-title <?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_headers_title)); ?>"><?php single_post_title(); ?></h1>
          </div>
          <div class="col-12">
            <div id="us_b_page_header_image_content" class="<?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_headers_meta)); ?>">
              <p>
                <i class="fa fa-calendar mr-1"></i>
                <em><?php echo esc_attr(get_the_time('F j, Y', $us_b_page_id)); ?></em>
              </p>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
  <?php $us_b_featured_image_already_shown = true; } ?>
  
</div>
<?php } ?>