<?php
/**
 * The template for displaying the author pages.
 *
 * Learn more: https://codex.wordpress.org/Author_Templates
 *
 * @package understrap-builder
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

// Load Customizer variables
$understrap_builder_container_type = get_theme_mod( 'understrap_builder_container_type', 'container');
$understrap_builder_container_archive_type = get_theme_mod( 'understrap_builder_container_archive_type', 'default');

// handle container
if($understrap_builder_container_archive_type != 'default'){
  $understrap_builder_container_type = $understrap_builder_container_archive_type;
}

?>

<?php get_template_part( 'global-templates/breadcrumbs-archive-check' ); ?>

<div class="wrapper" id="author-wrapper">

	<div class="<?php echo esc_attr( $understrap_builder_container_type ); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>
      
      <div class="col">

        <main class="site-main" id="main">

          <header class="page-header author-header my-3">

            <?php
            if ( isset( $_GET['author_name'] ) ) {
              $curauth = get_user_by( 'slug', $author_name );
            } else {
              $curauth = get_userdata( intval( $author ) );
              $curauthor_desc = $curauth->user_description;
            }
            ?>

            <div class="media mb-4">

              <?php if ( ! empty( $curauth->ID ) ) : ?>
                <?php echo get_avatar( $curauth->ID, 96, '', esc_html($curauth->nickname).' Photo', array('class' => 'mt-2 mr-4') ); ?>
              <?php endif; ?>

              <div class="media-body">
                <h1 class="mt-0"><?php echo esc_html($curauth->nickname); ?></h1>
                <?php if ( ! empty( $curauth->user_url ) || ! empty( $curauth->user_description ) ) : ?>
                <dl>
                  <?php if ( ! empty( $curauth->user_url ) ) : ?>
                    <dt><?php esc_html_e( 'Website', 'understrap-builder' ); ?></dt>
                    <dd>
                      <a href="<?php echo esc_url( $curauth->user_url ); ?>"><?php echo esc_html( $curauth->user_url ); ?></a>
                    </dd>
                  <?php endif; ?>

                  <?php if ( ! empty( $curauth->user_description ) ) : ?>
                    <dt><?php esc_html_e( 'Profile', 'understrap-builder' ); ?></dt>
                    <dd><?php esc_html( $curauthor_desc, 'understrap-builder' ); ?></dd>
                  <?php endif; ?>
                </dl>
              <?php endif; ?>
              </div>

            </div>					

            <h2><?php echo esc_html( 'Posts by', 'understrap-builder' ) . ' ' . esc_html( $curauth->nickname ); ?>:</h2>

          </header><!-- .page-header -->

          <div class="row mb-4">

            <!-- The Loop -->
            <?php if ( have_posts() ) : ?>

              <?php /* Start the Loop */ ?>
              <?php while ( have_posts() ) : the_post(); ?>

                <?php

                /*
                 * Include the Post-Format-specific template for the content.
                 * If you want to override this in a child theme, then include a file
                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                 */
                get_template_part( 'loop-templates/content', get_post_format() );
                ?>

              <?php endwhile; ?>


            <?php else : ?>

              <?php get_template_part( 'loop-templates/content', 'none' ); ?>

            <?php endif; ?>

            <!-- End Loop -->

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

		</div> <!-- .row -->

	</div><!-- #content -->

</div><!-- #author-wrapper -->

<?php get_footer(); ?>
