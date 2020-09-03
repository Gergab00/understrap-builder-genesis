<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package understrap-builder
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

global $us_b_featured_image_already_shown;

get_header();

// Load Customizer variables
$understrap_builder_container_type = get_option( 'understrap_builder_container_type', 'container');
$understrap_builder_container_page_type = get_option( 'understrap_builder_container_page_type', 'default');
$understrap_builder_breadcrumbs_page_display = get_option( 'understrap_builder_breadcrumbs_page_display', '');

// Handle container
if($understrap_builder_container_page_type != 'default'){
  $understrap_builder_container_type = $understrap_builder_container_page_type;
}

?>

<?php get_template_part( 'global-templates/builder-hero-check' ); ?>

<?php if($understrap_builder_breadcrumbs_page_display == 'under-nav'){ get_template_part( 'global-templates/breadcrumbs-page-check' ); } ?>

<?php get_template_part( 'global-templates/headers-page-check'); ?>

<?php if($understrap_builder_breadcrumbs_page_display == 'under-header'){ get_template_part( 'global-templates/breadcrumbs-page-check'); } ?>

<div class="wrapper" id="page-wrapper">

	<div class="<?php echo esc_attr( $understrap_builder_container_type ); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>
      
      <div class="col content-area" id="primary">

        <main class="site-main" id="main">

          <?php while ( have_posts() ) : the_post(); ?>

            <?php get_template_part( 'loop-templates/content', 'page' ); ?>
          
            <?php get_template_part( 'global-templates/child-pages-check' ); ?>
          
            <?php get_template_part( 'global-templates/the-author-box-page-check' ); ?>

            <?php
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
              comments_template();
            endif;
            ?>

          <?php endwhile; // end of the loop. ?>

        </main><!-- #main -->
        
      </div>

			<!-- Do the right sidebar check -->
			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php get_footer(); ?>
