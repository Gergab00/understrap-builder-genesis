<?php

/**
 * PRO Author box check.
 *
 * @package understrap-builder
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
if(!is_user_logged_in() && get_option('usblkv')!='1'){return'';}


// Load Customizer variables
$understrap_builder_author_box_page_style = get_theme_mod( 'understrap_builder_author_box_page_style', '');
$understrap_builder_author_box_page_align = get_theme_mod( 'understrap_builder_author_box_page_align', '');

global $builder_default_spacings;
$understrap_builder_spacings_author_outer = get_theme_mod( 'understrap_builder_spacings_author_outer', $builder_default_spacings );
$understrap_builder_spacings_author_name = get_theme_mod( 'understrap_builder_spacings_author_name', $builder_default_spacings );
$understrap_builder_spacings_author_desc = get_theme_mod( 'understrap_builder_spacings_author_desc', $builder_default_spacings );
$understrap_builder_spacings_author_links = get_theme_mod( 'understrap_builder_spacings_author_links', $builder_default_spacings );

// Unique page override header meta option
$understrap_builder_override_author_box = get_post_meta(get_the_ID(), '_us_b_hide_author_box', true);
if($understrap_builder_override_author_box == 'hide'){
  $understrap_builder_author_box_page_style = '';
}

// Handle author box
$us_b_author_box_class = '';
if($understrap_builder_author_box_page_align != ''){
  global $post;
  $us_b_author_box_class = 'text-'.$understrap_builder_author_box_page_align;
  $us_b_display_name = get_the_author_meta( 'display_name', $post->post_author );
  if(empty($us_b_display_name)){ $us_b_display_name = get_the_author_meta( 'nickname', $post->post_author ); }
  $us_b_user_description = get_the_author_meta( 'user_description', $post->post_author );
  $us_b_user_website = get_the_author_meta('url', $post->post_author);
  $us_b_user_posts = get_author_posts_url( get_the_author_meta( 'ID' , $post->post_author));
}

// Dont show author box on home page
if(!is_front_page()){

  if($understrap_builder_author_box_page_style == 'page-break'){ /* PRO Author Box */ ?>
    <div class="us_b_author_box_page_break_single border-top <?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_author_outer)); ?> <?php echo esc_attr($us_b_author_box_class); ?>">
      <hr>
      <div class="media">
        <?php echo get_avatar( get_the_author_meta('ID'), 64, '', esc_attr($us_b_display_name).' Gravatar', array('class' => 'mr-4') ); ?>
        <div class="media-body">
          <h5 class="<?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_author_name)); ?>"><?php echo esc_attr($us_b_display_name); ?></h5>
          <div class="<?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_author_desc)); ?>">
            <?php echo esc_attr($us_b_user_description); ?>
          </div>
          <p class="<?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_author_links)); ?>">
            <i class="fa fa-file mr-2"></i> <a href="<?php echo esc_url($us_b_user_posts); ?>" class="mr-3"><?php echo esc_attr($us_b_display_name); ?>s Posts</a>
            <?php if($us_b_user_website != ''){ ?>
            <i class="fa fa-home mr-2"></i> <a href="<?php echo esc_url($us_b_user_website); ?>"><?php echo esc_url($us_b_user_website); ?></a>
            <?php } ?>
          </p>
        </div>
      </div>
    </div>
  <?php } else if($understrap_builder_author_box_page_style == 'boxed'){ ?>
    <div class="us_b_author_box_boxed_single border <?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_author_outer)); ?> <?php echo esc_attr($us_b_author_box_class); ?>">
      <div class="media">
        <?php echo get_avatar( get_the_author_meta('ID'), 64, '', esc_attr($us_b_display_name).' Gravatar', array('class' => 'mr-4') ); ?>
        <div class="media-body">
          <h5 class="<?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_author_name)); ?>"><?php echo esc_attr($us_b_display_name); ?></h5>
          <div class="<?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_author_desc)); ?>">
            <?php echo esc_attr($us_b_user_description); ?>
          </div>
          <p class="<?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_author_links)); ?>">
            <i class="fa fa-file mr-2"></i> <a href="<?php echo esc_url($us_b_user_posts); ?>" class="mr-3"><?php echo esc_attr($us_b_display_name); ?>s Posts</a>
            <?php if($us_b_user_website != ''){ ?>
            <i class="fa fa-home mr-2"></i> <a href="<?php echo esc_url($us_b_user_website); ?>"><?php echo esc_url($us_b_user_website); ?></a>
            <?php } ?>
          </p>
        </div>
      </div>
    </div>
  <?php }
  
} ?>