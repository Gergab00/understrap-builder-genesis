<?php
/**
 * Sidebar setup for footer full.
 *
 * @package understrap-builder
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Load Customizer variables
$understrap_builder_container_type = get_theme_mod( 'understrap_builder_container_type', 'container');

global $builder_default_spacings;
$understrap_builder_spacings_footer_widgets = get_theme_mod( 'understrap_builder_spacings_footer_widgets', $builder_default_spacings );

?>

<?php if ( is_active_sidebar( 'footerfull' ) ) : ?>

  <div class="row <?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_footer_widgets)); ?>" id="us_b_footer_widgets">

    <?php dynamic_sidebar( 'footerfull' ); ?>

  </div>

<?php endif; ?>
