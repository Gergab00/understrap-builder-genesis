<?php
/**
 * The template for displaying search results pages.
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
$understrap_builder_breadcrumbs_archive_display = get_option( 'understrap_builder_breadcrumbs_archive_display', '');

// handle container
if($understrap_builder_container_archive_type != 'default'){
  $understrap_builder_container_type = $understrap_builder_container_archive_type;
}

?>

<?php if($understrap_builder_breadcrumbs_archive_display == 'under-nav'){ get_template_part( 'global-templates/breadcrumbs-archive-check' ); } ?>

<?php get_template_part( 'global-templates/headers-search-check' ); ?>

<?php if($understrap_builder_breadcrumbs_archive_display == 'under-header'){ get_template_part( 'global-templates/breadcrumbs-archive-check' ); } ?>

<div class="wrapper" id="search-wrapper">

	<div class="<?php echo esc_attr( $understrap_builder_container_type ); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check and opens the primary div -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>
      
      <div class="col">

        <main class="site-main" id="main">
          
          <div class="row">

          <?php if ( have_posts() ) : ?>

            <?php if(!$us_b_title_shown_already){ ?>
              <div class="col-12">
                <header class="page-header">

                    <h1 class="page-title">
                      <?php
                      printf(
                        /* translators: %s: query term */
                        esc_html__( 'Search Results for: %s', 'understrap-builder' ),
                        '<span>' . get_search_query() . '</span>'
                      );
                      ?>
                    </h1>

                </header><!-- .page-header -->
              </div>
            <?php } ?>

            <?php /* Start the Loop */ ?>
            <?php while ( have_posts() ) : the_post(); ?>

              <?php
              /**
               * Run the loop for the search to output the results.
               * If you want to overload this in a child theme then include a file
               * called content-search.php and that will be used instead.
               */
              get_template_part( 'loop-templates/content', get_post_format() );
              ?>

            <?php endwhile; ?>

          <?php else : ?>

            <?php get_template_part( 'loop-templates/content', 'none' ); ?>

          <?php endif; ?>
            
          </div>
          
          <div class="row my-4">
            <div class="col-12">
              <!-- The pagination component -->
			        <?php understrap_pagination(); ?>
            </div>
            
          </div>

        </main><!-- #main -->
        
      </div>

			<!-- Do the right sidebar check -->
			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #search-wrapper -->

<?php get_footer(); ?>
