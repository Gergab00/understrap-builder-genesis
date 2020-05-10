<?php


/* ============== Page attributes - show page title etc. ================ */

function understrap_builder_page_add_meta_box(){
  
  $us_b_post_types = array('post', 'page');

  foreach($us_b_post_types as $us_b_post_type){
    add_meta_box(
        'us_b_page_meta',
        'BUILDER '.ucfirst($us_b_post_type).' Options',
        'understrap_builder_page_meta_box',
        $us_b_post_type,
        'side'
    );
  }
  
}
add_action('add_meta_boxes', 'understrap_builder_page_add_meta_box');

function understrap_builder_page_meta_box($post){
  wp_nonce_field( basename( __FILE__ ), 'us_b_page_meta_nonce' ); ?>
  <label class="components-checkbox-control__label" for="us_b_show_page_title" style="margin-top:12px;margin-bottom:12px;display:block">
    <input id="us_b_show_page_title" name="us_b_show_page_title" type="checkbox" value="1"<?php if(get_post_meta( $post->ID, '_us_b_hide_title', true ) == 'hide'){echo ' checked';} ?>>
    Hide <?php echo ucfirst($post->post_type); ?> Title
  </label>
  <?php if(function_exists('understrap_builder_PRO_page_post_meta_add')){ understrap_builder_PRO_page_post_meta_add($post); } ?>
  <?php 
}


function understrap_builder_save_postdata($post_id, $post){

  if ( !isset( $_POST['us_b_page_meta_nonce'] ) || !wp_verify_nonce( $_POST['us_b_page_meta_nonce'], basename( __FILE__ ) ) ){ return $post_id; }
  
  $us_b_show_page_title_check = (int) $_POST['us_b_show_page_title'];
  if($us_b_show_page_title_check != 1){
    update_post_meta( $post_id, '_us_b_hide_title', '' );
  } else {
    update_post_meta( $post_id, '_us_b_hide_title', 'hide' );
  }
  
  $us_b_show_page_author_box_check = (int) $_POST['us_b_show_page_author_box'];
  if($us_b_show_page_author_box_check != 1){
    update_post_meta( $post_id, '_us_b_hide_author_box', '' );
  } else {
    update_post_meta( $post_id, '_us_b_hide_author_box', 'hide' );
  }
  
  $us_b_header_override_check = $_POST['us_b_page_header_override'];
  if($us_b_header_override_check != ''){
    update_post_meta( $post_id, '_us_b_override_header', $us_b_header_override_check );
  } else {
    update_post_meta( $post_id, '_us_b_override_header', '' );
  }
  
}
add_action( 'save_post', 'understrap_builder_save_postdata', 10, 2 );


?>