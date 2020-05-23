<?php
/**
 * Este archivo agrega la opción de cambiar el color del link del navbar desde el personalizador
 */

// Register our navbar link color controls
add_action( 'customize_register', 'navbar_link_color' );

function navbar_link_color ($wp_customize){

    global $us_b_potential_bootstrap_color_classes;
    $bs_color_navlink = array();

    foreach ($us_b_potential_bootstrap_color_classes as $bs_color => $bs_color_default) {

        $bs_color_lower = strtolower($bs_color);

        $bs_color_navlink[$bs_color_default] = ucfirst ($bs_color_lower).' [.bg-'.$bs_color_lower.']';

        /*echo '<script>';
        echo 'console.log( "Array: '.$bs_color_navlink[$bs_color_default].' '.$bs_color_default.'")';
        echo '</script>';*/

    }

    //Add setting for nav link color
    $wp_customize->add_setting(
        'understrap_genesis_navbar_link_color',
        array(
            'default' => '#000000',
            'type' => 'option',
            'transport' => 'refresh',
            'sanitize_callback' => 'skyrocket_text_sanitization',
            'capability' => 'edit_theme_options',
        )
    );

    // Theme navbar link color
        $wp_customize->add_control(
            new Skyrocket_Text_Radio_Button_Custom_Control(
                $wp_customize,
                'understrap_genesis_navbar_link_color',
                array(
                    'label' => __('Nav Link Color', 'understrap-builder'),
                    'description' => __('Choose the nav-link Bootstrap color class.', 'understrap-builder'),
                    'section' => 'understrap_builder_navbar_options',
                    'settings' => 'understrap_genesis_navbar_link_color',
                    'choices' => $bs_color_navlink,
                    'priority' => '17',
                )
            )
        );
}

function navlink_color_style(){
    $bs_color_navlink = get_option( 'understrap_genesis_navbar_link_color');
        echo '<script>';
        echo 'console.log( "Color: '.$bs_color_navlink.'")';
        echo '</script>';
    ?>
    <style>a.nav-link {color: <?php echo $bs_color_navlink ?> !important;}</style>
    <?php
}
?>