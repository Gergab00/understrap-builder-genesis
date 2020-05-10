<?php



/* Filters and actions on this page */

add_filter( 'pt-ocdi/plugin_page_setup', 'understrap_builder_ocdi_plugin_page_setup' );
add_filter( 'pt-ocdi/import_files', 'understrap_builder_ocdi_import_files' );
add_filter( 'pt-ocdi/plugin_intro_text', 'understrap_builder_ocdi_plugin_intro_text' );
add_filter( 'pt-ocdi/regenerate_thumbnails_in_content_import', '__return_false' );
add_action( 'pt-ocdi/enable_wp_customize_save_hooks', '__return_true' );

add_action( 'pt-ocdi/after_import', 'understrap_builder_ocdi_after_import_setup' );





/* Override the basic One Click Demo Import plugin settings */
function understrap_builder_ocdi_plugin_page_setup( $default_settings ) {
	$default_settings['menu_title']  = esc_html__( '&#x2192; Import Template' , 'understrap-builder' );
	return $default_settings;
}


/* List the importable templates */
function understrap_builder_ocdi_import_files( $predefined_ocdi_themes ) {
	$us_b_basic_themes = array(
    
		array(
			'import_file_name'           => 'Basic Blog',
			'categories'                 => array( 'Blog', 'Free' ),
			'import_file_url'            => 'https://builder.understrap.com/basic-blog/import/demo-content.xml',
			'import_widget_file_url'     => 'https://builder.understrap.com/basic-blog/import/widgets.wie',
			'import_customizer_file_url' => 'https://builder.understrap.com/basic-blog/import/customizer.dat',
			'import_preview_image_url'   => 'https://builder.understrap.com/basic-blog/basic-blog-screenshot.png',
			'import_notice'              => __( 'You will need Contact Form 7 and Gutenberg Bootstrap Blocks plugins for all features of this template to work.', 'understrap-builder' ),
			'preview_url'                => 'https://builder.understrap.com/basic-blog/',
		),
    
    array(
			'import_file_name'           => 'Basic Landing Page',
			'categories'                 => array( 'Landing Page', 'Free', 'Business' ),
			'import_file_url'            => 'https://builder.understrap.com/basic-landing-page/import/demo-content.xml',
			'import_customizer_file_url' => 'https://builder.understrap.com/basic-landing-page/import/customizer.dat',
			'import_preview_image_url'   => 'https://builder.understrap.com/basic-landing-page/basic-landing-page-screenshot.png',
			'import_notice'              => __( 'You will need Contact Form 7 and Gutenberg Bootstrap Blocks plugins for this template to work.', 'understrap-builder' ),
			'preview_url'                => 'https://builder.understrap.com/basic-landing-page/',
		),
    
	);
  return array_merge($predefined_ocdi_themes, $us_b_basic_themes);
}



/* Handle things after a template has been imported */
function understrap_builder_ocdi_after_import_setup() {
	// Assign front page and posts page (blog page).
	$front_page_id = get_page_by_title( 'BUILDER Home' );
	$blog_page_id  = get_page_by_title( 'BUILDER Blog' );
  if($front_page_id != null){
    update_option( 'show_on_front', 'page' );
	  update_option( 'page_on_front', $front_page_id->ID );
  }
  if($blog_page_id != null){
    update_option( 'page_for_posts', $blog_page_id->ID );
  }
}


/* Remove the bulky default intro text and replace with BUILDER alert */
function understrap_builder_ocdi_plugin_intro_text($default_text){
  $builder_pro_alert_text = '';
  if(!function_exists( 'understrap_builder_pro_start' )){
    $builder_pro_alert_text = 'You get a lot more importable templates by upgrading to <a href="https://builder.understrap.com/downloads/pro/">BUILDER PRO</a>.';
  }
	return '<div class="update-nag notice" style="margin-top:20px;margin-bottom:20px"><p>It is best to import to a clean WP install, we recommend the plugin <a href="https://wordpress.org/plugins/wp-reset/" target="_blank">WP Reset</a> to start afresh. '.$builder_pro_alert_text.'</p></div>';
}