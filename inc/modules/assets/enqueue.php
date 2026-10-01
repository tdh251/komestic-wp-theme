<?php
/**
 * Enqueue scripts and styles for the theme.
 *
 * @package Komestic Theme
 */
if ( ! defined( 'COSMETIC_VERSION' ) ) {
    define( 'COSMETIC_VERSION', wp_get_theme()->get('Version') );
}
 

/**
 * Enqueue third-party library scripts and styles.
 */
function komestic_theme_enqueue_library() {
    wp_enqueue_script( 'threejs', get_template_directory_uri() . '/assets/js/libs/threejs.min.js', array( 'jquery' ), COSMETIC_VERSION, true );
    wp_enqueue_script( 'gsap', get_template_directory_uri() . '/assets/js/libs/gsap/gsap.min.js', array( 'jquery' ), '3.12.5', true );
    wp_enqueue_script( 'scroll-trigger', get_template_directory_uri() . '/assets/js/libs/gsap/ScrollTrigger.min.js', array( 'gsap' ), '3.12.5', true ); // Thêm 'gsap' dependency
    wp_enqueue_script( 'split-text', get_template_directory_uri() . '/assets/js/libs/gsap/SplitText.min.js', array( 'gsap' ), '3.12.5', true ); // Thêm 'gsap' dependency

    $smooth_scroll = komestic()->get_theme_opt('smooth_scroll', 'off');
    if( $smooth_scroll === 'on' ) {
        wp_enqueue_script( 'scroll-smoother', get_template_directory_uri() . '/assets/js/libs/gsap/ScrollSmoother.min.js', array( 'gsap', 'scroll-trigger' ), '3.12.5', true ); // Thêm 'gsap', 'scroll-trigger' dependencies
    }

    wp_enqueue_script( 'hover-umd', get_template_directory_uri() . '/assets/js/libs/hover.umd.js', array( 'jquery' ), COSMETIC_VERSION, true );

    // wp_enqueue_script( 'select2', get_template_directory_uri() . '/assets/js/libs/select2.min.js', array( 'jquery' ), '4.1.0', true );

    wp_enqueue_script( 'swiper', get_template_directory_uri() . '/assets/js/libs/swiper.min.js', array( 'jquery' ), '11.2.1', true );
    wp_enqueue_style( 'swiper', get_template_directory_uri() . '/assets/css/libs/swiper.min.css', array(), '11.2.1');

    wp_enqueue_style('magnific-popup', get_template_directory_uri() . '/assets/css/libs/magnific-popup.css', array(), '1.1.0');
    wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/assets/js/libs/magnific-popup.min.js', array( 'jquery' ), '1.1.0', true );

    wp_enqueue_style('wow-animate', get_template_directory_uri() . '/assets/css/libs/animate.min.css', array(), '1.1.0');
    wp_enqueue_script( 'wow-animate', get_template_directory_uri() . '/assets/js/libs/wow.min.js', array( 'jquery' ), '1.0.0', true );

    wp_enqueue_script( 'nice-select', get_template_directory_uri() . '/assets/js/libs/nice-select.min.js', array( 'jquery' ), 'all', true );

    wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/assets/js/libs/modernizr.min.js', array( 'jquery' ), 'all', true );
    
    wp_enqueue_script( 'pxl-woocommerce', get_template_directory_uri() . '/woocommerce/js/woocommerce.js', array( 'jquery' ), COSMETIC_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'komestic_theme_enqueue_library' );

/**
 * Enqueue main theme-specific scripts.
 */
function komestic_theme_enqueue_scripts() {
    wp_enqueue_script( 'komestic-utils', get_template_directory_uri() . '/assets/js/utils.js', array( 'jquery' ), COSMETIC_VERSION, true );
    wp_enqueue_script( 'komestic-scrolling', get_template_directory_uri() . '/assets/js/motion-effects/scrolling.js', [], COSMETIC_VERSION, true );
    wp_enqueue_script( 'komestic-main-jquery', get_template_directory_uri() . '/assets/js/main-jquery.js', array( 'jquery' ), COSMETIC_VERSION, true );
    wp_enqueue_script( 'komestic-menu', get_template_directory_uri() . '/assets/js/menu.js', array( 'jquery' ), COSMETIC_VERSION, true );
    wp_enqueue_script( 'komestic-main-js', get_template_directory_uri() . '/assets/js/main-vanilla.js', array( 'jquery' ), COSMETIC_VERSION, true );
    if(class_exists('Woocommerce')) {
        wp_enqueue_script( 'komestic-wc-main-js', get_template_directory_uri() . '/assets/js/woocommerce/main.js', array( 'jquery' ), COSMETIC_VERSION, true );
        wp_enqueue_script( 'komestic-wpc-js', get_template_directory_uri() . '/assets/js/woocommerce/wpc.js', array( 'jquery' ), COSMETIC_VERSION, true );
        wp_enqueue_script( 'komestic-compare-js', get_template_directory_uri() . '/assets/js/woocommerce/compare.js', array( 'jquery' ), COSMETIC_VERSION, true );
    }
    wp_enqueue_script( 'komestic-elementor', get_template_directory_uri() . '/assets/js/elementor/main.js', [ 'jquery' ], COSMETIC_VERSION , true);
}
add_action( 'wp_enqueue_scripts', 'komestic_theme_enqueue_scripts' );

/**
 * Register scripts
 */
function komestic_theme_register_scripts() {
    wp_register_script('komestic-animated', get_template_directory_uri() . '/elements/assets/js/animated.js', [ 'jquery' ], COSMETIC_VERSION , true);

    wp_register_script('pxl-post-grid', get_template_directory_uri() . '/elements/assets/js/grid.js', [ 'isotope', 'jquery' ], COSMETIC_VERSION , true);
    wp_localize_script('pxl-post-grid', 'main_data', array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'wpnonce' => wp_create_nonce( '_ajax_nonce' ) ) );

    wp_register_script('komestic-accordion', get_template_directory_uri() . '/elements/assets/js/accordion.js', [ 'jquery' ], COSMETIC_VERSION , true);
    wp_register_script('komestic-scrolling', get_template_directory_uri() . '/elements/assets/js/scrolling.js', [ 'jquery' ], COSMETIC_VERSION , true);
    wp_register_script('komestic-effects', get_template_directory_uri() . '/elements/assets/js/effects.js', [ 'jquery' ], COSMETIC_VERSION , true);
    wp_register_script('komestic-swiper', get_template_directory_uri() . '/elements/assets/js/swiper.js', [ 'jquery' ], COSMETIC_VERSION , true);
    wp_register_script('komestic-tabs', get_template_directory_uri() . '/assets/js/elementor/tabs.js', [ 'jquery' ], COSMETIC_VERSION , true);
}
add_action( 'wp_enqueue_scripts', 'komestic_theme_register_scripts' );

