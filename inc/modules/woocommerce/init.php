<?php
/**
 * Initializes all WooCommerce related functionalities for the Komestic theme.
 *
 * @package Komestic_Theme
 * @subpackage WooCommerce
 */

if ( class_exists( 'WooCommerce' ) ) {
    require_once get_template_directory() . '/inc/modules/woocommerce/hooks.php'; 
    require_once get_template_directory() . '/inc/modules/woocommerce/helpers.php';
    require_once get_template_directory() . '/inc/modules/woocommerce/compare.php'; 
    require_once get_template_directory() . '/inc/modules/woocommerce/wpc-hook.php'; 
    require_once get_template_directory() . '/inc/modules/woocommerce/functions-products.php'; 
    require_once get_template_directory() . '/inc/modules/woocommerce/functions-single-product.php';
    require_once get_template_directory() . '/inc/modules/woocommerce/functions-cart.php';
    require_once get_template_directory() . '/inc/modules/woocommerce/functions-checkout.php';
    require_once get_template_directory() . '/inc/modules/woocommerce/functions-stores.php';
    require_once get_template_directory() . '/inc/modules/woocommerce/functions-order.php';
    require_once get_template_directory() . '/inc/modules/woocommerce/functions-myaccount.php';
    require_once get_template_directory() . '/inc/modules/woocommerce/class-komestic-woobt.php';
    require_once get_template_directory() . '/inc/modules/woocommerce/class-komestic-woovr.php';
    require_once get_template_directory() . '/inc/modules/woocommerce/class-komestic-woosc.php';
    require_once get_template_directory() . '/inc/modules/woocommerce/ajax.php'; 
}