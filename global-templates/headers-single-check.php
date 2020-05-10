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

// Load Customizer variables
$understrap_builder_container_type = get_theme_mod( 'understrap_builder_container_type', 'container');
$understrap_builder_container_single_type = get_theme_mod( 'understrap_builder_container_single_type', 'default');

$understrap_builder_headers_single = get_theme_mod( 'understrap_builder_headers_single', '');
$understrap_builder_headers_single_text = get_theme_mod( 'understrap_builder_headers_single_text', '');
$understrap_builder_comments_display = get_theme_mod( 'understrap_builder_comments_display', '');

global $builder_default_spacings;
$understrap_builder_spacings_headers_wrapper = get_theme_mod( 'understrap_builder_spacings_headers_wrapper', $builder_default_spacings );
$understrap_builder_spacings_headers_title = get_theme_mod( 'understrap_builder_spacings_headers_title', $builder_default_spacings );
$understrap_builder_spacings_headers_meta = get_theme_mod( 'understrap_builder_spacings_headers_meta', $builder_default_spacings );


// Container
if($understrap_builder_container_single_type != 'default'){
  $understrap_builder_container_type = $understrap_builder_container_single_type;
}


// Unique page override header meta option
/*$understrap_builder_override_header = get_post_meta(get_the_ID(), '_us_b_override_header', true);
if($understrap_builder_override_header != ''){
  $understrap_builder_headers_page = $understrap_builder_override_header;
}*/


// Header
$us_b_author_id = get_post_field('post_author', get_the_ID());
$us_b_headers_single_wrap_style = '';
$us_b_headers_single_wrap_class = '';
$us_b_headers_single_back_style = '';
$us_b_headers_single_back_class = '';
if(strstr($understrap_builder_headers_single, 'image-full')){
  if($understrap_builder_headers_single == 'image-full-dark'){
    $us_b_headers_single_wrap_class = 'bg-dark text-light us_b_text_shadow';
  } else {
    $us_b_headers_single_wrap_class = 'bg-light text-dark us_b_text_shadow_light';
  }
  if(has_post_thumbnail(get_the_ID())){
    $us_b_headers_single_wrap_style = "background: url('".wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()), 'full' )."');background-position:center;background-repeat:no-repeat;background-size:cover;";
  }
} else if(strstr($understrap_builder_headers_single, 'image-content')){
  if($understrap_builder_headers_single == 'image-content-dark'){
    $us_b_headers_single_wrap_class = 'text-light us_b_text_shadow';
    $us_b_headers_single_back_class = 'bg-dark';
  } else {
    $us_b_headers_single_wrap_class = 'text-dark us_b_text_shadow_light';
    $us_b_headers_single_back_class = 'bg-light';
  }
  if(has_post_thumbnail(get_the_ID())){
    $us_b_headers_single_back_style = "background: url('".wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()), 'full' )."');background-position:center;background-repeat:no-repeat;background-size:cover;";
  }
} else if(strstr($understrap_builder_headers_single, 'outside')){
  if($understrap_builder_headers_single == 'outside-centered'){
    $us_b_headers_single_wrap_class .= ' text-center';
  }
}
// Handle header image only
$us_b_headers_single_back_full_class = '';
if($understrap_builder_headers_single_text == 'below'){
  $us_b_headers_single_back_full_class = 'image_only';
  $us_b_headers_single_back_class .= ' image_only';
}


