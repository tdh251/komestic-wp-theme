<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

$is_register_page = isset($_GET['action']) && $_GET['action'] === 'register';
do_action( 'woocommerce_before_customer_login_form' ); 
if($is_register_page) {
	include  get_template_directory().'/template-parts/woocommerce/register.php';
}else {
	include  get_template_directory().'/template-parts/woocommerce/login.php'; 
}
do_action( 'woocommerce_after_customer_login_form' ); 
