<?php

// Reset Customizer settings to default
function understrap_builder_reset_default(){
  remove_theme_mods();
}

// Manuall check for new theme version
function understrap_builder_manually_check_version(){
  global $BUILDERUpdateChecker;
  $BUILDERUpdateChecker->checkForUpdates();
}

// Return the current installed BUILDER theme version
function understrap_builder_get_theme_version() {
  $theme = wp_get_theme();
  return $theme->get( 'Version' );
}