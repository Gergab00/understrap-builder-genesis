<?php

// Exit if accessed directly.
defined('ABSPATH') || exit;

/**
* Add the new custom control for the theme.
* Agregar el control personalizado al tema.
*/
require_once( trailingslashit( get_stylesheet_directory() ). 'inc/customizer/social-media-control.php' );
require_once( trailingslashit( get_stylesheet_directory() ). 'inc/customizer/navbar-link-color.php' );
require_once( trailingslashit( get_stylesheet_directory() ). 'inc/customizer/logo-size.php' );
require_once( trailingslashit( get_stylesheet_directory() ). 'inc\github-updater\github-updater.php' );
//require_once( trailingslashit( get_stylesheet_directory() ). 'inc/cluster-nav-creator/cluster-nav-creator-function.php' );

/* UnderStrap BUILDER Genesis Template Functions */
/**
 *
 * FUNCION QUE RETORNA LA URL PARA AMAZON AFFILATES.
 * 
 * @author Gerardo González <gergab00@hotmail.com>
 * @version 1.0.0
 * @package Genesis Pluings
 * @param string $associateTag ID de AmazonAffilates
 * @return string $urlAmazon String con la URL Completa para el carrito de Amazon
 * @license GNU General Public License v2 or lat
 *
 */
function wc_get_checkout_url_amazon($associateTag = 'tecnologias36-20')
{
    $itemNum = 0;
    $urlAmazon = 'https://www.amazon.com.mx/gp/aws/cart/add.html?AssociateTag=' . $associateTag;
    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
        $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
        if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key)) {
            $itemNum++;
            $urlAmazon .= '&ASIN.' . $itemNum . '=' . $_product->get_sku();
            $urlAmazon .= '&Quantity.' . $itemNum . '=' . $cart_item['quantity'];
        }
    }
    return $urlAmazon;
}

/**
 *
 * @author Gerardo González <gergab00@hotmail.com>
 * @category Función que retorna un Booleano para revisar el estado de los plugins
 * @param string $type, nombre del plugin
 * @return boolean $state True si esta activado, false si esta desactivado.
 *
 */
function check_plugin_state($type = '')
{
    include_once ABSPATH . 'wp-admin/includes/plugin.php';
    $state = false;
    switch ($type) {
        case 'woocommerce':
            $state = is_plugin_active('woocommerce/woocommerce.php');
            break;
        case 'mailchimp-for-wp':
            $state = is_plugin_active('mailchimp-for-wp/mailchimp-for-wp.php');
            break;
        default:
            break;
    }
    return $state;
}

/**
 *
 * @author Gerardo González <gergab00@hotmail.com>
 * @category Función que modifica el tamaño de la imagen del logo
 * @version 1.1.1
 * @package Genesis Pluings
 */
if (!function_exists('genesis_custom_logo_setup')) {
    function genesis_custom_logo_setup($width=106,$height=122)
    {
        $custom_logo_id = get_option('custom_logo');
        $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
        if (has_custom_logo()) {
            $html = sprintf(
                '<a href="%1$s" class="custom-logo-link" rel="home">%2$s</a>',
                esc_url( home_url( '/' ) ),
                '<img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . 
                '" width="'.$width.'px" height="'.$height.'px">'
            );
            echo $html;
        } else {
            echo '<h1>' . get_bloginfo('name') . '</h1>';
        }
        ;
    }
}

//3c11c82e87bfd8927ec36798f3058113f87e555e

/**
 * Configuraciones personalizadas de github-upodate
 */
add_filter ( 'github_updater_disable_wpcron' , '__return_true' );
add_filter ( 'github_updater_hide_settings' , '__return_true' );
add_filter ( 'github_updater_set_options' ,
	 function () {
		 return  array ( 
			 'understrap-builder-genesis'=> '3c11c82e87bfd8927ec36798f3058113f87e555e' ,
		);
	});