<?php
/**
 * Single post partial template.
 *
 * @package understrap-builder
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

global $us_b_title_shown_already, $us_b_featured_image_already_shown;

// Load Customizer variables
$understrap_builder_container_type = get_theme_mod( 'understrap_builder_container_type', 'container');
$understrap_builder_sidebars_show_default = get_theme_mod( 'understrap_builder_sidebars_show_default', 'right');
$understrap_builder_sidebars_show_single = get_theme_mod( 'understrap_builder_sidebars_show_single', 'default');
$understrap_builder_postlayout_featured_size = get_theme_mod( 'understrap_builder_postlayout_featured_size', 'large');
$understrap_builder_postlayout_featured_pos = get_theme_mod( 'understrap_builder_postlayout_featured_pos', 'default');
$understrap_builder_postlayout_meta_pos = get_theme_mod( 'understrap_builder_postlayout_meta_pos', 'default');
$understrap_builder_headers_single = get_theme_mod( 'understrap_builder_headers_single', '');
$understrap_builder_headers_single_text = get_theme_mod( 'understrap_builder_headers_single_text', '');

global $builder_default_spacings;
$understrap_builder_spacings_single_image = get_theme_mod( 'understrap_builder_spacings_single_image', $builder_default_spacings );
$understrap_builder_spacings_single_title = get_theme_mod( 'understrap_builder_spacings_single_title', $builder_default_spacings );
$understrap_builder_spacings_single_content = get_theme_mod( 'understrap_builder_spacings_single_content', $builder_default_spacings );
$understrap_builder_spacings_single_meta = get_theme_mod( 'understrap_builder_spacings_single_meta', $builder_default_spacings );

// Unique post override header meta option
$understrap_builder_override_header = get_post_meta(get_the_ID(), '_us_b_override_header', true);
if($understrap_builder_override_header != ''){
  $understrap_builder_headers_page = $understrap_builder_override_header;
}

// Unique page override title showing
$understrap_builder_override_title = get_post_meta(get_the_ID(), '_us_b_hide_title', true);


// Handle featured image size
$understrap_builder_featured_size = 'large';
if($understrap_builder_sidebars_show_single == 'none' || ($understrap_builder_sidebars_show_single == 'default' && $understrap_builder_sidebars_show_default == 'none')){
  $understrap_builder_featured_size = 'full';
}
if($understrap_builder_postlayout_featured_size != 'default'){
  $understrap_builder_featured_size = $understrap_builder_postlayout_featured_size;
}

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
  
  <?php if($understrap_builder_postlayout_featured_pos == 'above' && has_post_thumbnail(get_the_ID()) && !$us_b_featured_image_already_shown){ ?>
  <div id="us_b_single_thumb_high" class="<?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_single_image)); ?>">
    <?php echo get_the_post_thumbnail( get_the_ID(), $understrap_builder_featured_size ); ?>
  </div>
  <?php } ?>

	<header class="entry-header<?php if($understrap_builder_headers_single=='centered'){echo ' text-center';}?>">

    <?php if(!$us_b_title_shown_already && $understrap_builder_override_title !='hide'){ ?>
		  <h1 class="entry-title <?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_single_title)); ?>"><?php the_title(); ?></h1>
    <?php } ?>

    <?php if($understrap_builder_postlayout_meta_pos == 'default'){ ?>
		<div class="entry-meta <?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_single_meta)); ?>">
      <small><?php understrap_posted_on(); ?></small>
		</div><!-- .entry-meta -->
    <?php } ?>

	</header><!-- .entry-header -->

  <?php if($understrap_builder_postlayout_featured_pos == 'default' && has_post_thumbnail(get_the_ID()) && !$us_b_featured_image_already_shown){ ?>
  <div id="us_b_single_thumb_low" class="<?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_single_image)); ?>">
	  <?php echo get_the_post_thumbnail( get_the_ID(), $understrap_builder_featured_size ); ?>
  </div>
  <?php } ?>

	<div class="entry-content">

    <div class="content_spacings <?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_single_content)); ?>">
		  <?php the_content(); ?>
    </div>
    
    <?php if($understrap_builder_postlayout_meta_pos == 'below'){ ?>
		<div class="entry-meta <?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_single_meta)); ?>">
      <small><?php understrap_posted_on(); ?></small>
		</div><!-- .entry-meta -->
    <?php } ?>

</article><!-- #post-## -->
