<?php
/**
 * General helper functions for the Komestic theme.
 *
 * @package Komestic_Theme
 * @subpackage Core
 */

if ( ! function_exists( 'komestic_get_image_html_or_svg_content' ) ) {
    function komestic_get_image_html_or_svg_content( $image_id ) { 
        if ( empty( $image_id ) ) {
            return '';
        }

        $output     = '';
        $image_url  = wp_get_attachment_image_url( $image_id, 'full' );

        if ( ! $image_url ) {
            return '';
        }

        if ( strtolower( pathinfo( $image_url, PATHINFO_EXTENSION ) ) === 'svg' ) {
            $upload_dir = wp_upload_dir();
            $image_path = str_replace( $upload_dir['baseurl'], $upload_dir['basedir'], $image_url );

            if ( file_exists( $image_path ) && is_readable( $image_path ) ) {
                $output = file_get_contents( $image_path );
                $output = apply_filters( 'komestic_svg_content', $output, $image_id );
            }
        } else {
            $output = komestic_get_image_by_size( [
                'img_id'        => $image_id,
            ] );
        }

        return $output;
    }
}

if( ! function_exists( 'komestic_get_link_attributes' ) ) {
    function komestic_get_link_attributes( $link ) {
        $output = ''; 
        if ( isset( $link['url'] ) && ! empty( $link['url'] ) ) {
            $output = 'href="' . esc_url( $link['url'] ) . '"';
            if ( isset( $link['is_external'] ) && $link['is_external'] ) {
                $output .= ' target="_blank"';
            }
            if ( isset( $link['nofollow'] ) && $link['nofollow'] ) { 
                $output .= ' rel="nofollow"';
            }
            if ( ! empty( $link['custom_attributes'] ) ) {
                $custom_attributes_array = explode( ',', $link['custom_attributes'] );
                foreach ( $custom_attributes_array as $attr ) {
                    $attr_parts = explode( '|', $attr );
                    if ( count( $attr_parts ) === 2 ) { 
                        list( $key, $value ) = $attr_parts;
                        $output .= ' ' . esc_attr( trim( $key ) ) . '="' . esc_attr( trim( $value ) ) . '"';
                    }
                }
            }
        }
        return $output;
    }
}


// Get Sidebar
function komestic_get_sidebar() {
    global $wp_registered_sidebars;
    $options = [];
    $args = [];
    if ( !$wp_registered_sidebars ) {
        $options[''] = esc_html__( 'No sidebars', 'komestic' );
    } else {
        $options[''] = esc_html__( 'Choose Sidebar', 'komestic' );
        foreach ( $wp_registered_sidebars as $sidebar_id => $sidebar ) {
            $options[ $sidebar_id ] = $sidebar['name'];
        }
    }
    $default_key = array_keys( $options );
    $default_key = array_shift( $default_key );
    $args = [
        'default' => $default_key,
        'options' => $options,
    ];
    return $args;
}

/**
 * 
 */
function komestic_handler_elementor_grid_options($widget, $post_type = 'post') {
    $tax = ['category'];
    if($post_type === 'product') {
        $tax = ['product_cat'];
    }else {
        $tax = [$post_type.'-category'];
    }
    $layout = $widget->get_setting('layout_'.$post_type, $post_type.'-1');
    $select_post_by = $widget->get_setting('select_post_by', '');
    $post_ids = ($select_post_by === 'post_selected') ? $widget->get_setting('source_'.$post_type.'_post_ids', '') : [];
    $source = ($select_post_by === 'term_selected') ? $widget->get_setting('source_'.$post_type , '') : [];
    $orderby = $widget->get_setting('orderby', 'date');
    $order = $widget->get_setting('order', 'desc');
    $limit = $widget->get_setting('limit', 6);
    $query_result = pxl_get_posts_of_grid(
        $post_type, 
        [
            'source' => $source, 
            'orderby' => $orderby, 
            'order' => $order, 
            'limit' => $limit, 
            'post_ids' => $post_ids
        ],
    );
    extract($query_result);

    if( count($posts) <= 0) : ?>
        <div class="pxl-notification"><?php echo esc_html__( 'No Post Found', 'komestic' ); ?></div>;
        <?php return; ?>
    <?php endif;
    
    $title_tag = $widget->get_setting('title_tag', 'h6');
    $img_dimension = $widget->get_setting('img_dimension', 'custom');
    if($img_dimension === 'custom') {
        $custom_img_dimension = $widget->get_setting('custom_img_dimension', []);
        $img_dimension = (!empty($custom_img_dimension['width']) && !empty($custom_img_dimension['height'])) ? $custom_img_dimension : ['width' => 869, 'height' => 462];
    }
    $entrance_anim = $widget->get_setting('entrance_anim', '');
    $anim_delay = $widget->get_setting('anim_delay', 0);
    $layout_type = $widget->get_setting('layout_type', 'grid');
    return get_defined_vars();
}

/**
 * 
 */
