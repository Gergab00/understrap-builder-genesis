<?php
/**
 * Onpage styles to display dynamically on the front end.
 *
 * @package understrap-builder
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// JS to display at bottom of page
function check_display_onpage_scripts(){
  
  $scripts_to_display = '';
  
  // If scripts available, output them
  if($scripts_to_display != ''){
  ?>
  <script><?php echo $scripts_to_display; ?></script>
  <?php
  }
  
}

?>