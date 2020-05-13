<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


/* UnderStrap BUILDER Template Functions */

// In HEAD after the wp_head
function understrap_builder_in_head(){
  
  // Load Customizer variables
  $understrap_builder_add_head = get_theme_mod( 'understrap_builder_add_head', '');
  
  // Customizer HEAD content
  echo $understrap_builder_add_head;
  
  // Onpage styles, container width class etc.
  check_display_onpage_styles();
  
}

// After /BODY tag and wp_footer function
function understrap_builder_after_footer(){
  
  // Load Customizer variables
  $understrap_builder_add_footer = get_theme_mod( 'understrap_builder_add_footer', '');
  $understrap_builder_js = get_theme_mod( 'understrap_builder_js', '');
  
  // Customizer after /BODY content
  echo $understrap_builder_add_footer;
  
  check_display_onpage_scripts();
  
  // Customizer additional JS
  if($understrap_builder_js != ''){
    echo '<script>';
    echo $understrap_builder_js;
    echo '</script>';
  }
  
}


// Set the number of posts per page in archives
add_action( 'pre_get_posts', 'understrap_builder_posts_limit' );
function understrap_builder_posts_limit( $query ) {
  if($query->is_main_query() && !is_admin()){
    $understrap_builder_archives_posts_per_page = get_theme_mod( 'understrap_builder_archives_posts_per_page', 10);
    $query->set('posts_per_page', esc_attr($understrap_builder_archives_posts_per_page));
  }
}


// If more than one page exists, return TRUE.
function show_posts_nav() {
  global $wp_query;
  return ($wp_query->max_num_pages > 1);
}


// handle the BUILDER spacings JSON string to return classes string
function understrap_builder_spacings_handler($us_b_spacings_string){
  $class_return = '';
  $us_b_spacings_obj = json_decode($us_b_spacings_string);
  
  foreach($us_b_spacings_obj as $possible_spacing_class => $spacing_display_class){
    if($spacing_display_class != '[none]'){
      $class_return .= ' '.$spacing_display_class;
    }
  }
  
  return trim($class_return);
}


/* BUILDER Handle the custom logo classes */
add_filter( 'get_custom_logo', 'understrap_builder_custom_logo' );
function understrap_builder_custom_logo($html) {
  global $builder_default_spacings;
  $understrap_builder_spacings_navbar_logo = get_theme_mod( 'understrap_builder_spacings_navbar_logo', $builder_default_spacings );
  $html = str_replace( 'custom-logo-link', 'custom-logo-link '.esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_navbar_logo)), $html );
  return $html;
}

/**
 * 
 *@author Gerardo González <gergab00@hotmail.com>
 * @category FUNCION QUE RETORNA LA URL PARA AMAZON AFFILATES.
 * @param string $associateTag ID de AmazonAffilates
 * @return string $urlAmazon String con la URL Completa para el carrito de Amazon
 */
function wc_get_checkout_url_amazon($associateTag='tecnologias36-20'){
	$itemNum = 0;
	$urlAmazon = 'https://www.amazon.com.mx/gp/aws/cart/add.html?AssociateTag='.$associateTag;
	foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
		$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
		if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
			$itemNum++;
			$urlAmazon .= '&ASIN.'.$itemNum.'='.$_product->get_sku();
			$urlAmazon .= '&Quantity.'.$itemNum.'='.$cart_item['quantity'];
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
   */
  function check_plugin_state($type=''){
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
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


?>