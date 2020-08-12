<?php
/**
 * Este archivo agrega la opción de cambiar el tamaño del logo en el personalizador.
 */
// Exit if accessed directly.
defined('ABSPATH') || exit;

// Register our size logo controls
add_action( 'customize_register', 'logo_size' );

function logo_size($wp_customize){

    //Ajusta el tamaño height de Logo

    $wp_customize->add_setting( 'logo_size_height_control',
	array(
        'type' => 'option',
        'default' => 50,
		'transport' => 'refresh',
		'sanitize_callback' => 'skyrocket_sanitize_integer'
	)
);
    $wp_customize->add_control( new Skyrocket_Slider_Custom_Control( $wp_customize, 'logo_size_height_control',
	array(
		'label' => esc_html__( 'Logo Size Height' ),
		'section' => 'title_tagline',
		'input_attrs' => array(
			'min' => 100, // Required. Minimum value for the slider
			'max' => 1000, // Required. Maximum value for the slider
			'step' => 1, // Required. The size of each interval or step the slider takes between the minimum and maximum values
		),
	)
) );

 //Ajusta el tamaño width de Logo

 $wp_customize->add_setting( 'logo_size_width_control',
 array(
     'type' => 'option',
     'default' => 50,
     'transport' => 'refresh',
     'sanitize_callback' => 'skyrocket_sanitize_integer'
 )
);
 $wp_customize->add_control( new Skyrocket_Slider_Custom_Control( $wp_customize, 'logo_size_width_control',
 array(
     'label' => esc_html__( 'Logo Size Width' ),
     'section' => 'title_tagline',
     'input_attrs' => array(
         'min' => 100, // Required. Minimum value for the slider
         'max' => 1000, // Required. Maximum value for the slider
         'step' => 1, // Required. The size of each interval or step the slider takes between the minimum and maximum values
     ),
 )
) );

}