function komestic_handler_elementor_swiper_options($widget) {
    wp_enqueue_script('komestic-swiper');
    $effect = $widget->get_setting('effect', 'slide');
    $allow_touch_move = $widget->get_setting('allow_touch_move', '');
    $autoplay = $widget->get_setting('autoplay', false);
    $disable_on_interaction = $widget->get_setting('disable_on_interaction', false);
    $delay = $widget->get_setting('delay', 5000);
    $loop  = $widget->get_setting('loop', false);
    $speed = $widget->get_setting('speed', 500);
    $pagination = $widget->get_setting('swiper_pagination', '');
    $navigation = (bool)$widget->get_setting('swiper_navigation', false);
    $custom_slides = (bool)$widget->get_setting('custom_slides', '');
    $slides_per_view_xs  = $widget->get_setting('slides_per_view_xs', 1);
    $slides_per_view_sm  = $widget->get_setting('slides_per_view_sm', 2);
    $slides_per_view_md  = $widget->get_setting('slides_per_view_md', 3);
    $slides_per_view_lg  = $widget->get_setting('slides_per_view_lg', 3);
    $slides_per_view_xl  = $widget->get_setting('slides_per_view_xl', 4);
    $slides_per_view_xxl = $widget->get_setting('slides_per_view_xxl', 4);
    $swiper_params = [
        'effect'                 => $effect,
        'allow_touch_move'       => (bool)$allow_touch_move,
        'autoplay'               => (bool)$autoplay,
        'disable_on_interaction' => (bool)$disable_on_interaction,
        'delay'                  => $delay,
        'loop'                   => (bool)$loop,
        'speed'                  => $speed,
        'pagination'             => $pagination,
        'navigation'             => $navigation,
        'slides_per_view_xs'     => (int)$slides_per_view_xs,
        'slides_per_view_sm'     => (int)$slides_per_view_sm,
        'slides_per_view_md'     => (int)$slides_per_view_md,
        'slides_per_view_lg'     => (int)$slides_per_view_lg,
        'slides_per_view_xl'     => (int)$slides_per_view_xl,
        'slides_per_view_xxl'    => (int)$slides_per_view_xxl,
    ];
    $swiper_boxshadow = $widget->get_setting('slide_boxshadow', 'swiper-boxshadow');
    $nav_widget_id = $widget->get_setting('nav_widget_id', '');
    $navigation_hidden_class = !empty($nav_widget_id) ? 'swiper-navigation-hidden' : null;
    $nav_btn_icon_prev = $widget->get_settings('nav_btn_icon_prev', []);
    $nav_btn_icon_next = $widget->get_settings('nav_btn_icon_next', []);
    return [
        'swiper_params' => $swiper_params,
        'swiper_boxshadow' => $swiper_boxshadow,
        'nav_widget_id' => $nav_widget_id,
        'navigation_hidden_class' => $navigation_hidden_class,
        'nav_btn_icon_prev' => $nav_btn_icon_prev,
        'nav_btn_icon_next' => $nav_btn_icon_next
    ];
}

if(!function_exists('komestic_get_term_options')){
    function komestic_get_term_options($post_type, $taxonomy = array(), $hide_empty = false)
    {
        if (empty($taxonomy)) {
            $taxonomy = get_object_taxonomies($post_type, 'names');
        }
         
        $term_list = array();
        foreach ($taxonomy as $tax) {
            $terms = get_terms(
                array(
                    'taxonomy' => $tax,
                    'hide_empty' => $hide_empty,
                )
            );
            foreach ($terms as $term) {
                $term_list[$term->term_id] = $term->name;
            }
        }
        return $term_list;
    }
}

/**
 * Get all products
 */
function get_all_products_id_name() {
    $args = array(
        'status' => 'publish',
        'limit'  => -1, 
    );

    $products = wc_get_products($args);

    $products_arr = ['' => 'None'];

    foreach ($products as $product) {
        $products_arr[$product->get_id()] = $product->get_name();
    }

    return $products_arr;
}

/**
 * Get all product with bought together
 */
function get_all_products_with_bought_together() {
    $products_arr = ['' => 'None'];
    if(!class_exists('WPCleverWoobt')) {
        return $products_arr;
    }
    
    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => -1,
        'meta_query'     => array(
            array(
                'key'     => 'woobt_ids',
                'compare' => 'EXISTS',
            ),
        ),
    );

    $query = new WP_Query($args);


    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $product_id = get_the_ID();
            $product    = wc_get_product($product_id);

            if ($product) {
                $products_arr[$product_id] = $product->get_name();
            }
        }
        wp_reset_postdata();
    }

    return $products_arr;
}

function komestic_get_woobt_ids( $product_id ) {
    $raw_ids = get_post_meta( $product_id, 'woobt_ids', true );
    $ids     = [$product_id];

    if ( ! empty( $raw_ids ) && is_array( $raw_ids ) ) {
        foreach ( $raw_ids as $key => $value ) {
            if ( is_numeric( $value ) ) {
                $ids[] = (int) $value;
            } elseif ( is_array( $value ) && ! empty( $value['id'] ) ) {
                $ids[] = (int) $value['id'];
            }
        }
    }

    return $ids;
}

