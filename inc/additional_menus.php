<?php

/* Logic for additional menus added by UnderStrap BUILDER */

/**
 * @package understrap-builder
 */


// Add actions
add_action( 'init', 'understrap_builder_register_menus' );


// Add extra menus for potential locations
function understrap_builder_register_menus() {
  register_nav_menus(
    array(
      'us_b_additonal_primary_menu' => __( 'Additional Primary Menu [BUILDER]', 'understrap-builder' ),
      'us_b_submenu' => __( 'Submenu [BUILDER]', 'understrap-builder' ),
      'us_b_footer_bar' => __( 'Footer Bar [BUILDER]', 'understrap-builder' )
    )
  );
}