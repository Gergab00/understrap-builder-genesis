<?php

// Add a BUILDER dropdown in the front end admin bar for links and notifications of updates

add_action('admin_bar_menu', 'understrap_builder_admin_bar_items', 50);
function understrap_builder_admin_bar_items($admin_bar){
  if (current_user_can('manage_options') && !is_admin()){
    // Check for update
    global $BUILDERUpdateChecker;
    $us_b_update_state = $BUILDERUpdateChecker->getUpdateState();
    $us_b_get_update_object = $us_b_update_state->getUpdate();
    $us_b_latest_version = $us_b_get_update_object->version;
    $us_b_installed_version = understrap_builder_get_theme_version();
    $us_b_latest_int = (int)str_replace('.', '', $us_b_latest_version);
    $us_b_installed_int = (int)str_replace('.', '', $us_b_installed_version);
    $us_b_update_notification = '';
    if($us_b_latest_int > $us_b_installed_int){
      $us_b_update_notification = ' <span class="us_b_update_av">UPDATE</span>';
    }
    // Add main BUILDER admin bar dropdown item
    $admin_bar->add_menu( array(
        'id'    => 'builder-admin-bar',
        'title' => 'UnderStrap BUILDER'.$us_b_update_notification,
        'href'  => admin_url('themes.php?page=understrap-builder-settings')
    ));
  }
}