/**
 * Enqueue AJAX handling scripts and localize data.
 */
function komestic_theme_enqueue_ajax_scripts() {
    // wp_enqueue_script('komestic-ajax-product-categories', get_template_directory_uri() . '/assets/js/ajax/ajax-handlers.js', [ 'jquery' ], COSMETIC_VERSION, true);
    wp_localize_script(
        'komestic-main-jquery',
        'komestic_ajax_object',  
        [
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce'    => wp_create_nonce( '_ajax_nonce' )
        ]
    );

    wp_localize_script( 
        'pxl-main', 
        'main_data', 
        [
            'ajax_url' => admin_url( 'admin-ajax.php' )
        ]
    );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'komestic_theme_enqueue_ajax_scripts' );

/**
 * Enqueue styles.
 */
function komestic_theme_enqueue_style() {
    wp_enqueue_style( 'komestic-google-fonts', komestic_fonts_url(), array(), null );
    wp_enqueue_style( 'flaticon', get_template_directory_uri() . '/assets/css/flaticon.css', array(), COSMETIC_VERSION );
    wp_enqueue_style( 'komestic-grid', get_template_directory_uri() . '/assets/css/grid.css', array(), COSMETIC_VERSION );
	wp_enqueue_style( 'komestic-style', get_template_directory_uri() . '/assets/css/style.css', array(), rand() );
    wp_add_inline_style( 'komestic-style', komestic_generate_inline_style() );
    wp_enqueue_style( 'komestic-base', get_template_directory_uri() . '/style.css', array(), COSMETIC_VERSION );
}
add_action( 'wp_enqueue_scripts', 'komestic_theme_enqueue_style' );

/**
 * Enqueue Styles Scripts : Back-End
 */
add_action('admin_enqueue_scripts', 'komestic_admin_enqueue');
function komestic_admin_enqueue() {
    wp_enqueue_style( 'komestic-admin-style', get_template_directory_uri() . '/assets/css/admin.css', array(), COSMETIC_VERSION );
    wp_enqueue_style('magnific-popup', get_template_directory_uri() . '/assets/css/libs/magnific-popup.css', array(), '1.1.0');
    wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/assets/js/libs/magnific-popup.min.js', array( 'jquery' ), '1.1.0', true );
}

/**
 * Enqueue third-party elementor scripts and styles.
 */
add_action( 'elementor/editor/before_enqueue_scripts', function() {
    wp_enqueue_style( 'komestic-admin-style', get_template_directory_uri() . '/assets/css/admin.css');
});

/**
 * Enqueue woocommerce price settings
 */
if(class_exists('Woocommerce')) {
    add_action('wp_enqueue_scripts', function () {
        $currency = get_woocommerce_currency_symbol();
        $currency_pos = get_option('woocommerce_currency_pos');
        $thousand_sep = wc_get_price_thousand_separator();
        $decimal_sep = wc_get_price_decimal_separator();
        $num_decimals = wc_get_price_decimals();

        wp_enqueue_script('accounting'); 

        wp_localize_script('jquery', 'wc_price_settings', [
            'currency'       => $currency,
            'currency_pos'   => $currency_pos,
            'thousand_sep'   => $thousand_sep,
            'decimal_sep'    => $decimal_sep,
            'num_decimals'   => $num_decimals
        ]);
        wp_localize_script(
            'komestic-wc-main-js', 
            'komestic_ajax', 
            [
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce'   => wp_create_nonce( 'komestic-nonce' ),
            ]
        );
        wp_localize_script(
            'komestic-compare-js', 
            'komestic_ajax', 
            [
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce'   => wp_create_nonce( 'komestic_nonce' ),
            ]
        );
    });
}