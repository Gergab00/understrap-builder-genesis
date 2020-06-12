<?php
/**
 * The template for displaying all single posts.
 *
 * @package understrap-builder
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

// Load Customizer variables
$understrap_builder_container_type = get_theme_mod( 'understrap_builder_container_type', 'container');
$understrap_builder_container_single_type = get_theme_mod( 'understrap_builder_container_single_type', 'default');

$understrap_builder_postlayout_bg = get_theme_mod( 'understrap_builder_postlayout_bg', '');
$understrap_builder_postlayout_text = get_theme_mod( 'understrap_builder_postlayout_text', '');
$understrap_builder_postlayout_text_align = get_theme_mod( 'understrap_builder_postlayout_text_align', '');
$understrap_builder_postlayout_vertical_margin = get_theme_mod( 'understrap_builder_postlayout_vertical_margin', '');

$understrap_builder_breadcrumbs_single_post_display = get_theme_mod( 'understrap_builder_breadcrumbs_single_post_display', 'under-nav');

$understrap_builder_comments_display = get_theme_mod( 'understrap_builder_comments_display', 1);


// Container
if($understrap_builder_container_single_type != 'default'){
  $understrap_builder_container_type = $understrap_builder_container_single_type;
}

// Background
$understrap_builder_content_bg_class = '';
if($understrap_builder_postlayout_bg == 'all-light'){
  $understrap_builder_content_bg_class = 'bg-light p-3';
} else if($understrap_builder_postlayout_bg == 'all-dark') {
  $understrap_builder_content_bg_class = 'bg-dark p-3';
} else if($understrap_builder_postlayout_bg == 'content-light') {
  $understrap_builder_content_bg_class = ' bg-light p-4';
} else if($understrap_builder_postlayout_bg == 'content-dark') {
  $understrap_builder_content_bg_class = ' bg-dark p-4';
}
$understrap_builder_text_align_class = '';

// Text align
if($understrap_builder_postlayout_text_align != ''){
  $understrap_builder_text_align_class = ' text-'.$understrap_builder_postlayout_text_align;
}

// Text color
if($understrap_builder_postlayout_text != ''){
  $understrap_builder_postlayout_text = ' text-'.$understrap_builder_postlayout_text;
}

?>

<?php if($understrap_builder_breadcrumbs_single_post_display == 'under-nav'){ get_template_part( 'global-templates/breadcrumbs-single-check' ); } ?>

<?php get_template_part( 'global-templates/headers-single-check' ); ?>

<?php if($understrap_builder_breadcrumbs_single_post_display == 'under-header'){ get_template_part( 'global-templates/breadcrumbs-single-check' ); } ?>

<div class="wrapper p-0 mt-4" id="single-wrapper">

	<div class="<?php echo esc_attr( $understrap_builder_container_type ); ?>" id="content" tabindex="-1">

		<div class="row<?php echo esc_attr($understrap_builder_postlayout_text); ?> <?php echo esc_attr( $understrap_builder_postlayout_vertical_margin ); ?>">
      
      <?php if(strpos($understrap_builder_postlayout_bg, 'all') !== false){ ?>
      <div class="col">
        <div class="<?php echo esc_attr($understrap_builder_content_bg_class); ?>">
          <div class="row">
      <?php } ?>

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>
      
      <div class="col content-area" id="primary">

        <main class="site-main<?php echo esc_attr($understrap_builder_content_bg_class).esc_attr($understrap_builder_text_align_class); ?>" id="main">

          <?php while ( have_posts() ) : the_post(); ?>

            <?php get_template_part( 'loop-templates/content', 'single' ); ?>
          
            <?php get_template_part( 'global-templates/the-author-box-single-check' ); ?>

            <?php
            // UnderStrap BUILDER comments disable
            if($understrap_builder_comments_display == 1){
              // If comments are open or we have at least one comment, load up the comment template.
              if ( comments_open() || get_comments_number() ) :
                comments_template();
              endif;
            }
            ?>

          <?php endwhile; // end of the loop. ?>

        </main><!-- #main -->
        
      </div>

			<!-- Do the right sidebar check -->
			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

		</div><!-- .row -->

	</div><!-- #content -->
      
  <?php if(strpos($understrap_builder_postlayout_bg, 'all') !== false){ ?>
      </div>
    </div>
  </div>
  <?php } ?>

</div><!-- #single-wrapper -->

<?php get_footer(); ?>