if($understrap_builder_headers_single != ''){ /* PRO Headers */ ?>
<div class="wrapper <?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_headers_wrapper)); ?> <?php echo esc_attr($us_b_headers_single_wrap_class); ?>" id="headers-single-wrapper" style="<?php echo esc_attr($us_b_headers_single_wrap_style); ?>">
  
  <?php if(strstr($understrap_builder_headers_single, 'outside')){ /* Outside of Content */ ?>
    <div class="<?php echo esc_attr( $understrap_builder_container_type ); ?>">
      <div class="row">
        <div class="col-12">
          <h1 class="entry-title <?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_headers_title)); ?>"><?php the_title(); ?></h1>
          <div id="us_b_single_header_image_full" class="<?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_headers_meta)); ?>">
            <p>
              <a href="<?php echo esc_attr(get_author_posts_url($us_b_author_id)); ?>">
                <?php echo get_avatar( $us_b_author_id, 20, '', esc_attr(get_the_author_meta('display_name', $us_b_author_id)).' Thumb', array('class' => 'rounded-circle mr-1') ); ?>
                <?php echo esc_attr(get_the_author_meta('display_name', $us_b_author_id)); ?>
              </a>
              <i class="fa fa-calendar ml-4 mr-1"></i>
              <em><?php echo esc_attr(get_the_time('F j, Y', get_the_ID())); ?></em>
              <i class="fa fa-comment ml-4 mr-1"></i>
              <a href="#comments"><?php echo esc_attr(get_comments_number(get_the_ID())); ?></a>
            </p>
          </div>
        </div>
        <div class="col-12">
          <hr />
        </div>
      </div>
    </div>
  <?php $us_b_title_shown_already = true; } ?>
  
  <?php if(strstr($understrap_builder_headers_single, 'image-full')){ /* Full Width Image Background Light/Dark */ ?>
  <div id="us_b_single_header_image_full_back" class="<?php echo esc_attr($understrap_builder_container_type); ?> <?php echo esc_attr($us_b_headers_single_back_full_class); ?> text-center">
    <div class="row">
      <?php if($understrap_builder_headers_single_text == ''){ $us_b_title_shown_already = true; ?>
        <div class="col-12" id="us_b_single_header_image_full_title">
          <h1 class="entry-title <?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_headers_title)); ?>"><?php the_title(); ?></h1>
        </div>
        <div class="col-12">
          <div id="us_b_single_header_image_full" class="<?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_headers_meta)); ?>">
            <p>
              <a href="<?php echo esc_attr(get_author_posts_url($us_b_author_id)); ?>">
                <?php echo get_avatar( $us_b_author_id, 20, '', esc_attr(get_the_author_meta('display_name', $us_b_author_id)).' Thumb', array('class' => 'rounded-circle mr-1') ); ?>
                <?php echo esc_attr(get_the_author_meta('display_name', $us_b_author_id)); ?>
              </a>
              <i class="fa fa-calendar ml-4 mr-1"></i>
              <em><?php echo esc_attr(get_the_time('F j, Y', get_the_ID())); ?></em>
              <i class="fa fa-comment ml-4 mr-1"></i>
              <a href="#comments"><?php echo esc_attr(get_comments_number(get_the_ID())); ?></a>
            </p>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
  <?php $us_b_featured_image_already_shown = true; } ?>
  
  <?php if(strstr($understrap_builder_headers_single, 'image-content')){ /* Content Width Image Background Light/Dark */ ?>
  <div class="<?php echo esc_attr( $understrap_builder_container_type ); ?>">
    <div id="us_b_single_header_image_content_back" style="<?php echo esc_attr($us_b_headers_single_back_style); ?>" class="<?php echo esc_attr($us_b_headers_single_back_class); ?>">
      <div class="row">
        <?php if($understrap_builder_headers_single_text == ''){ $us_b_title_shown_already = true; ?>
          <div class="col-12" id="us_b_header_image_content_title">
            <h1 class="entry-title <?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_headers_title)); ?>"><?php the_title(); ?></h1>
          </div>
          <div class="col-12">
            <div id="us_b_single_header_image_content" class="<?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_headers_meta)); ?>">
              <p>
                <a href="<?php echo esc_attr(get_author_posts_url($us_b_author_id)); ?>">
                  <?php echo get_avatar( $us_b_author_id, 20, '', esc_attr(get_the_author_meta('display_name', $us_b_author_id)).' Thumb', array('class' => 'rounded-circle mr-1') ); ?>
                  <?php echo esc_attr(get_the_author_meta('display_name', $us_b_author_id)); ?>
                </a>
                <i class="fa fa-calendar ml-4 mr-1"></i>
                <em><?php echo esc_attr(get_the_time('F j, Y', get_the_ID())); ?></em>
                <i class="fa fa-comment ml-4 mr-1"></i>
                <a href="#comments"><?php echo esc_attr(get_comments_number(get_the_ID())); ?></a>
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