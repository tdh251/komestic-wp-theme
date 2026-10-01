<?php
/**
 * Include the TGM_Plugin_Activation class.
 */
get_template_part( 'inc/admin/libs/tgmpa/class-tgm-plugin-activation' );

add_action( 'tgmpa_register', 'komestic_register_required_plugins' );
function komestic_register_required_plugins() {
    $demos = require get_template_directory() . '/inc/admin/demo-data/demo-config.php';
    

    $pxl_server_info = apply_filters( 'pxl_server_info', ['plugin_url' => 'https://api.casethemes.net/plugins/'] ) ; 
    $default_path = $pxl_server_info['plugin_url'];  
    $images = get_template_directory_uri() . '/inc/admin/assets/img/plugins';
    $plugins = array(
        array(
            'name'               => esc_html__('Case Addons', 'komestic'),
            'slug'               => 'case-addons',
            'source'             => 'case-addons.zip',
            'required'           => true,
            'logo'        => $images . '/case-addons.png',
            'description' => esc_html__( 'Main process and Powerful Elements Plugin, exclusively for Komestic WordPress Theme.', 'komestic' ),
        ),

        array(
            'name'               => esc_html__('Elementor', 'komestic'),
            'slug'               => 'elementor',
            'required'           => true,
            'logo'        => $images . '/elementor.png',
            'description' => esc_html__( 'Introducing a WordPress website builder, with no limits of design. A website builder that delivers high-end page designs and advanced capabilities', 'komestic' ),
        ),

        array(
            'name'               => esc_html__('Redux Framework', 'komestic'),
            'slug'               => 'redux-framework',
            'required'           => true,
            'logo'        => $images . '/redux.png',
            'description' => esc_html__( 'Build theme options and post, page options for WordPress Theme.', 'komestic' ),
        ),

        array(
            'name'               => esc_html__('Contact Form 7', 'komestic'),
            'slug'               => 'contact-form-7',
            'required'           => true,
            'logo'        => $images . '/contact-f7.png',
            'description' => esc_html__( 'Contact Form 7 can manage multiple contact forms, you can customize the form and the mail contents flexibly with simple markup', 'komestic' ),
        ), 

        array(
            'name'               => esc_html__('WooCommerce', 'komestic'),
            'slug'               => "woocommerce",
            'required'           => true,
            'logo'        => $images . '/woo.png',
            'description' => esc_html__( 'WooCommerce is the world’s most popular open-source eCommerce solution.', 'komestic' ),
        ),

        array(
            'name'               => esc_html__('WPC Smart Wishlist for WooCommerce', 'komestic'),
            'slug'               => "woo-smart-wishlist",
            'required'           => true,
            'logo'        => $images . '/woo-smart-wishlist.webp',
            'description' => esc_html__( 'WPC Smart Wishlist is a simple but powerful tool that can help your customer save products for buying later.', 'komestic' ),

        ),

        array(
            'name'               => esc_html__('WPC AJAX Add to Cart for WooCommerce', 'komestic'),
            'slug'               => "wpc-ajax-add-to-cart",
            'required'           => true,
            'logo'        => $images . '/woo-add-to-cart-ajax.webp',
            'description' => esc_html__( 'It is a highly effective plugin for helping online stores cut down the site’s loading time, improve the user experience, and increase sales.', 'komestic' ),
        ),

        array(
            'name'               => esc_html__('WPC AJAX Search for WooCommerce', 'komestic'),
            'slug'               => "wpc-ajax-search",
            'required'           => true,
            'logo'        => $images . '/woo-ajax-search.webp',
            'description' => esc_html__( 'WPC AJAX Search enables visitors on your site to enter the search popup from anywhere the search button is placed and get instant results with a quick preview of product details.', 'komestic' ),
        ),

        array(
            'name'               => esc_html__('WPC Frequently Bought Together for WooCommerce', 'komestic'),
            'slug'               => "woo-bought-together",
            'required'           => true,
            'logo'             => $images . '/woo-bought-together.webp',
            'description' => esc_html__( 'WPC Frequently Bought Together for WooCommerce is a highly effective plugin developed for assisting online businesses in improving sales and profits through the cross-selling marketing strategy.', 'komestic' ),
        ),

        array(
            'name'               => esc_html__('WPC Variation Swatches for WooCommerce', 'komestic'),
            'slug'               => "/wpc-variation-swatches",
            'required'           => true,
            'logo'        => $images . '/wpc-variation-swatches.webp',
            'description' => esc_html__( 'WPC Variation Swatches for WooCommerce will definitely kill the game for online shops and WooCommerce sites with an elegant, responsive look and impressive effects.', 'komestic' ),
        ),

        array(
            'name'               => esc_html__('WPC Variations Radio Buttons for WooCommerce', 'komestic'),
            'slug'               => "/wpc-variations-radio-buttons",
            'required'           => true,
            'logo'        => $images . '/wpc-variations-radio-buttons.webp',
            'description' => esc_html__( 'WPC Variations Radio Buttons for WooCommerce is a blowing hit designed especially for helping store owners bring about a more visitor-friendly interface.', 'komestic' ),
        ),
    );
 

    $config = array(
        'default_path' => $default_path,           // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'is_automatic' => true,
    );

    tgmpa( $plugins, $config );

}