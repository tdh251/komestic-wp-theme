<?php
    $orderby = $widget->get_setting('orderby', 'date');
    $order = $widget->get_setting('order', 'desc');
    $limit = $widget->get_setting('limit', 6);
    $hide_cat_empty = (bool)$widget->get_setting('hide_cat_empty', '');
    $include_ids = $widget->get_setting('include_ids', []);
    $cat_arr = komestic_get_product_categories([
        'orderby' => $orderby,
        'order'  => $order,
        'limit' => $limit,
        'hide_cat_empty' => $hide_cat_empty,
        'include_ids' => $include_ids,
    ]);

    $img_dimension = $widget->get_setting('img_dimension', 'full');
    if($img_dimension === 'custom') {
        $custom_img_dimension = $widget->get_setting('custom_img_dimension', []);
        $img_dimension = (!empty($custom_img_dimension['width']) && !empty($custom_img_dimension['height'])) ? $custom_img_dimension : 'full';
    }
    $title_tag = $widget->get_setting('title_tag', 'div');
    $entrance_anim = $widget->get_setting('entrance_anim', '');
    $anim_delay = $widget->get_setting('anim_delay', 0);
    
    $show_count = (bool)$widget->get_setting('show_count', '');

    $display_settings = [
        'entrance_anim' => $entrance_anim,
        'anim_delay' => $anim_delay,
        'template' => '2',
        'img_dimension' => $img_dimension,
        'title_tag' => $title_tag,
        'categories' => $cat_arr['categories'],
        'layout' => 'carousel',
        'show_count' => $show_count,
    ];

    wp_enqueue_script( 'komestic-swiper' );

    $allow_touch_move = $widget->get_setting('allow_touch_move', '');
    $autoplay = $widget->get_setting('autoplay', false);
    $delay = $widget->get_setting('delay', 5000);
    $disable_on_interaction = $widget->get_setting('disable_on_interaction', false);
    $loop  = $widget->get_setting('loop', false);
    $speed = $widget->get_setting('speed', 500);
    $space_between = $widget->get_setting('space_between', 51);
    $pagination = $widget->get_setting('swiper_pagination', '');
    $navigation = (bool)$widget->get_setting('swiper_navigation', false);
    $slides_per_view_xs  = $widget->get_setting('slides_per_view_xs', 2);
    $slides_per_view_sm  = $widget->get_setting('slides_per_view_sm', 3);
    $slides_per_view_md  = $widget->get_setting('slides_per_view_md', 4);
    $slides_per_view_lg  = $widget->get_setting('slides_per_view_lg', 5);
    $slides_per_view_xl  = $widget->get_setting('slides_per_view_xl', 6);
    $slides_per_view_xxl = $widget->get_setting('slides_per_view_xxl', 8);
    $swiper_params = [
        'effect'                 => 'slide',
        'allow_touch_move'       => (bool)$allow_touch_move,
        'direction'              => 'horizontal',
        'autoplay'               => (bool)$autoplay,
        'delay'                  => $delay,
        'disable_on_interaction' => (bool)$disable_on_interaction,
        'loop'                   => (bool)$loop,
        'speed'                  => $speed,
        'pagination'             => $pagination,
        'navigation'             => $navigation,
        'space_between'          => $space_between,
        'slides_per_view_xs'     => (int)$slides_per_view_xs,
        'slides_per_view_sm'     => (int)$slides_per_view_sm,
        'slides_per_view_md'     => (int)$slides_per_view_md,
        'slides_per_view_lg'     => (int)$slides_per_view_lg,
        'slides_per_view_xl'     => (int)$slides_per_view_xl,
        'slides_per_view_xxl'    => (int)$slides_per_view_xxl,
    ];
    $swiper_params = json_encode( $swiper_params );

    $swiper_boxshadow = $widget->get_setting('swiper_boxshadow', '');
    $nav_widget_id = $widget->get_setting('nav_widget_id', '');
    $navigation_hidden_class = !empty($nav_widget_id) ? 'swiper-navigation-hidden' : null;
    $nav_btn_icon_prev = $widget->get_settings('nav_btn_icon_prev', []);
    $nav_btn_icon_next = $widget->get_settings('nav_btn_icon_next', []);

    $layout2_style = $widget->get_setting('layout2_style', '1');
?>

<div class="pxl-swiper pxl-product-categories" data-layout="2" data-layout_style="<?php echo esc_attr($layout2_style); ?>">
    <div class="swiper-inner">
        <div class="swiper-container" data-swiper="<?php echo esc_attr($swiper_params); ?>">
            <div class="swiper-wrapper">
                <?php komestic_render_product_categories_html($display_settings); ?>
            </div>
            <?php if(!empty($pagination)) : ?>
                    <div class="swiper-pagination"></div>
            <?php endif; ?>
            <?php if($navigation) : ?>
                <div class="swiper-navigation <?php echo esc_attr($navigation_hidden_class); ?>" <?php if(!empty($nav_widget_id)) : ?> data-navigation-id="<?php echo esc_attr($nav_widget_id); ?>" <?php endif; ?>>
                    <div class="pxl-swiper-button swiper-button-prev">
                        <?php \Elementor\Icons_Manager::render_icon( $nav_btn_icon_prev, [ 'aria-hidden' => 'true', 'class' => 'pxl-icon' ], 'i' ); ?>
                    </div>
                    <div class="pxl-swiper-button swiper-button-next">
                        <?php \Elementor\Icons_Manager::render_icon( $nav_btn_icon_next, [ 'aria-hidden' => 'true', 'class' => 'pxl-icon' ], 'i' ); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>