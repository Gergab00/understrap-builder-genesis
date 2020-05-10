<?php

/**
 * BUILDER child pages display.
 *
 * @package understrap-builder
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

global $post;

// Get child pages
$us_b_child_pages_list = get_pages(array('child_of' => $post->ID));

// Check child pages exist
if(count($us_b_child_pages_list)){
  
  echo '<div class="row text-center my-4" id="us_b_child_pages_list">';
  
  // Loop all child page
  foreach($us_b_child_pages_list as $us_b_child_page_object){
    echo '<div class="col-md-4">';
    echo '<a href="'.get_permalink($us_b_child_page_object->ID).'">';
    if(has_post_thumbnail($us_b_child_page_object->ID)){
      echo '<img src="'.wp_get_attachment_url(get_post_thumbnail_id($us_b_child_page_object->ID), 'medium').'" alt="'.$us_b_child_page_object->post_title.'" class="img-fluid mb-3" />';
    }
    echo '<h4>'.$us_b_child_page_object->post_title.'</h4>';
    echo '</a>';
    echo '</div>';
  }
  
  echo '</div>';
  
}



?>