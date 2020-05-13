<?php

// Exit if accessed directly.
defined('ABSPATH') || exit;

add_action('customize_register', 'understrap_builder_woocommerce_customize_register');

if (!function_exists('understrap_builder_woocommerce_customize_register')) {

    function understrap_builder_woocommerce_customize_register($wp_customize)
    {
        $wp_customize->add_section(
            'woocommerce_amazon',
            array(
                'title' => __('Amazon', 'woocommerce'),
                'priority' => 21,
                'panel' => 'woocommerce',
            )
        );
        $wp_customize->add_setting('woocommerce_amazon_simple_notice',
            array(
                'default' => '',
                'transport' => 'postMessage',
                'sanitize_callback' => 'skyrocket_text_sanitization',
            )
        );
        $wp_customize->add_setting('amazon_toggle_switch',
            array(
                'default' => 0,
                'transport' => 'refresh',
                'type' => 'option',
                'sanitize_callback' => 'skyrocket_switch_sanitization',
            )
        );
        $wp_customize->add_setting('amazon_id',
            array(
                'default' => '',
                'transport' => 'refresh',
                'type' => 'option',
                'sanitize_callback' => 'skyrocket_text_sanitization',
            )
        );
        $wp_customize->add_control(
            new Skyrocket_Simple_Notice_Custom_control(
                $wp_customize,
                'woocommerce_amazon_simple_notice',
                array(
                    'label' => __('Afiliados Amazon'),
                    'description' => __('En esta sección podras activar el ID de Afiliados de Amazon y agregarlo para que al momento de realizar compras envie los productos al caritos de Amazon'),
                    'section' => 'woocommerce_amazon',
                )
            )
        );
        $wp_customize->add_control(
            new Skyrocket_Toggle_Switch_Custom_control(
                $wp_customize,
                'amazon_toggle_switch',
                array(
                    'label' => esc_html__('Tienda de Amazon.'),
                    'description' => __('Activa o desactiva la tienda de Amazon.', 'understrap-builder'),
                    'section' => 'woocommerce_amazon',
                )
            )
        );
        $wp_customize->add_control('amazon_id',
            array(
                'label' => __('Amazon ID'),
                'description' => esc_html__('Ingresa el ID de Amazon'),
                'section' => 'woocommerce_amazon',
                 'type' => 'text', // Can be either text, email, url, number, hidden, or date
                 'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
                 'input_attrs' => array( // Optional.
                    'class' => 'form-control',
                    'placeholder' => __('Enter Amazon ID...'),
                ),
            ));
    } //End function
} //End if function exists
