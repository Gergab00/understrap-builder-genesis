<?php

/**
 * PRO Headers check for pages.
 *
 * @package understrap-builder
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
if(!is_user_logged_in() && get_option('usblkv')!='1'){return'';}

global $us_b_title_shown_already;

// Load Customizer variables
$understrap_builder_container_type = get_option( 'understrap_builder_container_type', 'container');
$understrap_builder_container_archive_type = get_option( 'understrap_builder_container_single_type', 'default');

$understrap_builder_container_archive_type = get_option( 'understrap_builder_container_archive_type', 'default');
$understrap_builder_headers_archive = get_option( 'understrap_builder_headers_archive', '');

global $builder_default_spacings;
$understrap_builder_spacings_headers_wrapper = get_option( 'understrap_builder_spacings_headers_wrapper', $builder_default_spacings );
$understrap_builder_spacings_headers_title = get_option( 'understrap_builder_spacings_headers_title', $builder_default_spacings );
$understrap_builder_spacings_headers_meta = get_option( 'understrap_builder_spacings_headers_meta', $builder_default_spacings );


// Handle container
if($understrap_builder_container_archive_type != 'default'){
  $understrap_builder_container_type = $understrap_builder_container_archive_type;
}

// Header
if(strstr($understrap_builder_headers_archive, 'outside')){
  $us_b_title_shown_already = true;
}

// Search logic
global $wp_query;
$us_b_search_results_count = $wp_query->found_posts;


/* PRO Headers */ 
if($understrap_builder_headers_archive != ''){ ?>
<div class="wrapper <?php echo esc_attr($us_b_headers_archive_wrap_class); ?> <?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_headers_wrapper)); ?>" id="headers-archive-wrapper">
  
  <?php if(strstr($understrap_builder_headers_archive, 'outside')){ /* Outside of Content */ ?>
    <div class="<?php echo esc_attr( $understrap_builder_container_type ); ?>">
      <div class="row">
        <div class="col-12">
          <h1 class="page-title <?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_headers_title)); ?>">
            <?php
            printf(
              /* translators: %s: query term */
              esc_html__( 'Search Results for: %s', 'understrap-builder' ),
              '<span>' . get_search_query() . '</span>'
            );
            ?>
          </h1>
          <?php if($us_b_search_results_count > 0){ ?>
          <div id="us_b_archive_header_image_full" class="<?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_headers_meta)); ?>">
            <p>
              <i class="fa fa-bullhorn mr-1"></i>
              <em><?php echo $us_b_search_results_count; ?> <small>Result<?php if($us_b_search_results_count>1){echo's';}?></small></em>
            </p>
          </div>
          <?php } ?>
        </div>
        <div class="col-12">
          <hr />
        </div>
      </div>
    </div>
  <?php $us_b_title_shown_already = true; } ?>
  
</div>
<?php } ?>