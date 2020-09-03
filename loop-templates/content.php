<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package understrap-builder
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


// Load Customizer variables
$understrap_builder_archives_cols = get_option( 'understrap_builder_archives_cols', '1');
$understrap_builder_container_type = get_option( 'understrap_builder_container_type', 'container');
$understrap_builder_container_archive_type = get_option( 'understrap_builder_container_archive_type', 'default');
$understrap_builder_archives_post_title = get_option( 'understrap_builder_archives_post_title', 'ontop');
$understrap_builder_archives_post_excerpt = get_option( 'understrap_builder_archives_post_excerpt', 'below-excerpt');
$understrap_builder_archives_post_excerpt_length = get_option( 'understrap_builder_archives_post_excerpt_length', '40');
$understrap_builder_archives_post_meta = get_option( 'understrap_builder_archives_post_meta', 'ontop');
$understrap_builder_archives_post_title_heading = get_option( 'understrap_builder_archives_post_title_heading', 'h2');
$understrap_builder_archives_post_title_color = get_option( 'understrap_builder_archives_post_title_color', '');
$understrap_builder_archives_post_read_more = get_option( 'understrap_builder_archives_post_read_more', '');
$understrap_builder_archives_post_read_more_text = get_option( 'understrap_builder_archives_post_read_more_text', '');
$understrap_builder_archives_image_clickable = get_option( 'understrap_builder_archives_image_clickable', 0);
$understrap_builder_archives_post_background = get_option( 'understrap_builder_archives_post_background', '');
$understrap_builder_archives_post_text_color = get_option( 'understrap_builder_archives_post_text_color', '');
$understrap_builder_archives_post_category = get_option( 'understrap_builder_archives_post_category', '');
$understrap_builder_archives_post_margin_bottom = get_option( 'understrap_builder_archives_post_margin_bottom', 'mb-3');
$understrap_builder_archives_post_padding_sides = get_option( 'understrap_builder_archives_post_padding_sides', '');


// Handle container for image sizes
if($understrap_builder_container_archive_type != 'default'){
  $understrap_builder_container_type = $understrap_builder_container_archive_type;
}

// Image size based on columns for bandwidth saving [speed]
$understrap_builder_archives_col_bs_string = '12';
$understrap_builder_archives_col_img_size = 'full';
if($understrap_builder_archives_cols == 2){
  $understrap_builder_archives_col_bs_string = '6';
  if($understrap_builder_container_type == 'container-fluid'){ // Larger images for full screen layout
    $understrap_builder_archives_col_img_size = 'full';
  } else {
    $understrap_builder_archives_col_img_size = 'large';
  }
} else if($understrap_builder_archives_cols == 3) {
  $understrap_builder_archives_col_bs_string = '4';
  if($understrap_builder_container_type == 'container-fluid'){ // Larger images for full screen layout
    $understrap_builder_archives_col_img_size = 'full';
  } else {
    $understrap_builder_archives_col_img_size = 'large';
  }
} else if($understrap_builder_archives_cols == 4) {
  $understrap_builder_archives_col_bs_string = '3';
  if($understrap_builder_container_type == 'container-fluid'){ // Larger images for full screen layout
    $understrap_builder_archives_col_img_size = 'large';
  } else {
    $understrap_builder_archives_col_img_size = 'medium';
  }
}

// Handle text and buttons
$understrap_builder_read_more_text_color = '';
if($understrap_builder_archives_post_read_more_text != ''){
  $understrap_builder_read_more_text_color = ' text-'.$understrap_builder_archives_post_read_more_text;
}
$understrap_builder_read_more_button = '';
if($understrap_builder_archives_post_read_more != ''){
  $understrap_builder_read_more_button = '<p class="us_b_read_more_para mt-3"><a href="'.esc_url(get_permalink()).'" 
  class="btn btn-'.esc_attr($understrap_builder_archives_post_read_more).esc_attr($understrap_builder_read_more_text_color).'">Read More</a></p>';
}

// Handle backgrounds
$understrap_builder_archives_post_background_classes = '';
if($understrap_builder_archives_post_background != '' || $understrap_builder_archives_post_text_color != ''){
  $understrap_builder_archives_post_background_classes = 'p-3';
}
if($understrap_builder_archives_post_background != ''){
  $understrap_builder_archives_post_background_classes .= ' bg-'.$understrap_builder_archives_post_background;
}
if($understrap_builder_archives_post_text_color != ''){
  $understrap_builder_archives_post_background_classes .= ' text-'.$understrap_builder_archives_post_text_color;
}

// Handle category
$us_b_post_category_under_title_string = '';
if($understrap_builder_archives_post_category != 'disabled'){
  $us_b_posts_categories = get_the_category(get_the_ID());
  $us_b_post_main_category = $us_b_posts_categories[0];
  $us_b_post_main_category_name = $us_b_post_main_category->name;
  $us_b_post_main_category_permalink = get_category_link($us_b_post_main_category);
  if($understrap_builder_archives_post_category == 'under-title'){
    $us_b_post_category_under_title_string = '<a href="'.esc_url($us_b_post_main_category_permalink).'" class="d-block mt-1 us_b_archive_post_category">'.esc_attr($us_b_post_main_category_name).'</a>';
  }
}

