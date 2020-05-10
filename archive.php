<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package understrap-builder
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

// Load Customizer variables
$understrap_builder_container_type = get_theme_mod( 'understrap_builder_container_type', 'container');
$understrap_builder_container_archive_type = get_theme_mod( 'understrap_builder_container_archive_type', 'default');

$understrap_builder_headers_archive = get_theme_mod( 'understrap_builder_headers_archive', '');

global $us_b_title_shown_already;
$us_b_title_shown_already = false;

// Handle container
if($understrap_builder_container_archive_type != 'default'){
  $understrap_builder_container_type = $understrap_builder_container_archive_type;
}

?>

<?php get_template_part( 'global-templates/breadcrumbs-archive-check'); ?>

<?php get_template_part( 'global-templates/headers-archive-check' ); ?>

<div class="wrapper" id="archive-wrapper">

	<div class="<?php echo esc_attr( $understrap_builder_container_type ); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>
      
      <div class="col">

        <main class="site-main" id="main">

          <div class="row">

            <?php if ( have_posts() ) : ?>

              <?php if(!$us_b_title_shown_already){ ?>
                <div class="col-12 mb-4">
                  <header class="page-header<?php if($understrap_builder_headers_archive == 'centered'){ echo ' text-center';}?>">
                    <?php
                    if(!$us_b_title_shown_already){ the_archive_title( '<h1 class="page-title">', '</h1>' ); }
                    the_archive_description( '<div class="taxonomy-description">', '</div>' );
                    ?>
                  </header><!-- .page-header -->
                </div>
              <?php } ?>

              <?php /* Start the Loop */ ?>
              <?php while ( have_posts() ) : the_post(); ?>

                <?php get_template_part( 'loop-templates/content', get_post_format() ); ?>

              <?php endwhile; ?>

            <?php else : ?>

              <?php get_template_part( 'loop-templates/content', 'none' ); ?>

            <?php endif; ?>

            <?php if(show_posts_nav()){ ?>
            <div class="col-12 my-4">
              <!-- The pagination component -->
              <?php understrap_pagination(); ?>
            </div>
            <?php } ?>

          </div>

        </main><!-- #main -->
        
      </div>

			<!-- Do the right sidebar check -->
			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

		</div> <!-- .row -->

	</div><!-- #content -->

	</div><!-- #archive-wrapper -->

<?php get_footer(); ?>
