<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package understrap-builder
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

global $us_b_title_shown_already;
$us_b_title_shown_already = false;

get_header();

// Load Customizer variables
$understrap_builder_container_type = get_option( 'understrap_builder_container_type', 'container');
$understrap_builder_container_archive_type = get_option( 'understrap_builder_container_archive_type', 'default');
$understrap_builder_breadcrumbs_page_display = get_option( 'understrap_builder_breadcrumbs_page_display', '');

$understrap_builder_hide_title = get_post_meta(get_the_ID(), '_us_b_hide_title', true);

// handle container
if($understrap_builder_container_archive_type != 'default'){
  $understrap_builder_container_type = $understrap_builder_container_archive_type;
}

?>

<?php get_template_part( 'global-templates/breadcrumbs-navbar-archive-check' ); ?>

<?php if(is_front_page()){ /* Home page with blog posts */ ?>

  <?php get_template_part( 'global-templates/builder-hero-check' ); ?>

  <?php get_template_part( 'global-templates/headers-archive-check' ); ?>

<?php } else { /* Blog posts hub /blog/ page */ ?>
  
  <?php if($understrap_builder_breadcrumbs_page_display == 'under-nav'){ get_template_part( 'global-templates/breadcrumbs-page-check'); } ?>

  <?php get_template_part( 'global-templates/headers-page-check'); ?>

  <?php if($understrap_builder_breadcrumbs_page_display == 'under-header'){ get_template_part( 'global-templates/breadcrumbs-page-check'); } ?>
  
<?php } ?>


<div class="wrapper" id="index-wrapper">

	<div class="<?php echo esc_attr( $understrap_builder_container_type ); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check and opens the primary div -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>
      
      <div class="col" id="index-primary">
        
        <div class="row">
          
          <div class="col-12">

            <main class="site-main" id="main">

              <div class="row">

                <?php if ( have_posts() ) : ?>

                  <?php if($understrap_builder_hide_title != 'hide' && !$us_b_title_shown_already && !is_home()){ ?>
                    <div class="col-12 mb-4">
                      <header class="page-header<?php if($understrap_builder_headers_archive == 'centered'){ echo ' text-center';}?>">
                        <h1><?php single_post_title(); ?></h1>
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

              </div>

            </main><!-- #main -->
            
          </div>
          
          <?php if(show_posts_nav()){ ?>
          <div class="col-12 my-4">
            <!-- The pagination component -->
            <?php understrap_pagination(); ?>
          </div>
          <?php } ?>
          
        </div>
        
      </div>

			

			<!-- Do the right sidebar check -->
			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #index-wrapper -->

<?php get_footer(); ?>