// Handle title color clas
$us_b_post_title_class = '';
if($understrap_builder_archives_post_title_color != ''){
  $us_b_post_title_class = ' text-'.$understrap_builder_archives_post_title_color;
}


?>

<div class="col-md-<?php echo esc_attr($understrap_builder_archives_col_bs_string); ?> <?php echo esc_attr($understrap_builder_archives_post_margin_bottom); ?> 
            <?php echo esc_attr($understrap_builder_archives_post_padding_sides); ?> us_b_archive_post">

  <article <?php post_class($understrap_builder_archives_post_background_classes); ?> id="post-<?php the_ID(); ?>">

    <header class="entry-header position-relative">

      <?php /* TITLE */ if($understrap_builder_archives_post_title == 'ontop'){ ?>
        <?php echo the_title(sprintf( '<'.esc_attr($understrap_builder_archives_post_title_heading).' class="entry-title mb-2"><a class="'.esc_attr($us_b_post_title_class).'" href="%s" rel="bookmark">', esc_url( get_permalink() ) ),'</a></h2>'); ?>
      <?php } ?>

      <?php if ( 'post' == get_post_type() ) : ?>

        <?php /* POST META */ if($understrap_builder_archives_post_meta == 'ontop'){ ?>
        <div class="entry-meta mb-2">
          <small><?php understrap_posted_on(); ?></small>
        </div><!-- .entry-meta -->
        <?php } ?>

      <?php endif; ?>
      
      <?php if(has_post_thumbnail(get_the_ID())){ ?>
        <?php  /* CLICKABLE IMAGE */ if($understrap_builder_archives_image_clickable == 1){ echo '<a href="'.esc_url(get_permalink()).'">'; } ?>
        <?php echo get_the_post_thumbnail( get_the_ID(), $understrap_builder_archives_col_img_size ); ?>
        <?php if($understrap_builder_archives_image_clickable == 1){ echo '</a>'; } ?>
      <?php } ?>
      
      <?php /* TITLE */ if($understrap_builder_archives_post_title == 'inside-dark' && has_post_thumbnail(get_the_ID())){ ?>
        <?php echo the_title(sprintf( '<'.esc_attr($understrap_builder_archives_post_title_heading).' class="entry-title us_b_archive_title_inside m-0 px-4 py-3 bg-dark"><a class="'.esc_attr($us_b_post_title_class).'" href="%s" rel="bookmark">', 
                                     esc_url( get_permalink() ) ),'</a>'.$us_b_post_category_under_title_string.'</'.esc_attr($understrap_builder_archives_post_title_heading).'>'); ?>
      <?php } ?>
      
      <?php /* TITLE */ if($understrap_builder_archives_post_title == 'inside-light' && has_post_thumbnail(get_the_ID())){ ?>
        <?php echo the_title(sprintf( '<'.esc_attr($understrap_builder_archives_post_title_heading).' class="entry-title us_b_archive_title_inside m-0 px-4 py-3 bg-light"><a class="'.esc_attr($us_b_post_title_class).'" href="%s" rel="bookmark">', 
                                     esc_url( get_permalink() ) ),'</a>'.$us_b_post_category_under_title_string.'</'.esc_attr($understrap_builder_archives_post_title_heading).'>'); ?>
      <?php } ?>
      
      <?php /* TITLE */ if($understrap_builder_archives_post_title == 'below' && !has_post_thumbnail(get_the_ID())){ ?>
        <?php echo the_title(sprintf( '<'.esc_attr($understrap_builder_archives_post_title_heading).' class="entry-title mt-3"><a class="'.esc_attr($us_b_post_title_class).'" href="%s" rel="bookmark">', 
                                     esc_url( get_permalink() ) ),'</a>'.$us_b_post_category_under_title_string.'</'.esc_attr($understrap_builder_archives_post_title_heading).'>'); ?>
      <?php } ?>

    </header><!-- .entry-header -->

    <div class="entry-content">
      
      <?php /* POST META */ if($understrap_builder_archives_post_meta == 'above-excerpt'){ ?>
      <div class="entry-meta mt-3 mb-2">
        <small><?php understrap_posted_on(); ?></small>
      </div><!-- .entry-meta -->
      <?php } ?>
      
      <?php /* EXCERPT */ if($understrap_builder_archives_post_excerpt == 'below'){ echo '<div class="mt-2">'.wp_trim_words(get_the_content(), $understrap_builder_archives_post_excerpt_length, '').'</div>'; } ?>
      
      <?php /* CATEGORY */ if($understrap_builder_archives_post_category == 'under-excerpt'){ echo '<a href="'.esc_url($us_b_post_main_category_permalink).'" class="d-block mt-3 us_b_archive_post_category">'.esc_attr($us_b_post_main_category_name).'</a>'; } ?>
      
      <?php /* READ MORE */ echo $understrap_builder_read_more_button; ?>
      
      <?php /* POST META */ if($understrap_builder_archives_post_meta == 'below-excerpt'){ ?>
      <div class="entry-meta mt-2">
        <small><?php understrap_posted_on(); ?></small>
      </div><!-- .entry-meta -->
      <?php } ?>

    </div><!-- .entry-content -->

  </article><!-- #post-## -->
  
</div>
