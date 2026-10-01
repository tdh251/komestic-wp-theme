<?php

add_action('after_setup_theme', 'komestic_theme_setup');
function komestic_theme_setup(){

    //Set the content width in pixels, based on the theme's design and stylesheet.
    $GLOBALS['content_width'] = apply_filters( 'komestic_content_width', 1200 );

    // Make theme available for translation.
    load_theme_textdomain( 'komestic', get_template_directory() . '/languages' );

    // Custom Header
    add_theme_support( 'custom-header' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    // Let WordPress manage the document title.
    add_theme_support( 'title-tag' );

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support( 'post-thumbnails' );

    set_post_thumbnail_size( 1170, 710 );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Desktop', 'komestic' ),
        'primary-mobile' => esc_html__( 'Primary Mobile', 'komestic' ),
    ) );

    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );

    // Add support for core custom logo.
    add_theme_support( 'custom-logo', array(
        'height'      => 250,
        'width'       => 250,
        'flex-width'  => true,
        'flex-height' => true,
    ) );
    add_theme_support( 'post-formats', array (
        '',
    ) );

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support('post-thumbnails');

    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
    remove_theme_support('widgets-block-editor');
    add_image_size( 'woobt-thumb', 360, 416, true );
}

/**
 * Register Widgets Position.
 */
add_action( 'widgets_init', 'komestic_widgets_init' );
function komestic_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'komestic' ),
		'id'            => 'sidebar-blog',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h6 class="widget__title"><span>',
		'after_title'   => '</span></h6>',
	) );

	if (class_exists('ReduxFramework')) {
		register_sidebar( array(
			'name'          => esc_html__( 'Page Sidebar', 'komestic' ),
			'id'            => 'sidebar-page',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div></section>',
			'before_title'  => '<h6 class="widget__title">
                                    <span class="widget__title-text">',
            'after_title'   =>      '</span>
                                    <span class="widget__title-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                            <path d="M7.42899 3.82906L0.236257 11.0242C-0.0786644 11.3399 -0.0786644 11.8514 0.236257 12.1679C0.551176 12.4837 1.06269 12.4837 1.37761 12.1679L7.99963 5.54352L14.6217 12.1671C14.9366 12.4829 15.4481 12.4829 15.7638 12.1671C16.0787 11.8514 16.0787 11.3391 15.7638 11.0234L8.57114 3.82827C8.25948 3.5174 7.73993 3.5174 7.42899 3.82906Z" fill="black"/>
                                        </svg>
                                    </span>
                                </h6><div class="widget__content"><div class="widget__content-inner">',
		));
	}

	if ( class_exists( 'Woocommerce' ) ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Shop Sidebar', 'komestic' ),
			'id'            => 'sidebar-shop',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div></section>',
			'before_title'  => '<h6 class="widget__title">
                                    <span class="widget__title-text">',
            'after_title'   =>      '</span>
                                    <span class="widget__title-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                            <path d="M7.42899 3.82906L0.236257 11.0242C-0.0786644 11.3399 -0.0786644 11.8514 0.236257 12.1679C0.551176 12.4837 1.06269 12.4837 1.37761 12.1679L7.99963 5.54352L14.6217 12.1671C14.9366 12.4829 15.4481 12.4829 15.7638 12.1671C16.0787 11.8514 16.0787 11.3391 15.7638 11.0234L8.57114 3.82827C8.25948 3.5174 7.73993 3.5174 7.42899 3.82906Z" fill="black"/>
                                        </svg>
                                    </span>
                                </h6><div class="widget__content"><div class="widget__content-inner">',
		) );
	}

    if ( class_exists( 'Woocommerce' ) ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Shop Sidebar 2', 'komestic' ),
			'id'            => 'sidebar-shop-2',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div></section>',
			'before_title'  => '<h6 class="widget__title">
                                    <span class="widget__title-text">',
            'after_title'   =>      '</span>
                                    <span class="widget__title-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                            <path d="M7.42899 3.82906L0.236257 11.0242C-0.0786644 11.3399 -0.0786644 11.8514 0.236257 12.1679C0.551176 12.4837 1.06269 12.4837 1.37761 12.1679L7.99963 5.54352L14.6217 12.1671C14.9366 12.4829 15.4481 12.4829 15.7638 12.1671C16.0787 11.8514 16.0787 11.3391 15.7638 11.0234L8.57114 3.82827C8.25948 3.5174 7.73993 3.5174 7.42899 3.82906Z" fill="black"/>
                                        </svg>
                                    </span>
                                </h6><div class="widget__content"><div class="widget__content-inner">',
		) );
	}
}

/**
 * Google Fonts
*/
function komestic_fonts_url() {
    $fonts_url = '';
    $fonts     = array();
    $subsets   = 'latin,latin-ext';   

    if ( 'off' !== _x( 'on', 'DM Sans font: on or off', 'komestic' ) ) {
        $fonts[] = 'DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap';
    }

    if ( 'off' !== _x( 'on', 'Syne font: on or off', 'komestic' ) ) {
        $fonts[] = 'Syne:wght@400..800&display=swap';
    }

    if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'komestic' ) ) {
        $fonts[] = 'Open+Sans:ital,wght@0,300..800;1,300..800';
    }

    if ( 'off' !== _x( 'on', 'Playfair Display font: on or off', 'komestic' ) ) {
        $fonts[] = 'Playfair+Display:ital,wght@0,400..900;1,400..900';
    }

    if ( 'off' !== _x( 'on', 'Syne font: on or off', 'komestic' ) ) {
        $fonts[] = 'Syne:wght@400..800&display=swap';
    }

    if ( $fonts ) {
        $fonts_url = add_query_arg( array(
            'family' => implode( '&family=', $fonts ),
            'subset' => urlencode( $subsets ),
        ), '//fonts.googleapis.com/css2?' );
    }
    return $fonts_url;
}