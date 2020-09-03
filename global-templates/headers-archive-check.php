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


/* PRO Headers */
if(strstr($understrap_builder_headers_archive, 'outside')){ ?>
<div class="wrapper <?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_headers_wrapper)); ?>" id="headers-archive-wrapper">
  <div class="<?php echo esc_attr( $understrap_builder_container_type ); ?> pb-0">
    <div class="row">
      <div class="col-12 <?php if($understrap_builder_headers_archive == 'outside-centered'){ echo 'text-center';}?>">
        <h1 class="<?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_headers_title)); ?>"><?php echo get_the_archive_title(); ?></h1>
        <div class="<?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_headers_meta)); ?>" id="us_b_archive_header_image_full">
          <p>
            <i class="fa fa-bullhorn mr-1"></i>
            <em><?php $us_b_current_category = get_queried_object(); echo $us_b_current_category->count; ?> <small>Post<?php if($us_b_current_category->count>1){echo's';}?></small></em>
          </p>
        </div>
      </div>
      <div class="col-12">
        <hr />
      </div>
    </div>
  </div>
</div>
<?php $us_b_title_shown_already = true; } ?>